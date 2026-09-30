@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Projects</h2>
        <p class="text-muted mb-0">Manage your portfolio projects</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add Project
    </a>
</div>

<x-admin.card title="Projects" subtitle="Manage all portfolio projects with technologies">
    <div class="table-responsive">
        <table id="projectsTable" class="table table-striped table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Project</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Technologies</th>
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

@push('js')
<script>
    $(document).ready(function() {
        $('#projectsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.projects.index') }}',
            columns: [
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'technologies', name: 'technologies', orderable: false, searchable: false },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[5, 'asc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            responsive: true,
            language: {
                processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
            },
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>
@endpush
