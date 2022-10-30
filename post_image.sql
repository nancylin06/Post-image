-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2022 at 03:25 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post_image`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `cont_id` int(11) NOT NULL AUTO_INCREMENT,
  `cont_head` char(50) NOT NULL,
  `cont_image` varchar(250) NOT NULL,
  `cont_disc` varchar(250) NOT NULL,
  `cont_date` varchar(50) NOT NULL,
  `cont_time` varchar(10) NOT NULL,
  PRIMARY KEY (`cont_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`cont_id`, `cont_head`, `cont_image`, `cont_disc`, `cont_date`, `cont_time`) VALUES
(20, 'Done is better than perfect', 'business-without-degree.jpg', 'Business opportunities are like buses, thereâ€™s always another one coming. Whenever you see a successful business, someone once made a courageous decision.', '28-10-22', '12:18 pm'),
(19, 'Focus on your audience', 'digital-marketing.png', 'Those who remain on face the heavy stream of ads, campaign and news that flood their social feeds each day and to say itâ€™s saturated would be an understatement.', '25th-10-22', '08:59 pm'),
(15, 'E-Business and Internet Technology', 'Modren-Tech.jpg', 'For the planning process to be effective, the firm is required to scan the business environment owing to a dynamic business environment.', '25th-10-22', '03:41 pm'),
(31, 'Central Bank Digital Currency', 'digital-rupee-1200.jpg', 'E-rupee or digital rupee is a digital version of the Indian rupee that the RBI is exploring.', '26-10-22', '07:55 am');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` char(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(20) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_gender` enum('M','F','null') NOT NULL,
  `user_code` int(6) NOT NULL,
  `current_date` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_profile`, `user_gender`, `user_code`, `current_date`) VALUES
(14, 'Nancylin x', 'nancylinxavier06@yahoo.com', 'Pa$$w0rd!', 'female.jpg', 'F', 257064, '2022-10-29'),
(11, 'Lillian Hayes', 'hunin@mailinator.com', 'Pa$$w0rd!', 'avatar.jpg', 'F', 372626, ''),
(15, 'Sade Wynn', 'lypojosi@mailinator.com', 'Pa$$w0rd!', 'images.jpg', 'M', 0, ''),
(17, 'Jessica Holmes', 'sehiv@mailinator.com', 'Pa$$w0rd!', '', 'null', 0, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
