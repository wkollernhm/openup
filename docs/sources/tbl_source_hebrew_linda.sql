-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2013 at 08:23 AM
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
-- Table structure for table `tbl_source_hebrew_linda`
--

CREATE TABLE IF NOT EXISTS `tbl_source_hebrew_linda` (
  `ID1` int(1) DEFAULT NULL,
  `alien` varchar(50) DEFAULT NULL,
  `delete` varchar(10) DEFAULT NULL,
  `ID` varchar(10) DEFAULT NULL,
  `ID_concord` varchar(10) DEFAULT NULL,
  `NPA Species Code` varchar(10) DEFAULT NULL,
  `LatinName` varchar(100) DEFAULT NULL,
  `NPA_Hebrew` varchar(43) DEFAULT NULL,
  `Frag Latin No` varchar(10) DEFAULT NULL,
  `CleanScientific Name` varchar(150) DEFAULT NULL,
  `CleanScientific` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `empty` varchar(10) DEFAULT NULL,
  `Frag_Hebrew` varchar(39) DEFAULT NULL,
  `HebrewGenus` varchar(20) DEFAULT NULL,
  `HebrewSpecies` varchar(18) DEFAULT NULL,
  `Frag Family Code` varchar(10) DEFAULT NULL,
  `Frag Family Name` varchar(10) DEFAULT NULL,
  `matched by hand` varchar(50) DEFAULT NULL,
  `new` varchar(50) DEFAULT NULL,
  `merged` varchar(50) DEFAULT NULL,
  `problematic` varchar(100) DEFAULT NULL,
  `Field17` varchar(10) DEFAULT NULL,
  `Field18` varchar(10) DEFAULT NULL,
  `Field19` varchar(10) DEFAULT NULL,
  `Field20` varchar(10) DEFAULT NULL,
  `Field21` varchar(10) DEFAULT NULL,
  `Field22` varchar(10) DEFAULT NULL,
  `Field23` varchar(10) DEFAULT NULL,
  `Field24` varchar(10) DEFAULT NULL,
  `Field25` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
