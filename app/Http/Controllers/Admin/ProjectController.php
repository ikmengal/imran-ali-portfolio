<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Project;
use App\Models\ProjectTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::with('technologies')->ordered();
            return DataTables::of($projects)
                ->addColumn('image', function ($project) {
                    if ($project->image) {
                        return '<img src="' . asset('storage/' . $project->image) . '" alt="" class="img-fluid rounded" style="width: 60px; height: 40px; object-fit: cover;">';
                    }
                    return '<div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;"><i class="bx bx-image text-secondary"></i></div>';
                })
                ->addColumn('title', function ($project) {
                    return '<div>
                        <h6 class="mb-1">' . e($project->title) . '</h6>
                        <small class="text-muted">' . e(Str::limit($project->short_description ?? '', 50)) . '</small>
                    </div>';
                })
                ->addColumn('category', function ($project) {
                    if ($project->category) {
                        return '<span class="badge bg-label-secondary">' . e($project->category) . '</span>';
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('status', function ($project) {
                    $badges = [];
                    if ($project->is_visible) {
                        $badges[] = '<span class="badge bg-label-success me-1">Visible</span>';
                    } else {
                        $badges[] = '<span class="badge bg-label-secondary me-1">Hidden</span>';
                    }
                    if ($project->is_featured) {
                        $badges[] = '<span class="badge bg-label-warning">Featured</span>';
                    }
                    return '<div class="d-flex flex-wrap">' . implode('', $badges) . '</div>';
                })
                ->addColumn('technologies', function ($project) {
                    if ($project->technologies->isEmpty()) {
                        return '<span class="text-muted">—</span>';
                    }
                    $tags = [];
                    foreach ($project->technologies as $tech) {
                        $tags[] = '<span class="badge bg-label-primary me-1">' . e($tech->name) . '</span>';
                    }
                    return '<div class="d-flex flex-wrap">' . implode('', $tags) . '</div>';
                })
                ->addColumn('sort_order', function ($project) {
                    return $project->sort_order ?? 0;
                })
                ->addColumn('actions', function ($project) {
                    return '<div class="d-flex justify-content-end gap-2">
                        <a href="' . route('admin.projects.edit', $project) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>
                        <form method="POST" action="' . route('admin.projects.destroy', $project) . '" onsubmit="return confirm(\'Are you sure you want to delete this project?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>';
                })
                ->rawColumns(['image', 'title', 'category', 'status', 'technologies', 'actions'])
                ->make(true);
        }

        return view('admin.projects.index');
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
            'technologies' => 'nullable|array',
            'technologies.*.name' => 'required_with:technologies|string|max:100',
            'technologies.*.sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        $project = Project::create($validated);

        if ($request->has('technologies')) {
            foreach ($request->technologies as $index => $tech) {
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'name' => $tech['name'],
                    'sort_order' => $tech['sort_order'] ?? $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load('technologies');
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load('technologies');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
            'technologies' => 'nullable|array',
            'technologies.*.name' => 'required_with:technologies|string|max:100',
            'technologies.*.sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                \Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        $project->update($validated);

        $project->technologies()->delete();
        if ($request->has('technologies')) {
            foreach ($request->technologies as $index => $tech) {
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'name' => $tech['name'],
                    'sort_order' => $tech['sort_order'] ?? $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            \Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}