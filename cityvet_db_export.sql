-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cityvet_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('event','notice','trivia') NOT NULL DEFAULT 'event',
  `date_when` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category` enum('Event','Trivia','Holiday Notice','Fun Fact') DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_user_id_foreign` (`user_id`),
  CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'Pet Adoption Day: Find Your Furry Friend!','Join us for our special weekend adoption event! We have dozens of healthy, vaccinated dogs and cats ready for their forever homes. All adoption fees will be waived for pre-approved applications. Don\'t forget to bring ID and proof of address.','event','December 7, 2025','Plaza',NULL,'2025-11-26 03:30:48','2025-11-26 03:30:48',NULL,'Event',NULL),(2,'Pet Trivia Challenge: The Sleeping Cat!','How much do cats really sleep? Test your knowledge! Cats spend an average of two-thirds of their lives sleeping, which means a nine-year-old cat has only been awake for three years! Is this true or false? Answer below!','event','N/As','N/A',NULL,'2025-11-26 03:48:00','2025-12-13 15:05:03',NULL,'Trivia',NULL);
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"40eb9f8d-db1d-4f17-a5bf-004dae926a22\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"4c2cb828-0ac1-47d8-96a6-44927b0b242a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764072857,\"delay\":null}',0,NULL,1764072857,1764072857),(2,'default','{\"uuid\":\"606db69a-f2a2-4e2f-8816-809c8c534adc\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"6046e61f-c556-49ea-ba21-0bc18c1fed30\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764073296,\"delay\":null}',0,NULL,1764073297,1764073297),(3,'default','{\"uuid\":\"9230b39b-96a5-473c-a7f5-059f5b053d94\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"93078b9d-6d19-478c-8abf-41b78384912c\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764073425,\"delay\":null}',0,NULL,1764073425,1764073425),(4,'default','{\"uuid\":\"bd230199-c0aa-439d-b19a-ce3f312bb728\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:14;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"da10c635-067f-4fbf-8a0c-7769935e4436\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764078447,\"delay\":null}',0,NULL,1764078447,1764078447),(5,'default','{\"uuid\":\"edeecc6d-1788-42e5-a90a-625444936029\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"7880930a-7e47-48d0-9d4c-649c0e870535\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764078870,\"delay\":null}',0,NULL,1764078870,1764078870),(6,'default','{\"uuid\":\"eab7c5a5-00e1-461d-a587-a7217f64099b\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"f26a6fce-c7a0-4fa9-bd20-6146e9ba41a9\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764080635,\"delay\":null}',0,NULL,1764080635,1764080635),(7,'default','{\"uuid\":\"bac8c633-0386-4af0-97e6-a66040ced551\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:15;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"6b5481ea-d282-40c8-b522-1cb0a2da4d81\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764117626,\"delay\":null}',0,NULL,1764117626,1764117626),(8,'default','{\"uuid\":\"f028698b-6372-4fc8-89bd-70391a36c3e7\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"fc95d3e7-0de3-4470-8304-cb9ca40ea457\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764144549,\"delay\":null}',0,NULL,1764144549,1764144549),(9,'default','{\"uuid\":\"1d9d8fc9-66e3-45c3-ace3-b4a78db2097c\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:15;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:6:\\\"denied\\\";s:2:\\\"id\\\";s:36:\\\"86c9f36e-eecd-4b7f-afed-fb51d6b6c66f\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764144566,\"delay\":null}',0,NULL,1764144566,1764144566),(10,'default','{\"uuid\":\"fe496be5-7f0b-424c-8cc8-d4966a04bed4\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:2:{i:0;s:11:\\\"requestable\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:9:\\\"completed\\\";s:2:\\\"id\\\";s:36:\\\"f69bb570-6f2c-432d-898f-cce297671e75\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764144566,\"delay\":null}',0,NULL,1764144566,1764144566),(11,'default','{\"uuid\":\"35c35c88-d138-41f6-ad2b-6983802b95a3\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"ab245979-9194-4078-8a03-fa7873a8b84b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764146082,\"delay\":null}',0,NULL,1764146082,1764146082),(12,'default','{\"uuid\":\"0e26d074-a529-4145-ae83-43a2e5f9a2a8\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:15;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:6:\\\"denied\\\";s:2:\\\"id\\\";s:36:\\\"55c80320-6d71-418a-9acc-3b01b07c68ce\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764146106,\"delay\":null}',0,NULL,1764146106,1764146106),(13,'default','{\"uuid\":\"02ad39f1-8fd8-4e50-b485-93d7c534ed71\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:2:{i:0;s:11:\\\"requestable\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:9:\\\"completed\\\";s:2:\\\"id\\\";s:36:\\\"fd50860a-b61e-4b25-990f-265ac881995f\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1764146106,\"delay\":null}',0,NULL,1764146106,1764146106),(14,'default','{\"uuid\":\"e3b8d8ed-0231-4c03-9873-3e54f9d258f8\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"92f3d141-ed3c-4611-bb1d-53b4903454cc\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1765115996,\"delay\":null}',0,NULL,1765115996,1765115996),(15,'default','{\"uuid\":\"34e1c074-4594-4e2c-a54d-0ca0287cf0d2\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:6:\\\"denied\\\";s:2:\\\"id\\\";s:36:\\\"e1b77b8f-62df-4869-950b-f2c515263e6a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1765117014,\"delay\":null}',0,NULL,1765117014,1765117014),(16,'default','{\"uuid\":\"192b611d-910c-468d-86d1-2a4fe97b00b5\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:15;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:2:{i:0;s:11:\\\"requestable\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:9:\\\"completed\\\";s:2:\\\"id\\\";s:36:\\\"dab598ff-6243-4995-a6bb-c112621ee2b3\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1765117014,\"delay\":null}',0,NULL,1765117014,1765117014),(17,'default','{\"uuid\":\"6683372c-8241-47b2-b10e-7d64e2579cdd\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:8:\\\"approved\\\";s:2:\\\"id\\\";s:36:\\\"f9535f2e-1a3f-4325-9348-47e00aabe067\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1765203650,\"delay\":null}',0,NULL,1765203650,1765203650),(18,'default','{\"uuid\":\"dfde5468-4672-4d06-85d3-fa611e2879c0\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:2:{i:0;s:11:\\\"requestable\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:9:\\\"completed\\\";s:2:\\\"id\\\";s:36:\\\"367a6968-f914-4e08-8f67-49c14b053b72\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1765631158,\"delay\":null}',0,NULL,1765631158,1765631158),(19,'default','{\"uuid\":\"c939f89c-21c8-4891-b31c-81d7f20558c5\",\"displayName\":\"App\\\\Notifications\\\\RequestStatusNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:13;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\RequestStatusNotification\\\":3:{s:13:\\\"\\u0000*\\u0000petRequest\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\PetRequest\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:2:{i:0;s:11:\\\"requestable\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"\\u0000*\\u0000status\\\";s:9:\\\"completed\\\";s:2:\\\"id\\\";s:36:\\\"4d85b704-8eaf-4d55-b2a0-6640db45ad9a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1765631193,\"delay\":null}',0,NULL,1765631193,1765631193);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_10_05_083151_add_role_to_users_table',1),(5,'2025_10_05_094157_create_pets_table',1),(6,'2025_10_05_094207_create_posters_table',1),(7,'2025_10_05_094217_create_requests_table',1),(8,'2025_10_16_000000_add_user_name_fields_and_address',1),(9,'2025_10_31_130746_add_photos_and_additional_data_to_pet_requests_table',1),(10,'2025_11_02_061826_add_location_and_decision_date_to_pets_table',1),(11,'2025_11_02_065246_add_registration_status_to_pets_table',1),(12,'2025_11_02_120311_add_address_and_emergency_contact_to_users_table',1),(13,'2025_11_06_111006_add_reason_for_adoption_to_pets_table',1),(14,'2025_11_08_072555_create_announcements_table',1),(15,'2025_11_12_112707_add_policy_fields_to_users_table',1),(16,'2025_11_14_000000_add_published_at_and_status_to_announcements_table',1),(17,'2025_11_14_094643_add_description_to_posters_table',1),(18,'2025_11_14_131041_add_status_to_posters_table',1),(19,'2025_11_14_133509_make_pet_name_nullable_in_posters_table',1),(20,'2025_11_15_000000_drop_user_id_and_status_from_announcements_table',1),(21,'2025_11_15_153029_add_uploader_comments_to_posters_table',1),(22,'2025_11_15_162018_add_pending_to_pets_status_enum',1),(23,'2025_11_15_171543_add_adoption_reason_to_pets_table',1),(24,'2025_11_16_100659_add_gender_and_birthday_to_users_table',1),(25,'2025_11_16_165741_remove_pet_name_from_impounded_and_adoptable_pets',1),(26,'2025_11_16_165939_make_pet_name_nullable_in_pets_table',1),(27,'2025_11_16_171650_add_photos_to_pets_table',1),(28,'2025_11_16_213824_update_announcements_table_for_new_categories',1),(29,'2025_11_17_004145_make_user_id_nullable_in_announcements_table',1),(30,'2025_11_17_034234_replace_birth_date_with_estimated_age_in_pets_table',1),(31,'2025_11_17_170307_change_date_when_to_string_in_announcements_table',1),(32,'2025_11_17_173536_create_pet_registrations_table',1),(33,'2025_11_18_012756_add_unclaimed_unadopted_statuses_to_pets_table',1),(34,'2025_11_18_015949_add_decision_date_to_pets_table',1),(35,'2025_11_20_091133_add_id_photo_to_users_table',1),(36,'2025_11_21_114023_update_pet_registrations_status_enum',1),(37,'2025_11_21_124236_create_pet_requests_table',1),(38,'2025_11_21_130200_add_urgent_deadline_to_pets_table',1),(39,'2025_11_22_000000_add_completed_at_to_pet_requests',1),(40,'2025_11_22_010000_drop_completed_at_from_pet_requests',1),(41,'2025_11_22_024135_verify_pet_requests_status_enum',1),(42,'2025_11_22_120000_add_denial_reason_to_pet_registrations_table',1),(43,'2025_11_23_120000_add_adoption_notes_to_pets_table',1),(44,'2025_11_24_212228_add_denial_reason_to_pet_requests_table',1),(45,'2025_11_25_000000_add_denial_type_to_pet_requests_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_registrations`
--

