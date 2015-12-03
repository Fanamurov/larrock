<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Apps;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use App\Models\Page as Model_Page;
use App\Models\Seo as Model_Seo;
use App\Models\Templates as Model_Templates;

class PageController extends Apps
{
	public function __construct()
	{
		$this->name = 'page';
		$this->title = 'Cтраницы';
		$this->description = 'Страницы без привязки к определенному разделу';
		$this->table_content = 'feed';
		$this->rows = [
			'title' => [
				'title' => 'Заголовок',
				'in_table_admin' => 'TRUE',
				'type' => 'text',
				'tab' => ['main' => 'Заголовок, описание'],
				'valid' => 'max:255|required',
				'typo' => 'true'
			],
			'description' => [
				'title' => 'Текст новости',
				'type' => 'textarea',
				'tab' => ['main' => 'Заголовок, описание']
			],
			'url' => [
				'title' => 'URL материала',
				'type' => 'text',
				'tab' => ['seo' => 'Seo'],
				'valid' => 'max:155|required'
			],
			'date' => [
				'title' => 'Дата материала',
				'type' => 'date',
				'tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'date'
			],
			'position' => [
				'title' => 'Вес материала',
				'type' => 'text',
				'tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'integer',
				'default' => 0
			],
			'active' => [
				'title' => 'Опубликован',
				'type' => 'checkbox',
				'checked' => 'TRUE',
				'tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'integer|max:1',
				'default' => 1
			],
		];
		$this->settings = '';
		$this->plugins_backend = ['seo', 'images', 'files', 'templates'];
		$this->plugins_front = '';
		$this->version = 22;
		$this->check_app();
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->_valid_construct());
        if($validator->fails()){
            return back()->withInput($request->except('password'))->withErrors($validator);
        }

        $data = Model_Page::find($id);
        if($data->fill($request->all())->save()){
            Session::flash('message', 'Материал '. $request->input('title') .' изменен');

            if(in_array('seo', $this->plugins_backend, TRUE)){
                if( !$seo = Model_Seo::where(['id_connect' => $id, 'type_connect' => $this->name])->first()){
                    $seo = new Model_Seo();
                }
                $seo->fill($request->all())->save();
            }

            if(in_array('templates', $this->plugins_backend, TRUE)){
                if( !$template = Model_Templates::where(['id_connect' => $id, 'type_connect' => $this->name])->first()){
                    $template = new Model_Templates();
                }
                $template->fill($request->all())->save();
            }

            return back();
        }

        Session::flash('error', 'Материал '. $request->input('title') .' не изменен');
        return back()->withInput();
    }
}
