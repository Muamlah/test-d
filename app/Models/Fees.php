<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property float $client_platform_fee
 * @property float $client_less_than_3300
 * @property float $client_less_than_1000
 * @property float $client_cancellation
 * @property float $offer_platform_fee
 * @property float $offer_cancellation
 * @property float $service_platform_fee
 * @property float $service_client_fees
 * @property float $service_cancellation
 * @property float $value_added_tax
 * @property float $payment_gateway_fee
 * @property float $payment_gateway_cancellation_fee
 * @property float $payment_gateway_refunded
 * @property string $bank_fees
 * @property float $bank_cancellation_fee
 * @property float $bank_refunded
 * @property float $staff_commission
 * @property float $marketers_commission
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Fees newModelQuery()
 * @method static Builder|Fees newQuery()
 * @method static Builder|Fees query()
 * @mixin \Eloquent
 * @property float $public_order_platform_fee
 * @property float $public_order_cancellation
 * @property float $public_order_added_tax
 * @property float $public_order_less_than_3300
 * @property float $public_order_less_than_1000
 * @property float $offer_less_than_3300
 * @property float $offer_added_tax
 * @property float|null $offer_less_than_1000
 * @method static Builder|Fees whereBankCancellationFee($value)
 * @method static Builder|Fees whereBankFees($value)
 * @method static Builder|Fees whereBankRefunded($value)
 * @method static Builder|Fees whereClientCancellation($value)
 * @method static Builder|Fees whereClientLessThan1000($value)
 * @method static Builder|Fees whereClientLessThan3300($value)
 * @method static Builder|Fees whereClientPlatformFee($value)
 * @method static Builder|Fees whereCreatedAt($value)
 * @method static Builder|Fees whereId($value)
 * @method static Builder|Fees whereMarketersCommission($value)
 * @method static Builder|Fees whereOfferAddedTax($value)
 * @method static Builder|Fees whereOfferCancellation($value)
 * @method static Builder|Fees whereOfferLessThan1000($value)
 * @method static Builder|Fees whereOfferLessThan3300($value)
 * @method static Builder|Fees whereOfferPlatformFee($value)
 * @method static Builder|Fees wherePaymentGatewayCancellationFee($value)
 * @method static Builder|Fees wherePaymentGatewayFee($value)
 * @method static Builder|Fees wherePaymentGatewayRefunded($value)
 * @method static Builder|Fees wherePublicOrderAddedTax($value)
 * @method static Builder|Fees wherePublicOrderCancellation($value)
 * @method static Builder|Fees wherePublicOrderLessThan1000($value)
 * @method static Builder|Fees wherePublicOrderLessThan3300($value)
 * @method static Builder|Fees wherePublicOrderPlatformFee($value)
 * @method static Builder|Fees whereServiceCancellation($value)
 * @method static Builder|Fees whereServiceClientFees($value)
 * @method static Builder|Fees whereServicePlatformFee($value)
 * @method static Builder|Fees whereStaffCommission($value)
 * @method static Builder|Fees whereUpdatedAt($value)
 * @method static Builder|Fees whereValueAddedTax($value)
 */
class Fees extends Model
{
    protected $fillable = ['client_platform_fee', 'client_less_than_3300', 'client_less_than_1000',
        'client_cancellation', 'offer_platform_fee', 'offer_cancellation', 'service_platform_fee', 'service_client_fees', 'service_cancellation',
        'value_added_tax', 'payment_gateway_fee', 'payment_gateway_cancellation_fee', 'payment_gateway_refunded', 'bank_fees',
        'bank_cancellation_fee', 'bank_refunded', 'staff_commission', 'marketers_commission','public_order_platform_fee'
        ,'public_order_cancellation','public_order_added_tax','public_order_less_than_3300','public_order_less_than_1000'
    ,'offer_less_than_3300','offer_added_tax','offer_less_than_1000'];
}
