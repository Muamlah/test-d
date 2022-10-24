<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * Class CreditCard
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ForbiddenWord extends Model
{

    protected $table='forbidden_words';
    protected $fillable=['name','description'];

}
