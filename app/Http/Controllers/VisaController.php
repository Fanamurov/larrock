<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Category;
use App\Models\Visa;
use Illuminate\Http\Request;

use App\Http\Requests;

class VisaController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');

        /* Краткая форма поиска от sletat */
        \View::share('SearchFormShort', $sletat->getSearchForm());
	}
	
    public function index()
	{
		$data['data'] = Visa::whereActive(1)->paginate(30);
		$data['category'] = Category::whereType('visa')->first();

		return view('santa.visa.category', $data);
	}

	public function getItem($item)
	{
		$data['data'] = Visa::whereUrl($item)->first();
		$data['category'] = Category::whereType('visa')->whereActive(1)->whereLevel(1)->with(['get_visaActive'])->first();

		return view('santa.visa.item', $data);
	}
}
