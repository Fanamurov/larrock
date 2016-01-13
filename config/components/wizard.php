<?php

return [
	'name' => 'wizard',
	'title' => 'Wizard',
	'description' => 'Wizard. Export .xls to catalog',
	'rows' => [
		'title' => [
			'title' => 'Заголовок',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
	],
	'settings' => [],
	'version' => 1
];
