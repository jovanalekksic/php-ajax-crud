-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Jan 13, 2023 at 10:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knjige`
--
CREATE DATABASE IF NOT EXISTS `knjige` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `knjige`;

-- --------------------------------------------------------

--
-- Table structure for table `clanovi`
--

DROP TABLE IF EXISTS `clanovi`;
CREATE TABLE `clanovi` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `adresa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clanovi`
--

INSERT INTO `clanovi` (`id`, `ime`, `prezime`, `email`, `telefon`, `adresa`) VALUES
(1, 'Jovana', 'Aleksic', 'jaleksic@gmail.com', '0653259874', 'Jove Ilica 52'),
(4, 'Stefan', 'Markovic', 'sm@gmail.com', '0633654792', 'Zlatiborska 46'),
(5, 'Ana', 'Ivanovic', 'ai@gmail.com', '0666549823', 'Makedonska 33'),
(8, 'Petar', 'Petrovic', 'pp@gmail.com', '0613459761', 'Paunova 64');

-- --------------------------------------------------------

--
-- Table structure for table `prijave`
--

DROP TABLE IF EXISTS `prijave`;
CREATE TABLE `prijave` (
  `prijava_id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `drzava` varchar(255) NOT NULL,
  `zanr` varchar(255) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `idClana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prijave`
--

INSERT INTO `prijave` (`prijava_id`, `naziv`, `autor`, `drzava`, `zanr`, `datum`, `idClana`) VALUES
(63, 'Harry Potter and the Goblet of Fire', 'J.K.Rowling', 'UK', 'Fantastika', '2023-01-04', 5),
(64, 'Silmarillion 2', 'J. R. R. Tolkien', 'SAD', 'Fantastika', '2023-01-04', 4),
(67, 'Šesta faza sna', 'Bernar Verber', 'Francuska', 'Avanturistički', '2022-12-23', 8),
(68, 'The Baltimore Boys', 'Joël Dicker', 'Switzerland', 'Drama', '2022-12-01', 5),
(69, 'Sreća je piti čaj s tobom', 'Mamen Sančes', 'Španija', 'Ljubavni', '2022-12-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanovi`
--
ALTER TABLE `clanovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prijave`
--
ALTER TABLE `prijave`
  ADD PRIMARY KEY (`prijava_id`),
  ADD KEY `prijave_ibfk_1` (`idClana`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clanovi`
--
ALTER TABLE `clanovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prijave`
--
ALTER TABLE `prijave`
  MODIFY `prijava_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prijave`
--
ALTER TABLE `prijave`
  ADD CONSTRAINT `prijave_ibfk_1` FOREIGN KEY (`idClana`) REFERENCES `clanovi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
