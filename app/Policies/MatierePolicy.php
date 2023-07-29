<?php

namespace App\Policies;

use App\Models\Matiere;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\Response as AccessResponse;

class MatierePolicy
{
    public function viewAny(User $user): AccessResponse
    {
        return $user->hasPermissionTo('view matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to view matieres');
    }

    public function view(User $user, Matiere $matiere): AccessResponse
    {
        return $user->hasPermissionTo('view matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to view matieres');
    }

    public function create(User $user): AccessResponse
    {
        return $user->hasPermissionTo('create matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to create matieres');
    }

    public function update(User $user, Matiere $matiere): AccessResponse
    {
        return $user->hasPermissionTo('update matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to update matieres');
    }

    public function delete(User $user, Matiere $matiere): AccessResponse
    {
        return $user->hasPermissionTo('delete matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to delete matieres');
    }

    public function restore(User $user, Matiere $matiere): AccessResponse
    {
        return $user->hasPermissionTo('restore matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to restore matieres');
    }

    public function forceDelete(User $user, Matiere $matiere): AccessResponse
    {
        return $user->hasPermissionTo('force delete matieres')
            ? Response::allow()
            : Response::deny('You do not have permission to force delete matieres');
    }
}
