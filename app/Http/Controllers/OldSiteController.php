<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class OldSiteController extends Controller
{
	public function redirectVidy($item)
	{
		return redirect('/tours/vidy-otdykha/'.$item , 301);
	}

	public function redirectStrany($item)
	{
		return redirect('/tours/strany/'.$item , 301);
	}

	public function redirectResort($item)
	{
		if($get_category = Category::whereUrl($item)->with('get_parent')->first()){
			return redirect('/tours/strany/'.$get_category->get_parent->first()->url .'/'. $item , 301);
		}else{
			abort(404, 'Такой страницы больше нет');
		}
	}

	public function redirectArticle($item)
	{
		if($get_item = Blog::whereUrl($item)->with('get_category')->first()){
			return redirect('/blog/'.$get_item->get_category->url .'/'. $item , 301);
		}else{
			abort(404, 'Такой страницы больше нет');
		}
	}

	public function redirectArticles()
	{
		return redirect('/blog', 301);
	}

	public function redirectSletat()
	{
		return redirect('/sletat', 301);
	}

	public function redirectNews()
	{
		return redirect('/news', 301);
	}
}
