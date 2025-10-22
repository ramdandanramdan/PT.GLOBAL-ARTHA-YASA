-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 07:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm_global_artha_yasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('H','S','I','A') NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `email`, `category`, `created_at`, `updated_at`) VALUES
(1, 'PT Surya Kencana', '08123456701', NULL, 'surya@test.com', NULL, '2025-05-21 20:42:05', '2025-10-21 20:42:05'),
(2, 'Budi Hartono', '08123456702', NULL, 'budi.h@mail.com', NULL, '2025-08-21 20:42:05', '2025-10-21 20:42:05'),
(3, 'Dewi Lestari', '08123456703', NULL, 'dewi.l@email.com', NULL, '2025-10-06 20:42:05', '2025-10-21 20:42:05'),
(4, 'Toko Makmur Jaya', '08123456704', NULL, 'makmur@jaya.co.id', NULL, '2024-10-21 20:42:05', '2025-10-21 20:42:05'),
(5, 'Ahmad R', '08123456705', NULL, 'ahmad.r@gmail.com', NULL, '2025-09-26 20:42:05', '2025-10-21 20:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_10_21_055524_create_roles_table', 1),
(4, '2025_10_21_060000_create_users_table', 1),
(5, '2025_10_21_171452_create_products_table', 1),
(6, '2025_10_21_171536_create_customers_table', 1),
(7, '2025_10_21_171759_create_sale_orders_table', 1),
(8, '2025_10_21_171810_create_sale_order_product_table', 1),
(9, '2025_10_21_171925_create_attendances_table', 1),
(10, '2025_10_21_171952_create_targets_table', 1),
(11, '2025_10_21_181258_add_role_and_target_to_users_table', 1),
(12, '2025_10_21_183215_add_total_sales_to_users_table', 1),
(13, '2025_10_22_035711_create_stock_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'founder', '2025-10-21 20:42:03', '2025-10-21 20:42:03'),
(2, 'manager', '2025-10-21 20:42:03', '2025-10-21 20:42:03'),
(3, 'pic', '2025-10-21 20:42:03', '2025-10-21 20:42:03'),
(4, 'spg motoris', '2025-10-21 20:42:03', '2025-10-21 20:42:03'),
(5, 'sales', '2025-10-21 20:42:03', '2025-10-21 20:42:03'),
(6, 'admin', '2025-10-21 20:42:03', '2025-10-21 20:42:03'),
(7, 'spg', '2025-10-21 20:42:03', '2025-10-21 20:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `user_id`, `customer_id`, `order_date`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2025-09-21 20:42:05', 5000000.00, 'Completed', '2025-09-21 20:42:05', '2025-09-21 20:42:05'),
(2, 4, 1, '2025-10-06 20:42:05', 7500000.00, 'Completed', '2025-10-06 20:42:05', '2025-10-06 20:42:05'),
(3, 4, 1, '2025-10-16 20:42:05', 6000000.00, 'Completed', '2025-10-16 20:42:05', '2025-10-16 20:42:05'),
(4, 4, 2, '2025-09-11 20:42:05', 1000000.00, 'Completed', '2025-09-11 20:42:05', '2025-09-11 20:42:05'),
(5, 4, 2, '2025-10-11 20:42:05', 1250000.00, 'Completed', '2025-10-11 20:42:05', '2025-10-11 20:42:05'),
(6, 4, 3, '2025-10-13 20:42:05', 3000000.00, 'Completed', '2025-10-13 20:42:05', '2025-10-13 20:42:05'),
(7, 4, 4, '2025-08-22 20:42:05', 2000000.00, 'Completed', '2025-08-22 20:42:05', '2025-08-22 20:42:05'),
(8, 4, 4, '2025-10-01 20:42:05', 2500000.00, 'Completed', '2025-10-01 20:42:05', '2025-10-01 20:42:05'),
(9, 4, 5, '2025-10-09 20:42:05', 1500000.00, 'Completed', '2025-10-09 20:42:05', '2025-10-09 20:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_product`
--

CREATE TABLE `sale_order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_logs`
--

CREATE TABLE `stock_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `month` tinyint(3) UNSIGNED NOT NULL,
  `target_units` int(11) NOT NULL,
  `target_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'sales',
  `target` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_sales` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `target`, `total_sales`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Founder Global Artha Yasa', 'founder@globalartha-yasa.local', NULL, '$2y$12$/yl7ybs80ZVCSSYhNpiZzeCvl3hMbNqTofw7ew9XqP8a0bTa1rbv.', 'founder', 0, 0, 1, NULL, '2024-12-21 20:42:03', '2025-10-21 20:42:03'),
(2, 2, 'Bambang Manager', 'manager@globalartha-yasa.local', NULL, '$2y$12$iDBF3p5vtfUDT20yTxzLXOhGSKGfmA.fTPlM/rII873AHuL/YxJLy', 'manager', 0, 0, 1, NULL, '2025-02-21 20:42:04', '2025-10-21 20:42:04'),
(3, 3, 'Susi PIC', 'pic@globalartha-yasa.local', NULL, '$2y$12$v2/U50VMy34EBpUCQHmT0OlzztMBo3gQgJ2d1VRo8tSzDWrXO3ULC', 'pic', 0, 0, 1, NULL, '2025-04-21 20:42:04', '2025-10-21 20:42:04'),
(4, 5, 'Dani Sales (General)', 'sales@globalartha-yasa.local', NULL, '$2y$12$.ZJ5kb0outhUKSf9JN/uI.tc/saJ00ZEUhPQKONUX7MeKORLBLxxi', 'sales', 2000, 1500, 1, NULL, '2025-03-21 20:42:04', '2025-10-21 20:42:04'),
(5, 4, 'Yohan Setiyawan', 'yohan@gay.id', NULL, '$2y$12$zWbjBPsXbzWbp3xj5sdMqOgfNan79YZlMWLZ9jVjqE4mxOq2dCpN2', 'spg motoris', 1820, 737, 1, NULL, '2025-06-21 20:42:04', '2025-10-21 20:42:04'),
(6, 4, 'Dedy Amun', 'dedy@gay.id', NULL, '$2y$12$mGrV5LF/YVfpcwc/wfvut.36GgoesI73ZI9MiKazp2S7VqZfK93hG', 'spg motoris', 1820, 0, 1, NULL, '2025-02-21 20:42:05', '2025-10-21 20:42:05'),
(7, 7, 'Rina Sari', 'rina@gay.id', NULL, '$2y$12$v90svYGNjRcpR.ITo1KM9uWMr2guWtyJKi8tXKefF8wIt0QxzRDxi', 'spg', 1800, 1256, 0, NULL, '2025-02-21 20:42:05', '2025-10-21 20:42:05'),
(8, 7, 'Maya SPG', 'maya@gay.id', NULL, '$2y$12$ayqqUxDEZgVRMbSDVCQvTuJgjKDLkKwGraZyh0Ho7dM3OzlxLBtxq', 'spg', 1500, 1500, 1, NULL, '2024-11-21 20:42:05', '2025-10-21 20:42:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_user_id_date_unique` (`user_id`,`date`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_orders_user_id_foreign` (`user_id`),
  ADD KEY `sale_orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sale_order_product`
--
ALTER TABLE `sale_order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_order_product_sale_order_id_foreign` (`sale_order_id`),
  ADD KEY `sale_order_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_logs_product_id_foreign` (`product_id`),
  ADD KEY `stock_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `targets_user_id_year_month_unique` (`user_id`,`year`,`month`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_order_product`
--
ALTER TABLE `sale_order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_logs`
--
ALTER TABLE `stock_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD CONSTRAINT `sale_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_order_product`
--
ALTER TABLE `sale_order_product`
  ADD CONSTRAINT `sale_order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_order_product_sale_order_id_foreign` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD CONSTRAINT `stock_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `targets`
--
ALTER TABLE `targets`
  ADD CONSTRAINT `targets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
