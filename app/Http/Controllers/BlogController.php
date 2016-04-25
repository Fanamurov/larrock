<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Blog;
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
		$data['category'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->with(['get_blogActive'])->get();
		$data['data'] = Blog::whereActive(1)->paginate(15);

		return view('santa.blog.index', $data);
	}

	public function show($category)
	{
		$data['category'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->with(['get_blogActive'])->get();
		$data['data'] = Category::whereUrl($category)->whereActive(1)->with(['get_blogActive'])->first();
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
