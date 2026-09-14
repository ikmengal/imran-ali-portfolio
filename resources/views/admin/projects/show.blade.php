@extends('admin.layouts.app')

@section('title', 'Project: ' . $project->title)

@section('content')
<div class="max-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $project->title }}</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Project details</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.projects.edit', $project) }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                <i class="ph ph-pencil text-sm"></i>
                Edit
            </a>
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
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
                    {!! $project->description ?? '<p class="text-slate-500 dark:text-slate-400">No description provided.</p>' !!}
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Technologies</h3>
                @if ($project->technologies->isEmpty())
                    <p class="text-slate-500 dark:text-slate-400">No technologies added.</p>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach ($project->technologies as $tech)
                            <span class="px-3 py-1 text-sm bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded-full">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            @if ($project->image)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Image</h3>
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700">
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Links</h3>
                <div class="space-y-3">
                    @if ($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:underline">
                            <i class="ph ph-github-logo text-lg"></i> GitHub
                        </a>
                    @endif
                    @if ($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="flex items-center gap-2 text-green-600 dark:text-green-400 hover:underline">
                            <i class="ph ph-globe text-lg"></i> Live Demo
                        </a>
                    @endif
                    @if (!$project->github_url && !$project->live_url)
                        <p class="text-slate-500 dark:text-slate-400">No links provided.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Status</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Visibility</dt>
                        <dd class="font-medium">{{ $project->is_visible ? 'Visible' : 'Hidden' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Featured</dt>
                        <dd class="font-medium">{{ $project->is_featured ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Category</dt>
                        <dd class="font-medium">{{ $project->category ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Sort Order</dt>
                        <dd class="font-medium">{{ $project->sort_order ?? 0 }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Timestamps</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Created</dt>
                        <dd class="font-medium">{{ $project->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Updated</dt>
                        <dd class="font-medium">{{ $project->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection