<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Education;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EducationController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $education = Education::ordered();
            return DataTables::of($education)
                ->addColumn('degree', function ($edu) {
                    return '<div>
                        <h6 class="mb-1">' . e($edu->degree) . '</h6>
                        <small class="text-muted">' . e($edu->institution) . '</small>
                    </div>';
                })
                ->addColumn('field', function ($edu) {
                    if ($edu->field) {
                        return e($edu->field);
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('duration', function ($edu) {
                    $start = $edu->start_year;
                    $end = $edu->is_current ? 'Present' : $edu->end_year;
                    return $start . ' - ' . $end;
                })
                ->addColumn('location', function ($edu) {
                    if ($edu->location) {
                        return e($edu->location);
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('status', function ($edu) {
                    if ($edu->is_visible) {
                        return '<span class="badge bg-label-success">Visible</span>';
                    }
                    return '<span class="badge bg-label-secondary">Hidden</span>';
                })
                ->addColumn('sort_order', function ($edu) {
                    return $edu->sort_order ?? 0;
                })
                ->addColumn('actions', function ($edu) {
                    return '<div class="d-flex justify-content-end gap-2">
                        <a href="' . route('admin.education.edit', $edu) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>
                        <form method="POST" action="' . route('admin.education.destroy', $edu) . '" onsubmit="return confirm(\'Are you sure you want to delete this education record?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>';
                })
                ->rawColumns(['degree', 'field', 'duration', 'location', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.education.index');
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field' => 'nullable|string|max:255',
            'start_year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'end_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:start_year',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'is_current' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        if ($validated['is_current']) {
            $validated['end_year'] = null;
        }

        Education::create($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education record created successfully.');
    }

    public function show(Education $education)
    {
        return view('admin.education.show', compact('education'));
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field' => 'nullable|string|max:255',
            'start_year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'end_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:start_year',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'is_current' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        if ($validated['is_current']) {
            $validated['end_year'] = null;
        }

        $education->update($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education record updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Education record deleted successfully.');
    }
}