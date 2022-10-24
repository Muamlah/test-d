<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property float $price
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer query()
 * @mixin \Eloquent
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $deadline
 * @property string|null $time
 * @property string|null $date
 * @property float|null $tax_amount
 * @property float|null $fees
 * @property float|null $deserved_price
 * @property float|null $value_added_tax
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PublicOrder $order
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereValueAddedTax($value)
 */
class PublicOrderOffer extends Model
{
    use Notifiable;

    protected $table='public_order_offers';
    protected $fillable = ['user_id','order_id','price','duration','details','deserved_price','tax_amount'];
    protected $dates = ['deadline'];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->with('avgReviews');
    }
    public function order(){
        return $this->belongsTo(PublicOrder::class,'order_id','id');
    }

}
