<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favorite
 *
 * @property int $user_id
 * @property string $favoriteable_type
 * @property int $favoriteable_id
 * @property-read \App\Models\User|null $provider
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereFavoriteableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereFavoriteableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereUserId($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    protected $table = "user_favoriteable";

    public function provider()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->where('level', 'provider');
    }
    

}
