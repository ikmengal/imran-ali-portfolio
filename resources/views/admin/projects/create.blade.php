@extends('admin.layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="max-4xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Create Project</h2>
            <p class="text-muted mb-0">Add a new portfolio project</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="card" id="create-form">
        @csrf

        <div class="card-header">
            <h4 class="card-title mb-0">Project Information</h4>
        </div>
        <div class="card-body">
            <x-admin.input
                label="Title"
                name="title"
                required
                placeholder="Enter project title"
                error="{{ $errors->first('title') }}"
            />

            <x-admin.input
                label="Slug"
                name="slug"
                placeholder="Auto-generated from title"
                help="Leave empty to auto-generate from title"
                error="{{ $errors->first('slug') }}"
            />

            <x-admin.textarea
                label="Short Description"
                name="short_description"
                placeholder="Brief description for cards and listings"
                rows="2"
                error="{{ $errors->first('short_description') }}"
            />

            <x-admin.textarea
                label="Full Description"
                name="description"
                placeholder="Detailed project description"
                rows="6"
                editor
                error="{{ $errors->first('description') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.input
                        label="GitHub URL"
                        name="github_url"
                        type="url"
                        placeholder="https://github.com/username/repo"
                        error="{{ $errors->first('github_url') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.input
                        label="Live URL"
                        name="live_url"
                        type="url"
                        placeholder="https://project-demo.com"
                        error="{{ $errors->first('live_url') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.input
                        label="Category"
                        name="category"
                        placeholder="Web App, Mobile App, API, etc."
                        error="{{ $errors->first('category') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.number
                        label="Sort Order"
                        name="sort_order"
                        value="0"
                        min="0"
                        error="{{ $errors->first('sort_order') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Featured Project"
                        name="is_featured"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Visible on Portfolio"
                        name="is_visible"
                        checked="true"
                    />
                </div>
            </div>

            <x-admin.file
                label="Project Image"
                name="image"
                accept="image/*"
                preview="true"
                error="{{ $errors->first('image') }}"
                help="Recommended: 800x600px, max 2MB"
            />
        </div>

        <div class="card-header">
            <h4 class="card-title mb-0">Technologies</h4>
        </div>
        <div class="card-body">
            <div id="technologies-container">
                <div class="technology-row row g-2 mb-2">
                    <div class="col-md-8">
                        <input type="text" name="technologies[0][name]" class="form-control" placeholder="Technology name (e.g., Laravel, Vue.js, PostgreSQL)">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="technologies[0][sort_order]" class="form-control" placeholder="Order" value="0" min="0">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger remove-tech" style="display:none;"><i class="bx bx-trash"></i></button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-technology" class="btn btn-outline-primary btn-sm">
                <i class="bx bx-plus me-1"></i> Add Technology
            </button>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Create Project
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        let techIndex = 1;

        $('#add-technology').click(function() {
            const html = `
                <div class="technology-row row g-2 mb-2">
                    <div class="col-md-8">
                        <input type="text" name="technologies[${techIndex}][name]" class="form-control" placeholder="Technology name">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="technologies[${techIndex}][sort_order]" class="form-control" placeholder="Order" value="${techIndex}" min="0">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger remove-tech"><i class="bx bx-trash"></i></button>
                    </div>
                </div>
            `;
            $('#technologies-container').append(html);
            techIndex++;
            updateRemoveButtons();
        });

        $(document).on('click', '.remove-tech', function() {
            $(this).closest('.technology-row').remove();
            updateRemoveButtons();
        });

        function updateRemoveButtons() {
            const rows = $('.technology-row');
            rows.each(function(index) {
                $(this).find('input[name^="technologies"]').each(function() {
                    const name = $(this).attr('name').replace(/technologies\[\d+\]/, `technologies[${index}]`);
                    $(this).attr('name', name);
                });
                $(this).find('.remove-tech').toggle(rows.length > 1);
            });
        }

        updateRemoveButtons();

        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('description');
        }
    });
</script>
@endpush
