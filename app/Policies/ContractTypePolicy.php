<?php

namespace App\Policies;

use App\Models\ContractType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractTypePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return true;//TODO
    }

    /**
     * Determine whether the user can view any contract types.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the contract type.
     *
     * @param User $user
     * @param ContractType $contractType
     * @return mixed
     */
    public function view(User $user, ContractType $contractType)
    {
        //
    }

    /**
     * Determine whether the user can create contract types.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the contract type.
     *
     * @param User $user
     * @param ContractType $contractType
     * @return mixed
     */
    public function update(User $user, ContractType $contractType)
    {
        //
    }

    /**
     * Determine whether the user can delete the contract type.
     *
     * @param User $user
     * @param ContractType $contractType
     * @return mixed
     */
    public function delete(User $user, ContractType $contractType)
    {
        //
    }

    /**
     * Determine whether the user can restore the contract type.
     *
     * @param User $user
     * @param ContractType $contractType
     * @return mixed
     */
    public function restore(User $user, ContractType $contractType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the contract type.
     *
     * @param User $user
     * @param ContractType $contractType
     * @return mixed
     */
    public function forceDelete(User $user, ContractType $contractType)
    {
        //
    }
}
