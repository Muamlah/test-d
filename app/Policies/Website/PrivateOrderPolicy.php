<?php

namespace App\Policies\Website;

use App\Models\PrivateOrder;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

/**
 * Class PrivateOrderPolicy
 * @package App\Policies\Website
 */
class PrivateOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param PrivateOrder $privateOrder
     * @return bool
     */
    public function owner(User $user, PrivateOrder $privateOrder): bool
    {

        return  ($user->id == $privateOrder->user_id || $user->id == $privateOrder->agent_id);
    }

    public function serviceOwner(User $user, PrivateOrder $privateOrder): bool
    {
        $userProvider= User::where('id',$privateOrder->provider_id)->first();

        return $user->id === $userProvider->id;
    }
    /**
     * @param User $user
     * @param PrivateOrder $privateOrder
     * @return bool
     */
    public function createFollowingOrder(User $user, PrivateOrder $privateOrder): bool
    {
        $userProvider= User::where('id',$privateOrder->provider_id)->first();
        return $user->id === $userProvider->id;
    }

    /**
     * @param User $user
     * @param PrivateOrder $privateOrder
     * @return bool
     */
    public function updateFollowingOrder(User $user, PrivateOrder $privateOrder): bool
    {
        $userProvider= User::where('id',$privateOrder->provider_id)->first();
        return $user->id === $userProvider->id;
    }
}
