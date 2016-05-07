<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Category;
use App\Models\News;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');
	}
	
    public function index()
	{
		$data = Cache::remember('news_index', 60*24, function() {
			$data['data'] = News::whereActive(1)->orderBy('updated_at', 'desc')->paginate(20);
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

		return view('santa.news.item', $data);
	}
}
