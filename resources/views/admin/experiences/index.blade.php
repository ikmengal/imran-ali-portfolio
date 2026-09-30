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

<x-admin.card title="Experiences" subtitle="Manage all work experiences">
    <div class="table-responsive">
        <table id="experiencesTable" class="table table-striped table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Type</th>
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
</x-admin.card>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#experiencesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.experiences.index') }}',
            columns: [
                { data: 'job_title', name: 'job_title' },
                { data: 'type', name: 'employment_type', orderable: false, searchable: false },
                { data: 'duration', name: 'start_date', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[4, 'asc']],
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