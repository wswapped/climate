-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 10:58 AM
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
-- Database: `aquavert`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `DeviceID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='stores data from sensord';

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `type`, `value`, `DeviceID`, `time`, `entry_id`) VALUES
(58, 'Temperature', '330.32', 1032, '2017-12-16 15:17:08', 0),
(59, 'pH_sensor', '1024.00', 1032, '2017-12-16 15:17:08', 0),
(60, 'Temperature', '330.32', 1032, '2017-12-16 15:17:35', 0),
(61, 'pH_sensor', '1024.00', 1032, '2017-12-16 15:17:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pipedata`
--

CREATE TABLE `pipedata` (
  `id` int(11) NOT NULL,
  `mode` varchar(256) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pipedata`
--

INSERT INTO `pipedata` (`id`, `mode`, `time`) VALUES
(1, 'open', '2017-12-17 06:14:32'),
(2, 'open', '2017-12-17 06:38:34'),
(3, 'close', '2017-12-17 06:39:56'),
(4, 'close', '2017-12-17 07:02:59'),
(5, 'open', '2017-12-17 07:04:57'),
(6, 'close', '2017-12-17 07:11:02'),
(7, 'open', '2017-12-17 08:38:03'),
(8, 'close', '2017-12-17 08:38:13'),
(9, 'open', '2017-12-17 08:38:27'),
(10, 'close', '2017-12-17 08:44:54'),
(11, 'open', '2017-12-17 08:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` int(11) NOT NULL,
  `location` varchar(256) NOT NULL,
  `locationName` varchar(256) NOT NULL,
  `ownerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `location`, `locationName`, `ownerId`) VALUES
(1, 'lat: -1.9563910, lng: 30.0919184', 'Rugando, Kigali, Rwanda', 1),
(3, 'lat: -1.961256, lng: 30.069435', 'Kiyovu, Kigali, Rwanda', 1),
(1032, 'lat: -1.945821, lng: 30.078459', 'Kimihurura, Kigali, Rwanda', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `username` varchar(26) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `location` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone`, `location`, `password`) VALUES
(1, 'Samuel MANIKIZA', 'sam', '072298525', 'Remera, Rukili', 'okayokay'),
(2, 'Hak Placide', 'plac', '0722546565', 'Kimironko, nahandi', 'admin'),
(3, 'clement', 'cle', '', 'kigali', 'cle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pipedata`
--
ALTER TABLE `pipedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `pipedata`
--
ALTER TABLE `pipedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
