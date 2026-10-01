@extends('admin.layouts.app')
@section('title', 'Create Experience')
@section('content')
    <div class="max-2xl mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Create Experience</h2>
                <p class="text-muted mb-0">Add a new work experience</p>
            </div>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-back me-1"></i> Back
            </a>
        </div>

        <form method="POST" action="{{ route('admin.experiences.store') }}" class="card" id="create-form">
            @csrf

            <div class="card-body">
                <x-admin.input
                    label="Job Title"
                    name="job_title"
                    required
                    placeholder="e.g., Senior Full Stack Developer"
                    error="{{ $errors->first('job_title') }}"
                />

                <x-admin.input
                    label="Company"
                    name="company"
                    required
                    placeholder="Company name"
                    error="{{ $errors->first('company') }}"
                />

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input
                            label="Employment Type"
                            name="employment_type"
                            placeholder="Full-time, Part-time, Contract, Freelance, Internship"
                            error="{{ $errors->first('employment_type') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-admin.input
                            label="Location"
                            name="location"
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
                            required
                            error="{{ $errors->first('start_date') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-admin.date
                            label="End Date"
                            name="end_date"
                            error="{{ $errors->first('end_date') }}"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.checkbox
                            label="Currently Working Here"
                            name="is_current"
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

                <x-admin.checkbox
                    label="Visible on Portfolio"
                    name="is_visible"
                    checked="true"
                />

                <x-admin.textarea
                    label="Description"
                    name="description"
                    placeholder="Describe your responsibilities, achievements, technologies used"
                    rows="5"
                    error="{{ $errors->first('description') }}"
                />
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-save me-1"></i> Save Experience
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
