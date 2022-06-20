-- MariaDB dump 10.17  Distrib 10.4.10-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: rehab
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
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('0af6c42f-189b-4641-ab8c-1400a0f9151e','App\\Notifications\\ReportComment','App\\Models\\User',10,'{\"post_id\":29,\"comment_id\":25,\"content\":\"c\\u01b0\\u1eddi g\\u00ec\",\"user_id\":2,\"comment_user_name\":\"Nguy\\u1ec5n Thanh Li\\u00eam\",\"comment_user_avatar\":\"..\\/..\\/uploads\\/62af2722e317612_01_2019_11_08_54_075889.jpeg\",\"user_name\":\"Nguy\\u1ec5n B\\u00e1 Qu\\u00e2n\",\"avatar\":\"..\\/..\\/uploads\\/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg\"}',NULL,'2022-06-20 08:36:58','2022-06-20 08:36:58'),('bdb896f7-1fa2-42fb-a0bf-9ef7e4cea837','App\\Notifications\\ReportComment','App\\Models\\User',10,'{\"post_id\":29,\"comment_id\":25,\"content\":\"c\\u01b0\\u1eddi g\\u00ec\",\"user_id\":2,\"comment_user_name\":\"Nguy\\u1ec5n Thanh Li\\u00eam\",\"comment_user_avatar\":\"..\\/..\\/uploads\\/62af2722e317612_01_2019_11_08_54_075889.jpeg\",\"user_name\":\"Nguy\\u1ec5n B\\u00e1 Qu\\u00e2n\",\"avatar\":\"..\\/..\\/uploads\\/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg\"}',NULL,'2022-06-20 08:28:28','2022-06-20 08:28:28'),('e917990d-453d-4619-80fb-0d1a1f609600','App\\Notifications\\ReportPost','App\\Models\\User',10,'{\"post_id\":34,\"user_id\":2,\"title\":\"\\u00e1dasdasd\",\"type\":\"Chia s\\u1ebb\",\"user_name\":\"Nguy\\u1ec5n B\\u00e1 Qu\\u00e2n\",\"avatar\":\"..\\/..\\/uploads\\/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg\",\"post_user_name\":\"Nguy\\u1ec5n Thanh Li\\u00eam\"}',NULL,'2022-06-20 08:49:00','2022-06-20 08:49:00');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-20 15:59:44
