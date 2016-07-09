-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2016 at 12:31 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_database_list`
--

INSERT INTO `client_database_list` (`client_db_id`, `client_db_server`, `client_db_username`, `client_db_password`, `client_db_name`) VALUES
(1, 'localhost', 'root', '', 'students');

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

--
-- Dumping data for table `menu_list`
--

INSERT INTO `menu_list` (`menu_id`, `menu_title`, `menu_link`) VALUES
(1, 'show_hello_world', 'hello_world.html'),
(1, 'show_youtube_video/show_html', 'show_html.html'),
(3, 'show_hello_world', 'hello_world.html'),
(4, 'about us', 'hello_world.html'),
(6, 'shakalaka', 'boomboom'),
(6, 'show_hello_world', 'hello_world.html'),
(7, 'search_students', 'search_students.html'),
(7, 'show_hello_world', 'hello_world.html'),
(7, 'show_youtube_video/show_html', 'show_html.html'),
(8, 'hello', 'goodbye.php');

-- --------------------------------------------------------

--
-- Table structure for table `page_list`
--

DROP TABLE IF EXISTS `page_list`;
CREATE TABLE IF NOT EXISTS `page_list` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_name` (`page_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`page_id`, `page_name`) VALUES
(1, 'page_1'),
(2, 'page_2');

-- --------------------------------------------------------

--
-- Table structure for table `panel_component_list`
--

DROP TABLE IF EXISTS `panel_component_list`;
CREATE TABLE IF NOT EXISTS `panel_component_list` (
  `page_id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL,
  `panel_component` varchar(255) NOT NULL,
  `panel_component_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panel_data_list`
--

DROP TABLE IF EXISTS `panel_data_list`;
CREATE TABLE IF NOT EXISTS `panel_data_list` (
  `page_id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL,
  `panel_data` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panel_list`
--

DROP TABLE IF EXISTS `panel_list`;
CREATE TABLE IF NOT EXISTS `panel_list` (
  `page_id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_child_id` int(11) NOT NULL,
  `panel_height` int(11) NOT NULL DEFAULT '100',
  `panel_width` int(11) NOT NULL DEFAULT '100',
  `panel_class` enum('top','bottom','left','right') NOT NULL DEFAULT 'top',
  PRIMARY KEY (`page_id`,`panel_id`,`panel_child_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panel_list`
--

INSERT INTO `panel_list` (`page_id`, `panel_id`, `panel_child_id`, `panel_height`, `panel_width`, `panel_class`) VALUES
(1, 1, 2, 100, 40, 'left'),
(1, 1, 3, 100, 60, 'right'),
(1, 0, 1, 100, 100, 'top');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
