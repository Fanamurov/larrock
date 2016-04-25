<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Helpers\Slideshow;
use App\Models\Blog;
use App\Models\News;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class MainpageController extends Controller
{
	public function __construct(Sletat $sletat, Slideshow $slideshow)
	{
		$this->middleware('loaderModules');

        /* Краткая форма поиска от sletat */
        \View::share('SearchFormShort', $sletat->getSearchForm());

		View::share('slideshow', $slideshow->render());
	}
	
    public function index()
	{
		$data['seo']['title'] = 'Santa-avia';

        $list_news = Cache::remember('list_news_mainpage', 600, function() {
            return News::whereActive(1)->orderBy('date', 'desc')->take(4)->get();
        });
        $list_blog = Cache::remember('list_blog_mainpage', 600, function() {
            return Blog::whereActive(1)->orderBy('date', 'desc')->take(4)->get();
        });

		View::share('list_news', $list_news);
		View::share('list_blog', $list_blog);

		return view('santa.mainpage', $data);
	}
}
