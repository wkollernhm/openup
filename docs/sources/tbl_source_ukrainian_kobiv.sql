-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2014 at 08:57 AM
-- Server version: 5.5.33
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openup`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source_ukrainian_kobiv`
--

CREATE TABLE IF NOT EXISTS `tbl_source_ukrainian_kobiv` (
  `IND` varchar(10) DEFAULT NULL,
  `UNAR` varchar(60) DEFAULT NULL,
  `UTYPESET` varchar(60) DEFAULT NULL,
  `LNOM` varchar(100) DEFAULT NULL,
  `LCIT` varchar(70) DEFAULT NULL,
  `LIT` varchar(140) DEFAULT NULL,
  `GEOSK` varchar(40) DEFAULT NULL,
  `LSECOND` varchar(100) DEFAULT NULL,
  `LSYNON` varchar(50) DEFAULT NULL,
  `PRIOR` varchar(10) DEFAULT NULL,
  KEY `LNOM` (`LNOM`),
  KEY `LSECOND` (`LSECOND`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
