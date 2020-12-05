<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return true;//TODO
    }

    /**
     * Determine whether the user can view any contracts.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the contract.
     *
     * @param  User  $user
     * @param  Contract  $contract
     * @return mixed
     */
    public function view(User $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can create contracts.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the contract.
     *
     * @param  User  $user
     * @param  Contract  $contract
     * @return mixed
     */
    public function update(User $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can delete the contract.
     *
     * @param  User  $user
     * @param  Contract  $contract
     * @return mixed
     */
    public function delete(User $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can restore the contract.
     *
     * @param  User  $user
     * @param  Contract  $contract
     * @return mixed
     */
    public function restore(User $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the contract.
     *
     * @param  User  $user
     * @param  Contract  $contract
     * @return mixed
     */
    public function forceDelete(User $user, Contract $contract)
    {
        //
    }
}
