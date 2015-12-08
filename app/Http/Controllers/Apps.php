<?php

namespace App\Http\Controllers;

use App\Helpers\Component;
use App\Helpers\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Apps as Model_Apps;
use DB;
use App\Helpers\ContentPlugins;
use Alert;
use Config;

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
	 * Проверка установлен ли компонент, требуется ли установка или обновление
	 *
	 * @param string	$app_name	Название компонента
	 */
	public function check_app($app_name)
	{

		$this->config = Config::get('components.'. $app_name);
		$this->name = $this->config['name'];
		$this->title = $this->config['title'];
		$this->description = \Funct\Collection\get($this->config, 'description', '');
		$this->table_content = $this->config['table_content'];
		$this->rows = $this->config['rows'];
		$this->settings = \Funct\Collection\get($this->config, 'settings', []);
		$this->plugins_backend =\Funct\Collection\get($this->config, 'plugins_backend', []);
		$this->plugins_front = \Funct\Collection\get($this->config, 'plugins_front', []);
		$this->menu_category = \Funct\Collection\get($this->config, 'menu_category', '');
		$this->sitemap = \Funct\Collection\get($this->config, 'sitemap', 1);
		$this->version = \Funct\Collection\get($this->config, 'version', 1);
		$this->active = \Funct\Collection\get($this->config, 'active', 1);


		if($test = Model_Apps::whereName($this->name)->first()){
			if($test->version < $this->version){
				$this->update_app('update', $test);
			}
		}else{
			$this->update_app('install');
		}
	}

	/**
	 * Обновление или установка компонента
	 * @param string    $action			install|update
	 * @param null 		$app_exists
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
	 * @link http://stackoverflow.com/a/10332361/2748662
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
