<?php

namespace App\Http\Controllers;

use App\Helpers\ContentPlugins;
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

	public function __construct()
	{
		$this->config = \Config::get('components.page');
		$this->middleware('loaderModules');
	}

    public function getItem($url, ContentPlugins $contentPlugins)
	{
		$data = Cache::remember('page'. $url, 60, function() use ($contentPlugins, $url) {
			$page = Page::whereUrl($url)->with(['get_seo', 'get_templates'])->firstOrFail();
			$page['images'] = $page->getMedia('images');
			$page['files'] = $page->getMedia('files');
			$data['data'] = $contentPlugins->renderGallery($page);
			$data['data'] = $contentPlugins->renderFilesGallery($page);
		    return $data;
		});

		if(\View::exists('front.page.'. $url)){
			return view('front.page.'. $url, $data);
		}else{
			return view('front.page.item', $data);
		}
	}
}
