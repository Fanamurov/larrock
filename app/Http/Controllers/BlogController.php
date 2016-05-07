<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Feed;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
	public function __construct(Sletat $sletat)
	{
		$this->middleware('loaderModules');
	}
	
    public function index()
	{
		$data = Cache::remember('blog_index', 60*24, function() {
			$data['category'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->orderBy('updated_at', 'desc')->with(['get_blogActive'])->get();
			$data['data'] = Blog::whereActive(1)->with('get_category')->orderBy('updated_at', 'desc')->paginate(15);
			return $data;
		});


		return view('santa.blog.index', $data);
	}

	public function show($category)
	{
		$data = Cache::remember('blog_'.$category, 60*24, function() use ($category) {
			$data['categorys'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->orderBy('updated_at', 'desc')->with(['get_blogActive'])->get();
			$data['category'] = Category::whereUrl($category)->whereActive(1)->with(['get_blogActive'])->first();
			$data['data'] = Blog::whereActive(1)->whereCategory($data['category']->id)->orderBy('updated_at', 'desc')->paginate(15);
			return $data;
		});
		return view('santa.blog.category', $data);
	}

	public function getItem($category, $item)
	{
		$data = Cache::remember(md5('blog_item_'. $item), 60*24, function() use ($item, $category) {
			$data['data'] = Blog::whereUrl($item)->first();
			$data['category'] = Category::whereUrl($category)->whereActive(1)->first();
			$data['categorys'] = Category::whereType('blog')->whereActive(1)->whereLevel(1)->with(['get_blogActive'])->get();
			return $data;
		});

		if(\View::exists('santa.blog.'. $item)){
			return view('santa.blog.'. $item, $data);
		}else{
			return view('santa.blog.item', $data);
		}
	}
}
