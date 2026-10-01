@extends('admin.layouts.app')

@section('title', 'Permissions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Permissions</h2>
        <p class="text-muted mb-0">Manage system permissions</p>
    </div>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Add Permission
    </a>
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
        <table class="permissionsTable table border-top table-striped dataTable no-footer dtr-column table-responsive table-hover nowrap w-100"
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
    });
</script>
@endpush