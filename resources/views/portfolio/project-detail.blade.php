<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $project->title }} - {{ $user->name ?? 'Full Stack Developer' }} Portfolio">
    <title>{{ $project->title }} | {{ $user->name ?? 'Portfolio' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill.js"></script>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased font-sans min-h-screen">
    <div id="app" class="relative overflow-hidden">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-primary-600 dark:focus:bg-slate-900">Skip to main content</a>

        @include('portfolio.partials.navigation')

        <main id="main-content">
            <!-- Project Hero -->
            <section class="py-20 lg:py-32 bg-white dark:bg-slate-950 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-primary-50/30 to-transparent dark:via-primary-900/10 pointer-events-none"></div>
                
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="mb-8" aria-label="Breadcrumb">
                        <ol class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                            <li><a href="{{ route('portfolio.user', $user->portfolio_slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ $user->name ?? 'Home' }}</a></li>
                            <li><i class="ph-fill ph-caret-right text-xs"></i></li>
                            <li><a href="{{ route('portfolio.user', $user->portfolio_slug) }}#projects" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Projects</a></li>
                            <li><i class="ph-fill ph-caret-right text-xs"></i></li>
                            <li class="text-slate-900 dark:text-white font-medium">{{ $project->title }}</li>
                        </ol>
                    </nav>

                    <div class="grid lg:grid-cols-2 gap-12 items-start" data-aos="fade-up">
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-medium mb-4">
                                <i class="ph-fill ph-folder"></i>
                                Project Details
                            </div>
                            <h1 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">{{ $project->title }}</h1>
                            
                            @if($project->category)
                                <span class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 mb-4">{{ $project->category }}</span>
                            @endif
                            
                            @if($project->short_description)
                                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed mb-6">{{ $project->short_description }}</p>
                            @endif

                            <div class="flex flex-wrap gap-3 mb-6">
                                @foreach($project->technologies as $tech)
                                    <span class="px-3 py-1 text-sm font-medium rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700">{{ $tech->name }}</span>
                                @endforeach
                            </div>

                            <div class="flex items-center gap-4">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 px-5 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700">
                                        <i class="ph-fill ph-github-logo text-lg"></i>
                                        View Code
                                    </a>
                                @endif
                                
                                @if($project->live_url)
                                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 px-5 py-3 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 transition-colors rounded-xl shadow-lg shadow-primary-500/25">
                                        <i class="ph-fill ph-arrow-up-right text-lg"></i>
                                        Live Demo
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-500/20 to-accent-500/20 flex items-center justify-center">
                                    <i class="ph-fill ph-image text-slate-300 dark:text-slate-600 text-6xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- Project Description -->
            @if($project->description)
            <section class="py-20 lg:py-32 bg-slate-50 dark:bg-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose prose-slate dark:prose-invert max-w-none" data-aos="fade-up">
                        <h2 class="font-space text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white mb-6">About This Project</h2>
                        <div class="text-slate-600 dark:text-slate-300 leading-relaxed text-lg">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <!-- Technologies Used -->
            @if($project->technologies->isNotEmpty())
            <section class="py-20 lg:py-32 bg-white dark:bg-slate-950">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">Technologies Used</h2>
                        <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto">Built with modern tools and frameworks</p>
                    </div>
                    
                    <div class="flex flex-wrap justify-center gap-3" data-aos="fade-up">
                        @foreach($project->technologies as $index => $tech)
                            <div class="group tool-card relative px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-300 hover:shadow-lg hover:shadow-primary-500/10 dark:hover:shadow-primary-900/10">
                                <div class="flex items-center gap-2">
                                    <div class="w-9 h-9 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="ph-fill ph-code text-primary-600 dark:text-primary-400 text-lg"></i>
                                    </div>
                                    <span class="text-base font-medium text-slate-900 dark:text-white">{{ $tech->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- Related Projects -->
            @if($relatedProjects->isNotEmpty())
            <section class="py-20 lg:py-32 bg-slate-50 dark:bg-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">Related Projects</h2>
                        <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto">Explore more of my work</p>
                    </div>
                    
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedProjects as $index => $relatedProject)
                            <article class="project-card group relative bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <a href="{{ route('portfolio.project.show', [$user->portfolio_slug, $relatedProject->slug]) }}">
                                    <div class="relative aspect-video overflow-hidden">
                                        @if($relatedProject->image)
                                            <img src="{{ asset('storage/' . $relatedProject->image) }}" alt="{{ $relatedProject->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-primary-500/20 to-accent-500/20 flex items-center justify-center">
                                                <i class="ph-fill ph-image text-slate-300 dark:text-slate-600 text-4xl"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        
                                        <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($relatedProject->technologies->take(3) as $tech)
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-slate-700 dark:text-slate-300">{{ $tech->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $relatedProject->title }}</h3>
                                        
                                        @if($relatedProject->short_description)
                                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mt-2 line-clamp-2">{{ $relatedProject->short_description }}</p>
                                        @endif
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- CTA Section -->
            <section class="py-20 lg:py-32 bg-gradient-to-r from-primary-600 to-primary-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
                    <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">Interested in Working Together?</h2>
                    <p class="text-primary-100 text-lg max-w-2xl mx-auto mb-8">I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision.</p>
                    <a href="{{ route('portfolio.user', $user->portfolio_slug) }}#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-600 font-medium rounded-xl hover:bg-primary-50 transition-all duration-200 shadow-xl hover:scale-105">
                        <i class="ph-fill ph-envelope"></i>
                        Get In Touch
                    </a>
                </div>
            </section>
        </main>

        @include('portfolio.partials.footer', ['user' => $user])

        <button id="scroll-top" class="fixed bottom-8 right-8 z-50 w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xl shadow-primary-500/30 opacity-0 invisible transition-all duration-300 hover:bg-primary-700 hover:scale-105 hover:-translate-y-1" aria-label="Scroll to top" title="Back to top" style="right: 2rem; bottom: 2rem;">
            <i class="ph-fill ph-caret-up text-xl"></i>
        </button>
    </div>

    @include('portfolio.partials.scripts')
</body>
</html>