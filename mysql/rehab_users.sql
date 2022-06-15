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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthyear` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci DEFAULT '../../images/user-default-ava.jpg',
  `role` int(11) NOT NULL DEFAULT 1,
  `specialist_id` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nguyễn Bá Quân','quanvip1999@gmail.com','1','0842075768','1999','../../uploads/62a84dd9a44c2kitty-cat-kitten-pet-45201.jpg',1,'null',NULL,'$2y$10$W/ph.qgSZbxrRO4M6g4DWOCA2c3.hXlhK/Un53qcD.vI1hmPKSNCa','urIJZpGEl4AJOQp3CSjJPggizW7z1YYRvwRba5Vtre1c27glibKV1nlMxRKa','2022-04-28 08:28:45','2022-06-14 08:56:19'),(2,'Nguyễn Thanh Liêm','thanhliem@gmail.com','1','0983657874','1964','https://vinmec-prod.s3.amazonaws.com/images/12_01_2019_11_08_53_877612.jpeg',2,'8',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','afKigGOHzbcfWEdsPPysb0ApBIP2VxlPoFoEEJL4k0pGZ04vGuu1x38DAHar','2022-05-26 02:18:32','2022-06-15 01:44:36'),(3,'Nguyễn Thị Mận','thiman@gmail.com','2',NULL,NULL,'https://vinmec-prod.s3.amazonaws.com/images/10_12_2018_10_26_07_072575.png',2,'19',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','F0Lm0N7qpJGPgNw17xXvM9QSxfvN4UzCITXwuOdyWXckWkKvIH4gkkXzalac','2022-05-26 02:18:32','2022-05-26 02:18:32'),(4,'Đỗ Doãn Lợi','doanloi@gmail.com','1',NULL,NULL,'https://vinmec-prod.s3.amazonaws.com/images/14_06_2021_08_15_51_145413.jpeg',2,'11',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ycPWFueJu8SyqG7N1quzOWSxdopkw6HMdm7O9z3P68tDdXgIr7gSyGJyOAfm','2022-05-26 02:18:32','2022-05-26 02:18:32'),(5,'Lê Thị Thu Hằng','thuhang@gmail.com','2',NULL,NULL,'https://vinmec-prod.s3.amazonaws.com/images/13_12_2018_03_34_04_423779.jpeg',2,'2',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ycPWFueJu8SyqG7N1quzOWSxdopkw6HMdm7O9z3P68tDdXgIr7gSyGJyOAfm','2022-05-26 02:18:32','2022-05-26 02:18:32'),(6,'Lê Dương Tiến','letien@gmail.com','1',NULL,NULL,'https://vinmec-prod.s3.amazonaws.com/images/22_02_2019_05_07_42_407968.jpeg',2,'1',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ycPWFueJu8SyqG7N1quzOWSxdopkw6HMdm7O9z3P68tDdXgIr7gSyGJyOAfm','2022-05-26 02:18:32','2022-05-26 02:18:32'),(7,'Phạm Tuấn Linh','tuanlinh@gmail.com','1',NULL,'2000','https://scontent.fhan4-1.fna.fbcdn.net/v/t39.30808-1/275927103_2415040861969097_4747635420157237262_n.jpg?stp=dst-jpg_p320x320&_nc_cat=105&ccb=1-7&_nc_sid=7206a8&_nc_ohc=x8ODvVHxaFsAX9SvFxQ&_nc_ht=scontent.fhan4-1.fna&oh=00_AT8EfVMN6dfF1NAddhZRL8YpKNht7_0ZxuR11lrSflsoyw&oe=62AB923A',1,NULL,NULL,'$2y$10$SHgbdwJpvU1O3q0lMWOa1ugoYVjL2aum8VOFOwRBdWTHs91c.Eae.',NULL,'2022-06-11 08:53:48','2022-06-11 08:53:48'),(8,'Lê Thanh Thủy','thanhthuy@gmail.com','2',NULL,'2000','https://scontent.fhan4-3.fna.fbcdn.net/v/t1.6435-1/129821113_1337945626549808_5514456129831260247_n.jpg?stp=dst-jpg_p320x320&_nc_cat=103&ccb=1-7&_nc_sid=7206a8&_nc_ohc=nVnqKtrplRYAX_U3Vh5&_nc_ht=scontent.fhan4-3.fna&oh=00_AT_wiNSBeIFg27WGa_mYLXxr1OGMpw7HP5pNd1NKn_N5FA&oe=62CCBED2',1,NULL,NULL,'$2y$10$ohnTsOxnT2SH4ALUKrP1oeahsyMUwxt5tH3CTw1tUSDRxe2oJOsE.','iGzMSTdGTkXsUjgQuvKYFuKDUQgpZsGKIY5NQYK4BFdgFnMYdMhTlyomXEmO','2022-06-11 09:02:00','2022-06-11 09:02:00'),(9,'Nguyễn Quốc Hưng','quochung@gmail.com','1',NULL,'1999','../../images/user-default-ava.jpg',1,NULL,NULL,'$2y$10$hdYxae/L94eoSb/43C5O0uLDrmi5IYzRSqUUpbV09hWCNai8xDETq',NULL,'2022-06-11 09:05:49','2022-06-11 09:05:49');
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

-- Dump completed on 2022-06-15 16:36:50
