@extends('errors.layout')

@section('title', '404 - Page Not Found')

@section('error-css')
@push('error-css')
@endpush

@section('content')
    <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
        Page Not Found
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10 max-w-lg mx-auto">
        Sorry, we couldn't find the page you're looking for. It might have been moved, deleted, or never existed.
    </p>
@endsection

@section('actions')
    [
        ['url' => route('portfolio'), 'label' => 'Back to Home', 'icon' => 'ph-fill ph-house', 'variant' => 'primary'],
        ['url' => 'javascript:history.back()', 'label' => 'Go Back', 'icon' => 'ph-fill ph-arrow-left', 'variant' => 'secondary'],
    ]
@endsection

@section('helpLinks')
    [
        'label' => 'Or explore these sections:',
        'links' => [
            ['url' => route('portfolio') . '#about', 'label' => 'About Me'],
            ['url' => route('portfolio') . '#projects', 'label' => 'Projects'],
            ['url' => route('portfolio') . '#contact', 'label' => 'Contact'],
        ]
    ]
@endsection