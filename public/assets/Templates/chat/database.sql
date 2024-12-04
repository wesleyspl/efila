-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306

-- Generation Time: May 26, 2015 at 09:43 PM
-- Server version: 5.5.28
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coco`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `userip` varchar(20) NOT NULL,
  `debug_data` text NOT NULL,
  `referrer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('success','fail') NOT NULL DEFAULT 'success',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat_logs`
--

CREATE TABLE `chat_logs` (
  `LID` bigint(20) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) NOT NULL DEFAULT '0',
  `toid` int(11) NOT NULL DEFAULT '0',
  `message` longtext NOT NULL,
  `sent_time` datetime NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`LID`),
  KEY `fromid` (`fromid`,`toid`,`sent_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(3) NOT NULL DEFAULT '0',
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `link`, `parent`, `sort`, `icon`) VALUES
(1, 'Dashboard', 'javascript:void(0);', 0, 0, 'icon-home-3'),
(2, 'UI Elements', 'javascript:void(0);', 0, 1, 'icon-feather'),
(3, 'Typography', 'typography.html', 2, 0, ''),
(5, 'Notifications', 'notifications.html', 2, 0, ''),
(6, 'Grid', 'grid.html', 2, 0, ''),
(7, 'Icons', 'icons.html', 2, 0, ''),
(8, 'Forms', 'javascript:void(0);', 0, 2, 'icon-pencil-3'),
(9, 'Tables', 'javascript:void(0);', 0, 3, 'fa fa-table'),
(10, 'Maps', 'javascript:void(0);', 0, 4, 'fa fa-map-marker'),
(11, 'Email', 'javascript:void(0);', 0, 5, 'fa fa-envelope'),
(12, 'Charts', 'javascript:void(0);', 0, 6, 'icon-chart-line'),
(14, 'Extras', 'javascript:void(0);', 0, 8, 'icon-megaphone'),
(15, 'Modals', 'modals.html', 2, 0, ''),
(16, 'Portlets', 'portlets.html', 2, 0, ''),
(17, 'Alerts', 'alerts.html', 2, 0, ''),
(18, 'Nested List', 'nested-list.html', 2, 0, ''),
(19, 'Progress Bars', 'progress-bars.html', 2, 0, ''),
(20, 'Tabs & Accordions', 'tabs-accordions.html', 2, 0, ''),
(21, 'Buttons', 'buttons.html', 2, 0, ''),
(22, 'Calendar', 'calendar.html', 2, 0, ''),
(23, 'Form Elements', 'forms.html', 8, 1, ''),
(51, 'Advanced Forms', 'advanced-forms.html', 8, 2, ''),
(25, 'Form Wizard', 'form-wizard.html', 8, 3, ''),
(26, 'Form Validation', 'form-validation.html', 8, 4, ''),
(27, 'File Uploads', 'form-uploads.html', 8, 5, ''),
(28, 'Basic Tables', 'tables.html', 9, 0, ''),
(29, 'Datatables', 'datatables.html', 9, 1, ''),
(30, 'Google Maps', 'google-maps.html', 10, 0, ''),
(31, 'Vector Maps', 'vector-maps.html', 10, 1, ''),
(32, 'Inbox', 'inbox.html', 11, 0, ''),
(33, 'View Email', 'read-message.html', 11, 1, ''),
(34, 'Blank Page', 'blank.html', 14, 0, ''),
(35, 'Login', 'login.html', 14, 1, ''),
(36, 'Lock Screen', 'lockscreen.html', 14, 2, ''),
(37, '404 Error', '404.html', 14, 3, ''),
(38, 'Gallery', 'gallery.html', 14, 7, ''),
(39, 'User Profile', 'profile.html', 14, 5, ''),
(40, 'Invoice', 'invoice.html', 14, 6, ''),
(41, '500 Error', '500.html', 14, 4, ''),
(42, 'Maintenance', 'maintenance.html', 14, 8, ''),
(43, '3 Level menu', 'javascript:void(0);', 14, 9, ''),
(44, 'Sub Item', 'javascript:void(0);', 43, 0, ''),
(45, '4 Level Menu', 'javascript:void(0);', 14, 10, ''),
(46, 'Sub Item - level 3', 'javascript:void(0);', 45, 0, ''),
(47, 'Sub Item - level 4', 'javascript:void(0);', 46, 0, ''),
(48, 'Submenu with icons', 'javascript:void(0);', 14, 11, ''),
(49, 'Item with icon', 'javascript:void(0);', 48, 0, 'fa fa-camera'),
(50, 'Another Item', 'javascript:void(0);', 48, 1, 'entypo entypo-users'),
(52, 'New Message', 'new-message.html', 11, 2, ''),
(53, 'Sparkline Charts', 'sparkline-charts.html', 12, 0, ''),
(54, 'Morris Charts', 'morris-charts.html', 12, 1, ''),
(55, 'Rickshaw Charts', 'rickshaw-charts.html', 12, 2, ''),
(56, 'Other Charts', 'other-charts.html', 12, 3, ''),
(57, 'Register', 'register.html', 14, 1, ''),
(58, 'Dashboard v1', 'index.html', 1, 0, ''),
(59, 'Dashboard v2', 'index2.html', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `PID` int(5) NOT NULL AUTO_INCREMENT,
  `perm` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`PID`),
  UNIQUE KEY `perm` (`perm`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`PID`, `perm`, `description`, `created_at`, `updated_at`) VALUES
