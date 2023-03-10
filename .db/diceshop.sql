-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 02:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diceshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `diningtable`
--

CREATE TABLE `diningtable` (
  `id_din` int(11) NOT NULL,
  `name_din` varchar(100) NOT NULL,
  `date_din` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_din` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diningtable`
--

INSERT INTO `diningtable` (`id_din`, `name_din`, `date_din`, `status_din`) VALUES
(1, 'โต๊ะ 1sdff', '2023-01-25 06:02:06', 0),
(2, 'sdfsdfsdfsdsdf', '2023-01-25 06:02:10', 0),
(3, 'โต๊ะ 1', '2023-01-25 17:21:44', 0),
(4, 'โต๊ะ 2', '2023-01-25 17:18:33', 1),
(5, 'โต๊ะ 3', '2023-01-25 17:18:42', 1),
(6, 'โต๊ะ 1', '2023-01-25 17:21:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `details` text DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `price`, `details`, `status`) VALUES
(12, 'ชุดเมนูนู 199', 'C62023_01_26_00_37_03Flf9nb.png', '199', '-', 1),
(13, 'ชุดเมนูนู 399', 'KC2023_01_26_00_37_11jnVmCD.png', '399', '-', 1),
(14, 'อาหารจากหลัก 999', 'qZ2023_01_26_00_37_216mX2xQ.png', '999', '', 1),
(15, 'อาหารไทย', '2P2023_01_26_00_39_31JUlFno.png', '650', '-', 1),
(16, 'อีสานอร่อย', '4J2023_01_26_00_40_20LU9PXn.png', '980', '-', 1),
(17, 'อาหารญีปุ่น', 'dr2023_01_26_00_41_09qNc22H.png', '500', '-', 1),
(18, 'อาหารอังกฤษ', 'JW2023_01_26_00_41_438crSF9.png', '700', '-', 1),
(19, 'ขนมหวาน', 'b12023_01_26_00_42_22wPPTmr.png', '50', '-', 1),
(20, 'ชุดอาหารไทย', 'bO2023_01_26_00_42_50idKQcu.png', '1000', '-', 1),
(21, 'ทอดปลานิล', 'IA2023_01_26_00_43_30VkvXKp.png', '250', '-', 1),
(22, 'ขนมจีนใต้', '462023_01_26_00_44_07X3iXIt.png', '60', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_res` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_din` int(11) NOT NULL,
  `people_sum_res` int(11) NOT NULL,
  `status_res` int(1) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_res` date NOT NULL,
  `time_res` time NOT NULL,
  `create_timeout_res` datetime DEFAULT NULL,
  `timeEnd_res` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_res`, `id_user`, `id_din`, `people_sum_res`, `status_res`, `create_time`, `date_res`, `time_res`, `create_timeout_res`, `timeEnd_res`) VALUES
(3, 2, 4, 3, 0, '2023-01-25 11:22:41', '2023-01-25', '10:20:00', NULL, '12:20:00'),
(4, 2, 5, 5, 3, '2023-01-25 17:53:05', '2023-01-27', '15:27:00', '2023-01-26 00:53:05', '17:27:00'),
(5, 2, 4, 2, 3, '2023-01-25 18:15:38', '2023-01-26', '17:28:00', '2023-01-26 00:52:37', '19:28:00'),
(6, 2, 3, 1, 0, '2023-01-25 18:15:36', '2023-02-02', '15:28:00', '2023-01-26 00:52:37', '17:28:00'),
(7, 2, 3, 3, 3, '2023-01-25 18:15:34', '2023-02-03', '15:28:00', '2023-01-26 00:52:37', '17:28:00'),
(8, 2, 3, 3, 3, '2023-01-25 18:15:31', '2023-02-03', '20:28:00', '2023-01-26 00:52:37', '22:28:00'),
(9, 2, 4, 3, 3, '2023-01-25 17:52:37', '2023-02-01', '19:54:00', '2023-01-26 00:52:37', '21:54:00'),
(10, 2, 5, 2, 0, '2023-01-25 18:15:55', '2023-01-26', '10:00:00', '2023-01-26 00:52:37', '11:00:00'),
(11, 2, 4, 1, 0, '2023-01-25 18:16:11', '2023-01-27', '10:00:00', '2023-01-26 00:52:37', '11:00:00'),
(12, 2, 5, 8, 3, '2023-01-26 03:28:57', '2023-01-26', '10:26:00', '2023-01-26 10:28:57', '12:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `codeID` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `rold` int(3) NOT NULL DEFAULT 1 COMMENT '0 admin\r\n1 user\r\n2 พนักงาน',
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '0 ลบ 1 ปกติ',
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `codeID`, `name`, `phone`, `email`, `username`, `pass`, `rold`, `status`, `dateTime`) VALUES
(1, '1339900662224', 'employee', '0961632545', 'employee@gmail.com', 'employee', 'employee', 2, 1, '2023-01-25 09:14:44'),
(2, '1339900662223', 'users2', '0961632546', 'users4@gmail.com', 'users', 'users', 1, 1, '2023-01-25 06:35:28'),
(3, '1339900662222', 'users1', '0961632545', 'users1@gmail.com', 'users1', 'users1', 1, 1, '2023-01-25 04:54:49'),
(10, '1339900662224', 'admin', '0961632545', 'admin@gmail.com', 'admin', 'admin', 0, 1, '2023-01-26 03:55:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diningtable`
--
ALTER TABLE `diningtable`
  ADD PRIMARY KEY (`id_din`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_res`),
  ADD KEY `sad` (`id_user`),
  ADD KEY `ad` (`id_din`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diningtable`
--
ALTER TABLE `diningtable`
  MODIFY `id_din` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_res` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `ad` FOREIGN KEY (`id_din`) REFERENCES `diningtable` (`id_din`),
  ADD CONSTRAINT `sad` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
