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
 * @property string $details
 * @property int $status
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder query()
 * @mixin \Eloquent
 * @property string|null $agent_id
 * @property string $title
 * @property float|null $price
 * @property float|null $deserved_price
 * @property float|null $fees
 * @property float|null $total_amount
 * @property float|null $client_cancellation
 * @property float|null $value_added_tax
 * @property float|null $payment_gateway_fee
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string|null $deadline
 * @property int|null $provider_id
 * @property int|null $verify_code
 * @property string $pay_status
 * @property int $master_order
 * @property int $parent_order
 * @property string $cancellation
 * @property int|null $payment_mathod_id
 * @property string|null $verify
 * @property float|null $payable_service_provider
 * @property float|null $provider_fees
 * @property float|null $provider_value_added_tax
 * @property string|null $agent_per
 * @property string|null $cancel_reason
 * @property string|null $invoice_code
 * @property string|null $reference_code
 * @property string|null $owner_discount
 * @property string|null $user_discount
 * @property-read \App\Models\User|null $agent
 * @property-read \App\Models\CouponInstance|null $coupone_instance
 * @property-read \Illuminate\Database\Eloquent\Collection|PublicOrder[] $followingOrders
 * @property-read int|null $following_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PublicOrder[] $followingOrdersMaster
 * @property-read int|null $following_orders_master_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PublicOrderOffer[] $offers
 * @property-read int|null $offers_count
 * @property-read \App\Models\PaymentMathod|null $paymentMathod
 * @property-read \App\Models\User|null $provider
 * @property-read \App\Models\Status|null $st
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder userOrAgent()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereInvoiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereMasterOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereParentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePayableServiceProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentMathodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereUserDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereVerifyCode($value)
 */
class PublicOrder extends Model
{
    use Notifiable;

    protected $guarded=[
        'agent'
    ];
    protected static $availableStatus = [
        '1' => [
            'status' => 'pending',
            'next_allowed_statuses' => [
                '2' , '6', '8'
            ],
        ],
        '2' => [
            'status' => 'waiting',
            'next_allowed_statuses' => [
                '3', '6', '4'
            ],
        ],
        '3' => [
            'status' => 'processing',
            'next_allowed_statuses' => [
                '4' , '6'  , '8'
            ],
        ],
        '4' => [
            'status' => 'completed',
            'next_allowed_statuses' => [
                '4'  ,'5'  , '8'
            ],
        ],
        '5' => [
            'status' => 'confirm_completed',
            'next_allowed_statuses' => [
                '8', '5'
            ],
        ],
        '6' => [
            'status' => 'canceled',
            'next_allowed_statuses' => [
                '7' , '8',
            ],
        ],
        '7' => [
            'status' => 'confirm_canceled',
            'next_allowed_statuses' => [
                '8'
            ],
        ],
        '8' => [
            'status' => 'report',
            'next_allowed_statuses' => [

            ],
        ],

    ];
    protected static $statusClasses = [
        '1' => 'bg-dark1-light',
        '2' => 'bg-yellow1-dark',
        '3' => 'bg-yellow1-dark',
        '4' => 'bg-green1-dark',
        '5' => 'bg-green1-dark',
        '6' => 'bg-red2-dark',
        '7' => 'bg-red2-dark',
        '8' => 'bg-red2-dark',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function st(){
        return $this->belongsTo(Status::class,'status','id');
    }
    public function provider(){
        return $this->belongsTo(User::class,'provider_id','id');
    }
    public function offers(){
        return $this->hasMany(PublicOrderOffer::class,'order_id','id');
    }

    public function followingOrders(){
        return $this->hasMany(PublicOrder::class,'parent_order','id');
    }
    public function followingOrdersMaster(){
        return $this->hasMany(PublicOrder::class,'master_order','id');
    }

    public function followingOrdersCount(){
        return PublicOrder::where('master_order' ,$this->master_order)->count();
    }
    public function coupone_instance(){
        return $this->hasOne(CouponInstance::class,'entity_id', 'id')->where('entity_type', PublicOrder::class);
    }
    public function paymentMathod() {
        return $this->belongsTo(PaymentMathod::class);
    } // end of paymentMathod

    public function statusName(){
        if(empty($this->st)){
            return false;
        }else{
            return $this->st->name;
        }
    }
    public static function collectAvailableStatus()
    {
        return collect( static::$availableStatus );
    }

    public function chechAvailableStatus($status){

        if(!isset(static::$availableStatus[$status])) return false;
        return in_array($status, static::$availableStatus[$this->status]['next_allowed_statuses']);
    }
    public function getDiscount(){
        $discount = 0;
        if(!is_null($instance = $this->coupone_instance)){
            $discount += $instance->amount;
        }
        if(!empty($this->user_discount)){
            $discount += $this->user_discount;
        }
        return $discount;
    }
    public function getHtmlStatus($addClass=""){
        $status = $this->st;
        $class = isset(static::$statusClasses[$status->id]) ? static::$statusClasses[$status->id] : 'bg-green1-dark';
        $html = '<span class="'.$class.' '.$addClass.' rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">'.$status->name.'</span>';
        return $html;
    }
    public function getHtmlStatusAlert($addClass=""){
        $status = $this->st;
        $class = isset(static::$statusClasses[$status->id]) ? static::$statusClasses[$status->id] : 'bg-green1-dark';
        $html = '<div class="alert mr-3 ml-3 rounded-s '.$class.' '.$addClass.' " role="alert">
                    <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                    <h4 class="text-uppercase color-white">'.$status->name.'</h4>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                            aria-label="Close">&times;
                    </button>
                </div>';
        return $html;
    }
    public function agent()
    {
        return $this->belongsTo('App\Models\User','agent_id');
    }
    public function scopeUserOrAgent($query){
        $user = auth()->user();
        if($user->IsAgent()){
           return $query->where('agent_id', $user->id);
        }else{
            return $query->where('user_id', $user->id);

        }
    }

    public function open_chat ()
    {
        $id = $this->id;
        $message = Message::where('entity_id',$id)->where('entity_type', PublicOrder::class)->whereNull('parent_id')->first();

        if (is_null($message)) {
            $user_id2 = $this->provider_id;
            if($user_id2 == \Auth::id()){
                $user_id2 = $this->user_id;
            }
            $message = new Message();
            $message->user_id = \Auth::id();
            $message->user_id2 = $user_id2;
            $message->subject = 'تعميد عام رقم '.$id;
            $message->message = 'تعميد عام رقم '.$id;
            $message->entity_id = $id;
            $message->entity_type = PublicOrder::class;
            $message->save();
            $message->users()->sync([
                \Auth::id() => ['entity_type' => User::class],
                $user_id2 => ['entity_type' => User::class]
            ]);
        }
        return $message;
    }
}
