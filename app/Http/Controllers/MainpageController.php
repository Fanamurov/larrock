<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Feed;
use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class MainpageController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');

        /* Краткая форма поиска от sletat */
        \View::share('SearchFormShort', $sletat->getSearchForm());
	}
	
    public function index()
	{
		$data['seo']['title'] = 'Santa-avia';

		View::share('list_news', Feed::whereCategory(1)->take(2)->get());

		return view('santa.mainpage', $data);
	}
}
