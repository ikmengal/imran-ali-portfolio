<section id="services" class="py-20 lg:py-32 bg-slate-50 dark:bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-cyan-50/30 to-transparent dark:via-cyan-900/10 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-300 text-sm font-medium mb-4">
                <i class="ph-fill ph-wrench"></i>
                Services
            </div>
            <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                What I <span class="bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">Offer</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto leading-relaxed">
                Comprehensive development services tailored to your business needs and technical requirements.
            </p>
        </div>

        @if($services->isNotEmpty())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $index => $service)
                    <div class="group relative bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 hover:border-cyan-300 dark:hover:border-cyan-700 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/10 dark:hover:shadow-cyan-900/10" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-cyan-500/10 to-transparent rounded-tr-2xl rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                @if($service->icon)
                                    <i class="{{ $service->icon }} text-white text-2xl"></i>
                                @else
                                    <i class="ph-fill ph-wrench text-white text-2xl"></i>
                                @endif
                            </div>
                            
                            @if($service->is_featured)
                                <span class="inline-block px-2 py-1 text-xs font-bold rounded-full bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-300 mb-4">Featured</span>
                            @endif
                            
                            <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-3">{{ $service->title }}</h3>
                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $service->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12" data-aos="fade-up">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4">
                    <i class="ph-fill ph-wrench text-slate-400 dark:text-slate-500 text-3xl"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-slate-900 dark:text-white mb-2">No Services Added Yet</h3>
                <p class="text-slate-500 dark:text-slate-400">Add services from the admin panel to showcase what you offer.</p>
            </div>
        @endif
    </div>
</section>