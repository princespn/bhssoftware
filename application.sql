-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2015 at 12:48 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `application`
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
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 258),
(2, 1, NULL, NULL, 'Pages', 2, 17),
(3, 2, NULL, NULL, 'display', 3, 4),
(4, 2, NULL, NULL, 'build_acl', 5, 6),
(5, 2, NULL, NULL, 'add', 7, 8),
(6, 2, NULL, NULL, 'edit', 9, 10),
(7, 2, NULL, NULL, 'index', 11, 12),
(8, 2, NULL, NULL, 'view', 13, 14),
(9, 2, NULL, NULL, 'delete', 15, 16),
(10, 1, NULL, NULL, 'Users', 18, 41),
(11, 10, NULL, NULL, 'initDB', 19, 20),
(12, 10, NULL, NULL, 'login', 21, 22),
(13, 10, NULL, NULL, 'logout', 23, 24),
(14, 10, NULL, NULL, 'add', 25, 26),
(15, 10, NULL, NULL, 'index', 27, 28),
(16, 10, NULL, NULL, 'view', 29, 30),
(17, 10, NULL, NULL, 'edit', 31, 32),
(18, 10, NULL, NULL, 'forgatepw', 33, 34),
(19, 10, NULL, NULL, 'delete', 35, 36),
(20, 10, NULL, NULL, 'team', 37, 38),
(21, 10, NULL, NULL, 'build_acl', 39, 40),
(22, 1, NULL, NULL, 'Groups', 42, 55),
(23, 22, NULL, NULL, 'index', 43, 44),
(24, 22, NULL, NULL, 'view', 45, 46),
(25, 22, NULL, NULL, 'add', 47, 48),
(26, 22, NULL, NULL, 'edit', 49, 50),
(27, 22, NULL, NULL, 'build_acl', 51, 52),
(28, 22, NULL, NULL, 'delete', 53, 54),
(29, 1, NULL, NULL, 'Admin', 56, 69),
(30, 29, NULL, NULL, 'index', 57, 58),
(31, 29, NULL, NULL, 'build_acl', 59, 60),
(32, 29, NULL, NULL, 'add', 61, 62),
(33, 29, NULL, NULL, 'edit', 63, 64),
(34, 29, NULL, NULL, 'view', 65, 66),
(35, 29, NULL, NULL, 'delete', 67, 68),
(36, 1, NULL, NULL, 'Pharmas', 70, 87),
(37, 36, NULL, NULL, 'addpharma', 71, 72),
(38, 36, NULL, NULL, 'viewpharma', 73, 74),
(39, 36, NULL, NULL, 'build_acl', 75, 76),
(40, 36, NULL, NULL, 'add', 77, 78),
(41, 36, NULL, NULL, 'edit', 79, 80),
(42, 36, NULL, NULL, 'index', 81, 82),
(43, 36, NULL, NULL, 'view', 83, 84),
(44, 36, NULL, NULL, 'delete', 85, 86),
(45, 1, NULL, NULL, 'Projects', 88, 127),
(46, 45, NULL, NULL, 'index', 89, 90),
(47, 45, NULL, NULL, 'srauserlist', 91, 92),
(48, 45, NULL, NULL, 'rauserlist', 93, 94),
(49, 45, NULL, NULL, 'userlist', 95, 96),
(50, 45, NULL, NULL, 'clientlist', 97, 98),
(51, 45, NULL, NULL, 'assign', 99, 100),
(52, 45, NULL, NULL, 'view', 101, 102),
(53, 45, NULL, NULL, 'viewc', 103, 104),
(54, 45, NULL, NULL, 'coment', 105, 106),
(55, 45, NULL, NULL, 'comentc', 107, 108),
(56, 45, NULL, NULL, 'add', 109, 110),
(57, 45, NULL, NULL, 'edit', 111, 112),
(58, 45, NULL, NULL, 'delete', 113, 114),
(59, 45, NULL, NULL, 'admin_index', 115, 116),
(60, 45, NULL, NULL, 'admin_view', 117, 118),
(61, 45, NULL, NULL, 'admin_add', 119, 120),
(62, 45, NULL, NULL, 'admin_edit', 121, 122),
(63, 45, NULL, NULL, 'admin_delete', 123, 124),
(64, 45, NULL, NULL, 'build_acl', 125, 126),
(65, 1, NULL, NULL, 'Teams', 128, 141),
(66, 65, NULL, NULL, 'index', 129, 130),
(67, 65, NULL, NULL, 'build_acl', 131, 132),
(68, 65, NULL, NULL, 'add', 133, 134),
(69, 65, NULL, NULL, 'edit', 135, 136),
(70, 65, NULL, NULL, 'view', 137, 138),
(71, 65, NULL, NULL, 'delete', 139, 140),
(72, 1, NULL, NULL, 'Infringements', 142, 159),
(73, 72, NULL, NULL, 'addevalution', 143, 144),
(74, 72, NULL, NULL, 'viewevalution', 145, 146),
(75, 72, NULL, NULL, 'build_acl', 147, 148),
(76, 72, NULL, NULL, 'add', 149, 150),
(77, 72, NULL, NULL, 'edit', 151, 152),
(78, 72, NULL, NULL, 'index', 153, 154),
(79, 72, NULL, NULL, 'view', 155, 156),
(80, 72, NULL, NULL, 'delete', 157, 158),
(81, 1, NULL, NULL, 'Searches', 160, 177),
(82, 81, NULL, NULL, 'addsearch', 161, 162),
(83, 81, NULL, NULL, 'viewsearch', 163, 164),
(84, 81, NULL, NULL, 'build_acl', 165, 166),
(85, 81, NULL, NULL, 'add', 167, 168),
(86, 81, NULL, NULL, 'edit', 169, 170),
(87, 81, NULL, NULL, 'index', 171, 172),
(88, 81, NULL, NULL, 'view', 173, 174),
(89, 81, NULL, NULL, 'delete', 175, 176),
(90, 1, NULL, NULL, 'Timesheets', 178, 203),
(91, 90, NULL, NULL, 'index', 179, 180),
(92, 90, NULL, NULL, 'add', 181, 182),
(93, 90, NULL, NULL, 'projectsralist', 183, 184),
(94, 90, NULL, NULL, 'projectralist', 185, 186),
(95, 90, NULL, NULL, 'projecttllist', 187, 188),
(96, 90, NULL, NULL, 'userlist', 189, 190),
(97, 90, NULL, NULL, 'teamlist', 191, 192),
(98, 90, NULL, NULL, 'edit', 193, 194),
(99, 90, NULL, NULL, 'view', 195, 196),
(100, 90, NULL, NULL, 'email', 197, 198),
(101, 90, NULL, NULL, 'build_acl', 199, 200),
(102, 90, NULL, NULL, 'delete', 201, 202),
(103, 1, NULL, NULL, 'Landscapes', 204, 221),
(104, 103, NULL, NULL, 'addlandscape', 205, 206),
(105, 103, NULL, NULL, 'viewlandscape', 207, 208),
(106, 103, NULL, NULL, 'build_acl', 209, 210),
(107, 103, NULL, NULL, 'add', 211, 212),
(108, 103, NULL, NULL, 'edit', 213, 214),
(109, 103, NULL, NULL, 'index', 215, 216),
(110, 103, NULL, NULL, 'view', 217, 218),
(111, 103, NULL, NULL, 'delete', 219, 220),
(112, 1, NULL, NULL, 'Coments', 222, 239),
(113, 112, NULL, NULL, 'Coments', 223, 238),
(114, 113, NULL, NULL, 'download', 224, 225),
(115, 113, NULL, NULL, 'index', 226, 227),
(116, 113, NULL, NULL, 'add', 228, 229),
(117, 113, NULL, NULL, 'build_acl', 230, 231),
(118, 113, NULL, NULL, 'edit', 232, 233),
(119, 113, NULL, NULL, 'view', 234, 235),
(120, 113, NULL, NULL, 'delete', 236, 237),
(121, 1, NULL, NULL, 'Comments', 240, 257),
(122, 121, NULL, NULL, 'Comments', 241, 256),
(123, 122, NULL, NULL, 'download', 242, 243),
(124, 122, NULL, NULL, 'index', 244, 245),
(125, 122, NULL, NULL, 'add', 246, 247),
(126, 122, NULL, NULL, 'build_acl', 248, 249),
(127, 122, NULL, NULL, 'edit', 250, 251),
(128, 122, NULL, NULL, 'view', 252, 253),
(129, 122, NULL, NULL, 'delete', 254, 255);

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 18),
(2, NULL, 'Group', 2, NULL, 19, 20),
(3, NULL, 'Group', 3, NULL, 21, 26),
(4, NULL, 'Group', 4, NULL, 27, 28),
(5, NULL, 'Group', 5, NULL, 29, 30),
(6, NULL, 'Group', 6, NULL, 31, 32),
(7, NULL, 'Group', 7, NULL, 33, 34),
(8, 1, 'User', 1, NULL, 2, 3),
(9, 1, 'User', 2, NULL, 6, 7),
(10, 1, 'User', 3, NULL, 10, 11),
(11, 1, 'User', 4, NULL, 14, 15),
(15, 1, 'User', 2, NULL, 4, 5),
(14, 3, 'User', 7, NULL, 22, 23),
(16, 1, 'User', 3, NULL, 8, 9),
(17, 1, 'User', 4, NULL, 12, 13),
(18, 1, 'User', 5, NULL, 16, 17),
(20, 3, 'User', 7, NULL, 24, 25);

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '1', '1', '1', '1'),
(3, 2, 17, '-1', '-1', '-1', '-1'),
(4, 2, 56, '-1', '-1', '-1', '-1'),
(5, 2, 53, '-1', '-1', '-1', '-1'),
(6, 3, 1, '-1', '-1', '-1', '-1'),
(7, 3, 52, '1', '1', '1', '1'),
(8, 4, 1, '1', '1', '1', '1'),
(9, 4, 17, '-1', '-1', '-1', '-1'),
(10, 5, 1, '1', '1', '1', '1'),
(11, 5, 15, '-1', '-1', '-1', '-1'),
(12, 5, 14, '-1', '-1', '-1', '-1'),
(13, 5, 17, '-1', '-1', '-1', '-1'),
(14, 5, 56, '-1', '-1', '-1', '-1'),
(15, 6, 1, '-1', '-1', '-1', '-1'),
(16, 6, 20, '1', '1', '1', '1'),
(17, 6, 18, '1', '1', '1', '1'),
(18, 6, 52, '1', '1', '1', '1'),
(19, 6, 53, '1', '1', '1', '1'),
(20, 6, 54, '1', '1', '1', '1'),
(21, 6, 74, '1', '1', '1', '1'),
(22, 6, 83, '1', '1', '1', '1'),
(23, 6, 38, '1', '1', '1', '1'),
(24, 6, 105, '1', '1', '1', '1'),
(25, 6, 92, '1', '1', '1', '1'),
(26, 6, 98, '1', '1', '1', '1'),
(27, 6, 99, '1', '1', '1', '1'),
(28, 7, 1, '-1', '-1', '-1', '-1'),
(29, 7, 20, '1', '1', '1', '1'),
(30, 7, 18, '1', '1', '1', '1'),
(31, 7, 52, '1', '1', '1', '1'),
(32, 7, 53, '1', '1', '1', '1'),
(33, 7, 54, '1', '1', '1', '1'),
(34, 7, 74, '1', '1', '1', '1'),
(35, 7, 83, '1', '1', '1', '1'),
(36, 7, 38, '1', '1', '1', '1'),
(37, 7, 105, '1', '1', '1', '1'),
(38, 7, 92, '1', '1', '1', '1'),
(39, 7, 98, '1', '1', '1', '1'),
(40, 7, 99, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `size` varchar(3000) NOT NULL,
  `coment_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coments`
--

CREATE TABLE IF NOT EXISTS `coments` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(8000) NOT NULL,
  `created` datetime DEFAULT NULL,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(8000) NOT NULL,
  `created` datetime DEFAULT NULL,
  `creator_id` int(10) unsigned DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'administrators', '2012-09-25 13:16:11', '2012-09-25 13:16:11'),
