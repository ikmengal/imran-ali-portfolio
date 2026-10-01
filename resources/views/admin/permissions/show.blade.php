@extends('admin.layouts.app')

@section('title', 'Permission: {{ $permission->name }}')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Permission Details</h2>
                <p class="text-muted mb-0">View permission information and assigned roles</p>
            </div>
            <div class="d-flex gap-2">
                @can('permissions-edit')
                <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i> Edit
                </a>
                @endcan
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Back to Permissions
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">Permission Information</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <h5>{{ $permission->name }}</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Label/Category</label>
                    <div class="col-sm-10">
                        <span class="badge bg-label-info">{{ $permission->label }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Guard</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $permission->guard_name }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Created</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $permission->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Assigned Roles</h4>
            </div>
            <div class="card-body">
                @if($permission->roles->isEmpty())
                    <p class="text-muted">No roles have this permission.</p>
                @else
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($permission->roles as $role)
                            <span class="badge bg-label-{{ $role->name === 'Super Admin' ? 'danger' : ($role->name === 'Admin' ? 'warning' : 'primary') }}">
                                {{ $role->name }} ({{ $role->users()->count() }} users)
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection