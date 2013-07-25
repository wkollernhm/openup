-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. Jul 2013 um 08:59
-- Server Version: 5.0.96
-- PHP-Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Tabellenstruktur für Tabelle `tbl_source_slovak_bratislava`
--

CREATE TABLE IF NOT EXISTS `tbl_source_slovak_bratislava` (
  `fldName` varchar(150) NOT NULL,
  `fldNameSK_prefix` varchar(255) NOT NULL,
  `fldNameSK` varchar(255) NOT NULL,
  KEY `fldName` (`fldName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
