<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Landing extends Controller
{
    public function index(Request $request)
	{
		return view('landing.html', []);
	}
}
