<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return true;//TODO
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function view(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function delete(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function restore(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function forceDelete(User $user, Client $client)
    {
        //
    }
}
