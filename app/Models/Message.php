<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $user_id2
 * @property int|null $admin_id
 * @property string|null $name
 * @property string|null $email
 * @property string $subject
 * @property string $message
 * @property int|null $parent_id
 * @property string|null $seen
 * @property string|null $file
 * @property int|null $entity_id
 * @property string|null $entity_type
 * @property string|null $reply_at
 * @property string|null $reply
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $seen_by_admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin[] $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Message[] $children
 * @property-read int|null $children_count
 * @property-read Message|null $parent
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Message chatUsers($user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReplyAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSeenByAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId2($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $table='messages';

    /**
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'message_users','message_id', 'entity_id');
    }

    /**
     * @return BelongsToMany
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class,'message_users','message_id', 'entity_id')->wherePivot('entity_type', Admin::class);
    }

    /**
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeChatUsers($query, $user_id){
        return $query->where(function($q) use ($user_id){
            $q->whereHas('users', function($q) use ($user_id){
                return $q->where('users.id', $user_id);
            })->orWhereHas('admins', function($q) use ($user_id){
                return $q->where('admins.id', $user_id);
            });
        });
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Message::class,'parent_id', 'id');

    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Message::class,'parent_id', 'id');

    }

    /**
     * @param $type
     * @return string
     */
    public function getFile($type = 'file'): string
    {
        if(is_null($this->file)) return "";
        $file = asset($this->file);
        if($type == 'file'){
            return $file;
        }else{
            $imageMimeTypes = ['jpeg','gif','png','jpg'];
            $ext = @pathinfo($file, PATHINFO_EXTENSION);
            if(in_array($ext, $imageMimeTypes)){
                return "image";
            }else{
                return "file";
            }
        }
    }
}
