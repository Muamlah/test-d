<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use App\Models\Status;
/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $master_order
 * @property int $parent_order
 * @property int $user_phone
 * @property int $service_provider_phone
 * @property float $price
 * @property float|null $fees
 * @property float|null $total_amount
 * @property float|null $client_cancellation
 * @property float|null $value_added_tax
 * @property float|null $payment_gateway_fee
 * @property string $details
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string $pay_status
 * @property string $status
 * @property string $cancellation
 * @property string $verify
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder query()
 * @mixin \Eloquent
 * @property int|null $instance_id
 * @property string|null $agent_id
 * @property int|null $status_id
 * @property int|null $provider_id
 * @property float|null $deserved_price
 * @property string $deadline
 * @property float $proposed_value
 * @property string|null $verify_code
 * @property float|null $payable_service_provider
 * @property float|null $provider_fees
 * @property float|null $provider_value_added_tax
 * @property string|null $edit_details
 * @property string|null $edit_deadline
 * @property float|null $edit_price
 * @property int|null $payment_mathod_id
 * @property string|null $reference_code
 * @property string|null $owner_discount
 * @property string|null $user_discount
 * @property string|null $agent_per
 * @property string|null $cancel_reason
 * @property string|null $invoice_code
 * @property string|null $update_price
 * @property-read \App\Models\User|null $agent
 * @property-read \App\Models\CouponInstance|null $coupone_instance
 * @property-read \Illuminate\Database\Eloquent\Collection|PrivateOrder[] $followingOrders
 * @property-read int|null $following_orders_count
 * @property-read \App\Models\PrivateOrderInstance|null $instance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrivateOrderInstance[] $instanceOrders
 * @property-read int|null $instance_orders_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PaymentMathod|null $paymentMathod
 * @property-read \App\Models\User|null $providerById
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder userOrAgent()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereEditDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereEditDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereEditPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereInstanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereInvoiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereMasterOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereParentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePayableServiceProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentMathodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProposedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereServiceProviderPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUpdatePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUserDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUserPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereVerifyCode($value)
 */
class PrivateOrder extends Model
{
    use Notifiable;
    protected $fillable = ['status','user_id','status_id','provider_id', 'user_phone', 'service_provider_phone',
        'price', 'fees', 'total_amount', 'client_cancellation', 'value_added_tax',
        'payment_gateway_fee','deserved_price', 'details', 'deadline', 'verify_code', 'payable_service_provider',
        'provider_value_added_tax', 'provider_fees', 'edit_deadline', 'edit_details', 'edit_price','created_at','payment_status','parent_order','master_order','payment_mathod_id'];

