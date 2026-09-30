@props(['label', 'name', 'value' => null, 'min' => null, 'max' => null, 'step' => 1, 'required' => false, 'error' => null, 'help' => null, 'placeholder' => '', 'class' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '<span class="text-danger">*</span>' : '' }}</label>
    <input
        type="number"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        placeholder="{{ $placeholder }}"
        @if ($min !== null) min="{{ $min }}" @endif
        @if ($max !== null) max="{{ $max }}" @endif
        @if ($step !== null) step="{{ $step }}" @endif
    >
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>