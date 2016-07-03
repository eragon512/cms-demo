-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2016 at 07:50 PM
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
(7, 'show_youtube_video/show_html', 'show_html.html');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_rollno` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_branch` varchar(255) NOT NULL,
  `student_college` varchar(255) NOT NULL,
  PRIMARY KEY (`student_rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_rollno`, `student_name`, `student_branch`, `student_college`) VALUES
(1, 'Anirud', 'CS', 'BPHC'),
(2, 'Aman', 'CS', 'BPHC'),
(3, 'Ajinkya', 'Bio', 'BPGC'),
(4, 'Sanyam', 'Math', 'BPGC');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