DROP TABLE IF EXISTS `pet_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_registrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `species` enum('Canine','Feline') NOT NULL,
  `breed` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female','unknown') NOT NULL,
  `color_markings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`color_markings`)),
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('pending','registered','denied') NOT NULL DEFAULT 'pending',
  `denial_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pet_registrations_user_id_foreign` (`user_id`),
  CONSTRAINT `pet_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_registrations`
--

LOCK TABLES `pet_registrations` WRITE;
/*!40000 ALTER TABLE `pet_registrations` DISABLE KEYS */;
INSERT INTO `pet_registrations` VALUES (1,13,'Chewy','Canine','Shih Tzu','2019-12-21','male','[\"Black\",\"White\"]','Grumpy','pet-registrations/TxpXo8qdnaQTU9BgDKrHInWAsCStzejxgfVQPpgQ.jpg','registered',NULL,'2025-11-25 12:18:59','2025-11-25 13:26:04'),(2,14,'Bella','Feline','Siamese','2021-10-21','female','[\"Black\",\"Cream\"]','Playful','pet-registrations/XPt4am5noh3YMSfOS0iKcWNxY4vH8THTU5Z2kcoo.jpg','registered',NULL,'2025-11-25 13:25:52','2025-11-26 00:45:04'),(3,13,'Douglas','Canine','Aspin','2022-06-17','female','[\"Black\",\"White\",\"Brown\"]','Hyper.','pet-registrations/QvH9g8axjnrSaI2tY0vZrGLg42iDsvPntjTAFfGj.jpg','pending','Need clear','2025-11-25 13:34:46','2025-11-26 08:15:33'),(4,13,'Katie','Feline','Philippine Domestic Cat','2021-10-21','female','[\"White\",\"Orange\"]','Kind','pet-registrations/3LGvDIpuhcCRR6rWOtSxq6nTYsKxbLUqoHmabXTa.jpg','pending',NULL,'2025-11-26 00:43:32','2025-11-26 00:43:32'),(5,13,'Bella','Canine','Maltese','2020-10-21','female','[\"White\"]','Hyper','pet-registrations/HTumNquq5hp4u0TY17NmfNWtY6kx6mPJJ3mjFSwH.jpg','pending',NULL,'2025-11-26 08:14:35','2025-11-26 08:14:35');
/*!40000 ALTER TABLE `pet_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_requests`
--

DROP TABLE IF EXISTS `pet_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `requestable_id` bigint(20) unsigned DEFAULT NULL,
  `requestable_type` varchar(255) DEFAULT NULL,
  `type` enum('claim','adopt','register') NOT NULL,
  `status` enum('pending','approved','denied','completed') DEFAULT 'pending',
  `denial_reason` varchar(255) DEFAULT NULL COMMENT 'Reason why request was denied',
  `denial_type` enum('manual','automatic') DEFAULT NULL COMMENT 'Type of denial: manual (admin) or automatic (system)',
  `reason` text NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photos`)),
  `additional_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_data`)),
  PRIMARY KEY (`id`),
  KEY `pet_requests_user_id_foreign` (`user_id`),
  KEY `pet_requests_requestable_type_requestable_id_index` (`requestable_type`,`requestable_id`),
  CONSTRAINT `pet_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_requests`
--

LOCK TABLES `pet_requests` WRITE;
/*!40000 ALTER TABLE `pet_requests` DISABLE KEYS */;
INSERT INTO `pet_requests` VALUES (1,13,2,'App\\Models\\Pet','claim','completed',NULL,NULL,'Jasper is a highly affectionate','09123520147',NULL,'2025-11-25 11:58:45','2025-11-25 12:19:38',NULL,'[\"requests\\/3JmVIl63KITo2mme8JdWYNKbnadNEE4kQdK66IZs.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(3,13,4,'App\\Models\\Pet','adopt','completed',NULL,NULL,'companion','09123520147',NULL,'2025-11-25 12:23:26','2025-11-25 12:23:52',NULL,'[\"requests\\/6OIqi4IwOrWez0aareEO4PNZOVS8hU3jCfPDxBmI.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"dwelling_type\":\"owned\",\"landlord_permission\":\"yes\",\"fenced_property\":\"yes\",\"adults_count\":\"2\",\"children_count\":\"4\",\"allergies\":\"no\",\"other_pets\":\"yes\",\"other_pets_list\":\"1 Cat\",\"pet_living_area\":\"outdoors\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(4,14,3,'App\\Models\\Pet','claim','completed',NULL,NULL,'Mahaba kuko','09123025478',NULL,'2025-11-25 13:45:42','2025-11-25 13:54:44',NULL,'[\"requests\\/KnsiDZAdb5Mph7KMHOgxvMAgeJLWNbRfjsNQQMNA.jpg\"]','{\"first_name\":\"Find\",\"last_name\":\"Furever\",\"middle_name\":\"Paw\",\"address\":\"Palali, Poblacion, Alaminos City\",\"contact_number\":\"09123025478\",\"email\":\"findfurever87@gmail.com\",\"date_of_birth\":\"2000-02-16\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/gvHAHOwXArWBcBvmzxSbWgueyVpPnWG4G7RdrCpW.png\"}'),(5,13,3,'App\\Models\\Pet','claim','denied','Other applicant was chosen','automatic','May sugat sa tenga','09123520147',NULL,'2025-11-25 13:46:30','2025-11-25 13:54:44',NULL,'[\"requests\\/Pmzr5qae5fEKyvCRPZT8OAmXO50rsxi7bNyZrNiT.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(6,13,6,'App\\Models\\Pet','claim','completed',NULL,NULL,'Makulit tas matakaw','09123520147',NULL,'2025-11-25 13:56:22','2025-12-13 13:06:33',NULL,'[\"requests\\/qJGoBYIID5KrvB9CfG6XWGQj9fea0i4qtEAMTpb4.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(7,15,5,'App\\Models\\Pet','claim','completed',NULL,NULL,'May sugat sa tenga','09123456789',NULL,'2025-11-26 00:35:04','2025-12-07 14:16:54',NULL,'[\"requests\\/5b9xHgq7zaD8HYhEZv0Eydicwz28juJrB41rQfmO.jpg\"]','{\"first_name\":\"Hunter\",\"last_name\":\"Smith\",\"middle_name\":\"Reyes\",\"address\":\"Palali, Poblacion, Alaminos City\",\"contact_number\":\"09123456789\",\"email\":\"xhunter.smith12@gmail.com\",\"date_of_birth\":\"2001-10-21\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/usMUGKMHwaiilwdweW4ziNg8RYeR2Q8Y1rQXg2ch.png\"}'),(8,13,9,'App\\Models\\Pet','claim','completed',NULL,NULL,'Sugat sa tenga','09123520147',NULL,'2025-11-26 08:07:06','2025-11-26 08:09:26',NULL,'[\"requests\\/3nTxSGDuA5O74oA6AIloOeYajtbJLx2a66lc92mA.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(9,15,9,'App\\Models\\Pet','adopt','denied','Other applicant was chosen',NULL,'Companion','09123456789',NULL,'2025-11-26 08:08:14','2025-11-26 08:09:26',NULL,'[\"requests\\/okzZiRPPVpzBe20NG0RrXu0E43kziXE8210ig801.jpg\"]','{\"first_name\":\"Hunter\",\"last_name\":\"Smith\",\"middle_name\":\"Reyes\",\"address\":\"Palali, Poblacion, Alaminos City\",\"contact_number\":\"09123456789\",\"email\":\"xhunter.smith12@gmail.com\",\"date_of_birth\":\"2001-10-21\",\"dwelling_type\":\"owned\",\"landlord_permission\":\"no\",\"fenced_property\":\"yes\",\"adults_count\":\"1\",\"children_count\":\"2\",\"allergies\":\"no\",\"other_pets\":\"yes\",\"other_pets_list\":\"1 cat\",\"pet_living_area\":\"indoors\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/usMUGKMHwaiilwdweW4ziNg8RYeR2Q8Y1rQXg2ch.png\"}'),(10,13,5,'App\\Models\\Pet','claim','denied','Other applicant was chosen',NULL,'Putol ang buntot','09123520147',NULL,'2025-11-26 08:30:22','2025-12-07 14:16:54',NULL,'[\"requests\\/XtF08v3hi6xj85R2tRu3RBV7DNY0Aw95G57itcRA.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(11,13,10,'App\\Models\\Pet','claim','completed',NULL,NULL,'Mabango','09123520147',NULL,'2025-11-26 08:32:22','2025-11-26 08:35:06',NULL,'[\"requests\\/zzVReR5ibFNgcWWOUTSQ1Vskhqfmj0895LJZSkcj.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(12,15,10,'App\\Models\\Pet','claim','denied','Other applicant was chosen',NULL,'N/a','09123456789',NULL,'2025-11-26 08:33:20','2025-11-26 08:35:06',NULL,'[\"requests\\/9L9gTd9HaO4mfmy3l7abNEFFfI1iTFxZen8bjw4Q.jpg\"]','{\"first_name\":\"Hunter\",\"last_name\":\"Smith\",\"middle_name\":\"Reyes\",\"address\":\"Palali, Poblacion, Alaminos City\",\"contact_number\":\"09123456789\",\"email\":\"xhunter.smith12@gmail.com\",\"date_of_birth\":\"2001-10-21\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/usMUGKMHwaiilwdweW4ziNg8RYeR2Q8Y1rQXg2ch.png\"}'),(13,13,12,'App\\Models\\Pet','claim','completed',NULL,NULL,'Sasas','09123520147',NULL,'2025-12-07 13:59:26','2025-12-07 14:00:11',NULL,'[\"requests\\/f8YRH3GLHuio6xNeUr8n7t7TzfVbBGNLIzoDRJ6w.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}'),(14,13,13,'App\\Models\\Pet','claim','completed',NULL,NULL,'N/a','09123520147',NULL,'2025-12-08 11:50:03','2025-12-13 13:05:54',NULL,'[\"requests\\/zvFBYPSqBLKeyIeVYZ6VvqcnqQZovFRqYoTGkOfT.jpg\"]','{\"first_name\":\"Erricca\",\"last_name\":\"Morales\",\"middle_name\":\"Carbonell\",\"address\":\"Pandayan, Poblacion, Alaminos City\",\"contact_number\":\"09123520147\",\"email\":\"erricca.morales12@gmail.com\",\"date_of_birth\":\"2003-06-17\",\"certify_info\":\"on\",\"agree_terms\":\"on\",\"id_photo_path\":\"id_photos\\/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png\"}');
/*!40000 ALTER TABLE `pet_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `gender` enum('male','female','unknown') NOT NULL,
  `estimated_age_years` int(11) DEFAULT NULL,
  `estimated_age_months` int(11) DEFAULT NULL,
  `color_markings` text NOT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photos`)),
  `status` enum('registered','impounded','adoptable','adopted','claimed','unclaimed','unadopted') NOT NULL DEFAULT 'registered',
  `registration_status` enum('pre-registered','approved','denied') NOT NULL DEFAULT 'pre-registered',
  `admin_notes` text DEFAULT NULL,
  `impounded_date` date DEFAULT NULL,
  `caught_location` varchar(255) DEFAULT NULL,
  `decision_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `adoption_reason` enum('surrendered_by_owner','remained_unclaimed','found_by_citizen','other') DEFAULT NULL,
  `adoption_notes` text DEFAULT NULL,
  `adoption_reason_other` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pets_user_id_foreign` (`user_id`),
  CONSTRAINT `pets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets`
--

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
INSERT INTO `pets` VALUES (1,13,'PET0001','Canine','Maltese','female',2,0,'White','Very friendly with dogs','pets/FUydsMHtqWJOhBaJKsDNYSQLhP3RlLDJGTPLhFV6.jpg',NULL,'claimed','pre-registered',NULL,'2025-11-25','Cpark','2025-11-25','2025-11-25 11:39:40','2025-11-25 12:21:43',NULL,NULL,NULL,NULL),(2,13,'PET0002','Canine','Golden Retriever','male',0,0,'Brown','Friendly and Approachable','pets/wAX3lwV3i16rL5hnXS87YcYU4FpY4ysouLq9Emr4.jpg',NULL,'claimed','pre-registered',NULL,NULL,NULL,'2025-11-25','2025-11-25 11:41:29','2025-11-25 12:19:38',NULL,'other','N/A','Lifestyle/Schedule Change'),(3,14,'PET0003','Canine','Shih Tzu','male',2,0,'Black,White,Brown','Enjoys being near and receiving physical attention','pets/qjonSkvWTuhmrZBepclbbgbilhd6Kk5RxqVAaCVw.jpg',NULL,'claimed','pre-registered',NULL,'2025-11-25','Suki Market','2025-11-25','2025-11-25 11:43:09','2025-11-25 13:54:44',NULL,NULL,NULL,NULL),(4,13,'PET0004','Canine','Aspin','female',3,5,'Brown','Gets along well with other canines','pets/8lZa1pepSPDX1aEGHE3AqPQ95dvpjRqX09WBd46J.jpg',NULL,'adopted','pre-registered',NULL,NULL,NULL,'2025-11-25','2025-11-25 11:44:19','2025-11-25 12:23:52',NULL,'surrendered_by_owner','N/A','Owner Relocation/Moving'),(5,15,'PET0005','Feline','Siamese','male',0,10,'Black,Cream','Generally calm','pets/ZPZJwmFRRieG5b4DN7ocvcMeLAXTkesvDvAXMY7z.jpg',NULL,'claimed','pre-registered',NULL,'2025-11-25','Barangay Lucap','2025-11-28','2025-11-25 11:49:15','2025-12-07 14:16:54',NULL,NULL,NULL,NULL),(7,NULL,'PET0007','Feline','Philippine Domestic Cat','male',0,7,'Orange','Generally enjoys interaction with people','pets/1AK0NJp90WRzLiQ2x5jB9FPQnBa5qwDGc1VEIm3V.jpg',NULL,'unadopted','pre-registered',NULL,'2025-11-25','Barangay Pocalpocal','2025-11-28','2025-11-25 11:53:38','2025-12-02 12:47:23',NULL,NULL,NULL,NULL),(8,NULL,'PET0008','Canine','Aspin','male',4,0,'Brown','extremely gentle and patient low-energy','pets/MVtQlrm6NdjfvGdr7U9M3Pi6Vod2dulEmiWqnuHK.jpg',NULL,'unadopted','pre-registered',NULL,'2025-11-25',NULL,'2025-11-28','2025-11-25 11:56:40','2025-12-02 12:47:23',NULL,NULL,NULL,NULL),(9,13,'PET0009','Feline','Philippine Domestic Cat','female',1,0,'Black','Affectionate & Playful','pets/zrMHuNX14KfCjhBBGT2qgHbqm52kbSCigKkx3D6S.jpg',NULL,'claimed','pre-registered',NULL,NULL,NULL,'2025-11-25','2025-11-25 13:17:08','2025-11-26 08:09:26',NULL,'other','N/A','Lifestyle/Schedule Change'),(10,13,'PET0010','Feline','Persian','female',2,1,'White','Small','pets/MORxEshfgMwKWdzANJYcS4JanAn3nvEU3M90arKu.jpg',NULL,'claimed','pre-registered',NULL,NULL,NULL,'2025-11-26','2025-11-26 08:19:19','2025-11-26 08:35:06',NULL,'surrendered_by_owner','N/A','Owner Relocation/Moving'),(11,NULL,'PET0011','Feline','Philippine Domestic Cat','male',2,2,'Cream','N/A','pets/wjNrZNTChX5YdS9r78uwMjFb6SIgKIaoravSj6v3.jpg',NULL,'unadopted','pre-registered',NULL,'2025-11-28','Suki','2025-12-01','2025-12-02 12:46:31','2025-12-07 13:56:13',NULL,NULL,NULL,NULL),(12,13,'PET0012','Feline','Philippine Domestic Cat','male',9,1,'White','Cute bubbly Cat','pets/uP6MXZ5K9RLDT8I9xFIFuYPbBU7BHSJbqlbp1mb6.jpg',NULL,'claimed','pre-registered',NULL,'2025-12-04','Suki Market','2025-12-07','2025-12-07 13:49:44','2025-12-07 14:00:11',NULL,NULL,NULL,NULL),(14,NULL,'PET0014','Feline','Philippine Domestic Cat','female',1,1,'Orange','N/a','pets/ANnPnRJdGop0LqCHMAmKO0YVy4pPhfccyxPpQq8y.jpg',NULL,'unadopted','pre-registered',NULL,NULL,NULL,'2025-12-07','2025-12-07 15:04:59','2025-12-13 11:00:34',NULL,'other','N/a','Financial Hardship'),(16,NULL,'PET0016','Feline','Philippine Domestic Cat','male',9,0,'Black','Calm','pets/u4d0Ixaap4hPqjVa8R42veFo7GVfInGgXq5AIYTL.jpg',NULL,'adoptable','pre-registered',NULL,'2025-12-13','Plaza','2025-12-16','2025-12-14 03:35:48','2025-12-17 17:15:43',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posters`
--

DROP TABLE IF EXISTS `posters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` enum('lost','found') NOT NULL,
  `pet_name` varchar(255) DEFAULT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `gender` enum('male','female','unknown') NOT NULL,
  `color_markings` text NOT NULL,
  `description` text DEFAULT NULL,
  `uploader_comments` text DEFAULT NULL,
  `date_lost_found` date NOT NULL,
  `last_seen` text DEFAULT NULL,
  `found_at` text DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `contact_info` text NOT NULL,
  `reward` decimal(8,2) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','reunited') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posters_user_id_foreign` (`user_id`),
  CONSTRAINT `posters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posters`
--

LOCK TABLES `posters` WRITE;
/*!40000 ALTER TABLE `posters` DISABLE KEYS */;
INSERT INTO `posters` VALUES (1,14,'lost','Douglas','Canine','Aspin','male','White,Gray','Grumpy','Contact me asap po thank youuuuu','2025-11-24','Cpark',NULL,'posters/kt4nMmg8eoxoKVFH5lGCGEM8w65EZKrQMYvWRe6i.jpg','https://www.facebook.com/',1000.00,1,'active','2025-11-25 13:19:32','2025-11-25 13:19:32'),(2,14,'found',NULL,'Feline','Philippine Domestic Cat','female','Black,White,Gray','Makulit','Contact niyo nlng po ako sa Fb \r\nhttps://www.facebook.com/ or sa phone number ko po','2025-11-24',NULL,'Likod ng Nepo','posters/shoaWRXuidzug4tu5oMgmFrg833UN5xCGexKQjSM.jpg','091203251201',NULL,1,'active','2025-11-25 13:22:34','2025-11-25 13:22:34'),(5,15,'lost','Peter','Feline','Philippine Domestic Cat','male','Black','Calm','that cat doesn\'t like to entertain','2025-12-09','Plaza',NULL,'posters/slXD7ESTWK89AC2kRe2fan0hlRK46k8pVQ7XTFG9.jpg','032165498777',500.00,1,'active','2025-12-14 02:36:41','2025-12-14 02:36:41');
/*!40000 ALTER TABLE `posters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('IvzLeauzeCoF0FvEohInmSXYJCoDrC0LcS2FzE6d',14,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU2pMSHl6VjJ5Nk9xM1hDb21TMGNod2s1cTJxQk9uVVlRaEdaR1hzMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teS1yZXF1ZXN0cz9zdGF0dXM9cGVuZGluZyI7czo1OiJyb3V0ZSI7czoxMzoidXNlci5yZXF1ZXN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O30=',1764082040),('lIxrygskF1LIXkfnfhjl5wgQioVvbTdXG8CX8Mdp',13,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmtMMXBLWkdwOXQ1eTNhbnNTT3JKYTFvNm1ub09Odmd5SnQ3dDA4byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTM7fQ==',1764082040),('XRM0TVLfCCRIcc7iOhcP2RKXfy66NZKMXHwk84aJ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzZuSW9idFVPT3MyRE1GR1JRTGRZM05HOWFzNEpLejQzOVljQXBieiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1764115100),('ZVQE1bNpAEvra2YfgHKE25q84RjsSA20dYv0W2iE',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM0NkUFZkYTF0VGtOUGwxbURpRmxEVmNNdmtqSVdSdXpRS0lPWFNKbSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1764082041);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city_municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `terms` tinyint(1) NOT NULL DEFAULT 0,
  `privacy` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name_lower` varchar(255) GENERATED ALWAYS AS (lcase(`first_name`)) VIRTUAL,
  `last_name_lower` varchar(255) GENERATED ALWAYS AS (lcase(`last_name`)) VIRTUAL,
  `id_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_first_last_unique` (`first_name_lower`,`last_name_lower`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin',NULL,'CityVet',NULL,'1985-05-15','09123456789',NULL,'CityVet Veterinary Clinic',NULL,'Poblacion','Alaminos City','Pangasinan','acp.cityvet@gmail.com','2025-11-25 10:56:52','$2y$12$bw9FGz9KxTe2.Bfb2ImeJeqWVRtEiwBz0cH2oBoNpc4CMZzTmAHmq','admin',0,0,'BS9Bv1CMANlvXCBQpAoodhLnMIHaoQaggHdHNnf9CPvR2tDM7u323w169A0y','2025-11-25 10:56:52','2025-11-25 10:56:52','admin','cityvet',NULL),(2,'Maria','Cruz','Santos',NULL,'1999-08-03','09170000001',NULL,'001 Sampaguita Street',NULL,'Alos','Alaminos City','Pangasinan','maria.santos@gmail.com','2025-11-25 10:56:53','$2y$12$0rN93tKQvW0m8baBew5OmerzKmgEW1LQla7jaht34VFhMzEiBNkKC','user',0,0,NULL,'2025-11-25 10:56:53','2025-11-25 10:56:53','maria','santos',NULL),(3,'Rosa','Fernandez','Garcia',NULL,'1982-07-23','09170000002',NULL,'002 Sampaguita Street',NULL,'Palamis','Alaminos City','Pangasinan','rosa.garcia@yahoo.com','2025-11-25 10:56:53','$2y$12$x5CS70ATrw2ptqAk3HG9IOpVTPt.f7S1iWINj7JGGSa/ixzKG1F/G','user',0,0,NULL,'2025-11-25 10:56:53','2025-11-25 10:56:53','rosa','garcia',NULL),(4,'Angelica','Reyes','Morales',NULL,'1979-11-05','09170000003',NULL,'003 Sampaguita Street',NULL,'Amandiego','Alaminos City','Pangasinan','angelica.morales@outlook.com','2025-11-25 10:56:53','$2y$12$2AYxKeqS2mUVdY9NjWUSluoj1NsbGMEMJv7xsCE4B56d08Nm6IMuu','user',0,0,NULL,'2025-11-25 10:56:53','2025-11-25 10:56:53','angelica','morales',NULL),(5,'Diana','Villanueva','Lopez',NULL,'2002-11-27','09170000004',NULL,'004 Sampaguita Street',NULL,'Pandan','Alaminos City','Pangasinan','diana.lopez@hotmail.com','2025-11-25 10:56:54','$2y$12$.2obTYBZ50hxrAWCKA40Eu7tb8mFOfOaJkErFY9F3jUrdMSidOF/K','user',0,0,NULL,'2025-11-25 10:56:54','2025-11-25 10:56:54','diana','lopez',NULL),(6,'Carmen','Ramos','De los Santos',NULL,'1985-05-28','09170000005',NULL,'005 Sampaguita Street',NULL,'Amangbangan','Alaminos City','Pangasinan','carmen.de los santos@icloud.com','2025-11-25 10:56:54','$2y$12$ObrrNq.slHdpxNyl.AHpxeJLyws7mmHaJSy3/0/W03bXVhZHCg8F6','user',0,0,NULL,'2025-11-25 10:56:54','2025-11-25 10:56:54','carmen','de los santos',NULL),(7,'Juan','Dela Cruz','Martinez',NULL,'1988-12-16','09170000006',NULL,'100 Lapu-Lapu Street',NULL,'Pangapisan','Alaminos City','Pangasinan','juan.martinez@protonmail.com','2025-11-25 10:56:54','$2y$12$CN2deD7BB2QXM0FpaqpBUefFC42FlMGsB33ND.RQfiCzdLBMZz3tW','user',0,0,NULL,'2025-11-25 10:56:54','2025-11-25 10:56:54','juan','martinez',NULL),(8,'Pedro','Aquino','Rizal',NULL,'1987-12-05','09170000007',NULL,'101 Lapu-Lapu Street',NULL,'Balangobong','Alaminos City','Pangasinan','pedro.rizal@mail.com','2025-11-25 10:56:54','$2y$12$V3bRHUCktYm1vknIpVqifubYwku7EUOI1HG0FmSK4Ji527Nw1yNYG','user',0,0,NULL,'2025-11-25 10:56:54','2025-11-25 10:56:54','pedro','rizal',NULL),(9,'Francisco','Bonifacio','Agoncillo',NULL,'2006-12-14','09170000008',NULL,'102 Lapu-Lapu Street',NULL,'Poblacion','Alaminos City','Pangasinan','francisco.agoncillo@gmail.com','2025-11-25 10:56:55','$2y$12$Jn2mzBAkAIuNQ0Hwl7hdNerx9eWbi.htfGVdn66eLNxWEHEX5uVii','user',0,0,NULL,'2025-11-25 10:56:55','2025-11-25 10:56:55','francisco','agoncillo',NULL),(10,'Manuel','Luis','Espinosa',NULL,'1995-03-04','09170000009',NULL,'103 Lapu-Lapu Street',NULL,'Balayang','Alaminos City','Pangasinan','manuel.espinosa@yahoo.com','2025-11-25 10:56:55','$2y$12$deUlVHUmgeeRDmfx578CQ.7Sh38ThDuIC/4XSiDOL5qZCdQrOloKm','user',0,0,NULL,'2025-11-25 10:56:55','2025-11-25 10:56:55','manuel','espinosa',NULL),(11,'Ricardo','Laurel','Jacinto',NULL,'1999-09-08','09170000010',NULL,'104 Lapu-Lapu Street',NULL,'Pocal-pocal','Alaminos City','Pangasinan','ricardo.jacinto@outlook.com','2025-11-25 10:56:55','$2y$12$0rXtv4LZe.a8tUrWvivyNuvW4aZ6t6hk62BI7QJU/oAb6zDGGrlzy','user',0,0,NULL,'2025-11-25 10:56:55','2025-11-25 10:56:55','ricardo','jacinto',NULL),(12,'Antonio','Gonzales','Hernandez',NULL,'2001-03-31','09170000011',NULL,'105 Lapu-Lapu Street',NULL,'Baleyadaan','Alaminos City','Pangasinan','antonio.hernandez@hotmail.com','2025-11-25 10:56:55','$2y$12$gdQ0b2J6AjZvvegkEFKmFufCHjCl3ab0A/Bxbn6biIhoipwsqQ6uS','user',0,0,NULL,'2025-11-25 10:56:55','2025-11-25 10:56:55','antonio','hernandez',NULL),(13,'Erricca','Carbonells','Morales','female','2003-06-17','09123520147','09125351562','Pandayan','2404','Palamis','Alaminos City','Pangasinan','erricca.morales12@gmail.com','2025-11-25 11:31:39','$2y$12$k102/hzxOtixiyH0b8bmmOCCEnXaMler28S2N8/yOEhlVL9PL.6a.','user',0,0,'KbYonF1FyqaZKdDfqhRtVaxeUUZ6NgqxBWTAs1JswTbZAzJtuD80iAffq4b2','2025-11-25 11:30:59','2025-12-17 17:11:08','erricca','morales','id_photos/XsZN987p1zh3gERLZwp4Bljj2XlQFiuzv5sjjffl.png'),(14,'Find','Paw','Furever','male','2000-02-16','09123025478','09235486510','Palali','2404','Poblacion','Alaminos City','Pangasinan','findfurever87@gmail.com','2025-11-25 13:11:12','$2y$12$u/JYucMENN3h5NbRkUMRcOiC7h4GfE505vxew2jH1U82oXctyOKi.','user',0,0,NULL,'2025-11-25 13:10:52','2025-11-25 13:14:09','find','furever','id_photos/gvHAHOwXArWBcBvmzxSbWgueyVpPnWG4G7RdrCpW.png'),(15,'Hunter','Ford','Smith','male','2001-10-21','09123456789','09123526852','Palali','2404','Poblacion','Alaminos City','Pangasinan','xhunter.smith12@gmail.com','2025-11-26 00:32:02','$2y$12$WJLJRS7LcUBf4vYoZAaye.O3nsCLMxho1klFJTkt2NY5DIhKin5ye','user',0,0,'PkcJTlyrvfgQGjqWEMNIkSKTza6na38kFiI5k65A1cjg9KJXDSzI5bRaK7t6','2025-11-26 00:31:14','2025-12-14 12:03:18','hunter','smith','id_photos/usMUGKMHwaiilwdweW4ziNg8RYeR2Q8Y1rQXg2ch.png');
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

-- Dump completed on 2025-12-18  1:16:04
