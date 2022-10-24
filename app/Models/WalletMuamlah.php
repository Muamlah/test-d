<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WalletMuamlah
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $order_id
 * @property string|null $order_type
 * @property float|null $amount
 * @property float|null $balance
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PrivateOrder|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereUpdatedAt($value)
 */
class WalletMuamlah extends Model
{
    protected $table='wallet_muamlah';
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(PrivateOrder::class,'order_id','id');
    }

}
