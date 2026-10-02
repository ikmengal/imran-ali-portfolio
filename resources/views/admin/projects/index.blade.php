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
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by title...">
            </div>
            <div class="col-md-3">
                <select id="filter-category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-visibility" class="form-select">
                    <option value="">All Visibility</option>
                    <option value="1">Visible</option>
                    <option value="0">Hidden</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-featured" class="form-select">
                    <option value="">All Featured</option>
                    <option value="1">Featured</option>
                    <option value="0">Not Featured</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="table-responsive">
                <table class="projectsTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap w-100"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Project</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin.card>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        var table = $('.projectsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.projects.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.category = $('#filter-category').val();
                    d.is_visible = $('#filter-visibility').val();
                    d.is_featured = $('#filter-featured').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-category, #filter-visibility, #filter-featured').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush
