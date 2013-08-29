-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Aug 2013 um 11:59
-- Server Version: 5.5.30-log
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
-- Tabellenstruktur für Tabelle `tbl_source_allearter_dk`
--

CREATE TABLE `tbl_source_allearter_dk` (
  `Videnskabeligt_navn` varchar(100) DEFAULT NULL,
  `Autor` varchar(150) DEFAULT NULL,
  `Dansk_navn` varchar(100) DEFAULT NULL,
  `Artsgruppe` varchar(50) DEFAULT NULL,
  `Artsgruppe_dk` varchar(50) DEFAULT NULL,
  `Taxontype` varchar(50) DEFAULT NULL,
  `Taxonstatus` varchar(20) DEFAULT NULL,
  `Rige` varchar(50) DEFAULT NULL,
  `Rige_dk` varchar(50) DEFAULT NULL,
  `Række` varchar(50) DEFAULT NULL,
  `Række_dk` varchar(50) DEFAULT NULL,
  `Underrække` varchar(50) DEFAULT NULL,
  `Underrække_dk` varchar(50) DEFAULT NULL,
  `Overklasse` varchar(50) DEFAULT NULL,
  `Overklasse_dk` varchar(50) DEFAULT NULL,
  `Klasse` varchar(50) DEFAULT NULL,
  `Klasse_dk` varchar(50) DEFAULT NULL,
  `Underklasse` varchar(50) DEFAULT NULL,
  `Underklasse_dk` varchar(50) DEFAULT NULL,
  `Infraklasse` varchar(50) DEFAULT NULL,
  `Infraklasse_dk` varchar(50) DEFAULT NULL,
  `Overorden` varchar(20) DEFAULT NULL,
  `Overorden_dk` varchar(20) DEFAULT NULL,
  `Orden` varchar(50) DEFAULT NULL,
  `Orden_dk` varchar(20) DEFAULT NULL,
  `Underorden` varchar(50) DEFAULT NULL,
  `Underorden_dk` varchar(50) DEFAULT NULL,
  `Infraorden` varchar(50) DEFAULT NULL,
  `Infraorden_dk` varchar(50) DEFAULT NULL,
  `Overfamilie` varchar(50) DEFAULT NULL,
  `Overfamilie_dk` varchar(50) DEFAULT NULL,
  `Familie` varchar(150) DEFAULT NULL,
  `Familie_dk` varchar(150) DEFAULT NULL,
  `Underfamilie` varchar(50) DEFAULT NULL,
  `Underfamilie_dk` varchar(50) DEFAULT NULL,
  `Tribus` varchar(50) DEFAULT NULL,
  `Tribus_dk` varchar(20) DEFAULT NULL,
  `Synonymer` varchar(255) DEFAULT NULL,
  `Synonymer_dk` varchar(200) DEFAULT NULL,
  `Referencenavn` varchar(100) DEFAULT NULL,
  `Referenceår` varchar(50) DEFAULT NULL,
  `Referencetekst` text,
  `Systematik` text,
  `Forekomst` varchar(200) DEFAULT NULL,
  `Økologi` varchar(150) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `Dato` varchar(20) DEFAULT NULL,
  `Sortering` varchar(20) DEFAULT NULL,
  `Den_danske_rødliste` varchar(50) DEFAULT NULL,
  `Fredede_arter` varchar(50) DEFAULT NULL,
  `EF_habitatdirektivet` varchar(20) DEFAULT NULL,
  `EF_fuglebeskyttelsesdirektivet` varchar(20) DEFAULT NULL,
  `Bern_konventionen` varchar(20) DEFAULT NULL,
  `Bonn_konventionen` varchar(20) DEFAULT NULL,
  `CITES` varchar(20) DEFAULT NULL,
  `Øvrige_forvaltningskategorier` varchar(20) DEFAULT NULL,
  `NOBANIS` varchar(200) DEFAULT NULL,
  `NOBANIS_herkomst` varchar(20) DEFAULT NULL,
  `NOBANIS_etableringsstatus` varchar(100) DEFAULT NULL,
  `NOBANIS_invasiv_optraeden` varchar(20) DEFAULT NULL,
  KEY `Videnskabeligt_navn` (`Videnskabeligt_navn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
