<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('projects-list');
    }

    public function view(User $user, Project $project): bool
    {
        return $user->can('projects-show') && $this->checkOwnership($user, $project);
    }

    public function create(User $user): bool
    {
        return $user->can('projects-create');
    }

    public function update(User $user, Project $project): bool
    {
        return $user->can('projects-edit') && $this->checkOwnership($user, $project);
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->can('projects-delete') && $this->checkOwnership($user, $project);
    }

    public function toggleStatus(User $user, Project $project): bool
    {
        return $user->can('projects-edit') && $this->checkOwnership($user, $project);
    }

    protected function checkOwnership(User $user, Project $project): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $project->user_id === $user->id;
    }
}
