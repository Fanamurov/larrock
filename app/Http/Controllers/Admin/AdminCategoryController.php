<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Helpers\Component;
use App\Helpers\ContentPlugins;
use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use JsValidator;
use Redirect;
use Route;
use Validator;
use View;

class AdminCategoryController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = \Config::get('components.category');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Request                     $request
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request, ContentPlugins $ContentPlugins)
    {
		$data['data'] = new Category();
		$data['app'] = $this->config;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data']->get_category = Category::find(\Input::get('category_id'));
		$data['id'] = \DB::table($this->config['table_content'])->max('id') + 1;
		$data['app']['rows']['type']['default'] = $request->get('type');
		$data = Component::tabbable($data);
		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.category.create', $data);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param ContentPlugins            $plugins
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(Request $request, ContentPlugins $plugins)
    {
		$validator = Validator::make($request->all(), Component::_valid_construct($this->config['rows']));
		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Category();
		$data->fill($request->all());
		$data->active = $request->input('active', 0);
		$data->position = $request->input('position', 0);

		if($request->input('parent') !== 0){
			if($get_parent = Category::find($request->input('parent'))->first()){
				$data->level = (int) $get_parent->level +1;
			}
		}else{
			$data->level = 0;
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
	 * Light store a newly created resource in storage.
	 *
	 * @param Request        $request
	 *
	 * @param ContentPlugins $contentPlugins
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function storeEasy(Request $request, ContentPlugins $contentPlugins)
	{
		$validator = Validator::make($request->all(), Component::_valid_construct($this->config['rows']));
		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Category();
		$data->fill($request->all());
		$data->active = $request->input('active', 1);
		$data->position = $request->input('position', 0);
		$data->url = str_slug($request->input('title'));

		if((int)$request->input('parent') !== 0){
			if($get_parent = Category::find($request->input('parent'))->first()){
				$data->level = (int) $get_parent->level +1;
			}
		}else{
			$data->level = 1;
		}

		if($data->save()){
			Alert::add('success', 'Раздел '. $request->input('title') .' добавлен')->flash();
			return back()->withInput();
		}

		Alert::add('error', 'Раздел '. $request->input('title') .' не добавлен')->flash();
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
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int           $id
	 * @param ContentPlugins $ContentPlugins
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function edit($id, ContentPlugins $ContentPlugins)
    {
		$data['data'] = Category::with(['get_seo', 'get_templates'])->findOrFail($id);

        $data['images']['data'] = $data['data']->getMedia('images');
		$data['id'] = $id;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = $ContentPlugins->attach_data($this->config, $data['data']);

		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);
		return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
		$data = Category::find($id);
        $data->clearMediaCollection();
		if($data->delete()){
			Alert::add('success', 'Раздел успешно удален')->flash();
			//уничтожение данные от плагинов фото, файлы
			$plugins->destroy($this->config['plugins_backend']);
		}else{
			Alert::add('error', 'Раздел не удален')->flash();
			return back()->withInput();
		}
		return back();
	}
}
