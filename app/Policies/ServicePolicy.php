<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('services-list');
    }

    public function view(User $user, Service $service): bool
    {
        return $user->can('services-show') && $this->checkOwnership($user, $service);
    }

    public function create(User $user): bool
    {
        return $user->can('services-create');
    }

    public function update(User $user, Service $service): bool
    {
        return $user->can('services-edit') && $this->checkOwnership($user, $service);
    }

    public function delete(User $user, Service $service): bool
    {
        return $user->can('services-delete') && $this->checkOwnership($user, $service);
    }

    public function toggleStatus(User $user, Service $service): bool
    {
        return $user->can('services-edit') && $this->checkOwnership($user, $service);
    }

    protected function checkOwnership(User $user, Service $service): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $service->user_id === $user->id;
    }
}
