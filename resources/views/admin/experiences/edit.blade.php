@extends('admin.layouts.app')

@section('title', 'Edit Experience: ' . $experience->job_title)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Experience</h2>
            <p class="text-muted mb-0">{{ $experience->job_title }} at {{ $experience->company }}</p>
        </div>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="card" id="create-form">
        @csrf
        @method('PUT')

        <div class="card-body">
            <x-admin.input
                label="Job Title"
                name="job_title"
                value="{{ $experience->job_title }}"
                required
                placeholder="e.g., Senior Full Stack Developer"
                error="{{ $errors->first('job_title') }}"
            />

            <x-admin.input
                label="Company"
                name="company"
                value="{{ $experience->company }}"
                required
                placeholder="Company name"
                error="{{ $errors->first('company') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.input
                        label="Employment Type"
                        name="employment_type"
                        value="{{ $experience->employment_type }}"
                        placeholder="Full-time, Part-time, Contract, Freelance, Internship"
                        error="{{ $errors->first('employment_type') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.input
                        label="Location"
                        name="location"
                        value="{{ $experience->location }}"
                        placeholder="City, Country or Remote"
                        error="{{ $errors->first('location') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.date
                        label="Start Date"
                        name="start_date"
                        value="{{ $experience->start_date?->format('Y-m-d') }}"
                        required
                        error="{{ $errors->first('start_date') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.date
                        label="End Date"
                        name="end_date"
                        value="{{ $experience->end_date?->format('Y-m-d') }}"
                        error="{{ $errors->first('end_date') }}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-admin.checkbox
                        label="Currently Working Here"
                        name="is_current"
                        checked="{{ $experience->is_current }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.number
                        label="Sort Order"
                        name="sort_order"
                        value="{{ $experience->sort_order ?? 0 }}"
                        min="0"
                        error="{{ $errors->first('sort_order') }}"
                    />
                </div>
            </div>

            <x-admin.checkbox
                label="Visible on Portfolio"
                name="is_visible"
                checked="{{ $experience->is_visible }}"
            />

            <x-admin.textarea
                label="Description"
                name="description"
                value="{{ $experience->description }}"
                placeholder="Describe your responsibilities, achievements, technologies used"
                rows="5"
                error="{{ $errors->first('description') }}"
            />
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Update Experience
                </button>
            </div>
        </div>
    </form>
</div>
@endsection