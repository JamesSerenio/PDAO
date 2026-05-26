-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 03:18 AM
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
-- Database: `pdao`
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
-- Table structure for table `disability_causes`
--

CREATE TABLE `disability_causes` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `category` enum('CONGENITAL/INBORN','ACQUIRED') NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disability_causes`
--

INSERT INTO `disability_causes` (`id`, `category`, `name`) VALUES
(2, 'CONGENITAL/INBORN', 'ADHD'),
(1, 'CONGENITAL/INBORN', 'Autism'),
(3, 'CONGENITAL/INBORN', 'Cerebral Palsy'),
(4, 'CONGENITAL/INBORN', 'Down Syndrome'),
(5, 'CONGENITAL/INBORN', 'Others'),
(7, 'ACQUIRED', 'Cerebral Palsy'),
(6, 'ACQUIRED', 'Chronic Illness'),
(8, 'ACQUIRED', 'Injury'),
(9, 'ACQUIRED', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `disability_types`
--

CREATE TABLE `disability_types` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disability_types`
--

INSERT INTO `disability_types` (`id`, `name`) VALUES
(10, 'Cancer (RA 11215)'),
(1, 'Deaf or Hard of Hearing'),
(2, 'Intellectual Disability'),
(3, 'Learning Disability'),
(4, 'Mental Disability'),
(6, 'Multiple Disability'),
(5, 'Physical Disability'),
(7, 'Psychosocial Disability'),
(11, 'Rare Disease (RA 10747)'),
(8, 'Speech & Language Impairment'),
(9, 'Visual Disability');

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
-- Table structure for table `household_members`
--

