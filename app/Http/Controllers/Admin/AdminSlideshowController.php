<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Helpers\ContentPlugins;
use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\Slideshow;
use Component;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use JsValidator;
use Redirect;
use Route;
use Validator;
use View;

class AdminSlideshowController extends Controller
{
	protected $config;
    protected $current_user;

	public function __construct(MenuBlock $menu, Guard $guard)
	{
		$this->config = \Config::get('components.slideshow');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}
        $this->current_user = $guard->user();
        if( !$this->current_user->is(array_get($this->config, 'role', 'admin'))) {
            abort(403, 'У вас нет прав доступа к этому разделу');
        }
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function index(ContentPlugins $ContentPlugins)
	{
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = Slideshow::orderBy('position', 'DESC')->paginate(30);
		View::share('validator', '');
		return view('admin.slideshow.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins)
	{
        $test = Request::create('/admin/slideshow', 'POST', [
            'title' => 'Новый материал',
            'url' => str_slug('Новый материал'),
            'banner_url' => '#',
            'active' => 0
        ]);
        return $this->store($test, $ContentPlugins);
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
		$data['data'] = Slideshow::findOrFail($id);
        $data['images']['data'] = $data['data']->getMedia('images');

		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.slideshow.edit', $data);
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

		$data = Slideshow::find($id);
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->view = $request->input('view', 0);

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
			if($validator->errors()->get('url')){
				$get_data = Slideshow::whereUrl($request->input('url'))->first();
				Alert::add('danger', 'В базе есть незаполненный элемент. 
				Нажмите на "Создать url" у заголовка и пересохраните материал. Затем можете повторить попытку создания материала. 
				Материалы нельзя оставлять с заголовком Новый материал')->flash();
				return Redirect::to('/admin/'. $this->config['name'] .'/'. $get_data->id .'/edit')->withInput();
			}
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Slideshow();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->view = $request->input('view', 0);
		$data->position = $request->input('position', 0);

		if($data->save()){
			Alert::add('success', 'Материал '. $request->input('title') .' добавлен')->flash();
			Input::merge(['id_connect' => $data->id, 'stash_id' => $request->input('id_connect')]);
			$plugins->update($this->config['plugins_backend']);

			return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
		}

		Alert::add('error', 'Материал '. $request->input('title') .' не добавлен')->flash();
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
		$data = Slideshow::find($id);
        $data->clearMediaCollection();
		if($data->delete()){
			Alert::add('success', 'Материал успешно удален')->flash();
			//уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->config['plugins_backend']);
			\Cache::flush();
		}else{
			Alert::add('error', 'Материал не удален')->flash();
		}
		return Redirect::to('/admin/'. $this->config['name']);
	}
}