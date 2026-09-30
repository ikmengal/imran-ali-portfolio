<?php

namespace App\Policies;

use App\Models\Education;
use App\Models\User;

class EducationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('educations-list');
    }

    public function view(User $user, Education $education): bool
    {
        return $user->can('educations-show') && $this->checkOwnership($user, $education);
    }

    public function create(User $user): bool
    {
        return $user->can('educations-create');
    }

    public function update(User $user, Education $education): bool
    {
        return $user->can('educations-edit') && $this->checkOwnership($user, $education);
    }

    public function delete(User $user, Education $education): bool
    {
        return $user->can('educations-delete') && $this->checkOwnership($user, $education);
    }

    public function toggleStatus(User $user, Education $education): bool
    {
        return $user->can('educations-edit') && $this->checkOwnership($user, $education);
    }

    protected function checkOwnership(User $user, Education $education): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $education->user_id === $user->id;
    }
}
