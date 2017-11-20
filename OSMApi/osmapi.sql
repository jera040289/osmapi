-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2017 at 02:32 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osmapi`
--
CREATE DATABASE IF NOT EXISTS `osmapi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `osmapi`;

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prezime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumRodjenja` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`ID`, `Ime`, `Prezime`, `DatumRodjenja`) VALUES
(1, 'Pera', 'Peric', '1981-12-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `knjiga`
--

CREATE TABLE IF NOT EXISTS `knjiga` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GodinaIzdavanja` datetime DEFAULT NULL,
  `Jezik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OriginalniJezik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDAutor` int(11) NOT NULL,
  `IDKorisnik` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `knjiga`
--

INSERT INTO `knjiga` (`ID`, `Naziv`, `GodinaIzdavanja`, `Jezik`, `OriginalniJezik`, `IDAutor`, `IDKorisnik`) VALUES
(1, 'Knjiga1', '2016-01-19 00:00:00', 'Srpski', 'Srpski', 1, 1),
(2, 'Knjiga2', '2017-11-07 00:00:00', 'Srpski', 'Engleski', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prezime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PlainPassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumKreiranja` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID`, `Ime`, `Prezime`, `Username`, `PlainPassword`, `DatumKreiranja`) VALUES
(1, 'Milos', 'Jerkovic', 'jera', '12345', '2017-11-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `korisniktoken`
--

CREATE TABLE IF NOT EXISTS `korisniktoken` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDKorisnik` int(11) NOT NULL,
  `TokenKorisnik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `JeValidan` tinyint(4) NOT NULL DEFAULT '0',
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `korisniktoken`
--

INSERT INTO `korisniktoken` (`ID`, `IDKorisnik`, `TokenKorisnik`, `JeValidan`, `TimeStamp`) VALUES
(1, 1, '8ff0ef0b-cd98-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:14:39'),
(2, 1, 'bba8b311-cd98-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:15:53'),
(3, 1, 'c40f7c6a-cd98-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:16:07'),
(4, 1, 'e905fcac-cd98-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:17:09'),
(5, 1, '0dbbea44-cd99-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:18:10'),
(6, 1, '13fe8ecd-cd99-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:18:21'),
(7, 1, '16ff2002-cd99-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:18:26'),
(8, 1, '19f79952-cd99-11e7-b799-1c6f6590f24e', 1, '2017-11-20 02:18:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
