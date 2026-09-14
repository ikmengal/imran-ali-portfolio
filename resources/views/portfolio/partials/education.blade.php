<section id="education" class="py-20 lg:py-32 bg-slate-50 dark:bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-violet-50/30 to-transparent dark:via-violet-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-100 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-graduation-cap"></i>
                Education
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                Academic <span class="bg-gradient-to-r from-violet-600 to-purple-600 bg-clip-text text-transparent">Background</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                Formal education and continuous learning that built my technical foundation.
            </p>
        </div>

        @if($education->isNotEmpty())
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($education as $index => $edu)
                    <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-violet-300 dark:hover:border-violet-700 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-violet-500/10 to-transparent rounded-tr-2xl rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-university text-white text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="font-space text-lg font-bold text-slate-900 dark:text-white">{{ $edu->degree }}</h3>
                                    @if($edu->is_current)
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-violet-100 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300">Current</span>
                                    @endif
                                </div>
                                <p class="text-violet-600 dark:text-violet-400 font-medium mb-1">{{ $edu->institution }}</p>
                                @if($edu->field)
                                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-2">{{ $edu->field }}</p>
                                @endif
                                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 dark:text-slate-400 mb-3">
                                    <span class="flex items-center gap-1">
                                        <i class="ph-fill ph-calendar text-xs"></i>
                                        {{ $edu->start_year }} - {{ $edu->is_current ? 'Present' : $edu->end_year }}
                                    </span>
                                    @if($edu->location)
                                        <span class="flex items-center gap-1">
                                            <i class="ph-fill ph-map-pin text-xs"></i>
                                            {{ $edu->location }}
                                        </span>
                                    @endif
                                </div>
                                @if($edu->description)
                                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">{{ $edu->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12" data-aos="fade-up">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4">
                    <i class="ph-fill ph-graduation-cap text-slate-400 dark:text-slate-500 text-3xl"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-2">No Education Added Yet</h3>
                <p class="text-slate-500 dark:text-slate-400">Add education records from the admin panel to showcase your academic background.</p>
            </div>
        @endif
    </div>
</section>