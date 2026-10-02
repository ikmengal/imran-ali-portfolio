@extends('admin.layouts.app')

@section('title', 'My Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">My Messages</h2>
        <p class="text-muted mb-0">View and track your contact form submissions</p>
    </div>
</div>

<x-admin.card title="Messages" subtitle="Your submitted messages and admin replies">
    <div class="card-body">
        @if($messages->isEmpty())
            <div class="text-center py-5">
                <i class="ti ti-mail text-muted" style="font-size: 3rem;"></i>
                <h4 class="mt-3 text-muted">No Messages Found</h4>
                <p class="text-muted">You haven't submitted any messages yet.</p>
                <a href="{{ route('portfolio') }}#contact" class="btn btn-primary mt-2">
                    <i class="ti ti-plus me-1"></i> Send a Message
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover w-100">
                    <thead class="table-light">
                        <tr>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Sent</th>
                            <th>Reply Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>
                                    <strong>{{ $message->subject ?? 'No Subject' }}</strong>
                                    @if($message->admin_reply)
                                        <span class="badge bg-label-success ms-2">Replied</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-label-{{ ['general'=>'secondary','complaint'=>'danger','feedback'=>'info','query'=>'primary','support'=>'warning'][$message->category] ?? 'secondary' }} text-capitalize">
                                        {{ $message->category }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-label-{{ ['new'=>'primary','in_progress'=>'warning','resolved'=>'success','closed'=>'secondary'][$message->status] ?? 'primary' }} text-capitalize">
                                        {{ str_replace('_', ' ', $message->status) }}
                                    </span>
                                </td>
                                <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($message->admin_reply)
                                        <span class="text-success">
                                            <i class="ti ti-check-circle me-1"></i> Replied
                                            @if($message->replied_at)
                                                <br><small class="text-muted">{{ $message->replied_at->format('M d, Y H:i') }}</small>
                                            @endif
                                        </span>
                                    @else
                                        <span class="text-muted">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon btn-label-info view-user-message-btn" 
                                        data-message-id="{{ $message->id }}" title="View Details">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $messages->links() }}
                </div>
            </div>
        @endif
    </div>
</x-admin.card>

<!-- View Message Modal for User -->
<div class="modal fade" id="viewUserMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewUserMessageContent">
                <!-- Loaded via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // View Message for User
        $(document).on('click', '.view-user-message-btn', function() {
            const messageId = $(this).data('message-id');
            
            $.ajax({
                url: '{{ route('admin.messages.show', ':id') }}'.replace(':id', messageId),
                method: 'GET',
                success: function(response) {
                    $('#viewUserMessageContent').html(response);
                    $('#viewUserMessageModal').modal('show');
                }
            });
        });
    });
</script>
@endpush