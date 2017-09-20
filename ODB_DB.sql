-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2017 at 10:53 AM
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
  `Vendor` int(11) NOT NULL,
  `Driver` int(11) DEFAULT NULL,
  `Items` varchar(50) NOT NULL,
  `ItemDesc` varchar(50) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `QuantityType` varchar(50) NOT NULL,
  `Value` decimal(10,2) DEFAULT NULL,
  `Weight` double DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Initialize` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donation`
--

INSERT INTO `Donation` (`Id`, `Vendor`, `Driver`, `Items`, `ItemDesc`, `Quantity`, `QuantityType`, `Value`, `Weight`, `Date`, `Initialize`) VALUES
(3, 4, 2, 'Produce', 'Potatos', 34, 'Bags', '12.00', 4, '2017-09-15 16:21:54', '2017-09-15 15:06:59'),
(4, 1, 1, 'Fruit', 'Apples', 15, 'Crates', '25.00', 13, '2017-09-15 16:17:31', '2017-09-15 15:06:59'),
(6, 5, 4, 'Meat', 'Ground Beef', 10, 'Boxes', '45.00', 50, '2017-09-15 16:54:41', '2017-09-15 15:06:59'),
(7, 6, 8, 'Computer', 'Laptop', 1, 'Boxes', '799.95', 7, '2017-09-18 16:40:44', '2017-09-18 16:29:37'),
(8, 2, 5, 'Baked Goods', 'Cookies', 200, 'Boxes', '7.50', 2, '2017-09-18 17:14:43', '2017-09-18 17:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `Driver`
--

CREATE TABLE `Driver` (
  `Id` int(11) NOT NULL,
  `Driver` varchar(75) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `Vendor` int(11) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Driver`
--

INSERT INTO `Driver` (`Id`, `Driver`, `Email`, `Vendor`, `PhoneNumber`) VALUES
(1, 'Tom Jones', 'tom@myemail.com', 1, '513-123-4567'),
(2, 'Jason King', 'jking@fuse.net', 4, '513-901-8874'),
(3, 'David Gaines', 'davidg@whatever.com', 1, '513-123-4555'),
(4, 'Maggie Turner', 'maggie@avrilsmeats.com', 5, '513-901-8989'),
(5, 'Tony Rush', 'rush@tinascookies.com', 2, '419-938-6154'),
(8, 'Jordy Ram', 'jram@harddriver.com', 6, '513-888-6767');

-- --------------------------------------------------------

--
-- Table structure for table `ItemType`
--

CREATE TABLE `ItemType` (
  `Id` int(11) NOT NULL,
  `Item` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ItemType`
--

INSERT INTO `ItemType` (`Id`, `Item`) VALUES
(1, 'Baked Goods'),
(2, 'Bread'),
(3, 'Canned Goods'),
(4, 'Coffee'),
(5, 'Dairy'),
(6, 'Fruit'),
(7, 'Paper Products'),
(8, 'Produce'),
(9, 'Meat'),
(10, 'Staples'),
(11, 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `QuantityType`
--

CREATE TABLE `QuantityType` (
  `Id` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `QuantityType`
--

INSERT INTO `QuantityType` (`Id`, `Type`) VALUES
(1, 'Bags'),
(2, 'Bins'),
(3, 'Boxes'),
(4, 'Crates'),
(5, 'Carts');

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
(2, 'Tinas Cookies', 'Tina Lacky', 'Tina@cookies.com', '1334 Butter Ave', 'Cincinnati', 'OH', '45212', '513-390-0021'),
(4, 'Joes Potatos', 'Joe Spud', 'joe@spuds.com', '222 Sweet Potato Dr', 'Cincinnati', 'OH', '45321', '513-944-4456'),
(5, 'Avrils Deli Meats', 'John Baker', 'johnb@avrilsmeats.com', '1234 Biltmore St', 'Cincinnati', 'OH', '45233', '513-123-4555'),
(6, 'Blue Ash Computer', 'Chip Socket', 'memory@blueashcomputer.com', '2297 Memory Ln', 'Blue Ash', 'OH', '45491', '513-444-7777');

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
-- Indexes for table `Driver`
--
ALTER TABLE `Driver`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `ID` (`Id`);

--
-- Indexes for table `ItemType`
--
ALTER TABLE `ItemType`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `QuantityType`
--
ALTER TABLE `QuantityType`
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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Driver`
--
ALTER TABLE `Driver`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ItemType`
--
ALTER TABLE `ItemType`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `QuantityType`
--
ALTER TABLE `QuantityType`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Vendor`
--
ALTER TABLE `Vendor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
