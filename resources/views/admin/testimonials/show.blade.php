@extends('admin.layouts.app')

@section('title', 'Testimonial: ' . $testimonial->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $testimonial->name }}</h2>
            <p class="text-muted mb-0">Testimonial Details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <x-admin.card title="Client Image">
                <div class="text-center">
                    @if ($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-fluid rounded-circle" style="max-width: 200px;">
                    @else
                        <div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 200px;">
                            <i class="bx bx-user text-secondary" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                </div>
            </x-admin.card>
        </div>

        <div class="col-md-8">
            <x-admin.card title="Client Info">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Designation</th>
                            <td>{{ $testimonial->designation ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Company</th>
                            <td>{{ $testimonial->company ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Rating</th>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= ($testimonial->rating ?? 5))
                                        <i class="bx bxs-star text-warning"></i>
                                    @else
                                        <i class="bx bx-star text-warning"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Order</th>
                            <td>{{ $testimonial->sort_order ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($testimonial->is_visible)
                                    <span class="badge bg-label-success">Visible</span>
                                @else
                                    <span class="badge bg-label-secondary">Hidden</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Created By</th>
                            <td>{{ $testimonial->user->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created At</th>
                            <td>{{ $testimonial->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>

            <x-admin.card title="Message" class="mt-3">
                <div class="prose">{{ $testimonial->message }}</div>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection