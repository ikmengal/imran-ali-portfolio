@extends('admin.layouts.app')

@section('title', 'Experiences')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Experiences</h2>
        <p class="text-muted mb-0">Manage your work experiences</p>
    </div>
    <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add Experience
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="experiencesTable" class="table table-striped table-hover dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Role & Company</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#experiencesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.experiences.index') }}',
            columns: [
                { data: 'title', name: 'title' },
                { data: 'type', name: 'type' },
                { data: 'location', name: 'location' },
                { data: 'duration', name: 'duration' },
                { data: 'status', name: 'status' },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[5, 'asc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            responsive: true,
            language: {
                processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
            }
        });
    });
</script>
@endpush