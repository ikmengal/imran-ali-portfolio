@extends('admin.layouts.app')

@section('title', 'Role: {{ $role->name }}')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Role Details</h2>
                <p class="text-muted mb-0">View role information and permissions</p>
            </div>
            <div class="d-flex gap-2">
                @can('roles-edit')
                @if($role->name !== 'Super Admin')
                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                        <i class="ti ti-edit me-1"></i> Edit Permissions
                    </a>
                @endif
                @endcan
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Back to Roles
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">Role Information</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <h5>{{ $role->name }}</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Users</label>
                    <div class="col-sm-10">
                        <span class="badge bg-label-primary">{{ $role->users()->count() }} users</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Created</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $role->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Assigned Permissions</h4>
            </div>
            <div class="card-body">
                @if($role->permissions->isEmpty())
                    <p class="text-muted">No permissions assigned to this role.</p>
                @else
                    <div class="row">
                        @foreach($role->permissions->groupBy('label') as $label => $perms)
                            <div class="col-md-6 mb-4">
                                <h6 class="text-muted text-uppercase fw-bold mb-2">{{ $label }}</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($perms as $perm)
                                        <span class="badge bg-label-info">{{ $perm->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection