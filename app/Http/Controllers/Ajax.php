<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use Cart;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Ajax extends Controller
{
	public function sharingCounter(Request $request)
	{
		$pass_types = ['magic', 'tours', 'category', 'blog', 'news', 'hotels'];
		$type = $request->get('type', '');
		$id = $request->get('id', '');
		if(empty($type) OR empty($id)){
			return false;
		}
		if( !in_array($type, $pass_types)){
			return false;
		}
		if(\DB::table($type)->where('id', $id)->increment('sharing')){
			echo 'OK';
		}else{
			echo 'ERROR DB';
		}
	}

	public function getResortsByCountry(Request $request)
	{
		$get_resorts = Category::whereUrl($request->get('country'))->with(['get_childActive'])->first();
		return response()->json($get_resorts->get_childActive);
	}
}
