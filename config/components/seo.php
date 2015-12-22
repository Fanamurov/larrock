<?php

return [
	'name' => 'seo',
	'title' => 'Seo',
	'description' => '',
	'table_content' => 'seo',
	'rows' => [
		'seo_title' => [
			'title' => 'Title',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'seo_description' => [
			'title' => 'Description',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'seo_keywords' => [
			'title' => 'Keywords',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:255',
			'typo' => 'true'
		],
		'id_connect' => [
			'title' => 'id_connect',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'integer|required_without:url_connect',
		],
		'url_connect' => [
			'title' => 'url_connect',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:255|required_without:id_connect',
		],
		'type_connect' => [
			'title' => 'type_connect',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'valid' => 'max:255|required',
			'default' => 'custom'
		]
	],
	'settings' => [],
	'plugins_backend' => [],
	'plugins_front' => [],
	'version' => 1
];
