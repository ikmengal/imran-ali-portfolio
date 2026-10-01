@extends('admin.layouts.app')

@section('title', 'Edit Role: {{ $role->name }}')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Edit Role: {{ $role->name }}</h2>
                <p class="text-muted mb-0">Update role permissions</p>
            </div>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Roles
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Role Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Permissions</label>
                        @foreach($permissions as $label => $perms)
                            <div class="mb-3">
                                <h6 class="text-muted text-uppercase fw-bold mb-2">{{ $label }}</h6>
                                <div class="row g-2">
                                    @foreach($perms as $perm)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->name }}" {{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm_{{ $perm->name }}">
                                                    {{ $perm->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection