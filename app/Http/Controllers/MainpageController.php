<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class MainpageController extends Controller
{
	public function __construct()
	{
		$this->middleware('loaderModules');
	}
	
    public function index()
	{
		$data['seo']['title'] = 'Santa-avia';

		View::share('list_news', Feed::whereCategory(1)->take(2)->get());

		return view('santa.mainpage', $data);
	}
}
