@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Testimonials</h2>
        <p class="text-muted mb-0">Manage client testimonials</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i> Add Testimonial
    </a>
</div>

<x-admin.card title="Testimonials" subtitle="Manage all client testimonials">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by name...">
            </div>
            <div class="col-md-3">
                <input type="text" id="filter-company" class="form-control" placeholder="Search by company...">
            </div>
            <div class="col-md-3">
                <select id="filter-rating" class="form-select">
                    <option value="">All Ratings</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
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
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="table-responsive">
                <table class="testimonialsTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap w-100"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Client</th>
                            <th>Rating</th>
                            <th>Message</th>
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
        var table = $('.testimonialsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.testimonials.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.company = $('#filter-company').val();
                    d.rating = $('#filter-rating').val();
                    d.is_visible = $('#filter-visibility').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'rating', name: 'rating', orderable: false, searchable: false },
                { data: 'message', name: 'message', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-company, #filter-rating, #filter-visibility').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush