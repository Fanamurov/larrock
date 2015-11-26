<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Apps;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Apps as Model_Apps;
use DB;
use Session;
use Validator;

class PageController extends Apps
{
	public function __construct()
	{
		$this->name = 'page';
		$this->title = 'Статичные страницы';
		$this->description = 'Страницы без привязки к определенному разделу';
		$this->table_content = 'feed';
		$this->rows = [
			'title' => [
				'title' => 'Заголовок',
				'in_table_admin' => 'TRUE',
				'type' => 'text',
				'in_admin_tab' => 'main',
				'valid' => 'max:255|required'
			],
			'description' => [
				'title' => 'Текст новости',
				'type' => 'textarea',
				'in_admin_tab' => 'main'
			],
			'url' => [
				'title' => 'URL материала',
				'type' => 'text',
				'in_admin_tab' => 'seo',
				'valid' => 'max:155|required'
			],
			'date' => [
				'title' => 'Дата материала',
				'type' => 'date',
				'in_admin_tab' => 'other',
				'valid' => 'date'
			],
			'position' => [
				'title' => 'Вес материала',
				'type' => 'input',
				'in_admin_tab' => 'other',
				'valid' => 'integer'
			],
			'active' => [
				'title' => 'Опубликован',
				'type' => 'checkbox',
				'checked' => 'TRUE',
				'in_admin_tab' => 'other',
				'valid' => 'integer|max:1',
				'default' => 1
			],
		];
		$this->settings = '';
		$this->plugins_backend = '';
		$this->plugins_front = '';
		$this->version = 12;
		$this->check_app();
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['apps'] = $this->get_app();
		$data['data'] = DB::table($this->table_content)->get();
		return view('admin.apps.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['apps'] = $this->get_app();
		$data['tabs'] = ['main', 'seo', 'other'];
		return view('admin.apps.create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data['apps'] = $this->get_app();
		$data['tabs'] = ['main', 'seo', 'other'];
		$data['data'] = DB::table($this->table_content)->where('id', '=', $id)->get();
		return view('admin.apps.edit', $data);
    }
}
