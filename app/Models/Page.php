<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page find($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @mixin \Eloquent
 */
class Page extends Model implements HasMediaConversions
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

    protected $table = 'page';

    protected $fillable = ['title', 'short', 'description', 'url', 'date', 'position', 'active'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer'
	];

	protected $dates = ['created_at', 'updated_at', 'date'];

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}
}
