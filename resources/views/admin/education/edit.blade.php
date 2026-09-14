@extends('admin.layouts.app')

@section('title', 'Edit Education: ' . $education->degree)

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Education Record</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $education->degree }} at {{ $education->institution }}</p>
        </div>
        <a href="{{ route('admin.education.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
            <i class="ph ph-arrow-left text-sm"></i>
            Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.education.update', $education) }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="degree" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Degree <span class="text-red-500">*</span></label>
            <input type="text" id="degree" name="degree" value="{{ old('degree', $education->degree) }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('degree')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="institution" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Institution <span class="text-red-500">*</span></label>
            <input type="text" id="institution" name="institution" value="{{ old('institution', $education->institution) }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('institution')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="field" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Field of Study</label>
                <input type="text" id="field" name="field" value="{{ old('field', $education->field) }}" placeholder="Computer Science, Business, etc." class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $education->location) }}" placeholder="City, Country" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="start_year" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Start Year <span class="text-red-500">*</span></label>
                <input type="number" id="start_year" name="start_year" value="{{ old('start_year', $education->start_year) }}" required min="1900" max="{{ date('Y') + 10 }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="end_year" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">End Year</label>
                <input type="number" id="end_year" name="end_year" value="{{ old('end_year', $education->end_year) }}" min="1900" max="{{ date('Y') + 10 }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
            <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description', $education->description) }}</textarea>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $education->sort_order ?? 0) }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current', $education->is_current) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">Currently Studying</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', $education->is_visible) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">Visible on Portfolio</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('admin.education.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-floppy-disk text-sm"></i>
                Update Education
            </button>
        </div>
    </form>
</div>
@endsection