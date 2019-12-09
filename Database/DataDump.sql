CREATE DATABASE  IF NOT EXISTS `team7` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `team7`;
-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: team7
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adcomdetailemp`
--

DROP TABLE IF EXISTS `adcomdetailemp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adcomdetailemp` (
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adcomdetailemp`
--

LOCK TABLES `adcomdetailemp` WRITE;
/*!40000 ALTER TABLE `adcomdetailemp` DISABLE KEYS */;
INSERT INTO `adcomdetailemp` VALUES ('Claude','Shannon'),('George P.','Burdell'),('Manager','One'),('Three','Three'),('Four','Four'),('Marie','Curie');
/*!40000 ALTER TABLE `adcomdetailemp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adcomdetailth`
--

DROP TABLE IF EXISTS `adcomdetailth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adcomdetailth` (
  `thName` varchar(45) NOT NULL,
  `manager` varchar(45) NOT NULL,
  `thCity` varchar(45) NOT NULL,
  `thState` char(2) NOT NULL,
  `capacity` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adcomdetailth`
--

LOCK TABLES `adcomdetailth` WRITE;
/*!40000 ALTER TABLE `adcomdetailth` DISABLE KEYS */;
INSERT INTO `adcomdetailth` VALUES ('Cinema Star','entropyRox','San Francisco','CA',4),('Jonathan\'s Movies','georgep','Seattle','WA',2),('Star Movies','radioactivePoRa','Boulder','CA',5);
/*!40000 ALTER TABLE `adcomdetailth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `AdminUsername[fk3]` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('cool_class4400');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `comName` varchar(45) NOT NULL,
  PRIMARY KEY (`comName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES ('4400 Theater Company'),('AI Theater Company'),('Awesome Theater Company'),('EZ Theater Company');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cosviewhistory`
--

DROP TABLE IF EXISTS `cosviewhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cosviewhistory` (
  `movName` varchar(45) NOT NULL,
  `thName` varchar(45) NOT NULL,
  `comName` varchar(45) NOT NULL,
  `creditCardNum` char(16) NOT NULL,
  `movPlayDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cosviewhistory`
--

LOCK TABLES `cosviewhistory` WRITE;
/*!40000 ALTER TABLE `cosviewhistory` DISABLE KEYS */;
INSERT INTO `cosviewhistory` VALUES ('How to Train Your Dragon','Main Movies','EZ Theater Company','1111111111111111','2010-03-22'),('How to Train Your Dragon','Main Movies','EZ Theater Company','1111111111111111','2010-03-23'),('How to Train Your Dragon','Star Movies','EZ Theater Company','1111111111111100','2010-03-25'),('How to Train Your Dragon','Cinema Star','4400 Theater Company','1111111111111111','2010-04-02');
/*!40000 ALTER TABLE `cosviewhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditcard`
--

DROP TABLE IF EXISTS `creditcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `creditcard` (
  `username` varchar(45) NOT NULL,
  `creditCardNum` char(16) NOT NULL,
  PRIMARY KEY (`creditCardNum`),
  KEY `CustomerUsername[fk11]_idx` (`username`),
  CONSTRAINT `CustomerUsername[fk10]` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditcard`
--

LOCK TABLES `creditcard` WRITE;
/*!40000 ALTER TABLE `creditcard` DISABLE KEYS */;
INSERT INTO `creditcard` VALUES ('calcultron','1111111111000000'),('calcultron','123456'),('calcultron2','1111111100000000'),('calcultron2','1111111110000000'),('calcwizard','1111111111100000'),('cool_class4400','2222222222000000'),('DNAhelix','2220000000000000'),('does2Much','2222222200000000'),('eeqmcsquare','2222222222222200'),('entropyRox','2222222222200000'),('entropyRox','2222222222220000'),('fullMetal','1100000000000000'),('georgep','1111111111110000'),('georgep','1111111111111000'),('georgep','1111111111111100'),('georgep','1111111111111110'),('georgep','1111111111111111'),('ilikemoney$$','2222222222222220'),('ilikemoney$$','2222222222222222'),('ilikemoney$$','9000000000000000'),('imready','1111110000000000'),('isthisthekrustykrab','1110000000000000'),('isthisthekrustykrab','1111000000000000'),('isthisthekrustykrab','1111100000000000'),('notFullMetal','1000000000000000'),('programerAAL','2222222000000000'),('RitzLover28','3333333333333300'),('thePiGuy3.14','2222222220000000'),('theScienceGuy','2222222222222000'),('ugh','123');
/*!40000 ALTER TABLE `creditcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `CustomerUsername[fk1]` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('abc'),('calcultron'),('calcultron2'),('calcwizard'),('cool_class4400'),('DNAhelix'),('does2Much'),('eeqmcsquare'),('entropyRox'),('fullMetal'),('georgep'),('ilikemoney$$'),('imready'),('isthisthekrustykrab'),('notFullMetal'),('programerAAL'),('RitzLover28'),('thePiGuy3.14'),('theScienceGuy');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerviewmovie`
--

DROP TABLE IF EXISTS `customerviewmovie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customerviewmovie` (
  `movName` varchar(45) NOT NULL,
  `movReleaseDate` date NOT NULL,
  `movPlayDate` date NOT NULL,
  `thName` varchar(45) NOT NULL,
  `comName` varchar(45) NOT NULL,
  `creditCardNum` char(16) NOT NULL,
  PRIMARY KEY (`movName`,`movReleaseDate`,`movPlayDate`,`thName`,`comName`,`creditCardNum`),
  KEY `MoviePlayDate[fk19]_idx` (`movPlayDate`),
  KEY `MoviePlayInfo[fk13]_idx` (`movName`,`movReleaseDate`,`movPlayDate`,`thName`,`comName`),
  KEY `CreditCardNum[fk11]` (`creditCardNum`),
  CONSTRAINT `CreditCardNum[fk11]` FOREIGN KEY (`creditCardNum`) REFERENCES `creditcard` (`creditCardNum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customerviewmovie`
--

LOCK TABLES `customerviewmovie` WRITE;
/*!40000 ALTER TABLE `customerviewmovie` DISABLE KEYS */;
INSERT INTO `customerviewmovie` VALUES ('How to Train Your Dragon','2010-03-21','2010-03-22','Main Movies','EZ Theater Company','1111111111111111'),('How to Train Your Dragon','2010-03-21','2010-03-23','Main Movies','EZ Theater Company','1111111111111111'),('How to Train Your Dragon','2010-03-21','2010-03-25','Star Movies','EZ Theater Company','1111111111111100'),('How to Train Your Dragon','2010-03-21','2010-04-02','Cinema Star','4400 Theater Company','1111111111111111'),('4400 The Movie','2019-08-12','2019-10-12','ABC Theater','Awesome Theater Company','123456');
/*!40000 ALTER TABLE `customerviewmovie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `EmployeeUsername[fk2]` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES ('calcultron'),('cool_class4400'),('entropyRox'),('fatherAI'),('georgep'),('ghcghc'),('imbatman'),('manager1'),('manager2'),('manager3'),('manager4'),('radioactivePoRa');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manager` (
  `username` varchar(45) NOT NULL,
  `manStreet` varchar(45) NOT NULL,
  `manCity` varchar(45) NOT NULL,
  `manState` char(2) NOT NULL,
  `manZipcode` char(5) NOT NULL,
  `comName` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `Address_idx` (`manStreet`,`manCity`,`manState`,`manZipcode`),
  KEY `Company_idx` (`comName`) /*!80000 INVISIBLE */,
  CONSTRAINT `CompanyName[fk14]` FOREIGN KEY (`comName`) REFERENCES `company` (`comName`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ManagerUsername[fk4]` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES ('calcultron','123 Peachtree St','Atlanta','GA','30308','EZ Theater Company'),('entropyRox','200 Cool Place','San Francisco','CA','94016','4400 Theater Company'),('fatherAI','456 Main St','New York','NY','10001','EZ Theater Company'),('georgep','10 Pearl Dr','Seattle','WA','98105','4400 Theater Company'),('ghcghc','100 Pi St','Pallet Town','KS','31415','AI Theater Company'),('imbatman','800 Color Dr','Austin','TX','78653','Awesome Theater Company'),('manager1','123 Ferst Drive','Atlanta','GA','30332','4400 Theater Company'),('manager2','456 Ferst Drive','Atlanta','GA','30332','AI Theater Company'),('manager3','789 Ferst Drive','Atlanta','GA','30332','4400 Theater Company'),('manager4','000 Ferst Drive','Atlanta','GA','30332','4400 Theater Company'),('radioactivePoRa','100 Blu St','Sunnyvale','CA','94088','4400 Theater Company');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie` (
  `movName` varchar(45) NOT NULL,
  `movReleaseDate` date NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  PRIMARY KEY (`movName`,`movReleaseDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` VALUES ('4400 The Movie','2019-08-12',130),('Avengers: Endgame','2019-04-26',181),('Calculus Returns: A ML Story','2019-09-19',314),('George P Burdell\'s Life Story','1927-08-12',100),('Georgia Tech The Movie','1985-08-13',100),('How to Train Your Dragon','2010-03-21',98),('Spaceballs','1987-06-24',96),('Spider-Man: Into the Spider-Verse','2018-12-01',117),('The First Pokemon Movie','1998-07-19',75),('The King\'s Speech','2010-11-26',119);
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movieplay`
--

DROP TABLE IF EXISTS `movieplay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movieplay` (
  `movName` varchar(45) NOT NULL,
  `movReleaseDate` date NOT NULL,
  `movPlayDate` date NOT NULL,
  `thName` varchar(45) NOT NULL,
  `comName` varchar(45) NOT NULL,
  PRIMARY KEY (`movName`,`movReleaseDate`,`movPlayDate`,`thName`,`comName`),
  KEY `TheaterName[fk7]_idx` (`thName`,`comName`),
  CONSTRAINT `MovieID[fk6]` FOREIGN KEY (`movName`, `movReleaseDate`) REFERENCES `movie` (`movName`, `movReleaseDate`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TheaterName[fk7]` FOREIGN KEY (`thName`, `comName`) REFERENCES `theater` (`thName`, `comName`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movieplay`
--

LOCK TABLES `movieplay` WRITE;
/*!40000 ALTER TABLE `movieplay` DISABLE KEYS */;
INSERT INTO `movieplay` VALUES ('4400 The Movie','2019-08-12','2019-10-12','ABC Theater','Awesome Theater Company'),('Georgia Tech The Movie','1985-08-13','1985-08-13','ABC Theater','Awesome Theater Company'),('The First Pokemon Movie','1998-07-19','2018-07-19','ABC Theater','Awesome Theater Company'),('4400 The Movie','2019-08-12','2019-09-12','Cinema Star','4400 Theater Company'),('George P Burdell\'s Life Story','1927-08-12','2010-05-20','Cinema Star','4400 Theater Company'),('Georgia Tech The Movie','1985-08-13','2019-09-30','Cinema Star','4400 Theater Company'),('How to Train Your Dragon','2010-03-21','2010-04-02','Cinema Star','4400 Theater Company'),('Spaceballs','1987-06-24','2000-02-02','Cinema Star','4400 Theater Company'),('The King\'s Speech','2010-11-26','2019-12-20','Cinema Star','4400 Theater Company'),('George P Burdell\'s Life Story','1927-08-12','2019-07-14','Main Movies','EZ Theater Company'),('George P Burdell\'s Life Story','1927-08-12','2019-10-22','Main Movies','EZ Theater Company'),('How to Train Your Dragon','2010-03-21','2010-03-22','Main Movies','EZ Theater Company'),('How to Train Your Dragon','2010-03-21','2010-03-23','Main Movies','EZ Theater Company'),('Spaceballs','1987-06-24','1999-06-24','Main Movies','EZ Theater Company'),('The King\'s Speech','2010-11-26','2019-12-20','Main Movies','EZ Theater Company'),('Calculus Returns: A ML Story','2019-09-19','2019-10-10','ML Movies','AI Theater Company'),('Calculus Returns: A ML Story','2019-09-19','2019-12-30','ML Movies','AI Theater Company'),('Spaceballs','1987-06-24','2010-04-02','ML Movies','AI Theater Company'),('Spaceballs','1987-06-24','2023-01-23','ML Movies','AI Theater Company'),('Spider-Man: Into the Spider-Verse','2018-12-01','2019-09-30','ML Movies','AI Theater Company'),('4400 The Movie','2019-08-12','2019-08-12','Star Movies','EZ Theater Company'),('How to Train Your Dragon','2010-03-21','2010-03-25','Star Movies','EZ Theater Company');
/*!40000 ALTER TABLE `movieplay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theater`
--

DROP TABLE IF EXISTS `theater`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theater` (
  `thName` varchar(45) NOT NULL,
  `comName` varchar(45) NOT NULL,
  `capacity` int(10) unsigned NOT NULL,
  `thStreet` varchar(45) NOT NULL,
  `thCity` varchar(45) NOT NULL,
  `thState` char(2) NOT NULL,
  `thZipcode` char(5) NOT NULL,
  `manager` varchar(45) NOT NULL,
  PRIMARY KEY (`thName`,`comName`),
  KEY `CompanyName_idx` (`comName`),
  KEY `Manager[fk13]_idx` (`manager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theater`
--

LOCK TABLES `theater` WRITE;
/*!40000 ALTER TABLE `theater` DISABLE KEYS */;
INSERT INTO `theater` VALUES ('ABC Theater','Awesome Theater Company',5,'880 Color Dr','Austin','TX','73301','imbatman'),('Cinema Star','4400 Theater Company',4,'100 Cool Place','San Francisco','CA','94016','entropyRox'),('Jonathan\'s Movies','4400 Theater Company',2,'67 Pearl Dr','Seattle','WA','98101','georgep'),('Main Movies','EZ Theater Company',3,'123 Main St','New York','NY','10001','fatherAI'),('ML Movies','AI Theater Company',3,'314 Pi St','Pallet Town','KS','31415','ghcghc'),('Star Movies','4400 Theater Company',5,'4400 Rocks Ave','Boulder','CA','80301','radioactivePoRa'),('Star Movies','EZ Theater Company',2,'745 GT St','Atlanta','GA','30332','calcultron');
/*!40000 ALTER TABLE `theater` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`username`),
  CONSTRAINT `user_chk_1` CHECK ((length(`password`) >= 8))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('calcultron','Dwight','Schrute','333333333','Approved'),('calcultron2','Jim','Halpert','444444444','Approved'),('calcwizard','Issac','Newton','222222222','Approved'),('clarinetbeast','Squidward','Tentacles','999999999','Declined'),('cool_class4400','A. TA','Washere','333333333','Approved'),('DNAhelix','Rosalind','Franklin','777777777','Approved'),('does2Much','Carl','Gauss','1212121212','Approved'),('eeqmcsquare','Albert','Einstein','111111110','Approved'),('entropyRox','Claude','Shannon','999999999','Approved'),('fatherAI','Alan','Turing','222222222','Approved'),('fullMetal','Edward','Elric','111111100','Approved'),('gdanger','Gary','Danger','555555555','Declined'),('georgep','George P.','Burdell','111111111','Approved'),('ghcghc','Grace','Hopper','666666666','Approved'),('hlin337','Hannah','Lin','46d294deab9987e94ced5c0f7b478f5d','Pending'),('ilikemoney$$','Eugene','Krabs','111111110','Approved'),('imbatman','Bruce','Wayne','666666666','Approved'),('imready','Spongebob','Squarepants','777777777','Approved'),('isthisthekrustykrab','Patrick','Star','888888888','Approved'),('manager1','Manager','One','1122112211','Approved'),('manager2','Manager','Two','3131313131','Approved'),('manager3','Three','Three','8787878787','Approved'),('manager4','Four','Four','5755555555','Approved'),('notFullMetal','Alphonse','Elric','111111100','Approved'),('programerAAL','Ada','Lovelace','3131313131','Approved'),('radioactivePoRa','Marie','Curie','1313131313','Approved'),('RitzLover28','Abby','Normal','444444444','Approved'),('smith_j','John','Smith','333333333','Pending'),('texasStarKarate','Sandy','Cheeks','111111110','Declined'),('thePiGuy3.14','Archimedes','Syracuse','1111111111','Approved'),('theScienceGuy','Bill','Nye','999999999','Approved');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userfilterth`
--

DROP TABLE IF EXISTS `userfilterth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userfilterth` (
  `thName` varchar(45) NOT NULL,
  `thStreet` varchar(45) NOT NULL,
  `thCity` varchar(45) NOT NULL,
  `thState` char(2) NOT NULL,
  `thZipcode` char(5) NOT NULL,
  `comName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userfilterth`
--

LOCK TABLES `userfilterth` WRITE;
/*!40000 ALTER TABLE `userfilterth` DISABLE KEYS */;
INSERT INTO `userfilterth` VALUES ('Star Movies','745 GT St','Atlanta','GA','30332','EZ Theater Company');
/*!40000 ALTER TABLE `userfilterth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userlogin` (
  `username` varchar(45) NOT NULL,
  `status` varchar(8) NOT NULL,
  `isCustomer` int(1) NOT NULL DEFAULT '0',
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `isManager` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlogin`
--

LOCK TABLES `userlogin` WRITE;
/*!40000 ALTER TABLE `userlogin` DISABLE KEYS */;
INSERT INTO `userlogin` VALUES ('cool_class4400','Approved',1,1,0);
/*!40000 ALTER TABLE `userlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uservisittheater`
--

DROP TABLE IF EXISTS `uservisittheater`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uservisittheater` (
  `username` varchar(45) NOT NULL,
  `thName` varchar(45) NOT NULL,
  `comName` varchar(45) NOT NULL,
  `visitDate` date NOT NULL,
  `[VisitID]` int(10) unsigned NOT NULL,
  PRIMARY KEY (`[VisitID]`),
  KEY `Username[fk9]_idx` (`username`),
  KEY `TheaterName[fk10]_idx` (`thName`,`comName`),
  CONSTRAINT `TheaterInfo[fk9]` FOREIGN KEY (`thName`, `comName`) REFERENCES `theater` (`thName`, `comName`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Username[fk8]` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uservisittheater`
--

LOCK TABLES `uservisittheater` WRITE;
/*!40000 ALTER TABLE `uservisittheater` DISABLE KEYS */;
INSERT INTO `uservisittheater` VALUES ('georgep','Main Movies','EZ Theater Company','2010-03-22',1),('calcwizard','Main Movies','EZ Theater Company','2010-03-22',2),('calcwizard','Star Movies','EZ Theater Company','2010-03-25',3),('imready','Star Movies','EZ Theater Company','2010-03-25',4),('calcwizard','ML Movies','AI Theater Company','2010-03-20',5);
/*!40000 ALTER TABLE `uservisittheater` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'team7'
--

--
-- Dumping routines for database 'team7'
--
/*!50003 DROP PROCEDURE IF EXISTS `admin_create_theater` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_create_theater`(IN i_thName VARCHAR(50), IN i_comName VARCHAR(50), IN i_thStreet VARCHAR(50), IN i_thCity VARCHAR(50), IN i_thState CHAR(2), IN i_thZipcode CHAR(5), IN i_capacity INT, IN i_managerUsername VARCHAR(50))
BEGIN
	INSERT INTO theater	(thName, comName, thStreet, thCity, thState, thZipcode, capacity, manager) 
    VALUES	(i_thName, i_comName, i_thStreet, i_thCity, i_thState, i_thZipcode, i_capacity, i_managerUsername); 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `admin_filter_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_filter_user`(IN i_username VARCHAR(50), IN i_status VARCHAR(8), IN i_sortBy ENUM("username","creditCardCount","status","userType"), IN i_sortDirection ENUM("ASC","DESC"))
BEGIN
    DROP TABLE IF EXISTS AdFilterUser;
    CREATE TABLE AdFilterUser
		SELECT username, status, count(creditCardNum) as creditCardCount,
			CASE WHEN username in (select username from customer natural join manager natural join user) THEN "CustomerManager" END AS userType,
			CASE WHEN username in (select username from customer natural join admin natural join user) THEN "CustomerAdmin" END AS userType,
            CASE WHEN username in (select username from user natural join manager) THEN "Manager" END AS userType,
            CASE WHEN username in (select username from user natural join admin) THEN "Admin" END AS userType,
            CASE WHEN username in (select username from user natural join customer) THEN "Customer" END AS userType,
            CASE WHEN username in (select username from user) THEN "User" END AS userType
		FROM creditcard natural join user
		WHERE username = i_username AND (status = i_status OR status = "ALL")
		ORDER BY 
			(CASE WHEN i_sortBy = "username" AND i_sortDirection = "ASC" THEN username END) ASC,
            (CASE WHEN i_sortBy = "username" AND i_sortDirection = "DESC" THEN username END) DESC,
			(CASE WHEN i_sortBy = "creditCardCount" AND i_sortDirection = "ASC" THEN creditCardCount END) ASC,
            (CASE WHEN i_sortBy = "creditCardCount" AND i_sortDirection = "DESC" THEN creditCardCount END) DESC,
			(CASE WHEN i_sortBy = "status" AND i_sortDirection = "ASC" THEN status END) ASC,
            (CASE WHEN i_sortBy = "status" AND i_sortDirection = "DESC" THEN status END) DESC,
			(CASE WHEN i_sortBy = "userType" and i_sortDirection = "ASC" THEN userType END) ASC;
 --         (CASE WHEN i_sortBy = "" AND i_sortDirection = "ASC" THEN username END) ASC,
 --         (CASE WHEN i_sortBy = "" AND i_sortDirection = "DESC" THEN username END) DESC,
 --         (CASE WHEN i_sortBy = "" AND i_sortDirection = "" THEN username END) DESC,
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `admin_view_comDetail_emp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_view_comDetail_emp`(IN i_comName VARCHAR(50))
BEGIN
    DROP TABLE IF EXISTS AdComDetailEmp;
    CREATE TABLE AdComDetailEmp
SELECT firstname, lastname
    FROM user
	WHERE username IN (SELECT username FROM manager WHERE comName = i_comName); 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `admin_view_comDetail_th` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_view_comDetail_th`(IN i_comName VARCHAR(50))
BEGIN
    DROP TABLE IF EXISTS AdComDetailTh;
    CREATE TABLE AdComDetailTh
SELECT thName, manager, thCity, thState, capacity
    FROM theater
	WHERE (comName = i_comName); 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `customer_add_creditcard` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_add_creditcard`(IN i_username VARCHAR(50), IN i_creditCardNum CHAR(16))
BEGIN
		INSERT INTO creditcard (username, creditCardNum) VALUES (i_username, i_creditCardNum);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `customer_only_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_only_register`(IN i_username VARCHAR(50), IN i_password VARCHAR(50), IN i_firstname VARCHAR(50), IN i_lastname VARCHAR(50))
BEGIN
		INSERT INTO user (username, password, firstname, lastname) VALUES (i_username, MD5(i_password), i_firstname, i_lastname);
		INSERT INTO customer (username) VALUES (i_username);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `customer_view_History` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_view_History`(IN i_cusUsername VARCHAR(50))
BEGIN
    DROP TABLE IF EXISTS CosViewHistory;
    CREATE TABLE CosViewHistory
	SELECT movName, thName, comName, creditCardNum, movPlayDate
    FROM customerviewmovie
WHERE creditCardNum IN (SELECT creditCardNum from creditcard WHERE username = i_cusUsername);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `customer_view_mov` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_view_mov`(IN i_creditCardNum CHAR(16), IN i_movName VARCHAR(50), IN i_movReleaseDate DATE, IN i_thName VARCHAR(50), IN i_comName VARCHAR(50), IN i_movPlayDate DATE)
BEGIN
	INSERT INTO customerviewmovie(movName, movReleaseDate, movPlayDate, thName, comName, creditCardNum) 
    VALUES	(i_movName, i_movReleaseDate, i_movPlayDate, i_thName, i_comName, i_creditCardNum); 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manager_customer_add_creditcard` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manager_customer_add_creditcard`(IN i_username VARCHAR(50), IN i_creditCardNum CHAR(16))
BEGIN
		INSERT INTO creditcard (username, creditCardNum) VALUES (i_username, i_creditCardNum);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manager_customer_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manager_customer_register`(IN i_username VARCHAR(50), IN i_password VARCHAR(50), IN i_firstname VARCHAR(50), IN i_lastname VARCHAR(50), IN i_comName VARCHAR(50), IN i_empStreet VARCHAR(50), IN i_empCity VARCHAR(50), IN i_empState CHAR(2), i_empZipcode CHAR(5))
BEGIN
		INSERT INTO user (username, password, firstname, lastname, comName, empStreet, empCity, empState, empZipcode) VALUES (i_username, MD5(i_password), i_firstname, i_lastname, i_comName, i_empStreet, i_empCity, i_empState, i_empZipcode);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manager_only_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manager_only_register`(IN i_username VARCHAR(50), IN i_password VARCHAR(50), IN i_firstname VARCHAR(50), IN i_lastname VARCHAR(50), IN i_comName VARCHAR(50), IN i_empStreet VARCHAR(50), IN i_empCity VARCHAR(50), IN i_empState CHAR(2), i_empZipcode CHAR(5))
BEGIN
		INSERT INTO user (username, password, firstname, lastname)VALUES (i_username, MD5(i_password), i_firstname, i_lastname);

		INSERT INTO manager(username, manStreet, manCity, manState, manZipcode, comName) VALUES (i_username, i_empStreet, i_empCity, i_empState, i_empZipcode, i_comName);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manager_schedule_mov` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manager_schedule_mov`(IN i_manUsername VARCHAR(50), IN i_movName VARCHAR(50), IN i_movReleaseDate DATE, IN i_movPlayDate DATE)
BEGIN
    INSERT INTO movie(movName, movReleaseDate)
    VALUES (i_movName, i_movReleaseDate);
    INSERT INTO movieplay(movPlayDate) VALUES (i_movPlayDate);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_filter_th` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_filter_th`(IN i_thName VARCHAR(50), IN i_comName VARCHAR(50), IN i_city VARCHAR(50), IN i_state VARCHAR(3))
BEGIN
    DROP TABLE IF EXISTS UserFilterTh;
    CREATE TABLE UserFilterTh
	SELECT thName, thStreet, thCity, thState, thZipcode, comName 
    FROM Theater
    WHERE 
		(thName = i_thName OR i_thName = "ALL") AND
        (comName = i_comName OR i_comName = "ALL") AND
        (thCity = i_city OR i_city = "") AND
        (thState = i_state OR i_state = "ALL");
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_login`(IN i_username VARCHAR(50), IN i_password VARCHAR(50))
BEGIN
    DROP TABLE IF EXISTS UserLogin;
    CREATE TABLE UserLogin
	SELECT username, status,
	CASE
		WHEN username IN (select username from customer) THEN 1
		ELSE 0
	END AS isCustomer,
	CASE
		WHEN username IN (select username from admin) THEN 1
		ELSE 0
	END AS isAdmin,
	CASE
		WHEN username IN (select username from manager) THEN 1
		ELSE 0
	END AS isManager	
    FROM User
    WHERE 
		(username = i_username) AND (password = i_password);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_register`(IN i_username VARCHAR(50), IN i_password VARCHAR(50), IN i_firstname VARCHAR(50), IN i_lastname VARCHAR(50))
BEGIN
		INSERT INTO user (username, password, firstname, lastname) VALUES (i_username, MD5(i_password), i_firstname, i_lastname);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_visit_th` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_visit_th`(IN i_thName VARCHAR(50), IN i_comName VARCHAR(50), IN i_visitDate DATE, IN i_username VARCHAR(50))
BEGIN
    INSERT INTO UserVisitTheater (thName, comName, visitDate, username)
    VALUES (i_thName, i_comName, i_visitDate, i_username);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-26 14:37:34
