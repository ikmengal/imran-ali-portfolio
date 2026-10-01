@extends('admin.layouts.app')
@section('title', 'Education')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Education</h2>
        <p class="text-muted mb-0">Manage your education history</p>
    </div>
    <a href="{{ route('admin.education.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Add Education
    </a>
</div>

<x-admin.card title="Education" subtitle="Manage all education entries">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by degree...">
            </div>
            <div class="col-md-3">
                <input type="text" id="filter-institution" class="form-control" placeholder="Search by institution...">
            </div>
            <div class="col-md-3">
                <select id="filter-visibility" class="form-select">
                    <option value="">All Visibility</option>
                    <option value="1">Visible</option>
                    <option value="0">Hidden</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-current" class="form-select">
                    <option value="">All</option>
                    <option value="1">Current</option>
                    <option value="0">Completed</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="table-responsive">
                <table class="educationTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Degree</th>
                            <th>Field</th>
                            <th>Duration</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin.card>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        var table = $('.educationTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.education.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.institution = $('#filter-institution').val();
                    d.is_visible = $('#filter-visibility').val();
                    d.is_current = $('#filter-current').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'degree', name: 'degree' },
                { data: 'field', name: 'field' },
                { data: 'duration', name: 'start_year', orderable: false, searchable: false },
                { data: 'location', name: 'location', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-institution, #filter-visibility, #filter-current').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush