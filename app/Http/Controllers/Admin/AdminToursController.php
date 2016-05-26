<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\Tours;
use App\Models\UsersLogger;
use App\User;
use Breadcrumbs;
use Cache;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use JsValidator;
use Alert;
use Route;
use Spatie\MediaLibrary\Media;
use Validator;
use Redirect;
use View;
use Input;

class AdminToursController extends Controller
{
	protected $config;
	protected $current_user;

	public function __construct(MenuBlock $menu, Guard $guard)
	{
		$this->config = \Config::get('components.tours');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.tours.index', function($breadcrumbs){
			$breadcrumbs->push('Туры', route('admin.tours.index'));
		});
		$this->current_user = $guard->user();
		View::share('current_user', $this->current_user);
        if( !$this->current_user->is(array_get($this->config, 'role', 'admin'))) {
            abort(403, 'У вас нет прав доступа к этому разделу');
        }
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['app'] = $this->config;
		$data['data'] = Category::type('tours')->level(1)->orderBy('position', 'DESC')->with(['get_child', 'get_parent'])->paginate(30);
		View::share('validator', '');

		return view('admin.tours.index', $data);
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
		$create_data = Request::create('/admin/tours', 'POST', [
			'title' => 'Новый материал',
			'url' => str_slug('Новый материал'),
			'category' => [$request->get('category')],
			'active' => 0,
			'cost_notactive' => 0
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

		$data = new Tours();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->to_rss = $request->input('to_rss', 1);
		$data->position = $request->input('position', 0);
		$data->cost_notactive = $request->input('cost_notactive', 0);
		$data->user_id = $this->current_user->id;

		if($data->save()){
			//Присоединяем разделы
			foreach($request->input('category') as $category){
				$data->get_category()->attach($category, ['tour_id' => $data->id]);
			}
			Alert::add('success', 'Тур '. $request->input('title') .' добавлен')->flash();
			Input::merge(['id_connect' => $data->id, 'stash_id' => $request->input('id')]);
			$plugins->update($this->config['plugins_backend']);

			$logger = new UsersLogger();
			$logger->user_id = $this->current_user->id;
			$logger->action = 'Add data in '. $this->config['name'] .': '. $data->title;
			$logger->type_action = 'Add';
			$logger->save();

			return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
		}

		Alert::add('error', 'Тур '. $request->input('title') .' не добавлен')->flash();
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
		//Cache::forget('admin_cat_tours'. $id);
		$data = Cache::remember('admin_cat_tours'. $id, 60, function() use ($paginate, $id){
			$data['app'] = $this->config;
			$data['data'] = Category::whereId($id)->with(['get_tours' => function($query) use ($paginate)
			{
				$query->with('getFirstImage')->paginate($paginate);
			}, 'get_child.get_parent', 'get_parent'])->first();

			$data['data']['image'] = $data['data']->getMedia('images')->sortByDesc('order_column')->first();
			foreach($data['data']->get_tours as $key => $tovar){
				$data['data']->get_tours[$key]['image'] = $tovar->getMedia('images')->sortByDesc('order_column')->first();
			}
			foreach($data['data']->get_child as $key => $tovar){
				$data['data']->get_child[$key]['image'] = $tovar->getMedia('images')->sortByDesc('order_column')->first();
			}
		    return $data;
		});


		$data['paginator'] = new Paginator(
			$data['data']->get_tours(),
			$data['data']->get_tours()->count(),
			$limit = $paginate,
			$page = $request->get('page', 1), [
			'path'  => $request->url(),
			'query' => $request->query(),
		]);

		View::share('validator', '');

		Breadcrumbs::register('admin.tours.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.tours.index');
			if($find_parent = Category::find($data->parent)){
				if($find_parent_2 = Category::find($find_parent->parent)){
					if($find_parent_3 = Category::find($find_parent_2->parent)){
						$breadcrumbs->push($find_parent_3->title, route('admin.tours.show', $find_parent_3->id));
						$breadcrumbs->push($find_parent_2->title, route('admin.tours.show', $find_parent_2->id));
						$breadcrumbs->push($find_parent->title, route('admin.tours.show', $find_parent->id));
					}else{
						$breadcrumbs->push($find_parent_2->title, route('admin.tours.show', $find_parent_2->id));
						$breadcrumbs->push($find_parent->title, route('admin.tours.show', $find_parent->id));
					}
				}else{
					$breadcrumbs->push($find_parent->title, route('admin.tours.show', $find_parent->id));
				}
			}
			$breadcrumbs->push($data->title, route('admin.tours.show', $data->id));
		});

		return view('admin.tours.show', $data);
	}
	
	public function showTours(Request $request)
	{
		$page = $request->get('page');
		$data['data'] = Cache::remember('admin_all_tours'. $page, 1440, function() {
		    return Tours::where('id', '>=', 0)->with('getFirstImage')->paginate(25);
		});
		$data['app'] = $this->config;

		Breadcrumbs::register('all.tours.admin', function($breadcrumbs){
			$breadcrumbs->push('Все туры', route('all.tours.admin'));
		});
		
		return view('admin.tours.showTours', $data);
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
		$data['data'] = Tours::with(['get_category', 'get_seo', 'get_templates'])->findOrFail($id);
        $data['images']['data'] = $data['data']->getMedia('images')->sortByDesc('order_column');

		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		Breadcrumbs::register('admin.tours.edit', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.tours.index');
			if(isset($data->get_category[0])){
                if($find_parent = Category::find($data->get_category[0]->id)){
                    if($find_parent_2 = Category::find($find_parent->parent)){
                        $find_parent_3 = Category::find($find_parent_2->parent);
                    }
                }

                if(isset($find_parent_3->title)){
                    $breadcrumbs->push($find_parent_3->title, route('admin.tours.show', $find_parent_3->id));
                }
                if(isset($find_parent_2->title)){
                    $breadcrumbs->push($find_parent_2->title, route('admin.tours.show', $find_parent_2->id));
                }
                if(isset($find_parent->title)){
                    $breadcrumbs->push($find_parent->title, route('admin.tours.show', $find_parent->id));
                }
            }

			$breadcrumbs->push($data->title, route('admin.tours.show', $data->id));
		});

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.tours.edit', $data);
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

		$data = Tours::find($id);
		$data->user_id = $this->current_user->id;

		//Открепляем от старых разделов
		foreach($data->get_category()->get() as $category){
			$data->get_category()->detach($category);
		}

		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->actual = $request->input('actual', '0000-00-00 00:00:00');
		$data->to_rss = $request->input('to_rss', 1);
		$data->cost_notactive = $request->input('cost_notactive', 0);
		if($data->save()){
			//Присоединяем разделы
			foreach($request->input('category') as $category){
				$data->get_category()->attach($category);
			}
			Alert::add('success', 'Материал '. $request->input('title') .' изменен')->flash();
			$plugins->update($this->config['plugins_backend']);
			\Cache::flush();

			$logger = new UsersLogger();
			$logger->user_id = $this->current_user->id;
			$logger->action = 'Update data in '. $this->config['name'] .': '. $data->title;
			$logger->type_action = 'Update';
			$logger->save();

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
		$data = Tours::find($id);
        $data->clearMediaCollection();
		$category = $data->get_category()->get();
		if($data->delete()){
			//Отсоединяем разделы
			foreach($category as $category_value){
				$data->get_category()->detach($category_value->id, ['tour_id' => $data->id]);
			}
			Alert::add('success', 'Материал успешно удален')->flash();
			//уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->config['plugins_backend']);
			\Cache::flush();

			$logger = new UsersLogger();
			$logger->user_id = $this->current_user->id;
			$logger->action = 'Delete data in '. $this->config['name'] .': '. $data->title;
			$logger->type_action = 'Delete';
			$logger->save();
		}else{
			Alert::add('error', 'Материал не удален')->flash();
		}
		return back();
	}

	public function search(Request $request)
	{
		$data['app'] = $this->config;
		$data['tours'] = Tours::search($request->get('search'))->get();
		foreach($data['tours'] as $key => $tovar){
			$data['tours'][$key]['image'] = $tovar->getMedia('images')->sortByDesc('order_column')->first();
		}
		$data['categories'] = Category::search($request->get('search'))->get();
		return view('admin.tours.search', $data);
	}
}
