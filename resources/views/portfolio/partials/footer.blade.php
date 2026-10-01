<footer class="bg-slate-950 dark:bg-slate-950 border-t border-slate-800 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-t from-primary-500/5 via-transparent to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid lg:grid-cols-4 gap-12 mb-12">
            <div class="lg:col-span-2">
                <a href="#home" class="flex items-center gap-2 mb-4" aria-label="Go to homepage">
                    @if($user->logo)
                        <img src="{{ asset('storage/users/' . $user->logo) }}" alt="{{ $user->name }}" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                            <i class="ph-fill ph-code text-white text-xl"></i>
                        </div>
                    @endif
                    <span class="font-space font-bold text-xl text-white">{{ $user->name ?? 'Developer' }}</span>
                </a>
                <p class="text-slate-400 max-w-md leading-relaxed mb-6">
                    {{ $user->bio ?? 'Full Stack Developer crafting robust, scalable web applications with modern technologies. Passionate about clean code, performance, and great user experiences.' }}
                </p>
                
                <div class="flex flex-wrap gap-4">
                    @if($user->github)
                        <a href="{{ $user->github }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="GitHub">
                            <i class="ph-fill ph-github-logo text-xl"></i>
                        </a>
                    @endif
                    @if($user->linkedin)
                        <a href="{{ $user->linkedin }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="LinkedIn">
                            <i class="ph-fill ph-linkedin-logo text-xl"></i>
                        </a>
                    @endif
                    @if($user->twitter)
                        <a href="{{ $user->twitter }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="Twitter">
                            <i class="ph-fill ph-twitter-logo text-xl"></i>
                        </a>
                    @endif
                    @if($user->facebook)
                        <a href="{{ $user->facebook }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="Facebook">
                            <i class="ph-fill ph-facebook-logo text-xl"></i>
                        </a>
                    @endif
                    @if($user->instagram)
                        <a href="{{ $user->instagram }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="Instagram">
                            <i class="ph-fill ph-instagram-logo text-xl"></i>
                        </a>
                    @endif
                    @if($user->youtube)
                        <a href="{{ $user->youtube }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="YouTube">
                            <i class="ph-fill ph-youtube-logo text-xl"></i>
                        </a>
                    @endif
                    @if($user->email)
                        <a href="mailto:{{ $user->email }}" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary-500/20 transition-all duration-200" aria-label="Email">
                            <i class="ph-fill ph-envelope text-xl"></i>
                        </a>
                    @endif
                </div>
            </div>
            
            <div>
                <h4 class="font-space font-bold text-white mb-4">Quick Links</h4>
                <nav class="space-y-3">
                    <a href="#about" class="text-slate-400 hover:text-primary-400 transition-colors">About Me</a>
                    <a href="#skills" class="text-slate-400 hover:text-primary-400 transition-colors">Skills</a>
                    <a href="#experience" class="text-slate-400 hover:text-primary-400 transition-colors">Experience</a>
                    <a href="#projects" class="text-slate-400 hover:text-primary-400 transition-colors">Projects</a>
                    <a href="#services" class="text-slate-400 hover:text-primary-400 transition-colors">Services</a>
                    <a href="#testimonials" class="text-slate-400 hover:text-primary-400 transition-colors">Testimonials</a>
                    <a href="#contact" class="text-slate-400 hover:text-primary-400 transition-colors">Contact</a>
                </nav>
            </div>
            
            <div>
                <h4 class="font-space font-bold text-white mb-4">Technologies</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Laravel', 'PHP', 'Vue.js', 'React', 'TypeScript', 'Tailwind CSS', 'PostgreSQL', 'MySQL', 'Redis', 'Docker', 'AWS', 'Git'] as $tech)
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-slate-800 text-slate-300 hover:text-primary-400 hover:bg-primary-500/20 transition-colors">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="pt-8 border-t border-slate-800">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} {{ $user->name ?? 'Full Stack Developer' }}. All rights reserved.
                </p>
                
                @if($user->professional_title)
                <p class="text-slate-500 text-sm">{{ $user->professional_title }}</p>
                @endif
                
                <div class="flex items-center gap-4 text-sm text-slate-500">
                    <a href="#" class="hover:text-primary-400 transition-colors">Privacy Policy</a>
                    <span>/</span>
                    <a href="#" class="hover:text-primary-400 transition-colors">Terms of Service</a>
                </div>
                
                <div class="flex items-center gap-2 text-slate-500">
                    <i class="ph-fill ph-heart text-red-500 text-lg animate-pulse"></i>
                    <span class="text-sm">Built with Laravel & Tailwind CSS</span>
                </div>
            </div>
        </div>
    </div>
</footer>