    protected static $availableStatus = [
        '1' => [
            'status' => 'pending',
            'next_allowed_statuses' => [
                '2' , '6', '8', '11'
            ],
        ],
        '2' => [
            'status' => 'waiting',
            'next_allowed_statuses' => [
                '3', '6', '4', '11'
            ],
        ],
        '3' => [
            'status' => 'processing',
            'next_allowed_statuses' => [
                '4' , '6'  , '8', '11'
            ],
        ],
        '4' => [
            'status' => 'completed',
            'next_allowed_statuses' => [
                '4'  ,'5'  , '8', '11'
            ],
        ],
        '5' => [
            'status' => 'confirm_completed',
            'next_allowed_statuses' => [
                '8', '11'
            ],
        ],
        '6' => [
            'status' => 'canceled',
            'next_allowed_statuses' => [
                '7' , '8', '11'
            ],
        ],
        '7' => [
            'status' => 'confirm_canceled',
            'next_allowed_statuses' => [

            ],
        ],
        '8' => [
            'status' => 'report',
            'next_allowed_statuses' => [

            ],
        ],
        '11' => [
            'status' => 'confirm_completed',
            'next_allowed_statuses' => [
                    '11'
            ],
        ]

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
        '9' => 'bg-green1-dark',
        '10' => 'bg-green1-dark',
        '11' => 'bg-green1-dark',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function provider(){
        return $this->belongsTo(User::class,'service_provider_phone','phone');
    }

    public function providerById(){
        return $this->hasOne(User::class,'id','provider_id');
    }
    public function coupone_instance(){
        return $this->hasOne(CouponInstance::class,'entity_id', 'id')->where('entity_type', PrivateOrder::class);
    }
    public function instance(){
        return $this->hasOne(PrivateOrderInstance::class,'order_id', 'id')->latest();
    }
    public function getStatus(){
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function followingOrders(){
        return $this->hasMany(PrivateOrder::class,'master_order','id');
    }

    /**
     * @return HasMany
     */
    public function instanceOrders(): HasMany
    {
        return $this->hasMany(PrivateOrderInstance::class,'order_id','id');
    }

    public function paymentMathod() {
        return $this->belongsTo(PaymentMathod::class);
    } // end of paymentMathod

    public function getStatusHTML(){
        $status         = $this->getStatus;
        $html           = '';

        if(empty($status)){
            if($this->status == 'canceled'){
                $html = '
                    <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                        <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                        <h4 class="text-uppercase color-white">بانتظار تأكيد مقدم الخدمة لالغاء الطلب !</h4>
                        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                                aria-label="Close">&times;
                        </button>
                    </div>
                ';
            }elseif($this->status == 'report'){
                $html = '
                    <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                        <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                        <h4 class="text-uppercase color-white">تم فتح نزاع من قبل مقدم الخدمة !</h4>
                        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                                aria-label="Close">&times;
                        </button>
                    </div>
                ';
            }elseif($this->status == 'confirm_completed'){
                $html = '
                    <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                        <span><i class="fa fa-check"></i></span>
                        <strong>تم تأكيد استلام الطلب !</strong>
                        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                                aria-label="Close">&times;
                        </button>
                    </div>
                ';
            }elseif($this->status == 'completed'){
                $html = '
                    <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                        <span><i class="fa fa-check"></i></span>
                        <h4 class="text-uppercase color-white">بانتظار تأكيد العميل لاستلام الطلب !</h4>
                        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                                aria-label="Close">&times;
                        </button>
                    </div>
                ';
            }
        }


        $status_name    = $status->name;
        if($status->id == 6){
            $html = '
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">'.$status_name.' !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
            ';
        }elseif($status->id == 8){
            $html = '
                <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                    <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                    <h4 class="text-uppercase color-white">'.$status_name.' !</h4>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                            aria-label="Close">&times;
                    </button>
                </div>
            ';
        }elseif($status->id == 5){
            $html = '
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <strong>'.$status_name.' !</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                            aria-label="Close">&times;
                    </button>
                </div>
            ';
        }elseif($status->id == 11){
            $html = '
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <strong>'.$status_name.' !</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                            aria-label="Close">&times;
                    </button>
                </div>
            ';}elseif($status->id == 4){
            $html = '
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <h4 class="text-uppercase color-white">'.$status_name.' !</h4>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                            aria-label="Close">&times;
                    </button>
                </div>
            ';
        }
        return $html;
    }

    public function getStatusWithClass(){
        $status         = $this->getStatus;
        $html           = '';

        if(empty($status)){
            if($this->status == 'pending'){
                $html = '
                    <span class="bg-dark1-light rounded-xs text-uppercase font-900 font-14 pr-2 pl-2 pb-0 pt-0 line-height-s">
                        بإنتظارالمراجعة
                    </span>
                ';
            }elseif($this->status == 'processing'){
                $html = '
                    <span class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                        قيد التنفيذ
                    </span>
                ';
            }elseif($this->status == 'waiting'){
                $html = '
                    <span class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                       بانتظار موافقة مقدم الخدمة
                    </span>
                ';
            }elseif($this->status == 'canceled'){
                $html = '
                    <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                        ملغي
                    </span>
                ';
            }elseif($this->status == 'whatsapp'){
                $html = '
                    <span class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                    تنفيذ واتس اب

                    </span>
                ';
            }elseif($this->status == 'confirm_canceled'){
                $html = '
                    <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                        تم تأكيد الغاء الطلب
                    </span>
                ';
            }elseif($this->status == 'report'){
                $html = '
                    <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                        بلاغ
                    </span>
                ';
            }elseif($this->status == 'completed'){
                $html = '
                    <span class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                بانتظار استلام العميل

                    </span>
                ';
            }elseif($this->status == 'confirm_completed'){
                $html = '
                    <span class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                        تم التسليم
                    </span>
                ';
            }
            return ['type' => 'by_key' , 'html' => $html];
        }else{

            $status_name    = $status->name;

            if($status->id == 1){
                $class      = 'bg-dark1-light rounded-xs text-uppercase font-900 font-14 pr-2 pl-2 pb-0 pt-0 line-height-s';
            }elseif($status->id == 3 || $status->id == 2){
                $class      = 'bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s';
            }elseif($status->id == 6 || $status->id == 7 || $status->id == 8){
                $class      = 'bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s';
            }elseif($status->id == 4 || $status->id == 5 || $status->id == 11){
                $class      = 'bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s';
            }else{
                $class      = '';
            }

            return ['type' => 'by_id' , 'class' => $class , 'status_name' => $status_name];
        }
    }

    public function statusName(){
        if(empty($this->getStatus)){
            return false;
        }else{
            return $this->getStatus->name;
        }
    }

    public static function collectAvailableStatus()
    {
        return collect( static::$availableStatus );
    }

    public function chechAvailableStatus($status){
        if(!isset(static::$availableStatus[$status])) return false;
        return in_array($status, static::$availableStatus[$this->status_id]['next_allowed_statuses']);
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
        $status = $this->getStatus;
        $class = isset(static::$statusClasses[$status->id]) ? static::$statusClasses[$status->id] : 'bg-green1-dark';
        $html = '<span class="'.$class.' '.$addClass.' rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">'.$status->name.'</span>';
        return $html;
    }
    public function getHtmlStatusAlert($addClass=""){
        $status = $this->getStatus;
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
        if(!in_array($this->status_id, [1, 2 , 3, 5])) return null;
        $id = $this->id;
        $message = Message::where('entity_id',$id)->where('entity_type', PrivateOrder::class)->whereNull('parent_id')->first();

        if (is_null($message)) {
            $user_id2 = $this->provider_id;
            if($user_id2 == \Auth::id()){
                $user_id2 = $this->user_id;
            }
            $message = new Message();
            $message->user_id = \Auth::id();
            $message->user_id2 = $user_id2;
            $message->subject = 'تعميد خاص رقم '.$id;
            $message->message = 'تعميد خاص رقم '.$id;
            $message->entity_id = $id;
            $message->entity_type = PrivateOrder::class;
            $message->save();
            $message->users()->sync([
                \Auth::id() => ['entity_type' => User::class],
                $user_id2 => ['entity_type' => User::class]
            ]);
        }
        return $message;
    }
}
