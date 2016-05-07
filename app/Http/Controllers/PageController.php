<?php

namespace App\Http\Controllers;

use App\Helpers\ContentPlugins;
use App\Helpers\Sletat;
use App\Models\Blocks;
use App\Models\Menu;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
	protected $config;

	public function __construct(Sletat $sletat)
	{
		$this->config = \Config::get('components.page');
		$this->middleware('loaderModules');
	}

    public function getItem($url, ContentPlugins $contentPlugins)
	{
		$data = Cache::remember(md5('page'. $url), 60*24, function() use ($url, $contentPlugins) {
			$page = Page::whereUrl($url)->with(['get_seo', 'get_templates'])->firstOrFail();
			$page['images'] = $page->getMedia('images');
			$page['files'] = $page->getMedia('files');
			$data['data'] = $contentPlugins->renderGallery($page);
			return $data;
		});

		if(\View::exists('santa.page.'. $url)){
			return view('santa.page.'. $url, $data);
		}else{
			return view('santa.page.item', $data);
		}
	}
}
