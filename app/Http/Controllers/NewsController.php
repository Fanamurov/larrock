<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
	public function __construct()
	{
		$this->middleware('loaderModules');
	}
	
    public function index()
	{
		$data['seo']['title'] = 'Feed Santa-avia';
		$data['data'] = Category::whereType('news')->whereActive(1)->whereLevel(1)->with(['get_feedActive'])->first();

		return view('santa.news.category', $data);
	}

	public function getItem($item)
	{
		$data['seo']['title'] = 'Feed Santa-avia';
		$data['data'] = Feed::whereUrl($item)->first();
		$data['category'] = Category::whereType('news')->whereActive(1)->whereLevel(1)->first();

		return view('santa.news.item', $data);
	}
}
