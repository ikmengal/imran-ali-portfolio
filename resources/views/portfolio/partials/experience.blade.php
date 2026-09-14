<section id="experience" class="py-20 lg:py-32 bg-white dark:bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-50/30 to-transparent dark:via-emerald-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-briefcase"></i>
                Professional Experience
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                Work <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Experience</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                My journey through various roles, companies, and challenges that shaped me as a developer.
            </p>
        </div>

        @if($experiences->isNotEmpty())
            <div class="relative">
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-emerald-500 to-teal-500 hidden lg:block"></div>
                
                <div class="space-y-10">
                    @foreach($experiences as $index => $experience)
                        <div class="relative lg:pl-20" data-aos="fade-right" data-aos-delay="{{ $index * 100 }}">
                            <div class="absolute left-8 top-2 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white dark:border-slate-950 shadow-lg shadow-emerald-500/30 z-10 hidden lg:block"></div>
                            
                            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-emerald-300 dark:hover:border-emerald-700 relative overflow-hidden group">
                                <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-emerald-500 to-teal-500 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></div>
                                
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center flex-shrink-0">
                                            <i class="ph-fill ph-building text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-space text-lg font-bold text-slate-900 dark:text-white">{{ $experience->job_title }}</h3>
                                            <p class="text-emerald-600 dark:text-emerald-400 font-medium">{{ $experience->company }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                                        <span class="flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">
                                            <i class="ph-fill ph-clock text-xs"></i>
                                            {{ $experience->start_date->format('M Y') }} - {{ $experience->is_current ? 'Present' : $experience->end_date->format('M Y') }}
                                        </span>
                                        @if($experience->employment_type)
                                            <span class="flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                                                <i class="ph-fill ph-briefcase text-xs"></i>
                                                {{ $experience->employment_type }}
                                            </span>
                                        @endif
                                        @if($experience->location)
                                            <span class="flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                                                <i class="ph-fill ph-map-pin text-xs"></i>
                                                {{ $experience->location }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($experience->description)
                                    <div class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed">
                                        {!! nl2br(e($experience->description)) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-12" data-aos="fade-up">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4">
                    <i class="ph-fill ph-briefcase text-slate-400 dark:text-slate-500 text-3xl"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-2">No Experience Added Yet</h3>
                <p class="text-slate-500 dark:text-slate-400">Add work experience from the admin panel to showcase your professional journey.</p>
            </div>
        @endif
    </div>
</section>