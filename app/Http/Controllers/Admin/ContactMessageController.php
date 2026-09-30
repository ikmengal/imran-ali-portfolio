<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ContactMessage::latest();

            return DataTables::of($query)
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
                ->addColumn('message', function ($message) {
                    return '<div class="text-truncate" style="max-width: 300px;">'.e(Str::limit($message->message, 100)).'</div>';
                })
                ->addColumn('status', function ($message) {
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
                        $actions .= '<a href="'.route('admin.messages.show', $message).'" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="bx bx-show"></i></a>';
                    }

                    if (auth()->user()->can('contact_messages-delete')) {
                        $actions .= '<form method="POST" action="'.route('admin.messages.destroy', $message).'" onsubmit="return confirm(\'Are you sure you want to delete this message?\')" class="d-inline">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['name', 'subject', 'message', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.messages.index');
    }

    public function show(ContactMessage $message)
    {
        $this->authorize('view', $message);

        return view('admin.messages.show', compact('message'));
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
