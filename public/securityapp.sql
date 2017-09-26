-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2017 at 08:40 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securityapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ku_district`
--

CREATE TABLE `ku_district` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ku_district`
--

INSERT INTO `ku_district` (`id`, `district_name`, `district_code`, `state_code`, `district_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ahmedabad', 'GJ-1', 'GU', 'District-GJ-1-1505382683.jpg', '2017-09-14 04:21:23', '2017-09-14 04:21:23', NULL),
(2, 'Mehsana', 'GJ-2', 'GU', 'District-GJ-2-1505382784.jpg', '2017-09-14 04:23:04', '2017-09-14 04:23:04', NULL),
(3, 'Rajkot', 'GJ-3', 'GU', 'District-GJ-3-1505382855.jpg', '2017-09-14 04:24:15', '2017-09-14 04:24:15', NULL),
(4, 'Bhavnagar', 'GJ-4', 'GU', 'District-GJ-4-1505382883.jpg', '2017-09-14 04:24:43', '2017-09-14 04:24:43', NULL),
(5, 'Surat', 'GJ-5', 'GU', 'District-GJ-5-1505382935.jpg', '2017-09-14 04:25:35', '2017-09-14 04:25:35', NULL),
(6, 'Vadodara', 'GJ-6', 'GU', 'District-GJ-6-1505382971.jpg', '2017-09-14 04:26:11', '2017-09-14 04:26:11', NULL),
(7, 'Kheda', 'GJ-7', 'GU', 'District-GJ-7-1505383012.jpg', '2017-09-14 04:26:52', '2017-09-14 04:26:52', NULL),
(8, 'Banaskantha', 'GJ-8', 'GU', 'District-GJ-8-1505383053.jpg', '2017-09-14 04:27:33', '2017-09-14 04:27:33', NULL),
(9, 'Sabarkantha', 'GJ-9', 'GU', 'District-GJ-9-1505383099.jpg', '2017-09-14 04:28:19', '2017-09-14 04:28:19', NULL),
(10, 'Jamnagar', 'GJ-10', 'GU', 'District-GJ-10-1505383132.jpg', '2017-09-14 04:28:52', '2017-09-14 04:28:52', NULL),
(11, 'Junagadh', 'GJ-11', 'GU', 'District-GJ-11-1505383222.jpg', '2017-09-14 04:30:22', '2017-09-14 04:30:22', NULL),
(12, 'Kutch', 'GJ-12', 'GU', 'District-GJ-12-1505383277.jpg', '2017-09-14 04:31:17', '2017-09-14 04:31:17', NULL),
(13, 'Surendranagar', 'GJ-13', 'GU', 'District-GJ-13-1505383326.jpg', '2017-09-14 04:32:06', '2017-09-14 04:32:06', NULL),
(14, 'Amreli', 'GJ-14', 'GU', 'District-GJ-14-1505383371.jpg', '2017-09-14 04:32:51', '2017-09-14 04:32:51', NULL),
(15, 'Valsad', 'GJ-15', 'GU', 'District-GJ-15-1505383514.jpg', '2017-09-14 04:35:14', '2017-09-14 04:35:14', NULL),
(16, 'Bharuch', 'GJ-16', 'GU', 'District-GJ-16-1505383594.jpg', '2017-09-14 04:36:35', '2017-09-14 04:36:35', NULL),
(17, 'Panchmahal', 'GJ-17', 'GU', 'District-GJ-17-1505383628.jpg', '2017-09-14 04:37:08', '2017-09-14 04:37:08', NULL),
(18, 'Gandhinagar', 'GJ-18', 'GU', 'District-GJ-18-1505383670.jpg', '2017-09-14 04:37:50', '2017-09-14 04:37:50', NULL),
(19, 'Dahod', 'GJ-20', 'GU', 'District-GJ-20-1505383816.jpg', '2017-09-14 04:40:16', '2017-09-14 04:40:16', NULL),
(20, 'Navsari', 'GJ-21', 'GU', 'District-GJ-21-1505383850.jpg', '2017-09-14 04:40:50', '2017-09-14 04:40:50', NULL),
(21, 'Narmada', 'GJ-22', 'GU', 'District-GJ-22-1505383901.jpg', '2017-09-14 04:41:42', '2017-09-14 04:41:42', NULL),
(22, 'Anand', 'GJ-23', 'GU', 'District-GJ-23-1505383953.jpg', '2017-09-14 04:42:33', '2017-09-14 04:42:33', NULL),
(23, 'Patan', 'GJ-24', 'GU', 'District-GJ-24-1505384003.jpg', '2017-09-14 04:43:24', '2017-09-14 04:43:24', NULL),
(24, 'Porbandar', 'GJ-25', 'GU', 'District-GJ-25-1505384049.jpg', '2017-09-14 04:44:09', '2017-09-14 04:44:09', NULL),
(25, 'Tapi (Vyara)', 'GJ-26', 'GU', 'District-GJ-26-1505384118.jpg', '2017-09-14 04:45:18', '2017-09-14 04:45:18', NULL),
(26, 'Ahmedabad East (Vastral)', 'GJ-27', 'GU', 'District-GJ-27-1505384167.jpg', '2017-09-14 04:46:07', '2017-09-14 04:46:07', NULL),
(27, 'Surat rural', 'GJ-28', 'GU', 'District-GJ-28-1505384218.jpg', '2017-09-14 04:46:58', '2017-09-14 04:46:58', NULL),
(28, 'Vadodara rural', 'GJ-29', 'GU', 'District-GJ-29-1505384275.jpg', '2017-09-14 04:47:55', '2017-09-14 04:47:55', NULL),
(29, 'Dang', 'GJ-30', 'GU', 'District-GJ-30-1505384314.jpg', '2017-09-14 04:48:34', '2017-09-14 04:48:34', NULL),
(30, 'Gandhidham', 'GJ-31', 'GU', 'District-GJ-31-1505384375.jpg', '2017-09-14 04:49:35', '2017-09-14 04:49:35', NULL),
(31, 'Botad', 'GJ-32', 'GU', 'District-GJ-32-1505384440.jpg', '2017-09-14 04:50:40', '2017-09-14 04:50:40', NULL),
(32, 'Aravali', 'GJ-33', 'GU', 'District-GJ-33-1505384487.jpg', '2017-09-14 04:51:27', '2017-09-14 04:51:27', NULL),
(33, 'Dwarka', 'GJ-34', 'GU', 'District-GJ-34-1505384534.jpg', '2017-09-14 04:52:14', '2017-09-14 04:52:14', NULL),
(34, 'Mahisagar', 'GJ-35', 'GU', 'District-GJ-35-1505384566.jpg', '2017-09-14 04:52:46', '2017-09-14 04:52:46', NULL),
(35, 'Morbi', 'GJ-36', 'GU', 'District-GJ-36-1505384607.jpg', '2017-09-14 04:53:27', '2017-09-14 04:53:27', NULL),
(36, 'Chhota Udaipur', 'GJ-37', 'GU', 'District-GJ-37-1505384643.jpg', '2017-09-14 04:54:03', '2017-09-14 04:54:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ku_taluka`
--

CREATE TABLE `ku_taluka` (
  `id` int(10) UNSIGNED NOT NULL,
  `taluka_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` tinyint(4) NOT NULL,
  `taluka_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - Inactive , 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ku_taluka`
--

INSERT INTO `ku_taluka` (`id`, `taluka_name`, `district_code`, `district_id`, `taluka_image`, `taluka_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hello', 'GJ-4', 4, 'Taluka-hello-1505737847.PNG', 'hello taluka how are you', 1, '2017-09-18 07:00:47', '2017-09-18 07:00:47', NULL),
(2, 'kmlmlm', 'GJ-8', 8, 'Taluka-kmlmlm-1505758028.jpg', '===> આમલી નું ઝાડ \r\n\r\nઆમલીના આરોગ્ય લાભો\r\n1) પાચન સુધારે છે\r\n2) વજન ઘટાડે છે\r\n3) અટકાવે છે અને પેપ્ટીક અલ્સર વર્તે છે\r\n4) કેન્સર સંઘર્ષ\r\n5) ત્વચા સાફ કરે છે\r\n6) શરીર ની એનર્જી લાભો\r\n\r\n===> લીમડા નુ ઝાડ\r\n\r\nલીમડા નુ ઝાડ અેક ચમત્કારી ગણાય છે. ભારત મા અેક કહેવત લોક પ્રચલિત છે. જે ધરતી ઉપર લીમડા નુ ઝાડ હોઈ ત્યા મરન અને રોગ કેવી રીતે હોઈ.\r\n\r\n1) માથા ના વાળ માથી ખોડો મટાડો\r\n2)  ત્વચા ની સમસ્યાઓ ઘટાડો\r\n3)  મોઢાનું સંચાલન કરે છે\r\n4)  લોહીને શુદ્ધ કરે છે\r\n5)  ડાયાબિટીસ નિયંત્રિત કરે છે\r\n\r\n\r\n\r\n\r\napp design link \r\nhttps://dribbble.com/shots/3519538-My-Diet-App-Onboarding', 1, '2017-09-18 12:37:09', '2017-09-18 12:37:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_09_14_062531_create_district_table', 1),
(4, '2017_09_15_072838_create_taluka_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` double(10,6) DEFAULT NULL,
  `latitude` double(10,6) DEFAULT NULL,
  `user_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1:Male, 2:Female, 3:Other',
  `points` bigint(20) UNSIGNED DEFAULT NULL,
  `roster_app_amount` bigint(20) UNSIGNED DEFAULT NULL,
  `funds` decimal(8,2) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:Admin, 0:Normal',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `dob`, `password`, `location`, `longitude`, `latitude`, `user_pic`, `gender`, `points`, `roster_app_amount`, `funds`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Khedut Unity', 'App Admin', 'khedutunity_app', 'khedut.unity@gmail.com', NULL, NULL, '$2y$10$HeO2t5vpajZljyrhjDUb4uhQ8p8GROBAExo9RxIZEExCRda3/fc/6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-08-03 11:34:00', '2017-08-03 11:34:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ku_district`
--
ALTER TABLE `ku_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ku_taluka`
--
ALTER TABLE `ku_taluka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ku_district`
--
ALTER TABLE `ku_district`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `ku_taluka`
--
ALTER TABLE `ku_taluka`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
