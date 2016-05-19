<?php

return [
	'name' => 'tours',
	'title' => 'Туры',
	'description' => 'Каталог туров',
	'table_content' => 'tours',
	'rows' => [
		'title' => [
			'title' => 'Заголовок',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Описание тура'],
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'category' => [
			'title' => 'Разделы',
			'type' => 'select_category',
			'tab' => ['main' => 'Описание тура'],
			'valid' => 'max:255|required',
			'options_connect' => ['row' => 'title', 'table' => 'category', 'where' => ['type' => 'tours']]
		],
		'short' => [
			'title' => 'Короткое описание',
			'type' => 'textarea',
			'tab' => ['main' => 'Описание тура'],
			//'css_class' => 'not-editor'
		],
		'description' => [
			'title' => 'Полное описание',
			'type' => 'textarea',
			'tab' => ['main' => 'Описание тура'],
		],
		'url' => [
			'title' => 'URL материала',
			'type' => 'text',
			'tab' => ['seo' => 'Seo'],
			'valid' => 'max:155|required|unique:tours,url,:id'
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
		'cost_notactive' => [
			'title' => 'Цены не актуальны',
			'type' => 'checkbox',
			'checked' => 'TRUE',
			'tab' => ['other' => 'Дополнительные поля'],
			'valid' => 'integer',
			'default' => 0
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
		'to_rss' => [
			'title' => 'Опубликован в rss (импорт в соц.сети)',
			'type' => 'checkbox',
			'checked' => 'TRUE',
			'tab' => ['other' => 'Дата, вес, активность'],
			'valid' => 'integer|max:1',
			'default' => 1
		],
		'actual' => [
			'title' => 'Дата конца актуальности',
			'type' => 'dateDay',
			'tab' => ['other' => 'Дата, вес, активность'],
			//'valid' => 'date_format:Y-m-d h:s:i'
		],
	],
	'menu_category' => 'tours',
	'admin_menu' => ['type' => 'category_list'],
	'admin_menu_push' => ['Только туры' => '/admin/tours/all'],
	'settings' => [],
	'plugins_backend' => ['seo', 'images', 'files', 'templates'],
	'plugins_front' => [],
	'version' => 1
];
