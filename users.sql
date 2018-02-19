-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2017 at 10:13 AM
-- Server version: 5.5.54-38.7-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marieade_adelaide`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8 NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `social_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `welcome_passed` int(11) NOT NULL DEFAULT '0',
  `completion` int(11) NOT NULL DEFAULT '50',
  `ip_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resized_cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `bannned` int(11) NOT NULL DEFAULT '0',
  `privacy_info` text COLLATE utf8_unicode_ci NOT NULL,
  `design_details` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `online_status` int(11) NOT NULL DEFAULT '0',
  `online_time` int(11) NOT NULL DEFAULT '0',
  `hash` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `activated` int(11) NOT NULL DEFAULT '0',
  `birth_day` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birth_month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_active_time` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email_address`, `social_email`, `first_name`, `last_name`, `gender`, `country`, `state`, `city`, `role`, `welcome_passed`, `completion`, `ip_address`, `timezone`, `verified`, `avatar`, `cover`, `resized_cover`, `bio`, `bannned`, `privacy_info`, `design_details`, `lang`, `online_status`, `online_time`, `hash`, `active`, `activated`, `birth_day`, `birth_month`, `birth_year`, `join_date`, `last_active_time`, `featured`) VALUES
(1, 'stuxnetcode1', '5c4ac697a0bfa0d6f157102fc901855f', 'samuelmanikiza@gmail.com', '', 'stuxnetcode1', '', 'male', '', '', '', 2, 1, 50, '41.74.174.251', 'utc', 0, 'storage/uploads/1/2017/photos/profile/_%w_6376c5a7ba73844086b989b8078608c8.jpg', 'storage/uploads/1/2017/photos/profile/cover/_800_b5c77d40b3470bef0b44536aac474f6f.png', 'storage/uploads/1/2017/photos/profile/cover/resized/_800_15e2f079a281633d11b37383491462f9.png', 'welcome to my homeland of technology', 0, '', '', '', 0, 1512843080, '', 1, 1, '', '', '', '2017-12-07 13:26:45', '', 0),
(2, 'sammy', 'c7daf2bb9136d439d5a1fa1e8a9befca', 'realfair95@gmail.com', '', 'manikiza', 'sugira', 'male', 'rwanda', '', '', 2, 1, 50, '197.243.118.78', 'utc', 0, 'storage/avatar/2_avatar1512653576.png', '', '', '', 0, '', '', '', 0, 1512654084, '', 1, 1, '18', 'november', '1990', '2017-12-07 13:32:56', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
