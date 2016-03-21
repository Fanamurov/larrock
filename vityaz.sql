-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1,	1,	'XVpuqeRvcVbrmr3YqUcLmRtbDlCi0KN5',	1,	NULL,	'2015-11-19 15:47:17',	'2015-11-19 15:47:17');

DROP TABLE IF EXISTS `apps`;
CREATE TABLE `apps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rows` text COLLATE utf8_unicode_ci NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `plugins_backend` text COLLATE utf8_unicode_ci NOT NULL,
  `plugins_front` text COLLATE utf8_unicode_ci NOT NULL,
  `menu_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sitemap` int(11) NOT NULL DEFAULT '1',
  `version` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `apps_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `apps` (`id`, `title`, `name`, `description`, `table_content`, `rows`, `settings`, `plugins_backend`, `plugins_front`, `menu_category`, `sitemap`, `version`, `active`, `created_at`, `updated_at`) VALUES
(4,	'Cтраницы',	'page',	'Страницы без привязки к определенному разделу',	'feed',	'a:6:{s:5:\"title\";a:6:{s:5:\"title\";s:18:\"Заголовок\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}s:5:\"valid\";s:16:\"max:255|required\";s:4:\"typo\";s:4:\"true\";}s:11:\"description\";a:3:{s:5:\"title\";s:25:\"Текст новости\";s:4:\"type\";s:8:\"textarea\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}}s:3:\"url\";a:4:{s:5:\"title\";s:22:\"URL материала\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:3:\"seo\";s:3:\"Seo\";}s:5:\"valid\";s:16:\"max:155|required\";}s:4:\"date\";a:4:{s:5:\"title\";s:27:\"Дата материала\";s:4:\"type\";s:4:\"date\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:17:\"date_format:Y-m-d\";}s:8:\"position\";a:5:{s:5:\"title\";s:25:\"Вес материала\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:7:\"integer\";s:7:\"default\";i:0;}s:6:\"active\";a:6:{s:5:\"title\";s:22:\"Опубликован\";s:4:\"type\";s:8:\"checkbox\";s:7:\"checked\";s:4:\"TRUE\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:13:\"integer|max:1\";s:7:\"default\";i:1;}}',	's:0:\"\";',	'a:4:{i:0;s:3:\"seo\";i:1;s:6:\"images\";i:2;s:5:\"files\";i:3;s:9:\"templates\";}',	's:0:\"\";',	NULL,	1,	25,	1,	'2015-11-26 07:04:03',	'2015-12-07 07:25:29'),
(5,	'Меню сайта',	'menu',	'',	'menu',	'a:8:{s:5:\"title\";a:5:{s:5:\"title\";s:29:\"Название пункта\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:5:\"valid\";s:16:\"max:255|required\";s:4:\"typo\";s:4:\"true\";}s:8:\"category\";a:3:{s:5:\"title\";s:15:\"Вид меню\";s:4:\"type\";s:6:\"select\";s:7:\"default\";s:3:\"top\";}s:4:\"type\";a:2:{s:5:\"title\";s:6:\"Тип\";s:4:\"type\";s:4:\"text\";}s:6:\"parent\";a:4:{s:5:\"title\";s:16:\"Родитель\";s:4:\"type\";s:10:\"select_row\";s:7:\"default\";s:36:\"Это главный уровень\";s:15:\"options_connect\";a:2:{s:3:\"row\";s:5:\"title\";s:5:\"table\";s:4:\"menu\";}}s:7:\"connect\";a:2:{s:5:\"title\";s:10:\"Связь\";s:4:\"type\";s:4:\"text\";}s:3:\"url\";a:4:{s:5:\"title\";s:16:\"URL пункта\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:5:\"valid\";s:16:\"max:155|required\";}s:8:\"position\";a:4:{s:5:\"title\";s:6:\"Вес\";s:4:\"type\";s:4:\"text\";s:5:\"valid\";s:7:\"integer\";s:7:\"default\";i:0;}s:6:\"active\";a:5:{s:5:\"title\";s:22:\"Опубликован\";s:4:\"type\";s:8:\"checkbox\";s:7:\"checked\";s:4:\"TRUE\";s:5:\"valid\";s:13:\"integer|max:1\";s:7:\"default\";i:1;}}',	'a:0:{}',	'a:0:{}',	'a:0:{}',	'',	1,	10,	1,	'2015-12-05 14:58:18',	'2015-12-08 04:04:46'),
(6,	'Ленты',	'feed',	'Страницы с привязкой к определенным разделам',	'feed',	'a:7:{s:5:\"title\";a:6:{s:5:\"title\";s:18:\"Заголовок\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}s:5:\"valid\";s:16:\"max:255|required\";s:4:\"typo\";s:4:\"true\";}s:8:\"category\";a:5:{s:5:\"title\";s:12:\"Раздел\";s:4:\"type\";s:10:\"select_row\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}s:5:\"valid\";s:16:\"max:255|required\";s:15:\"options_connect\";a:2:{s:3:\"row\";s:5:\"title\";s:5:\"table\";s:8:\"category\";}}s:11:\"description\";a:3:{s:5:\"title\";s:25:\"Текст новости\";s:4:\"type\";s:8:\"textarea\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}}s:3:\"url\";a:4:{s:5:\"title\";s:22:\"URL материала\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:3:\"seo\";s:3:\"Seo\";}s:5:\"valid\";s:16:\"max:155|required\";}s:4:\"date\";a:4:{s:5:\"title\";s:27:\"Дата материала\";s:4:\"type\";s:4:\"date\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:17:\"date_format:Y-m-d\";}s:8:\"position\";a:5:{s:5:\"title\";s:25:\"Вес материала\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:7:\"integer\";s:7:\"default\";i:0;}s:6:\"active\";a:6:{s:5:\"title\";s:22:\"Опубликован\";s:4:\"type\";s:8:\"checkbox\";s:7:\"checked\";s:4:\"TRUE\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:13:\"integer|max:1\";s:7:\"default\";i:1;}}',	's:0:\"\";',	'a:4:{i:0;s:3:\"seo\";i:1;s:6:\"images\";i:2;s:5:\"files\";i:3;s:9:\"templates\";}',	's:0:\"\";',	'feed',	1,	3,	1,	'2015-12-08 05:33:40',	'2015-12-16 07:41:18');

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `blocks_url_unique` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blocks` (`id`, `title`, `description`, `url`, `position`, `active`, `created_at`, `updated_at`) VALUES
(1,	'header-email',	'<p><a href=\"mailto:pshabar@mail.ru\">pshabar@mail.ru</a></p>',	'header-email',	0,	1,	'2016-01-21 05:45:22',	'2016-01-21 05:45:22'),
(2,	'header-slogan',	'<p>Огнетушители и пожарное оборудование</p>',	'header-slogan',	0,	1,	'2016-01-21 07:08:15',	'2016-01-21 07:08:15'),
(3,	'Баннер в колонке справа',	'',	'banner',	0,	0,	'2016-03-16 05:56:05',	'2016-03-16 05:56:05');

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `cost` double(10,2) NOT NULL DEFAULT '0.00',
  `cost_discount` double(10,2) DEFAULT NULL,
  `kupon` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_order` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_pay` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `method_pay` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `method_delivery` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `catalog`;
