@extends('admin.layouts.app')

@section('title', 'User: ' . $user->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $user->email }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                <i class="ph ph-pencil text-sm"></i>
                Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center gap-2">
                <i class="ph ph-arrow-left text-sm"></i>
                Back
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Bio</h3>
                <p class="prose dark:prose-invert max-w-none">{{ $user->bio ?? 'No bio provided.' }}</p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6 flex items-center justify-center">
                @if ($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover">
                @else
                    <div class="w-24 h-24 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                        <span class="text-primary-600 dark:text-primary-400 text-3xl font-bold">{{ strtoupper($user->name[0]) }}</span>
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Details</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Email</dt>
                        <dd class="font-medium"><a href="mailto:{{ $user->email }}" class="text-primary-600 dark:text-primary-400 hover:underline">{{ $user->email }}</a></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Roles</dt>
                        <dd class="font-medium">
                            @foreach ($user->getRoleNames() as $role)
                                <span class="px-2 py-0.5 text-xs bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded mr-1">{{ $role }}</span>
                            @endforeach
                            @if ($user->getRoleNames()->isEmpty())
                                <span class="text-slate-400 dark:text-slate-500">No roles</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Email Verified</dt>
                        <dd class="font-medium">{{ $user->email_verified_at ? 'Yes' : 'No' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Timestamps</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Created</dt>
                        <dd class="font-medium">{{ $user->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Updated</dt>
                        <dd class="font-medium">{{ $user->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                    @if ($user->email_verified_at)
                        <div class="flex justify-between">
                            <dt class="text-slate-500 dark:text-slate-400">Email Verified At</dt>
                            <dd class="font-medium">{{ $user->email_verified_at->format('M d, Y H:i') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection