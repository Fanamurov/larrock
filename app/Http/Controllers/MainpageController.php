<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Helpers\Slideshow;
use App\Models\Blog;
use App\Models\News;
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

		View::share('list_news', News::whereActive(1)->orderBy('date', 'desc')->take(2)->get());
		View::share('list_blog', Blog::whereActive(1)->orderBy('date', 'desc')->take(2)->get());

		return view('santa.mainpage', $data);
	}
}
