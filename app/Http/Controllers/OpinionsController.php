<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use Illuminate\Http\Request;

use App\Http\Requests;

class OpinionsController extends Controller
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

		return view('santa.opinions.external', $data);
	}
}
