@extends('admin.layouts.app')

@section('title', 'Edit Skill: ' . $skill->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Skill</h2>
            <p class="text-muted mb-0">{{ $skill->name }}</p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="card" id="create-form">
        @csrf
        @method('PUT')

        <div class="card-body">
            <x-admin.input
                label="Skill Name"
                name="name"
                value="{{ $skill->name }}"
                required
                placeholder="Enter skill name"
                error="{{ $errors->first('name') }}"
            />

            <x-admin.input
                label="Category"
                name="category"
                value="{{ $skill->category }}"
                required
                placeholder="Frontend, Backend, DevOps, Design, etc."
                error="{{ $errors->first('category') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.number
                        label="Proficiency (%)"
                        name="percentage"
                        value="{{ $skill->percentage }}"
                        min="0"
                        max="100"
                        error="{{ $errors->first('percentage') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.input
                        label="Phosphor Icon Class"
                        name="icon"
                        value="{{ $skill->icon }}"
                        placeholder="ph-code, ph-database, ph-server, etc."
                        help="Use Phosphor Icons class names (e.g., ph-fill ph-code)"
                        error="{{ $errors->first('icon') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.number
                        label="Sort Order"
                        name="sort_order"
                        value="{{ $skill->sort_order ?? 0 }}"
                        min="0"
                        error="{{ $errors->first('sort_order') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Featured Skill"
                        name="is_featured"
                        checked="{{ $skill->is_featured }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Visible on Portfolio"
                        name="is_visible"
                        checked="{{ $skill->is_visible }}"
                    />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Update Skill
                </button>
            </div>
        </div>
    </form>
</div>
@endsection