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
    <div class="table-responsive">
        <table id="messagesTable" class="table table-striped table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</x-admin.card>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#messagesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.messages.index') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'subject', name: 'subject' },
                { data: 'message', name: 'message', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[4, 'desc']],
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