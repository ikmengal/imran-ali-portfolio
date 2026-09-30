<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('users-list');
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('users-show') && $this->checkOwnership($user, $model);
    }

    public function create(User $user): bool
    {
        return $user->can('users-create');
    }

    public function update(User $user, User $model): bool
    {
        return $user->can('users-edit') && $this->checkOwnership($user, $model);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can('users-delete') && $this->checkOwnership($user, $model);
    }

    public function restore(User $user, User $model): bool
    {
        return $user->can('users-edit') && $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->can('users-delete') && $user->hasRole('Super Admin');
    }

    public function changePassword(User $user, User $model): bool
    {
        return $user->can('users-edit') && ($user->id === $model->id || $user->hasRole('Super Admin'));
    }

    public function generatePassword(User $user, User $model): bool
    {
        return $user->can('users-edit') && $user->hasRole('Super Admin');
    }

    protected function checkOwnership(User $user, User $model): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $user->id === $model->id;
    }
}
