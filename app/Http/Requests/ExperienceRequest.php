<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('experiences-create') || $this->user()->can('experiences-edit');
    }

    public function rules(): array
    {
        return [
            'job_title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current' => ['boolean'],
            'description' => ['nullable', 'string'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'job_title.required' => 'Job title is required.',
            'company.required' => 'Company name is required.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_current' => $this->boolean('is_current'),
            'is_visible' => $this->boolean('is_visible', true),
            'sort_order' => $this->integer('sort_order', 0),
            'user_id' => auth()->id(),
        ]);
    }
}
