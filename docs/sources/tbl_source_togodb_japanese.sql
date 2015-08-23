-- phpMyAdmin SQL Dump
-- version 4.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 20. Aug 2015 um 12:42
-- Server Version: 5.5.44-MariaDB
-- PHP-Version: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `openup`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_source_togodb_japanese`
--

CREATE TABLE IF NOT EXISTS `tbl_source_togodb_japanese` (
  `scientific_name` varchar(150) NOT NULL,
  `japanese_name` varchar(150) NOT NULL,
  `information_source_distributor` varchar(255) DEFAULT NULL,
  `information_source_name` varchar(255) DEFAULT NULL,
  `information_source_edition` varchar(255) DEFAULT NULL,
  `ID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
