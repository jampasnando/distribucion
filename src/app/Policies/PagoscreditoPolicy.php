<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pagoscredito;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagoscreditoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pagoscredito');
    }

    public function view(AuthUser $authUser, Pagoscredito $pagoscredito): bool
    {
        return $authUser->can('View:Pagoscredito');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pagoscredito');
    }

    public function update(AuthUser $authUser, Pagoscredito $pagoscredito): bool
    {
        return $authUser->can('Update:Pagoscredito');
    }

    public function delete(AuthUser $authUser, Pagoscredito $pagoscredito): bool
    {
        return $authUser->can('Delete:Pagoscredito');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Pagoscredito');
    }

    public function restore(AuthUser $authUser, Pagoscredito $pagoscredito): bool
    {
        return $authUser->can('Restore:Pagoscredito');
    }

    public function forceDelete(AuthUser $authUser, Pagoscredito $pagoscredito): bool
    {
        return $authUser->can('ForceDelete:Pagoscredito');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pagoscredito');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pagoscredito');
    }

    public function replicate(AuthUser $authUser, Pagoscredito $pagoscredito): bool
    {
        return $authUser->can('Replicate:Pagoscredito');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pagoscredito');
    }

}