@extends('admin.layouts.app')
@section('title', 'Messages')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Contact Messages</h2>
        <p class="text-muted mb-0">Manage contact form submissions</p>
    </div>
</div>

<x-admin.card title="Messages" subtitle="All contact form submissions">
    <div class="card-body pb-0">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter-search" class="form-control" placeholder="Search by name...">
            </div>
            <div class="col-md-3">
                <input type="text" id="filter-email" class="form-control" placeholder="Search by email...">
            </div>
            <div class="col-md-2">
                <select id="filter-category" class="form-select">
                    <option value="">All Categories</option>
                    <option value="general">General</option>
                    <option value="complaint">Complaint</option>
                    <option value="feedback">Feedback</option>
                    <option value="query">Query</option>
                    <option value="support">Support</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter-status" class="form-select">
                    <option value="">All Status</option>
                    <option value="new">New</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter-read" class="form-select">
                    <option value="">Read Status</option>
                    <option value="1">Read</option>
                    <option value="0">Unread</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="table-responsive">
                <table class="messagesTable table border-top table-striped dataTable no-footer dtr-column data_table table-responsive table-hover nowrap w-100"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="display: table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Read</th>
                            <th>Date</th>
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
        var table = $('.messagesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.messages.index') }}',
                data: function(d) {
                    d.search = $('#filter-search').val();
                    d.email = $('#filter-email').val();
                    d.category = $('#filter-category').val();
                    d.status = $('#filter-status').val();
                    d.is_read = $('#filter-read').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'subject', name: 'subject' },
                { data: 'category', name: 'category' },
                { data: 'status', name: 'status' },
                { data: 'message', name: 'message', orderable: false, searchable: false },
                { data: 'read_status', name: 'read_status', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
        });

        $('#filter-search, #filter-email, #filter-category, #filter-status, #filter-read').on('change keyup', function() {
            table.draw();
        });
    });
</script>
@endpush