-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: ODB_DB
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Donation`
--

DROP TABLE IF EXISTS `Donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Donation` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `Initialize` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Donation`
--

LOCK TABLES `Donation` WRITE;
/*!40000 ALTER TABLE `Donation` DISABLE KEYS */;
INSERT INTO `Donation` VALUES (18,9,'Enoch','Bread','Bread',2,'Bags',240.00,40,'Variety of breads ','2017-10-04 09:19:03','2017-10-04 09:19:03'),(19,13,'Bruce Cortwright','Meat','Various meats',1,'Carts',100.00,35,'Catered event leftovers','2017-10-04 09:21:46','2017-10-04 09:21:46'),(20,9,'Enoch','Bread','Various breads',1,'Bags',100.00,35,'','2017-10-04 09:22:49','2017-10-04 09:22:49'),(21,10,'John Rush','Baked Goods','Bread and cakes',1,'Carts',100.00,90,'','2017-10-04 09:28:24','2017-10-04 09:24:17');
/*!40000 ALTER TABLE `Donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Driver`
--

DROP TABLE IF EXISTS `Driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Driver` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Driver` varchar(75) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `ID` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Driver`
--

LOCK TABLES `Driver` WRITE;
/*!40000 ALTER TABLE `Driver` DISABLE KEYS */;
INSERT INTO `Driver` VALUES (5,'John Rush','unknown','unknown'),(13,'Bruce Cortwright','corts5097@aol.com','513-451-5549'),(14,'Enoch','em@emsbread.com','513-802-5728');
/*!40000 ALTER TABLE `Driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ItemType`
--

DROP TABLE IF EXISTS `ItemType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ItemType` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Item` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ItemType`
--

LOCK TABLES `ItemType` WRITE;
/*!40000 ALTER TABLE `ItemType` DISABLE KEYS */;
INSERT INTO `ItemType` VALUES (1,'Baked Goods'),(2,'Bread'),(3,'Canned Goods'),(4,'Coffee'),(5,'Dairy'),(6,'Fruit'),(7,'Paper Products'),(8,'Produce'),(9,'Meat'),(10,'Staples'),(11,'Computer');
/*!40000 ALTER TABLE `ItemType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QuantityType`
--

DROP TABLE IF EXISTS `QuantityType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `QuantityType` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QuantityType`
--

LOCK TABLES `QuantityType` WRITE;
/*!40000 ALTER TABLE `QuantityType` DISABLE KEYS */;
INSERT INTO `QuantityType` VALUES (1,'Bags'),(2,'Bins'),(3,'Boxes'),(4,'Crates'),(5,'Carts'),(8,'Box'),(11,'Skids');
/*!40000 ALTER TABLE `QuantityType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vendor`
--

DROP TABLE IF EXISTS `Vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vendor` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Vendor` varchar(75) NOT NULL,
  `Contact` varchar(75) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(10) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='Vendor Details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vendor`
--

LOCK TABLES `Vendor` WRITE;
/*!40000 ALTER TABLE `Vendor` DISABLE KEYS */;
INSERT INTO `Vendor` VALUES (9,'Ems Bread','Enoch','em@emsbread.com','1801 Race St','Cincinnati','OH','45202','513-802-5728'),(10,'Kroger','John Rush','Paddack@purdailybread.us','4100 Hunt Rd','Blue Ash','OH','45236','513-792-1500'),(11,'Kroger','Bill','Paddack@purdailybread.us','6950 Miami Ave','Madeira','OH','	45243','513-271-1260'),(12,'Kroger','John Darlington','Paddack@purdailybread.us','12164 Lebanon Rd','Sharonville','OH','45241','513-733-4910'),(13,'P&G event at Rhinegeist','unknown','Paddack@purdailybread.us','1910 Elm St','Cincinnati','OH','45202','513-381-1367');
/*!40000 ALTER TABLE `Vendor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-04  9:33:44
