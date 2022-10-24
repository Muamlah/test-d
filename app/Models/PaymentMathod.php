<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentMathod
 *
 * @property int $id
 * @property string|null $payment_gateway_type
 * @property string|null $payment_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\eservices_orders|null $eserviceOrder
 * @property-read \App\Models\PrivateOrder|null $privateOrder
 * @property-read \App\Models\PublicOrder|null $publicOrder
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod wherePaymentDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod wherePaymentGatewayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentMathod extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function publicOrder() {
        return $this->hasOne(PublicOrder::class);
    } // end of publicOrder

    public function privateOrder() {
        return $this->hasOne(PrivateOrder::class);
    } // end of privateOrder

    public function eserviceOrder() {
        return $this->hasOne(eservices_orders::class);
    } // end of eserviceOrder

} // end of PaymentMathod
