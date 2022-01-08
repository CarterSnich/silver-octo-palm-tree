-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2022 at 01:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Id` int(11) NOT NULL,
  `Username` varchar(70) NOT NULL,
  `Password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', '$2y$10$Y5WHx4fFGwnWzOXeuFvhlO2MJh7NZ24CwVXVQn53hmGBxc9rhXKjW');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(70) NOT NULL,
  `Password` varchar(70) NOT NULL,
  `Lastname` varchar(70) NOT NULL,
  `Firstname` varchar(70) NOT NULL,
  `Middlename` varchar(70) DEFAULT NULL,
  `Phonenumber` varchar(11) NOT NULL,
  `Address` varchar(128) NOT NULL,
  `Vaccine` varchar(70) DEFAULT NULL,
  `Firstdose` date DEFAULT NULL,
  `Seconddose` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Lastname`, `Firstname`, `Middlename`, `Phonenumber`, `Address`, `Vaccine`, `Firstdose`, `Seconddose`) VALUES
(3, 'troy', '$2y$10$Y5WHx4fFGwnWzOXeuFvhlO2MJh7NZ24CwVXVQn53hmGBxc9rhXKjW', 'Costelo', 'Troy', NULL, '0912345679', 'Carigara', 'CORONAVAC', '2022-01-03', '2022-01-19'),
(5, 'johndoe', '$2y$10$4rBConEdW8yxiPlpTB5BoO6I8.aY/xIdW2/HLwxOBd2NOGqAKNeim', 'Doe', 'John', 'Smith', '09123685479', 'Dulag', NULL, NULL, NULL),
(6, 'juan', '$2y$10$f16QDBMPJnbdYCVSAv.f6.O.9v4eMX87bVsYGWiCTQQpzv2V7h.eO', 'de la Cruz', 'Juan', NULL, '0912587593', 'Alang-alang', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
