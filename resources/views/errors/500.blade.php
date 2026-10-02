@extends('errors.layout')

@section('title', '500 - Server Error')

@section('content')
    <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
        Server Error
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10 max-w-lg mx-auto">
        Something went wrong on our end. Our team has been notified and we're working to fix it. Please try again in a few moments.
    </p>
@endsection

@section('actions')
    [
        ['url' => 'javascript:location.reload()', 'label' => 'Try Again', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
        ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
    ]
@endsection

@section('helpLinks')
    [
        'label' => 'If this problem persists:',
        'links' => [
            ['url' => '#', 'label' => 'Refresh the page'],
            ['url' => '#', 'label' => 'Clear browser cache'],
            ['url' => route('portfolio') . '#contact', 'label' => 'Contact Support'],
        ]
    ]
@endsection