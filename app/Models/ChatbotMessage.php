<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatbotMessage
 *
 * @property int $id
 * @property string $chatId
 * @property int $user_id
 * @property string $type
 * @property string $message
 * @property string $file
 * @property string $response
 * @property string $status
 * @property string $sent_at
 * @property string $delivered_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereDeliveredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereUserId($value)
 * @mixin \Eloquent
 */
class ChatbotMessage extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
}
