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
(1,	'Новости',	'',	'',	'feed',	0,	1,	'news',	1,	0,	1,	'0000-00-00 00:00:00',	'2016-03-31 02:54:30'),
(2,	'SEO-тексты',	'',	'',	'feed',	0,	1,	'seofish',	0,	0,	1,	'2015-12-08 07:25:12',	'2015-12-08 07:25:12'),
(306,	'Пляжный отдых',	'',	'',	'tours',	377,	2,	'plyazhnyy-otdykh',	1,	0,	1,	'2016-03-30 02:16:56',	'2016-03-30 02:16:56'),
(308,	'Страны',	'',	'',	'tours',	0,	1,	'strany',	1,	100,	1,	'2016-03-30 03:17:16',	'2016-03-30 03:17:16'),
(309,	'Индонезия',	'',	'',	'tours',	308,	2,	'indoneziya',	1,	0,	1,	'2016-03-30 03:17:29',	'2016-03-30 03:17:29'),
(310,	'Бали',	'',	'',	'tours',	309,	2,	'bali',	1,	0,	1,	'2016-03-30 03:22:32',	'2016-03-30 03:22:32'),
(311,	'Экскурсионные туры',	'',	'',	'tours',	377,	2,	'ekskursionnye-tury',	1,	0,	1,	'2016-03-30 03:28:11',	'2016-03-30 03:28:11'),
(312,	'Комби-туры',	'',	'',	'tours',	377,	2,	'kombi-tury',	1,	0,	1,	'2016-03-30 03:28:31',	'2016-03-30 03:28:31'),
(313,	'Отдых с детьми',	'',	'',	'tours',	377,	2,	'otdykh-s-detmi',	1,	0,	1,	'2016-03-30 03:28:45',	'2016-03-30 03:28:45'),
(314,	'Учимся и отдыхаем',	'',	'',	'tours',	377,	2,	'uchimsya-i-otdykhaem',	1,	0,	1,	'2016-03-30 03:28:55',	'2016-03-30 03:28:55'),
(315,	'Отдых и здоровье',	'',	'',	'tours',	377,	2,	'otdykh-i-zdorove',	1,	0,	1,	'2016-03-30 03:29:28',	'2016-03-30 03:29:28'),
(316,	'Экзотические острова',	'',	'',	'tours',	377,	2,	'ekzoticheskie-ostrova',	1,	0,	1,	'2016-03-30 03:29:39',	'2016-03-30 03:29:39'),
(317,	'Luxury',	'',	'',	'tours',	377,	2,	'luxury',	1,	0,	1,	'2016-03-30 03:29:49',	'2016-03-30 03:29:49'),
(318,	'Туристические круизы',	'',	'',	'tours',	377,	2,	'turisticheskie-kruizy',	1,	0,	1,	'2016-03-30 03:29:59',	'2016-03-30 03:29:59'),
(319,	'Свадебные путешествия',	'',	'',	'tours',	377,	2,	'svadebnye-puteshestviya',	1,	0,	1,	'2016-03-30 03:30:10',	'2016-03-30 03:30:10'),
(320,	'Горнолыжные туры',	'',	'',	'tours',	377,	2,	'gornolyzhnye-tury',	1,	0,	1,	'2016-03-30 03:30:20',	'2016-03-30 03:30:20'),
(321,	'Австралия',	'',	'',	'tours',	308,	2,	'avstraliya',	1,	0,	1,	'2016-03-30 03:31:28',	'2016-03-30 03:31:28'),
(322,	'Австрия',	'',	'',	'tours',	308,	2,	'avstriya',	1,	0,	1,	'2016-03-30 03:31:41',	'2016-03-30 03:31:41'),
(323,	'Андорра',	'',	'',	'tours',	308,	2,	'andorra',	1,	0,	1,	'2016-03-30 03:31:51',	'2016-03-30 03:31:51'),
(324,	'Болгария',	'',	'',	'tours',	308,	2,	'bolgariya',	1,	0,	1,	'2016-03-30 03:32:01',	'2016-03-30 03:32:01'),
(325,	'Бора-бора',	'',	'',	'tours',	308,	2,	'bora-bora',	1,	0,	1,	'2016-03-30 03:32:12',	'2016-03-30 03:32:12'),
(326,	'Бразилия',	'',	'',	'tours',	308,	2,	'braziliya',	1,	0,	1,	'2016-03-30 03:35:21',	'2016-03-30 03:35:21'),
(327,	'Венгрия',	'',	'',	'tours',	308,	2,	'vengriya',	1,	0,	1,	'2016-03-30 03:35:48',	'2016-03-30 03:35:48'),
(328,	'Вьетнам',	'',	'',	'tours',	308,	2,	'vetnam',	1,	0,	1,	'2016-03-30 03:36:03',	'2016-03-30 03:36:03'),
(329,	'Германия',	'',	'',	'tours',	308,	2,	'germaniya',	1,	0,	1,	'2016-03-30 03:36:15',	'2016-03-30 03:36:15'),
(330,	'Греция',	'',	'',	'tours',	308,	2,	'gretsiya',	1,	0,	1,	'2016-03-30 03:36:20',	'2016-03-30 03:36:20'),
(331,	'Доминикана',	'',	'',	'tours',	308,	2,	'dominikana',	1,	0,	1,	'2016-03-30 03:36:27',	'2016-03-30 03:36:27'),
(332,	'Египет',	'',	'',	'tours',	308,	2,	'egipet',	1,	0,	1,	'2016-03-30 03:36:35',	'2016-03-30 03:36:35'),
(333,	'Израиль',	'',	'',	'tours',	308,	2,	'izrail',	1,	0,	1,	'2016-03-30 03:36:42',	'2016-03-30 03:36:42'),
(334,	'Индия',	'',	'',	'tours',	308,	2,	'indiya',	1,	0,	1,	'2016-03-30 03:36:49',	'2016-03-30 03:36:49'),
(336,	'Иордания',	'',	'',	'tours',	308,	2,	'iordaniya',	1,	0,	1,	'2016-03-30 03:42:46',	'2016-03-30 03:42:46'),
(337,	'Ирландия',	'',	'',	'tours',	308,	2,	'irlandiya',	1,	0,	1,	'2016-03-30 03:42:54',	'2016-03-30 03:42:54'),
(338,	'Испания',	'',	'',	'tours',	308,	2,	'ispaniya',	1,	0,	1,	'2016-03-30 03:43:02',	'2016-03-30 03:43:02'),
(339,	'Италия',	'',	'',	'tours',	308,	2,	'italiya',	1,	0,	1,	'2016-03-30 03:43:11',	'2016-03-30 03:43:11'),
(340,	'Камбоджа',	'',	'',	'tours',	308,	2,	'kambodzha',	1,	0,	1,	'2016-03-30 03:43:17',	'2016-03-30 03:43:17'),
(341,	'Канада',	'',	'',	'tours',	308,	2,	'kanada',	1,	0,	1,	'2016-03-30 03:43:24',	'2016-03-30 03:43:24'),
(342,	'Кипр',	'',	'',	'tours',	308,	2,	'kipr',	1,	0,	1,	'2016-03-30 03:43:30',	'2016-03-30 03:43:30'),
(343,	'Китай',	'',	'',	'tours',	308,	2,	'kitay',	1,	0,	1,	'2016-03-30 03:43:35',	'2016-03-30 03:43:35'),
(344,	'Куба',	'',	'',	'tours',	308,	2,	'kuba',	1,	0,	1,	'2016-03-30 03:43:41',	'2016-03-30 03:43:41'),
(345,	'Маврикий',	'',	'',	'tours',	308,	2,	'mavrikiy',	1,	0,	1,	'2016-03-30 03:43:46',	'2016-03-30 03:43:46'),
(346,	'Малайзия',	'',	'',	'tours',	308,	2,	'malayziya',	1,	0,	1,	'2016-03-30 03:43:53',	'2016-03-30 03:43:53'),
(347,	'Мальдивы',	'',	'',	'tours',	308,	2,	'maldivy',	1,	0,	1,	'2016-03-30 03:44:00',	'2016-03-30 03:44:00'),
(348,	'Марианские острова',	'',	'',	'tours',	308,	2,	'marianskie-ostrova',	1,	0,	1,	'2016-03-30 03:44:09',	'2016-03-30 03:44:09'),
(349,	'Мексика',	'',	'',	'tours',	308,	2,	'meksika',	1,	0,	1,	'2016-03-30 03:44:16',	'2016-03-30 03:44:16'),
(350,	'Муреа',	'',	'',	'tours',	308,	2,	'murea',	1,	0,	1,	'2016-03-30 03:44:22',	'2016-03-30 03:44:22'),
(351,	'Новая Зеландия',	'',	'',	'tours',	308,	2,	'novaya-zelandiya',	1,	0,	1,	'2016-03-30 03:44:30',	'2016-03-30 03:44:30'),
(352,	'Норвегия',	'',	'',	'tours',	308,	2,	'norvegiya',	1,	0,	1,	'2016-03-30 03:44:38',	'2016-03-30 03:44:38'),
(353,	'ОАЭ',	'',	'',	'tours',	308,	2,	'oae',	1,	0,	1,	'2016-03-30 03:44:46',	'2016-03-30 03:44:46'),
(354,	'Палау',	'',	'',	'tours',	308,	2,	'palau',	1,	0,	1,	'2016-03-30 03:44:51',	'2016-03-30 03:44:51'),
(355,	'Польша',	'',	'',	'tours',	308,	2,	'polsha',	1,	0,	1,	'2016-03-30 03:44:55',	'2016-03-30 03:44:55'),
(356,	'Португалия',	'',	'',	'tours',	308,	2,	'portugaliya',	1,	0,	1,	'2016-03-30 03:45:02',	'2016-03-30 03:45:02'),
(357,	'Россия',	'',	'',	'tours',	308,	2,	'rossiya',	1,	0,	1,	'2016-03-30 03:45:06',	'2016-03-30 03:45:06'),
(358,	'Сейшелы',	'',	'',	'tours',	308,	2,	'seyshely',	1,	0,	1,	'2016-03-30 03:45:11',	'2016-03-30 03:45:11'),
(359,	'Сингапур',	'',	'',	'tours',	308,	2,	'singapur',	1,	0,	1,	'2016-03-30 03:45:17',	'2016-03-30 03:45:17'),
(360,	'СШа',	'',	'',	'tours',	308,	2,	'ssha',	1,	0,	1,	'2016-03-30 03:45:21',	'2016-03-30 03:45:21'),
(361,	'Тайланд',	'',	'',	'tours',	308,	2,	'tayland',	1,	0,	1,	'2016-03-30 03:45:35',	'2016-03-30 03:45:35'),
(362,	'Таити',	'',	'',	'tours',	308,	2,	'taiti',	1,	0,	1,	'2016-03-30 03:45:42',	'2016-03-30 03:45:42'),
(363,	'Тунис',	'',	'',	'tours',	308,	2,	'tunis',	1,	0,	1,	'2016-03-30 03:45:47',	'2016-03-30 03:45:47'),
(364,	'Турция',	'',	'',	'tours',	308,	2,	'turtsiya',	1,	0,	1,	'2016-03-30 03:45:51',	'2016-03-30 03:45:51'),
(365,	'Фиджи',	'',	'',	'tours',	308,	2,	'fidzhi',	1,	0,	1,	'2016-03-30 03:45:57',	'2016-03-30 03:45:57'),
(366,	'Филиппины',	'',	'',	'tours',	308,	2,	'filippiny',	1,	0,	1,	'2016-03-30 03:46:12',	'2016-03-30 03:46:12'),
(367,	'Финляндия',	'',	'',	'tours',	308,	2,	'finlyandiya',	1,	0,	1,	'2016-03-30 03:46:18',	'2016-03-30 03:46:18'),
(368,	'Франция',	'',	'',	'tours',	308,	2,	'frantsiya',	1,	0,	1,	'2016-03-30 03:46:22',	'2016-03-30 03:46:22'),
(369,	'Черногория',	'',	'',	'tours',	308,	2,	'chernogoriya',	1,	0,	1,	'2016-03-30 03:46:27',	'2016-03-30 03:46:27'),
(370,	'Чехия',	'',	'',	'tours',	308,	2,	'chekhiya',	1,	0,	1,	'2016-03-30 03:46:32',	'2016-03-30 03:46:32'),
(371,	'Швейцария',	'',	'',	'tours',	308,	2,	'shveytsariya',	1,	0,	1,	'2016-03-30 03:46:37',	'2016-03-30 03:46:37'),
(372,	'Швеция',	'',	'',	'tours',	308,	2,	'shvetsiya',	1,	0,	1,	'2016-03-30 03:46:44',	'2016-03-30 03:46:44'),
(373,	'Шри-ланка',	'',	'',	'tours',	308,	2,	'shri-lanka',	1,	0,	1,	'2016-03-30 03:46:55',	'2016-03-30 03:46:55'),
(374,	'Южная Корея',	'',	'',	'tours',	308,	2,	'yuzhnaya-koreya',	1,	0,	1,	'2016-03-30 03:47:00',	'2016-03-30 03:47:00'),
(375,	'Ямайка',	'',	'',	'tours',	308,	2,	'yamayka',	1,	0,	1,	'2016-03-30 03:47:05',	'2016-03-30 03:47:05'),
(376,	'Япония',	'',	'',	'tours',	308,	2,	'yaponiya',	1,	0,	1,	'2016-03-30 03:47:09',	'2016-03-30 03:47:09'),
(377,	'Виды отдыха',	'',	'',	'tours',	0,	1,	'vidy-otdykha',	1,	0,	1,	'2016-03-30 05:47:50',	'2016-03-30 05:47:50'),
(378,	'Блог',	'',	'',	'blog',	0,	1,	'blog',	1,	0,	1,	'2016-03-31 04:57:43',	'2016-03-31 04:57:43'),
(379,	'Пляжный отдых',	'',	'',	'blog',	378,	1,	'plyazhnyy-otdykh',	1,	0,	1,	'2016-03-31 05:39:25',	'2016-03-31 05:39:25'),
(380,	'Хитрости и нюансы',	'',	'',	'',	378,	2,	'oformlenie-dokumentov',	1,	0,	1,	'2016-03-31 05:40:42',	'2016-03-31 05:40:42');

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


