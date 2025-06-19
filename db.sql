-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.42

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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `cart_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Food',NULL,'2025-06-18 11:28:58','2025-06-18 11:28:58'),(2,'Dessert',NULL,'2025-06-18 11:29:05','2025-06-18 11:29:05'),(3,'Drink',NULL,'2025-06-18 11:29:12','2025-06-18 11:29:12');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deliveries` (
  `delivery_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_status` enum('pending','out','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `deliveries_order_id_foreign` (`order_id`),
  KEY `deliveries_user_id_foreign` (`user_id`),
  CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `deliveries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'0001_01_01_000003_create_categories',1),(5,'0001_01_01_000005_create_subcategories',1),(6,'0001_01_01_000006_create_products',1),(7,'2025_06_09_171914_create_carts',1),(8,'2025_06_09_171922_create_wishlists',1),(9,'2025_06_09_171925_create_orders',1),(10,'2025_06_09_171927_create_order_items',1),(11,'2025_06_09_171929_create_payments',1),(12,'2025_06_11_074418_create_deliveries',1),(13,'2025_06_11_080314_create_stocking',1),(14,'2025_06_12_090829_create_personal_access_tokens_table',1),(15,'2025_06_18_103955_create_product_ratings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `order_item_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_type` enum('dine-in','delivery') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','preparing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_date` datetime NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `table_number` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
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
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `payment_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','card','mobile') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','paid','fail','refund') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `product_ratings`
--

DROP TABLE IF EXISTS `product_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `rating` decimal(2,1) unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_ratings_product_id_user_id_unique` (`product_id`,`user_id`),
  KEY `product_ratings_user_id_foreign` (`user_id`),
  CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `product_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_ratings`
--

LOCK TABLES `product_ratings` WRITE;
/*!40000 ALTER TABLE `product_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `estimated_delivery_minutes` int NOT NULL DEFAULT '30',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`subcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Amok Fish','Traditional Cambodian steamed fish curry with coconut milk and kroeung, served in banana leaves.',6.50,'https://kroya.restaurant/media/pages/glossary/amok/cda065f9ea-1709213047/amok.jpg',20,1,1,35,'2025-06-18 11:42:00','2025-06-18 11:42:00'),(2,'Nom Banh Chok','Nom Banh Chok is a traditional Asia dish.',2.00,'https://grantourismotravels.com/wp-content/uploads/2021/02/Authentic-Nom-Banh-Chok-Recipe-Cambodian-Khmer-Noodles-Copyright-2021-Terence-Carter-Grantourismo-500x375.jpg',20,1,1,20,'2025-06-18 13:11:56','2025-06-18 13:11:56'),(3,'Samlar machu','Samlar machu is a traditional Asia dish',1.50,'https://angkorchef.com/wp-content/uploads/2019/12/Somlaw-Machu-Kroeung-on-Table.jpg',20,1,1,15,'2025-06-18 13:13:22','2025-06-18 13:13:22'),(4,'Kampot Pepper Crab','Kampot Pepper Crab is a traditional Asia dish.',2.00,'https://amber-kampot.com/wp-content/uploads/2020/12/ingredients4.jpg',20,1,1,20,'2025-06-18 13:17:47','2025-06-18 13:17:47'),(5,'Samlar kari','Samlar kari is a traditional Asia dish.',1.50,'https://www.gourmandtrotter.com/wp-content/uploads/2020/01/Khmer-Red-Curry.jpg',20,1,1,15,'2025-06-18 13:30:34','2025-06-18 13:30:34'),(6,'Samlor Korkor','Samlor Korkor is a traditional Europe dish.',2.00,'https://blog.takemetour.com/wp-content/uploads/2019/03/Somlorkoko.jpg',20,1,1,20,'2025-06-18 13:35:37','2025-06-18 13:35:37'),(7,'Steak','Steak recipe is served with very garlicky butter that makes this steak melt-in-your-mouth wonderful!',1.50,'https://www.petergbouchier.com.au/cdn/shop/articles/Steak_and_rocket_on_plate.jpg?v=1724724050',20,1,3,40,'2025-06-18 13:47:20','2025-06-18 13:47:20'),(8,'Boeuf Bourguignon','Rich beef, slow cooked in Burgundy wine alongside fresh vegetables and bacon served with slices of crusty baguette and a large glass of red, this is rustic French food at its best.',1.50,'https://www.celebritycruises.com/blog/content/uploads/2023/10/european-food-boeuf-bourguignon-france-1024x684.jpg',20,1,3,40,'2025-06-18 13:53:41','2025-06-18 13:53:41'),(9,'Fish ’n’ Chips','Fish ’n’ Chips the most popular meal from England accompanied by mushy peas or curry source with unique taste!',1.50,'https://www.celebritycruises.com/blog/content/uploads/2023/10/european-food-fish-n-chips-england-1024x683.jpg',20,1,3,40,'2025-06-18 13:57:59','2025-06-18 13:57:59'),(10,'Souvlaki','The quintessential street food of Greece refers to any meat or fish that is cubed, placed on bamboo skewers and grilled on an open fire.',2.50,'https://www.celebritycruises.com/blog/content/uploads/2023/10/european-food-souvlaki-greece-1024x683.jpg',20,1,3,25,'2025-06-18 13:59:54','2025-06-18 13:59:54'),(11,'Escargots','In France, they’re delicately and uniquely braised in butter, garlic and parsley and can be served with shells or without.',3.00,'https://www.celebritycruises.com/blog/content/uploads/2023/10/european-food-escargots-france-1024x682.jpg',20,1,3,30,'2025-06-18 14:01:41','2025-06-18 14:01:41'),(12,'Italian Pizza','Traditional Italian pizza: the most popular authentic Italian pizzas',1.50,'https://st3.idealista.it/news/archivie/styles/fullwidth_xl/public/2022-10/media/image/aurelien-lemasson-theobald-x00czbt4dfk-unsplash.jpg?VersionId=V5HNX7jAzvpmOwawvIKLGNATTI3v_m09&itok=KeH-F7_2',20,1,3,15,'2025-06-18 14:07:20','2025-06-18 14:07:20'),(13,'Shakshuka','Originating in North Africa and now strongly associated with Israeli cuisine, shakshuka typically involves a sauce of tomatoes and red peppers accompanied by bread and feta',2.00,'https://cdn.loveandlemons.com/wp-content/uploads/2017/01/shakshuka.jpg',20,1,2,20,'2025-06-18 14:11:02','2025-06-18 14:11:02'),(14,'Roasted Vegetable Baked Falafel Sandwiches','A zippy roasted pepper salad is the perfect foil, and creamy tahini sauce (aka tarator sauce) ties it all together.',1.50,'https://www.eatingwell.com/thmb/O_ob8YJULqU8EuIBk-M-PYsIKmE=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/7854420-6e4cb5a9b190462b8c7517ee778cb1fc.jpg',20,1,2,15,'2025-06-18 14:13:47','2025-06-18 14:13:47'),(15,'Moroccan Lamb Tagine','Tagine refers to both the pot and the stew like dish that is cooked inside, but we made ours in a Dutch oven and it comes out perfectly!',1.50,'https://hips.hearstapps.com/hmg-prod/images/190313-tagine-horizontal-1-1553026905.png?crop=1xw:0.843328335832084xh;center,top&resize=1200:*',20,1,2,15,'2025-06-18 14:17:09','2025-06-18 14:17:09'),(16,'Baba Ghanoush','Rich, smoky baba ghanoush is a staple dip throughout the Levant. Made from char-grilled or oven-roasted eggplant mixed with lemon juice, garlic, tahini, and olive oil.',6.00,'https://goodfoodbaddie.com/wp-content/uploads/2021/04/good-food-baddie-baba-ganoush-1.jpg',20,1,2,40,'2025-06-18 14:21:21','2025-06-18 14:21:21'),(17,'Fattoush','Fattoush is a very fresh and bright salad usually served alongside a protein to help cut the fat.',1.50,'https://forksandfoliage.com/wp-content/uploads/2022/06/authentic-fattoush-salad-1-2-1.jpg',20,1,2,40,'2025-06-18 14:26:27','2025-06-18 14:26:27'),(18,'Harissa Meatballs','Harissa is a Tunisian spicy chili paste that adds a ton of flavor to any dish. Here, we add it to chicken meatballs and red sauce for some extra heat.',2.00,'https://hips.hearstapps.com/hmg-prod/images/delish-202105-harissameatballs-035-ls-1621367921.jpg?crop=0.668xw:1.00xh;0.135xw,0&resize=1200:*',20,1,2,15,'2025-06-18 14:27:51','2025-06-18 14:27:51'),(19,'Larb Dish','Larb dish is national lao local dish',1.50,'https://i.pinimg.com/474x/49/af/80/49af80daa0561f68f236fb2defa1ccec.jpg',20,1,1,15,'2025-06-18 14:33:47','2025-06-18 14:33:47'),(20,'Fried Insects','Deep Fried Various type of Insects',0.75,'https://pppenglish.sgp1.digitaloceanspaces.com/image/main/field/image/_mg_5212.jpg',20,1,1,20,'2025-06-18 14:36:34','2025-06-18 14:36:34'),(21,'Korean Bibimbap','Bibimbap is one of the most well known Korean dishes.',2.50,'https://thewoksoflife.com/wp-content/uploads/2017/05/bibimbap-recipe-13.jpg',20,1,1,20,'2025-06-18 14:40:21','2025-06-18 14:40:21'),(22,'Bulgogi','A super easy recipe for Korean BBQ with the most flavorful marinade! The thin, tender slices of meat cook SO quickly!',4.00,'https://static01.nyt.com/images/2023/11/14/multimedia/JM-Bulgogi-qmfj/JM-Bulgogi-qmfj-mediumThreeByTwo440.jpg',20,1,1,15,'2025-06-18 14:42:56','2025-06-18 14:42:56'),(23,'Zucchini Cakes','These cheesy zucchini patties are easy to make and an excellent way to use up that abundance of zucchini from the garden.',1.50,'https://www.themediterraneandish.com/wp-content/uploads/2023/07/zucchini-fritter-recipe-24-1.jpg',20,1,2,15,'2025-06-18 14:45:49','2025-06-18 14:45:49'),(24,'Grilled Ahi Tuna with Lemony Labneh','Best-ever Grilled Ahi Tuna with Lemony Labneh',3.50,'https://hips.hearstapps.com/hmg-prod/images/delish-210601-tunafish-094-1623441449.jpg',20,1,2,30,'2025-06-18 14:50:25','2025-06-18 14:50:25'),(25,'Lebanese Fried Kibbeh','With its crunchy outer layer and super tender aromatic filling of minced beef, every bite of these zesty Lebanese fried kibbeh balls will hold a burst of flavors!',3.50,'https://falasteenifoodie.com/wp-content/uploads/2022/11/Fried-Lebanese-Kibbeh-Recipe.jpeg',20,1,2,30,'2025-06-18 14:54:41','2025-06-18 14:54:41'),(26,'Pierogi','The Polish are genius – this is dumpling heaven! A great weekend project – cook some now, freeze some for later. They cook from frozen!!',5.00,'https://preppykitchen.com/wp-content/uploads/2024/12/Pierogi-Recipe-Card.jpg',20,1,3,30,'2025-06-18 14:58:52','2025-06-18 14:58:52'),(27,'Cheese fondue','Cheese lovers, get ready. Always served with crusty bread such as the traditional Weizenbrot',7.00,'https://www.deliciousmagazine.co.uk/wp-content/uploads/2019/02/fondue-768x960.jpg',50,1,3,45,'2025-06-18 15:01:17','2025-06-18 15:01:17'),(28,'Mashed Potato','The best Creamy Mashed Potatoes',1.50,'https://e6r2s2g3.delivery.rocketcdn.me/wp-content/uploads/2022/05/Creamy-Mashed-Potato.jpg',50,1,3,15,'2025-06-18 15:05:44','2025-06-18 15:05:44'),(29,'Spagetti Carbonara','This is a real spaghetti carbonara recipe made the traditional Italian way, without a single drop of cream.',3.00,'https://chefsupplyco.com.au/cdn/shop/articles/knife_recapie_cabonara.jpg?v=1693272728',15,1,3,20,'2025-06-18 15:08:13','2025-06-18 15:08:13'),(30,'Lasagna','This lasagna takes a little work, but it is so satisfying and filling that it\'s worth it!',3.00,'https://cookingwithayeh.com/wp-content/uploads/2023/12/Spinach-Lasagna-SQ-12.jpg',20,1,3,30,'2025-06-18 15:10:28','2025-06-18 15:10:28'),(31,'Num Ansom Chek','Traditional Cambodian sticky rice and banana dessert wrapped in banana leaves.',3.50,'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhx4D2I9IBLCOVEvOv4OlAdIv72MSjSIAfYWsRlaR5gC0mM7qWJVPN38vMkmRwhX9I1rrx75Gd0vnThxgjbyIr-LXBCtk2hRLNbr6xfozsvzI2igj-gXy_8C8VmFGGlv2OZnsifXAXpO8eI/s1600/blogs-how-to-prepare-cambodian-desserts.jpg',50,2,4,60,'2025-06-19 13:57:00','2025-06-19 13:57:00'),(32,'Plae ay','Sweet palm sugar balls filled with grated coconut, popular Cambodian treat.',3.00,'https://i.ytimg.com/vi/qZrYLwX5yto/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAi6pWIgTQlHahjaEwQIT-N5VT9CQ',50,2,4,50,'2025-06-19 14:01:59','2025-06-19 14:01:59'),(33,'Kralan','Roasted bamboo sticky rice cake mixed with black beans and coconut milk.',2.50,'https://askacambodian.net/wp-content/uploads/2015/06/images-12.jpeg',50,2,4,120,'2025-06-19 14:02:11','2025-06-19 14:02:11'),(34,'Banh Duk','Cambodian steamed rice flour cake with palm sugar and coconut.',3.00,'https://i.ytimg.com/vi/5MYOR4apKBo/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCLjq3DE90W0lci9tgU8nCook1SVw',50,2,4,40,'2025-06-19 14:02:24','2025-06-19 14:02:24'),(35,'Nom dongkov','Sweet steamed coconut and palm sugar pudding, soft and chewy texture.',2.80,'https://i.ytimg.com/vi/rcpX3UeQU24/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLA89WvIsFdGbOgO3_bF2PAvSnM_GQ',50,2,4,60,'2025-06-19 14:02:40','2025-06-19 14:02:40'),(36,'Japanese cheesecake','Jiggly Japanese cheesecake recipe is the ultimate fluffy, souffle-like cheesecake that some refer to as Japanese Cotton cheesecake due to its unique texture.',3.00,'https://qeleg.com/cdn/shop/articles/20240524080412-japanese-cotton-cheesecake_8824a9cf-5dd7-4113-b936-8660961da8ca.webp?v=1717665900',50,2,4,60,'2025-06-19 14:31:24','2025-06-19 14:31:24'),(37,'Tanghulu','Sweet steamed coconut and palm sugar pudding, soft and chewy texture.',1.50,'https://www.tasteofhome.com/wp-content/uploads/2024/03/Tanghulu_EXPS_FT24_276063_JR_0229_6.jpg',10,2,4,15,'2025-06-19 14:31:35','2025-06-19 14:31:35'),(38,'Hokkaido Baked Cheese Tarts','Hokkaido Baked Cheese Tarts are the ultimate rich and creamy bite-sized',2.00,'https://www.spatuladesserts.com/wp-content/uploads/2022/03/Hokkaido-baked-cheese-tart-3050762.1.1.jpg',50,2,4,30,'2025-06-19 14:31:44','2025-06-19 14:31:44'),(39,'Mango on Coconut Sticky Rice','When tender sticky rice meets ripe juicy mangos, it\'s a crowd-pleasing dessert that\'s impossible to resist.',3.50,'https://chenabgourmet.b-cdn.net/wp-content/uploads/2024/02/sticky-rice-with-mango-recipe.jpg',50,2,4,40,'2025-06-19 14:31:56','2025-06-19 14:31:56'),(40,'Chocolate Truffle Mochi','Chocolate Truffle Mochi features mochi stuffed with a rich chocolate truffle and rolled in cocoa powder. Make these delicious Japanese sweet treats for your friends and family this holiday or just enjoy them on your own at home!',2.80,'https://theheirloompantry.co/wp-content/uploads/2022/12/chocolate-truffle-mochi-the-heirloom-pantry-13.jpg',50,2,4,35,'2025-06-19 14:32:05','2025-06-19 14:32:05'),(41,'Tiramisu','Classic Italian layered dessert with coffee-soaked ladyfingers and mascarpone cream.',6.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpiRjt4A-TRZSmORiY_YiHwruO-I1TBpw42A&s',50,2,6,30,'2025-06-19 14:33:26','2025-06-19 14:33:26'),(42,'Baklava','Rich, sweet pastry made of layers of filo filled with chopped nuts and honey syrup.',5.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqcXBktNsIimO0afpqZTFfKzsZaqzk-5FHsQ&s',50,2,6,25,'2025-06-19 14:33:37','2025-06-19 14:33:37'),(43,'Panna Cotta','Creamy Italian dessert made with sweetened cream and gelatin, often served with fruit.',5.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCOoBmKHmCQPFK2uwpFpMJOJNqkmwld9iIWg&s',50,2,6,20,'2025-06-19 14:33:45','2025-06-19 14:33:45'),(44,'Crepes (with Nutella)','Thin French pancakes filled with Nutella spread, rolled and served warm.',4.50,'https://www.chelseasmessyapron.com/wp-content/uploads/2019/05/Nutella-Crepes-ChelseasMessyApron-1200-3-500x500.jpg',50,2,6,15,'2025-06-19 14:33:56','2025-06-19 14:33:56'),(45,'Cheesecake','Rich and creamy dessert with a crunchy base and smooth cream cheese topping.',6.50,'https://www.thespruceeats.com/thmb/HM3X8w38eMVo0Lejx4GLvGHZ4dM=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/gluten-free-new-york-cheesecake-1450985-hero-01-dc54f9daf38044238b495c7cefc191fa.jpg',50,2,6,30,'2025-06-19 14:34:05','2025-06-19 14:34:05'),(46,'Chocolate Lava Cake','Warm chocolate cake with a gooey molten center, rich and indulgent.',7.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkD7OSbyvoEzYoqjoEAjzRxlV0QUXQ7E2M9g&s',50,2,6,25,'2025-06-19 14:34:18','2025-06-19 14:34:18'),(47,'Apple Strudel','Austrian pastry with thin dough wrapped around a spiced apple filling.',5.80,'https://platedcravings.com/wp-content/uploads/2017/12/Apple-Strudel-Recipe-Plated-Cravings-10-500x375.jpg',50,2,6,20,'2025-06-19 14:34:31','2025-06-19 14:34:31'),(48,'Profiteroles','Choux pastry balls filled with whipped cream or custard, topped with chocolate.',5.20,'https://www.seriouseats.com/thmb/oN0XXRAYpQqfRrefFnhOvUBmuWg=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/20210609-profiteroles-debbie-wee-seriouseats-17-b1ac56cd654549bc896307e919b26edc.jpg',50,2,6,20,'2025-06-19 14:34:42','2025-06-19 14:34:42'),(49,'Mousse au Chocolat','Light and airy French chocolate mousse, a classic European dessert.',6.00,'https://www.1001recettes.net/wp-content/uploads/2025/01/1735901112-mousse-au-chocolat-onctueuse-recette-facile-et-rapide.jpg',50,2,6,25,'2025-06-19 14:34:51','2025-06-19 14:34:51'),(50,'Churros (with Chocolate Sauce)','Fried dough pastries coated in sugar, served with a rich chocolate dipping sauce.',4.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjdqSqc0g8SkzYA7FTGavh93mcnWuPQfb91Q&s',50,2,6,15,'2025-06-19 14:35:01','2025-06-19 14:35:01'),(51,'Doughnuts (Glazed)','Soft fried dough with a shiny sweet glaze, a timeless sweet treat.',3.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsRg2a-i048EX4JQ34nTTGDt6gGyfBcj3VWQ&s',50,2,6,10,'2025-06-19 14:35:14','2025-06-19 14:35:14'),(52,'Strawberry Shortcake','Layers of sweet biscuit, whipped cream, and fresh strawberries.',5.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRl8I5Yzxz7OG_VAekb4Y7jOHTl70G5mxqo_ASNI13gwBpC7SAeuBhXzgfRzH49TiAgiYQ&usqp=CAU',50,2,6,20,'2025-06-19 14:35:23','2025-06-19 14:35:23'),(53,'Turkish Delight (Lokum)','Sweet, chewy cubes flavored with rosewater or citrus, dusted with powdered sugar.',3.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtI-DJMzItKCBodDYgnhLhApgBDJ__MJK7Rw&s',50,2,5,10,'2025-06-19 14:35:34','2025-06-19 14:35:34'),(54,'Sutlac (Turkish Rice Pudding)','Creamy baked rice pudding, lightly sweetened and topped with a golden crust.',3.80,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuiRedPYM6lSqFR9NHhLEwy8H3IklSWbfYOw&s',50,2,5,20,'2025-06-19 14:35:41','2025-06-19 14:35:41'),(55,'Qatayef','Stuffed Arabic pancakes, usually filled with cream or nuts, deep-fried and soaked in syrup.',4.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkUilLsSMCoMgaQD77ApABajzDUlnk0EY90w&s',50,2,5,20,'2025-06-19 14:35:50','2025-06-19 14:35:50'),(56,'Basbousa','Semolina cake soaked in syrup, often garnished with almonds or coconut.',4.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRB8pw_oVfW9fFg0LpuiOwD-XMIsqNyX3EecQ&s',50,2,5,15,'2025-06-19 14:35:58','2025-06-19 14:35:58'),(57,'Luqaimat','Crispy golden dough balls drizzled with date syrup or honey.',4.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi16uMu_AR1rbW0WwNqa49g7U0iMObErNJyg&s',50,2,5,15,'2025-06-19 14:36:06','2025-06-19 14:36:06'),(58,'Umm Ali','Egyptian bread pudding made with milk, nuts, raisins, and flaky pastry.',4.80,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR23iK_ry_nsaXs-Hc_91nKxMb0CBRmVAfkeg&s',50,2,5,20,'2025-06-19 14:36:14','2025-06-19 14:36:14'),(59,'Halawet el Jibn','Sweet cheese rolls filled with cream and topped with pistachios and syrup.',5.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsDpaYBcpg_eXghkirVlcu89gAOcx5_gdiUQ&s',50,2,5,25,'2025-06-19 14:36:25','2025-06-19 14:36:25'),(60,'Rice Pudding','Classic creamy dessert made with rice, milk, sugar, and sometimes cinnamon.',3.50,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqo9w11fqJdgVdr50pIIe-6i2mriKptg8X1A&s',50,2,5,20,'2025-06-19 14:36:35','2025-06-19 14:36:35'),(61,'Maamoul','Shortbread cookies filled with dates, pistachios, or walnuts, often served on holidays.',4.20,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-adpbn6ODLpeyPwcsmcqitwxi4cFYVDxZ9Q&s',50,2,5,15,'2025-06-19 14:36:43','2025-06-19 14:36:43'),(62,'Gulab Jamun','Soft fried dough balls soaked in fragrant rose-flavored syrup.',4.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7jjET_D5ujcfyL33VEVKvWLIbifiysZdMmA&s',50,2,5,20,'2025-06-19 14:36:52','2025-06-19 14:36:52'),(63,'Kataifi','Shredded pastry filled with nuts and baked to crispy perfection, soaked in syrup.',5.00,'https://www.vickisgreekrecipes.com/wp-content/uploads/2023/10/kataifi-roll-2-1170x804.jpeg',50,2,5,25,'2025-06-19 14:37:03','2025-06-19 14:37:03'),(64,'Hot Americano','Classic black coffee made by diluting espresso with hot water.',2.50,'https://i.pinimg.com/736x/4a/d7/b7/4ad7b70efacd8390944568f16d1a3096.jpg',50,3,7,15,'2025-06-19 15:11:46','2025-06-19 15:11:46'),(65,'Hot Cappuccino','Espresso with steamed milk and a thick layer of milk foam.',2.80,'https://i.pinimg.com/736x/f0/65/5f/f0655f2737da76be9b4ac435c65e3d9b.jpg',50,3,7,20,'2025-06-19 15:11:57','2025-06-19 15:11:57'),(66,'Hot Macchiato','Bold espresso topped with a dollop of foamed milk.',3.00,'https://i.pinimg.com/736x/6c/0f/46/6c0f465a04617940d6e5fc1e784849c0.jpg',50,3,7,25,'2025-06-19 15:12:06','2025-06-19 15:12:06'),(67,'Hot Matcha','Warm matcha green tea with a frothy, smooth texture.',3.50,'https://i.pinimg.com/736x/c2/67/d3/c267d3070e22a73eb254cc43e1eca72f.jpg',50,3,7,17,'2025-06-19 15:12:14','2025-06-19 15:12:14'),(68,'Hot Mocha','Espresso with chocolate and steamed milk, topped with whipped cream.',2.20,'https://i.pinimg.com/736x/22/8b/72/228b72a03cb98c19063193cf0188a6a3.jpg',50,3,7,24,'2025-06-19 15:12:21','2025-06-19 15:12:21'),(69,'Hot Salt Caramel Macchiato','Rich espresso layered with caramel and milk, topped with foam and sea salt.',2.90,'https://i.pinimg.com/736x/d2/0c/e6/d20ce6b882f53f35c58738dab963434b.jpg',50,3,7,10,'2025-06-19 15:12:29','2025-06-19 15:12:29'),(70,'Hot Honey Lemon Tea','Comforting hot tea infused with honey and a squeeze of lemon.',2.70,'https://i.pinimg.com/736x/99/27/a6/9927a6ed9832abf7da9361772a5a6f9f.jpg',50,3,7,21,'2025-06-19 15:12:37','2025-06-19 15:12:37'),(71,'Hot Green Tea','Steamed green tea with earthy and mildly bitter flavor.',2.00,'https://i.pinimg.com/736x/e7/f8/d5/e7f8d59826f9ef94db40bc47765f194d.jpg',50,3,7,30,'2025-06-19 15:12:45','2025-06-19 15:12:45'),(72,'Hot Cocoa','Rich and creamy hot chocolate made with cocoa powder and milk.',2.90,'https://i.pinimg.com/736x/9b/21/7d/9b217dff29b25f72b9070a174492e732.jpg',50,3,7,28,'2025-06-19 15:12:54','2025-06-19 15:12:54'),(73,'Crockpot Apple Cider','When you\'re expecting guests, just load the slow cooker hours in advance and spend your time visiting instead.',2.90,'https://www.joyfulhealthyeats.com/wp-content/uploads/2015/12/Crock-Pot-Hot-Apple-Cider-web-9.jpg',50,3,7,28,'2025-06-19 15:13:10','2025-06-19 15:13:10'),(74,'Iced Latte','Chilled espresso blended with milk and ice, smooth and refreshing.',2.50,'https://i.pinimg.com/736x/d4/70/0c/d4700c9e6ad5ef2630f4d530a613d86b.jpg',50,3,8,25,'2025-06-19 15:13:18','2025-06-19 15:13:18'),(75,'Iced Matcha Latte','Creamy green tea latte served cold, with a rich matcha flavor.',3.30,'https://i.pinimg.com/736x/73/22/d0/7322d0a282371f8bb205b7b66cd50d7c.jpg',50,3,8,32,'2025-06-19 15:13:27','2025-06-19 15:13:27'),(76,'Iced Americano','Strong and bold espresso poured over ice, served black and chilled.',3.80,'https://i.pinimg.com/736x/21/03/32/21033241cec90baa0f32f80373d70a61.jpg',50,3,8,22,'2025-06-19 15:13:38','2025-06-19 15:13:38'),(77,'Strawberry Smoothie','Blended strawberry drink with yogurt or milk, naturally sweet and creamy.',4.20,'https://i.pinimg.com/736x/69/cf/a6/69cfa6d82bda2dc58013888353b4a74b.jpg',50,3,8,28,'2025-06-19 15:13:49','2025-06-19 15:13:49'),(78,'Blueberry Banana Smoothie','Refreshing blend of bananas and blueberries, perfect for a fruity boost.',4.50,'https://i.pinimg.com/736x/f8/1c/df/f81cdf2b077ebf0db858351cdc0c9ef3.jpg',50,3,8,18,'2025-06-19 15:13:57','2025-06-19 15:13:57'),(79,'Avocado Smoothie','Rich and creamy smoothie made with ripe avocados and milk.',3.60,'https://i.pinimg.com/736x/46/d8/15/46d815be729c637ceaf9be14d1f80a04.jpg',50,3,8,21,'2025-06-19 15:14:13','2025-06-19 15:14:13'),(80,'Rainbow Smoothie','Colorful layered smoothie made with a variety of fresh fruits.',4.00,'https://i.pinimg.com/736x/2d/e4/1d/2de41d64c747a503149fad421693455f.jpg',50,3,8,16,'2025-06-19 15:14:22','2025-06-19 15:14:22'),(81,'Strawberry Soda','Refreshing soda infused with sweet strawberry flavor, served chilled.',2.40,'https://i.pinimg.com/736x/4f/7a/60/4f7a608bd5384c201a6d707b16263616.jpg',50,3,9,11,'2025-06-19 15:14:29','2025-06-19 15:14:29'),(82,'Fresh Passion Juice','Tangy and aromatic juice made from fresh passion fruit pulp.',2.70,'https://i.pinimg.com/736x/02/f7/9e/02f79ea76240b214c527bc94d689920a.jpg',50,3,9,19,'2025-06-19 15:14:38','2025-06-19 15:14:38'),(83,'Honey Lime Tea','Cooling herbal tea blended with fresh lime and natural honey.',2.50,'https://i.pinimg.com/736x/91/3c/fd/913cfd83bc134c57c66919286ce292b3.jpg',50,3,9,35,'2025-06-19 15:14:46','2025-06-19 15:14:46'),(84,'Watermelon Mint','Chilled watermelon drink with a fresh mint twist.',2.75,'https://i.pinimg.com/736x/63/fe/9e/63fe9e6066520678479ab953fb1c2767.jpg',50,3,9,20,'2025-06-19 15:14:56','2025-06-19 15:14:56'),(85,'Blueberry Soda','Bubbly blueberry soda with a fruity burst and icy finish.',1.50,'https://i.pinimg.com/736x/4a/3f/e0/4a3fe020097f9ec2a5dba454860b7396.jpg',50,3,9,10,'2025-06-19 15:15:12','2025-06-19 15:15:12'),(86,'Blue Hawaii Soda','Tropical soda blend with citrus and pineapple flavors, bright and fizzy.',1.75,'https://i.pinimg.com/736x/85/13/64/851364b03d5d3298583826f883d2d263.jpg',50,3,9,10,'2025-06-19 15:15:22','2025-06-19 15:15:22'),(87,'Mango Mocktail','Non-alcoholic mango cocktail with citrus zest and sweet tropical notes.',3.25,'https://i.pinimg.com/736x/22/c2/1c/22c21c1b21d3553568531a1d6c8596a0.jpg',50,3,9,30,'2025-06-19 15:15:34','2025-06-19 15:15:34'),(88,'Cucumber Apple Mocktail','Light and crisp drink combining cucumber freshness with apple sweetness.',4.25,'https://i.pinimg.com/736x/10/d9/71/10d971a0b40ebae91ca3a3a869f21577.jpg',50,3,9,35,'2025-06-19 15:15:43','2025-06-19 15:15:43');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('7us8J0nvtbLSfKNg3iEO3cHM67T00lMCKWByLT4y',NULL,'172.22.0.1','Apidog/1.0.0 (https://apidog.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGFmMVRXSnlDVHk3c3k1MGhEOGJLSnlHR2xRT0dqNGNRektnNHh2dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1750246378),('uvVSM7YgXDDRHauXDDbu4h9pdCbRaOWUSLxY0dig',NULL,'172.22.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:139.0) Gecko/20100101 Firefox/139.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidHNYSUhVanhKN0xtQnB1NGNyTWJyYnp2dkFaZVB0M3NxbGxQNmptdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1750264294);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocking`
--

DROP TABLE IF EXISTS `stocking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocking` (
  `stock_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `quantity_available` int NOT NULL,
  `status` enum('in stock','low','out of stock') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `stocking_product_id_foreign` (`product_id`),
  CONSTRAINT `stocking_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocking`
--

LOCK TABLES `stocking` WRITE;
/*!40000 ALTER TABLE `stocking` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `subcategory_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'Asian',NULL,'2025-06-18 11:29:30','2025-06-18 11:29:30'),(2,1,'Middle Eastern',NULL,'2025-06-18 11:29:41','2025-06-18 11:29:41'),(3,1,'Europe',NULL,'2025-06-18 11:29:57','2025-06-18 11:29:57'),(4,2,'Asian',NULL,'2025-06-18 11:30:10','2025-06-18 11:30:10'),(5,2,'Middle Eastern',NULL,'2025-06-18 11:30:16','2025-06-18 11:30:16'),(6,2,'Europe',NULL,'2025-06-18 11:30:25','2025-06-18 11:30:25'),(7,3,'Hot',NULL,'2025-06-18 11:30:33','2025-06-18 11:30:33'),(8,3,'Iced & Smoothie',NULL,'2025-06-18 11:30:48','2025-06-18 11:30:48'),(9,3,'Juice & Fresh',NULL,'2025-06-18 11:30:58','2025-06-18 11:30:58');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
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
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `wishlist_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`wishlist_id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-19 15:21:19
