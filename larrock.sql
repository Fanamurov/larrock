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
(4,	'Cтраницы',	'page',	'Страницы без привязки к определенному разделу',	'feed',	'a:6:{s:5:\"title\";a:6:{s:5:\"title\";s:18:\"Заголовок\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}s:5:\"valid\";s:16:\"max:255|required\";s:4:\"typo\";s:4:\"true\";}s:11:\"description\";a:3:{s:5:\"title\";s:25:\"Текст новости\";s:4:\"type\";s:8:\"textarea\";s:3:\"tab\";a:1:{s:4:\"main\";s:36:\"Заголовок, описание\";}}s:3:\"url\";a:4:{s:5:\"title\";s:22:\"URL материала\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:3:\"seo\";s:3:\"Seo\";}s:5:\"valid\";s:16:\"max:155|required\";}s:4:\"date\";a:4:{s:5:\"title\";s:27:\"Дата материала\";s:4:\"type\";s:4:\"date\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:17:\"date_format:Y-m-d\";}s:8:\"position\";a:5:{s:5:\"title\";s:25:\"Вес материала\";s:4:\"type\";s:4:\"text\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:7:\"integer\";s:7:\"default\";i:0;}s:6:\"active\";a:6:{s:5:\"title\";s:22:\"Опубликован\";s:4:\"type\";s:8:\"checkbox\";s:7:\"checked\";s:4:\"TRUE\";s:3:\"tab\";a:1:{s:5:\"other\";s:38:\"Дата, вес, активность\";}s:5:\"valid\";s:13:\"integer|max:1\";s:7:\"default\";i:1;}}',	's:0:\"\";',	'a:4:{i:0;s:3:\"seo\";i:1;s:6:\"images\";i:2;s:5:\"files\";i:3;s:9:\"templates\";}',	's:0:\"\";',	NULL,	1,	24,	1,	'2015-11-26 07:04:03',	'2015-12-04 03:16:49'),
(5,	'Меню сайта',	'menu',	'',	'menu',	'a:8:{s:5:\"title\";a:5:{s:5:\"title\";s:29:\"Название пункта\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:5:\"valid\";s:16:\"max:255|required\";s:4:\"typo\";s:4:\"true\";}s:8:\"category\";a:3:{s:5:\"title\";s:15:\"Вид меню\";s:4:\"type\";s:6:\"select\";s:7:\"default\";s:3:\"top\";}s:4:\"type\";a:2:{s:5:\"title\";s:6:\"Тип\";s:4:\"type\";s:4:\"text\";}s:6:\"parent\";a:4:{s:5:\"title\";s:16:\"Родитель\";s:4:\"type\";s:10:\"select_row\";s:7:\"default\";s:36:\"Это главный уровень\";s:15:\"options_connect\";a:2:{s:3:\"row\";s:5:\"title\";s:5:\"table\";s:4:\"menu\";}}s:7:\"connect\";a:2:{s:5:\"title\";s:10:\"Связь\";s:4:\"type\";s:4:\"text\";}s:3:\"url\";a:4:{s:5:\"title\";s:16:\"URL пункта\";s:14:\"in_table_admin\";s:4:\"TRUE\";s:4:\"type\";s:4:\"text\";s:5:\"valid\";s:16:\"max:155|required\";}s:8:\"position\";a:4:{s:5:\"title\";s:6:\"Вес\";s:4:\"type\";s:4:\"text\";s:5:\"valid\";s:7:\"integer\";s:7:\"default\";i:0;}s:6:\"active\";a:5:{s:5:\"title\";s:22:\"Опубликован\";s:4:\"type\";s:8:\"checkbox\";s:7:\"checked\";s:4:\"TRUE\";s:5:\"valid\";s:13:\"integer|max:1\";s:7:\"default\";i:1;}}',	's:0:\"\";',	'a:0:{}',	'a:0:{}',	NULL,	1,	8,	1,	'2015-12-05 14:58:18',	'2015-12-06 15:05:39');

