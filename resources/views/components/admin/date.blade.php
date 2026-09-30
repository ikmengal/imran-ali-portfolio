@props(['label', 'name', 'value' => null, 'required' => false, 'error' => null, 'help' => null, 'class' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '<span class="text-danger">*</span>' : '' }}</label>
    <input
        type="date"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
    >
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>