-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 02:50 PM
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
-- Database: `oerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `nid_number` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `emergency_contact_name_one` varchar(255) DEFAULT NULL,
  `emergency_contact_number_one` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_one` varchar(255) DEFAULT NULL,
  `emergency_contact_name_two` varchar(255) DEFAULT NULL,
  `emergency_contact_number_two` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_two` varchar(255) DEFAULT NULL,
  `emergency_contact_name_three` varchar(255) DEFAULT NULL,
  `emergency_contact_number_three` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

CREATE TABLE `business_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_type` varchar(255) NOT NULL,
  `business_status` int(11) NOT NULL COMMENT 'Status of the role: 1 for active, 2 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_types`
--

INSERT INTO `business_types` (`id`, `business_type`, `business_status`, `created_at`, `updated_at`) VALUES
(1, 'Software Company', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(2, 'Hospital Management', 1, '2024-09-23 08:50:40', '2024-09-23 08:50:40');

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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `trade_license_no` varchar(255) DEFAULT NULL,
  `bin_no` varchar(255) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `contact_no`, `trade_license_no`, `bin_no`, `tin_no`, `company_address`, `division_id`, `district_id`, `country`, `created_at`, `updated_at`) VALUES
(1, 'Otithee Software Solution Limited', '+8801907802744', 'TRAD/DNCC/029335/2023', NULL, NULL, 'Police Plaza Concord, Tower-A, Floor #8N, 10E, Plot #02, Road #144, Gulshan-1, Dhaka-1212, Bangladesh.', 6, 47, 'Bangladesh', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(2, 'FusionMatrix', '01513470120', 'TRAD/DNCC/029340/2024', '0001234567890', '123456789012', 'Laalbagh, Dhaka', 6, 47, 'Bangladesh', '2024-09-23 08:50:40', '2024-09-23 08:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lon` decimal(11,8) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', 23.46827470, 91.17881350, 'www.comilla.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(2, 1, 'Feni', 'ফেনী', 23.02323100, 91.38408440, 'www.feni.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.95709040, 91.11192860, 'www.brahmanbaria.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', 22.65561018, 92.17541121, 'www.rangamati.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(5, 1, 'Noakhali', 'নোয়াখালী', 22.86956300, 91.09939800, 'www.noakhali.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(6, 1, 'Chandpur', 'চাঁদপুর', 23.23325850, 90.67129120, 'www.chandpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', 22.94247700, 90.84118400, 'www.lakshmipur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(8, 1, 'Chattogram', 'চট্টগ্রাম', 22.33510900, 91.83407300, 'www.chittagong.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(9, 1, 'Coxsbazar', 'কক্সবাজার', 21.44315751, 91.97381741, 'www.coxsbazar.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', 23.11928500, 91.98466300, 'www.khagrachhari.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(11, 1, 'Bandarban', 'বান্দরবান', 22.19532750, 92.21837730, 'www.bandarban.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', 24.48055500, 89.70867900, 'www.sirajganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(13, 2, 'Pabna', 'পাবনা', 23.99852400, 89.23364500, 'www.pabna.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(14, 2, 'Bogura', 'বগুড়া', 24.84652280, 89.37775500, 'www.bogra.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(15, 2, 'Rajshahi', 'রাজশাহী', 24.37450000, 88.60416600, 'www.rajshahi.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(16, 2, 'Natore', 'নাটোর', 24.42055600, 89.00028200, 'www.natore.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(17, 2, 'Joypurhat', 'জয়পুরহাট', 25.10216400, 89.02648900, 'www.joypurhat.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', 24.59650340, 88.27751200, 'www.chapainawabganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(19, 2, 'Naogaon', 'নওগাঁ', 24.82336050, 88.94486200, 'www.naogaon.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(20, 3, 'Jessore', 'যশোর', 23.17066300, 89.21320600, 'www.jessore.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(21, 3, 'Satkhira', 'সাতক্ষীরা', 22.71937600, 89.07057900, 'www.satkhira.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(22, 3, 'Meherpur', 'মেহেরপুর', 23.76794200, 88.63182100, 'www.meherpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(23, 3, 'Narail', 'নড়াইল', 23.16643000, 89.49514000, 'www.narail.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', 23.64019610, 88.84184100, 'www.chuadanga.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(25, 3, 'Kushtia', 'কুষ্টিয়া', 23.90125800, 89.12048200, 'www.kushtia.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(26, 3, 'Magura', 'মাগুরা', 23.48733700, 89.41995600, 'www.magura.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(27, 3, 'Khulna', 'খুলনা', 22.81577400, 89.56867900, 'www.khulna.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(28, 3, 'Bagerhat', 'বাগেরহাট', 22.65797000, 89.78593800, 'www.bagerhat.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', 23.54119700, 89.15318200, 'www.jhenaidah.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(30, 4, 'Jhalokathi', 'ঝালকাঠি', 22.64056000, 90.19873800, 'www.jhalokathi.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(31, 4, 'Patuakhali', 'পটুয়াখালী', 22.35831700, 90.32987100, 'www.patuakhali.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(32, 4, 'Pirojpur', 'পিরোজপুর', 22.58410500, 89.97845400, 'www.pirojpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(33, 4, 'Barisal', 'বরিশাল', 22.70100200, 90.35345100, 'www.barisal.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(34, 4, 'Bhola', 'ভোলা', 22.68592300, 90.71821800, 'www.bhola.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(35, 4, 'Barguna', 'বরগুনা', 22.16305300, 90.13536200, 'www.barguna.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(36, 5, 'Sylhet', 'সিলেট', 24.88979560, 91.86978940, 'www.sylhet.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', 24.48293400, 91.77741700, 'www.moulvibazar.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(38, 5, 'Habiganj', 'হবিগঞ্জ', 24.30654800, 91.41650400, 'www.habiganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', 25.06580400, 91.39501100, 'www.sunamganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(40, 6, 'Narsingdi', 'নরসিংদী', 23.93223300, 90.71541000, 'www.narsingdi.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(41, 6, 'Gazipur', 'গাজীপুর', 24.00228580, 90.42642830, 'www.gazipur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(42, 6, 'Shariatpur', 'শরিয়তপুর', 23.24233070, 90.43478380, 'www.shariatpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', 23.63366000, 90.49648200, 'www.narayanganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(44, 6, 'Tangail', 'টাঙ্গাইল', 24.25134500, 89.91666700, 'www.tangail.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', 24.44493700, 90.77657500, 'www.kishoreganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', 23.84780900, 90.00421050, 'www.manikganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(47, 6, 'Dhaka', 'ঢাকা', 23.71152530, 90.41114510, 'www.dhaka.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(48, 6, 'Munshiganj', 'মুন্সীগঞ্জ', 23.54222730, 90.53051210, 'www.munshiganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(49, 6, 'Rajbari', 'রাজবাড়ি', 23.75743050, 89.64446650, 'www.rajbari.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(50, 6, 'Madaripur', 'মাদারীপুর', 23.16410200, 90.18968050, 'www.madaripur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', 23.00508570, 89.82660590, 'www.gopalganj.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(52, 6, 'Faridpur', 'ফরিদপুর', 23.60708220, 89.84294060, 'www.faridpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(53, 7, 'Panchagarh', 'পঞ্চগড়', 26.32784600, 88.52686600, 'www.panchagarh.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(54, 7, 'Dinajpur', 'দিনাজপুর', 25.62170610, 88.63545040, 'www.dinajpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', 25.99234200, 89.28472500, 'www.lalmonirhat.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(56, 7, 'Nilphamari', 'নীলফামারী', 25.93179400, 88.85600600, 'www.nilphamari.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(57, 7, 'Gaibandha', 'গাইবান্ধা', 25.32875100, 89.52808800, 'www.gaibandha.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', 26.03369400, 88.46470500, 'www.thakurgaon.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(59, 7, 'Rangpur', 'রংপুর', 25.75580960, 89.24446200, 'www.rangpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', 25.80708100, 89.62926500, 'www.kurigram.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(61, 8, 'Sherpur', 'শেরপুর', 25.02049300, 90.01529600, 'www.sherpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', 24.74714900, 90.42027300, 'www.mymensingh.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(63, 8, 'Jamalpur', 'জামালপুর', 24.93753300, 89.93777500, 'www.jamalpur.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(64, 8, 'Netrokona', 'নেত্রকোণা', 24.87095500, 90.72788700, 'www.netrokona.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Chattagram', 'চট্টগ্রাম', 'www.chittagongdiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(2, 'Rajshahi', 'রাজশাহী', 'www.rajshahidiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(3, 'Khulna', 'খুলনা', 'www.khulnadiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(4, 'Barisal', 'বরিশাল', 'www.barisaldiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(5, 'Sylhet', 'সিলেট', 'www.sylhetdiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(6, 'Dhaka', 'ঢাকা', 'www.dhakadiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(7, 'Rangpur', 'রংপুর', 'www.rangpurdiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(8, 'Mymensingh', 'ময়মনসিংহ', 'www.mymensinghdiv.gov.bd', '2024-09-23 08:43:07', '2024-09-23 08:43:07');

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
-- Table structure for table `hr_attendances`
--

CREATE TABLE `hr_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `entry_time` time DEFAULT NULL,
  `exit_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_benefits`
--

CREATE TABLE `hr_benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `benefit_name` varchar(255) NOT NULL,
  `benefit_description` text DEFAULT NULL,
  `benefit_type` varchar(255) DEFAULT NULL,
  `eligibility_criteria` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_branches`
--

CREATE TABLE `hr_branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `br_name` varchar(255) DEFAULT NULL,
  `br_address` varchar(255) DEFAULT NULL,
  `br_type` int(11) NOT NULL COMMENT 'Status of the role: 1 for Head Office, 2 for Single Branch',
  `br_status` int(11) NOT NULL COMMENT 'Status of the role: 1 for active, 2 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hr_branches`
--

INSERT INTO `hr_branches` (`id`, `company_id`, `br_name`, `br_address`, `br_type`, `br_status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Islampur Branch', 'Islampur Road', 1, 1, '2024-09-23 10:02:54', '2024-09-23 10:02:54'),
(2, 2, 'Mirpur Branch', 'Mirpur 10', 2, 2, '2024-09-23 10:03:08', '2024-09-23 10:03:08'),
(3, 2, 'Dhanmondi Branch', 'Dhanmondi 27, Dhaka', 2, 1, '2024-09-23 10:03:28', '2024-09-23 10:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `hr_departments`
--

CREATE TABLE `hr_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dept_name` varchar(255) DEFAULT NULL,
  `dept_status` int(11) NOT NULL COMMENT 'Status of the role: 1 for active, 2 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hr_departments`
--

INSERT INTO `hr_departments` (`id`, `company_id`, `branch_id`, `dept_name`, `dept_status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'IT department', 1, '2024-09-23 10:03:38', '2024-09-23 10:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `hr_designations`
--

CREATE TABLE `hr_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level` int(11) NOT NULL COMMENT '1 = managing level, 2 = operational level, 3 = support level',
  `designation_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hr_designations`
--

INSERT INTO `hr_designations` (`id`, `company_id`, `level`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Senior Software Engineer', '2024-09-23 10:01:43', '2024-09-23 10:01:43'),
(2, 2, 1, 'Inventory Manager', '2024-09-23 10:01:53', '2024-09-23 10:01:53'),
(3, 2, 3, 'IT Support', '2024-09-23 10:02:02', '2024-09-23 10:02:02'),
(4, 2, 2, 'Sales Executive', '2024-09-23 10:02:14', '2024-09-23 10:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `hr_documents`
--

CREATE TABLE `hr_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_type` varchar(100) DEFAULT NULL,
  `document_file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_employees`
--

CREATE TABLE `hr_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `monthly_salary` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `nid_number` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `emergency_contact_name_one` varchar(255) DEFAULT NULL,
  `emergency_contact_number_one` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_one` varchar(255) DEFAULT NULL,
  `emergency_contact_name_two` varchar(255) DEFAULT NULL,
  `emergency_contact_number_two` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_two` varchar(255) DEFAULT NULL,
  `emergency_contact_name_three` varchar(255) DEFAULT NULL,
  `emergency_contact_number_three` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hr_employees`
--

INSERT INTO `hr_employees` (`id`, `user_id`, `designation_id`, `branch_id`, `department_id`, `joining_date`, `monthly_salary`, `profile_pic`, `full_name`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `emergency_contact_name_one`, `emergency_contact_number_one`, `emergency_contact_relation_one`, `emergency_contact_name_two`, `emergency_contact_number_two`, `emergency_contact_relation_two`, `emergency_contact_name_three`, `emergency_contact_number_three`, `emergency_contact_relation_three`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 3, 1, '2024-09-23', '25500.50', 'profile/202409231727092826.jpg', 'Fahad Ahmed', 'Jasim Ahmed', 'Nazma Begum', '01814750127', '354353363', 'Hazaribagh, Dhaka', 'Hazaribagh, Dhaka', '1993-08-11', 'O+', 'Bangladeshi', 'Single', 'Islam', 'Male', 'Jasim Ahmed', '01715470120', 'Father', 'Nazma Begum', '01814780127', 'Mother', NULL, NULL, NULL, '2024-09-23 11:24:03', '2024-09-23 12:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_benefits`
--

CREATE TABLE `hr_employee_benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_date` date DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_trainings`
--

CREATE TABLE `hr_employee_trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `training_program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `completion_status` int(11) NOT NULL COMMENT '1 = not_started, 2 = in_progress, 3 = completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave_applications`
--

CREATE TABLE `hr_leave_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leave_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_type` int(11) NOT NULL COMMENT '1 = file attachment, 2= form submission',
  `application_file` varchar(255) DEFAULT NULL,
  `application_msg` text DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `application_from` date DEFAULT NULL,
  `application_to` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `approved_duration` int(11) DEFAULT NULL,
  `application_status` int(11) NOT NULL COMMENT '1 = pending, 2 = approved, 3 = declined',
  `application_approved_user_id` int(11) DEFAULT NULL,
  `application_approved_date` date DEFAULT NULL,
  `application_decline_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leave_types`
--

CREATE TABLE `hr_leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_managers`
--

CREATE TABLE `hr_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `monthly_salary` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `nid_number` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `emergency_contact_name_one` varchar(255) DEFAULT NULL,
  `emergency_contact_number_one` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_one` varchar(255) DEFAULT NULL,
  `emergency_contact_name_two` varchar(255) DEFAULT NULL,
  `emergency_contact_number_two` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_two` varchar(255) DEFAULT NULL,
  `emergency_contact_name_three` varchar(255) DEFAULT NULL,
  `emergency_contact_number_three` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_notices`
--

CREATE TABLE `hr_notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `notice_body` text NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_overtimes`
--

CREATE TABLE `hr_overtimes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `overtime_date` date DEFAULT NULL,
  `overtime_hours` int(11) DEFAULT NULL,
  `overtime_rate` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_payrolls`
--

CREATE TABLE `hr_payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary_date` date DEFAULT NULL,
  `per_day_salary` varchar(255) DEFAULT NULL,
  `total_working_day` int(11) DEFAULT NULL,
  `total_leave` int(11) DEFAULT NULL,
  `total_number_of_pay_day` int(11) DEFAULT NULL,
  `monthly_salary` varchar(255) DEFAULT NULL,
  `monthly_bonus` varchar(255) DEFAULT NULL,
  `total_overtime_hours` int(11) DEFAULT NULL,
  `overtime_rate` varchar(255) DEFAULT NULL,
  `total_overtime_paid_amount` varchar(255) DEFAULT NULL,
  `total_daily_allowance` varchar(255) DEFAULT NULL,
  `total_travel_allowance` varchar(255) DEFAULT NULL,
  `rental_cost_allowance` varchar(255) DEFAULT NULL,
  `hospital_bill_allowance` varchar(255) DEFAULT NULL,
  `insurance_allowance` varchar(255) DEFAULT NULL,
  `sales_commission` varchar(255) DEFAULT NULL,
  `retail_commission` varchar(255) DEFAULT NULL,
  `total_others` varchar(255) DEFAULT NULL,
  `total_salary` varchar(255) DEFAULT NULL,
  `yearly_bonus` varchar(255) DEFAULT NULL,
  `gross_pay` varchar(255) DEFAULT NULL,
  `deduction` varchar(255) DEFAULT NULL,
  `net_pay` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL COMMENT '1 = pending, 2 = paid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_recruitment_candidates`
--

CREATE TABLE `hr_recruitment_candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = applied, 2 = interviewed, 3 = hired, 4 = rejected',
  `applied_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_recruitment_interviews`
--

CREATE TABLE `hr_recruitment_interviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interview_date` date NOT NULL,
  `interview_time` time NOT NULL,
  `interviewers` text DEFAULT NULL,
  `interview_feedback` text DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = scheduled, 2 = completed, 3 = cancelled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_recruitment_jobs`
--

CREATE TABLE `hr_recruitment_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employment_type` varchar(255) DEFAULT NULL,
  `salary_range` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = open, 2 = closed, 3 = filled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hr_training_programs`
--

CREATE TABLE `hr_training_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `program_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = upcoming, 2 = ongoing, 3 = completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Table structure for table `master_admins`
--

CREATE TABLE `master_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `nid_number` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `emergency_contact_name_one` varchar(255) DEFAULT NULL,
  `emergency_contact_number_one` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_one` varchar(255) DEFAULT NULL,
  `emergency_contact_name_two` varchar(255) DEFAULT NULL,
  `emergency_contact_number_two` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_two` varchar(255) DEFAULT NULL,
  `emergency_contact_name_three` varchar(255) DEFAULT NULL,
  `emergency_contact_number_three` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_admins`
--

INSERT INTO `master_admins` (`id`, `user_id`, `profile_pic`, `full_name`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `emergency_contact_name_one`, `emergency_contact_number_one`, `emergency_contact_relation_one`, `emergency_contact_name_two`, `emergency_contact_number_two`, `emergency_contact_relation_two`, `emergency_contact_name_three`, `emergency_contact_number_three`, `emergency_contact_relation_three`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-23 08:50:40', '2024-09-23 08:50:40');

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
(3, '2024_07_14_042734_create_vendors_table', 1),
(4, '2024_09_02_110907_inventory_stocks', 1),
(5, '2024_09_03_102241_create_divisions_table', 1),
(6, '2024_09_03_102242_create_districts_table', 1),
(7, '2024_09_03_102243_create_companies_table', 1),
(8, '2024_09_03_112346_create_roles_table', 1),
(9, '2024_09_03_113423_create_business_types_table', 1),
(10, '2024_09_03_113424_create_users_table', 1),
(11, '2024_09_03_113425_create_admins_table', 1),
(12, '2024_09_11_043931_create_master_admins_table', 1),
(13, '2024_09_11_073249_create_super_admins_table', 1),
(14, '2024_09_12_095909_create_hr_branches_table', 1),
(15, '2024_09_12_101329_create_hr_departments_table', 1),
(16, '2024_09_12_113837_create_hr_designations_table', 1),
(17, '2024_09_14_063925_create_hr_employees_table', 1),
(18, '2024_09_14_070512_create_hr_managers_table', 1),
(19, '2024_09_14_071743_create_hr_leave_types_table', 1),
(20, '2024_09_14_092748_create_hr_leave_applications_table', 1),
(21, '2024_09_14_102812_create_hr_attendances_table', 1),
(22, '2024_09_14_110938_create_hr_payrolls_table', 1),
(23, '2024_09_14_114320_create_hr_overtimes_table', 1),
(24, '2024_09_16_123456_create_hr_recruitment_jobs_table', 1),
(25, '2024_09_16_123457_create_hr_recruitment_candidates_table', 1),
(26, '2024_09_16_123458_create_hr_recruitment_interviews_table', 1),
(27, '2024_09_16_123459_create_hr_training_programs_table', 1),
(28, '2024_09_16_123460_create_hr_employee_trainings_table', 1),
(29, '2024_09_16_123461_create_hr_documents_table', 1),
(30, '2024_09_16_123462_create_hr_benefits_table', 1),
(31, '2024_09_16_123463_create_hr_employee_benefits_table', 1),
(32, '2024_09_16_123464_create_hr_notices_table', 1);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_status` int(11) NOT NULL COMMENT 'Status of the role: 1 for active, 2 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(2, 'Master Admin', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(3, 'Admin', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(4, 'Employee', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(5, 'Vendor', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(6, 'Customer', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07'),
(7, 'Manufacturer', 1, '2024-09-23 08:43:07', '2024-09-23 08:43:07');

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
('c1vvhZrfQwqvidbyxplsTGg66xBw1dcHYrSVHp4Q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUUxdEk4UnBYNno0SlFaVnNXUm9ZZ3lEVjNHNmVhV2hiVUhheDhDcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1727095812);

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `nid_number` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `emergency_contact_name_one` varchar(255) DEFAULT NULL,
  `emergency_contact_number_one` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_one` varchar(255) DEFAULT NULL,
  `emergency_contact_name_two` varchar(255) DEFAULT NULL,
  `emergency_contact_number_two` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_two` varchar(255) DEFAULT NULL,
  `emergency_contact_name_three` varchar(255) DEFAULT NULL,
  `emergency_contact_number_three` varchar(255) DEFAULT NULL,
  `emergency_contact_relation_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `user_id`, `profile_pic`, `full_name`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `emergency_contact_name_one`, `emergency_contact_number_one`, `emergency_contact_relation_one`, `emergency_contact_name_two`, `emergency_contact_number_two`, `emergency_contact_relation_two`, `emergency_contact_name_three`, `emergency_contact_number_three`, `emergency_contact_relation_three`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-23 08:43:08', '2024-09-23 08:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active_status` int(11) NOT NULL COMMENT 'Status of the role: 1 for active, 2 for inactive',
  `company_business_type` bigint(20) UNSIGNED DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `company_id`, `email`, `email_verified_at`, `password`, `active_status`, `company_business_type`, `registration_date`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'OSSL', 1, 1, 'ossl@gmail.com', NULL, '$2y$12$M/ExzxEmCi7ILz4U4V2nmOlgv3ConKm4DHu51CLxzz0JaWHENmnzS', 1, 1, NULL, NULL, '2024-09-23 08:43:08', '2024-09-23 08:43:08', NULL),
(2, 'Abul Kauser Samer', 2, 2, 'sam@gmail.com', NULL, '$2y$12$KXwJAHaNVabHhYgty3cXdOJX0TB.IKZahrrNtKDjqV01nbQmFDNFK', 1, 2, '2024-09-23', NULL, '2024-09-23 02:50:40', '2024-09-23 02:50:40', NULL),
(3, 'Fahad Ahmed', 4, 2, 'fahad@gmail.com', NULL, '$2y$12$azhN1itQ1RvNHTA6ys6x8OpVaXZoLMqNUcsRwZnNqy3MLw4IBRT8K', 1, 2, '2024-09-23', NULL, '2024-09-23 05:24:03', '2024-09-23 05:24:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `business_types`
--
ALTER TABLE `business_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_division_id_foreign` (`division_id`),
  ADD KEY `companies_district_id_foreign` (`district_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_division_id_foreign` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `hr_benefits`
--
ALTER TABLE `hr_benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_branches`
--
ALTER TABLE `hr_branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_branches_company_id_foreign` (`company_id`);

--
-- Indexes for table `hr_departments`
--
ALTER TABLE `hr_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_departments_company_id_foreign` (`company_id`),
  ADD KEY `hr_departments_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `hr_designations`
--
ALTER TABLE `hr_designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_designations_company_id_foreign` (`company_id`);

--
-- Indexes for table `hr_documents`
--
ALTER TABLE `hr_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `hr_employees`
--
ALTER TABLE `hr_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_employees_user_id_foreign` (`user_id`),
  ADD KEY `hr_employees_designation_id_foreign` (`designation_id`),
  ADD KEY `hr_employees_branch_id_foreign` (`branch_id`),
  ADD KEY `hr_employees_department_id_foreign` (`department_id`);

--
-- Indexes for table `hr_employee_benefits`
--
ALTER TABLE `hr_employee_benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_employee_benefits_employee_id_foreign` (`employee_id`),
  ADD KEY `hr_employee_benefits_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `hr_employee_trainings`
--
ALTER TABLE `hr_employee_trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_employee_trainings_user_id_foreign` (`user_id`),
  ADD KEY `hr_employee_trainings_training_program_id_foreign` (`training_program_id`);

--
-- Indexes for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_leave_applications_user_id_foreign` (`user_id`),
  ADD KEY `hr_leave_applications_company_id_foreign` (`company_id`),
  ADD KEY `hr_leave_applications_leave_type_id_foreign` (`leave_type_id`);

--
-- Indexes for table `hr_leave_types`
--
ALTER TABLE `hr_leave_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_leave_types_company_id_foreign` (`company_id`);

--
-- Indexes for table `hr_managers`
--
ALTER TABLE `hr_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_managers_user_id_foreign` (`user_id`),
  ADD KEY `hr_managers_designation_id_foreign` (`designation_id`),
  ADD KEY `hr_managers_department_id_foreign` (`department_id`);

--
-- Indexes for table `hr_notices`
--
ALTER TABLE `hr_notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_notices_company_id_foreign` (`company_id`),
  ADD KEY `hr_notices_branch_id_foreign` (`branch_id`),
  ADD KEY `hr_notices_department_id_foreign` (`department_id`);

--
-- Indexes for table `hr_overtimes`
--
ALTER TABLE `hr_overtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_overtimes_user_id_foreign` (`user_id`),
  ADD KEY `hr_overtimes_company_id_foreign` (`company_id`);

--
-- Indexes for table `hr_payrolls`
--
ALTER TABLE `hr_payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_payrolls_user_id_foreign` (`user_id`),
  ADD KEY `hr_payrolls_company_id_foreign` (`company_id`);

--
-- Indexes for table `hr_recruitment_candidates`
--
ALTER TABLE `hr_recruitment_candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hr_recruitment_candidates_email_unique` (`email`),
  ADD KEY `hr_recruitment_candidates_job_id_foreign` (`job_id`);

--
-- Indexes for table `hr_recruitment_interviews`
--
ALTER TABLE `hr_recruitment_interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_recruitment_interviews_candidate_id_foreign` (`candidate_id`);

--
-- Indexes for table `hr_recruitment_jobs`
--
ALTER TABLE `hr_recruitment_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_recruitment_jobs_company_id_foreign` (`company_id`),
  ADD KEY `hr_recruitment_jobs_department_id_foreign` (`department_id`);

--
-- Indexes for table `hr_training_programs`
--
ALTER TABLE `hr_training_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hr_training_programs_company_id_foreign` (`company_id`);

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
-- Indexes for table `master_admins`
--
ALTER TABLE `master_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_admins_user_id_foreign` (`user_id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `super_admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_company_id_foreign` (`company_id`),
  ADD KEY `users_company_business_type_foreign` (`company_business_type`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_types`
--
ALTER TABLE `business_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_benefits`
--
ALTER TABLE `hr_benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_branches`
--
ALTER TABLE `hr_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_departments`
--
ALTER TABLE `hr_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_designations`
--
ALTER TABLE `hr_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_documents`
--
ALTER TABLE `hr_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_employees`
--
ALTER TABLE `hr_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr_employee_benefits`
--
ALTER TABLE `hr_employee_benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_employee_trainings`
--
ALTER TABLE `hr_employee_trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_leave_types`
--
ALTER TABLE `hr_leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_managers`
--
ALTER TABLE `hr_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_notices`
--
ALTER TABLE `hr_notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_overtimes`
--
ALTER TABLE `hr_overtimes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_payrolls`
--
ALTER TABLE `hr_payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_recruitment_candidates`
--
ALTER TABLE `hr_recruitment_candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_recruitment_interviews`
--
ALTER TABLE `hr_recruitment_interviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_recruitment_jobs`
--
ALTER TABLE `hr_recruitment_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_training_programs`
--
ALTER TABLE `hr_training_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_admins`
--
ALTER TABLE `master_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `companies_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_attendances`
--
ALTER TABLE `hr_attendances`
  ADD CONSTRAINT `hr_attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_branches`
--
ALTER TABLE `hr_branches`
  ADD CONSTRAINT `hr_branches_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_departments`
--
ALTER TABLE `hr_departments`
  ADD CONSTRAINT `hr_departments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `hr_branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_designations`
--
ALTER TABLE `hr_designations`
  ADD CONSTRAINT `hr_designations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_documents`
--
ALTER TABLE `hr_documents`
  ADD CONSTRAINT `hr_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_employees`
--
ALTER TABLE `hr_employees`
  ADD CONSTRAINT `hr_employees_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `hr_branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `hr_departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `hr_designations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_employee_benefits`
--
ALTER TABLE `hr_employee_benefits`
  ADD CONSTRAINT `hr_employee_benefits_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `hr_employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_employee_benefits_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `hr_managers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_employee_trainings`
--
ALTER TABLE `hr_employee_trainings`
  ADD CONSTRAINT `hr_employee_trainings_training_program_id_foreign` FOREIGN KEY (`training_program_id`) REFERENCES `hr_training_programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_employee_trainings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_leave_applications`
--
ALTER TABLE `hr_leave_applications`
  ADD CONSTRAINT `hr_leave_applications_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_leave_applications_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `hr_leave_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_leave_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_leave_types`
--
ALTER TABLE `hr_leave_types`
  ADD CONSTRAINT `hr_leave_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_managers`
--
ALTER TABLE `hr_managers`
  ADD CONSTRAINT `hr_managers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `hr_departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_managers_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `hr_designations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_notices`
--
ALTER TABLE `hr_notices`
  ADD CONSTRAINT `hr_notices_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `hr_branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_notices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_notices_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `hr_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_overtimes`
--
ALTER TABLE `hr_overtimes`
  ADD CONSTRAINT `hr_overtimes_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_overtimes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_payrolls`
--
ALTER TABLE `hr_payrolls`
  ADD CONSTRAINT `hr_payrolls_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_payrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_recruitment_candidates`
--
ALTER TABLE `hr_recruitment_candidates`
  ADD CONSTRAINT `hr_recruitment_candidates_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `hr_recruitment_jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_recruitment_interviews`
--
ALTER TABLE `hr_recruitment_interviews`
  ADD CONSTRAINT `hr_recruitment_interviews_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `hr_recruitment_candidates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_recruitment_jobs`
--
ALTER TABLE `hr_recruitment_jobs`
  ADD CONSTRAINT `hr_recruitment_jobs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_recruitment_jobs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `hr_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hr_training_programs`
--
ALTER TABLE `hr_training_programs`
  ADD CONSTRAINT `hr_training_programs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `master_admins`
--
ALTER TABLE `master_admins`
  ADD CONSTRAINT `master_admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD CONSTRAINT `super_admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_business_type_foreign` FOREIGN KEY (`company_business_type`) REFERENCES `business_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
