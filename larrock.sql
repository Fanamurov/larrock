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
(2,	'Новый товар',	'',	'',	'novyy-tovar',	'23423',	423432.00,	0.00,	'',	0,	'AR',	1,	0,	'2015-12-29 06:20:19',	'2015-12-29 06:20:19'),
(4,	'Товар во втором уровне',	'        Краткое описание\r\n    ',	'',	'tovar-vo-vtorom-urovne',	'2',	310.00,	400.00,	'',	0,	'AR',	1,	0,	'2015-12-30 07:09:43',	'2015-12-30 07:09:43');

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
(3,	'Первый уровень',	'Test',	'',	'catalog',	0,	1,	'tester2213',	1,	0,	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	'Еще первый уровень',	'',	'',	'catalog',	0,	1,	'342234',	1,	2,	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(6,	'Второй уровень',	'',	'',	'catalog',	4,	2,	'tester221',	1,	0,	1,	'2015-12-24 05:32:48',	'2015-12-24 05:32:48'),
(7,	'Еще второй уровень',	'',	'',	'catalog',	3,	2,	'vot-tak-vot',	1,	0,	1,	'2015-12-24 05:38:38',	'2015-12-24 05:38:38'),
(16,	'ннн',	'',	'',	'catalog',	3,	2,	'nnn',	1,	0,	1,	'2015-12-28 05:59:55',	'2015-12-28 05:59:55');

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
(7,	4,	'2015-12-30 07:09:43',	'0000-00-00 00:00:00'),
(6,	4,	'2015-12-30 07:09:43',	'0000-00-00 00:00:00');

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
(1,	'catalog',	'a:2:{s:14:\"image_original\";s:7:\"800-800\";s:14:\"image_generate\";a:2:{i:0;s:7:\"260-120\";i:1;s:7:\"600-600\";}}',	'image_presets',	'2016-01-11 07:21:09',	'2016-01-12 02:06:36'),
(2,	'page',	'a:2:{s:14:\"image_original\";s:0:\"\";s:14:\"image_generate\";a:2:{i:0;s:7:\"100-200\";i:1;s:7:\"300-540\";}}',	'image_presets',	'2016-01-12 04:34:30',	'2016-01-12 04:34:30');

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
(21,	'ek_111.png',	'image/png',	'',	'page',	22,	'',	0,	'2016-01-12 05:11:47',	'2016-01-12 05:12:15');

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
(1,	'Пункт меню',	0,	'',	0,	'punkt-menyu',	'',	0,	1,	'2015-12-05 16:07:44',	'2015-12-05 16:07:44'),
(2,	'Вложенный пункт меню',	0,	'',	1,	'vlozhennyy-punkt-menyu',	'',	0,	1,	'2015-12-05 16:49:31',	'2015-12-06 15:04:08'),
(3,	'Новый пункт',	0,	'',	0,	'novyy-punkt',	'',	0,	1,	'2015-12-06 15:43:28',	'2015-12-06 15:43:28'),
(4,	'Пункт меню для теста',	0,	'',	3,	'punkt-menyu-dlya-testa',	'',	0,	1,	'2015-12-06 15:43:45',	'2015-12-06 15:43:45'),
(5,	'А если так',	0,	'',	4,	'a-esli-tak',	'',	0,	1,	'2015-12-06 16:00:59',	'2015-12-06 16:00:59'),
(6,	'И даже вот так',	0,	'',	5,	'i-dazhe-vot-tak',	'',	0,	0,	'2015-12-06 16:19:45',	'2015-12-06 16:19:45'),
(7,	'Контрольный пункт',	0,	'',	4,	'kontrol-nyy-punkt',	'',	0,	1,	'2015-12-06 16:20:22',	'2015-12-06 16:20:38');

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
('2015_12_29_144628_create_category_catalog_table',	12);

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
(22,	'rwerwe',	'',	'rwerwe',	'2016-01-12',	0,	1,	'2016-01-12 05:12:15',	'2016-01-12 05:12:15');

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
(25,	'Template1',	'Template1',	'page',	22,	'2016-01-12 05:12:15',	'2016-01-12 05:12:15');

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

-- 2016-01-12 07:59:06
