-- phpMyAdmin SQL Dump
-- version 4.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2016 at 10:51 AM
-- Server version: 5.5.36
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `product_listing`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
`id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 180),
(2, 1, NULL, NULL, 'Pages', 2, 15),
(3, 2, NULL, NULL, 'display', 3, 4),
(4, 2, NULL, NULL, 'add', 5, 6),
(5, 2, NULL, NULL, 'edit', 7, 8),
(6, 2, NULL, NULL, 'index', 9, 10),
(7, 2, NULL, NULL, 'view', 11, 12),
(8, 2, NULL, NULL, 'delete', 13, 14),
(9, 1, NULL, NULL, 'EbayenglishListings', 16, 35),
(10, 9, NULL, NULL, 'index', 17, 18),
(11, 9, NULL, NULL, 'categoriesPro', 19, 20),
(12, 9, NULL, NULL, 'category', 21, 22),
(13, 9, NULL, NULL, 'import', 23, 24),
(14, 9, NULL, NULL, 'update', 25, 26),
(15, 9, NULL, NULL, 'edit', 27, 28),
(16, 9, NULL, NULL, 'delete', 29, 30),
(17, 9, NULL, NULL, 'add', 31, 32),
(18, 9, NULL, NULL, 'view', 33, 34),
(19, 1, NULL, NULL, 'EnglishListings', 36, 55),
(20, 19, NULL, NULL, 'index', 37, 38),
(21, 19, NULL, NULL, 'categoriesPro', 39, 40),
(22, 19, NULL, NULL, 'category', 41, 42),
(23, 19, NULL, NULL, 'import', 43, 44),
(24, 19, NULL, NULL, 'update', 45, 46),
(25, 19, NULL, NULL, 'view', 47, 48),
(26, 19, NULL, NULL, 'add', 49, 50),
(27, 19, NULL, NULL, 'edit', 51, 52),
(28, 19, NULL, NULL, 'delete', 53, 54),
(29, 1, NULL, NULL, 'FranceListings', 56, 77),
(30, 29, NULL, NULL, 'index', 57, 58),
(31, 29, NULL, NULL, 'categoriesPro', 59, 60),
(32, 29, NULL, NULL, 'category', 61, 62),
(33, 29, NULL, NULL, 'import', 63, 64),
(34, 29, NULL, NULL, 'update', 65, 66),
(35, 29, NULL, NULL, 'download', 67, 68),
(36, 29, NULL, NULL, 'edit', 69, 70),
(37, 29, NULL, NULL, 'delete', 71, 72),
(38, 29, NULL, NULL, 'add', 73, 74),
(39, 29, NULL, NULL, 'view', 75, 76),
(40, 1, NULL, NULL, 'GermanListings', 78, 99),
(41, 40, NULL, NULL, 'index', 79, 80),
(42, 40, NULL, NULL, 'categoriesPro', 81, 82),
(43, 40, NULL, NULL, 'category', 83, 84),
(44, 40, NULL, NULL, 'import', 85, 86),
(45, 40, NULL, NULL, 'update', 87, 88),
(46, 40, NULL, NULL, 'download', 89, 90),
(47, 40, NULL, NULL, 'edit', 91, 92),
(48, 40, NULL, NULL, 'delete', 93, 94),
(49, 40, NULL, NULL, 'add', 95, 96),
(50, 40, NULL, NULL, 'view', 97, 98),
(51, 1, NULL, NULL, 'Groups', 100, 113),
(52, 51, NULL, NULL, 'build_acl', 101, 102),
(53, 51, NULL, NULL, 'index', 103, 104),
(54, 51, NULL, NULL, 'view', 105, 106),
(55, 51, NULL, NULL, 'add', 107, 108),
(56, 51, NULL, NULL, 'edit', 109, 110),
(57, 51, NULL, NULL, 'delete', 111, 112),
(58, 1, NULL, NULL, 'InventoryMasters', 114, 135),
(59, 58, NULL, NULL, 'categorieslist', 115, 116),
(60, 58, NULL, NULL, 'index', 117, 118),
(61, 58, NULL, NULL, 'category', 119, 120),
(62, 58, NULL, NULL, 'import_inventory', 121, 122),
(63, 58, NULL, NULL, 'edit_inventory', 123, 124),
(64, 58, NULL, NULL, 'delete_inventory', 125, 126),
(65, 58, NULL, NULL, 'add', 127, 128),
(66, 58, NULL, NULL, 'edit', 129, 130),
(67, 58, NULL, NULL, 'view', 131, 132),
(68, 58, NULL, NULL, 'delete', 133, 134),
(69, 1, NULL, NULL, 'Keywords', 136, 147),
(70, 69, NULL, NULL, 'index', 137, 138),
(71, 69, NULL, NULL, 'add', 139, 140),
(72, 69, NULL, NULL, 'edit', 141, 142),
(73, 69, NULL, NULL, 'view', 143, 144),
(74, 69, NULL, NULL, 'delete', 145, 146),
(75, 1, NULL, NULL, 'Menus', 148, 159),
(76, 75, NULL, NULL, 'index', 149, 150),
(77, 75, NULL, NULL, 'add', 151, 152),
(78, 75, NULL, NULL, 'edit', 153, 154),
(79, 75, NULL, NULL, 'view', 155, 156),
(80, 75, NULL, NULL, 'delete', 157, 158),
(81, 1, NULL, NULL, 'Users', 160, 179),
(82, 81, NULL, NULL, 'initDB', 161, 162),
(83, 81, NULL, NULL, 'login', 163, 164),
(84, 81, NULL, NULL, 'logout', 165, 166),
(85, 81, NULL, NULL, 'add', 167, 168),
(86, 81, NULL, NULL, 'index', 169, 170),
(87, 81, NULL, NULL, 'view', 171, 172),
(88, 81, NULL, NULL, 'edit', 173, 174),
(89, 81, NULL, NULL, 'forgatepw', 175, 176),
(90, 81, NULL, NULL, 'delete', 177, 178);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
`id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 10),
(2, NULL, 'Group', 2, NULL, 11, 16),
(3, 1, 'User', 1, NULL, 2, 3),
(4, 2, 'User', 2, NULL, 12, 13),
(5, 1, 'User', 3, NULL, 4, 5),
(6, 2, 'User', 4, NULL, 14, 15),
(7, 1, 'User', 5, NULL, 6, 7),
(8, 1, 'User', 6, NULL, 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
`id` int(10) NOT NULL,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '1', '1', '1', '1'),
(3, 2, 86, '-1', '-1', '-1', '-1'),
(4, 2, 60, '-1', '-1', '-1', '-1'),
(5, 2, 20, '-1', '-1', '-1', '-1'),
(6, 2, 27, '-1', '-1', '-1', '-1'),
(7, 2, 28, '-1', '-1', '-1', '-1'),
(8, 2, 23, '-1', '-1', '-1', '-1'),
(9, 2, 24, '-1', '-1', '-1', '-1'),
(10, 2, 30, '-1', '-1', '-1', '-1'),
(11, 2, 36, '-1', '-1', '-1', '-1'),
(12, 2, 37, '-1', '-1', '-1', '-1'),
(13, 2, 33, '-1', '-1', '-1', '-1'),
(14, 2, 34, '-1', '-1', '-1', '-1'),
(15, 2, 41, '-1', '-1', '-1', '-1'),
(16, 2, 47, '-1', '-1', '-1', '-1'),
(17, 2, 48, '-1', '-1', '-1', '-1'),
(18, 2, 44, '-1', '-1', '-1', '-1'),
(19, 2, 45, '-1', '-1', '-1', '-1'),
(20, 2, 10, '-1', '-1', '-1', '-1'),
(21, 2, 15, '-1', '-1', '-1', '-1'),
(22, 2, 16, '-1', '-1', '-1', '-1'),
(23, 2, 13, '-1', '-1', '-1', '-1'),
(24, 2, 14, '-1', '-1', '-1', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `ebayenglish_listings`
--

CREATE TABLE IF NOT EXISTS `ebayenglish_listings` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(700) NOT NULL,
  `product_code` varchar(700) NOT NULL,
  `title` varchar(900) DEFAULT NULL,
  `sale_price` varchar(700) DEFAULT NULL,
  `description` text,
  `size` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `color1` varchar(100) DEFAULT NULL,
  `material` varchar(400) DEFAULT NULL,
  `room` varchar(900) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `sub_type` varchar(100) DEFAULT NULL,
  `plant_required` varchar(100) DEFAULT NULL,
  `image` varchar(900) DEFAULT NULL,
  `image1` varchar(900) DEFAULT NULL,
  `error` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `english_listings`
--

CREATE TABLE IF NOT EXISTS `english_listings` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
  `product_code` varchar(700) NOT NULL,
  `external_product_id` varchar(100) DEFAULT NULL,
  `external_product_id_type` varchar(100) DEFAULT NULL,
  `item_name` varchar(900) DEFAULT NULL,
  `brand_name` varchar(700) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `feed_product_type` varchar(400) DEFAULT NULL,
  `part_number` varchar(500) DEFAULT NULL,
  `product_description` text,
  `update_delete` varchar(100) DEFAULT NULL,
  `product_site_launch_date` varchar(100) DEFAULT NULL,
  `standard_price` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `item_package_quantity` varchar(100) DEFAULT NULL,
  `product_tax_code` varchar(400) DEFAULT NULL,
  `merchant_release_date` varchar(100) DEFAULT NULL,
  `sale_price` varchar(200) DEFAULT NULL,
  `sale_from_date` varchar(100) DEFAULT NULL,
  `sale_end_date` varchar(100) DEFAULT NULL,
  `condition_type` varchar(100) DEFAULT NULL,
  `condition_note` varchar(900) DEFAULT NULL,
  `fulfillment_latency` varchar(900) DEFAULT NULL,
  `restock_date` varchar(100) DEFAULT NULL,
  `max_aggregate_ship_quantity` varchar(400) DEFAULT NULL,
  `offering_can_be_gift_messaged` varchar(400) DEFAULT NULL,
  `offering_can_be_giftwrapped` varchar(2000) DEFAULT NULL,
  `is_discontinued_by_manufacturer` varchar(100) DEFAULT NULL,
  `missing_keyset_reason` varchar(2000) DEFAULT NULL,
  `website_shipping_weight` varchar(2000) DEFAULT NULL,
  `website_shipping_weight_unit_of_measure` varchar(2000) DEFAULT NULL,
  `item_display_length` varchar(2000) DEFAULT NULL,
  `item_display_length_unit_of_measure` varchar(2000) DEFAULT NULL,
  `item_display_width` varchar(400) DEFAULT NULL,
  `item_display_width_unit_of_measure` varchar(400) DEFAULT NULL,
  `item_display_height` varchar(200) DEFAULT NULL,
  `item_display_height_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_display_depth` varchar(300) DEFAULT NULL,
  `item_display_depth_unit_of_measure` varchar(300) DEFAULT NULL,
  `item_display_diameter` varchar(900) DEFAULT NULL,
  `item_display_diameter_unit_of_measure` varchar(900) DEFAULT NULL,
  `item_display_weight` varchar(900) DEFAULT NULL,
  `item_display_weight_unit_of_measure` varchar(900) DEFAULT NULL,
  `volume_capacity_name` varchar(900) DEFAULT NULL,
  `volume_capacity_name_unit_of_measure` varchar(900) DEFAULT NULL,
  `item_display_volume` varchar(900) DEFAULT NULL,
  `item_display_volume_unit_of_measure` varchar(900) DEFAULT NULL,
  `recommended_browse_nodes1` varchar(900) DEFAULT NULL,
  `recommended_browse_nodes2` varchar(900) DEFAULT NULL,
  `catalog_number` varchar(900) DEFAULT NULL,
  `bullet_point1` text,
  `bullet_point2` text,
  `bullet_point3` text,
  `bullet_point4` text,
  `bullet_point5` text,
  `generic_keywords1` text,
  `generic_keywords2` text,
  `generic_keywords3` text,
  `generic_keywords4` text,
  `generic_keywords5` text,
  `platinum_keywords1` text,
  `platinum_keywords2` text,
  `platinum_keywords3` text,
  `platinum_keywords4` text,
  `platinum_keywords5` text,
  `target_audience_keywords1` text,
  `target_audience_keywords2` text,
  `target_audience_keywords3` text,
  `target_audience_keywords4` text,
  `target_audience_keywords5` text,
  `main_image_url` varchar(200) DEFAULT NULL,
  `swatch_image_url` varchar(200) DEFAULT NULL,
  `other_image_url1` varchar(200) DEFAULT NULL,
  `other_image_url2` varchar(200) DEFAULT NULL,
  `other_image_url3` varchar(100) DEFAULT NULL,
  `other_image_url4` varchar(100) DEFAULT NULL,
  `other_image_url5` varchar(100) DEFAULT NULL,
  `other_image_url6` varchar(100) DEFAULT NULL,
  `other_image_url7` varchar(100) DEFAULT NULL,
  `other_image_url8` varchar(100) DEFAULT NULL,
  `package_length` varchar(100) DEFAULT NULL,
  `package_width` varchar(100) DEFAULT NULL,
  `package_height` varchar(100) DEFAULT NULL,
  `package_length_unit_of_measure` varchar(100) DEFAULT NULL,
  `fulfillment_center_id` varchar(100) DEFAULT NULL,
  `parent_child` varchar(300) DEFAULT NULL,
  `parent_sku` varchar(200) DEFAULT NULL,
  `relationship_type` varchar(300) DEFAULT NULL,
  `variation_theme` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_age_warning` text,
  `eu_toys_safety_directive_warning1` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning2` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning3` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning4` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning5` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning6` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning7` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning8` varchar(400) DEFAULT NULL,
  `color_name` varchar(400) DEFAULT NULL,
  `color_map` varchar(500) DEFAULT NULL,
  `size_name` varchar(400) DEFAULT NULL,
  `warranty_description` text,
  `number_of_pieces` varchar(100) DEFAULT NULL,
  `material_type1` varchar(300) DEFAULT NULL,
  `material_type2` varchar(300) DEFAULT NULL,
  `material_type3` varchar(200) DEFAULT NULL,
  `material_type4` varchar(200) DEFAULT NULL,
  `material_type5` varchar(100) DEFAULT NULL,
  `material_type6` varchar(100) DEFAULT NULL,
  `material_type7` varchar(100) DEFAULT NULL,
  `material_type8` varchar(100) DEFAULT NULL,
  `special_features1` varchar(300) DEFAULT NULL,
  `special_features2` varchar(300) DEFAULT NULL,
  `special_features3` varchar(300) DEFAULT NULL,
  `special_features4` varchar(300) DEFAULT NULL,
  `special_features5` varchar(300) DEFAULT NULL,
  `error` varchar(4000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `france_listings`
--

CREATE TABLE IF NOT EXISTS `france_listings` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
  `product_code` varchar(700) NOT NULL,
  `external_product_id` varchar(100) DEFAULT NULL,
  `external_product_id_type` varchar(100) DEFAULT NULL,
  `item_name` varchar(900) DEFAULT NULL,
  `brand_name` varchar(700) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `feed_product_type` varchar(400) DEFAULT NULL,
  `part_number` varchar(500) DEFAULT NULL,
  `product_description` text,
  `update_delete` varchar(100) DEFAULT NULL,
  `product_site_launch_date` varchar(100) DEFAULT NULL,
  `standard_price` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `item_package_quantity` varchar(100) DEFAULT NULL,
  `product_tax_code` varchar(400) DEFAULT NULL,
  `merchant_release_date` varchar(100) DEFAULT NULL,
  `sale_price` varchar(200) DEFAULT NULL,
  `sale_from_date` varchar(100) DEFAULT NULL,
  `sale_end_date` varchar(100) DEFAULT NULL,
  `condition_type` varchar(100) DEFAULT NULL,
  `condition_note` varchar(900) DEFAULT NULL,
  `fulfillment_latency` varchar(900) DEFAULT NULL,
  `restock_date` varchar(100) DEFAULT NULL,
  `max_aggregate_ship_quantity` varchar(400) DEFAULT NULL,
  `offering_can_be_gift_messaged` varchar(400) DEFAULT NULL,
  `offering_can_be_giftwrapped` varchar(2000) DEFAULT NULL,
  `is_discontinued_by_manufacturer` varchar(100) DEFAULT NULL,
  `missing_keyset_reason` varchar(2000) DEFAULT NULL,
  `weee_tax_value` varchar(600) DEFAULT NULL,
  `weee_tax_value_unit_of_measure` varchar(600) DEFAULT NULL,
  `merchant_shipping_group_name` varchar(600) DEFAULT NULL,
  `website_shipping_weight` varchar(2000) DEFAULT NULL,
  `website_shipping_weight_unit_of_measure` varchar(2000) DEFAULT NULL,
  `item_display_length` varchar(2000) DEFAULT NULL,
  `item_display_length_unit_of_measure` varchar(2000) DEFAULT NULL,
  `item_display_width` varchar(400) DEFAULT NULL,
  `item_display_width_unit_of_measure` varchar(400) DEFAULT NULL,
  `item_display_height` varchar(200) DEFAULT NULL,
  `item_display_height_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_display_depth` varchar(300) DEFAULT NULL,
  `item_display_depth_unit_of_measure` varchar(300) DEFAULT NULL,
  `item_display_diameter` varchar(900) DEFAULT NULL,
  `item_display_diameter_unit_of_measure` varchar(900) DEFAULT NULL,
  `item_display_weight` varchar(200) DEFAULT NULL,
  `item_display_weight_unit_of_measure` varchar(200) DEFAULT NULL,
  `volume_capacity_name` varchar(200) DEFAULT NULL,
  `volume_capacity_name_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_display_volume` varchar(200) DEFAULT NULL,
  `item_display_volume_unit_of_measure` varchar(200) DEFAULT NULL,
  `recommended_browse_nodes1` varchar(200) DEFAULT NULL,
  `recommended_browse_nodes2` varchar(200) DEFAULT NULL,
  `catalog_number` varchar(200) DEFAULT NULL,
  `bullet_point1` text,
  `bullet_point2` text,
  `bullet_point3` text,
  `bullet_point4` text,
  `bullet_point5` text,
  `generic_keywords1` text,
  `generic_keywords2` text,
  `generic_keywords3` text,
  `generic_keywords4` text,
  `generic_keywords5` text,
  `platinum_keywords1` text,
  `platinum_keywords2` text,
  `platinum_keywords3` text,
  `platinum_keywords4` text,
  `platinum_keywords5` text,
  `target_audience_keywords1` text,
  `target_audience_keywords2` text,
  `target_audience_keywords3` text,
  `target_audience_keywords4` text,
  `target_audience_keywords5` text,
  `main_image_url` varchar(200) DEFAULT NULL,
  `swatch_image_url` varchar(200) DEFAULT NULL,
  `other_image_url1` varchar(200) DEFAULT NULL,
  `other_image_url2` varchar(200) DEFAULT NULL,
  `other_image_url3` varchar(100) DEFAULT NULL,
  `other_image_url4` varchar(100) DEFAULT NULL,
  `other_image_url5` varchar(100) DEFAULT NULL,
  `other_image_url6` varchar(100) DEFAULT NULL,
  `other_image_url7` varchar(100) DEFAULT NULL,
  `other_image_url8` varchar(100) DEFAULT NULL,
  `package_length` varchar(100) DEFAULT NULL,
  `package_width` varchar(100) DEFAULT NULL,
  `package_height` varchar(100) DEFAULT NULL,
  `package_length_unit_of_measure` varchar(100) DEFAULT NULL,
  `fulfillment_center_id` varchar(100) DEFAULT NULL,
  `parent_child` varchar(300) DEFAULT NULL,
  `parent_sku` varchar(200) DEFAULT NULL,
  `relationship_type` varchar(300) DEFAULT NULL,
  `variation_theme` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_age_warning` varchar(300) DEFAULT NULL,
  `eu_toys_safety_directive_warning1` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning2` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning3` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning4` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning5` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning6` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning7` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning8` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_language1` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language2` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language3` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language4` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language5` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language6` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language7` varchar(600) DEFAULT NULL,
  `eu_toys_safety_directive_language8` varchar(600) DEFAULT NULL,
  `country_string` varchar(600) DEFAULT NULL,
  `safety_warning` varchar(600) DEFAULT NULL,
  `energy_efficiency_image_url` varchar(600) DEFAULT NULL,
  `product_efficiency_image_url` varchar(600) DEFAULT NULL,
  `is_stain_resistant` varchar(500) DEFAULT NULL,
  `color_name` varchar(400) DEFAULT NULL,
  `color_map` varchar(500) DEFAULT NULL,
  `size_name` varchar(400) DEFAULT NULL,
  `warranty_description` varchar(400) DEFAULT NULL,
  `number_of_sets` varchar(100) DEFAULT NULL,
  `wattage` varchar(200) DEFAULT NULL,
  `material_type1` varchar(300) DEFAULT NULL,
  `material_type2` varchar(300) DEFAULT NULL,
  `material_type3` varchar(200) DEFAULT NULL,
  `material_type4` varchar(200) DEFAULT NULL,
  `material_type5` varchar(100) DEFAULT NULL,
  `material_type6` varchar(100) DEFAULT NULL,
  `material_type7` varchar(100) DEFAULT NULL,
  `material_type8` varchar(100) DEFAULT NULL,
  `special_features1` varchar(300) DEFAULT NULL,
  `special_features2` varchar(300) DEFAULT NULL,
  `special_features3` varchar(300) DEFAULT NULL,
  `special_features4` varchar(300) DEFAULT NULL,
  `special_features5` varchar(300) DEFAULT NULL,
  `seating_capacity` varchar(400) DEFAULT NULL,
  `pattern_name` varchar(300) DEFAULT NULL,
  `paper_size` varchar(300) DEFAULT NULL,
  `paint_type` varchar(300) DEFAULT NULL,
  `occasion_type1` varchar(300) DEFAULT NULL,
  `occasion_type2` varchar(300) DEFAULT NULL,
  `occasion_type3` varchar(300) DEFAULT NULL,
  `occasion_type4` varchar(300) DEFAULT NULL,
  `occasion_type5` varchar(300) DEFAULT NULL,
  `number_of_doors` varchar(300) DEFAULT NULL,
  `material_composition` varchar(300) DEFAULT NULL,
  `line_weight` varchar(300) DEFAULT NULL,
  `item_type_name` varchar(300) DEFAULT NULL,
  `item_styling` varchar(300) DEFAULT NULL,
  `item_shape` varchar(300) DEFAULT NULL,
  `item_hardness` varchar(300) DEFAULT NULL,
  `installation_type` varchar(300) DEFAULT NULL,
  `included_components1` varchar(300) DEFAULT NULL,
  `included_components2` varchar(300) DEFAULT NULL,
  `included_components3` varchar(300) DEFAULT NULL,
  `included_components4` varchar(300) DEFAULT NULL,
  `included_components5` varchar(300) DEFAULT NULL,
  `included_components6` varchar(300) DEFAULT NULL,
  `included_components7` varchar(300) DEFAULT NULL,
  `included_components8` varchar(300) DEFAULT NULL,
  `included_components9` varchar(300) DEFAULT NULL,
  `included_components10` varchar(300) DEFAULT NULL,
  `frame_type` varchar(300) DEFAULT NULL,
  `form_factor` varchar(300) DEFAULT NULL,
  `finish_type1` varchar(300) DEFAULT NULL,
  `finish_type2` varchar(300) DEFAULT NULL,
  `finish_type3` varchar(300) DEFAULT NULL,
  `finish_type4` varchar(300) DEFAULT NULL,
  `finish_type5` varchar(300) DEFAULT NULL,
  `adjustment_type` varchar(300) DEFAULT NULL,
  `are_batteries_included` varchar(300) DEFAULT NULL,
  `batteries_required` varchar(300) DEFAULT NULL,
  `battery_type` varchar(300) DEFAULT NULL,
  `number_of_batteries` varchar(300) DEFAULT NULL,
  `efficiency` varchar(300) DEFAULT NULL,
  `thermal_performance_description` varchar(300) DEFAULT NULL,
  `error` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `german_listings`
--

CREATE TABLE IF NOT EXISTS `german_listings` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
  `product_code` varchar(700) NOT NULL,
  `item_name` varchar(900) DEFAULT NULL,
  `external_product_id` varchar(100) DEFAULT NULL,
  `external_product_id_type` varchar(100) DEFAULT NULL,
  `feed_product_type` varchar(400) DEFAULT NULL,
  `brand_name` varchar(700) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `part_number` varchar(500) DEFAULT NULL,
  `product_description` text,
  `update_delete` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `standard_price` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `condition_type` varchar(100) DEFAULT NULL,
  `condition_note` varchar(900) DEFAULT NULL,
  `product_site_launch_date` varchar(100) DEFAULT NULL,
  `fulfillment_latency` varchar(900) DEFAULT NULL,
  `merchant_release_date` varchar(100) DEFAULT NULL,
  `restock_date` varchar(100) DEFAULT NULL,
  `sale_price` varchar(200) DEFAULT NULL,
  `sale_from_date` varchar(100) DEFAULT NULL,
  `sale_end_date` varchar(100) DEFAULT NULL,
  `max_aggregate_ship_quantity` varchar(100) DEFAULT NULL,
  `max_order_quantity` varchar(100) DEFAULT NULL,
  `offering_can_be_gift_messaged` varchar(400) DEFAULT NULL,
  `offering_can_be_giftwrapped` varchar(2000) DEFAULT NULL,
  `missing_keyset_reason` varchar(2000) DEFAULT NULL,
  `is_discontinued_by_manufacturer` varchar(100) DEFAULT NULL,
  `item_package_quantity` varchar(100) DEFAULT NULL,
  `product_tax_code` varchar(100) DEFAULT NULL,
  `delivery_schedule_group_id` varchar(100) DEFAULT NULL,
  `merchant_shipping_group_name` varchar(400) DEFAULT NULL,
  `website_shipping_weight` varchar(200) DEFAULT NULL,
  `website_shipping_weight_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_weight` varchar(200) DEFAULT NULL,
  `item_weight_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_length` varchar(200) DEFAULT NULL,
  `item_length_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_width` varchar(200) DEFAULT NULL,
  `item_width_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_height` varchar(200) DEFAULT NULL,
  `item_height_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_display_depth` varchar(300) DEFAULT NULL,
  `item_display_depth_unit_of_measure` varchar(300) DEFAULT NULL,
  `item_display_diameter` varchar(300) DEFAULT NULL,
  `item_display_diameter_unit_of_measure` varchar(200) DEFAULT NULL,
  `bullet_point1` text,
  `bullet_point2` text,
  `bullet_point3` text,
  `bullet_point4` text,
  `bullet_point5` text,
  `recommended_browse_nodes1` varchar(200) DEFAULT NULL,
  `recommended_browse_nodes2` varchar(200) DEFAULT NULL,
  `generic_keywords1` text,
  `generic_keywords2` text,
  `generic_keywords3` text,
  `generic_keywords4` text,
  `generic_keywords5` text,
  `catalog_number` varchar(200) DEFAULT NULL,
  `platinum_keywords1` text,
  `platinum_keywords2` text,
  `platinum_keywords3` text,
  `platinum_keywords4` text,
  `platinum_keywords5` text,
  `target_audience_keywords` text,
  `main_image_url` varchar(200) DEFAULT NULL,
  `swatch_image_url` varchar(200) DEFAULT NULL,
  `other_image_url1` varchar(200) DEFAULT NULL,
  `other_image_url2` varchar(200) DEFAULT NULL,
  `other_image_url3` varchar(100) DEFAULT NULL,
  `other_image_url4` varchar(100) DEFAULT NULL,
  `other_image_url5` varchar(100) DEFAULT NULL,
  `other_image_url6` varchar(100) DEFAULT NULL,
  `other_image_url7` varchar(100) DEFAULT NULL,
  `other_image_url8` varchar(100) DEFAULT NULL,
  `fulfillment_center_id` varchar(100) DEFAULT NULL,
  `package_length` varchar(100) DEFAULT NULL,
  `package_width` varchar(100) DEFAULT NULL,
  `package_height` varchar(100) DEFAULT NULL,
  `package_length_unit_of_measure` varchar(100) DEFAULT NULL,
  `package_weight` varchar(100) DEFAULT NULL,
  `package_weight_unit_of_measure` varchar(100) DEFAULT NULL,
  `relationship_type` varchar(300) DEFAULT NULL,
  `parent_child` varchar(300) DEFAULT NULL,
  `parent_sku` varchar(200) DEFAULT NULL,
  `variation_theme` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_age_warning` text,
  `eu_toys_safety_directive_warning1` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning2` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning3` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning4` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning5` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning6` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning7` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning8` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_language1` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language2` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language3` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language4` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language5` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language6` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language7` varchar(200) DEFAULT NULL,
  `eu_toys_safety_directive_language8` varchar(200) DEFAULT NULL,
  `legal_disclaimer_description` varchar(200) DEFAULT NULL,
  `fedas_id` varchar(100) DEFAULT NULL,
  `country_string` varchar(100) DEFAULT NULL,
  `energy_efficiency_image_url` varchar(100) DEFAULT NULL,
  `product_efficiency_image_url` varchar(100) DEFAULT NULL,
  `number_of_pieces` varchar(100) DEFAULT NULL,
  `warranty_description` text,
  `scent_name` varchar(100) DEFAULT NULL,
  `is_stain_resistant` varchar(100) DEFAULT NULL,
  `color_name` varchar(100) DEFAULT NULL,
  `size_name` varchar(100) DEFAULT NULL,
  `thread_count` varchar(100) DEFAULT NULL,
  `material_type` varchar(100) DEFAULT NULL,
  `number_of_sets` varchar(100) DEFAULT NULL,
  `wattage` varchar(100) DEFAULT NULL,
  `unit_count` varchar(200) DEFAULT NULL,
  `unit_count_type` varchar(200) DEFAULT NULL,
  `thermal_performance_description` varchar(100) DEFAULT NULL,
  `special_features` varchar(300) DEFAULT NULL,
  `seasons1` varchar(300) DEFAULT NULL,
  `seasons2` varchar(300) DEFAULT NULL,
  `seasons3` varchar(300) DEFAULT NULL,
  `seasons4` varchar(300) DEFAULT NULL,
  `outer_material_type1` varchar(100) DEFAULT NULL,
  `outer_material_type2` varchar(100) DEFAULT NULL,
  `outer_material_type3` varchar(100) DEFAULT NULL,
  `outer_material_type4` varchar(100) DEFAULT NULL,
  `outer_material_type5` varchar(100) DEFAULT NULL,
  `occupancy` varchar(100) DEFAULT NULL,
  `mfg_minimum` varchar(100) DEFAULT NULL,
  `material_composition` varchar(100) DEFAULT NULL,
  `item_type_name` varchar(100) DEFAULT NULL,
  `item_thickness_derived` varchar(100) DEFAULT NULL,
  `item_thickness_unit_of_measure` varchar(100) DEFAULT NULL,
  `item_shape` varchar(100) DEFAULT NULL,
  `inner_material_type` varchar(100) DEFAULT NULL,
  `capacity` varchar(100) DEFAULT NULL,
  `capacity_unit_of_measure` varchar(100) DEFAULT NULL,
  `are_batteries_included` varchar(100) DEFAULT NULL,
  `batteries_required` varchar(100) DEFAULT NULL,
  `battery_type1` varchar(100) DEFAULT NULL,
  `battery_type2` varchar(100) DEFAULT NULL,
  `battery_type3` varchar(100) DEFAULT NULL,
  `number_of_batteries1` varchar(100) DEFAULT NULL,
  `number_of_batteries2` varchar(100) DEFAULT NULL,
  `number_of_batteries3` varchar(100) DEFAULT NULL,
  `efficiency` varchar(100) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `style_name` varchar(100) DEFAULT NULL,
  `specific_uses_for_product` varchar(100) DEFAULT NULL,
  `seating_capacity` varchar(100) DEFAULT NULL,
  `pattern_name` varchar(100) DEFAULT NULL,
  `paper_size` varchar(100) DEFAULT NULL,
  `paint_type` varchar(100) DEFAULT NULL,
  `occasion_type` varchar(100) DEFAULT NULL,
  `number_of_doors` varchar(100) DEFAULT NULL,
  `line_weight` varchar(100) DEFAULT NULL,
  `item_styling` varchar(100) DEFAULT NULL,
  `item_hardness` varchar(100) DEFAULT NULL,
  `adjustment_type` varchar(100) DEFAULT NULL,
  `installation_type` varchar(100) DEFAULT NULL,
  `included_components` varchar(100) DEFAULT NULL,
  `frame_type` varchar(100) DEFAULT NULL,
  `form_factor` varchar(100) DEFAULT NULL,
  `error` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2016-02-11 09:56:31', '2016-02-11 09:56:31'),
(2, 'User', '2016-02-11 09:56:57', '2016-02-11 09:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_masters`
--

CREATE TABLE IF NOT EXISTS `inventory_masters` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
  `product_code` varchar(700) NOT NULL,
  `external_product_id` varchar(100) DEFAULT NULL,
  `external_product_id_type` varchar(100) DEFAULT NULL,
  `item_name` varchar(900) DEFAULT NULL,
  `brand_name` varchar(700) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `feed_product_type` varchar(400) DEFAULT NULL,
  `part_number` varchar(500) DEFAULT NULL,
  `product_description` text,
  `update_delete` varchar(100) DEFAULT NULL,
  `product_site_launch_date` varchar(100) DEFAULT NULL,
  `standard_price` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `item_package_quantity` varchar(100) DEFAULT NULL,
  `product_tax_code` varchar(400) DEFAULT NULL,
  `merchant_release_date` varchar(100) DEFAULT NULL,
  `sale_price` varchar(200) DEFAULT NULL,
  `sale_from_date` varchar(100) DEFAULT NULL,
  `sale_end_date` varchar(100) DEFAULT NULL,
  `condition_type` varchar(100) DEFAULT NULL,
  `condition_note` varchar(900) DEFAULT NULL,
  `fulfillment_latency` varchar(900) DEFAULT NULL,
  `restock_date` varchar(100) DEFAULT NULL,
  `max_aggregate_ship_quantity` varchar(400) DEFAULT NULL,
  `offering_can_be_gift_messaged` varchar(400) DEFAULT NULL,
  `offering_can_be_giftwrapped` varchar(2000) DEFAULT NULL,
  `is_discontinued_by_manufacturer` varchar(100) DEFAULT NULL,
  `missing_keyset_reason` varchar(2000) DEFAULT NULL,
  `website_shipping_weight` varchar(2000) DEFAULT NULL,
  `website_shipping_weight_unit_of_measure` varchar(2000) DEFAULT NULL,
  `item_display_length` varchar(2000) DEFAULT NULL,
  `item_display_length_unit_of_measure` varchar(2000) DEFAULT NULL,
  `item_display_width` varchar(400) DEFAULT NULL,
  `item_display_width_unit_of_measure` varchar(400) DEFAULT NULL,
  `item_display_height` varchar(200) DEFAULT NULL,
  `item_display_height_unit_of_measure` varchar(200) DEFAULT NULL,
  `item_display_depth` varchar(300) DEFAULT NULL,
  `item_display_depth_unit_of_measure` varchar(300) DEFAULT NULL,
  `item_display_diameter` varchar(900) DEFAULT NULL,
  `item_display_diameter_unit_of_measure` varchar(900) DEFAULT NULL,
  `item_display_weight` varchar(900) DEFAULT NULL,
  `item_display_weight_unit_of_measure` varchar(900) DEFAULT NULL,
  `volume_capacity_name` varchar(900) DEFAULT NULL,
  `volume_capacity_name_unit_of_measure` varchar(900) DEFAULT NULL,
  `item_display_volume` varchar(900) DEFAULT NULL,
  `item_display_volume_unit_of_measure` varchar(900) DEFAULT NULL,
  `recommended_browse_nodes1` varchar(900) DEFAULT NULL,
  `recommended_browse_nodes2` varchar(900) DEFAULT NULL,
  `catalog_number` varchar(900) DEFAULT NULL,
  `bullet_point1` text,
  `bullet_point2` text,
  `bullet_point3` text,
  `bullet_point4` text,
  `bullet_point5` text,
  `generic_keywords1` text,
  `generic_keywords2` text,
  `generic_keywords3` text,
  `generic_keywords4` text,
  `generic_keywords5` text,
  `platinum_keywords1` text,
  `platinum_keywords2` text,
  `platinum_keywords3` text,
  `platinum_keywords4` text,
  `platinum_keywords5` text,
  `target_audience_keywords1` text,
  `target_audience_keywords2` text,
  `target_audience_keywords3` text,
  `target_audience_keywords4` text,
  `target_audience_keywords5` text,
  `main_image_url` varchar(200) DEFAULT NULL,
  `swatch_image_url` varchar(200) DEFAULT NULL,
  `other_image_url1` varchar(200) DEFAULT NULL,
  `other_image_url2` varchar(200) DEFAULT NULL,
  `other_image_url3` varchar(100) DEFAULT NULL,
  `other_image_url4` varchar(100) DEFAULT NULL,
  `other_image_url5` varchar(100) DEFAULT NULL,
  `other_image_url6` varchar(100) DEFAULT NULL,
  `other_image_url7` varchar(100) DEFAULT NULL,
  `other_image_url8` varchar(100) DEFAULT NULL,
  `package_length` varchar(100) DEFAULT NULL,
  `package_width` varchar(100) DEFAULT NULL,
  `package_height` varchar(100) DEFAULT NULL,
  `package_length_unit_of_measure` varchar(100) DEFAULT NULL,
  `fulfillment_center_id` varchar(100) DEFAULT NULL,
  `parent_child` varchar(300) DEFAULT NULL,
  `parent_sku` varchar(200) DEFAULT NULL,
  `relationship_type` varchar(300) DEFAULT NULL,
  `variation_theme` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_age_warning` text,
  `eu_toys_safety_directive_warning1` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning2` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning3` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning4` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning5` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning6` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning7` varchar(400) DEFAULT NULL,
  `eu_toys_safety_directive_warning8` varchar(400) DEFAULT NULL,
  `color_name` varchar(400) DEFAULT NULL,
  `color_map` varchar(500) DEFAULT NULL,
  `size_name` varchar(400) DEFAULT NULL,
  `warranty_description` text,
  `number_of_pieces` varchar(100) DEFAULT NULL,
  `material_type1` varchar(300) DEFAULT NULL,
  `material_type2` varchar(300) DEFAULT NULL,
  `material_type3` varchar(200) DEFAULT NULL,
  `material_type4` varchar(200) DEFAULT NULL,
  `material_type5` varchar(100) DEFAULT NULL,
  `material_type6` varchar(100) DEFAULT NULL,
  `material_type7` varchar(100) DEFAULT NULL,
  `material_type8` varchar(100) DEFAULT NULL,
  `special_features1` varchar(300) DEFAULT NULL,
  `special_features2` varchar(300) DEFAULT NULL,
  `special_features3` varchar(300) DEFAULT NULL,
  `special_features4` varchar(300) DEFAULT NULL,
  `special_features5` varchar(300) DEFAULT NULL,
  `category` varchar(400) DEFAULT NULL,
  `error` varchar(4000) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inventory_masters`
--

INSERT INTO `inventory_masters` (`id`, `user_id`, `item_sku`, `product_code`, `external_product_id`, `external_product_id_type`, `item_name`, `brand_name`, `manufacturer`, `feed_product_type`, `part_number`, `product_description`, `update_delete`, `product_site_launch_date`, `standard_price`, `currency`, `quantity`, `item_package_quantity`, `product_tax_code`, `merchant_release_date`, `sale_price`, `sale_from_date`, `sale_end_date`, `condition_type`, `condition_note`, `fulfillment_latency`, `restock_date`, `max_aggregate_ship_quantity`, `offering_can_be_gift_messaged`, `offering_can_be_giftwrapped`, `is_discontinued_by_manufacturer`, `missing_keyset_reason`, `website_shipping_weight`, `website_shipping_weight_unit_of_measure`, `item_display_length`, `item_display_length_unit_of_measure`, `item_display_width`, `item_display_width_unit_of_measure`, `item_display_height`, `item_display_height_unit_of_measure`, `item_display_depth`, `item_display_depth_unit_of_measure`, `item_display_diameter`, `item_display_diameter_unit_of_measure`, `item_display_weight`, `item_display_weight_unit_of_measure`, `volume_capacity_name`, `volume_capacity_name_unit_of_measure`, `item_display_volume`, `item_display_volume_unit_of_measure`, `recommended_browse_nodes1`, `recommended_browse_nodes2`, `catalog_number`, `bullet_point1`, `bullet_point2`, `bullet_point3`, `bullet_point4`, `bullet_point5`, `generic_keywords1`, `generic_keywords2`, `generic_keywords3`, `generic_keywords4`, `generic_keywords5`, `platinum_keywords1`, `platinum_keywords2`, `platinum_keywords3`, `platinum_keywords4`, `platinum_keywords5`, `target_audience_keywords1`, `target_audience_keywords2`, `target_audience_keywords3`, `target_audience_keywords4`, `target_audience_keywords5`, `main_image_url`, `swatch_image_url`, `other_image_url1`, `other_image_url2`, `other_image_url3`, `other_image_url4`, `other_image_url5`, `other_image_url6`, `other_image_url7`, `other_image_url8`, `package_length`, `package_width`, `package_height`, `package_length_unit_of_measure`, `fulfillment_center_id`, `parent_child`, `parent_sku`, `relationship_type`, `variation_theme`, `eu_toys_safety_directive_age_warning`, `eu_toys_safety_directive_warning1`, `eu_toys_safety_directive_warning2`, `eu_toys_safety_directive_warning3`, `eu_toys_safety_directive_warning4`, `eu_toys_safety_directive_warning5`, `eu_toys_safety_directive_warning6`, `eu_toys_safety_directive_warning7`, `eu_toys_safety_directive_warning8`, `color_name`, `color_map`, `size_name`, `warranty_description`, `number_of_pieces`, `material_type1`, `material_type2`, `material_type3`, `material_type4`, `material_type5`, `material_type6`, `material_type7`, `material_type8`, `special_features1`, `special_features2`, `special_features3`, `special_features4`, `special_features5`, `category`, `error`) VALUES
(1, 1, '1101', '1101', '', '', 'Homwwscapes', 'Homescapes', 'Homeswwcapes', '', '', '', '', '', '123', '', '3', '', '', '', '', '', '', 'new, new', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://images.vikkit.co.uk/Rakuten-Images/Bed-Linen/Fitted-Sheets/Fitted-Sheets-200-TC/200Tc-Fitted-Sheet-Black-Double.jpg', ' ', 'http://images.vikkit.co.uk/Rakuten-Images/Bed-Linen/Fitted-Sheets/Fitted-Sheets-200-TC/200Tc-Fitted-Sheet-Black-Double-(2).jpg', ' ', '', '', '', '', '', '', '', '', '', '', '', 'parent', '', '', 'size', '', '', '', '', '', '', '', '', '', 'Beige', 'Beige', '', '', '', '100%-cotton', 'cotton', 'egyptian_cotton', '', '', '', '', '', '', '', '', '', '', 'Duvets', 'Listing Could not be processed due to error on line 1 :Item name did not match..');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
`id` int(11) NOT NULL,
  `keyword_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
`id` int(11) unsigned NOT NULL,
  `item_name` varchar(255) NOT NULL DEFAULT '',
  `item_sku` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(900) NOT NULL,
  `email` varchar(3000) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modify_by` text
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `group_id`, `created`, `created_by`, `modified`, `modify_by`) VALUES
(1, 'admin', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'vikram@homescapesonline.com', 1, '2016-02-11 09:58:50', '', '2016-02-11 13:00:00', 'admin'),
(2, 'vikram', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'amitkumartiwarispn@gmail.com', 2, '2016-02-11 13:41:34', 'admin', '2016-02-11 13:41:34', NULL),
(3, 'rajeev', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'rajeev@homescapesonline.com', 1, '2016-02-17 07:10:39', 'admin', '2016-02-17 07:12:14', 'admin'),
(4, 'rasmi', '3c0456e941ee43f55c843ff2bcb687057fc35263', 'rasmi@homescapesonline.com', 2, '2016-02-17 07:11:22', 'admin', '2016-02-17 07:11:22', NULL),
(5, 'Anika', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'anika@homescapesonline.com', 1, '2016-02-17 07:13:25', 'admin', '2016-02-17 07:13:57', 'admin'),
(6, 'sandeep', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'sandeep@homescapesonline.com', 1, '2016-02-17 11:19:58', 'admin', '2016-05-16 09:32:51', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acos`
--
ALTER TABLE `acos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aros`
--
ALTER TABLE `aros`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aros_acos`
--
ALTER TABLE `aros_acos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`);

--
-- Indexes for table `ebayenglish_listings`
--
ALTER TABLE `ebayenglish_listings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `item_sku` (`item_sku`), ADD KEY `user_id` (`user_id`), ADD KEY `id_2` (`id`), ADD KEY `item_sku_2` (`item_sku`), ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `english_listings`
--
ALTER TABLE `english_listings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `item_sku` (`item_sku`), ADD KEY `item_sku_2` (`item_sku`), ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `france_listings`
--
ALTER TABLE `france_listings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `item_sku_2` (`item_sku`), ADD UNIQUE KEY `item_sku_3` (`item_sku`), ADD UNIQUE KEY `item_sku_4` (`item_sku`), ADD KEY `id_2` (`id`), ADD KEY `item_sku` (`item_sku`), ADD KEY `item_sku_5` (`item_sku`);

--
-- Indexes for table `german_listings`
--
ALTER TABLE `german_listings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `item_sku_2` (`item_sku`), ADD UNIQUE KEY `item_sku_3` (`item_sku`), ADD KEY `id_2` (`id`), ADD KEY `item_sku` (`item_sku`), ADD KEY `item_sku_4` (`item_sku`), ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_masters`
--
ALTER TABLE `inventory_masters`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `item_sku` (`item_sku`), ADD KEY `item_sku_2` (`item_sku`), ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
 ADD PRIMARY KEY (`id`), ADD KEY `Keyword_name` (`keyword_name`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acos`
--
ALTER TABLE `acos`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `aros`
--
ALTER TABLE `aros`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `aros_acos`
--
ALTER TABLE `aros_acos`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ebayenglish_listings`
--
ALTER TABLE `ebayenglish_listings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `english_listings`
--
ALTER TABLE `english_listings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `france_listings`
--
ALTER TABLE `france_listings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `german_listings`
--
ALTER TABLE `german_listings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventory_masters`
--
ALTER TABLE `inventory_masters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
