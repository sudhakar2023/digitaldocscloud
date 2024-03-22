-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: drms
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_comments`
--

DROP TABLE IF EXISTS `document_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL DEFAULT '0',
  `document_id` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_comments`
--

LOCK TABLES `document_comments` WRITE;
/*!40000 ALTER TABLE `document_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_histories`
--

DROP TABLE IF EXISTS `document_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document` int NOT NULL DEFAULT '0',
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_user` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_histories`
--

LOCK TABLES `document_histories` WRITE;
/*!40000 ALTER TABLE `document_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  `sub_category_id` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `tages` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
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
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `logged_histories`
--

DROP TABLE IF EXISTS `logged_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logged_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logged_histories`
--

LOCK TABLES `logged_histories` WRITE;
/*!40000 ALTER TABLE `logged_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `logged_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2020_05_21_065337_create_permission_tables',1),(6,'2021_05_08_100002_create_subscriptions_table',1),(7,'2021_05_08_124950_create_settings_table',1),(8,'2021_05_10_171906_create_supports_table',1),(9,'2021_05_29_180034_create_notice_boards_table',1),(10,'2021_05_29_183858_create_contacts_table',1),(11,'2021_05_30_000713_create_support_replies_table',1),(12,'2021_05_30_170848_create_orders_table',1),(13,'2023_07_23_051513_create_documents_table',1),(14,'2023_07_23_052655_create_categories_table',1),(15,'2023_07_23_052715_create_sub_categories_table',1),(16,'2023_07_23_105702_create_tags_table',1),(17,'2023_07_31_160008_create_document_comments_table',1),(18,'2023_07_31_170000_create_reminders_table',1),(19,'2023_08_01_161941_create_version_histories_table',1),(20,'2023_08_02_145848_create_share_documents_table',1),(21,'2023_08_03_172747_create_document_histories_table',1),(22,'2023_08_04_164513_create_logged_histories_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',2),(2,'App\\Models\\User',3),(3,'App\\Models\\User',4);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice_boards`
--

DROP TABLE IF EXISTS `notice_boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notice_boards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice_boards`
--

LOCK TABLES `notice_boards` WRITE;
/*!40000 ALTER TABLE `notice_boards` DISABLE KEYS */;
/*!40000 ALTER TABLE `notice_boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_id` int NOT NULL,
  `price` double(8,2) NOT NULL,
  `price_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'manage user','web','2023-12-24 08:53:24','2023-12-24 08:53:24'),(2,'create user','web','2023-12-24 08:53:24','2023-12-24 08:53:24'),(3,'edit user','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(4,'delete user','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(5,'manage role','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(6,'create role','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(7,'edit role','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(8,'delete role','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(9,'manage contact','web','2023-12-24 08:53:25','2023-12-24 08:53:25'),(10,'create contact','web','2023-12-24 08:53:26','2023-12-24 08:53:26'),(11,'edit contact','web','2023-12-24 08:53:26','2023-12-24 08:53:26'),(12,'delete contact','web','2023-12-24 08:53:26','2023-12-24 08:53:26'),(13,'manage support','web','2023-12-24 08:53:26','2023-12-24 08:53:26'),(14,'create support','web','2023-12-24 08:53:26','2023-12-24 08:53:26'),(15,'edit support','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(16,'delete support','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(17,'reply support','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(18,'manage note','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(19,'create note','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(20,'edit note','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(21,'delete note','web','2023-12-24 08:53:27','2023-12-24 08:53:27'),(22,'manage account settings','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(23,'manage password settings','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(24,'manage general settings','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(25,'manage company settings','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(26,'manage category','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(27,'create category','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(28,'edit category','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(29,'delete category','web','2023-12-24 08:53:28','2023-12-24 08:53:28'),(30,'manage sub category','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(31,'create sub category','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(32,'edit sub category','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(33,'delete sub category','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(34,'manage tag','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(35,'create tag','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(36,'edit tag','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(37,'delete tag','web','2023-12-24 08:53:29','2023-12-24 08:53:29'),(38,'manage document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(39,'create document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(40,'edit document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(41,'delete document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(42,'show document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(43,'manage my document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(44,'edit my document','web','2023-12-24 08:53:30','2023-12-24 08:53:30'),(45,'delete my document','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(46,'show my document','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(47,'create my document','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(48,'manage reminder','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(49,'create reminder','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(50,'edit reminder','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(51,'delete reminder','web','2023-12-24 08:53:31','2023-12-24 08:53:31'),(52,'show reminder','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(53,'manage my reminder','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(54,'manage document history','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(55,'download document','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(56,'preview document','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(57,'manage comment','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(58,'create comment','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(59,'manage version','web','2023-12-24 08:53:32','2023-12-24 08:53:32'),(60,'create version','web','2023-12-24 08:53:33','2023-12-24 08:53:33'),(61,'manage share document','web','2023-12-24 08:53:33','2023-12-24 08:53:33'),(62,'delete share document','web','2023-12-24 08:53:33','2023-12-24 08:53:33'),(63,'create share document','web','2023-12-24 08:53:33','2023-12-24 08:53:33'),(64,'manage mail','web','2023-12-24 08:53:33','2023-12-24 08:53:33'),(65,'send mail','web','2023-12-24 08:53:33','2023-12-24 08:53:33'),(66,'manage logged history','web','2023-12-24 08:53:33','2023-12-24 08:53:33');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reminders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `message` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `assign_user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_email` int NOT NULL DEFAULT '0',
  `document_id` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(9,3),(10,3),(11,3),(12,3),(13,3),(14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(43,3),(44,3),(45,3),(46,3),(47,3),(52,3),(53,3),(55,3),(56,3),(57,3),(58,3),(59,3),(61,3),(63,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'owner','web',1,'2023-12-24 08:53:34','2023-12-24 08:53:34'),(2,'manager','web',2,'2023-12-24 08:53:44','2023-12-24 08:53:44'),(3,'employee','web',2,'2023-12-24 08:53:53','2023-12-24 08:53:53');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_parent_id_unique` (`name`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `share_documents`
--

DROP TABLE IF EXISTS `share_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `share_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `document_id` int NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `share_documents`
--

LOCK TABLES `share_documents` WRITE;
/*!40000 ALTER TABLE `share_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `share_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_user` int DEFAULT NULL,
  `total_document` int DEFAULT NULL,
  `enabled_document_history` int NOT NULL DEFAULT '0',
  `enabled_logged_history` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,'Basic',0.00,'Unlimit',NULL,5,5,1,1,NULL,'2023-12-24 08:53:58','2023-12-24 08:53:58');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_replies`
--

DROP TABLE IF EXISTS `support_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `support_id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_replies`
--

LOCK TABLES `support_replies` WRITE;
/*!40000 ALTER TABLE `support_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supports`
--

DROP TABLE IF EXISTS `supports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_id` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supports`
--

LOCK TABLES `supports` WRITE;
/*!40000 ALTER TABLE `supports` DISABLE KEYS */;
/*!40000 ALTER TABLE `supports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription` int DEFAULT NULL,
  `subscription_expire_date` date DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','superadmin@gmail.com','super admin','avatar.png','english',NULL,NULL,0,NULL,'$2y$10$fTgJLHs9SGKns/pj7Mc79ufY./3V2rpkvL93Cz1yS6pkTA.EfjNzi',1,NULL,'2023-12-24 08:53:34','2023-12-24 08:53:34'),(2,'Owner','owner@gmail.com','admin','avatar.png','english',1,NULL,1,NULL,'$2y$10$YWjUAsEFsOLaGCSH8Ihx.uQ22yM8jKmv5hC/HFJTBeGU4HuZyERym',1,NULL,'2023-12-24 08:53:44','2023-12-24 08:53:44'),(3,'Manager','manager@gmail.com','manager','avatar.png','english',0,NULL,2,NULL,'$2y$10$vTkfVnorUc.Qh25Hl0OtCelVz/2sI/gRtWNlXqiBwbMigQwEKp.26',1,NULL,'2023-12-24 08:53:53','2023-12-24 08:53:53'),(4,'Employee','employee@gmail.com','employee','avatar.png','english',0,NULL,2,NULL,'$2y$10$MdH88EIFZ9CQU4hCeh6oXe8w5mJ3U7zid7i55L9KlvtUekSsWZj8i',1,NULL,'2023-12-24 08:53:57','2023-12-24 08:53:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `version_histories`
--

DROP TABLE IF EXISTS `version_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `version_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `document_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `version_histories`
--

LOCK TABLES `version_histories` WRITE;
/*!40000 ALTER TABLE `version_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `version_histories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-24 15:32:19
