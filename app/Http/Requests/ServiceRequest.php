<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('services-create') || $this->user()->can('services-edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Service title is required.',
            'description.required' => 'Service description is required.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_visible' => $this->boolean('is_visible', true),
            'sort_order' => $this->integer('sort_order', 0),
            'user_id' => auth()->id(),
        ]);
    }
}
