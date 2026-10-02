@extends('errors.layout')

@section('title', '419 - Session Expired')

@section('content')
    <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
        Session Expired
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10 max-w-lg mx-auto">
        Your session has expired for security reasons. Please refresh the page to start a new session.
    </p>
@endsection

@section('actions')
    [
        ['url' => 'javascript:location.reload()', 'label' => 'Refresh Page', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
        ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
    ]
@endsection