(2, 'Editor', '2012-09-25 13:18:02', '2015-06-17 10:31:10'),
(3, 'Reader', '2012-09-25 13:18:17', '2015-06-17 10:31:49'),
(4, 'sales', '2012-09-25 13:18:34', '2015-06-17 10:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `infringements`
--

CREATE TABLE IF NOT EXISTS `infringements` (
  `id` int(20) NOT NULL,
  `team_id` int(10) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `month` date NOT NULL,
  `delivery` float NOT NULL,
  `without_error` float NOT NULL,
  `number_of_errors` int(10) NOT NULL,
  `cap_novelty` varchar(25) NOT NULL,
  `comprehensive_search` varchar(25) NOT NULL,
  `bang` varchar(25) NOT NULL,
  `reports` float NOT NULL,
  `mentor_suggestion` varchar(25) NOT NULL,
  `error_mapping` varchar(25) NOT NULL,
  `element_mapping_claim_chart` varchar(25) NOT NULL,
  `products_not_chart` float NOT NULL,
  `on_time_update` varchar(25) NOT NULL,
  `client` varchar(25) NOT NULL,
  `acknowledge_emails` varchar(25) NOT NULL,
  `quality_emails` varchar(25) NOT NULL,
  `verbal_comm` varchar(25) NOT NULL,
  `written_comm_error` float NOT NULL,
  `motivation` varchar(25) NOT NULL,
  `independent_learning` varchar(25) NOT NULL,
  `adaptation` varchar(25) NOT NULL,
  `responsibility` varchar(25) NOT NULL,
  `new_tech_share` varchar(25) NOT NULL,
  `no_of_share` int(10) NOT NULL,
  `project_quality_rating` varchar(25) NOT NULL,
  `cooperate` varchar(25) NOT NULL,
  `new_approach` varchar(25) NOT NULL,
  `initiative` varchar(25) NOT NULL,
  `excel_function` varchar(25) NOT NULL,
  `intellectual_property` varchar(25) NOT NULL,
  `patent_laws` varchar(25) NOT NULL,
  `lawsuit` varchar(25) NOT NULL,
  `expediting_project` varchar(25) NOT NULL,
  `project_quality4` float NOT NULL,
  `rough` int(11) NOT NULL,
  `deliveryt` text NOT NULL,
  `without_errort` text NOT NULL,
  `number_of_errorst` text NOT NULL,
  `cap_noveltyt` text NOT NULL,
  `comprehensive_searcht` text NOT NULL,
  `bangt` text NOT NULL,
  `reportst` text NOT NULL,
  `mentor_suggestiont` text NOT NULL,
  `error_mappingt` text NOT NULL,
  `element_mapping_claim_chartt` text NOT NULL,
  `products_not_chartt` text NOT NULL,
  `on_time_updatet` text NOT NULL,
  `clientt` text NOT NULL,
  `acknowledge_emailst` text NOT NULL,
  `quality_emailst` text NOT NULL,
  `verbal_commt` text NOT NULL,
  `written_comm_errort` text NOT NULL,
  `motivationt` text NOT NULL,
  `independent_learningt` text NOT NULL,
  `adaptationt` text NOT NULL,
  `responsibilityt` text NOT NULL,
  `new_tech_sharet` text NOT NULL,
  `no_of_sharet` text NOT NULL,
  `project_quality_ratingt` text NOT NULL,
  `cooperatet` text NOT NULL,
  `new_approacht` text NOT NULL,
  `initiativet` text NOT NULL,
  `excel_functiont` text NOT NULL,
  `intellectual_propertyt` text NOT NULL,
  `patent_lawst` text NOT NULL,
  `lawsuitt` text NOT NULL,
  `expediting_projectt` text NOT NULL,
  `project_quality4t` text NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `landscapes`
--

CREATE TABLE IF NOT EXISTS `landscapes` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `month` date NOT NULL,
  `delivery` float NOT NULL,
  `deliver_errors` float NOT NULL,
  `keylogic` varchar(25) NOT NULL,
  `judge` varchar(25) NOT NULL,
  `bang` varchar(25) NOT NULL,
  `include` varchar(25) NOT NULL,
  `includecat` varchar(25) NOT NULL,
  `mapping` varchar(25) NOT NULL,
  `mappingc` varchar(25) NOT NULL,
  `coll` varchar(25) NOT NULL,
  `updates` varchar(25) NOT NULL,
  `plan` varchar(25) NOT NULL,
  `ackn` varchar(25) NOT NULL,
  `fdeliver_errors` int(11) NOT NULL,
  `english` varchar(25) NOT NULL,
  `charts` varchar(25) NOT NULL,
  `customize` varchar(25) NOT NULL,
  `insight` varchar(25) NOT NULL,
  `chartprep` varchar(25) NOT NULL,
  `respdead` varchar(25) NOT NULL,
  `share` varchar(25) NOT NULL,
  `delay` varchar(25) NOT NULL,
  `qualityflag` varchar(25) NOT NULL,
  `clientshare` varchar(25) NOT NULL,
  `ackmail` varchar(25) NOT NULL,
  `qualityemail` varchar(25) NOT NULL,
  `vcomm` varchar(25) NOT NULL,
  `self` varchar(25) NOT NULL,
  `indp` varchar(25) NOT NULL,
  `adapt` varchar(25) NOT NULL,
  `undert` varchar(25) NOT NULL,
  `newt` varchar(25) NOT NULL,
  `findings` int(11) NOT NULL,
  `teamwork` varchar(25) NOT NULL,
  `planz` varchar(25) NOT NULL,
  `risk` varchar(25) NOT NULL,
  `coord` varchar(25) NOT NULL,
  `skills` varchar(25) NOT NULL,
  `clientform` varchar(25) NOT NULL,
  `clientq` varchar(252) NOT NULL,
  `delegation` varchar(25) NOT NULL,
  `attitude` varchar(25) NOT NULL,
  `approach` varchar(25) NOT NULL,
  `initiative` varchar(25) NOT NULL,
  `excel` varchar(25) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `patent` varchar(25) NOT NULL,
  `law` varchar(25) NOT NULL,
  `new` varchar(255) NOT NULL,
  `deliprep` varchar(25) NOT NULL,
  `quality_rate3` float NOT NULL,
  `rough` int(11) NOT NULL,
  `deliveryt` text NOT NULL,
  `deliver_errorst` text NOT NULL,
  `keylogict` text NOT NULL,
  `judget` text NOT NULL,
  `bangt` text NOT NULL,
  `includet` text NOT NULL,
  `includecatt` text NOT NULL,
  `mappingt` text NOT NULL,
  `mappingct` text NOT NULL,
  `collt` text NOT NULL,
  `updatest` text NOT NULL,
  `plant` text NOT NULL,
  `acknt` text NOT NULL,
  `fdeliver_errorst` text NOT NULL,
  `englisht` text NOT NULL,
  `chartst` text NOT NULL,
  `customizet` text NOT NULL,
  `insightt` text NOT NULL,
  `chartprept` text NOT NULL,
  `respdeadt` text NOT NULL,
  `sharet` text NOT NULL,
  `delayt` text NOT NULL,
  `qualityflagt` text NOT NULL,
  `clientsharet` text NOT NULL,
  `ackmailt` text NOT NULL,
  `qualityemailt` text NOT NULL,
  `vcommt` text NOT NULL,
  `selft` text NOT NULL,
  `indpt` text NOT NULL,
  `adaptt` text NOT NULL,
  `undertt` text NOT NULL,
  `newtt` text NOT NULL,
  `findingst` text NOT NULL,
  `teamworkt` text NOT NULL,
  `planzt` text NOT NULL,
  `riskt` text NOT NULL,
  `coordt` text NOT NULL,
  `skillst` text NOT NULL,
  `clientformt` text NOT NULL,
  `clientqt` text NOT NULL,
  `delegationt` text NOT NULL,
  `attitudet` text NOT NULL,
  `approacht` text NOT NULL,
  `initiativet` text NOT NULL,
  `excelt` text NOT NULL,
  `ipt` text NOT NULL,
  `patentt` text NOT NULL,
  `lawt` text NOT NULL,
  `new_t` text NOT NULL,
  `deliprept` text NOT NULL,
  `quality_rate3t` text NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type` varchar(900) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `comment` varchar(9000) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `coment_id` int(11) NOT NULL,
  `massage` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharmas`
--

CREATE TABLE IF NOT EXISTS `pharmas` (
  `id` int(11) NOT NULL,
  `team_id` int(10) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `month` date NOT NULL,
  `delivery` float NOT NULL,
  `without_error` float NOT NULL,
  `number_of_errors` int(11) NOT NULL,
  `capture_novelty` varchar(25) NOT NULL,
  `comprehensive_search` varchar(25) NOT NULL,
  `bang` varchar(25) NOT NULL,
  `reports` float NOT NULL,
  `keyerror` float NOT NULL,
  `compkey` varchar(25) NOT NULL,
  `mentor_suggestion` varchar(25) NOT NULL,
  `error_mapping` varchar(25) NOT NULL,
  `on_time_update` varchar(25) NOT NULL,
  `client` varchar(25) NOT NULL,
  `acknowledge_emails` varchar(25) NOT NULL,
  `quality_emails` varchar(25) NOT NULL,
  `verbal_comm` varchar(25) NOT NULL,
  `written_comm_error` float NOT NULL,
  `motivation` varchar(25) NOT NULL,
  `independent_learning` varchar(25) NOT NULL,
  `adaptation` varchar(25) NOT NULL,
  `responsibility` varchar(25) NOT NULL,
  `new_tech_share` varchar(25) NOT NULL,
  `no_of_share` int(10) NOT NULL,
  `project_quality_rating` varchar(25) NOT NULL,
  `cooperate` varchar(25) NOT NULL,
  `new_approach` varchar(25) NOT NULL,
  `initiative` varchar(252) NOT NULL,
  `excel_function` varchar(25) NOT NULL,
  `intellectual_property` varchar(25) NOT NULL,
  `patent_laws` varchar(25) NOT NULL,
  `lawsuit` varchar(25) NOT NULL,
  `expediting_project` varchar(25) NOT NULL,
  `deliver_quality` varchar(25) NOT NULL,
  `project_quality4` float NOT NULL,
  `rough` int(11) NOT NULL,
  `deliveryt` text NOT NULL,
  `without_errort` text NOT NULL,
  `number_of_errorst` text NOT NULL,
  `capture_noveltyt` text NOT NULL,
  `comprehensive_searcht` text NOT NULL,
  `bangt` text NOT NULL,
  `reportst` text NOT NULL,
  `keyerrort` text NOT NULL,
  `compkeyt` text NOT NULL,
  `mentor_suggestiont` text NOT NULL,
  `error_mappingt` text NOT NULL,
  `on_time_updatet` text NOT NULL,
  `clientt` text NOT NULL,
  `acknowledge_emailst` text NOT NULL,
  `quality_emailst` text NOT NULL,
  `verbal_commt` text NOT NULL,
  `written_comm_errort` text NOT NULL,
  `motivationt` text NOT NULL,
  `independent_learningt` text NOT NULL,
  `adaptationt` text NOT NULL,
  `responsibilityt` text NOT NULL,
  `new_tech_sharet` text NOT NULL,
  `no_of_sharet` text NOT NULL,
  `project_quality_ratingt` text NOT NULL,
  `cooperatet` text NOT NULL,
  `new_approacht` text NOT NULL,
  `initiativet` text NOT NULL,
  `excel_functiont` text NOT NULL,
  `intellectual_propertyt` text NOT NULL,
  `patent_lawst` text NOT NULL,
  `lawsuitt` text NOT NULL,
  `expediting_projectt` text NOT NULL,
  `deliver_qualityt` text NOT NULL,
  `project_quality4t` text NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_sku` varchar(500) NOT NULL,
  `external_product_id` varchar(100) DEFAULT NULL,
  `external_product_id_type` varchar(100) NOT NULL,
  `item_name` varchar(900) NOT NULL,
  `brand_name` varchar(700) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `feed_product_type` varchar(400) NOT NULL,
  `part_number` varchar(500) NOT NULL,
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
  `sale_from_date` varchar(100) NOT NULL,
  `sale_end_date` varchar(100) NOT NULL,
  `condition_type` varchar(100) NOT NULL,
  `condition_note` varchar(900) DEFAULT NULL,
  `fulfillment_latency` varchar(900) DEFAULT NULL,
  `restock_date` varchar(100) NOT NULL,
  `max_aggregate_ship_quantity` varchar(400) NOT NULL,
  `offering_can_be_gift_messaged` varchar(400) NOT NULL,
  `offering_can_be_giftwrapped` varchar(2000) NOT NULL,
  `is_discontinued_by_manufacturer` varchar(100) NOT NULL,
  `missing_keyset_reason` varchar(2000) NOT NULL,
  `website_shipping_weight` varchar(2000) NOT NULL,
  `website_shipping_weight_unit_of_measure` varchar(2000) NOT NULL,
  `item_display_length` varchar(2000) NOT NULL,
  `item_display_length_unit_of_measure` varchar(2000) NOT NULL,
  `item_display_width` varchar(400) NOT NULL,
  `item_display_width_unit_of_measure` varchar(400) NOT NULL,
  `item_display_height` varchar(200) NOT NULL,
  `item_display_height_unit_of_measure` varchar(200) NOT NULL,
  `item_display_depth` varchar(300) NOT NULL,
  `item_display_depth_unit_of_measure` varchar(300) NOT NULL,
  `item_display_diameter` varchar(900) NOT NULL,
  `item_display_diameter_unit_of_measure` varchar(900) NOT NULL,
  `item_display_weight` varchar(900) NOT NULL,
  `item_display_weight_unit_of_measure` varchar(900) NOT NULL,
  `volume_capacity_name` varchar(900) NOT NULL,
  `volume_capacity_name_unit_of_measure` varchar(900) NOT NULL,
  `item_display_volume` varchar(900) NOT NULL,
  `item_display_volume_unit_of_measure` varchar(900) NOT NULL,
  `recommended_browse_nodes1` varchar(900) NOT NULL,
  `recommended_browse_nodes2` varchar(900) NOT NULL,
  `catalog_number` varchar(900) NOT NULL,
  `bullet_point1` text NOT NULL,
  `bullet_point2` text NOT NULL,
  `bullet_point3` text NOT NULL,
  `bullet_point4` text NOT NULL,
  `bullet_point5` text NOT NULL,
  `generic_keywords1` text NOT NULL,
  `generic_keywords2` text NOT NULL,
  `generic_keywords3` text NOT NULL,
  `generic_keywords4` text NOT NULL,
  `generic_keywords5` text NOT NULL,
  `platinum_keywords1` text NOT NULL,
  `platinum_keywords2` text NOT NULL,
  `platinum_keywords3` text NOT NULL,
  `platinum_keywords4` text NOT NULL,
  `platinum_keywords5` text NOT NULL,
  `target_audience_keywords1` text NOT NULL,
  `target_audience_keywords2` text NOT NULL,
  `target_audience_keywords3` text NOT NULL,
  `target_audience_keywords4` text NOT NULL,
  `target_audience_keywords5` text NOT NULL,
  `main_image_url` varchar(200) NOT NULL,
  `swatch_image_url` varchar(200) NOT NULL,
  `other_image_url1` varchar(200) NOT NULL,
  `other_image_url2` varchar(200) NOT NULL,
  `other_image_url3` varchar(100) NOT NULL,
  `other_image_url4` varchar(100) NOT NULL,
  `other_image_url5` varchar(100) NOT NULL,
  `other_image_url6` varchar(100) NOT NULL,
  `other_image_url7` varchar(100) NOT NULL,
  `other_image_url8` varchar(100) NOT NULL,
  `package_length` varchar(100) NOT NULL,
  `package_width` varchar(100) NOT NULL,
  `package_height` varchar(100) NOT NULL,
  `package_length_unit_of_measure` varchar(100) NOT NULL,
  `fulfillment_center_id` varchar(100) NOT NULL,
  `parent_child` varchar(300) NOT NULL,
  `parent_sku` varchar(200) NOT NULL,
  `relationship_type` varchar(300) NOT NULL,
  `variation_theme` varchar(400) NOT NULL,
  `eu_toys_safety_directive_age_warning` text NOT NULL,
  `eu_toys_safety_directive_warning1` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning2` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning3` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning4` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning5` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning6` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning7` varchar(400) NOT NULL,
  `eu_toys_safety_directive_warning8` varchar(400) NOT NULL,
  `color_name` varchar(400) NOT NULL,
  `color_map` varchar(500) NOT NULL,
  `size_name` varchar(400) NOT NULL,
  `warranty_description` text NOT NULL,
  `number_of_pieces` varchar(100) NOT NULL,
  `material_type1` varchar(300) NOT NULL,
  `material_type2` varchar(300) NOT NULL,
  `material_type3` varchar(200) NOT NULL,
  `material_type4` varchar(200) NOT NULL,
  `material_type5` varchar(100) NOT NULL,
  `material_type6` varchar(100) NOT NULL,
  `material_type7` varchar(100) NOT NULL,
  `material_type8` varchar(100) NOT NULL,
  `special_features1` varchar(300) NOT NULL,
  `special_features2` varchar(300) NOT NULL,
  `special_features3` varchar(300) NOT NULL,
  `special_features4` varchar(300) NOT NULL,
  `special_features5` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE IF NOT EXISTS `searches` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `month` date NOT NULL,
  `delivery` float NOT NULL,
  `without_error` float NOT NULL,
  `number_of_errors` int(11) NOT NULL,
  `capture_novelty` varchar(25) NOT NULL,
  `comprehensive_search` varchar(25) NOT NULL,
  `bang` varchar(25) NOT NULL,
  `reports` float NOT NULL,
  `keyerror` float NOT NULL,
  `compkey` varchar(25) NOT NULL,
  `mentor_suggestion` varchar(25) NOT NULL,
  `error_mapping` varchar(25) NOT NULL,
  `on_time_update` varchar(25) NOT NULL,
  `client` varchar(25) NOT NULL,
  `acknowledge_emails` varchar(25) NOT NULL,
  `quality_emails` varchar(25) NOT NULL,
  `verbal_comm` varchar(25) NOT NULL,
  `written_comm_error` float NOT NULL,
  `motivation` varchar(25) NOT NULL,
  `independent_learning` varchar(25) NOT NULL,
  `adaptation` varchar(25) NOT NULL,
  `responsibility` varchar(25) NOT NULL,
  `new_tech_share` varchar(25) NOT NULL,
  `no_of_share` int(11) NOT NULL,
  `project_quality_rating` varchar(25) NOT NULL,
  `cooperate` varchar(25) NOT NULL,
  `new_approach` varchar(25) NOT NULL,
  `initiative` varchar(25) NOT NULL,
  `excel_function` varchar(25) NOT NULL,
  `intellectual_property` varchar(25) NOT NULL,
  `patent_laws` varchar(25) NOT NULL,
  `lawsuit` varchar(25) NOT NULL,
  `expediting_project` varchar(25) NOT NULL,
  `deliver_quality` varchar(25) NOT NULL,
  `project_quality4` float NOT NULL,
  `rough` int(11) NOT NULL,
  `deliveryt` text NOT NULL,
  `without_errort` text NOT NULL,
  `number_of_errorst` text NOT NULL,
  `capture_noveltyt` text NOT NULL,
  `comprehensive_searcht` text NOT NULL,
  `bangt` text NOT NULL,
  `reportst` text NOT NULL,
  `keyerrort` text NOT NULL,
  `compkeyt` text NOT NULL,
  `mentor_suggestiont` text NOT NULL,
  `error_mappingt` text NOT NULL,
  `on_time_updatet` text NOT NULL,
  `clientt` text NOT NULL,
  `acknowledge_emailst` text NOT NULL,
  `quality_emailst` text NOT NULL,
  `verbal_commt` text NOT NULL,
  `written_comm_errort` text NOT NULL,
  `motivationt` text NOT NULL,
  `independent_learningt` text NOT NULL,
  `adaptationt` text NOT NULL,
  `responsibilityt` text NOT NULL,
  `new_tech_sharet` text NOT NULL,
  `no_of_sharet` text NOT NULL,
  `project_quality_ratingt` text NOT NULL,
  `cooperatet` text NOT NULL,
  `new_approacht` text NOT NULL,
  `initiativet` text NOT NULL,
  `excel_functiont` text NOT NULL,
  `intellectual_propertyt` text NOT NULL,
  `patent_lawst` text NOT NULL,
  `lawsuitt` text NOT NULL,
  `expediting_projectt` text NOT NULL,
  `deliver_qualityt` text NOT NULL,
  `project_quality4t` text NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(3000) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`) VALUES
(1, 'Infringement'),
(2, 'Search'),
(3, 'Search Pharma'),
(4, 'Landscape');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE IF NOT EXISTS `timesheets` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `task` varchar(900) DEFAULT NULL,
  `status` varchar(900) DEFAULT NULL,
  `specification` varchar(2000) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(900) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modify_by` varchar(900) NOT NULL,
  `working_hours` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `size` varchar(3000) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `modify_by` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `group_id`, `created`, `created_by`, `modified`, `modify_by`) VALUES
(1, 'admin', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'amit.tiwari@homescapesonline.com', 1, '2012-09-25 13:24:26', '', '2015-06-15 10:21:06', 'homescapesonline'),
(2, 'homescapesonline', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'amit@homescapesonline.com', 1, '2015-06-15 10:18:59', 'admin', '2015-06-18 12:29:17', 'admin'),
(3, 'hsadmin', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'vijay@homescapesonline.com', 1, '2015-06-18 12:32:07', 'homescapesonline', '2015-06-18 12:38:54', 'admin'),
(4, 'amittiwari', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'amittiwari@gmail.com', 1, '2015-06-18 12:46:47', 'admin', '2015-06-18 13:07:42', 'admin'),
(5, 'vikram', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'vikram@homescapesonline.com', 1, '2015-06-18 13:13:29', 'admin', '2015-06-18 13:13:29', ''),
(7, 'pankaj', 'b87ec64c455a3341e564efe33400ceaab29a4852', 'pankaj@homescapesonline.com', 3, '2015-06-19 11:56:44', 'admin', '2015-06-22 06:42:07', 'admin');

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
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`coment_id`);

--
-- Indexes for table `coments`
--
ALTER TABLE `coments`
  ADD PRIMARY KEY (`id`), ADD KEY `creator_id` (`creator_id`), ADD KEY `modifier_id` (`modifier_id`), ADD KEY `id` (`id`), ADD KEY `model` (`model`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`), ADD KEY `creator_id` (`creator_id`), ADD KEY `modifier_id` (`modifier_id`), ADD KEY `id` (`id`), ADD KEY `model` (`model`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infringements`
--
ALTER TABLE `infringements`
  ADD PRIMARY KEY (`id`), ADD KEY `emp_id` (`team_id`);

--
-- Indexes for table `landscapes`
--
ALTER TABLE `landscapes`
  ADD PRIMARY KEY (`id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmas`
--
ALTER TABLE `pharmas`
  ADD PRIMARY KEY (`id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `id_2` (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `aros`
--
ALTER TABLE `aros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `aros_acos`
--
ALTER TABLE `aros_acos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coments`
--
ALTER TABLE `coments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `infringements`
--
ALTER TABLE `infringements`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `landscapes`
--
ALTER TABLE `landscapes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharmas`
--
ALTER TABLE `pharmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
