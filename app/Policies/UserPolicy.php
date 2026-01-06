<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Only admin can assign manager
     */
    public function adminCheck(User $authUser): bool
    {
        return $authUser->role === 'admin';
    }
      public function managerCheck(User $authUser): bool
    {
        return $authUser->role === 'manager';
    }
}
