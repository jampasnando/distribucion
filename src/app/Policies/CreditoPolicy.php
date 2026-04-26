<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Credito;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Credito');
    }

    public function view(AuthUser $authUser, Credito $credito): bool
    {
        return $authUser->can('View:Credito');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Credito');
    }

    public function update(AuthUser $authUser, Credito $credito): bool
    {
        return $authUser->can('Update:Credito');
    }

    public function delete(AuthUser $authUser, Credito $credito): bool
    {
        return $authUser->can('Delete:Credito');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Credito');
    }

    public function restore(AuthUser $authUser, Credito $credito): bool
    {
        return $authUser->can('Restore:Credito');
    }

    public function forceDelete(AuthUser $authUser, Credito $credito): bool
    {
        return $authUser->can('ForceDelete:Credito');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Credito');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Credito');
    }

    public function replicate(AuthUser $authUser, Credito $credito): bool
    {
        return $authUser->can('Replicate:Credito');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Credito');
    }

}