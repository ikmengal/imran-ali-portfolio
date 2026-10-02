@php
    $technologies = $project->technologies->pluck('name')->take(4);
    $hasMoreTech = $project->technologies->count() > 4;
@endphp

<article class="project-card group relative bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-category="{{ $project->category ?? 'all' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
    <a href="{{ route('portfolio.project.show', [$user->portfolio_slug ?? 'default', $project->slug]) }}" class="block">
        <div class="relative aspect-video overflow-hidden">
            @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full bg-gradient-to-br from-primary-500/20 to-accent-500/20 flex items-center justify-center">
                    <i class="ph-fill ph-image text-slate-300 dark:text-slate-600 text-4xl"></i>
                </div>
            @endif
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <div class="flex flex-wrap gap-2">
                    @foreach($technologies as $tech)
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-slate-700 dark:text-slate-300">{{ $tech }}</span>
                    @endforeach
                    @if($hasMoreTech)
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-slate-700 dark:text-slate-300">+{{ $project->technologies->count() - 4 }} more</span>
                    @endif
                </div>
            </div>
            
            @if($project->is_featured)
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-500 text-white flex items-center gap-1">
                        <i class="ph-fill ph-star"></i>
                        Featured
                    </span>
                </div>
            @endif
        </a>
        
        <div class="p-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $project->title }}</h3>
                @if($project->category)
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300">{{ $project->category }}</span>
                @endif
            </div>
            
            @if($project->short_description)
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4 line-clamp-2">{{ $project->short_description }}</p>
            @endif
            
            <div class="flex items-center gap-3">
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <i class="ph-fill ph-github-logo text-lg"></i>
                        Code
                    </a>
                @endif
                
                @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 transition-colors rounded-lg">
                        <i class="ph-fill ph-arrow-up-right text-lg"></i>
                        Live Demo
                    </a>
                @endif
            </div>
        </div>
    </article>