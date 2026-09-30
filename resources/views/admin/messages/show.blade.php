@extends('admin.layouts.app')

@section('title', 'Message: ' . $message->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $message->name }}</h2>
            <p class="text-muted mb-0">{{ $message->email }}</p>
        </div>
        <div class="d-flex gap-2">
            @if (!$message->read_at)
                <a href="{{ route('admin.messages.read', $message) }}" class="btn btn-success">
                    <i class="bx bx-check me-1"></i> Mark as Read
                </a>
            @else
                <a href="{{ route('admin.messages.unread', $message) }}" class="btn btn-secondary">
                    <i class="bx bx-envelope me-1"></i> Mark as Unread
                </a>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-admin.card title="Sender Information">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Name</th>
                            <td>{{ $message->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                        </tr>
                        <tr>
                            <th scope="row">Subject</th>
                            <td>{{ $message->subject ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($message->read_at)
                                    <span class="badge bg-label-success">Read</span>
                                    <small class="text-muted ms-2">Read on {{ $message->read_at->format('M d, Y H:i') }}</small>
                                @else
                                    <span class="badge bg-label-danger">Unread</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Received</th>
                            <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>
        </div>

        <div class="col-md-6">
            <x-admin.card title="Message" class="mt-3 mt-md-0">
                <div class="prose">{{ $message->message }}</div>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection