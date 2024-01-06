-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 07:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pastry_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `baker`
--

CREATE TABLE `baker` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(100) NOT NULL,
  `class` varchar(255) NOT NULL,
  `assign_date` date NOT NULL,
  `sallary` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baker`
--

INSERT INTO `baker` (`id`, `username`, `password`, `full_name`, `age`, `class`, `assign_date`, `sallary`) VALUES
(1, 'johnny', 'johnnygood', 'jhonny good dept', 45, 'professional', '2020-12-10', 12000000),
(2, 'donovan', 'donovangtg', 'donovan victor', 25, 'amateur', '2023-11-20', 4570000),
(3, 'estevan', 'iniestevan', 'estifan miracle amalo', 29, 'beginner', '2023-12-01', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `dtrans`
--

CREATE TABLE `dtrans` (
  `id` int(11) NOT NULL,
  `htrans_id` int(11) NOT NULL,
  `pastry_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `htrans`
--

CREATE TABLE `htrans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `membership_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `nama`, `supplier_id`, `deleted_at`) VALUES
(1, 'garam', 1, NULL),
(2, 'mentega', 2, NULL),
(3, 'gula', 3, NULL),
(4, 'TEPUNG', 4, NULL),
(5, 'Susu', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
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
(1, '2024_01_05_173228_add_soft_deletes_to_pastry_table', 1),
(2, '2024_01_05_171706_add_soft_deletes_to_supplier_table', 2),
(3, '2024_01_05_153122_add_deleted_at_to_ingredients_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pastry`
--

CREATE TABLE `pastry` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `picturepastry` varchar(255) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastry`
--

INSERT INTO `pastry` (`id`, `nama`, `harga`, `picturepastry`, `ingredients_id`, `deleted_at`) VALUES
(16, 'chocolate', 10000, 'storage/profile/E6BbZgdfaZLwVR40YLWLmJgGY3flmLwV99XSvyXe.jpg', 1, NULL),
(17, 'cheese', 188888, 'storage/profile/joFyIUeAgdfcDNF4NVcPgrTfcxYqRTxNMqcVe7Bw.png', 1, NULL),
(18, 'bebe', 1132131232, 'storage/profile/DazgVbdy4FWBm9RXP7vGIsCnB2UhtIMDAUgrQH3F.png', 1, NULL),
(19, 'dasfsa', 1231232112, 'storage/profile/AHMYvSK6bFXrRPApeklSNQ0EAFnRtqAuiP2O5xtO.png', 1, NULL),
(20, 'efesf', 213123213, 'storage/profile/jMnfiGsRWqT6msouGyTHxbrSYSo44IGr3d6FLpjI.jpg', 2, NULL),
(21, 'asas', 9996, 'storage/profile/k4pOIhIz5ChOCULK9EMOO6O1vXIuAKQjUfbFdoU1.jpg', 4, '2024-01-05 23:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `deleted_at`) VALUES
(1, 'gudang garam gresik', NULL),
(2, 'PT. GudangMentegaSurabaya', NULL),
(3, 'PT. CenterGulaMalang', NULL),
(4, 'PT. GUDANGTEPUNGMALANG', NULL),
(5, 'PT. AlatDapurMagelang', NULL),
(6, 'PT.SUSUINDOMILK', NULL),
(7, 'asa', '2024-01-05 23:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tgllahir` date NOT NULL,
  `role` varchar(255) NOT NULL,
  `member` int(11) NOT NULL DEFAULT 0,
  `saldo` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `email`, `password`, `tgllahir`, `role`, `member`, `saldo`, `picture`) VALUES
(1, 'qwe', 'qwe', 'qwe@gmail.com', 'qwe', '2023-10-19', 'baker', 0, 2086365, 'default.png'),
(2, 'asd', 'asd', 'asd@gmail.com', 'asd', '2023-11-09', 'user', 0, 0, '2.png'),
(3, 'asdf', 'asdf', 'asdf@gmail.com', 'asdf', '2023-12-21', 'user', 0, 890000, 'default.png'),
(4, '123', '123', '123@gmail.com', '123', '2023-12-06', 'baker', 0, 0, 'default.png'),
(5, 'zxc', 'zxc', 'zxc@gmail.com', 'zxc', '2023-12-04', 'user', 0, 100000000, '5.png'),
(6, 'bnm', 'bnm', 'bnm@gmail.com', 'bnm', '2023-12-02', 'karyawan', 0, 0, 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baker`
--
ALTER TABLE `baker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `htrans_id` (`htrans_id`),
  ADD KEY `pastry_id` (`pastry_id`);

--
-- Indexes for table `htrans`
--
ALTER TABLE `htrans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastry`
--
ALTER TABLE `pastry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_id` (`ingredients_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baker`
--
ALTER TABLE `baker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dtrans`
--
ALTER TABLE `dtrans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `htrans`
--
ALTER TABLE `htrans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pastry`
--
ALTER TABLE `pastry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD CONSTRAINT `dtrans_ibfk_1` FOREIGN KEY (`htrans_id`) REFERENCES `htrans` (`id`),
  ADD CONSTRAINT `dtrans_ibfk_2` FOREIGN KEY (`pastry_id`) REFERENCES `pastry` (`id`);

--
-- Constraints for table `htrans`
--
ALTER TABLE `htrans`
  ADD CONSTRAINT `htrans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `htrans_ibfk_2` FOREIGN KEY (`membership_id`) REFERENCES `membership` (`id`);

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `pastry`
--
ALTER TABLE `pastry`
  ADD CONSTRAINT `pastry_ibfk_1` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
