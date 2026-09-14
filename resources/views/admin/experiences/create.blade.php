@extends('admin.layouts.app')

@section('title', 'Create Experience')

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Create Experience</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Add a new work experience</p>
        </div>
        <a href="{{ route('admin.experiences.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
            <i class="ph ph-arrow-left text-sm"></i>
            Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.experiences.store') }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 space-y-6">
        @csrf

        <div>
            <label for="job_title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Job Title <span class="text-red-500">*</span></label>
            <input type="text" id="job_title" name="job_title" value="{{ old('job_title') }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('job_title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="company" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Company <span class="text-red-500">*</span></label>
            <input type="text" id="company" name="company" value="{{ old('company') }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('company')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="employment_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Employment Type</label>
                <input type="text" id="employment_type" name="employment_type" value="{{ old('employment_type') }}" placeholder="Full-time, Part-time, Contract, etc." class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="City, Country or Remote" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="start_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Start Date <span class="text-red-500">*</span></label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
            <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description') }}</textarea>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current') ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">Current Position</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">Visible on Portfolio</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('admin.experiences.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-floppy-disk text-sm"></i>
                Save Experience
            </button>
        </div>
    </form>
</div>
@endsection