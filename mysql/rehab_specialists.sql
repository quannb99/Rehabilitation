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
-- Table structure for table `specialists`
--

DROP TABLE IF EXISTS `specialists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialists`
--

LOCK TABLES `specialists` WRITE;
/*!40000 ALTER TABLE `specialists` DISABLE KEYS */;
INSERT INTO `specialists` VALUES (1,'Cơ xương khớp','2022-06-04 07:45:26','2022-06-04 07:45:26'),(2,'Da liễu','2022-06-04 07:45:26','2022-06-04 07:45:26'),(3,'Dinh dưỡng','2022-06-04 07:45:26','2022-06-04 07:45:26'),(4,'Đa khoa','2022-06-04 07:45:26','2022-06-04 07:45:26'),(5,'Hô hấp','2022-06-04 07:45:26','2022-06-04 07:45:26'),(6,'Nhãn khoa','2022-06-04 07:45:26','2022-06-04 07:45:26'),(7,'Chấn thương chỉnh hình','2022-06-04 07:45:26','2022-06-04 07:45:26'),(8,'Nhi khoa','2022-06-04 07:45:26','2022-06-04 07:45:26'),(9,'Thần kinh','2022-06-04 07:45:26','2022-06-04 07:45:26'),(10,'Nội tiết','2022-06-04 07:45:26','2022-06-04 07:45:26'),(11,'Tim mạch','2022-06-04 07:45:26','2022-06-04 07:45:26'),(12,'Răng - Hàm - Mặt','2022-06-04 07:45:26','2022-06-04 07:45:26'),(13,'Tiêu hóa','2022-06-04 07:45:26','2022-06-04 07:45:26'),(14,'Tai - Mũi - Họng','2022-06-04 07:45:26','2022-06-04 07:45:26'),(15,'Tâm lý','2022-06-04 07:45:26','2022-06-04 07:45:26'),(16,'Ung bướu','2022-06-04 07:45:26','2022-06-04 07:45:26'),(17,'Truyền nhiễm','2022-06-04 07:45:26','2022-06-04 07:45:26'),(18,'Huyết học','2022-06-04 07:45:26','2022-06-04 07:45:26'),(19,'Sản khoa','2022-06-04 07:45:26','2022-06-04 07:45:26'),(20,'Tiết Niệu','2022-06-04 07:45:26','2022-06-04 07:45:26');
/*!40000 ALTER TABLE `specialists` ENABLE KEYS */;
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
