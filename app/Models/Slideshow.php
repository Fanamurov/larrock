<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * App\Models\Slideshow
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $banner_url
 * @property string $view
 * @property string $url
 * @property integer $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereBannerUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereView($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slideshow whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slideshow extends Model implements HasMediaConversions
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

		$this->addMediaConversion('230x140')
			->setManipulations(['w' => 230, 'h' => 140])
			->performOnCollections('images');

		$this->addMediaConversion('755x255')
			->setManipulations(['w' => 755, 'h' => 255, 'fit' => 'crop'])
			->performOnCollections('images');
    }

	protected $table = 'slideshow';

	protected $fillable = ['title', 'short', 'description', 'banner_url', 'view', 'url', 'position', 'active'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer',
		'view' => 'integer'
	];
}
