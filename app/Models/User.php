<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\eservices;
use App\Models\BankAccount;
use App\Models\CreditCard;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $logo
 * @property string|null $name
 * @property string $phone
 * @property string|null $email
 * @property string|null $password
 * @property int|null $city
 * @property string|null $level
 * @property string|null $api_token
 * @property int $active
 * @property string|null $verification_code
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property mixed $available_balance
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @mixin \Eloquent
 * @property string|null $full_name
 * @property string|null $reference_code
 * @property string|null $file
 * @property string|null $address
 * @property string|null $nationality
 * @property string|null $is_agent
 * @property string|null $in_review
 * @property float $total_balance
 * @property float $pinding_balance
 * @property string $status
 * @property string|null $image
 * @property string|null $commercial_register
 * @property string|null $bio
 * @property string|null $work_status
 * @property int $verified
 * @property string|null $activation_type
 * @property string|null $email_code
 * @property string|null $phone_code
 * @property string|null $v_code
 * @property int|null $agent_id
 * @property string|null $balance_withdrawal
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $linkedin
 * @property string|null $twitter
 * @property string|null $whatsapp
 * @property string|null $added_to_zoho
 * @property string|null $zoho_response_code
 * @property string|null $zoho_response
 * @property-read User|null $Agent
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $AgentUsers
 * @property-read int|null $agent_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $Transactions
 * @property-read int|null $transactions_count
 * @property-read BankAccount|null $bank
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read CreditCard|null $creditCard
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\eservices_orders[] $eservicesOrders
 * @property-read int|null $eservices_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\eservices_orders[] $eservicesOrdersReport
 * @property-read int|null $eservices_orders_report_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrivateOrder[] $privateOrders
 * @property-read int|null $private_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrivateOrder[] $privateOrdersReport
 * @property-read int|null $private_orders_report_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PublicOrder[] $publicOrders
 * @property-read int|null $public_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PublicOrder[] $publicOrdersReport
 * @property-read int|null $public_orders_report_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|eservices[] $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FirebaseToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddedToZoho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvailableBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalanceWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCommercialRegister($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePindingBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTotalBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerificationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWorkStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZohoResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZohoResponseCode($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'full_name',
        'email',
        'password',
        'phone',
        'active',
        'level',
        'remember_token',
        'verification_code',
        'available_balance',
        'pinding_balance',
        'total_balance',
        'commercial_register',
        'reference_code'
    ];

    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function services()
    {
        return $this->morphedByMany(eservices::class, 'favoriteable', 'user_favoriteable')->withPivot('price','date');
    }


    /**
     * @return int
     */
    public function hasVerifiedPhone(): int
    {
        return $this->active;
    }

    /**
     * @return HasOne
     */
    public function creditCard(): HasOne
    {
        return $this->hasOne(CreditCard::class);
    }
    public function bank(){
        return $this->hasOne(BankAccount::class,'user_id','id');
    }
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return HasMany
     */
    public function publicOrders(): HasMany
    {
        return $this->hasMany(PublicOrder::class);
    }

    /**
     * @return HasMany
     */
    public function privateOrders(): HasMany
    {
        return $this->hasMany(PrivateOrder::class);
    }

    /**
     * @return HasMany
     */
    public function eservicesOrders(): HasMany
    {
        return $this->hasMany(eservices_orders::class);
    }

    public function publicOrdersReport(): HasMany
    {
        return $this->hasMany(PublicOrder::class)->where('status',8);
    }

    /**
     * @return HasMany
     */
    public function privateOrdersReport(): HasMany
    {
        return $this->hasMany(PrivateOrder::class)->where('status_id',8);
    }

    /**
     * @return HasMany
     */
    public function eservicesOrdersReport(): HasMany
    {
        return $this->hasMany(eservices_orders::class)->where('status',8);
    }

     /**
     * @return HasMany
     */
    public function coupon(): HasOne
    {
        return $this->HasOne(Coupon::class, 'code', 'reference_code');
    }

    /**
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'provider_id');
    }

    public function avgReviews()
    {
        return $this->reviews()
            ->selectRaw('
        avg(quality_of_service) as quality_of_service,
        avg(execution_speed) as execution_speed,
        avg(professionalism_in_dealing) as professionalism_in_dealing,
        avg(communication) as communication,
        avg(deal_with_him_again) as deal_with_him_again,
        provider_id')
            ->groupBy('provider_id');
    }

    /**
     * @return HasMany
     */
    public function Transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(FirebaseToken::class);
    }

    public function getImage()
    {
        return !is_null($this->image) ?  asset('/storage') . '/' . $this->image : asset("/template-muamlah/images/pictures/faces/1s.png");
    }

    public function createTransaction($amount, $type, $description)
    {
        $wallet = $this->Transactions()->create([
            'amount'        => $amount,
            'type'          => $type,
            'description'   => $description
        ]);
    }

    public function getFile($type = 'file')
    {
        if (is_null($this->file)) return "";
        $file = asset($this->file);
        return $file;
    }

    public function getCommercialRegister($type = 'file')
    {
        if (is_null($this->commercial_register)) return "";
        $file = asset($this->commercial_register);
        return $file;
    }

    public function getQrCode(){
        $timestamp = \Carbon\Carbon::parse($this->created_at)->timestamp;
        $file_name = $timestamp . '-' . $this->id;
        $origin_path = '/qr_images/'.$file_name.'.png';
        $path = public_path() . $origin_path;
        if(file_exists($path)){
            return asset('/public'.$origin_path);
        }
    }

    public function getName(){
        if(!empty($this->full_name)){
            return " ".$this->full_name;
        }
        if(!empty($this->name)){
            return " ".$this->name;
        }
        if(!empty($this->phone)){
            return " ".$this->phone;
        }
        return " منصة معاملة ";
    }
    public function getFirstName(){

        if(!empty($this->name)){
            return " ".$this->name;
        }
        if(!empty($this->full_name)){
            return " ".$this->full_name;
        }
        if(!empty($this->phone)){
            return " ".$this->phone;
        }
        return " منصة معاملة ";
    }
    static public function providersIds(){
        $ids = [];
        $providers = User::where('level', 'provider')->whereHas('tokens')->get();
        if(count($providers)){
            $ids = $providers->pluck('id')->toArray();
        }
        return $ids;
    }

    static public function providers(){
        $providers = User::where('level', 'provider')->get();
        return $providers;
    }

    static public function favProviders($service_id){
        $providers = User::where('level', 'provider')->whereHas('services', function($q) use ($service_id){
            $q->where('favoriteable_id', $service_id)->where('favoriteable_type', eservices::class);
        })->get();
        return $providers;
    }

    public function createCoupon(){
        $settings = \App\Models\Settings::first();
        $owner_discount = $settings->reference_code_discount_for_owner;
        $user_discount = $settings->reference_code_discount_for_user;
        $coupon = Coupon::where('owner_id', $this->id)->where('code', $this->reference_code)->first();
        if(!is_null($coupon)){
            return $coupon;
        }
        $coupon = new Coupon;
        $coupon->code = $this->reference_code;
        $coupon->discount = $user_discount;
        $coupon->owner_id = $this->id;
        $coupon->owner_discount = $owner_discount;
        $coupon->instances_count = 1000;
        $coupon->discount_type = 'percentage';
        $coupon->type = 'coupon';
        $coupon->number_of_use = 100;
        $coupon->max_discount = 100;
        $coupon->end_date = \Carbon\Carbon::now()->addMonths(12)->format('Y-m-d');
        $coupon->save();
        return $coupon;
    }

    public function Agent(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'agent_id');
    }
    public function getAgentId()
    {
        if(!is_null($this->agent_id)){
            return $this->agent_id;
        }
        return 0;
    }
    public function checkOrderFrom(){
        if($this->getAgentId() == auth()->user()->id){
            return true;
        }
        return false;
    }

    public function checkOrderFromLabel($order){

        if($this->checkOrderFrom()){
            return "<span style='color:#ba881f;font-size:13px;font-weight: bold;'>(هذا الطلب من موكلك ".$order->user->getName().")</span>";
        }
        return "";
    }

    public function IsAgent()
    {
        if($this->is_agent == 1 && $this->in_review == 0){
            return true;
        }
        return false;
    }

    public function AgentUsers(): hasMany
    {
        return $this->hasMany(User::class, 'agent_id', 'id');
    }

    /**
     * @return array
     */
    public function getAgentUsersIds(): array
    {
        return $this->AgentUsers()->pluck('id')->toArray();
    }

    /**
     * @param $order
     * @return bool
     */
    public function chackUserAvailability($order): bool
    {
       if(empty($order)) return false;
       if($this->id == $order->user_id || $this->id == $order->agent_id){
           return true;
       }
       return false;
    }
}
