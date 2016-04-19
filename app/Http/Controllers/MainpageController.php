<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Helpers\Slideshow;
use App\Models\Feed;
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

		View::share('list_news', Feed::whereCategory(1)->take(2)->get());

		return view('santa.mainpage', $data);
	}
}
