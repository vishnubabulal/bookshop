-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 03:05 PM
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
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `sale_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_mail` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`sale_id`, `customer_name`, `customer_mail`, `product_id`, `product_name`, `product_price`, `sale_date`) VALUES
(1, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com', 1, 'Refactoring: Improving the Design of Existing Code', 49.99, '2019-04-02 06:05:12'),
(2, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com', 2, 'Clean Architecture: A Craftsman\'s Guide to Software Structure and Design', 24.99, '2019-05-01 09:07:18'),
(3, 'Leandro Bußmann', 'leandro.bussmann@no-reply.rexx-systems.com', 2, 'Clean Architecture: A Craftsman\'s Guide to Software Structure and Design', 19.99, '2019-05-06 12:26:14'),
(4, 'Hans Schäfer', 'hans.schaefer@no-reply.rexx-systems.com', 1, 'Refactoring: Improving the Design of Existing Code', 37.98, '2019-06-07 09:38:39'),
(5, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com', 1, 'Refactoring: Improving the Design of Existing Code', 37.98, '2019-07-01 13:01:13'),
(6, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com', 2, 'Clean Architecture: A Craftsman\'s Guide to Software Structure and Design', 19.99, '2019-08-07 17:08:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`sale_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
