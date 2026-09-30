@extends('admin.layouts.app')

@section('title', 'Edit Testimonial: ' . $testimonial->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Testimonial</h2>
            <p class="text-muted mb-0">{{ $testimonial->name }}</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="card" id="create-form">
        @csrf
        @method('PUT')

        <div class="card-body">
            <x-admin.input
                label="Client Name"
                name="name"
                value="{{ $testimonial->name }}"
                required
                placeholder="Client full name"
                error="{{ $errors->first('name') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.input
                        label="Designation"
                        name="designation"
                        value="{{ $testimonial->designation }}"
                        placeholder="e.g., CEO, CTO, Founder"
                        error="{{ $errors->first('designation') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.input
                        label="Company"
                        name="company"
                        value="{{ $testimonial->company }}"
                        placeholder="Company name"
                        error="{{ $errors->first('company') }}"
                    />
                </div>
            </div>

            <x-admin.textarea
                label="Message"
                name="message"
                value="{{ $testimonial->message }}"
                required
                placeholder="Client testimonial message"
                rows="5"
                error="{{ $errors->first('message') }}"
            />

            <div class="row">
                <div class="col-md-6">
                    <x-admin.number
                        label="Rating (1-5)"
                        name="rating"
                        value="{{ $testimonial->rating ?? 5 }}"
                        min="1"
                        max="5"
                        error="{{ $errors->first('rating') }}"
                    />
                </div>
                <div class="col-md-6">
                    <x-admin.number
                        label="Sort Order"
                        name="sort_order"
                        value="{{ $testimonial->sort_order ?? 0 }}"
                        min="0"
                        error="{{ $errors->first('sort_order') }}"
                    />
                </div>
            </div>

            <x-admin.checkbox
                label="Visible on Portfolio"
                name="is_visible"
                checked="{{ $testimonial->is_visible }}"
            />

            <x-admin.file
                label="Client Image"
                name="image"
                accept="image/*"
                preview="true"
                previewUrl="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : '' }}"
                error="{{ $errors->first('image') }}"
                help="Recommended: 200x200px, max 2MB"
            />
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Update Testimonial
                </button>
            </div>
        </div>
    </form>
</div>
@endsection