@extends('admin.layouts.app')

@section('title', 'Roles')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Roles & Permissions</h2>
                <p class="text-muted mb-0">Manage system roles and their permissions</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                    <i class="ti ti-plus me-1"></i> Create Role
                </button>
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#managePermissionsModal">
                    <i class="ti ti-lock me-1"></i> Manage Permissions
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Roles Cards -->
<div class="row" id="rolesContainer">
    @foreach($roles as $role)
        <div class="col-md-4 mb-4">
            <div class="card h-100 role-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $role->name }}</h5>
                        <span class="badge bg-label-{{ $role->name === 'Super Admin' ? 'danger' : ($role->name === 'Admin' ? 'warning' : 'primary') }}">
                            {{ $role->name }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Users Assigned</span>
                            <span class="fw-bold fs-4">{{ $role->users()->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted">Permissions</span>
                            <span class="fw-bold">{{ $role->permissions->count() }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary flex-grow-1 edit-role-btn"
                            data-bs-toggle="modal" data-bs-target="#editRoleModal"
                            data-role-id="{{ $role->id }}"
                            data-role-name="{{ $role->name }}">
                            <i class="ti ti-edit me-1"></i> Edit Permissions
                        </button>
                        @can('roles-delete')
                        @if($role->name !== 'Super Admin')
                        <button type="button" class="btn btn-sm btn-danger delete-role-btn"
                            data-role-id="{{ $role->id }}"
                            data-role-name="{{ $role->name }}">
                            <i class="ti ti-trash me-1"></i> Delete
                        </button>
                        @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($roles->isEmpty())
<div class="text-center py-5">
    <i class="ti ti-lock text-muted" style="font-size: 3rem;"></i>
    <h4 class="mt-3 text-muted">No Roles Found</h4>
    <p class="text-muted">Create your first role to get started.</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        <i class="ti ti-plus me-1"></i> Create Role
    </button>
</div>
@endif

<!-- Create Role Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.roles.store') }}" method="POST" id="createRoleForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. Content Manager, Moderator" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        @foreach($permissions as $label => $perms)
                            <div class="mb-3">
                                <h6 class="text-muted text-uppercase fw-bold mb-2">{{ $label }}</h6>
                                <div class="row g-2">
                                    @foreach($perms as $perm)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="create_perm_{{ $perm->name }}">
                                                <label class="form-check-label" for="create_perm_{{ $perm->name }}">
                                                    {{ $perm->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="#" method="POST" id="editRoleForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="role_id" id="editRoleId">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role: <span id="editRoleName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="editRoleNameInput" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Select/deselect permissions for this role</span>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" id="checkAllPermissions">Check All</button>
                                <button type="button" class="btn btn-outline-secondary" id="uncheckAllPermissions">Uncheck All</button>
                            </div>
                        </div>
                        @foreach($permissions as $label => $perms)
                            <div class="mb-3">
                                <h6 class="text-muted text-uppercase fw-bold mb-2">{{ $label }}</h6>
                                <div class="row g-2">
                                    @foreach($perms as $perm)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="edit_perm_{{ $perm->name }}">
                                                <label class="form-check-label" for="edit_perm_{{ $perm->name }}">
                                                    {{ $perm->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Manage Permissions Modal (Bulk) -->
<div class="modal fade" id="managePermissionsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Select Role</label>
                        <select class="form-select select2" id="bulkRoleSelect">
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->users()->count() }} users)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2 mt-4">
                            <button type="button" class="btn btn-outline-primary" id="checkAllBulk">Check All</button>
                            <button type="button" class="btn btn-outline-secondary" id="uncheckAllBulk">Uncheck All</button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.roles.bulk-permissions') }}" method="POST" id="bulkPermissionsForm">
                    @csrf
                    <input type="hidden" name="role_id" id="bulkRoleId">
                    @foreach($permissions as $label => $perms)
                        <div class="mb-3">
                            <h6 class="text-muted text-uppercase fw-bold mb-2">{{ $label }}</h6>
                            <div class="row g-2">
                                @foreach($perms as $perm)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input bulk-permission-checkbox" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="bulk_perm_{{ $perm->name }}">
                                            <label class="form-check-label" for="bulk_perm_{{ $perm->name }}">
                                                {{ $perm->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBulkPermissions">Save Permissions</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Role Confirmation Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteRoleName"></strong>? This action cannot be undone.</p>
                <p class="text-muted small">Users with this role will lose it.</p>
            </div>
            <div class="modal-footer">
                <form action="#" method="POST" id="deleteRoleForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="role_id" id="deleteRoleId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Role</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('admin/assets/vendor/libs/select2/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            dropdownParent: $('.modal'),
            width: '100%'
        });

        // Edit Role Modal - Load role data
        $(document).on('click', '.edit-role-btn', function() {
            const roleId = $(this).data('role-id');
            const roleName = $(this).data('role-name');

            $('#editRoleId').val(roleId);
            $('#editRoleName').text(roleName);
            $('#editRoleNameInput').val(roleName);
            $('#editRoleForm').attr('action', '{{ route('admin.roles.update', ':id') }}'.replace(':id', roleId));

            // Reset checkboxes
            $('.permission-checkbox').prop('checked', false);

            // Load role permissions via AJAX
            $.ajax({
                url: '{{ route('admin.roles.show', ':id') }}'.replace(':id', roleId),
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.permissions) {
                        response.permissions.forEach(function(permName) {
                            $('#edit_perm_' + permName).prop('checked', true);
                        });
                    }
                }
            });
        });

        // Check/Uncheck all permissions in edit modal
        $('#checkAllPermissions').on('click', function() {
            $('.permission-checkbox').prop('checked', true);
        });
        $('#uncheckAllPermissions').on('click', function() {
            $('.permission-checkbox').prop('checked', false);
        });

        // Check/Uncheck all permissions in bulk modal
        $('#checkAllBulk').on('click', function() {
            $('.bulk-permission-checkbox').prop('checked', true);
        });
        $('#uncheckAllBulk').on('click', function() {
            $('.bulk-permission-checkbox').prop('checked', false);
        });

        // Bulk Role Select - Load permissions for selected role
        $('#bulkRoleSelect').on('change', function() {
            const roleId = $(this).val();
            $('#bulkRoleId').val(roleId);
            $('.bulk-permission-checkbox').prop('checked', false);

            if (roleId) {
                $.ajax({
                    url: '{{ route('admin.roles.show', ':id') }}'.replace(':id', roleId),
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.permissions) {
                            response.permissions.forEach(function(permName) {
                                $('#bulk_perm_' + permName).prop('checked', true);
                            });
                        }
                    }
                });
            }
        });

        // Save Bulk Permissions
        $('#saveBulkPermissions').on('click', function() {
            const roleId = $('#bulkRoleId').val();
            if (!roleId) {
                toastr.error('Please select a role first');
                return;
            }

            $('#bulkPermissionsForm').attr('action', '{{ route('admin.roles.bulk-permissions') }}');
            $('#bulkPermissionsForm').submit();
        });

        // Delete Role
        $(document).on('click', '.delete-role-btn', function() {
            const roleId = $(this).data('role-id');
            const roleName = $(this).data('role-name');

            $('#deleteRoleId').val(roleId);
            $('#deleteRoleName').text(roleName);
            $('#deleteRoleForm').attr('action', '{{ route('admin.roles.destroy', ':id') }}'.replace(':id', roleId));
        });

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