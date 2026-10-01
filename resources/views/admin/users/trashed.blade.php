@extends('admin.layouts.app')
@section('title', 'Trashed Users')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Trashed Users</h2>
            <p class="text-muted mb-0">Deleted users (soft deleted)</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-back me-1"></i> Back to Users
        </a>
    </div>

    <x-admin.card title="Trashed Users" subtitle="Restore or permanently delete users">
        <div class="table-responsive">
            <table id="trashedUsersTable" class="table table-striped table-hover dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Roles</th>
                        <th>Deleted At</th>
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
            $('#trashedUsersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.users.trashed') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'roles', name: 'roles', orderable: false, searchable: false },
                    { data: 'deleted_at', name: 'deleted_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[2, 'desc']],
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
