<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Page
 *
 * @property integer $id
 * @property string $title
 * @property string $category
 * @property string $short
 * @property string $description
 * @property string $url
 * @property string $date
 * @property string $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Seo $seo
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUpdatedAt($value)
 */
class Page extends Model
{
    protected $table = 'feed';

    protected $fillable = ['title', 'short', 'description', 'url', 'date', 'position', 'active'];

    public function seo()
    {
        return $this->hasOne('App\Models\Seo', 'id_connect');
    }
}
