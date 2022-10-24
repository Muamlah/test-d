<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\eservices
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $img
 * @property string $service_name
 * @property string $details
 * @property int $price
 * @property string $status
 * @property string $section_id
 * @property string $how_do
 * @property int|null $views
 * @property int|null $shares
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $customers
 * @property-read int|null $customers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $providers
 * @property-read int|null $providers_count
 * @property-read \App\Models\sections|null $sections
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|eservices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices query()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereHowDo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereServiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereShares($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereViews($value)
 * @mixin \Eloquent
 */
class eservices extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sections()
    {
        return $this->belongsTo('App\Models\sections','section_id');
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'favoriteable', 'user_favoriteable');
    }
    public function providers()
    {
        return $this->morphToMany(User::class, 'favoriteable', 'user_favoriteable')->where('level', 'provider');
    }
    public function customers()
    {
        return $this->morphToMany(User::class, 'favoriteable', 'user_favoriteable')->where('level', 'user');
    }


}
