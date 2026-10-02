@extends('admin.layouts.app')

@section('title', 'Edit Page: {{ $page->title }}')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Edit Page: {{ $page->title }}</h2>
                <p class="text-muted mb-0">Update page content</p>
            </div>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Pages
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Page Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ $page->title }}" required>
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="slug" value="{{ $page->slug }}" required>
                        <small class="text-muted">URL-friendly version of title</small>
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div>

                    <!-- Banner Image Section -->
                    <div class="col-12">
                        <label class="form-label">Banner Image</label>
                        <div class="row g-3">
                            <div class="col-md-8">
                                @if($page->banner_image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Banner</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('storage/pages/' . $page->banner_image) }}" alt="{{ $page->banner_alt ?? $page->title }}" class="rounded" style="max-height: 100px;">
                                            <div class="flex-grow-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_banner" id="remove_banner" value="1">
                                                    <label class="form-check-label text-danger" for="remove_banner">Remove current banner</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="banner_image" accept="image/*">
                                <small class="text-muted">Recommended: 1920x600px, JPG/PNG/WebP, Max 5MB</small>
                                <span class="text-danger">{{ $errors->first('banner_image') }}</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Banner Alt Text</label>
                                <input type="text" class="form-control" name="banner_alt" value="{{ $page->banner_alt }}" placeholder="Accessibility description for banner">
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" name="banner_overlay" id="banner_overlay" value="1" {{ $page->banner_overlay ? 'checked' : '' }}>
                                    <label class="form-check-label" for="banner_overlay">Dark Overlay (for better text readability)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">

                    <div class="col-12">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea name="content" id="editor" class="form-control" rows="15" required>{{ $page->content }}</textarea>
                        <span class="text-danger">{{ $errors->first('content') }}</span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{ $page->meta_title }}" placeholder="SEO title (optional)">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3" placeholder="SEO description (optional)">{{ $page->meta_description }}</textarea>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="{{ $page->sort_order }}">
                    </div>

                    <div class="col-md-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" {{ $page->is_visible ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_visible">Visible</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="show_in_footer" id="show_in_footer" value="1" {{ $page->show_in_footer ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_in_footer">Show in Footer</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Page</button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('admin/assets/vendor/libs/ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('editor', {
            height: 400,
        });
    });
</script>
@endpush