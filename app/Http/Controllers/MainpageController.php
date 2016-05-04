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
		//Форма от слетать
		$data = $sletat->getFullSearchForm($request);

		//Форма поиска туров по сайту
		$data['siteSearch'] = Cache::remember('siteSearch-form', 60, function() {
			$siteSearch['countries'] = Category::whereType('tours')->whereActive(1)->whereParent(308)->get(['title','id']);
			$siteSearch['resorts'] = Category::whereType('tours')->whereActive(1)->where('parent', '!=', 308)->where('parent', '!=', 377)->where('parent', '!=', 0)->get(['title','id']);
			$siteSearch['vidy'] = Category::whereType('tours')->whereActive(1)->whereParent(377)->get(['title','id']);
		    return $siteSearch;
		});

        $list_news = Cache::remember('list_news_mainpage', 600, function() {
            return News::whereActive(1)->with(['get_category'])->orderBy('updated_at', 'desc')->take(6)->get();
        });
        $list_blog = Cache::remember('list_blog_mainpage', 600, function() {
            return Blog::whereActive(1)->with(['get_category'])->orderBy('updated_at', 'desc')->take(6)->get();
        });
		$list_tours = Cache::remember('list_tours_mainpage', 600, function() {
			return Tours::whereActive(1)->with(['get_category'])->orderBy('updated_at', 'desc')->take(6)->get();
		});

		View::share('list_news', $list_news);
		View::share('list_blog', $list_blog);
		View::share('list_tours', $list_tours);

		$data['best_cost'] = Cache::remember('best_cost_mainpage', 60, function() use ($sletat) {
			return $sletat->GetTours(1286, 29, [], 3);
		});
		if( !array_key_exists('best_cost', $data)){
			Cache::forget('best_cost_mainpage');
		}else{
			if($data['best_cost']['iTotalRecords'] < 1){
				Cache::forget('best_cost_mainpage');
			}
		}

		return view('santa.mainpage', $data);
	}
}
