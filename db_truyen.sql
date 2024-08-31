-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table db.cart: ~0 rows (approximately)

-- Dumping data for table db.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `title`, `img`, `class`, `created_at`, `updated_at`) VALUES
	(17, 'a afaf', '/uploads/story/436379182_4185384755021270_3855561984935209441_n.jpg', 'af afqwf q', '2024-08-29 05:32:04', '2024-08-29 05:32:05'),
	(18, 'ưettw', '/uploads/story/436379182_4185384755021270_3855561984935209441_n.jpg', 'e t', '2024-08-29 05:59:38', '2024-08-29 05:59:38');

-- Dumping data for table db.chapter: ~0 rows (approximately)

-- Dumping data for table db.failed_jobs: ~0 rows (approximately)

-- Dumping data for table db.migrations: ~20 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_04_11_000002_create_categories_table', 1),
	(6, '2023_04_11_000003_create_products_table', 1),
	(7, '2023_04_11_000004_create_products_img_table', 1),
	(8, '2023_04_11_000005_create_order_table', 1),
	(9, '2023_04_11_000006_create_order_item_table', 1),
	(10, '2023_04_20_000008_create_vote_product_table', 1),
	(11, '2023_04_25_000009_create_table_cart', 1),
	(12, '2023_04_28_000010_create_voucher_code_table', 1),
	(13, '2023_04_28_000011_create_orders_table', 1),
	(14, '2023_05_03_000012_create_reply_customers_table', 1),
	(15, '2024_08_28_175755_create_settings_table', 1),
	(16, '2024_08_28_183305_create_column_vote_in_products_table', 2),
	(17, '2024_08_29_024755_create_story_table', 3),
	(18, '2024_08_29_025022_create_chapter_table', 3),
	(19, '2024_08_29_091421_add_column_slug_and_tag_on_story_table', 4),
	(21, '2024_08_30_150433_add_img_column_into_products_img', 5);

-- Dumping data for table db.order: ~0 rows (approximately)

-- Dumping data for table db.orders: ~0 rows (approximately)

-- Dumping data for table db.order_item: ~0 rows (approximately)

-- Dumping data for table db.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table db.personal_access_tokens: ~0 rows (approximately)

-- Dumping data for table db.products: ~8 rows (approximately)
INSERT INTO `products` (`id`, `name`, `category_id`, `des`, `price`, `slug`, `tag`, `sale_off`, `quanlity`, `vote`, `created_at`, `updated_at`) VALUES
	(1, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:43:43', '2024-08-30 07:43:43'),
	(2, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:44:56', '2024-08-30 07:44:56'),
	(3, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:45:48', '2024-08-30 07:45:48'),
	(4, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:47:24', '2024-08-30 07:47:24'),
	(5, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:47:41', '2024-08-30 07:47:41'),
	(6, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:48:42', '2024-08-30 07:48:42'),
	(7, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:49:08', '2024-08-30 07:49:08'),
	(8, 'wr QWR', 18, 'No description', 120000.00, 'No slug', 'No tag', 10, 1200, 0, '2024-08-30 07:50:17', '2024-08-30 07:50:17');

-- Dumping data for table db.products_img: ~1 rows (approximately)
INSERT INTO `products_img` (`id`, `slug`, `tag`, `product_id`, `created_at`, `updated_at`, `img`) VALUES
	(2, 'No slug', 'No tag', 8, '2024-08-30 08:11:23', '2024-08-30 08:11:23', '/uploads/productImages/436491101_4185384818354597_3820006754041112681_n.jpg');

-- Dumping data for table db.reply_customers: ~0 rows (approximately)

-- Dumping data for table db.settings: ~1 rows (approximately)
INSERT INTO `settings` (`id`, `logo`, `store_name`, `banner`, `contentBanner_left`, `contentBanner_right`, `contentBanner_heading`, `email`, `phone`, `address`, `pos_code`, `opentime`, `facebook_url`, `tiktok_url`, `map_key`) VALUES
	(1, 'logo.png', 'Store name', 'https://images.pexels.com/photos/27722068/pexels-photo-27722068/free-photo-of-sometimes-it-s-the-one-with-the-most-beautiful-view.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping data for table db.story: ~0 rows (approximately)

-- Dumping data for table db.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'dat198hp', 'dat198hp@gmail.com', 1, NULL, '$2y$10$3R.CEim2Op3w3ioG7IEjbueLCNG36idkH2TmryJO/B7lo3Flm6z.W', NULL, '2024-08-28 11:26:46', '2024-08-28 11:26:46');

-- Dumping data for table db.vote_product: ~0 rows (approximately)

-- Dumping data for table db.voucher_code: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
