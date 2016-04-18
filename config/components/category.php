<?php

return [
	'name' => 'category',
	'title' => 'Разделы',
	'description' => '',
	'table_content' => 'category',
	'rows' => [
		'parent' => [
			'title' => 'Родительский раздел',
			'type' => 'select_category_once',
			'tab' => ['main' => 'Заголовок, описание'],
			'options_connect' => ['row' => 'title', 'table' => 'category', 'where' => ['type' => 'tours']],
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
        'forecast_url' => [
            'title' => 'URL прогноза погоды (http://api.pogoda.com/)',
            'type' => 'text',
            'tab' => ['other' => 'Дополнительные поля']
        ],
        'map' => [
            'title' => 'Координаты для карты (https://constructor.maps.yandex.ru/location-tool/)',
            'type' => 'text',
            'tab' => ['other' => 'Дополнительные поля']
        ],
		'sitemap' => [
			'title' => 'Публиковать ли раздел в sitemap',
			'type' => 'checkbox',
			'tab' => ['other' => 'Дополнительные поля'],
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
			'tab' => ['other' => 'Дополнительные поля'],
			'valid' => 'integer',
			'default' => 0
		],
		'active' => [
			'title' => 'Опубликован',
			'type' => 'checkbox',
			'checked' => 'TRUE',
			'tab' => ['other' => 'Дополнительные поля'],
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
