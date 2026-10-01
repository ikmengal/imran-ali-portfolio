<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends AdminController
{
public function index(Request $request)
    {
        $filters = $this->getFilters(User::class);

        if ($request->ajax()) {
            $query = User::with('roles:id,name')->whereHas('roles', function ($q) {
                $q->where('name', 'User');
            });

            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function ($user) {
                    $image = $user->profile_image
                        ? asset('storage/'.$user->profile_image)
                        : asset('admin/assets/img/avatars/1.png');

                    return '<div class="d-flex align-items-center">
                        <img src="'.$image.'" alt="" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0">'.e($user->name).'</h6>
                            <small class="text-muted">'.e($user->email).'</small>
                        </div>
                    </div>';
                })
                ->addColumn('roles', function ($user) {
                    $badges = [];
                    foreach ($user->roles as $role) {
                        $color = match ($role->name) {
                            'Super Admin' => 'danger',
                            'Admin' => 'warning',
                            'User' => 'primary',
                            default => 'secondary',
                        };
                        $badges[] = '<span class="badge bg-label-'.$color.' me-1">'.e($role->name).'</span>';
                    }

                    return '<div class="d-flex flex-wrap">'.implode('', $badges).'</div>';
                })
                ->addColumn('status', function ($user) {
                    if ($user->trashed()) {
                        return '<span class="badge bg-label-danger">Trashed</span>';
                    }

                    return '<span class="badge bg-label-success">Active</span>';
                })
                ->addColumn('email_verified', function ($user) {
                    if ($user->email_verified_at) {
                        return '<span class="badge bg-label-success"><i class="ti ti-check me-1"></i>Verified</span>';
                    }
                    return '<span class="badge bg-label-secondary"><i class="ti ti-x me-1"></i>Unverified</span>';
                })
                ->addColumn('created_at', function ($user) {
                    return '<small>'.$user->created_at->format('M d, Y').'</small>';
                })
                ->addColumn('actions', function ($user) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                        if (auth()->user()->can('users-show')) {
                            $actions .= '<a href="'.route('admin.users.show', $user).'" class="btn btn-sm btn-icon btn-label-info" title="View">
                                <i class="ti ti-eye"></i>
                            </a>';
                        }
                        if (auth()->user()->can('users-edit') && ! $user->trashed()) {
                            $actions .= '<a href="'.route('admin.users.edit', $user).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit">
                                <i class="ti ti-edit"></i>
                            </a>';
                        }
                        if (auth()->user()->can('users-delete')) {
                            if ($user->trashed()) {
                                if (auth()->user()->hasRole('Super Admin')) {
                                    $actions .= '<button data-del-url="'.route('admin.users.force-delete', $user).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Force Delete">
                                            <i class="ti ti-trash"></i>
                                        </button>';
                                    $actions .= '<a href="'.route('admin.users.restore', $user).'" class="btn btn-sm btn-icon btn-label-success" title="Restore">
                                        <i class="ti ti-undo"></i>
                                    </a>';
                                }
                            } else {
                                $actions .= '<button data-del-url="'.route('admin.users.destroy', $user).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>';
                            }
                        }
                        if (auth()->user()->can('users-edit') && $user->id !== auth()->id()) {
                            $actions .= '<form action="'.route('admin.users.generate-password', $user).'" method="POST" class="d-inline">
                                '.csrf_field().'
                                <button type="submit" class="btn btn-sm btn-icon btn-label-secondary" title="Generate Password" onclick="return confirm(\'Generate new password for this user?\')">
                                    <i class="ti ti-key"></i>
                                </button>
                            </form>';
                        }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['name', 'roles', 'status', 'email_verified', 'created_at', 'actions'])
            ->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::where('guard_name', 'web')->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('users', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $roles = $validated['roles'] ?? [];
        unset($validated['roles']);

        $user = User::create($validated);

        if (! empty($roles)) {
            $user->assignRole($roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $user->load('roles', 'permissions');

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::where('guard_name', 'web')->pluck('name', 'name');
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('users', 'public');
        }

        $roles = $validated['roles'] ?? [];
        unset($validated['roles']);

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        $user->syncRoles($roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete yourself.');
        }
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }

    public function trashed()
    {
        $this->authorize('viewAny', User::class);

        return view('admin.users.trashed');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $user);
        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'User restored successfully.');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $user);

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->forceDelete();

        return response()->json(['success' => true, 'message' => 'User permanently deleted.']);
    }

    public function generatePassword(User $user)
    {
        $this->authorize('generatePassword', $user);

        $password = Str::random(12);
        $user->update(['password' => Hash::make($password)]);

        return redirect()->route('admin.users.index')->with([
            'success' => 'Password generated successfully.',
            'generated_password' => $password,
        ]);
    }

    public function changePassword(Request $request, User $user)
    {
        $this->authorize('changePassword', $user);

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.users.index')->with('success', 'Password changed successfully.');
    }
}
