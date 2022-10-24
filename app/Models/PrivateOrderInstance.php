<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrivateOrderInstance
 *
 * @property int $id
 * @property int $order_id
 * @property float $price
 * @property float|null $deserved_price
 * @property float|null $fees
 * @property float|null $total_amount
 * @property float|null $client_cancellation
 * @property float|null $value_added_tax
 * @property float $payable_service_provider
 * @property float|null $payment_gateway_fee
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payment_gateway_checkout_data
 * @property int|null $payment_status
 * @property float|null $provider_fees
 * @property float|null $provider_value_added_tax
 * @property string|null $update_price
 * @property-read \App\Models\PrivateOrder|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePayableServiceProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereUpdatePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereValueAddedTax($value)
 * @mixin \Eloquent
 */
class PrivateOrderInstance extends Model
{
    protected $guarded = [];
    protected $table = "private_orders_instances";

    public function order()
    {
        return $this->belongsTo(PrivateOrder::class, 'order_id');
    }

    public static function createInstance($order){
        $instance = new PrivateOrderInstance();
        $instance->order_id = $order->id;
        $instance->price = $order->price;
        $instance->deserved_price = $order->deserved_price;
        $instance->fees = $order->fees;
        $instance->total_amount = $order->total_amount;
        $instance->client_cancellation = $order->client_cancellation;
        $instance->value_added_tax = $order->value_added_tax;
        $instance->payable_service_provider = $order->payable_service_provider;
        $instance->payment_gateway_fee = $order->payment_gateway_fee;
        $instance->payment_gateway_checkout_data = $order->payment_gateway_checkout_data;
        $instance->provider_fees = $order->provider_fees;
        $instance->provider_value_added_tax = $order->provider_value_added_tax;
        $instance->update_price = $order->update_price;
        $instance->save();
        return $instance;
    } 
    public function getDiscount(){
        $discount = 0;
        if(!is_null($instance = $this->order->coupone_instance)){
            $discount += $instance->amount;
        }
        if(!empty($this->order->user_discount)){
            $discount += $this->order->user_discount;
        }
        return $discount;
    }
}
