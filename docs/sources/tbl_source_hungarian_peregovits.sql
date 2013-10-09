-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Okt 2013 um 06:32
-- Server Version: 5.5.33
-- PHP-Version: 5.3.17

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
-- Tabellenstruktur für Tabelle `tbl_source_hungarian_peregovits`
--

CREATE TABLE IF NOT EXISTS `tbl_source_hungarian_peregovits` (
  `Ordo` varchar(50) DEFAULT NULL,
  `Family` varchar(50) DEFAULT NULL,
  `Genus` varchar(50) DEFAULT NULL,
  `species` varchar(50) DEFAULT NULL,
  `Auctor_year` varchar(50) DEFAULT NULL,
  `HU_Common_name` varchar(50) DEFAULT NULL,
  `Period` varchar(50) DEFAULT NULL,
  `PUB_ID` int(11) DEFAULT NULL,
  KEY `PUB_ID` (`PUB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_source_hungarian_peregovits_literature`
--

CREATE TABLE IF NOT EXISTS `tbl_source_hungarian_peregovits_literature` (
  `PUB_ID` int(11) NOT NULL DEFAULT '0',
  `Authors` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  `Series_journal_title` varchar(255) DEFAULT NULL,
  `volume_no` varchar(10) DEFAULT NULL,
  `Publisher` varchar(100) DEFAULT NULL,
  `Publisher_city` varchar(100) DEFAULT NULL,
  `edition` varchar(10) DEFAULT NULL,
  `ISBN` varchar(25) DEFAULT NULL,
  `pages` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`PUB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_source_hungarian_peregovits`
--
ALTER TABLE `tbl_source_hungarian_peregovits`
  ADD CONSTRAINT `fk_hungarian_peregovits_literature_PUB_ID` FOREIGN KEY (`PUB_ID`) REFERENCES `tbl_source_hungarian_peregovits_literature` (`PUB_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
