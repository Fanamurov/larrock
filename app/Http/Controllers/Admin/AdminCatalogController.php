<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\Catalog;
use Breadcrumbs;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Category;
use DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use JsValidator;
use Alert;
use Route;
use Validator;
use Redirect;
use View;
use Input;

class AdminCatalogController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = \Config::get('components.catalog');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.catalog.index', function($breadcrumbs){
			$breadcrumbs->push('Каталог', route('admin.catalog.index'));
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['app'] = $this->config;
		$data['data'] = Category::type('catalog')->level(1)->orderBy('position', 'DESC')->with(['get_child', 'get_parent'])->paginate(30);
		View::share('validator', '');

		return view('admin.catalog.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @param Request                     $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins, Request $request)
	{
		$create_data = Request::create('/admin/catalog', 'POST', [
			'title' => 'Новый материал',
			'url' => str_slug('Новый материал'),
			'what' => 'руб./шт.',
			'category' => [$request->get('category')],
			'active' => 0
		]);
		return $this->store($create_data, $ContentPlugins);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, ContentPlugins $plugins)
	{
		$validator = Validator::make($request->all(), Component::_valid_construct($this->config['rows']));
		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Catalog();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);
		$data->articul = 'AR'. $request->input('id');

		if($data->save()){
			//Присоединяем разделы
			foreach($request->input('category') as $category){
				$data->get_category()->attach($category, ['catalog_id' => $data->id]);
			}
			Alert::add('success', 'Товар '. $request->input('title') .' добавлен')->flash();
			Input::merge(['id_connect' => $data->id, 'stash_id' => $request->input('id')]);
			$plugins->update($this->config['plugins_backend']);

			return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
		}

		Alert::add('error', 'Товар '. $request->input('title') .' не добавлен')->flash();
		return back()->withInput();
	}

	/**
	 * Display the list resource of category.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id, Request $request)
	{
		$paginate = 50;

		$data = Cache::remember('admin_cat_catalog'. $id, 60, function() use ($paginate, $id){
			$data['app'] = $this->config;
			$data['data'] = Category::whereId($id)->with(['get_tovars' => function($query) use ($paginate)
			{
				$query->paginate($paginate);
			}, 'get_child', 'get_parent'])->first();

			$data['data']['image'] = $data['data']->getMedia('images')->sortByDesc('order_column')->first();
			foreach($data['data']->get_tovars as $key => $tovar){
				$data['data']->get_tovars[$key]['image'] = $tovar->getMedia('images')->sortByDesc('order_column')->first();
			}
		    return $data;
		});


		$data['paginator'] = new Paginator(
			$data['data']->get_tovars(),
			$data['data']->get_tovars()->count(),
			$limit = $paginate,
			$page = $request->get('page', 1), [
			'path'  => $request->url(),
			'query' => $request->query(),
		]);

		View::share('validator', '');

		Breadcrumbs::register('admin.catalog.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.catalog.index');
			if($find_parent = Category::find($data->parent)){
				$breadcrumbs->push($find_parent->title, route('admin.catalog.show', $find_parent->id));
				if($find_parent = Category::find($find_parent->parent)){
					$breadcrumbs->push($find_parent->title, route('admin.catalog.show', $find_parent->id));
					if($find_parent = Category::find($find_parent->parent)){
						$breadcrumbs->push($find_parent->title, route('admin.catalog.show', $find_parent->id));
					}
				}
			}
			$breadcrumbs->push($data->title, route('admin.catalog.show', $data->id));
		});

		return view('admin.catalog.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, ContentPlugins $ContentPlugins)
	{
		$data['data'] = Catalog::with(['get_category', 'get_seo', 'get_templates'])->findOrFail($id);
        $data['images']['data'] = $data['data']->getMedia('images')->sortByDesc('order_column');

		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		Breadcrumbs::register('admin.catalog.edit', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.catalog.index');
			//dd($data);
			if($find_parent = Category::find($data->get_category[0]->id)){
				if($find_parent_2 = Category::find($find_parent->parent)){
					$find_parent_3 = Category::find($find_parent_2->parent);
				}
			}

			if(isset($find_parent_3->title)){
				$breadcrumbs->push($find_parent_3->title, route('admin.catalog.show', $find_parent_3->id));
			}
			if(isset($find_parent_2->title)){
				$breadcrumbs->push($find_parent_2->title, route('admin.catalog.show', $find_parent_2->id));
			}
			if(isset($find_parent->title)){
				$breadcrumbs->push($find_parent->title, route('admin.catalog.show', $find_parent->id));
			}

			$breadcrumbs->push($data->title, route('admin.catalog.show', $data->id));
		});

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.catalog.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id, ContentPlugins $plugins)
	{
		$validator = Validator::make($request->all(), Component::_valid_construct($this->config['rows'], 'update', $id));
		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = Catalog::find($id);

		//Открепляем от старых разделов
		foreach($data->get_category()->get() as $category){
			$data->get_category()->detach($category);
		}

		if($data->fill($request->all())->save()){
			//Присоединяем разделы
			foreach($request->input('category') as $category){
				$data->get_category()->attach($category);
			}
			Alert::add('success', 'Материал '. $request->input('title') .' изменен')->flash();
			$plugins->update($this->config['plugins_backend']);
			\Cache::flush();
			return back();
		}

		Alert::add('error', 'Материал '. $request->input('title') .' не изменен')->flash();
		return back()->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @param  \App\Helpers\ContentPlugins $plugins
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id, ContentPlugins $plugins)
	{
		$data = Catalog::find($id);
        $data->clearMediaCollection();
		$category = $data->get_category()->get();
		if($data->delete()){
			//Отсоединяем разделы
			foreach($category as $category_value){
				$data->get_category()->detach($category_value->id, ['catalog_id' => $data->id]);
			}
			Alert::add('success', 'Материал успешно удален')->flash();
			//уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->config['plugins_backend']);
			\Cache::flush();
		}else{
			Alert::add('error', 'Материал не удален')->flash();
		}
		return back();
	}
}
