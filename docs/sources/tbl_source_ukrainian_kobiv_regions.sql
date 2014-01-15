-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2014 at 09:31 AM
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
-- Table structure for table `tbl_source_ukrainian_kobiv_regions`
--

CREATE TABLE IF NOT EXISTS `tbl_source_ukrainian_kobiv_regions` (
  `short` varchar(6) DEFAULT NULL,
  `region` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_source_ukrainian_kobiv_regions`
--

INSERT INTO `tbl_source_ukrainian_kobiv_regions` (`short`, `region`) VALUES
('БО', 'Boykivshchyna'),
('БУ', 'Bukovyna'),
('ВЛ', 'Volyn’'),
('ГЦ', 'Hutsulshchyna'),
('ДС', 'Naddnistryanshchyna'),
('ЗК', 'Transcarpathia'),
('ЗП', 'Western Polissya'),
('ЛМ', 'Lemkivshchyna'),
('ПД', 'Podolia'),
('СД', 'Central Naddnipryanshchyna'),
('СЛ', 'Slobozhanshchyna'),
('СП', 'Eastern Polissya'),
('СТ', 'Step'),
('СЯ', 'Nadsiannya'),
('ЦП', 'Central Polissya'),
('ГЛ', 'Galicia'),
('ПЛ', 'Polissya'),
('ЗАГ', 'common         (for most of Ukraine)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
