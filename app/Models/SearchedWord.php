<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SearchedWord
 *
 * @property int $id
 * @property string $word
 * @property int $count
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord query()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord whereWord($value)
 * @mixin \Eloquent
 */
class SearchedWord extends Model
{
    protected $table = 'searched_words';

    public $timestamps = false;
}