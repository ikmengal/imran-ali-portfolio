@props(['label', 'name', 'value' => null, 'accept' => '*', 'required' => false, 'error' => null, 'help' => null, 'preview' => false, 'previewUrl' => null, 'class' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '<span class="text-danger">*</span>' : '' }}</label>
    <input
        type="file"
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        accept="{{ $accept }}"
    >
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
    @if ($preview && $previewUrl)
        <div class="mt-2">
            <small class="text-muted">Current:</small>
            <div class="d-flex align-items-center gap-2 mt-1">
                @if (str_contains($previewUrl, '.ico') || str_contains($previewUrl, 'favicon'))
                    <img src="{{ $previewUrl }}" alt="Current" class="rounded" style="height: 32px;">
                @else
                    <img src="{{ $previewUrl }}" alt="Current" class="rounded" style="height: 80px; object-fit: cover;">
                @endif
            </div>
        </div>
    @endif
</div>