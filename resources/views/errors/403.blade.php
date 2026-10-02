@extends('errors.layout')

@section('title', '403 - Access Denied')

@section('content')
    <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
        Access Denied
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10 max-w-lg mx-auto">
        You don't have permission to access this page. Please contact the administrator if you believe this is an error.
    </p>
@endsection

@section('actions')
    [
        ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'primary'],
        ['url' => 'javascript:history.back()', 'label' => 'Go Back', 'icon' => 'ph-fill ph-arrow-left', 'variant' => 'secondary'],
    ]
@endsection