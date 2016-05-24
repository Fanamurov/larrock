<?php

return [
	'name' => 'blocks',
	'title' => 'Блоки',
	'description' => 'Блоки для вставки в шаблон',
	'table_content' => 'blocks',
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
