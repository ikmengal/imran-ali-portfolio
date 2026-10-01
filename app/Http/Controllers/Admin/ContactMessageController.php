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
                            $actions .= '<a href="'.route('admin.messages.show', $message).'" class="btn btn-sm btn-icon btn-label-info" title="View">
                                <i class="ti ti-eye"></i>
                            </a>';
                        }
                        if (auth()->user()->can('contact_messages-edit') && ! $message->trashed()) {
                            $actions .= '<a href="'.route('admin.messages.edit', $message).'" class="btn btn-sm btn-icon btn-label-primary" title="Reply/Edit">
                                <i class="ti ti-mail-edit"></i>
                            </a>';
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

        return view('admin.messages.show', compact('message'));
    }

    public function edit(ContactMessage $message)
    {
        $this->authorize('update', $message);

        return view('admin.messages.edit', compact('message'));
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

        if ($request->filled('admin_reply') && ! $message->replied_at) {
            $validated['replied_at'] = now();
            $validated['replied_by'] = Auth::id();
        }

        $message->update($validated);

        return redirect()->route('admin.messages.index')->with('success', 'Message updated successfully.');
    }

    public function destroy(ContactMessage $message)
    {
        $this->authorize('delete', $message);
        $message->delete();

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
