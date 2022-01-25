-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 07:05 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magacin`
--

-- --------------------------------------------------------

--
-- Table structure for table `mgc_dobavljaci`
--

CREATE TABLE `mgc_dobavljaci` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_dobavljaci`
--

INSERT INTO `mgc_dobavljaci` (`id`, `naziv`) VALUES
(1, 'Firma d.o.o.'),
(3, 'Hleb i kifle'),
(4, 'Automehanika');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_izlaz_robe`
--

CREATE TABLE `mgc_izlaz_robe` (
  `id` int(11) NOT NULL,
  `radnik_id` int(11) NOT NULL,
  `datum_izdavanja` date NOT NULL,
  `vreme_izdavanja` time NOT NULL,
  `svrha_izdavanja_id` int(11) NOT NULL,
  `vrsta_kvara_id` int(11) NOT NULL,
  `kolicina` double NOT NULL,
  `status_id` int(11) NOT NULL,
  `napomena` text NOT NULL,
  `stanje_id` int(11) NOT NULL,
  `ulaz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_izlaz_robe`
--

INSERT INTO `mgc_izlaz_robe` (`id`, `radnik_id`, `datum_izdavanja`, `vreme_izdavanja`, `svrha_izdavanja_id`, `vrsta_kvara_id`, `kolicina`, `status_id`, `napomena`, `stanje_id`, `ulaz_id`) VALUES
(2, 0, '2021-12-04', '05:42:00', 0, 0, 1234, 0, 'test1', 0, 0),
(3, 0, '2021-12-04', '05:05:00', 0, 0, 2223, 0, 'aaaaaaa1', 0, 0),
(4, 9, '2021-12-04', '05:05:00', 1, 3, 3333444, 2, 'testiranje', 0, 0),
(5, 2, '2021-12-11', '05:05:00', 2, 2, 111, 1, 'test', 3, 0),
(9, 1, '0000-00-00', '11:11:00', 1, 1, 111, 1, '1111', 0, 9),
(13, 1, '0000-00-00', '00:00:00', 1, 1, 0, 1, '', 0, 6),
(14, 1, '0000-00-00', '00:00:00', 1, 1, 2, 1, '', 0, 10),
(18, 2, '2022-01-12', '11:01:00', 1, 1, 6666666, 2, '12', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `mgc_kvalitet_robe`
--

CREATE TABLE `mgc_kvalitet_robe` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_kvalitet_robe`
--

INSERT INTO `mgc_kvalitet_robe` (`id`, `naziv`) VALUES
(1, 'Nova roba'),
(2, 'Polovna roba');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_radnici`
--

CREATE TABLE `mgc_radnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(200) NOT NULL,
  `prezime` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_radnici`
--

INSERT INTO `mgc_radnici` (`id`, `ime`, `prezime`) VALUES
(1, 'Marko', 'Markovic'),
(2, 'Pera', 'Peric Ilic'),
(3, 'Stevan', 'Nikolic'),
(4, 'Igor', 'Ilic');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_stanje_robe`
--

CREATE TABLE `mgc_stanje_robe` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_stanje_robe`
--

INSERT INTO `mgc_stanje_robe` (`id`, `naziv`) VALUES
(1, 'Vraceno osteceno'),
(2, 'Vraceno delimicno osteceno'),
(5, 'Vraceno celo'),
(6, 'izdato osteceno'),
(7, 'izdato delimicno osteceno'),
(8, 'izdato celo');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_status_robe`
--

CREATE TABLE `mgc_status_robe` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_status_robe`
--

INSERT INTO `mgc_status_robe` (`id`, `naziv`) VALUES
(1, 'Vraceno'),
(2, 'Zaduzeno');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_svrha_izdavanja`
--

CREATE TABLE `mgc_svrha_izdavanja` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_svrha_izdavanja`
--

INSERT INTO `mgc_svrha_izdavanja` (`id`, `naziv`) VALUES
(1, 'pozajmica'),
(2, 'Ugradnja u bager'),
(3, 'Ishrana'),
(4, 'Prodaja');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_ulaz_robe`
--

