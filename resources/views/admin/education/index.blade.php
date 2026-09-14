@extends('admin.layouts.app')

@section('title', 'Education')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Education</h2>
        <p class="text-muted mb-0">Manage your education records</p>
    </div>
    <a href="{{ route('admin.education.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add Education
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="educationTable" class="table table-striped table-hover dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Degree & Institution</th>
                        <th>Field</th>
                        <th>Duration</th>
                        <th>Location</th>
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
        $('#educationTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.education.index') }}',
            columns: [
                { data: 'degree', name: 'degree' },
                { data: 'field', name: 'field' },
                { data: 'duration', name: 'duration' },
                { data: 'location', name: 'location' },
                { data: 'status', name: 'status' },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[5, 'asc']],
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