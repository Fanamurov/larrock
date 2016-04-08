<?php

return [
	'name' => 'users',
	'title' => 'Пользователи',
	'description' => '',
	'table_content' => 'users',
	'rows' => [
		'email' => [
			'title' => 'Email/login',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
			'valid' => 'email|min:4|required|unique:users,email,:id'
		],
        'password' => [
            'title' => 'Password',
            'type' => 'text',
            'tab' => ['main' => 'Заголовок, описание'],
            'valid' => 'min:5|required',
        ],
		'first_name' => [
			'title' => 'First name',
			'type' => 'text',
			'tab' => ['main' => 'Заголовок, описание'],
            'valid' => 'max:155'
		],
		'last_name' => [
			'title' => 'Last name',
			'type' => 'text',
			'tab' => ['seo' => 'Seo'],
			'valid' => 'max:155'
		],
		'role' => [
			'title' => 'Роль',
			'type' => 'integer',
			'tab' => ['other' => 'Дата, вес, активность'],
			'valid' => 'integer',
		]
	],
    'admin_menu' => ['type' => 'hidden'],
	'settings' => [],
	'plugins_backend' => [],
	'plugins_front' => [],
	'version' => 1
];