(1, 'index', 'Enable user to view dashboard page', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'index2', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'alerts', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'calendar', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'grid', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'icons', '', '2015-05-13 17:09:31', '2015-05-13 17:09:31'),
(10, 'notifications', '', '2015-05-13 17:12:41', '2015-05-13 17:12:41'),
(8, 'modals', '', '2015-05-13 17:12:23', '2015-05-13 17:12:23'),
(9, 'nested-list', '', '2015-05-13 17:12:26', '2015-05-13 17:12:26'),
(11, 'portlets', '', '2015-05-13 17:12:43', '2015-05-13 17:12:43'),
(12, 'progress-bars', '', '2015-05-13 17:12:45', '2015-05-13 17:12:45'),
(13, 'tabs-accordions', '', '2015-05-13 17:12:47', '2015-05-13 17:12:47'),
(14, 'typography', '', '2015-05-13 17:12:49', '2015-05-13 17:12:49'),
(15, 'forms', '', '2015-05-13 17:12:51', '2015-05-13 17:12:51'),
(16, 'advanced-forms', '', '2015-05-13 17:12:54', '2015-05-13 17:12:54'),
(17, 'form-wizard', '', '2015-05-13 17:12:57', '2015-05-13 17:12:57'),
(18, 'form-validation', '', '2015-05-13 17:12:59', '2015-05-13 17:12:59'),
(19, 'form-uploads', '', '2015-05-13 17:13:02', '2015-05-13 17:13:02'),
(20, 'tables', '', '2015-05-13 17:13:05', '2015-05-13 17:13:05'),
(21, 'datatables', '', '2015-05-13 17:13:07', '2015-05-13 17:13:07'),
(22, 'google-maps', '', '2015-05-13 17:13:11', '2015-05-13 17:13:11'),
(23, 'vector-maps', '', '2015-05-13 17:13:15', '2015-05-13 17:13:15'),
(24, 'inbox', '', '2015-05-13 17:13:20', '2015-05-13 17:13:20'),
(25, 'read-message', '', '2015-05-13 17:13:24', '2015-05-13 17:13:24'),
(26, 'new-message', '', '2015-05-13 17:13:29', '2015-05-13 17:13:29'),
(27, 'sparkline-charts', '', '2015-05-13 17:13:32', '2015-05-13 17:13:32'),
(28, 'morris-charts', '', '2015-05-13 17:13:35', '2015-05-13 17:13:35'),
(29, 'rickshaw-charts', '', '2015-05-13 17:13:39', '2015-05-13 17:13:39'),
(30, 'other-charts', '', '2015-05-13 17:13:43', '2015-05-13 17:13:43'),
(31, 'blank', '', '2015-05-13 17:13:46', '2015-05-13 17:13:46'),
(32, 'lockscreen', '', '2015-05-13 17:14:18', '2015-05-13 17:14:18'),
(33, '404', '', '2015-05-13 17:14:23', '2015-05-13 17:14:23'),
(34, '500', '', '2015-05-13 17:14:29', '2015-05-13 17:14:29'),
(35, 'profile', '', '2015-05-13 17:14:43', '2015-05-13 17:14:43'),
(36, 'invoice', '', '2015-05-13 17:14:54', '2015-05-13 17:14:54'),
(37, 'gallery', '', '2015-05-13 17:15:00', '2015-05-13 17:15:00'),
(38, 'maintenance', '', '2015-05-13 17:15:03', '2015-05-13 17:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`RID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RID`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2015-01-31 20:56:34', '2015-01-31 20:56:34'),
(2, 'Sales User', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `RID` int(11) unsigned NOT NULL DEFAULT '0',
  `PID` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `RID` (`RID`,`PID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`RID`, `PID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `online` enum('0','1','2') NOT NULL DEFAULT '0',
  `last_action` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `username`, `first_name`, `last_name`, `avatar`, `email`, `password`, `online`, `last_action`, `created_at`, `updated_at`, `status`) VALUES
(1, 'hakan', 'demo', 'user', 'images/users/chat/1.jpg', 'contact@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '1', 1432577891, '2015-02-01 19:13:50', '2015-02-01 19:13:50', '1'),
(2, 'demo2', 'demo2', 'user', 'images/users/chat/2.jpg', 'contact2@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '0', 1432570993, '2015-05-13 17:40:07', '2015-05-13 17:40:07', '1'),
(3, 'demo3', 'demo3', 'user', 'images/users/chat/3.jpg', 'contact3@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '1', 1432576650, '2015-05-13 17:40:34', '2015-05-13 17:40:34', '1'),
(4, 'demo4', 'demo4', 'user', 'images/users/chat/4.jpg', 'contact4@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '0', 1432497558, '2015-05-13 17:40:45', '2015-05-13 17:40:45', '1'),
(5, 'demo5', 'demo5', 'user', 'images/users/chat/5.jpg', 'contact5@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '0', 0, '2015-05-13 18:12:12', '2015-05-13 18:12:12', '1'),
(6, 'demo6', 'demo6', 'user', 'images/users/chat/6.jpg', 'contact6@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '0', 0, '2015-05-13 18:15:20', '2015-05-13 18:15:20', '1'),
(7, 'demo7', 'demo7', 'user', 'images/users/chat/7.jpg', 'contact7@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '0', 0, '2015-05-13 18:15:46', '2015-05-13 18:15:46', '1'),
(8, 'demo8', 'demo8', 'user', 'images/users/chat/8.jpg', 'contact8@hubanmedia.com', '!00!:)fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3', '0', 0, '2015-05-13 18:16:02', '2015-05-13 18:16:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `UID` int(11) unsigned NOT NULL DEFAULT '0',
  `RID` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `UID` (`UID`,`RID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`UID`, `RID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(7, 2),
(8, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
