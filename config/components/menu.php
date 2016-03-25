<?php

return [
	'name' => 'menu',
	'title' => 'Меню сайта',
	'description' => '',
	'table_content' => 'menu',
	'rows' => [
		'title' => [
			'title' => 'Название пункта',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'category' => [
			'title' => 'Вид меню',
			'type' => 'select',
			'default' => 'top'
		],
		'type' => [
			'title' => 'Тип',
			'type' => 'text',
		],
		'parent' => [
			'title' => 'Родитель',
			'type' => 'select_row',
			'default' => 'Это главный уровень',
			'options_connect' => ['row' => 'title', 'table' => 'menu']
		],
		'connect' => [
			'title' => 'Связь',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
		],
		'url' => [
			'title' => 'URL пункта',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:155|required'
		],
		'position' => [
			'title' => 'Вес',
			'type' => 'text',
			'valid' => 'integer',
			'default' => 0
		],
		'active' => [
			'title' => 'Опубликован',
			'type' => 'checkbox',
			'checked' => 'TRUE',
			'valid' => 'integer|max:1',
			'default' => 1
		],
	],
    'admin_menu' => ['type' => 'hidden'],
	'settings' => [],
	'plugins_backend' => [],
	'plugins_front' => [],
	'version' => 1
];
