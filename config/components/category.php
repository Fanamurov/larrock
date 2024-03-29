<?php

return [
	'name' => 'category',
	'title' => 'Разделы',
	'description' => '',
	'table_content' => 'category',
	'rows' => [
		'parent' => [
			'title' => 'Родительский раздел',
			'type' => 'select_category',
			'tab' => ['main' => 'Заголовок, описание'],
			'options_connect' => ['row' => 'title', 'table' => 'category', 'where' => ['type' => 'catalog']],
			'default' => 'Это новый корневой раздел'
		],
		'title' => [
			'title' => 'Заголовок',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'short' => [
			'title' => 'Анонс',
			'type' => 'textarea',
			'tab' => ['main' => 'Заголовок, описание']
		],
		'description' => [
			'title' => 'Описание раздела',
			'type' => 'textarea',
			'tab' => ['main' => 'Заголовок, описание']
		],
		'type' => [
			'title' => 'Тип раздела',
			'type' => 'hidden',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:155'
		],
		'level' => [
			'title' => 'Уровень вложенности раздела',
			'type' => 'hidden',
			'tab' => ['main' => 'Заголовок, описание'],
		],
		'sitemap' => [
			'title' => 'Публиковать ли раздел в sitemap',
			'type' => 'text',
			'tab' => ['other' => 'Дата, вес, активность'],
			'valid' => 'integer',
			'default' => 1
		],
		'url' => [
			'title' => 'URL материала',
			'type' => 'text',
			'tab' => ['seo' => 'Seo'],
			'valid' => 'max:155|required|unique:category,url,:id'
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
	'admin_menu' => ['type' => 'hidden'],
	'settings' => [],
	'plugins_backend' => ['seo', 'images', 'files', 'templates'],
	'plugins_front' => [],
	'version' => 1
];