DROP TABLE IF EXISTS `feed`;
CREATE TABLE `feed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `active` int(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `feed` (`id`, `title`, `category`, `short`, `description`, `url`, `date`, `position`, `active`, `created_at`, `updated_at`) VALUES
(1,	'Пример заголовка',	NULL,	'',	'<p>&laquo;Эдиториум.ру&raquo;&nbsp;&mdash; сайт, созданный по&nbsp;материалам сборника &laquo;О&nbsp;редактировании и&nbsp;редакторах&raquo; Аркадия Эммануиловича Мильчина, который с&nbsp;1944 года коллекционировал выдержки из&nbsp;статей, рассказов, фельетонов, пародий, писем и&nbsp;книг, где так или иначе затрагивается тема редакторской работы. Эта коллекция легла в&nbsp;основу обширной антологии, представляющей историю и&nbsp;природу редактирования в&nbsp;первоисточниках.</p>',	'primer-zagolovka',	'2015-11-11',	20,	1,	'2015-11-26 05:47:36',	'2015-12-05 13:26:13'),
(2,	'Новость об акции',	NULL,	'',	'<p>4324324</p>',	'ttrtr',	'2015-11-11',	23,	1,	'2015-11-26 06:10:16',	'2015-11-30 06:03:16'),
(3,	'Новый материал',	NULL,	'',	'<p>Текст новости</p>',	'URL',	'0000-00-00',	0,	0,	'2015-12-02 06:27:28',	'2015-12-02 06:27:28');

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_connect` int(11) NOT NULL,
  `param` text COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `images` (`id`, `name`, `mime`, `description`, `type`, `id_connect`, `param`, `position`, `created_at`, `updated_at`) VALUES
(5,	'foo.jpg',	'image/jpg',	'',	'page',	1,	'89ttrtr',	3,	'2015-12-03 02:13:09',	'2015-12-03 02:13:09'),
(9,	'MORNING_EROFEY_on_Vimeo.png',	'image/png',	'',	'page',	9,	'333',	0,	'2015-12-04 16:08:49',	'2015-12-04 16:08:49');

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
('2015_12_06_004411_create_menu_table',	6);

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
(13,	1,	'zlSDU4K06BvazeEDsWW0ySdmtykMNJJR',	'2015-12-02 07:58:20',	'2015-12-02 07:58:20');

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
(1,	'admin',	'admin',	NULL,	'2015-11-19 15:35:42',	'2015-11-19 15:35:42');

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2015-11-19 15:41:49',	'2015-11-19 15:41:49');

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
(5,	'tesr',	'2333',	'3',	1,	NULL,	'page',	'2015-12-02 05:58:07',	'2015-12-04 03:05:23'),
(6,	'Title material',	'',	'',	3,	NULL,	'page',	'2015-12-02 06:27:28',	'2015-12-02 06:27:28'),
(11,	'',	'',	'',	10,	NULL,	'page',	'2015-12-04 04:45:08',	'2015-12-04 04:45:08'),
(12,	'',	'',	'',	9,	NULL,	'page',	'2015-12-04 16:10:40',	'2015-12-04 16:10:40');

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
(1,	'Template2',	'Template1',	'page',	1,	'2015-12-03 17:27:58',	'2015-12-04 10:19:44'),
(2,	'Template1',	'Template1',	'page',	4,	'2015-12-04 03:20:21',	'2015-12-04 03:20:21'),
(3,	'Template1',	'Template1',	'page',	6,	'2015-12-04 03:36:36',	'2015-12-04 03:36:36'),
(4,	'Template1',	'Template1',	'page',	10,	'2015-12-04 04:45:08',	'2015-12-04 04:45:08'),
(5,	'Template1',	'Template1',	'page',	9,	'2015-12-04 16:10:40',	'2015-12-04 16:10:40');

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
(28,	NULL,	'ip',	'192.168.0.2',	'2015-12-01 03:27:35',	'2015-12-01 03:27:35');

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
(1,	'fanamurov@ya.ru',	'$2y$10$SJzDIVLhyCdzOMxfnqAADOCoyzVgjwjmBlYaVWQlikchTd67mWPRa',	NULL,	'2015-12-02 07:58:20',	'4234',	'',	'2015-11-19 15:41:49',	'2015-12-02 07:58:20');

-- 2015-12-06 16:48:43
