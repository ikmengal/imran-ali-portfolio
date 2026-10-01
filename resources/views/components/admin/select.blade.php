@props(['label', 'name', 'options' => [], 'value' => null, 'placeholder' => 'Select an option', 'required' => false, 'error' => null, 'help' => null, 'multiple' => false, 'class' => '', 'attributes' => []])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {!! $required ? '<span class="text-danger">*</span>' : '' !!}</label>
    <select
        id="{{ $name }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        class="form-select {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes }}
    >
        <option value="" disabled {{ !$multiple && !old($name, $value) ? 'selected' : '' }}>{{ $placeholder }}</option>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ (is_array(old($name, $value)) ? in_array($key, old($name, $value)) : old($name, $value) == $key) ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>