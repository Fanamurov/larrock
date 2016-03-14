<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\ListCatalog;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Menu;
use Breadcrumbs;
use Cookie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use URL;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class CatalogController extends Controller
{
	protected $config;

	public function __construct()
	{
		$this->config = \Config::get('components.catalog');

		Breadcrumbs::register('catalog.index', function($breadcrumbs)
		{
			$breadcrumbs->push('Каталог', route('catalog.index'));
		});
		\View::share('menu', Menu::whereActive(1)->get());
	}

    public function getMainCategory()
	{
		$data['data'] = Category::whereType('catalog')->whereLevel(1)->whereActive(1)->get();
		foreach($data['data'] as $key => $value){
			$data['data'][$key]['images'] = $value->getMedia('images');
		}
		$data['seo']['title'] = 'SEO title getMainCategory';

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

		$data['data'] = Category::whereType('catalog')->whereActive(1)->whereUrl($select_category)->with([
				'get_childActive' => function($query){
					$query->with('get_parent');
				}
			]
		)->first();
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

		//Модуль списка разделов справа
		$data['module_listCatalog'] = $listCatalog->categories();

		if( !$data['data']){
			//Раздела с таким url нет, значит ищем товар
			return $this->getItem($select_category, $data['module_listCatalog']);
		}

		$data['data']['images'] = $data['data']->getMedia('images');

		if(count($data['data']->get_child) === 0){
			return $this->getTovars($select_category, $request, $data['module_listCatalog']);
		}

		$data['seo']['title'] = 'SEO title getCategory';

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

		//Основной запрос для вывода
		$data['data'] = Category::whereUrl($category)->whereActive(1)->with(
			['get_tovarsActive' => function($query) use ($paginate){
				//TODO: сортировки и фильтры
				if(Cookie::get('sort_cost') === 'asc'){
					$query->orderBy('cost', 'asc')->paginate($paginate);
				}elseif(Cookie::get('sort_cost') === 'desc'){
					$query->orderBy('cost', 'desc')->paginate($paginate);
				}else{
					$query->paginate($paginate);
				}
			}, 'get_tovarsAlias', 'get_parent', 'get_seo']
		)->first();

		$data['data']['images'] = $data['data']->getMedia('images');
		foreach($data['data']->get_tovars as $key => $value){
			$data['data']->get_tovars[$key]['images'] = $value->getMedia('images');
		}

		$data['paginator'] = new Paginator(
			$data['data']->get_tovars,
			count($data['data']->get_tovarsAlias),
			$limit = $paginate,
			$page = $request->get('page', 1), [
				'path'  => $request->url(),
				'query' => $request->query(),
		]);

		if($data['data']->get_seo){
			$data['seo']['title'] = $data['data']->get_seo->title;
		}else{
			$data['seo']['title'] = $data['data']->title;
		}

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
		$data['data'] = Catalog::whereUrl($item)->with(['get_seo', 'get_templates', 'get_category'])->first();
		$data['data']['images'] = $data['data']->getMedia('images');
		$data['data']['files'] = $data['data']->getMedia('files');

		Breadcrumbs::register('catalog.item', function($breadcrumbs, $data)
		{
			$url = '';
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
