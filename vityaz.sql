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
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blocks_url_unique` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blocks` (`id`, `title`, `description`, `url`, `position`, `active`, `created_at`, `updated_at`, `user_id`) VALUES
(1,	'header-email',	'<p><a href=\"mailto:pshabar@mail.ru\">pshabar@mail.ru</a></p>',	'header-email',	0,	1,	'2016-01-21 05:45:22',	'2016-01-21 05:45:22',	0),
(2,	'header-slogan',	'<p>Огнетушители и пожарное оборудование</p>',	'header-slogan',	0,	1,	'2016-01-21 07:08:15',	'2016-01-21 07:08:15',	0),
(3,	'Баннер в колонке справа',	'',	'banner',	0,	1,	'2016-03-23 06:07:24',	'2016-03-16 05:56:05',	0),
(4,	'Прайс-листы справа',	'',	'prays-listy-sprava',	0,	1,	'2016-04-08 06:25:42',	'2016-04-08 06:25:42',	0);

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
(138,	'Горбуша серебро ПСГ',	'',	'',	'gorbusha-serebro-psg',	'р/кг',	0.00,	0.00,	'',	100,	'AR',	0,	0,	'2016-03-23 06:29:59',	'2016-03-21 07:50:57',	'ПСГ',	'3-5',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'',	'23'),
(139,	'Горбуша серебро ПБГ',	'',	'',	'gorbusha-serebro-pbg',	'р/кг',	0.00,	0.00,	'',	95,	'',	0,	0,	'2016-03-23 06:30:01',	'2016-03-21 07:51:04',	'ПБГ',	'3-5',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'',	'23'),
(140,	'Горбуша ПСГ',	'',	'',	'gorbusha-psg',	'р/кг',	150.00,	0.00,	'',	90,	'',	1,	0,	'2016-03-21 07:47:50',	'2016-03-21 07:47:50',	'ПСГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(142,	'Горбуша ПБГ',	'',	'',	'gorbusha-pbg',	'р/кг',	155.00,	0.00,	'',	85,	'AR',	1,	0,	'2016-03-21 07:49:31',	'2016-03-21 07:49:31',	'ПБГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(143,	'Кета серебро ПСГ',	'',	'',	'keta-serebro-psg',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 07:44:38',	'2016-03-21 07:44:38',	'ПСГ',	'',	'1/20-1/22',	'Меш.',	'',	'',	'',	'23'),
(144,	'Кета серебро ПБГ',	'',	'',	'keta-serebro-pbg',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 07:44:45',	'2016-03-21 07:44:45',	'ПБГ',	'',	'1/20-1/22',	'Меш.',	'',	'',	'',	'23'),
(145,	'Кета ПСГ',	'',	'',	'psg',	'р/кг',	155.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 05:13:58',	'2016-03-21 05:13:58',	'ПСГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(146,	'Кета ПБГ',	'',	'',	'keta-pbg',	'р/кг',	160.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-21 05:20:18',	'2016-03-21 05:20:18',	'ПБГ',	'3-5',	'1/20-1/22',	'Меш.',	'15.08.2015',	'Т/У',	'Николаевск',	'23'),
(147,	'Сельдь Олюторская НР',	'',	'',	'seld-olyutorskaya-nr',	'р/кг',	90.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 04:14:41',	'2016-03-22 04:14:41',	'НР',	'29+',	'1/20-1/22',	'Кор.',	'',	'Т/У',	'Владивосток',	'23'),
(148,	'Сельдь Тихоокеанская НР',	'',	'',	'seld-tikhookeanskaya-svezhemorozhenaya-nr',	'р/кг',	118.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 04:16:26',	'2016-03-22 04:16:26',	'НР',	'300-400',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Владивосток',	'23'),
(152,	'Минтай ПБГ',	'',	'',	'mintay-pbg',	'р/кг',	84.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 02:49:01',	'2016-03-22 02:49:01',	'ПБГ',	'25+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(153,	'Треска ПБГ',	'',	'',	'treska-pbg',	'р/кг',	158.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 03:15:39',	'2016-03-22 03:15:39',	'',	'0,5-1',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Сахалин',	'23'),
(154,	'Камбала ББ',	'',	'',	'kambala-bb',	'р/кг',	86.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 02:57:20',	'2016-03-22 02:57:20',	'НР',	'21+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(155,	'Навага ПБГ',	'',	'',	'navaga-pbg',	'р/кг',	67.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 03:37:28',	'2016-03-22 03:37:28',	'ПБГ',	'17+',	'1/20-1/22',	'Меш.',	'15.01.2016',	'ГОСТ',	'Камчатка',	'23'),
(157,	'Краб камчатский (мясо роза)',	'',	'',	'krab-kamchatskiy-myaso-roza',	'р/кг',	1350.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:10:20',	'2016-03-22 07:10:20',	'',	'',	'',	'вакуум 1кг.',	'',	'',	'',	'23'),
(158,	'Краб камчатский (мясо 1-я фаланга)',	'',	'',	'krab-kamchatskiy-myaso-1-ya-falanga',	'р/кг',	1850.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:10:59',	'2016-03-22 07:10:59',	'',	'8-10см.',	'',	'',	'',	'',	'',	'23'),
(159,	'Фаланга краба 2ая',	'<p><strong>Вид продукта:</strong> фаланга краба 2ая замороженная<br /><strong>Размерный ряд: <br /> Дата вылова:<br /></strong><strong>Место вылова:<br /> Вес упаковки: <br /> Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'<p><strong>Вид продукта:</strong> фаланга краба 2ая замороженная<br /><strong>Размерный ряд: <br />Дата вылова:<br /></strong><strong>Место вылова:<br />Вес упаковки: <br />Вид упаковки: </strong>вакуумная<br /><strong>Минимальная партия: </strong>5т.</p>',	'falanga-kraba-2aya',	'р/кг',	0.00,	0.00,	'',	0,	'AR',	0,	0,	'2016-03-22 07:16:14',	'2016-03-14 07:26:43',	'',	'',	'',	'',	'',	'',	'',	'23'),
(160,	'Икра красная замороженная',	'',	'',	'ikra-krasnaya-zamorozhennaya',	'р/кг',	2200.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 03:10:57',	'2016-04-07 03:10:57',	'',	'крупная',	'12',	'куботейнер',	'15 сентября',	'',	'',	'5'),
(161,	'Икра красная охлажденная',	'',	'',	'ikra-krasnaya-okhlazhdennaya',	'р/кг',	1800.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 03:11:51',	'2016-04-07 03:11:51',	'',	'крупная',	'12',	'куботейнер',	'15 сентября',	'',	'',	'5'),
(162,	'Минтай ПБГ',	'',	'',	'mintay-pbg-2',	'р/кг',	89.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:28',	'2016-03-22 02:51:01',	'ПБГ',	'30+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(163,	'Минтай НР',	'',	'',	'mintay-nr',	'р/кг',	58.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 02:52:31',	'НР',	'25+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(164,	'Минтай НР',	'',	'',	'mintay-nr-2',	'р/кг',	63.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 02:53:38',	'НР',	'30+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(165,	'Минтай НР',	'',	'',	'mintay-nr-3',	'р/кг',	68.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 02:54:41',	'НР',	'35+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(166,	'Камбала ББ (икр)',	'',	'',	'kambala-bb-ikr',	'р/кг',	185.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 03:00:16',	'НР',	'21+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Камчатка',	'23'),
(167,	'Треска ПБГ',	'',	'',	'treska-pbg-2',	'р/кг',	163.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 03:18:41',	'ПБГ',	'1-2',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Сахалин',	'23'),
(168,	'Треска ПБГ',	'',	'',	'treska-pbg-41',	'р/кг',	168.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 03:34:38',	'ПБГ',	'2+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Сахалин',	'23'),
(169,	'Треска НР',	'',	'',	'treska-nr',	'р/кг',	56.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 03:35:39',	'НР',	'20-30см.',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Сахалин',	'23'),
(170,	'Навага НР',	'',	'',	'navaga-nr',	'р/кг',	55.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 03:45:54',	'НР',	'19+',	'1/20-1/22',	'Меш.',	'',	'ГОСТ',	'Камчатка',	'23'),
(171,	'Навага НР вор.',	'',	'',	'navaga-nr-vor',	'р/кг',	53.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 03:47:20',	'НР вор.',	'23-27',	'1/25',	'Меш.',	'15.01.2016',	'ГОСТ',	'Камчатка',	'23'),
(172,	'Навага ПБГ',	'',	'',	'navaga-pbg-615',	'р/кг',	71.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:10:20',	'ПБГ',	'17+',	'1/20-1/22',	'Меш.',	'15.01.2016',	'ГОСТ',	'Сахалин',	'23'),
(173,	'Навага НР',	'',	'',	'navaga-nr-117',	'р/кг',	61.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:11:12',	'НР',	'19+',	'1/20-1/22',	'Меш.',	'15.01.2016',	'ГОСТ',	'Сахалин',	'23'),
(174,	'Навага НР вор.',	'',	'',	'navaga-nr-vor-139',	'р/кг',	51.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:11:53',	'НР вор.',	'19+',	'1/25',	'Меш.',	'15.01.2016',	'ГОСТ',	'Сахалин',	'23'),
(175,	'Сельдь Олюторская НР',	'',	'',	'seld-olyutorskaya-nr-700',	'р/кг',	85.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:15:33',	'НР',	'29+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Владивосток',	'23'),
(176,	'Сельдь Тихоокеанская НР',	'',	'',	'seld-tikhookeanskaya-nr',	'р/кг',	124.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:30:44',	'НР',	'500+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Владивосток',	'23'),
(177,	'Сельдь Тихоокеанская НР',	'',	'',	'seld-tikhookeanskaya-nr-13',	'р/кг',	61.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:31:39',	'НР',	'25+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Владивосток',	'23'),
(178,	'Сельдь Тихоокеанская НР',	'',	'',	'seld-tikhookeanskaya-nr-348',	'р/кг',	69.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 04:32:20',	'НР',	'27+',	'1/20-1/22',	'Меш.',	'',	'Т/У',	'Владивосток',	'23'),
(179,	'Креветка углохвостая магаданская',	'',	'',	'krevetka-uglokhvostaya-magadanskaya',	'р/кг',	700.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:51:26',	'2016-03-22 06:51:26',	'',	'50-70 шт/кг.',	'',	'5кг. коробка',	'',	'',	'',	'23'),
(180,	'Креветка северная сахалинская',	'',	'',	'krevetka-severnaya-sakhalinskaya',	'р/кг',	680.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:57:36',	'2016-03-22 06:57:36',	'',	'50-70 шт/кг.',	'',	'1кг. коробка',	'',	'',	'',	'23'),
(181,	'Креветка чилим (мелко средняя)',	'',	'',	'krevetka-chilim-melko-srednyaya',	'р/кг',	730.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:52:46',	'2016-03-22 06:52:46',	'',	'50-70 шт/кг.',	'',	'1кг. контейнер',	'',	'',	'',	'23'),
(182,	'Креветка чилим (крупная)',	'',	'',	'krevetka-chilim-krupnaya',	'р/кг',	1150.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 06:57:31',	'',	'20шт/кг',	'',	'1кг. контейнер',	'',	'',	'',	'23'),
(183,	'Креветка Ботан (крупная)',	'',	'',	'krevetka-botan-krupnaya',	'р/кг',	980.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:54:33',	'2016-03-22 06:54:33',	'',	'12-18 шт/кг.',	'',	'коробка',	'',	'',	'',	'23'),
(184,	'Креветка Ботан (средняя)',	'',	'',	'krevetka-botan-srednyaya',	'р/кг',	880.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:55:14',	'2016-03-22 06:55:14',	'',	'25-30 шт/кг.',	'',	'коробка',	'',	'',	'',	'23'),
(185,	'Креветка Ботан (мелкая)',	'',	'',	'krevetka-botan-melkaya',	'р/кг',	780.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:59:59',	'2016-03-22 06:55:51',	'',	'30-45 шт/кг.',	'',	'коробка',	'',	'',	'',	'23'),
(186,	'Медведка Шримс (крупная)',	'',	'',	'medvedka-shrims-krupnaya',	'р/кг',	2230.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 06:58:36',	'2016-03-22 06:58:36',	'',	'20-30 шт/кг.',	'',	'коробка',	'',	'',	'',	'23'),
(187,	'Медведка Шримс (средняя)',	'',	'',	'medvedka-shrims-srednyaya',	'р/кг',	1730.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:01:28',	'2016-03-22 07:01:28',	'',	'30-40шт/кг.',	'',	'коробка',	'',	'',	'',	'23'),
(188,	'Медведка Шримс (мелко-средняя)',	'',	'',	'medvedka-shrims-melko-srednyaya',	'р/кг',	880.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:02:00',	'2016-03-22 07:02:00',	'',	'40-50 шт/кг.',	'',	'коробка',	'',	'',	'',	'23'),
(189,	'Краб камчатский',	'',	'',	'krab-kamchatskiy-108',	'р/кг',	1130.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:05:55',	'2016-03-22 07:05:55',	'',	'3 (1кг.-12кг.)',	'',	'коробка',	'',	'',	'',	'23'),
(190,	'Краб камчатский',	'',	'',	'krab-kamchatskiy-367',	'р/кг',	1100.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:13:48',	'2016-03-22 07:06:45',	'',	'2L (700гр.-900гр.)',	'',	'коробка',	'',	'',	'',	'23'),
(191,	'Краб камчатский',	'',	'',	'krab-kamchatskiy-50',	'р/кг',	1000.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:13:48',	'2016-03-22 07:07:29',	'',	'L (500гр.-700гр.)',	'',	'коробка',	'',	'',	'',	'23'),
(192,	'Краб камчатский',	'',	'',	'krab-kamchatskiy-601',	'руб./шт.',	700.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:08:14',	'2016-03-22 07:08:14',	'',	'M (300гр.-500гр.)',	'',	'коробка',	'',	'',	'',	'23'),
(193,	'Краб камчатский (мясо салатное)',	'',	'',	'krab-kamchatskiy-myaso-salatnoe',	'р/кг',	900.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:09:53',	'2016-03-22 07:09:53',	'',	'',	'',	'вакуум 1кг.',	'',	'',	'',	'23'),
(194,	'Краб камчатский (мясо 1-я фаланга)',	'',	'',	'krab-kamchatskiy-myaso-1-ya-falanga-648',	'руб./шт.',	2250.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:12:43',	'2016-03-22 07:12:43',	'',	'10-12см.',	'',	'вакуум 1кг.',	'',	'',	'',	'23'),
(195,	'Краб камчатский (мясо 1-я фаланга)',	'',	'',	'krab-kamchatskiy-myaso-1-ya-falanga-928',	'р/кг',	2850.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:13:31',	'2016-03-22 07:13:31',	'',	'12+см.',	'',	'вакуум 1кг.',	'',	'',	'',	'23'),
(196,	'Краб камчатский (подарочный)',	'',	'',	'krab-kamchatskiy-podarochnyy',	'р/кг',	980.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-22 07:14:45',	'2016-03-22 07:14:45',	'',	'2,5кг.-4кг.',	'',	'коробка',	'',	'',	'',	'23'),
(197,	'Осьминог Приморский',	'',	'',	'osminog-primorskiy',	'р/кг',	380.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:18:43',	'2016-04-07 04:18:43',	'',	'4-8 кг.',	'',	'вакуум',	'',	'',	'',	'5'),
(198,	'Осьминог Пикантный Варено мороженный',	'',	'',	'osminog-pikantnyy-vareno-morozhennyy',	'р/кг',	1430.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:52:00',	'2016-04-07 04:52:00',	'',	'',	'',	'вакуум',	'',	'',	'',	'5'),
(199,	'Трепанг Приморский на меду липа',	'',	'',	'trepang-primorskiy-na-medu-lipa',	'руб./шт.',	1230.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:51:57',	'2016-04-07 04:51:57',	'',	'50% на 50%',	'',	'1кг. ведро',	'',	'',	'',	'5'),
(200,	'Мидия Приморская чищенная',	'',	'',	'midiya-primorskaya-chishchennaya',	'р/кг',	450.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:48:32',	'2016-04-07 04:48:32',	'',	'',	'',	'вакуум 1кг.',	'',	'',	'',	'5'),
(201,	'Устрица Приморская',	'',	'',	'ustritsa-primorskaya',	'руб./шт.',	75.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:40:30',	'2016-04-07 04:40:30',	'',	'',	'',	'',	'',	'',	'',	'5'),
(202,	'Гребешок Северокурильский',	'',	'',	'grebeshok-severokurilskiy',	'руб./шт.',	1280.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:42:23',	'2016-04-07 04:42:23',	'',	'15гр. шт.',	'',	'Вакуум 0,5-1кг.',	'',	'',	'',	'5'),
(203,	'Гребешок Приморский',	'',	'',	'grebeshok-primorskiy',	'руб./шт.',	1550.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:51:10',	'2016-04-07 04:51:10',	'',	'60-80гр. шт.',	'',	'вакуум 1кг.',	'',	'',	'',	'5'),
(204,	'Гребешок в ракушке шоковой заморозки',	'',	'',	'grebeshok-v-rakushke-shokovoy-zamorozki',	'руб./шт.',	350.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-04-07 04:48:14',	'2016-04-07 04:48:14',	'',	'4-5шт. кг.',	'',	'1кг.',	'',	'',	'',	'5');

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
(297,	'Краб',	'',	'',	'catalog',	0,	1,	'krab',	1,	-80,	1,	'2016-03-11 07:12:02',	'2016-03-22 06:35:34'),
(298,	'Икра лососёвая',	'',	'',	'catalog',	0,	1,	'ikra-lososevaya',	1,	-100,	1,	'2016-03-11 07:12:21',	'2016-03-11 07:12:21'),
(299,	'Горбуша',	'',	'',	'catalog',	0,	1,	'gorbusha',	1,	90,	1,	'2016-03-18 03:01:23',	'2016-03-18 05:27:08'),
(300,	'Кета',	'',	'',	'catalog',	0,	1,	'keta',	1,	100,	1,	'2016-03-18 03:01:31',	'2016-03-18 03:01:31'),
(301,	'Минтай',	'',	'',	'catalog',	0,	1,	'mintay',	1,	0,	1,	'2016-03-21 07:52:19',	'2016-03-21 07:52:19'),
(302,	'Треска',	'',	'',	'catalog',	0,	1,	'treska',	1,	0,	1,	'2016-03-21 07:52:30',	'2016-03-21 07:52:30'),
(303,	'Камбала',	'',	'',	'catalog',	0,	1,	'kambala',	1,	0,	1,	'2016-03-21 07:52:45',	'2016-03-21 07:52:45'),
(304,	'Навага',	'',	'',	'catalog',	0,	1,	'navaga',	1,	0,	1,	'2016-03-21 07:52:53',	'2016-03-21 07:52:53'),
(305,	'Креветка',	'',	'',	'catalog',	0,	1,	'krevetka',	1,	-90,	1,	'2016-03-22 06:35:08',	'2016-03-22 06:52:06'),
(306,	'Осьминог',	'',	'',	'catalog',	0,	1,	'osminog',	1,	-110,	1,	'2016-04-07 04:14:25',	'2016-04-07 04:14:25'),
(307,	'Трепанг',	'',	'',	'catalog',	0,	1,	'trepang',	1,	-120,	1,	'2016-04-07 04:26:58',	'2016-04-07 04:26:58'),
(308,	'Гребешок',	'',	'',	'catalog',	0,	1,	'grebeshok',	1,	-130,	1,	'2016-04-07 04:27:12',	'2016-04-07 04:27:12'),
(309,	'Мидия',	'',	'',	'catalog',	0,	1,	'midiya',	1,	-140,	1,	'2016-04-07 04:27:50',	'2016-04-07 04:27:50'),
(310,	'Устрица',	'',	'',	'catalog',	0,	1,	'ustritsa',	1,	-150,	1,	'2016-04-07 04:27:54',	'2016-04-07 04:27:54');

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
(297,	159,	'2016-03-14 07:26:43',	'0000-00-00 00:00:00'),
(300,	146,	'2016-03-21 05:20:18',	'0000-00-00 00:00:00'),
(300,	145,	'2016-03-21 05:31:41',	'0000-00-00 00:00:00'),
(300,	143,	'2016-03-21 07:44:38',	'0000-00-00 00:00:00'),
(300,	144,	'2016-03-21 07:44:45',	'0000-00-00 00:00:00'),
(299,	140,	'2016-03-21 07:47:50',	'0000-00-00 00:00:00'),
(299,	142,	'2016-03-21 07:49:31',	'0000-00-00 00:00:00'),
(299,	138,	'2016-03-21 07:50:57',	'0000-00-00 00:00:00'),
(299,	139,	'2016-03-21 07:51:04',	'0000-00-00 00:00:00'),
(301,	152,	'2016-03-22 02:49:01',	'0000-00-00 00:00:00'),
(301,	162,	'2016-03-22 02:51:01',	'0000-00-00 00:00:00'),
(301,	163,	'2016-03-22 02:52:31',	'0000-00-00 00:00:00'),
(301,	164,	'2016-03-22 02:53:38',	'0000-00-00 00:00:00'),
(301,	165,	'2016-03-22 02:54:41',	'0000-00-00 00:00:00'),
(303,	154,	'2016-03-22 02:57:20',	'0000-00-00 00:00:00'),
(303,	166,	'2016-03-22 03:00:16',	'0000-00-00 00:00:00'),
(302,	153,	'2016-03-22 03:15:39',	'0000-00-00 00:00:00'),
(302,	167,	'2016-03-22 03:18:41',	'0000-00-00 00:00:00'),
(302,	168,	'2016-03-22 03:34:38',	'0000-00-00 00:00:00'),
(302,	169,	'2016-03-22 03:35:39',	'0000-00-00 00:00:00'),
(304,	155,	'2016-03-22 03:37:28',	'0000-00-00 00:00:00'),
(304,	170,	'2016-03-22 03:45:54',	'0000-00-00 00:00:00'),
(304,	171,	'2016-03-22 03:47:20',	'0000-00-00 00:00:00'),
(304,	172,	'2016-03-22 04:10:21',	'0000-00-00 00:00:00'),
(304,	173,	'2016-03-22 04:11:12',	'0000-00-00 00:00:00'),
(304,	174,	'2016-03-22 04:11:53',	'0000-00-00 00:00:00'),
(296,	147,	'2016-03-22 04:14:41',	'0000-00-00 00:00:00'),
(296,	175,	'2016-03-22 04:15:33',	'0000-00-00 00:00:00'),
(296,	148,	'2016-03-22 04:16:26',	'0000-00-00 00:00:00'),
(296,	176,	'2016-03-22 04:30:44',	'0000-00-00 00:00:00'),
(296,	177,	'2016-03-22 04:31:39',	'0000-00-00 00:00:00'),
(296,	178,	'2016-03-22 04:32:20',	'0000-00-00 00:00:00'),
(305,	179,	'2016-03-22 06:51:26',	'0000-00-00 00:00:00'),
(305,	181,	'2016-03-22 06:52:46',	'0000-00-00 00:00:00'),
(305,	183,	'2016-03-22 06:54:33',	'0000-00-00 00:00:00'),
(305,	184,	'2016-03-22 06:55:14',	'0000-00-00 00:00:00'),
(305,	185,	'2016-03-22 06:55:51',	'0000-00-00 00:00:00'),
(305,	182,	'2016-03-22 06:57:31',	'0000-00-00 00:00:00'),
(305,	186,	'2016-03-22 06:58:36',	'0000-00-00 00:00:00'),
(305,	187,	'2016-03-22 07:01:28',	'0000-00-00 00:00:00'),
(305,	188,	'2016-03-22 07:02:00',	'0000-00-00 00:00:00'),
(305,	180,	'2016-03-22 07:02:50',	'0000-00-00 00:00:00'),
(297,	189,	'2016-03-22 07:05:55',	'0000-00-00 00:00:00'),
(297,	190,	'2016-03-22 07:06:45',	'0000-00-00 00:00:00'),
(297,	191,	'2016-03-22 07:07:29',	'0000-00-00 00:00:00'),
(297,	192,	'2016-03-22 07:08:14',	'0000-00-00 00:00:00'),
(297,	193,	'2016-03-22 07:09:53',	'0000-00-00 00:00:00'),
(297,	157,	'2016-03-22 07:10:20',	'0000-00-00 00:00:00'),
(297,	158,	'2016-03-22 07:10:59',	'0000-00-00 00:00:00'),
(297,	194,	'2016-03-22 07:12:43',	'0000-00-00 00:00:00'),
(297,	195,	'2016-03-22 07:13:31',	'0000-00-00 00:00:00'),
(297,	196,	'2016-03-22 07:14:45',	'0000-00-00 00:00:00'),
(298,	160,	'2016-04-07 03:10:57',	'0000-00-00 00:00:00'),
(298,	161,	'2016-04-07 03:11:51',	'0000-00-00 00:00:00'),
(306,	197,	'2016-04-07 04:18:43',	'0000-00-00 00:00:00'),
(310,	201,	'2016-04-07 04:40:30',	'0000-00-00 00:00:00'),
(308,	202,	'2016-04-07 04:42:23',	'0000-00-00 00:00:00'),
(309,	200,	'2016-04-07 04:48:32',	'0000-00-00 00:00:00'),
(308,	204,	'2016-04-07 04:50:07',	'0000-00-00 00:00:00'),
(308,	203,	'2016-04-07 04:51:10',	'0000-00-00 00:00:00'),
(307,	199,	'2016-04-07 04:51:57',	'0000-00-00 00:00:00'),
(306,	198,	'2016-04-07 04:52:00',	'0000-00-00 00:00:00');

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
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `feed_category_foreign` (`category`),
  CONSTRAINT `feed_category_foreign` FOREIGN KEY (`category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `feed` (`id`, `title`, `category`, `short`, `description`, `url`, `date`, `position`, `active`, `created_at`, `updated_at`, `user_id`) VALUES
(8,	'Оптовая продажа рыбы и дальневосточных морепродуктов',	2,	'<p>Оптовая продажа рыбы и дальневосточных морепродуктов</p>',	'',	'mainfish432',	'2016-03-17 00:00:00',	100,	1,	'2016-03-17 05:32:45',	'2016-04-11 03:35:32',	1),
(11,	'Оптовая продажа тихоокеанской сельди',	2,	'',	'',	'optovaya-prodazha-tikhookeanskoy-seldi',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:35:53',	'2016-04-11 03:36:42',	1),
(12,	'Продажа дальневосточной кеты оптом',	2,	'',	'',	'prodazha-dalnevostochnoy-kety-optom',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:36:48',	'2016-04-11 03:37:30',	1),
(13,	'Реализуем минтай оптом',	2,	'',	'',	'chernovik-stranitsy',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:37:35',	'2016-04-11 03:37:59',	1),
(14,	'Продажа дальневосточной горбуши оптом',	2,	'',	'',	'prodazha-dalnevostochnoy-gorbushi-optom',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:38:54',	'2016-04-11 03:43:25',	1),
(15,	'Продаем камбалу оптом. Партии от 23 тонн',	2,	'',	'',	'prodaem-kambalu-optom-partii-ot-23-tonn',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:43:40',	'2016-04-11 03:45:05',	1),
(16,	'Продажа креведки в коробках и контейнерах',	2,	'',	'',	'prodazha-krevedki-v-korobkakh-i-konteynerakh',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:45:12',	'2016-04-11 03:45:41',	1),
(17,	'Купить красную икру оптом',	2,	'',	'',	'kupit-krasnuyu-ikru-optom',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:45:49',	'2016-04-11 03:46:24',	1),
(18,	'Продажа камчатского краба оптом',	2,	'',	'',	'prodazha-kamchatskogo-kraba-optom',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:46:31',	'2016-04-11 03:46:45',	1),
(19,	'Реализуем навагу оптом. Вылов: Сахалин, Камчатка',	2,	'',	'',	'chernovik-stranitsy-258',	'2016-04-11 00:00:00',	0,	1,	'2016-04-11 03:46:50',	'2016-04-11 03:47:28',	1);

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
(140,	138,	'App\\Models\\Catalog',	'images',	'Catalog-138-gorbuha-ser-psbpng',	'Catalog-138-gorbuha-ser-psbpng.png',	'media',	64635,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	117,	'2016-03-14 04:56:10',	'2016-03-14 04:56:10'),
(142,	140,	'App\\Models\\Catalog',	'images',	'Catalog-140-gorbuha-psgpng',	'Catalog-140-gorbuha-psgpng.png',	'media',	49756,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	109,	'2016-03-14 05:12:49',	'2016-03-14 05:12:49'),
(144,	142,	'App\\Models\\Catalog',	'images',	'Catalog-142-gorbuha-psgpng',	'Catalog-142-gorbuha-psgpng.png',	'media',	49756,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	111,	'2016-03-14 05:24:54',	'2016-03-14 05:24:54'),
(145,	139,	'App\\Models\\Catalog',	'images',	'Catalog-139-gorbuha-ser-psbpng',	'Catalog-139-gorbuha-ser-psbpng.png',	'media',	64635,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	112,	'2016-03-14 05:49:10',	'2016-03-14 05:49:10'),
(147,	143,	'App\\Models\\Catalog',	'images',	'Catalog-143-keta-serebpng',	'Catalog-143-keta-serebpng.png',	'media',	67245,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	114,	'2016-03-14 05:59:28',	'2016-03-14 05:59:28'),
(149,	144,	'App\\Models\\Catalog',	'images',	'Catalog-144-keta-serebpng',	'Catalog-144-keta-serebpng.png',	'media',	67245,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	116,	'2016-03-14 06:00:58',	'2016-03-14 06:00:58'),
(151,	145,	'App\\Models\\Catalog',	'images',	'Catalog-145-keta-psgpng',	'Catalog-145-keta-psgpng.png',	'media',	58389,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	118,	'2016-03-14 06:08:37',	'2016-03-14 06:08:37'),
(153,	146,	'App\\Models\\Catalog',	'images',	'Catalog-146-keta-psgpng',	'Catalog-146-keta-psgpng.png',	'media',	58389,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	120,	'2016-03-14 06:10:08',	'2016-03-14 06:10:08'),
(155,	147,	'App\\Models\\Catalog',	'images',	'Catalog-147-seld-olutpng',	'Catalog-147-seld-olutpng.png',	'media',	59920,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	82,	'2016-03-14 06:11:52',	'2016-03-14 06:11:52'),
(168,	154,	'App\\Models\\Catalog',	'images',	'Catalog-154-kambalapng',	'Catalog-154-kambalapng.png',	'media',	86485,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	131,	'2016-03-14 07:05:00',	'2016-03-14 07:05:00'),
(170,	155,	'App\\Models\\Catalog',	'images',	'Catalog-155-navagapng',	'Catalog-155-navagapng.png',	'media',	38384,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	132,	'2016-03-14 07:07:35',	'2016-03-14 07:07:35'),
(175,	158,	'App\\Models\\Catalog',	'images',	'Catalog-158-falang-1png',	'Catalog-158-falang-1png.png',	'media',	70150,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	135,	'2016-03-14 07:25:44',	'2016-03-14 07:25:44'),
(177,	159,	'App\\Models\\Catalog',	'images',	'Catalog-159-falang-2png',	'Catalog-159-falang-2png.png',	'media',	76480,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	137,	'2016-03-14 07:26:36',	'2016-03-14 07:26:36'),
(186,	148,	'App\\Models\\Catalog',	'images',	'Catalog-148-seld-tihookpng',	'Catalog-148-seld-tihookpng.png',	'media',	56719,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	100,	'2016-03-15 05:20:08',	'2016-03-15 05:20:08'),
(187,	157,	'App\\Models\\Catalog',	'images',	'Catalog-157-rozapng',	'Catalog-157-rozapng.png',	'media',	60518,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	143,	'2016-03-15 08:06:19',	'2016-03-15 08:06:19'),
(190,	161,	'App\\Models\\Catalog',	'images',	'Catalog-161-ikra-tovar-1png',	'Catalog-161-ikra-tovar-1png.png',	'media',	42315,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	144,	'2016-03-16 03:54:22',	'2016-03-16 03:54:22'),
(191,	160,	'App\\Models\\Catalog',	'images',	'Catalog-160-ikra-tovar-1png',	'Catalog-160-ikra-tovar-1png.png',	'media',	42315,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	145,	'2016-03-16 03:54:28',	'2016-03-16 03:54:28'),
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
(211,	159,	'App\\Models\\Catalog',	'images',	'Catalog-159-riba-15jpg',	'Catalog-159-riba-15jpg.jpg',	'media',	27067,	'[]',	'[]',	61,	'2016-03-17 04:55:09',	'2016-03-17 04:55:09'),
(212,	157,	'App\\Models\\Catalog',	'images',	'Catalog-157-riba-16jpg',	'Catalog-157-riba-16jpg.jpg',	'media',	32142,	'[]',	'[]',	62,	'2016-03-17 04:56:41',	'2016-03-17 04:56:41'),
(213,	158,	'App\\Models\\Catalog',	'images',	'Catalog-158-riba-17jpg',	'Catalog-158-riba-17jpg.jpg',	'media',	16194,	'[]',	'[]',	63,	'2016-03-17 04:58:39',	'2016-03-17 04:58:39'),
(214,	160,	'App\\Models\\Catalog',	'images',	'Catalog-160-riba-18jpg',	'Catalog-160-riba-18jpg.jpg',	'media',	56217,	'[]',	'[]',	64,	'2016-03-17 05:07:02',	'2016-03-17 05:07:02'),
(215,	161,	'App\\Models\\Catalog',	'images',	'Catalog-161-riba-19jpg',	'Catalog-161-riba-19jpg.jpg',	'media',	40891,	'[]',	'[]',	65,	'2016-03-17 05:07:09',	'2016-03-17 05:07:09'),
(216,	147,	'App\\Models\\Catalog',	'images',	'Catalog-147-riba-09jpg',	'Catalog-147-riba-09jpg.jpg',	'media',	35317,	'[]',	'[]',	66,	'2016-03-17 05:10:42',	'2016-03-17 05:10:42'),
(217,	148,	'App\\Models\\Catalog',	'images',	'Catalog-148-seld-tojpg',	'Catalog-148-seld-tojpg.jpg',	'media',	44583,	'[]',	'{\"alt\":null,\"gallery\":null}',	0,	'2016-03-17 05:10:44',	'2016-03-17 05:10:44'),
(218,	299,	'App\\Models\\Category',	'images',	'Category-299-gorbuhapng',	'Category-299-gorbuhapng.png',	'media',	59444,	'[]',	'[]',	68,	'2016-03-18 04:57:18',	'2016-03-18 04:57:18'),
(219,	300,	'App\\Models\\Category',	'images',	'Category-300-ketapng',	'Category-300-ketapng.png',	'media',	56150,	'[]',	'[]',	69,	'2016-03-18 04:57:26',	'2016-03-18 04:57:26'),
(221,	25,	'App\\Models\\Page',	'files',	'Page-25-flk96dgiltyb9png',	'Page-25-flk96dgiltyb9png.png',	'media',	1288,	'[]',	'[]',	70,	'2016-03-21 03:07:47',	'2016-03-21 03:07:47'),
(223,	25,	'App\\Models\\Page',	'images',	'Page-25-arlainpng',	'Page-25-arlainpng.png',	'media',	5378,	'[]',	'[]',	72,	'2016-03-21 03:15:27',	'2016-03-21 03:15:27'),
(224,	27,	'App\\Models\\Page',	'images',	'Page-27-foto-karabljpg',	'Page-27-foto-karabljpg.jpg',	'media',	94486,	'[]',	'{\"alt\":\"\",\"gallery\":\"onas\",\"position\":\"0\"}',	73,	'2016-03-21 03:20:27',	'2016-03-21 03:20:27'),
(237,	166,	'App\\Models\\Catalog',	'images',	'Catalog-166-kambalapng',	'Catalog-166-kambalapng.png',	'media',	86485,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	178,	'2016-03-22 03:00:04',	'2016-03-22 03:00:04'),
(238,	166,	'App\\Models\\Catalog',	'images',	'Catalog-166-riba-12jpg',	'Catalog-166-riba-12jpg.jpg',	'media',	28382,	'[]',	'[]',	79,	'2016-03-22 03:00:04',	'2016-03-22 03:00:04'),
(240,	167,	'App\\Models\\Catalog',	'images',	'Catalog-167-riba-11jpg',	'Catalog-167-riba-11jpg.jpg',	'media',	34585,	'[]',	'[]',	80,	'2016-03-22 03:18:11',	'2016-03-22 03:18:11'),
(242,	168,	'App\\Models\\Catalog',	'images',	'Catalog-168-riba-11jpg',	'Catalog-168-riba-11jpg.jpg',	'media',	34585,	'[]',	'[]',	81,	'2016-03-22 03:34:34',	'2016-03-22 03:34:34'),
(244,	170,	'App\\Models\\Catalog',	'images',	'Catalog-170-navagapng',	'Catalog-170-navagapng.png',	'media',	38384,	'[]',	'[]',	83,	'2016-03-22 03:45:50',	'2016-03-22 03:45:50'),
(245,	171,	'App\\Models\\Catalog',	'images',	'Catalog-171-navagapng',	'Catalog-171-navagapng.png',	'media',	38384,	'[]',	'[]',	84,	'2016-03-22 03:47:17',	'2016-03-22 03:47:17'),
(246,	172,	'App\\Models\\Catalog',	'images',	'Catalog-172-navagapng',	'Catalog-172-navagapng.png',	'media',	38384,	'[]',	'[]',	85,	'2016-03-22 04:10:17',	'2016-03-22 04:10:17'),
(247,	173,	'App\\Models\\Catalog',	'images',	'Catalog-173-navagapng',	'Catalog-173-navagapng.png',	'media',	38384,	'[]',	'[]',	86,	'2016-03-22 04:11:08',	'2016-03-22 04:11:08'),
(248,	174,	'App\\Models\\Catalog',	'images',	'Catalog-174-navagapng',	'Catalog-174-navagapng.png',	'media',	38384,	'[]',	'[]',	87,	'2016-03-22 04:11:49',	'2016-03-22 04:11:49'),
(249,	175,	'App\\Models\\Catalog',	'images',	'Catalog-175-seld-olutpng',	'Catalog-175-seld-olutpng.png',	'media',	59920,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	89,	'2016-03-22 04:15:25',	'2016-03-22 04:15:25'),
(250,	175,	'App\\Models\\Catalog',	'images',	'Catalog-175-riba-09jpg',	'Catalog-175-riba-09jpg.jpg',	'media',	35258,	'[]',	'[]',	88,	'2016-03-22 04:15:25',	'2016-03-22 04:15:25'),
(260,	304,	'App\\Models\\Category',	'images',	'Category-304-navagapng',	'Category-304-navagapng.png',	'media',	38384,	'[]',	'[]',	185,	'2016-03-22 06:33:49',	'2016-03-22 06:33:49'),
(261,	303,	'App\\Models\\Category',	'images',	'Category-303-kambalapng',	'Category-303-kambalapng.png',	'media',	86485,	'[]',	'[]',	186,	'2016-03-22 06:34:12',	'2016-03-22 06:34:12'),
(262,	305,	'App\\Models\\Category',	'images',	'Category-305-krevedka-obhaiapng',	'Category-305-krevedka-obhaiapng.png',	'media',	46155,	'[]',	'[]',	187,	'2016-03-22 06:35:17',	'2016-03-22 06:35:17'),
(264,	179,	'App\\Models\\Catalog',	'images',	'Catalog-179-krevedka-uglohvostpng',	'Catalog-179-krevedka-uglohvostpng.png',	'media',	36722,	'[]',	'[]',	188,	'2016-03-22 06:48:47',	'2016-03-22 06:48:47'),
(266,	181,	'App\\Models\\Catalog',	'images',	'Catalog-181-krevedka-hilimpng',	'Catalog-181-krevedka-hilimpng.png',	'media',	49814,	'[]',	'[]',	190,	'2016-03-22 06:52:42',	'2016-03-22 06:52:42'),
(267,	182,	'App\\Models\\Catalog',	'images',	'Catalog-182-krevedka-hilimpng',	'Catalog-182-krevedka-hilimpng.png',	'media',	49814,	'[]',	'[]',	191,	'2016-03-22 06:53:26',	'2016-03-22 06:53:26'),
(268,	183,	'App\\Models\\Catalog',	'images',	'Catalog-183-krevedka-botan-severnaiapng',	'Catalog-183-krevedka-botan-severnaiapng.png',	'media',	57235,	'[]',	'[]',	192,	'2016-03-22 06:54:26',	'2016-03-22 06:54:26'),
(269,	184,	'App\\Models\\Catalog',	'images',	'Catalog-184-krevedka-botan-severnaiapng',	'Catalog-184-krevedka-botan-severnaiapng.png',	'media',	57235,	'[]',	'[]',	193,	'2016-03-22 06:55:10',	'2016-03-22 06:55:10'),
(270,	185,	'App\\Models\\Catalog',	'images',	'Catalog-185-krevedka-botan-severnaiapng',	'Catalog-185-krevedka-botan-severnaiapng.png',	'media',	57235,	'[]',	'[]',	194,	'2016-03-22 06:55:48',	'2016-03-22 06:55:48'),
(271,	301,	'App\\Models\\Category',	'images',	'Category-301-mintai-1png',	'Category-301-mintai-1png.png',	'media',	46310,	'[]',	'[]',	195,	'2016-03-22 06:56:15',	'2016-03-22 06:56:15'),
(272,	152,	'App\\Models\\Catalog',	'images',	'Catalog-152-mintai-1png',	'Catalog-152-mintai-1png.png',	'media',	46310,	'[]',	'[]',	196,	'2016-03-22 06:56:32',	'2016-03-22 06:56:32'),
(273,	162,	'App\\Models\\Catalog',	'images',	'Catalog-162-mintai-1png',	'Catalog-162-mintai-1png.png',	'media',	46310,	'[]',	'[]',	197,	'2016-03-22 06:56:45',	'2016-03-22 06:56:45'),
(274,	163,	'App\\Models\\Catalog',	'images',	'Catalog-163-mintai-1png',	'Catalog-163-mintai-1png.png',	'media',	46310,	'[]',	'[]',	198,	'2016-03-22 06:56:50',	'2016-03-22 06:56:50'),
(275,	164,	'App\\Models\\Catalog',	'images',	'Catalog-164-mintai-1png',	'Catalog-164-mintai-1png.png',	'media',	46310,	'[]',	'[]',	199,	'2016-03-22 06:56:58',	'2016-03-22 06:56:58'),
(276,	165,	'App\\Models\\Catalog',	'images',	'Catalog-165-mintai-1png',	'Catalog-165-mintai-1png.png',	'media',	46310,	'[]',	'[]',	200,	'2016-03-22 06:57:06',	'2016-03-22 06:57:06'),
(277,	186,	'App\\Models\\Catalog',	'images',	'Catalog-186-medvedkapng',	'Catalog-186-medvedkapng.png',	'media',	60073,	'[]',	'[]',	201,	'2016-03-22 06:58:33',	'2016-03-22 06:58:33'),
(278,	187,	'App\\Models\\Catalog',	'images',	'Catalog-187-medvedkapng',	'Catalog-187-medvedkapng.png',	'media',	60073,	'[]',	'[]',	202,	'2016-03-22 07:01:25',	'2016-03-22 07:01:25'),
(279,	188,	'App\\Models\\Catalog',	'images',	'Catalog-188-medvedkapng',	'Catalog-188-medvedkapng.png',	'media',	60073,	'[]',	'[]',	203,	'2016-03-22 07:02:07',	'2016-03-22 07:02:07'),
(280,	180,	'App\\Models\\Catalog',	'images',	'Catalog-180-krevedka-severnaiapng',	'Catalog-180-krevedka-severnaiapng.png',	'media',	64986,	'[]',	'[]',	204,	'2016-03-22 07:02:47',	'2016-03-22 07:02:47'),
(281,	189,	'App\\Models\\Catalog',	'images',	'Catalog-189-riba-14jpg',	'Catalog-189-riba-14jpg.jpg',	'media',	38895,	'[]',	'[]',	205,	'2016-03-22 07:04:50',	'2016-03-22 07:04:50'),
(282,	189,	'App\\Models\\Catalog',	'images',	'Catalog-189-krabb-1png',	'Catalog-189-krabb-1png.png',	'media',	96755,	'[]',	'[]',	206,	'2016-03-22 07:04:50',	'2016-03-22 07:04:50'),
(283,	190,	'App\\Models\\Catalog',	'images',	'Catalog-190-riba-14jpg',	'Catalog-190-riba-14jpg.jpg',	'media',	38895,	'[]',	'[]',	207,	'2016-03-22 07:06:41',	'2016-03-22 07:06:41'),
(284,	190,	'App\\Models\\Catalog',	'images',	'Catalog-190-krabb-1png',	'Catalog-190-krabb-1png.png',	'media',	96755,	'[]',	'[]',	208,	'2016-03-22 07:06:41',	'2016-03-22 07:06:41'),
(285,	191,	'App\\Models\\Catalog',	'images',	'Catalog-191-riba-14jpg',	'Catalog-191-riba-14jpg.jpg',	'media',	38895,	'[]',	'[]',	209,	'2016-03-22 07:07:24',	'2016-03-22 07:07:24'),
(286,	191,	'App\\Models\\Catalog',	'images',	'Catalog-191-krabb-1png',	'Catalog-191-krabb-1png.png',	'media',	96755,	'[]',	'[]',	210,	'2016-03-22 07:07:24',	'2016-03-22 07:07:24'),
(287,	192,	'App\\Models\\Catalog',	'images',	'Catalog-192-riba-14jpg',	'Catalog-192-riba-14jpg.jpg',	'media',	38895,	'[]',	'[]',	211,	'2016-03-22 07:08:08',	'2016-03-22 07:08:08'),
(288,	192,	'App\\Models\\Catalog',	'images',	'Catalog-192-krabb-1png',	'Catalog-192-krabb-1png.png',	'media',	96755,	'[]',	'[]',	212,	'2016-03-22 07:08:08',	'2016-03-22 07:08:08'),
(289,	194,	'App\\Models\\Catalog',	'images',	'Catalog-194-riba-17jpg',	'Catalog-194-riba-17jpg.jpg',	'media',	16174,	'[]',	'[]',	213,	'2016-03-22 07:12:31',	'2016-03-22 07:12:31'),
(290,	194,	'App\\Models\\Catalog',	'images',	'Catalog-194-falang-1png',	'Catalog-194-falang-1png.png',	'media',	70150,	'[]',	'[]',	214,	'2016-03-22 07:12:31',	'2016-03-22 07:12:31'),
(291,	195,	'App\\Models\\Catalog',	'images',	'Catalog-195-riba-17jpg',	'Catalog-195-riba-17jpg.jpg',	'media',	16174,	'[]',	'[]',	215,	'2016-03-22 07:13:22',	'2016-03-22 07:13:22'),
(292,	195,	'App\\Models\\Catalog',	'images',	'Catalog-195-falang-1png',	'Catalog-195-falang-1png.png',	'media',	70150,	'[]',	'[]',	216,	'2016-03-22 07:13:22',	'2016-03-22 07:13:22'),
(293,	196,	'App\\Models\\Catalog',	'images',	'Catalog-196-krabb-1png',	'Catalog-196-krabb-1png.png',	'media',	96755,	'[]',	'[]',	217,	'2016-03-22 07:14:42',	'2016-03-22 07:14:42'),
(294,	176,	'App\\Models\\Catalog',	'images',	'Catalog-176-seld-tihookpng',	'Catalog-176-seld-tihookpng.png',	'media',	56719,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	219,	'2016-03-22 07:18:42',	'2016-03-22 07:18:42'),
(295,	176,	'App\\Models\\Catalog',	'images',	'Catalog-176-seld-tojpg',	'Catalog-176-seld-tojpg.jpg',	'media',	44499,	'[]',	'[]',	218,	'2016-03-22 07:18:42',	'2016-03-22 07:18:42'),
(296,	178,	'App\\Models\\Catalog',	'images',	'Catalog-178-seld-tojpg',	'Catalog-178-seld-tojpg.jpg',	'media',	44499,	'[]',	'[]',	220,	'2016-03-22 07:19:06',	'2016-03-22 07:19:06'),
(297,	178,	'App\\Models\\Catalog',	'images',	'Catalog-178-seld-tihookpng',	'Catalog-178-seld-tihookpng.png',	'media',	56719,	'[]',	'[]',	221,	'2016-03-22 07:19:06',	'2016-03-22 07:19:06'),
(298,	177,	'App\\Models\\Catalog',	'images',	'Catalog-177-seld-tojpg',	'Catalog-177-seld-tojpg.jpg',	'media',	44499,	'[]',	'[]',	222,	'2016-03-22 07:19:10',	'2016-03-22 07:19:10'),
(299,	177,	'App\\Models\\Catalog',	'images',	'Catalog-177-seld-tihookpng',	'Catalog-177-seld-tihookpng.png',	'media',	56719,	'[]',	'[]',	223,	'2016-03-22 07:19:10',	'2016-03-22 07:19:10'),
(300,	193,	'App\\Models\\Catalog',	'images',	'Catalog-193-krab-salatpng',	'Catalog-193-krab-salatpng.png',	'media',	65992,	'[]',	'[]',	224,	'2016-04-07 03:05:00',	'2016-04-07 03:05:00'),
(301,	198,	'App\\Models\\Catalog',	'images',	'Catalog-198-osm-morpng',	'Catalog-198-osm-morpng.png',	'media',	91522,	'[]',	'[]',	225,	'2016-04-07 04:17:40',	'2016-04-07 04:17:40'),
(302,	197,	'App\\Models\\Catalog',	'images',	'Catalog-197-osmpng',	'Catalog-197-osmpng.png',	'media',	78771,	'[]',	'[]',	226,	'2016-04-07 04:18:37',	'2016-04-07 04:18:37'),
(303,	306,	'App\\Models\\Category',	'images',	'Category-306-osmpng',	'Category-306-osmpng.png',	'media',	78771,	'[]',	'[]',	227,	'2016-04-07 04:19:11',	'2016-04-07 04:19:11'),
(304,	199,	'App\\Models\\Catalog',	'images',	'Catalog-199-tripangpng',	'Catalog-199-tripangpng.png',	'media',	95167,	'[]',	'[]',	228,	'2016-04-07 04:29:10',	'2016-04-07 04:29:10'),
(305,	307,	'App\\Models\\Category',	'images',	'Category-307-tripangpng',	'Category-307-tripangpng.png',	'media',	95167,	'[]',	'[]',	229,	'2016-04-07 04:33:35',	'2016-04-07 04:33:35'),
(306,	200,	'App\\Models\\Catalog',	'images',	'Catalog-200-modii-2png',	'Catalog-200-modii-2png.png',	'media',	80146,	'[]',	'[]',	230,	'2016-04-07 04:39:19',	'2016-04-07 04:39:19'),
(307,	309,	'App\\Models\\Category',	'images',	'Category-309-modii-3png',	'Category-309-modii-3png.png',	'media',	73385,	'[]',	'[]',	231,	'2016-04-07 04:39:40',	'2016-04-07 04:39:40'),
(308,	201,	'App\\Models\\Catalog',	'images',	'Catalog-201-ustr-1png',	'Catalog-201-ustr-1png.png',	'media',	76556,	'[]',	'[]',	232,	'2016-04-07 04:40:24',	'2016-04-07 04:40:24'),
(309,	310,	'App\\Models\\Category',	'images',	'Category-310-ustr-2png',	'Category-310-ustr-2png.png',	'media',	67043,	'[]',	'[]',	233,	'2016-04-07 04:40:43',	'2016-04-07 04:40:43'),
(311,	202,	'App\\Models\\Catalog',	'images',	'Catalog-202-greb-1png',	'Catalog-202-greb-1png.png',	'media',	54929,	'[]',	'[]',	235,	'2016-04-07 04:42:20',	'2016-04-07 04:42:20'),
(312,	203,	'App\\Models\\Catalog',	'images',	'Catalog-203-greb-1png',	'Catalog-203-greb-1png.png',	'media',	54929,	'[]',	'[]',	236,	'2016-04-07 04:45:47',	'2016-04-07 04:45:47'),
(314,	204,	'App\\Models\\Catalog',	'images',	'Catalog-204-greb-2png',	'Catalog-204-greb-2png.png',	'media',	109489,	'[]',	'[]',	237,	'2016-04-07 04:50:00',	'2016-04-07 04:50:00'),
(315,	308,	'App\\Models\\Category',	'images',	'Category-308-greb-3png',	'Category-308-greb-3png.png',	'media',	79293,	'[]',	'[]',	238,	'2016-04-07 04:50:24',	'2016-04-07 04:50:24'),
(316,	4,	'App\\Models\\Blocks',	'files',	'Blocks-4-prais-rybadocx',	'Blocks-4-prais-rybadocx.docx',	'media',	23618,	'[]',	'{\"alt\":\"\\u0421\\u043a\\u0430\\u0447\\u0430\\u0442\\u044c \\u043f\\u0440\\u0430\\u0439\\u0441 \\u043d\\u0430 \\u0440\\u044b\\u0431\\u0443\",\"gallery\":\"\"}',	239,	'2016-04-08 06:36:35',	'2016-04-08 06:36:35'),
(317,	4,	'App\\Models\\Blocks',	'files',	'Blocks-4-prais-moreproduktydocx',	'Blocks-4-prais-moreproduktydocx.docx',	'media',	22449,	'[]',	'{\"alt\":\"\\u0421\\u043a\\u0430\\u0447\\u0430\\u0442\\u044c \\u043f\\u0440\\u0430\\u0439\\u0441 \\u043d\\u0430 \\u043c\\u043e\\u0440\\u0435\\u043f\\u0440\\u043e\\u0434\\u0443\\u043a\\u0442\\u044b\",\"gallery\":\"\"}',	239,	'2016-04-08 06:36:35',	'2016-04-08 06:36:35'),
(318,	302,	'App\\Models\\Category',	'images',	'Category-302-trskapng',	'Category-302-trskapng.png',	'media',	56276,	'[]',	'[]',	240,	'2016-04-11 03:32:22',	'2016-04-11 03:32:22'),
(319,	153,	'App\\Models\\Catalog',	'images',	'Catalog-153-trskapng',	'Catalog-153-trskapng.png',	'media',	56276,	'[]',	'[]',	241,	'2016-04-11 03:33:22',	'2016-04-11 03:33:22'),
(320,	167,	'App\\Models\\Catalog',	'images',	'Catalog-167-trskapng',	'Catalog-167-trskapng.png',	'media',	56276,	'[]',	'[]',	242,	'2016-04-11 03:33:29',	'2016-04-11 03:33:29'),
(321,	168,	'App\\Models\\Catalog',	'images',	'Catalog-168-trskapng',	'Catalog-168-trskapng.png',	'media',	56276,	'[]',	'[]',	243,	'2016-04-11 03:33:35',	'2016-04-11 03:33:35'),
(322,	169,	'App\\Models\\Catalog',	'images',	'Catalog-169-trskapng',	'Catalog-169-trskapng.png',	'media',	56276,	'[]',	'[]',	244,	'2016-04-11 03:33:41',	'2016-04-11 03:33:41');

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
(11,	'О нас',	0,	'',	0,	'/page/o-nas',	'',	100,	0,	'2016-03-21 02:56:48',	'2016-03-21 02:56:48');

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
('2016_03_21_141322_update_catalog_vitayz',	17),
('2016_03_24_122015_add_remember_token_to_users_table',	18);

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
(95,	'Template1',	'Template1',	'page',	27,	'2016-03-21 02:56:20',	'2016-03-21 02:56:20'),
(96,	'',	'',	'',	162,	'2016-03-22 02:47:04',	'2016-03-22 02:47:04'),
(97,	'Template1',	'Template1',	'catalog',	162,	'2016-03-22 02:51:01',	'2016-03-22 02:51:01'),
(98,	'',	'',	'',	163,	'2016-03-22 02:51:33',	'2016-03-22 02:51:33'),
(99,	'Template1',	'Template1',	'catalog',	163,	'2016-03-22 02:52:31',	'2016-03-22 02:52:31'),
(100,	'',	'',	'',	164,	'2016-03-22 02:52:49',	'2016-03-22 02:52:49'),
(101,	'Template1',	'Template1',	'catalog',	164,	'2016-03-22 02:53:38',	'2016-03-22 02:53:38'),
(102,	'',	'',	'',	165,	'2016-03-22 02:53:50',	'2016-03-22 02:53:50'),
(103,	'Template1',	'Template1',	'catalog',	165,	'2016-03-22 02:54:41',	'2016-03-22 02:54:41'),
(104,	'',	'',	'',	166,	'2016-03-22 02:56:17',	'2016-03-22 02:56:17'),
(105,	'Template1',	'Template1',	'catalog',	166,	'2016-03-22 03:00:16',	'2016-03-22 03:00:16'),
(106,	'',	'',	'',	167,	'2016-03-22 03:16:33',	'2016-03-22 03:16:33'),
(107,	'Template1',	'Template1',	'catalog',	167,	'2016-03-22 03:18:41',	'2016-03-22 03:18:41'),
(108,	'',	'',	'',	168,	'2016-03-22 03:33:53',	'2016-03-22 03:33:53'),
(109,	'Template1',	'Template1',	'catalog',	168,	'2016-03-22 03:34:38',	'2016-03-22 03:34:38'),
(110,	'',	'',	'',	169,	'2016-03-22 03:34:52',	'2016-03-22 03:34:52'),
(111,	'Template1',	'Template1',	'catalog',	169,	'2016-03-22 03:35:39',	'2016-03-22 03:35:39'),
(112,	'',	'',	'',	170,	'2016-03-22 03:44:10',	'2016-03-22 03:44:10'),
(113,	'Template1',	'Template1',	'catalog',	170,	'2016-03-22 03:45:54',	'2016-03-22 03:45:54'),
(114,	'',	'',	'',	171,	'2016-03-22 03:46:17',	'2016-03-22 03:46:17'),
(115,	'Template1',	'Template1',	'catalog',	171,	'2016-03-22 03:47:20',	'2016-03-22 03:47:20'),
(116,	'',	'',	'',	172,	'2016-03-22 04:09:22',	'2016-03-22 04:09:22'),
(117,	'Template1',	'Template1',	'catalog',	172,	'2016-03-22 04:10:21',	'2016-03-22 04:10:21'),
(118,	'',	'',	'',	173,	'2016-03-22 04:10:32',	'2016-03-22 04:10:32'),
(119,	'Template1',	'Template1',	'catalog',	173,	'2016-03-22 04:11:12',	'2016-03-22 04:11:12'),
(120,	'',	'',	'',	174,	'2016-03-22 04:11:19',	'2016-03-22 04:11:19'),
(121,	'Template1',	'Template1',	'catalog',	174,	'2016-03-22 04:11:53',	'2016-03-22 04:11:53'),
(122,	'',	'',	'',	175,	'2016-03-22 04:14:46',	'2016-03-22 04:14:46'),
(123,	'Template1',	'Template1',	'catalog',	175,	'2016-03-22 04:15:33',	'2016-03-22 04:15:33'),
(124,	'',	'',	'',	176,	'2016-03-22 04:29:53',	'2016-03-22 04:29:53'),
(125,	'Template1',	'Template1',	'catalog',	176,	'2016-03-22 04:30:44',	'2016-03-22 04:30:44'),
(126,	'',	'',	'',	177,	'2016-03-22 04:31:03',	'2016-03-22 04:31:03'),
(127,	'Template1',	'Template1',	'catalog',	177,	'2016-03-22 04:31:39',	'2016-03-22 04:31:39'),
(128,	'',	'',	'',	178,	'2016-03-22 04:31:45',	'2016-03-22 04:31:45'),
(129,	'Template1',	'Template1',	'catalog',	178,	'2016-03-22 04:32:20',	'2016-03-22 04:32:20'),
(130,	'',	'',	'',	179,	'2016-03-22 06:46:28',	'2016-03-22 06:46:28'),
(131,	'Template1',	'Template1',	'catalog',	179,	'2016-03-22 06:48:51',	'2016-03-22 06:48:51'),
(132,	'',	'',	'',	180,	'2016-03-22 06:48:59',	'2016-03-22 06:48:59'),
(133,	'Template1',	'Template1',	'catalog',	180,	'2016-03-22 06:51:05',	'2016-03-22 06:51:05'),
(134,	'',	'',	'',	181,	'2016-03-22 06:51:35',	'2016-03-22 06:51:35'),
(135,	'Template1',	'Template1',	'category',	305,	'2016-03-22 06:52:06',	'2016-03-22 06:52:06'),
(136,	'Template1',	'Template1',	'catalog',	181,	'2016-03-22 06:52:46',	'2016-03-22 06:52:46'),
(137,	'',	'',	'',	182,	'2016-03-22 06:52:54',	'2016-03-22 06:52:54'),
(138,	'Template1',	'Template1',	'catalog',	182,	'2016-03-22 06:53:30',	'2016-03-22 06:53:30'),
(139,	'',	'',	'',	183,	'2016-03-22 06:53:35',	'2016-03-22 06:53:35'),
(140,	'Template1',	'Template1',	'catalog',	183,	'2016-03-22 06:54:33',	'2016-03-22 06:54:33'),
(141,	'',	'',	'',	184,	'2016-03-22 06:54:40',	'2016-03-22 06:54:40'),
(142,	'Template1',	'Template1',	'catalog',	184,	'2016-03-22 06:55:14',	'2016-03-22 06:55:14'),
(143,	'',	'',	'',	185,	'2016-03-22 06:55:19',	'2016-03-22 06:55:19'),
(144,	'Template1',	'Template1',	'catalog',	185,	'2016-03-22 06:55:51',	'2016-03-22 06:55:51'),
(145,	'',	'',	'',	186,	'2016-03-22 06:57:41',	'2016-03-22 06:57:41'),
(146,	'Template1',	'Template1',	'catalog',	186,	'2016-03-22 06:58:36',	'2016-03-22 06:58:36'),
(147,	'',	'',	'',	187,	'2016-03-22 07:00:40',	'2016-03-22 07:00:40'),
(148,	'Template1',	'Template1',	'catalog',	187,	'2016-03-22 07:01:28',	'2016-03-22 07:01:28'),
(149,	'',	'',	'',	188,	'2016-03-22 07:01:33',	'2016-03-22 07:01:33'),
(150,	'Template1',	'Template1',	'catalog',	188,	'2016-03-22 07:02:00',	'2016-03-22 07:02:00'),
(151,	'',	'',	'',	189,	'2016-03-22 07:03:04',	'2016-03-22 07:03:04'),
(152,	'Template1',	'Template1',	'catalog',	189,	'2016-03-22 07:05:04',	'2016-03-22 07:05:04'),
(153,	'',	'',	'',	190,	'2016-03-22 07:06:14',	'2016-03-22 07:06:14'),
(154,	'Template1',	'Template1',	'catalog',	190,	'2016-03-22 07:06:45',	'2016-03-22 07:06:45'),
(155,	'',	'',	'',	191,	'2016-03-22 07:06:52',	'2016-03-22 07:06:52'),
(156,	'Template1',	'Template1',	'catalog',	191,	'2016-03-22 07:07:29',	'2016-03-22 07:07:29'),
(157,	'',	'',	'',	192,	'2016-03-22 07:07:48',	'2016-03-22 07:07:48'),
(158,	'Template1',	'Template1',	'catalog',	192,	'2016-03-22 07:08:14',	'2016-03-22 07:08:14'),
(159,	'',	'',	'',	193,	'2016-03-22 07:09:22',	'2016-03-22 07:09:22'),
(160,	'Template1',	'Template1',	'catalog',	193,	'2016-03-22 07:09:53',	'2016-03-22 07:09:53'),
(161,	'',	'',	'',	194,	'2016-03-22 07:11:09',	'2016-03-22 07:11:09'),
(162,	'Template1',	'Template1',	'catalog',	194,	'2016-03-22 07:12:43',	'2016-03-22 07:12:43'),
(163,	'',	'',	'',	195,	'2016-03-22 07:12:54',	'2016-03-22 07:12:54'),
(164,	'Template1',	'Template1',	'catalog',	195,	'2016-03-22 07:13:31',	'2016-03-22 07:13:31'),
(165,	'',	'',	'',	196,	'2016-03-22 07:14:05',	'2016-03-22 07:14:05'),
(166,	'Template1',	'Template1',	'catalog',	196,	'2016-03-22 07:14:45',	'2016-03-22 07:14:45'),
(167,	'',	'',	'',	197,	'2016-04-07 04:14:44',	'2016-04-07 04:14:44'),
(168,	'Template1',	'Template1',	'catalog',	197,	'2016-04-07 04:16:39',	'2016-04-07 04:16:39'),
(169,	'',	'',	'',	198,	'2016-04-07 04:16:49',	'2016-04-07 04:16:49'),
(170,	'Template1',	'Template1',	'catalog',	198,	'2016-04-07 04:17:52',	'2016-04-07 04:17:52'),
(171,	'Template1',	'Template1',	'category',	306,	'2016-04-07 04:19:15',	'2016-04-07 04:19:15'),
(172,	'',	'',	'',	199,	'2016-04-07 04:28:04',	'2016-04-07 04:28:04'),
(173,	'Template1',	'Template1',	'catalog',	199,	'2016-04-07 04:29:14',	'2016-04-07 04:29:14'),
(174,	'',	'',	'',	200,	'2016-04-07 04:37:46',	'2016-04-07 04:37:46'),
(175,	'Template1',	'Template1',	'catalog',	200,	'2016-04-07 04:39:23',	'2016-04-07 04:39:23'),
(176,	'',	'',	'',	201,	'2016-04-07 04:39:54',	'2016-04-07 04:39:54'),
(177,	'Template1',	'Template1',	'catalog',	201,	'2016-04-07 04:40:30',	'2016-04-07 04:40:30'),
(178,	'',	'',	'',	202,	'2016-04-07 04:41:18',	'2016-04-07 04:41:18'),
(179,	'Template1',	'Template1',	'catalog',	202,	'2016-04-07 04:42:23',	'2016-04-07 04:42:23'),
(180,	'',	'',	'',	203,	'2016-04-07 04:45:12',	'2016-04-07 04:45:12'),
(181,	'Template1',	'Template1',	'catalog',	203,	'2016-04-07 04:46:04',	'2016-04-07 04:46:04'),
(182,	'',	'',	'',	204,	'2016-04-07 04:47:25',	'2016-04-07 04:47:25'),
(183,	'Template1',	'Template1',	'catalog',	204,	'2016-04-07 04:48:14',	'2016-04-07 04:48:14'),
(184,	'Template1',	'Template1',	'category',	308,	'2016-04-07 04:50:29',	'2016-04-07 04:50:29'),
(185,	'',	'',	'',	4,	'2016-04-08 06:24:56',	'2016-04-08 06:24:56'),
(186,	'Template1',	'Template1',	'blocks',	4,	'2016-04-08 06:25:42',	'2016-04-08 06:25:42'),
(187,	'Template1',	'Template1',	'category',	302,	'2016-04-11 03:32:26',	'2016-04-11 03:32:26'),
(188,	'',	'',	'',	11,	'2016-04-11 03:35:53',	'2016-04-11 03:35:53'),
(189,	'Template1',	'Template1',	'feed',	11,	'2016-04-11 03:36:21',	'2016-04-11 03:36:21'),
(190,	'',	'',	'',	12,	'2016-04-11 03:36:48',	'2016-04-11 03:36:48'),
(191,	'Template1',	'Template1',	'feed',	12,	'2016-04-11 03:37:30',	'2016-04-11 03:37:30'),
(192,	'',	'',	'',	13,	'2016-04-11 03:37:35',	'2016-04-11 03:37:35'),
(193,	'Template1',	'Template1',	'feed',	13,	'2016-04-11 03:37:59',	'2016-04-11 03:37:59'),
(194,	'',	'',	'',	14,	'2016-04-11 03:38:54',	'2016-04-11 03:38:54'),
(195,	'Template1',	'Template1',	'feed',	14,	'2016-04-11 03:43:25',	'2016-04-11 03:43:25'),
(196,	'',	'',	'',	15,	'2016-04-11 03:43:40',	'2016-04-11 03:43:40'),
(197,	'Template1',	'Template1',	'feed',	15,	'2016-04-11 03:45:05',	'2016-04-11 03:45:05'),
(198,	'',	'',	'',	16,	'2016-04-11 03:45:12',	'2016-04-11 03:45:12'),
(199,	'Template1',	'Template1',	'feed',	16,	'2016-04-11 03:45:41',	'2016-04-11 03:45:41'),
(200,	'',	'',	'',	17,	'2016-04-11 03:45:49',	'2016-04-11 03:45:49'),
(201,	'Template1',	'Template1',	'feed',	17,	'2016-04-11 03:46:24',	'2016-04-11 03:46:24'),
(202,	'',	'',	'',	18,	'2016-04-11 03:46:31',	'2016-04-11 03:46:31'),
(203,	'Template1',	'Template1',	'feed',	18,	'2016-04-11 03:46:45',	'2016-04-11 03:46:45'),
(204,	'',	'',	'',	19,	'2016-04-11 03:46:50',	'2016-04-11 03:46:50'),
(205,	'Template1',	'Template1',	'feed',	19,	'2016-04-11 03:47:28',	'2016-04-11 03:47:28');

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
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`, `remember_token`) VALUES
(1,	'fanamurov@ya.ru',	'$2y$10$SJzDIVLhyCdzOMxfnqAADOCoyzVgjwjmBlYaVWQlikchTd67mWPRa',	NULL,	'2016-03-17 06:51:06',	'4234',	'',	'2015-11-19 15:41:49',	'2016-03-24 02:22:14',	'FQqU3jVvLEBaAZfnTXA3Vk2o1l201QE87omXJjkqnFXbFfVQoz1rA6ufauFr');

-- 2016-04-11 05:00:58
