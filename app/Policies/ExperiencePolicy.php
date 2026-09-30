<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;

class ExperiencePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('experiences-list');
    }

    public function view(User $user, Experience $experience): bool
    {
        return $user->can('experiences-show') && $this->checkOwnership($user, $experience);
    }

    public function create(User $user): bool
    {
        return $user->can('experiences-create');
    }

    public function update(User $user, Experience $experience): bool
    {
        return $user->can('experiences-edit') && $this->checkOwnership($user, $experience);
    }

    public function delete(User $user, Experience $experience): bool
    {
        return $user->can('experiences-delete') && $this->checkOwnership($user, $experience);
    }

    public function toggleStatus(User $user, Experience $experience): bool
    {
        return $user->can('experiences-edit') && $this->checkOwnership($user, $experience);
    }

    protected function checkOwnership(User $user, Experience $experience): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $experience->user_id === $user->id;
    }
}
