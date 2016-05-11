<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Category;
use App\Models\News;
use Breadcrumbs;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');

        Breadcrumbs::register('news.index', function($breadcrumbs)
        {
            $breadcrumbs->push('Новости', '/news');
        });
	}
	
    public function index(Request $request)
	{
		$page = $request->get('page', 1);
		Cache::forget('news_index'.$page);
		$data = Cache::remember('news_index'.$page, 60*24, function() use ($page) {
			$data['data'] = News::whereActive(1)->orderBy('updated_at', 'desc')->skip(($page-1)*20)->paginate(20);
			$data['category'] = Category::whereType('news')->first();
		    return $data;
		});

		return view('santa.news.category', $data);
	}

	public function getItem($item)
	{
		$data = Cache::remember(md5('news_item'. $item), 60*24, function() use ($item) {
			$data['data'] = News::whereUrl($item)->first();
			$data['category'] = Category::whereType('news')->whereActive(1)->whereLevel(1)->first();
		    return $data;
		});

        Breadcrumbs::register('news.item', function($breadcrumbs) use ($data)
        {
            $breadcrumbs->parent('news.index');
            $breadcrumbs->push($data['data']->title);
        });

		return view('santa.news.item', $data);
	}
}
