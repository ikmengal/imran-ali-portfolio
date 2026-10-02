<div class="row">
    <div class="col-md-6">
        <x-admin.card title="Sender Information">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <th scope="row" style="width: 150px;">Name</th>
                        <td>{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Subject</th>
                        <td>{{ $message->subject ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td>
                            <span class="badge bg-label-{{ ['general'=>'secondary','complaint'=>'danger','feedback'=>'info','query'=>'primary','support'=>'warning'][$message->category] ?? 'secondary' }} text-capitalize">
                                {{ $message->category }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>
                            <span class="badge bg-label-{{ ['new'=>'primary','in_progress'=>'warning','resolved'=>'success','closed'=>'secondary'][$message->status] ?? 'primary' }} text-capitalize">
                                {{ str_replace('_', ' ', $message->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Read Status</th>
                        <td>
                            @if ($message->read_at)
                                <span class="badge bg-label-success">Read</span>
                                <small class="text-muted ms-2">Read on {{ $message->read_at->format('M d, Y H:i') }}</small>
                            @else
                                <span class="badge bg-label-danger">Unread</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Received</th>
                        <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @if($message->assigned_to)
                    <tr>
                        <th scope="row">Assigned To</th>
                        <td>{{ $message->assignedTo->name ?? 'Unknown' }}</td>
                    </tr>
                    @endif
                    @if($message->replied_at)
                    <tr>
                        <th scope="row">Replied</th>
                        <td>{{ $message->replied_at->format('M d, Y H:i') }} by {{ $message->repliedBy->name ?? 'Admin' }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </x-admin.card>
    </div>

    <div class="col-md-6">
        <x-admin.card title="Message" class="mt-3 mt-md-0">
            <div class="prose">{{ $message->message }}</div>
        </x-admin.card>
        
        @if($message->admin_reply)
        <x-admin.card title="Admin Reply" class="mt-3">
            <div class="alert alert-info">
                <strong>Replied on:</strong> {{ $message->replied_at->format('M d, Y H:i') }}
                <div class="mt-2 bg-light dark:bg-slate-800 p-3 rounded border">
                    {!! nl2br(e($message->admin_reply)) !!}
                </div>
            </div>
        </x-admin.card>
        @endif
    </div>
</div>

<div class="modal-footer mt-3">
    <a href="{{ route('admin.messages.edit', $message) }}" class="btn btn-primary">
        <i class="ti ti-mail-edit me-1"></i> Reply / Edit
    </a>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>