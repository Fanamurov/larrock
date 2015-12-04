<?php

namespace App\Http\Controllers;

use App\Helpers\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Apps as Model_Apps;
use DB;
use Session;
use JsValidator;
use App\Helpers\ContentPlugins;

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
		if($app = Model_Apps::whereName($this->name)->first()){
			$app->rows = unserialize($app->rows);
			$ContentPlugins = new ContentPlugins();
			$app = $ContentPlugins->attach_rows($app, $this->plugins_backend);
			return $app;
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
		$app = $app_exists;
		if($action === 'install'){
			$app = new Model_Apps();
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
				if($get_seo = DB::table('seo')->whereId_connect($data['data']->id)->whereType_connect($this->name)->first()){
					$data['data']->seo_title = $get_seo->seo_title;
					$data['data']->seo_description = $get_seo->seo_description;
					$data['data']->seo_keywords = $get_seo->seo_keywords;
				}
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
		}
		return $data;
	}

	public function plugin_templates($data)
	{
		if(in_array('templates', $this->plugins_backend, TRUE)){
			if(array_key_exists('data', $data)){
				if($get_template = DB::table('templates')->whereId_connect($data['data']->id)->whereType_connect($this->name)->first()){
                    $data['data']->template = $get_template->template;
                    $data['data']->template_global = $get_template->template_global;
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
		return $data;
	}
}
