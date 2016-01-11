<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Feed;
use App\Models\Category;
use DB;
use JsValidator;
use Alert;
use Route;
use Validator;
use Redirect;
use Config;
use View;
use Input;

class FeedController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = Config::get('components.feed');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.feed.index', function($breadcrumbs)
		{
			$breadcrumbs->push('Ленты', route('admin.feed.index'));
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
		$data['data'] = Feed::with('get_category')->paginate(30);
		View::share('validator', '');
		return view('admin.feed.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins)
	{
		$data['data'] = new Feed;
		$data['app'] = $this->config;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data']->get_category = Category::findOrFail(\Input::get('category'));
		$data['id'] = DB::table($this->config['table_content'])->max('id') + 1;
		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);

		Breadcrumbs::register('admin.feed.create', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.feed.index');
			if($find_parent = Category::find($data->category)){
				if($find_parent_2 = Category::find($find_parent->parent)){
					$find_parent_3 = Category::find($find_parent_2->parent);
				}
			}

			if(isset($find_parent_3->title)){
				$breadcrumbs->push($find_parent_3->title, route('admin.feed.show', $find_parent_3->id));
			}
			if(isset($find_parent_2->title)){
				$breadcrumbs->push($find_parent_2->title, route('admin.feed.show', $find_parent_2->id));
			}
			if(isset($find_parent->title)){
				$breadcrumbs->push($find_parent->title, route('admin.feed.show', $find_parent->id));
			}
			$breadcrumbs->push('Новый материал');
		});

		return view('admin.feed.create', $data);
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

		$data = new Feed();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);
		$today = getdate();
		$data->date = $request->input('position');
		if(empty($data->date)){
			$data->date = $today['year'] .'-'. $today['mon'] .'-'. $today['mday'];
		}

		if($data->save()){
			Alert::add('success', 'Материал '. $request->input('title') .' добавлен')->flash();
			Input::merge(['id_connect' => $data->id, 'stash_id' => $request->input('id')]);
			$plugins->update($this->config['plugins_backend']);

			return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
		}

		Alert::add('error', 'Материал '. $request->input('title') .' не добавлен')->flash();
		return back()->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$data['app'] = $this->config;
		$data['category'] = Category::findOrFail($id);
		$data['data'] = Feed::whereCategory($id)->paginate(30);
		View::share('validator', '');

		Breadcrumbs::register('admin.feed.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.feed.index');
			if($find_parent = Category::find($data->parent)){
				$breadcrumbs->push($find_parent->title, route('admin.feed.show', $find_parent->id));
				if($find_parent = Category::find($find_parent->parent)){
					$breadcrumbs->push($find_parent->title, route('admin.feed.show', $find_parent->id));
					if($find_parent = Category::find($find_parent->parent)){
						$breadcrumbs->push($find_parent->title, route('admin.feed.show', $find_parent->id));
					}
				}
			}
			$breadcrumbs->push($data->title, route('admin.feed.show', $data->id));
		});

		return view('admin.feed.show', $data);
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
		$data['data'] = Feed::with([
				'get_category',
				'get_seo' => function($query){
					$query->whereTypeConnect($this->config['name']);
				},
				'get_templates'=> function($query){
					$query->whereTypeConnect($this->config['name']);
				}]
		)->findOrFail($id);

		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);

		$breadcrumbsHelper = new BreadcrumbsHelper();
		$breadcrumbsHelper->generateEdit($data['app']['name']);

		return view('admin.feed.edit', $data);
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
		$validator = Validator::make($request->all(), Component::_valid_construct($this->config['rows']));
		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = Feed::find($id);
		if($data->fill($request->all())->save()){
			Alert::add('success', 'Материал '. $request->input('title') .' изменен')->flash();
			$plugins->update($this->config['plugins_backend']);
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
		$data = Feed::find($id);
		$category = $data->category;
		if($data->delete()){
			Alert::add('success', 'Материал успешно удален')->flash();
			//уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->config['plugins_backend']);
		}else{
			Alert::add('error', 'Материал не удален')->flash();
		}
		return Redirect::to('/admin/'. $this->config['name'] .'/'. $category);
	}
}
