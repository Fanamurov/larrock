<?php

namespace App\Helpers;

use App\Helpers\ContentPlugins\ContentPluginsInterface;
use App\Models\Files;
use App\Models\Images;
use App\Models\Seo;
use App\Models\Templates;
use App\Models\Images as Model_Images;
use App\Models\Files as Model_Files;
use Request;
use Illuminate\Support\Arr;

class ContentPlugins implements ContentPluginsInterface
{
	/**
	 * Прикрепляем к объекту полей компонента поля от плагинов
	 * @param $app
	 *
	 * @return mixed
	 */
	public function attach_rows($app)
	{
		if(in_array('seo', $app['plugins_backend'], TRUE)){
			$app['rows']['seo_title'] = [
				'title' => 'Title материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:255',
				'help' => 'По-умолчанию равно заголовку материала',
			];

			$app['rows']['seo_description'] = [
				'title' => 'Description материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:255',
				'help' => 'По-умолчанию равно заголовку материала',
			];

			$app['rows']['seo_keywords'] = [
				'title' => 'Keywords материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:255'
			];
		}

		if(in_array('templates', $app['plugins_backend'], TRUE)){
            $app['rows']['template'] = [
				'title' => 'Шаблон материала',
				'type' => 'select',
				'options' => ['Template1' => 'Template1', 'Template2' => 'Template2'],
				'tab' => ['templates' => 'Шаблоны'],
				'valid' => 'max:255',
				'form-group_class' => 'col-sm-6 col-sm-offset-3'
			];

            $app['rows']['template_global'] = [
				'title' => 'Глобальный шаблон',
				'type' => 'select',
				'options' => ['Template1' => 'Template1', 'Template2' => 'Template2'],
				'tab' => ['templates' => 'Шаблоны'],
				'valid' => 'max:255',
				'form-group_class' => 'col-sm-6 col-sm-offset-3'
			];
		}
		return $app;
	}

    /**
     * Присоединение полей для заполнения/данных плагинов прикрепленных к материалу
     *
     * @param array	$app_config
     * @param mixed	$data
     * @return mixed
     */
	public function attach_data($app_config, $data)
	{
		if(in_array('seo', $app_config['plugins_backend'], TRUE)){
			$data->seo_title = Arr::get($data->get_seo, 'seo_title', '');
			$data->seo_description = Arr::get($data->get_seo, 'seo_description', '');
			$data->seo_keywords = Arr::get($data->get_seo, 'seo_keywords', '');
		}

        if(in_array('templates', $app_config['plugins_backend'], TRUE)){
			$data->template = Arr::get($data->get_templates, 'template', '');
			$data->template_global = Arr::get($data->get_templates, 'template_global', '');
        }
		return $data;
	}

	/**
	 * Обновление данных плагинов
	 * @param array $plugins_load
	 */
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
		if( !$seo = Seo::whereIdConnect(Request::input('id_connect'))->whereTypeConnect(Request::input('type_connect'))->first()){
			$seo = new Seo();
		}
		if(Request::get('seo_title', '') !== ''){
			$seo->fill(Request::all())->save();
		}
	}

	protected function update_templates()
	{
		if( !$template = Templates::whereIdConnect(Request::input('id_connect'))->whereTypeConnect(Request::input('type_connect'))->first()){
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
		if($seo = Seo::whereIdConnect(Request::input('id_connect'))->whereTypeConnect(Request::input('type_connect'))->first()){
			$seo->delete();
		}
	}

	protected function destroy_templates()
	{
		if($template = Templates::whereIdConnect(Request::input('id_connect'))->whereTypeConnect(Request::input('type_connect'))->first()){
			$template->delete();
		}
	}
}