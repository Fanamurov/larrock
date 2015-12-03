<?php

namespace App\Http\Controllers;

use App\Helpers\FormBuilder;
use App\Models\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Apps as Model_Apps;
use App\Models\Seo as Model_Seo;
use App\Models\Templates as Model_Templates;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use Illuminate\Http\Request;
use Lang;
use Redirect;
use JsValidator;

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
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['apps'] = $this->get_app();
		$data['data'] = DB::table($this->table_content)->paginate(30);
		\View::share('validator', '');
		return view('admin.apps.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Helpers\FormBuilder $formBuilder
	 * @return \Illuminate\Http\Response
	 */
	public function create(FormBuilder $formBuilder)
	{
		$data['apps'] = $this->get_app();
		$this->plugin_seo($data);
		$this->plugin_templates($data);
		$data['tabs'] = $this->get_tabs_names_admin();
		$data['next_id'] = DB::table($this->table_content)->max('id') + 1;

		foreach($data['tabs'] as $tab_key => $tab_value){
			$data['form'][$tab_key] = $formBuilder->render($data['apps'], [], $tab_key);
		}

		$validator = JsValidator::make($this->_valid_construct());
		\View::share('validator', $validator);

		return view('admin.apps.create', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \App\Helpers\FormBuilder $formBuilder
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, FormBuilder $formBuilder)
	{
		$data['data'] = DB::table($this->table_content)->whereId($id)->get();
		$data['apps'] = $this->get_app();
        $data['id'] = $id;

		$this->plugin_seo($data);
		$this->plugin_templates($data);
		$data['tabs'] = $this->get_tabs_names_admin();

		foreach($data['tabs'] as $tab_key => $tab_value){
			$data['form'][$tab_key] = $formBuilder->render($data['apps'], $data['data'], $tab_key);
		}

		$validator = JsValidator::make($this->_valid_construct());
		\View::share('validator', $validator);

		return view('admin.apps.edit', $data);
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

        $data->active = $request->input('active', 0);
        $data->active = $request->input('position', 0);

        $data->setTable($this->table_content);
		$next_id = DB::table($this->table_content)->max('id') + 1;

		if($data->save()){
			Session::flash('message', 'Материал '. $request->input('title') .' добавлен');

			if(in_array('seo', $this->plugins_backend, TRUE)){
				$seo = new Model_Seo();
				$seo->title = $request->get('seo_title');
				$seo->description = $request->get('seo_description');
				$seo->keywords = $request->get('seo_keywords');
				$seo->id_connect = $next_id;
				$seo->type_connect = $this->name;
				$seo->save();
			}

			if(in_array('template', $this->plugins_backend, TRUE)){
				$template = new Model_Templates();
				$template->template = $request->get('template');
				$template->template_global = $request->get('template_global');
				$template->id_connect = $next_id;
				$template->type_connect = $this->name;
				$template->save();
			}

			return \Redirect::to('/admin/'. $this->name .'/'. $next_id .'/edit')->withInput();
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

        $data->active = $request->input('active', 0);

        $data->setTable($this->table_content);
        $data->save();

		if($data->save()){
			Session::flash('message', 'Материал '. $request->input('title') .' изменен');

			if(in_array('seo', $this->plugins_backend, TRUE)){
				$seo = Model_Seo::where(['id_connect' => $id, 'type_connect' => $this->name])->first();
				if( !$seo){
					$seo = new Model_Seo();
				}
				$seo->title = $request->get('seo_title');
				$seo->description = $request->get('seo_description');
				$seo->keywords = $request->get('seo_keywords');
				$seo->id_connect = $id;
				$seo->type_connect = $this->name;
				$seo->save();
			}

			if(in_array('templates', $this->plugins_backend, TRUE)){
				$template = Model_Templates::where(['id_connect' => $id, 'type_connect' => $this->name])->first();
				if( !$template){
					$template = new Model_Templates();
				}
				$template->template = $request->get('template');
				$template->template_global = $request->get('template_global');
				$template->id_connect = $id;
				$template->type_connect = $this->name;
				$template->save();
			}

			return back();
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
        $data->setTable($this->table_content);
		if($data->delete()){
			Session::flash('message', 'Материал успешно удален');

            if(in_array('seo', $this->plugins_backend, TRUE)){
                if($seo = Model_Seo::where(['id_connect' => $id, 'type_connect' => $this->name])->first()){
                    $seo->delete();
                }
            }

            if(in_array('templates', $this->plugins_backend, TRUE)){
                if($template = Model_Templates::where(['id_connect' => $id, 'type_connect' => $this->name])->first()){
                    $template->delete();
                }
            }

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

	/**
	 * Возвращает ключ таба и его название из массива параметров поля компонента
	 * @return array
	 */
	public function get_tabs_names_admin()
	{
		$tabs = array();
		foreach($this->rows as $row_value){
			if(array_key_exists('tab', $row_value)){
				$tabs = array_add($tabs, key($row_value['tab']), $row_value['tab'][key($row_value['tab'])]);
			}
		}
		return $tabs;
	}

	public function plugin_seo($data)
	{
		if(in_array('seo', $this->plugins_backend, TRUE)){
			if(array_key_exists('data', $data)){
				$get_seo = DB::table('seo')->whereId_connect($data['data'][0]->id)->whereType_connect($this->name)->first();
			}

			$this->rows['seo_title'] = [
				'title' => 'Title материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:255',
				'help' => 'По-умолчанию равно заголовку материала',
			];

			$this->rows['seo_description'] = [
				'title' => 'Description материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:255',
				'help' => 'По-умолчанию равно заголовку материала',
			];

			$this->rows['seo_keywords'] = [
				'title' => 'Keywords материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:255'
			];

			if(isset($get_seo)){
				$data['data']['0']->seo_title = $get_seo->seo_title;
				$data['data']['0']->seo_description = $get_seo->seo_description;
				$data['data']['0']->seo_keywords = $get_seo->seo_keywords;
			}
		}
		$data['apps']->rows = $this->rows;
		return $data;
	}

	public function plugin_templates($data)
	{
		if(in_array('templates', $this->plugins_backend, TRUE)){
			if(array_key_exists('data', $data)){
				if($get_template = DB::table('templates')->whereId_connect($data['data'][0]->id)->whereType_connect($this->name)->first()){
                    $data['data']['0']->template = $get_template->template;
                    $data['data']['0']->template_global = $get_template->template_global;
                }
			}

			$this->rows['template'] = [
				'title' => 'Шаблон материала',
				'type' => 'select',
				'options' => ['Template1', 'Template2'],
				'tab' => ['templates' => 'Шаблоны'],
				'valid' => 'max:255',
				'form-group_class' => 'col-sm-6 col-sm-offset-3'
			];

			$this->rows['template_global'] = [
				'title' => 'Глобальный шаблон',
				'type' => 'select',
				'options' => ['Template1', 'Template2'],
				'tab' => ['templates' => 'Шаблоны'],
				'valid' => 'max:255',
				'form-group_class' => 'col-sm-6 col-sm-offset-3'
			];
		}
		$data['apps']->rows = $this->rows;
		return $data;
	}
}
