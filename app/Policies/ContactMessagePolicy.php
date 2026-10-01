<?php

namespace App\Policies;

use App\Models\ContactMessage;
use App\Models\User;

class ContactMessagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('contact_messages-list');
    }

    public function view(User $user, ContactMessage $message): bool
    {
        return $user->can('contact_messages-show');
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ContactMessage $message): bool
    {
        return $user->can('contact_messages-edit');
    }

    public function delete(User $user, ContactMessage $message): bool
    {
        return $user->can('contact_messages-delete');
    }

    public function toggleRead(User $user, ContactMessage $message): bool
    {
        return $user->can('contact_messages-list');
    }
}
