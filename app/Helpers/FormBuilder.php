<?php

namespace App\Helpers;

use App\Helpers\FormBuilder\FormBuilderInterface;
use DB;
use View;
use App\Helpers\Tree;

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

		if(\Request::input($row_key)){
			$data->$row_key = \Request::input($row_key);
		}

		if( !isset($row_settings['options_connect']['selected_search'])){
			$row_settings['options_connect']['selected_search'] = 'key';
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

		$row_settings['options'] = array_unique($row_settings['options']);

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
		$selected = [];
		if(\Request::input($row_key)){
			$selected[] = \Request::input($row_key);
		}else{
			if($data->get_category){
				foreach($data->get_category as $category){
					$selected[] = $category->id;
				}
			}
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

		$tree = new Tree;
		$row_settings['options'] = $tree->build_tree($list_categories, 'parent');

		return View::make('formbuilder.select.category', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data, 'selected' => $selected])->render();
	}

	public function select_category_once($row_key, $row_settings, $data)
	{
		if( !array_key_exists('options', $row_settings)){
			$row_settings['options'] = [];
		}

		if(array_key_exists('default', $row_settings)){
			$row_settings['options'][''] = $row_settings['default'];
		}
		$selected = [];
		if(\Request::input($row_key)){
			$selected[] = \Request::input($row_key);
		}else{
			if($data->get_category){
				foreach($data->get_category as $category){
					$selected[] = $category->id;
				}
			}
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

		$tree = new Tree;
		$row_settings['options'] = $tree->build_tree($list_categories, 'parent');

		return View::make('formbuilder.select.category-once', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data, 'selected' => $selected])->render();
	}
}