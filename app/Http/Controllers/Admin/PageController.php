<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Page;
use JsValidator;
use Alert;
use Route;
use Validator;
use Redirect;
use View;
use Input;

class PageController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = \Config::get('components.page');
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
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins)
	{
		$data['data'] = new Page;
		$data['app'] = $this->config;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['id'] = \DB::table($this->config['table_content'])->max('id') + 1;
		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.apps.create', $data);
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
		$data['data'] = Page::with([
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
		if($data->fill($request->all())->save()){
			Alert::add('success', 'Материал '. $request->input('title') .' изменен')->flash();
			$plugins->update($this->config['plugins_backend']);
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
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Page();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);
		$today = getdate();
		$data->date = $request->input('date');
		if(empty($data->date)){
			$data->date = $today['year'] .'-'. $today['mon'] .'-'. $today['mday'];
		}

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
		$data = Page::find($id);
		if($data->delete()){
			Alert::add('success', 'Материал успешно удален')->flash();
			//уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->config['plugins_backend']);
		}else{
			Alert::add('error', 'Материал не удален')->flash();
		}
		return Redirect::to('/admin/'. $this->config['name']);
	}
}
