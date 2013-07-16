-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2013 at 11:21 AM
-- Server version: 5.5.30-log
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
-- Table structure for table `tbl_source_azerbaijan`
--

CREATE TABLE IF NOT EXISTS `tbl_source_azerbaijan` (
  `FAMİLY` varchar(50) DEFAULT NULL,
  `FAMAUTHOR` varchar(50) DEFAULT NULL,
  `GENUS` varchar(50) DEFAULT NULL,
  `GENAUTHOR` varchar(50) DEFAULT NULL,
  `SPECIES` varchar(100) DEFAULT NULL,
  `SPAUTHOR` varchar(100) DEFAULT NULL,
  `infrarank` varchar(50) DEFAULT NULL,
  `SUBTAXA` varchar(50) DEFAULT NULL,
  `SUBTAUTHOR` varchar(50) DEFAULT NULL,
  `AZERİNAME` varchar(150) DEFAULT NULL,
  `RUSNAME` varchar(150) DEFAULT NULL,
  `ENGNAME` varchar(150) DEFAULT NULL,
  `ACCENAME` varchar(150) DEFAULT NULL,
  `OTHERNAME` varchar(150) DEFAULT NULL,
  KEY `SPECIES` (`SPECIES`,`AZERİNAME`),
  KEY `SPECIES_2` (`SPECIES`,`SUBTAXA`,`AZERİNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
