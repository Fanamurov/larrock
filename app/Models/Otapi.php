<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Otapi extends Model implements HasMediaConversions
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

	protected $table = 'otapi';
}
