<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('educations-create') || $this->user()->can('educations-edit');
    }

    public function rules(): array
    {
        return [
            'degree' => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'field' => ['nullable', 'string', 'max:255'],
            'start_year' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 10)],
            'end_year' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 10)],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'is_current' => ['boolean'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'degree.required' => 'Degree is required.',
            'institution.required' => 'Institution is required.',
            'end_year.gte' => 'End year must be greater than or equal to start year.',
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
