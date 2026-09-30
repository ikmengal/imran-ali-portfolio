@extends('admin.layouts.app')

@section('title', 'Skill: ' . $skill->name)

@section('content')
<div class="max-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $skill->name }}</h2>
            <p class="text-muted mb-0">Skill Details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-primary">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-admin.card title="Skill Info">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Category</th>
                            <td>{{ $skill->category }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Proficiency</th>
                            <td>
                                @if ($skill->percentage !== null)
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $skill->percentage }}%"></div>
                                        </div>
                                        <span>{{ $skill->percentage }}%</span>
                                    </div>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Icon</th>
                            <td>
                                @if ($skill->icon)
                                    <i class="bx {{ $skill->icon }} fs-2"></i>
                                    <code class="ms-2">{{ $skill->icon }}</code>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Order</th>
                            <td>{{ $skill->sort_order ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($skill->is_visible)
                                    <span class="badge bg-label-success">Visible</span>
                                @else
                                    <span class="badge bg-label-secondary">Hidden</span>
                                @endif
                                @if ($skill->is_featured)
                                    <span class="badge bg-label-warning ms-1">Featured</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Created By</th>
                            <td>{{ $skill->user->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created At</th>
                            <td>{{ $skill->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection