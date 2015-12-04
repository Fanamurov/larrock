<?php

namespace app\Helpers;

use App\Helpers\ContentPlugins\ContentPluginsInterface;
use App\Models\Seo;
use App\Models\Templates;
use Request;

class ContentPlugins implements ContentPluginsInterface
{
	protected $rows;

	public function __construct(){
		$this->rows = [];
	}

	public function __set($name, $value) {
		$this->rows[$name] = $value;
	}
	public function __get($name) {
		return $this->rows[$name];
	}

	/**
	 * Прикрепляем к объекту полей компонента поля от плагинов
	 * @param $app
	 * @param $plugins_backend
	 *
	 * @return mixed
	 */
	public function attach_rows($app, $plugins_backend)
	{
		$this->rows = $app->rows;
		if(in_array('seo', $plugins_backend, TRUE)){
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

		if(in_array('templates', $plugins_backend, TRUE)){
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

		$app->rows = $this->rows;
		return $app;
	}

	public function attach_data($plugins_backend, array $data)
	{
		if(in_array('seo', $plugins_backend, TRUE)){
			if(array_key_exists('data', $data)){
				if($get_seo = Seo::whereIdConnect($data['data']->id_connect)->whereTypeConnect('page')->first()){
					$data['data']->seo_title = $get_seo->seo_title;
					$data['data']->seo_description = $get_seo->seo_description;
					$data['data']->seo_keywords = $get_seo->seo_keywords;
				}
			}
		}
		return $data;
	}

	public function update(array $plugins_load)
	{
		foreach($plugins_load as $plugins_load_value){
			if($plugins_load_value === 'seo'){
				$this->update_seo();
			}
			if($plugins_load_value === 'templates'){
				$this->update_templates();
			}
		}
	}

	protected function update_seo()
	{
		if( !$seo = Seo::where(['id_connect' => Request::input('id_connect'), 'type_connect' => Request::input('type_connect')])->first()){
			$seo = new Seo();
		}
		$seo->fill(Request::all())->save();
	}

	protected function update_templates()
	{
		if( !$template = Templates::where(['id_connect' => Request::input('id_connect'), 'type_connect' => Request::input('type_connect')])->first()){
			$template = new Templates();
		}
		$template->fill(Request::all())->save();
	}


	public function destroy(array $plugins_load)
	{
		foreach($plugins_load as $plugins_load_value){
			if($plugins_load_value === 'seo'){
				$this->destroy_seo();
			}
			if($plugins_load_value === 'templates'){
				$this->destroy_templates();
			}
		}
	}

	protected function destroy_seo()
	{
		if($seo = Seo::where(['id_connect' => Request::input('id_connect'), 'type_connect' => Request::input('type_connect')])->first()){
			$seo->delete();
		}
	}

	protected function destroy_templates()
	{
		if($template = Templates::where(['id_connect' => Request::input('id_connect'), 'type_connect' => Request::input('type_connect')])->first()){
			$template->delete();
		}
	}
}