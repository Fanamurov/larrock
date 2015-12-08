<?php

namespace App\Helpers;

use App\Helpers\Component\ComponentInterface;
use App\Models\Apps;
use Funct;
use Cache;

class Component implements ComponentInterface
{
	/**
	 * Возвращает конфиг компонента с его настройками, полями
	 *
	 * @param string|int	$app_nameOrId		Название или ID компонента
	 * @param bool|NULL 	$attach_plugins		Присоединять ли поля от плагинов
	 * @return bool|mixed|static
	 */
	public static function get_app($app_nameOrId, $attach_plugins = TRUE)
	{
		$cache_key = sha1('get_app'. $app_nameOrId . $attach_plugins);
		if(Cache::has($cache_key)){
			return Cache::get($cache_key);
		}else{
			if(is_int($app_nameOrId)){
				$app = Apps::whereId($app_nameOrId)->first();
			}else{
				$app = Apps::whereName($app_nameOrId)->first();
			}
			if($app){
				$app->rows = unserialize($app->rows);
				$app->plugins_backend = unserialize($app->plugins_backend);
				$app->plugins_front = unserialize($app->plugins_front);
				$app->settings = unserialize($app->settings);
				if($attach_plugins){
					$ContentPlugins = new ContentPlugins();
					$app = $ContentPlugins->attach_rows($app, $app->plugins_backend);
				}
			}

			Cache::forever($cache_key, $app);
			return $app;
		}
	}

	/**
	 * Вывод списка установленных компонентов
	 *
	 * @param int   $onlyActive		Вернуть только активные
	 * @param array $rows			Какие поля вернуть
	 *
	 * @return array|\Illuminate\Database\Eloquent\Collection|mixed|static[]
	 */
	public static function list_apps($onlyActive = 1, $rows = [])
	{
		$cache_key = sha1('list_apps'. $onlyActive . serialize($rows));
		if(Cache::has($cache_key)){
			return Cache::get($cache_key);
		}else{
			if($onlyActive){
				$app = Apps::whereActive($onlyActive)->get();
			}else{
				$app = Apps::all();
			}

			Cache::forever($cache_key, $app);
			return $app;
		}
	}

	/**
	 * Проверка, включен ли плагин у компонента
	 *
	 * @param string $app_name			Название компонента
	 * @param string $search_plugin		Название плагина для поиска
	 * @param string $plugin_type		Тип плагина plugins_backend|plugins_front
	 *
	 * @return bool|mixed
	 */
	public static function search_plugin_apply($app_name, $search_plugin, $plugin_type = 'plugins_backend')
	{
		$cache_key = sha1('search_plugin_apply'. $app_name . $search_plugin . $plugin_type);
		if(Cache::has($cache_key)){
			return Cache::get($cache_key);
		}else{
			$get_app = Apps::whereName($app_name)->first()->toArray();
			$result = in_array($search_plugin, unserialize($get_app[$plugin_type]), TRUE);
			Cache::forever($cache_key, $result);
			return $result;
		}
	}

	/**
	 * Вспомогательный метод построения правил валидации из конфига полей компонента
	 *
	 * @param @rows
	 * @return array
	 */
	public static function _valid_construct($rows)
	{
		$rules = array();
		foreach($rows as $rows_key => $rows_value){
			if(array_key_exists('valid', $rows_value)){
				$rules[$rows_key] = $rows_value['valid'];
			}
		}
		return $rules;
	}

	/**
	 * Разбиение полей формы по табам
	 *
	 * @param array $data
	 * @return mixed
	 */
	public static function tabbable(array $data)
	{
		$formBuilder = new FormBuilder();
		$data['tabs'] = Component::get_tabs_names_admin($data['app']->rows);
		foreach($data['tabs'] as $tab_key => $tab_value){
			$data['form'][$tab_key] = $formBuilder->render($data['app'], $data['data'], $tab_key);
		}
		if(count($data['tabs']) < 2){
			$data['form'] = $formBuilder->render($data['app'], $data['data']);
		}
		return $data;
	}

	/**
	 * Возвращает массив с именами табов для вывода полей формы
	 * @param array $rows
	 * @return array
	 */
	public static function get_tabs_names_admin(array $rows)
	{
		$tabs = array();
		foreach($rows as $row_value){
			if(array_key_exists('tab', $row_value)){
				$tabs = array_add($tabs, key($row_value['tab']), $row_value['tab'][key($row_value['tab'])]);
			}
		}
		return $tabs;
	}
}