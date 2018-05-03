-- MySQL dump 10.16  Distrib 10.1.30-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: collective
-- ------------------------------------------------------
-- Server version	10.1.30-MariaDB

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
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `loginid` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) NOT NULL,
  `user` varchar(256) NOT NULL,
  `date` datetime NOT NULL,
  `action` varchar(10) NOT NULL,
  PRIMARY KEY (`loginid`)
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'198.18.8.122','admin','2018-04-12 22:00:41','fail'),(2,'198.18.8.122','admin','2018-04-17 17:19:48','pass'),(3,'198.18.8.122','admin','2018-04-17 18:35:54','pass'),(4,'198.18.8.122','admin','2018-04-17 18:49:16','pass'),(5,'198.18.8.122','admin','2018-04-17 18:50:03','pass'),(6,'198.18.8.122','admin','2018-04-17 18:50:52','pass'),(7,'198.18.8.122','ralphie','2018-04-17 18:53:51','pass'),(8,'198.18.8.122','admin','2018-04-17 18:55:27','pass'),(9,'198.18.8.122','admin','2018-04-17 18:56:15','pass'),(10,'198.18.8.122','admin','2018-04-17 19:11:27','pass'),(11,'198.18.8.122','parksjg','2018-04-17 19:12:12','pass'),(12,'198.18.8.122','parksjg','2018-04-17 19:20:49','pass'),(13,'198.18.8.122','ralphie','2018-04-17 19:22:30','pass'),(14,'198.18.8.122','ralphie','2018-04-17 19:23:13','pass'),(15,'198.18.8.122','ralphie','2018-04-17 20:14:38','pass'),(16,'198.18.8.122','ralphie','2018-04-17 20:54:10','pass'),(17,'198.18.8.122','ralphie','2018-04-17 20:58:32','pass'),(18,'198.18.8.122','ralphie','2018-04-17 21:01:07','pass'),(19,'198.18.8.122','ralphie','2018-04-17 21:27:24','pass'),(20,'198.18.8.122','ralphie','2018-04-19 17:08:42','pass'),(21,'198.18.8.122','ralphie','2018-04-19 17:21:04','pass'),(22,'198.18.8.122','ralphie','2018-04-19 17:25:24','pass'),(23,'198.18.8.122','ralphie','2018-04-19 17:26:41','pass'),(24,'198.18.8.122','parksjg','2018-04-19 17:43:33','pass'),(25,'198.18.8.122','ralphie','2018-04-19 18:00:58','pass'),(26,'198.18.8.122','parksjg','2018-04-19 18:06:12','pass'),(27,'198.18.8.122','ralphie','2018-04-19 18:11:56','pass'),(28,'198.18.8.122','ralphie','2018-04-19 18:17:56','pass'),(29,'198.18.8.122','admin','2018-04-23 22:29:23','fail'),(30,'198.18.8.122','admin','2018-04-23 22:30:04','pass'),(31,'198.18.8.122','ralphie','2018-04-23 22:32:08','pass'),(32,'198.18.8.122','ralphie','2018-04-23 22:54:02','pass'),(33,'198.18.8.122','ralphie','2018-04-23 23:05:05','pass'),(34,'198.18.8.122','ralphie','2018-04-23 23:11:13','pass'),(35,'198.18.8.122','ralphie','2018-04-23 23:18:34','pass'),(36,'198.18.8.122','parksjg','2018-04-23 23:20:42','pass'),(37,'198.18.8.122','ralphie','2018-04-24 14:38:27','pass'),(38,'198.18.8.122','ralphie','2018-04-24 17:47:42','pass'),(39,'198.18.8.122','ralphie','2018-04-24 17:50:39','pass'),(40,'198.18.8.122','ralphie','2018-04-24 17:58:40','pass'),(41,'198.18.8.122','ralphie','2018-04-24 18:31:05','pass'),(42,'198.18.8.122','ralphie','2018-04-24 18:35:30','pass'),(43,'198.18.8.122','ralphie','2018-04-25 14:15:08','pass'),(44,'198.18.8.122','ralphie','2018-04-25 14:20:55','pass'),(45,'198.18.8.122','ralphie','2018-04-25 21:34:59','pass'),(46,'198.18.8.122','ralphie','2018-04-25 22:14:52','pass'),(47,'198.18.8.122','ralphie','2018-04-25 22:17:40','pass'),(48,'198.18.8.122','ralphie','2018-04-26 14:13:43','pass'),(49,'198.18.8.122','ralphie','2018-04-26 14:52:43','pass'),(50,'198.18.8.122','ralphie','2018-04-26 20:46:38','pass'),(51,'198.18.8.122','ralphie','2018-04-26 20:52:10','pass'),(52,'198.18.8.122','ralphie','2018-04-26 20:57:01','pass'),(53,'198.18.8.122','ralphie','2018-04-26 21:02:40','pass'),(54,'198.18.8.122','parksjg','2018-04-26 21:09:05','pass'),(55,'198.18.8.122','ralphie','2018-04-26 21:12:10','pass'),(56,'198.18.8.122','ralphie','2018-04-26 21:13:50','pass'),(57,'198.18.8.122','ralphie','2018-04-26 21:41:19','pass'),(58,'198.18.8.122','ralphie','2018-04-26 21:44:00','pass'),(59,'198.18.8.122','ralphie','2018-04-26 21:46:37','pass'),(60,'198.18.8.122','admin','2018-04-26 22:04:25','pass'),(61,'198.18.8.122','nimda','2018-04-26 22:05:26','pass'),(62,'198.18.8.122','ralphie','2018-04-26 22:07:21','pass'),(63,'198.18.8.122','parksjg','2018-04-26 22:11:42','pass'),(64,'198.18.8.122','nimda','2018-04-26 22:12:07','pass'),(65,'198.18.8.122','nimda','2018-04-26 22:17:34','pass'),(66,'198.18.8.122','ralphie','2018-04-26 22:18:35','pass'),(67,'198.18.8.122','ralphie','2018-04-26 22:20:28','pass'),(68,'198.18.8.122','ralphie','2018-04-26 22:25:36','pass'),(69,'198.18.8.122','parksjg','2018-04-26 22:29:39','pass'),(70,'198.18.8.122','parksjg','2018-04-26 22:31:36','pass'),(71,'198.18.8.122','parksjg','2018-04-26 22:35:43','pass'),(72,'198.18.8.122','nimda','2018-04-26 22:37:11','pass'),(73,'198.18.8.122','ralphie','2018-04-26 22:47:49','pass'),(74,'198.18.8.122','nimda','2018-04-26 22:49:48','pass'),(75,'198.18.8.122','parksjg','2018-04-26 22:51:27','pass'),(76,'198.18.8.122','ralphie','2018-04-26 22:53:18','pass'),(77,'198.18.8.122','ralphie','2018-04-27 19:20:00','pass'),(78,'198.18.8.122','parksjg','2018-04-27 19:22:09','pass'),(79,'198.18.8.122','nimda','2018-04-27 19:22:44','pass'),(80,'198.18.8.122','nimda','2018-04-27 19:25:33','pass'),(81,'198.18.8.122','parksjg','2018-04-27 19:38:42','pass'),(82,'198.18.8.122','parksjg','2018-04-27 19:41:15','pass'),(83,'198.18.8.122','parksjg','2018-04-27 20:10:28','pass'),(84,'198.18.8.122','parksjg','2018-04-27 20:14:53','pass'),(85,'198.18.8.122','parksjg','2018-04-27 20:17:51','pass'),(86,'198.18.8.122','ralphie','2018-04-27 20:20:50','pass'),(87,'198.18.8.122','parksjg','2018-04-27 20:33:17','pass'),(88,'198.18.8.122','parksjg','2018-04-27 20:48:36','pass'),(89,'198.18.8.122','nimda','2018-04-27 21:00:19','pass'),(90,'198.18.8.122','parksjg','2018-04-27 21:00:58','pass'),(91,'198.18.8.122','nimda','2018-04-27 21:13:26','pass'),(92,'198.18.8.122','ralphie','2018-04-27 21:13:51','pass'),(93,'198.18.8.122','ralphie','2018-04-27 21:40:11','pass'),(94,'198.18.8.122','parksjg','2018-04-27 21:42:03','pass'),(95,'198.18.8.122','ralphie','2018-04-27 21:44:07','pass'),(96,'198.18.8.122','parksjg','2018-04-27 21:44:39','pass'),(97,'198.18.8.122','ralphie','2018-04-27 21:45:01','pass'),(98,'198.18.8.122','parksjg','2018-04-27 21:45:36','pass'),(99,'198.18.8.122','ralphie','2018-04-27 21:55:32','pass'),(100,'198.18.8.122','nimda','2018-04-27 21:56:18','pass'),(101,'198.18.8.122','parksjg','2018-04-27 21:57:24','pass'),(102,'198.18.8.122','parksjg','2018-04-27 22:23:48','pass'),(103,'198.18.8.122','parksjg','2018-04-27 22:25:27','pass'),(104,'198.18.8.122','parksjg','2018-04-27 22:28:03','pass'),(105,'198.18.8.122','ralphie','2018-04-27 22:37:05','pass'),(106,'198.18.8.122','parksjg','2018-04-27 22:39:43','pass'),(107,'198.18.8.122','ralphie','2018-04-27 22:50:51','pass'),(108,'198.18.8.122','parksjg','2018-04-27 23:00:49','pass'),(109,'198.18.8.122','ralphie','2018-04-27 23:09:10','pass'),(110,'198.18.8.122','ralphie','2018-04-27 23:11:26','pass'),(111,'198.18.8.122','ralphie','2018-04-27 23:12:32','pass'),(112,'198.18.8.122','ralphie','2018-04-27 23:22:53','pass'),(113,'198.18.8.122','ralphie','2018-04-27 23:29:04','pass'),(114,'198.18.8.122','ralphie','2018-04-27 23:38:14','pass'),(115,'198.18.8.122','ralphie','2018-04-27 23:38:23','pass'),(116,'198.18.8.122','ralphie','2018-04-27 23:39:53','pass'),(117,'198.18.8.122','parksjg','2018-04-28 00:05:26','pass'),(118,'198.18.8.122','nimda','2018-04-28 00:05:46','fail'),(119,'198.18.8.122','nimda','2018-04-28 00:05:51','pass'),(120,'198.18.8.122','ralphie','2018-04-28 00:19:25','pass'),(121,'198.18.8.122','parksjg','2018-04-28 00:50:06','pass'),(122,'198.18.8.122','parksjg','2018-04-28 01:12:09','pass'),(123,'198.18.8.122','ralphie','2018-04-28 01:33:03','pass'),(124,'198.18.8.122','ralphie','2018-04-28 01:35:06','pass'),(125,'198.18.8.122','parksjg','2018-04-28 01:54:32','pass'),(126,'198.18.8.122','ralphie','2018-04-28 01:55:21','pass'),(127,'198.18.8.122','nimda','2018-04-28 02:03:48','pass'),(128,'198.18.8.122','parksjg','2018-04-28 18:27:46','pass'),(129,'198.18.8.122','ralphie','2018-04-28 18:41:48','pass'),(130,'198.18.8.122','ralphie','2018-04-28 21:12:46','pass'),(131,'198.18.8.122','parksjg','2018-04-28 21:16:25','pass'),(132,'198.18.8.122','admin','2018-04-28 21:17:20','pass'),(133,'198.18.8.122','parksjg','2018-04-28 21:33:36','pass'),(134,'198.18.8.122','nimda','2018-04-28 21:48:46','pass'),(135,'198.18.8.122','admin','2018-04-28 21:54:55','fail'),(136,'198.18.8.122','admin','2018-04-28 21:55:04','fail'),(137,'198.18.8.122','admin','2018-04-28 21:55:09','pass'),(138,'198.18.8.122','alice','2018-04-28 22:08:46','pass'),(139,'198.18.8.122','parksjg','2018-04-28 22:09:38','pass'),(140,'198.18.8.122','ralphie','2018-04-28 22:22:02','pass'),(141,'198.18.8.122','parksjg','2018-04-28 22:22:20','pass'),(142,'198.18.8.122','alice','2018-04-28 22:22:39','pass'),(143,'198.18.8.122','admin','2018-04-28 22:27:11','pass'),(144,'198.18.8.122','parksjg','2018-04-28 22:29:29','pass'),(145,'198.18.8.122','admin','2018-04-28 22:30:40','pass'),(146,'198.18.8.122','parksjg','2018-04-28 22:53:37','pass'),(147,'198.18.8.122','alice','2018-04-28 22:57:37','fail'),(148,'198.18.8.122','admin','2018-04-28 22:57:44','pass'),(149,'198.18.8.122','ralphie','2018-04-28 23:05:30','pass'),(150,'198.18.8.122','admin','2018-04-28 23:09:46','pass'),(151,'198.18.8.122','alice','2018-04-28 23:10:23','fail'),(152,'198.18.8.122','admin','2018-04-28 23:10:34','pass'),(153,'198.18.8.122','skrap','2018-04-28 23:11:07','pass'),(154,'198.18.8.122','parksjg','2018-04-28 23:14:12','pass'),(155,'198.18.8.122','ralphie','2018-04-28 23:14:50','pass'),(156,'198.18.8.122','parksjg','2018-04-28 23:15:32','pass'),(157,'198.18.8.122','parksjg','2018-04-28 23:46:50','pass'),(158,'198.18.8.122','alice','2018-04-28 23:50:57','pass'),(159,'198.18.8.122','parksjg','2018-04-28 23:51:47','pass'),(160,'198.18.8.122','alice','2018-04-29 00:00:53','pass'),(161,'198.18.8.122','ralphie','2018-04-29 00:06:40','pass'),(162,'198.18.8.122','admin','2018-04-29 00:08:32','pass'),(163,'198.18.8.122','alice','2018-04-29 00:10:44','pass'),(164,'198.18.8.122','skrap','2018-04-29 00:13:35','pass'),(165,'198.18.8.122','ralphie','2018-04-29 00:14:12','pass'),(166,'198.18.8.122','nimda','2018-04-29 00:14:51','pass'),(167,'198.18.8.122','alice','2018-04-29 00:15:48','pass'),(168,'198.18.8.122','parksjg','2018-04-29 00:33:59','pass'),(169,'198.18.8.122','admin','2018-04-29 00:42:35','pass'),(170,'198.18.8.122','parksjg','2018-04-29 00:47:41','pass'),(171,'198.18.8.122','admin','2018-04-29 16:48:51','pass'),(172,'198.18.8.122','admin','2018-04-29 18:08:07','pass'),(173,'198.18.8.122','parksjg','2018-04-29 18:23:51','pass'),(174,'198.18.8.122','parksjg','2018-04-29 19:24:12','pass'),(175,'198.18.8.122','parksjg','2018-04-29 19:58:42','pass'),(176,'198.18.8.122','admin','2018-04-29 20:02:14','pass'),(177,'198.18.8.122','skrap','2018-04-29 20:07:01','pass'),(178,'198.18.8.122','parksjg','2018-04-29 20:07:50','pass'),(179,'198.18.8.122','skrap','2018-04-29 20:08:32','pass'),(180,'198.18.8.122','alice','2018-04-29 20:09:37','pass'),(181,'198.18.8.122','skrap','2018-04-29 20:41:06','pass'),(182,'198.18.8.122','skrap','2018-04-29 20:44:27','fail'),(183,'198.18.8.122','alice','2018-04-29 20:44:33','pass'),(184,'198.18.8.122','admin','2018-04-29 20:45:34','pass'),(185,'198.18.8.122','skrap','2018-04-29 20:47:52','pass'),(186,'198.18.8.122','alice','2018-04-29 20:49:41','pass'),(187,'198.18.8.122','skrap','2018-04-29 20:50:18','pass'),(188,'198.18.8.122','skrap','2018-04-29 20:51:17','fail'),(189,'198.18.8.122','admin','2018-04-29 20:51:25','pass'),(190,'198.18.8.122','skrap','2018-04-29 20:51:39','pass'),(191,'198.18.8.122','admin','2018-04-29 20:53:02','pass'),(192,'198.18.8.122','skrap','2018-04-29 20:53:15','pass'),(193,'198.18.8.122','admin','2018-04-29 20:55:56','pass'),(194,'198.18.8.122','skrap','2018-04-29 20:59:41','pass'),(195,'198.18.8.122','user','2018-04-29 21:00:16','pass'),(196,'198.18.8.122','admin','2018-04-29 21:03:10','pass'),(197,'198.18.8.122','admin','2018-04-29 21:03:24','pass'),(198,'198.18.8.122','parksjg','2018-04-29 21:03:52','pass'),(199,'198.18.8.122','admin','2018-04-29 21:28:57','pass'),(200,'198.18.8.122','joe','2018-04-29 21:29:45','pass'),(201,'198.18.8.122','alice','2018-04-29 21:31:17','pass'),(202,'198.18.8.122','ralphie','2018-04-29 21:32:06','pass'),(203,'198.18.8.122','nimda','2018-04-29 21:32:51','pass'),(204,'198.18.8.122','joe','2018-04-29 21:47:30','pass'),(205,'198.18.8.122','nimda','2018-04-29 21:47:43','pass'),(206,'198.18.8.122','joe','2018-04-29 21:48:04','pass'),(207,'198.18.8.122','nimda','2018-04-29 21:48:38','pass'),(208,'198.18.8.122','joe','2018-04-29 21:49:42','pass'),(209,'198.18.8.122','admin','2018-04-29 21:50:21','pass'),(210,'198.18.8.122','joe','2018-04-29 21:57:36','pass'),(211,'198.18.8.122','admin','2018-04-29 21:59:02','pass'),(212,'198.18.8.122','joe','2018-04-29 22:25:04','pass'),(213,'198.18.8.122','alice','2018-04-29 22:28:00','pass'),(214,'198.18.8.122','admin','2018-04-29 22:37:25','pass'),(215,'198.18.8.122','joe','2018-04-29 22:37:34','pass'),(216,'198.18.8.122','admin','2018-04-29 22:44:31','pass'),(217,'198.18.8.122','joe','2018-04-29 22:48:10','pass'),(218,'198.18.8.122','joe','2018-04-29 23:16:49','pass'),(219,'198.18.8.122','admin','2018-04-29 23:22:43','pass'),(220,'198.18.8.122','admin','2018-04-29 23:23:20','pass'),(221,'198.18.8.122','admin','2018-04-29 23:23:28','fail'),(222,'198.18.8.122','admin','2018-04-29 23:23:34','pass'),(223,'198.18.8.122','admin','2018-04-29 23:23:50','pass'),(224,'198.18.8.122','nimda','2018-04-29 23:24:03','fail'),(225,'198.18.8.122','nimda','2018-04-29 23:24:08','pass'),(226,'198.18.8.122','nimda','2018-04-29 23:24:19','fail'),(227,'198.18.8.122','nimda','2018-04-29 23:24:23','fail'),(228,'198.18.8.122','nimda','2018-04-29 23:24:28','fail'),(229,'198.18.8.122','nimda','2018-04-29 23:24:34','pass'),(230,'198.18.8.122','nimda','2018-04-29 23:24:40','fail'),(231,'198.18.8.122','admin','2018-04-29 23:25:26','pass'),(232,'198.18.8.122','user','2018-04-29 23:27:05','fail'),(233,'198.18.8.122','admin','2018-04-29 23:27:11','pass'),(234,'198.18.8.122','joe','2018-04-29 23:44:18','pass'),(235,'198.18.8.122','ralphie','2018-04-29 23:46:56','pass'),(236,'198.18.8.122','alice','2018-04-29 23:48:13','pass'),(237,'198.18.8.122','joe','2018-04-29 23:48:52','pass'),(238,'198.18.8.122','joe','2018-04-29 23:49:57','fail'),(239,'198.18.8.122','alice','2018-04-29 23:50:05','pass'),(240,'198.18.8.122','admin','2018-04-29 23:50:25','pass'),(241,'198.18.8.122','joe','2018-04-29 23:50:59','pass'),(242,'198.18.8.122','alice','2018-04-29 23:51:39','pass'),(243,'198.18.8.122','ralphie','2018-04-30 10:02:26','pass'),(244,'198.18.8.122','admin','2018-04-30 15:29:37','pass'),(245,'198.18.8.122','joe','2018-04-30 15:31:43','pass'),(246,'198.18.8.122','alice','2018-04-30 15:33:39','pass'),(247,'198.18.8.122','joe','2018-04-30 15:34:26','pass'),(248,'198.18.8.122','joe','2018-04-30 15:34:47','pass'),(249,'198.18.8.122','ralphie','2018-04-30 22:43:46','pass'),(250,'198.18.8.122','admin','2018-04-30 22:46:21','pass'),(251,'198.18.8.122','admin','2018-04-30 22:58:24','pass'),(252,'198.18.8.122','admin','2018-05-01 09:12:35','pass'),(253,'198.18.8.122','joe','2018-05-01 09:13:06','pass'),(254,'198.18.8.122','admin','2018-05-01 10:19:23','pass'),(255,'198.18.8.122','joe','2018-05-01 10:20:16','pass'),(256,'198.18.8.122','joe','2018-05-01 10:20:54','pass'),(257,'198.18.8.122','alice','2018-05-01 10:21:04','pass'),(258,'198.18.8.122','joe','2018-05-01 10:21:20','pass'),(259,'198.18.8.122','alice','2018-05-01 10:21:28','pass'),(260,'198.18.8.122','admin','2018-05-01 10:21:40','pass'),(261,'198.18.8.122','joe','2018-05-01 10:22:59','pass'),(262,'198.18.8.122','admin','2018-05-01 10:23:28','pass'),(263,'198.18.8.122','joe','2018-05-01 10:23:39','pass'),(264,'198.18.8.122','joe','2018-05-01 10:23:51','fail'),(265,'198.18.8.122','alice','2018-05-01 10:23:59','pass'),(266,'198.18.8.122','admin','2018-05-01 10:42:33','pass'),(267,'198.18.8.122','admin','2018-05-01 11:18:51','fail'),(268,'198.18.8.122','admin','2018-05-01 11:18:54','fail'),(269,'198.18.8.122','alice','2018-05-01 11:19:20','pass'),(270,'198.18.8.122','admin','2018-05-01 11:19:26','pass'),(271,'198.18.8.122','alice','2018-05-01 11:19:53','pass'),(272,'198.18.8.122','admin','2018-05-01 11:20:43','pass'),(273,'198.18.8.122','joe','2018-05-01 11:39:20','pass'),(274,'198.18.8.122','admin','2018-05-01 11:39:51','pass'),(275,'198.18.8.122','alice','2018-05-01 11:40:04','pass'),(276,'198.18.8.122','admin','2018-05-01 11:41:15','pass'),(277,'198.18.8.122','joe','2018-05-01 11:41:40','pass'),(278,'198.18.8.122','ralphie','2018-05-01 11:42:02','pass'),(279,'198.18.8.122','alice','2018-05-01 11:42:46','pass'),(280,'198.18.8.122','joe','2018-05-01 11:42:56','pass'),(281,'198.18.8.122','admin','2018-05-01 11:48:17','pass'),(282,'198.18.8.122','alice','2018-05-01 11:48:50','pass'),(283,'198.18.8.122','admin','2018-05-01 12:07:15','pass'),(284,'198.18.8.122','admin','2018-05-01 12:38:06','pass'),(285,'198.18.8.122','joe','2018-05-01 14:27:04','pass'),(286,'198.18.8.122','joe','2018-05-01 15:08:32','pass'),(287,'198.18.8.122','joe','2018-05-01 15:53:55','pass'),(288,'198.18.8.122','alice','2018-05-01 15:54:11','pass'),(289,'198.18.8.122','ralphie','2018-05-01 15:54:21','pass'),(290,'198.18.8.122','admin','2018-05-01 15:56:18','pass'),(291,'198.18.8.122','joe','2018-05-01 15:57:01','pass'),(292,'198.18.8.122','alice','2018-05-01 15:57:35','pass'),(293,'198.18.8.122','ralphie','2018-05-01 15:58:02','pass'),(294,'198.18.8.122','joe','2018-05-01 16:11:24','pass'),(295,'198.18.8.122','admin','2018-05-01 16:26:59','fail'),(296,'198.18.8.122','admin','2018-05-01 16:27:04','pass'),(297,'198.18.8.122','joe','2018-05-01 16:34:04','pass'),(298,'198.18.8.122','joe','2018-05-01 16:59:51','pass'),(299,'198.18.8.122','admin','2018-05-01 17:05:07','pass'),(300,'198.18.8.122','admin','2018-05-01 17:05:28','pass'),(301,'198.18.8.122','joe','2018-05-01 17:06:09','pass'),(302,'198.18.8.122','nimda','2018-05-01 17:07:13','pass'),(303,'198.18.8.122','joe','2018-05-01 17:07:37','pass'),(304,'198.18.8.122','joe','2018-05-01 17:07:53','pass'),(305,'198.18.8.122','joe','2018-05-01 17:08:01','fail'),(306,'198.18.8.122','alice','2018-05-01 17:08:11','pass'),(307,'198.18.8.122','admin','2018-05-02 16:20:03','pass'),(308,'198.18.8.122','joe','2018-05-02 16:20:31','pass'),(309,'198.18.8.122','alice','2018-05-02 16:21:21','pass'),(310,'198.18.8.122','ralphie','2018-05-03 12:16:21','pass'),(311,'198.18.8.122','admin','2018-05-03 12:21:44','pass'),(312,'198.18.8.122','joe','2018-05-03 12:26:32','pass'),(313,'198.18.8.122','ralphie','2018-05-03 12:30:40','pass'),(314,'198.18.8.122','admin','2018-05-03 14:37:57','pass'),(315,'198.18.8.122','admin','2018-05-03 15:09:07','pass'),(316,'198.18.8.122','admin','2018-05-03 15:13:23','pass'),(317,'198.18.8.122','joe','2018-05-03 15:15:45','pass'),(318,'198.18.8.122','alice','2018-05-03 15:16:26','pass'),(319,'198.18.8.122','bob','2018-05-03 15:17:08','pass'),(320,'198.18.8.122','nimda','2018-05-03 15:17:48','pass'),(321,'198.18.8.122','bob','2018-05-03 15:18:23','pass');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sharedWith`
--

DROP TABLE IF EXISTS `sharedWith`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sharedWith` (
  `sharedWithid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `sharedusername` varchar(256) NOT NULL,
  PRIMARY KEY (`sharedWithid`),
  KEY `userid_idx` (`userid`),
  CONSTRAINT `swuserid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sharedWith`
--

LOCK TABLES `sharedWith` WRITE;
/*!40000 ALTER TABLE `sharedWith` DISABLE KEYS */;
INSERT INTO `sharedWith` VALUES (127,35,'alice'),(128,35,'bob'),(129,36,'joe'),(130,36,'bob'),(131,38,'joe'),(132,38,'alice'),(133,37,'joe'),(134,37,'bob'),(135,38,'nimda');
/*!40000 ALTER TABLE `sharedWith` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `storyid` int(11) NOT NULL AUTO_INCREMENT,
  `story` longtext NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`storyid`),
  KEY `userid_idx` (`userid`),
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (78,'emZBV3FTRXp0TnRPUWtyWk4zVURmV01HVUFoMnNMSDFOU3hHMHlrTG8vQT0=',35),(79,'SUdaMlQ1bE85QWFkNlZ4MUt6S2o5Y3Jvdng5eWFLd21sRENseHFYeklrST0=',36),(80,'MDRoTzJwSy9xWTY1b01YZlY2a202Y0sycHQzYUViMWF6L05Sc1RsQW9uYz0=',38),(81,'Szc2RHpCU3VoQ2dsYUpsb05MbURyeHFuK3BPaktQWFd4TEVaWHV5TzAzWT0=',37);
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(254) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','0465df62bf2f12467bb724c77a3ef22eb59dab8082e50567d3bbe3b5f7178ae4','52d98a612368acc0308b62d3fbd817802dff0d262f09f406d4044c0832795f0b','ralphie@colorado.edu'),(35,'joe','746060e3e5d5d8777cf804a2563242eada8671950ce473f4e340a69ef044cdd7','gVypWxvweZ6h9uLLaN4PcA0FFCBmixeiyUrvXb29042YnFUJHRGxItoC0TiLDxOy','jmail'),(36,'alice','55d1d724701c03bd1a06d2650cb70ba63bf8e6fcdb83626477fdc501dc8e3fee','qQro0REuyHZ4PtPy55cEnqLkNoDShNV7frEQWDkok0h3jas1LbggSCZ46Uw1078e','amail'),(37,'nimda','6aa6bedc2d03fa81286993b110f0692f5f171549beb82751f813f6724d0984dc','AslMs2mKEZ7fvU0FdEKztlpRZuEgY3iKiwqphHY8RlZOhetkrvQjcuxzhou0Myvh','nmail'),(38,'bob','a3b60d431f230c3d4c55c73b5069015ba76c07e324dcc250d20c333cdbe71a6d','gTiGyGZVkRxr3b62vRkeezuJJ2e1F4XNLpa02b2lcjtsNlVaSJyD0Jrk5X6Mn01A','bmail');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whitelist`
--

DROP TABLE IF EXISTS `whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whitelist` (
  `whitelistid` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) NOT NULL,
  PRIMARY KEY (`whitelistid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whitelist`
--

LOCK TABLES `whitelist` WRITE;
/*!40000 ALTER TABLE `whitelist` DISABLE KEYS */;
INSERT INTO `whitelist` VALUES (20,'0.0.0.0'),(23,'127.0.0.1'),(28,'');
/*!40000 ALTER TABLE `whitelist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-03 15:21:43
