-- MariaDB dump 10.17  Distrib 10.4.10-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: rehab
-- ------------------------------------------------------
-- Server version	10.4.10-MariaDB

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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_a_id` bigint(20) DEFAULT NULL,
  `user_b_id` bigint(20) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (28,1,3,'Chào Bs Mận','2022-06-06 15:44:22','2022-06-06 15:44:22'),(29,1,4,'Chào bác sĩ Đỗ Doãn Lợi','2022-06-06 15:44:39','2022-06-06 15:44:39'),(51,2,3,'alo','2022-06-10 04:20:39','2022-06-10 04:20:39'),(140,1,2,'chào bác sĩ','2022-06-10 12:28:39','2022-06-10 12:28:39'),(141,2,1,'chào bạn','2022-06-10 12:28:45','2022-06-10 12:28:45'),(142,1,2,'alo','2022-06-10 12:31:24','2022-06-10 12:31:24'),(143,1,2,'test','2022-06-10 12:31:34','2022-06-10 12:31:34'),(144,2,1,'ok','2022-06-10 12:31:43','2022-06-10 12:31:43'),(145,1,2,'1','2022-06-10 12:31:47','2022-06-10 12:31:47'),(147,2,1,'2','2022-06-10 12:31:54','2022-06-10 12:31:54'),(219,1,2,'ok','2022-06-25 03:34:24','2022-06-25 03:34:24'),(220,1,10,'hello','2022-06-25 10:56:42','2022-06-25 10:56:42'),(221,1,26,'hi','2022-06-25 11:30:23','2022-06-25 11:30:23'),(222,1,25,'xin chào','2022-06-25 11:30:31','2022-06-25 11:30:31'),(223,1,24,'hello','2022-06-25 11:30:45','2022-06-25 11:30:45'),(239,2,1,'? Nguyễn Thanh Liêm đã gọi cho bạn','2022-07-01 17:10:05','2022-07-01 17:10:05'),(240,2,1,'? Nguyễn Thanh Liêm đã gọi cho bạn','2022-07-02 07:36:51','2022-07-02 07:36:51'),(241,2,1,'? Nguyễn Thanh Liêm đã gọi cho bạn','2022-07-02 10:16:10','2022-07-02 10:16:10');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-02 17:19:46
