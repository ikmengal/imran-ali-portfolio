@extends('errors.layout')

@section('title', '{{ $code ?? "Error" }} - {{ config("app.name") }}')

@section('content')
    <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
        {{ $message ?? 'Something Went Wrong' }}
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10 max-w-lg mx-auto">
        {{ $exception ? $exception->getMessage() : 'An unexpected error occurred. Please try again later.' }}
    </p>
@endsection

@section('actions')
    [
        ['url' => 'javascript:location.reload()', 'label' => 'Try Again', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
        ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
    ]
@endsection

@if(config('app.debug') && $exception)
@section('error-js')
    <script>
        console.error('Error:', {{ json_encode($exception->getMessage()) }});
    </script>
@endsection
@endif