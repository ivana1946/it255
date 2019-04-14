-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 10:18 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `it255`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumentacija`
--

CREATE TABLE IF NOT EXISTS `dokumentacija` (
`id_dokumentacija` int(128) NOT NULL,
  `kategorija_dokumentacija` varchar(128) NOT NULL,
  `naziv_dokumentacija` varchar(128) NOT NULL,
  `opis_dokumentacija` text NOT NULL,
  `id_ugovor` int(128) NOT NULL,
  `datum_dokumentacija` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dokumentacija`
--

INSERT INTO `dokumentacija` (`id_dokumentacija`, `kategorija_dokumentacija`, `naziv_dokumentacija`, `opis_dokumentacija`, `id_ugovor`, `datum_dokumentacija`) VALUES
(1, 'Reklamacija', 'Reklamacija', 'Slab protok interneta', 1, '2019-02-04'),
(2, 'Zahtev', 'Zahtev za dodavanje novog uredjaja', 'Dodavanje novog uredjaja za internet.', 1, '2019-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
`id` int(25) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `sifra` varchar(25) NOT NULL,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `username`, `sifra`, `token`) VALUES
(1, 'ivana', 'stankovic', 'ivana@gmail.com', '12345', '0'),
(2, 'milos', 'kostic', 'milos@gmail.com', '54321', '1'),
(3, 'katarina', 'vuckovic', 'kaca@gmail.com', 'kaca', '');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
`id_paket` int(10) NOT NULL,
  `ime_paketa` varchar(10) NOT NULL,
  `kategorija` varchar(15) NOT NULL,
  `opis` text NOT NULL,
  `cena` int(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `ime_paketa`, `kategorija`, `opis`, `cena`) VALUES
(1, 'GoldTrio', 'Trio', 'Najprodavaniji Trio paket. Obuhvata TV, Internet i Telefoniju.', 3500),
(2, 'SilverTrio', 'Trio', 'Jos jaci paket sa jos brzim internetom i vise besplatnih minuta.', 4000),
(3, 'DuoGold', 'Duo', 'Razgovarajte jos vise i gledajte jos vise kanala sa novim paketom.', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `ugovor`
--

CREATE TABLE IF NOT EXISTS `ugovor` (
`id_ugovor` int(25) NOT NULL,
  `id` int(25) NOT NULL,
  `id_paket` int(25) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `ime_paketa` varchar(25) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ugovor`
--

INSERT INTO `ugovor` (`id_ugovor`, `id`, `id_paket`, `ime`, `prezime`, `ime_paketa`, `datum`) VALUES
(1, 2, 1, '2', '2', '1', '2019-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumentacija`
--
ALTER TABLE `dokumentacija`
 ADD PRIMARY KEY (`id_dokumentacija`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
 ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `ugovor`
--
ALTER TABLE `ugovor`
 ADD PRIMARY KEY (`id_ugovor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumentacija`
--
ALTER TABLE `dokumentacija`
MODIFY `id_dokumentacija` int(128) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
MODIFY `id_paket` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ugovor`
--
ALTER TABLE `ugovor`
MODIFY `id_ugovor` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
