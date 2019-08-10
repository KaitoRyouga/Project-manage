-- MySQL dump 10.16  Distrib 10.1.40-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: kho2
-- ------------------------------------------------------
-- Server version	10.1.40-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ITEM_CODE` varchar(255) NOT NULL,
  `ITEM` varchar(255) NOT NULL,
  `QUANTITY` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Zggb','asd','1'),(2,'ZbWE','asddddaw','9'),(3,'gale','fds','12'),(4,'bgal','aoquan1','16'),(5,'1SIY','go4','15'),(6,'XkBG','gon','65'),(7,'ZWYZ','sp5','9');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MAIL` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `FNAME` varchar(255) NOT NULL,
  `PASS` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'a','b','c','d'),(3,'q','w','e','r'),(4,'1','w','4','r'),(5,'1','w','4','r'),(6,'1','w','4','r'),(7,'1','w','4','r'),(8,'1','w','4','r'),(9,'1','w','4','r'),(10,'1','w','4','r'),(11,'1','w','4','r'),(12,'1','w','4','r'),(13,'1','w','4','r'),(14,'1','w','4','r'),(15,'1','w','4','r'),(16,'1','w','4','r'),(17,'1','w','4','r'),(18,'1','w','4','r'),(19,'1','w','4','r'),(20,'1','w','4','r'),(21,'1','w','4','r'),(22,'1','w','4','r'),(23,'1','w','4','r'),(24,'1','w','4','r'),(25,'kaito','kkmkm','fasf','aff'),(26,'kaito','kkmkm','fasf','aff'),(27,'kaito','kkmkm','fasf','aff'),(28,'kaito','kkmkm','fasf','aff'),(29,'a','b','c','d'),(30,'kaito1477800@gmail.com','','',''),(31,'kaito1477800@gmail.com','','',''),(32,'kaito1477800@gmail.com','','',''),(33,'kaito1477800@gmail.com','','',''),(34,'','','',''),(35,'kaito1477800@gmail.com','','',''),(36,'kaito1477800@gmail.com','','',''),(37,'','Grasso','James','fxhN8V&#V@AJ8(HK*h^f'),(38,'','Grasso','James','fxhN8V&#V@AJ8(HK*h^f'),(39,'','Grasso','James','fs'),(40,'','Grasso','James','g'),(41,'','Grassofasf','James','asdf'),(42,'','Grasso','James','k'),(43,'','Ryouga','Kaito','aaaaaa'),(44,'','Grasso','James','k'),(45,'','Grasso','James','fxhN8V&#V@AJ8(HK*h^f'),(46,'kaito1477800@gmail.com','Grasso','James','fxhN8V&#V@AJ8(HK*h^f'),(47,'kaito1477800@gmail.com','Grasso','James','k'),(48,'kaito1477800@gmail.com','Grasso','James','j'),(49,'kaito@gmail.com','ryouga','kaito','aaaaaa'),(50,'b52a306574@mailboxy.fun','Ryouga','Kaito','j'),(51,'kaito1477800@gmail.com','','',''),(52,'kaito1477800@gmail.com','','',''),(53,'kaito1477800@gmail.com','','',''),(54,'kaito1477800@gmail.com','','',''),(55,'kaito1477800@gmail.com','Grasso','James',''),(56,'kaito1477800@gmail.com','Grasso','James','fxhN8V&#V@AJ8(HK*h^f'),(57,'kaito1477800@gmail.com','Grasso','James','k'),(58,'kaito@gmail.com','ryouga','kaito','j'),(59,'kaito@gmail.com','ryouga','kaito','fxhN8V&#V@AJ8(HK*h^f'),(60,'b52a306574@mailboxy.fun','Ryouga','Kaito','j'),(61,'b52a306574@mailboxy.fun','Ryouga','Kaito','fxhN8V&#V@AJ8(HK*h^f'),(62,'b52a306574@mailboxy.fun','Ryouga','Kaito','fxhN8V&#V@AJ8(HK*h^f'),(63,'kaito@gmail.com','ryouga','kaito','aaaaaa'),(64,'b52a306574@mailboxy.fun','Ryouga','Kaito','j'),(65,'k','k','k','k'),(66,'b52a306574@mailboxy.fun','Ryouga','Kaito','j'),(67,'b52a306574@mailboxy.fun','Ryouga','Kaito','$2y$10$lhlyg3AqwjrkM7WkkyCYNeTLxGjC7xMssv5UEJ7Zk9/eH4Mz9VTii'),(68,'kaito0407@ryouga.com','ryouga07','kaito04','$2y$10$DgmMxM8/GUbPS3aXQvEF..6YWwo8QWaVn39RuIi/ufnFR6fF7g7Dy'),(69,'kaito@ryouga.com.vn','l','k','$2y$10$ploCZHuWKCsUdyV0Gw71vuy4T3kGRMQhjUmH5/KBnhTtzI/mm6wU.'),(70,'kaito1477800@gmail.com','g','g','$2y$10$Pg1r4S.rPsP8cqw1tq.faecaGaSl4VAfQPUkQZDJ0pcxu1vQruEFe'),(71,'t','h','a','n'),(72,'t','h','a','n'),(73,'t','h','a','n');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-10 14:48:46
