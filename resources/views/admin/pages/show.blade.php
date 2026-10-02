@extends('admin.layouts.app')
@section('title', 'Page: {{ $page->title }}')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">{{ $page->title }}</h2>
                    <p class="text-muted mb-0">Page details</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary">
                        <i class="ti ti-edit me-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Back to Pages
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Preview -->
    @if($page->banner_image)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="relative" style="height: 300px;">
                        <img src="{{ asset('storage/pages/' . $page->banner_image) }}"
                            alt="{{ $page->banner_alt ?? $page->title }}"
                            class="absolute inset-0 w-full h-full object-cover">
                        @if($page->banner_overlay)
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center z-10">
                            <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 max-w-3xl mx-auto text-center">
                                <h3 class="font-space text-2xl font-bold text-slate-900 dark:text-white mb-2">{{ $page->title }}</h3>
                                @if($page->banner_alt)
                                    <p class="text-slate-500 text-sm">Alt: {{ $page->banner_alt }}</p>
                                @endif
                                <span class="inline-flex items-center gap-1 text-xs text-slate-500 mt-2">
                                    <i class="ph-fill ph-image"></i> Banner Preview
                                    @if($page->banner_overlay)
                                        <span class="px-2 py-0.5 text-xs rounded bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300 ml-1">Overlay Enabled</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Page Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Banner Section (if no banner, show placeholder) -->
                    @if(!$page->banner_image)
                    <div class="card mb-4 border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50">
                        <div class="card-body text-center py-8">
                            <i class="ph-fill ph-image text-slate-400 dark:text-slate-500 text-4xl mb-3"></i>
                            <h5 class="font-medium text-slate-600 dark:text-slate-400 mb-1">No Banner Image</h5>
                            <p class="text-slate-500 text-sm mb-3">Upload a banner image (1920x600px recommended) from the edit page to display a hero banner on the frontend.</p>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-primary">
                                <i class="ph-fill ph-upload me-1"></i> Add Banner
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Slug</label>
                            <p class="font-monospace">{{ $page->slug }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Status</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge bg-label-{{ $page->is_visible ? 'success' : 'secondary' }}">
                                    {{ $page->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                                @if($page->show_in_footer)
                                    <span class="badge bg-label-info">Show in Footer</span>
                                @endif
                                @if($page->banner_image)
                                    <span class="badge bg-label-warning">Has Banner</span>
                                @endif
                                @if($page->banner_overlay)
                                    <span class="badge bg-label-primary">Overlay</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Meta Title</label>
                            <p>{{ $page->meta_title ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Meta Description</label>
                            <p>{{ $page->meta_description ?? '—' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Banner Alt Text</label>
                            <p>{{ $page->banner_alt ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Banner Overlay</label>
                            <p>{{ $page->banner_overlay ? 'Enabled' : 'Disabled' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Sort Order</label>
                            <p>{{ $page->sort_order }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted mb-1">Created</label>
                            <p>{{ $page->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="prose prose-slate dark:prose-invert max-w-none">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
