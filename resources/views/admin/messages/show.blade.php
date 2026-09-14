@extends('admin.layouts.app')

@section('title', 'Message from ' . $message->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Message Details</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">From {{ $message->name }} ({{ $message->email }})</p>
        </div>
        <div class="flex items-center gap-2">
            @if (is_null($message->read_at))
                <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                        <i class="ph ph-envelope-open text-sm"></i>
                        Mark as Read
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.messages.unread', $message) }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors flex items-center gap-2">
                        <i class="ph ph-envelope text-sm"></i>
                        Mark as Unread
                    </button>
                </form>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                <i class="ph ph-arrow-left text-sm"></i>
                Back
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Message</h3>
                <div class="prose dark:prose-invert max-w-none whitespace-pre-wrap">
                    {{ $message->message }}
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Sender Info</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Name</dt>
                        <dd class="font-medium">{{ $message->name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Email</dt>
                        <dd class="font-medium"><a href="mailto:{{ $message->email }}" class="text-primary-600 dark:text-primary-400 hover:underline">{{ $message->email }}</a></dd>
                    </div>
                    @if ($message->subject)
                        <div class="flex justify-between">
                            <dt class="text-slate-500 dark:text-slate-400">Subject</dt>
                            <dd class="font-medium">{{ $message->subject }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Status</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Status</dt>
                        <dd class="font-medium">
                            @if (is_null($message->read_at))
                                <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded-full">Unread</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full">Read</span>
                            @endif
                        </dd>
                    </div>
                    @if ($message->read_at)
                        <div class="flex justify-between">
                            <dt class="text-slate-500 dark:text-slate-400">Read At</dt>
                            <dd class="font-medium">{{ $message->read_at->format('M d, Y H:i') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Timestamps</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Received</dt>
                        <dd class="font-medium">{{ $message->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Updated</dt>
                        <dd class="font-medium">{{ $message->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection