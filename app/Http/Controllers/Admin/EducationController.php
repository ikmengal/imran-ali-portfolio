<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EducationController extends AdminController
{
public function index(Request $request)
    {
        $filters = $this->getFilters(Education::class);

        if ($request->ajax()) {
            $query = Education::with('user:id,name')->ordered();
            $query = $this->scopeRecords($query);
            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('degree', function ($education) {
                    return '<div>
                        <h6 class="mb-1">'.e($education->degree).'</h6>
                        <small class="text-muted">'.e($education->institution).'</small>
                    </div>';
                })
                ->addColumn('field', function ($education) {
                    if ($education->field) {
                        return '<span class="text-muted">'.e($education->field).'</span>';
                    }

                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('duration', function ($education) {
                    $start = $education->start_year ?? '—';
                    $end = $education->is_current ? 'Present' : ($education->end_year ?? '—');

                    return '<small>'.$start.' - '.$end.'</small>';
                })
                ->addColumn('location', function ($education) {
                    if ($education->location) {
                        return '<small class="text-muted">'.e($education->location).'</small>';
                    }
                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('status', function ($education) {
                    $badges = [];
                    if ($education->is_visible) {
                        $badges[] = '<span class="badge bg-label-success me-1">Visible</span>';
                    } else {
                        $badges[] = '<span class="badge bg-label-secondary me-1">Hidden</span>';
                    }
                    if ($education->is_current) {
                        $badges[] = '<span class="badge bg-label-primary">Current</span>';
                    }

                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('actions', function ($education) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                    if (auth()->user()->can('educations-show')) {
                        $actions .= '<a href="'.route('admin.education.show', $education).'" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="ti ti-eye"></i></a>';
                    }

                    if (auth()->user()->can('educations-edit')) {
                        $actions .= '<a href="'.route('admin.education.edit', $education).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="ti ti-edit"></i></a>';
                    }

                    if (auth()->user()->can('educations-delete')) {
                        $actions .= '<button data-del-url="'.route('admin.education.destroy', $education).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete">
                            <i class="ti ti-trash"></i>
                        </button>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['degree', 'field', 'duration', 'location', 'status', 'actions'])
            ->make(true);
        }
        return view('admin.education.index');
    }

    public function create()
    {
        $this->authorize('create', Education::class);

        return view('admin.education.create');
    }

    public function store(EducationRequest $request)
    {
        $this->authorize('create', Education::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Education::create($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education created successfully.');
    }

    public function show(Education $education)
    {
        $this->authorize('view', $education);
        $education->load('user');

        return view('admin.education.show', compact('education'));
    }

    public function edit(Education $education)
    {
        $this->authorize('update', $education);

        return view('admin.education.edit', compact('education'));
    }

    public function update(EducationRequest $request, Education $education)
    {
        $this->authorize('update', $education);

        $validated = $request->validated();
        $education->update($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $this->authorize('delete', $education);
        $education->delete();

        return response()->json(['success' => true, 'message' => 'Education deleted successfully.']);
    }

    public function toggleStatus(Request $request, Education $education)
    {
        $this->authorize('toggleStatus', $education);

        $field = $request->get('field');
        if (in_array($field, ['is_visible', 'is_current'])) {
            $education->update([$field => ! $education->$field]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field.'], 400);
    }
}
