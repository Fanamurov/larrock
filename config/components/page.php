<?php

return [
	'name' => 'page',
	'title' => 'Страницы',
	'description' => 'Страницы без привязки к определенному разделу',
	'table_content' => 'page',
	'rows' => [
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
			'valid' => 'max:155|required|unique:page,url,:id'
		],
		'date' => [
			'title' => 'Дата материала',
			'type' => 'date',
			'tab' => ['other' => 'Дата, вес, активность'],
			'valid' => 'date_format:Y-m-d h:s:i'
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
	'settings' => [],
	'plugins_backend' => ['seo', 'images', 'files', 'templates'],
	'plugins_front' => [],
	'version' => 1
];
