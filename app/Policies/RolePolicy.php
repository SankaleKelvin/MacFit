<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{

    public function _construct() {}

    public function viewAny(User $user)
    {
        return $user->role?->id === 1;
    }
    public function view(User $user, Role $model)
    {
        return $user->id === $model->id || $user->isAdmin();
    }

    public function create(?User $user)
    {
        return true;
    }

    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->role->id === 1;
    }

    public function delete(User $user)
    {
        return $user->role->id === 1;
    }
}