CREATE TABLE `catalog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `what` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double(10,2) NOT NULL DEFAULT '0.00',
  `cost_old` double(10,2) DEFAULT NULL,
  `manufacture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `articul` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `nalichie` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vid_raz` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razmer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vid_up` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_vilov` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sertifikacia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `min_part` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '23',
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_url_unique` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `catalog` (`id`, `title`, `short`, `description`, `url`, `what`, `cost`, `cost_old`, `manufacture`, `position`, `articul`, `active`, `nalichie`, `created_at`, `updated_at`, `vid_raz`, `razmer`, `weight`, `vid_up`, `date_vilov`, `sertifikacia`, `mesto`, `min_part`) VALUES
(138,	'Горбуша серебро ПСГ',	'',	'',	'gorbusha-serebro-psg',	'р/кг',	0.00,	0.00,	'',	100,	'AR',	1,	0,	'2016-03-21 07:50:57',	'2016-03-21 07:50:57',	'ПСГ',	'3-5',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'',	'23'),
(139,	'Горбуша серебро ПБГ',	'',	'',	'gorbusha-serebro-pbg',	'р/кг',	0.00,	0.00,	'',	95,	'',	1,	0,	'2016-03-21 07:51:04',	'2016-03-21 07:51:04',	'ПБГ',	'3-5',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'',	'23'),
(140,	'Горбуша ПСГ',	'',	'',	'gorbusha-psg',	'р/кг',	150.00,	0.00,	'',	90,	'',	1,	0,	'2016-03-21 07:47:50',	'2016-03-21 07:47:50',	'ПСГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(142,	'Горбуша ПБГ',	'',	'',	'gorbusha-pbg',	'р/кг',	155.00,	0.00,	'',	85,	'AR',	1,	0,	'2016-03-21 07:49:31',	'2016-03-21 07:49:31',	'ПБГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(143,	'Кета серебро ПСГ',	'',	'',	'keta-serebro-psg',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 07:44:38',	'2016-03-21 07:44:38',	'ПСГ',	'',	'1/20-1/22',	'Меш.',	'',	'',	'',	'23'),
(144,	'Кета серебро ПБГ',	'',	'',	'keta-serebro-pbg',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 07:44:45',	'2016-03-21 07:44:45',	'ПБГ',	'',	'1/20-1/22',	'Меш.',	'',	'',	'',	'23'),
(145,	'Кета ПСГ',	'',	'',	'psg',	'р/кг',	155.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 05:13:58',	'2016-03-21 05:13:58',	'ПСГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(146,	'Кета ПБГ',	'',	'',	'keta-pbg',	'р/кг',	160.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 05:20:18',	'2016-03-21 05:20:18',	'ПБГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(147,	'Сельдь Олюторская НР',	'<p><strong>Вид продукта: </strong>Сельдь алюторская свежемороженая НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки:<br /></strong><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Сельдь алюторская свежемороженая НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки:<br /></strong><strong>Минимальная партия: </strong>20т.</p>',	'seld-olyutorskaya-nr',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 06:11:58',	'',	'',	'',	'',	'',	'',	'',	'23'),
(148,	'Сельдь Тихоокеанская свежемороженая НР',	'<p><strong>Вид продукта: </strong>Сельдь свежемороженая тихоокеанская НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Сельдь свежемороженая тихоокеанская НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'seld-tikhookeanskaya-svezhemorozhenaya-nr',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 06:12:52',	'',	'',	'',	'',	'',	'',	'',	'23'),
(152,	'Минтай ПБГ',	'<p><strong>Вид продукта: </strong>минтай свежемороженая ПБГ<br /><strong>Размерный ряд: </strong>25+;35+;<strong><br /> Дата вылова: <br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>минтай свежемороженая ПБГ<br /><strong>Размерный ряд: </strong>25+;35+;<strong><br />Дата вылова: <br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'mintay-pbg',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 06:27:07',	'',	'',	'',	'',	'',	'',	'',	'23'),
(153,	'Треска свежемороженая ПБГ',	'<p><strong>Вид продукта: </strong>треска свежемороженая ПБГ<br /><strong>Размерный ряд:&nbsp;</strong>0,5-1;1-2; 2+<strong><br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки:</strong> 1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>треска свежемороженая ПБГ<br /><strong>Размерный ряд:&nbsp;</strong>0,5-1;1-2; 2+<strong><br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки:</strong> 1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'treska-svezhemorozhenaya-pbg',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 06:59:03',	'',	'',	'',	'',	'',	'',	'',	'23'),
(154,	'Камбала желтоперая НР',	'<p><strong>Вид продукта: </strong>камбала свежемороженая НР<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>камбала свежемороженая НР<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'kambala-zheltoperaya-nr',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:05:05',	'',	'',	'',	'',	'',	'',	'',	'23'),
(155,	'Навага ПБГ свежемороженая',	'<p><strong>Вид продукта: </strong>Навага ПБГ свежемороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Навага ПБГ свежемороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'navaga-pbg-svezhemorozhenaya',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:07:40',	'',	'',	'',	'',	'',	'',	'',	'23'),
(156,	'Краб камчатский',	'<p><strong>Вид продукта: </strong>краб свежемороженая камчатский(целый вареный)<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>картон<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>краб свежемороженая камчатский(целый вареный)<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>картон<br /><strong>Минимальная партия: </strong>20т.</p>',	'krab-kamchatskiy',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:14:28',	'',	'',	'',	'',	'',	'',	'',	'23'),
(157,	'Роза',	'<p><strong>Вид продукта: </strong>мясо краба свежемороженая (роза)<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта: </strong>мясо краба свежемороженая (роза)<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'roza',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:23:45',	'',	'',	'',	'',	'',	'',	'',	'23'),
(158,	'Фаланга краба 1ая',	'<p><strong>Вид продукта: </strong>фаланга краба 1ая замороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>фаланга краба 1ая замороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>20т.</p>',	'falanga-kraba-1aya',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:25:49',	'',	'',	'',	'',	'',	'',	'',	'23'),
(159,	'Фаланга краба 2ая',	'<p><strong>Вид продукта:</strong> фаланга краба 2ая замороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта:</strong> фаланга краба 2ая замороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'falanga-kraba-2aya',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:26:43',	'',	'',	'',	'',	'',	'',	'',	'23'),
(160,	'Икра красная замороженная',	'<p><strong>Вид продукта:</strong> икра красная замороженная<br /><strong>Размерный ряд: </strong>крупная<strong><br /> Дата вылова:</strong> 15 сентября<br /><strong>Место вылова:<br /> Вес упаковки:</strong>12кг<strong>.<br /> Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта:</strong> икра красная замороженная<br /><strong>Размерный ряд: </strong>крупная<strong><br />Дата вылова:</strong> 15 сентября<br /><strong>Место вылова:<br />Вес упаковки:</strong>12кг<strong>.<br />Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'ikra-krasnaya-zamorozhennaya',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:30:14',	'',	'',	'',	'',	'',	'',	'',	'23'),
(161,	'Икра красная охлажденная',	'<p><strong>Вид продукта: </strong>икра красная охлажденная<br /><strong>Размерный ряд: </strong>крупная<strong> <br /> Дата вылова: </strong>15 сентября<br /><strong>Место вылова:<br /> Вес упаковки: </strong>12кг<strong><br /> Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта: </strong>икра красная охлажденная<br /><strong>Размерный ряд: </strong>крупная<strong> <br />Дата вылова: </strong>15 сентября<br /><strong>Место вылова:<br />Вес упаковки: </strong>12кг<strong><br />Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'ikra-krasnaya-okhlazhdennaya',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-16 03:28:48',	'2016-03-14 07:31:18',	'',	'',	'',	'',	'',	'',	'',	'23');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sitemap` int(11) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `category` (`id`, `title`, `short`, `description`, `type`, `parent`, `level`, `url`, `sitemap`, `position`, `active`, `created_at`, `updated_at`) VALUES
(1,	'Новости',	'',	'',	'feed',	0,	1,	'test_category',	1,	0,	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	'SEO-тексты',	'',	'',	'feed',	0,	1,	'seofish',	0,	0,	1,	'2015-12-08 07:25:12',	'2015-12-08 07:25:12'),
(296,	'Сельдь',	'',	'',	'catalog',	0,	1,	'seld',	1,	0,	1,	'2016-03-11 07:11:52',	'2016-03-11 07:11:52'),
(297,	'Морепродукты',	'',	'',	'catalog',	0,	1,	'krab-krevedki',	1,	0,	1,	'2016-03-11 07:12:02',	'2016-03-21 02:36:23'),
(298,	'Икра лососёвая',	'',	'',	'catalog',	0,	1,	'ikra-lososevaya',	1,	0,	1,	'2016-03-11 07:12:21',	'2016-03-11 07:12:21'),
(299,	'Горбуша',	'',	'',	'catalog',	0,	1,	'gorbusha',	1,	90,	1,	'2016-03-18 03:01:23',	'2016-03-18 05:27:08'),
(300,	'Кета',	'',	'',	'catalog',	0,	1,	'keta',	1,	100,	1,	'2016-03-18 03:01:31',	'2016-03-18 03:01:31'),
(301,	'Минтай',	'',	'',	'catalog',	0,	1,	'mintay',	1,	0,	1,	'2016-03-21 07:52:19',	'2016-03-21 07:52:19'),
(302,	'Треска',	'',	'',	'catalog',	0,	1,	'treska',	1,	0,	1,	'2016-03-21 07:52:30',	'2016-03-21 07:52:30'),
(303,	'Камбала',	'',	'',	'catalog',	0,	1,	'kambala',	1,	0,	1,	'2016-03-21 07:52:45',	'2016-03-21 07:52:45'),
(304,	'Навага',	'',	'',	'catalog',	0,	1,	'navaga',	1,	0,	1,	'2016-03-21 07:52:53',	'2016-03-21 07:52:53');

DROP TABLE IF EXISTS `category_catalog`;
CREATE TABLE `category_catalog` (
  `category_id` int(10) unsigned NOT NULL,
  `catalog_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `category_catalog_category_id_foreign` (`category_id`),
  KEY `category_catalog_catalog_id_foreign` (`catalog_id`),
  CONSTRAINT `category_catalog_catalog_id_foreign` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_catalog_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `category_catalog` (`category_id`, `catalog_id`, `created_at`, `updated_at`) VALUES
(297,	156,	'2016-03-14 07:19:51',	'0000-00-00 00:00:00'),
(297,	158,	'2016-03-14 07:25:49',	'0000-00-00 00:00:00'),
(297,	159,	'2016-03-14 07:26:43',	'0000-00-00 00:00:00'),
(296,	147,	'2016-03-15 03:35:16',	'0000-00-00 00:00:00'),
(296,	148,	'2016-03-15 05:20:12',	'0000-00-00 00:00:00'),
(297,	157,	'2016-03-15 08:06:23',	'0000-00-00 00:00:00'),
(298,	160,	'2016-03-16 03:53:31',	'0000-00-00 00:00:00'),
(298,	161,	'2016-03-16 03:54:25',	'0000-00-00 00:00:00'),
(300,	146,	'2016-03-21 05:20:18',	'0000-00-00 00:00:00'),
(300,	145,	'2016-03-21 05:31:41',	'0000-00-00 00:00:00'),
(300,	143,	'2016-03-21 07:44:38',	'0000-00-00 00:00:00'),
(300,	144,	'2016-03-21 07:44:45',	'0000-00-00 00:00:00'),
(299,	140,	'2016-03-21 07:47:50',	'0000-00-00 00:00:00'),
(299,	142,	'2016-03-21 07:49:31',	'0000-00-00 00:00:00'),
(299,	138,	'2016-03-21 07:50:57',	'0000-00-00 00:00:00'),
(299,	139,	'2016-03-21 07:51:04',	'0000-00-00 00:00:00'),
(301,	152,	'2016-03-21 07:53:26',	'0000-00-00 00:00:00'),
(302,	153,	'2016-03-21 07:53:34',	'0000-00-00 00:00:00'),
(303,	154,	'2016-03-21 07:53:42',	'0000-00-00 00:00:00'),
(304,	155,	'2016-03-21 07:53:47',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `config` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1,	'catalog',	'a:2:{s:14:\"image_original\";s:7:\"800-800\";s:14:\"image_generate\";a:1:{i:0;s:7:\"140-140\";}}',	'image_presets',	'2016-01-11 07:21:09',	'2016-02-04 02:33:12'),
(2,	'page',	'a:2:{s:14:\"image_original\";s:0:\"\";s:14:\"image_generate\";a:2:{i:0;s:7:\"100-200\";i:1;s:7:\"300-540\";}}',	'image_presets',	'2016-01-12 04:34:30',	'2016-01-12 04:34:30'),
(4,	'catalog',	'a:5:{s:12:\"naimenovanie\";a:2:{s:2:\"db\";s:5:\"title\";s:4:\"slug\";s:5:\"title\";}s:8:\"opisanie\";a:2:{s:2:\"db\";s:5:\"short\";s:4:\"slug\";s:5:\"short\";}s:5:\"tsena\";a:2:{s:2:\"db\";s:4:\"cost\";s:4:\"slug\";s:4:\"cost\";}s:19:\"edenitsy_izmereniya\";a:2:{s:2:\"db\";s:4:\"what\";s:4:\"slug\";s:4:\"what\";}s:4:\"foto\";a:2:{s:2:\"db\";s:0:\"\";s:4:\"slug\";s:0:\"\";}}',	'wizard',	'2016-01-13 04:13:59',	'2016-02-04 03:02:25'),
(5,	'category',	'a:2:{s:14:\"image_original\";s:0:\"\";s:14:\"image_generate\";a:1:{i:0;s:7:\"140-140\";}}',	'image_presets',	'2016-01-22 06:24:30',	'2016-01-22 06:24:30');

DROP TABLE IF EXISTS `feed`;
CREATE TABLE `feed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(10) unsigned DEFAULT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `feed_category_foreign` (`category`),
  CONSTRAINT `feed_category_foreign` FOREIGN KEY (`category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `feed` (`id`, `title`, `category`, `short`, `description`, `url`, `date`, `position`, `active`, `created_at`, `updated_at`) VALUES
(8,	'Оптовая продажа дальневосточной рыбной&nbsp;продукции',	2,	'<p>Оптовая продажа дальневосточной рыбной продукции</p>',	'',	'mainfish432',	'2016-03-17 00:00:00',	100,	1,	'2016-03-17 05:32:45',	'2016-03-17 06:21:52'),
(9,	'Сельди',	2,	'<p>Тело сжатое с боков, с зазубренным краем брюха. Чешуя умеренная или крупная, редко мелкая. Верхняя челюсть не выдаётся за нижнюю. Рот умеренный. Зубы, если имеются, рудиментарные и выпадающие. Анальный плавник умеренной длины и имеет менее 80 лучей. Спинной плавник расположен над брюшными. Хвостовой плавник раздвоенный. К этому роду относят 3 вида. Пищу их составляют различные мелкие животные, особенно мелкие ракообразные.</p>\r\n<p>Все представители рода имеют важное промысловое значение, используются в пищу, а также для изготовления рыбной муки.</p>\r\n<p>Особенно важна в экономическом отношении атлантическая сельдь (Clupea harengus)</p>',	'',	'seldi',	'2016-03-17 00:00:00',	0,	1,	'2016-03-17 06:23:19',	'2016-03-17 06:24:18'),
(10,	'Камбалообразные',	2,	'<p>Камбалообра́зные (лат. Pleuronectiformes) &mdash; отряд лучепёрых рыб. В состав отряда включают около 680 видов, объединяемых в 134 рода; подразделяется на три подотряда, включающие 14 семейств.</p>\r\n<p>Камбалообразные &mdash; донные рыбы, лежат и плавают на боку. Тело сильно сжато с боков, глаза расположены не по бокам головы, а смещены на одну её сторону. Плавательного пузыря нет. Верхняя сторона рыбы пигментирована, нижняя &mdash; обычно белая. Личинки камбал первоначально плавают в толще воды, но в последующем, по мере перехода к донному образу жизни, их тело уплощается в боковом направлении, а глаза перемещаются на одну из сторон тела &mdash; верхнюю.</p>',	'',	'kambaloobraznye',	'2016-03-17 00:00:00',	0,	1,	'2016-03-17 06:24:29',	'2016-03-17 06:24:51');

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_connect` int(11) NOT NULL,
  `param` text COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `files` (`id`, `name`, `mime`, `description`, `type_connect`, `id_connect`, `param`, `position`, `created_at`, `updated_at`) VALUES
(1,	'bg_header.jpg',	'image/jpeg',	'',	'feed',	4,	'novost-o-novom-gode',	0,	'2015-12-18 05:28:15',	'2015-12-18 05:28:15'),
(2,	'план финансово-хозяйственной деятельности на 2015 год.rar',	'applicatio',	'',	'feed',	1,	'primer-zagolovka',	0,	'2015-12-18 06:43:20',	'2015-12-18 06:43:20'),
(3,	'муниципальное задание на 2015 год.rar',	'applicatio',	'',	'feed',	1,	'primer-zagolovka',	0,	'2015-12-18 06:43:20',	'2015-12-18 06:43:20');

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_connect` int(11) NOT NULL,
  `param` text COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `images` (`id`, `name`, `mime`, `description`, `type_connect`, `id_connect`, `param`, `position`, `created_at`, `updated_at`) VALUES
(22,	'ognetuh_l1.png',	'image/png',	'',	'category',	272,	'fotosuveniry-1-0',	0,	'2016-01-22 06:24:41',	'2016-01-22 06:24:41'),
(23,	'ognetuh_l1.png',	'image/png',	'',	'category',	273,	'fotosuveniry-1-0',	0,	'2016-01-22 06:24:41',	'2016-01-22 06:24:41'),
(25,	'freza.jpg',	'image/jpeg',	'',	'catalog',	96,	'kruzhka-273',	0,	'2016-02-04 02:47:30',	'2016-02-04 02:47:30');

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collection_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `manipulations` text COLLATE utf8_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8_unicode_ci NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `media` (`id`, `model_id`, `model_type`, `collection_name`, `name`, `file_name`, `disk`, `size`, `manipulations`, `custom_properties`, `order_column`, `created_at`, `updated_at`) VALUES
(135,	297,	'App\\Models\\Category',	'images',	'Category-297-krabbpng',	'Category-297-krabbpng.png',	'media',	96755,	'[]',	'[]',	2,	'2016-03-11 07:49:56',	'2016-03-11 07:49:56'),
(136,	296,	'App\\Models\\Category',	'images',	'Category-296-seldpng',	'Category-296-seldpng.png',	'media',	72765,	'[]',	'[]',	3,	'2016-03-11 07:50:02',	'2016-03-11 07:50:02'),
(139,	298,	'App\\Models\\Category',	'images',	'Category-298-ikrapng',	'Category-298-ikrapng.png',	'media',	39684,	'[]',	'[]',	6,	'2016-03-11 07:57:56',	'2016-03-11 07:57:56'),
(140,	138,	'App\\Models\\Catalog',	'images',	'Catalog-138-gorbuha-ser-psbpng',	'Catalog-138-gorbuha-ser-psbpng.png',	'media',	64635,	'[]',	'{\"alt\":\"\",\"gallery\":\"\",\"position\":\"10\"}',	7,	'2016-03-14 04:56:10',	'2016-03-14 04:56:10'),
(142,	140,	'App\\Models\\Catalog',	'images',	'Catalog-140-gorbuha-psgpng',	'Catalog-140-gorbuha-psgpng.png',	'media',	49756,	'[]',	'[]',	9,	'2016-03-14 05:12:49',	'2016-03-14 05:12:49'),
(144,	142,	'App\\Models\\Catalog',	'images',	'Catalog-142-gorbuha-psgpng',	'Catalog-142-gorbuha-psgpng.png',	'media',	49756,	'[]',	'[]',	11,	'2016-03-14 05:24:54',	'2016-03-14 05:24:54'),
(145,	139,	'App\\Models\\Catalog',	'images',	'Catalog-139-gorbuha-ser-psbpng',	'Catalog-139-gorbuha-ser-psbpng.png',	'media',	64635,	'[]',	'[]',	12,	'2016-03-14 05:49:10',	'2016-03-14 05:49:10'),
(147,	143,	'App\\Models\\Catalog',	'images',	'Catalog-143-keta-serebpng',	'Catalog-143-keta-serebpng.png',	'media',	67245,	'[]',	'[]',	14,	'2016-03-14 05:59:28',	'2016-03-14 05:59:28'),
(149,	144,	'App\\Models\\Catalog',	'images',	'Catalog-144-keta-serebpng',	'Catalog-144-keta-serebpng.png',	'media',	67245,	'[]',	'[]',	16,	'2016-03-14 06:00:58',	'2016-03-14 06:00:58'),
(151,	145,	'App\\Models\\Catalog',	'images',	'Catalog-145-keta-psgpng',	'Catalog-145-keta-psgpng.png',	'media',	58389,	'[]',	'[]',	18,	'2016-03-14 06:08:37',	'2016-03-14 06:08:37'),
(153,	146,	'App\\Models\\Catalog',	'images',	'Catalog-146-keta-psgpng',	'Catalog-146-keta-psgpng.png',	'media',	58389,	'[]',	'[]',	20,	'2016-03-14 06:10:08',	'2016-03-14 06:10:08'),
(155,	147,	'App\\Models\\Catalog',	'images',	'Catalog-147-seld-olutpng',	'Catalog-147-seld-olutpng.png',	'media',	59920,	'[]',	'[]',	22,	'2016-03-14 06:11:52',	'2016-03-14 06:11:52'),
(163,	152,	'App\\Models\\Catalog',	'images',	'Catalog-152-mintaipng',	'Catalog-152-mintaipng.png',	'media',	51873,	'[]',	'[]',	26,	'2016-03-14 06:26:58',	'2016-03-14 06:26:58'),
(166,	153,	'App\\Models\\Catalog',	'images',	'Catalog-153-trskapng',	'Catalog-153-trskapng.png',	'media',	56270,	'[]',	'[]',	29,	'2016-03-14 06:58:55',	'2016-03-14 06:58:55'),
(168,	154,	'App\\Models\\Catalog',	'images',	'Catalog-154-kambalapng',	'Catalog-154-kambalapng.png',	'media',	86485,	'[]',	'[]',	31,	'2016-03-14 07:05:00',	'2016-03-14 07:05:00'),
(170,	155,	'App\\Models\\Catalog',	'images',	'Catalog-155-navagapng',	'Catalog-155-navagapng.png',	'media',	38384,	'[]',	'[]',	32,	'2016-03-14 07:07:35',	'2016-03-14 07:07:35'),
(172,	156,	'App\\Models\\Catalog',	'images',	'Catalog-156-krabb-1png',	'Catalog-156-krabb-1png.png',	'media',	96755,	'[]',	'[]',	34,	'2016-03-14 07:14:22',	'2016-03-14 07:14:22'),
(175,	158,	'App\\Models\\Catalog',	'images',	'Catalog-158-falang-1png',	'Catalog-158-falang-1png.png',	'media',	70150,	'[]',	'[]',	35,	'2016-03-14 07:25:44',	'2016-03-14 07:25:44'),
(177,	159,	'App\\Models\\Catalog',	'images',	'Catalog-159-falang-2png',	'Catalog-159-falang-2png.png',	'media',	76480,	'[]',	'[]',	37,	'2016-03-14 07:26:36',	'2016-03-14 07:26:36'),
(186,	148,	'App\\Models\\Catalog',	'images',	'Catalog-148-seld-tihookpng',	'Catalog-148-seld-tihookpng.png',	'media',	56719,	'[]',	'[]',	42,	'2016-03-15 05:20:08',	'2016-03-15 05:20:08'),
(187,	157,	'App\\Models\\Catalog',	'images',	'Catalog-157-rozapng',	'Catalog-157-rozapng.png',	'media',	60518,	'[]',	'[]',	43,	'2016-03-15 08:06:19',	'2016-03-15 08:06:19'),
(190,	161,	'App\\Models\\Catalog',	'images',	'Catalog-161-ikra-tovar-1png',	'Catalog-161-ikra-tovar-1png.png',	'media',	42315,	'[]',	'[]',	44,	'2016-03-16 03:54:22',	'2016-03-16 03:54:22'),
(191,	160,	'App\\Models\\Catalog',	'images',	'Catalog-160-ikra-tovar-1png',	'Catalog-160-ikra-tovar-1png.png',	'media',	42315,	'[]',	'[]',	45,	'2016-03-16 03:54:28',	'2016-03-16 03:54:28'),
(193,	3,	'App\\Models\\Blocks',	'images',	'Blocks-3-baner-kolmarpng',	'Blocks-3-baner-kolmarpng.png',	'media',	117383,	'[]',	'[]',	47,	'2016-03-16 05:55:53',	'2016-03-16 05:55:53'),
(196,	138,	'App\\Models\\Catalog',	'images',	'Catalog-138-riba-01-1jpg',	'Catalog-138-riba-01-1jpg.jpg',	'media',	41673,	'[]',	'[]',	48,	'2016-03-17 04:11:34',	'2016-03-17 04:11:34'),
(197,	139,	'App\\Models\\Catalog',	'images',	'Catalog-139-riba-02jpg',	'Catalog-139-riba-02jpg.jpg',	'media',	43973,	'[]',	'[]',	49,	'2016-03-17 04:14:17',	'2016-03-17 04:14:17'),
(198,	140,	'App\\Models\\Catalog',	'images',	'Catalog-140-riba-03jpg',	'Catalog-140-riba-03jpg.jpg',	'media',	43549,	'[]',	'[]',	50,	'2016-03-17 04:18:42',	'2016-03-17 04:18:42'),
(199,	142,	'App\\Models\\Catalog',	'images',	'Catalog-142-riba-04jpg',	'Catalog-142-riba-04jpg.jpg',	'media',	42348,	'[]',	'[]',	51,	'2016-03-17 04:21:19',	'2016-03-17 04:21:19'),
(200,	143,	'App\\Models\\Catalog',	'images',	'Catalog-143-riba-05jpg',	'Catalog-143-riba-05jpg.jpg',	'media',	47364,	'[]',	'[]',	52,	'2016-03-17 04:23:15',	'2016-03-17 04:23:15'),
(201,	144,	'App\\Models\\Catalog',	'images',	'Catalog-144-riba-06jpg',	'Catalog-144-riba-06jpg.jpg',	'media',	41325,	'[]',	'[]',	53,	'2016-03-17 04:27:14',	'2016-03-17 04:27:14'),
(204,	145,	'App\\Models\\Catalog',	'images',	'Catalog-145-riba-07jpg',	'Catalog-145-riba-07jpg.jpg',	'media',	49839,	'[]',	'[]',	54,	'2016-03-17 04:43:08',	'2016-03-17 04:43:08'),
(205,	146,	'App\\Models\\Catalog',	'images',	'Catalog-146-riba-08jpg',	'Catalog-146-riba-08jpg.jpg',	'media',	45878,	'[]',	'[]',	55,	'2016-03-17 04:43:17',	'2016-03-17 04:43:17'),
(206,	152,	'App\\Models\\Catalog',	'images',	'Catalog-152-riba-10jpg',	'Catalog-152-riba-10jpg.jpg',	'media',	41023,	'[]',	'[]',	56,	'2016-03-17 04:45:37',	'2016-03-17 04:45:37'),
(207,	153,	'App\\Models\\Catalog',	'images',	'Catalog-153-riba-11jpg',	'Catalog-153-riba-11jpg.jpg',	'media',	34615,	'[]',	'[]',	57,	'2016-03-17 04:45:38',	'2016-03-17 04:45:38'),
(208,	154,	'App\\Models\\Catalog',	'images',	'Catalog-154-riba-12jpg',	'Catalog-154-riba-12jpg.jpg',	'media',	28420,	'[]',	'[]',	58,	'2016-03-17 04:49:39',	'2016-03-17 04:49:39'),
(209,	155,	'App\\Models\\Catalog',	'images',	'Catalog-155-riba-13jpg',	'Catalog-155-riba-13jpg.jpg',	'media',	49414,	'[]',	'[]',	59,	'2016-03-17 04:50:56',	'2016-03-17 04:50:56'),
(210,	156,	'App\\Models\\Catalog',	'images',	'Catalog-156-riba-14jpg',	'Catalog-156-riba-14jpg.jpg',	'media',	38968,	'[]',	'[]',	60,	'2016-03-17 04:54:37',	'2016-03-17 04:54:37'),
(211,	159,	'App\\Models\\Catalog',	'images',	'Catalog-159-riba-15jpg',	'Catalog-159-riba-15jpg.jpg',	'media',	27067,	'[]',	'[]',	61,	'2016-03-17 04:55:09',	'2016-03-17 04:55:09'),
(212,	157,	'App\\Models\\Catalog',	'images',	'Catalog-157-riba-16jpg',	'Catalog-157-riba-16jpg.jpg',	'media',	32142,	'[]',	'[]',	62,	'2016-03-17 04:56:41',	'2016-03-17 04:56:41'),
(213,	158,	'App\\Models\\Catalog',	'images',	'Catalog-158-riba-17jpg',	'Catalog-158-riba-17jpg.jpg',	'media',	16194,	'[]',	'[]',	63,	'2016-03-17 04:58:39',	'2016-03-17 04:58:39'),
(214,	160,	'App\\Models\\Catalog',	'images',	'Catalog-160-riba-18jpg',	'Catalog-160-riba-18jpg.jpg',	'media',	56217,	'[]',	'[]',	64,	'2016-03-17 05:07:02',	'2016-03-17 05:07:02'),
(215,	161,	'App\\Models\\Catalog',	'images',	'Catalog-161-riba-19jpg',	'Catalog-161-riba-19jpg.jpg',	'media',	40891,	'[]',	'[]',	65,	'2016-03-17 05:07:09',	'2016-03-17 05:07:09'),
(216,	147,	'App\\Models\\Catalog',	'images',	'Catalog-147-riba-09jpg',	'Catalog-147-riba-09jpg.jpg',	'media',	35317,	'[]',	'[]',	66,	'2016-03-17 05:10:42',	'2016-03-17 05:10:42'),
(217,	148,	'App\\Models\\Catalog',	'images',	'Catalog-148-seld-tojpg',	'Catalog-148-seld-tojpg.jpg',	'media',	44583,	'[]',	'[]',	67,	'2016-03-17 05:10:44',	'2016-03-17 05:10:44'),
(218,	299,	'App\\Models\\Category',	'images',	'Category-299-gorbuhapng',	'Category-299-gorbuhapng.png',	'media',	59444,	'[]',	'[]',	68,	'2016-03-18 04:57:18',	'2016-03-18 04:57:18'),
(219,	300,	'App\\Models\\Category',	'images',	'Category-300-ketapng',	'Category-300-ketapng.png',	'media',	56150,	'[]',	'[]',	69,	'2016-03-18 04:57:26',	'2016-03-18 04:57:26'),
(221,	25,	'App\\Models\\Page',	'files',	'Page-25-flk96dgiltyb9png',	'Page-25-flk96dgiltyb9png.png',	'media',	1288,	'[]',	'[]',	70,	'2016-03-21 03:07:47',	'2016-03-21 03:07:47'),
(223,	25,	'App\\Models\\Page',	'images',	'Page-25-arlainpng',	'Page-25-arlainpng.png',	'media',	5378,	'[]',	'[]',	72,	'2016-03-21 03:15:27',	'2016-03-21 03:15:27'),
(224,	27,	'App\\Models\\Page',	'images',	'Page-27-foto-karabljpg',	'Page-27-foto-karabljpg.jpg',	'media',	94486,	'[]',	'{\"alt\":\"\",\"gallery\":\"onas\",\"position\":\"0\"}',	73,	'2016-03-21 03:20:27',	'2016-03-21 03:20:27');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `menu` (`id`, `title`, `category`, `type`, `parent`, `url`, `connect`, `position`, `active`, `created_at`, `updated_at`) VALUES
(8,	'Рыбная продукция',	0,	'',	0,	'/',	'catalog/{category}',	90,	1,	'2016-03-14 02:51:10',	'2016-03-17 01:53:50'),
(9,	'Доставка',	0,	'',	0,	'/page/dostavka',	'',	80,	1,	'2016-03-14 02:51:28',	'2016-03-16 05:06:29'),
(10,	'Контакты',	0,	'',	0,	'/page/kontakty',	'',	70,	1,	'2016-03-14 02:51:41',	'2016-03-16 05:08:24'),
(11,	'О нас',	0,	'',	0,	'/page/o-nas',	'',	100,	1,	'2016-03-21 02:56:48',	'2016-03-21 02:56:48');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_07_02_230147_migration_cartalyst_sentinel',	1),
('2015_11_25_151848_create_apps_table',	2),
('2015_11_25_173945_create_feed_table',	2),
('2015_12_01_120218_create_images_table',	3),
('2015_12_01_145645_create_seo_table',	4),
('2015_12_01_163857_create_templates_table',	5),
('2015_12_06_004411_create_menu_table',	6),
('2015_12_08_152322_create_category_table',	7),
('2015_12_08_155118_update_feed_table',	8),
('2015_12_08_173518_create_page_table',	9),
('2015_12_18_151456_create_files_table',	10),
('2015_12_22_224121_create_config_table',	11),
('2015_12_23_115811_create_catalog_table',	12),
('2015_12_29_144628_create_category_catalog_table',	12),
('2016_01_19_144649_create_blocks_table',	13),
('2016_01_19_162530_create_cart_table',	14),
('2016_02_05_140905_create_media_table',	15),
('2015_01_15_105324_create_roles_table',	16),
('2015_01_15_114412_create_role_user_table',	16),
('2015_01_26_115212_create_permissions_table',	16),
('2015_01_26_115523_create_permission_role_table',	16),
('2015_02_09_132439_create_permission_user_table',	16),
('2016_03_21_141322_update_catalog_vitayz',	17);

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_url_unique` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `page` (`id`, `title`, `description`, `url`, `date`, `position`, `active`, `created_at`, `updated_at`) VALUES
(25,	'Доставка',	'<p>Наш партнер по доставке кампания ООО &laquo;Арлайн Авто&raquo;</p>\r\n<p style=\"text-align: left;\"><strong>Тарифы на доставку грузов авто-рефрижераторами (22 т.) по России</strong></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<table class=\"table\">\r\n<thead>\r\n<tr>\r\n<th>Город, (погрузки)</th>\r\n<th>Тариф, руб. с НДС</th>\r\n<th>Срок доставки, (сутки)</th>\r\n<th>Город, (выгрузки)</th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>Хабаровск&nbsp;</td>\r\n<td>165000&nbsp;</td>\r\n<td>6-7&nbsp;</td>\r\n<td>Новосибирск&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;</td>\r\n<td>170000&nbsp;</td>\r\n<td>7-8&nbsp;</td>\r\n<td>Новосибирск&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;</td>\r\n<td>170000&nbsp;</td>\r\n<td>6-7&nbsp;</td>\r\n<td>Барнаул&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;</td>\r\n<td>175000&nbsp;</td>\r\n<td>7-8&nbsp;</td>\r\n<td>Барнаул&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;</td>\r\n<td>185000&nbsp;</td>\r\n<td>7-8&nbsp;</td>\r\n<td>Омск&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;</td>\r\n<td>190000&nbsp;</td>\r\n<td>8-9&nbsp;</td>\r\n<td>Омск&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;</td>\r\n<td>195000&nbsp;</td>\r\n<td>9-10&nbsp;</td>\r\n<td>Екатеринбург&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;</td>\r\n<td>200000&nbsp;</td>\r\n<td>10-11&nbsp;</td>\r\n<td>Екатеринбург&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;</td>\r\n<td>220000&nbsp;</td>\r\n<td>10-11&nbsp;</td>\r\n<td>Самара&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;</td>\r\n<td>230000&nbsp;</td>\r\n<td>11-12&nbsp;</td>\r\n<td>Самара&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;</td>\r\n<td>245000&nbsp;</td>\r\n<td>11-12&nbsp;</td>\r\n<td>Москва</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;&nbsp;</td>\r\n<td>255000&nbsp;</td>\r\n<td>12-13&nbsp;</td>\r\n<td>Москва</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;&nbsp;</td>\r\n<td>250000&nbsp;</td>\r\n<td>11-12&nbsp;</td>\r\n<td>Воронеж</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;&nbsp;</td>\r\n<td>260000&nbsp;</td>\r\n<td>12-13&nbsp;</td>\r\n<td>Воронеж</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;&nbsp;</td>\r\n<td>260000&nbsp;</td>\r\n<td>12-13&nbsp;</td>\r\n<td>Санкт-Петербург</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;&nbsp;</td>\r\n<td>270000&nbsp;</td>\r\n<td>13-14&nbsp;</td>\r\n<td>Санкт-Петербург</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;&nbsp;</td>\r\n<td>260000&nbsp;</td>\r\n<td>12-13&nbsp;</td>\r\n<td>Краснодар</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;&nbsp;</td>\r\n<td>270000&nbsp;</td>\r\n<td>13-14&nbsp;</td>\r\n<td>Краснодар</td>\r\n</tr>\r\n<tr>\r\n<td>Хабаровск&nbsp;&nbsp;</td>\r\n<td>360000&nbsp;</td>\r\n<td>13-14&nbsp;</td>\r\n<td>Симферополь</td>\r\n</tr>\r\n<tr>\r\n<td>Владивосток&nbsp;&nbsp;</td>\r\n<td>370000&nbsp;</td>\r\n<td>14-15&nbsp;</td>\r\n<td>Симферополь</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p><img style=\"float: right;\" src=\"../../../media/Page/Page-25-arlainpng.png\" alt=\"Арлайн\" width=\"232\" height=\"27\" /></p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: right;\">Россия, г. Новосибирск, ул. Высоцкого, д. 38 <br />e-mail: <a href=\"mailto:arlainavto@mail.ru\">arlainavto@mail.ru</a> <br />Телефон: 8 (383) 230-34-78, 89139532954</p>',	'dostavka',	'2016-03-16',	0,	1,	'2016-03-16 05:05:09',	'2016-03-21 03:18:26'),
(26,	'Контакты',	'<h1>Рыболовецкий колхоз &laquo;Витязь&raquo;</h1>\r\n<p>680009, Хабаровский край, г. Хабаровск, <br />ул. Промышленная, 12г, оф. 10<br />Тел: 8 (4212) 93-25-49<br /><a href=\"mailto:stormelectric@mail.ru\">stormelectric@mail.ru</a></p>',	'kontakty',	'2016-03-16',	0,	1,	'2016-03-16 05:06:40',	'2016-03-17 02:54:11'),
(27,	'О нас',	'<p>{Фото[news]=onas}</p>',	'o-nas',	'2016-03-21',	0,	1,	'2016-03-21 02:55:58',	'2016-03-21 03:20:51');

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `persistences`;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1,	1,	'zARaeN5AuMYX4VKW40tMUBosYHjoF9fh',	'2015-11-19 15:48:26',	'2015-11-19 15:48:26'),
(2,	1,	'qso47HyXEoN5bxZqSBvb3KsCD8NkHdml',	'2015-11-19 15:48:57',	'2015-11-19 15:48:57'),
(7,	1,	'lno7hBMsryB4PpLnJ6fpRRe3OUGhvaYg',	'2015-11-19 21:33:35',	'2015-11-19 21:33:35'),
(9,	1,	'4f1jLnmRK7kpNWEIOy8MAWP9IMQjAwb1',	'2015-11-23 13:44:27',	'2015-11-23 13:44:27'),
(11,	1,	'jp05qAtmuta0D5Qk6KvJhtpnPeldpFpB',	'2015-11-30 07:21:48',	'2015-11-30 07:21:48'),
(13,	1,	'zlSDU4K06BvazeEDsWW0ySdmtykMNJJR',	'2015-12-02 07:58:20',	'2015-12-02 07:58:20'),
(14,	1,	'lWKl1mWZhuE7cNRmAaYjNkPQs4ZFpZbA',	'2015-12-11 06:02:37',	'2015-12-11 06:02:37'),
(15,	1,	'ZwCwP7oqg2PXJ8cOQRGEghqQVuAU3WVI',	'2015-12-17 07:57:59',	'2015-12-17 07:57:59'),
(19,	1,	'lVjOgloO0j8pSCQLXakd24jZ9m6WMyVI',	'2015-12-22 10:33:42',	'2015-12-22 10:33:42'),
(20,	1,	'61MuFref301oRpqwcZHdcD8EZHurK0HS',	'2015-12-24 05:46:40',	'2015-12-24 05:46:40'),
(23,	1,	'fJvvvkP3cBqosLhEH9YRDTcGXv6goFtF',	'2015-12-25 07:18:00',	'2015-12-25 07:18:00'),
(24,	1,	'vTltCkhFkx7YGFnw5gSVofAX86sLnOpR',	'2016-03-17 06:51:06',	'2016-03-17 06:51:06');

DROP TABLE IF EXISTS `reminders`;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin',	NULL,	3,	'2016-03-17 07:19:03',	'2016-03-17 07:19:03'),
(2,	'Moderator',	'moderator',	NULL,	2,	'2016-03-17 07:19:03',	'2016-03-17 07:19:03'),
(3,	'User',	'user',	NULL,	1,	'2016-03-17 07:19:03',	'2016-03-17 07:19:03');

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'2016-03-17 07:24:27',	'2016-03-17 07:24:27');

DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_connect` int(11) DEFAULT NULL,
  `url_connect` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_connect` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `seo` (`id`, `seo_title`, `seo_description`, `seo_keywords`, `id_connect`, `url_connect`, `type_connect`, `created_at`, `updated_at`) VALUES
(29,	'tess',	'',	'',	1,	NULL,	'page',	'2016-01-11 05:36:02',	'2016-01-11 05:36:02'),
(30,	'Доставка. Тарифы на доставку грузов авто-рефрижераторами (22 т.) по России',	'',	'',	25,	NULL,	'page',	'2016-03-21 03:18:26',	'2016-03-21 03:18:26');

DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_global` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_connect` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `templates` (`id`, `template`, `template_global`, `type_connect`, `id_connect`, `created_at`, `updated_at`) VALUES
(9,	'Template2',	'Template2',	'feed',	4,	'2015-12-18 06:40:38',	'2015-12-18 06:44:30'),
(10,	'Template2',	'Template2',	'page',	2,	'2015-12-21 00:44:01',	'2015-12-21 01:16:23'),
(11,	'Template1',	'Template1',	'category',	5,	'2015-12-24 05:22:04',	'2015-12-24 05:22:04'),
(12,	'Template1',	'Template1',	'category',	6,	'2015-12-24 05:32:48',	'2015-12-24 05:32:48'),
(13,	'Template1',	'Template1',	'category',	7,	'2015-12-24 05:38:38',	'2015-12-24 05:38:38'),
(14,	'Template1',	'Template1',	'catalog',	2,	'2015-12-29 02:00:38',	'2015-12-29 02:00:38'),
(15,	'Template1',	'Template1',	'catalog',	3,	'2015-12-29 03:16:28',	'2015-12-29 03:16:28'),
(16,	'Template1',	'Template1',	'feed',	5,	'2015-12-29 04:01:52',	'2015-12-29 04:01:52'),
(17,	'Template1',	'Template1',	'catalog',	4,	'2015-12-29 04:34:57',	'2015-12-29 04:34:57'),
(18,	'Template2',	'Template2',	'page',	3,	'2016-01-11 04:23:53',	'2016-01-11 04:23:53'),
(19,	'Template2',	'Template1',	'page',	4,	'2016-01-11 04:25:47',	'2016-01-11 04:25:47'),
(20,	'Template1',	'Template1',	'page',	5,	'2016-01-11 04:41:24',	'2016-01-11 04:41:24'),
(21,	'Template1',	'Template1',	'page',	1,	'2016-01-11 04:47:59',	'2016-01-11 04:47:59'),
(26,	'',	'',	'',	17,	'2016-01-13 08:16:31',	'2016-01-13 08:16:31'),
(27,	'Template1',	'Template1',	'blocks',	1,	'2016-01-21 05:45:22',	'2016-01-21 05:45:22'),
(28,	'Template1',	'Template1',	'blocks',	2,	'2016-01-21 07:08:15',	'2016-01-21 07:08:15'),
(29,	'Template1',	'Template1',	'catalog',	96,	'2016-02-04 02:30:41',	'2016-02-04 02:30:41'),
(31,	'',	'',	'',	24,	'2016-02-16 11:33:45',	'2016-02-16 11:33:45'),
(32,	'',	'',	'',	25,	'2016-02-16 11:43:02',	'2016-02-16 11:43:02'),
(33,	'',	'',	'',	26,	'2016-02-16 17:22:24',	'2016-02-16 17:22:24'),
(34,	'',	'',	'',	27,	'2016-02-16 17:25:24',	'2016-02-16 17:25:24'),
(35,	'',	'',	'',	28,	'2016-02-16 17:26:00',	'2016-02-16 17:26:00'),
(36,	'',	'',	'',	29,	'2016-02-16 17:26:53',	'2016-02-16 17:26:53'),
(37,	'',	'',	'',	30,	'2016-02-16 17:32:43',	'2016-02-16 17:32:43'),
(38,	'',	'',	'',	31,	'2016-02-16 17:42:07',	'2016-02-16 17:42:07'),
(39,	'Template1',	'Template1',	'page',	31,	'2016-02-17 02:44:25',	'2016-02-17 02:44:25'),
(40,	'Template1',	'Template1',	'catalog',	138,	'2016-03-14 04:49:01',	'2016-03-14 04:49:01'),
(41,	'Template1',	'Template1',	'catalog',	139,	'2016-03-14 05:04:53',	'2016-03-14 05:04:53'),
(42,	'Template1',	'Template1',	'catalog',	140,	'2016-03-14 05:12:41',	'2016-03-14 05:12:41'),
(43,	'',	'',	'',	142,	'2016-03-14 05:24:08',	'2016-03-14 05:24:08'),
(44,	'Template1',	'Template1',	'catalog',	142,	'2016-03-14 05:25:03',	'2016-03-14 05:25:03'),
(45,	'',	'',	'',	143,	'2016-03-14 05:58:32',	'2016-03-14 05:58:32'),
(46,	'Template1',	'Template1',	'catalog',	143,	'2016-03-14 05:59:35',	'2016-03-14 05:59:35'),
(47,	'',	'',	'',	144,	'2016-03-14 06:00:08',	'2016-03-14 06:00:08'),
(48,	'Template1',	'Template1',	'catalog',	144,	'2016-03-14 06:01:24',	'2016-03-14 06:01:24'),
(49,	'',	'',	'',	145,	'2016-03-14 06:06:29',	'2016-03-14 06:06:29'),
(50,	'Template1',	'Template1',	'catalog',	145,	'2016-03-14 06:09:10',	'2016-03-14 06:09:10'),
(51,	'',	'',	'',	146,	'2016-03-14 06:09:31',	'2016-03-14 06:09:31'),
(52,	'Template1',	'Template1',	'catalog',	146,	'2016-03-14 06:10:18',	'2016-03-14 06:10:18'),
(53,	'',	'',	'',	147,	'2016-03-14 06:10:27',	'2016-03-14 06:10:27'),
(54,	'Template1',	'Template1',	'catalog',	147,	'2016-03-14 06:11:58',	'2016-03-14 06:11:58'),
(55,	'',	'',	'',	148,	'2016-03-14 06:12:08',	'2016-03-14 06:12:08'),
(56,	'Template1',	'Template1',	'catalog',	148,	'2016-03-14 06:12:52',	'2016-03-14 06:12:52'),
(57,	'',	'',	'',	149,	'2016-03-14 06:13:13',	'2016-03-14 06:13:13'),
(58,	'',	'',	'',	150,	'2016-03-14 06:17:04',	'2016-03-14 06:17:04'),
(59,	'',	'',	'',	151,	'2016-03-14 06:18:15',	'2016-03-14 06:18:15'),
(60,	'',	'',	'',	152,	'2016-03-14 06:25:54',	'2016-03-14 06:25:54'),
(61,	'Template1',	'Template1',	'catalog',	152,	'2016-03-14 06:27:07',	'2016-03-14 06:27:07'),
(62,	'',	'',	'',	153,	'2016-03-14 06:27:17',	'2016-03-14 06:27:17'),
(63,	'Template1',	'Template1',	'catalog',	153,	'2016-03-14 06:59:03',	'2016-03-14 06:59:03'),
(64,	'',	'',	'',	154,	'2016-03-14 07:04:01',	'2016-03-14 07:04:01'),
(65,	'Template1',	'Template1',	'catalog',	154,	'2016-03-14 07:05:05',	'2016-03-14 07:05:05'),
(66,	'',	'',	'',	155,	'2016-03-14 07:06:09',	'2016-03-14 07:06:09'),
(67,	'Template1',	'Template1',	'catalog',	155,	'2016-03-14 07:07:40',	'2016-03-14 07:07:40'),
(68,	'',	'',	'',	156,	'2016-03-14 07:13:44',	'2016-03-14 07:13:44'),
(69,	'Template1',	'Template1',	'catalog',	156,	'2016-03-14 07:14:28',	'2016-03-14 07:14:28'),
(70,	'',	'',	'',	157,	'2016-03-14 07:20:53',	'2016-03-14 07:20:53'),
(71,	'Template1',	'Template1',	'catalog',	157,	'2016-03-14 07:23:13',	'2016-03-14 07:23:13'),
(72,	'',	'',	'',	158,	'2016-03-14 07:24:58',	'2016-03-14 07:24:58'),
(73,	'Template1',	'Template1',	'catalog',	158,	'2016-03-14 07:25:49',	'2016-03-14 07:25:49'),
(74,	'',	'',	'',	159,	'2016-03-14 07:26:02',	'2016-03-14 07:26:02'),
(75,	'Template1',	'Template1',	'catalog',	159,	'2016-03-14 07:26:43',	'2016-03-14 07:26:43'),
(76,	'',	'',	'',	160,	'2016-03-14 07:29:09',	'2016-03-14 07:29:09'),
(77,	'Template1',	'Template1',	'catalog',	160,	'2016-03-14 07:29:44',	'2016-03-14 07:29:44'),
(78,	'',	'',	'',	161,	'2016-03-14 07:30:40',	'2016-03-14 07:30:40'),
(79,	'Template1',	'Template1',	'catalog',	161,	'2016-03-14 07:31:18',	'2016-03-14 07:31:18'),
(80,	'',	'',	'',	25,	'2016-03-16 05:05:09',	'2016-03-16 05:05:09'),
(81,	'Template1',	'Template1',	'page',	25,	'2016-03-16 05:06:18',	'2016-03-16 05:06:18'),
(82,	'',	'',	'',	26,	'2016-03-16 05:06:40',	'2016-03-16 05:06:40'),
(83,	'Template1',	'Template1',	'page',	26,	'2016-03-16 05:08:06',	'2016-03-16 05:08:06'),
(84,	'',	'',	'',	3,	'2016-03-16 05:55:22',	'2016-03-16 05:55:22'),
(85,	'Template1',	'Template1',	'blocks',	3,	'2016-03-16 05:56:05',	'2016-03-16 05:56:05'),
(86,	'',	'',	'',	8,	'2016-03-17 05:32:45',	'2016-03-17 05:32:45'),
(87,	'Template1',	'Template1',	'feed',	8,	'2016-03-17 05:54:43',	'2016-03-17 05:54:43'),
(88,	'',	'',	'',	9,	'2016-03-17 06:23:19',	'2016-03-17 06:23:19'),
(89,	'Template1',	'Template1',	'feed',	9,	'2016-03-17 06:24:18',	'2016-03-17 06:24:18'),
(90,	'',	'',	'',	10,	'2016-03-17 06:24:29',	'2016-03-17 06:24:29'),
(91,	'Template1',	'Template1',	'feed',	10,	'2016-03-17 06:24:51',	'2016-03-17 06:24:51'),
(92,	'Template1',	'Template1',	'category',	299,	'2016-03-18 05:32:09',	'2016-03-18 05:32:09'),
(93,	'Template1',	'Template1',	'category',	297,	'2016-03-21 02:36:23',	'2016-03-21 02:36:23'),
(94,	'',	'',	'',	27,	'2016-03-21 02:55:58',	'2016-03-21 02:55:58'),
(95,	'Template1',	'Template1',	'page',	27,	'2016-03-21 02:56:20',	'2016-03-21 02:56:20');

DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(13,	NULL,	'global',	NULL,	'2015-11-19 19:48:59',	'2015-11-19 19:48:59'),
(14,	NULL,	'ip',	'::1',	'2015-11-19 19:48:59',	'2015-11-19 19:48:59'),
(15,	NULL,	'global',	NULL,	'2015-11-19 19:58:57',	'2015-11-19 19:58:57'),
(16,	NULL,	'ip',	'::1',	'2015-11-19 19:58:57',	'2015-11-19 19:58:57'),
(17,	NULL,	'global',	NULL,	'2015-11-19 19:59:23',	'2015-11-19 19:59:23'),
(18,	NULL,	'ip',	'::1',	'2015-11-19 19:59:24',	'2015-11-19 19:59:24'),
(19,	NULL,	'global',	NULL,	'2015-11-19 20:01:29',	'2015-11-19 20:01:29'),
(20,	NULL,	'ip',	'::1',	'2015-11-19 20:01:29',	'2015-11-19 20:01:29'),
(21,	NULL,	'global',	NULL,	'2015-11-19 21:32:07',	'2015-11-19 21:32:07'),
(22,	NULL,	'ip',	'::1',	'2015-11-19 21:32:07',	'2015-11-19 21:32:07'),
(23,	1,	'user',	NULL,	'2015-11-19 21:32:07',	'2015-11-19 21:32:07'),
(24,	NULL,	'global',	NULL,	'2015-11-19 21:32:39',	'2015-11-19 21:32:39'),
(25,	NULL,	'ip',	'::1',	'2015-11-19 21:32:39',	'2015-11-19 21:32:39'),
(26,	1,	'user',	NULL,	'2015-11-19 21:32:39',	'2015-11-19 21:32:39'),
(27,	NULL,	'global',	NULL,	'2015-12-01 03:27:35',	'2015-12-01 03:27:35'),
(28,	NULL,	'ip',	'192.168.0.2',	'2015-12-01 03:27:35',	'2015-12-01 03:27:35'),
(29,	NULL,	'global',	NULL,	'2015-12-11 06:01:21',	'2015-12-11 06:01:21'),
(30,	NULL,	'ip',	'192.168.0.2',	'2015-12-11 06:01:21',	'2015-12-11 06:01:21');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1,	'fanamurov@ya.ru',	'$2y$10$SJzDIVLhyCdzOMxfnqAADOCoyzVgjwjmBlYaVWQlikchTd67mWPRa',	NULL,	'2016-03-17 06:51:06',	'4234',	'',	'2015-11-19 15:41:49',	'2016-03-17 06:51:06');

-- 2016-03-21 07:54:16
