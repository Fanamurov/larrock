<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
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

		\View::share('header_email', Blocks::whereUrl('header-email')->first());
		\View::share('header_slogan', Blocks::whereUrl('header-slogan')->first());
		\View::share('contentBottom', Blocks::whereUrl('header-slogan')->first());
	}

    public function getItem($url = 'test')
	{
		$page = Page::whereUrl($url)->first();
		$page->addMedia(public_path().'/images/page/big/ek_111.png')->withCustomProperties(['test' => '1', 'two' => 'other'])->preservingOriginal()->toMediaLibrary('images');
		$mediaItems = $page->getMedia('images');
		echo $page->getFirstMediaUrl('images', '110x110');

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
