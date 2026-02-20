-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: vuka_laravel11
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `uploaded_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'4','ID Proof','Untitled document','pdf','documents/1767636834_Untitled document.pdf','pending','2026-01-05 12:43:54','2026-01-05 12:41:21','2026-01-05 12:43:54'),(2,'4','KRA Pin','Document','pdf','documents/1767636834_Document.pdf','pending','2026-01-05 12:43:54','2026-01-05 12:41:21','2026-01-05 12:43:54'),(3,'8','ID Proof','todo','png','documents/1767685389_todo.drawio.png','pending','2026-01-06 02:13:09','2026-01-06 02:10:46','2026-01-06 02:13:09'),(4,'8','KRA Pin','ss','png','documents/1767685389_Screenshot from 2025-12-03 16-05-50.png','pending','2026-01-06 02:13:09','2026-01-06 02:10:46','2026-01-06 02:13:09'),(5,'9','ID Proof','todo','png','documents/1767696895_todo.drawio.png','pending','2026-01-06 05:24:55','2026-01-06 05:24:14','2026-01-06 05:24:55'),(6,'9','KRA Pin','ss','png','documents/1767696895_Screenshot from 2025-12-03 16-05-50.png','pending','2026-01-06 05:24:55','2026-01-06 05:24:14','2026-01-06 05:24:55'),(7,'23','ID Proof','todo','png','documents/1767726049_todo.drawio.png','approved','2026-01-06 13:30:49','2026-01-06 13:30:26','2026-01-06 13:43:56'),(8,'23','KRA Pin','ss','png','documents/1767726049_Screenshot from 2025-12-03 16-05-50.png','rejected','2026-01-06 13:30:49','2026-01-06 13:30:26','2026-01-06 13:48:34');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_12_29_163240_create_otp_verifications_table',1),(5,'2025_12_29_163240_create_personal_infos_table',1),(6,'2025_12_29_195921_change_password_column_type',1),(7,'2025_12_31_175642_create_personal_access_tokens_table',1),(8,'2026_01_05_065954_create_documents_table',1),(9,'2026_01_05_070026_create_risk_questions_table',1),(10,'2026_01_05_070047_create_risk_assessments_table',1),(11,'2026_01_06_142106_add_role_and_manager_id_to_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp_verifications`
--

