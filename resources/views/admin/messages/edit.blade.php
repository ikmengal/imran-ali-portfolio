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
        @include('admin.messages.partials._edit_form')
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