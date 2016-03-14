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
(2,	'header-slogan',	'<p>Огнетушители и пожарное оборудование</p>',	'header-slogan',	0,	1,	'2016-01-21 07:08:15',	'2016-01-21 07:08:15');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_url_unique` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `catalog` (`id`, `title`, `short`, `description`, `url`, `what`, `cost`, `cost_old`, `manufacture`, `position`, `articul`, `active`, `nalichie`, `created_at`, `updated_at`) VALUES
(138,	'Горбуша серебро ПСГ',	'<p><strong>Вид продукта:</strong> горбуша свежемороженая серебро ПСГ <br /><strong>Размерный ряд:</strong> <br /><strong>Дата вылова:</strong> <br /><strong>Место вылова:</strong> <br /><strong>Вес упаковки:</strong> 1/22,24 <br /><strong>Вид упаковки:</strong> мешок<br /><strong>Минимальная партия:</strong> 20т.</p>',	'<p><strong>Вид продукта:</strong> горбуша свежемороженая серебро ПСГ <br /><strong>Размерный ряд:</strong> <br /><strong>Дата вылова:</strong> <br /><strong>Место вылова:</strong> <br /><strong>Вес упаковки:</strong> 1/22,24 <br /><strong>Вид упаковки:</strong> мешок<br /><strong>Минимальная партия:</strong> 20т.</p>',	'gorbusha-serebro-psg',	'р./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 05:06:22',	'2016-03-14 05:06:22'),
(139,	'Горбуша серебро ПБГ',	'<p><strong>Вид продукта: </strong>Горбуша свежемороженая серебро ПБГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Горбуша свежемороженая серебро ПБГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'gorbusha-serebro-pbg',	'р./шт.',	0.00,	0.00,	'',	0,	'',	1,	0,	'2016-03-14 05:05:10',	'2016-03-14 05:05:10'),
(140,	'Горбуша ПСГ',	'<p><strong>Вид продукта: </strong>Горбуша свежемороженая&nbsp; ПСГ<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Горбуша свежемороженая&nbsp; ПСГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'gorbusha-psg',	'р./шт.',	0.00,	0.00,	'',	0,	'',	1,	0,	'2016-03-14 05:12:54',	'2016-03-14 05:12:54'),
(142,	'Горбуша ПБГ',	'<p><strong>Вид продукта: </strong>Горбуша свежемороженая&nbsp; ПБГ<br /><strong>Размерный ряд: <br /> Дата вылова: <br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Горбуша свежемороженая&nbsp; ПБГ<br /><strong>Размерный ряд: <br />Дата вылова: <br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'gorbusha-pbg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 05:55:46',	'2016-03-14 05:25:29'),
(143,	'Кета серебро ПСГ',	'<p><strong>Вид продукта: </strong>Кета свежемороженая серебро ПСГ<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Кета свежемороженая серебро ПСГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'keta-serebro-psg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 06:09:25',	'2016-03-14 05:59:35'),
(144,	'Кета серебро ПБГ',	'<p><strong>Вид продукта: </strong>Кета свежемороженая серебро ПБГ<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки:</strong> мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Кета свежемороженая серебро ПБГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки:</strong> мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'keta-serebro-pbg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 06:09:26',	'2016-03-14 06:01:24'),
(145,	'ПСГ',	'<p><strong>Вид продукта: </strong>Кета свежемороженая&nbsp; ПСГ<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Кета свежемороженая&nbsp; ПСГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'psg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 06:09:27',	'2016-03-14 06:09:10'),
(146,	'Кета ПБГ',	'<p><strong>Вид продукта: </strong>Кет свежемороженая &nbsp;ПБГ<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Кет свежемороженая &nbsp;ПБГ<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'keta-pbg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 06:10:24',	'2016-03-14 06:10:18'),
(147,	'Сельдь Олюторская НР',	'<p><strong>Вид продукта: </strong>Сельдь алюторская свежемороженая НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки:<br /></strong><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Сельдь алюторская свежемороженая НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки:<br /></strong><strong>Минимальная партия: </strong>20т.</p>',	'seld-olyutorskaya-nr',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 06:12:05',	'2016-03-14 06:11:58'),
(148,	'Сельдь Тихоокеанская свежемороженая НР',	'<p><strong>Вид продукта: </strong>Сельдь свежемороженая тихоокеанская НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Сельдь свежемороженая тихоокеанская НР<br /><strong>Размерный ряд: </strong>27+;29+<strong><br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'seld-tikhookeanskaya-svezhemorozhenaya-nr',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 06:17:01',	'2016-03-14 06:12:52'),
(152,	'Минтай ПБГ',	'<p><strong>Вид продукта: </strong>минтай свежемороженая ПБГ<br /><strong>Размерный ряд: </strong>25+;35+;<strong><br /> Дата вылова: <br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>минтай свежемороженая ПБГ<br /><strong>Размерный ряд: </strong>25+;35+;<strong><br />Дата вылова: <br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'mintay-pbg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:05:13',	'2016-03-14 06:27:07'),
(153,	'Треска свежемороженая ПБГ',	'<p><strong>Вид продукта: </strong>треска свежемороженая ПБГ<br /><strong>Размерный ряд:&nbsp;</strong>0,5-1;1-2; 2+<strong><br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки:</strong> 1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>треска свежемороженая ПБГ<br /><strong>Размерный ряд:&nbsp;</strong>0,5-1;1-2; 2+<strong><br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки:</strong> 1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'treska-svezhemorozhenaya-pbg',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:05:14',	'2016-03-14 06:59:03'),
(154,	'Камбала желтоперая НР',	'<p><strong>Вид продукта: </strong>камбала свежемороженая НР<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>камбала свежемороженая НР<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'kambala-zheltoperaya-nr',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:05:15',	'2016-03-14 07:05:05'),
(155,	'Навага ПБГ свежемороженая',	'<p><strong>Вид продукта: </strong>Навага ПБГ свежемороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: </strong>1/22,24<strong><br /> Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>Навага ПБГ свежемороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: </strong>1/22,24<strong><br />Вид упаковки: </strong>мешок<br /><strong>Минимальная партия: </strong>20т.</p>',	'navaga-pbg-svezhemorozhenaya',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:07:49',	'2016-03-14 07:07:40'),
(156,	'Краб камчатский',	'<p><strong>Вид продукта: </strong>краб свежемороженая камчатский(целый вареный)<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>картон<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>краб свежемороженая камчатский(целый вареный)<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>картон<br /><strong>Минимальная партия: </strong>20т.</p>',	'krab-kamchatskiy',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:20:29',	'2016-03-14 07:14:28'),
(157,	'Роза',	'<p><strong>Вид продукта: </strong>мясо краба свежемороженая (роза)<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта: </strong>мясо краба свежемороженая (роза)<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'roza',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:23:45',	'2016-03-14 07:23:45'),
(158,	'Фаланга краба 1ая',	'<p><strong>Вид продукта: </strong>фаланга краба 1ая замороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>20т.</p>',	'<p><strong>Вид продукта: </strong>фаланга краба 1ая замороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>20т.</p>',	'falanga-kraba-1aya',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:25:49',	'2016-03-14 07:25:49'),
(159,	'Фаланга краба 2ая',	'<p><strong>Вид продукта:</strong> фаланга краба 2ая замороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта:</strong> фаланга краба 2ая замороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'falanga-kraba-2aya',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:26:43',	'2016-03-14 07:26:43'),
(160,	'Икра красная замороженная',	'<p><strong>Вид продукта:</strong> икра красная замороженная<br /><strong>Размерный ряд: </strong>крупная<strong><br /> Дата вылова:</strong> 15 сентября<br /><strong>Место вылова:<br /> Вес упаковки:</strong>12кг<strong>.<br /> Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта:</strong> икра красная замороженная<br /><strong>Размерный ряд: </strong>крупная<strong><br />Дата вылова:</strong> 15 сентября<br /><strong>Место вылова:<br />Вес упаковки:</strong>12кг<strong>.<br />Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'ikra-krasnaya-zamorozhennaya',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:30:14',	'2016-03-14 07:30:14'),
(161,	'Икра красная охлажденная',	'<p><strong>Вид продукта: </strong>икра красная охлажденная<br /><strong>Размерный ряд: </strong>крупная<strong> <br /> Дата вылова: </strong>15 сентября<br /><strong>Место вылова:<br /> Вес упаковки: </strong>12кг<strong><br /> Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта: </strong>икра красная охлажденная<br /><strong>Размерный ряд: </strong>крупная<strong> <br />Дата вылова: </strong>15 сентября<br /><strong>Место вылова:<br />Вес упаковки: </strong>12кг<strong><br />Вид упаковки: </strong>куботейнер<br /><strong>Минимальная партия: </strong>5т.</p>',	'ikra-krasnaya-okhlazhdennaya',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-14 07:31:18',	'2016-03-14 07:31:18');

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
(1,	'Новости',	'',	'',	'feed',	0,	1,	'test_category',	1,	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	'Акции',	'',	'',	'feed',	0,	1,	'tester',	1,	0,	1,	'2015-12-08 07:25:12',	'2015-12-08 07:25:12'),
(294,	'Лосось',	'',	'',	'catalog',	0,	1,	'losos',	1,	0,	1,	'2016-03-11 07:11:18',	'2016-03-11 07:11:18'),
(295,	'Белая рыба',	'',	'',	'catalog',	0,	1,	'belaya-ryba',	1,	0,	1,	'2016-03-11 07:11:34',	'2016-03-11 07:11:34'),
(296,	'Сельдь',	'',	'',	'catalog',	0,	1,	'seld',	1,	0,	1,	'2016-03-11 07:11:52',	'2016-03-11 07:11:52'),
(297,	'Краб, креведки',	'',	'',	'catalog',	0,	1,	'krab-krevedki',	1,	0,	1,	'2016-03-11 07:12:02',	'2016-03-11 07:12:02'),
(298,	'Икра лососёвая',	'',	'',	'catalog',	0,	1,	'ikra-lososevaya',	1,	0,	1,	'2016-03-11 07:12:21',	'2016-03-11 07:12:21');

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
(294,	138,	'2016-03-14 05:06:22',	'0000-00-00 00:00:00'),
(294,	140,	'2016-03-14 05:12:54',	'0000-00-00 00:00:00'),
(294,	142,	'2016-03-14 05:25:29',	'0000-00-00 00:00:00'),
(294,	139,	'2016-03-14 05:49:14',	'0000-00-00 00:00:00'),
(294,	143,	'2016-03-14 05:59:35',	'0000-00-00 00:00:00'),
(294,	144,	'2016-03-14 06:01:24',	'0000-00-00 00:00:00'),
(294,	145,	'2016-03-14 06:09:10',	'0000-00-00 00:00:00'),
(294,	146,	'2016-03-14 06:10:18',	'0000-00-00 00:00:00'),
(294,	147,	'2016-03-14 06:11:58',	'0000-00-00 00:00:00'),
(294,	148,	'2016-03-14 06:12:52',	'0000-00-00 00:00:00'),
(294,	152,	'2016-03-14 06:27:07',	'0000-00-00 00:00:00'),
(294,	153,	'2016-03-14 06:59:03',	'0000-00-00 00:00:00'),
(294,	154,	'2016-03-14 07:05:05',	'0000-00-00 00:00:00'),
(294,	155,	'2016-03-14 07:07:40',	'0000-00-00 00:00:00'),
(297,	156,	'2016-03-14 07:19:51',	'0000-00-00 00:00:00'),
(297,	157,	'2016-03-14 07:23:45',	'0000-00-00 00:00:00'),
(297,	158,	'2016-03-14 07:25:49',	'0000-00-00 00:00:00'),
(297,	159,	'2016-03-14 07:26:43',	'0000-00-00 00:00:00'),
(298,	160,	'2016-03-14 07:30:14',	'0000-00-00 00:00:00'),
(298,	161,	'2016-03-14 07:31:18',	'0000-00-00 00:00:00');

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
(1,	'Пример заголовка',	2,	'',	'<p>&laquo;Эдиториум.ру&raquo;&nbsp;&mdash; сайт, созданный по&nbsp;материалам сборника &laquo;О&nbsp;редактировании и&nbsp;редакторах&raquo; Аркадия Эммануиловича Мильчина, который с&nbsp;1944 года коллекционировал выдержки из&nbsp;статей, рассказов, фельетонов, пародий, писем и&nbsp;книг, где так или иначе затрагивается тема редакторской работы. Эта коллекция легла в&nbsp;основу обширной антологии, представляющей историю и&nbsp;природу редактирования в&nbsp;первоисточниках.</p>',	'primer-zagolovka',	'2015-11-11 00:00:00',	20,	1,	'2015-11-26 05:47:36',	'2015-12-05 13:26:13'),
(2,	'Новость об акции',	2,	'',	'<p>4324324</p>',	'ttrtr',	'2015-11-11 00:00:00',	23,	1,	'2015-11-26 06:10:16',	'2015-11-30 06:03:16'),
(4,	'Новость о «новом годе»',	1,	'<h1>Test</h1>\r\n<h2>32234</h2>\r\n<p>Вот так вот</p>',	'<p>Текст новости</p>',	'novost-o-novom-gode',	'2015-12-17 00:00:00',	0,	1,	'2015-12-17 06:09:43',	'2015-12-24 03:51:45'),
(5,	'32423423',	1,	'',	'',	'32423423',	'0000-00-00 00:00:00',	0,	1,	'2015-12-29 04:01:52',	'2015-12-29 04:01:52');

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
(137,	295,	'App\\Models\\Category',	'images',	'Category-295-belribpng',	'Category-295-belribpng.png',	'media',	80640,	'[]',	'[]',	4,	'2016-03-11 07:50:07',	'2016-03-11 07:50:07'),
(138,	294,	'App\\Models\\Category',	'images',	'Category-294-losospng',	'Category-294-losospng.png',	'media',	47091,	'[]',	'[]',	5,	'2016-03-11 07:50:11',	'2016-03-11 07:50:11'),
(139,	298,	'App\\Models\\Category',	'images',	'Category-298-ikrapng',	'Category-298-ikrapng.png',	'media',	39684,	'[]',	'[]',	6,	'2016-03-11 07:57:56',	'2016-03-11 07:57:56'),
(140,	138,	'App\\Models\\Catalog',	'images',	'Catalog-138-gorbuha-ser-psbpng',	'Catalog-138-gorbuha-ser-psbpng.png',	'media',	64635,	'[]',	'[]',	7,	'2016-03-14 04:56:10',	'2016-03-14 04:56:10'),
(142,	140,	'App\\Models\\Catalog',	'images',	'Catalog-140-gorbuha-psgpng',	'Catalog-140-gorbuha-psgpng.png',	'media',	49756,	'[]',	'[]',	9,	'2016-03-14 05:12:49',	'2016-03-14 05:12:49'),
(144,	142,	'App\\Models\\Catalog',	'images',	'Catalog-142-gorbuha-psgpng',	'Catalog-142-gorbuha-psgpng.png',	'media',	49756,	'[]',	'[]',	11,	'2016-03-14 05:24:54',	'2016-03-14 05:24:54'),
(145,	139,	'App\\Models\\Catalog',	'images',	'Catalog-139-gorbuha-ser-psbpng',	'Catalog-139-gorbuha-ser-psbpng.png',	'media',	64635,	'[]',	'[]',	12,	'2016-03-14 05:49:10',	'2016-03-14 05:49:10'),
(147,	143,	'App\\Models\\Catalog',	'images',	'Catalog-143-keta-serebpng',	'Catalog-143-keta-serebpng.png',	'media',	67245,	'[]',	'[]',	14,	'2016-03-14 05:59:28',	'2016-03-14 05:59:28'),
(149,	144,	'App\\Models\\Catalog',	'images',	'Catalog-144-keta-serebpng',	'Catalog-144-keta-serebpng.png',	'media',	67245,	'[]',	'[]',	16,	'2016-03-14 06:00:58',	'2016-03-14 06:00:58'),
(151,	145,	'App\\Models\\Catalog',	'images',	'Catalog-145-keta-psgpng',	'Catalog-145-keta-psgpng.png',	'media',	58389,	'[]',	'[]',	18,	'2016-03-14 06:08:37',	'2016-03-14 06:08:37'),
(153,	146,	'App\\Models\\Catalog',	'images',	'Catalog-146-keta-psgpng',	'Catalog-146-keta-psgpng.png',	'media',	58389,	'[]',	'[]',	20,	'2016-03-14 06:10:08',	'2016-03-14 06:10:08'),
(155,	147,	'App\\Models\\Catalog',	'images',	'Catalog-147-seld-olutpng',	'Catalog-147-seld-olutpng.png',	'media',	59920,	'[]',	'[]',	22,	'2016-03-14 06:11:52',	'2016-03-14 06:11:52'),
(157,	148,	'App\\Models\\Catalog',	'images',	'Catalog-148-seld-olutpng',	'Catalog-148-seld-olutpng.png',	'media',	59920,	'[]',	'[]',	23,	'2016-03-14 06:12:46',	'2016-03-14 06:12:46'),
(163,	152,	'App\\Models\\Catalog',	'images',	'Catalog-152-mintaipng',	'Catalog-152-mintaipng.png',	'media',	51873,	'[]',	'[]',	26,	'2016-03-14 06:26:58',	'2016-03-14 06:26:58'),
(166,	153,	'App\\Models\\Catalog',	'images',	'Catalog-153-trskapng',	'Catalog-153-trskapng.png',	'media',	56270,	'[]',	'[]',	29,	'2016-03-14 06:58:55',	'2016-03-14 06:58:55'),
(168,	154,	'App\\Models\\Catalog',	'images',	'Catalog-154-kambalapng',	'Catalog-154-kambalapng.png',	'media',	86485,	'[]',	'[]',	31,	'2016-03-14 07:05:00',	'2016-03-14 07:05:00'),
(170,	155,	'App\\Models\\Catalog',	'images',	'Catalog-155-navagapng',	'Catalog-155-navagapng.png',	'media',	38384,	'[]',	'[]',	32,	'2016-03-14 07:07:35',	'2016-03-14 07:07:35'),
(172,	156,	'App\\Models\\Catalog',	'images',	'Catalog-156-krabb-1png',	'Catalog-156-krabb-1png.png',	'media',	96755,	'[]',	'[]',	34,	'2016-03-14 07:14:22',	'2016-03-14 07:14:22'),
(175,	158,	'App\\Models\\Catalog',	'images',	'Catalog-158-falang-1png',	'Catalog-158-falang-1png.png',	'media',	70150,	'[]',	'[]',	35,	'2016-03-14 07:25:44',	'2016-03-14 07:25:44'),
(177,	159,	'App\\Models\\Catalog',	'images',	'Catalog-159-falang-2png',	'Catalog-159-falang-2png.png',	'media',	76480,	'[]',	'[]',	37,	'2016-03-14 07:26:36',	'2016-03-14 07:26:36'),
(179,	160,	'App\\Models\\Catalog',	'images',	'Catalog-160-ikra-1png',	'Catalog-160-ikra-1png.png',	'media',	39684,	'[]',	'[]',	38,	'2016-03-14 07:29:38',	'2016-03-14 07:29:38'),
(181,	161,	'App\\Models\\Catalog',	'images',	'Catalog-161-ikra-1png',	'Catalog-161-ikra-1png.png',	'media',	39684,	'[]',	'[]',	40,	'2016-03-14 07:31:12',	'2016-03-14 07:31:12');

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
(8,	'Рыбная продукция',	0,	'',	0,	'/',	'',	0,	1,	'2016-03-14 02:51:10',	'2016-03-14 03:59:23'),
(9,	'О компании',	0,	'',	0,	'o-kompanii',	'',	0,	1,	'2016-03-14 02:51:28',	'2016-03-14 02:51:28'),
(10,	'Контакты',	0,	'',	0,	'kontakty',	'',	0,	1,	'2016-03-14 02:51:41',	'2016-03-14 02:51:41');

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
('2016_02_05_140905_create_media_table',	15);

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
(23,	'Пример страницы',	'<p>Текст</p>',	'primer-stranicy',	'2016-02-16',	0,	0,	'2016-02-16 09:00:30',	'2016-02-16 09:01:10'),
(24,	'Новый материал',	'',	'novyy-material',	'2016-02-16',	0,	0,	'2016-02-16 11:33:44',	'2016-02-16 11:33:44');

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
(12,	1,	'udSUb7m4mJpUZEEpYyI6RIYPnfuNvrkx',	'2015-12-02 07:57:39',	'2015-12-02 07:57:39'),
(13,	1,	'zlSDU4K06BvazeEDsWW0ySdmtykMNJJR',	'2015-12-02 07:58:20',	'2015-12-02 07:58:20'),
(14,	1,	'lWKl1mWZhuE7cNRmAaYjNkPQs4ZFpZbA',	'2015-12-11 06:02:37',	'2015-12-11 06:02:37'),
(15,	1,	'ZwCwP7oqg2PXJ8cOQRGEghqQVuAU3WVI',	'2015-12-17 07:57:59',	'2015-12-17 07:57:59'),
(19,	1,	'lVjOgloO0j8pSCQLXakd24jZ9m6WMyVI',	'2015-12-22 10:33:42',	'2015-12-22 10:33:42'),
(20,	1,	'61MuFref301oRpqwcZHdcD8EZHurK0HS',	'2015-12-24 05:46:40',	'2015-12-24 05:46:40'),
(23,	1,	'fJvvvkP3cBqosLhEH9YRDTcGXv6goFtF',	'2015-12-25 07:18:00',	'2015-12-25 07:18:00');

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
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'Admin',	NULL,	'2015-11-19 15:35:42',	'2015-11-19 15:35:42');

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2015-11-19 15:41:49',	'2015-11-19 15:41:49'),
(2,	1,	'2015-12-22 09:50:31',	'2015-12-22 09:50:31');

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
(29,	'tess',	'',	'',	1,	NULL,	'page',	'2016-01-11 05:36:02',	'2016-01-11 05:36:02');

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
(30,	'Template1',	'Template1',	'page',	23,	'2016-02-16 09:01:10',	'2016-02-16 09:01:10'),
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
(79,	'Template1',	'Template1',	'catalog',	161,	'2016-03-14 07:31:18',	'2016-03-14 07:31:18');

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
(1,	'fanamurov@ya.ru',	'$2y$10$SJzDIVLhyCdzOMxfnqAADOCoyzVgjwjmBlYaVWQlikchTd67mWPRa',	NULL,	'2015-12-25 07:18:00',	'4234',	'',	'2015-11-19 15:41:49',	'2015-12-25 07:18:00'),
(2,	'4234234@fa.ru',	'$2y$10$7xxex.8N0z6VSgHKACE1/e.RuIUzPN3IDnErUIG5Kiq/Jm1.5/QzG',	NULL,	NULL,	'',	'',	'2015-12-22 09:47:43',	'2015-12-22 09:47:43');

-- 2016-03-14 08:00:29