CREATE TABLE `household_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `local_profile_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `educational_attainment` varchar(80) DEFAULT NULL,
  `relationship_to_pwd` varchar(80) DEFAULT NULL,
  `occupation` varchar(120) DEFAULT NULL,
  `social_pension_affiliation` varchar(120) DEFAULT NULL,
  `monthly_income` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household_members`
--

INSERT INTO `household_members` (`id`, `local_profile_id`, `name`, `date_of_birth`, `civil_status`, `educational_attainment`, `relationship_to_pwd`, `occupation`, `social_pension_affiliation`, `monthly_income`, `created_at`) VALUES
(5, 5, '12321', '2026-03-04', '321213', '312321', '321321', '321321', '321321', 213213.00, '2026-03-03 18:58:57'),
(6, 5, '12321', NULL, '3213213', '123213', '21321', '21321321', '32132', 21321.00, '2026-03-03 18:58:57'),
(8, 7, '12321', '2026-03-04', '321213', '312321', '321321', '321321', '321321', 213213.00, '2026-03-03 22:43:12'),
(9, 8, '12321', '2026-03-04', '321213', '312321', '321321', '321321', '321321', 213213.00, '2026-03-11 17:40:21');

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
-- Table structure for table `local_profiles`
--

CREATE TABLE `local_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ldr_number` varchar(50) DEFAULT NULL,
  `profiling_date` date DEFAULT NULL,
  `photo_1x1` varchar(255) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `blood_type` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `ethnic_group` varchar(100) DEFAULT NULL,
  `sex` enum('MALE','FEMALE') DEFAULT NULL,
  `signature_thumbmark` varchar(255) DEFAULT NULL,
  `civil_status` enum('Single','Separated','Cohabitation (Live-in)','Married','Widow','Widower') DEFAULT NULL,
  `house_no_street` varchar(200) DEFAULT NULL,
  `sitio_purok` varchar(100) DEFAULT NULL,
  `barangay` enum('Agusan Canyon','Alae','Dahilayan','Dalirig','Damilag','Dicklum','Guilang-guilang','Kalugmanan','Lindaban','Lingion','Lunocan','Maluko','Mambatangan','Mampayag','Mantibugao','Minsuro','San Miguel','Sankanan','Santiago','Santo Niño','Tankulan','Ticala') DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `education_level` enum('None','Kindergarten','Elementary','Junior High School','Senior High','College','Vocational','Post Graduate') DEFAULT NULL,
  `employment_status` enum('Employed','Unemployed','Self-employed') DEFAULT NULL,
  `employment_category` enum('Government','Private') DEFAULT NULL,
  `specific_occupation` varchar(150) DEFAULT NULL,
  `employment_type` enum('Permanent','Seasonal','Contractual','Job Order','On Call') DEFAULT NULL,
  `registered_voter` tinyint(1) DEFAULT NULL,
  `special_skills` text DEFAULT NULL,
  `sporting_talent` text DEFAULT NULL,
  `pwd_org_affiliated` varchar(150) DEFAULT NULL,
  `org_contact_person` varchar(150) DEFAULT NULL,
  `org_office_address` varchar(255) DEFAULT NULL,
  `org_tel_mobile` varchar(80) DEFAULT NULL,
  `id_reference_no` varchar(80) DEFAULT NULL,
  `sss_no` varchar(30) DEFAULT NULL,
  `gsis_no` varchar(30) DEFAULT NULL,
  `pagibig_no` varchar(30) DEFAULT NULL,
  `phn_no` varchar(30) DEFAULT NULL,
  `philhealth_no` varchar(30) DEFAULT NULL,
  `pwd_id_no` varchar(30) DEFAULT NULL,
  `is_bedridden` tinyint(1) NOT NULL DEFAULT 0,
  `is_indigent` tinyint(1) NOT NULL DEFAULT 0,
  `total_family_income` decimal(12,2) DEFAULT NULL,
  `interviewee_name` varchar(150) DEFAULT NULL,
  `interviewee_relationship` varchar(100) DEFAULT NULL,
  `interviewee_signature_thumbmark` varchar(255) DEFAULT NULL,
  `accomplished_by_name` varchar(150) DEFAULT NULL,
  `accomplished_by_position` varchar(100) DEFAULT NULL,
  `accomplished_signature` varchar(255) DEFAULT NULL,
  `reporting_unit_office_section` varchar(150) DEFAULT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `approved_signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_profiles`
--

INSERT INTO `local_profiles` (`id`, `ldr_number`, `profiling_date`, `photo_1x1`, `last_name`, `first_name`, `middle_name`, `suffix`, `date_of_birth`, `blood_type`, `religion`, `ethnic_group`, `sex`, `signature_thumbmark`, `civil_status`, `house_no_street`, `sitio_purok`, `barangay`, `municipality`, `province`, `region`, `landline`, `mobile`, `email`, `education_level`, `employment_status`, `employment_category`, `specific_occupation`, `employment_type`, `registered_voter`, `special_skills`, `sporting_talent`, `pwd_org_affiliated`, `org_contact_person`, `org_office_address`, `org_tel_mobile`, `id_reference_no`, `sss_no`, `gsis_no`, `pagibig_no`, `phn_no`, `philhealth_no`, `pwd_id_no`, `is_bedridden`, `is_indigent`, `total_family_income`, `interviewee_name`, `interviewee_relationship`, `interviewee_signature_thumbmark`, `accomplished_by_name`, `accomplished_by_position`, `accomplished_signature`, `reporting_unit_office_section`, `approved_by`, `approved_signature`, `created_at`, `updated_at`) VALUES
(5, '312', '2026-03-04', 'local_profiles/photos/nsrFhNXckZPvQzwgTC1rqdSVvEakZNGGCtsVoESW.jpg', 'Serenio', 'James', 'Manayaga', NULL, '2000-11-20', 'O+', 'catholic', NULL, 'FEMALE', 'local_profiles/signatures/E2v1xsZIBjHK8maGXw0pSvpiDE1dzQuigsCxqNkN.png', 'Single', '21321', 'Abyawan', 'Dalirig', 'manolo fortich', 'bukidnon', '10', NULL, '09264686973', 'sereniojames363@gmail.com', 'College', 'Employed', 'Government', 'Study', 'Job Order', 1, 'I.T', 'Swimming', 'Power Ranger', 'James Serenio', 'tankulan manolo fortich bukidnon', '09264686973', '21321321', '3213213', '21321', '3213213', '21321', NULL, '213123', 0, 1, 234534.00, 'James Serenio', 'cousin', 'local_profiles/interviewee_sign/8OgKzRkYkuWrcLnh5ARWbMk9UNZj8wyicCwWIw68.png', '312', '12312', 'local_profiles/accomplished_sign/j8PUgxI6xSapdapRQlQYyA1a1ES0zOG7kovl9q49.png', '213213', '12312', 'local_profiles/approved_sign/gQlzaUR4RVRlL5ph64zFOO4RO5U0Q5YTH8BEauiO.png', '2026-03-03 18:58:57', '2026-05-25 17:14:20'),
(7, '21233', '2026-03-09', 'local_profiles/photos/Z8aA2ibiw9NICeOJK5Pp1DJtFZGSH4Iyna5T9MZS.jpg', 'moradas', 'renante', 'V.', NULL, '1974-05-21', 'O+', 'roman', NULL, 'MALE', NULL, 'Married', 'phase2', 'P-2', 'Dicklum', 'manolo fortich', 'bukidnon', '10', NULL, '09264686973', 'sereniojames363@gmail.com', NULL, NULL, NULL, 'OIC', NULL, 1, 'Playing Guitar', 'Basketball', 'Power Rangers', 'James Serenio', 'tankulan manolo fortich bukidnon', '09264686973', '21321321', '3213213', '21321', '3213213', '21321', '1233', '213123', 1, 0, 213213.00, 'Geneck Kidlat', 'cousin', NULL, '312', '12312', NULL, '213213', '12312', NULL, '2026-03-03 22:43:12', '2026-05-25 17:10:49'),
(8, '21232', '2026-03-04', NULL, 'marlon', 'renante', 'V.', NULL, '1960-05-21', NULL, 'roman', NULL, NULL, NULL, NULL, 'phase2', 'zone 8', NULL, 'manolo fortich', 'bukidnon', '10', NULL, '09264686973', 'sereniojames363@gmail.com', NULL, NULL, NULL, 'OIC', NULL, NULL, NULL, NULL, 'Power Ranger', 'James Serenio', 'tankulan manolo fortich bukidnon', '09264686973', '21321321', '3213213', '21321', '3213213', '21321', '1233', '213123', 0, 0, 213213.00, 'James Serenio', 'cousin', NULL, '312', '12312', NULL, '213213', '12312', NULL, '2026-03-11 17:40:21', '2026-03-11 17:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `local_profile_disability_causes`
--

CREATE TABLE `local_profile_disability_causes` (
  `local_profile_id` bigint(20) UNSIGNED NOT NULL,
  `disability_cause_id` smallint(5) UNSIGNED NOT NULL,
  `other_specify` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_profile_disability_causes`
