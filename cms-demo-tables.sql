-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2016 at 07:04 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms-demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `block_list`
--

DROP TABLE IF EXISTS `block_list`;
CREATE TABLE IF NOT EXISTS `block_list` (
  `block_id` int(11) NOT NULL AUTO_INCREMENT,
  `block_name` varchar(255) NOT NULL,
  `block_data` longtext NOT NULL,
  PRIMARY KEY (`block_id`),
  UNIQUE KEY `block_name` (`block_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_database_list`
--

DROP TABLE IF EXISTS `client_database_list`;
CREATE TABLE IF NOT EXISTS `client_database_list` (
  `client_db_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_db_server` varchar(255) NOT NULL,
  `client_db_username` varchar(255) NOT NULL,
  `client_db_password` varchar(255) NOT NULL,
  `client_db_name` varchar(255) NOT NULL,
  PRIMARY KEY (`client_db_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `layout_list`
--

DROP TABLE IF EXISTS `layout_list`;
CREATE TABLE IF NOT EXISTS `layout_list` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_name` varchar(255) NOT NULL,
  PRIMARY KEY (`layout_id`),
  UNIQUE KEY `page_name` (`layout_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_list`
--

DROP TABLE IF EXISTS `menu_list`;
CREATE TABLE IF NOT EXISTS `menu_list` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`,`menu_title`,`menu_link`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_list`
--

DROP TABLE IF EXISTS `page_list`;
CREATE TABLE IF NOT EXISTS `page_list` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_panel_list`
--

DROP TABLE IF EXISTS `page_panel_list`;
CREATE TABLE IF NOT EXISTS `page_panel_list` (
  `page_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `panel_child_id` int(11) NOT NULL,
  `panel_data` longtext,
  PRIMARY KEY (`page_id`,`layout_id`,`panel_child_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panel_list`
--

DROP TABLE IF EXISTS `panel_list`;
CREATE TABLE IF NOT EXISTS `panel_list` (
  `layout_id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL,
  `panel_child_id` int(11) NOT NULL,
  `panel_height` int(11) NOT NULL DEFAULT '100',
  `panel_width` int(11) NOT NULL DEFAULT '100',
  `panel_class` enum('top','bottom','left','right') DEFAULT NULL,
  PRIMARY KEY (`layout_id`,`panel_id`,`panel_child_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
