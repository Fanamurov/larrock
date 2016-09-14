<?php

namespace App\Helpers;

use App\Models\Slideshow as Model_Slideshow;
use Cache;

class Slideshow{

    public function render()
	{

		$data = Cache::remember('slideshow_mainpage', 1440, function() {
			$data = Model_Slideshow::whereActive(1)->orderBy('position', 'desc')->get();
			foreach($data as $key => $value){
				$data[$key]['images'] = $value->getFirstMediaUrl('images', '755x255');
			}
		    return $data;
		});
		return $data;
	}
}