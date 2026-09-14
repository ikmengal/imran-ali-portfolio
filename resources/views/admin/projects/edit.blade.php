@extends('admin.layouts.app')

@section('title', 'Edit Project: ' . $project->title)

@section('content')
<div class="max-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Project</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $project->title }}</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
            <i class="ph ph-arrow-left text-sm"></i>
            Back to Projects
        </a>
    </div>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 space-y-6">
        @csrf
        @method('PUT')

        @include('admin.projects._form', ['project' => $project, 'technologies' => $project->technologies])

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-floppy-disk text-sm"></i>
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('technologies-container');
    const addBtn = document.getElementById('add-technology');
    let techIndex = {{ $project->technologies->count() }};

    addBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <input type="text" name="technologies[${techIndex}][name]" placeholder="Technology name" class="flex-1 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <input type="number" name="technologies[${techIndex}][sort_order]" placeholder="Order" value="${techIndex}" class="w-20 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <button type="button" class="remove-tech p-2 text-slate-500 hover:text-red-600 dark:hover:text-red-400" title="Remove"><i class="ph ph-trash"></i></button>
        `;
        container.appendChild(div);
        techIndex++;
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-tech')) {
            e.target.closest('.flex').remove();
        }
    });
});
</script>
@endpush