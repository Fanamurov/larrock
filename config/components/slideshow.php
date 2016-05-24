<?php

return [
	'name' => 'slideshow',
	'title' => 'Слайдшоу',
	'description' => 'Слайдшоу на главной странице',
	'table_content' => 'slideshow',
	'rows' => [
		'title' => [
			'title' => 'Название блока',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'description' => [
			'title' => 'Текст блока',
			'type' => 'textarea',
			'tab' => ['main' => 'Заголовок, описание']
		],
		'banner_url' => [
			'title' => 'URL слайда',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:255|required',
			'in_table_admin' => 'TRUE'
		],
		'view' => [
			'title' => 'Развернуть слайд на всю ширину',
			'type' => 'checkbox',
			'checked' => 'TRUE',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'integer|max:1',
			'default' => 1
		],
		'url' => [
			'title' => 'URL материала',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'max:155|required|unique:blocks,url,:id'
		],
		'position' => [
			'title' => 'Вес материала',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'integer',
			'default' => 0
		],
		'active' => [
			'title' => 'Опубликован',
			'type' => 'checkbox',
			'checked' => 'TRUE',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'integer|max:1',
			'default' => 1
		],
	],
	'settings' => [],
	'plugins_backend' => ['images', 'files'],
	'plugins_front' => [],
	'version' => 1
];
