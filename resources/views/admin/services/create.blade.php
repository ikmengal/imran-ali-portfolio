@extends('admin.layouts.app')

@section('title', 'Create Service')

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Create Service</h2>
            <p class="text-muted mb-0">Add a new service</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.services.store') }}" class="card" id="create-form">
        @csrf

        <div class="card-body">
            <x-admin.input
                label="Service Title"
                name="title"
                required
                placeholder="Enter service title"
                error="{{ $errors->first('title') }}"
            />

            <x-admin.input
                label="Icon Class"
                name="icon"
                placeholder="ph-cpu, ph-server, ph-database, ph-code, etc."
                help="Use Phosphor Icons class names"
                error="{{ $errors->first('icon') }}"
            />

            <x-admin.textarea
                label="Description"
                name="description"
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
                        value="0"
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
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Save Service
                </button>
            </div>
        </div>
    </form>
</div>
@endsection