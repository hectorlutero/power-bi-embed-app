<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAnyUser(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewUser(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id || $user->is_admin === true;
    }


    /**
     * Determine whether the user can create models.
     */
    public function createUser(User $user, User $targetUser): bool
    {
        if (auth()->user()->is_admin === 0)
            return false;
        return $user->is_admin || $user->id === $targetUser->id;
    }

    /**
     * Determine whether the user can change the role the model.
     */
    public function updateUserRole(User $user, User $targetUser): bool
    {
        // check if the user is not an admin user
        if (auth()->user()->is_admin === 0)
            return false;
        return $user->is_admin || $user->id === $targetUser->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateUser(User $user, User $targetUser): bool
    {
        return $user->is_admin || $user->id === $targetUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function deleteUser(User $user, User $targetUser): bool
    {
        return auth()->user()->is_admin === 1 || $user->id === $targetUser->id;
    }
}
