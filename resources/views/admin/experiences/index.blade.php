@extends('admin.layouts.app')
@section('title', 'Experiences')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Experiences</h2>
        <p class="text-muted mb-0">Manage your work experiences</p>
    </div>
    <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Add Experience
    </a>
</div>

<x-admin.card title="Experiences" subtitle="Manage all work experiences">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by job title...">
            </div>
            <div class="col-md-3">
                <input type="text" id="filter-company" class="form-control" placeholder="Search by company...">
            </div>
            <div class="col-md-3">
                <select id="filter-employment-type" class="form-select">
                    <option value="">All Types</option>
                    @foreach($employmentTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
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
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <select id="filter-current" class="form-select">
                    <option value="">All</option>
                    <option value="1">Current</option>
                    <option value="0">Past</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="table-responsive">
                <table class="experiencesTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Position</th>
                            <th>Type</th>
                            <th>Duration</th>
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
        var table = $('.experiencesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.experiences.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.company = $('#filter-company').val();
                    d.employment_type = $('#filter-employment-type').val();
                    d.is_visible = $('#filter-visibility').val();
                    d.is_current = $('#filter-current').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'job_title', name: 'job_title' },
                { data: 'type', name: 'employment_type', orderable: false, searchable: false },
                { data: 'duration', name: 'start_date', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-company, #filter-employment-type, #filter-visibility, #filter-current').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush