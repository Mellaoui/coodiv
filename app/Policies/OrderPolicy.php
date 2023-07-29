<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\Response as AccessResponse;

class OrderPolicy
{
    public function viewAny(User $user): AccessResponse
    {
        return $user->hasPermissionTo('view orders')
            ? Response::allow()
            : Response::deny('You do not have permission to view orders');
    }

    public function view(User $user, Order $order): AccessResponse
    {
        return $user->hasPermissionTo('view orders')
            ? Response::allow()
            : Response::deny('You do not have permission to view this order');
    }

    public function create(User $user): AccessResponse
    {
        return $user->hasPermissionTo('create orders')
            ? Response::allow()
            : Response::deny('You do not have permission to create orders');
    }

    public function update(User $user, Order $order): AccessResponse
    {
        return $user->hasPermissionTo('update orders')
            ? Response::allow()
            : Response::deny('You do not have permission to update this order');
    }

    public function delete(User $user, Order $order): AccessResponse
    {
        return $user->hasPermissionTo('delete orders')
            ? Response::allow()
            : Response::deny('You do not have permission to delete this order');
    }

    public function restore(User $user, Order $order): AccessResponse
    {
        return $user->hasPermissionTo('restore orders')
            ? Response::allow()
            : Response::deny('You do not have permission to restore this order');
    }

    public function forceDelete(User $user, Order $order): AccessResponse
    {
        return $user->hasPermissionTo('force delete orders')
            ? Response::allow()
            : Response::deny('You do not have permission to force delete this order');
    }
}
