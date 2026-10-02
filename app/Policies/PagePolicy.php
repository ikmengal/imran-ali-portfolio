<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;

class PagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('pages-list');
    }

    public function view(User $user, Page $page): bool
    {
        return $user->can('pages-show') && $this->checkOwnership($user, $page);
    }

    public function create(User $user): bool
    {
        return $user->can('pages-create');
    }

    public function update(User $user, Page $page): bool
    {
        return $user->can('pages-edit') && $this->checkOwnership($user, $page);
    }

    public function delete(User $user, Page $page): bool
    {
        return $user->can('pages-delete') && $this->checkOwnership($user, $page);
    }

    protected function checkOwnership(User $user, Page $page): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $page->user_id === $user->id;
    }
}