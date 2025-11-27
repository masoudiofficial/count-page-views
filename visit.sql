-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 11:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visit`
--

-- --------------------------------------------------------

--
-- Table structure for table `statstable`
--

CREATE TABLE `statstable` (
  `username` char(32) NOT NULL,
  `datetime` char(19) NOT NULL,
  `d01` int(10) NOT NULL,
  `d02` int(10) NOT NULL,
  `d03` int(10) NOT NULL,
  `d04` int(10) NOT NULL,
  `d05` int(10) NOT NULL,
  `d06` int(10) NOT NULL,
  `d07` int(10) NOT NULL,
  `d08` int(10) NOT NULL,
  `d09` int(10) NOT NULL,
  `d10` int(10) NOT NULL,
  `d11` int(10) NOT NULL,
  `d12` int(10) NOT NULL,
  `d13` int(10) NOT NULL,
  `d14` int(10) NOT NULL,
  `d15` int(10) NOT NULL,
  `d16` int(10) NOT NULL,
  `d17` int(10) NOT NULL,
  `d18` int(10) NOT NULL,
  `d19` int(10) NOT NULL,
  `d20` int(10) NOT NULL,
  `d21` int(10) NOT NULL,
  `d22` int(10) NOT NULL,
  `d23` int(10) NOT NULL,
  `d24` int(10) NOT NULL,
  `d25` int(10) NOT NULL,
  `d26` int(10) NOT NULL,
  `d27` int(10) NOT NULL,
  `d28` int(10) NOT NULL,
  `d29` int(10) NOT NULL,
  `d30` int(10) NOT NULL,
  `d31` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statstable`
--

INSERT INTO `statstable` (`username`, `datetime`, `d01`, `d02`, `d03`, `d04`, `d05`, `d06`, `d07`, `d08`, `d09`, `d10`, `d11`, `d12`, `d13`, `d14`, `d15`, `d16`, `d17`, `d18`, `d19`, `d20`, `d21`, `d22`, `d23`, `d24`, `d25`, `d26`, `d27`, `d28`, `d29`, `d30`, `d31`) VALUES
('mainaccount', '1404-07-25 13:26:26', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `statstable`
--
ALTER TABLE `statstable`
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
