<?php

return [
	'name' => 'feed',
	'title' => 'Ленты',
	'description' => 'Страницы с привязкой к определенным разделам',
	'table_content' => 'feed',
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
			'type' => 'select_row',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:255|required',
			'options_connect' => ['row' => 'title', 'table' => 'category']
		],
		'short' => [
			'title' => 'Анонс новости',
			'type' => 'textarea',
			'tab' => ['main' => 'Заголовок, описание']
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
			'valid' => 'max:155|required|unique:feed,url'
		],
		'date' => [
			'title' => 'Дата материала',
			'type' => 'date',
			'tab' => ['other' => 'Дата, вес, активность'],
			'valid' => 'date_format:Y-m-d H:i:s'
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
	],
	'menu_category' => 'feed',
	'admin_menu' => ['type' => 'category_list'],
	'settings' => [],
	'plugins_backend' => ['seo', 'images', 'files', 'templates'],
	'plugins_front' => [],
	'version' => 1
];
