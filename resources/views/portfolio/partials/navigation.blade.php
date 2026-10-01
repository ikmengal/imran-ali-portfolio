<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200/50 dark:border-slate-800/50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <div class="flex items-center">
                <a href="#home" class="flex items-center gap-2" aria-label="Go to homepage">
                    @if($user->logo)
                        <img src="{{ asset('storage/users/' . $user->logo) }}" alt="{{ $user->name }}" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                            <i class="ph-fill ph-code text-white text-xl"></i>
                        </div>
                    @endif
                    <span class="font-space font-bold text-xl text-slate-900 dark:text-white hidden sm:block">{{ $user->name ?? 'Developer' }}</span>
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-8">
                <a href="#about" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">About</a>
                <a href="#skills" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Skills</a>
                <a href="#experience" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Experience</a>
                <a href="#projects" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Projects</a>
                <a href="#services" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Services</a>
                <a href="#testimonials" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Testimonials</a>
                <a href="#contact" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Contact</a>
            </div>

            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200" aria-label="Toggle theme">
                    <i class="ph-fill ph-sun text-lg" id="sun-icon"></i>
                    <i class="ph-fill ph-moon text-lg hidden" id="moon-icon"></i>
                </button>

                <a href="#contact" class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-xl hover:bg-primary-700 transition-all duration-200 shadow-lg shadow-primary-500/25">
                    <i class="ph-fill ph-envelope"></i>
                    Hire Me
                </a>

                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors" aria-label="Open menu" aria-expanded="false">
                    <i class="ph-fill ph-list text-xl" id="menu-open"></i>
                    <i class="ph-fill ph-x text-xl hidden" id="menu-close"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="lg:hidden hidden overflow-hidden transition-all duration-300 ease-out bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800">
            <div class="py-4 px-4 space-y-2">
                <a href="#about" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">About</a>
                <a href="#skills" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Skills</a>
                <a href="#experience" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Experience</a>
                <a href="#projects" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Projects</a>
                <a href="#services" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Services</a>
                <a href="#testimonials" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Testimonials</a>
                <a href="#contact" class="mobile-nav-link block px-4 py-3 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Contact</a>
                <a href="#contact" class="block mt-4 px-5 py-3 bg-primary-600 text-white text-center font-medium rounded-xl hover:bg-primary-700 transition-colors">Hire Me</a>
            </div>
        </div>
    </div>
</nav>