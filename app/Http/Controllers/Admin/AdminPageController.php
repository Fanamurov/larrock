<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Page;
use JsValidator;
use Alert;
use Lang;
use Route;
use Validator;
use Redirect;
use View;
use Input;

class AdminPageController extends Controller
{
	protected $config;
    protected $current_user;

	public function __construct(MenuBlock $menu, Guard $guard)
	{
		$this->config = \Config::get('components.page');
        $this->current_user = $guard->user();
        if( !$this->current_user->is(array_get($this->config, 'role', 'admin'))) {
            abort(403, 'У вас нет прав доступа к этому разделу');
        }
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
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
		$data['data'] = Page::orderBy('position', 'DESC')->paginate(30);
		View::share('validator', '');
		return view('admin.apps.index', $data);
	}

	/**
	 * Подготовка данных для создания черновика материала
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins)
	{
        $test = Request::create('/admin/page', 'POST', [
            'title' => 'Новый материал',
            'url' => str_slug('Новый материал'),
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
		$data['data'] = Page::with(['get_seo', 'get_templates'])->findOrFail($id);
		$data['images']['data'] = $data['data']->getMedia('images');
		$data['files']['data'] = $data['data']->getMedia('files');

		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.apps.edit', $data);
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

		$data = Page::find($id);
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		if($data->save()){
			Alert::add('success', Lang::get('apps.update.success', ['name' => $request->input('title')]))->flash();
			$plugins->update($this->config['plugins_backend']);
			return back();
		}else{
            Alert::add('warning', Lang::get('apps.update.nothing', ['name' => $request->input('title')]))->flash();
        }
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
				$get_data = Page::whereUrl($request->input('url'))->first();
				Alert::add('danger', 'В базе есть незаполненный элемент. 
				Нажмите на "Создать url" у заголовка и пересохраните материал. Затем можете повторить попытку создания материала. 
				Материалы нельзя оставлять с заголовком Новый материал')->flash();
				return Redirect::to('/admin/'. $this->config['name'] .'/'. $get_data->id .'/edit')->withInput();
			}
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Page();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);
		$data->date = $request->input('date', date('Y-m-d'));

        if($data->save()){
            Alert::add('success', Lang::get('apps.create.success-temp'))->flash();
            Input::merge(['id_connect' => $data->id, 'stash_id' => $request->input('id_connect')]);
            $plugins->update($this->config['plugins_backend']);
            return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
        }else{
            Alert::add('error', Lang::get('apps.create.error'));
            return back()->withInput();
        }
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
		$data = Page::find($id);
        $data->clearMediaCollection();
		if($data->delete()){
			Alert::add('success', Lang::get('apps.delete.success'))->flash();
			$plugins->destroy($this->config['plugins_backend']);
		}else{
			Alert::add('error', Lang::get('apps.delete.error'))->flash();
		}
		return Redirect::to('/admin/'. $this->config['name']);
	}
}
