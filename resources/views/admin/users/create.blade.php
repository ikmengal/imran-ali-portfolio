@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Create User</h2>
            <p class="text-muted mb-0">Add a new system user</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" class="card" id="create-form">
        @csrf

        <div class="card-body">
            <x-admin.input
                label="Name"
                name="name"
                required
                placeholder="Full name"
                error="{{ $errors->first('name') }}"
            />

            <x-admin.input
                label="Email"
                name="email"
                type="email"
                required
                placeholder="user@example.com"
                error="{{ $errors->first('email') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.input
                        label="Password"
                        name="password"
                        type="password"
                        required
                        placeholder="Minimum 8 characters"
                        error="{{ $errors->first('password') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.input
                        label="Confirm Password"
                        name="password_confirmation"
                        type="password"
                        required
                        placeholder="Confirm password"
                    />
                </div>
            </div>

            <x-admin.file
                label="Profile Image"
                name="profile_image"
                accept="image/*"
                preview="true"
                error="{{ $errors->first('profile_image') }}"
                help="Recommended: 400x400px, max 2MB"
            />

            <x-admin.textarea
                label="Bio"
                name="bio"
                placeholder="Short biography"
                rows="3"
                error="{{ $errors->first('bio') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.select
                        label="Roles"
                        name="roles"
                        :options="$roles"
                        multiple="true"
                        help="Hold Ctrl/Cmd to select multiple roles"
                        error="{{ $errors->first('roles') }}"
                    />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Create User
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.form-select').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
            });
        });
    });
</script>
@endpush