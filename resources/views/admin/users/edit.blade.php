@extends('admin.layouts.app')
@section('title', 'Edit User: ' . $user->name)
@section('content')
    <div class="max-2xl mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Edit User</h2>
                <p class="text-muted mb-0">{{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-back me-1"></i> Back
            </a>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="card" id="create-form">
            @csrf
            @method('PUT')

            <div class="card-body">
                <x-admin.input
                    label="Name"
                    name="name"
                    value="{{ $user->name }}"
                    required
                    placeholder="Full name"
                    error="{{ $errors->first('name') }}"
                />

                <x-admin.input
                    label="Email"
                    name="email"
                    type="email"
                    value="{{ $user->email }}"
                    required
                    placeholder="user@example.com"
                    error="{{ $errors->first('email') }}"
                />

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input
                            label="New Password"
                            name="password"
                            type="password"
                            placeholder="Leave blank to keep current password"
                            error="{{ $errors->first('password') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-admin.input
                            label="Confirm Password"
                            name="password_confirmation"
                            type="password"
                            placeholder="Confirm new password"
                        />
                    </div>
                </div>

                <x-admin.file
                    label="Profile Image"
                    name="profile_image"
                    accept="image/*"
                    preview="true"
                    previewUrl="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('admin/assets/img/avatars/1.png') }}"
                    error="{{ $errors->first('profile_image') }}"
                    help="Recommended: 400x400px, max 2MB"
                />

                <x-admin.textarea
                    label="Bio"
                    name="bio"
                    value="{{ $user->bio }}"
                    placeholder="Short biography"
                    rows="3"
                    error="{{ $errors->first('bio') }}"
                />

                <x-admin.input
                    label="Portfolio Slug"
                    name="portfolio_slug"
                    value="{{ $user->portfolio_slug }}"
                    placeholder="e.g., john-doe (for portfolio link: /john-doe)"
                    help="Unique slug for portfolio URL. Leave empty to disable portfolio."
                    error="{{ $errors->first('portfolio_slug') }}"
                />

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.select
                            label="Roles"
                            name="roles"
                            :options="$roles"
                            :value="$userRoles"
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
                        <i class="bx bx-save me-1"></i> Update User
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
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
