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

		$this->addMediaConversion('695x250')
			->setManipulations(['w' => 695, 'h' => 250])
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
