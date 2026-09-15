<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Experience;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $experiences = Experience::ordered();
            return DataTables::of($experiences)
                ->addColumn('title', function ($experience) {
                    return '<div>
                        <h6 class="mb-1">' . e($experience->job_title) . '</h6>
                        <small class="text-muted">' . e($experience->company) . '</small>
                    </div>';
                })
                ->addColumn('type', function ($experience) {
                    if ($experience->employment_type) {
                        return '<span class="badge bg-label-info">' . e($experience->employment_type) . '</span>';
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('location', function ($experience) {
                    if ($experience->location) {
                        return e($experience->location);
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('duration', function ($experience) {
                    $start = $experience->start_date->format('M Y');
                    $end = $experience->is_current ? 'Present' : $experience->end_date->format('M Y');
                    return $start . ' - ' . $end;
                })
                ->addColumn('status', function ($experience) {
                    if ($experience->is_visible) {
                        return '<span class="badge bg-label-success">Visible</span>';
                    }
                    return '<span class="badge bg-label-secondary">Hidden</span>';
                })
                ->addColumn('sort_order', function ($experience) {
                    return $experience->sort_order ?? 0;
                })
                ->addColumn('actions', function ($experience) {
                    return '<div class="d-flex justify-content-end gap-2">
                        <a href="' . route('admin.experiences.edit', $experience) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>
                        <form method="POST" action="' . route('admin.experiences.destroy', $experience) . '" onsubmit="return confirm(\'Are you sure you want to delete this experience?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>';
                })
                ->rawColumns(['title', 'type', 'location', 'duration', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.experiences.index');
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible', true);
        $validated['user_id'] = auth()->id();

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience created successfully.');
    }

    public function show(Experience $experience)
    {
        return view('admin.experiences.show', compact('experience'));
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted successfully.');
    }
}