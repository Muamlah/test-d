<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FollowingOrder
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $master_order
 * @property int|null $parent_order
 * @property int|null $main_order_id
 * @property string $user_phone
 * @property string $service_provider_phone
 * @property string $duration
 * @property string $price
 * @property string $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder query()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereMainOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereMasterOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereParentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereServiceProviderPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereUserPhone($value)
 */
class FollowingOrder extends Model
{
}
