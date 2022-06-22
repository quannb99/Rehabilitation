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
  `deactive` text COLLATE utf8mb4_unicode_ci DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nguyễn Bá Quân','quanvip1999@gmail.com','1','0842075768','1999','../../uploads/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg',1,NULL,'0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ic5Sc3nskELDA74ovtbxSpKX5hNOVmLnKul3kPVdMNvx8T3CRmyhuH6S5ifP','2022-04-28 08:28:45','2022-06-15 11:33:45',NULL),(2,'Nguyễn Thanh Liêm','ntliem@gmail.com','1','0983657874','1964','../../uploads/62af2722e317612_01_2019_11_08_54_075889.jpeg',2,'8','0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','aXMlSrkv9Peh85OhiKdmzEGMrWuMKnUTvt39Kum8IlGO4glTPtTvpBVacsgX','2022-05-26 02:18:32','2022-06-19 13:39:47',NULL),(3,'Nguyễn Thị Mận','ntman@gmail.com','2',NULL,NULL,'../../uploads/62af2818edbea10_12_2018_10_26_07_373275.png',2,'19','0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','F0Lm0N7qpJGPgNw17xXvM9QSxfvN4UzCITXwuOdyWXckWkKvIH4gkkXzalac','2022-05-26 02:18:32','2022-06-19 13:43:53',NULL),(4,'Đỗ Doãn Lợi','ddloi@gmail.com','1',NULL,NULL,'../../uploads/62af27e742a9614_06_2021_08_15_52_525183.jpeg',2,'11','0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ycPWFueJu8SyqG7N1quzOWSxdopkw6HMdm7O9z3P68tDdXgIr7gSyGJyOAfm','2022-05-26 02:18:32','2022-06-19 13:43:03',NULL),(5,'Lê Thị Thu Hằng','ltthang@gmail.com','2',NULL,NULL,'../../uploads/62af27616185d13_12_2018_03_34_04_640186.jpeg',2,'2','0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ycPWFueJu8SyqG7N1quzOWSxdopkw6HMdm7O9z3P68tDdXgIr7gSyGJyOAfm','2022-05-26 02:18:32','2022-06-19 13:40:49',NULL),(6,'Lê Dương Tiến','ldtien@gmail.com',NULL,NULL,NULL,'../../uploads/62af279c885ae22_02_2019_05_07_42_717364.jpeg',2,'1','0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','ycPWFueJu8SyqG7N1quzOWSxdopkw6HMdm7O9z3P68tDdXgIr7gSyGJyOAfm','2022-05-26 02:18:32','2022-06-19 13:41:48',NULL),(7,'Phạm Tuấn Linh','ptlinh@gmail.com','1',NULL,'2000','../../uploads/62aee06ee7244275927103_2415040861969097_4747635420157237262_n.jpg',1,NULL,'0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa',NULL,'2022-06-11 08:53:48','2022-06-19 08:38:06',NULL),(8,'Lê Thanh Thủy','ltthuy@gmail.com','2',NULL,'2000','../../uploads/62aee0a74cc61129821113_1337945626549808_5514456129831260247_n.jpg',1,NULL,'0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','iGzMSTdGTkXsUjgQuvKYFuKDUQgpZsGKIY5NQYK4BFdgFnMYdMhTlyomXEmO','2022-06-11 09:02:00','2022-06-19 08:39:03',NULL),(9,'Nguyễn Quốc Hưng','nqhung@gmail.com','1',NULL,'1999','../../uploads/62aede0516b7b279050602_5065363200246010_633260472491961963_n.jpg',1,NULL,'0',NULL,'$2y$10$fR95stdbiHYlyj3dyP.SG.N6O5eHT1y4xdAd8zxn2kSdd/UisC65a','vfhSo3uDSpsBxEs3Be2z3HFhDZg3WiioLOcDjRA2HgkYvU4PW19EevneGrtS','2022-06-11 09:05:49','2022-06-19 09:27:03',NULL),(10,'Admin','admin@gmail.com','1','0842075777','1999','../../uploads/62af16cad321eadmin-sign-laptop-icon-stock-vector-166205404.jpg',3,NULL,'0',NULL,'$2y$10$Y9Xkm/mXAuUi7mHmmFcEfe43TNAhafqyjUf.JS6UeXCFfltVB7jGa','QZuBBsIULSBfFLWRDdzXzIKMzDXT9iI1krxbW3nlJNWbbKQ7jmDc6JvUrss2','2022-06-18 09:17:57','2022-06-19 12:30:02',NULL),(11,'Hồ Thu Mai','htmai@gmail.com','2',NULL,NULL,'../../uploads/62af1aff901ec13_08_2021_02_45_06_572933.jpeg',2,'3','1',NULL,'$2y$10$Xkbr1Rv0TqUeD8VtsX4mL.W7hoj6Jc9crnw04E4a5nYmxKzrEG5Nu',NULL,'2022-06-19 12:47:59','2022-06-21 13:33:50',NULL),(12,'Nguyễn Minh Hằng','minhan@gmail.com','2',NULL,'1999','../../uploads/62af1da4207e380297568_1596238173860966_454793769145860096_n.jpg',1,NULL,'0',NULL,'$2y$10$E61MbSIu1qES4gzd1ORAXerimwSR.sx1qpSxdLlpditcCf4fGeuVi',NULL,'2022-06-19 12:58:59','2022-06-19 12:59:34',NULL),(13,'Hoàng Thị Hiền','hthien@gmail.com',NULL,NULL,NULL,'../../uploads/62af1e20b58e307_08_2020_06_06_24_055973.jpeg',2,'4','0',NULL,'$2y$10$A.POmVi7aFS8VIg6SQvC8uLZuUuuuiEQXxSI6HmRfWzzSCwbKSZWS',NULL,'2022-06-19 13:01:20','2022-06-19 13:01:20',NULL),(14,'Thành Ngọc Tiến','tntien@gmail.com',NULL,NULL,NULL,'../../uploads/62b27db1ed6f326_11_2021_03_04_33_877300.jpeg',2,'5','0',NULL,'$2y$10$.PVfP6/JCgZwcg4ho71gau9sdShcNIJYYoQSb5qEepzXNEo18HaNS',NULL,'2022-06-22 02:24:38','2022-06-22 02:25:54',NULL),(15,'Lê Thị Phương Thảo','ltpthao@gmail.com',NULL,NULL,NULL,'../../uploads/62b27eb69a5a806_03_2019_04_43_49_264874.jpeg',2,'6','0',NULL,'$2y$10$KnP7MDpx3SOytefUOIBFpe5OzPuEMZ2cJQ68VEj/A4evGKFSl4mSe',NULL,'2022-06-22 02:30:14','2022-06-22 02:30:14',NULL),(16,'Phạm Hồng Hà','phha@gmail.com',NULL,NULL,NULL,'../../uploads/62b27f9c4d74302_04_2021_08_20_14_938995.jpeg',2,'7','0',NULL,'$2y$10$vPKcamSPTG7lj3OnAo9T/ux9ssVSHoKzZEpnvC.rcbdSuJ670MY06',NULL,'2022-06-22 02:34:04','2022-06-22 02:34:04',NULL),(17,'Nguyễn Thị Phương Thảo','ntpthao@gmail.com',NULL,NULL,NULL,'../../uploads/62b28018333e212_04_2022_01_30_06_917749.jpeg',2,'9','0',NULL,'$2y$10$/lqMpfUMgbrDUSkBKmX7G.I/AZi85v7DibXvJ9JRWmK5GEHTtKhc6',NULL,'2022-06-22 02:36:08','2022-06-22 02:36:08',NULL),(18,'Trần Thị Hoàng Anh','tthanh',NULL,NULL,NULL,'../../uploads/62b280ebb72ac26_05_2022_13_23_25_161459.jpeg',2,'10','0',NULL,'$2y$10$xH87AAE7juyxBcdozBo9nOZB.6Dy/ovzcz8UVpocD4AoSpdDKv1p6',NULL,'2022-06-22 02:39:32','2022-06-22 02:39:39',NULL),(19,'Hoàng Mai Anh','hmanh@gmail.com',NULL,NULL,NULL,'../../uploads/62b281b6eff5313_02_2019_08_14_32_979963.jpeg',2,'12','0',NULL,'$2y$10$Fdi18.JCynTVR.ddR28VZulOfOnEzJuwYfJk2YZb4SSe3qQDEJkEC',NULL,'2022-06-22 02:43:02','2022-06-22 02:43:02',NULL),(20,'Phan Thanh Nguyên','ptnguyen@gmail.com',NULL,NULL,NULL,'../../uploads/62b282894eaee28_07_2016_08_58_52_428946.jpeg',2,'13','0',NULL,'$2y$10$/5hjnIAgH8XHM/O.Biqv1ui4zwJGrFZD5KE7kJ//CFFrKXGY/TWfK',NULL,'2022-06-22 02:46:33','2022-06-22 02:46:33',NULL),(21,'Nguyễn Tuấn Lâm','ntlam@gmail.com',NULL,NULL,NULL,'../../uploads/62b282e54639d21_12_2019_04_51_07_304063.jpeg',2,'14','0',NULL,'$2y$10$6ZeS7WFYKqxYLwWZikbRo.8uPwuwO9o9Vz/fsxOuN0kEgi2uq5epO',NULL,'2022-06-22 02:48:05','2022-06-22 02:48:05',NULL),(22,'Trương Tạ Anh Nga','ttanga@gmail.com',NULL,NULL,NULL,'../../uploads/62b283d0c8cd601_03_2019_07_43_40_915617.jpeg',2,'15','0',NULL,'$2y$10$bA9GtP5lbzOLTyv6rMlht.tKYG60FFcqZ.H5niuB2sFRSLFfFnfjS',NULL,'2022-06-22 02:52:00','2022-06-22 02:52:00',NULL),(23,'Nguyễn Thị Phi Yến','ntpyen@gmail.com',NULL,NULL,NULL,'../../uploads/62b28428e7ad123_02_2019_02_37_16_391801.jpeg',2,'16','0',NULL,'$2y$10$0NbpkgMlqYbaYqIqm0mX/Occwb7yARXa.NjeXRGiOkCk1ZRQ0K5kK',NULL,'2022-06-22 02:53:28','2022-06-22 02:53:28',NULL),(24,'Nguyễn Thị Nhật','ntnhat@gmail.com',NULL,NULL,NULL,'../../uploads/62b284a528b7931_01_2019_04_15_26_574013.jpeg',2,'17','0',NULL,'$2y$10$q6B14R2NtTtWqM7yOqb/PeFQlBdXaGxxS5GLwB2/VHoK/4wFrLx2e',NULL,'2022-06-22 02:55:33','2022-06-22 02:55:33',NULL),(25,'Phạm Thị Thùy Nhung','pttnhung@gmail.com',NULL,NULL,NULL,'../../uploads/62b2850f8259a19_01_2019_04_56_30_163094.jpeg',2,'18','0',NULL,'$2y$10$kzzjX9svbx18ti7chUDzVu.UDszOHpliW5D8zGs.6LLMV0oMnhnQK',NULL,'2022-06-22 02:57:19','2022-06-22 02:57:19',NULL),(26,'Lê Phúc Liên','lplien@gmail.com',NULL,NULL,NULL,'../../uploads/62b2861f8672625_03_2019_11_19_54_217110.jpeg',2,'20','0',NULL,'$2y$10$ZJEpslMmJST1iqhbmN66y.zWvxm3IbY1tLnCX9gMaCfjpN0kwlJMa',NULL,'2022-06-22 03:01:51','2022-06-22 03:01:51',NULL);
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

-- Dump completed on 2022-06-22 14:12:10
