-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 05:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pt_pren`
--

-- --------------------------------------------------------

--
-- Table structure for table `penukaran_marchendises`
--

CREATE TABLE `penukaran_marchendises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `bukti_penukaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penukaran_marchendises`
--

INSERT INTO `penukaran_marchendises` (`id`, `user_id`, `bukti_penukaran`, `created_at`, `updated_at`) VALUES
(1, 1, 'siHalal.png', '2022-09-12 13:26:20', NULL),
(2, 2, 'siHalal.png', '2022-09-09 13:26:54', NULL),
(3, 3, 'siHalal.png', '2022-09-09 13:26:54', NULL),
(4, 4, 'siHalal.png', '2022-09-09 13:26:54', NULL),
(5, 5, 'siHalal.png', '2022-09-09 13:26:54', NULL),
(15, 3, 'siHalal.png', '2022-09-09 01:37:12', '2022-09-09 01:37:12'),
(16, 2, 'siHalal.png', '2022-09-09 02:09:34', '2022-09-09 02:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penukaran_marchendises`
--
ALTER TABLE `penukaran_marchendises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penukaran_marchendises`
--
ALTER TABLE `penukaran_marchendises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
