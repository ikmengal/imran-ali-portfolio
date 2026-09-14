@extends('admin.layouts.app')

@section('title', 'Service: ' . $service->title)

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $service->title }}</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Service details</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.services.edit', $service) }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                <i class="ph ph-pencil text-sm"></i>
                Edit
            </a>
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-arrow-left text-sm"></i>
                Back
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Description</h3>
                <div class="prose dark:prose-invert max-w-none">
                    {!! $service->description ?? '<p class="text-slate-500 dark:text-slate-400">No description provided.</p>' !!}
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 flex items-center justify-center">
                @if ($service->icon)
                    <i class="ph {{ $service->icon }} text-6xl text-primary-600 dark:text-primary-400"></i>
                @else
                    <i class="ph ph-wrench text-6xl text-slate-400 dark:text-slate-500"></i>
                @endif
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Details</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Icon</dt>
                        <dd class="font-medium">{{ $service->icon ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Featured</dt>
                        <dd class="font-medium">{{ $service->is_featured ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Visibility</dt>
                        <dd class="font-medium">{{ $service->is_visible ? 'Visible' : 'Hidden' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Sort Order</dt>
                        <dd class="font-medium">{{ $service->sort_order ?? 0 }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Timestamps</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Created</dt>
                        <dd class="font-medium">{{ $service->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Updated</dt>
                        <dd class="font-medium">{{ $service->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection