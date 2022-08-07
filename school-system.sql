-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2022 at 09:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `grade_id`, `created_at`, `updated_at`) VALUES
(1, 'أبوبكر', 1, '2022-08-07 04:35:28', '2022-08-07 04:35:28'),
(2, 'عمر', 1, '2022-08-07 04:35:35', '2022-08-07 04:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'لايوجد تخفيض', 0, NULL, NULL),
(2, 'طالب واحد', 5, NULL, NULL),
(3, 'اخويين', 10, NULL, NULL),
(4, '3 اخوان', 15, NULL, NULL),
(5, '4 اخوان او اكثر', 20, NULL, NULL),
(6, 'ابناء عاملين', 75, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'رسوم التسجيل', 1, NULL, NULL),
(2, 'الرسوم الدراسية', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'اﻷول', 1, '2022-08-07 04:35:01', '2022-08-07 04:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `grade_fees`
--

CREATE TABLE `grade_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `fee_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade_fees`
--

INSERT INTO `grade_fees` (`id`, `grade_id`, `fee_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 30000, '2022-08-07 04:35:01', '2022-08-07 04:35:01'),
(2, 1, 2, 250000, '2022-08-07 04:35:01', '2022-08-07 04:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `guardian_relations`
--

CREATE TABLE `guardian_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guardian_relations`
--

INSERT INTO `guardian_relations` (`id`, `relation`, `created_at`, `updated_at`) VALUES
(1, 'اب', NULL, NULL),
(2, 'ام', NULL, NULL),
(3, 'جد', NULL, NULL),
(4, 'جدة', NULL, NULL),
(5, 'عم', NULL, NULL),
(6, 'عمة', NULL, NULL),
(7, 'خال', NULL, NULL),
(8, 'خالة', NULL, NULL),
(9, 'اخ', NULL, NULL),
(10, 'اخت', NULL, NULL),
(11, 'ابن عم', NULL, NULL),
(12, 'ابن عمة', NULL, NULL),
(13, 'ابن خال', NULL, NULL),
(14, 'ابن خالة', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mark` double(2,2) NOT NULL,
  `result_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_20_070123_create_schools_table', 1),
(6, '2022_07_20_070223_create_grades_table', 1),
(7, '2022_07_21_070123_create_classrooms_table', 1),
(8, '2022_07_21_070323_create_students_table', 1),
(9, '2022_07_24_123543_create_nationalities_table', 1),
(10, '2022_07_24_130252_create_guardian_relations_table', 1),
(11, '2022_07_26_090457_create_discounts_table', 1),
(12, '2022_07_26_090457_create_exams_table', 1),
(13, '2022_07_26_090457_create_fees_table', 1),
(14, '2022_07_26_090457_create_grade_fees_table', 1),
(15, '2022_07_26_090457_create_results_table', 1),
(16, '2022_07_26_090457_create_subjects_table', 1),
(17, '2022_07_26_090458_create_marks_table', 1),
(18, '2022_07_31_062120_create_student_parts_table', 1),
(19, '2022_08_03_124447_laratrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `country`, `created_at`, `updated_at`) VALUES
(1, 'السودان', NULL, NULL),
(2, 'جنوب السودان', NULL, NULL),
(3, 'سوريا', NULL, NULL),
(4, 'مصر', NULL, NULL),
(5, 'السعودية', NULL, NULL),
(6, 'الامارات', NULL, NULL),
(7, 'ليبيا', NULL, NULL),
(8, 'اليمن', NULL, NULL),
(9, 'العراق', NULL, NULL),
(10, 'اثيوبيا', NULL, NULL),
(11, 'تونس', NULL, NULL),
(12, 'الجزائر', NULL, NULL),
(13, 'المغرب', NULL, NULL),
(14, 'موريتانيا', NULL, NULL),
(15, 'تشاد', NULL, NULL),
(16, 'الصومال', NULL, NULL),
(17, 'عمان', NULL, NULL),
(18, 'الكويت', NULL, NULL),
(19, 'فلسطين', NULL, NULL),
(20, 'لبنان', NULL, NULL),
(21, 'قطر', NULL, NULL),
(22, 'البحرين', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'User-create', 'Create User', 'Create User', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(2, 'User-read', 'Read User', 'Read User', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(3, 'User-update', 'Update User', 'Update User', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(4, 'User-delete', 'Delete User', 'Delete User', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(5, 'Student-create', 'Create Student', 'Create Student', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(6, 'Student-read', 'Read Student', 'Read Student', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(7, 'Student-update', 'Update Student', 'Update Student', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(8, 'Student-delete', 'Delete Student', 'Delete Student', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(9, 'Classroom-create', 'Create Classroom', 'Create Classroom', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(10, 'Classroom-read', 'Read Classroom', 'Read Classroom', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(11, 'Classroom-update', 'Update Classroom', 'Update Classroom', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(12, 'Classroom-delete', 'Delete Classroom', 'Delete Classroom', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(13, 'Grade-create', 'Create Grade', 'Create Grade', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(14, 'Grade-read', 'Read Grade', 'Read Grade', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(15, 'Grade-update', 'Update Grade', 'Update Grade', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(16, 'Grade-delete', 'Delete Grade', 'Delete Grade', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(17, 'School-create', 'Create School', 'Create School', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(18, 'School-read', 'Read School', 'Read School', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(19, 'School-update', 'Update School', 'Update School', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(20, 'School-delete', 'Delete School', 'Delete School', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(21, 'Fee-create', 'Create Fee', 'Create Fee', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(22, 'Fee-read', 'Read Fee', 'Read Fee', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(23, 'Fee-update', 'Update Fee', 'Update Fee', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(24, 'Fee-delete', 'Delete Fee', 'Delete Fee', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(25, 'Discount-create', 'Create Discount', 'Create Discount', '2022-08-07 04:29:16', '2022-08-07 04:29:16'),
(26, 'Discount-read', 'Read Discount', 'Read Discount', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(27, 'Discount-update', 'Update Discount', 'Update Discount', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(28, 'Discount-delete', 'Delete Discount', 'Delete Discount', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(29, 'GradFee-create', 'Create GradFee', 'Create GradFee', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(30, 'GradFee-read', 'Read GradFee', 'Read GradFee', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(31, 'GradFee-update', 'Update GradFee', 'Update GradFee', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(32, 'GradFee-delete', 'Delete GradFee', 'Delete GradFee', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(33, 'Result-create', 'Create Result', 'Create Result', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(34, 'Result-read', 'Read Result', 'Read Result', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(35, 'Result-update', 'Update Result', 'Update Result', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(36, 'Result-delete', 'Delete Result', 'Delete Result', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(37, 'Exam-create', 'Create Exam', 'Create Exam', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(38, 'Exam-read', 'Read Exam', 'Read Exam', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(39, 'Exam-update', 'Update Exam', 'Update Exam', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(40, 'Exam-delete', 'Delete Exam', 'Delete Exam', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(41, 'Mark-create', 'Create Mark', 'Create Mark', '2022-08-07 04:29:17', '2022-08-07 04:29:17'),
(42, 'Mark-read', 'Read Mark', 'Read Mark', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(43, 'Mark-update', 'Update Mark', 'Update Mark', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(44, 'Mark-delete', 'Delete Mark', 'Delete Mark', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(45, 'Subject-create', 'Create Subject', 'Create Subject', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(46, 'Subject-read', 'Read Subject', 'Read Subject', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(47, 'Subject-update', 'Update Subject', 'Update Subject', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(48, 'Subject-delete', 'Delete Subject', 'Delete Subject', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(49, 'Role-create', 'Create Role', 'Create Role', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(50, 'Role-read', 'Read Role', 'Read Role', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(51, 'Role-update', 'Update Role', 'Update Role', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(52, 'Role-delete', 'Delete Role', 'Delete Role', '2022-08-07 04:29:18', '2022-08-07 04:29:18'),
(53, 'Permission-create', 'Create Permission', 'Create Permission', '2022-08-07 04:29:19', '2022-08-07 04:29:19'),
(54, 'Permission-read', 'Read Permission', 'Read Permission', '2022-08-07 04:29:19', '2022-08-07 04:29:19'),
(55, 'Permission-update', 'Update Permission', 'Update Permission', '2022-08-07 04:29:19', '2022-08-07 04:29:19'),
(56, 'Permission-delete', 'Delete Permission', 'Delete Permission', '2022-08-07 04:29:19', '2022-08-07 04:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(18, 5),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(22, 3),
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 4),
(34, 1),
(34, 2),
(34, 4),
(34, 5),
(35, 1),
(35, 4),
(36, 1),
(36, 4),
(37, 1),
(37, 4),
(38, 1),
(38, 2),
(38, 4),
(38, 5),
(39, 1),
(39, 4),
(40, 1),
(40, 4),
(41, 1),
(41, 4),
(42, 1),
(42, 2),
(42, 4),
(42, 5),
(43, 1),
(43, 4),
(44, 1),
(44, 4),
(45, 1),
(45, 4),
(46, 1),
(46, 2),
(46, 4),
(46, 5),
(47, 1),
(47, 4),
(48, 1),
(48, 4),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Super Admin', 'Super Admin', '2022-08-07 04:29:15', '2022-08-07 04:29:15'),
(2, 'finance_manager', 'Finance Manager', 'Finance Manager', '2022-08-07 04:29:23', '2022-08-07 04:29:23'),
(3, 'accountant', 'Accountant', 'Accountant', '2022-08-07 04:29:26', '2022-08-07 04:29:26'),
(4, 'results_manager', 'Results Manager', 'Results Manager', '2022-08-07 04:29:26', '2022-08-07 04:29:26'),
(5, 'results_reader', 'Results Reader', 'Results Reader', '2022-08-07 04:29:28', '2022-08-07 04:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 2, 'App\\Models\\User'),
(3, 3, 'App\\Models\\User'),
(4, 4, 'App\\Models\\User'),
(5, 5, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'مدارس امادو اساس بنين', '2022-08-07 04:34:27', '2022-08-07 04:34:27'),
(2, 'مدارس امادو اساس بنات', '2022-08-07 04:34:42', '2022-08-07 04:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_workplace` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_f_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_s_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_f_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_s_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nationality_id` bigint(20) UNSIGNED NOT NULL,
  `guardian_relation_id` bigint(20) UNSIGNED NOT NULL,
  `no_payment` tinyint(1) DEFAULT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `address`, `guardian`, `guardian_workplace`, `guardian_f_phone`, `guardian_s_phone`, `mother_name`, `mother_f_phone`, `mother_s_phone`, `discount_id`, `nationality_id`, `guardian_relation_id`, `no_payment`, `classroom_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'أحمد بدرالدين محمد عبدالقادر', 'أركويت - مربع 59 جوار مسجد السيدة زينب', 'عزة اسماعيل مرحوم', 'المنزل', '0911255899', NULL, 'عزة اسماعيل', '0911255899', NULL, 3, 1, 2, NULL, 1, NULL, '2022-08-07 04:36:36', '2022-08-07 04:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `student_parts`
--

CREATE TABLE `student_parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_number` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment_time` date DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_type` int(11) DEFAULT NULL,
  `check_number` int(11) DEFAULT NULL,
  `check_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_parts`
--

INSERT INTO `student_parts` (`id`, `part_number`, `type`, `amount`, `payment_time`, `paid`, `payment_type`, `check_number`, `check_owner`, `payment_image`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 30000, '2022-08-07', 1, 1, NULL, NULL, NULL, 1, '2022-08-07 04:36:36', '2022-08-07 04:38:34'),
(2, 1, 2, 112500, '2022-08-07', 1, 2, NULL, NULL, '202208070638WhatsApp Image 2022-08-06 at 2.35.02 PM.jpeg', 1, '2022-08-07 04:36:36', '2022-08-07 04:38:48'),
(3, 2, 2, 56250, NULL, 0, NULL, NULL, NULL, NULL, 1, '2022-08-07 04:36:36', '2022-08-07 04:36:36'),
(4, 3, 2, 50000, NULL, 0, NULL, NULL, NULL, NULL, 1, '2022-08-07 04:36:36', '2022-08-07 04:38:24'),
(5, 5, 2, 6250, NULL, 0, NULL, NULL, NULL, NULL, 1, '2022-08-07 04:38:05', '2022-08-07 04:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_mark` int(11) NOT NULL,
  `grade_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super_admin', '$2y$10$WPwswUSKn9Yk/yWy97QiJuebo2MjOSCI6kRHpqFeUEeRJSgUiMwq2', NULL, '2022-08-07 04:29:23', '2022-08-07 04:29:23'),
(2, 'Finance Manager', 'finance_manager', '$2y$10$RjuexWZV4h6tLiibE6434ud7yN7pX96s6T8sw25qM0AO1Fl2/ZLmC', NULL, '2022-08-07 04:29:25', '2022-08-07 04:29:25'),
(3, 'احمد', 'احمد', '$2y$10$dWDY3afsvrl5UO3mQlho8Oo9FlSWJPg7rYLD7EwnGXxk4L2mVxk7W', NULL, '2022-08-07 04:29:26', '2022-08-07 04:30:28'),
(4, 'حسن', 'حسن', '$2y$10$juv7LgMFGifYMMbIRvpyruUPq2DcVSwGyzts5puK8MlJfT749dcfu', NULL, '2022-08-07 04:29:28', '2022-08-07 04:31:37'),
(5, 'مدير البنين', 'عثمان', '$2y$10$CUe4ei98jjxB8CjJrdUi6u1P86CwwAPi2g9UtPzO0e324AJbtr3f2', NULL, '2022-08-07 04:29:28', '2022-08-07 04:32:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classrooms_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discounts_name_unique` (`name`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_name_unique` (`name`),
  ADD KEY `exams_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fees_name_unique` (`name`),
  ADD UNIQUE KEY `fees_type_unique` (`type`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_school_id_foreign` (`school_id`);

--
-- Indexes for table `grade_fees`
--
ALTER TABLE `grade_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_fees_grade_id_foreign` (`grade_id`),
  ADD KEY `grade_fees_fee_id_foreign` (`fee_id`);

--
-- Indexes for table `guardian_relations`
--
ALTER TABLE `guardian_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_result_id_foreign` (`result_id`),
  ADD KEY `marks_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_student_id_foreign` (`student_id`),
  ADD KEY `results_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_name_unique` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `student_parts`
--
ALTER TABLE `student_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_parts_student_id_foreign` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_name_unique` (`name`),
  ADD KEY `subjects_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grade_fees`
--
ALTER TABLE `grade_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guardian_relations`
--
ALTER TABLE `guardian_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_parts`
--
ALTER TABLE `student_parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grade_fees`
--
ALTER TABLE `grade_fees`
  ADD CONSTRAINT `grade_fees_fee_id_foreign` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grade_fees_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_result_id_foreign` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_parts`
--
ALTER TABLE `student_parts`
  ADD CONSTRAINT `student_parts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
