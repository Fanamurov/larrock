<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use Breadcrumbs;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Blog;
use App\Models\Category;
use JsValidator;
use Alert;
use Route;
use Validator;
use Redirect;
use Config;
use View;
use Input;

class AdminBlogController extends Controller
{
	protected $config;
	protected $current_user;

	public function __construct(MenuBlock $menu, Guard $guard)
	{
		$this->config = Config::get('components.blog');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.blog.index', function($breadcrumbs){
			$breadcrumbs->push('Блог', route('admin.blog.index'));
		});

		$this->current_user = $guard->user();
		View::share('current_user', $this->current_user);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['app'] = $this->config;
		$data['data'] = Category::type('blog')->level(1)->orderBy('position', 'DESC')->with(['get_child', 'get_parent'])->paginate(30);
		View::share('validator', '');
		return view('admin.blog.index', $data);
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
		if( !$category = Category::whereType('blog')->first()){
			Category::create(['title' => 'Новый раздел', 'url' => str_slug('Новый раздел')]);
			$category = Category::whereType('blog')->first();
		}
		$test = Request::create('/admin/blog', 'POST', [
			'title' => 'Новый материал',
			'url' => str_slug('Новый материал'),
			'category' => $request->get('category', $category->id),
			'active' => 0
		]);
		return $this->store($test, $ContentPlugins);
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

		$data = new Blog();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);
		$today = getdate();
		$data->date = $request->input('position');
		if(empty($data->date)){
			$data->date = $today['year'] .'-'. $today['mon'] .'-'. $today['mday'];
		}
		$data->user_id = $this->current_user->id;

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
		$data['data'] = Blog::whereCategory($id)->paginate(30);
		View::share('validator', '');

		Breadcrumbs::register('admin.blog.category', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.blog.index');
			if($find_parent = Category::find($data->parent)){
				$breadcrumbs->push($find_parent->title, route('admin.blog.show', $find_parent->id));
				if($find_parent = Category::find($find_parent->parent)){
					$breadcrumbs->push($find_parent->title, route('admin.blog.show', $find_parent->id));
					if($find_parent = Category::find($find_parent->parent)){
						$breadcrumbs->push($find_parent->title, route('admin.blog.show', $find_parent->id));
					}
				}
			}
			$breadcrumbs->push($data->title, route('admin.blog.show', $data->id));
		});

		return view('admin.blog.show', $data);
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
		$data['data'] = Blog::with(['get_category', 'get_seo', 'get_templates'])->findOrFail($id);
        $data['images']['data'] = $data['data']->getMedia('images');

		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		Breadcrumbs::register('admin.blog.edit', function($breadcrumbs, $data)
		{
			$breadcrumbs->parent('admin.blog.index');
			//dd($data);
			if($find_parent = Category::find($data->get_category->id)){
				if($find_parent_2 = Category::find($find_parent->parent)){
					$find_parent_3 = Category::find($find_parent_2->parent);
				}
			}

			if(isset($find_parent_3->title)){
				$breadcrumbs->push($find_parent_3->title, '/admin/blog/'. $find_parent_3->id);
			}
			if(isset($find_parent_2->title)){
				$breadcrumbs->push($find_parent_2->title, '/admin/blog/'. $find_parent_2->id);
			}
			if(isset($find_parent->title)){
				$breadcrumbs->push($find_parent->title, '/admin/blog/'. $find_parent->id);
			}

			$breadcrumbs->push($data->title, '/admin/blog/'. $data->id);
		});

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);

		return view('admin.blog.edit', $data);
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

		$data = Blog::find($id);
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->user_id = $this->current_user->id;

		if($data->save()){
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
		$data = Blog::find($id);
        $data->clearMediaCollection();
		if($data->delete()){
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
