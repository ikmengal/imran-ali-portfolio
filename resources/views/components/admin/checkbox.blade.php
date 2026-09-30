@props(['label', 'name', 'value' => true, 'checked' => false, 'error' => null, 'help' => null, 'inline' => false, 'class' => ''])

<div class="mb-3 {{ $inline ? 'form-check form-check-inline' : 'form-check' }}">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        class="form-check-input {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        {{ old($name, $checked) ? 'checked' : '' }}
    >
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    @if ($error)
        <div class="invalid-feedback d-block">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>