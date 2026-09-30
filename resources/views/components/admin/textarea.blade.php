@props(['label', 'name', 'value' => null, 'placeholder' => '', 'required' => false, 'error' => null, 'help' => null, 'rows' => 4, 'class' => '', 'editor' => false])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '<span class="text-danger">*</span>' : '' }}</label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        @if ($editor) data-editor="true" @endif
    >{{ old($name, $value) }}</textarea>
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>