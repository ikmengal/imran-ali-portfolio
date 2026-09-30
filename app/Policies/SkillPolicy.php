<?php

namespace App\Policies;

use App\Models\Skill;
use App\Models\User;

class SkillPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('skills-list');
    }

    public function view(User $user, Skill $skill): bool
    {
        return $user->can('skills-show') && $this->checkOwnership($user, $skill);
    }

    public function create(User $user): bool
    {
        return $user->can('skills-create');
    }

    public function update(User $user, Skill $skill): bool
    {
        return $user->can('skills-edit') && $this->checkOwnership($user, $skill);
    }

    public function delete(User $user, Skill $skill): bool
    {
        return $user->can('skills-delete') && $this->checkOwnership($user, $skill);
    }

    public function toggleStatus(User $user, Skill $skill): bool
    {
        return $user->can('skills-edit') && $this->checkOwnership($user, $skill);
    }

    protected function checkOwnership(User $user, Skill $skill): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $skill->user_id === $user->id;
    }
}
