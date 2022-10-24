<?php

namespace App\Policies\Website;

use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\PublicOrderOffer;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

/**
 * Class PrivateOrderPolicy
 * @package App\Policies\Website
 */
class PublicOrderPolicy
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
    public function showOrders(User $user, PublicOrder $publicOrder): bool
    {
        return $user->id === $publicOrder->user_id;
    }

    public function addOffer(User $user, PublicOrder $publicOrder): bool
    {
        $checkOffer=PublicOrderOffer::where('user_id',$user->id)->where('order_id',$publicOrder->id)->first();
        return $user->id === $checkOffer->user_id;
    }

    public function showOffers(User $user, PublicOrder $publicOrder): bool
    {
        return $user->id === $publicOrder->user_id;
    }

    public function editOffer(User $user, PublicOrderOffer $publicOrderOffer): bool
    {
        return $user->id === $publicOrderOffer->user_id;
    }
 /**
     * @param User $user
     * @param PublicOrder $publicOrder
     * @return bool
     */
    public function createFollowingOrder(User $user, PublicOrder $publicOrder): bool
    {
        $userProvider= User::where('id',$publicOrder->provider_id)->first();
        return $user->id === $userProvider->id;
    }
    /**
     * @param User $user
     * @param PublicOrder $publicOrder
     * @return bool
     */
    public function createFollowingOrderWithoutLogin(User $user, PublicOrder $publicOrder): bool
    {
        $userProvider= User::where('id',$publicOrder->provider_id)->first();
        return $user->id === $userProvider->id;
    }

    /**
     * @param User $user
     * @param PublicOrder $publicOrder
     * @return bool
     */
    public function updateFollowingOrder(User $user, PublicOrder $publicOrder): bool
    {
        $userProvider= User::where('id',$publicOrder->provider_id)->first();
        return $user->id === $userProvider->id;
    }

}
