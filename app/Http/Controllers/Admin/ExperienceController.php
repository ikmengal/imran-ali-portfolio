<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends AdminController
{
    public function index(Request $request)
    {
        $filters = $this->getFilters(Experience::class);
        $employmentTypes = Experience::query()->select('employment_type')->distinct()->pluck('employment_type')->filter()->values();

        if ($request->ajax()) {
            $query = Experience::with('user:id,name')->ordered();
            $query = $this->scopeRecords($query);
            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('job_title', function ($experience) {
                    return '<div>
                        <h6 class="mb-1">'.e($experience->job_title).'</h6>
                        <small class="text-muted">'.e($experience->company).'</small>
                    </div>';
                })
                ->addColumn('type', function ($experience) {
                    if ($experience->employment_type) {
                        return '<span class="badge bg-label-info">'.e($experience->employment_type).'</span>';
                    }

                    return '<span class="text-muted">—</span>';
                })
                ->addColumn('duration', function ($experience) {
                    $start = $experience->start_date ? $experience->start_date->format('M Y') : '—';
                    $end = $experience->is_current ? 'Present' : ($experience->end_date ? $experience->end_date->format('M Y') : '—');

                    return '<small>'.$start.' - '.$end.'</small>';
                })
                ->addColumn('status', function ($experience) {
                    $badges = [];
                    if ($experience->is_visible) {
                        $badges[] = '<span class="badge bg-label-success me-1">Visible</span>';
                    } else {
                        $badges[] = '<span class="badge bg-label-secondary me-1">Hidden</span>';
                    }
                    if ($experience->is_current) {
                        $badges[] = '<span class="badge bg-label-primary">Current</span>';
                    }

                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('actions', function ($experience) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';

                    if (auth()->user()->can('experiences-show')) {
                        $actions .= '<a href="'.route('admin.experiences.show', $experience).'" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="ti ti-eye"></i></a>';
                    }

                    if (auth()->user()->can('experiences-edit')) {
                        $actions .= '<a href="'.route('admin.experiences.edit', $experience).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="ti ti-edit"></i></a>';
                    }

                    if (auth()->user()->can('experiences-delete')) {
                        $actions .= '<button data-del-url="'.route('admin.experiences.destroy', $experience).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete">
                            <i class="ti ti-trash"></i>
                        </button>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['job_title', 'type', 'duration', 'status', 'actions'])
            ->make(true);
        }

        return view('admin.experiences.index', compact('employmentTypes'));
    }

    public function create()
    {
        $this->authorize('create', Experience::class);
        return view('admin.experiences.create');
    }

    public function store(ExperienceRequest $request)
    {
        $this->authorize('create', Experience::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience created successfully.');
    }

    public function show(Experience $experience)
    {
        $this->authorize('view', $experience);
        $experience->load('user');

        return view('admin.experiences.show', compact('experience'));
    }

    public function edit(Experience $experience)
    {
        $this->authorize('update', $experience);

        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        $this->authorize('update', $experience);

        $validated = $request->validated();
        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $this->authorize('delete', $experience);
        $experience->delete();

        return response()->json(['success' => true, 'message' => 'Experience deleted successfully.']);
    }

    public function toggleStatus(Request $request, Experience $experience)
    {
        $this->authorize('toggleStatus', $experience);

        $field = $request->get('field');
        if (in_array($field, ['is_visible', 'is_current'])) {
            $experience->update([$field => ! $experience->$field]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field.'], 400);
    }
}
