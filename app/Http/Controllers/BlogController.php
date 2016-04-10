<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Category;
use App\Models\Feed;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');

        /* Краткая форма поиска от sletat */
        \View::share('SearchFormShort', $sletat->getSearchForm());
	}
	
    public function index()
	{
		$data['seo']['title'] = 'Opinions Santa-avia';
		$data['data'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->with(['get_feedActive', 'get_childActive'])->first();

		return view('santa.blog.category', $data);
	}

	public function getItem($item)
	{
		$data['seo']['title'] = 'Opinions Santa-avia';
		$data['data'] = Feed::whereUrl($item)->first();
		$data['category'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->with(['get_childActive'])->first();

		return view('santa.blog.item', $data);
	}
}
