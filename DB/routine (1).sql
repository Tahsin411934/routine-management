-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2025 at 01:59 PM
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
-- Database: `routine`
--

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_04_154241_create_sessions_table', 1),
(5, '2024_06_04_160113_create_semesters_table', 1),
(6, '2024_06_04_161246_create_offer_lists_table', 1),
(7, '2024_06_05_185638_create_selected_offer_lists_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offer_lists`
--

CREATE TABLE `offer_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `course_credit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `session` int(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `assign_teacher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`id`, `date`, `time`, `course_name`, `course_code`, `session`, `semester`, `assign_teacher`) VALUES
(44, '2025-05-20', '4:44 AM - 4:44 AM', 'DBM', '303', 1, '2nd', NULL),
(45, '2025-05-20', '3:33 AM - 10:02 PM', 'DBMS', '303', NULL, '1st', NULL),
(46, '2025-05-20', '4:04 AM - 5:05 AM', 'DBMS', '303', 1, '8th', NULL),
(49, '2025-05-19', '4:04 AM - 5:05 AM', 'Basic Accounting', '303', 1, '1st', NULL),
(50, '2025-05-20', '11:11 AM - 10:22 PM', 'cccs', '303', 2, '8th', NULL),
(51, '2025-07-06', '11:11 AM - 12:12 AM', 'RDMS', '111', 2, '1st', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `routine_section`
--

CREATE TABLE `routine_section` (
  `id` int(11) NOT NULL,
  `routine_id` int(11) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `room` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routine_section`
--

INSERT INTO `routine_section` (`id`, `routine_id`, `section`, `room`) VALUES
(71, 45, '4A', '404'),
(72, 45, '3B', '407'),
(73, 45, '4C', '406'),
(81, 44, '4A', '404'),
(82, 44, '4B', '405'),
(83, 44, '4C', '406'),
(84, 49, '4A', '404'),
(85, 46, '4A', '404'),
(86, 46, '4B', '405'),
(87, 50, '4A', '404'),
(88, 51, '7A', '612');

-- --------------------------------------------------------

--
-- Table structure for table `routine_teachers`
--

CREATE TABLE `routine_teachers` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routine_teachers`
--

INSERT INTO `routine_teachers` (`id`, `section_id`, `teacher_id`) VALUES
(14, 71, 1),
(15, 71, 1),
(16, 72, 1),
(17, 73, 1),
(28, 81, 3),
(29, 82, 4),
(30, 83, 3),
(31, 83, 4),
(32, 84, 3),
(33, 84, 4),
(34, 85, 3),
(35, 85, 4),
(36, 86, 3),
(37, 87, 3),
(38, 87, 4),
(39, 88, 6);

-- --------------------------------------------------------

--
-- Table structure for table `selected_offer_lists`
--

CREATE TABLE `selected_offer_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `offer_list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1st', NULL, NULL),
(2, '2nd', NULL, NULL),
(3, '3rd', NULL, NULL),
(4, '4th', NULL, NULL),
(5, '5th', NULL, NULL),
(6, '6th', NULL, NULL),
(7, '7th', NULL, NULL),
(8, '8th', NULL, NULL),
(9, '1st', NULL, NULL),
(10, '2nd', NULL, NULL),
(11, '3rd', NULL, NULL),
(12, '4th', NULL, NULL),
(13, '5th', NULL, NULL),
(14, '6th', NULL, NULL),
(15, '7th', NULL, NULL),
(16, '8th', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sping 2025', 'Running', '2025-05-20 22:47:28', '2025-05-20 22:48:02'),
(2, 'Fall 2025', 'Running', '2025-05-20 22:47:49', '2025-05-20 22:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shortName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sid`, `email`, `designation`, `priority`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `shortName`) VALUES
(1, 'Admin', NULL, 'admin@gmail.com', '', 0, 'admin', '$2y$12$He8vOafLWT/n71G120hT3.DQPh77CCBIABNJgx1l7m66/UYANVwom', 'iVL2jl4zA4ImLuXYTNCfx5ZTQJkGSAU32MR9Z1g0Yuq5XIOv4ScIh9B5F1Ez', NULL, NULL, NULL),
(3, 'Kinshuk Dhor', NULL, 'fuzeme@mailinator.com', 'kyvutovuva@mailinator.com', 40, 'teacher', '$2y$12$7WUsJM0bvv.73UH/DDneu.PYUrU3gkTcjQWuOyOYu2NLMitan7O3q', NULL, '2025-05-21 03:30:28', '2025-05-21 08:24:31', 'KD'),
(4, 'Neamul Haque', NULL, 'zusesuwi@mailinator.com', 'mypes@mailinator.com', 14, 'teacher', '$2y$12$sA20fFYaIG1g1jqEG8Z1IOpiVGNYV9Czw5q/AfyiFJZCQxzIe8Raa', NULL, '2025-05-21 03:30:49', '2025-05-21 08:24:48', 'MNH'),
(6, 'Mahedi Hasan', NULL, 'hasan@gamil.com', 'Professor', 50, 'teacher', '$2y$12$aGeCy2qlKw6/IMExd.fYZuwece9wiYHtHnIMdlxhYtyQ3TIVQZghW', NULL, '2025-07-06 03:45:37', '2025-07-06 03:45:37', 'MH');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `offer_lists`
--
ALTER TABLE `offer_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_lists_session_id_foreign` (`session_id`),
  ADD KEY `offer_lists_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routine_section`
--
ALTER TABLE `routine_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routine_id` (`routine_id`);

--
-- Indexes for table `routine_teachers`
--
ALTER TABLE `routine_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selected_offer_lists`
--
ALTER TABLE `selected_offer_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_offer_list_id_unique` (`user_id`,`offer_list_id`),
  ADD KEY `selected_offer_lists_offer_list_id_foreign` (`offer_list_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_sid_unique` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offer_lists`
--
ALTER TABLE `offer_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `routine_section`
--
ALTER TABLE `routine_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `routine_teachers`
--
ALTER TABLE `routine_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `selected_offer_lists`
--
ALTER TABLE `selected_offer_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offer_lists`
--
ALTER TABLE `offer_lists`
  ADD CONSTRAINT `offer_lists_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offer_lists_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `routine_section`
--
ALTER TABLE `routine_section`
  ADD CONSTRAINT `routine_section_ibfk_1` FOREIGN KEY (`routine_id`) REFERENCES `routine` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `selected_offer_lists`
--
ALTER TABLE `selected_offer_lists`
  ADD CONSTRAINT `selected_offer_lists_offer_list_id_foreign` FOREIGN KEY (`offer_list_id`) REFERENCES `offer_lists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `selected_offer_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
