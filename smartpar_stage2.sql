-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2017 at 07:06 AM
-- Server version: 5.6.22-72.0-log
-- PHP Version: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartpar_stage2`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_listings`
--

CREATE TABLE IF NOT EXISTS `admin_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_sku` varchar(300) NOT NULL,
  `linnworks_code` varchar(500) NOT NULL,
  `web_price_uk` varchar(500) NOT NULL,
  `web_sale_price_uk` varchar(500) NOT NULL,
  `web_price_fr` varchar(500) NOT NULL,
  `web_sale_price_fr` varchar(500) NOT NULL,
  `web_price_de` varchar(500) NOT NULL,
  `web_sale_price_de` varchar(500) NOT NULL,
  `web_price_dm` varchar(500) NOT NULL,
  `web_sale_price_dm` varchar(500) NOT NULL,
  `web_price_tesco` varchar(500) NOT NULL,
  `web_sale_price_tesco` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `web_sku` (`web_sku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6761 ;

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `cost_settings`
--

CREATE TABLE IF NOT EXISTS `cost_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_base_currency` varchar(300) DEFAULT NULL,
  `invoice_currency` varchar(300) DEFAULT NULL,
  `exchange_rate` varchar(200) DEFAULT NULL,
  `variation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `ebayenglish_listings`
--

CREATE TABLE IF NOT EXISTS `ebayenglish_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `error` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `item_sku` (`item_sku`),
  KEY `user_id` (`user_id`),
  KEY `id_2` (`id`),
  KEY `item_sku_2` (`item_sku`),
  KEY `product_code` (`product_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `english_listings`
--

CREATE TABLE IF NOT EXISTS `english_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
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
  `error` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_sku` (`item_sku`),
  KEY `item_sku_2` (`item_sku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `france_listings`
--

CREATE TABLE IF NOT EXISTS `france_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
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
  `error` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `item_sku_2` (`item_sku`),
  UNIQUE KEY `item_sku_3` (`item_sku`),
  UNIQUE KEY `item_sku_4` (`item_sku`),
  KEY `id_2` (`id`),
  KEY `item_sku` (`item_sku`),
  KEY `item_sku_5` (`item_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `france_master_listings`
--

CREATE TABLE IF NOT EXISTS `france_master_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
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
  `error` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_sku` (`item_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `france_product_listings`
--

CREATE TABLE IF NOT EXISTS `france_product_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku` varchar(500) NOT NULL,
  `product_code` varchar(500) NOT NULL,
  `product_asin` varchar(500) NOT NULL DEFAULT '',
  `fulfillmentchannel` varchar(500) NOT NULL DEFAULT '',
  `web_sku` varchar(600) NOT NULL DEFAULT '',
  `category` varchar(400) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_sku_2` (`product_sku`),
  KEY `product_sku` (`product_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `german_listings`
--

CREATE TABLE IF NOT EXISTS `german_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
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
  `error` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `item_sku_2` (`item_sku`),
  UNIQUE KEY `item_sku_3` (`item_sku`),
  KEY `id_2` (`id`),
  KEY `item_sku` (`item_sku`),
  KEY `item_sku_4` (`item_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `german_master_listings`
--

CREATE TABLE IF NOT EXISTS `german_master_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
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
  `error` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `german_product_listings`
--

CREATE TABLE IF NOT EXISTS `german_product_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku` varchar(500) NOT NULL,
  `product_code` varchar(500) NOT NULL,
  `product_asin` varchar(500) NOT NULL DEFAULT '',
  `fulfillmentchannel` varchar(500) NOT NULL DEFAULT '',
  `web_sku` varchar(600) NOT NULL DEFAULT '',
  `category` varchar(400) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_sku` (`product_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_codes`
--

CREATE TABLE IF NOT EXISTS `inventory_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linnworks_code` varchar(600) NOT NULL,
  `product_name` varchar(600) NOT NULL,
  `category` varchar(990) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `linnworks_code` (`linnworks_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5207 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_masters`
--

CREATE TABLE IF NOT EXISTS `inventory_masters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_sku` varchar(600) NOT NULL,
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
  `error` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_sku` (`item_sku`),
  KEY `item_sku_2` (`item_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE IF NOT EXISTS `listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_sku` varchar(300) NOT NULL,
  `linnworks_code` varchar(500) NOT NULL,
  `web_price_uk` varchar(500) NOT NULL,
  `web_sale_price_uk` varchar(500) NOT NULL,
  `web_price_fr` varchar(500) NOT NULL,
  `web_sale_price_fr` varchar(500) NOT NULL,
  `web_price_de` varchar(500) NOT NULL,
  `web_sale_price_de` varchar(500) NOT NULL,
  `web_price_dm` varchar(500) NOT NULL,
  `web_sale_price_dm` varchar(500) NOT NULL,
  `web_price_tesco` varchar(500) NOT NULL,
  `web_sale_price_tesco` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `web_sku` (`web_sku`),
  UNIQUE KEY `web_sku_2` (`web_sku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1685 ;

-- --------------------------------------------------------

--
-- Table structure for table `main_listings`
--

CREATE TABLE IF NOT EXISTS `main_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amazon_sku` varchar(600) NOT NULL,
  `channel_id` varchar(100) NOT NULL,
  `linnworks_code` varchar(900) NOT NULL,
  `price_uk` varchar(500) NOT NULL,
  `sale_price_uk` varchar(500) NOT NULL,
  `price_fr` varchar(300) NOT NULL,
  `sale_price_fr` varchar(300) NOT NULL,
  `price_de` varchar(300) NOT NULL,
  `sale_price_de` varchar(300) NOT NULL,
  `price_es` varchar(300) NOT NULL,
  `sale_price_es` varchar(300) NOT NULL,
  `price_ebay` varchar(300) NOT NULL,
  `sale_price_ebay` varchar(300) NOT NULL,
  `price_cdiscount` varchar(300) NOT NULL,
  `sale_price_cdiscount` varchar(300) NOT NULL,
  `error` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_name` (`amazon_sku`,`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_listings`
--

CREATE TABLE IF NOT EXISTS `master_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amazon_sku` varchar(600) NOT NULL,
  `channel_id` varchar(100) NOT NULL,
  `linnworks_code` varchar(600) NOT NULL,
  `price_uk` varchar(800) NOT NULL,
  `sale_price_uk` varchar(500) NOT NULL,
  `price_fr` varchar(300) NOT NULL,
  `sale_price_fr` varchar(300) NOT NULL,
  `price_de` varchar(300) NOT NULL,
  `sale_price_de` varchar(300) NOT NULL,
  `price_es` varchar(300) NOT NULL,
  `sale_price_es` varchar(300) NOT NULL,
  `price_ebay` varchar(300) NOT NULL,
  `sale_price_ebay` varchar(300) NOT NULL,
  `price_cdiscount` varchar(300) NOT NULL,
  `sale_price_cdiscount` varchar(300) NOT NULL,
  `error` text NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `index_name` (`amazon_sku`,`channel_id`),
  KEY `linnworks_code` (`linnworks_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1308 ;

-- --------------------------------------------------------

--
-- Table structure for table `multipliers`
--

CREATE TABLE IF NOT EXISTS `multipliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(600) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `multiplier` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(200) NOT NULL,
  `product_sku` varchar(900) DEFAULT NULL,
  `currency` varchar(400) DEFAULT NULL,
  `plateform` varchar(300) DEFAULT NULL,
  `subsource` varchar(500) DEFAULT NULL,
  `category` varchar(900) DEFAULT NULL,
  `product_name` varchar(900) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `stocks` varchar(100) DEFAULT NULL,
  `order_date` varchar(200) DEFAULT NULL,
  `order_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15656 ;

-- --------------------------------------------------------

--
-- Table structure for table `processed_orders`
--

CREATE TABLE IF NOT EXISTS `processed_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(200) NOT NULL,
  `product_sku` varchar(900) DEFAULT NULL,
  `currency` varchar(400) DEFAULT NULL,
  `plateform` varchar(300) DEFAULT NULL,
  `subsource` varchar(500) DEFAULT NULL,
  `category` varchar(900) DEFAULT NULL,
  `product_name` varchar(900) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `stocks` varchar(100) DEFAULT NULL,
  `price_per_unit` varchar(400) NOT NULL,
  `order_date` varchar(200) DEFAULT NULL,
  `order_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1213182 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_listings`
--

CREATE TABLE IF NOT EXISTS `product_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku` varchar(500) NOT NULL,
  `product_code` varchar(500) NOT NULL,
  `product_asin` varchar(500) NOT NULL DEFAULT '',
  `fulfillmentchannel` varchar(500) NOT NULL DEFAULT '',
  `web_sku` varchar(600) NOT NULL DEFAULT '',
  `category` varchar(400) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_sku` (`product_sku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10260 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linnworks_code` varchar(600) NOT NULL,
  `product_name` varchar(600) NOT NULL,
  `invoice_value` varchar(100) NOT NULL,
  `latest_invoice` varchar(100) NOT NULL,
  `category` varchar(600) NOT NULL,
  `supplier` varchar(600) NOT NULL,
  `invoice_currency` varchar(600) NOT NULL,
  `sale_price_gbp` varchar(600) NOT NULL,
  `sale_price_euro` varchar(600) NOT NULL,
  `error` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `linnworks_code` (`linnworks_code`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23785 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_channels`
--

CREATE TABLE IF NOT EXISTS `sales_channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_code` varchar(500) NOT NULL,
  `channel_name` varchar(900) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel_code` (`channel_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(400) NOT NULL,
  `country` varchar(400) NOT NULL,
  `shipping_cost` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL DEFAULT '',
  `item_sku` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_multipliers`
--

CREATE TABLE IF NOT EXISTS `supplier_multipliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(700) DEFAULT NULL,
  `invoice_currency` text,
  `supplier` varchar(700) DEFAULT NULL,
  `sp1_multiplier` varchar(100) DEFAULT NULL,
  `sp2_multiplier` varchar(100) DEFAULT NULL,
  `sp3_multiplier` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(900) NOT NULL,
  `email` varchar(3000) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modify_by` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_masters`
--
ALTER TABLE `inventory_masters`
  ADD CONSTRAINT `product_master_sku` FOREIGN KEY (`item_sku`) REFERENCES `inventory_masters` (`item_sku`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
