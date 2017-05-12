-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 09:31 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stoplight`
--

-- --------------------------------------------------------

--
-- Table structure for table `readings`
--

CREATE TABLE `readings` (
  `reading_id` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stoplight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `readings`
--

INSERT INTO `readings` (`reading_id`, `r`, `y`, `g`, `time`, `stoplight_id`) VALUES
(1, 255, 0, 0, '2017-05-06 11:25:08', 0),
(2, 255, 0, 0, '2017-05-06 11:28:12', 12);

-- --------------------------------------------------------

--
-- Table structure for table `stoplight`
--

CREATE TABLE `stoplights` (
  `stoplight_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `status` bool NOT NULL,
  `error` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

INSERT INTO `stoplights` (`stoplight_id`, `name`, `longitude`, `latitude`, `status`, `error`) VALUES
(1, 'manila', 120.984, 14.5995, 0, "Not Working"),
(2, 'cebu', 123.885, 10.8157, 1, "Pattern error");
--
-- Indexes for table `readings`
--
ALTER TABLE `readings`
  ADD PRIMARY KEY (`reading_id`);

--
-- Indexes for table `stoplight`
--
ALTER TABLE `stoplights`
  ADD PRIMARY KEY (`stoplight_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `readings`
--
ALTER TABLE `readings`
  MODIFY `reading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stoplight`
--
ALTER TABLE `stoplights`
  MODIFY `stoplight_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
