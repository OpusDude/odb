-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2017 at 07:25 PM
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
  `Driver` varchar(50) NOT NULL,
  `Items` varchar(50) NOT NULL,
  `ItemDesc` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `QuantityType` varchar(50) NOT NULL,
  `Value` decimal(10,2) NOT NULL,
  `Weight` double NOT NULL,
  `Notes` varchar(250) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Initialize` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donation`
--

INSERT INTO `Donation` (`Id`, `Vendor`, `Driver`, `Items`, `ItemDesc`, `Quantity`, `QuantityType`, `Value`, `Weight`, `Notes`, `Date`, `Initialize`) VALUES
(3, 4, 'Jordy Ram', 'Produce', 'Potatos', 34, 'Bags', '12.00', 4, NULL, '2017-10-01 10:59:16', '2017-09-15 15:06:59'),
(4, 1, 'Tony Rush', 'Fruit', 'Apples', 15, 'Crates', '25.00', 13, NULL, '2017-10-01 10:59:04', '2017-09-15 15:06:59'),
(6, 5, 'Maggie Turner', 'Meat', 'Ground Beef', 10, 'Boxes', '45.00', 50, NULL, '2017-10-01 10:58:46', '2017-09-15 15:06:59'),
(7, 6, 'Jordy Ram', 'Computer', 'Laptop', 1, 'Boxes', '799.95', 7, NULL, '2017-10-01 10:59:38', '2017-09-18 16:29:37'),
(8, 2, 'Jerry Fields', 'Baked Goods', 'Cookies', 200, 'Boxes', '7.50', 2, 'This is a super long comment. If Tina made 5 dozen cookies and gave 3 dozen to Alice and 1 dozen to Lisa, how many does she have left to give to ODB?', '2017-10-02 17:20:47', '2017-09-18 17:14:43'),
(9, 1, 'Tom Jones', 'Canned Goods', 'Green Beans', 50, 'Bags', '4.99', 1, 'We have to many green beans. Do not except anymore.', '2017-10-02 15:12:44', '2017-10-02 13:35:09'),
(14, 4, 'Tony Rush', 'Produce', 'Sweet Potatos', 20, 'Boxes', '60.00', 8, 'Sweet Potatos are awesome!', '2017-10-02 14:07:41', '2017-10-02 14:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `Driver`
--

CREATE TABLE `Driver` (
  `Id` int(11) NOT NULL,
  `Driver` varchar(75) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Driver`
--

INSERT INTO `Driver` (`Id`, `Driver`, `Email`, `PhoneNumber`) VALUES
(1, 'Tom Jones', 'tom@myemail.com', '513-123-4567'),
(3, 'David Gaines', 'davidg@whatever.com', '513-123-4555'),
(4, 'Maggie Turner', 'maggie@avrilsmeats.com', '513-901-8989'),
(5, 'Tony Rush', 'rush@tinascookies.com', '419-938-6154'),
(8, 'Jordy Ram', 'jram@harddriver.com', '513-888-6767'),
(9, 'Jason King', 'jking@fuse.net', '513-222-2222'),
(10, 'Jerry Fields', 'Feilds@grass.com', '513-999-8765');

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Driver`
--
ALTER TABLE `Driver`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
