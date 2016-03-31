<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OpinionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('loaderModules');
	}

	public function index()
	{
		$data['seo']['title'] = 'Opinions Santa-avia';

		return view('santa.opinions.external', $data);
	}
}
