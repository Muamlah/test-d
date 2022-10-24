<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CouponInstance
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $coupon_id
 * @property string|null $code
 * @property string $type
 * @property int $number_of_use
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $discount
 * @property int|null $owner_id
 * @property string|null $owner_discount
 * @property int|null $max_discount
 * @property string $discount_type
 * @property string|null $amount
 * @property int|null $entity_id
 * @property string|null $entity_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereMaxDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereNumberOfUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereUserId($value)
 * @mixin \Eloquent
 */
class CouponInstance extends Model
{
    protected $table = 'coupons_instances';
    protected $fillable = [
        'code',
        'type',
        'discount_type',
        'discount',
        'owner_id',
        'owner_discount',
        'max_discount',
        'number_of_use',
        'end_date',
        'type',
        'amount',
    ];

    static public function create_new($coupon, $user, $amount, $owner_discount = 0){
        $instance = new CouponInstance;
        $instance->user_id = $user->id;
        $instance->coupon_id = $coupon->id;
        $instance->code = $coupon->code;
        $instance->discount = $coupon->discount;
        $instance->owner_id = $coupon->owner_id;
        $instance->owner_discount = $owner_discount;
        $instance->amount = $amount;
        $instance->discount_type = $coupon->discount_type;
        $instance->number_of_use = $coupon->number_of_use;
        $instance->max_discount = $coupon->max_discount;
        $instance->type = $coupon->type;
        $instance->save();
        return $instance;
    }
    static public function update_instance($instance, $coupon, $amount, $owner_discount = 0){
        $instance->code = $coupon->code;
        $instance->discount = $coupon->discount;
        $instance->owner_id = $coupon->owner_id;
        $instance->owner_discount = $owner_discount;
        $instance->amount = $amount;
        $instance->discount_type = $coupon->discount_type;
        $instance->number_of_use = $coupon->number_of_use;
        $instance->max_discount = $coupon->max_discount;
        $instance->type = $coupon->type;
        $instance->save();
        return $instance;
    }
    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    }
}
