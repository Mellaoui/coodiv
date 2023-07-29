<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\Response as AccessResponse;

class ProductPolicy
{
    public function viewAny(User $user): AccessResponse
    {
        return $user->hasPermissionTo('view products')
            ? Response::allow()
            : Response::deny('You do not have permission to view products');
    }

    public function view(User $user, Product $product): AccessResponse
    {
        return $user->hasPermissionTo('view products')
            ? Response::allow()
            : Response::deny('You do not have permission to view products');
    }

    public function create(User $user): AccessResponse
    {
        return $user->hasPermissionTo('create products')
            ? Response::allow()
            : Response::deny('You do not have permission to create products');
    }

    public function update(User $user, Product $product): AccessResponse
    {
        return $user->hasPermissionTo('update products')
            ? Response::allow()
            : Response::deny('You do not have permission to update products');
    }

    public function delete(User $user, Product $product): AccessResponse
    {
        return $user->hasPermissionTo('delete products')
            ? Response::allow()
            : Response::deny('You do not have permission to delete products');
    }

    public function restore(User $user, Product $product): AccessResponse
    {
        return $user->hasPermissionTo('restore products')
            ? Response::allow()
            : Response::deny('You do not have permission to restore products');
    }

    public function forceDelete(User $user, Product $product): AccessResponse
    {
        return $user->hasPermissionTo('force delete products')
            ? Response::allow()
            : Response::deny('You do not have permission to force delete products');
    }
}
