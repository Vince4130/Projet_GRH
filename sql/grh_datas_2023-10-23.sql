-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: grh
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `adminid` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `mdpass` varchar(50) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adminid`),
  UNIQUE KEY `ident` (`ident`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Sadmin','','admin','admin',1),(2,'Blanchard','Andrée','ablanchard','merguez',1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conges`
--

DROP TABLE IF EXISTS `conges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conges` (
  `congeid` int NOT NULL AUTO_INCREMENT,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `empid` int unsigned NOT NULL,
  `typeid` int NOT NULL,
  PRIMARY KEY (`congeid`),
  KEY `typeid` (`typeid`),
  KEY `empid` (`empid`),
  CONSTRAINT `conges_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`),
  CONSTRAINT `conges_ibfk_2` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conges`
--

LOCK TABLES `conges` WRITE;
/*!40000 ALTER TABLE `conges` DISABLE KEYS */;
INSERT INTO `conges` VALUES (1,'2023-03-07','2023-03-10',1,1),(2,'2023-05-03','2023-05-05',1,1),(3,'2023-06-06','2023-06-12',1,1),(4,'2023-08-08','2023-09-01',1,1),(5,'2023-08-07','2023-08-07',1,3);
/*!40000 ALTER TABLE `conges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_ant`
--

DROP TABLE IF EXISTS `credit_ant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credit_ant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `temps` time DEFAULT NULL,
  `empid` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empid` (`empid`),
  CONSTRAINT `credit_ant_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_ant`
--

LOCK TABLES `credit_ant` WRITE;
/*!40000 ALTER TABLE `credit_ant` DISABLE KEYS */;
INSERT INTO `credit_ant` VALUES (1,'02:20:00',2),(2,'01:15:00',3),(3,'00:00:00',4);
/*!40000 ALTER TABLE `credit_ant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demande_absence`
--

DROP TABLE IF EXISTS `demande_absence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `demande_absence` (
  `demabsid` int NOT NULL AUTO_INCREMENT,
  `date_dem` date NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `annee` year NOT NULL,
  `nb_j` int NOT NULL,
  `etat` varchar(50) NOT NULL,
  `empid` int unsigned NOT NULL,
  `typeid` int NOT NULL,
  PRIMARY KEY (`demabsid`),
  KEY `empid` (`empid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `demande_absence_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE,
  CONSTRAINT `demande_absence_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demande_absence`
--

LOCK TABLES `demande_absence` WRITE;
/*!40000 ALTER TABLE `demande_absence` DISABLE KEYS */;
INSERT INTO `demande_absence` VALUES (4,'2023-02-22','2023-03-07','2023-03-10',2023,4,'Acceptée',1,1),(5,'2023-02-22','2023-05-03','2023-05-05',2023,3,'Acceptée',1,1),(6,'2023-02-22','2023-06-06','2023-06-12',2023,5,'Acceptée',1,1),(8,'2023-02-22','2023-08-08','2023-09-01',2023,18,'Acceptée',1,1),(12,'2023-04-21','2023-05-02','2023-05-09',2023,5,'En attente',5,1),(18,'2023-08-04','2023-08-07','2023-08-07',2023,1,'Acceptée',1,3);
/*!40000 ALTER TABLE `demande_absence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demande_pointage`
--

DROP TABLE IF EXISTS `demande_pointage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `demande_pointage` (
  `dempointid` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `ha` time NOT NULL,
  `pm1` time NOT NULL,
  `pm2` time NOT NULL,
  `hd` time NOT NULL,
  `etat` varchar(50) NOT NULL,
  `pointid` int NOT NULL,
  PRIMARY KEY (`dempointid`),
  KEY `pointid` (`pointid`),
  CONSTRAINT `demande_pointage_ibfk_1` FOREIGN KEY (`pointid`) REFERENCES `pointage` (`pointid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demande_pointage`
--

LOCK TABLES `demande_pointage` WRITE;
/*!40000 ALTER TABLE `demande_pointage` DISABLE KEYS */;
INSERT INTO `demande_pointage` VALUES (1,'2022-11-10','08:30:00','11:55:00','12:30:00','17:58:00','Refusée',1),(2,'2023-04-05','09:07:00','11:56:00','12:36:00','17:30:00','En attente',3);
/*!40000 ALTER TABLE `demande_pointage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `droits_conges`
--

DROP TABLE IF EXISTS `droits_conges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `droits_conges` (
  `droitsid` int unsigned NOT NULL AUTO_INCREMENT,
  `nb_jours` int unsigned NOT NULL,
  `annee` year NOT NULL,
  `empid` int unsigned NOT NULL,
  `typeid` int NOT NULL,
  PRIMARY KEY (`droitsid`),
  KEY `empid` (`empid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `droits_conges_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE,
  CONSTRAINT `droits_conges_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `droits_conges`
--

LOCK TABLES `droits_conges` WRITE;
/*!40000 ALTER TABLE `droits_conges` DISABLE KEYS */;
INSERT INTO `droits_conges` VALUES (1,11,2023,1,1),(2,15,2023,1,2),(3,45,2022,2,1),(4,15,2022,2,2),(5,45,2022,3,1),(6,15,2022,3,2),(7,45,2023,4,1),(8,15,2023,4,2),(9,45,2023,5,1),(10,15,2023,5,2),(11,99,2023,1,3),(12,100,2023,2,3),(13,100,2023,3,3),(14,100,2023,4,3),(15,100,2023,5,3),(16,45,2023,6,1),(17,15,2023,6,2),(18,100,2023,6,3);
/*!40000 ALTER TABLE `droits_conges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employe`
--

DROP TABLE IF EXISTS `employe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employe` (
  `empid` int unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `mdpass` varchar(50) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `horid` int NOT NULL,
  `servid` int NOT NULL,
  `fonctid` int NOT NULL,
  PRIMARY KEY (`empid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ident` (`ident`),
  KEY `horid` (`horid`),
  KEY `servid` (`servid`),
  KEY `fonctid` (`fonctid`),
  CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`horid`) REFERENCES `mod_horaire` (`horid`),
  CONSTRAINT `employe_ibfk_2` FOREIGN KEY (`servid`) REFERENCES `service` (`servid`),
  CONSTRAINT `employe_ibfk_3` FOREIGN KEY (`fonctid`) REFERENCES `fonction` (`fonctid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employe`
--

LOCK TABLES `employe` WRITE;
/*!40000 ALTER TABLE `employe` DISABLE KEYS */;
INSERT INTO `employe` VALUES (1,'Blanca','Vincent','vinceblanca@gmail.com','vince','bitonio','2022-11-10',5,2,5),(2,'Coco','Laurent','lolococo@gmail.com','koko','koko','2022-12-01',5,2,2),(3,'Test','Alex','alex@yahoo.fr','test','test','2022-12-01',3,2,4),(4,'Vijeyalingam','Arvinth','arvinth.vijeyalingam@dgfip.finances.gouv.fr','arv','arv','2023-01-19',5,2,2),(5,'Blanchard','Andrée','andreeblanchard@gmail.com','andrée.blanchard','bienvenue','2023-04-05',5,2,7),(6,'Test Tt','Vince','vincett@gmail.com','vince.testtt','bienvenue','2023-08-04',5,2,1);
/*!40000 ALTER TABLE `employe` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `employe_ai` AFTER INSERT ON `employe` FOR EACH ROW INSERT INTO droits_conges (empid, annee, nb_jours, typeid) VALUES (NEW.empid, YEAR(NOW()), 45, 1), (NEW.empid, YEAR(NOW()), 15, 2), (NEW.empid, YEAR(NOW()), 100, 3) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fonction` (
  `fonctid` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `servid` int NOT NULL,
  PRIMARY KEY (`fonctid`),
  KEY `servid` (`servid`),
  CONSTRAINT `fonction_ibfk_1` FOREIGN KEY (`servid`) REFERENCES `service` (`servid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonction`
--

LOCK TABLES `fonction` WRITE;
/*!40000 ALTER TABLE `fonction` DISABLE KEYS */;
INSERT INTO `fonction` VALUES (1,'Développeur',2),(2,'Analyste',2),(3,'Chef de projet',2),(4,'Adm. réseau',2),(5,'Adm. base de données',2),(6,'Secrétaire',1),(7,'Assistant RH',1);
/*!40000 ALTER TABLE `fonction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mod_horaire`
--

DROP TABLE IF EXISTS `mod_horaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mod_horaire` (
  `horid` int NOT NULL AUTO_INCREMENT,
  `hormod` time NOT NULL,
  PRIMARY KEY (`horid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mod_horaire`
--

LOCK TABLES `mod_horaire` WRITE;
/*!40000 ALTER TABLE `mod_horaire` DISABLE KEYS */;
INSERT INTO `mod_horaire` VALUES (1,'07:00:00'),(2,'07:14:00'),(3,'07:30:00'),(4,'07:36:00'),(5,'07:42:00');
/*!40000 ALTER TABLE `mod_horaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pointage`
--

DROP TABLE IF EXISTS `pointage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pointage` (
  `pointid` int NOT NULL AUTO_INCREMENT,
  `pointdate` date NOT NULL,
  `h_arrivee` time NOT NULL,
  `h_mer1` time NOT NULL,
  `h_mer2` time NOT NULL,
  `h_depart` time NOT NULL,
  `empid` int unsigned NOT NULL,
  PRIMARY KEY (`pointid`),
  KEY `empid` (`empid`),
  CONSTRAINT `pointage_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pointage`
--

LOCK TABLES `pointage` WRITE;
/*!40000 ALTER TABLE `pointage` DISABLE KEYS */;
INSERT INTO `pointage` VALUES (1,'2022-11-10','08:30:00','11:55:00','12:30:00','18:00:00',1),(2,'2022-11-02','07:30:00','11:55:00','12:30:00','18:00:00',1),(3,'2022-12-30','09:07:00','11:56:00','12:36:00','17:35:00',1),(4,'2023-04-21','08:30:00','12:30:00','13:15:00','17:12:00',5),(5,'2023-07-21','08:10:00','11:50:00','12:30:00','17:00:00',1);
/*!40000 ALTER TABLE `pointage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `servid` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`servid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Administratif'),(2,'Informatique');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_conge`
--

DROP TABLE IF EXISTS `type_conge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_conge` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_conge`
--

LOCK TABLES `type_conge` WRITE;
/*!40000 ALTER TABLE `type_conge` DISABLE KEYS */;
INSERT INTO `type_conge` VALUES (1,'Congés'),(2,'Formation'),(3,'Télétravail');
/*!40000 ALTER TABLE `type_conge` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-23  9:06:13
