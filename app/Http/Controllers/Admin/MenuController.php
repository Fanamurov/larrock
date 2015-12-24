<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Tree;
use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ContentPlugins;
use App\Helpers\Component;
use App\Models\Menu;
use DB;
use JsValidator;
use Alert;
use Validator;
use Redirect;
use Config;
use View;
use Input;

class MenuController extends Controller
{
	/**
	 * @var mixed	Конфиг компонента
	 */
	protected $config;

	/**
	 * Bundle constructor.
	 *
	 * Attach admin menu
	 * @param MenuBlock $menu
	 */
	public function __construct(MenuBlock $menu)
	{
		$this->config = \Config::get('components.menu');
        View::share('menu', $menu->index(\Route::current()->getUri())->render());
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @param Tree                        $tree
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(ContentPlugins $ContentPlugins, Tree $tree)
	{
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['data'] = Menu::orderBy('position', 'DESC')->get();
		$data['data'] = $tree->build_tree($data['data']);
		View::share('validator', '');
		return view('admin.menu.index', $data);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Helpers\ContentPlugins $ContentPlugins
	 * @return \Illuminate\Http\Response
	 */
	public function create(ContentPlugins $ContentPlugins)
    {
		$data['data'] = new Menu();
		$data['app'] = $this->config;
		$data['app'] = $ContentPlugins->attach_rows($this->config);
		$data['id'] = DB::table($this->config['table_content'])->max('id') + 1;
		$data = Component::tabbable($data);

		$validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
		View::share('validator', $validator);

		return view('admin.menu.create', $data);
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

        $data = new Menu();
        $data->fill($request->all());
        $data->active = $request->input('active', 1);
        $data->position = $request->input('position', 0);

        dd($data);

        if($data->save()){
            Alert::add('success', 'Пункт меню '. $request->input('title') .' добавлен')->flash();
            \Input::input('connect_id', $data->id);
            $plugins->update($this->config['plugins_backend']);

            return Redirect::to('/admin/'. $this->config['name'] .'/'. $data->id .'/edit')->withInput();
        }

        Alert::add('error', 'Пункт меню '. $request->input('title') .' не добавлен')->flash();
        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = Menu::find($id);
        $data['app'] = $this->config;
        $data['id'] = $id;
        $data = Component::tabbable($data);

        $validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
        View::share('validator', $validator);

        return view('admin.menu.edit', $data);
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
        $validator = Validator::make($request->all(), Component::_valid_construct($this->config['rows']));
        if($validator->fails()){
            return back()->withInput($request->except('password'))->withErrors($validator);
        }

        $data = Menu::find($id);
        if($data->fill($request->all())->save()){
            Alert::add('success', 'Пункт меню '. $request->input('title') .' изменен')->flash();
            return back();
        }

        Alert::add('error', 'Пункт меню '. $request->input('title') .' не изменен')->flash();
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
        $data = Menu::find($id);
        if($data->delete()){
            Alert::add('success', 'Пункт меню успешно удален')->flash();
        }else{
            Alert::add('error', 'Пункт меню не удален')->flash();
        }
        return Redirect::to('/admin/'. $this->config['name']);
    }
}
