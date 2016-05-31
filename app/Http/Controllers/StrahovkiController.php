<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StrahovkiController extends Controller
{
	public function __construct()
	{
		$this->middleware('loaderModules');
	}

    public function success()
	{
		return view('santa.strahovki.success');
	}
	
	public function fail()
	{
		return view('santa.strahovki.fail');
	}
}
