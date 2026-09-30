<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Service::with('user:id,name')->ordered();
            $query = $this->scopeRecords($query);

            return DataTables::of($query)
                ->addColumn('title', function ($service) {
                    $icon = '';
                    if ($service->icon) {
                        $icon = '<i class="bx '.e($service->icon).' me-2 fs-4"></i>';
                    }

                    return '<div class="d-flex align-items-center">
                        '.$icon.'
                        <div>
                            <h6 class="mb-0">'.e($service->title).'</h6>
                        </div>
                    </div>';
                })
                ->addColumn('description', function ($service) {
                    return '<div class="text-truncate" style="max-width: 300px;">'.e($service->description).'</div>';
                })
                ->addColumn('status', function ($service) {
                    $badges = [];
                    if ($service->is_visible) {
                        $badges[] = '<span class="badge bg-label-success me-1">Visible</span>';
                    } else {
                        $badges[] = '<span class="badge bg-label-secondary me-1">Hidden</span>';
                    }
                    if ($service->is_featured) {
                        $badges[] = '<span class="badge bg-label-warning">Featured</span>';
                    }

                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('sort_order', function ($service) {
                    return $service->sort_order ?? 0;
                })
                ->addColumn('actions', function ($service) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';

                    if (auth()->user()->can('services-show')) {
                        $actions .= '<a href="'.route('admin.services.show', $service).'" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="bx bx-show"></i></a>';
                    }

                    if (auth()->user()->can('services-edit')) {
                        $actions .= '<a href="'.route('admin.services.edit', $service).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>';
                    }

                    if (auth()->user()->can('services-delete')) {
                        $actions .= '<form method="POST" action="'.route('admin.services.destroy', $service).'" onsubmit="return confirm(\'Are you sure you want to delete this service?\')" class="d-inline">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['title', 'description', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.services.index');
    }

    public function create()
    {
        $this->authorize('create', Service::class);

        return view('admin.services.create');
    }

    public function store(ServiceRequest $request)
    {
        $this->authorize('create', Service::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        $this->authorize('view', $service);
        $service->load('user');

        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $validated = $request->validated();
        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus(Request $request, Service $service)
    {
        $this->authorize('toggleStatus', $service);

        $field = $request->get('field');
        if (in_array($field, ['is_visible', 'is_featured'])) {
            $service->update([$field => ! $service->$field]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field.'], 400);
    }
}
