<?php

namespace App\Http\Controllers;

use App\Helpers\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Apps as Model_Apps;
use DB;
use App\Helpers\ContentPlugins;
use Alert;

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

    /**
     * Возвращает конфиг компонента с его настройками, полями
     * @return bool|mixed|static
     */
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

    /**
     * Проверка установлен ли компонент, нужно ли обновление или установка
     */
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

    /**
     * Обновление компонента (конфига в бд)
     *
     * @param $action
     * @param null $app_exists
     */
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
            Alert::add('info', 'Компонент '. $app->title .' установлен. Версия '. $this->version)->flash();
		}
		if($action === 'update' && $app->update()){
			Alert::add('info', 'Компонент '. $app->title .' обновлен до версии '. $this->version)->flash();
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
     * Вспомогательный метод построения правил валидации из конфига полей компонента
     *
     * @return array
     */
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
     * Разбиение полей формы по табам
     *
     * @param array $data
     * @return mixed
     */
    public function tabbable(array $data)
    {
        $formBuilder = new FormBuilder();
        $data['tabs'] = $this->get_tabs_names_admin($data['app']->rows);
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
	public function get_tabs_names_admin(array $rows)
	{
		$tabs = array();
		foreach($rows as $row_value){
			if(array_key_exists('tab', $row_value)){
				$tabs = array_add($tabs, key($row_value['tab']), $row_value['tab'][key($row_value['tab'])]);
			}
		}
		return $tabs;
	}

    /**
     * Построение дерева объектов по определенному полю(по-умолчанию parent)
     *
     * @link http://stackoverflow.com/a/10332361/2748662
     * @param $data
     * @param string $row_level     по какому полю ищем детей
     * @return array
     */
    public function build_tree($data, $row_level = 'parent')
    {
        $new = array();
        foreach ($data as $a){
            $new[$a->$row_level][] = $a;
        }
        $tree = $this->createTree($new, $new[0]);
        return $tree;
    }

    /**
     * Вспомогательный метод для построения дерева
     * Прикрпепляем информацию о вложенности элемента ->level
     *
     * @param $list
     * @param array $parent
     * @param int $level
     * @return array
     */
    public function createTree(&$list, $parent, $level = 1){
        $tree = array();
        foreach ($parent as $k=>$l){
            $l->level = $level;
            if(isset($list[$l->id])){
                $l->children = $this->createTree($list, $list[$l->id], ++$level);
                --$level;
            }
            $tree[] = $l;
        }
        return $tree;
    }
}
