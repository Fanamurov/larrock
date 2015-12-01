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
		$this->title = 'Cтраницы';
		$this->description = 'Страницы без привязки к определенному разделу';
		$this->table_content = 'feed';
		$this->rows = [
			'title' => [
				'title' => 'Заголовок',
				'in_table_admin' => 'TRUE',
				'type' => 'text',
				'in_admin_tab' => ['main' => 'Заголовок, описание'],
				'valid' => 'max:255|required',
				'typo' => 'true'
			],
			'description' => [
				'title' => 'Текст новости',
				'type' => 'textarea',
				'in_admin_tab' => ['main' => 'Заголовок, описание']
			],
			'url' => [
				'title' => 'URL материала',
				'type' => 'text',
				'in_admin_tab' => ['seo' => 'Seo'],
				'valid' => 'max:155|required'
			],
			'date' => [
				'title' => 'Дата материала',
				'type' => 'date',
				'in_admin_tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'date'
			],
			'position' => [
				'title' => 'Вес материала',
				'type' => 'input',
				'in_admin_tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'integer'
			],
			'active' => [
				'title' => 'Опубликован',
				'type' => 'checkbox',
				'checked' => 'TRUE',
				'in_admin_tab' => ['other' => 'Дата, вес, активность'],
				'valid' => 'integer|max:1',
				'default' => 1
			],
		];
		$this->settings = '';
		$this->plugins_backend = ['seo', 'images', 'files', 'templates'];
		$this->plugins_front = '';
		$this->version = 19;
		$this->check_app();
	}
}
