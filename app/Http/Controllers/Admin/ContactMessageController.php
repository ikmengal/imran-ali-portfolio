<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $messages = ContactMessage::latest();
            return DataTables::of($messages)
                ->addColumn('name', function ($message) {
                    return '<div>
                        <h6 class="mb-1">' . e($message->name) . '</h6>
                        <small class="text-muted">' . e($message->email) . '</small>
                    </div>';
                })
                ->addColumn('subject', function ($message) {
                    if ($message->subject) {
                        return e($message->subject);
                    }
                    return '<span class="text-muted">No subject</span>';
                })
                ->addColumn('message', function ($message) {
                    return '<small class="text-muted">' . e(\Illuminate\Support\Str::limit($message->message, 100)) . '</small>';
                })
                ->addColumn('status', function ($message) {
                    if ($message->read_at) {
                        return '<span class="badge bg-label-success">Read</span>';
                    }
                    return '<span class="badge bg-label-warning">Unread</span>';
                })
                ->addColumn('date', function ($message) {
                    return $message->created_at->format('M d, Y H:i');
                })
                ->addColumn('actions', function ($message) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                    if ($message->read_at) {
                        $actions .= '<form method="POST" action="' . route('admin.messages.unread', $message) . '" class="d-inline">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-secondary" title="Mark as Unread"><i class="bx bx-envelope"></i></button>
                        </form>';
                    } else {
                        $actions .= '<form method="POST" action="' . route('admin.messages.read', $message) . '" class="d-inline">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-primary" title="Mark as Read"><i class="bx bx-check"></i></button>
                        </form>';
                    }
                    $actions .= '<a href="' . route('admin.messages.show', $message) . '" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="bx bx-show"></i></a>';
                    $actions .= '<form method="POST" action="' . route('admin.messages.destroy', $message) . '" onsubmit="return confirm(\'Are you sure you want to delete this message?\')" class="d-inline">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                    </form>';
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
        if ($message->read_at === null) {
            $message->update(['read_at' => now()]);
            $message->refresh();
        }
        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(ContactMessage $message)
    {
        $message->update(['read_at' => now()]);
        return redirect()->route('admin.messages.index')->with('success', 'Message marked as read.');
    }

    public function markAsUnread(ContactMessage $message)
    {
        $message->update(['read_at' => null]);
        return redirect()->route('admin.messages.index')->with('success', 'Message marked as unread.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}