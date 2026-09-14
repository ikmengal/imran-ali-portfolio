<section id="about" class="py-20 lg:py-32 bg-white dark:bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-primary-50/30 to-transparent dark:via-primary-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-user"></i>
                Get to Know Me
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                About <span class="bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent">Me</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                Passionate developer with a love for clean code, modern architectures, and solving complex problems.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start">
            <div class="space-y-8" data-aos="fade-right">
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                            <i class="ph-fill ph-code text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white">Full Stack Development</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Building end-to-end solutions</p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        Expert in building scalable web applications using Laravel, PHP, and modern frontend frameworks. 
                        From RESTful APIs to real-time applications with WebSockets, I deliver robust backend solutions 
                        that power exceptional user experiences.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent-500 to-amber-500 flex items-center justify-center">
                            <i class="ph-fill ph-cpu text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white">Cloud & DevOps</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Infrastructure & deployment</p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        Experienced with AWS, Docker, and CI/CD pipelines. I architect cloud-native solutions 
                        with auto-scaling, monitoring, and zero-downtime deployments. Infrastructure as Code 
                        using Terraform for reproducible environments.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                            <i class="ph-fill ph-database text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white">Database Design</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Optimization & architecture</p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        Deep expertise in relational databases (PostgreSQL, MySQL) and NoSQL solutions (Redis, MongoDB). 
                        Query optimization, indexing strategies, data modeling, and migration management for 
                        high-performance applications handling millions of records.
                    </p>
                </div>
            </div>

            <div class="relative" data-aos="fade-left">
                <div class="bg-gradient-to-br from-slate-50 dark:from-slate-900 to-white dark:to-slate-800 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-bl from-primary-500/10 to-transparent rounded-full blur-3xl"></div>
                    
                    <h3 class="font-space text-2xl font-bold text-slate-900 dark:text-white mb-6 relative z-10">My Journey</h3>
                    
                    <div class="relative z-10 space-y-6">
                        @php
                            $stats = [
                                ['icon' => 'ph-fill ph-briefcase', 'value' => '5+', 'label' => 'Years Experience', 'color' => 'primary'],
                                ['icon' => 'ph-fill ph-projector-screen', 'value' => '50+', 'label' => 'Projects Delivered', 'color' => 'accent'],
                                ['icon' => 'ph-fill ph-users', 'value' => '20+', 'label' => 'Happy Clients', 'color' => 'emerald'],
                                ['icon' => 'ph-fill ph-coffee', 'value' => '∞', 'label' => 'Cups of Coffee', 'color' => 'amber'],
                            ];
                        @endphp
                        
                        <div class="grid grid-cols-2 gap-6">
                            @foreach($stats as $index => $stat)
                                <div class="group relative p-6 rounded-2xl bg-white/50 dark:bg-slate-900/50 border border-slate-200/50 dark:border-slate-800/50 hover:border-{{ $stat['color'] }}-300 dark:hover:border-{{ $stat['color'] }}-700 transition-all duration-300" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                    <div class="w-12 h-12 rounded-xl bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-900/30 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                        <i class="{{ $stat['icon'] }} text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400 text-xl"></i>
                                    </div>
                                    <div class="font-space text-3xl font-bold text-slate-900 dark:text-white counter" data-target="{{ str_replace('+', '', $stat['value']) }}">{{ $stat['value'] }}</div>
                                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $stat['label'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-6 border-t border-slate-200 dark:border-slate-800">
                            <h4 class="font-medium text-slate-900 dark:text-white mb-4">Technologies I Work With</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Laravel', 'PHP', 'Vue.js', 'React', 'TypeScript', 'Tailwind CSS', 'PostgreSQL', 'MySQL', 'Redis', 'Docker', 'AWS', 'Git', 'REST APIs', 'GraphQL', 'WebSockets'] as $tech)
                                    <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 border border-primary-200 dark:border-primary-800">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-6 lg:-right-12 w-64 h-64 bg-gradient-to-tr from-accent-500/20 to-transparent rounded-full blur-3xl"></div>
            </div>
        </div>
    </div>
</section>