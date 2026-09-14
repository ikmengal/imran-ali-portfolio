@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Services</h2>
        <p class="text-muted mb-0">Manage your services</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add Service
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="servicesTable" class="table table-striped table-hover dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#servicesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.services.index') }}',
            columns: [
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[3, 'asc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            responsive: true,
            language: {
                processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
            }
        });
    });
</script>
@endpush