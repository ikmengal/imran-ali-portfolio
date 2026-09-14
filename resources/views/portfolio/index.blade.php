<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $user->name ?? 'Full Stack Developer' }} - Portfolio">
    <title>{{ $user->name ?? 'Full Stack Developer' }} | Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/bold.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/duotone.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/thin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/all.js"></script>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased font-sans min-h-screen">
    <div id="app" class="relative overflow-hidden">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-primary-600 dark:focus:bg-slate-900">Skip to main content</a>

        @include('portfolio.partials.navigation')

        <main id="main-content">
            @include('portfolio.partials.hero', ['user' => $user])
            @include('portfolio.partials.about', ['user' => $user])
            @include('portfolio.partials.skills', ['skills' => $skills])
            @include('portfolio.partials.experience', ['experiences' => $experiences])
            @include('portfolio.partials.education', ['education' => $education])
            @include('portfolio.partials.projects', ['projects' => $projects, 'featuredProjects' => $featuredProjects])
            @include('portfolio.partials.services', ['services' => $services])
            @include('portfolio.partials.testimonials', ['testimonials' => $testimonials])
            @include('portfolio.partials.contact')
        </main>

        @include('portfolio.partials.footer', ['user' => $user])
    </div>

    @include('portfolio.partials.scripts')
</body>
</html>