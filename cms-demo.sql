-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2016 at 05:27 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `block_list`
--

INSERT INTO `block_list` (`block_id`, `block_name`, `block_data`) VALUES
(1, 'left', 'bkjbkjbo'),
(2, 'hello', 'hello');

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

--
-- Dumping data for table `client_database_list`
--

INSERT INTO `client_database_list` (`client_db_id`, `client_db_server`, `client_db_username`, `client_db_password`, `client_db_name`) VALUES
(4, 'localhost', 'root', '', 'wp-sample'),
(3, 'localhost', 'root', '', 'students');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layout_list`
--

INSERT INTO `layout_list` (`layout_id`, `layout_name`) VALUES
(1, 'page_1'),
(2, 'jnvkrlenl'),
(3, 'diwe'),
(4, 'layout_4'),
(5, 'home'),
(6, 'home_panel'),
(7, 'other_panel'),
(8, 'other_panel_2'),
(9, 'test_layout');

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
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`page_id`, `page_name`, `layout_id`) VALUES
(1, 'cnsejggnsl', 4),
(2, 'adv', 4),
(3, '', 1),
(4, 'ncke', 1),
(5, 'cnejk', 4),
(6, 'cjdlnvlsnl', 4),
(7, 'home1', 4),
(8, 'cab', 3),
(9, 'contact_us', 7),
(10, 'about_us', 7),
(11, 'about_us', 7),
(12, 'home', 6),
(13, 'xyz', 7),
(14, 'djbak', 4),
(15, 'djbakcwkal', 4),
(16, 'djbakcwkaljw', 4),
(17, 'cjwek', 1),
(18, 'cjkew', 4),
(19, 'test_page_1', 9),
(20, 'test_page_2', 9),
(21, 'hello', 9),
(22, 'hello1', 9),
(23, 'hello2', 9),
(24, 'hello3', 9),
(25, 'hello4', 9),
(26, 'hello5', 9),
(27, 'hello6', 9);

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

--
-- Dumping data for table `page_panel_list`
--

INSERT INTO `page_panel_list` (`page_id`, `layout_id`, `panel_child_id`, `panel_data`) VALUES
(2, 4, 14, ''),
(2, 4, 2, '<img src=''images/elitecore.jpg'' style=''height: 100%; width: auto; max-height: 100%; max-width: 100%;'' />'),
(2, 4, 24, ''),
(2, 4, 25, ''),
(2, 4, 13, 'aloha'),
(2, 4, 15, 'cinco de mayo'),
(5, 4, 2, ''),
(5, 4, 24, ''),
(5, 4, 25, ''),
(5, 4, 13, ''),
(5, 4, 14, ''),
(5, 4, 15, ''),
(8, 3, 4, '<a href=''http://facebook.com''>Link to FB</a>'),
(8, 3, 5, '<img src=''images/elitecore.jpg'' />'),
(8, 3, 6, ''),
(8, 3, 14, ''),
(8, 3, 30, ''),
(8, 3, 31, ''),
(9, 7, 4, '<img src=''http://www.elitecore.com/images/elitecore.jpg'' style=''height: 100%; width: 100%;'' />'),
(9, 7, 5, ''),
(9, 7, 6, '<ul>\r\n  <a href=''view_page.php?page_id=12''><li>home</li></a>\r\n<a href=''view_page.php?page_id=9''><li>contact us</li></a>\r\n</ul>'),
(9, 7, 7, 'This is contact us page'),
(12, 6, 4, '<img src=''http://www.elitecore.com/images/elitecore.jpg'' style=''height: 100%; width: 100%;'' />'),
(12, 6, 5, ''),
(12, 6, 6, '<ul>\r\n  <a href=''view_page.php?page_id=12''><li>home</li></a>\r\n<a href=''view_page.php?page_id=9''><li>contact us</li></a>\r\n</ul>'),
(12, 6, 14, 'This is home page'),
(12, 6, 15, ''),
(10, 7, 4, '<img>'),
(10, 7, 5, 'nejsk'),
(10, 7, 6, 'vbsov'),
(10, 7, 7, 'cenjw'),
(17, 1, 1, NULL),
(17, 1, 2, NULL),
(17, 1, 3, NULL),
(17, 1, 4, NULL),
(17, 1, 5, NULL),
(17, 1, 6, NULL),
(17, 1, 7, NULL),
(17, 1, 8, NULL),
(17, 1, 9, NULL),
(17, 1, 10, NULL),
(17, 1, 11, NULL),
(17, 1, 12, NULL),
(17, 1, 13, NULL),
(17, 1, 14, NULL),
(17, 1, 15, NULL),
(17, 1, 16, NULL),
(17, 1, 17, NULL),
(17, 1, 24, NULL),
(17, 1, 25, NULL),
(17, 1, 26, NULL),
(17, 1, 27, NULL),
(17, 1, 28, NULL),
(17, 1, 29, NULL),
(17, 1, 30, NULL),
(17, 1, 31, NULL),
(17, 1, 54, NULL),
(17, 1, 55, NULL),
(18, 4, 1, NULL),
(18, 4, 2, NULL),
(18, 4, 3, NULL),
(18, 4, 6, NULL),
(18, 4, 7, NULL),
(18, 4, 12, NULL),
(18, 4, 13, NULL),
(18, 4, 14, NULL),
(18, 4, 15, NULL),
(18, 4, 24, NULL),
(18, 4, 25, NULL),
(18, 4, 48, NULL),
(18, 4, 49, NULL),
(19, 9, 1, NULL),
(19, 9, 2, NULL),
(19, 9, 3, NULL),
(19, 9, 4, 'hello'),
(19, 9, 5, 'cwueiwke'),
(19, 9, 6, 'wejke'),
(19, 9, 7, 'new'),
(20, 9, 1, NULL),
(20, 9, 2, NULL),
(20, 9, 3, NULL),
(20, 9, 4, 'cbweu'),
(20, 9, 5, 'cjdw'),
(20, 9, 6, 'cnewjrwk'),
(20, 9, 7, 'cwnejvbwkbjdvdbvwjvl'),
(26, 9, 1, NULL),
(26, 9, 2, NULL),
(26, 9, 3, NULL),
(26, 9, 4, 'hello'),
(26, 9, 5, 'cwueiwke'),
(26, 9, 6, 'wejke'),
(26, 9, 7, 'new'),
(27, 9, 1, NULL),
(27, 9, 2, NULL),
(27, 9, 3, NULL),
(27, 9, 4, 'hello'),
(27, 9, 5, 'cwueiwke'),
(27, 9, 6, 'wejke'),
(27, 9, 7, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `panel_list`
--

DROP TABLE IF EXISTS `panel_list`;
CREATE TABLE IF NOT EXISTS `panel_list` (
  `layout_id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL,
  `panel_child_id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_height` int(11) NOT NULL DEFAULT '100',
  `panel_width` int(11) NOT NULL DEFAULT '100',
  `panel_class` enum('top','bottom','left','right') DEFAULT NULL,
  PRIMARY KEY (`layout_id`,`panel_id`,`panel_child_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panel_list`
--

INSERT INTO `panel_list` (`layout_id`, `panel_id`, `panel_child_id`, `panel_height`, `panel_width`, `panel_class`) VALUES
(1, 1, 2, 100, 40, 'left'),
(1, 1, 3, 100, 60, 'right'),
(1, 0, 1, 100, 100, 'top'),
(1, 2, 4, 20, 100, 'top'),
(1, 3, 6, 60, 100, 'top'),
(1, 2, 5, 80, 100, 'bottom'),
(1, 3, 7, 40, 100, 'bottom'),
(1, 4, 8, 100, 30, 'left'),
(1, 4, 9, 100, 70, 'right'),
(1, 5, 11, 80, 100, 'bottom'),
(1, 5, 10, 20, 100, 'top'),
(1, 8, 16, 0, 100, 'top'),
(1, 8, 17, 100, 100, 'bottom'),
(1, 6, 12, 100, 20, 'left'),
(1, 6, 13, 100, 80, 'right'),
(1, 12, 24, 10, 100, 'top'),
(1, 12, 25, 90, 100, 'bottom'),
(4, 6, 13, 70, 100, 'bottom'),
(4, 6, 12, 30, 100, 'top'),
(1, 7, 14, 100, 45, 'left'),
(1, 7, 15, 100, 55, 'right'),
(1, 14, 28, 100, 20, 'left'),
(1, 14, 29, 100, 80, 'right'),
(1, 13, 26, 30, 100, 'top'),
(1, 13, 27, 70, 100, 'bottom'),
(1, 27, 54, 30, 100, 'top'),
(1, 27, 55, 70, 100, 'bottom'),
(1, 15, 30, 100, 20, 'left'),
(1, 15, 31, 100, 80, 'right'),
(2, 0, 1, 100, 100, 'top'),
(2, 1, 2, 100, 70, 'left'),
(2, 1, 3, 100, 30, 'right'),
(2, 2, 4, 100, 40, 'left'),
(2, 2, 5, 100, 60, 'right'),
(3, 0, 1, 100, 100, 'top'),
(3, 1, 2, 100, 40, 'left'),
(3, 1, 3, 100, 60, 'right'),
(3, 3, 6, 100, 20, 'left'),
(3, 3, 7, 100, 80, 'right'),
(3, 7, 14, 100, 40, 'left'),
(3, 7, 15, 100, 60, 'right'),
(3, 2, 4, 20, 100, 'top'),
(3, 2, 5, 80, 100, 'bottom'),
(2, 5, 10, 40, 100, 'top'),
(2, 5, 11, 60, 100, 'bottom'),
(3, 15, 30, 60, 100, 'top'),
(3, 15, 31, 40, 100, 'bottom'),
(4, 0, 1, 100, 100, 'top'),
(4, 1, 2, 20, 100, 'top'),
(4, 1, 3, 80, 100, 'bottom'),
(4, 3, 6, 100, 40, 'left'),
(4, 3, 7, 100, 60, 'right'),
(5, 0, 1, 100, 100, 'top'),
(5, 1, 2, 20, 100, 'top'),
(5, 1, 3, 80, 100, 'bottom'),
(4, 7, 14, 100, 20, 'left'),
(4, 7, 15, 100, 80, 'right'),
(4, 12, 24, 100, 40, 'left'),
(4, 12, 25, 100, 60, 'right'),
(4, 24, 48, 20, 100, 'top'),
(4, 24, 49, 80, 100, 'bottom'),
(6, 0, 1, 100, 100, 'top'),
(6, 1, 2, 20, 100, 'top'),
(6, 1, 3, 80, 100, 'bottom'),
(6, 3, 6, 100, 15, 'left'),
(6, 3, 7, 100, 85, 'right'),
(6, 7, 14, 100, 80, 'left'),
(6, 7, 15, 100, 20, 'right'),
(7, 0, 1, 100, 100, 'top'),
(6, 2, 4, 100, 15, 'left'),
(6, 2, 5, 100, 85, 'right'),
(7, 1, 2, 20, 100, 'top'),
(7, 1, 3, 80, 100, 'bottom'),
(7, 2, 4, 100, 15, 'left'),
(7, 2, 5, 100, 85, 'right'),
(7, 3, 6, 100, 15, 'left'),
(7, 3, 7, 100, 85, 'right'),
(8, 0, 1, 100, 100, 'top'),
(8, 1, 2, 20, 100, 'top'),
(8, 1, 3, 80, 100, 'bottom'),
(8, 2, 4, 100, 15, 'left'),
(8, 2, 5, 100, 85, 'right'),
(8, 3, 6, 100, 15, 'left'),
(8, 3, 7, 100, 85, 'right'),
(8, 7, 14, 100, 80, 'left'),
(8, 7, 15, 100, 20, 'right'),
(9, 0, 1, 100, 100, 'top'),
(9, 1, 2, 100, 50, 'left'),
(9, 1, 3, 100, 50, 'right'),
(9, 2, 4, 50, 100, 'top'),
(9, 2, 5, 50, 100, 'bottom'),
(9, 3, 6, 50, 100, 'top'),
(9, 3, 7, 50, 100, 'bottom');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
