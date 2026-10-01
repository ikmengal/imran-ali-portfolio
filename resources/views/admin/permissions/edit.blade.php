@extends('admin.layouts.app')

@section('title', 'Edit Permission: {{ $permission->name }}')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Edit Permission: {{ $permission->name }}</h2>
                <p class="text-muted mb-0">Update permission details</p>
            </div>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Permissions
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Permission Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label class="form-label">Permission Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $permission->name }}" required>
                        <small class="text-muted">Use format: resource-action (e.g. users-view, projects-create)</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Label/Category <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" value="{{ $permission->label }}" required>
                        <small class="text-muted">Used to group permissions in the UI</small>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Permission</button>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection