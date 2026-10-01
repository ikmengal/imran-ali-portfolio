<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16 lg:pt-20">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 via-transparent to-accent-50/50 dark:from-primary-900/20 dark:via-transparent dark:to-accent-900/20"></div>

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl animate-float-slow animation-delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-primary-500/5 to-transparent rounded-full blur-3xl animate-pulse-slow"></div>
    </div>

    <div class="absolute top-0 left-0 right-0 bottom-0 overflow-hidden" aria-hidden="true">
        <canvas id="hero-canvas"></canvas>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="text-center lg:text-left" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-medium mb-6 animate-slide-up">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                    </span>
                    Available for freelance & full-time opportunities
                </div>

                <h1 class="font-space text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-slate-900 dark:text-white leading-tight mb-6 animate-slide-up animation-delay-200">
                    Hi, I'm <span class="bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent">{{ $user->name ?? 'Full Stack Developer' }}</span>
                </h1>

                <p class="text-lg sm:text-xl lg:text-2xl text-slate-600 dark:text-slate-300 font-medium mb-4 animate-slide-up animation-delay-300 min-h-[3rem]">
                    <span id="typed-text"></span><span class="typing-cursor" aria-hidden="true"></span>
                </p>

                <p class="text-slate-500 dark:text-slate-400 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 mb-10 animate-slide-up animation-delay-400 leading-relaxed">
                    {{ $user->bio ?? 'Passionate Full Stack Developer crafting robust, scalable web applications with modern technologies. Specializing in Laravel, Vue.js, and cloud-native architectures.' }}
                </p>

                @if($user->professional_title)
                <p class="text-primary-600 dark:text-primary-400 font-medium mb-8 animate-slide-up animation-delay-400">
                    {{ $user->professional_title }}
                </p>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 animate-slide-up animation-delay-500">
                    <a href="#contact" class="group flex items-center justify-center gap-2 px-8 py-4 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-all duration-300 shadow-xl shadow-primary-500/30 hover:shadow-primary-500/40 hover:-translate-y-1">
                        <i class="ph-fill ph-paper-plane"></i>
                        Let's Work Together
                    </a>
                    <a href="#projects" class="group flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-medium rounded-xl border border-slate-200 dark:border-slate-700 hover:border-primary-300 dark:hover:border-primary-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300 hover:-translate-y-1">
                        <i class="ph-fill ph-folder"></i>
                        View Projects
                    </a>
                </div>

                <div class="mt-12 flex flex-wrap items-center justify-center lg:justify-start gap-8 animate-slide-up animation-delay-600">
                    @if($user->github)
                    <a href="{{ $user->github }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:opacity-75 transition-opacity">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                            <i class="ph-fill ph-github-logo text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-slate-500 dark:text-slate-400">GitHub</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ parse_url($user->github, PHP_URL_PATH) }}</p>
                        </div>
                    </a>
                    @endif
                    @if($user->linkedin)
                    <a href="{{ $user->linkedin }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:opacity-75 transition-opacity">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                            <i class="ph-fill ph-linkedin-logo text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-slate-500 dark:text-slate-400">LinkedIn</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ parse_url($user->linkedin, PHP_URL_PATH) }}</p>
                        </div>
                    </a>
                    @endif
                    @if($user->twitter)
                    <a href="{{ $user->twitter }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:opacity-75 transition-opacity">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center">
                            <i class="ph-fill ph-twitter-logo text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-slate-500 dark:text-slate-400">Twitter</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ parse_url($user->twitter, PHP_URL_PATH) }}</p>
                        </div>
                    </a>
                    @endif
                    @if($user->facebook)
                    <a href="{{ $user->facebook }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:opacity-75 transition-opacity">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                            <i class="ph-fill ph-facebook-logo text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-slate-500 dark:text-slate-400">Facebook</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ parse_url($user->facebook, PHP_URL_PATH) }}</p>
                        </div>
                    </a>
                    @endif
                    @if($user->instagram)
                    <a href="{{ $user->instagram }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:opacity-75 transition-opacity">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 via-purple-500 to-orange-500 flex items-center justify-center">
                            <i class="ph-fill ph-instagram-logo text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-slate-500 dark:text-slate-400">Instagram</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ parse_url($user->instagram, PHP_URL_PATH) }}</p>
                        </div>
                    </a>
                    @endif
                    @if($user->youtube)
                    <a href="{{ $user->youtube }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 hover:opacity-75 transition-opacity">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center">
                            <i class="ph-fill ph-youtube-logo text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-slate-500 dark:text-slate-400">YouTube</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ parse_url($user->youtube, PHP_URL_PATH) }}</p>
                        </div>
                    </a>
                    @endif
                    @if(!$user->github && !$user->linkedin && !$user->twitter && !$user->facebook && !$user->instagram && !$user->youtube)
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Add social links in your profile settings</p>
                    @endif
                </div>
            </div>

            <div class="relative" data-aos="fade-left" data-aos-delay="300">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-500/20 to-accent-500/20 rounded-3xl blur-2xl animate-pulse-slow"></div>
                    <div class="relative bg-white dark:bg-slate-900 rounded-3xl p-2 border border-slate-200 dark:border-slate-800 shadow-2xl">
                        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-slate-50 dark:from-slate-900 to-white dark:to-slate-800">
                            @if($user->portfolio_header)
                                <img src="{{ asset('storage/users/' . $user->portfolio_header) }}" alt="{{ $user->name }}'s Portfolio Header" class="w-full h-auto object-cover object-top">
                            @elseif($user->profile_image)
                                <img src="{{ asset('storage/users/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-auto aspect-square object-cover">
                            @else
                                <div class="w-full aspect-square flex items-center justify-center bg-gradient-to-br from-primary-500 to-accent-500">
                                    <i class="ph-fill ph-user text-white text-8xl opacity-50"></i>
                                </div>
                            @endif

                            <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-2xl bg-gradient-to-br from-accent-500 to-amber-500 flex items-center justify-center shadow-xl shadow-accent-500/30 animate-bounce-slow">
                                <i class="ph-fill ph-code text-white text-3xl"></i>
                            </div>

                            <div class="absolute -top-4 -left-4 w-20 h-20 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg animate-float">
                                <i class="ph-fill ph-laptop text-primary-600 dark:text-primary-400 text-3xl"></i>
                            </div>

                            <div class="absolute bottom-8 left-8 w-16 h-16 rounded-xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg animate-float animation-delay-500">
                                <i class="ph-fill ph-database text-accent-600 dark:text-accent-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-8 -left-8 lg:-left-12 flex gap-4" aria-hidden="true">
                    <div class="w-20 h-20 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-xl animate-float-slow">
                        <i class="ph-fill ph-terminal text-primary-600 dark:text-primary-400 text-2xl"></i>
                    </div>
                    <div class="w-16 h-16 rounded-xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg animate-float animation-delay-1000 -mt-4">
                        <i class="ph-fill ph-server text-accent-600 dark:text-accent-400 text-xl"></i>
                    </div>
                    <div class="w-24 h-24 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-xl animate-float-slow animation-delay-500">
                        <i class="ph-fill ph-gear text-slate-600 dark:text-slate-400 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce-slow" aria-hidden="true">
            <a href="#about" class="w-10 h-10 rounded-full bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-700 flex items-center justify-center shadow-lg hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-300">
                <i class="ph-fill ph-caret-double-down text-slate-600 dark:text-slate-400 text-xl"></i>
            </a>
        </div>
    </div>
</section>
