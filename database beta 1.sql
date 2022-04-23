-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 02:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maturski`
--
CREATE DATABASE IF NOT EXISTS `maturski` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `maturski`;

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

CREATE TABLE `ocena` (
  `id` int(11) NOT NULL,
  `predmet` int(11) NOT NULL,
  `razred` int(11) NOT NULL,
  `ucenik` int(11) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`id`, `predmet`, `razred`, `ucenik`, `ocena`) VALUES
(3, 14, 6, 50, 5),
(4, 17, 6, 50, 5),
(5, 15, 6, 50, 5),
(6, 16, 6, 50, 4),
(7, 9, 6, 50, 4),
(8, 10, 6, 50, 4),
(9, 11, 6, 50, 4),
(10, 12, 6, 50, 4),
(11, 8, 6, 50, 4),
(12, 1, 6, 50, 4),
(13, 4, 6, 50, 4),
(14, 19, 6, 50, 4),
(15, 20, 6, 50, 4),
(16, 3, 6, 50, 4),
(17, 14, 7, 50, 5),
(18, 17, 7, 50, 5),
(19, 15, 7, 50, 5),
(20, 16, 7, 50, 5),
(21, 9, 7, 50, 5),
(22, 10, 7, 50, 5),
(23, 11, 7, 50, 5),
(24, 8, 7, 50, 5),
(25, 2, 7, 50, 5),
(26, 1, 7, 50, 5),
(27, 14, 8, 50, 5),
(28, 14, 9, 50, 5),
(29, 17, 9, 50, 3);

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

CREATE TABLE `predmeti` (
  `ID` int(11) NOT NULL,
  `Naziv` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`ID`, `Naziv`) VALUES
(1, 'Matematika'),
(2, 'Fizika'),
(3, 'Fizičko vaspitanje'),
(4, 'Biologija'),
(7, 'Hemija'),
(8, 'Geografija'),
(9, 'Likovna kultura'),
(10, 'Muzička kultura'),
(11, 'Istorija'),
(12, 'Demokratija i ljudska prava'),
(14, 'Srpski jezik'),
(15, 'Vjeronauka'),
(16, 'Engleski jezik'),
(17, 'Drugi strani jezik'),
(19, 'Tehničko obrazovanje'),
(20, 'Osnovi informatike');

-- --------------------------------------------------------

--
-- Table structure for table `smer`
--

CREATE TABLE `smer` (
  `ID` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smer`
--

INSERT INTO `smer` (`ID`, `naziv`) VALUES
(2, 'Tehničar inforamcionih tehnologija'),
(3, ' Tehničar mehatronike'),
(4, 'Tehničar multimedija'),
(5, 'Tehničar energetike'),
(6, ' Autoelektričar'),
(7, ' Električar');

-- --------------------------------------------------------

--
-- Table structure for table `ucenik`
--

CREATE TABLE `ucenik` (
  `ID` int(11) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `jmbg` varchar(13) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `mesto_rodjenja` varchar(50) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `telefon` varchar(25) NOT NULL,
  `jezik_od_3` varchar(50) NOT NULL,
  `jezik_od_6` varchar(50) NOT NULL,
  `veronauka` varchar(50) NOT NULL,
  `osnovna_skola` varchar(100) NOT NULL,
  `djelovodni_broj` varchar(50) NOT NULL,
  `datum_izdavanja` date NOT NULL,
  `mesto_izdavanja` varchar(50) NOT NULL,
  `ime_majke` varchar(50) NOT NULL,
  `prezime_majke` varchar(50) NOT NULL,
  `telefon_majke` varchar(50) NOT NULL,
  `zanimanje_majke` varchar(50) NOT NULL,
  `adresa_majke` varchar(50) NOT NULL,
  `ime_oca` varchar(50) NOT NULL,
  `prezime_oca` varchar(50) NOT NULL,
  `telefon_oca` varchar(50) NOT NULL,
  `zanimanje_oca` varchar(50) NOT NULL,
  `adresa_oca` varchar(50) NOT NULL,
  `smer1` int(11) NOT NULL,
  `smer2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`ID`, `ime`, `prezime`, `mail`, `jmbg`, `datum_rodjenja`, `mesto_rodjenja`, `adresa`, `telefon`, `jezik_od_3`, `jezik_od_6`, `veronauka`, `osnovna_skola`, `djelovodni_broj`, `datum_izdavanja`, `mesto_izdavanja`, `ime_majke`, `prezime_majke`, `telefon_majke`, `zanimanje_majke`, `adresa_majke`, `ime_oca`, `prezime_oca`, `telefon_oca`, `zanimanje_oca`, `adresa_oca`, `smer1`, `smer2`) VALUES
(50, 'Slaven', 'Đervida', 'slavendjervida@gmail.com', '3112020160017', '2002-12-31', 'Prijedor', '', '066/887-516', '', '', '', 'Vuk', '1234', '2018-06-01', 'Prijedor', 'Anđelka', 'Đervida', '066/059-176', 'Programer', 'Berlin 357', 'konj', 'konjinja', '000/000-000', 'budala', '__ bb', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `veza_razred_predmet`
--

CREATE TABLE `veza_razred_predmet` (
  `ID` int(11) NOT NULL,
  `Predmet` int(11) NOT NULL,
  `Razred` int(11) NOT NULL,
  `Redni_broj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `veza_razred_predmet`
--

INSERT INTO `veza_razred_predmet` (`ID`, `Predmet`, `Razred`, `Redni_broj`) VALUES
(9, 3, 6, 14),
(11, 19, 6, 12),
(12, 4, 6, 11),
(13, 1, 6, 10),
(14, 20, 6, 13),
(15, 8, 6, 9),
(16, 12, 6, 8),
(17, 11, 6, 7),
(18, 10, 6, 6),
(19, 9, 6, 5),
(20, 16, 6, 4),
(21, 15, 6, 3),
(22, 17, 6, 2),
(23, 14, 6, 1),
(27, 14, 9, 0),
(28, 14, 7, 1),
(29, 17, 7, 2),
(31, 15, 7, 3),
(32, 16, 7, 4),
(33, 9, 7, 5),
(34, 10, 7, 6),
(35, 11, 7, 7),
(36, 8, 7, 7),
(37, 2, 7, 8),
(38, 1, 7, 9),
(39, 17, 9, 2),
(40, 14, 8, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `smer`
--
ALTER TABLE `smer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `veza_razred_predmet`
--
ALTER TABLE `veza_razred_predmet`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `predmeti`
--
ALTER TABLE `predmeti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `smer`
--
ALTER TABLE `smer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ucenik`
--
ALTER TABLE `ucenik`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `veza_razred_predmet`
--
ALTER TABLE `veza_razred_predmet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
