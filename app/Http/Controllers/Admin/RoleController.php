<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends AdminController
{
    public function index(Request $request)
    {
        $roles = Role::where('guard_name', 'web')->with('permissions')->get();
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get()->groupBy('label');

        if ($request->ajax()) {
            // For backward compatibility with DataTables if needed
            $query = Role::where('guard_name', 'web')->with('permissions');
            $query = $this->applyFilters($query, $request, $this->getFilters(Role::class));

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function ($role) {
                    return '<h6 class="mb-0">'.e($role->name).'</h6>';
                })
                ->addColumn('permissions', function ($role) {
                    $badges = [];
                    foreach ($role->permissions as $permission) {
                        $badges[] = '<span class="badge bg-label-info me-1 mb-1">'.e($permission->name).'</span>';
                    }
                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('users_count', function ($role) {
                    return $role->users()->count();
                })
                ->addColumn('created_at', function ($role) {
                    return '<small>'.$role->created_at->format('M d, Y').'</small>';
                })
                ->addColumn('actions', function ($role) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                    if (auth()->user()->can('roles-show')) {
                        $actions .= '<a href="'.route('admin.roles.show', $role).'" class="btn btn-sm btn-icon btn-label-info" title="View">
                            <i class="ti ti-eye"></i>
                        </a>';
                    }
                    if (auth()->user()->can('roles-edit') && $role->name !== 'Super Admin') {
                        $actions .= '<button type="button" class="btn btn-sm btn-icon btn-label-primary edit-role-btn" title="Edit Permissions"
                            data-bs-toggle="modal" data-bs-target="#editRoleModal"
                            data-role-id="'.$role->id.'" data-role-name="'.$role->name.'">
                            <i class="ti ti-lock"></i>
                        </button>';
                    }
                    if (auth()->user()->can('roles-delete') && $role->name !== 'Super Admin') {
                        $actions .= '<button type="button" class="btn btn-sm btn-icon btn-label-danger delete-role-btn" title="Delete"
                            data-role-id="'.$role->id.'" data-role-name="'.$role->name.'">
                            <i class="ti ti-trash"></i>
                        </button>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['name', 'permissions', 'users_count', 'actions'])
                ->make(true);
        }

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get()->groupBy('label');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $this->authorize('view', $role);
        $role->load('permissions');

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray(),
                'users_count' => $role->users()->count(),
            ]);
        }

        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get()->groupBy('label');
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions'] ?? []);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Role updated successfully.']);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function bulkPermissions(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($validated['role_id']);

        $this->authorize('update', $role);

        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Permissions updated successfully.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        if ($role->name === 'Super Admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Cannot delete Super Admin role.');
        }

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}