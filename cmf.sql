-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2014 at 12:49 PM
-- Server version: 5.5.38
-- PHP Version: 5.4.33-2+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bow`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `short_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3AF346683DA5256D` (`image_id`),
  KEY `IDX_3AF34668B213FA4` (`lang_id`),
  KEY `IDX_3AF3466834ECB4E6` (`route_id`),
  KEY `IDX_3AF34668727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `parent_id`, `level`, `heading`, `slug`, `title`, `meta_description`, `lang_id`, `published`, `route_id`, `lft`, `rgt`, `image_id`, `short_description`, `description`, `ordering`) VALUES
(2, NULL, 0, 'Новости', 'news', 'Новости', 'Новости', 2, 1, 10, 1, 8, NULL, '', 'Наши новости', 0),
(3, 4, 2, 'Новости Киева', 'kiev', 'Киев', 'Киев', 2, 1, 18, 5, 6, NULL, '', '', 0),
(4, 2, 1, 'Новости Украины', 'ukraine', 'Новости Украины', 'Новости Украины', 2, 1, 19, 4, 7, NULL, '', '', 2),
(5, 7, 1, 'Статьи по PHP', 'php', 'Статьи по PHP', 'Статьи по PHP', 2, 1, 20, 10, 13, NULL, '', '', 0),
(7, NULL, 0, 'Статьи', 'articles', 'Статьи', 'Статьи', 2, 1, 23, 9, 14, NULL, '', '', 0),
(8, 5, 2, 'Регулярные выражения в PHP', 'regex', 'Регулярные выражения в PHP', 'Регулярные выражения в PHP', 2, 1, 25, 11, 12, NULL, '', '', 0),
(10, 2, 1, 'Новости Мира', 'world', 'Новости Мира', 'Новости Мира', 2, 1, 26, 2, 3, NULL, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_contacts`
--

CREATE TABLE IF NOT EXISTS `blog_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `house` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `office` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `map` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `skype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `person` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `captcha` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_33401573B213FA4` (`lang_id`),
  KEY `IDX_3340157334ECB4E6` (`route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog_contacts`
--

INSERT INTO `blog_contacts` (`id`, `heading`, `country`, `city`, `street`, `house`, `office`, `email`, `phone`, `map`, `slug`, `title`, `meta_description`, `lang_id`, `route_id`, `skype`, `person`, `company_name`, `company_description`, `description`, `captcha`) VALUES
(1, 'Контакты', 'Украина', 'Киев', 'ул. профессора Подвысоцкого', '3А,', 'офис 27, 4-й этаж', 'mail@brainforce.kiev.ua', '044-232-79-10||093-333-33-33||096-666-66-66', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1271.1722117077145!2d30.5460359!3d50.4160542!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xec3dd0497a8eb172!2z0KPRh9C10LHQvdGL0Lkg0YbQtdC90YLRgCDQmNC90YLQtdC70LvQtdC60YIgLSDQutC-0LzQv9GM0Y7RgtC10YDQvdGL0LUg0LrRg9GA0YHRiw!5e0!3m2!1sru!2sua!4v1397723571841" width="845" height="300" frameborder="0" style="border:0"></iframe>', 'kontakty', 'Контакты', 'Контакты', 2, 41, 'skipper-bw', 'Виктор', 'BrainForce', 'Разработка web-приложений...', 'Дополнительное описание...', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `home` tinyint(1) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_885DBAFA3DA5256D` (`image_id`),
  KEY `IDX_2074E575B213FA4` (`lang_id`),
  KEY `IDX_885DBAFA34ECB4E6` (`route_id`),
  KEY `IDX_885DBAFA12469DE2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `lang_id`, `slug`, `title`, `meta_description`, `heading`, `short_description`, `content`, `created`, `updated`, `published`, `route_id`, `category_id`, `home`, `image_id`) VALUES
(1, 2, 'contacts', 'Контакты', 'Контакты........', 'Контакты', 'Контакты.....', '<p>093-000-00-00</p>', '2013-11-20 18:12:00', '2013-11-20 18:12:52', 1, 4, NULL, 0, NULL),
(2, 1, 'contacts', 'Contacts', 'Contacts Contacts Contacts', 'Contacts', 'Contacts Contacts Contacts', '<p>093-000-00-00</p>', '2013-11-20 18:12:00', '2013-11-20 18:13:31', 1, 7, NULL, 0, NULL),
(3, NULL, 'about', 'О компании', 'О компании...', 'О компании', 'О компании...', '<p>О компании.....</p>', '2013-12-11 18:56:00', '2013-12-11 18:57:45', 1, 8, NULL, 0, NULL),
(4, 2, 'news-kieva-1', 'Новость Киева 1', 'Новость Киева 1', 'Новость Киева 1', 'Новость Киева 1', '<p>Новость Киева 1&nbsp;Новость Киева 1&nbsp;Новость Киева 1&nbsp;Новость Киева 1</p>', '2013-12-18 19:15:00', '2013-12-18 19:16:44', 1, 13, 3, 0, NULL),
(5, 2, 'news-kieva-2', 'Новость Киева 2', 'Новость Киева 2', 'Новость Киева 2', 'Новость Киева 2', '<p>Новость Киева 2&nbsp;Новость Киева 2&nbsp;Новость Киева 2&nbsp;Новость Киева 2&nbsp;Новость Киева 2&nbsp;Новость Киева 2</p>', '2013-12-18 19:16:00', '2013-12-18 19:17:18', 1, 14, 3, 0, NULL),
(6, 2, 'news-kieva-3', 'Новость Киева 3', 'Новость Киева 3', 'Новость Киева 3', 'Новость Киева 3', '<p>Новость Киева 3&nbsp;Новость Киева 3&nbsp;Новость Киева 3</p>', '2013-12-18 20:32:00', '2013-12-18 20:34:17', 1, 16, 3, 0, NULL),
(7, 2, 'news-kieva-4', 'Новость Киева 4', 'Новость Киева 4', 'Новость Киева 4', 'Новость Киева 4', '<p>Новость Киева 4&nbsp;Новость Киева 4</p>', '2013-12-18 20:52:00', '2013-12-18 21:01:33', 1, 17, 3, 0, NULL),
(8, 2, 'news-1', 'Новость 1', 'Новость 1', 'Новость 1', '<p>Новость 1</p>', '<p>Новость 1&nbsp;Новость 1&nbsp;Новость 1</p>', '2014-02-27 14:09:00', '2014-02-27 14:09:57', 1, 27, 2, 0, NULL),
(9, 2, 'news-2', 'Новость 2', 'Новость 2', 'Новость 2', '<p>Новость 2</p>', '<p>Новость 2&nbsp;Новость 2&nbsp;Новость 2&nbsp;Новость 2&nbsp;Новость 2</p>', '2014-02-27 14:10:00', '2014-02-27 14:10:24', 1, 28, 2, 0, NULL),
(10, 2, 'news-ukraine-1', 'Новость Украины 1', 'Новость Украины 1', 'Новость Украины 1', 'Новость Украины 1', '<p>Новость Украины 1&nbsp;Новость Украины 1&nbsp;Новость Украины 1&nbsp;Новость Украины 1&nbsp;Новость Украины 1</p>', '2014-02-27 14:12:00', '2014-02-27 14:13:22', 1, 29, 4, 0, NULL),
(11, 2, 'news-mira-1', 'Новость Мира 1', 'Новость Мира 1', 'Новость Мира 1', 'Новость Мира 1', '<p>Новость Мира 1&nbsp;Новость Мира 1&nbsp;Новость Мира 1&nbsp;Новость Мира 1</p>', '2014-02-27 14:13:00', '2014-02-27 14:14:27', 1, 30, 10, 0, NULL),
(12, 2, 'home', 'Главная страница', 'Главная страница', 'Главная страница', 'Главная страница', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>\r\n\r\n<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>', '2014-03-26 18:47:00', '2014-03-26 18:49:42', 1, 31, NULL, 1, NULL),
(14, 2, 'testovaya-stranitsa', '', '', 'Тестовая    страница', '', '', '2014-03-31 12:42:00', '2014-03-31 12:42:36', 1, 40, NULL, 0, NULL),
(15, 2, 'news-3', 'Новость 3', 'Новость 3', 'Новость 3', '<p>Новость 3</p>', '<p>Новость 3</p>', '2014-06-24 17:07:00', '2014-06-24 17:07:47', 1, 42, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_custom_fields`
--

CREATE TABLE IF NOT EXISTS `blog_post_custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5539899F4B89032C` (`post_id`),
  KEY `IDX_5539899F443707B0` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `name_en` varchar(60) NOT NULL,
  `alpha2` varchar(2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `numeric_code` smallint(2) NOT NULL,
  `code` varchar(15) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D66EBAD38248176` (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Стандарт ISO_3166-1. http://ru.wikipedia.org/wiki/ISO_3166-1' AUTO_INCREMENT=250 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `name_en`, `alpha2`, `alpha3`, `numeric_code`, `code`, `currency_id`, `enabled`) VALUES
(1, 'Австралия', 'Australia', 'AU', 'AUS', 36, 'ISO 3166-2:AU', NULL, 0),
(2, 'Австрия', 'Austria', 'AT', 'AUT', 40, 'ISO 3166-2:AT', NULL, 0),
(3, 'Азербайджан', 'Azerbaijan', 'AZ', 'AZE', 31, 'ISO 3166-2:AZ', NULL, 0),
(4, 'Аландские острова', 'Åland Islands', 'AX', 'ALA', 248, 'ISO 3166-2:AX', NULL, 0),
(5, 'Албания', 'Albania', 'AL', 'ALB', 8, 'ISO 3166-2:AL', NULL, 0),
(6, 'Алжир', 'Algeria', 'DZ', 'DZA', 12, 'ISO 3166-2:DZ', NULL, 0),
(7, 'Американские Виргинские острова', 'Virgin Islands, U.S.', 'VI', 'VIR', 850, 'ISO 3166-2:VI', NULL, 0),
(8, 'Американское Самоа', 'American Samoa', 'AS', 'ASM', 16, 'ISO 3166-2:AS', NULL, 0),
(9, 'Ангилья', 'Anguilla', 'AI', 'AIA', 660, 'ISO 3166-2:AI', NULL, 0),
(10, 'Ангола', 'Angola', 'AO', 'AGO', 24, 'ISO 3166-2:AO', NULL, 0),
(11, 'Андорра', 'Andorra', 'AD', 'AND', 20, 'ISO 3166-2:AD', NULL, 0),
(12, 'Антарктида', 'Antarctica', 'AQ', 'ATA', 10, 'ISO 3166-2:AQ', NULL, 0),
(13, 'Антигуа и Барбуда', 'Antigua and Barbuda', 'AG', 'ATG', 28, 'ISO 3166-2:AG', NULL, 0),
(14, 'Аргентина', 'Argentina', 'AR', 'ARG', 32, 'ISO 3166-2:AR', NULL, 0),
(15, 'Армения', 'Armenia', 'AM', 'ARM', 51, 'ISO 3166-2:AM', NULL, 0),
(16, 'Аруба', 'Aruba', 'AW', 'ABW', 533, 'ISO 3166-2:AW', NULL, 0),
(17, 'Афганистан', 'Afghanistan', 'AF', 'AFG', 4, 'ISO 3166-2:AF', NULL, 0),
(18, 'Багамы', 'Bahamas', 'BS', 'BHS', 44, 'ISO 3166-2:BS', NULL, 0),
(19, 'Бангладеш', 'Bangladesh', 'BD', 'BGD', 50, 'ISO 3166-2:BD', NULL, 0),
(20, 'Барбадос', 'Barbados', 'BB', 'BRB', 52, 'ISO 3166-2:BB', NULL, 0),
(21, 'Бахрейн', 'Bahrain', 'BH', 'BHR', 48, 'ISO 3166-2:BH', NULL, 0),
(22, 'Белиз', 'Belize', 'BZ', 'BLZ', 84, 'ISO 3166-2:BZ', NULL, 0),
(23, 'Белоруссия', 'Belarus', 'BY', 'BLR', 112, 'ISO 3166-2:BY', NULL, 0),
(24, 'Бельгия', 'Belgium', 'BE', 'BEL', 56, 'ISO 3166-2:BE', NULL, 0),
(25, 'Бенин', 'Benin', 'BJ', 'BEN', 204, 'ISO 3166-2:BJ', NULL, 0),
(26, 'Бермуды', 'Bermuda', 'BM', 'BMU', 60, 'ISO 3166-2:BM', NULL, 0),
(27, 'Болгария', 'Bulgaria', 'BG', 'BGR', 100, 'ISO 3166-2:BG', NULL, 0),
(28, 'Боливия', 'Bolivia, Plurinational State of', 'BO', 'BOL', 68, 'ISO 3166-2:BO', NULL, 0),
(29, 'Бонэйр, Синт-Эстатиус и Саба', 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', 535, 'ISO 3166-2:BQ', NULL, 0),
(30, 'Босния и Герцеговина', 'Bosnia and Herzegovina', 'BA', 'BIH', 70, 'ISO 3166-2:BA', NULL, 0),
(31, 'Ботсвана', 'Botswana', 'BW', 'BWA', 72, 'ISO 3166-2:BW', NULL, 0),
(32, 'Бразилия', 'Brazil', 'BR', 'BRA', 76, 'ISO 3166-2:BR', NULL, 0),
(33, 'Британская территория в Индийском океане', 'British Indian Ocean Territory', 'IO', 'IOT', 86, 'ISO 3166-2:IO', NULL, 0),
(34, 'Британские Виргинские острова', 'Virgin Islands, British', 'VG', 'VGB', 92, 'ISO 3166-2:VG', NULL, 0),
(35, 'Бруней', 'Brunei Darussalam', 'BN', 'BRN', 96, 'ISO 3166-2:BN', NULL, 0),
(36, 'Буркина-Фасо', 'Burkina Faso', 'BF', 'BFA', 854, 'ISO 3166-2:BF', NULL, 0),
(37, 'Бурунди', 'Burundi', 'BI', 'BDI', 108, 'ISO 3166-2:BI', NULL, 0),
(38, 'Бутан', 'Bhutan', 'BT', 'BTN', 64, 'ISO 3166-2:BT', NULL, 0),
(39, 'Вануату', 'Vanuatu', 'VU', 'VUT', 548, 'ISO 3166-2:VU', NULL, 0),
(40, 'Ватикан', 'Holy See (Vatican City State)', 'VA', 'VAT', 336, 'ISO 3166-2:VA', NULL, 0),
(41, 'Великобритания', 'United Kingdom', 'GB', 'GBR', 826, 'ISO 3166-2:GB', NULL, 1),
(42, 'Венгрия', 'Hungary', 'HU', 'HUN', 348, 'ISO 3166-2:HU', NULL, 0),
(43, 'Венесуэла', 'Venezuela, Bolivarian Republic of', 'VE', 'VEN', 862, 'ISO 3166-2:VE', NULL, 0),
(44, 'Внешние малые острова (США)', 'United States Minor Outlying Islands', 'UM', 'UMI', 581, 'ISO 3166-2:UM', NULL, 0),
(45, 'Восточный Тимор', 'Timor-Leste', 'TL', 'TLS', 626, 'ISO 3166-2:TL', NULL, 0),
(46, 'Вьетнам', 'Vietnam', 'VN', 'VNM', 704, 'ISO 3166-2:VN', NULL, 0),
(47, 'Габон', 'Gabon', 'GA', 'GAB', 266, 'ISO 3166-2:GA', NULL, 0),
(48, 'Гаити', 'Haiti', 'HT', 'HTI', 332, 'ISO 3166-2:HT', NULL, 0),
(49, 'Гайана', 'Guyana', 'GY', 'GUY', 328, 'ISO 3166-2:GY', NULL, 0),
(50, 'Гамбия', 'Gambia', 'GM', 'GMB', 270, 'ISO 3166-2:GM', NULL, 0),
(51, 'Гана', 'Ghana', 'GH', 'GHA', 288, 'ISO 3166-2:GH', NULL, 0),
(52, 'Гваделупа', 'Guadeloupe', 'GP', 'GLP', 312, 'ISO 3166-2:GP', NULL, 0),
(53, 'Гватемала', 'Guatemala', 'GT', 'GTM', 320, 'ISO 3166-2:GT', NULL, 0),
(54, 'Гвиана', 'French Guiana', 'GF', 'GUF', 254, 'ISO 3166-2:GF', NULL, 0),
(55, 'Гвинея', 'Guinea', 'GN', 'GIN', 324, 'ISO 3166-2:GN', NULL, 0),
(56, 'Гвинея-Бисау', 'Guinea-Bissau', 'GW', 'GNB', 624, 'ISO 3166-2:GW', NULL, 0),
(57, 'Германия', 'Germany', 'DE', 'DEU', 276, 'ISO 3166-2:DE', NULL, 0),
(58, 'Гернси', 'Guernsey', 'GG', 'GGY', 831, 'ISO 3166-2:GG', NULL, 0),
(59, 'Гибралтар', 'Gibraltar', 'GI', 'GIB', 292, 'ISO 3166-2:GI', NULL, 0),
(60, 'Гондурас', 'Honduras', 'HN', 'HND', 340, 'ISO 3166-2:HN', NULL, 0),
(61, 'Гонконг', 'Hong Kong', 'HK', 'HKG', 344, 'ISO 3166-2:HK', NULL, 0),
(62, 'Государство Палестина', 'Palestine, State of', 'PS', 'PSE', 275, 'ISO 3166-2:PS', NULL, 0),
(63, 'Гренада', 'Grenada', 'GD', 'GRD', 308, 'ISO 3166-2:GD', NULL, 0),
(64, 'Гренландия', 'Greenland', 'GL', 'GRL', 304, 'ISO 3166-2:GL', NULL, 0),
(65, 'Греция', 'Greece', 'GR', 'GRC', 300, 'ISO 3166-2:GR', NULL, 0),
(66, 'Грузия', 'Georgia', 'GE', 'GEO', 268, 'ISO 3166-2:GE', NULL, 0),
(67, 'Гуам', 'Guam', 'GU', 'GUM', 316, 'ISO 3166-2:GU', NULL, 0),
(68, 'Дания', 'Denmark', 'DK', 'DNK', 208, 'ISO 3166-2:DK', NULL, 0),
(69, 'Джерси (остров)', 'Jersey', 'JE', 'JEY', 832, 'ISO 3166-2:JE', NULL, 0),
(70, 'Джибути', 'Djibouti', 'DJ', 'DJI', 262, 'ISO 3166-2:DJ', NULL, 0),
(71, 'Доминика', 'Dominica', 'DM', 'DMA', 212, 'ISO 3166-2:DM', NULL, 0),
(72, 'Доминиканская Республика', 'Dominican Republic', 'DO', 'DOM', 214, 'ISO 3166-2:DO', NULL, 0),
(73, 'ДР Конго', 'Congo, the Democratic Republic of the', 'CD', 'COD', 180, 'ISO 3166-2:CD', NULL, 0),
(74, 'Египет', 'Egypt', 'EG', 'EGY', 818, 'ISO 3166-2:EG', NULL, 0),
(75, 'Замбия', 'Zambia', 'ZM', 'ZMB', 894, 'ISO 3166-2:ZM', NULL, 0),
(76, 'Западная Сахара', 'Western Sahara', 'EH', 'ESH', 732, 'ISO 3166-2:EH', NULL, 0),
(77, 'Зимбабве', 'Zimbabwe', 'ZW', 'ZWE', 716, 'ISO 3166-2:ZW', NULL, 0),
(78, 'Израиль', 'Israel', 'IL', 'ISR', 376, 'ISO 3166-2:IL', NULL, 0),
(79, 'Индия', 'India', 'IN', 'IND', 356, 'ISO 3166-2:IN', NULL, 0),
(80, 'Индонезия', 'Indonesia', 'ID', 'IDN', 360, 'ISO 3166-2:ID', NULL, 0),
(81, 'Иордания', 'Jordan', 'JO', 'JOR', 400, 'ISO 3166-2:JO', NULL, 0),
(82, 'Ирак', 'Iraq', 'IQ', 'IRQ', 368, 'ISO 3166-2:IQ', NULL, 0),
(83, 'Иран', 'Iran, Islamic Republic of', 'IR', 'IRN', 364, 'ISO 3166-2:IR', NULL, 0),
(84, 'Ирландия', 'Ireland', 'IE', 'IRL', 372, 'ISO 3166-2:IE', NULL, 0),
(85, 'Исландия', 'Iceland', 'IS', 'ISL', 352, 'ISO 3166-2:IS', NULL, 0),
(86, 'Испания', 'Spain', 'ES', 'ESP', 724, 'ISO 3166-2:ES', NULL, 0),
(87, 'Италия', 'Italy', 'IT', 'ITA', 380, 'ISO 3166-2:IT', NULL, 0),
(88, 'Йемен', 'Yemen', 'YE', 'YEM', 887, 'ISO 3166-2:YE', NULL, 0),
(89, 'Кабо-Верде', 'Cape Verde', 'CV', 'CPV', 132, 'ISO 3166-2:CV', NULL, 0),
(90, 'Казахстан', 'Kazakhstan', 'KZ', 'KAZ', 398, 'ISO 3166-2:KZ', NULL, 0),
(91, 'Каймановы острова', 'Cayman Islands', 'KY', 'CYM', 136, 'ISO 3166-2:KY', NULL, 0),
(92, 'Камбоджа', 'Cambodia', 'KH', 'KHM', 116, 'ISO 3166-2:KH', NULL, 0),
(93, 'Камерун', 'Cameroon', 'CM', 'CMR', 120, 'ISO 3166-2:CM', NULL, 0),
(94, 'Канада', 'Canada', 'CA', 'CAN', 124, 'ISO 3166-2:CA', NULL, 0),
(95, 'Катар', 'Qatar', 'QA', 'QAT', 634, 'ISO 3166-2:QA', NULL, 0),
(96, 'Кения', 'Kenya', 'KE', 'KEN', 404, 'ISO 3166-2:KE', NULL, 0),
(97, 'Кипр', 'Cyprus', 'CY', 'CYP', 196, 'ISO 3166-2:CY', NULL, 0),
(98, 'Киргизия', 'Kyrgyzstan', 'KG', 'KGZ', 417, 'ISO 3166-2:KG', NULL, 0),
(99, 'Кирибати', 'Kiribati', 'KI', 'KIR', 296, 'ISO 3166-2:KI', NULL, 0),
(100, 'Китайская Республика', 'Taiwan, Province of China', 'TW', 'TWN', 158, 'ISO 3166-2:TW', NULL, 0),
(101, 'КНДР', 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 408, 'ISO 3166-2:KP', NULL, 0),
(102, 'КНР', 'China', 'CN', 'CHN', 156, 'ISO 3166-2:CN', NULL, 0),
(103, 'Кокосовые острова', 'Cocos (Keeling) Islands', 'CC', 'CCK', 166, 'ISO 3166-2:CC', NULL, 0),
(104, 'Колумбия', 'Colombia', 'CO', 'COL', 170, 'ISO 3166-2:CO', NULL, 0),
(105, 'Коморы', 'Comoros', 'KM', 'COM', 174, 'ISO 3166-2:KM', NULL, 0),
(106, 'Коста-Рика', 'Costa Rica', 'CR', 'CRI', 188, 'ISO 3166-2:CR', NULL, 0),
(107, 'Кот-д’Ивуар', 'Côte d''Ivoire', 'CI', 'CIV', 384, 'ISO 3166-2:CI', NULL, 0),
(108, 'Куба', 'Cuba', 'CU', 'CUB', 192, 'ISO 3166-2:CU', NULL, 0),
(109, 'Кувейт', 'Kuwait', 'KW', 'KWT', 414, 'ISO 3166-2:KW', NULL, 0),
(110, 'Кюрасао', 'Curaçao', 'CW', 'CUW', 531, 'ISO 3166-2:CW', NULL, 0),
(111, 'Лаос', 'Lao People''s Democratic Republic', 'LA', 'LAO', 418, 'ISO 3166-2:LA', NULL, 0),
(112, 'Латвия', 'Latvia', 'LV', 'LVA', 428, 'ISO 3166-2:LV', NULL, 0),
(113, 'Лесото', 'Lesotho', 'LS', 'LSO', 426, 'ISO 3166-2:LS', NULL, 0),
(114, 'Либерия', 'Liberia', 'LR', 'LBR', 430, 'ISO 3166-2:LR', NULL, 0),
(115, 'Ливан', 'Lebanon', 'LB', 'LBN', 422, 'ISO 3166-2:LB', NULL, 0),
(116, 'Ливия', 'Libya', 'LY', 'LBY', 434, 'ISO 3166-2:LY', NULL, 0),
(117, 'Литва', 'Lithuania', 'LT', 'LTU', 440, 'ISO 3166-2:LT', NULL, 0),
(118, 'Лихтенштейн', 'Liechtenstein', 'LI', 'LIE', 438, 'ISO 3166-2:LI', NULL, 0),
(119, 'Люксембург', 'Luxembourg', 'LU', 'LUX', 442, 'ISO 3166-2:LU', NULL, 0),
(120, 'Маврикий', 'Mauritius', 'MU', 'MUS', 480, 'ISO 3166-2:MU', NULL, 0),
(121, 'Мавритания', 'Mauritania', 'MR', 'MRT', 478, 'ISO 3166-2:MR', NULL, 0),
(122, 'Мадагаскар', 'Madagascar', 'MG', 'MDG', 450, 'ISO 3166-2:MG', NULL, 0),
(123, 'Майотта', 'Mayotte', 'YT', 'MYT', 175, 'ISO 3166-2:YT', NULL, 0),
(124, 'Макао', 'Macao', 'MO', 'MAC', 446, 'ISO 3166-2:MO', NULL, 0),
(125, 'Македония', 'Macedonia, the former Yugoslav Republic of', 'MK', 'MKD', 807, 'ISO 3166-2:MK', NULL, 0),
(126, 'Малави', 'Malawi', 'MW', 'MWI', 454, 'ISO 3166-2:MW', NULL, 0),
(127, 'Малайзия', 'Malaysia', 'MY', 'MYS', 458, 'ISO 3166-2:MY', NULL, 0),
(128, 'Мали', 'Mali', 'ML', 'MLI', 466, 'ISO 3166-2:ML', NULL, 0),
(129, 'Мальдивы', 'Maldives', 'MV', 'MDV', 462, 'ISO 3166-2:MV', NULL, 0),
(130, 'Мальта', 'Malta', 'MT', 'MLT', 470, 'ISO 3166-2:MT', NULL, 0),
(131, 'Марокко', 'Morocco', 'MA', 'MAR', 504, 'ISO 3166-2:MA', NULL, 0),
(132, 'Мартиника', 'Martinique', 'MQ', 'MTQ', 474, 'ISO 3166-2:MQ', NULL, 0),
(133, 'Маршалловы Острова', 'Marshall Islands', 'MH', 'MHL', 584, 'ISO 3166-2:MH', NULL, 0),
(134, 'Мексика', 'Mexico', 'MX', 'MEX', 484, 'ISO 3166-2:MX', NULL, 0),
(135, 'Микронезия', 'Micronesia, Federated States of', 'FM', 'FSM', 583, 'ISO 3166-2:FM', NULL, 0),
(136, 'Мозамбик', 'Mozambique', 'MZ', 'MOZ', 508, 'ISO 3166-2:MZ', NULL, 0),
(137, 'Молдавия', 'Moldova, Republic of', 'MD', 'MDA', 498, 'ISO 3166-2:MD', NULL, 0),
(138, 'Монако', 'Monaco', 'MC', 'MCO', 492, 'ISO 3166-2:MC', NULL, 0),
(139, 'Монголия', 'Mongolia', 'MN', 'MNG', 496, 'ISO 3166-2:MN', NULL, 0),
(140, 'Монтсеррат', 'Montserrat', 'MS', 'MSR', 500, 'ISO 3166-2:MS', NULL, 0),
(141, 'Мьянма', 'Myanmar', 'MM', 'MMR', 104, 'ISO 3166-2:MM', NULL, 0),
(142, 'Намибия', 'Namibia', 'NA', 'NAM', 516, 'ISO 3166-2:NA', NULL, 0),
(143, 'Науру', 'Nauru', 'NR', 'NRU', 520, 'ISO 3166-2:NR', NULL, 0),
(144, 'Непал', 'Nepal', 'NP', 'NPL', 524, 'ISO 3166-2:NP', NULL, 0),
(145, 'Нигер', 'Niger', 'NE', 'NER', 562, 'ISO 3166-2:NE', NULL, 0),
(146, 'Нигерия', 'Nigeria', 'NG', 'NGA', 566, 'ISO 3166-2:NG', NULL, 0),
(147, 'Нидерланды', 'Netherlands', 'NL', 'NLD', 528, 'ISO 3166-2:NL', NULL, 0),
(148, 'Никарагуа', 'Nicaragua', 'NI', 'NIC', 558, 'ISO 3166-2:NI', NULL, 0),
(149, 'Ниуэ', 'Niue', 'NU', 'NIU', 570, 'ISO 3166-2:NU', NULL, 0),
(150, 'Новая Зеландия', 'New Zealand', 'NZ', 'NZL', 554, 'ISO 3166-2:NZ', NULL, 0),
(151, 'Новая Каледония', 'New Caledonia', 'NC', 'NCL', 540, 'ISO 3166-2:NC', NULL, 0),
(152, 'Норвегия', 'Norway', 'NO', 'NOR', 578, 'ISO 3166-2:NO', NULL, 0),
(153, 'ОАЭ', 'United Arab Emirates', 'AE', 'ARE', 784, 'ISO 3166-2:AE', NULL, 0),
(154, 'Оман', 'Oman', 'OM', 'OMN', 512, 'ISO 3166-2:OM', NULL, 0),
(155, 'Остров Буве', 'Bouvet Island', 'BV', 'BVT', 74, 'ISO 3166-2:BV', NULL, 0),
(156, 'Остров Мэн', 'Isle of Man', 'IM', 'IMN', 833, 'ISO 3166-2:IM', NULL, 0),
(157, 'Остров Норфолк', 'Norfolk Island', 'NF', 'NFK', 574, 'ISO 3166-2:NF', NULL, 0),
(158, 'Остров Рождества', 'Christmas Island', 'CX', 'CXR', 162, 'ISO 3166-2:CX', NULL, 0),
(159, 'Острова Кука', 'Cook Islands', 'CK', 'COK', 184, 'ISO 3166-2:CK', NULL, 0),
(160, 'Острова Питкэрн', 'Pitcairn', 'PN', 'PCN', 612, 'ISO 3166-2:PN', NULL, 0),
(161, 'Острова Святой Елены, Вознесения и Тристан-да-Кунья', 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN', 654, 'ISO 3166-2:SH', NULL, 0),
(162, 'Пакистан', 'Pakistan', 'PK', 'PAK', 586, 'ISO 3166-2:PK', NULL, 0),
(163, 'Палау', 'Palau', 'PW', 'PLW', 585, 'ISO 3166-2:PW', NULL, 0),
(164, 'Панама', 'Panama', 'PA', 'PAN', 591, 'ISO 3166-2:PA', NULL, 0),
(165, 'Папуа — Новая Гвинея', 'Papua New Guinea', 'PG', 'PNG', 598, 'ISO 3166-2:PG', NULL, 0),
(166, 'Парагвай', 'Paraguay', 'PY', 'PRY', 600, 'ISO 3166-2:PY', NULL, 0),
(167, 'Перу', 'Peru', 'PE', 'PER', 604, 'ISO 3166-2:PE', NULL, 0),
(168, 'Польша', 'Poland', 'PL', 'POL', 616, 'ISO 3166-2:PL', NULL, 0),
(169, 'Португалия', 'Portugal', 'PT', 'PRT', 620, 'ISO 3166-2:PT', NULL, 0),
(170, 'Пуэрто-Рико', 'Puerto Rico', 'PR', 'PRI', 630, 'ISO 3166-2:PR', NULL, 0),
(171, 'Республика Конго', 'Congo', 'CG', 'COG', 178, 'ISO 3166-2:CG', NULL, 0),
(172, 'Республика Корея', 'Korea, Republic of', 'KR', 'KOR', 410, 'ISO 3166-2:KR', NULL, 0),
(173, 'Реюньон', 'Réunion', 'RE', 'REU', 638, 'ISO 3166-2:RE', NULL, 0),
(174, 'Россия', 'Russian Federation', 'RU', 'RUS', 643, 'ISO 3166-2:RU', NULL, 1),
(175, 'Руанда', 'Rwanda', 'RW', 'RWA', 646, 'ISO 3166-2:RW', NULL, 0),
(176, 'Румыния', 'Romania', 'RO', 'ROU', 642, 'ISO 3166-2:RO', NULL, 0),
(177, 'Сальвадор', 'El Salvador', 'SV', 'SLV', 222, 'ISO 3166-2:SV', NULL, 0),
(178, 'Самоа', 'Samoa', 'WS', 'WSM', 882, 'ISO 3166-2:WS', NULL, 0),
(179, 'Сан-Марино', 'San Marino', 'SM', 'SMR', 674, 'ISO 3166-2:SM', NULL, 0),
(180, 'Сан-Томе и Принсипи', 'Sao Tome and Principe', 'ST', 'STP', 678, 'ISO 3166-2:ST', NULL, 0),
(181, 'Саудовская Аравия', 'Saudi Arabia', 'SA', 'SAU', 682, 'ISO 3166-2:SA', NULL, 0),
(182, 'Свазиленд', 'Swaziland', 'SZ', 'SWZ', 748, 'ISO 3166-2:SZ', NULL, 0),
(183, 'Северные Марианские острова', 'Northern Mariana Islands', 'MP', 'MNP', 580, 'ISO 3166-2:MP', NULL, 0),
(184, 'Сейшельские Острова', 'Seychelles', 'SC', 'SYC', 690, 'ISO 3166-2:SC', NULL, 0),
(185, 'Сен-Бартелеми', 'Saint Barthélemy', 'BL', 'BLM', 652, 'ISO 3166-2:BL', NULL, 0),
(186, 'Сенегал', 'Senegal', 'SN', 'SEN', 686, 'ISO 3166-2:SN', NULL, 0),
(187, 'Сен-Мартен', 'Saint Martin (French part)', 'MF', 'MAF', 663, 'ISO 3166-2:MF', NULL, 0),
(188, 'Сен-Пьер и Микелон', 'Saint Pierre and Miquelon', 'PM', 'SPM', 666, 'ISO 3166-2:PM', NULL, 0),
(189, 'Сент-Винсент и Гренадины', 'Saint Vincent and the Grenadines', 'VC', 'VCT', 670, 'ISO 3166-2:VC', NULL, 0),
(190, 'Сент-Китс и Невис', 'Saint Kitts and Nevis', 'KN', 'KNA', 659, 'ISO 3166-2:KN', NULL, 0),
(191, 'Сент-Люсия', 'Saint Lucia', 'LC', 'LCA', 662, 'ISO 3166-2:LC', NULL, 0),
(192, 'Сербия', 'Serbia', 'RS', 'SRB', 688, 'ISO 3166-2:RS', NULL, 0),
(193, 'Сингапур', 'Singapore', 'SG', 'SGP', 702, 'ISO 3166-2:SG', NULL, 0),
(194, 'Синт-Мартен', 'Sint Maarten (Dutch part)', 'SX', 'SXM', 534, 'ISO 3166-2:SX', NULL, 0),
(195, 'Сирия', 'Syrian Arab Republic', 'SY', 'SYR', 760, 'ISO 3166-2:SY', NULL, 0),
(196, 'Словакия', 'Slovakia', 'SK', 'SVK', 703, 'ISO 3166-2:SK', NULL, 0),
(197, 'Словения', 'Slovenia', 'SI', 'SVN', 705, 'ISO 3166-2:SI', NULL, 0),
(198, 'Соломоновы Острова', 'Solomon Islands', 'SB', 'SLB', 90, 'ISO 3166-2:SB', NULL, 0),
(199, 'Сомали', 'Somalia', 'SO', 'SOM', 706, 'ISO 3166-2:SO', NULL, 0),
(200, 'Судан', 'Sudan', 'SD', 'SDN', 729, 'ISO 3166-2:SD', NULL, 0),
(201, 'Суринам', 'Suriname', 'SR', 'SUR', 740, 'ISO 3166-2:SR', NULL, 0),
(202, 'США', 'United States', 'US', 'USA', 840, 'ISO 3166-2:US', 2, 0),
(203, 'Сьерра-Леоне', 'Sierra Leone', 'SL', 'SLE', 694, 'ISO 3166-2:SL', NULL, 0),
(204, 'Таджикистан', 'Tajikistan', 'TJ', 'TJK', 762, 'ISO 3166-2:TJ', NULL, 0),
(205, 'Таиланд', 'Thailand', 'TH', 'THA', 764, 'ISO 3166-2:TH', NULL, 0),
(206, 'Танзания', 'Tanzania, United Republic of', 'TZ', 'TZA', 834, 'ISO 3166-2:TZ', NULL, 0),
(207, 'Тёркс и Кайкос', 'Turks and Caicos Islands', 'TC', 'TCA', 796, 'ISO 3166-2:TC', NULL, 0),
(208, 'Того', 'Togo', 'TG', 'TGO', 768, 'ISO 3166-2:TG', NULL, 0),
(209, 'Токелау', 'Tokelau', 'TK', 'TKL', 772, 'ISO 3166-2:TK', NULL, 0),
(210, 'Тонга', 'Tonga', 'TO', 'TON', 776, 'ISO 3166-2:TO', NULL, 0),
(211, 'Тринидад и Тобаго', 'Trinidad and Tobago', 'TT', 'TTO', 780, 'ISO 3166-2:TT', NULL, 0),
(212, 'Тувалу', 'Tuvalu', 'TV', 'TUV', 798, 'ISO 3166-2:TV', NULL, 0),
(213, 'Тунис', 'Tunisia', 'TN', 'TUN', 788, 'ISO 3166-2:TN', NULL, 0),
(214, 'Туркмения', 'Turkmenistan', 'TM', 'TKM', 795, 'ISO 3166-2:TM', NULL, 0),
(215, 'Турция', 'Turkey', 'TR', 'TUR', 792, 'ISO 3166-2:TR', NULL, 0),
(216, 'Уганда', 'Uganda', 'UG', 'UGA', 800, 'ISO 3166-2:UG', NULL, 0),
(217, 'Узбекистан', 'Uzbekistan', 'UZ', 'UZB', 860, 'ISO 3166-2:UZ', NULL, 0),
(218, 'Украина', 'Ukraine', 'UA', 'UKR', 804, 'ISO 3166-2:UA', 1, 1),
(219, 'Уоллис и Футуна', 'Wallis and Futuna', 'WF', 'WLF', 876, 'ISO 3166-2:WF', NULL, 0),
(220, 'Уругвай', 'Uruguay', 'UY', 'URY', 858, 'ISO 3166-2:UY', NULL, 0),
(221, 'Фарерские острова', 'Faroe Islands', 'FO', 'FRO', 234, 'ISO 3166-2:FO', NULL, 0),
(222, 'Фиджи', 'Fiji', 'FJ', 'FJI', 242, 'ISO 3166-2:FJ', NULL, 0),
(223, 'Филиппины', 'Philippines', 'PH', 'PHL', 608, 'ISO 3166-2:PH', NULL, 0),
(224, 'Финляндия', 'Finland', 'FI', 'FIN', 246, 'ISO 3166-2:FI', NULL, 0),
(225, 'Фолклендские острова', 'Falkland Islands (Malvinas)', 'FK', 'FLK', 238, 'ISO 3166-2:FK', NULL, 0),
(226, 'Франция', 'France', 'FR', 'FRA', 250, 'ISO 3166-2:FR', NULL, 0),
(227, 'Французская Полинезия', 'French Polynesia', 'PF', 'PYF', 258, 'ISO 3166-2:PF', NULL, 0),
(228, 'Французские Южные и Антарктические Территории', 'French Southern Territories', 'TF', 'ATF', 260, 'ISO 3166-2:TF', NULL, 0),
(229, 'Херд и Макдональд', 'Heard Island and McDonald Islands', 'HM', 'HMD', 334, 'ISO 3166-2:HM', NULL, 0),
(230, 'Хорватия', 'Croatia', 'HR', 'HRV', 191, 'ISO 3166-2:HR', NULL, 0),
(231, 'ЦАР', 'Central African Republic', 'CF', 'CAF', 140, 'ISO 3166-2:CF', NULL, 0),
(232, 'Чад', 'Chad', 'TD', 'TCD', 148, 'ISO 3166-2:TD', NULL, 0),
(233, 'Черногория', 'Montenegro', 'ME', 'MNE', 499, 'ISO 3166-2:ME', NULL, 0),
(234, 'Чехия', 'Czech Republic', 'CZ', 'CZE', 203, 'ISO 3166-2:CZ', NULL, 0),
(235, 'Чили', 'Chile', 'CL', 'CHL', 152, 'ISO 3166-2:CL', NULL, 0),
(236, 'Швейцария', 'Switzerland', 'CH', 'CHE', 756, 'ISO 3166-2:CH', NULL, 0),
(237, 'Швеция', 'Sweden', 'SE', 'SWE', 752, 'ISO 3166-2:SE', NULL, 0),
(238, 'Шпицберген и Ян-Майен', 'Svalbard and Jan Mayen', 'SJ', 'SJM', 744, 'ISO 3166-2:SJ', NULL, 0),
(239, 'Шри-Ланка', 'Sri Lanka', 'LK', 'LKA', 144, 'ISO 3166-2:LK', NULL, 0),
(240, 'Эквадор', 'Ecuador', 'EC', 'ECU', 218, 'ISO 3166-2:EC', NULL, 0),
(241, 'Экваториальная Гвинея', 'Equatorial Guinea', 'GQ', 'GNQ', 226, 'ISO 3166-2:GQ', NULL, 0),
(242, 'Эритрея', 'Eritrea', 'ER', 'ERI', 232, 'ISO 3166-2:ER', NULL, 0),
(243, 'Эстония', 'Estonia', 'EE', 'EST', 233, 'ISO 3166-2:EE', NULL, 0),
(244, 'Эфиопия', 'Ethiopia', 'ET', 'ETH', 231, 'ISO 3166-2:ET', NULL, 0),
(245, 'ЮАР', 'South Africa', 'ZA', 'ZAF', 710, 'ISO 3166-2:ZA', NULL, 0),
(246, 'Южная Георгия и Южные Сандвичевы острова', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 239, 'ISO 3166-2:GS', NULL, 0),
(247, 'Южный Судан', 'South Sudan', 'SS', 'SSD', 728, 'ISO 3166-2:SS', NULL, 0),
(248, 'Ямайка', 'Jamaica', 'JM', 'JAM', 388, 'ISO 3166-2:JM', NULL, 0),
(249, 'Япония', 'Japan', 'JP', 'JPN', 392, 'ISO 3166-2:JP', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `abbr` varchar(20) NOT NULL,
  `symbol` varchar(1) NOT NULL,
  `exchange_rate` decimal(15,2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `numeric_code` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_37C44693C065E6E4` (`alpha3`),
  UNIQUE KEY `UNIQ_37C4469395079952` (`numeric_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `abbr`, `symbol`, `exchange_rate`, `alpha3`, `numeric_code`) VALUES
(1, 'Украинская гривна', 'грн.', '₴', 1.00, 'UAH', 980),
(2, 'Американский доллар', 'US $', '$', 12.40, 'USD', 840),
(3, 'Евро', '€', '€', 16.20, 'EUR', 978);

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expanded` tinyint(1) NOT NULL,
  `multiple` tinyint(1) NOT NULL,
  `used` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `expanded`, `multiple`, `used`) VALUES
(1, 'Цвет', 1, 1, 1),
(2, 'Год', 1, 1, 1),
(3, 'Категория', 1, 1, 1),
(4, 'Производитель', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `custom_properties`
--

CREATE TABLE IF NOT EXISTS `custom_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B83C0D6D443707B0` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `custom_properties`
--

INSERT INTO `custom_properties` (`id`, `field_id`, `name`) VALUES
(1, 1, 'Красный'),
(2, 1, 'Зеленый'),
(3, 2, '1989'),
(4, 2, '1990'),
(5, 3, 'Компьютеры'),
(6, 3, 'Смартфоны'),
(8, 4, 'Apple'),
(9, 4, 'HTC'),
(10, 4, 'Samsung'),
(13, 4, 'Dell'),
(14, 3, 'Телефоны');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `short_description`) VALUES
(1, 'Gallery 1', 'My first gallery 1');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `sub_folder`, `title`, `alt`) VALUES
(12, 'baff26fd002f846e107ef18addf41d94917ef9d7.jpeg', 'vendors', 'The Apple Corp', 'The Apple Corp'),
(13, '467a915a81f8ff9e4aa954d4944d5a57fea46236.jpeg', 'products', 'iPhone 6', 'iPhone 6'),
(14, 'e2a70a4d6d6f0954d05c0e66d62f3a1a2d74c632.jpeg', 'products', 'iPhone 6 - 2', 'iPhone 6 - 2'),
(15, 'abf879d4ba16344f05a29249b8d91300fdcc5d75.jpeg', 'products', 'iPhone 6 - 3', 'iPhone 6 - 3'),
(18, '1e05a2c99eccdcb932cdc529d4b61d564dc81d48.jpeg', 'products', 'iPhone 5s - front', 'iPhone 5s - front'),
(19, '5463bd09de3647b38d7c5500d92f45e7c445826d.jpeg', 'products', 'iPhone 5s - back', 'iPhone 5s - back'),
(20, 'b70e9ceee902645f5c56baa8957b053e5300881b.jpeg', 'products', 'iPhone 5s - side', 'iPhone 5s - side');

-- --------------------------------------------------------

--
-- Table structure for table `images_deprecated`
--

CREATE TABLE IF NOT EXISTS `images_deprecated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `langs`
--

CREATE TABLE IF NOT EXISTS `langs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sign` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B883C6FB9F7E91FE` (`sign`),
  UNIQUE KEY `UNIQ_B883C6FB4180C698` (`locale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `langs`
--

INSERT INTO `langs` (`id`, `name`, `sign`, `locale`) VALUES
(1, 'English', 'en', 'en_US'),
(2, 'Русский', 'ru', 'ru_RU'),
(3, 'Українська', 'ua', 'uk_UA'),
(4, 'Deutsch', 'de', 'de_DE');

-- --------------------------------------------------------

--
-- Table structure for table `mailing`
--

CREATE TABLE IF NOT EXISTS `mailing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `success` tinyint(1) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3ED9315E537A1329` (`message_id`),
  KEY `IDX_3ED9315EA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mailing`
--

INSERT INTO `mailing` (`id`, `success`, `message_id`, `user_id`) VALUES
(6, 1, 1, 1),
(7, 1, 1, 4),
(8, 0, 1, 5),
(9, 1, 1, 6),
(10, 1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_727508CFE16C6B94` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `alias`, `name`, `description`) VALUES
(1, 'main_menu', 'Главное меню', 'Основное меню в хедере'),
(2, 'left_menu', 'Левое меню', 'Дополнительное меню в левом сайдбаре');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blank` tinyint(1) NOT NULL,
  `level` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_70B2CA2A3DA5256D` (`image_id`),
  KEY `IDX_70B2CA2ACCD7E912` (`menu_id`),
  KEY `IDX_70B2CA2A727ACA70` (`parent_id`),
  KEY `IDX_70B2CA2AB213FA4` (`lang_id`),
  KEY `IDX_70B2CA2A34ECB4E6` (`route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `name`, `title`, `href`, `class`, `blank`, `level`, `ordering`, `lft`, `rgt`, `lang_id`, `route_id`, `image_id`) VALUES
(1, 1, NULL, 'Главная', '', '', '', 0, 0, 0, 1, 2, 2, NULL, NULL),
(2, 1, NULL, 'Новости', '', '', '', 0, 0, 0, 3, 4, 2, 10, NULL),
(3, 1, NULL, 'Home', '', '', '', 0, 0, 0, 5, 6, 1, NULL, NULL),
(5, 1, NULL, 'Symfony', 'Официальный сайт Symfony Framework', 'http://symfony.com/', '', 1, 0, 0, 7, 10, 2, NULL, NULL),
(6, 1, 5, 'Demo', 'Примеры использования', 'demo', 'demo', 1, 1, 0, 8, 9, 2, NULL, NULL),
(9, 1, NULL, 'Контакты', 'Контакты', '', 'contacts', 0, 0, 99, 11, 12, 2, 41, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `created` datetime NOT NULL,
  `sending` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `text`, `created`, `sending`) VALUES
(1, 'Рассылка №1', '<p>Текст рассылки 1</p>', '2014-02-28 13:23:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_role`
--

CREATE TABLE IF NOT EXISTS `message_role` (
  `message_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`,`role_id`),
  KEY `IDX_FEFC11B3537A1329` (`message_id`),
  KEY `IDX_FEFC11B3D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_role`
--

INSERT INTO `message_role` (`message_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `small_image_id` int(11) DEFAULT NULL,
  `big_image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_876E0D9D9E4E1BC` (`small_image_id`),
  UNIQUE KEY `UNIQ_876E0D95272F7EF` (`big_image_id`),
  KEY `IDX_876E0D94E7AF8F` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_field_property`
--

CREATE TABLE IF NOT EXISTS `post_field_property` (
  `post_field_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`post_field_id`,`property_id`),
  KEY `IDX_D96BAB73FBDA8E11` (`post_field_id`),
  KEY `IDX_D96BAB73549213EC` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_field_property`
--

CREATE TABLE IF NOT EXISTS `product_field_property` (
  `product_field_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`product_field_id`,`property_id`),
  KEY `IDX_EA3E53F8F876D27` (`product_field_id`),
  KEY `IDX_EA3E53F549213EC` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_field_property`
--

INSERT INTO `product_field_property` (`product_field_id`, `property_id`) VALUES
(1, 3),
(2, 2),
(3, 3),
(3, 4),
(5, 8),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house` varchar(255) NOT NULL,
  `apartment` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8B308530A76ED395` (`user_id`),
  KEY `IDX_8B308530F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `surname`, `name`, `patronymic`, `phone`, `region`, `city`, `postcode`, `street`, `house`, `apartment`, `user_id`, `country_id`) VALUES
(5, 'Бочарский', 'Виктор', 'Викторович', '093-763-00-40', 'Киевская', 'Киев', '01103', 'Подвысоцкого', '3А', '27', 1, 218),
(6, 'Шиян', 'Сергей', 'Леонидович', '0669474191', '', '', '', '', '', '', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `replenishments`
--

CREATE TABLE IF NOT EXISTS `replenishments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `additive_amount` decimal(15,2) NOT NULL,
  `equivalent_amount` decimal(15,2) NOT NULL,
  `created` datetime NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `receipt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F4245E9CCFA12B8` (`profile_id`),
  KEY `IDX_4F4245E938248176` (`currency_id`),
  KEY `IDX_4F4245E92B5CA896` (`receipt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `replenishments`
--

INSERT INTO `replenishments` (`id`, `additive_amount`, `equivalent_amount`, `created`, `profile_id`, `currency_id`, `status`, `receipt_id`) VALUES
(33, 100.00, 6.17, '2014-04-16 12:25:04', 5, 3, 2, NULL),
(34, 1000.00, 1000.00, '2014-04-16 12:25:11', 5, 1, 1, NULL),
(35, 1000.00, 1000.00, '2014-04-16 15:09:06', 6, 1, 2, NULL),
(36, 100.00, 100.00, '2014-04-16 16:52:45', 5, 1, 2, NULL),
(37, 800.00, 49.38, '2014-04-16 17:07:03', 5, 3, 2, NULL),
(38, 200.00, 16.13, '2014-04-16 17:07:32', 5, 2, 1, NULL),
(39, 0.00, 0.00, '2014-04-16 17:47:44', 6, 1, 0, NULL),
(40, 0.00, 0.00, '2014-04-16 17:47:52', 6, 1, 0, NULL),
(41, 0.00, 0.00, '2014-04-16 17:50:22', 6, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC757698A6A` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role`) VALUES
(1, 'Администратор', 'ROLE_ADMIN'),
(2, 'Пользователь', 'ROLE_USER'),
(3, 'Подписчик', 'ROLE_SUBSCRIBER');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `defaults` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_32D5C2B3B548B0F` (`path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `path`, `defaults`) VALUES
(4, 'ru/cms/contacts', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:1;}'),
(7, 'en/contacts', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:2;}'),
(8, 'about', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:3;}'),
(10, 'ru/news', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:2;}'),
(13, 'ru/news/ukraine/kiev/news-kieva-1', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:4;}'),
(14, 'ru/news/ukraine/kiev/news-kieva-2', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:5;}'),
(16, 'ru/news/ukraine/kiev/news-kieva-3', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:6;}'),
(17, 'ru/news/ukraine/kiev/news-kieva-4', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:7;}'),
(18, 'ru/news/ukraine/kiev', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:3;}'),
(19, 'ru/news/ukraine', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:4;}'),
(20, 'ru/articles/php', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:5;}'),
(23, 'ru/articles', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:7;}'),
(25, 'ru/articles/php/regex', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:8;}'),
(26, 'ru/news/world', 'a:2:{s:11:"_controller";s:30:"BWBlogBundle:Category:category";s:2:"id";i:10;}'),
(27, 'ru/news/news-1', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:8;}'),
(28, 'ru/news/news-2', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:9;}'),
(29, 'ru/news/ukraine/news-ukraine-1', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:10;}'),
(30, 'ru/news/world/news-mira-1', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:11;}'),
(31, 'ru/home', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:12;}'),
(40, 'ru/testovaya-stranitsa', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:14;}'),
(41, 'ru/kontakty', 'a:2:{s:11:"_controller";s:28:"BWBlogBundle:Contact:contact";s:2:"id";i:1;}'),
(42, 'ru/news/news-3', 'a:2:{s:11:"_controller";s:22:"BWBlogBundle:Post:post";s:2:"id";i:15;}'),
(43, '/telefony/smartfony', 'a:2:{s:11:"_controller";s:26:"BWShopBundle:Category:show";s:2:"id";i:1;}'),
(44, '/kompyutery', 'a:2:{s:11:"_controller";s:26:"BWShopBundle:Category:show";s:2:"id";i:2;}'),
(45, '/tech/smartphones/iphone-6', 'a:2:{s:11:"_controller";s:25:"BWShopBundle:Product:show";s:2:"id";i:1;}'),
(46, '/tech/smartphones/iphone-5s', 'a:2:{s:11:"_controller";s:25:"BWShopBundle:Product:show";s:2:"id";i:3;}'),
(47, '/tech/smartphones/iphone-5', 'a:2:{s:11:"_controller";s:25:"BWShopBundle:Product:show";s:2:"id";i:4;}'),
(48, '/dwadaw', 'a:2:{s:11:"_controller";s:25:"BWShopBundle:Product:show";s:2:"id";i:5;}'),
(49, '/telefony', 'a:2:{s:11:"_controller";s:26:"BWShopBundle:Category:show";s:2:"id";i:3;}');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE IF NOT EXISTS `shop_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4080AB4E549213EC` (`property_id`),
  KEY `IDX_4080AB4E727ACA70` (`parent_id`),
  KEY `IDX_4080AB4E34ECB4E6` (`route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `parent_id`, `route_id`, `heading`, `slug`, `title`, `meta_description`, `short_description`, `description`, `published`, `ordering`, `level`, `lft`, `rgt`, `property_id`) VALUES
(1, 3, 43, 'Смартфоны', 'smartfony', 'Смартфоны', 'Смартфоны', '<p>Смартфоны</p>', '<p>Смартфоны</p>', 1, 0, 1, 4, 5, 6),
(2, NULL, 44, 'Компьютеры', 'kompyutery', 'Компьютреная техника', 'Компьютреная техника', '<p>Компьютреная техника</p>', '<p>Компьютреная техника</p>', 1, 0, 0, 1, 2, 5),
(3, NULL, 49, 'Телефоны', 'telefony', '', '', '', '', 1, 0, 0, 3, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `short_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `recent` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `popular` tinyint(1) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5AF603EE73` (`vendor_id`),
  KEY `IDX_B3BA5A5A12469DE2` (`category_id`),
  KEY `IDX_B3BA5A5A34ECB4E6` (`route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `heading`, `description`, `slug`, `title`, `meta_description`, `published`, `vendor_id`, `short_description`, `sku`, `price`, `recent`, `featured`, `popular`, `category_id`, `created`, `updated`, `route_id`) VALUES
(1, 'iPhone 6', '<p>iPhone 6...</p>', 'iphone-6', 'iPhone 6', 'iPhone 6...', 1, 1, '<p>iPhone 6...</p>', 'AI006', 9.99, 0, 0, 0, 1, '2014-08-12 00:00:00', '2014-08-13 00:00:00', 45),
(3, 'iPhone 5s', '<p>iPhone 5s...</p>', 'iphone-5s', 'iPhone 5s', 'iPhone 5s...', 1, 1, '<p>iPhone 5s...</p>', 'AI005S', 9999.00, 0, 0, 0, 1, '2014-08-12 04:00:00', '2014-08-13 09:00:00', 46),
(4, 'iPhone 5', '<p>iPhone 5...</p>', 'iphone-5', 'iphone-5', 'iphone-5...', 1, 1, '<p>iPhone 5...</p>', 'AI005', 6666.00, 0, 0, 0, 1, '2014-08-21 16:14:00', '2014-08-21 16:14:40', 47),
(5, 'dwadaw', '', 'dwadaw', '', '', 1, NULL, '', 'dawd', 0.00, 0, 0, 0, NULL, '2014-09-10 13:50:00', '2014-09-10 13:50:46', 48);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_custom_fields`
--

CREATE TABLE IF NOT EXISTS `shop_product_custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_90A52B7E4584665A` (`product_id`),
  KEY `IDX_90A52B7E443707B0` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `shop_product_custom_fields`
--

INSERT INTO `shop_product_custom_fields` (`id`, `product_id`, `field_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 3, 2),
(4, 5, 2),
(5, 1, 4),
(6, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_images`
--

CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_64617F033DA5256D` (`image_id`),
  KEY `IDX_64617F034584665A` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `shop_product_images`
--

INSERT INTO `shop_product_images` (`id`, `image_id`, `product_id`) VALUES
(2, 13, 1),
(3, 14, 1),
(4, 15, 1),
(14, 18, 3),
(15, 19, 3),
(16, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `shop_vendors`
--

CREATE TABLE IF NOT EXISTS `shop_vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4C16FA3B549213EC` (`property_id`),
  UNIQUE KEY `UNIQ_4F25BA113DA5256D` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `shop_vendors`
--

INSERT INTO `shop_vendors` (`id`, `heading`, `description`, `slug`, `title`, `meta_description`, `image_id`, `property_id`) VALUES
(1, 'Apple', '<p>The Apple Corp.</p>', 'apple', 'The Apple Corp.', 'The Apple Corp.', 12, 8),
(2, 'HTC', '<p>HTC</p>', 'htc', 'HTC', 'HTC', NULL, 9),
(3, 'Samsung', '<p>Samsung</p>', 'samsung', 'Samsung', 'Samsung', NULL, 10),
(6, 'Dell', '', 'dell', '', '', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_85A59DB8E16C6B94` (`alias`),
  KEY `IDX_85A59DB8FE54D947` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `alias`, `group_id`) VALUES
(1, 'Слайдер 1', 'slider-1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider_groups`
--

CREATE TABLE IF NOT EXISTS `slider_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BA34287DE16C6B94` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `slider_groups`
--

INSERT INTO `slider_groups` (`id`, `name`, `alias`) VALUES
(1, 'Группа 1', 'group-1');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slider_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8C020912CCC9638` (`slider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `slider_id`, `path`) VALUES
(1, 'Слайд 1', 1, '2ce47a9ad946bdbaaf2872f527caaf8fb8ac88ec.jpeg'),
(2, 'Слайд 2', 1, 'e5786d62b895aa4df404ef3bc5d1421953810639.jpeg'),
(3, 'Слайд 3', 1, '30d9d3fb1236fdfc1974d9cd816147d8566d306b.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `is_confirm` tinyint(1) NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vkontakte_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  UNIQUE KEY `UNIQ_1483A5E99BE8FD98` (`facebook_id`),
  UNIQUE KEY `UNIQ_1483A5E976F5C865` (`google_id`),
  UNIQUE KEY `UNIQ_1483A5E989588C72` (`vkontakte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `salt`, `password`, `email`, `is_active`, `created`, `updated`, `is_confirm`, `hash`, `facebook_id`, `google_id`, `vkontakte_id`) VALUES
(1, 'bocharsky.bw', 'b8c9bdcc1e6deb8ddc0b7ba7dfdec0e3', '2e6c2cf229d56599d4d401bf3e4c2e13abcb24b0', 'bocharsky.bw@gmail.com', 1, '2013-11-04 00:00:00', '2014-09-10 17:26:25', 1, '', '1716571471', '102640184623617573755', '10087918'),
(4, 'user', 'b04c9a70b7b111d2048337b34de601ca', '416c7c65ed7d3539043a7e5a8c0b01586a5a0416', 'user@local.loc', 1, '2013-11-15 18:53:10', '2014-04-16 12:15:36', 1, '', NULL, NULL, NULL),
(5, 'user1', '40b9269b86dddcf9604454eecf4994f0', '9cb91fc1fda042623e3d843d871120638cfe0156', 'user1local.loc', 1, '2014-02-28 18:13:47', '2014-02-28 18:15:21', 0, 'fc5ed0cac96634e066ea381c0391e8c3', NULL, NULL, NULL),
(6, 'user2', 'eab0f9f3e4100523368eed9be1773312', 'cfa3594c3d0208532235eeea82fe2ad95a608145', 'user2@local.loc', 1, '2014-02-28 18:14:34', '2014-02-28 18:15:20', 0, '2602074b81a762b55b2bcf8164910d2d', NULL, NULL, NULL),
(7, 'user3', '72f7e41a3fcad6b22b3cb5d0f25353df', 'd1ac66b712a813f9e5fca5168cf96c6922c8c469', 'user3@local.loc', 0, '2014-02-28 18:14:57', '2014-04-16 12:15:39', 0, 'df15b7ea1684551b07f4306fbc3c4dec', NULL, NULL, NULL),
(8, 'wbyglock', 'fecdf99e11c91f904313c2c785e270d6', 'e3f63fc60f82c7d212bc5cc64d77ff27d5b51030', 'wbyglock@gmail.com', 1, '2014-04-14 10:24:06', '2014-04-17 16:37:29', 1, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(4, 2),
(5, 3),
(6, 3),
(7, 3),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_amount` decimal(15,2) NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_967AAA6CCCFA12B8` (`profile_id`),
  KEY `IDX_967AAA6C38248176` (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `total_amount`, `profile_id`, `currency_id`) VALUES
(16, 6.17, 5, 3),
(17, 1000.00, 5, 1),
(18, 1000.00, 6, 1),
(19, 16.13, 5, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `FK_3AF3466834ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `FK_3AF346683DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images_deprecated` (`id`),
  ADD CONSTRAINT `FK_3AF34668727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `FK_3AF34668B213FA4` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`);

--
-- Constraints for table `blog_contacts`
--
ALTER TABLE `blog_contacts`
  ADD CONSTRAINT `FK_3340157334ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `FK_33401573B213FA4` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`);

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `FK_2074E575B213FA4` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`),
  ADD CONSTRAINT `FK_885DBAFA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `FK_885DBAFA34ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `FK_885DBAFA3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images_deprecated` (`id`);

--
-- Constraints for table `blog_post_custom_fields`
--
ALTER TABLE `blog_post_custom_fields`
  ADD CONSTRAINT `FK_5539899F443707B0` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`),
  ADD CONSTRAINT `FK_5539899F4B89032C` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`);

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `FK_5D66EBAD38248176` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `custom_properties`
--
ALTER TABLE `custom_properties`
  ADD CONSTRAINT `FK_B83C0D6D443707B0` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`);

--
-- Constraints for table `mailing`
--
ALTER TABLE `mailing`
  ADD CONSTRAINT `FK_3ED9315E537A1329` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `FK_3ED9315EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `FK_70B2CA2A34ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `FK_70B2CA2A3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images_deprecated` (`id`),
  ADD CONSTRAINT `FK_70B2CA2A727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`),
  ADD CONSTRAINT `FK_70B2CA2AB213FA4` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`),
  ADD CONSTRAINT `FK_70B2CA2ACCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `message_role`
--
ALTER TABLE `message_role`
  ADD CONSTRAINT `FK_FEFC11B3537A1329` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FEFC11B3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `FK_876E0D94E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`),
  ADD CONSTRAINT `FK_876E0D95272F7EF` FOREIGN KEY (`big_image_id`) REFERENCES `images_deprecated` (`id`),
  ADD CONSTRAINT `FK_876E0D9D9E4E1BC` FOREIGN KEY (`small_image_id`) REFERENCES `images_deprecated` (`id`);

--
-- Constraints for table `post_field_property`
--
ALTER TABLE `post_field_property`
  ADD CONSTRAINT `FK_D96BAB73549213EC` FOREIGN KEY (`property_id`) REFERENCES `custom_properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D96BAB73FBDA8E11` FOREIGN KEY (`post_field_id`) REFERENCES `blog_post_custom_fields` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_field_property`
--
ALTER TABLE `product_field_property`
  ADD CONSTRAINT `FK_EA3E53F549213EC` FOREIGN KEY (`property_id`) REFERENCES `custom_properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EA3E53F8F876D27` FOREIGN KEY (`product_field_id`) REFERENCES `shop_product_custom_fields` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `FK_8B308530A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_8B308530F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `replenishments`
--
ALTER TABLE `replenishments`
  ADD CONSTRAINT `FK_4F4245E92B5CA896` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`),
  ADD CONSTRAINT `FK_4F4245E938248176` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `FK_4F4245E9CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`);

--
-- Constraints for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD CONSTRAINT `FK_4080AB4E34ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `FK_4080AB4E549213EC` FOREIGN KEY (`property_id`) REFERENCES `custom_properties` (`id`),
  ADD CONSTRAINT `FK_4080AB4E727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `shop_categories` (`id`);

--
-- Constraints for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD CONSTRAINT `FK_B3BA5A5A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `shop_categories` (`id`),
  ADD CONSTRAINT `FK_B3BA5A5A34ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `FK_B3BA5A5AF603EE73` FOREIGN KEY (`vendor_id`) REFERENCES `shop_vendors` (`id`);

--
-- Constraints for table `shop_product_custom_fields`
--
ALTER TABLE `shop_product_custom_fields`
  ADD CONSTRAINT `FK_90A52B7E443707B0` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`),
  ADD CONSTRAINT `FK_90A52B7E4584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`);

--
-- Constraints for table `shop_product_images`
--
ALTER TABLE `shop_product_images`
  ADD CONSTRAINT `FK_64617F033DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_64617F034584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`);

--
-- Constraints for table `shop_vendors`
--
ALTER TABLE `shop_vendors`
  ADD CONSTRAINT `FK_4C16FA3B549213EC` FOREIGN KEY (`property_id`) REFERENCES `custom_properties` (`id`),
  ADD CONSTRAINT `FK_4F25BA113DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `FK_85A59DB8FE54D947` FOREIGN KEY (`group_id`) REFERENCES `slider_groups` (`id`);

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `FK_B8C020912CCC9638` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `FK_967AAA6C38248176` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `FK_967AAA6CCCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
