@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Users</h2>
        <p class="text-muted mb-0">Manage system users</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.users.trashed') }}" class="btn btn-outline-secondary">
            <i class="bx bx-trash me-1"></i> Trashed
        </a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Add User
        </a>
    </div>
</div>

<x-admin.card title="Users" subtitle="Manage all system users and their roles">
    <div class="table-responsive">
        <table id="usersTable" class="table table-striped table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Email Verified</th>
                    <th>Registered</th>
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
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.users.index') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'roles', name: 'roles', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'email_verified', name: 'email_verified', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[4, 'desc']],
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