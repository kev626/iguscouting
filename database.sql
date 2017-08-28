-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 28, 2017 at 05:40 PM
-- Server version: 5.5.54-0+deb8u1
-- PHP Version: 5.6.29-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `igutech`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match` int(5) NOT NULL,
  `red1` int(6) NOT NULL,
  `red2` int(6) NOT NULL,
  `blue1` int(6) NOT NULL,
  `blue2` int(6) NOT NULL,
  `redscore` int(5) NOT NULL,
  `bluescore` int(5) NOT NULL,
  `winner` varchar(5) NOT NULL,
  `comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `number` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `score` int(5) NOT NULL,
  `historical` int(5) NOT NULL DEFAULT '0',
  `elo` int(5) NOT NULL DEFAULT '1000',
  `abilities` varchar(1000) NOT NULL,
  `starred` int(2) NOT NULL DEFAULT '0',
  `comments` varchar(1000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD UNIQUE KEY `number` (`number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
