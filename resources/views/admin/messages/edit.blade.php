@extends('admin.layouts.app')

@section('title', 'Reply to Message')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Reply to Message</h2>
                <p class="text-muted mb-0">Respond to contact form submission</p>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Messages
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <!-- Original Message -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">Original Message</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $message->name }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <p class="form-control-static"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $message->subject ?? '—' }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <span class="badge bg-label-{{ ['general'=>'secondary','complaint'=>'danger','feedback'=>'info','query'=>'primary','support'=>'warning'][$message->category] ?? 'secondary' }} text-capitalize">
                            {{ $message->category }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <span class="badge bg-label-{{ ['new'=>'primary','in_progress'=>'warning','resolved'=>'success','closed'=>'secondary'][$message->status] ?? 'primary' }} text-capitalize">
                            {{ str_replace('_', ' ', $message->status) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Received</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $message->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10">
                        <div class="bg-light dark:bg-slate-800 p-4 rounded border">
                            {!! nl2br(e($message->message)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Reply Form -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Admin Reply & Management</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.messages.update', $message) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

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
                            @foreach(\App\Models\User::whereHas('roles', function($q) { $q->whereIn('name', ['Super Admin', 'Admin']); })->get() as $admin)
                                <option value="{{ $admin->id }}" {{ $message->assigned_to === $admin->id ? 'selected' : '' }}>
                                    {{ $admin->name }} ({{ $admin->getRoleNames()->first() }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Admin Reply</label>
                        <textarea name="admin_reply" class="form-control" rows="6" placeholder="Write your reply here...">{{ $message->admin_reply }}</textarea>
                        <small class="text-muted">This reply can be sent to the user via email (feature to be implemented).</small>
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

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-save me-1"></i> Save Changes
                        </button>
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Auto-hide success messages
        const alerts = document.querySelectorAll('.alert-success');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000);
        });
    });
</script>
@endpush