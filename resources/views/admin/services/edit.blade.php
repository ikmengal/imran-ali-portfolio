@extends('admin.layouts.app')

@section('title', 'Edit Service: ' . $service->title)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Service</h2>
            <p class="text-muted mb-0">{{ $service->title }}</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.services.update', $service) }}" class="card" id="create-form">
        @csrf
        @method('PUT')

        <div class="card-body">
            <x-admin.input
                label="Service Title"
                name="title"
                value="{{ $service->title }}"
                required
                placeholder="Enter service title"
                error="{{ $errors->first('title') }}"
            />

            <x-admin.input
                label="Icon Class"
                name="icon"
                value="{{ $service->icon }}"
                placeholder="ph-cpu, ph-server, ph-database, ph-code, etc."
                help="Use Phosphor Icons class names"
                error="{{ $errors->first('icon') }}"
            />

            <x-admin.textarea
                label="Description"
                name="description"
                value="{{ $service->description }}"
                required
                placeholder="Describe the service"
                rows="5"
                error="{{ $errors->first('description') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.number
                        label="Sort Order"
                        name="sort_order"
                        value="{{ $service->sort_order ?? 0 }}"
                        min="0"
                        error="{{ $errors->first('sort_order') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Featured Service"
                        name="is_featured"
                        checked="{{ $service->is_featured }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Visible on Portfolio"
                        name="is_visible"
                        checked="{{ $service->is_visible }}"
                    />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Update Service
                </button>
            </div>
        </div>
    </form>
</div>
@endsection