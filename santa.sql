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
(1,	'Новости',	'',	'',	'news',	0,	1,	'news',	1,	0,	1,	'0000-00-00 00:00:00',	'2016-03-31 02:54:30'),
(2,	'SEO-тексты',	'',	'',	'feed',	0,	1,	'seofish',	0,	0,	1,	'2015-12-08 07:25:12',	'2015-12-08 07:25:12'),
(306,	'Пляжный отдых',	'',	'',	'tours',	377,	2,	'plyazhnyy-otdykh',	1,	0,	1,	'2016-03-30 02:16:56',	'2016-03-30 02:16:56'),
(308,	'Страны',	'',	'',	'tours',	0,	1,	'strany',	1,	100,	1,	'2016-03-30 03:17:16',	'2016-03-30 03:17:16'),
(309,	'Индонезия',	'<p>Индонезия представляет собой скопление тропических островов, прекрасных и&nbsp;манящих, и&nbsp;вместе с&nbsp;тем очень разных. Вас непременно приведут в&nbsp;восторг чувственные балийские танцы, яркие огни ночного острова и&nbsp;романтические прогулки по&nbsp;вечернему пляжу. <br /><br />Свободный воздух гор, нестройное пение тропического леса и&nbsp;затаившееся спокойствие древнего вулканического озера Тоба создают неповторимую атмосферу философского спокойствия, которой так не&nbsp;хватает жителям больших и&nbsp;шумных городов. <br /><br />Чистые песчаные побережья, теплая, лазурная вода и&nbsp;мягкое южное солнце. В&nbsp;кронах деревьев гнездятся экзотические птицы, воздух наполнен сладкими, нежными запахами тропических цветов, а&nbsp;в&nbsp;подводных глубинах раскинулся целый мир из&nbsp;рыб, кораллов и&nbsp;других морских жителей.</p>',	'<p>Индонезия представляет собой огромное количество островов, объединенных в&nbsp;одно единое государство. Общая численность островов составляет 13677. Каждый остров индивидуален и&nbsp;отличается друг от&nbsp;друга.</p>\r\n<p>Эта страна очень многолика и&nbsp;индивидуальна. Описать её&nbsp;на&nbsp;нескольких страницах просто невозможно. Пейзажи немыслимой красоты. Рисовые террасы, которые окружены пальмами, тропические растения, деревья и&nbsp;цветы необычных нежных манящих ароматов, лазурное море, дарящее белым песчаным пляжам то&nbsp;нежно ласкающий бриз, сравнимый разве что с&nbsp;поцелуями, то&nbsp;страстные обжигающие объятия, обрушивающиеся на&nbsp;берег красивыми пенными волнами. Чудесные картины и&nbsp;скульптуры из&nbsp;дерева, маски, сделанные местными мастерами, всемирно известный батик и&nbsp;нежные шали, вышитые вручную, украшения из&nbsp;жемчуга, черепашьего панциря и&nbsp;раковин, вызывают восхищение!</p>\r\n<p><strong>Географическое положение</strong></p>\r\n<p>Индонезия&nbsp;&mdash; государство в&nbsp;Юго-Восточной Азии, расположенное на&nbsp;островах Малайского архипелага и&nbsp;западной части острова Новая Гвинея. Это крупнейшее в&nbsp;мире островное государство. Всего в&nbsp;его состав входит 13667 островов, из&nbsp;которых заселены чуть менее 1000, большинство других представляет собой отдельные скалы или небольшие атоллы. На&nbsp;островах большое количество вулканов (около 400, в т. ч. более 100&nbsp;&mdash; действующие); самый высокий из&nbsp;них&nbsp;&mdash; Керинчи (3800 м&nbsp;над уровнем моря)&nbsp;&mdash; находится на&nbsp;Суматре. В&nbsp;1883&nbsp;г. в&nbsp;результате извержения вулкана Кракатау, расположенного на&nbsp;небольшом острове между Явой и&nbsp;Суматрой, возникла 20-метровая морская волна, а&nbsp;вулканический пепел покрыл почти треть территории Индонезии.</p>\r\n<p><strong>Климат</strong></p>\r\n<p>Экваториальный морской. Солнечная погода сохраняется практически весь год. В&nbsp;Индонезии тропический климат с&nbsp;достаточно ровной температурой на&nbsp;протяжении всего года: 28&deg; - 33&nbsp;&deg;C. Климатические условия значительно отличаются по&nbsp;разным островам, но&nbsp;в&nbsp;целом можно выделить два сезона: дождливый&nbsp;&mdash; с&nbsp;ноября по&nbsp;февраль и&nbsp;сухой&nbsp;&mdash; с&nbsp;марта по&nbsp;октябрь. Влажность, довольно высокая, в&nbsp;среднем от&nbsp;75 до&nbsp;100%, переносится на&nbsp;удивление легко. Апрель и&nbsp;октябрь&nbsp;&mdash; наиболее непредсказуемые месяцы из-за смены муссонов. Среднегодовая температура воды в&nbsp;среднем составляет 24&nbsp;&mdash; 26&nbsp;&deg;C.</p>\r\n<p><strong>Природа</strong></p>\r\n<p>Природа архипелага богата и&nbsp;разнообразна: влажные тропические леса, удивительная флора и&nbsp;фауна, величественные вулканы и&nbsp;голубые лагуны. Индонезия&nbsp;&mdash; излюбленное место путешественников. Самобытная культура, национальные парки и&nbsp;заповедники, превосходные курорты с&nbsp;множеством развлечений создают неповторимую атмосферу для полноценного отдыха.</p>\r\n<p>Природа Индонезии&nbsp;&mdash; самая богатая на&nbsp;нашей планете. Только две страны в&nbsp;мире могут похвастаться таким небывалым разнообразием&nbsp;&mdash; это Бразилия и&nbsp;Индонезия. И&nbsp;только в&nbsp;Индонезии вы&nbsp;можете увидеть нетронутую природу и&nbsp;Азии и&nbsp;Австралии. Почему-то считается, что кенгуру живут только в&nbsp;Австралии, на&nbsp;самом&nbsp;же деле их&nbsp;можно увидеть и&nbsp;на&nbsp;восточных островах индонезийского архипелага. Уже в&nbsp;50 километрах восточнее Бали, на&nbsp;острове Ломбок, водятся кенгуру и&nbsp;другие представители австралийской флоры и&nbsp;фауны. Путешествуя по&nbsp;островам, вы&nbsp;можете встретить тигра или носорога, увидеть черных обезьян и&nbsp;белых павлинов, пообщаться с&nbsp;умными орангутангами, послушать пение райских птиц или покормить прожорливых варанов Комодо&nbsp;&mdash; последних динозавров на&nbsp;Земле.</p>\r\n<p><strong>Экономика</strong></p>\r\n<p>Индонезия&nbsp;&mdash; индустриально-аграрная страна. Основ&shy;ная отрасль промышленности&nbsp;&mdash; добыча нефти и&nbsp;газа (90% иностранными, главным образом, американски&shy;ми фирмами), олова, угля, бокситов, марганцевых, медных, никелевых руд, асбеста, асфальта, фосфори&shy;тов, золота, серебра, поваренной соли. Основные отрас&shy;ли промышленности: нефте- и&nbsp;газопереработка, метал&shy;лургия, машиностроение, химическая промышленность, пищевкусовая и&nbsp;текстильная промышленность. Важное значение имеет рыболовство и&nbsp;рыборазведение. Изготавливают древесину ценных пород. Сохраняются традиционные ремесла: производство батика, чеканных изделий из&nbsp;серебра, керамических сосудов, художественная резьба по&nbsp;кости, плетение циновок, шляп и&nbsp;др. Боль&shy;шое значение имеет иностранный туризм. Экспорт: нефть и&nbsp;нефтепродукты, сжиженный природный газ, продукция электрической и&nbsp;электронной промышленности, уголь, медь, олово, никель, текстиль, древесина ценных пород, каучук, рыбопродукты, кофе, перец, чай) хинного дерева, пряности. Импорт: продукция тяжело&shy;го машиностроения и&nbsp;химической промышленности, транспортное и&nbsp;электронное оборудование, минеральные продукты, основные промышленные товары. Основные внешнеторговые партнеры: Япония, США, Сингапур, Германия.</p>\r\n<p><strong>Основные достопримечательности</strong></p>\r\n<p>Выбирая туры на <strong>Бали</strong>, лежащий между островами Ява и&nbsp;Ломбок, помните, что он&nbsp;считается наиболее освоенной туристической зоной Индонезии. Протяженность этого большого острова&nbsp;&mdash; 150 км. с&nbsp;востока на&nbsp;запад и&nbsp;80 км. с&nbsp;севера на&nbsp;юг. Высота до&nbsp;3142 м. (вулкан Агунг). Общая площадь&nbsp;&mdash; 5561 кв. км. Население&nbsp;&mdash; 2,9 млн. человек. Столица и&nbsp;административный центр&nbsp;&mdash; город Денпасар, расположенный в&nbsp;южной части острова, сильно отличается от&nbsp;привычного многим образа типичной азиатской столицы&nbsp;&mdash; неожиданно тихий и&nbsp;зелёный город, наполненный ароматами растений и&nbsp;с&nbsp;необычно свежим воздухом. Множество небольших зданий традиционной архитектуры, этнографический музей &laquo;Неген-Пропинси&raquo;, Центр искусств Таман-Веди-Будайя, тихие уютные улочки, постоянно сияющее солнце&nbsp;&mdash; всё это придает городу особое очарование. Неподалёку находится международный аэропорт Нгура-Раи&nbsp;&mdash; главный транспортный узел острова. <br /> Сам &laquo;Остров богов&raquo;, как его еще называют при выборе горящих туров на&nbsp;Бали, привлекает туристов своими девственными ландшафтами, тропическими лесами и&nbsp;величественными вулканами Кинтамини, Гунунг-Батур (1717 м) и&nbsp;Гунунг-Агунг, а&nbsp;также храмами и&nbsp;превосходными курортами с&nbsp;голубыми лагунами и&nbsp;густыми тропическими джунглями вокруг. Главными достопримечательностями острова, с&nbsp;которыми стоит ознакомится в&nbsp;выбирая туры на&nbsp;Бали это расположенный на&nbsp;склоне священной горы Гунунг-Агунг (действующий вулкан!), в&nbsp;85 км. от&nbsp;Нуса Дуа, храмовый комплекс Пура-Бесаких (Храм Матери), возвышающийся на&nbsp;приморской скале Танан-Лот (&laquo;Храм Моря&raquo;), священный &laquo;лес обезьян&raquo; Алас-Кедатон, окруженный водой &laquo;Королевский храм&raquo; Taман-Аюн в&nbsp;Meнгви, &laquo;храм посреди озера&raquo; Уюн-Дану, знаменитый ремесленный и&nbsp;этнографический центр с&nbsp;музеем &laquo;Пури-Лукисан&raquo; в&nbsp;Убуде, скальные храмы в&nbsp;Педженге, Йех-Пулу и&nbsp;Пура-Самуан-Тига, &laquo;остров черепах&raquo; Серанган, селение мастеров-ювелиров Челук, монастырь и&nbsp;священный источник Пура Тирта-Эмпул в&nbsp;Тампаксиринге, храм Пура-Панатаран-Саси, королевская усыпальница Гунунг-Кави (X-XI вв.), а&nbsp;также &laquo;пещера летучих мышей&raquo; Гоа-Лавах, огромная галерея скальных барельефов в&nbsp;Ге-Пулу, водопад Гит-Гит (40 м), &laquo;Слоновая пещера&raquo; Гоя-Гаджа со&nbsp;статуей Ганеши (XIII в.) и&nbsp;расположенное в&nbsp;кратере потухшего вулкана озеро Батур с&nbsp;шикарным ботаническим садом вокруг. Все это просто нужно увидеть, поэтому горящие туры на&nbsp;Бали&nbsp;&mdash; это идеальный выбор для отдыха! Главная причина, по&nbsp;которой выбирают туры на&nbsp;Бали&nbsp;&mdash; это его пляжи и&nbsp;морские курорты. Самые популярные курорты острова&nbsp;&mdash; Санур, Кута, Джимбаран, Беноа, Тубан-Легиан, Нуса-Дуа, Канди-Даса, Убуд и&nbsp;Ловина. Здесь сосредоточены шикарные пятизвездочные отели и&nbsp;уютные частные гостиницы, утопающие в&nbsp;зелени сады и&nbsp;парки, многочисленные маленькие музеи и&nbsp;прекрасные набережные и&nbsp;пляжи. Подводный мир рядом с&nbsp;островом поражает своим великолепием, а&nbsp;участки вокруг островов Менджанган, Гили-Тепеконг, Гили-Виах, а&nbsp;Гили-Минпанг, Нуса-Пенида и&nbsp;Нуса-Лембонган широко известны своими прекрасными ландшафтами у&nbsp;дайверов всего мира.</p>\r\n<p><strong>Суматра</strong>&nbsp;&mdash; шестой по&nbsp;величине остров в&nbsp;мире, протяженностью около тысячи миль. Главный интерес представляют его красочные пейзажи и&nbsp;туземные культуры. Большинство путешественников летит в&nbsp;Медан, чтобы увидеть высокогорье Батак и&nbsp;озеро Тоба, площадью 1700 кв&nbsp;км, крупнейшее озеро в&nbsp;Юго-Восточной Азии. Оно расположено в&nbsp;100 км&nbsp;к&nbsp;югу от&nbsp;Медана на&nbsp;высоте 900 м&nbsp;в&nbsp;кратере доисторического вулкана, его глубина достигает 450 метров. Озеро Тоба стоит посетить из-за горных пейзажей, прохладного климата и&nbsp;живописных деревень Батака.</p>\r\n<p>Область Минангкабау на&nbsp;западе Суматры также отличается захватывающими природными ландшафтами и&nbsp;обладает немалым культурным значением. Она простирается от&nbsp;Паданга на&nbsp;побережье до&nbsp;Букиттинги, расположенного в&nbsp;горах. Мингкабау известен тем, что здесь сохранились традиционные мусульманские матрилинейные сообщества.</p>\r\n<p>Бенкулу&nbsp;&mdash; когда-то был британской факторией, здесь до&nbsp;сих пор сохранился форт Мальборо, построенный в&nbsp;1762 году. Сэр Стэмфорд Раффлз, основатель Сингапура, был лейтенант-губернатором Бенкулу в&nbsp;1818&mdash;1823 годах. Гигантские цветки раффлезии, растущие в&nbsp;ботанических садах Дендам Таксуда, названы в&nbsp;его честь.</p>\r\n<p>Палембанг был в&nbsp;прошлом столицей великой морской империи, хоть это и&nbsp;не&nbsp;отражено в&nbsp;масштабных архитектурных памятниках, но&nbsp;в&nbsp;музее Румах Бари имеются мегалитические индуистские и&nbsp;буддистские статуи, а&nbsp;традиционные формы искусства, музыка и&nbsp;танцы восходят к V|| веку. В&nbsp;наши дни богатство Палембанга связано с&nbsp;нефтью и&nbsp;нефтехимической промышленностью.</p>\r\n<p><strong>Ява </strong>&nbsp;&mdash; остров, сравнимый по&nbsp;размерам с&nbsp;Англией, удивительно плодороден, его почвы обогащены вулканическим пеплом, извергнутым в&nbsp;былые времена из&nbsp;жерл 121 вулкана. Тридцать из&nbsp;них действуют поныне, и&nbsp;периодически здесь происходят извержения, несущие смерть и&nbsp;разрушения, но&nbsp;при этом и&nbsp;восстанавливающие плодородие. Несмотря на&nbsp;это на&nbsp;Яве можно найти безлюдные территории.</p>\r\n<p><strong>&laquo;Парк Индонезии в&nbsp;миниатюре&raquo;</strong>, демонстрирует возможности страны. Он&nbsp;расположен в&nbsp;южных окрестностях Джакарты и&nbsp;состоит из&nbsp;27 павильонов, каждый из&nbsp;которых посвящен отдельной провинции и&nbsp;возведет с&nbsp;использованием традиционных материалов и&nbsp;методов, воспроизводя региональные архитектурные стили. В&nbsp;каждом павильоне расположена выставка региональных костюмов, рукоделий и&nbsp;культурных ценностей. Все они расположены вокруг озера, на&nbsp;поверхности которого установлена трехмерная рельефная карта Индонезийского архипелага.</p>\r\n<p>Туристы не&nbsp;часто обращают внимание на&nbsp;Северную Яву, но&nbsp;здесь есть на&nbsp;что посмотреть.</p>\r\n<p>В&nbsp;Сиребоне это два дворца, Кратон Ксепухан и&nbsp;Кратон Каноман, датируемые 1678 годом, Большая Мечеть. Вне Сиребона примечателен Таман арум Суньяраги. Изначально это была крепость, построенная против датчан в&nbsp;1702 году, но&nbsp;в&nbsp;1852 китайский архитектор с&nbsp;помощью кораллов, камней и&nbsp;известняка создал из&nbsp;нее сад для отдохновения и&nbsp;медитаций Сиребонских раджей. Сиребон знаменит прилежащими к&nbsp;нему поселениями художников и&nbsp;ремесленников.</p>\r\n<p><strong>Убуд</strong>, расположенный на&nbsp;глубине острова Бали, является центром искусств, как балийских, так и&nbsp;иноземных. Он&nbsp;находится в&nbsp;прекрасной гористой местности среди живописных рисовых террас и&nbsp;окружен деревнями, которые специализируются на&nbsp;различных ремеслах и&nbsp;видах искусства. Далее к&nbsp;северу в&nbsp;кратере массивного вулкана расположено крупнейшее на&nbsp;Бали озеро Батур. С&nbsp;кромки кратера можно спуститься к&nbsp;озеру по&nbsp;узкой тропе и&nbsp;взять лодку до&nbsp;Труньяна, одной из&nbsp;немногих сохранившихся деревень бали-ага, также посетите храм Пура Улун Дану, возвышающийся на&nbsp;кромке кратера. В&nbsp;Кинтамани, который находится далее по&nbsp;кромке, каждые три дня устраивается ярмарка. Есть возможность взобраться на&nbsp;гору Гунунгбатур и&nbsp;осмотреть четыре ее&nbsp;кратера.</p>\r\n<p><strong>Ломбок</strong> населен в&nbsp;основном мусульманами, он&nbsp;суше и&nbsp;плотность населения меньше, чем на&nbsp;Бали. Административным центром региона является</p>\r\n<p><strong>Матарам</strong>, но&nbsp;большенство культурных и&nbsp;архитектурных достопримечательностей сосредоточены в&nbsp;Канкранегаре, старой королевской столице, до&nbsp;которой несложно добраться. посетите храмы Пура Меру, королевские сады Пура Майюра и&nbsp;скромный королевский дворец</p>\r\n<p>Между Сумбавой и&nbsp;Флоресом находится остров <strong>Комодо</strong>, где водится крупнейший в&nbsp;мире варан, который стал туристической достопримечательностью.</p>\r\n<p>На&nbsp;горе <strong>Крелл Муту</strong>, в&nbsp;южной части Флореса, расположены три кратерных озера, которые меняют цвет без всякой видимой причины.</p>\r\n<p><strong>Сумба</strong> находится вдали от&nbsp;проторенных маршрутов. Главной его достопримечательностью является ежегодная церемония Пасола, во&nbsp;время которой устраиваются ритуальные бои между группами вооруженных всадников.</p>\r\n<p>В&nbsp;Сулавеси попасть довольно сложно, остров имеет форму звезды, что затрудняет внутреннее перемещение по&nbsp;нему, но&nbsp;здесь множество интересных объектов. Уджунгпанданг был столицей торговой империи бугисов, пока датчане не&nbsp;захватили ее, форт Ротттердам ныне превращен в&nbsp;музей, но&nbsp;лодки бугисов все еще входят в&nbsp;док у&nbsp;Паотере. Долина Бада с&nbsp;ее&nbsp;огромными каменными мегалитами, озеро Позо и&nbsp;Национальный парк Лоре Линду.</p>\r\n<p>В&nbsp;северном Сулавеси местными достопримечательностями являются Бунакен-Манадский морской национальный парк, который предлагает превосходную возможность подводного плавания и&nbsp;дайвинга; Национальный парк Тангкоко Батуанус; озеро Тондано и&nbsp;Сад орхидей Таман Анггрек в&nbsp;Айрмадди.</p>',	'tours',	308,	2,	'indoneziya',	1,	0,	1,	'2016-03-30 03:17:29',	'2016-04-02 13:33:54'),
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
(4,	13,	'App\\Models\\Feed',	'images',	'Feed-13-213jpg',	'Feed-13-213jpg.jpg',	'media',	10959,	'[]',	'[]',	4,	'2016-03-31 05:26:12',	'2016-03-31 05:26:12'),
(5,	27,	'App\\Models\\Page',	'images',	'Page-27-nata6077jpg',	'Page-27-nata6077jpg.jpg',	'media',	97768,	'[]',	'[]',	5,	'2016-04-02 12:09:26',	'2016-04-02 12:09:26'),
(6,	29,	'App\\Models\\Page',	'images',	'Page-29-blajpg',	'Page-29-blajpg.jpg',	'media',	214395,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	6,	'2016-04-02 12:31:53',	'2016-04-02 12:31:53'),
(7,	29,	'App\\Models\\Page',	'images',	'Page-29-biblio-globusjpg',	'Page-29-biblio-globusjpg.jpg',	'media',	214928,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	6,	'2016-04-02 12:31:53',	'2016-04-02 12:31:53'),
(8,	29,	'App\\Models\\Page',	'images',	'Page-29-bg-gramota1jpg',	'Page-29-bg-gramota1jpg.jpg',	'media',	156695,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	6,	'2016-04-02 12:31:53',	'2016-04-02 12:31:53'),
(9,	29,	'App\\Models\\Page',	'images',	'Page-29-advantika-0jpg',	'Page-29-advantika-0jpg.jpg',	'media',	238110,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	6,	'2016-04-02 12:31:53',	'2016-04-02 12:31:53'),
(10,	29,	'App\\Models\\Page',	'images',	'Page-29-bank-atbjpeg',	'Page-29-bank-atbjpeg.jpeg',	'media',	356074,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	7,	'2016-04-02 12:31:53',	'2016-04-02 12:31:53'),
(11,	29,	'App\\Models\\Page',	'images',	'Page-29-aleanjpg',	'Page-29-aleanjpg.jpg',	'media',	313800,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	7,	'2016-04-02 12:31:53',	'2016-04-02 12:31:53'),
(12,	29,	'App\\Models\\Page',	'images',	'Page-29-izobrazhenie0001jpg',	'Page-29-izobrazhenie0001jpg.jpg',	'media',	51749,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	8,	'2016-04-02 12:31:55',	'2016-04-02 12:31:55'),
(13,	29,	'App\\Models\\Page',	'images',	'Page-29-blagodarstvennoe-pismo-ot-prezentjpg',	'Page-29-blagodarstvennoe-pismo-ot-prezentjpg.jpg',	'media',	255079,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	9,	'2016-04-02 12:31:55',	'2016-04-02 12:31:55'),
(14,	29,	'App\\Models\\Page',	'images',	'Page-29-sertifikatjpg',	'Page-29-sertifikatjpg.jpg',	'media',	128477,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	10,	'2016-04-02 12:31:55',	'2016-04-02 12:31:55'),
(15,	29,	'App\\Models\\Page',	'images',	'Page-29-natali-turs1jpg',	'Page-29-natali-turs1jpg.jpg',	'media',	235349,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	10,	'2016-04-02 12:31:55',	'2016-04-02 12:31:55'),
(16,	29,	'App\\Models\\Page',	'images',	'Page-29-blagodarstvennoe-pismo-nautilus1jpg',	'Page-29-blagodarstvennoe-pismo-nautilus1jpg.jpg',	'media',	272079,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	11,	'2016-04-02 12:31:55',	'2016-04-02 12:31:55'),
(17,	29,	'App\\Models\\Page',	'images',	'Page-29-delfin-gramotajpg',	'Page-29-delfin-gramotajpg.jpg',	'media',	238765,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	12,	'2016-04-02 12:31:55',	'2016-04-02 12:31:55'),
(18,	29,	'App\\Models\\Page',	'images',	'Page-29-skae-blagodarnostey0001jpg',	'Page-29-skae-blagodarnostey0001jpg.jpg',	'media',	220507,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	13,	'2016-04-02 12:31:56',	'2016-04-02 12:31:56'),
(19,	29,	'App\\Models\\Page',	'images',	'Page-29-skae-blagodarnostey0002jpg',	'Page-29-skae-blagodarnostey0002jpg.jpg',	'media',	195459,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	14,	'2016-04-02 12:31:56',	'2016-04-02 12:31:56'),
(20,	29,	'App\\Models\\Page',	'images',	'Page-29-skan-blagodarnostey0009-0jpg',	'Page-29-skan-blagodarnostey0009-0jpg.jpg',	'media',	132921,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	15,	'2016-04-02 12:31:56',	'2016-04-02 12:31:56'),
(21,	29,	'App\\Models\\Page',	'images',	'Page-29-unnamed-6jpg',	'Page-29-unnamed-6jpg.jpg',	'media',	53861,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	16,	'2016-04-02 12:31:56',	'2016-04-02 12:31:56'),
(22,	29,	'App\\Models\\Page',	'images',	'Page-29-skan-blagodarnostey0003jpg',	'Page-29-skan-blagodarnostey0003jpg.jpg',	'media',	274422,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	17,	'2016-04-02 12:31:57',	'2016-04-02 12:31:57'),
(23,	29,	'App\\Models\\Page',	'images',	'Page-29-skan-blagodarnostey0010jpg',	'Page-29-skan-blagodarnostey0010jpg.jpg',	'media',	166536,	'[]',	'{\"alt\":\"\",\"gallery\":\"serts\"}',	18,	'2016-04-02 12:31:57',	'2016-04-02 12:31:57'),
(24,	309,	'App\\Models\\Category',	'images',	'Category-309-ind2jpg',	'Category-309-ind2jpg.jpg',	'media',	69406,	'[]',	'[]',	19,	'2016-04-02 13:33:21',	'2016-04-02 13:33:21'),
(25,	309,	'App\\Models\\Category',	'images',	'Category-309-indjpg',	'Category-309-indjpg.jpg',	'media',	75959,	'[]',	'{\"alt\":\"\",\"gallery\":\"\"}',	25,	'2016-04-02 13:33:21',	'2016-04-02 13:33:21'),
(26,	309,	'App\\Models\\Category',	'images',	'Category-309-ind1jpg',	'Category-309-ind1jpg.jpg',	'media',	64246,	'[]',	'[]',	19,	'2016-04-02 13:33:21',	'2016-04-02 13:33:21'),
(27,	309,	'App\\Models\\Category',	'images',	'Category-309-ind3jpg',	'Category-309-ind3jpg.jpg',	'media',	71150,	'[]',	'[]',	19,	'2016-04-02 13:33:21',	'2016-04-02 13:33:21'),
(28,	309,	'App\\Models\\Category',	'images',	'Category-309-ind4jpg',	'Category-309-ind4jpg.jpg',	'media',	39011,	'[]',	'[]',	20,	'2016-04-02 13:33:21',	'2016-04-02 13:33:21'),
(29,	309,	'App\\Models\\Category',	'images',	'Category-309-ind5jpg',	'Category-309-ind5jpg.jpg',	'media',	57922,	'[]',	'[]',	20,	'2016-04-02 13:33:21',	'2016-04-02 13:33:21');

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
(26,	'Контакты',	'<h1>Контакты \"Санта Авиа\" г. Хабаровск</h1>\r\n<p>г. Хабаровск, ул. Шеронова, 115<br />тел:+7 (4212) 45-99-05<br />e-mail: <a href=\"mailto:tur@santa-avia.ru\">tur@santa-avia.ru</a></p>\r\n<p>Здание &laquo;Премьера&raquo;, вход с торца (новое здание с цветными балконами)</p>\r\n<p>09:00 - 19:00 (Пн - Пт) <br />10:00 - 15:00 (Сб) <br />10:00 - 15:00 (Праздничные дни)</p>\r\n<p><strong>Воскресенье выходной</strong></p>',	'kontakty',	'2016-03-16',	0,	1,	'2016-03-16 05:06:40',	'2016-03-31 04:38:20'),
(27,	'О компании',	'<p>Добро пожаловать на сайт туристической компании &laquo;Санта-Авиа&raquo;! <br /><br />Туристическая компания &laquo;Санта-Авиа&raquo; - одна из лидирующих на Дальнем Востоке. За нас говорит наш опыт &ndash; более 10 лет в туризме, а также благодарные отзывы наших клиентов. Ежегодно нам доверяют свой отпуск более 10&nbsp;000 туристов. Мы гордимся тем, что Вы доверяете нам работать над Вашим отдыхом, и делаем все, чтобы он стал комфортным и незабываемым! <br /><br /></p>\r\n<p><img title=\"NATA6077.jpg\" src=\"../../../media/Page/Page-27-nata6077jpg.jpg\" alt=\"NATA6077.jpg\" width=\"864\" height=\"576\" /></p>\r\n<p><br /><strong>Принципы нашей работы просты и прозрачны:</strong> это сочетание идеального сервиса и индивидуального подхода к каждому клиенту. <br /><br />С самого первого года основа работы нашей компании &ndash; это идеальный сервис. Как мы этого добились? С помощью постоянного развития наших работников.&nbsp; Каждый из наших менеджеров &ndash; эксперт своего направления, способный качественно проконсультировать и организовать тур любой сложности. Менеджеры регулярно проходят обучение и аттестацию, тем самым постоянно повышая уровень своего мастерства в туризме. <br /><br />На нашем сайте предусмотрен удобный <strong>поиск туров</strong>. Введите параметры поиска и легко найдете то, о чем Вы мечтали! <br /><br /><strong>В нашей компании Вам никогда не предложат то, что Вам не нужно.</strong> Мы не нацелены на просто получение денег от наших клиентов. Мы делаем все для того, чтобы клиент остался доволен (а еще лучше, пришел в восторг) и обратился к нам снова. К слову, около 70% наших туристов рекомендуют нас друзьям и знакомым, это ли не показатель отменного качества?&nbsp;<br /><br />Особое внимание мы уделяем тем клиентам, которые выбирают эксклюзивные путешествия. Сразу заметим, что &laquo;эксклюзивные&raquo; - не обязательно означает &laquo;дорогие&raquo;. Это может быть уникальное путешествие по вполне адекватной цене, в зависимости от Ваших пожеланий. <br /><br />&laquo;Санта-Авиа&raquo; работает не только в качестве турагента, но и в качестве туроператора, и не раз получала награды за разработку и воплощение в жизнь самых сложных маршрутов. Таким образом, спектр туристических услуг, которые мы оказываем нашим клиентам, практически неограничен.&nbsp;<br /><br />Мы рады организовать отдых не только отдельных туристов, но и целых компаний. Среди наших клиентов &ndash; крупные организации города. Нашим корпоративным клиентам мы предлагаем особые условия, ознакомиться с которыми Вы можете в разделе <strong><a href=\"http://www.santa-avia.ru/uslugi/corporate/\">&laquo;Корпоративное обслуживание&raquo;</a></strong>. <br /><br />Информационная поддержка клиентов. Чтобы держать наших друзей в курсе акций и специальных предложений, раз в месяц мы делаем email-рассылку, куда входит все самое интересное. Кроме того, у нас есть и кое-что и для любителей &laquo;горяченького&raquo; - ежедневно наш отдел горящих туров мониторит предложения от туроператоров и отправляет нашим туристам лучшие цены. Так что, если Вы &ndash; экономный турист, то советуем Вам подписаться на рассылку <strong><a href=\"http://www.santa-avia.ru/hot_tours/\">горящих туров</a></strong>. Когда Вы найдете то, что искали, нажмите &laquo;отписаться&raquo; - и мы не будем больше Вас беспокоить :)<br /><br />Мы открыты и дружелюбны! Вступайте в наши группы в <a href=\"http://www.odnoklassniki.ru/group53664952418315\">Одноклассниках</a> и <a href=\"http://vk.com/santa_avia\">ВКонтакте</a>, подписывайтесь на нашу страничку в <a href=\"http://instagram.com/santa_avia\">Инстаграм</a>, жмите \"Нравится\" на <a href=\"https://www.facebook.com/santaavia\">Фейсбуке</a>,&nbsp;чтобы получать не только лучшие цены на туры и новинки, но и порцию отменного позитива! Кроме того, в социальных сетях можно делиться мнением об отдыхе и компании, оставлять отзывы и фотографии из отпуска! Давайте дружить! <br /><br />Если у Вас возникли вопросы или предложения &ndash; пожалуйста, обратитесь в нашу <strong><a href=\"http://www.santa-avia.ru/o-kompanii/zabota-o-klientakh/\">&laquo;Заботу о клиентах&raquo;</a></strong>.&nbsp; Каждое обращение будет тщательно рассмотрено, а критика поможет нам стать лучше, ведь предела у совершенства нет! <br /><br />Чтобы организовать Ваш отдых, просто обратитесь к нам и расслабьтесь! Без ложной скромности, &laquo;Санта-Авиа&raquo; - профессионал в туризме! <br /><br />Мы сделаем все, чтобы Ваш отдых удался, ведь это &ndash; наша работа.&nbsp;</p>',	'o-kompanii',	'2016-03-21',	0,	1,	'2016-03-21 02:55:58',	'2016-04-02 12:10:00'),
(28,	'Вакансии «Санта Авиа»',	'<p>Работа в туризме &ndash; это сфера, где нет потолка и предела совершенству. Это постоянное развитие Вас как личности и карьерный рост в дружном коллективе единомышленников.&nbsp;<br /><br />Мы постоянно расширяемся, поэтому всегда рады энергичным и&nbsp;инициативным сотрудникам!<br /><br />Если у Вас активная жизненная позиция, Вы ответственный человек, стремитесь к постоянному развитию и умеете работать в команде, ждем Ваше резюме!&nbsp;</p>\r\n<h5>&nbsp;</h5>\r\n<h5>Сейчас в нашей Компании открыты следующие вакансии:</h5>\r\n<h4>&nbsp;</h4>\r\n<h4>МЕНЕДЖЕР ПО ТУРИЗМУ</h4>\r\n<p><strong>Требования:</strong></p>\r\n<ul>\r\n<li>Опыт работы в турагентстве от 1 года.</li>\r\n<li>Уверенные знания основных направлений, курортов.</li>\r\n<li>Отличное знание отельной базы массовых направлений.</li>\r\n<li>Знание техник продаж и грамотное их применение на практике.</li>\r\n<li>Высокоразвитые коммуникативные навыки.</li>\r\n<li>Хорошее владение ПК и офисной техникой.</li>\r\n<li>Грамотная русская речь.</li>\r\n<li>Гражданство РФ.</li>\r\n</ul>\r\n<p><br /><strong>Обязанности:</strong><br />Работа с клиентами&sbquo; оформление туров.<br /><strong><br />Условия:</strong></p>\r\n<ul>\r\n<li>Оформление согласно ТК РФ.</li>\r\n<li>Дружный сплоченный коллектив.</li>\r\n<li>Посещение семинаров и участие в инфотурах.</li>\r\n<li>Реальные перспективы карьерного роста.</li>\r\n<li>Обучение, регулярные тренинги, профессиональный рост.</li>\r\n<li>Скидки на приобретение туристической путевки.</li>\r\n<li>Системы поощрения сотрудников.</li>\r\n<li>Зарплата:&nbsp; оклад + %&nbsp;</li>\r\n</ul>\r\n<p><br />Телефон/факс: (4212)&nbsp;47-03-01<br />E-mail:&nbsp;<a href=\"mailto:office@santa-avia.ru\">office@santa-avia.ru</a></p>',	'vakansii-santa-avia',	'2016-04-02',	0,	1,	'2016-04-02 12:21:32',	'2016-04-02 12:22:16'),
(29,	'Почему покупать туры надо только у нас',	'<p>Конечно, туристических фирм на рынке&nbsp;много, и Вы можете воспользоваться услугами любой из них. Но мы - намного лучше, чем наши конкуренты!<br /><br />Без ложной скромности, туристическая компания \"Санта-Авиа\" - профессионал туристического бизнеса, это подтвердят годы нашей работы и наши клиенты, которые обращаются к нам год за годом.<br /><br /></p>\r\n<h3>Почему мы лучшие?&nbsp;С легкостью назовем 11 причин!</h3>\r\n<p><br />1. Наш опыт работы в туризме - более 10 лет. Говорит сам за себя. Мы переживали экономические кризисы, рост курса доллара и другие неприятности и всегда оставались лидерами. Потому что мы любим туризм и умеем его готовить;<br /><br />2. <a href=\"http://www.santa-avia.ru/o-kompanii/nasha-komanda/\">Наши сотрудники</a> - это лучшие из лучших, мы постоянно расширяемся и совершенствуемся, организуем обучающие семинары и курсы за счет компании. Потому что мы заинтересованы в профессиональном росте каждого из работников;<br /><br />3. 70% наших клиентов рекомендуют нас своим друзьям и знакомым. И даже целые организации, например, \"МЖК-Хабаровский\", летают только с \"Санта-Авиа\"!<br /><br />4. Все туры в одном месте. В \"Санта-Авиа\" Вам предложат только качественные туры от проверенных операторов. Кроме того, мы - одни из немногих на Дальнем Востоке туристических агентств, кто работает в том числе&nbsp;и как туроператор, разрабатывая <a href=\"http://www.santa-avia.ru/vidy-otdykha/komibinirovannye-tury/\">самые сложные и нестандартные маршруты</a>.&nbsp;(Кстати, уникальный маршрут не обязательно означает дорогой.)&nbsp;Выбор путешествия ограничен только Вашей фантазией, просто доверьте нам сделать нашу работу&nbsp;;)<br /><br />5. Быстрое оформление тура. Разработанная в нашей компании система работы с клиентом позволяет экономить Ваше время, чтобы Вы тратили его на другие полезные и приятные дела;<br /><br />6. Мы - белые. Пробиваем чеки, платим налоги и спим спокойно.&nbsp;Наши туристы защищены законом и страховыми обязательствами туроператоров;<br /><br />7. Карта постоянного клиента. Оформите ее онлайн или в любом из наших офисов. Это позволит Вам значительно экономить и получать приятные бонусы. В общем, давайте дружить :)<br /><br />8. Мы принимаем пластиковые карты.&nbsp;Никто не любит бегать по городу в поисках банкомата, поэтому во всех наших офисах для Вашего удобства имеются&nbsp;платежные терминалы;<br /><br />9. Покупайте онлайн!&nbsp;Для наших клиентов мы создали на сайте удобный поиск туров с возможностью оплаты онлайн &ndash; карточкой или другим способом. Если Вам понадобится помощь менеджера по туризму, Вы всегда можете позвонить нам <strong>+7(4212) 45-45-46&nbsp;</strong>или обратиться к онлайн-консультанту! А вообще, мы всегда рады гостям, приходите в наши офисы, мы угостим Вас ароматным кофе :)<br />&nbsp;<br />10. Удобное расположение. Мы находимся в самом центре города, по ул. Шеронова, 115. Для тех, кто еще не был у нас в гостях, ориентир - Хабаровский Дом Быта. Мы через дорогу напротив. Указатели и следы на асфальте не дадут Вам заблудиться.<br /><br />11. И наконец, наш многоканальный телефон <strong>(4212) 45-45-46</strong>&nbsp;никогда не бывает занят! Мы рады каждому Вашему звонку. На нашем сайте Вы также можете заказать звонок менеджера. <a href=\"http://www.santa-avia.ru/page/kontakty/\">Закажите звонок</a>, и через несколько секунд мы&nbsp;свяжемся с вами!</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>{Фото[news]=serts}</p>',	'pochemu-pokupat-tury-nado-tolko-u-nas',	'2016-04-02',	0,	1,	'2016-04-02 12:23:07',	'2016-04-02 12:38:28'),
(30,	'Забота о клиентах',	'<h4>Нам важно, что Вы&nbsp;о&nbsp;нас думаете!</h4>\r\n<p><br />Мы&nbsp;создали независимое подразделение &laquo;Забота о&nbsp;клиентах&raquo;&nbsp;&mdash; специально для приема и&nbsp;обработки любых обращений от&nbsp;Вас. Каждое Ваше обращение будет рассмотрено руководителем.<br /><br />Если Вам кажется, что Ваш менеджер к&nbsp;Вам недостаточно внимателен, у&nbsp;Вас есть безответные просьбы или нерешенные проблемы, или, наоборот, Вы&nbsp;хотите передать свою благодарность, дать добрый совет&nbsp;&mdash; просто заполните форму ниже.</p>',	'zabota-o-klientakh',	'2016-04-02',	0,	1,	'2016-04-02 12:39:01',	'2016-04-02 12:39:45'),
(31,	'Тур на заказ',	'<h4>Я знаю, куда хочу поехать!</h4>\r\n<p>Для тех, кто выбрал для себя страну или курорт.&nbsp;</p>\r\n<p>Вы хотите подобрать для себя лучшее предложение по цене и качеству? Но изучение сайтов с ворохом предложений так утомляет, что руки опускаются. К тому же Вы знаете, что на сайтах агентств Вы не найдете всех предложений. Часть из них раскупают еще до публикации.&nbsp;Мы подберем для Вас тур по Вашим критериям, предложим несколько вариантов и подготовим Ваше лучшее путешествие!</p>\r\n<p>&nbsp;</p>\r\n<h4>Я просто хочу где-нибудь отдохнуть.</h4>\r\n<p>Для тех, кто еще не решил, куда он хочет поехать.<br />По сути для Вас это не важно. Главное - Вы хотите интересно отдохнуть. Мы предложим Вам несколько стран под Ваш стиль отдыха, расскажем, что Вы найдете на каждом из курортов, подберем для Вас оптимальный вариант по лучшей цене.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h4>В любом случае, заполните форму ниже, и подбор тура для Вас мы возьмем на себя!</h4>',	'tur-na-zakaz',	'2016-04-02',	0,	1,	'2016-04-02 13:20:45',	'2016-04-02 13:21:32'),
(32,	'Акции на продажу авиабилетов. Поиск дешевых билетов на самолет',	'',	'aviabilety',	'2016-04-02',	0,	0,	'2016-04-02 13:23:49',	'2016-04-02 13:24:26'),
(33,	'Корпоративное обслуживание [IN PROGRESS]',	'<p>Туристическая компания \"Санта-Авиа\" работает не только с частными лицами, но и с корпоративными клиентами. Мы рады не только организовать Ваш отдых, но и помочь в организации деловых поездок - решения \"под ключ\" помогут Вам снизить издержки и обеспечат прозрачную отчетность.&nbsp; <br /><br />Деловые поездки с \"Санта-Авиа\" просты как раз, два, три!&nbsp;</p>',	'korporativnoe-obsluzhivanie',	'2016-04-02',	0,	1,	'2016-04-02 13:27:22',	'2016-04-02 13:28:27');

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
(31,	'Тур на заказ. \"Санта Авиа\" найдет для вас лучший тур для отдыха',	'',	'',	31,	NULL,	'page',	'2016-04-02 13:21:32',	'2016-04-02 13:21:32'),
(32,	'Корпоративное обслуживание туристической компанией. Деловые поездки',	'',	'',	33,	NULL,	'page',	'2016-04-02 13:28:27',	'2016-04-02 13:28:27');

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
(178,	'Template1',	'Template1',	'feed',	13,	'2016-03-31 04:57:24',	'2016-03-31 04:57:24'),
(179,	'',	'',	'',	28,	'2016-04-02 12:21:32',	'2016-04-02 12:21:32'),
(180,	'Template1',	'Template1',	'page',	28,	'2016-04-02 12:22:16',	'2016-04-02 12:22:16'),
(181,	'',	'',	'',	29,	'2016-04-02 12:23:07',	'2016-04-02 12:23:07'),
(182,	'Template1',	'Template1',	'page',	29,	'2016-04-02 12:24:10',	'2016-04-02 12:24:10'),
(183,	'',	'',	'',	30,	'2016-04-02 12:39:01',	'2016-04-02 12:39:01'),
(184,	'Template1',	'Template1',	'page',	30,	'2016-04-02 12:39:45',	'2016-04-02 12:39:45'),
(185,	'',	'',	'',	31,	'2016-04-02 13:20:45',	'2016-04-02 13:20:45'),
(186,	'',	'',	'',	32,	'2016-04-02 13:23:49',	'2016-04-02 13:23:49'),
(187,	'Template1',	'Template1',	'page',	32,	'2016-04-02 13:24:26',	'2016-04-02 13:24:26'),
(188,	'',	'',	'',	33,	'2016-04-02 13:27:22',	'2016-04-02 13:27:22'),
(189,	'Template1',	'Template1',	'page',	33,	'2016-04-02 13:28:27',	'2016-04-02 13:28:27'),
(190,	'Template1',	'Template1',	'category',	309,	'2016-04-02 13:33:54',	'2016-04-02 13:33:54');

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

-- 2016-04-03 17:10:05
