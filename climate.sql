-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2018 at 05:59 AM
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
-- Database: `climate`
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
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` varchar(4) NOT NULL,
  `birth_year` varchar(4) NOT NULL,
  `system` int(11) NOT NULL COMMENT 'associate system with family member it''ll feed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `name`, `gender`, `birth_year`, `system`) VALUES
(1, 'BAZIMYA Saphani', 'Gabo', '1992', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fertilizer`
--

CREATE TABLE `fertilizer` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `quality` varchar(32) DEFAULT NULL COMMENT 'like 17-17-12'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fertilizer`
--

INSERT INTO `fertilizer` (`id`, `name`, `quality`) VALUES
(1, 'NPK', '17-17-17'),
(2, 'Ammonia Nitrate', '12');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `ownerName` varchar(128) NOT NULL,
  `location` varchar(256) NOT NULL,
  `purpose` varchar(1024) NOT NULL,
  `phone` varchar(1024) DEFAULT NULL,
  `locationName` varchar(256) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `width` float NOT NULL,
  `stages` int(11) NOT NULL,
  `total_produce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `ownerName`, `location`, `purpose`, `phone`, `locationName`, `ownerId`, `type`, `width`, `stages`, `total_produce`) VALUES
(1, 'MUHIRWA Clement', 'lat: -1.9563910, lng: 30.0919184', 'umuryango', '0781673265', 'Rugando, Kigali, Rwanda', 1, 'uhendutse', 10, 3, 1),
(3, 'Isaac', 'lat: -1.961256, lng: 30.069435', 'umuryango no gucuruza', '0784589841', 'Kiyovu, Kigali, Rwanda', 1, 'akandare', 1000, 6, 20),
(1032, 'Placide', 'lat: -1.945821, lng: 30.078459', 'gucuruza', '0781673265', 'Kimihurura, Kigali, Rwanda', 1, 'ugezweho', 1500, 6, 27);

-- --------------------------------------------------------

--
-- Table structure for table `field_fertilizer`
--

CREATE TABLE `field_fertilizer` (
  `id` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `fertilizer` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_needed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_fertilizer`
--

INSERT INTO `field_fertilizer` (`id`, `field`, `fertilizer`, `quantity`, `date_needed`) VALUES
(1, 3, 2, 1, '2018-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `field_messages`
--

CREATE TABLE `field_messages` (
  `id` int(11) NOT NULL,
  `field` int(11) NOT NULL COMMENT 'where message should be sent',
  `message` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_messages`
--

INSERT INTO `field_messages` (`id`, `field`, `message`, `time`) VALUES
(1, 3, 1, '2018-02-19 18:01:14'),
(2, 1032, 1, '2018-02-19 18:01:14'),
(3, 1, 1, '2018-02-19 18:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `irrigation`
--

CREATE TABLE `irrigation` (
  `id` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `litters` int(11) NOT NULL,
  `date` date NOT NULL,
  `done_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `text`) VALUES
(1, 'now', 'Mwiriwe $name,\r\nUyu munsi hakenewe litiro $litters\r\nndetse n\'ifumbire ibiro $fert_kg bya NPK 17-17-17\r\n\r\n$date_today'),
(2, 'predict', 'Mwiriwe $name,\r\nKu itariki ya $date_predict hakenewe litiro $litters\r\nndetse n\'ifumbire ibiro $fert_kg bya NPK 17-17-17\r\n\r\n$date_today');

-- --------------------------------------------------------

--
-- Table structure for table `message_send_logs`
--

CREATE TABLE `message_send_logs` (
  `id` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `time_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 'open', '2017-12-17 08:49:15'),
(12, 'open', '2017-12-17 11:29:41'),
(13, 'open', '2017-12-17 11:55:40'),
(14, 'close', '2017-12-17 11:55:43'),
(15, 'open', '2017-12-17 11:56:01'),
(16, 'open', '2017-12-17 12:04:26'),
(17, 'close', '2017-12-17 12:04:29'),
(18, 'close', '2017-12-17 12:04:36'),
(19, 'open', '2017-12-17 12:04:39'),
(20, 'close', '2017-12-17 12:05:01'),
(21, 'open', '2017-12-17 12:06:12'),
(22, 'close', '2017-12-17 12:07:21'),
(23, 'clod', '2017-12-17 12:07:21'),
(24, 'open', '2017-12-17 13:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `crop` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `target` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `crop`, `quantity`, `target`) VALUES
(1, 0, 0, 'hitamo ..'),
(2, 0, 12, 'abaturanyi');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` int(11) NOT NULL,
  `location` varchar(256) NOT NULL,
  `purpose` varchar(1024) NOT NULL,
  `name` varchar(128) NOT NULL,
  `locationName` varchar(256) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `width` float NOT NULL,
  `stages` int(11) NOT NULL,
  `total_produce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `location`, `purpose`, `name`, `locationName`, `ownerId`, `type`, `width`, `stages`, `total_produce`) VALUES
(1, 'lat: -1.9563910, lng: 30.0919184', 'umuryango', 'Ku gikoni', 'Rugando, Kigali, Rwanda', 1, 'uhendutse', 10, 3, 1),
(3, 'lat: -1.961256, lng: 30.069435', 'umuryango no gucuruza', 'Ku irembo', 'Kiyovu, Kigali, Rwanda', 1, 'akandare', 1000, 6, 20),
(1032, 'lat: -1.945821, lng: 30.078459', 'gucuruza', 'Munsi y\'urugo', 'Kimihurura, Kigali, Rwanda', 2, 'ugezweho', 1500, 6, 27);

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
(1, 'Dodo', 1, '2018-02-02 00:00:00', NULL, 12);

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
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family-system` (`system`);

--
-- Indexes for table `fertilizer`
--
ALTER TABLE `fertilizer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_fertilizer`
--
ALTER TABLE `field_fertilizer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fert-field` (`field`),
  ADD KEY `fertilizer` (`fertilizer`);

--
-- Indexes for table `field_messages`
--
ALTER TABLE `field_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_field` (`message`),
  ADD KEY `que_field` (`field`);

--
-- Indexes for table `irrigation`
--
ALTER TABLE `irrigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_send_logs`
--
ALTER TABLE `message_send_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pipedata`
--
ALTER TABLE `pipedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_crops`
--
ALTER TABLE `system_crops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop-system` (`system`);

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
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fertilizer`
--
ALTER TABLE `fertilizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1033;

--
-- AUTO_INCREMENT for table `field_fertilizer`
--
ALTER TABLE `field_fertilizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `field_messages`
--
ALTER TABLE `field_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `irrigation`
--
ALTER TABLE `irrigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message_send_logs`
--
ALTER TABLE `message_send_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pipedata`
--
ALTER TABLE `pipedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1033;

--
-- AUTO_INCREMENT for table `system_crops`
--
ALTER TABLE `system_crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family-system` FOREIGN KEY (`system`) REFERENCES `systems` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `field_fertilizer`
--
ALTER TABLE `field_fertilizer`
  ADD CONSTRAINT `fert-field` FOREIGN KEY (`field`) REFERENCES `fields` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fertilizer` FOREIGN KEY (`fertilizer`) REFERENCES `fertilizer` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `field_messages`
--
ALTER TABLE `field_messages`
  ADD CONSTRAINT `message_field` FOREIGN KEY (`message`) REFERENCES `messages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `que_field` FOREIGN KEY (`field`) REFERENCES `fields` (`id`);

--
-- Constraints for table `system_crops`
--
ALTER TABLE `system_crops`
  ADD CONSTRAINT `crop-system` FOREIGN KEY (`system`) REFERENCES `systems` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
