-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 08:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `rand` varchar(10) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `quantity`, `rand`, `inserted`) VALUES
(7, '1', '6', '2141118071', '2022-05-14 10:54:52'),
(8, '2', '3', '2141118071', '2022-05-14 10:54:52'),
(9, '1', '6', '686461229', '2022-05-14 10:54:52'),
(10, '2', '3', '686461229', '2022-05-14 10:54:52'),
(11, '1', '6', '1680395868', '2022-05-14 10:54:52'),
(12, '2', '3', '1680395868', '2022-05-14 10:54:52'),
(13, '1', '4', '395468664', '2022-05-14 10:54:52'),
(14, '1', '23', '476878239', '2022-05-14 10:54:52'),
(15, '2', '16', '476878239', '2022-05-14 10:54:52'),
(16, '4', '9', '476878239', '2022-05-14 10:54:52'),
(17, '1', '4', '1896754302', '2022-05-15 10:15:47'),
(18, '2', '7', '1896754302', '2022-05-15 10:15:47'),
(19, '1', '1', '1163989215', '2022-05-15 10:16:00'),
(20, '2', '2', '1163989215', '2022-05-15 10:16:00'),
(21, '4', '2', '1163989215', '2022-05-15 10:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'Apple', 120.00),
(2, 'Orrange', 70.00),
(4, 'Banana\r\n', 70.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
