<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::ordered();
            return DataTables::of($services)
                ->addColumn('title', function ($service) {
                    $icon = '';
                    if ($service->icon) {
                        $icon = '<i class="bx ' . e($service->icon) . ' me-2 fs-4"></i>';
                    }
                    return '<div class="d-flex align-items-center">
                        ' . $icon . '
                        <div>
                            <h6 class="mb-0">' . e($service->title) . '</h6>
                        </div>
                    </div>';
                })
                ->addColumn('description', function ($service) {
                    if ($service->description) {
                        return '<small class="text-muted">' . e(\Illuminate\Support\Str::limit($service->description, 80)) . '</small>';
                    }
                    return '<span class="text-muted">—</span>';
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
                    return '<div class="d-flex flex-wrap">' . implode('', $badges) . '</div>';
                })
                ->addColumn('sort_order', function ($service) {
                    return $service->sort_order ?? 0;
                })
                ->addColumn('actions', function ($service) {
                    return '<div class="d-flex justify-content-end gap-2">
                        <a href="' . route('admin.services.edit', $service) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>
                        <form method="POST" action="' . route('admin.services.destroy', $service) . '" onsubmit="return confirm(\'Are you sure you want to delete this service?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>';
                })
                ->rawColumns(['title', 'description', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.services.index');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);
        $validated['user_id'] = auth()->id();

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}