<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Error - ' . config('app.name') }}">
    <title>{{ $title ?? ($code ?? 'Error') . ' - ' . config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill.js"></script>
    @stack('error-css')
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased font-sans min-h-screen flex items-center justify-center">
    <div id="app" class="relative overflow-hidden w-full">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 via-transparent to-accent-50/50 dark:from-primary-900/20 dark:via-transparent dark:to-accent-900/20"></div>
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl animate-float-slow animation-delay-1000"></div>
        </div>

        <main class="relative z-10 flex items-center justify-center min-h-screen px-4 py-20">
            <div class="max-w-md w-full text-center" data-aos="fade-up">
                <div class="mb-8 relative">
                    <div class="text-9xl lg:text-[12rem] font-space font-bold bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent animate-pulse-slow">
                        {{ $code ?? 'Error' }}
                    </div>
                </div>

                <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
                    {{ $title ?? 'Something Went Wrong' }}
                </h1>
                <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10 max-w-lg mx-auto">
                    {{ $message ?? 'An unexpected error occurred. Please try again later.' }}
                </p>

                @if(isset($actions))
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        @foreach($actions as $action)
                            <a href="{{ $action['url'] }}" 
                               class="group flex items-center justify-center gap-2 px-8 py-4 {{ $action['variant'] ?? 'bg-primary-600 text-white' }} font-medium rounded-xl {{ $action['variant'] === 'secondary' ? 'hover:bg-primary-50' : 'hover:bg-primary-700' }} transition-all duration-300 shadow-xl {{ $action['variant'] === 'secondary' ? 'shadow-primary-500/30 hover:shadow-primary-500/40' : 'shadow-primary-500/30 hover:shadow-primary-500/40' }} hover:scale-105">
                                @if(isset($action['icon']))
                                    <i class="{{ $action['icon'] }}"></i>
                                @endif
                                {{ $action['label'] }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('portfolio') }}" class="group flex items-center justify-center gap-2 px-8 py-4 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-all duration-300 shadow-xl shadow-primary-500/30 hover:shadow-primary-500/40 hover:-translate-y-1">
                            <i class="ph-fill ph-house"></i>
                            Go Home
                        </a>
                        <button onclick="history.back()" class="group flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-medium rounded-xl border border-slate-200 dark:border-slate-700 hover:border-primary-300 dark:hover:border-primary-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300 hover:-translate-y-1">
                            <i class="ph-fill ph-arrow-left"></i>
                            Go Back
                        </button>
                    </div>
                @endif

                @if(isset($helpLinks))
                    <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 dark:text-slate-500 text-sm mb-4">{{ $helpLinks['label'] ?? 'Or explore:' }}</p>
                        <div class="flex flex-wrap justify-center gap-3">
                            @foreach($helpLinks['links'] as $link)
                                <a href="{{ $link['url'] }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors text-sm">{{ $link['label'] }}</a>
                                @if(!$loop->last)
                                    <span class="text-slate-300 dark:text-slate-600">·</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </main>

        <!-- Floating Shapes -->
        <div class="absolute top-0 left-0 right-0 bottom-0 overflow-hidden" aria-hidden="true">
            <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl animate-float-slow animation-delay-1000"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.opacity = '0';
            requestAnimationFrame(() => {
                document.body.style.transition = 'opacity 0.5s ease';
                document.body.style.opacity = '1';
            });
        });
    </script>
    @stack('error-js')
</body>
</html>