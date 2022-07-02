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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,29,'test\ntest','2022-05-25 03:25:17','2022-05-25 03:25:17'),(2,1,29,'test','2022-05-25 04:14:21','2022-05-25 04:14:21'),(3,1,29,'chán quá','2022-05-25 04:14:25','2022-05-25 04:14:25'),(4,1,29,'xóa bài đi','2022-05-25 04:14:26','2022-05-25 04:14:26'),(6,1,29,'ko hay','2022-05-25 04:14:28','2022-05-25 04:14:28'),(8,1,29,'hello','2022-05-25 04:22:22','2022-05-25 04:22:22'),(9,1,29,'hiiii','2022-05-25 06:57:46','2022-05-25 06:57:46'),(11,1,29,'ôi bạn ơi','2022-05-25 07:19:49','2022-05-25 07:19:49'),(19,1,29,'hehe','2022-05-25 08:22:15','2022-05-25 08:42:17'),(24,1,29,'hahaha','2022-05-25 10:22:21','2022-05-29 08:41:50'),(26,1,16,'hay','2022-05-28 03:44:55','2022-05-28 03:44:55'),(30,14,40,'Chào bạn,\n\nVới câu hỏi “Đau tức ngực khi mắc Covid điều trị thế nào?”, bác sĩ giải đáp như sau:\n\nCOVID-19 tác động đến mỗi người theo những cách khác nhau. Hầu hết những người nhiễm vi-rút sẽ có triệu chứng bệnh từ nhẹ đến trung bình và có thể hồi phục mà không cần nhập viện. Tuy nhiên, bệnh nhân cần đi khám ngay lập tức nếu có một hay nhiều các triệu chứng nghiêm trọng như: khó thở, đau ngực, mất khả năng nói hay cử động hoặc thấy lú lẫn\n\nTrường hợp của bạn đang điều trị Covid ngày thứ ba, không có triệu chứng khó thở nhưng bạn có triệu chứng đau ngực. Triệu chứng này có thể do Sars-CoV2 gây ra nhưng cũng có thể do nguyên nhân khác như bệnh mạch vành, viêm cơ tim, tràn khí màng phổi... gây ra. Vì vậy, bạn cần đến ngay cơ sở y tế để bác sĩ tìm và điều trị nguyên nhân gây đau ngực cho bạn.','2022-06-22 04:40:38','2022-06-22 04:40:38'),(31,15,41,'Chào bạn,\n\nVới câu hỏi “Người mắc Covid ho kèm sốt 4 ngày có nên đi bệnh viện không?”, bác sĩ giải đáp như sau:\n\nSốt và ho là những triệu chứng thường gặp của nhiễm Sars-CoV2. Tuy nhiên, ho ra máu là triệu chứng rất hiếm gặp ở bệnh nhân Covid 19. Vì vậy, nếu người thân của bạn ho rất nhiều và/hoặc ho ra máu thì bạn cần đưa người thân đến ngay cơ sở y tế để bác sĩ khám, đánh giá mức độ ho, mức độ ho ra máu để có phương án xử trí kịp thời.','2022-06-22 04:43:32','2022-06-22 04:43:32');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
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
