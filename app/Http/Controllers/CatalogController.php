<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\ListCatalog;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Feed;
use Breadcrumbs;
use Cache;
use Cookie;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class CatalogController extends Controller
{
	protected $config;
	protected $seo;

	public function __construct()
	{
		$this->config = \Config::get('components.catalog');
		\View::share('config_app', $this->config);
		$this->middleware('loaderModules');
		$this->middleware('getSeo');

		Breadcrumbs::register('catalog.index', function($breadcrumbs)
		{
			$breadcrumbs->push('Рыбная продукция', '/catalog');
		});
	}

	public function getAllTovars(Request $request, ListCatalog $listCatalog)
	{
		Breadcrumbs::register('catalog.all', function($breadcrumbs)
		{
			$breadcrumbs->parent('catalog.index');
			$breadcrumbs->push('Все товары');
		});

		$data['data'] = Cache::remember('getTovars_all', 60, function()
		{
			$get_category = Category::type('catalog')->orderBy('position', 'desc')->with(['get_tovarsActive' => function($query){
				return $query->orderBy('cost', 'asc');
			}])->get();

			foreach($get_category as $key => $value){
				foreach($value->get_tovarsActive as $key_tovar => $value_tovar){
					$get_category[$key]->get_tovarsActive[$key_tovar]['images'] = $value_tovar->getMedia('images')->sortByDesc('order_column');
				}
			}
			return $get_category;
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

		$data['seo']['title'] = 'Вся рыбная продукция';

		return view('front.catalog.items-all', $data);
	}

    public function getMainCategory()
	{
		$seofish = Cache::remember('seofish_mod', 60, function() {
		    return Feed::whereCategory(2)->whereActive(1)->orderBy('position', 'DESC')->get();
		});
		\View::share('seofish', $seofish);

		$data = Cache::remember('getTovars_main', 60, function() use ($seofish)
		{
			$data['data'] = Category::whereType('catalog')->whereLevel(1)->whereActive(1)->with('get_parent')->orderBy('position', 'DESC')->get();
			foreach($data['data'] as $key => $value){
				$data['data'][$key]['image'] = $value->getMedia('images')->sortByDesc('order_column')->first();
			}
			$data['seo']['title'] = $seofish->first()->title;
			return $data;
		});

		return view('front.catalog.categorys', $data);
	}

	public function getCategory(Request $request, ListCatalog $listCatalog, $category, $child = NULL, $grandson = NULL)
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

		//Модуль списка разделов справа
		$data['module_listCatalog'] = $listCatalog->categories();

		$data['data'] = Cache::remember('getCategory'. $select_category, 60, function() use ($select_category) {
		    return Category::whereType('catalog')->whereActive(1)->whereUrl($select_category)->with(['get_childActive.get_parent'])->first();
		});

		if( !$data['data']){
			//Раздела с таким url нет, значит ищем товар
			return $this->getItem($select_category, $data['module_listCatalog']);
		}

		Breadcrumbs::register('catalog.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('catalog.index');
			if($data->level !== 1 &&
				$get_parent = Category::whereType('catalog')->whereId($data->parent)->first()){
				if($get_parent->level !== 1
					&& $get_granddad = Category::whereType('catalog')->whereId($get_parent->parent)->first()){
					$breadcrumbs->push($get_granddad->title);
				}
				$breadcrumbs->push($get_parent->title, '/catalog/'. $get_parent->url);
			}
			$breadcrumbs->push($data->title);
		});

		if(count($data['data']->get_child) === 0){
			return $this->getTovars($select_category, $request, $data['module_listCatalog']);
		}

		$data['data']['images'] = Cache::remember('categoryImages', 60, function() use ($data) {
			return $data['data']->getMedia('images')->sortByDesc('order_column');
		});

		return view('front.catalog.categorysListChilds', $data);
	}

	public function getTovars($category, Request $request, $module_listCatalog)
	{
		Breadcrumbs::register('catalog.items', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('catalog.category', $data);
		});

		$paginate = Cookie::get('perPage', 24);
		//echo Cookie::get('sort_cost');

		$data['data'] = Cache::remember('getTovars'. $category .''. $request->get('page', 1), 60, function() use ($category, $paginate)
		{
			//Основной запрос для вывода
			return Category::whereUrl($category)->whereActive(1)->with(
				['get_tovarsActive' => function($query) use ($paginate){
					//TODO: сортировки и фильтры
					/*if(Cookie::get('sort_cost') === 'asc'){
						$query->orderBy('cost', 'asc')->paginate($paginate);
					}elseif(Cookie::get('sort_cost') === 'desc'){
						$query->orderBy('cost', 'desc')->paginate($paginate);
					}else{
						$query->paginate($paginate);
					}*/
					$query->orderBy('cost', 'asc')->paginate($paginate);
				}, 'get_parent', 'get_seo']
			)->first();
		});

		$data['data']['images'] = $data['data']->getMedia('images')->sortByDesc('order_column');
		foreach($data['data']->get_tovarsActive as $key => $value){
			$images = Cache::remember('catalog_image'. $value->id, 60, function() use ($value)
			{
				return $value->getMedia('images')->sortByDesc('order_column');
			});
			$data['data']->get_tovarsActive[$key]['images'] = $images;
		}

		$data['paginator'] = new Paginator(
			$data['data']->get_tovarsActive(),
			$data['data']->get_tovarsActive()->count(),
			$limit = $paginate,
			$page = $request->get('page', 1), [
				'path'  => $request->url(),
				'query' => $request->query(),
		]);

		//Модуль списка разделов справа
		$data['module_listCatalog'] = $module_listCatalog;

		if(Cookie::get('vid') === 'table'){
			return view('front.catalog.items-table', $data);
		}else{
			return view('front.catalog.items-2', $data);
		}
	}

	public function getItem($item, $module_listCatalog)
	{
		$data['data'] = Catalog::whereUrl($item)->with(['get_seo', 'get_templates', 'get_category'])->firstOrFail();
		$data['data']['images'] = $data['data']->getMedia('images')->sortByDesc('order_column');
		$data['data']['files'] = $data['data']->getMedia('files')->sortByDesc('order_column');

		Breadcrumbs::register('catalog.item', function($breadcrumbs, $data)
		{
			$url = '/catalog';
			$breadcrumbs->parent('catalog.index');
			$get_category = $data->get_category->first();
			if($get_category->level !== 1){
				$parent = $get_category->get_parent;
				if($parent->level !== 1){
					$grandpa = $parent->get_parent;
					$breadcrumbs->push($grandpa->title, '/catalog/'. $grandpa->url .'/'. $parent->url);
					$url = '/catalog/'. $grandpa->url .'/'. $parent->url;
				}else{
					$breadcrumbs->push($parent->title, '/catalog/'. $parent->url);
					$url = '/catalog/'. $parent->url;
				}
			}
			$breadcrumbs->push($get_category->title, $url .'/'. $get_category->url);
			$breadcrumbs->push($data->title);
		});

		//Модуль списка разделов справа
		$data['module_listCatalog'] = $module_listCatalog;

		if($data['data']->get_seo){
			$data['seo']['title'] = $data['data']->get_seo->title;
		}else{
			$data['seo']['title'] = $data['data']->title;
		}

		return view('front.catalog.item', $data);
	}

	public function searchItem(Request $request)
	{
		$query = $request->get('q');
		if( !$query && $query === ''){
			return \Response::json(array(), 400);
		}

		$search = Catalog::search($query)->with(['get_category'])->whereActive(1)->get()->toArray();
		return \Response::json($search);
	}

	public function searchCategory(Request $request)
	{
		$query = $request->get('q');
		if( !$query && $query === ''){
			return \Response::json(array(), 400);
		}

		$search = Catalog::search($query)->whereActive(1)->get()->toArray();
		return \Response::json($search);
	}
}
