-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2017 at 06:57 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ODB_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Donation`
--

CREATE TABLE `Donation` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Vendor` varchar(50) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Driver` varchar(50) DEFAULT NULL,
  `Items` varchar(250) NOT NULL,
  `ItemDesc` varchar(50) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Value` decimal(10,0) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donation`
--

INSERT INTO `Donation` (`Id`, `Name`, `Vendor`, `Email`, `Driver`, `Items`, `ItemDesc`, `Quantity`, `Value`, `Weight`, `Date`) VALUES
(1, 'John Doe', 'Kroger', 'johndoe@kroger.com', 'Pete Spade', 'Bread', '', 15, '20', 4, '2017-08-08 16:08:27'),
(2, 'Betty Rubble', 'Avrils Deli Meats', 'betty@myhouse.com', 'Ted Ginn', 'Meat', 'Hotdogs', 50, '70', 15, '2017-09-01 11:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `Vendor`
--

CREATE TABLE `Vendor` (
  `Id` int(11) NOT NULL,
  `Vendor` varchar(75) NOT NULL,
  `Contact` varchar(75) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(10) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Vendor Details';

--
-- Dumping data for table `Vendor`
--

INSERT INTO `Vendor` (`Id`, `Vendor`, `Contact`, `Email`, `Address`, `City`, `State`, `ZipCode`, `PhoneNumber`) VALUES
(1, 'Freds Produce', 'Fred Johnson', 'fred@produce.us', '967 Orange St', 'Cincinnati', 'OH', '45212', '513-934-1189'),
(2, 'Tinas Cookies', 'Tina Lacky', 'Tina@cookies.com', '1334 Butter Ave', 'Cincinnati', 'OH', '45212', ''),
(4, 'Joes Potatos', 'Joe Spud', 'joe@spuds.com', '222 Sweet Potato Dr', 'Cincinnati', 'OH', '45321', '513-944-4456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Donation`
--
ALTER TABLE `Donation`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `Vendor`
--
ALTER TABLE `Vendor`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Donation`
--
ALTER TABLE `Donation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Vendor`
--
ALTER TABLE `Vendor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
