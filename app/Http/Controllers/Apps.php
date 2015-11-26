<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Apps as Model_Apps;
use DB;
use Session;
use Validator;
use Illuminate\Http\Request;
use Lang;
use Redirect;

abstract class Apps extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $config;
	protected $name;
	protected $title;
	protected $description;
	protected $table_content;
	protected $rows;
	protected $settings;
	protected $plugins_backend;
	protected $plugins_front;
	protected $menu_category;
	protected $sitemap = 1;
	protected $version = 1;
	protected $active = 1;

	public function get_app()
	{
		if($test = Model_Apps::whereName($this->name)->first()){
			$test->rows = unserialize($test->rows);
			return $test;
		}
		return FALSE;
	}

	public function check_app()
	{
		if($test = Model_Apps::whereName($this->name)->first()){
			if($test->version < $this->version){
				$this->update_app('update', $test);
			}
		}else{
			$this->update_app('install');
		}
	}

	protected function update_app($action, $app_exists = NULL)
	{
		if($action === 'install'){
			$app = new Model_Apps();
		}else{
			$app = $app_exists;
		}
		$app->name = $this->name;
		$app->title = $this->title;
		$app->description = $this->description;
		$app->table_content = $this->table_content;
		$app->rows = serialize($this->rows);
		$app->settings = serialize($this->settings);
		$app->plugins_backend = serialize($this->plugins_backend);
		$app->plugins_front = serialize($this->plugins_front);
		$app->menu_category = $this->menu_category;
		$app->sitemap = $this->sitemap;
		$app->version = $this->version;
		$app->active = $this->active;

		if($action === 'install' && $app->save()){
			Session::flash('message', 'Компонент '. $app->title .' установлен. Версия '. $this->version);
		}
		if($action === 'update' && $app->update()){
			Session::flash('message', 'Компонент '. $app->title .' обновлен до версии '. $this->version);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), $this->_valid_construct());

		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Model_Apps();
		$data->setTable($this->table_content);
		foreach($this->rows as $rows_key => $rows_value){
			$data->$rows_key = $request->input($rows_key);
		}

		if($data->save()){
			Session::flash('message', 'Материал '. $request->input('title') .' добавлен');
			return back()->withInput();
		}

		Session::flash('error', 'Материал '. $request->input('title') .' не добавлен');
		return back()->withInput();
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
		$validator = Validator::make($request->all(), $this->_valid_construct());

		if($validator->fails()){
			return back()->withInput($request->except('password'))->withErrors($validator);
		}

		$data = new Model_Apps();
		$data->setTable($this->table_content);
		$data = $data->find($id);
		foreach($this->rows as $rows_key => $rows_value){
			$data->$rows_key = $request->input($rows_key);
		}

		if($data->save()){
			Session::flash('message', 'Материал '. $request->input('title') .' изменен');
			return back()->withInput();
		}

		Session::flash('error', 'Материал '. $request->input('title') .' не изменен');
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
		$data = new Model_Apps();
		$data->setTable($this->table_content);
		$data = $data->find($id);
		if($data->delete()){
			Session::flash('message', 'Материал успешно удален');
		}else{
			Session::flash('error', 'Материал не удален');
		}
		return Redirect::to('/admin/'. $this->name);
	}

	public function _valid_construct()
	{
		$rules = array();
		foreach($this->rows as $rows_key => $rows_value){
			if(array_key_exists('valid', $rows_value)){
				$rules[$rows_key] = $rows_value['valid'];
			}
		}
		return $rules;
	}
}
