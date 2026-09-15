<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Skill;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SkillController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $skills = Skill::ordered();
            return DataTables::of($skills)
                ->addColumn('name', function ($skill) {
                    $icon = '';
                    if ($skill->icon) {
                        $icon = '<i class="bx ' . e($skill->icon) . ' me-2 fs-4"></i>';
                    }
                    return '<div class="d-flex align-items-center">
                        ' . $icon . '
                        <div>
                            <h6 class="mb-0">' . e($skill->name) . '</h6>
                            <small class="text-muted">' . e($skill->category) . '</small>
                        </div>
                    </div>';
                })
                ->addColumn('percentage', function ($skill) {
                    if ($skill->percentage !== null) {
                        return '<div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: ' . $skill->percentage . '%" aria-valuenow="' . $skill->percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-muted small">' . $skill->percentage . '%</span>
                        </div>';
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('status', function ($skill) {
                    $badges = [];
                    if ($skill->is_visible) {
                        $badges[] = '<span class="badge bg-label-success me-1">Visible</span>';
                    } else {
                        $badges[] = '<span class="badge bg-label-secondary me-1">Hidden</span>';
                    }
                    if ($skill->is_featured) {
                        $badges[] = '<span class="badge bg-label-warning">Featured</span>';
                    }
                    return '<div class="d-flex flex-wrap">' . implode('', $badges) . '</div>';
                })
                ->addColumn('sort_order', function ($skill) {
                    return $skill->sort_order ?? 0;
                })
                ->addColumn('actions', function ($skill) {
                    return '<div class="d-flex justify-content-end gap-2">
                        <a href="' . route('admin.skills.edit', $skill) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>
                        <form method="POST" action="' . route('admin.skills.destroy', $skill) . '" onsubmit="return confirm(\'Are you sure you want to delete this skill?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>';
                })
                ->rawColumns(['name', 'percentage', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.skills.index');
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'percentage' => 'nullable|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);
        $validated['user_id'] = auth()->id();

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        return view('admin.skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'percentage' => 'nullable|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}