@extends('admin.layouts.app')
@section('title', 'Edit Education: ' . $education->degree)
@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Education</h2>
            <p class="text-muted mb-0">{{ $education->degree }} at {{ $education->institution }}</p>
        </div>
        <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.education.update', $education) }}" class="card" id="create-form">
        @csrf
        @method('PUT')

        <div class="card-body">
            <x-admin.input
                label="Degree"
                name="degree"
                value="{{ $education->degree }}"
                required
                placeholder="e.g., Bachelor of Science in Computer Science"
                error="{{ $errors->first('degree') }}"
            />

            <x-admin.input
                label="Institution"
                name="institution"
                value="{{ $education->institution }}"
                required
                placeholder="University or school name"
                error="{{ $errors->first('institution') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.input
                        label="Field of Study"
                        name="field"
                        value="{{ $education->field }}"
                        placeholder="Computer Science, Engineering, etc."
                        error="{{ $errors->first('field') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.input
                        label="Location"
                        name="location"
                        value="{{ $education->location }}"
                        placeholder="City, Country"
                        error="{{ $errors->first('location') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.number
                        label="Start Year"
                        name="start_year"
                        value="{{ $education->start_year }}"
                        min="1900"
                        max="{{ date('Y') + 10 }}"
                        error="{{ $errors->first('start_year') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.number
                        label="End Year"
                        name="end_year"
                        value="{{ $education->end_year }}"
                        min="1900"
                        max="{{ date('Y') + 10 }}"
                        error="{{ $errors->first('end_year') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Currently Studying"
                        name="is_current"
                        checked="{{ $education->is_current }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.number
                        label="Sort Order"
                        name="sort_order"
                        value="{{ $education->sort_order ?? 0 }}"
                        min="0"
                        error="{{ $errors->first('sort_order') }}"
                    />
                </div>
            </div>

            <x-admin.checkbox
                label="Visible on Portfolio"
                name="is_visible"
                checked="{{ $education->is_visible }}"
            />

            <x-admin.textarea
                label="Description"
                name="description"
                value="{{ $education->description }}"
                placeholder="Additional details about the program, achievements, etc."
                rows="4"
                error="{{ $errors->first('description') }}"
            />
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-save me-1"></i> Update Education
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
