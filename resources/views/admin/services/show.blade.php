@extends('admin.layouts.app')

@section('title', 'Service: ' . $service->title)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $service->title }}</h2>
            <p class="text-muted mb-0">Service Details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-admin.card title="Service Info">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Icon</th>
                            <td>
                                @if ($service->icon)
                                    <i class="bx {{ $service->icon }} fs-2"></i>
                                    <code class="ms-2">{{ $service->icon }}</code>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Order</th>
                            <td>{{ $service->sort_order ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($service->is_visible)
                                    <span class="badge bg-label-success">Visible</span>
                                @else
                                    <span class="badge bg-label-secondary">Hidden</span>
                                @endif
                                @if ($service->is_featured)
                                    <span class="badge bg-label-warning ms-1">Featured</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Created By</th>
                            <td>{{ $service->user->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created At</th>
                            <td>{{ $service->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>
        </div>

        <div class="col-md-6">
            <x-admin.card title="Description">
                <p>{{ $service->description }}</p>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection