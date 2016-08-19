<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;
use View;

class PageController extends Controller
{
	protected $config;

	public function __construct()
	{
		$this->config = \Config::get('components.page');
		Breadcrumbs::register('otapi.index', function($breadcrumbs){
			$breadcrumbs->push('Контакты', route('otapi.index'));
		});
	}
	
	public function getContact()
	{
		return view('tbkhv.page.contact');
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
