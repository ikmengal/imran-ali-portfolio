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
            <i class="ti ti-trash me-1"></i> Trashed
        </a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Add User
        </a>
    </div>
</div>

<x-admin.card title="Users" subtitle="Manage all system users and their roles">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by name...">
            </div>
            <div class="col-md-3">
                <input type="text" id="filter-email" class="form-control" placeholder="Search by email...">
            </div>
            <div class="col-md-2">
                <select id="filter-role" class="form-select">
                    <option value="">All Roles</option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter-status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="trashed">Trashed</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter-email-verified" class="form-select">
                    <option value="">Email Verified</option>
                    <option value="1">Verified</option>
                    <option value="0">Unverified</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="table-responsive">
                <table class="usersTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap w-100"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>User</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Email Verified</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin.card>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var table = $('.usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.users.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.email = $('#filter-email').val();
                    d.role = $('#filter-role').val();
                    d.status = $('#filter-status').val();
                    d.email_verified = $('#filter-email-verified').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'roles', name: 'roles', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'email_verified', name: 'email_verified', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-email, #filter-role, #filter-status, #filter-email-verified').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush