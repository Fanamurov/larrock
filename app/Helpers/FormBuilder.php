<?php

namespace app\Helpers;

use App\Helpers\FormBuilder\FormBuilderInterface;
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

        if($get_options = DB::table($row_settings['options_connect']['table'])->get([$row_settings['options_connect']['row'], 'id'])){
            foreach($get_options as $get_options_value){
                $row_settings['options'][$get_options_value->id] = $get_options_value->$row_settings['options_connect']['row'];
            }
        }
        return View::make('formbuilder.select.row', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data])->render();
    }

}