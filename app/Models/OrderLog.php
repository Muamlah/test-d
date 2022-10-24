<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
/**
 * Class OrderLog
 *
 * @package App\Models
 * @property int $id
 * @property int $order_id
 * @property float|null $fees
 * @property float|null $provider_fees
 * @property float|null $price
 * @property float|null $value_added_tax
 * @property float|null $provider_value_added_tax
 * @property float|null $total_amount
 * @property float|null $provider_total_amount
 * @property float|null $deserved_price
 * @property float|null $diff_amount
 * @property string|null $provider_discount
 * @property string|null $amount
 * @property string|null $payment_gateway_checkout_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereDiffAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereValueAddedTax($value)
 * @mixin \Eloquent
 */
class OrderLog extends Model
{
    use HasFactory;

    protected $table = 'order_log';
    

}
