<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\ListCatalog;
use App\Models\Blocks;
use App\Models\Category;
use App\Models\Feed;
use App\Models\Menu;
use App\Models\Tours;
use Breadcrumbs;
use Cache;
use Cookie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use URL;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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
	}

	public function getAllTovars(Request $request, ListCatalog $listCatalog)
	{
		Breadcrumbs::register('tours.all', function($breadcrumbs)
		{
			$breadcrumbs->parent('tours.index');
			$breadcrumbs->push('Все туры');
		});

		$data['data'] = Cache::remember('gettours_all', 60, function()
		{
			//Основной запрос для вывода
			return Tours::all();
		});
		$data['module_listCatalog'] = $listCatalog->categories();
		foreach($data['data'] as $key => $value){
			$data['data'][$key]['images'] = $value->getMedia('images')->sortByDesc('order_column');
		}

		$data['paginator'] = new Paginator(
			$data['data'],
			count($data['data']),
			$limit = 100,
			$page = $request->get('page', 1), [
			'path'  => $request->url(),
			'query' => $request->query(),
		]);

		$data['seo']['title'] = 'Все товары каталога';

		return view('santa.tours.items-all', $data);
	}

    public function getMainCategory()
	{
		$data = Cache::remember('getTours_main', 60, function()
		{
			$data['data'] = Category::whereType('tours')->whereLevel(1)->whereActive(1)->with('get_parent')->orderBy('position', 'DESC')->get();
			foreach($data['data'] as $key => $value){
				$data['data'][$key]['image'] = $value->getFirstMediaUrl('images');
			}
			$data['seo']['title'] = 'Оптовая продажа дальневосточной рыбной продукции';
			return $data;
		});

		return view('santa.tours.categorys', $data);
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

	public function getVidy()
	{
		$data['data'] = Category::whereId(377)->whereActive(1)->with(['get_childActive.get_parent'])->first();

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('tours.index');
			$breadcrumbs->push('Виды отдыха');
		});

		return view('santa.tours.categorysListChilds', $data);
	}

	public function getCategory(Request $request, $category, $child = NULL, $grandson = NULL)
	{
		//Смотрим какой раздел выбираем для работы
		//Первый уровень: /Раздел
		$select_category = $category;
		if($child){
			//Вложенный раздел: /Раздел/Подраздел
			$select_category = $child;
			if($grandson){
				//Вложенный раздел: /Раздел/Подраздел/Подраздел
				$select_category = $grandson;
			}
		}

		$data['data'] = Cache::remember('getCategory'. $select_category, 60, function() use ($select_category) {
			return Category::whereType('tours')->whereActive(1)->whereUrl($select_category)->with(['get_childActive.get_parent'])->first();
		});

		//Редирект на страну
		if($data['data']->parent === 308){
			return $this->getCountry($select_category);
		}

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('tours.index');
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

		if(count($data['data']->get_child) === 0){
			return $this->getTours($select_category, $request);
		}

		$data['data']['images'] = Cache::remember('categoryImages'. $data['data']->id, 60, function() use ($data) {
			return $data['data']->getMedia('images')->sortByDesc('order_column');
		});

		foreach($data['data']->get_childActive as $key => $value){
			$data['data']->get_childActive[$key]['image'] = $value->getMedia('images')->sortByDesc('order_column');
		}

		return view('santa.tours.categorysListChilds', $data);
	}

	public function getCountry($category)
	{
		$data['data'] = Category::whereType('tours')->whereActive(1)->whereUrl($category)->with(['get_toursActive', 'get_childActive'])->first();

		$data['data']['images'] = Cache::remember('categoryImages'. $data['data']->id, 60, function() use ($data) {
			return $data['data']->getMedia('images')->sortByDesc('order_column');
		});

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('tours.index');
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

		return view('santa.tours.country', $data);
	}

	public function getResourt($category, $item)
	{
		$data['data'] = Category::whereType('tours')->whereActive(1)->whereUrl($item)->with(['get_toursActive', 'get_childActive'])->first();

		if( !$data['data']){
			return $this->getItem($category, $item);
		}

		$data['data']['images'] = Cache::remember('ResourtImages'. $data['data']->id, 60, function() use ($data) {
			return $data['data']->getMedia('images')->sortByDesc('order_column');
		});

		Breadcrumbs::register('tours.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('tours.index');
			if($data->level !== 1 &&
				$get_parent = Category::whereType('tours')->whereId($data->parent)->first()){
				if($get_parent->level !== 1
					&& $get_granddad = Category::whereType('tours')->whereId($get_parent->parent)->first()){
					$breadcrumbs->push($get_granddad->title, '/'. $get_granddad->url);
				}
				$breadcrumbs->push($get_parent->title, '/strany/'. $get_parent->url);
			}
			$breadcrumbs->push($data->title);
		});

		return view('santa.tours.resourt', $data);
	}

	public function getItem($category, $item)
	{
		$data['data'] = Tours::whereUrl($item)->whereActive(1)->with(['get_seo', 'get_templates', 'get_category'])->firstOrFail();
		$data['data']['images'] = $data['data']->getMedia('images')->sortByDesc('order_column');
		$data['data']['files'] = $data['data']->getMedia('files')->sortByDesc('order_column');

		Breadcrumbs::register('tours.item', function($breadcrumbs, $data)
		{
			$url = '/tours';
			$breadcrumbs->parent('tours.index');
			$get_category = $data->get_category->first();
			if($get_category->level !== 1){
				$parent = $get_category->get_parent;
				if($parent->level !== 1){
					$grandpa = $parent->get_parent;
					$breadcrumbs->push($grandpa->title, '/tours/'. $grandpa->url .'/'. $parent->url);
					$url = '/tours/'. $grandpa->url .'/'. $parent->url;
				}else{
					$breadcrumbs->push($parent->title, '/tours/'. $parent->url);
					$url = '/tours/'. $parent->url;
				}
			}
			$breadcrumbs->push($get_category->title, $url .'/'. $get_category->url);
			$breadcrumbs->push('Тур');
		});

		if($data['data']->get_seo){
			$data['seo']['title'] = $data['data']->get_seo->title;
		}else{
			$data['seo']['title'] = $data['data']->title;
		}

		return view('santa.tours.item', $data);
	}

	public function getTours($category, Request $request)
	{
		Breadcrumbs::register('tours.items', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('tours.category', $data);
		});

		$paginate = Cookie::get('perPage', 24);

		$data['data'] = Cache::remember('getTours'. $category .''. $request->get('page', 1), 60, function() use ($category, $paginate)
		{
			//Основной запрос для вывода
			return Category::whereUrl($category)->whereActive(1)->with(
				['get_toursActive' => function($query) use ($paginate){
					$query->paginate($paginate);
				}, 'get_parent', 'get_seo']
			)->first();
		});

		$data['data']['images'] = $data['data']->getMedia('images')->sortByDesc('order_column');
		foreach($data['data']->get_toursActive as $key => $value){
			$images = Cache::remember('tours_image'. $value->id, 60, function() use ($value)
			{
				return $value->getMedia('images')->sortByDesc('order_column');
			});
			$data['data']->get_toursActive[$key]['images'] = $images;
		}

		$data['paginator'] = new Paginator(
			$data['data']->get_toursActive(),
			$data['data']->get_toursActive()->count(),
			$limit = $paginate,
			$page = $request->get('page', 1), [
			'path'  => $request->url(),
			'query' => $request->query(),
		]);

		return view('santa.tours.items-4-3', $data);
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
}