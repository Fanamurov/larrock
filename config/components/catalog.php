<?php

return [
	'name' => 'catalog',
	'title' => 'Каталог',
	'description' => 'Каталог товаров',
	'table_content' => 'catalog',
	'rows' => [
		'title' => [
			'title' => 'Заголовок',
			'in_table_admin' => 'TRUE',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:255|required',
			'typo' => 'true'
		],
		'category' => [
			'title' => 'Раздел',
			'type' => 'select_category',
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:255|required',
			'options_connect' => ['row' => 'title', 'table' => 'category', 'where' => ['type' => 'catalog']]
		],
		'short' => [
			'title' => 'Короткое описание',
			'type' => 'textarea',
			'tab' => ['main' => 'Описание товара'],
			//'css_class' => 'not-editor'
		],
		'description' => [
			'title' => 'Полное описание',
			'type' => 'textarea',
			'tab' => ['main' => 'Описание товара'],
		],
		'url' => [
			'title' => 'URL материала',
			'type' => 'text',
			'tab' => ['seo' => 'Seo'],
			'valid' => 'max:155|required|unique:catalog,url,:id'
		],
		'cost' => [
			'title' => 'Цена',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-4 col-md-2'
		],
		'cost_old' => [
			'title' => 'Старая цена',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-4 col-md-2'
		],
		'what' => [
			'title' => 'Мера измерений',
			'type' => 'select_row',
			'options_connect' => ['row' => 'what', 'table' => 'catalog', 'selected_search' => 'value'],
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:55|required',
			'css_class_group' => 'col-xs-3'
		],

		'vid_raz' => [
			'title' => 'Вид разделки',
			'type' => 'select_row',
			'options_connect' => ['row' => 'vid_raz', 'table' => 'catalog', 'selected_search' => 'value'],
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:55',
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],
		'razmer' => [
			'title' => 'Размер продукта',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-2 col-md-2',
			'template' => 'description'
		],
		'weight' => [
			'title' => 'Вес продукции в упаковке',
			'type' => 'select_row',
			'options_connect' => ['row' => 'weight', 'table' => 'catalog', 'selected_search' => 'value'],
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:55',
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],
		'vid_up' => [
			'title' => 'Вид упаковки',
			'type' => 'select_row',
			'options_connect' => ['row' => 'vid_up', 'table' => 'catalog', 'selected_search' => 'value'],
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:55',
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],
		'date_vilov' => [
			'title' => 'Дата вылова',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],
		'sertifikacia' => [
			'title' => 'Сертификация',
			'type' => 'select_row',
			'options_connect' => ['row' => 'sertifikacia', 'table' => 'catalog', 'selected_search' => 'value'],
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:55',
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],
		'mesto' => [
			'title' => 'Место вылова',
			'type' => 'select_row',
			'options_connect' => ['row' => 'mesto', 'table' => 'catalog', 'selected_search' => 'value'],
			'tab' => ['main' => 'Описание товара'],
			'valid' => 'max:55',
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],
		'min_part' => [
			'title' => 'Минимальная партия (т.)',
			'type' => 'text',
			'tab' => ['main' => 'Описание товара'],
			'css_class_group' => 'col-xs-3',
			'template' => 'description'
		],


		'manufacture' => [
			'title' => 'Производитель',
			'type' => 'text',
			'tab' => ['other' => 'Дополнительные поля'],
		],
		'articul' => [
			'title' => 'Артикул',
			'type' => 'text',
			'tab' => ['other' => 'Дополнительные поля'],
			'valid' => 'max:255'
		],
		/*'nalichie' => [
			'title' => 'В наличии',
			'type' => 'text',
			'tab' => ['other' => 'Дополнительные поля'],
			'valid' => 'required|integer',
			'default' => 999999
		],*/
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
	],
	'menu_category' => 'catalog',
	'admin_menu' => ['type' => 'category_list'],
	//'admin_menu_push' => ['Wizard' => '/admin/wizard'],
	'settings' => [],
	'plugins_backend' => ['seo', 'images', 'files', 'templates'],
	'plugins_front' => [],
	'version' => 1
];
