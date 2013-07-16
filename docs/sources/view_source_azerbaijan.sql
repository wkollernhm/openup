-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2013 at 11:22 AM
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
-- Structure for view `view_source_azerbaijan`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_source_azerbaijan` AS (select concat_ws(' ',`tbl_source_azerbaijan`.`GENUS`,`tbl_source_azerbaijan`.`GENAUTHOR`) AS `scientific_name`,`tbl_source_azerbaijan`.`AZERİNAME` AS `azerbaijan` from `tbl_source_azerbaijan` where ((`tbl_source_azerbaijan`.`SPECIES` = '') and (`tbl_source_azerbaijan`.`AZERİNAME` <> ''))) union (select concat_ws(' ',`tbl_source_azerbaijan`.`GENUS`,`tbl_source_azerbaijan`.`SPECIES`,`tbl_source_azerbaijan`.`SPAUTHOR`) AS `CONCAT_WS(' ', ``GENUS``, ``SPECIES``, ``SPAUTHOR``)`,`tbl_source_azerbaijan`.`AZERİNAME` AS `AZERİNAME` from `tbl_source_azerbaijan` where ((`tbl_source_azerbaijan`.`SPECIES` <> '') and (`tbl_source_azerbaijan`.`SUBTAXA` = '') and (`tbl_source_azerbaijan`.`AZERİNAME` <> ''))) union (select concat_ws(' ',`tbl_source_azerbaijan`.`GENUS`,`tbl_source_azerbaijan`.`SPECIES`,`tbl_source_azerbaijan`.`infrarank`,`tbl_source_azerbaijan`.`SUBTAXA`,`tbl_source_azerbaijan`.`SUBTAUTHOR`) AS `CONCAT_WS(' ', ``GENUS``, ``SPECIES``, ``infrarank``, ``SUBTAXA``, ``SUBTAUTHOR``)`,`tbl_source_azerbaijan`.`AZERİNAME` AS `AZERİNAME` from `tbl_source_azerbaijan` where ((`tbl_source_azerbaijan`.`SPECIES` <> '') and (`tbl_source_azerbaijan`.`SUBTAXA` <> '') and (`tbl_source_azerbaijan`.`AZERİNAME` <> '')));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
