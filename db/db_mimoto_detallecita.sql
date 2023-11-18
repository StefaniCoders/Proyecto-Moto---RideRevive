-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_mimoto
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detallecita`
--

DROP TABLE IF EXISTS `detallecita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallecita` (
  `IdDetalleCita` bigint unsigned NOT NULL AUTO_INCREMENT,
  `IdCita` bigint unsigned NOT NULL,
  `IdMoto` bigint unsigned DEFAULT NULL,
  `IdMotor` bigint unsigned DEFAULT NULL,
  `detalle_moto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle_motor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdDetalleCita`),
  KEY `detallecita_idcita_foreign` (`IdCita`),
  KEY `detallecita_idmoto_foreign` (`IdMoto`),
  KEY `detallecita_idmotor_foreign` (`IdMotor`),
  CONSTRAINT `detallecita_idcita_foreign` FOREIGN KEY (`IdCita`) REFERENCES `cita` (`IdCita`),
  CONSTRAINT `detallecita_idmoto_foreign` FOREIGN KEY (`IdMoto`) REFERENCES `moto` (`IdMoto`),
  CONSTRAINT `detallecita_idmotor_foreign` FOREIGN KEY (`IdMotor`) REFERENCES `motor` (`IdMotor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecita`
--

LOCK TABLES `detallecita` WRITE;
/*!40000 ALTER TABLE `detallecita` DISABLE KEYS */;
INSERT INTO `detallecita` VALUES (6,18,8,8,'.0..','.0..','2023-10-29 08:35:41','2023-10-29 08:50:58'),(7,19,6,NULL,'cxvxcvxcv','cxvxcvxcv','2023-10-29 08:49:17','2023-10-29 08:49:17'),(8,20,1,NULL,'vcbcbcvb','vcbcbcvb','2023-10-29 08:49:44','2023-10-29 08:49:44'),(9,21,1,1,'vbnvbn','vbnvbn','2023-10-29 08:50:35','2023-10-29 08:50:41'),(10,22,1,1,'laaaaa','laaaaa','2023-10-29 08:51:41','2023-10-30 20:59:57'),(11,23,6,NULL,'yoyoyo','yoyoyo','2023-10-29 09:05:25','2023-10-29 09:05:25');
/*!40000 ALTER TABLE `detallecita` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-18 17:58:01
