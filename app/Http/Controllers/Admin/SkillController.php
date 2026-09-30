<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SkillController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Skill::with('user:id,name')->ordered();
            $query = $this->scopeRecords($query);

            return DataTables::of($query)
                ->addColumn('name', function ($skill) {
                    $icon = '';
                    if ($skill->icon) {
                        $icon = '<i class="bx '.e($skill->icon).' me-2 fs-4"></i>';
                    }

                    return '<div class="d-flex align-items-center">
                        '.$icon.'
                        <div>
                            <h6 class="mb-0">'.e($skill->name).'</h6>
                            <small class="text-muted">'.e($skill->category).'</small>
                        </div>
                    </div>';
                })
                ->addColumn('percentage', function ($skill) {
                    if ($skill->percentage !== null) {
                        return '<div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: '.$skill->percentage.'%" aria-valuenow="'.$skill->percentage.'" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-muted small">'.$skill->percentage.'%</span>
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

                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('sort_order', function ($skill) {
                    return $skill->sort_order ?? 0;
                })
                ->addColumn('actions', function ($skill) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';

                    if (auth()->user()->can('skills-show')) {
                        $actions .= '<a href="'.route('admin.skills.show', $skill).'" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="bx bx-show"></i></a>';
                    }

                    if (auth()->user()->can('skills-edit')) {
                        $actions .= '<a href="'.route('admin.skills.edit', $skill).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>';
                    }

                    if (auth()->user()->can('skills-delete')) {
                        $actions .= '<form method="POST" action="'.route('admin.skills.destroy', $skill).'" onsubmit="return confirm(\'Are you sure you want to delete this skill?\')" class="d-inline">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['name', 'percentage', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.skills.index');
    }

    public function create()
    {
        $this->authorize('create', Skill::class);

        return view('admin.skills.create');
    }

    public function store(SkillRequest $request)
    {
        $this->authorize('create', Skill::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        $this->authorize('view', $skill);
        $skill->load('user');

        return view('admin.skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        $this->authorize('update', $skill);

        return view('admin.skills.edit', compact('skill'));
    }

    public function update(SkillRequest $request, Skill $skill)
    {
        $this->authorize('update', $skill);

        $validated = $request->validated();
        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $this->authorize('delete', $skill);
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }

    public function toggleStatus(Request $request, Skill $skill)
    {
        $this->authorize('toggleStatus', $skill);

        $field = $request->get('field');
        if (in_array($field, ['is_visible', 'is_featured'])) {
            $skill->update([$field => ! $skill->$field]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field.'], 400);
    }
}
