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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Donation`
--

LOCK TABLES `Donation` WRITE;
/*!40000 ALTER TABLE `Donation` DISABLE KEYS */;
INSERT INTO `Donation` VALUES (3,4,'Jordy Ram','Produce','Potatos',34,'Bags',12.00,4,NULL,'2017-10-01 10:59:16','2017-09-15 15:06:59'),(4,1,'Tony Rush','Fruit','Apples',15,'Crates',25.00,13,NULL,'2017-10-01 10:59:04','2017-09-15 15:06:59'),(6,5,'Maggie Turner','Meat','Ground Beef',10,'Boxes',45.00,50,NULL,'2017-10-01 10:58:46','2017-09-15 15:06:59'),(7,6,'Jordy Ram','Computer','Laptop',1,'Boxes',799.95,7,NULL,'2017-10-01 10:59:38','2017-09-18 16:29:37'),(8,2,'Jerry Fields','Baked Goods','Cookies',200,'Boxes',7.50,2,'This is a super long comment. If Tina made 5 dozen cookies and gave 3 dozen to Alice and 1 dozen to Lisa, how many does she have left to give to ODB?','2017-10-02 17:20:47','2017-09-18 17:14:43'),(9,1,'Tom Jones','Canned Goods','Green Beans',50,'Bags',4.99,1,'We have to many green beans. Do not accept anymore.','2017-10-03 15:16:32','2017-10-02 13:35:09'),(14,4,'Tony Rush','Produce','Sweet Potatos',20,'Boxes',60.00,8,'Sweet Potatos are awesome!','2017-10-02 14:07:41','2017-10-02 14:07:41'),(16,2,'Maggie Turner','Baked Goods','Birthday Cake',5,'Boxes',20.00,3,'Extra special cakes from Tinas. ','2017-10-03 15:08:27','2017-10-03 15:08:27'),(17,8,'Tony Rush','Canned Goods','Corn',50,'Bags',2.00,1,'Frozen corn in 1 lbs bags','2017-10-03 15:45:04','2017-10-03 15:45:04');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Driver`
--

LOCK TABLES `Driver` WRITE;
/*!40000 ALTER TABLE `Driver` DISABLE KEYS */;
INSERT INTO `Driver` VALUES (1,'Tom Jones','tom@myemail.com','513-123-4567'),(3,'David Gaines','davidg@whatever.com','513-123-4555'),(4,'Maggie Turner','maggie@avrilsmeats.com','513-901-8989'),(5,'Tony Rush','rush@tinascookies.com','419-938-6154'),(8,'Jordy Ram','jram@harddriver.com','513-888-6768'),(9,'Jason King','jking@fuse.net','513-222-2222'),(10,'Jerry Fields','Feilds@grass.com','513-999-8765');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QuantityType`
--

LOCK TABLES `QuantityType` WRITE;
/*!40000 ALTER TABLE `QuantityType` DISABLE KEYS */;
INSERT INTO `QuantityType` VALUES (1,'Bags'),(2,'Bins'),(3,'Boxes'),(4,'Crates'),(5,'Carts'),(8,'Box');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Vendor Details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vendor`
--

LOCK TABLES `Vendor` WRITE;
/*!40000 ALTER TABLE `Vendor` DISABLE KEYS */;
INSERT INTO `Vendor` VALUES (1,'Freds Produce','Fred Johnson','fred@produce.us','967 Orange St','Cincinnati','OH','45212','513-934-1189'),(2,'Tinas Cookies','Tina Lacky','Tina@cookies.com','1334 Butter Ave','Cincinnati','OH','45212','513-390-0021'),(4,'Joes Potatos','Joe Spud','joe@spuds.com','222 Sweet Potato Dr','Cincinnati','OH','45321','513-944-4456'),(5,'Avrils Deli Meats','John Baker','johnb@avrilsmeats.com','1234 Biltmore St','Cincinnati','OH','45233','513-123-4555'),(6,'Blue Ash Computer','Chip Socket','memory@blueashcomputer.com','2297 Memory Ln','Blue Ash','OH','45491','513-444-7777'),(8,'Abels Quality Foods','Able Long','abel@aqf.com','5499 Peach St','Cincinnati','OH','45221','513-666-7654');
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

-- Dump completed on 2017-10-03 21:47:39
