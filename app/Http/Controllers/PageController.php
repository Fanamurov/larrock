<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
	protected $config;

	public function __construct()
	{
		$this->config = \Config::get('components.page');
	}

    public function getItem($url)
	{
		if( !$data['data'] = Page::with([
				'get_seo' => function($query){
					$query->whereTypeConnect($this->config['name']);
				},
				'get_templates'=> function($query){
					$query->whereTypeConnect($this->config['name']);
				},
				'get_images'=> function($query){
					$query->whereTypeConnect($this->config['name']);
				}]
		)->whereUrl($url)->first()){
			abort('404', 'Page not found');
		}



		return view('front.page.item', $data);
	}
}
