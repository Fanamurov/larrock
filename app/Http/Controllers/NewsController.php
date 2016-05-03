<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');

        /* Краткая форма поиска от sletat */
        \View::share('SearchFormShort', $sletat->getSearchForm());
	}
	
    public function index()
	{
		$data['data'] = News::whereActive(1)->orderBy('updated_at', 'desc')->paginate(20);
		$data['category'] = Category::whereType('news')->first();

		return view('santa.news.category', $data);
	}

	public function getItem($item)
	{
		$data['data'] = News::whereUrl($item)->first();
		$data['category'] = Category::whereType('news')->whereActive(1)->whereLevel(1)->first();

		return view('santa.news.item', $data);
	}
}
