<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatbotSession
 *
 * @property int $id
 * @property string $chatID
 * @property string $type
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereChatID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChatbotSession extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
}
