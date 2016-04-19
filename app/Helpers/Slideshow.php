<?php

namespace App\Helpers;

use App\Models\Slideshow as Model_Slideshow;
use Cache;

class Slideshow{

    public function render()
	{

		$data = Cache::remember('slideshow_mainpage', 60, function() {
			$data['big'] = Model_Slideshow::whereActive(1)->whereView(1)->get();
			foreach($data['big'] as $key => $value){
				$data['big'][$key]['images'] = $value->getMedia('images')->sortByDesc('order_column');
			}
			$data['small'] = Model_Slideshow::whereActive(1)->whereView(0)->take(3)->get();
			foreach($data['small'] as $key => $value){
				$data['small'][$key]['images'] = $value->getMedia('images')->sortByDesc('order_column');
			}
		    return $data;
		});
		return $data;
	}
}