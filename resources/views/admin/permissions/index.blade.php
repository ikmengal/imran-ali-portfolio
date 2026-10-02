@extends('admin.layouts.app')
@section('title', 'Permissions')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Permissions</h2>
            <p class="text-muted mb-0">Manage system permissions</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
            <i class="ti ti-plus me-1"></i> Add Permission
        </button>
    </div>

    <x-admin.card title="Permissions" subtitle="All system permissions with assigned roles">
        <div class="card-body pb-0">
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" id="filter-search" class="form-control" placeholder="Search by name...">
                </div>
                <div class="col-md-3">
                    <select id="filter-label" class="form-select">
                        <option value="">All Labels</option>
                        @foreach($labels as $label)
                            <option value="{{ $label }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="permissionsTable table border-top table-striped dataTable no-footer dtr-column table-responsive table-hover nowrap w-100 data_table"
                id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Permission Name</th>
                        <th>Label/Category</th>
                        <th>Assigned Roles</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </x-admin.card>

    <!-- Create Permission Modal -->
    <div class="modal fade" id="createPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.permissions.store') }}" method="POST" id="createPermissionForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="e.g. users-view, projects-delete" id="name">
                            <small class="text-muted">Use format: resource-action (e.g. users-view, projects-create)</small>
                            <span class="text-danger error" id="name_error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Label/Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="label" placeholder="e.g. users, projects, settings" id="label">
                            <small class="text-muted">Used to group permissions in the UI</small>
                            <span class="text-danger error" id="label_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary pcSubmitBtn">Create Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="#" method="POST" id="editPermissionForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="permission_id" id="editPermissionId">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Permission: <span id="editPermissionName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="editPermissionNameInput" id="name">
                            <small class="text-muted">Use format: resource-action (e.g. users-view, projects-create)</small>
                            <span class="text-danger error" id="name_error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Label/Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="label" id="editPermissionLabelInput" id="label">
                            <small class="text-muted">Used to group permissions in the UI</small>
                            <span class="text-danger error" id="label_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary peSubmitBtn">Update Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var table = $('.permissionsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.permissions.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.label = $('#filter-label').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'label', name: 'label' },
                { data: 'roles', name: 'roles', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-label').on('change keyup', function() {
            table.draw();
        });

        // Create Permission Form - AJAX Submit
        $('#createPermissionForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('.pcSubmitBtn');
            const originalText = submitBtn.html();

            submitBtn.prop('disabled', true).html('<i class="ph-fill ph-spinner animate-spin"></i> Creating...');
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.error').empty();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#createPermissionModal').modal('hide');
                    form[0].reset();
                    toastr.success('Permission created successfully.');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            form.find('#' + key).addClass('is-invalid');
                            form.find('#' + key + '_error').text(val[0]);
                        });
                        toastr.error('Please fix the errors below.');
                    } else {
                        toastr.error('Failed to create permission.');
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });

        // Edit Permission Modal - Load permission data
        $(document).on('click', '.edit-permission-btn', function() {
            const permissionId = $(this).data('permission-id');

            $.ajax({
                url: '{{ route('admin.permissions.edit', ':id') }}'.replace(':id', permissionId),
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#editPermissionId').val(response.id);
                    $('#editPermissionName').text(response.name);
                    $('#editPermissionNameInput').val(response.name);
                    $('#editPermissionLabelInput').val(response.label);
                    $('#editPermissionForm').attr('action', '{{ route('admin.permissions.update', ':id') }}'.replace(':id', response.id));
                    $('#editPermissionModal').modal('show');
                }
            });
        });

        // Edit Permission Form - AJAX Submit
        $('#editPermissionForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('.peSubmitBtn');
            const originalText = submitBtn.html();

            submitBtn.prop('disabled', true).html('<i class="ph-fill ph-spinner animate-spin"></i> Updating...');
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.error').empty();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#editPermissionModal').modal('hide');
                    toastr.success('Permission updated successfully.');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            form.find('#' + key).addClass('is-invalid');
                            form.find('#' + key + '_error').text(val[0]);
                        });
                        toastr.error('Please fix the errors below.');
                    } else {
                        toastr.error('Failed to update permission.');
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });

        // Delete Permission
        $(document).on('click', '.delete', function() {
            const url = $(this).data('del-url');
            const name = $(this).closest('tr').find('td:nth-child(2) h6').text();

            $('#deletePermissionName').text(name);
            $('#deletePermissionForm').attr('action', url);
            $('#deletePermissionModal').modal('show');
        });

        $('#deletePermissionForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            submitBtn.prop('disabled', true).html('<i class="ph-fill ph-spinner animate-spin"></i> Deleting...');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#deletePermissionModal').modal('hide');
                    toastr.success('Permission deleted successfully.');
                    table.ajax.reload();
                },
                error: function() {
                    toastr.error('Failed to delete permission.');
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });
    });
</script>
@endpush
