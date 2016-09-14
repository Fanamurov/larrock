<?php

namespace App\Http\Controllers;

use App\Helpers\ContentPlugins;
use App\Helpers\Sletat;
use App\Models\Category;
use App\Models\News;
use Breadcrumbs;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
	public function __construct()
	{
		$this->middleware('loaderModules');

        Breadcrumbs::register('news.index', function($breadcrumbs)
        {
            $breadcrumbs->push('Новости', '/news');
        });
	}
	
    public function index(Request $request)
	{
		$page = $request->get('page', 1);
		//Cache::forget('news_index'.$page);
		$data = Cache::remember('news_index'.$page, 1440, function() use ($page) {
			$data['data'] = News::whereActive(1)->orderBy('updated_at', 'desc')->skip(($page-1)*8)->paginate(8);
			$data['category'] = Category::whereType('news')->first();
		    return $data;
		});

		return view('santa.news.category', $data);
	}

	public function getItem(ContentPlugins $contentPlugins, $item)
	{
		$data = Cache::remember(md5('news_item'. $item), 1440, function() use ($item, $contentPlugins) {
			$data['data'] = News::whereUrl($item)->firstOrFail();
			$data['category'] = Category::whereType('news')->whereActive(1)->whereLevel(1)->first();
            $data['data']['images'] = $data['data']->getMedia('images');

			//Замена баксов на рубли по курсу ЦБ
			$re = "/[0-9]*\\$/m";
			preg_match_all($re, $data['data']->description, $matches);
			if(array_key_exists(0, $matches)){
				foreach($matches[0] as $value){
					$cost = explode('$', $value);
					$data['data']->description = preg_replace("/>$cost[0]*\\$/m", '>'.$this->Cbrf($cost[0]) .' руб.', $data['data']->description);
					$data['data']->description = preg_replace("/ $cost[0]*\\$/m", ' '.$this->Cbrf($cost[0]) .' руб.', $data['data']->description);
				}
			}

            $data['data'] = $contentPlugins->renderGallery($data['data']);
		    return $data;
		});

        Breadcrumbs::register('news.item', function($breadcrumbs) use ($data)
        {
            $breadcrumbs->parent('news.index');
            $breadcrumbs->push($data['data']->title);
        });

		\View::share('sharing_type', 'news');
		\View::share('sharing_id', $data['data']->id);

		return view('santa.news.item', $data);
	}

	protected function Cbrf($cost)
	{
		$dollar = Cache::remember('dollar_cb', 1440, function(){
			$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y')); // раскладываем xml на массив
			return ceil($xml->Valute[9]->Value);
		});
		return ceil(($dollar * $cost) * 1.03);
	}
}
