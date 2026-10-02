@extends('errors.layout')

@section('title', '503 - Maintenance Mode')

@section('content')
    <h1 class="font-space text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
        Maintenance Mode
    </h1>
    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-6 max-w-lg mx-auto">
        We're currently performing scheduled maintenance to improve your experience.
    </p>
    
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mb-10">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center">
                <i class="ph-fill ph-clock text-white text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-blue-900 dark:text-blue-100">Maintenance in Progress</h3>
                <p class="text-sm text-blue-700 dark:text-blue-300">We'll be back shortly. Thank you for your patience!</p>
            </div>
        </div>
        <div class="space-y-2 text-sm text-blue-700 dark:text-blue-300">
            <div class="flex items-center gap-2">
                <i class="ph-fill ph-check text-success"></i>
                <span>Scheduled maintenance window</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ph-fill ph-check text-success"></i>
                <span>Improving performance & features</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ph-fill ph-check text-success"></i>
                <span>Back online soon</span>
            </div>
        </div>
    </div>
@endsection

@section('actions')
    [
        ['url' => 'javascript:location.reload()', 'label' => 'Check Again', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
        ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
    ]
@endsection