<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('settings-list');
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'white_name' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'white_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:ico,png', 'max:1024'],
            'footer_text' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:500'],
            'social_links' => ['nullable', 'json'],
            'meta_data' => ['nullable', 'json'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Please provide a valid email address.',
            'logo.image' => 'The logo must be a valid image file.',
            'logo.max' => 'The logo size must not exceed 2MB.',
            'white_logo.image' => 'The white logo must be a valid image file.',
            'white_logo.max' => 'The white logo size must not exceed 2MB.',
            'favicon.image' => 'The favicon must be a valid image file.',
            'favicon.max' => 'The favicon size must not exceed 1MB.',
        ];
    }
}
