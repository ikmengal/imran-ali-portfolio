<section id="skills" class="py-20 lg:py-32 bg-slate-50 dark:bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-accent-50/30 to-transparent dark:via-accent-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent-100 dark:bg-accent-900/30 text-accent-700 dark:text-accent-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-lightning"></i>
                Technical Skills
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                My <span class="bg-gradient-to-r from-accent-600 to-primary-600 bg-clip-text text-transparent">Expertise</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                A curated collection of technologies and tools I work with daily to build exceptional digital experiences.
            </p>
        </div>

        @if($skills->isNotEmpty())
            <div class="space-y-12" data-aos="fade-up">
                @foreach($skills as $category => $categorySkills)
                    <div class="skill-category">
                        <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                            {{ ucfirst($category) }}
                        </h3>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($categorySkills as $index => $skill)
                                <div class="group bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 hover:border-accent-300 dark:hover:border-accent-700 transition-all duration-300 hover:shadow-xl hover:shadow-accent-500/10 dark:hover:shadow-accent-900/10" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                                    <div class="flex items-start justify-between gap-4 mb-4">
                                        <div class="flex items-center gap-3">
                                            @if($skill->icon)
                                                <div class="w-12 h-12 rounded-xl bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center text-accent-600 dark:text-accent-400">
                                                    <i class="{{ $skill->icon }} text-xl"></i>
                                                </div>
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent-500 to-amber-500 flex items-center justify-center">
                                                    <i class="ph-fill ph-code text-white text-xl"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="font-medium text-slate-900 dark:text-white">{{ $skill->name }}</h4>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $category }}</span>
                                            </div>
                                        </div>
                                        @if($skill->is_featured)
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300">Featured</span>
                                        @endif
                                    </div>
                                    
                                    <div class="relative h-2 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                        <div class="skill-progress h-full rounded-full bg-gradient-to-r from-accent-500 to-amber-500" 
                                             data-percentage="{{ $skill->percentage }}" 
                                             style="width: 0%; transform-origin: left center;">
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <span class="text-sm text-slate-500 dark:text-slate-400">Proficiency</span>
                                        <span class="text-sm font-bold text-accent-600 dark:text-accent-400 skill-percentage" data-target="{{ $skill->percentage }}">0%</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12" data-aos="fade-up">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4">
                    <i class="ph-fill ph-folder text-slate-400 dark:text-slate-500 text-3xl"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-2">No Skills Added Yet</h3>
                <p class="text-slate-500 dark:text-slate-400">Add skills from the admin panel to showcase your expertise.</p>
            </div>
        @endif

        <div class="mt-16" data-aos="fade-up">
            <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white text-center mb-8">Tools & Technologies</h3>
            
            <!-- First Row - Left to Right -->
            <div class="overflow-hidden mb-8">
                <div class="flex animate-scroll flex-wrap justify-center gap-3" role="list" aria-label="Tools and technologies" id="tools-track-1">
                    @foreach([
                        ['name' => 'Laravel', 'icon' => 'ph-fill ph-terminal', 'color' => 'red'],
                        ['name' => 'PHP', 'icon' => 'ph-fill ph-code', 'color' => 'purple'],
                        ['name' => 'Vue.js', 'icon' => 'ph-fill ph-device-mobile', 'color' => 'green'],
                        ['name' => 'React', 'icon' => 'ph-fill ph-atom', 'color' => 'cyan'],
                        ['name' => 'TypeScript', 'icon' => 'ph-fill ph-brackets-curly', 'color' => 'blue'],
                        ['name' => 'Tailwind CSS', 'icon' => 'ph-fill ph-paint-brush-broad', 'color' => 'sky'],
                        ['name' => 'PostgreSQL', 'icon' => 'ph-fill ph-database', 'color' => 'indigo'],
                        ['name' => 'MySQL', 'icon' => 'ph-fill ph-cylinder', 'color' => 'orange'],
                        ['name' => 'Redis', 'icon' => 'ph-fill ph-lightning', 'color' => 'red'],
                        ['name' => 'Docker', 'icon' => 'ph-fill ph-box', 'color' => 'blue'],
                        ['name' => 'AWS', 'icon' => 'ph-fill ph-cloud', 'color' => 'orange'],
                        ['name' => 'Git', 'icon' => 'ph-fill ph-git-branch', 'color' => 'red'],
                        ['name' => 'REST API', 'icon' => 'ph-fill ph-arrow-arc-right', 'color' => 'emerald'],
                        ['name' => 'GraphQL', 'icon' => 'ph-fill ph-diagram', 'color' => 'pink'],
                        ['name' => 'WebSockets', 'icon' => 'ph-fill ph-wifi-high', 'color' => 'violet'],
                        ['name' => 'Linux', 'icon' => 'ph-fill ph-terminal-window', 'color' => 'yellow'],
                    ] as $index => $tool)
                        <div class="group tool-card relative px-4 py-3 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-{{ $tool['color'] }}-300 dark:hover:border-{{ $tool['color'] }}-700 transition-all duration-300 hover:shadow-lg hover:shadow-{{ $tool['color'] }}-500/10 dark:hover:shadow-{{ $tool['color'] }}-900/10 flex-shrink-0" data-aos="zoom-in" data-aos-delay="{{ $index * 30 }}">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-{{ $tool['color'] }}-100 dark:bg-{{ $tool['color'] }}-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="{{ $tool['icon'] }} text-{{ $tool['color'] }}-600 dark:text-{{ $tool['color'] }}-400 text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $tool['name'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Second Row - Right to Left -->
            <div class="overflow-hidden">
                <div class="flex animate-scroll-reverse flex-wrap justify-center gap-3" role="list" aria-label="Tools and technologies" id="tools-track-2">
                    @foreach([
                        ['name' => 'Kubernetes', 'icon' => 'ph-fill ph-gear-six', 'color' => 'blue'],
                        ['name' => 'NGINX', 'icon' => 'ph-fill ph-server', 'color' => 'green'],
                        ['name' => 'Apache', 'icon' => 'ph-fill ph-feather', 'color' => 'red'],
                        ['name' => 'MongoDB', 'icon' => 'ph-fill ph-database', 'color' => 'green'],
                        ['name' => 'Firebase', 'icon' => 'ph-fill ph-fire', 'color' => 'orange'],
                        ['name' => 'Supabase', 'icon' => 'ph-fill ph-cloud', 'color' => 'green'],
                        ['name' => 'Vercel', 'icon' => 'ph-fill ph-globe', 'color' => 'gray'],
                        ['name' => 'Netlify', 'icon' => 'ph-fill ph-shield-check', 'color' => 'emerald'],
                        ['name' => 'Figma', 'icon' => 'ph-fill ph-pen-nib', 'color' => 'purple'],
                        ['name' => 'Adobe XD', 'icon' => 'ph-fill ph-paint-brush', 'color' => 'pink'],
                        ['name' => 'Jira', 'icon' => 'ph-fill ph-ticket', 'color' => 'blue'],
                        ['name' => 'Trello', 'icon' => 'ph-fill ph-columns', 'color' => 'blue'],
                        ['name' => 'Slack', 'icon' => 'ph-fill ph-chat-circle', 'color' => 'purple'],
                        ['name' => 'Notion', 'icon' => 'ph-fill ph-file-text', 'color' => 'gray'],
                        ['name' => 'VS Code', 'icon' => 'ph-fill ph-code', 'color' => 'blue'],
                        ['name' => 'Postman', 'icon' => 'ph-fill ph-paper-plane', 'color' => 'orange'],
                    ] as $index => $tool)
                        <div class="group tool-card relative px-4 py-3 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-{{ $tool['color'] }}-300 dark:hover:border-{{ $tool['color'] }}-700 transition-all duration-300 hover:shadow-lg hover:shadow-{{ $tool['color'] }}-500/10 dark:hover:shadow-{{ $tool['color'] }}-900/10 flex-shrink-0" data-aos="zoom-in" data-aos-delay="{{ $index * 30 }}">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-{{ $tool['color'] }}-100 dark:bg-{{ $tool['color'] }}-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="{{ $tool['icon'] }} text-{{ $tool['color'] }}-600 dark:text-{{ $tool['color'] }}-400 text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $tool['name'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>