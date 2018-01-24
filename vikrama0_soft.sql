-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2018 at 06:48 AM
-- Server version: 5.6.36-82.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vikrama0_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE `acos` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_listings`
--

CREATE TABLE `admin_listings` (
  `id` int(11) NOT NULL,
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
  `web_sale_price_tesco` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE `aros` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bk_stock_items`
--

CREATE TABLE `bk_stock_items` (
  `id` int(11) NOT NULL,
  `item_number` varchar(200) NOT NULL,
  `item_title` varchar(900) NOT NULL,
  `barcode_number` varchar(200) NOT NULL,
  `category_name` varchar(900) NOT NULL,
  `heights` varchar(200) NOT NULL,
  `widths` varchar(200) NOT NULL,
  `depths` varchar(200) NOT NULL,
  `weights` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cost_calculators`
--

CREATE TABLE `cost_calculators` (
  `id` int(11) NOT NULL,
  `linnworks_code` varchar(600) NOT NULL,
  `product_name` varchar(600) NOT NULL,
  `category` varchar(600) NOT NULL,
  `supplier` varchar(600) NOT NULL,
  `invoice_currency` varchar(600) NOT NULL,
  `landed_price_gbp` varchar(300) NOT NULL,
  `sp1_value_gbp` varchar(300) NOT NULL,
  `sp2_value_gbp` varchar(300) NOT NULL,
  `sp3_value_gbp` varchar(300) NOT NULL,
  `sale_price_gbp` varchar(600) NOT NULL,
  `landed_price_eur` varchar(300) NOT NULL,
  `sp1_value_eur` varchar(300) NOT NULL,
  `sp2_value_eur` varchar(300) NOT NULL,
  `sp3_value_eur` varchar(300) NOT NULL,
  `sale_price_euro` varchar(600) NOT NULL,
  `import_dates` varchar(400) NOT NULL,
  `error` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_settings`
--

CREATE TABLE `cost_settings` (
  `id` int(11) NOT NULL,
  `sale_base_currency` varchar(300) DEFAULT NULL,
  `invoice_currency` varchar(300) DEFAULT NULL,
  `exchange_rate` varchar(200) DEFAULT NULL,
  `variation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ebayenglish_listings`
--

CREATE TABLE `ebayenglish_listings` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `english_listings`
--

CREATE TABLE `english_listings` (
  `id` int(11) NOT NULL,
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
  `error` varchar(4000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `france_listings`
--

CREATE TABLE `france_listings` (
  `id` int(11) NOT NULL,
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
  `error` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `france_master_listings`
--

CREATE TABLE `france_master_listings` (
  `id` int(11) NOT NULL,
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
  `error` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `france_product_listings`
--

CREATE TABLE `france_product_listings` (
  `id` int(11) NOT NULL,
  `product_sku` varchar(500) NOT NULL,
  `product_code` varchar(500) NOT NULL,
  `product_asin` varchar(500) NOT NULL DEFAULT '',
  `fulfillmentchannel` varchar(500) NOT NULL DEFAULT '',
  `web_sku` varchar(600) NOT NULL DEFAULT '',
  `category` varchar(400) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `german_listings`
--

CREATE TABLE `german_listings` (
  `id` int(11) NOT NULL,
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
  `error` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `german_master_listings`
--

CREATE TABLE `german_master_listings` (
  `id` int(11) NOT NULL,
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
  `error` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `german_product_listings`
--

CREATE TABLE `german_product_listings` (
  `id` int(11) NOT NULL,
  `product_sku` varchar(500) NOT NULL,
  `product_code` varchar(500) NOT NULL,
  `product_asin` varchar(500) NOT NULL DEFAULT '',
  `fulfillmentchannel` varchar(500) NOT NULL DEFAULT '',
  `web_sku` varchar(600) NOT NULL DEFAULT '',
  `category` varchar(400) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_codes`
--

CREATE TABLE `inventory_codes` (
  `id` int(11) NOT NULL,
  `linnworks_code` varchar(600) NOT NULL,
  `product_name` varchar(600) NOT NULL,
  `category` varchar(990) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_masters`
--

CREATE TABLE `inventory_masters` (
  `id` int(11) NOT NULL,
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
  `error` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
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
  `web_sale_price_tesco` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `main_listings`
--

CREATE TABLE `main_listings` (
  `id` int(11) NOT NULL,
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
  `prime_date` varchar(400) DEFAULT NULL,
  `error` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_listings`
--

CREATE TABLE `master_listings` (
  `id` int(11) NOT NULL,
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
  `prime_date` varchar(400) DEFAULT NULL,
  `error` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `multipliers`
--

CREATE TABLE `multipliers` (
  `id` int(11) NOT NULL,
  `category` varchar(600) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `multiplier` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `open_orders`
--

CREATE TABLE `open_orders` (
  `id` bigint(255) NOT NULL,
  `order_id` varchar(600) NOT NULL,
  `plateform` varchar(500) NOT NULL,
  `subsource` varchar(500) NOT NULL,
  `currency` varchar(300) NOT NULL,
  `order_date` date NOT NULL,
  `order_value` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `processed_listings`
--

CREATE TABLE `processed_listings` (
  `id` bigint(255) NOT NULL,
  `order_id` varchar(900) NOT NULL,
  `order_date` date NOT NULL,
  `currency` varchar(300) NOT NULL,
  `plateform` varchar(900) NOT NULL,
  `subsource` varchar(900) NOT NULL,
  `cat_name` varchar(900) NOT NULL,
  `product_sku` varchar(900) NOT NULL,
  `product_name` varchar(900) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_product` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `processed_orders`
--

CREATE TABLE `processed_orders` (
  `id` bigint(255) NOT NULL,
  `order_id` varchar(700) NOT NULL,
  `order_date` date NOT NULL,
  `currency` varchar(200) NOT NULL,
  `plateform` varchar(400) NOT NULL,
  `subsource` varchar(300) NOT NULL,
  `order_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_listings`
--

CREATE TABLE `product_listings` (
  `id` int(11) NOT NULL,
  `product_sku` varchar(500) NOT NULL,
  `product_code` varchar(500) NOT NULL,
  `product_asin` varchar(500) NOT NULL DEFAULT '',
  `fulfillmentchannel` varchar(500) NOT NULL DEFAULT '',
  `web_sku` varchar(600) NOT NULL DEFAULT '',
  `category` varchar(400) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `linnworks_code` varchar(600) NOT NULL,
  `product_name` varchar(600) NOT NULL,
  `category` varchar(600) NOT NULL,
  `supplier` varchar(600) NOT NULL,
  `invoice_currency` varchar(600) NOT NULL,
  `landed_price_gbp` varchar(300) NOT NULL,
  `sp1_value_gbp` varchar(300) NOT NULL,
  `sp2_value_gbp` varchar(300) NOT NULL,
  `sp3_value_gbp` varchar(300) NOT NULL,
  `sale_price_gbp` varchar(600) NOT NULL,
  `landed_price_eur` varchar(300) NOT NULL,
  `sp1_value_eur` varchar(300) NOT NULL,
  `sp2_value_eur` varchar(300) NOT NULL,
  `sp3_value_eur` varchar(300) NOT NULL,
  `sale_price_euro` varchar(600) NOT NULL,
  `import_dates` varchar(400) NOT NULL,
  `error` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_prices`
--

CREATE TABLE `purchase_prices` (
  `id` int(11) NOT NULL,
  `purchase_id` varchar(200) NOT NULL,
  `supplier_id` varchar(300) NOT NULL,
  `stock_itemid` varchar(200) NOT NULL,
  `item_sku` varchar(200) NOT NULL,
  `item_title` varchar(200) NOT NULL,
  `invoice_currency` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `purchase_price` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_channels`
--

CREATE TABLE `sales_channels` (
  `id` int(11) NOT NULL,
  `channel_code` varchar(500) NOT NULL,
  `channel_name` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(11) NOT NULL,
  `category` varchar(400) NOT NULL,
  `country` varchar(400) NOT NULL,
  `shipping_cost` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL DEFAULT '',
  `item_sku` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `id` int(11) NOT NULL,
  `item_number` varchar(200) NOT NULL,
  `item_title` varchar(900) NOT NULL,
  `barcode_number` varchar(200) NOT NULL,
  `category_name` varchar(900) NOT NULL,
  `supp_name` varchar(500) NOT NULL,
  `supp_id` varchar(500) NOT NULL,
  `heights` varchar(200) NOT NULL,
  `widths` varchar(200) NOT NULL,
  `depths` varchar(200) NOT NULL,
  `weights` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_levels`
--

CREATE TABLE `stock_levels` (
  `id` int(11) NOT NULL,
  `change_date` varchar(100) NOT NULL,
  `item_number` varchar(100) NOT NULL,
  `item_title` varchar(200) NOT NULL,
  `barcode_number` varchar(100) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `stock_lev` varchar(100) NOT NULL,
  `stock_val` varchar(100) NOT NULL,
  `unit_costs` varchar(200) NOT NULL,
  `stock_itemid` varchar(100) NOT NULL,
  `stock_location_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_multipliers`
--

CREATE TABLE `supplier_multipliers` (
  `id` int(11) NOT NULL,
  `category` varchar(700) DEFAULT NULL,
  `invoice_currency` text,
  `supplier` varchar(700) DEFAULT NULL,
  `sp1_multiplier` varchar(100) DEFAULT NULL,
  `sp2_multiplier` varchar(100) DEFAULT NULL,
  `sp3_multiplier` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(900) NOT NULL,
  `email` varchar(3000) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modify_by` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acos`
--
ALTER TABLE `acos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_listings`
--
ALTER TABLE `admin_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `web_sku` (`web_sku`);

--
-- Indexes for table `aros`
--
ALTER TABLE `aros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aros_acos`
--
ALTER TABLE `aros_acos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`);

--
-- Indexes for table `bk_stock_items`
--
ALTER TABLE `bk_stock_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_number` (`item_number`);

--
-- Indexes for table `cost_calculators`
--
ALTER TABLE `cost_calculators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `linnworks_code` (`linnworks_code`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cost_settings`
--
ALTER TABLE `cost_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebayenglish_listings`
--
ALTER TABLE `ebayenglish_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `item_sku` (`item_sku`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `item_sku_2` (`item_sku`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `english_listings`
--
ALTER TABLE `english_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_sku` (`item_sku`),
  ADD KEY `item_sku_2` (`item_sku`);

--
-- Indexes for table `france_listings`
--
ALTER TABLE `france_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `item_sku_2` (`item_sku`),
  ADD UNIQUE KEY `item_sku_3` (`item_sku`),
  ADD UNIQUE KEY `item_sku_4` (`item_sku`),
  ADD KEY `id_2` (`id`),
  ADD KEY `item_sku` (`item_sku`),
  ADD KEY `item_sku_5` (`item_sku`);

--
-- Indexes for table `france_master_listings`
--
ALTER TABLE `france_master_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_sku` (`item_sku`);

--
-- Indexes for table `france_product_listings`
--
ALTER TABLE `france_product_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku_2` (`product_sku`),
  ADD KEY `product_sku` (`product_sku`);

--
-- Indexes for table `german_listings`
--
ALTER TABLE `german_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `item_sku_2` (`item_sku`),
  ADD UNIQUE KEY `item_sku_3` (`item_sku`),
  ADD KEY `id_2` (`id`),
  ADD KEY `item_sku` (`item_sku`),
  ADD KEY `item_sku_4` (`item_sku`);

--
-- Indexes for table `german_master_listings`
--
ALTER TABLE `german_master_listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `german_product_listings`
--
ALTER TABLE `german_product_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_codes`
--
ALTER TABLE `inventory_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `linnworks_code` (`linnworks_code`);

--
-- Indexes for table `inventory_masters`
--
ALTER TABLE `inventory_masters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_sku` (`item_sku`),
  ADD KEY `item_sku_2` (`item_sku`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `web_sku` (`web_sku`),
  ADD UNIQUE KEY `web_sku_2` (`web_sku`);

--
-- Indexes for table `main_listings`
--
ALTER TABLE `main_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `index_name` (`amazon_sku`,`channel_id`);

--
-- Indexes for table `master_listings`
--
ALTER TABLE `master_listings`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `index_name` (`amazon_sku`,`channel_id`),
  ADD KEY `linnworks_code` (`linnworks_code`);

--
-- Indexes for table `multipliers`
--
ALTER TABLE `multipliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_orders`
--
ALTER TABLE `open_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`(255)) USING BTREE;

--
-- Indexes for table `processed_listings`
--
ALTER TABLE `processed_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_unique` (`order_id`(13),`product_sku`(14),`product_name`(15),`price_per_product`(17));

--
-- Indexes for table `processed_orders`
--
ALTER TABLE `processed_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id_2` (`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product_listings`
--
ALTER TABLE `product_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- Indexes for table `purchase_prices`
--
ALTER TABLE `purchase_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_sku` (`item_sku`);

--
-- Indexes for table `sales_channels`
--
ALTER TABLE `sales_channels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `channel_code` (`channel_code`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_number` (`item_number`);

--
-- Indexes for table `stock_levels`
--
ALTER TABLE `stock_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqe` (`item_number`,`item_title`,`barcode_number`,`category_name`,`location_name`,`stock_itemid`,`stock_location_id`,`change_date`) USING BTREE;

--
-- Indexes for table `supplier_multipliers`
--
ALTER TABLE `supplier_multipliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acos`
--
ALTER TABLE `acos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `admin_listings`
--
ALTER TABLE `admin_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8991;
--
-- AUTO_INCREMENT for table `aros`
--
ALTER TABLE `aros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `aros_acos`
--
ALTER TABLE `aros_acos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `bk_stock_items`
--
ALTER TABLE `bk_stock_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13653;
--
-- AUTO_INCREMENT for table `cost_calculators`
--
ALTER TABLE `cost_calculators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31182;
--
-- AUTO_INCREMENT for table `cost_settings`
--
ALTER TABLE `cost_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- AUTO_INCREMENT for table `france_master_listings`
--
ALTER TABLE `france_master_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6589;
--
-- AUTO_INCREMENT for table `france_product_listings`
--
ALTER TABLE `france_product_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5757;
--
-- AUTO_INCREMENT for table `german_listings`
--
ALTER TABLE `german_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `german_master_listings`
--
ALTER TABLE `german_master_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `german_product_listings`
--
ALTER TABLE `german_product_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `inventory_codes`
--
ALTER TABLE `inventory_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6773;
--
-- AUTO_INCREMENT for table `inventory_masters`
--
ALTER TABLE `inventory_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11605;
--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6755;
--
-- AUTO_INCREMENT for table `main_listings`
--
ALTER TABLE `main_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24283;
--
-- AUTO_INCREMENT for table `master_listings`
--
ALTER TABLE `master_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46265;
--
-- AUTO_INCREMENT for table `multipliers`
--
ALTER TABLE `multipliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `open_orders`
--
ALTER TABLE `open_orders`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `processed_listings`
--
ALTER TABLE `processed_listings`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1048138;
--
-- AUTO_INCREMENT for table `processed_orders`
--
ALTER TABLE `processed_orders`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=907787;
--
-- AUTO_INCREMENT for table `product_listings`
--
ALTER TABLE `product_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10260;
--
-- AUTO_INCREMENT for table `purchase_prices`
--
ALTER TABLE `purchase_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6195;
--
-- AUTO_INCREMENT for table `sales_channels`
--
ALTER TABLE `sales_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7691;
--
-- AUTO_INCREMENT for table `stock_levels`
--
ALTER TABLE `stock_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3603082;
--
-- AUTO_INCREMENT for table `supplier_multipliers`
--
ALTER TABLE `supplier_multipliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_masters`
--
ALTER TABLE `inventory_masters`
  ADD CONSTRAINT `product_master_sku` FOREIGN KEY (`item_sku`) REFERENCES `inventory_masters` (`item_sku`);

--
-- Constraints for table `product_listings`
--
ALTER TABLE `product_listings`
  ADD CONSTRAINT `master_product_sku` FOREIGN KEY (`product_sku`) REFERENCES `inventory_masters` (`item_sku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
