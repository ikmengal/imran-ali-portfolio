@extends('admin.layouts.app')

@section('title', 'Edit User: ' . $user->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit User</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
            <i class="ph ph-arrow-left text-sm"></i>
            Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password" minlength="8" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label for="profile_image" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-500 file:text-white hover:file:bg-primary-600">
            @if ($user->profile_image)
                <div class="mt-2">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Current image:</p>
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Current" class="mt-1 w-16 h-16 rounded-full object-cover border border-slate-200 dark:border-slate-700">
                </div>
            @endif
        </div>

        <div>
            <label for="bio" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bio</label>
            <textarea id="bio" name="bio" rows="3" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Roles</label>
            <div class="flex flex-wrap gap-3">
                @foreach ($roles as $role)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-floppy-disk text-sm"></i>
                Update User
            </button>
        </div>
    </form>
</div>
@endsection