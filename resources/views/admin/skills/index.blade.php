@extends('admin.layouts.app')
@section('title', 'Skills')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Skills</h2>
        <p class="text-muted mb-0">Manage your skills</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Add Skill
    </a>
</div>

<x-admin.card title="Skills" subtitle="Manage all skills with proficiency levels">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by skill name...">
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
                <table class="skillsTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Skill</th>
                            <th>Category</th>
                            <th>Proficiency</th>
                            <th>Status</th>
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
        var table = $('.skillsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.skills.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.category = $('#filter-category').val();
                    d.is_visible = $('#filter-visibility').val();
                    d.is_featured = $('#filter-featured').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'category', name: 'category' },
                { data: 'percentage', name: 'percentage', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-category, #filter-visibility, #filter-featured').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush