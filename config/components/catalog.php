<?php

return [
	'name' => 'catalog',
	'title' => 'Каталог',
	'description' => 'Каталог товаров',
	'table_content' => 'catalog',
	'rows' => [
		'title' => [
			'title' => 'Заголовок',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'category' => [
			'title' => 'Раздел',
			'type' => 'select_category',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:255|required',
			'options_connect' => ['row' => 'title', 'table' => 'category', 'where' => ['type' => 'catalog']]
		],
		'short' => [
			'title' => 'Короткое описание',
			'type' => 'textarea',
			'tab' => ['main' => 'Заголовок, описание'],
			'css_class' => 'not-editor'
		],
		'description' => [
			'title' => 'Полное описание',
			'type' => 'textarea',
			'tab' => ['main' => 'Заголовок, описание']
		],
		'url' => [
			'title' => 'URL материала',
			'type' => 'text',
			'tab' => ['seo' => 'Seo'],
			'valid' => 'max:155|required|unique:catalog,url'
		],
		'what' => [
			'title' => 'Мера измерений',
			'type' => 'text',
			'tab' => ['cost' => 'Цена'],
			'valid' => 'max:55|required'
		],
		'cost' => [
			'title' => 'Цена',
			'type' => 'text',
			'tab' => ['cost' => 'Цена']
		],
		'cost_old' => [
			'title' => 'Старая цена',
			'type' => 'text',
			'tab' => ['cost' => 'Цена'],
		],
		'manufacture' => [
			'title' => 'Производитель',
			'type' => 'text',
			'tab' => ['cost' => 'Цена'],
		],
		'articul' => [
			'title' => 'Артикул',
			'type' => 'text',
			'tab' => ['cost' => 'Цена'],
			'valid' => 'max:255'
		],
		'nalichie' => [
			'title' => 'В наличии',
			'type' => 'text',
			'tab' => ['cost' => 'Цена'],
			'valid' => 'required|integer',
			'default' => 999999
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
			'valid' => 'integer',
			'default' => 1
		],
	],
	'menu_category' => 'catalog',
	'admin_menu' => ['type' => 'category_list'],
	'settings' => [],
	'plugins_backend' => ['seo', 'images', 'files', 'templates'],
	'plugins_front' => [],
	'version' => 1
];
