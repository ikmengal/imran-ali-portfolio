@extends('admin.layouts.app')
@section('title', 'Experience: ' . $experience->job_title)
@section('content')
    <div class="max-2xl mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">{{ $experience->job_title }}</h2>
                <p class="text-muted mb-0">{{ $experience->company }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-back me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-admin.card title="Experience Details">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 150px;">Company</th>
                                <td>{{ $experience->company }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Employment Type</th>
                                <td>{{ $experience->employment_type ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Location</th>
                                <td>{{ $experience->location ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Duration</th>
                                <td>
                                    {{ $experience->start_date?->format('M Y') }} -
                                    {{ $experience->is_current ? 'Present' : ($experience->end_date?->format('M Y') ?? '—') }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Current Position</th>
                                <td>{{ $experience->is_current ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sort Order</th>
                                <td>{{ $experience->sort_order ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                    @if ($experience->is_visible)
                                        <span class="badge bg-label-success">Visible</span>
                                    @else
                                        <span class="badge bg-label-secondary">Hidden</span>
                                    @endif
                                    @if ($experience->is_current)
                                        <span class="badge bg-label-primary ms-1">Current</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Created By</th>
                                <td>{{ $experience->user->name ?? 'Unknown' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>{{ $experience->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </x-admin.card>
            </div>

            <div class="col-md-6">
                <x-admin.card title="Description">
                    <p>{{ $experience->description ?? 'No description provided.' }}</p>
                </x-admin.card>
            </div>
        </div>
    </div>
@endsection
