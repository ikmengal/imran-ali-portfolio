<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends AdminController
{
    public function index(Request $request)
    {
        $filters = $this->getFilters(Project::class);
        $categories = Project::query()->select('category')->distinct()->pluck('category')->filter()->values();

        if ($request->ajax()) {
            $query = Project::with('technologies')
                ->with('user:id,name')
                ->ordered();
            $query = $this->scopeRecords($query);
            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', function ($project) {
                    if ($project->image) {
                        return '<img src="'.asset('storage/'.$project->image).'" alt="" class="img-fluid rounded" style="width: 60px; height: 40px; object-fit: cover;">';
                    }
                    return '<div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;"><i class="bx bx-image text-secondary"></i></div>';
                })
                ->addColumn('title', function ($project) {
                    return '<div>
                        <h6 class="mb-1">'.e($project->title).'</h6>
                        <small class="text-muted">'.e(Str::limit($project->short_description ?? '', 50)).'</small>
                    </div>';
                })
                ->addColumn('category', function ($project) {
                    if ($project->category) {
                        return '<span class="badge bg-label-secondary">'.e($project->category).'</span>';
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

                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('actions', function ($project) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';

                    if (auth()->user()->can('projects-show')) {
                        $actions .= '<a href="'.route('admin.projects.show', $project).'" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="ti ti-eye"></i></a>';
                    }

                    if (auth()->user()->can('projects-edit')) {
                        $actions .= '<a href="'.route('admin.projects.edit', $project).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="ti ti-edit"></i></a>';
                    }

                    if (auth()->user()->can('projects-delete')) {
                        $actions .= '<a href="javascript:;" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete"
                            data-del-url="'.route('admin.projects.destroy', $project->id).'">
                            <i class="ti ti-trash"></i>
                        </a>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['image', 'title', 'category', 'status', 'actions'])
            ->make(true);
        }
        return view('admin.projects.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Project::class);
        return view('admin.projects.create');
    }

    public function store(ProjectRequest $request)
    {
        $this->authorize('create', Project::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();

        $project = Project::create($validated);

        if ($request->has('technologies')) {
            foreach ($request->technologies as $index => $tech) {
                if (! empty($tech['name'])) {
                    ProjectTechnology::create([
                        'project_id' => $project->id,
                        'user_id' => auth()->id(),
                        'name' => $tech['name'],
                        'sort_order' => $tech['sort_order'] ?? $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $project->load('technologies', 'user');

        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        $project->load('technologies');

        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);

        $project->update($validated);

        $project->technologies()->delete();
        if ($request->has('technologies')) {
            foreach ($request->technologies as $index => $tech) {
                if (! empty($tech['name'])) {
                    ProjectTechnology::create([
                        'project_id' => $project->id,
                        'user_id' => auth()->id(),
                        'name' => $tech['name'],
                        'sort_order' => $tech['sort_order'] ?? $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return response()->json(['success' => true, 'message' => 'Project deleted successfully.']);
    }

    public function toggleStatus(Request $request, Project $project)
    {
        $this->authorize('toggleStatus', $project);

        $field = $request->get('field');
        if (in_array($field, ['is_visible', 'is_featured'])) {
            $project->update([$field => ! $project->$field]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field.'], 400);
    }
}