DROP TABLE IF EXISTS `category_tours`;
CREATE TABLE `category_tours` (
  `category_id` int(10) unsigned NOT NULL,
  `tour_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `category_tours_category_id_foreign` (`category_id`),
  KEY `category_tours_tour_id_foreign` (`tour_id`),
  CONSTRAINT `category_tours_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_tours_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `category_tours` (`category_id`, `tour_id`, `created_at`, `updated_at`) VALUES
(306,	4,	'2016-03-30 03:23:45',	'0000-00-00 00:00:00'),
(310,	4,	'2016-03-30 03:23:45',	'0000-00-00 00:00:00'),
(306,	7,	'2016-03-30 04:34:45',	'0000-00-00 00:00:00');

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
(11,	'Рейсы Азейбайджанской авиакомпании Azal',	1,	'<p>Азейбайджанская авиакомпания Azal представляет рейсы из Москвы и Санкт-Петербурга до Тбилиси, Стамбула, Дубая, Баку, Актау, Тегерана от 8000 рублей по маршруту \"туда-обратно\"! Не упустите шанс! Спешите купить авиабилеты по самым низким ценам!</p>\r\n<p>Подробности по телефону 45-45-46</p>',	'<p>Азейбайджанская авиакомпания Azal представляет рейсы из Москвы и Санкт-Петербурга до Тбилиси, Стамбула, Дубая, Баку, Актау, Тегерана от 8000 рублей по маршруту \"туда-обратно\"! Не упустите шанс! Спешите купить авиабилеты по самым низким ценам!<br /><br />Подробности по телефону 45-45-46</p>',	'reysy-azeybaydzhanskoy-aviakompanii-azal',	'2016-03-31 00:00:00',	0,	1,	'2016-03-31 02:49:40',	'2016-03-31 02:51:12',	0),
(12,	'Субсидированные перевозки',	1,	'<p>С 17.03.2016 открыто бронирование по субсидированным тарифам</p>\r\n<p>Открылись новые субсидированные перевозки по направлению Хабаровск - Владивосток - Хабаровск по стоимости 5000 руб для взрослого,<br />для ребенка стоимость составляет 4100 руб.</p>\r\n<p>Подробности по телефону 45-45-46</p>',	'<p>С 17.03.2016 открыто бронирование по субсидированным тарифам</p>\r\n<p>Открылись новые субсидированные перевозки по направлению Хабаровск - Владивосток - Хабаровск по стоимости 5000 руб для взрослого,<br />для ребенка стоимость составляет 4100 руб.</p>\r\n<p>Подробности по телефону 45-45-46</p>',	'subsidirovannye-perevozki',	'2016-03-31 00:00:00',	0,	1,	'2016-03-31 02:51:56',	'2016-03-31 04:47:32',	1),
(13,	'Транспорт за границей: как не испортить себе отдых?',	378,	'<p>В последнее время многие путешественники решают отдохнуть самостоятельно, без покупки тура. Однако здесь наших туристов может поджидать множество неожиданностей, одной из которых являются транспортные проблемы за границей.</p>',	'<p align=\"left\">В последнее время многие путешественники решают отдохнуть самостоятельно, без покупки тура. Однако здесь наших туристов может поджидать множество неожиданностей, одной из которых являются транспортные проблемы за границей.<br /><strong><br /></strong></p>\r\n<h3 align=\"left\"><strong>Транспорт&hellip;Стоит ли думать об этом заранее?</strong></h3>\r\n<p align=\"left\">Транспортный вопрос остается для туристов не актуальным до тех пор, пока они не прибывают в страну назначения. Многие не думают, какие действия они будут предпринимать по прилету в аэропорт, как станут добираться до гостиницы. Для тех, кто не желает начать себе портить настроение уже в аэропорту, следует заранее побеспокоиться о трансфере. Статистика неумолима: каждый год тысячи путешественников сталкиваются с неприятностями, связанными с транспортом за границей.<br /><br /></p>\r\n<h3 align=\"left\"><strong>До отеля 6 часов в дороге.</strong></h3>\r\n<p><img class=\"\" title=\"Долгий переезд\" src=\"http://www.santa-avia.ru/upload/medialibrary/5e0/dolgiy-pereezd.jpg\" alt=\"Долгий переезд\" width=\"600\" height=\"400\" /></p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p align=\"left\">Большинство путешественников полагают, что от аэропорта до нужного им адреса должен курсировать автобус. Да, это имеет место быть, от аэропорта действительно ходит общественный транспорт. Но подвох заключается в том, что пассажира довезут или только до станции метро или до гостиницы, но тогда придется потратить уйму времени в ожидании, пока развезут всех туристов. В результате, заветный отдых сокращается на несколько часов. Более того, если с вами едут дети, то эти часы превращаются в настоящий кошмар, после которого дальнейший отдых может быть подпорчен основательно.<br />Такси &ndash; хороший и быстрый вариант, но не для бюджетных туристов. <br /><br /></p>\r\n<h3>100&euro; за 10 минут на такси</h3>\r\n<p><img class=\"\" title=\"Злой таксист\" src=\"http://www.santa-avia.ru/upload/medialibrary/186/zloy-taksist.jpg\" alt=\"Злой таксист\" width=\"600\" height=\"401\" /></p>\r\n<p>&nbsp;</p>\r\n<p align=\"left\">Что может быть проще, чем по прибытию в аэропорт взять такси и ехать в отель? Многие так и поступают, о чем потом искренне сожалеют. Дело в том, что не каждый путешественник в предвкушении отдыха, интересуется стоимостью услуг такси и договаривается с водителем, в попытках сбить цену. Когда приходит время расплачиваться за проезд, на счетчике уже значится немалая сумма, которую придется заплатить, чтобы избежать неприятностей.</p>\r\n<p align=\"left\">&nbsp;</p>\r\n<h3 align=\"left\"><strong>Что делать, чтобы добраться до места без проблем?</strong></h3>\r\n<p><img class=\"\" title=\"Советы туристам\" src=\"http://www.santa-avia.ru/upload/medialibrary/857/transfer-bez-problem.jpg\" alt=\"Советы туристам\" width=\"600\" height=\"400\" /></p>\r\n<p><strong><br /></strong>Существуют несколько правил, которые позволят путешественникам избежать многих проблем с проездом в незнакомой стране.<br /><strong><br /></strong></p>\r\n<h4><strong>Правильно подходите к выбору транспортного средства.</strong></h4>\r\n<p align=\"left\">Общественный транспорт &ndash; оптимальный вариант для тех, кто знает язык или не имеет проблем с топографией. Для больших компаний, семей с детьми, туристов, которые в стране впервые и не знают языка &ndash; такси.<br /><strong><br /></strong></p>\r\n<h4 align=\"left\"><strong>Не стоит пользоваться услугами частных извозчиков</strong></h4>\r\n<p align=\"left\">Независимо автобус это или такси, перемещаться нужно только на официально зарегистрированных транспортных средствах. Как правило, все неприятности происходят только с теми туристами, которые имеют дело с частниками, ведь их никто не контролирует.<br /><strong><br /></strong></p>\r\n<h4 align=\"left\"><strong>Бронируйте трансфер заранее</strong></h4>\r\n<p align=\"left\">Предварительное бронирование транспорта позволит избежать многих проблем и нервотрепки. Перед поездкой рекомендуется предварительно заказать трансфер, тогда по приезду туриста встретит машина, которая отвезет в нужное место. Заказ такси, в отличие от автобусов, возможен в любом аэропорту практически любой страны.<br />Услуга предварительно бронирования позволит путешественникам самим выбрать автомобиль нужного класса. Туристов встретят с табличками в аэропорту, а в авто гарантированно будут доступны напитки, вода, детские кресла и прочие опции. Пассажир может не объясняться с водителем, контроль над поездкой осуществляется посредством диспетчера, владеющего русским языком, с которым можно связаться в случае необходимости. При этом турист осведомлен о стоимости поездки, оплатить которую он может с помощью карты на сайте агентства по бронированию .<br /><br /></p>\r\n<h3 align=\"left\"><strong>Как забронировать трансфер?</strong></h3>\r\n<p align=\"left\">Уделите этой процедуре всего несколько минут, и отдых начнется идеально. Этапы бронирования: <br /><br /></p>\r\n<p align=\"left\">1. Выбор аэропорта и города отеля.<br />2. Выбор авто нужного класса.<br />3. Указание контактов и времени прилета.<br />4. Оплата частичная или полная.<br /><br /></p>\r\n<p align=\"left\">Эти простые действия гарантируют приятную встречу и хороший отдых.&nbsp;</p>',	'transport-za-granitsey-kak-ne-isportit-sebe-otdykh',	'2016-03-31 00:00:00',	0,	1,	'2016-03-31 04:47:38',	'2016-03-31 04:57:59',	1);

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
(1,	4,	'App\\Models\\Tours',	'images',	'Tours-4-balisvadbajpg',	'Tours-4-balisvadbajpg.jpg',	'media',	75967,	'[]',	'[]',	1,	'2016-03-30 02:43:45',	'2016-03-30 02:43:45'),
(2,	11,	'App\\Models\\Feed',	'images',	'Feed-11-azaljpg',	'Feed-11-azaljpg.jpg',	'media',	5642,	'[]',	'[]',	2,	'2016-03-31 02:51:03',	'2016-03-31 02:51:03'),
(3,	12,	'App\\Models\\Feed',	'images',	'Feed-12-aeroflot-1jpg',	'Feed-12-aeroflot-1jpg.jpg',	'media',	4202,	'[]',	'[]',	3,	'2016-03-31 02:52:40',	'2016-03-31 02:52:40'),
(4,	13,	'App\\Models\\Feed',	'images',	'Feed-13-213jpg',	'Feed-13-213jpg.jpg',	'media',	10959,	'[]',	'[]',	4,	'2016-03-31 05:26:12',	'2016-03-31 05:26:12');

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
(8,	'Страны',	0,	'',	0,	'/',	'tours/{category}',	90,	0,	'2016-03-14 02:51:10',	'2016-03-30 05:35:00'),
(9,	'Доставка',	0,	'',	0,	'/page/dostavka',	'',	80,	0,	'2016-03-14 02:51:28',	'2016-03-16 05:06:29'),
(10,	'Контакты',	0,	'',	0,	'/page/kontakty',	'',	70,	0,	'2016-03-14 02:51:41',	'2016-03-16 05:08:24');

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
(26,	'Контакты',	'<h1>Контакты \"Санта Авиа\" г. Хабаровск</h1>\r\n<p>г. Хабаровск, ул. Шеронова, 115<br />тел:+7 (4212) 45-99-05<br />e-mail: <a href=\"mailto:tur@santa-avia.ru\">tur@santa-avia.ru</a></p>\r\n<p>Здание &laquo;Премьера&raquo;, вход с торца (новое здание с цветными балконами)</p>\r\n<p>09:00 - 19:00 (Пн - Пт) <br />10:00 - 15:00 (Сб) <br />10:00 - 15:00 (Праздничные дни)</p>\r\n<p><strong>Воскресенье выходной</strong></p>',	'kontakty',	'2016-03-16',	0,	1,	'2016-03-16 05:06:40',	'2016-03-31 04:38:20'),
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
(167,	'',	'',	'',	4,	'2016-03-30 02:36:23',	'2016-03-30 02:36:23'),
(168,	'Template2',	'Template2',	'tours',	4,	'2016-03-30 02:40:47',	'2016-03-30 02:40:47'),
(169,	'',	'',	'',	5,	'2016-03-30 03:35:26',	'2016-03-30 03:35:26'),
(170,	'',	'',	'',	7,	'2016-03-30 04:24:35',	'2016-03-30 04:24:35'),
(171,	'Template1',	'Template1',	'tours',	7,	'2016-03-30 04:30:23',	'2016-03-30 04:30:23'),
(172,	'',	'',	'',	11,	'2016-03-31 02:49:40',	'2016-03-31 02:49:40'),
(173,	'Template1',	'Template1',	'feed',	11,	'2016-03-31 02:51:12',	'2016-03-31 02:51:12'),
(174,	'',	'',	'',	12,	'2016-03-31 02:51:56',	'2016-03-31 02:51:56'),
(175,	'Template1',	'Template1',	'feed',	12,	'2016-03-31 02:52:57',	'2016-03-31 02:52:57'),
(176,	'Template1',	'Template1',	'category',	1,	'2016-03-31 02:54:30',	'2016-03-31 02:54:30'),
(177,	'',	'',	'',	13,	'2016-03-31 04:47:38',	'2016-03-31 04:47:38'),
(178,	'Template1',	'Template1',	'feed',	13,	'2016-03-31 04:57:24',	'2016-03-31 04:57:24');

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

DROP TABLE IF EXISTS `tours`;
CREATE TABLE `tours` (
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
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tours_url_unique` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tours` (`id`, `title`, `short`, `description`, `url`, `what`, `cost`, `cost_old`, `manufacture`, `position`, `articul`, `active`, `nalichie`, `created_at`, `updated_at`, `user_id`) VALUES
(4,	'Свадебная церемония на о.Бали',	'<p>Балийская свадебная церемония.</p>\r\n<p>Вы решили дать клятвенное обещание или сделать предложение своей второй половинке? Или у вас впереди помолвка/обручение или свадьба? Или не за горами годовщина свадьбы?</p>\r\n<p>Значит скоро - одно из самых ярких событий жизни. И это должен быть праздник, воспоминание о котором вы будете хранить, как самую большую семейную драгоценность. Вы мучаетесь в поисках \"незабываемого\" подарка? Выбор, конечно, за вами, но в одном вы можете быть абсолютно уверенными, нигде в мире ваш праздник не станет таким красочным, торжественным, запоминающимся и неповторимым, как на Бали!<br />На этих страницах мы бы хотели ознакомить вас со свадебной церемонией в традиционном стиле.</p>',	'<table class=\"sa-tours-table\" border=\"1\" width=\"627px\" cellpadding=\"7\">\r\n<tbody>\r\n<tr>\r\n<td width=\"57\">&nbsp; Время</td>\r\n<td width=\"359\">&nbsp; Программа</td>\r\n<td width=\"113\">Свадьба <br />&laquo;Делюкс&raquo; <br />без танцев</td>\r\n<td width=\"104\">Свадьба <br />&laquo;Делюкс&raquo; <br />&nbsp;</td>\r\n<td width=\"111\">Свадьба <br />&laquo;Королевская&raquo;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">14:00</td>\r\n<td width=\"359\">Приготовления к церемонии в номере молодоженов. Костюмы и макияж. Присутствуют: фотограф и русскоговорящий ассистент</td>\r\n<td rowspan=\"9\" width=\"113\">75424 руб.</td>\r\n<td rowspan=\"9\" width=\"104\">94545 руб.</td>\r\n<td rowspan=\"9\" width=\"111\">115791 руб.</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">16:00</td>\r\n<td width=\"359\">Приезд в Puri Belayu</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">16:00-17:00</td>\r\n<td width=\"359\">Переодевание в костюмы</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">17:00</td>\r\n<td width=\"359\">Начало церемонии</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">20:00</td>\r\n<td width=\"359\">Окончание церемонии</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">22:00</td>\r\n<td width=\"359\">Возвращение в отель</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">&nbsp;</td>\r\n<td width=\"359\">Свадьба &laquo;Делюкс&raquo; без танцев: &nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">19:00</td>\r\n<td width=\"359\">Окончание церемонии</td>\r\n</tr>\r\n<tr>\r\n<td width=\"57\">21:00</td>\r\n<td width=\"359\">Возвращение в отель &nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>Срок действия до 31.03.2016г.</p>\r\n<p><strong>Стоимость на двоих включает:</strong>&nbsp;</p>\r\n<table class=\"sa-tours-table\" border=\"1\" width=\"627px\" cellpadding=\"7\">\r\n<tbody>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Программа</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>Свадьба</p>\r\n<p>&laquo;Делюкс&raquo;</p>\r\n<p>без танцев</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>Свадьба</p>\r\n<p>&laquo;Делюкс&raquo;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>Свадьба</p>\r\n<p>&laquo;Королевская&raquo;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Продолжительность</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>3 ч</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>3 часа 50 мин</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>3 часа 50 мин</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Балийские свадебные костюмы для жениха и невесты</p>\r\n</td>\r\n<td width=\"113\">&nbsp;+</td>\r\n<td width=\"104\">\r\n<p>+ &nbsp; &nbsp;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Балийский священник</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>&nbsp;+ &nbsp;&nbsp;</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Балийцы с традиционными музыкальными инструментами</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>4 человека</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>4 человека</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>20 человек</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Факела</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Балийские женщины в красочных балийских костюмах, несущие цветочные и фруктовые композиции на голове</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>2 человека</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>2 человека</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>10 человек</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Мужчины, обслуживающие свадебную повозку с невестой и женихом</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>4 человека</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>4 человека</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>8 человек</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Балийцы, несущие большие традиционные зонты для невесты и жениха</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>2 человека</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>2 человека</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>4 человека</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Оркестр &laquo;Риндик&raquo;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>&nbsp;+</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+ &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Оркестр &laquo;гамелан&raquo;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>&nbsp;+</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+ &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Приветствие молодоженов главой Пури Белаю у павильона Кори Геде, а также приветствие традиционной музыкой у павильона Бале Кембар</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Балийские танцы</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>5 танцев</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>6 танцев</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Традиционный ужин и свадебный торт</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+ &nbsp; &nbsp;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>1 бутылка балийского вина или игристого вина (только для невесты и жениха)</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>-</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>2 бутылки минеральной воды (500мл) и 1 бутылка безалкогольного напитка или пива на человека</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+ &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Сертификат и памятный сувенир от Пури Белаю</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp; &nbsp;</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+ &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"423\">\r\n<p>Транспорт на все время свадьбы</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+</p>\r\n</td>\r\n<td width=\"104\">\r\n<p>+</p>\r\n</td>\r\n<td width=\"113\">\r\n<p>+ &nbsp;</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;&nbsp;</p>\r\n<p><strong>Дополнительно по желанию оплачивается:</strong></p>\r\n<p>Фото + альбом 240$</p>\r\n<p>Видео + CD 270$</p>\r\n<p>Фото + видео + альбом + CD 460$</p>\r\n<p>Русский ассистент/переводчик 150$</p>',	'svadebnaya-tseremoniya-na-obali',	'рублей',	75424.00,	0.00,	'',	0,	'AR',	1,	0,	'2016-03-30 02:45:12',	'2016-03-30 02:45:12',	0),
(7,	'Новый материал',	'',	'',	'novyy-material',	'руб./шт.',	0.00,	0.00,	'',	0,	'AR',	0,	0,	'2016-03-30 04:34:45',	'2016-03-30 04:34:45',	1);

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
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`, `remember_token`) VALUES
(1,	'fanamurov@ya.ru',	'$2y$10$SJzDIVLhyCdzOMxfnqAADOCoyzVgjwjmBlYaVWQlikchTd67mWPRa',	NULL,	'2016-03-17 06:51:06',	'4234',	'',	'2015-11-19 15:41:49',	'2016-03-30 05:45:56',	'NYtEkamQZHZHCFhrCLV9aqxWSPsgNfB0ZbDJUUEwjDgSX4l1M9G23H9rEq2g');

-- 2016-03-31 08:02:53
