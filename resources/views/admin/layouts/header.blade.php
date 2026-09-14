<header class="sticky top-0 z-20 flex items-center justify-between gap-4 border-b border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-950/80 backdrop-blur-sm px-6 py-4">
    <div class="flex items-center gap-4">
        <button type="button" class="lg:hidden p-2 text-slate-500 hover:text-slate-900 dark:hover:text-slate-100" id="sidebar-toggle" aria-label="Open sidebar">
            <i class="ph ph-list text-xl"></i>
        </button>
        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    <div class="flex items-center gap-4">
        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-sm text-slate-600 dark:text-slate-400">
            <i class="ph ph-user-circle text-lg"></i>
            <span>{{ auth()->user()->name }}</span>
        </div>
    </div>
</header>