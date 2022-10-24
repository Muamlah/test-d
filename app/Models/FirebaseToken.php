<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FirebaseToken
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $token
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $eservices_orders_notifications
 * @property string $public_private_orders_notifications
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereEservicesOrdersNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken wherePublicPrivateOrdersNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereUserId($value)
 * @mixin \Eloquent
 */
class FirebaseToken extends Model
{
    protected $fillable = [
        'token',
        'type',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
