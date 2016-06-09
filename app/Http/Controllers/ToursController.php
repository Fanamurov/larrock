<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tours;
use Breadcrumbs;
use Cache;
use Carbon\Carbon;
use Cookie;
use DOMDocument;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Helpers\Sletat;
use App\Helpers\Forecast;

class ToursController extends Controller
{
	protected $config;

	public function __construct()
	{
		$this->config = \Config::get('components.tours');
		\View::share('config_app', $this->config);
		$this->middleware('loaderModules');

		Breadcrumbs::register('tours.index', function($breadcrumbs)
		{
			$breadcrumbs->push('Каталог туров');
		});

		/*$data = Category::whereParent(308)->get();
		foreach($data as $value){
			echo 'Туры в '. $value->title .';http://santa-avia.ru'. $value->full_url .'<br/>';

			$resort = Category::whereParent($value->id)->get();
			foreach($resort as $resort_value){
				echo 'Туры в '. $resort_value->title .';http://santa-avia.ru'. $resort_value->full_url .'<br/>';
			}
		}*/
	}
	
	public function getStrany()
	{
		$data['data'] = Category::whereId(308)->whereActive(1)->with(['get_childActive.get_parent'])->first();

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('tours.index');
			$breadcrumbs->push('Страны');
		});

		return view('santa.tours.categorysListChilds', $data);
	}

	public function getVidy(Request $request, $category, $country = '', $resort = '')
	{
		\View::share('selected_resort', $resort);
		\View::share('selected_vid', $category);
		\View::share('selected_country', $country);

		//Cache::flush();
		$page = $request->get('page');
		if($category === 'all') {
            $data['data'] = Cache::remember('search_vid_all_' . $country . '_' . $page, 1440, function () use ($country) {
                $data['data'] = Category::whereUrl($country)->whereActive(1)->with(['get_toursActive.get_category', 'get_child.get_toursActive.get_category'])->first();
                $data['data']->title = 'Все виды отдыха';

                foreach ($data['data']->get_child as $child) {
                    $data['data']->get_toursActive = $data['data']->get_toursActive->merge($child->get_toursActive);
                }
                return $data['data'];
            });
			\View::share('selected_vid', 'all');
        }elseif($category === 'luxury'){
            //Cache::forget('search_vid_luxury_' . $country . '_' . $page);
            $data['data'] = Cache::remember('search_vid_luxury_' . $country . '_' . $page, 1440, function () use ($country, $category) {
                $data['data'] = Category::whereUrl($category)->whereActive(1)->with(['get_hotelsActive.get_category', 'get_child.get_hotelsActive.get_category'])->first();
                foreach ($data['data']->get_child as $child) {
                    $data['data']->get_hotelsActive = $data['data']->get_hotelsActive->merge($child->get_hotelsActive);
                }
                return $data['data'];
            });
		}else{
			if($resort !== ''){
				$data['data'] = Category::whereUrl($resort)->whereActive(1)->with(['get_toursActive.get_category'])->first();
			}elseif($country !== ''){
				$data['data'] = Cache::remember('search_vid'.$category .'_'. $country .'_'. $resort .'_'. $page, 1440, function() use ($country, $category, $resort) {
					$data['data'] = Category::whereUrl($country)->whereActive(1)->with(['get_toursActive.get_category', 'get_child.get_toursActive.get_category'])->first();
						$get_vid = Category::whereUrl($category)->whereActive(1)->first();
						$data['data']->description = $get_vid->description;
						$data['data']->title = $get_vid->title;
						//dd($data['data']);
						$filtered = $data['data']->get_toursActive->filter(function ($value, $key) use ($category, $data) {
							foreach($value->get_category as $category_value){
								//echo $category_value->url .'-'. $category .'<br/>';
								if($category_value->url == $category){
									return $value;
								}
							}
							return false;
						});

						$data['data']->get_toursActive = collect($filtered->all());

						foreach($data['data']->get_child as $child){
							$filtered = $child->get_toursActive->filter(function ($value, $key) use ($category, $data) {
								foreach($value->get_category as $category_value){
									//echo $category_value->url .'<br/>';
									if($category_value->url == $category){
										//$data['data']->get_toursActive->push = $value;
										$data['data']->get_toursActive[] = $value;
										return $value;
									}
								}
								return false;
							});
						}
						return $data['data'];
				});
			}else{
				$data['data'] = Category::whereUrl($category)->whereActive(1)->with(['get_toursActive.get_category', 'get_child.get_toursActive.get_category'])->first();
			}

            if( !$data['data']){
                abort(404, 'Такого раздела нет');
            }
		}

		Breadcrumbs::register('tours.vid', function($breadcrumbs, $data) use ($country)
		{
			if($country){
				$breadcrumbs->push('Виды отдыха');
				if($data->title === 'Все виды отдыха'){
					$breadcrumbs->push($data->title);
				}else{
					$breadcrumbs->push($data->title, '/tours/vidy-otdykha/'. $data->url);
				}

				$get_country = Category::whereUrl($country)->first();
				$breadcrumbs->push($get_country->title, $get_country->url);
			}else{
				$breadcrumbs->push('Виды отдыха');
				$breadcrumbs->push($data->title);
			}
		});

		$data['paginator'] = new Paginator(
			$data['data']->get_toursActive(),
			$data['data']->get_toursActive()->count(),
			$limit = 60,
			$page = $request->get('page', 1), [
			'path'  => $request->url(),
			'query' => $request->query(),
		]);

		\View::share('sharing_type', 'category');
		\View::share('sharing_id', $data['data']->id);

        if($category === 'luxury'){
            return view('santa.hotels.luxury', $data);
        }else{
			//dd($data['data']->get_toursActive);
            return view('santa.tours.toursVid', $data);
        }
	}

	public function getCountry($category, Sletat $sletat, Forecast $forecast)
	{
		$data['data'] = Cache::remember('get_country_'. $category, 1440, function() use ($category) {
		    return Category::whereType('tours')->whereActive(1)->whereUrl($category)->with(['get_toursActive', 'get_childActive'])->first();
		});

		$data['data']['images'] = Cache::remember('categoryImages'. $data['data']->id, 60, function() use ($data) {
			return $data['data']->getMedia('images')->sortByDesc('order_column');
		});

		$filtered = $sletat->country_list->filter(function ($value, $key) use ($data) {
			return $value->Name === $data['data']->title;
		});
		$sletat_id = 29;
		if(count($filtered) > 0){
			$sletat_id = $filtered->first()->Id;
		}
		$data['country_id_sletat'] = $sletat_id;

		//Cache::forget('best_cost'. $data['data']->id);
        $data['GetTours'] = Cache::remember('best_cost'. $data['data']->id, 1440, function() use ($sletat, $sletat_id) {
			$params['s_nightsMin'] = '7';
			$params['s_nightsMax'] = '29';
			$params['s_adults'] = '2';
            return $sletat->GetTours(1286, $sletat_id, $params, 4);
        });
		if($data['GetTours']['iTotalRecords'] < 1){
			Cache::forget('best_cost'. $data['data']->id);
		}

        $data['forecast'] = $forecast->render($data['data']->forecast_url);

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			//$breadcrumbs->parent('tours.index');
			if($data->level !== 1 &&
				$get_parent = Category::whereType('tours')->whereId($data->parent)->first()){
				if($get_parent->level !== 1
					&& $get_granddad = Category::whereType('tours')->whereId($get_parent->parent)->first()){
					$breadcrumbs->push($get_granddad->title);
				}
				$breadcrumbs->push($get_parent->title, '/tours/'. $get_parent->url);
			}
			$breadcrumbs->push($data->title);
		});

		$data['seo']['title'] = 'Страна';

		\View::share('sharing_type', 'category');
		\View::share('sharing_id', $data['data']->id);

		return view('santa.tours.country', $data);
	}

	public function getResourt($category, $item, Sletat $sletat, Forecast $forecast)
	{
		if( !Category::whereUrl($category)->whereType('tours')->whereActive(1)->first()){
			if($get_resort = Category::whereUrl($item)->whereType('tours')->with(['get_parent'])->whereActive(1)->first()){
				//dd($get_resort);
				return redirect('/tours/strany/'. $get_resort->get_parent->url .'/'. $item);
			}
			abort(404, 'Такой страны на сайте нет');
		}

		$data['data'] = Category::whereType('tours')->whereActive(1)->whereUrl($item)->with(['get_toursActive', 'get_childActive', 'get_parent.get_toursActive'])->first();

		if( !$data['data']){
			return $this->getItem($category, '', $item);
		}

		\View::share('selected_resort', $data['data']->id);
		\View::share('selected_country', $data['data']->get_parent->url);

		$data['other_resourts'] = Category::whereParent($data['data']->parent)->where('id', '!=', $data['data']->id)->get();

		$data['data']['images'] = Cache::remember('ResourtImages'. $data['data']->id, 60, function() use ($data) {
			return $data['data']->getMedia('images')->sortByDesc('order_column');
		});

        $filtered = $sletat->country_list->filter(function ($value, $key) use ($data) {
            return $value->Name === $data['data']->get_parent->title;
        });
        $sletat_id = 29;
        if(count($filtered) > 0){
            $sletat_id = $filtered->first()->Id;
        }
        $data['country_id_sletat'] = $sletat_id;

        //Cache::forget('best_cost'. $data['data']->id);
        $data['GetTours'] = Cache::remember('best_cost'. $data['data']->id, 1440, function() use ($sletat, $sletat_id) {
            $params['s_nightsMin'] = '7';
            $params['s_nightsMax'] = '29';
            $params['s_adults'] = '2';
            return $sletat->GetTours(1286, $sletat_id, $params, 4);
        });
		if($data['GetTours']['iTotalRecords'] < 1){
			Cache::forget('best_cost'. $data['data']->id);
		}

        $data['forecast'] = $forecast->render($data['data']->get_parent->forecast_url);

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			//$breadcrumbs->parent('tours.index');
			if($data->level !== 1 &&
				$get_parent = Category::whereType('tours')->whereId($data->parent)->first()){
				if($get_parent->level !== 1
					&& $get_granddad = Category::whereType('tours')->whereId($get_parent->parent)->first()){
					$breadcrumbs->push($get_granddad->title, '/'. $get_granddad->url);
				}
				$breadcrumbs->push($get_parent->title, '/tours/strany/'. $get_parent->url);
			}
			$breadcrumbs->push($data->title);
		});

		\View::share('sharing_type', 'category');
		\View::share('sharing_id', $data['data']->id);

		return view('santa.tours.resourt', $data);
	}

	public function getItem($category = '', $resourt = '', $item)
	{
		//Cache::forget('TourItem'. $item);
		$data = Cache::remember('TourItem'. $item, 1440, function() use ($item) {
			$data['data'] = Tours::whereUrl($item)->whereActive(1)->with(['get_seo', 'get_category'])->firstOrFail();
			$data['data']['images'] = $data['data']->getMedia('images')->sortByDesc('order_column');
			$data['data']['files'] = $data['data']->getMedia('files')->sortByDesc('order_column');

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

			return $data;
		});


		if( !empty($category) && !Category::whereUrl($category)->whereType('tours')->whereActive(1)->first()){
			abort(404, 'Такой страны на сайте нет');
		}

		if( !empty($resourt) && !Category::whereUrl($resourt)->whereActive(1)->first()){
			abort(404, 'Такого курорта на сайте нет');
		}


		Breadcrumbs::register('tours.item', function($breadcrumbs, $data)
		{
			$url = '/tours';
			//$breadcrumbs->parent('tours.index');
			$get_category = $data->get_category->first();
			if($get_category->level !== 1){
				$parent = $get_category->get_parent;
				if($parent->parent === 308){
					$grandpa = $parent->get_parent;
					$breadcrumbs->push($grandpa->title);
					$breadcrumbs->push($parent->title, '/tours/'. $grandpa->url .'/'. $parent->url);
					$url = '/tours/'. $grandpa->url .'/'. $parent->url;
				}else{
					$breadcrumbs->push($parent->title);
					$url = '/tours/'. $parent->url;
				}
			}
			$breadcrumbs->push($get_category->title, $url .'/'. $get_category->url);
			$breadcrumbs->push($data->title, '/tours/strany/'. $data->get_category->first()->url .'/'. $data->url);
		});

		if($data['data']->get_seo){
			$data['seo']['title'] = $data['data']->get_seo->title;
		}else{
			$data['seo']['title'] = $data['data']->title;
		}

		\View::share('sharing_type', 'tours');
		\View::share('sharing_id', $data['data']->id);

		return view('santa.tours.item', $data);
	}

	public function search(Request $request)
	{
		if($request->get('vid')){
			$get_vid = Category::whereId($request->get('vid'))->first();
			if($request->get('resort')){
				$get_resort = Category::whereId($request->get('resort'))->with(['get_parent'])->first();
				return redirect('/tours/vidy-otdykha/'. $get_vid->url .'/'. $get_resort->get_parent->url .'/'. $get_resort->url);
			}
			if($request->get('country')){
				$get_country = Category::whereUrl($request->get('country'))->first();
				return redirect('/tours/vidy-otdykha/'. $get_vid->url .'/'. $get_country->url);
			}
			return redirect('/tours/vidy-otdykha/'. $get_vid->url);
		}
		if($request->get('resort')){
			$get_resort = Category::whereUrl($request->get('resort'))->with(['get_parent'])->first();
			return redirect('/tours/strany/'. $get_resort->get_parent->url .'/'. $get_resort->url);
		}
		if($request->get('country')){
			$get_country = Category::whereUrl($request->get('country'))->first();
			return redirect('/tours/vidy-otdykha/all/'. $get_country->url);
		}
		return back();
	}

	public function searchItem(Request $request)
	{
		$query = $request->get('q');
		if( !$query && $query === ''){
			return \Response::json(array(), 400);
		}

		$search = Tours::search($query)->with(['get_category'])->whereActive(1)->get()->toArray();
		return \Response::json($search);
	}

	public function searchCategory(Request $request)
	{
		$query = $request->get('q');
		if( !$query && $query === ''){
			return \Response::json(array(), 400);
		}

		$search = Tours::search($query)->whereActive(1)->get()->toArray();
		return \Response::json($search);
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
