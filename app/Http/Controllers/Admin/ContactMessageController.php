<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends AdminController
{
    public function index(Request $request)
    {
        $filters = $this->getFilters(ContactMessage::class);

        if ($request->ajax()) {
            $query = ContactMessage::latest();
            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function ($message) {
                    return '<div>
                        <h6 class="mb-0">'.e($message->name).'</h6>
                        <small class="text-muted">'.e($message->email).'</small>
                    </div>';
                })
                ->addColumn('subject', function ($message) {
                    if ($message->subject) {
                        return '<span class="text-muted">'.e(Str::limit($message->subject, 50)).'</span>';
                    }

                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('category', function ($message) {
                    $colors = [
                        'general' => 'secondary',
                        'complaint' => 'danger',
                        'feedback' => 'info',
                        'query' => 'primary',
                        'support' => 'warning',
                    ];
                    $color = $colors[$message->category] ?? 'secondary';
                    return '<span class="badge bg-label-'.$color.' text-capitalize">'.$message->category.'</span>';
                })
                ->addColumn('status', function ($message) {
                    $colors = [
                        'new' => 'primary',
                        'in_progress' => 'warning',
                        'resolved' => 'success',
                        'closed' => 'secondary',
                    ];
                    $color = $colors[$message->status] ?? 'primary';
                    return '<span class="badge bg-label-'.$color.' text-capitalize">'.str_replace('_', ' ', $message->status).'</span>';
                })
                ->addColumn('message', function ($message) {
                    return '<div class="text-truncate" style="max-width: 300px;">'.e(Str::limit($message->message, 100)).'</div>';
                })
                ->addColumn('read_status', function ($message) {
                    if ($message->read_at) {
                        return '<span class="badge bg-label-success">Read</span>';
                    }
                    return '<span class="badge bg-label-danger">Unread</span>';
                })
                ->addColumn('created_at', function ($message) {
                    return '<small>'.$message->created_at->format('M d, Y H:i').'</small>';
                })
                ->addColumn('actions', function ($message) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                        if (auth()->user()->can('contact_messages-show')) {
                            $actions .= '<button type="button" class="btn btn-sm btn-icon btn-label-info view-message-btn" title="View"
                                data-message-id="'.$message->id.'">
                                <i class="ti ti-eye"></i>
                            </button>';
                        }
                        if (auth()->user()->can('contact_messages-edit') && ! $message->trashed()) {
                            $actions .= '<button type="button" class="btn btn-sm btn-icon btn-label-primary edit-message-btn" title="Reply/Edit"
                                data-message-id="'.$message->id.'">
                                <i class="ti ti-mail-edit"></i>
                            </button>';
                        }
                        if (auth()->user()->can('contact_messages-delete')) {
                            if ($message->trashed()) {
                                if (auth()->user()->hasRole('Super Admin')) {
                                    $actions .= '<button data-del-url="'.route('admin.messages.force-delete', $message).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Force Delete">
                                            <i class="ti ti-trash"></i>
                                        </button>';
                                    $actions .= '<a href="'.route('admin.messages.restore', $message).'" class="btn btn-sm btn-icon btn-label-success" title="Restore">
                                        <i class="ti ti-undo"></i>
                                    </a>';
                                }
                            } else {
                                $actions .= '<button data-del-url="'.route('admin.messages.destroy', $message).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete">
                                        <i class="ti ti-trash"></i>
                                    </button>';
                            }
                        }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['name', 'subject', 'category', 'status', 'message', 'read_status', 'actions'])
            ->make(true);
        }
        return view('admin.messages.index');
    }

    public function show(ContactMessage $message)
    {
        $this->authorize('view', $message);

        // Auto mark as read when viewed
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        if (request()->ajax() || request()->wantsJson()) {
            return view('admin.messages.partials._show', compact('message'))->render();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function edit(ContactMessage $message)
    {
        $this->authorize('update', $message);

        $admins = \App\Models\User::whereHas('roles', function($q) { $q->whereIn('name', ['Super Admin', 'Admin']); })->get(['id', 'name']);

        if (request()->ajax() || request()->wantsJson()) {
            $message->load('assignedTo');
            return response()->json([
                'message' => [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'subject' => $message->subject,
                    'category' => $message->category,
                    'status' => $message->status,
                    'message' => $message->message,
                    'admin_reply' => $message->admin_reply,
                    'replied_at' => $message->replied_at?->format('M d, Y H:i'),
                    'created_at' => $message->created_at->format('M d, Y H:i'),
                    'read_at' => $message->read_at?->format('M d, Y H:i'),
                    'assigned_to' => $message->assigned_to,
                    'assignedTo' => $message->assignedTo,
                    'repliedBy' => $message->repliedBy,
                ],
                'admins' => $admins,
            ]);
        }

        return view('admin.messages.edit', compact('message', 'admins'));
    }

public function update(Request $request, ContactMessage $message)
    {
        $this->authorize('update', $message);

        $validated = $request->validate([
            'category' => 'required|in:general,complaint,feedback,query,support',
            'status' => 'required|in:new,in_progress,resolved,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'admin_reply' => 'nullable|string',
        ]);

        if ($request->filled('admin_reply') && !$message->replied_at) {
            $validated['replied_at'] = now();
            $validated['replied_by'] = Auth::id();
        }

        $message->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Message updated successfully.']);
        }

        return redirect()->route('admin.messages.index')->with('success', 'Message updated successfully.');
    }

    public function destroy(ContactMessage $message)
    {
        $this->authorize('delete', $message);
        $message->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Message deleted successfully.']);
        }

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }

    public function toggleRead(Request $request, ContactMessage $message)
    {
        $this->authorize('toggleRead', $message);

        $action = $request->get('action');
        if ($action === 'read') {
            $message->update(['read_at' => now()]);
        } elseif ($action === 'unread') {
            $message->update(['read_at' => null]);
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    public function markAsRead(ContactMessage $message)
    {
        $this->authorize('toggleRead', $message);
        $message->update(['read_at' => now()]);

        return redirect()->route('admin.messages.index')->with('success', 'Message marked as read.');
    }

    public function markAsUnread(ContactMessage $message)
    {
        $this->authorize('toggleRead', $message);
        $message->update(['read_at' => null]);

        return redirect()->route('admin.messages.index')->with('success', 'Message marked as unread.');
    }
}
