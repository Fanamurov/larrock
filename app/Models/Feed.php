<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * App\Models\Feed
 *
 * @property integer $id
 * @property string $title
 * @property string $category
 * @property string $short
 * @property string $description
 * @property string $url
 * @property string $date
 * @property integer $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed find($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed categoryInfo()
 */
class Feed extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    public function registerMediaConversions()
    {
        $this->addMediaConversion('110x110')
            ->setManipulations(['w' => 110, 'h' => 110])
            ->performOnCollections('images');

        $this->addMediaConversion('140x140')
            ->setManipulations(['w' => 140, 'h' => 140])
            ->performOnCollections('images');
    }

    protected $table = 'feed';

	protected $fillable = ['title', 'short', 'description', 'category', 'url', 'date', 'position', 'active'];

    protected $dates = ['created_at', 'updated_at', 'date'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer'
	];

	public function scopeCategoryInfo()
	{
		return DB::table('feed')
			->leftJoin('category', 'feed.category', '=', 'category.id')
			->get();
	}

	public function get_category()
	{
		return $this->hasOne('App\Models\Category', 'id', 'category');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}
}
