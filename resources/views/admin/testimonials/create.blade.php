@extends('admin.layouts.app')

@section('title', 'Create Testimonial')

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Create Testimonial</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Add a new client testimonial</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
            <i class="ph ph-arrow-left text-sm"></i>
            Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Client Name <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="designation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Designation</label>
                <input type="text" id="designation" name="designation" value="{{ old('designation') }}" placeholder="CEO, CTO, Founder, etc." class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
            <div>
                <label for="company" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Company</label>
                <input type="text" id="company" name="company" value="{{ old('company') }}" placeholder="Company name" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Client Photo</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-500 file:text-white hover:file:bg-primary-600">
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Testimonial Message <span class="text-red-500">*</span></label>
            <textarea id="message" name="message" rows="4" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('message') }}</textarea>
            @error('message')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Rating <span class="text-red-500">*</span></label>
            <select id="rating" name="rating" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 Stars - Excellent</option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars - Very Good</option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars - Good</option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars - Fair</option>
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star - Poor</option>
            </select>
            @error('rating')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">Visible on Portfolio</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-floppy-disk text-sm"></i>
                Save Testimonial
            </button>
        </div>
    </form>
</div>
@endsection