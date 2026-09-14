@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Dashboard</h2>
                <p class="text-muted mb-0">Manage your portfolio content</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.projects.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Projects</span>
                            <h3 class="mb-0 mt-2">{{ $stats['projects'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-primary bg-opacity-25">
                            <i class="bx bx-folder text-primary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.experiences.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Experiences</span>
                            <h3 class="mb-0 mt-2">{{ $stats['experiences'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-success bg-opacity-25">
                            <i class="bx bx-briefcase-alt text-success fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.education.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Education</span>
                            <h3 class="mb-0 mt-2">{{ $stats['education'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-info bg-opacity-25">
                            <i class="bx bx-graduation text-info fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.skills.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Skills</span>
                            <h3 class="mb-0 mt-2">{{ $stats['skills'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-warning bg-opacity-25">
                            <i class="bx bx-award text-warning fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.services.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Services</span>
                            <h3 class="mb-0 mt-2">{{ $stats['services'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-purple bg-opacity-25">
                            <i class="bx bx-wrench text-purple fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.testimonials.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Testimonials</span>
                            <h3 class="mb-0 mt-2">{{ $stats['testimonials'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-pink bg-opacity-25">
                            <i class="bx bx-message-square-detail text-pink fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.messages.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Messages</span>
                            <h3 class="mb-0 mt-2">{{ $stats['messages'] }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-orange bg-opacity-25">
                            <i class="bx bx-envelope text-orange fs-2"></i>
                        </div>
                    </div>
                    @if ($stats['unread_messages'] > 0)
                        <div class="mt-2">
                            <span class="badge bg-label-warning">{{ $stats['unread_messages'] }} unread</span>
                        </div>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-sm">Users</span>
                            <h3 class="mb-0 mt-2">{{ $stats['users'] ?? 0 }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-label-secondary bg-opacity-25">
                            <i class="bx bx-user text-secondary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.projects.create') }}" class="text-decoration-none">
                            <div class="card h-100 border-primary border-2">
                                <div class="card-body text-center py-4">
                                    <i class="bx bx-plus-circle text-primary fs-1 mb-2"></i>
                                    <span class="fw-medium">Add Project</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.experiences.create') }}" class="text-decoration-none">
                            <div class="card h-100 border-success border-2">
                                <div class="card-body text-center py-4">
                                    <i class="bx bx-plus-circle text-success fs-1 mb-2"></i>
                                    <span class="fw-medium">Add Experience</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.skills.create') }}" class="text-decoration-none">
                            <div class="card h-100 border-warning border-2">
                                <div class="card-body text-center py-4">
                                    <i class="bx bx-plus-circle text-warning fs-1 mb-2"></i>
                                    <span class="fw-medium">Add Skill</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.testimonials.create') }}" class="text-decoration-none">
                            <div class="card h-100 border-pink border-2">
                                <div class="card-body text-center py-4">
                                    <i class="bx bx-plus-circle text-pink fs-1 mb-2"></i>
                                    <span class="fw-medium">Add Testimonial</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Messages</h5>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-label-primary">View All</a>
            </div>
            <div class="card-body">
                @php
                    $recentMessages = \App\Models\ContactMessage::latest()->take(5)->get();
                @endphp
                @if ($recentMessages->isEmpty())
                    <p class="text-muted text-center py-4 mb-0">No messages yet</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentMessages as $message)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.messages.show', $message) }}" class="fw-medium text-body">{{ $message->name }}</a>
                                        </td>
                                        <td>{{ $message->subject ?? 'No subject' }}</td>
                                        <td>{{ $message->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if (is_null($message->read_at))
                                                <span class="badge bg-label-warning">Unread</span>
                                            @else
                                                <span class="badge bg-label-success">Read</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection