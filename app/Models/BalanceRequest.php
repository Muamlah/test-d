<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BalanceRequest
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property float|null $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string|null $description
 * @property string|null $ref
 * @property string|null $file
 * @property-read \App\Models\CreditCard $credit
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereUserId($value)
 */
class BalanceRequest extends Model
{
     protected $table='balance_requests';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function credit(){
        return $this->belongsTo(CreditCard::class,'user_id','user_id');
    }

}
