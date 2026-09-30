@props(['label', 'name', 'value' => null, 'type' => 'text', 'placeholder' => '', 'required' => false, 'error' => null, 'help' => null, 'attributes' => [], 'class' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '<span class="text-danger">*</span>' : '' }}</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>