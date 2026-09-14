<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Title <span class="text-red-500">*</span></label>
        <input type="text" id="title" name="title" value="{{ old('title', $project->title ?? '') }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        @error('title')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="short_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Short Description</label>
        <textarea id="short_description" name="short_description" rows="2" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('short_description', $project->short_description ?? '') }}</textarea>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Full Description</label>
        <textarea id="description" name="description" rows="5" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description', $project->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Project Image</label>
        <input type="file" id="image" name="image" accept="image/*" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-500 file:text-white hover:file:bg-primary-600">
        @if ($project && $project->image)
            <div class="mt-2">
                <p class="text-sm text-slate-500 dark:text-slate-400">Current image:</p>
                <img src="{{ asset('storage/' . $project->image) }}" alt="Current" class="mt-1 max-w-xs rounded-lg border border-slate-200 dark:border-slate-700">
            </div>
        @endif
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="github_url" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">GitHub URL</label>
            <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>
        <div>
            <label for="live_url" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Live URL</label>
            <input type="url" id="live_url" name="live_url" value="{{ old('live_url', $project->live_url ?? '') }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>
    </div>

    <div>
        <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Category</label>
        <input type="text" id="category" name="category" value="{{ old('category', $project->category ?? '') }}" placeholder="e.g., Web App, Mobile, API" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="sort_order" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>
    </div>

    <div class="flex items-center gap-4">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
            <span class="text-sm text-slate-700 dark:text-slate-300">Featured Project</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', $project->is_visible ?? true) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
            <span class="text-sm text-slate-700 dark:text-slate-300">Visible on Portfolio</span>
        </label>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Technologies</label>
        <div id="technologies-container" class="space-y-2">
            @foreach ($technologies as $index => $tech)
                <div class="flex items-center gap-2">
                    <input type="text" name="technologies[{{ $index }}][name]" value="{{ $tech->name ?? old("technologies.{$index}.name") }}" placeholder="Technology name" class="flex-1 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <input type="number" name="technologies[{{ $index }}][sort_order]" value="{{ $tech->sort_order ?? old("technologies.{$index}.sort_order", $index) }}" class="w-20 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <button type="button" class="remove-tech p-2 text-slate-500 hover:text-red-600 dark:hover:text-red-400" title="Remove"><i class="ph ph-trash"></i></button>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-technology" class="mt-2 px-3 py-1.5 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 flex items-center gap-1">
            <i class="ph ph-plus"></i> Add Technology
        </button>
    </div>
</div>