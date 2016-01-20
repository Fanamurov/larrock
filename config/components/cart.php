<?php

return [
	'name' => 'cart',
	'title' => 'Корзина',
	'description' => 'Корзина заказов каталога',
	'table_content' => 'cart',
	'rows' => [
		'cost' => [
			'title' => 'Цена',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-4'
		],
		'cost_discount' => [
			'title' => 'Цена со скидкой',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-4'
		],
		'position' => [
			'title' => 'Вес материала',
			'type' => 'text',
			'tab' => ['other' => 'Дата, вес, активность'],
			'valid' => 'integer',
			'default' => 0
		],
	],
	'settings' => [],
	'plugins_backend' => ['images'],
	'plugins_front' => [],
	'version' => 1
];
