<?php

namespace App\Http\Controllers;

use App\Helpers\Sletat;
use App\Helpers\Slideshow;
use App\Models\Blog;
use App\Models\Category;
use App\Models\News;
use App\Models\Tours;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class MainpageController extends Controller
{
	public function __construct(Slideshow $slideshow)
	{
		$this->middleware('loaderModules');

		View::share('slideshow', $slideshow->render());
	}
	
    public function index(Request $request, Sletat $sletat)
	{
        $list_news = Cache::remember('list_news_mainpage', 1440, function() {
            $data = News::whereActive(1)->with(['get_category'])->orderBy('updated_at', 'desc')->take(6)->get();
			foreach($data as $key => $value){
				$data[$key]['image'] = $value->getFirstMediaUrl('images', '250x250');
			}
			return $data;
        });
        $list_blog = Cache::remember('list_blog_mainpage', 1440, function() {
			$data = Blog::whereActive(1)->with(['get_category'])->orderBy('updated_at', 'desc')->take(6)->get();
			foreach($data as $key => $value){
				$data[$key]['image'] = $value->getFirstMediaUrl('images', '250x250');
			}
			return $data;
        });
		$list_tours = Cache::remember('list_tours_mainpage', 1440, function() {
			$data = Tours::whereActive(1)->with(['get_category'])->orderBy('updated_at', 'desc')->take(6)->get();
			foreach($data as $key => $value){
				$data[$key]['image'] = $value->getFirstMediaUrl('images', '250x250');
			}
			return $data;
		});

		View::share('list_news', $list_news);
		View::share('list_blog', $list_blog);
		View::share('list_tours', $list_tours);

        $data['country_id_sletat'] = 29;

		return view('santa.mainpage', $data);
	}
}
