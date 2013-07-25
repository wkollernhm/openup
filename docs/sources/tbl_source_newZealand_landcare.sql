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
-- Tabellenstruktur für Tabelle `tbl_source_newZealand_landcare`
--

CREATE TABLE IF NOT EXISTS `tbl_source_newZealand_landcare` (
  `nameguid` varchar(36) default NULL,
  `NameFull` varchar(200) default NULL,
  `VernacularGuid` varchar(36) default NULL,
  `VernacularName` varchar(200) default NULL,
  `ReferenceGenCitation` varchar(255) default NULL,
  `GeoRegionName` varchar(100) default NULL,
  `LanguageEnglish` varchar(30) default NULL,
  `LanguageISOCode` varchar(6) default NULL,
  KEY `NameFull` (`NameFull`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
