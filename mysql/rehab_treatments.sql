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
-- Table structure for table `treatments`
--

DROP TABLE IF EXISTS `treatments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difficulty` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objective` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outcome` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatments`
--

LOCK TABLES `treatments` WRITE;
/*!40000 ALTER TABLE `treatments` DISABLE KEYS */;
INSERT INTO `treatments` VALUES (1,2,'Tập thở khi nằm ngửa','1','2','Giúp giảm triệu chứng khó thở','<p>Nằm ngửa và gập đầu gối của bạn sao cho lòng bàn chân của bạn nằm trên giường.</p><p><img src=\"https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/3/16/1024098/Tap-Tho-1.png\" alt=\"Bài tập thở 3 phút đơn giản cải thiện sức khỏe cho bệnh nhân COVID-19\"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>','Thực hiện được 80% các bài tập','Không','2022-06-26 15:15:49','2022-07-01 09:36:57'),(2,2,'Tập thở khi nằm sấp','1','3','Giúp giảm triệu chứng khó thở','<p>Nằm sấp và gối đầu lên tay để có khoảng trống thở.</p><p><img src=\"https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/3/16/1024098/Tap-Tho-2.jpg\" alt=\"Bài tập thở 3 phút đơn giản cải thiện sức khỏe cho bệnh nhân COVID-19\"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>','Thực hiện được 80% các bài tập','Không','2022-07-01 09:46:10','2022-07-01 09:46:10'),(3,3,'Tập thở khi ngồi','1','2','Giúp giảm triệu chứng khó thở','<p>Ngồi thẳng trên mép giường hoặc trên ghế chắc chắn.</p><p><img src=\"https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2021/10/1/tap-tho1-16330905921521396660062.png\" alt=\"Tập thở tăng thông khí phổi, phòng bệnh COVID-19\"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>','Thực hiện được 80% các bài tập','Không','2022-07-01 09:50:33','2022-07-01 09:50:33'),(4,3,'Tập thở khi đứng','2','3','Giúp giảm triệu chứng khó thở','<p>Đứng thẳng và đặt hai tay quanh hai bên bụng.</p><p><img src=\"https://vinmec-prod.s3.amazonaws.com/images/20210220_115839_571708_hit-tho-dung-cach.max-1800x1800.jpg\" alt=\"Hướng dẫn tập các kiểu thở | Vinmec\"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>','Thực hiện được 80% các bài tập','Không','2022-07-01 09:59:25','2022-07-01 09:59:25'),(5,2,'Tập thở ngáp cười','1','4','Giúp giảm triệu chứng khó thở','<p><img src=\"https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2021/12/25/photo-1640450188522-1640450188726157630238.png\" alt=\"Tập thở khi bị COVID\"></p><p>• Ngồi thẳng trên mép giường hoặc trên ghế chắc chắn.</p><p>• Đưa cánh tay qua đầu và tạo ra một cái ngáp dài.</p><p>• Đưa cánh tay xuống và kết thúc bằng cách mỉm cười trong ba giây.</p><p>• Lặp lại trong một phút</p><p>Bài tập này kết hợp chuyển động với hít thở sâu, giúp tăng khả năng phối hợp và xây dựng sức mạnh ở cánh tay và vai. Nó cũng mở ra các cơ trong ngực của bạn để tạo không gian cho cơ hoành mở rộng.</p>','Thực hiện được 80% các bài tập','Không','2022-07-01 10:06:04','2022-07-01 10:06:04'),(6,2,'Tập thở tạo âm','1','4','Giúp giảm triệu chứng khó thở','<p>• Ngồi thẳng trên mép giường hoặc trên ghế chắc chắn.</p><p>• Đặt tay quanh hai bên bụng.</p><p>• Nhắm môi lại, hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên / nở ra.</p><p>• Khi phổi của bạn đã đầy, hãy giữ môi của bạn khép lại và thở ra trong khi ngâm nga, tạo ra âm thanh “hmmmmmm”.</p><p>Chú ý cách hai tay của bạn hạ thấp trở lại.</p><p>• Một lần nữa, hít vào bằng mũi, sau đó thở ra bằng mũi trong khi ngâm nga.</p><p>• Lặp lại trong một phút.</p>','Thực hiện được 80% các bài tập','Không','2022-07-01 10:07:10','2022-07-01 10:07:10');
/*!40000 ALTER TABLE `treatments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-02 17:19:45
