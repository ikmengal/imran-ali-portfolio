@extends('admin.layouts.app')

@section('title', 'Education: ' . $education->degree)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $education->degree }}</h2>
            <p class="text-muted mb-0">{{ $education->institution }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.education.edit', $education) }}" class="btn btn-primary">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-admin.card title="Education Details">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Institution</th>
                            <td>{{ $education->institution }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Field of Study</th>
                            <td>{{ $education->field ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Location</th>
                            <td>{{ $education->location ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Duration</th>
                            <td>
                                {{ $education->start_year ?? '—' }} - 
                                {{ $education->is_current ? 'Present' : ($education->end_year ?? '—') }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Currently Studying</th>
                            <td>{{ $education->is_current ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Order</th>
                            <td>{{ $education->sort_order ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($education->is_visible)
                                    <span class="badge bg-label-success">Visible</span>
                                @else
                                    <span class="badge bg-label-secondary">Hidden</span>
                                @endif
                                @if ($education->is_current)
                                    <span class="badge bg-label-primary ms-1">Current</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Created By</th>
                            <td>{{ $education->user->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created At</th>
                            <td>{{ $education->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>
        </div>

        <div class="col-md-6">
            <x-admin.card title="Description">
                <p>{{ $education->description ?? 'No description provided.' }}</p>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection