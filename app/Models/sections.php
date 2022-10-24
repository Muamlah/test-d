<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\sections
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $img
 * @method static \Illuminate\Database\Eloquent\Builder|sections newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sections newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sections query()
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class sections extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_at', 'updated_at', 'name', 'img'
    ];
    protected $guarded = [];
}
