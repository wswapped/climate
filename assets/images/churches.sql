-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 10:35 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `churches`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_crops`
--

CREATE TABLE `system_crops` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `system` int(11) NOT NULL,
  `plant_date` datetime DEFAULT NULL,
  `sow_date` datetime DEFAULT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_crops`
--

INSERT INTO `system_crops` (`id`, `name`, `system`, `plant_date`, `sow_date`, `price`) VALUES
(1, 'Dodo', 1032, '2018-02-02 00:00:00', NULL, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_crops`
--
ALTER TABLE `system_crops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop-system` (`system`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_crops`
--
ALTER TABLE `system_crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_crops`
--
ALTER TABLE `system_crops`
  ADD CONSTRAINT `crop-system` FOREIGN KEY (`system`) REFERENCES `edoricac_aqvert`.`systems` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
