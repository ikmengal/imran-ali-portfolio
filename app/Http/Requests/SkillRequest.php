<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('skills-create') || $this->user()->can('skills-edit');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'percentage' => ['nullable', 'integer', 'min:0', 'max:100'],
            'icon' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Skill name is required.',
            'category.required' => 'Category is required.',
            'percentage.min' => 'Proficiency must be at least 0%.',
            'percentage.max' => 'Proficiency cannot exceed 100%.',
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
