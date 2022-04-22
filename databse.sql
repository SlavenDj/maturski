-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 04:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone =  "+00:00";


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
  `telefon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`ID`, `ime`, `prezime`, `mail`, `jmbg`, `datum_rodjenja`, `mesto_rodjenja`, `adresa`, `telefon`) VALUES
(1, 'Slaven', '', '', '', '0000-00-00', '', '', ''),
(2, '', '', '', '', '0000-00-00', '', '', ''),
(3, '', '', '', '', '0000-00-00', '', '', '+387 66/887516'),
(4, '', '', '', '', '0000-00-00', '', '', '+387 66/887-516'),
(5, '', '', '', '', '0000-00-00', '', '', '+38766/887-516'),
(6, '', '', '', '', '0000-00-00', '', '', '+366/887-516'),
(7, '', '', '', '', '0000-00-00', '', '', '+366/887-516'),
(8, '', '', '', '', '0000-00-00', '', '', '66sadsad'),
(9, '', '', '', '', '0000-00-00', '', '', '066/123-456');

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
(38, 1, 7, 9);

--
-- Indexes for dumped tables
--

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `veza_razred_predmet`
--
ALTER TABLE `veza_razred_predmet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
