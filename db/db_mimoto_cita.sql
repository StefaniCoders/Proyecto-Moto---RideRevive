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
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita` (
  `IdCita` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fec_registro` date NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdHorario` bigint unsigned NOT NULL,
  `IdCliente` bigint unsigned NOT NULL,
  `IdUsuario` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdCategoria` bigint unsigned NOT NULL,
  `IdMoto` int DEFAULT NULL,
  PRIMARY KEY (`IdCita`),
  KEY `cita_idhorario_foreign` (`IdHorario`),
  KEY `cita_idcliente_foreign` (`IdCliente`),
  KEY `cita_idusuario_foreign` (`IdUsuario`),
  KEY `FK_cita_categoria_2` (`IdCategoria`),
  CONSTRAINT `cita_idcliente_foreign` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`),
  CONSTRAINT `cita_idhorario_foreign` FOREIGN KEY (`IdHorario`) REFERENCES `horario` (`IdHorario`),
  CONSTRAINT `cita_idusuario_foreign` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`),
  CONSTRAINT `FK_cita_categoria` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`),
  CONSTRAINT `FK_cita_categoria_2` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (18,'2023-10-19','t',1,2,1,'2023-10-29 08:35:41','2023-10-29 08:51:15',4,1),(19,'2023-10-27','t',1,2,1,'2023-10-29 08:49:17','2023-10-29 08:49:17',2,NULL),(20,'2023-10-17','t',1,1,1,'2023-10-29 08:49:44','2023-10-29 08:49:44',2,NULL),(21,'2023-10-18','t',1,4,1,'2023-10-29 08:50:35','2023-10-29 08:53:31',4,NULL),(22,'2023-11-01','n',1,5,1,'2023-10-29 08:51:41','2023-10-30 20:59:57',1,NULL),(23,'2023-11-03','t',1,4,1,'2023-10-29 09:05:25','2023-10-29 09:05:31',4,NULL);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-18 17:58:00