DROP TABLE IF EXISTS `otp_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otp_verifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `otp_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otp_verifications_user_id_foreign` (`user_id`),
  CONSTRAINT `otp_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp_verifications`
--

LOCK TABLES `otp_verifications` WRITE;
/*!40000 ALTER TABLE `otp_verifications` DISABLE KEYS */;
INSERT INTO `otp_verifications` VALUES (1,4,'415448','2026-01-05 12:31:15','2026-01-05 12:41:15',1,0,'2026-01-05 12:31:15','2026-01-05 12:31:38'),(2,5,'690724','2026-01-05 12:52:30','2026-01-05 13:02:30',1,0,'2026-01-05 12:52:30','2026-01-05 12:53:11'),(3,7,'283544','2026-01-06 02:03:34','2026-01-06 02:13:34',0,0,'2026-01-06 02:03:34','2026-01-06 02:03:34'),(4,8,'115300','2026-01-06 02:05:19','2026-01-06 02:15:19',1,0,'2026-01-06 02:05:19','2026-01-06 02:05:52'),(5,9,'939456','2026-01-06 05:19:56','2026-01-06 05:29:56',1,0,'2026-01-06 05:19:56','2026-01-06 05:21:25'),(6,10,'285161','2026-01-06 09:42:30','2026-01-06 09:52:30',1,0,'2026-01-06 09:42:30','2026-01-06 09:43:12'),(7,11,'549632','2026-01-06 09:44:37','2026-01-06 09:54:37',1,0,'2026-01-06 09:44:37','2026-01-06 09:45:07'),(9,13,'412914','2026-01-06 09:55:31','2026-01-06 10:05:31',1,0,'2026-01-06 09:55:31','2026-01-06 09:56:07'),(10,14,'578925','2026-01-06 10:03:08','2026-01-06 10:13:08',1,0,'2026-01-06 10:03:08','2026-01-06 10:03:39'),(11,15,'367908','2026-01-06 10:04:28','2026-01-06 10:14:28',1,0,'2026-01-06 10:04:28','2026-01-06 10:04:51'),(12,16,'171624','2026-01-06 10:23:25','2026-01-06 10:33:25',1,0,'2026-01-06 10:23:25','2026-01-06 10:23:54'),(13,17,'830363','2026-01-06 11:07:58','2026-01-06 11:17:58',1,0,'2026-01-06 11:07:58','2026-01-06 11:08:38'),(14,18,'428545','2026-01-06 11:28:14','2026-01-06 11:38:14',1,0,'2026-01-06 11:28:14','2026-01-06 11:30:17'),(15,19,'757528','2026-01-06 11:34:10','2026-01-06 11:44:10',1,0,'2026-01-06 11:34:10','2026-01-06 11:35:43'),(16,20,'589888','2026-01-06 11:53:39','2026-01-06 12:03:39',1,0,'2026-01-06 11:34:54','2026-01-06 11:54:09'),(17,21,'468052','2026-01-06 11:56:59','2026-01-06 12:06:59',1,0,'2026-01-06 11:56:59','2026-01-06 11:59:12'),(18,22,'613917','2026-01-06 12:38:39','2026-01-06 12:48:39',1,0,'2026-01-06 12:38:39','2026-01-06 12:39:10'),(19,23,'575772','2026-01-06 13:26:52','2026-01-06 13:36:52',1,0,'2026-01-06 13:26:52','2026-01-06 13:28:18'),(20,24,'510319','2026-01-06 13:35:59','2026-01-06 13:45:59',1,0,'2026-01-06 13:35:59','2026-01-06 13:36:21'),(21,25,'946762','2026-01-06 22:36:49','2026-01-06 22:46:49',1,0,'2026-01-06 22:36:49','2026-01-06 22:37:13');
/*!40000 ALTER TABLE `otp_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',4,'VukaAPI-login','c1ce60323921e978d18ebc4c4aef22cb97a721f492d3bd0abbe7fb13c8e02168','[\"*\"]','2026-01-05 12:45:55','2026-01-05 14:31:58','2026-01-05 12:31:58','2026-01-05 12:45:55'),(2,'App\\Models\\User',5,'VukaAPI-login','d6b16841d792816f7e3e091945d091e43865b8c09cc69be5dfb757b8e80cd081','[\"*\"]','2026-01-05 12:54:45','2026-01-05 14:53:41','2026-01-05 12:53:41','2026-01-05 12:54:45'),(3,'App\\Models\\User',8,'VukaAPI-login','924388bf7a8420cf52a5110f801ad8df561f7874b297431e0b6447ad37f20c95','[\"*\"]','2026-01-06 02:13:09','2026-01-06 04:06:11','2026-01-06 02:06:11','2026-01-06 02:13:09'),(4,'App\\Models\\User',9,'VukaAPI-login','3417d8351779ed205fc9dbac4e4abb844054959ff8244964a0a13a3aaa0b68db','[\"*\"]','2026-01-06 05:27:40','2026-01-06 07:22:18','2026-01-06 05:22:18','2026-01-06 05:27:40'),(5,'App\\Models\\User',10,'VukaAPI-login','019e365a8f7dd7c4d5a3a7f238c812e3edc66ab2410448a9904a6e8e48333ad5','[\"*\"]',NULL,'2026-01-06 11:43:26','2026-01-06 09:43:26','2026-01-06 09:43:26'),(6,'App\\Models\\User',11,'VukaAPI-login','de13f9c75fea63ffd13fb12cda1686c54ddc0bca5a40240040ef785728ddafad','[\"*\"]','2026-01-06 09:51:21','2026-01-06 11:45:19','2026-01-06 09:45:19','2026-01-06 09:51:21'),(7,'App\\Models\\User',12,'VukaAPI-login','8899a99966b9e121364347de5eff6d3f5f8ae04ea0c3e059027e31cf2a6c0eb2','[\"*\"]','2026-01-06 09:58:08','2026-01-06 11:54:55','2026-01-06 09:54:55','2026-01-06 09:58:08'),(8,'App\\Models\\User',13,'VukaAPI-login','d762c7724e5931e8e292b338471a3d97aee051b7462c1e9cae2195279e746718','[\"*\"]',NULL,'2026-01-06 11:56:19','2026-01-06 09:56:19','2026-01-06 09:56:19'),(9,'App\\Models\\User',14,'VukaAPI-login','e6689c17c7f7d903d12362c7101742df1f4f33ca4bf0afc886302bb155cbb501','[\"*\"]',NULL,'2026-01-06 12:03:48','2026-01-06 10:03:48','2026-01-06 10:03:48'),(10,'App\\Models\\User',15,'VukaAPI-login','3841b7858cbefbb7795ff51f0fca9e2108bbc929f781277e3d380746a6734af7','[\"*\"]','2026-01-06 10:44:57','2026-01-06 12:05:11','2026-01-06 10:05:11','2026-01-06 10:44:57'),(11,'App\\Models\\User',16,'VukaAPI-login','3de69911696c1e51f66cddfb512a8b148aa095937f94ab95a3c84635f546cb7a','[\"*\"]','2026-01-06 11:43:34','2026-01-06 12:24:40','2026-01-06 10:24:40','2026-01-06 11:43:34'),(12,'App\\Models\\User',18,'VukaAPI-login','12b6ce3cc24f2b4613f1168cd8f981eb232170213bb9acde23b7524babbb7453','[\"*\"]',NULL,'2026-01-06 13:32:21','2026-01-06 11:32:21','2026-01-06 11:32:21'),(13,'App\\Models\\User',19,'VukaAPI-login','7c86f0d64105432cb75ee21c00b3b7b4d842540748ffd6ec621b38c9b2eb1d9a','[\"*\"]','2026-01-06 12:40:36','2026-01-06 13:36:01','2026-01-06 11:36:01','2026-01-06 12:40:36'),(14,'App\\Models\\User',20,'VukaAPI-login','8d6c436c8d0ffa9f9811be5ff4d5e1f312dc01879432bbad560c9b868aebdac4','[\"*\"]','2026-01-06 11:59:25','2026-01-06 13:54:39','2026-01-06 11:54:39','2026-01-06 11:59:25'),(15,'App\\Models\\User',22,'VukaAPI-login','873aaddd792a27a3cec6667a7e426871e94f2d09b066b60e2edf9bc4ca0139e1','[\"*\"]','2026-01-06 12:40:50','2026-01-06 14:39:23','2026-01-06 12:39:23','2026-01-06 12:40:50'),(16,'App\\Models\\User',23,'VukaAPI-login','54dcd67a58ed5bf43e10777cb3d42d4261ae6ea9f6bab44de1d3c982045cb208','[\"*\"]','2026-01-06 13:35:15','2026-01-06 15:28:28','2026-01-06 13:28:28','2026-01-06 13:35:15'),(17,'App\\Models\\User',24,'VukaAPI-login','0d7a7c6c09a6479f269ff286fa1400acf105d65b8b31f546ad4a9d40ff91fd39','[\"*\"]','2026-01-06 14:02:26','2026-01-06 15:36:47','2026-01-06 13:36:47','2026-01-06 14:02:26'),(18,'App\\Models\\User',25,'VukaAPI-login','f0f8af747c6e7578f9bf52ac93fae518d68cc58d270237fa42bc70383913dda0','[\"*\"]','2026-01-06 22:37:56','2026-01-07 00:37:29','2026-01-06 22:37:29','2026-01-06 22:37:56');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_infos`
--

DROP TABLE IF EXISTS `personal_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `proof_type` enum('National ID','Alien ID','Passport ID') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kra_pin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_residence` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female','Others') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employment_status` enum('Employed','Unemployed','SelfEmployed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('incomplete','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'incomplete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_infos_id_number_unique` (`id_number`),
  UNIQUE KEY `personal_infos_kra_pin_unique` (`kra_pin`),
  KEY `personal_infos_user_id_foreign` (`user_id`),
  CONSTRAINT `personal_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_infos`
--

LOCK TABLES `personal_infos` WRITE;
/*!40000 ALTER TABLE `personal_infos` DISABLE KEYS */;
INSERT INTO `personal_infos` VALUES (1,4,'National ID','NID753349629','KRA951333881','2026-01-06','Kenyan','Kenya','Kenya','Male','Employed','incomplete','2026-01-05 12:37:00','2026-01-05 12:37:00'),(2,5,'National ID','NID756549629','KRA951253881','2026-01-05','Kenyan','Kenya','Kenya','Male','Employed','incomplete','2026-01-05 12:54:45','2026-01-05 12:54:45'),(3,8,'National ID','NID7563459629','KRA951253731','2026-01-06','Kenyan','Kenya','Kenya','Male','Employed','incomplete','2026-01-06 02:07:19','2026-01-06 02:07:19'),(4,9,'National ID','NID7583459629','KRA951273731','2026-01-06','Kenyan','Kenya','Kenya','Female','Employed','incomplete','2026-01-06 05:22:51','2026-01-06 05:22:51'),(5,20,'National ID','NID7343459629','KRA951773731','2026-01-06','Kenyan','Kenya','Kenya','Female','Employed','incomplete','2026-01-06 11:56:03','2026-01-06 11:56:03'),(6,23,'National ID','NID7653459629','KRA958703731','2026-01-26','Kenyan','Kenya','Kenya','Female','Employed','incomplete','2026-01-06 13:29:31','2026-01-06 13:29:31');
/*!40000 ALTER TABLE `personal_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_assessments`
--

DROP TABLE IF EXISTS `risk_assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `risk_assessments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `users_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_selected` int NOT NULL,
  `risk_score` int NOT NULL,
  `submitted_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `risk_assessments_question_id_foreign` (`question_id`),
  CONSTRAINT `risk_assessments_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `risk_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_assessments`
--

LOCK TABLES `risk_assessments` WRITE;
/*!40000 ALTER TABLE `risk_assessments` DISABLE KEYS */;
INSERT INTO `risk_assessments` VALUES (1,3,'4',3,1,'2026-01-05 12:45:25','2026-01-05 12:45:07','2026-01-05 12:45:25'),(2,1,'4',2,3,'2026-01-05 12:45:14','2026-01-05 12:45:14','2026-01-05 12:45:14'),(3,2,'4',3,4,'2026-01-05 12:45:20','2026-01-05 12:45:20','2026-01-05 12:45:20'),(4,4,'4',3,3,'2026-01-05 12:45:29','2026-01-05 12:45:29','2026-01-05 12:45:29'),(5,5,'4',3,3,'2026-01-05 12:45:33','2026-01-05 12:45:33','2026-01-05 12:45:33'),(6,5,'9',4,4,'2026-01-06 05:26:58','2026-01-06 05:26:58','2026-01-06 05:26:58'),(7,4,'9',4,1,'2026-01-06 05:27:04','2026-01-06 05:27:04','2026-01-06 05:27:04'),(8,3,'9',4,3,'2026-01-06 05:27:09','2026-01-06 05:27:09','2026-01-06 05:27:09'),(9,2,'9',4,2,'2026-01-06 05:27:15','2026-01-06 05:27:15','2026-01-06 05:27:15'),(10,1,'9',4,4,'2026-01-06 05:27:20','2026-01-06 05:27:20','2026-01-06 05:27:20');
/*!40000 ALTER TABLE `risk_assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_questions`
--

DROP TABLE IF EXISTS `risk_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `risk_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option1_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option1_risk_score` int NOT NULL,
  `option2_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option2_risk_score` int NOT NULL,
  `option3_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option3_risk_score` int NOT NULL,
  `option4_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option4_risk_score` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_questions`
--

LOCK TABLES `risk_questions` WRITE;
/*!40000 ALTER TABLE `risk_questions` DISABLE KEYS */;
INSERT INTO `risk_questions` VALUES (1,'What is your primary investment goal?','Capital protection',1,'Stable income',3,'Moderate growth',2,'High growth',4,'2026-01-05 12:35:06','2026-01-05 12:35:06'),(2,'How long do you plan to stay invested?','Less than 1 year',3,'1–3 years',1,'3–5 years',4,'More than 5 years',2,'2026-01-05 12:35:06','2026-01-05 12:35:06'),(3,'How would you react if your investment value drops by 20%?','Sell immediately',4,'Wait for recovery',2,'Hold and monitor',1,'Invest more',3,'2026-01-05 12:35:06','2026-01-05 12:35:06'),(4,'What percentage of your income are you comfortable investing?','Less than 10%',4,'10–25%',2,'25–50%',3,'More than 50%',1,'2026-01-05 12:35:06','2026-01-05 12:35:06'),(5,'Which investment option do you prefer?','Fixed deposits / bonds',1,'Balanced mutual funds',2,'Equity mutual funds',3,'Stocks / crypto',4,'2026-01-05 12:35:06','2026-01-05 12:35:06');
/*!40000 ALTER TABLE `risk_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','manager','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `manager_id` bigint unsigned DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_cond` tinyint(1) NOT NULL DEFAULT '0',
  `registration_status` enum('started','otp_verified','personal_info','documents_uploaded','documents_reuploaded','risk_done','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'started',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_manager_id_foreign` (`manager_id`),
  CONSTRAINT `users_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'anand','krish','s','ak@gmail.com','user',16,'$2y$12$c1fvXpyIa8Oqm5ZGt4CNiOorCOZw9DA4LZBsYT2JNTceTz.QbwTJa','7094540200',1,'risk_done','2026-01-05 12:31:15','2026-01-06 10:42:49'),(5,'gokul','kumar','g','gouklkumar@gmail.com','user',14,'$2y$12$jW8LI8j6fwoVbuAIPVsQVOHU37H1q1PD6aXbo9kTFpQNT2IuK7NMK','9867564334',1,'personal_info','2026-01-05 12:52:30','2026-01-06 10:06:24'),(6,'Anu','Shankari','S','anushankaris@gmail.com','user',16,'$2y$12$4AwoxZbHmVXncgxASe9t..s0BYzJWKZSdZe4xdSv5iGRk.oyuGUTe','9856473564',1,'started','2026-01-05 12:56:21','2026-01-06 11:43:12'),(7,'gokul','kumar','g','gokulkumar@gmail.com','user',22,'$2y$12$CmtzTzpj5f5CWY.tqyziWOPDpkcTFDny9ZFCQ7xrXMJFMol.EPCTS','9867564334',1,'started','2026-01-06 02:03:34','2026-01-06 12:40:13'),(8,'ahin','sree','n m','ahin@gmail.com','user',22,'$2y$12$0N.dvB6zOqaJx0vB6tLCwOKKsP.RxJDICCoeUSINjwx2RVQldiSky','9867564334',1,'documents_reuploaded','2026-01-06 02:05:19','2026-01-06 12:40:18'),(9,'anuja',NULL,'s','anuja@gmail.com','user',22,'$2y$12$GL.pIIp28uP.S2nbh4SErOrHM8NMIT7eTdhzqVEHXQc9J./pGHRK.','9867564334',1,'risk_done','2026-01-06 05:19:56','2026-01-06 12:40:36'),(10,'shyam',NULL,'s','shyam@gmail.com','user',16,'$2y$12$if9Q0a96rFX1lbsxgOubaOvY76A6CsjHUJWWcTqUzK1N4TIYg3yK6','9867564334',1,'otp_verified','2026-01-06 09:42:30','2026-01-06 10:37:35'),(11,'mohit','aakash','g','mohitaakash@gmail.com','user',NULL,'$2y$12$ozQBMPyJyzFq5DazQBZ.aOGQarHzJD6GixmYIwf0Z8N3bCBfwHKDq','9867564334',1,'otp_verified','2026-01-06 09:44:37','2026-01-06 09:45:07'),(13,'vishal',NULL,'g','vishal@gmail.com','user',18,'$2y$12$uwrQWSVfFp00JiRLkDHcsOVedB1Q.1s4NTvB5lncsfsMdapjlis5S','9867564334',1,'otp_verified','2026-01-06 09:55:31','2026-01-06 11:41:18'),(14,'surya',NULL,'s','surya@gmail.com','manager',NULL,'$2y$12$ZHSzk.rsZCgGosbCDy9/o.zsU9Q0Zgfj7G6HMQ8N/xrajJyPBZQXe','9867564334',1,'otp_verified','2026-01-06 10:03:08','2026-01-06 10:03:39'),(15,'mohith','aakash','g','mohithaakash@gmail.com','admin',NULL,'$2y$12$xp6svbPInPIjjcDjPJj/sOfQdMjzNpK4OcpVpvuuVN/EL.exjJ0SC','9867564334',1,'otp_verified','2026-01-06 10:04:28','2026-01-06 10:04:51'),(16,'joshua','henry','s','joshua@gmail.com','manager',NULL,'$2y$12$ZuMkbFzsHivifY.Q77YCVu.OPfFHTVfasZ5wOmZeMHvBnvudVPSKi','9867564334',1,'otp_verified','2026-01-06 10:23:25','2026-01-06 10:23:54'),(17,'pradeep',NULL,'s','pradeep@gmail.com','manager',NULL,'$2y$12$3mk.skHJ6kzezKeEDhxpqOlNph0Htu6LVY4mETACR4qsNICoogrz2','9867564334',1,'otp_verified','2026-01-06 11:07:58','2026-01-06 11:08:38'),(18,'prathi',NULL,'s','prathi@gmail.com','manager',NULL,'$2y$12$zBtqvQV56i0XmC3HRIZnQ.ZQd9qWVJE5I1Hmgkp1tp0FrcYGjb8k2','9867564334',1,'otp_verified','2026-01-06 11:28:14','2026-01-06 11:30:17'),(19,'Guru',NULL,'s','guru@gmail.com','admin',NULL,'$2y$12$UUzO0Wca7cnuPyNrHieoYOPterkFHe4g6xPOym/Bq4FbN3NCTrgLC','9867564334',1,'otp_verified','2026-01-06 11:34:10','2026-01-06 11:35:43'),(20,'Pravin',NULL,'P','pravin@gmail.com','user',NULL,'$2y$12$vg1bAxaeBf0pdQ40Nx4Tcusl.psKdcElBZmES0hm1.xATquEEJl1S','9867564334',1,'personal_info','2026-01-06 11:34:54','2026-01-06 11:56:03'),(21,'Prakash',NULL,'P','prakash@gmail.com','user',NULL,'$2y$12$4dGL8.mkC0QFcmA3Py/lD.je.WUodeNjIHIj8v/gU6N1NActttbLW','9867564334',1,'otp_verified','2026-01-06 11:56:59','2026-01-06 11:59:12'),(22,'sara',NULL,'P','sara@gmail.com','manager',NULL,'$2y$12$BuJ2L3U0dHFHaA4sDy2QzuCJ.9Tb4sLBG/mLQk4P6SKH0VOqX3XKe','9867564334',1,'otp_verified','2026-01-06 12:38:39','2026-01-06 12:39:10'),(23,'sarah',NULL,'P','sarah@gmail.com','user',NULL,'$2y$12$ZSUm/X20ouuyvmWksaJT4OyYtW2qK2w.u7FerOUHQIyLs0PvRz5H6','9867564334',1,'documents_reuploaded','2026-01-06 13:26:52','2026-01-06 13:30:49'),(24,'raj',NULL,'p','raj@gmail.com','admin',NULL,'$2y$12$XdTJr7Uls4gvCpv3RcoH6e0Yu9UxfeHflfYR2qvhbQW4uUVky6JmS','9867564334',1,'otp_verified','2026-01-06 13:35:59','2026-01-06 13:36:21'),(25,'lavanya',NULL,'s','lavanyasivasubramani@gmail.com','admin',NULL,'$2y$12$Qhgpuxh4WdgeFO3.CMz72e.vEBEUjnZ4gSsHJl9BKAfOA8cFcYT6e','7548834663',1,'otp_verified','2026-01-06 22:36:49','2026-01-06 22:37:13');
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

-- Dump completed on 2026-01-07 14:03:05
