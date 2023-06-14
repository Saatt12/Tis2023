-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: id20802803_parqueo
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `id20802803_parqueo`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `id20802803_parqueo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `id20802803_parqueo`;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descuento` int DEFAULT NULL,
  `multa` int DEFAULT NULL,
  `monto_mes` double DEFAULT NULL,
  `monto_multa` double DEFAULT NULL,
  `monto_descuento` double DEFAULT NULL,
  `monto_anual` double DEFAULT NULL,
  `cantidad_espacios` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Administrativo',NULL,NULL);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `claim_managers`
--

DROP TABLE IF EXISTS `claim_managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `claim_managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `claim_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `claim_managers_user_id_foreign` (`user_id`),
  KEY `claim_managers_claim_id_foreign` (`claim_id`),
  CONSTRAINT `claim_managers_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE,
  CONSTRAINT `claim_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claim_managers`
--

LOCK TABLES `claim_managers` WRITE;
/*!40000 ALTER TABLE `claim_managers` DISABLE KEYS */;
/*!40000 ALTER TABLE `claim_managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `claims`
--

DROP TABLE IF EXISTS `claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `claims` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `claims_client_id_foreign` (`client_id`),
  CONSTRAINT `claims_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claims`
--

LOCK TABLES `claims` WRITE;
/*!40000 ALTER TABLE `claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversation_messages`
--

DROP TABLE IF EXISTS `conversation_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversation_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `conversation_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_messages_sender_id_foreign` (`sender_id`),
  KEY `conversation_messages_receiver_id_foreign` (`receiver_id`),
  KEY `conversation_messages_conversation_id_foreign` (`conversation_id`),
  CONSTRAINT `conversation_messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversation_messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversation_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation_messages`
--

LOCK TABLES `conversation_messages` WRITE;
/*!40000 ALTER TABLE `conversation_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversation_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversations_sender_id_foreign` (`sender_id`),
  KEY `conversations_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `conversations_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dias_trabajo`
--

DROP TABLE IF EXISTS `dias_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dias_trabajo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_dia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias_trabajo`
--

LOCK TABLES `dias_trabajo` WRITE;
/*!40000 ALTER TABLE `dias_trabajo` DISABLE KEYS */;
/*!40000 ALTER TABLE `dias_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `nom_turno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_vehicles`
--

DROP TABLE IF EXISTS `income_vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `income_vehicles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `vehicle_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_vehicles_vehicle_id_foreign` (`vehicle_id`),
  KEY `income_vehicles_user_id_foreign` (`user_id`),
  CONSTRAINT `income_vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `income_vehicles_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_vehicles`
--

LOCK TABLES `income_vehicles` WRITE;
/*!40000 ALTER TABLE `income_vehicles` DISABLE KEYS */;
/*!40000 ALTER TABLE `income_vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint unsigned DEFAULT NULL,
  `claim_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_claim_id_foreign` (`claim_id`),
  CONSTRAINT `messages_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2023_04_12_204606_create_cargos_table',1),(5,'2023_04_12_204656_create_unidades_table',1),(6,'2023_04_12_204840_add_ci_to_users_table',1),(7,'2023_04_14_005816_create_horario_table',1),(8,'2023_04_14_011222_create_dias_trabajo_table',1),(9,'2023_04_14_011400_create_rol_table',1),(10,'2023_04_14_011913_add_role_id_to_users_table',1),(11,'2023_05_02_191302_create_vehicles_table',1),(12,'2023_05_03_105241_create_payments_table',1),(13,'2023_05_03_105321_create_request_forms_table',1),(14,'2023_05_03_105434_create_parkings_table',1),(15,'2023_05_03_111112_create_claims_table',1),(16,'2023_05_03_111637_create_claim_managers_table',1),(17,'2023_05_03_112734_create_messages_table',1),(18,'2023_05_03_113650_add_parking_id_to_request_forms_table',1),(19,'2023_05_07_211911_add_is_read_to_messages_table',1),(20,'2023_05_25_142415_create_conversations_table',1),(21,'2023_05_25_142848_create_announcements_table',1),(22,'2023_05_25_143307_create_income_vehicles_table',1),(23,'2023_05_25_155108_add_status_comprobante_to_payments_table',1),(24,'2023_05_25_182315_add_image_to_announcements_table',1),(25,'2023_05_25_223006_remove_fields_from_conversation',1),(26,'2023_05_25_223243_create_conversation_messages_table',1),(27,'2023_05_26_035850_add_field_conversation_id_to_conversation_messages_table',1),(28,'2023_05_26_062700_add_field_hour_vehicle_id_to_vehicles_table',1),(29,'2023_06_01_202644_add_announcement_id_to_request_forms_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parkings`
--

DROP TABLE IF EXISTS `parkings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parkings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parkings`
--

LOCK TABLES `parkings` WRITE;
/*!40000 ALTER TABLE `parkings` DISABLE KEYS */;
INSERT INTO `parkings` VALUES (101,'espacio 1','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(102,'espacio 2','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(103,'espacio 3','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(104,'espacio 4','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(105,'espacio 5','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(106,'espacio 6','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(107,'espacio 7','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(108,'espacio 8','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(109,'espacio 9','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(110,'espacio 10','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(111,'espacio 11','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(112,'espacio 12','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(113,'espacio 13','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(114,'espacio 14','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(115,'espacio 15','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(116,'espacio 16','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(117,'espacio 17','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(118,'espacio 18','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(119,'espacio 19','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(120,'espacio 20','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(121,'espacio 21','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(122,'espacio 22','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(123,'espacio 23','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(124,'espacio 24','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(125,'espacio 25','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(126,'espacio 26','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(127,'espacio 27','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(128,'espacio 28','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(129,'espacio 29','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(130,'espacio 30','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(131,'espacio 31','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(132,'espacio 32','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(133,'espacio 33','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(134,'espacio 34','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(135,'espacio 35','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(136,'espacio 36','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(137,'espacio 37','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(138,'espacio 38','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(139,'espacio 39','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(140,'espacio 40','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(141,'espacio 41','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(142,'espacio 42','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(143,'espacio 43','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(144,'espacio 44','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(145,'espacio 45','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(146,'espacio 46','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(147,'espacio 47','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(148,'espacio 48','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(149,'espacio 49','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(150,'espacio 50','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(151,'espacio 51','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(152,'espacio 52','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(153,'espacio 53','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(154,'espacio 54','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(155,'espacio 55','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(156,'espacio 56','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(157,'espacio 57','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(158,'espacio 58','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(159,'espacio 59','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(160,'espacio 60','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(161,'espacio 61','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(162,'espacio 62','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(163,'espacio 63','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(164,'espacio 64','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(165,'espacio 65','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(166,'espacio 66','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(167,'espacio 67','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(168,'espacio 68','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(169,'espacio 69','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(170,'espacio 70','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(171,'espacio 71','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(172,'espacio 72','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(173,'espacio 73','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(174,'espacio 74','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(175,'espacio 75','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(176,'espacio 76','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(177,'espacio 77','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(178,'espacio 78','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(179,'espacio 79','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(180,'espacio 80','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(181,'espacio 81','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(182,'espacio 82','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(183,'espacio 83','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(184,'espacio 84','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(185,'espacio 85','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(186,'espacio 86','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(187,'espacio 87','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(188,'espacio 88','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(189,'espacio 89','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(190,'espacio 90','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(191,'espacio 91','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(192,'espacio 92','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(193,'espacio 93','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(194,'espacio 94','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(195,'espacio 95','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(196,'espacio 96','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(197,'espacio 97','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(198,'espacio 98','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(199,'espacio 99','available','2023-06-02 08:32:49','2023-06-02 08:32:49'),(200,'espacio 100','available','2023-06-02 08:32:49','2023-06-02 08:32:49');
/*!40000 ALTER TABLE `parkings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` double DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `count` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprobante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_forms`
--

DROP TABLE IF EXISTS `request_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `vehicle_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parking_id` bigint unsigned DEFAULT NULL,
  `announcement_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_forms_user_id_foreign` (`user_id`),
  KEY `request_forms_vehicle_id_foreign` (`vehicle_id`),
  KEY `request_forms_parking_id_foreign` (`parking_id`),
  KEY `request_forms_announcement_id_foreign` (`announcement_id`),
  CONSTRAINT `request_forms_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_forms_parking_id_foreign` FOREIGN KEY (`parking_id`) REFERENCES `parkings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_forms_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_forms`
--

LOCK TABLES `request_forms` WRITE;
/*!40000 ALTER TABLE `request_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario_id` bigint unsigned DEFAULT NULL,
  `dia_trabajo_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_horario_id_foreign` (`horario_id`),
  KEY `rol_dia_trabajo_id_foreign` (`dia_trabajo_id`),
  CONSTRAINT `rol_dia_trabajo_id_foreign` FOREIGN KEY (`dia_trabajo_id`) REFERENCES `dias_trabajo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rol_horario_id_foreign` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (5,'ADMINISTRADOR',NULL,NULL,NULL,NULL),(6,'CLIENTE',NULL,NULL,NULL,NULL),(7,'OPERADOR',NULL,NULL,NULL,NULL),(8,'GUARDIA',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_unidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo_id` bigint unsigned NOT NULL,
  `unidad_id` bigint unsigned NOT NULL,
  `rol_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_cargo_id_foreign` (`cargo_id`),
  KEY `users_unidad_id_foreign` (`unidad_id`),
  KEY `users_rol_id_foreign` (`rol_id`),
  CONSTRAINT `users_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `placa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_pago` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hour_vehicle_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_user_id_foreign` (`user_id`),
  KEY `vehicles_hour_vehicle_id_foreign` (`hour_vehicle_id`),
  CONSTRAINT `vehicles_hour_vehicle_id_foreign` FOREIGN KEY (`hour_vehicle_id`) REFERENCES `income_vehicles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-02  0:51:47
