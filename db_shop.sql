-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 08:58 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(10) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `cat_name`, `status`) VALUES
(1, 'Electronic Devices', 'Active'),
(2, 'Electronic Accessories', 'Active'),
(3, 'TV & Home Appliances', 'Active'),
(4, 'Health & Beauty', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) NOT NULL,
  `sub_cat_id` int(10) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` varchar(10) DEFAULT NULL,
  `product_status` varchar(10) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `sub_cat_id`, `product_name`, `product_price`, `product_status`, `product_image`) VALUES
(1, 1, 'Iphone 13 Pro MAX', '$1400', 'Active', 'product/iphone.png'),
(2, 1, 'Iphone 13 Pro MAX', '$1400', 'Active', 'product/iphone.png'),
(3, 1, 'Iphone 13 Pro MAX', '$1400', 'Active', 'product/iphone.png'),
(4, 1, 'Iphone 13 Pro MAX', '$1400', 'Active', 'product/iphone.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_cat`
--

CREATE TABLE `tbl_sub_cat` (
  `id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `sub_cat_name` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_cat`
--

INSERT INTO `tbl_sub_cat` (`id`, `cat_id`, `sub_cat_name`, `status`) VALUES
(1, 1, 'Smart Phones', 'Active'),
(2, 1, 'Tablets', 'Active'),
(3, 2, 'Charger', 'Active'),
(4, 2, 'HandsFree', 'Active'),
(5, 3, 'Smart Led Tv', 'Active'),
(6, 3, 'Blender', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'profile\\noprofile.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `username`, `password`, `profile_pic`) VALUES
(16, 'Salman', 'Khan', 'salman@yahoo.com', '202cb962ac59075b964b07152d234b70', 'profile/pic1.png'),
(17, 'Sharukh', 'Khan', 'sharukh@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'profile/pic1.png'),
(18, 'Aqsa', 'butt', 'maria@mail.com', '202cb962ac59075b964b07152d234b70', 'profile/Aqsa_100122121452_marlon-schmeiski-3j9b2s7NiGg-unsplash.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
