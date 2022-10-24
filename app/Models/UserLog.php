<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserLog
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string|null $user_email
 * @property string|null $price
 * @property string|null $action
 * @property string|null $description
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUserName($value)
 * @mixin \Eloquent
 */
class UserLog extends Model
{

    protected $table        = 'users_logs';
    protected $guarded      = [];
    
}
