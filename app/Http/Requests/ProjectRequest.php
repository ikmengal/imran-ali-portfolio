<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('projects-create') || $this->user()->can('projects-edit');
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id;

        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('projects', 'title')->ignore($projectId)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($projectId)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'technologies' => ['nullable', 'array'],
            'technologies.*.name' => ['required_with:technologies', 'string', 'max:100'],
            'technologies.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Project title is required.',
            'title.unique' => 'A project with this title already exists.',
            'slug.unique' => 'A project with this slug already exists.',
            'image.image' => 'The image must be a valid image file.',
            'image.max' => 'The image size must not exceed 2MB.',
            'github_url.url' => 'Please provide a valid GitHub URL.',
            'live_url.url' => 'Please provide a valid live URL.',
            'technologies.*.name.required_with' => 'Technology name is required.',
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
