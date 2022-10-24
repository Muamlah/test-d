<?php

namespace App\Models;

use App\Models\PublicOrder;
use App\Models\PrivateOrder;
use App\Models\eservices_orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class CreditCard
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read eservices_orders|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUserId($value)
 * @mixin \Eloquent
 */
class Invoices extends Model
{

    protected $table='invoices';
    protected $fillable=['order_id','type','user_id'];

    public function order(): BelongsTo
    {
        if($this->type == 'public'){

        return $this->belongsTo(PublicOrder::class,'order_id','id');

        }elseif ($this->type == 'private'){

            return $this->belongsTo(PrivateOrder::class,'order_id','id');
        }
        else{

            return $this->belongsTo(eservices_orders::class,'order_id','id');
        }
    }
}
