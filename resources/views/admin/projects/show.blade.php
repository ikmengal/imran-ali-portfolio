@extends('admin.layouts.app')

@section('title', 'Project: ' . $project->title)

@section('content')
<div class="max-4xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $project->title }}</h2>
            <p class="text-muted mb-0">Project Details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <x-admin.card title="Project Image">
                <div class="text-center">
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid rounded">
                    @else
                        <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="bx bx-image text-secondary" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                </div>
            </x-admin.card>

            <x-admin.card title="Links" class="mt-3">
                <div class="d-flex flex-column gap-2">
                    @if ($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-dark">
                            <i class="bx bxl-github me-2"></i> View on GitHub
                        </a>
                    @endif
                    @if ($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bx bx-link-external me-2"></i> Live Demo
                        </a>
                    @endif
                </div>
            </x-admin.card>
        </div>

        <div class="col-md-8">
            <x-admin.card title="Description">
                <div class="prose">{{ $project->description }}</div>
            </x-admin.card>

            <x-admin.card title="Short Description" class="mt-3">
                <p>{{ $project->short_description ?? '—' }}</p>
            </x-admin.card>

            <x-admin.card title="Technologies" class="mt-3">
                @if ($project->technologies->isEmpty())
                    <p class="text-muted">No technologies added</p>
                @else
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($project->technologies as $tech)
                            <span class="badge bg-primary">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                @endif
            </x-admin.card>

            <x-admin.card title="Metadata" class="mt-3">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Category</th>
                            <td>{{ $project->category ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Order</th>
                            <td>{{ $project->sort_order ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($project->is_visible)
                                    <span class="badge bg-label-success">Visible</span>
                                @else
                                    <span class="badge bg-label-secondary">Hidden</span>
                                @endif
                                @if ($project->is_featured)
                                    <span class="badge bg-label-warning ms-1">Featured</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Created By</th>
                            <td>{{ $project->user->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created At</th>
                            <td>{{ $project->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Updated At</th>
                            <td>{{ $project->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection