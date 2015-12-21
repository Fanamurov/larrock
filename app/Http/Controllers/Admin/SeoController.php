<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Helpers\Component;
use App\Helpers\ContentPlugins;
use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Seo;
use Redirect;
use Validator;
use View;
use JsValidator;

class SeoController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = \Config::get('components.seo');
		\View::share('menu', $menu->index(\Route::current()->getUri())->render());
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['data'] = Seo::orderBy('type_connect')->paginate(30);
		//Для каждого пункта, где сеошка прикреплена по id_connect, достаем url
		foreach($data['data'] as $data_key => $data_value){
			if(empty($data_value['url_connect'])){
				$data['data'][$data_key]['url_connect'] = '~~~';
			}
		}
		$data['app'] = $this->config;
		return view('admin.seo.index', $data);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins)
	{
		$data['data'] = new Seo;
		$data['app'] = $this->config;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['id'] = \DB::table($this->config['table_content'])->max('id') + 1;
		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);

		return view('admin.seo.create', $data);
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

		$data = new Seo();
		if($data->fill($request->all())->save()){
			Alert::add('success', 'Seo '. $request->input('title') .' добавлен')->flash();
			return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
		}

		Alert::add('error', 'Seo '. $request->input('title') .' не добавлен')->flash();
		return back()->withInput();
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
		$data['data'] = Seo::findOrFail($id);
		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);

		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.seo.edit', $data);
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

		$data = Seo::find($id);
		if($data->fill($request->all())->save()){
			Alert::add('success', 'Seo '. $request->input('seo_title') .' изменен')->flash();
			$plugins->update($this->config['plugins_backend']);
			return back();
		}

		Alert::add('error', 'Seo '. $request->input('seo_title') .' не изменен')->flash();
		return back()->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$data = Seo::find($id);
		if($data->delete()){
			Alert::add('success', 'Материал успешно удален')->flash();
		}else{
			Alert::add('error', 'Материал не удален')->flash();
		}
		return Redirect::to('/admin/'. $this->config['name']);
	}
}
