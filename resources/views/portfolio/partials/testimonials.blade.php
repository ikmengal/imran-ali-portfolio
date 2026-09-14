<section id="testimonials" class="py-20 lg:py-32 bg-white dark:bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-pink-50/30 to-transparent dark:via-pink-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-chat-circle-text"></i>
                Testimonials
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                Client <span class="bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">Feedback</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                What clients and colleagues have to say about working with me.
            </p>
        </div>

        @if($testimonials->isNotEmpty())
            <div class="relative">
                <div class="overflow-hidden">
                    <div id="testimonials-track" class="flex transition-transform duration-500 ease-out">
                        @foreach($testimonials as $index => $testimonial)
                            <div class="testimonial-slide flex-shrink-0 w-full sm:w-1/2 lg:w-1/3 px-4">
                                <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-lg hover:shadow-xl transition-all duration-300 h-full">
                                    <div class="flex items-center gap-1 mb-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="ph-fill ph-star text-amber-400 text-lg" style="color: {{ $i <= $testimonial->rating ? '#fbbf24' : '#d1d5db' }}"></i>
                                        @endfor
                                    </div>
                                    
                                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-6">"{{ $testimonial->message }}"</p>
                                    
                                    <div class="flex items-center gap-4 pt-4 border-t border-slate-200 dark:border-slate-800">
                                        @if($testimonial->image)
                                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center">
                                                <span class="font-bold text-white text-lg">{{ strtoupper($testimonial->name[0]) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">{{ $testimonial->name }}</p>
                                            @if($testimonial->designation)
                                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $testimonial->designation }}</p>
                                            @endif
                                            @if($testimonial->company)
                                                <p class="text-sm text-pink-600 dark:text-pink-400">{{ $testimonial->company }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex items-center justify-center gap-4 mt-10">
                    <button id="testimonial-prev" class="w-12 h-12 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 shadow-lg" aria-label="Previous testimonial">
                        <i class="ph-fill ph-caret-left text-xl"></i>
                    </button>
                    
                    <div id="testimonial-dots" class="flex items-center gap-2" role="tablist" aria-label="Testimonial navigation">
                        @foreach($testimonials as $index => $testimonial)
                            <button class="testimonial-dot w-2.5 h-2.5 rounded-full {{ $index === 0 ? 'bg-primary-600' : 'bg-slate-300 dark:bg-slate-600' }} transition-all duration-200" data-index="{{ $index }}" role="tab" aria-selected="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Go to testimonial {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    
                    <button id="testimonial-next" class="w-12 h-12 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 shadow-lg" aria-label="Next testimonial">
                        <i class="ph-fill ph-caret-right text-xl"></i>
                    </button>
                </div>
            </div>
        @else
            <div class="text-center py-12" data-aos="fade-up">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4">
                    <i class="ph-fill ph-chat-circle-text text-slate-400 dark:text-slate-500 text-3xl"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-2">No Testimonials Yet</h3>
                <p class="text-slate-500 dark:text-slate-400">Add testimonials from the admin panel to showcase client feedback.</p>
            </div>
        @endif
    </div>
</section>