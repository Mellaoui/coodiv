<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\Response as AccessResponse;

class CategoryPolicy
{
    public function viewAny(User $user): AccessResponse
    {
        return $user->hasPermissionTo('view categories')
            ? Response::allow()
            : Response::deny('You do not have permission to view categories');
    }

    public function view(User $user, Category $category): AccessResponse
    {
        return $user->hasPermissionTo('view categories')
            ? Response::allow()
            : Response::deny('You do not have permission to view categories');
    }

    public function create(User $user): AccessResponse
    {
        return $user->hasPermissionTo('create categories')
            ? Response::allow()
            : Response::deny('You do not have permission to create categories');
    }

    public function update(User $user, Category $category): AccessResponse
    {
        return $user->hasPermissionTo('update categories')
            ? Response::allow()
            : Response::deny('You do not have permission to update categories');
    }

    public function delete(User $user, Category $category): AccessResponse
    {
        return $user->hasPermissionTo('delete categories')
            ? Response::allow()
            : Response::deny('You do not have permission to delete categories');
    }

    public function restore(User $user, Category $category): AccessResponse
    {
        return $user->hasPermissionTo('restore categories')
            ? Response::allow()
            : Response::deny('You do not have permission to restore categories');
    }

    public function forceDelete(User $user, Category $category): AccessResponse
    {
        return $user->hasPermissionTo('force delete categories')
            ? Response::allow()
            : Response::deny('You do not have permission to force delete categories');
    }
}
