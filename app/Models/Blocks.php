<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * App\Models\Blocks
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property integer $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Blocks whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Blocks extends Model implements HasMediaConversions
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

	protected $table = 'blocks';

	protected $fillable = ['title', 'short', 'description', 'url', 'position', 'active'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer'
	];

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id')->whereTypeConnect('blocks');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id')->whereTypeConnect('blocks');
	}
}
