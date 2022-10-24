<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property string|null $image
 * @property string $title
 * @property string|null $details
 * @property string $type
 * @property string|null $key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $category
 * @property string|null $base_type
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBaseType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $guarded = [];
    protected $table = "pages";
    static $categories = [
        'eservices_page' => [
            'key' => 'eservices_page',
            'title' => 'دليل الخدمات الإلكترونية',
        ],
        'public_page' => [
            'key' => 'public_page',
            'title' => 'دليل خدمات التعميد العام',
        ],
        'private_page' => [
            'key' => 'private_page',
            'title' => 'دليل خدمات التعميد الخاص',
        ]
    ];

    static $types = [
        'all' => [
            'key' => 'all',
            'title' => 'للكل',
        ],
        'provider' => [
            'key' => 'provider',
            'title' => 'لمقدمي الخدمة',
        ],
        'user' => [
            'key' => 'user',
            'title' => 'للعملاء',
        ]
    ];

    public static function getCategories(){
        return static::$categories;
    }

    public static function getTypes(){
        return static::$types;
    }
}