--

INSERT INTO `local_profile_disability_causes` (`local_profile_id`, `disability_cause_id`, `other_specify`) VALUES
(5, 1, NULL),
(5, 7, NULL),
(7, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `local_profile_disability_types`
--

CREATE TABLE `local_profile_disability_types` (
  `local_profile_id` bigint(20) UNSIGNED NOT NULL,
  `disability_type_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_profile_disability_types`
--

INSERT INTO `local_profile_disability_types` (`local_profile_id`, `disability_type_id`) VALUES
(5, 5),
(7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `local_profile_logs`
--

CREATE TABLE `local_profile_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `local_profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(40) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, '0001_01_01_000001_create_cache_table', 2),
(3, '0001_01_01_000002_create_jobs_table', 2),
(4, '2026_02_26_014401_add_role_to_users_table', 2),
(5, '2026_02_26_021927_create_sessions_table', 2),
(6, '2025_08_14_170933_add_two_factor_columns_to_users_table', 3);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HfwmaDF3F3U2lCRfoLbsY7fhPOxQLaswXMm5VHTk', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicTA4Y2pSamZDdUZmQkM2cTI3a1VWbEhhbnVBV21FVjliamlDaGRoZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMDoibG9naW4uZm9ybSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=', 1772504995),
('LbRZBDTrpHauzn689FzkwO5Ml1yrKnw17eFk8CEx', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUpqWWhUQ1FOWUpHQk5mc01pUVRwY0JmQ3VJdFk5THFUd0dOc2dYbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGFmZi9sb2NhbC1wcm9maWxlLWZvcm0iO3M6NToicm91dGUiO3M6MjQ6InN0YWZmLmxvY2FsX3Byb2ZpbGVfZm9ybSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=', 1772515563);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'Tikoy Morales', 'tikoymorales@gmail.com', NULL, '$2y$12$FeuYCH4evUHFfCHROUcKsOJbx.0FwANyPh4QKWyMVqy1wrwoiq8/O', NULL, NULL, NULL, 'admin', 'QoKsbcLy6duM19DcDzSQXff6HLOmKscosNlUngjXzHDjcYxXJVNlw4lf9TIG', '2026-02-26 03:46:52', '2026-02-25 20:03:45'),
(10, 'Staff Jiejie', 'jiejieq@gmail.com', NULL, '$2y$12$GqZ2ZbOpx6RwSMHMsw8sSO8VgaLGxr38tqU.qy00cgJFlQwQ7.j.q', NULL, NULL, NULL, 'admin', NULL, '2026-02-26 03:46:52', '2026-03-01 18:43:44'),
(11, 'Staff Balendez', 'balendez01@gmail.com', NULL, '$2y$12$O/3fX1WB6DbsbikD3jemhOFmioogUSVxK2jyU2pVk0JaXpHiB59.G', NULL, NULL, NULL, 'admin', NULL, '2026-02-26 03:46:52', '2026-03-01 18:43:45'),
(12, 'Staff Maring', 'maring14@gmail.com', NULL, '$2y$12$.UvmPFtUhBDYJRfzxKKtq.vnxXwHNyQMqWoO9avY844NehUaLwgGO', NULL, NULL, NULL, 'admin', NULL, '2026-02-26 03:46:52', '2026-03-01 18:43:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `disability_causes`
--
ALTER TABLE `disability_causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_cause` (`category`,`name`);

--
-- Indexes for table `disability_types`
--
ALTER TABLE `disability_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `household_members`
--
ALTER TABLE `household_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_household_profile` (`local_profile_id`);

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
-- Indexes for table `local_profiles`
--
ALTER TABLE `local_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ldr_number` (`ldr_number`),
  ADD KEY `idx_name` (`last_name`,`first_name`),
  ADD KEY `idx_barangay` (`barangay`),
  ADD KEY `idx_municipality` (`municipality`),
  ADD KEY `idx_profiling_date` (`profiling_date`);

--
-- Indexes for table `local_profile_disability_causes`
--
ALTER TABLE `local_profile_disability_causes`
  ADD PRIMARY KEY (`local_profile_id`,`disability_cause_id`),
  ADD KEY `fk_lpdc_cause` (`disability_cause_id`);

--
-- Indexes for table `local_profile_disability_types`
--
ALTER TABLE `local_profile_disability_types`
  ADD PRIMARY KEY (`local_profile_id`,`disability_type_id`),
  ADD KEY `fk_lpdt_type` (`disability_type_id`);

--
-- Indexes for table `local_profile_logs`
--
ALTER TABLE `local_profile_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lpl_profile` (`local_profile_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disability_causes`
--
ALTER TABLE `disability_causes`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `disability_types`
--
ALTER TABLE `disability_types`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_profiles`
--
ALTER TABLE `local_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `local_profile_logs`
--
ALTER TABLE `local_profile_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `household_members`
--
ALTER TABLE `household_members`
  ADD CONSTRAINT `fk_household_profile` FOREIGN KEY (`local_profile_id`) REFERENCES `local_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `local_profile_disability_causes`
--
ALTER TABLE `local_profile_disability_causes`
  ADD CONSTRAINT `fk_lpdc_cause` FOREIGN KEY (`disability_cause_id`) REFERENCES `disability_causes` (`id`),
  ADD CONSTRAINT `fk_lpdc_profile` FOREIGN KEY (`local_profile_id`) REFERENCES `local_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `local_profile_disability_types`
--
ALTER TABLE `local_profile_disability_types`
  ADD CONSTRAINT `fk_lpdt_profile` FOREIGN KEY (`local_profile_id`) REFERENCES `local_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lpdt_type` FOREIGN KEY (`disability_type_id`) REFERENCES `disability_types` (`id`);

--
-- Constraints for table `local_profile_logs`
--
ALTER TABLE `local_profile_logs`
  ADD CONSTRAINT `fk_lpl_profile` FOREIGN KEY (`local_profile_id`) REFERENCES `local_profiles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
