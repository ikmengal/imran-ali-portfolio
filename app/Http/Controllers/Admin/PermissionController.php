<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends AdminController
{
    public function index(Request $request)
    {
        $filters = $this->getFilters(Permission::class);

        if ($request->ajax()) {
            $query = Permission::where('guard_name', 'web')->with('roles');

            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function ($permission) {
                    return '<h6 class="mb-0">'.e($permission->name).'</h6>';
                })
                ->addColumn('label', function ($permission) {
                    return '<span class="badge bg-label-info">'.e($permission->label).'</span>';
                })
                ->addColumn('roles', function ($permission) {
                    $badges = [];
                    foreach ($permission->roles as $role) {
                        $color = match ($role->name) {
                            'Super Admin' => 'danger',
                            'Admin' => 'warning',
                            default => 'primary',
                        };
                        $badges[] = '<span class="badge bg-label-'.$color.' me-1 mb-1">'.e($role->name).'</span>';
                    }
                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('created_at', function ($permission) {
                    return '<small>'.$permission->created_at->format('M d, Y').'</small>';
                })
                ->addColumn('actions', function ($permission) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                    if (auth()->user()->can('permissions-show')) {
                        $actions .= '<a href="'.route('admin.permissions.show', $permission).'" class="btn btn-sm btn-icon btn-label-info" title="View">
                            <i class="ti ti-eye"></i>
                        </a>';
                    }
                    if (auth()->user()->can('permissions-edit')) {
                        $actions .= '<button type="button" class="btn btn-sm btn-icon btn-label-primary edit-permission-btn" title="Edit"
                            data-permission-id="'.$permission->id.'" data-permission-name="'.$permission->name.'">
                            <i class="ti ti-edit"></i>
                        </button>';
                    }
                    if (auth()->user()->can('permissions-delete')) {
                        $actions .= '<button data-del-url="'.route('admin.permissions.destroy', $permission).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete">
                            <i class="ti ti-trash"></i>
                        </button>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['name', 'label', 'roles', 'created_at', 'actions'])
                ->make(true);
        }

        $labels = Permission::where('guard_name', 'web')->distinct()->pluck('label');
        return view('admin.permissions.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', Permission::class);
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'label' => 'required|string|max:255',
        ]);

        $permission = Permission::create([
            'name' => $validated['name'],
            'label' => $validated['label'],
            'guard_name' => 'web',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Permission created successfully.']);
        }

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission)
    {
        $this->authorize('view', $permission);
        $permission->load('roles');
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'id' => $permission->id,
                'name' => $permission->name,
                'label' => $permission->label,
            ]);
        }

        $roles = Role::where('guard_name', 'web')->get();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,'.$permission->id,
            'label' => 'required|string|max:255',
        ]);

        $permission->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Permission updated successfully.']);
        }

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);
        $permission->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Permission deleted successfully.']);
        }

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
