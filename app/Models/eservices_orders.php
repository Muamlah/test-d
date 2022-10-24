<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
/**
 * Class eservices_orders
 *
 * @package App\Models
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $eservice_id
 * @property int $user_id
 * @property string|null $agent_id
 * @property int $provider_id
 * @property string $details
 * @property float $fees
 * @property float $value_added_tax
 * @property float $total_amount
 * @property float $price
 * @property float $deserved_price
 * @property string|null $verify_code
 * @property int $status
 * @property string $pay_status
 * @property int $payment_gateway_fee
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string $client_cancellation
 * @property int $verify
 * @property float $provider_total_amount
 * @property float $provider_fees
 * @property float $provider_value_added_tax
 * @property int|null $payment_mathod_id
 * @property string|null $reference_code
 * @property string|null $owner_discount
 * @property string|null $user_discount
 * @property string|null $order_log
 * @property string|null $agent_per
 * @property string|null $cancel_reason
 * @property string|null $invoice_code
 * @property-read \App\Models\User|null $agent
 * @property-read \App\Models\CouponInstance|null $coupone_instance
 * @property-read \App\Models\eservices|null $eservices
 * @property-read \App\Models\PaymentMathod|null $paymentMathod
 * @property-read \App\Models\User|null $provider
 * @property-read \App\Models\User|null $providers
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WalletMuamlah[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders userOrAgent()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereEserviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereInvoiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereOrderLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentMathodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereUserDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereVerifyCode($value)
 * @mixin \Eloquent
 */
class eservices_orders extends Model
{
    use HasFactory;

    protected $guarded = [];
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
                '4'  , '5'  , '8'
            ],
        ],
        '5' => [
            'status' => 'confirm_completed',
            'next_allowed_statuses' => [
                '8'
            ],
        ],
        '6' => [
            'status' => 'canceled',
            'next_allowed_statuses' => [
                '7' , '8'
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
            'next_allowed_statuses' => [],
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
    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function getStatus(){
        return $this->hasOne(Status::class,'id','status');
    }
    public function providers()
    {
        return $this->belongsTo('App\Models\User','provider_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\User','provider_id');
    }


    public function eservices()
    {
        return $this->belongsTo('App\Models\eservices','eservice_id');
    }

    public function wallets()
    {
        return $this->hasMany(WalletMuamlah::class,'order_id', 'id');
    }

    public function paymentMathod() {
        return $this->belongsTo(PaymentMathod::class);
    } // end of paymentMathod

    public function createWallet($balance, $type, $description, $amount=null, $order_type="electronic"){
        $wallet = $this->wallets()->create([
            'amount'        => !is_null($amount) ? $amount : $this->price,
            'balance'       => $balance,
            'type'          => $type,
            'description'   => $description,
            'order_type'    => $order_type,
        ]);
    }
    public static function collectAvailableStatus()
    {
        return collect( static::$availableStatus );
    }
    public function coupone_instance(){
        return $this->hasOne(CouponInstance::class,'entity_id', 'id')->where('entity_type', eservices_orders::class);
    }

    /**
     * @param $status
     * @return bool
     */
    public function chechAvailableStatus($status): bool
    {
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
    public function statusName(){
        if(empty($this->getStatus)){
            return false;
        }else{
            return $this->getStatus->name;
        }
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
    // public function scopeUserOrAgent($query){
    //     $user = auth()->user();
    //     if($user->IsAgent()){
    //        $user_ids = $user->getAgentUsersIds();
    //        $user_ids[] = $user->id;
    //        return $query->whereIn('user_id', $user_ids);
    //     }else{
    //         return $query->where('user_id', $user->id);

    //     }
    // }

    public function agent()
    {
        return $this->belongsTo('App\Models\User','agent_id');
    }

    public function scopeUserOrAgent($query){
        $user = auth()->user();
        if($user->IsAgent()){
           return $query->where(function ($query) use ($user) {
               $query->where('agent_id', $user->id)
                   ->orWhere('user_id', $user->id);
           });
        }else{
            return $query->where('user_id', $user->id);

        }
    }

    protected static function booted()
    {
        static::created(function ($record) {
            // call zoho api to create new record
        });

        static::updated(function ($record) {
            // call zoho api to update record
        });

        static::deleted(function ($record) {
            // call zoho api to delete record
        });
    }

    public function open_chat ()
    {
        if(!in_array($this->status, [3])) return null;
        $id = $this->id;
        $message = Message::where('entity_id',$id)->where('entity_type', eservices_orders::class)->whereNull('parent_id')->first();

        if (is_null($message)) {
            $user_id2 = $this->provider_id;
            if($user_id2 == \Auth::id()){
                $user_id2 = $this->user_id;
            }
            $message = new Message();
            $message->user_id = \Auth::id();
            $message->user_id2 = $user_id2;
            $message->subject = 'خدمة الكترونية رقم '.$id;
            $message->message = 'خدمة الكترونية رقم '.$id;
            $message->entity_id = $id;
            $message->entity_type = eservices_orders::class;
            $message->save();
            $message->users()->sync([
                \Auth::id() => ['entity_type' => User::class],
                $user_id2 => ['entity_type' => User::class]
            ]);
        }
        return $message;
    }
}
