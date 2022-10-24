<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CreditCard
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $bank_name
 * @property string $name
 * @property string|null $email
 * @property string $account_number
 * @property string|null $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereUserId($value)
 * @mixin \Eloquent
 */
class CreditCard extends Model
{
protected $fillable=['user_id','bank_name','name','account_number','number', 'email'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
