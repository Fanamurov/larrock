<?php

namespace app\Helpers;

use App\Helpers\FormBuilder\FormBuilderInterface;
use App\Models\Apps as Model_Apps;

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
		return view('formbuilder.input.text', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data]);
	}

	public function textarea($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
		return view('formbuilder.textarea.editor', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data]);
	}

	public function date($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
		return view('formbuilder.input.date', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data]);
	}

	public function checkbox($row_key, $row_settings, $data)
	{
		if( !isset($data->$row_key) && array_key_exists('default', $row_settings)){
			$data->$row_key = $row_settings['default'];
		}
		return view('formbuilder.checkbox.default', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data]);
	}

	public function select($row_key, $row_settings, $data)
	{
		return view('formbuilder.select.default', ['row_key' => $row_key, 'row_settings' => $row_settings, 'data' => $data]);
	}

}