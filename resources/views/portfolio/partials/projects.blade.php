<section id="projects" class="py-20 lg:py-32 bg-white dark:bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-amber-50/30 to-transparent dark:via-amber-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-folder"></i>
                Featured Projects
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                Selected <span class="bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">Work</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                A showcase of projects I've built, demonstrating various technologies and problem-solving approaches.
            </p>
        </div>

        @if($featuredProjects->isNotEmpty())
            <div class="grid lg:grid-cols-2 gap-8 mb-16">
                @foreach($featuredProjects as $index => $project)
                    @include('portfolio.partials.project-card', ['project' => $project, 'index' => $index, 'featured' => true])
                @endforeach
            </div>
        @endif

        <div class="mb-10" data-aos="fade-up">
            <div class="flex flex-wrap justify-center gap-2" role="tablist" aria-label="Project categories">
                <button class="project-filter-btn active px-4 py-2 rounded-xl bg-primary-600 text-white font-medium transition-all duration-200 hover:bg-primary-700" data-filter="all" role="tab" aria-selected="true">All Projects</button>
                @php
                    $categories = $projects->pluck('category')->filter()->unique()->values();
                @endphp
                @foreach($categories as $category)
                    <button class="project-filter-btn px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-medium transition-all duration-200 hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400" data-filter="{{ $category }}" role="tab" aria-selected="false">{{ $category }}</button>
                @endforeach
            </div>
        </div>

        @if($projects->isNotEmpty())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-grid">
                @foreach($projects as $index => $project)
                    @include('portfolio.partials.project-card', ['project' => $project, 'index' => $index, 'featured' => false])
                @endforeach
            </div>
        @else
            <div class="text-center py-12" data-aos="fade-up">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4">
                    <i class="ph-fill ph-folder text-slate-400 dark:text-slate-500 text-3xl"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-2">No Projects Added Yet</h3>
                <p class="text-slate-500 dark:text-slate-400">Add projects from the admin panel to showcase your work.</p>
            </div>
        @endif
    </div>
</section>