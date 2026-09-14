<section id="contact" class="py-20 lg:py-32 bg-slate-950 dark:bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 via-transparent to-accent-500/10"></div>
    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl animate-float-slow animation-delay-1000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-500/20 text-primary-400 text-sm font-medium mb-4">
                <i class="ph-fill ph-envelope"></i>
                Get In Touch
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Let's <span class="bg-gradient-to-r from-primary-400 to-accent-400 bg-clip-text text-transparent">Connect</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed">
                Have a project in mind or just want to say hello? I'd love to hear from you.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">
            <div data-aos="fade-right">
                <div class="bg-slate-900/50 dark:bg-slate-900/50 rounded-3xl p-8 border border-slate-800">
                    <h3 class="font-space text-2xl font-bold text-white mb-6">Let's Start a Conversation</h3>
                    <p class="text-slate-300 leading-relaxed mb-8">
                        Whether you have a question about my work, want to collaborate on a project, or just want to chat about technology, I'm always open to connecting with fellow developers and potential clients.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-500/20 flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-envelope text-primary-400 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-white">Email</h4>
                                <a href="mailto:{{ $user->email ?? 'hello@example.com' }}" class="text-slate-400 hover:text-primary-400 transition-colors">{{ $user->email ?? 'hello@example.com' }}</a>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-accent-500/20 flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-map-pin text-accent-400 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-white">Location</h4>
                                <p class="text-slate-400">{{ $user->location ?? 'Available Worldwide' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-clock text-emerald-400 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-white">Availability</h4>
                                <p class="text-slate-400">Open for freelance & full-time</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 pt-8 border-t border-slate-800">
                        <h4 class="font-medium text-white mb-4">Follow Me</h4>
                        <div class="flex items-center gap-4">
                            @foreach([
                                ['icon' => 'ph-fill ph-github-logo', 'url' => $user->github_url ?? '#', 'color' => 'hover:text-white'],
                                ['icon' => 'ph-fill ph-linkedin-logo', 'url' => $user->linkedin_url ?? '#', 'color' => 'hover:text-sky-400'],
                                ['icon' => 'ph-fill ph-twitter-logo', 'url' => $user->twitter_url ?? '#', 'color' => 'hover:text-sky-300'],
                                ['icon' => 'ph-fill ph-youtube-logo', 'url' => $user->youtube_url ?? '#', 'color' => 'hover:text-red-400'],
                            ] as $social)
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 {{ $social['color'] }} transition-all duration-200 hover:bg-primary-500/20">
                                    <i class="{{ $social['icon'] }} text-xl"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div data-aos="fade-left">
                <div class="bg-slate-900/50 dark:bg-slate-900/50 rounded-3xl p-8 border border-slate-800">
                    <form id="contact-form" class="space-y-6" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Name</label>
                                <div class="relative">
                                    <i class="ph-fill ph-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl"></i>
                                    <input type="text" id="name" name="name" required class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" placeholder="Your Name">
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                                <div class="relative">
                                    <i class="ph-fill ph-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl"></i>
                                    <input type="email" id="email" name="email" required class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" placeholder="your@email.com">
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-300 mb-2">Subject</label>
                            <div class="relative">
                                <i class="ph-fill ph-chat-circle absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl"></i>
                                <input type="text" id="subject" name="subject" class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" placeholder="Project Inquiry / Collaboration / Just saying hi">
                            </div>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-300 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 resize-none" placeholder="Tell me about your project, ideas, or just say hello..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full py-4 px-8 bg-gradient-to-r from-primary-600 to-accent-600 text-white font-medium rounded-xl hover:from-primary-700 hover:to-accent-700 transition-all duration-300 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 flex items-center justify-center gap-2">
                            <i class="ph-fill ph-paper-plane"></i>
                            Send Message
                        </button>
                        
                        <div id="form-status" class="hidden p-4 rounded-xl"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>