-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2014 at 04:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pz_volonteri`
--

-- --------------------------------------------------------

--
-- Table structure for table `akcija`
--

CREATE TABLE IF NOT EXISTS `akcija` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(64) NOT NULL,
  `opis` text NOT NULL,
  `datum_pocetka` date NOT NULL,
  `datum_kraja` date NOT NULL,
  `lokacija` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `akcija`
--

INSERT INTO `akcija` (`id`, `naziv`, `opis`, `datum_pocetka`, `datum_kraja`, `lokacija`) VALUES
(1, 'Crveno je za volontere!', 'Akcija okupljanja volontera.', '2014-08-10', '2014-08-14', 'Crveni Krst'),
(2, 'Pomozimo kucama', 'Prikupljanje svih vidova pomoci za kuce. Npr:vode, hrane, lekova, sredstva za kupanje.', '2014-08-12', '2014-08-18', 'Pet Shop "Mala Buva"');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `administrator` tinyint(3) unsigned NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `sifra` varchar(64) NOT NULL,
  `datum_registracije` datetime NOT NULL,
  `o_sebi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `administrator`, `ime`, `prezime`, `email`, `sifra`, `datum_registracije`, `o_sebi`) VALUES
(1, 1, 'Ivana', 'Stankovic', 'ivanast14071994@gmail.com', '21071970', '2014-08-07 15:19:21', ''),
(2, 0, 'Zorica', 'Milanovic', 'zoka@gmail.com', '1234', '2014-08-07 15:44:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `volonter`
--

CREATE TABLE IF NOT EXISTS `volonter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_akcija` int(10) unsigned NOT NULL,
  `id_korisnik` int(10) unsigned NOT NULL,
  `datum_pridruzivanja` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_akcija` (`id_akcija`,`id_korisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `volonter`
--

INSERT INTO `volonter` (`id`, `id_akcija`, `id_korisnik`, `datum_pridruzivanja`) VALUES
(1, 1, 1, '2014-08-13'),
(3, 1, 2, '2014-08-07'),
(36, 2, 1, '2014-08-07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
