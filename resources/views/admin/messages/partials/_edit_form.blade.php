<!-- Original Message -->
<div class="card mb-3">
    <div class="card-header bg-light">
        <h6 class="mb-0">Original Message</h6>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">{{ $message->name }}</div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Subject</label>
            <div class="col-sm-9">{{ $message->subject ?? '—' }}</div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Category</label>
            <div class="col-sm-9">
                <span class="badge bg-label-{{ ['general'=>'secondary','complaint'=>'danger','feedback'=>'info','query'=>'primary','support'=>'warning'][$message->category] ?? 'secondary' }} text-capitalize">
                    {{ $message->category }}
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <span class="badge bg-label-{{ ['new'=>'primary','in_progress'=>'warning','resolved'=>'success','closed'=>'secondary'][$message->status] ?? 'primary' }} text-capitalize">
                    {{ str_replace('_', ' ', $message->status) }}
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-3 col-form-label">Received</label>
            <div class="col-sm-9">{{ $message->created_at->format('M d, Y H:i') }}</div>
        </div>
        <div class="row">
            <label class="col-sm-3 col-form-label">Message</label>
            <div class="col-sm-9">
                <div class="bg-light dark:bg-slate-800 p-3 rounded border">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Admin Reply Form -->
<div class="card">
    <div class="card-header">
        <h6 class="mb-0">Admin Reply & Management</h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="general" {{ $message->category === 'general' ? 'selected' : '' }}>General</option>
                    <option value="complaint" {{ $message->category === 'complaint' ? 'selected' : '' }}>Complaint</option>
                    <option value="feedback" {{ $message->category === 'feedback' ? 'selected' : '' }}>Feedback</option>
                    <option value="query" {{ $message->category === 'query' ? 'selected' : '' }}>Query</option>
                    <option value="support" {{ $message->category === 'support' ? 'selected' : '' }}>Support</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="new" {{ $message->status === 'new' ? 'selected' : '' }}>New</option>
                    <option value="in_progress" {{ $message->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ $message->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ $message->status === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Assign To</label>
                <select name="assigned_to" class="form-select">
                    <option value="">— Unassigned —</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ $message->assigned_to === $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Admin Reply</label>
                <textarea name="admin_reply" class="form-control" rows="6" placeholder="Write your reply here...">{{ $message->admin_reply }}</textarea>
                <small class="text-muted">This reply will be visible to the user in their dashboard.</small>
            </div>

            @if($message->admin_reply)
            <div class="col-12">
                <div class="alert alert-info">
                    <strong>Previous Reply:</strong> {{ $message->replied_at ? $message->replied_at->format('M d, Y H:i') : 'Not sent' }}
                    <div class="mt-2 bg-light dark:bg-slate-800 p-3 rounded border">
                        {!! nl2br(e($message->admin_reply)) !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>