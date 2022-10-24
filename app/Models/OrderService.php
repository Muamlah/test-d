<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class OrderService
 *
 * @package App\Models
 * @property-read \App\Models\User $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OrderService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderService query()
 * @mixin \Eloquent
 */
class OrderService extends Model
{

    protected $table='order_services';
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function provider(){
        return $this->belongsTo(User::class,'provider_id','id');
    }
    public function offer(){
        return $this->belongsTo(Offer::class,'offer_id','id');
    }

}
