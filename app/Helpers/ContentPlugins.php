<?php

namespace App\Helpers;

use App\Helpers\ContentPlugins\ContentPluginsInterface;
use App\Models\Seo;
use App\Models\Templates;
use App\Models\Images as Model_Images;
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
				'options' => ['Template1', 'Template2'],
				'tab' => ['templates' => 'Шаблоны'],
				'valid' => 'max:255',
				'form-group_class' => 'col-sm-6 col-sm-offset-3'
			];

            $app['rows']['template_global'] = [
				'title' => 'Глобальный шаблон',
				'type' => 'select',
				'options' => ['Template1', 'Template2'],
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
     * @param $plugins_backend
     * @param $data
     * @return mixed
     */
	public function attach_data($plugins_backend, $data)
	{
		if(in_array('seo', $plugins_backend, TRUE)){
            if(isset($data->id)){
                if($get_seo = Seo::whereIdConnect($data->id)->whereTypeConnect('page')->first()){
                    $data->seo_title = $get_seo->seo_title;
                    $data->seo_description = $get_seo->seo_description;
                    $data->seo_keywords = $get_seo->seo_keywords;
                }
            }else{
                $data->seo_title = '';
                $data->seo_description = '';
                $data->seo_keywords = '';
            }

		}

        if(in_array('templates', $plugins_backend, TRUE)){
            if(isset($data->id)){
                if($get_template = Templates::whereIdConnect($data->id)->whereTypeConnect('page')->first()){
                    $data->template = $get_template->template;
                    $data->template_global = $get_template->template_global;
                }
            }else{
                $data->template = '';
                $data->template_global = '';
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
		if( !$seo = Seo::whereIdConnect(Request::input('id_connect'))->whereTypeConnect(Request::input('type_connect'))->first()){
			$seo = new Seo();
		}
		$seo->fill(Request::all())->save();
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
            if($plugins_load_value === 'images'){
                $this->destroy_images();
            }
            if($plugins_load_value === 'files'){
                $this->destroy_files();
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

    protected function destroy_images()
    {
        if($images = Model_Images::whereIdConnect(Request::input('id_connect'))->whereType(Request::input('type_connect'))->get()){
            foreach($images as $images_value){
                $images_value->delete();
                @unlink('images/page/big/'. $images_value->name);
            }
        }
    }

    protected function destroy_files()
    {
        //TODO:удаление файлов
    }
}