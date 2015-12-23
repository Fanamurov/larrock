<?php

namespace App\Helpers;

use App\Helpers\FormBuilder\FormBuilderInterface;
use Carbon\Carbon;
use DB;
use View;

class FormBuilder implements FormBuilderInterface
{
	public function render($app, $data, $tab = NULL)
	{
		$render = '';
		foreach($app['rows'] as $row_key => $row_settings){
			if($tab){
				if(array_key_exists('tab', $row_settings) && key($row_settings['tab']) === $tab){
					$render .=  $this->$row_settings['type']($row_key, $row_settings, $data);
				}
			}else{
				$render .= $this->$row_settings['type']($row_key, $row_settings, $data);
			}
		}
		return $render;
	}

	public function hidden($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
		return View::make('formbuilder.input.hidden', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

	public function text($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
        return View::make('formbuilder.input.text', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

	public function textarea($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
        return View::make('formbuilder.textarea.editor', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

	public function date($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
        return View::make('formbuilder.input.date', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

	public function checkbox($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
        return View::make('formbuilder.checkbox.default', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

	public function select($row_key, $row_settings, $data)
	{
        if( !array_key_exists('options', $row_settings)){
            if(array_key_exists('default', $row_settings)){
                $row_settings['options'] = [$row_settings['default']];
            }else{
                $row_settings['options'] = [];
            }
        }
        return View::make('formbuilder.select.default', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

    public function select_row($row_key, $row_settings, $data)
    {
        if( !array_key_exists('options', $row_settings)){
            $row_settings['options'] = [];
        }

        if(array_key_exists('default', $row_settings)){
            $row_settings['options'][''] = $row_settings['default'];
        }

		if(isset($row_settings['options_connect']['where'])){
			foreach($row_settings['options_connect']['where'] as $where_key => $where_value){
				if($get_options = DB::table($row_settings['options_connect']['table'])->where($where_key, '=', $where_value)->get([$row_settings['options_connect']['row'], 'id'])){
					foreach($get_options as $get_options_value){
						$row_settings['options'][$get_options_value->id] = $get_options_value->$row_settings['options_connect']['row'];
					}
				}
			}
		}else{
			if($get_options = DB::table($row_settings['options_connect']['table'])->get([$row_settings['options_connect']['row'], 'id'])){
				foreach($get_options as $get_options_value){
					$row_settings['options'][$get_options_value->id] = $get_options_value->$row_settings['options_connect']['row'];
				}
			}
		}

        return View::make('formbuilder.select.row', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
    }

	public function select_category($row_key, $row_settings, $data)
	{
		if( !array_key_exists('options', $row_settings)){
			$row_settings['options'] = [];
		}

		if(array_key_exists('default', $row_settings)){
			$row_settings['options'][''] = $row_settings['default'];
		}
		$list_categories = [];

		if(isset($row_settings['options_connect']['where'])){
			foreach($row_settings['options_connect']['where'] as $where_key => $where_value){
				if($get_options = DB::table($row_settings['options_connect']['table'])->where($where_key, '=', $where_value)
					->get([$row_settings['options_connect']['row'], 'id', 'parent', 'level'])){
					foreach($get_options as $get_options_value){
						$list_categories[] = $get_options_value;
					}
				}
			}
		}else{
			if($get_options = DB::table($row_settings['options_connect']['table'])->get([$row_settings['options_connect']['row'], 'id', 'parent', 'level'])){
				foreach($get_options as $get_options_value){
					$list_categories[] = $get_options_value;
				}
			}
		}

		$row_settings['options'] = $this->build_tree($list_categories, 'parent');

		return View::make('formbuilder.select.category', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
	}

	/** TODO: Дублирование MenuController, вынести функции в один хелпер */
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
		return $this->createTree($new, $new[0]);
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