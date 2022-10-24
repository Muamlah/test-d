<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Status;


/**
 * App\Models\WpAbusmoApplications
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WpAbusmoApplications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WpAbusmoApplications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WpAbusmoApplications query()
 * @mixin \Eloquent
 */
class WpAbusmoApplications extends Model
{

    protected $table='wp_abusmo_applications';

    public $timestamps = false;
    
}
