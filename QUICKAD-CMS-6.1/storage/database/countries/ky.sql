-- MySQL dump 10.13  Distrib 5.5.42, for osx10.6 (i386)
--
-- Host: localhost    Database: laraclassified
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Dumping data for table `<<prefix>>subadmin1`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin1` DISABLE KEYS */;
INSERT IGNORE INTO `<<prefix>>subadmin1` VALUES (1612,'KY.10346796','George Town','George Town',1);
INSERT IGNORE INTO `<<prefix>>subadmin1` VALUES (1613,'KY.10375968','West Bay','West Bay',1);
INSERT IGNORE INTO `<<prefix>>subadmin1` VALUES (1614,'KY.10375969','Bodden Town','Bodden Town',1);
INSERT IGNORE INTO `<<prefix>>subadmin1` VALUES (1615,'KY.10375970','North Side','North Side',1);
INSERT IGNORE INTO `<<prefix>>subadmin1` VALUES (1616,'KY.10375971','East End','East End',1);
INSERT IGNORE INTO `<<prefix>>subadmin1` VALUES (1617,'KY.10375972','Sister Island','Sister Island',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT IGNORE INTO `<<prefix>>cities` VALUES (3580477,'KY','West Bay','West Bay',-81.4167,19.3667,'P','PPLA','10375968','',11269,'America/Cayman',1,NULL,NULL);
INSERT IGNORE INTO `<<prefix>>cities` VALUES (3580575,'KY','North Side','North Side',-81.2,19.35,'P','PPLA','10375970','',1184,'America/Cayman',1,NULL,NULL);
INSERT IGNORE INTO `<<prefix>>cities` VALUES (3580661,'KY','George Town','George Town',-81.3744,19.2866,'P','PPLC','10346796','',29370,'America/Cayman',1,NULL,NULL);
INSERT IGNORE INTO `<<prefix>>cities` VALUES (3580678,'KY','East End','East End',-81.1167,19.3,'P','PPLA','10375971','',1639,'America/Cayman',1,NULL,NULL);
INSERT IGNORE INTO `<<prefix>>cities` VALUES (3580733,'KY','Bodden Town','Bodden Town',-81.2542,19.2765,'P','PPLA','10375969','',10341,'America/Cayman',1,NULL,NULL);
INSERT IGNORE INTO `<<prefix>>cities` VALUES (9294258,'KY','Little Cayman','Little Cayman',-80.1098,19.6611,'P','PPLA','10375972','',0,'America/Cayman',1,NULL,NULL);
/*!40000 ALTER TABLE `<<prefix>>cities` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
