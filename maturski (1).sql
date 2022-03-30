-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2021 at 10:54 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
(23, 14, 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `veza_razred_predmet`
--
ALTER TABLE `veza_razred_predmet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
