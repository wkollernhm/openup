-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. Jul 2013 um 08:58
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
-- Tabellenstruktur für Tabelle `tbl_source_allearter_dk`
--

CREATE TABLE IF NOT EXISTS `tbl_source_allearter_dk` (
  `Videnskabeligt_navn` varchar(100) default NULL,
  `Autor` varchar(17) default NULL,
  `Dansk_navn` varchar(100) default NULL,
  `Artsgruppe` varchar(10) default NULL,
  `Artsgruppe_dk` varchar(15) default NULL,
  `Taxontype` varchar(3) default NULL,
  `Taxonstatus` varchar(10) default NULL,
  `Rige` varchar(8) default NULL,
  `Rige_dk` varchar(9) default NULL,
  `Række` varchar(10) default NULL,
  `Række_dk` varchar(6) default NULL,
  `Underrække` varchar(8) default NULL,
  `Underrække_dk` varchar(10) default NULL,
  `Overklasse` varchar(10) default NULL,
  `Overklasse_dk` varchar(10) default NULL,
  `Klasse` varchar(7) default NULL,
  `Klasse_dk` varchar(8) default NULL,
  `Underklasse` varchar(10) default NULL,
  `Underklasse_dk` varchar(10) default NULL,
  `Infraklasse` varchar(10) default NULL,
  `Infraklasse_dk` varchar(10) default NULL,
  `Overorden` varchar(10) default NULL,
  `Overorden_dk` varchar(10) default NULL,
  `Orden` varchar(10) default NULL,
  `Orden_dk` varchar(15) default NULL,
  `Underorden` varchar(11) default NULL,
  `Underorden_dk` varchar(10) default NULL,
  `Infraorden` varchar(10) default NULL,
  `Infraorden_dk` varchar(10) default NULL,
  `Overfamilie` varchar(10) default NULL,
  `Overfamilie_dk` varchar(10) default NULL,
  `Familie` varchar(8) default NULL,
  `Familie_dk` varchar(10) default NULL,
  `Underfamilie` varchar(10) default NULL,
  `Underfamilie_dk` varchar(10) default NULL,
  `Tribus` varchar(10) default NULL,
  `Tribus_dk` varchar(10) default NULL,
  `Synonymer` varchar(10) default NULL,
  `Synonymer_dk` varchar(10) default NULL,
  `Referencenavn` varchar(100) default NULL,
  `Referenceår` int(4) default NULL,
  `Referencetekst` varchar(255) default NULL,
  `Systematik` varchar(10) default NULL,
  `Forekomst` varchar(10) default NULL,
  `Økologi` varchar(10) default NULL,
  `Status` varchar(10) default NULL,
  `Dato` varchar(10) default NULL,
  `Sortering` varchar(10) default NULL,
  `Den_danske_rødliste` varchar(10) default NULL,
  `Fredede_arter` varchar(10) default NULL,
  `EF_habitatdirektivet` varchar(10) default NULL,
  `EF_fuglebeskyttelsesdirektivet` varchar(10) default NULL,
  `Bern_konventionen` varchar(10) default NULL,
  `Bonn_konventionen` varchar(10) default NULL,
  `CITES` varchar(10) default NULL,
  `Øvrige_forvaltningskategorier` varchar(10) default NULL,
  `NOBANIS` varchar(10) default NULL,
  `NOBANIS_herkomst` varchar(10) default NULL,
  `NOBANIS_etableringsstatus` varchar(10) default NULL,
  `NOBANIS_invasiv_optraeden` varchar(10) default NULL,
  KEY `Videnskabeligt_navn` (`Videnskabeligt_navn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
