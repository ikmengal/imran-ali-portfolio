@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Pages</h2>
        <p class="text-muted mb-0">Manage static pages (Privacy Policy, Terms, etc.)</p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Add Page
    </a>
</div>

<x-admin.card title="Pages" subtitle="All static pages">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by title...">
            </div>
            <div class="col-md-3">
                <select id="filter-visibility" class="form-select">
                    <option value="">All Status</option>
                    <option value="1">Visible</option>
                    <option value="0">Hidden</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-footer" class="form-select">
                    <option value="">Footer Status</option>
                    <option value="1">Show in Footer</option>
                    <option value="0">Not in Footer</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <table class="pagesTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap w-100"
            id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
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
        var table = $('.pagesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.pages.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.is_visible = $('#filter-visibility').val();
                    d.show_in_footer = $('#filter-footer').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'slug', name: 'slug' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-visibility, #filter-footer').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush