<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $page->meta_description ?? $page->title }} - {{ $user->name ?? 'Full Stack Developer' }}">
    <title>{{ $page->meta_title ?? $page->title }} | {{ $user->name ?? 'Portfolio' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill.js"></script>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased font-sans min-h-screen">
    <div id="app" class="relative overflow-hidden">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-primary-600 dark:focus:bg-slate-900">Skip to main content</a>

        @include('portfolio.partials.navigation')

        <main id="main-content">
            <!-- Page Banner -->
            @if($page->banner_image)
                <section class="relative min-h-[350px] lg:min-h-[450px] xl:min-h-[550px] flex items-center justify-center">
                    <img src="{{ asset('storage/pages/' . $page->banner_image) }}" 
                         alt="{{ $page->banner_alt ?? $page->title }}" 
                         class="absolute inset-0 w-full h-full object-cover">
                    @if($page->banner_overlay)
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                    @endif
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
                        <nav class="mb-8" aria-label="Breadcrumb">
                            <ol class="flex items-center gap-2 text-sm text-white/80">
                                <li><a href="{{ route('portfolio.user', $user->portfolio_slug) }}" class="hover:text-primary-300 transition-colors">{{ $user->name ?? 'Home' }}</a></li>
                                <li><i class="ph-fill ph-caret-right text-xs"></i></li>
                                <li class="text-white font-medium">{{ $page->title }}</li>
                            </ol>
                        </nav>
                        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                            <h1 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">{{ $page->title }}</h1>
                            <p class="text-white/80 text-lg max-w-2xl mx-auto">Last updated: {{ $page->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </section>
            @else
                <!-- Page Hero (No Banner) -->
                <section class="py-20 lg:py-32 bg-white dark:bg-slate-950 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-primary-50/30 to-transparent dark:via-primary-900/10 pointer-events-none"></div>
                    
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <nav class="mb-8" aria-label="Breadcrumb">
                            <ol class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                <li><a href="{{ route('portfolio.user', $user->portfolio_slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ $user->name ?? 'Home' }}</a></li>
                                <li><i class="ph-fill ph-caret-right text-xs"></i></li>
                                <li class="text-slate-900 dark:text-white font-medium">{{ $page->title }}</li>
                            </ol>
                        </nav>

                        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                            <h1 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-4">{{ $page->title }}</h1>
                            <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto">Last updated: {{ $page->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </section>
            @endif

            <!-- Page Content -->
            <section class="py-20 lg:py-32 bg-slate-50 dark:bg-slate-900">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <article class="prose prose-slate dark:prose-invert max-w-none" data-aos="fade-up">
                        {!! $page->content !!}
                    </article>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 lg:py-32 bg-gradient-to-r from-primary-600 to-primary-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
                    <h2 class="font-space text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">Have Questions?</h2>
                    <p class="text-primary-100 text-lg max-w-2xl mx-auto mb-8">Feel free to reach out if you have any questions about this page.</p>
                    <a href="{{ route('portfolio.user', $user->portfolio_slug) }}#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-600 font-medium rounded-xl hover:bg-primary-50 transition-all duration-200 shadow-xl hover:scale-105">
                        <i class="ph-fill ph-envelope"></i>
                        Contact Me
                    </a>
                </div>
            </section>
        </main>

        @include('portfolio.partials.footer', ['user' => $user])

        <button id="scroll-top" class="fixed bottom-8 right-8 z-50 w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xl shadow-primary-500/30 opacity-0 invisible transition-all duration-300 hover:bg-primary-700 hover:scale-105 hover:-translate-y-1" aria-label="Scroll to top" title="Back to top" style="right: 2rem; bottom: 2rem;">
            <i class="ph-fill ph-caret-up text-xl"></i>
        </button>
    </div>

    @include('portfolio.partials.scripts')
</body>
</html>