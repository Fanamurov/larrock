<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Apps;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\ContentPlugins as ContentPlugins;
use App\Models\Menu;
use DB;
use JsValidator;
use Validator;
use Alert;
use Redirect;
use App\Helpers\Component;

class MenuController extends Apps
{
    public function __construct()
    {
        $this->check_app('menu');
    }

    /**
     * Display a listing of the resource.
     *
	 * @param \App\Helpers\Component $component
     * @return \Illuminate\Http\Response
     */
    public function index(Component $component)
    {
        $data['apps'] = Component::get_app($this->name);
        $data['data'] = DB::table($this->table_content)->paginate(30);
        $data['data'] = $this->build_tree($data['data']);
        \View::share('validator', '');
        return view('admin.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['data'] = new Menu;
        $data['app'] = Component::get_app($this->name);

        $data = Component::tabbable($data);

        $data['next_id'] = DB::table($this->table_content)->max('id') + 1;

        $validator = JsValidator::make(Component::_valid_construct($this->rows));
        \View::share('validator', $validator);

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
        $validator = Validator::make($request->all(), Component::_valid_construct($this->rows));
        if($validator->fails()){
            return back()->withInput($request->except('password'))->withErrors($validator);
        }

        $data = new Menu();
        $data->fill($request->all());
        $data->active = $request->input('active', 0);
        $data->position = $request->input('position', 0);

        if($data->save()){
            Alert::add('success', 'Пункт меню '. $request->input('title') .' добавлен')->flash();
            \Input::input('connect_id', $data->id);
            $plugins->update($this->plugins_backend);

            return Redirect::to('/admin/'. $this->name .'/'. $data->id .'/edit')->withInput();
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
        $data['app'] = Component::get_app($this->name);
        $data['id'] = $id;
        $data = Component::tabbable($data);

        $validator = JsValidator::make(Component::_valid_construct($this->rows));
        \View::share('validator', $validator);

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
        $validator = Validator::make($request->all(), Component::_valid_construct($this->rows));
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
            Alert::add('success', 'Материал успешно удален')->flash();
        }else{
            Alert::add('error', 'Материал не удален')->flash();
        }
        return Redirect::to('/admin/'. $this->name);
    }
}
