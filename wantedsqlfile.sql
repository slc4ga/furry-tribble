-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: slc4ga
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `admins`
--

--
-- Table structure for table `bands`
--

DROP TABLE IF EXISTS `bands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qr_code` int(10) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bands`
--

LOCK TABLES `bands` WRITE;
/*!40000 ALTER TABLE `bands` DISABLE KEYS */;
INSERT INTO `bands` VALUES (1,1234,1),(2,12345,1),(3,-1,1),(4,1324,1),(5,13455,1);
/*!40000 ALTER TABLE `bands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flagged` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (12,4,3,'comment on  band 3','2015-03-11 22:39:19',1),(13,4,3,'johns band','2015-03-11 22:41:21',0),(14,4,3,'johns band\r\n','2015-03-11 22:41:27',0),(15,4,3,'johns band\r\n','2015-03-11 22:41:30',0),(16,4,3,'johns band\r\n','2015-03-11 22:41:32',0),(17,4,3,'19032i\r\nsdfjsidjf\r\ndsfjilsjdf\r\nsdlfkaldsjf','2015-03-11 22:41:42',0),(18,4,3,'what happens if I have a really really long comment...\r\noiasjdfopiajdsfpoiajdspfoijadspfoijadspoifjpsadpidsojgpsoidspoidjfoisadjfsaoidjfapoisdjfpaoidsjfapoidjfapoidsjfapoijdsf\r\nsdiofjaoidsjf','2015-03-11 22:42:07',0),(19,4,3,'what happens if I have a really really long comment...\r\nnkjdlkwnd','2015-03-11 22:42:24',0),(20,4,3,'1','2015-03-11 22:42:31',0),(21,4,3,'1','2015-03-11 22:42:35',0),(22,4,3,'1','2015-03-11 22:42:37',0),(23,4,3,'1','2015-03-11 22:42:38',0),(24,4,3,'1','2015-03-11 22:42:40',0),(25,4,3,'1','2015-03-11 22:42:42',0),(26,4,3,'1','2015-03-11 22:42:43',0),(27,4,3,'1','2015-03-11 22:42:45',0),(28,4,3,'1','2015-03-11 22:42:47',0),(29,4,3,'1','2015-03-11 22:42:49',0),(30,4,3,'1','2015-03-11 22:42:51',0),(31,4,3,'1','2015-03-11 22:42:53',0),(32,4,3,'1','2015-03-11 22:42:55',0),(33,4,3,'1','2015-03-11 22:42:57',0),(34,4,3,'1','2015-03-11 22:42:59',0),(35,4,3,'1','2015-03-11 22:43:01',0),(36,4,2,'hguoih','2015-03-11 22:43:37',0),(37,4,3,'hgvugv','2015-03-11 22:43:53',0),(38,4,1,'hb,hb','2015-03-11 22:45:08',0),(39,4,4,'aeffff','2015-03-11 22:48:37',0),(40,4,1,'aefff','2015-03-11 22:48:54',0),(42,4,5,'aeffff','2015-03-11 22:50:19',0),(43,4,5,'aeffff','2015-03-11 22:50:19',0),(44,4,5,'aeffff','2015-03-11 22:51:07',0),(45,4,5,'aeffff','2015-03-11 22:51:07',0),(46,4,3,'adsf','2015-03-11 22:52:04',0),(47,4,5,'fsdfdf','2015-03-11 22:53:08',0),(48,1,1,'Igxtisigx','2015-03-16 18:40:39',0),(50,1,1,'123 activate','2015-03-17 02:03:56',0),(51,1,1,'sdjhasdf','2015-04-08 20:32:54',0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `setting` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('comments','6',1),('days','21',2);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_likes`
--

DROP TABLE IF EXISTS `user_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_likes` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_likes`
--

LOCK TABLES `user_likes` WRITE;
/*!40000 ALTER TABLE `user_likes` DISABLE KEYS */;
INSERT INTO `user_likes` VALUES (4,12),(4,38);
/*!40000 ALTER TABLE `user_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'slc4ga',1),(2,'mdv3kt',1),(3,'jds5vy',0),(4,'jdv3hn',1),(5,'gjd2gd',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-08 21:45:21
