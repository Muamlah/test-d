<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property string|null $code
 * @property string $type
 * @property int|null $instances_count
 * @property int $number_of_use
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $discount
 * @property int|null $owner_id
 * @property string|null $owner_discount
 * @property int|null $max_discount
 * @property string $discount_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CouponInstance[] $Instances
 * @property-read \App\Models\User|null $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereInstancesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereNumberOfUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coupon extends Model
{
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
        'instances_count'
    ];

    static $types = [
        'coupon' => [
            'key' => 'coupon',
            'title' => 'بطاقة حسم أو كود تسويق',
        ],
        'gift' => [
            'key' => 'gift',
            'title' => 'بطاقة شحن رصيد',
        ]
    ];

    static $discount_types = [
        'fixed_amount' => [
            'key' => 'fixed_amount',
            'title' => 'قيمة ثابتة',
        ],
        'percentage' => [
            'key' => 'percentage',
            'title' => 'نسبة',
        ]
    ];

    public static function getTypes(){
        return static::$types;
    }

    public static function getDiscountTypes(){
        return static::$discount_types;
    }

    public function Instances(){
        return $this->hasMany(CouponInstance::class, 'coupon_id', 'id');
    }

    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    }
}