CREATE TABLE `mgc_ulaz_robe` (
  `id` int(11) NOT NULL,
  `dobavljac_id` int(11) NOT NULL,
  `datum_prijema` date NOT NULL,
  `garancija` varchar(100) NOT NULL DEFAULT '0',
  `vrsta_robe_id` int(11) NOT NULL,
  `cena_robe` double NOT NULL,
  `kolicina` int(11) NOT NULL,
  `kvalitet_id` int(11) NOT NULL,
  `napomena` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_ulaz_robe`
--

INSERT INTO `mgc_ulaz_robe` (`id`, `dobavljac_id`, `datum_prijema`, `garancija`, `vrsta_robe_id`, `cena_robe`, `kolicina`, `kvalitet_id`, `napomena`) VALUES
(4, 1, '2021-11-25', '0', 1, 222, 222, 2, 'napomena'),
(5, 1, '0000-00-00', '0', 1, 111, 2, 1, '3'),
(15, 1, '2022-01-24', '44445', 1, 4445, 4445, 1, '44445'),
(21, 3, '2022-01-12', 'aasd', 1, 123231, 21323, 1, '123');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_vracena_roba`
--

CREATE TABLE `mgc_vracena_roba` (
  `id` int(11) NOT NULL,
  `radnik_id` int(11) NOT NULL,
  `datum_vracanja` date NOT NULL,
  `vreme_vracanja` time NOT NULL,
  `status_id` int(11) NOT NULL,
  `stanje_id` int(11) NOT NULL,
  `napomena` text NOT NULL,
  `ulaz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_vracena_roba`
--

INSERT INTO `mgc_vracena_roba` (`id`, `radnik_id`, `datum_vracanja`, `vreme_vracanja`, `status_id`, `stanje_id`, `napomena`, `ulaz_id`) VALUES
(2, 2, '2021-12-11', '05:05:00', 1, 3, 'aaa', 0),
(8, 3, '0000-00-00', '11:12:00', 1, 2, '2312312', 10),
(14, 1, '2022-01-19', '11:01:00', 1, 1, '213', 15),
(15, 3, '2022-01-05', '11:11:00', 1, 2, 'aaaa', 15),
(18, 1, '2022-01-19', '22:22:00', 1, 1, 'AAAA', 15);

-- --------------------------------------------------------

--
-- Table structure for table `mgc_vrsta_kvara`
--

CREATE TABLE `mgc_vrsta_kvara` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_vrsta_kvara`
--

INSERT INTO `mgc_vrsta_kvara` (`id`, `naziv`) VALUES
(1, 'mehanicarski'),
(2, 'elektricarski'),
(3, 'bravarski');

-- --------------------------------------------------------

--
-- Table structure for table `mgc_vrsta_robe`
--

CREATE TABLE `mgc_vrsta_robe` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgc_vrsta_robe`
--

INSERT INTO `mgc_vrsta_robe` (`id`, `naziv`) VALUES
(1, 'Alat'),
(2, 'Hrana'),
(3, 'Brasno'),
(4, 'Ulje'),
(5, 'Gume');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mgc_dobavljaci`
--
ALTER TABLE `mgc_dobavljaci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_izlaz_robe`
--
ALTER TABLE `mgc_izlaz_robe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulaz_id` (`ulaz_id`);

--
-- Indexes for table `mgc_kvalitet_robe`
--
ALTER TABLE `mgc_kvalitet_robe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_radnici`
--
ALTER TABLE `mgc_radnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_stanje_robe`
--
ALTER TABLE `mgc_stanje_robe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_status_robe`
--
ALTER TABLE `mgc_status_robe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_svrha_izdavanja`
--
ALTER TABLE `mgc_svrha_izdavanja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_ulaz_robe`
--
ALTER TABLE `mgc_ulaz_robe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_vracena_roba`
--
ALTER TABLE `mgc_vracena_roba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulaz_id` (`ulaz_id`);

--
-- Indexes for table `mgc_vrsta_kvara`
--
ALTER TABLE `mgc_vrsta_kvara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgc_vrsta_robe`
--
ALTER TABLE `mgc_vrsta_robe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mgc_dobavljaci`
--
ALTER TABLE `mgc_dobavljaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mgc_izlaz_robe`
--
ALTER TABLE `mgc_izlaz_robe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mgc_kvalitet_robe`
--
ALTER TABLE `mgc_kvalitet_robe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mgc_radnici`
--
ALTER TABLE `mgc_radnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mgc_stanje_robe`
--
ALTER TABLE `mgc_stanje_robe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mgc_status_robe`
--
ALTER TABLE `mgc_status_robe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgc_svrha_izdavanja`
--
ALTER TABLE `mgc_svrha_izdavanja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgc_ulaz_robe`
--
ALTER TABLE `mgc_ulaz_robe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mgc_vracena_roba`
--
ALTER TABLE `mgc_vracena_roba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mgc_vrsta_kvara`
--
ALTER TABLE `mgc_vrsta_kvara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgc_vrsta_robe`
--
ALTER TABLE `mgc_vrsta_robe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mgc_izlaz_robe`
--
ALTER TABLE `mgc_izlaz_robe`
  ADD CONSTRAINT `mgc_izlaz_robe_ibfk_1` FOREIGN KEY (`ulaz_id`) REFERENCES `mgc_ulaz_robe` (`id`);

--
-- Constraints for table `mgc_vracena_roba`
--
ALTER TABLE `mgc_vracena_roba`
  ADD CONSTRAINT `mgc_vracena_roba_ibfk_1` FOREIGN KEY (`ulaz_id`) REFERENCES `mgc_izlaz_robe` (`ulaz_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
