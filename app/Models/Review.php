<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $user_id
 * @property int $provider_id
 * @property int $order_id
 * @property string $order_type
 * @property float $quality_of_service
 * @property float $execution_speed
 * @property float $professionalism_in_dealing
 * @property float $communication
 * @property float $deal_with_him_again
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCommunication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereDealWithHimAgain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereExecutionSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereProfessionalismInDealing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereQualityOfService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
}
