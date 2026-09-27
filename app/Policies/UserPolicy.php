<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function view(
        User $loggedInUser,
        User $targetUser
    ): bool {

        if ($loggedInUser->hasRole('super_admin')) {
            return true;
        }

        return $targetUser->parent_id === $loggedInUser->id;
    }


    public function update(
        User $loggedInUser,
        User $targetUser
    ): bool {

        if ($loggedInUser->hasRole('super_admin')) {
            return true;
        }

        return $targetUser->parent_id === $loggedInUser->id;
    }


    public function delete(
        User $loggedInUser,
        User $targetUser
    ): bool {

        if ($loggedInUser->hasRole('super_admin')) {
            return true;
        }

        return $targetUser->parent_id === $loggedInUser->id;
    }
}