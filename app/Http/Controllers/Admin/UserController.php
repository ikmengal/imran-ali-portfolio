<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->latest();
            return DataTables::of($users)
                ->addColumn('image', function ($user) {
                    if ($user->profile_image) {
                        return '<img src="' . asset('storage/' . $user->profile_image) . '" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">';
                    }
                    return '<div class="avatar avatar-sm bg-label-primary">' . strtoupper($user->name[0]) . '</div>';
                })
                ->addColumn('name', function ($user) {
                    return '<div>
                        <h6 class="mb-1">' . e($user->name) . '</h6>
                        <small class="text-muted">' . e($user->email) . '</small>
                    </div>';
                })
                ->addColumn('roles', function ($user) {
                    $badges = [];
                    foreach ($user->roles as $role) {
                        $color = $role->name === 'Super Admin' ? 'danger' : 'primary';
                        $badges[] = '<span class="badge bg-label-' . $color . ' me-1">' . e($role->name) . '</span>';
                    }
                    return '<div class="d-flex flex-wrap">' . implode('', $badges) . '</div>';
                })
                ->addColumn('status', function ($user) {
                    if ($user->email_verified_at) {
                        return '<span class="badge bg-label-success">Verified</span>';
                    }
                    return '<span class="badge bg-label-warning">Unverified</span>';
                })
                ->addColumn('joined', function ($user) {
                    return $user->created_at->format('M d, Y');
                })
                ->addColumn('actions', function ($user) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                    $actions .= '<a href="' . route('admin.users.edit', $user) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>';
                    if ($user->id !== auth()->id()) {
                        $actions .= '<form method="POST" action="' . route('admin.users.destroy', $user) . '" onsubmit="return confirm(\'Are you sure you want to delete this user?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['image', 'name', 'roles', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('users', 'public');
        }

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                \Storage::disk('public')->delete($user->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('users', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}