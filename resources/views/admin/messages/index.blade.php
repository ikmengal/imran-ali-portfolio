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
    </x-admin.card>

    <!-- View Message Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewMessageContent">
                    <!-- Loaded via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit/Reply Message Modal -->
    <div class="modal fade" id="editMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="#" method="POST" id="editMessageForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="message_id" id="editMessageId">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply to Message: <span id="editMessageSubject"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="editMessageContent">
                        <!-- Loaded via AJAX -->
                    </div>
                </form>
            </div>
        </div>
    </div>
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

            // View Message
            $(document).on('click', '.view-message-btn', function() {
                const messageId = $(this).data('message-id');

                $.ajax({
                    url: '{{ route('admin.messages.show', ':id') }}'.replace(':id', messageId),
                    method: 'GET',
                    success: function(response) {
                        $('#viewMessageContent').html(response);
                        $('#viewMessageModal').modal('show');
                    }
                });
            });

            // Edit/Reply Message
            $(document).on('click', '.edit-message-btn', function() {
                const messageId = $(this).data('message-id');

                $.ajax({
                    url: '{{ route('admin.messages.edit', ':id') }}'.replace(':id', messageId),
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#editMessageId').val(response.message.id);
                        $('#editMessageSubject').text(response.message.subject || 'No Subject');
                        $('#editMessageForm').attr('action', '{{ route('admin.messages.update', ':id') }}'.replace(':id', response.message.id));

                        // Build form content
                        let content = `
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Original Message</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2"><label class="col-sm-3 col-form-label">Name</label><div class="col-sm-9">${response.message.name}</div></div>
                                    <div class="row mb-2"><label class="col-sm-3 col-form-label">Email</label><div class="col-sm-9"><a href="mailto:${response.message.email}">${response.message.email}</a></div></div>
                                    <div class="row mb-2"><label class="col-sm-3 col-form-label">Subject</label><div class="col-sm-9">${response.message.subject || '—'}</div></div>
                                    <div class="row mb-2"><label class="col-sm-3 col-form-label">Category</label><div class="col-sm-9"><span class="badge bg-label-${({general:'secondary',complaint:'danger',feedback:'info',query:'primary',support:'warning'})[response.message.category] || 'secondary'} text-capitalize">${response.message.category}</span></div></div>
                                    <div class="row mb-2"><label class="col-sm-3 col-form-label">Status</label><div class="col-sm-9"><span class="badge bg-label-${({new:'primary',in_progress:'warning',resolved:'success',closed:'secondary'})[response.message.status] || 'primary'} text-capitalize">${response.message.status.replace('_', ' ')}</span></div></div>
                                    <div class="row mb-2"><label class="col-sm-3 col-form-label">Received</label><div class="col-sm-9">${response.message.created_at}</div></div>
                                    <div class="row"><label class="col-sm-3 col-form-label">Message</label><div class="col-sm-9"><div class="bg-light dark:bg-slate-800 p-3 rounded border">${response.message.message}</div></div></div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Admin Reply & Management</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Category</label>
                                            <select name="category" class="form-select" required>
                                                <option value="general" ${response.message.category === 'general' ? 'selected' : ''}>General</option>
                                                <option value="complaint" ${response.message.category === 'complaint' ? 'selected' : ''}>Complaint</option>
                                                <option value="feedback" ${response.message.category === 'feedback' ? 'selected' : ''}>Feedback</option>
                                                <option value="query" ${response.message.category === 'query' ? 'selected' : ''}>Query</option>
                                                <option value="support" ${response.message.category === 'support' ? 'selected' : ''}>Support</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="new" ${response.message.status === 'new' ? 'selected' : ''}>New</option>
                                                <option value="in_progress" ${response.message.status === 'in_progress' ? 'selected' : ''}>In Progress</option>
                                                <option value="resolved" ${response.message.status === 'resolved' ? 'selected' : ''}>Resolved</option>
                                                <option value="closed" ${response.message.status === 'closed' ? 'selected' : ''}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Assign To</label>
                                            <select name="assigned_to" class="form-select">
                                                <option value="">— Unassigned —</option>`;

                        response.admins.forEach(admin => {
                            content += `<option value="${admin.id}" ${response.message.assigned_to === admin.id ? 'selected' : ''}>${admin.name}</option>`;
                        });

                        content += `
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Admin Reply</label>
                                            <textarea name="admin_reply" class="form-control" rows="6" placeholder="Write your reply here...">${response.message.admin_reply || ''}</textarea>
                                            <small class="text-muted">This reply will be visible to the user in their dashboard.</small>
                                        </div>
                        `;

                        if (response.message.admin_reply) {
                            content += `
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <strong>Previous Reply:</strong> ${response.message.replied_at || 'Not sent'}
                                                <div class="mt-2 bg-light dark:bg-slate-800 p-3 rounded border">
                                                    ${response.message.admin_reply}
                                                </div>
                                            </div>
                                        </div>
                            `;
                        }

                        content += `
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        `;

                        $('#editMessageContent').html(content);
                        $('#editMessageModal').modal('show');
                    }
                });
            });

            // Edit Message Form - AJAX Submit
            $('#editMessageForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const originalText = submitBtn.html();

                submitBtn.prop('disabled', true).html('<i class="ph-fill ph-spinner animate-spin"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#editMessageModal').modal('hide');
                        toastr.success('Message updated successfully.');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMsg = '';
                            $.each(errors, function(key, val) {
                                errorMsg += val[0] + '<br>';
                            });
                            toastr.error(errorMsg);
                        } else {
                            toastr.error('Failed to update message.');
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@endpush
