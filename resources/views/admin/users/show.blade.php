@extends('admin.layouts.app')
@section('title', 'User: ' . $user->name)
@section('content')
    <div class="max-2xl mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">{{ $user->name }}</h2>
                <p class="text-muted mb-0">{{ $user->email }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i> Edit
                </a>
                @if ($user->id !== auth()->id())
                    <a href="{{ route('admin.users.generate-password', $user) }}" class="btn btn-secondary">
                        <i class="ti ti-key me-1"></i> Generate Password
                    </a>
                @endif
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-back me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <x-admin.card title="Profile">
                    <div class="text-center">
                        @if ($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px;">
                                <i class="bx bx-user text-secondary" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>

                        <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
                            @foreach ($user->roles as $role)
                                <span class="badge bg-{{ match($role->name) { 'Super Admin' => 'danger', 'Admin' => 'warning', default => 'primary' } }}">{{ $role->name }}</span>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @if ($user->trashed() && auth()->user()->hasRole('Super Admin'))
                                <a href="{{ route('admin.users.restore', $user) }}" class="btn btn-sm btn-outline-success">Restore</a>
                            @endif
                        </div>
                    </div>
                </x-admin.card>

                @if ($user->bio)
                    <x-admin.card title="Bio" class="mt-3">
                        <p>{{ $user->bio }}</p>
                    </x-admin.card>
                @endif

                @if ($user->portfolio_slug)
                    <x-admin.card title="Portfolio" class="mt-3">
                        <p>
                            <strong>Portfolio URL:</strong><br>
                            <a href="{{ $user->portfolio_url }}" target="_blank" class="text-primary">
                                {{ $user->portfolio_url }}
                            </a>
                        </p>
                        <a href="{{ $user->portfolio_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="ti ti-external-link me-1"></i> View Portfolio
                        </a>
                    </x-admin.card>
                @endif
            </div>

            <div class="col-md-8">
                <x-admin.card title="Account Details">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 200px;">Email Verified</th>
                                <td>
                                    @if ($user->email_verified_at)
                                        <span class="badge bg-label-success"><i class="bx bx-check me-1"></i>Yes</span>
                                        <small class="text-muted ms-2">Verified on {{ $user->email_verified_at->format('M d, Y') }}</small>
                                    @else
                                        <span class="badge bg-label-secondary"><i class="bx bx-x me-1"></i>No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                    @if ($user->trashed())
                                        <span class="badge bg-label-danger">Trashed</span>
                                        <small class="text-muted ms-2">Deleted on {{ $user->deleted_at->format('M d, Y H:i') }}</small>
                                    @else
                                        <span class="badge bg-label-success">Active</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Roles</th>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-{{ match($role->name) { 'Super Admin' => 'danger', 'Admin' => 'warning', default => 'primary' } }} me-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Registered</th>
                                <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Last Updated</th>
                                <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </x-admin.card>
            </div>
        </div>
    </div>
@endsection
