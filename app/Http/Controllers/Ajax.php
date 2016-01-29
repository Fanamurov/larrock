<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Ajax extends Controller
{
    public function editPerPage(Request $request)
	{
		$response = new \Illuminate\Http\Response('perPage');
		$response->withCookie(cookie('perPage', $request->get('q'), 45000));
		return $response;
	}
}
