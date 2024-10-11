-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 03:28 PM
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
-- Database: `ecommerce-sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(24, 'superadmin', 'superadmin404', 'ea313c9eeee34da905715819296626d3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub_title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `active` varchar(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `sub_title`, `description`, `active`, `featured`, `image`) VALUES
(1, 'category 1', '', '', 'yes', 'yes', 'category_301.jpg'),
(2, 'category 2', '', '', 'yes', 'yes', 'category_833.jpg'),
(3, 'category 3', '', '', 'yes', 'yes', 'category_470.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` varchar(150) NOT NULL,
  `size` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `postal_code` int(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `product`, `size`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `postal_code`, `payment_method`) VALUES
(1, 'product 1 title', '', 199.00, 1, 299.00, '2024-07-08 05:37:12', 'Delivered', 'naji sir', '0771234567', '1111@email.com', 'colombo 7', 456, 'cash-on-delivery'),
(2, 'product 2 title', '', 199.00, 2, 458.20, '2024-07-08 06:03:41', 'Cancelled', 'safraz sir', '22222222222', '22@gmail.com', 'nsbm green uni', 22222, 'bank-transfer'),
(3, 'product 8 title', 'Small', 199.00, 3, 697.00, '2024-07-08 06:06:24', 'On Delivery', 'mahinda rajapaksha', '33333333', 'mahi@69gmail.com', 'colombo 1', 333333, 'card-payment');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub_title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `active` varchar(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `sub_title`, `description`, `price`, `discount`, `active`, `featured`, `category_id`, `image1`, `image2`, `image3`, `image4`) VALUES
(1, 'product 1 title', '', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Ullam animi\r\nomnis ab illum, at repellendus.Lorem ipsum dolor sit amet consectetur adipisicing elit.Ullam animi\r\nomnis ab illum, at repellendus.', 199, 0, 'yes', 'yes', 1, 'product_909.jpg', '', '', ''),
(2, 'product 2 title', '', '', 199, 0, 'yes', 'yes', 3, 'product_149.jpg', '', '', ''),
(3, 'product 3 title', '', '', 300, 0, 'yes', 'yes', 3, 'product_384.jpg', '', '', ''),
(4, 'product 4 title', '', '', 200, 0, 'yes', 'yes', 3, 'product_6668.jpg', '', '', ''),
(5, 'product 5 title', '', '', 199, 0, 'yes', 'yes', 0, 'product_4889.jpg', '', '', ''),
(6, 'product 6 title', '', '', 199, 0, 'yes', 'yes', 0, 'product_3182.jpg', '', '', ''),
(7, 'product 7 title', '', '', 199, 0, 'yes', 'yes', 0, 'product_3351.jpg', '', '', ''),
(8, 'product 8 title', '', '', 199, 0, 'yes', 'yes', 0, 'product_1355.jpg', '', '', ''),
(9, 'product 9 title', '', '', 199, 0, 'yes', 'yes', 1, 'product_9984.jpg', '', '', ''),
(10, 'product 10 title', '', '', 199, 0, 'yes', 'yes', 0, 'product_5076.jpg', '', '', ''),
(11, 'product 11 title', '', '', 199, 0, 'yes', 'yes', 1, 'product_3999.jpg', '', '', ''),
(12, 'product 12 title', '', '', 199, 0, 'yes', 'yes', 1, 'product_2241.jpg', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
