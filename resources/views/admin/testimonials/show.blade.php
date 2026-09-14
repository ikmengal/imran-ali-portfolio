@extends('admin.layouts.app')

@section('title', 'Testimonial: ' . $testimonial->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $testimonial->name }}</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $testimonial->designation ?? '' }} @if($testimonial->company) at {{ $testimonial->company }} @endif</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                <i class="ph ph-pencil text-sm"></i>
                Edit
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-arrow-left text-sm"></i>
                Back
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Testimonial</h3>
                <div class="prose dark:prose-invert max-w-none">
                    <blockquote class="border-l-4 border-primary-500 pl-4 italic">
                        <p>{{ $testimonial->message }}</p>
                    </blockquote>
                </div>
                <div class="flex items-center gap-1 mt-4">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $testimonial->rating)
                            <i class="ph ph-fill ph-star text-yellow-400 text-xl"></i>
                        @else
                            <i class="ph ph-star text-slate-300 dark:text-slate-600 text-xl"></i>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

        <div class="space-y-6">
            @if ($testimonial->image)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-primary-100 dark:border-primary-900/30">
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Client Details</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Name</dt>
                        <dd class="font-medium">{{ $testimonial->name }}</dd>
                    </div>
                    @if ($testimonial->designation)
                        <div class="flex justify-between">
                            <dt class="text-slate-500 dark:text-slate-400">Designation</dt>
                            <dd class="font-medium">{{ $testimonial->designation }}</dd>
                        </div>
                    @endif
                    @if ($testimonial->company)
                        <div class="flex justify-between">
                            <dt class="text-slate-500 dark:text-slate-400">Company</dt>
                            <dd class="font-medium">{{ $testimonial->company }}</dd>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Rating</dt>
                        <dd class="font-medium">{{ $testimonial->rating }}/5</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Visibility</dt>
                        <dd class="font-medium">{{ $testimonial->is_visible ? 'Visible' : 'Hidden' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Sort Order</dt>
                        <dd class="font-medium">{{ $testimonial->sort_order ?? 0 }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Timestamps</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Created</dt>
                        <dd class="font-medium">{{ $testimonial->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Updated</dt>
                        <dd class="font-medium">{{ $testimonial->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection