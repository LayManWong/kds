-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2017 at 06:00 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khanstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Khim Design'),
(2, 'Landor'),
(3, 'The Chase'),
(4, 'Happy Cog'),
(5, 'Charlie Smith Design'),
(6, 'Chermayeff & Geismar & Haviv'),
(7, 'Custom');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(1, 3, '::1', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Picture'),
(2, 'Rythmic'),
(3, 'Folklore'),
(4, 'Fairytales'),
(5, 'Fantasy'),
(6, 'Fun Books'),
(7, 'Concept Books');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `trx_id`, `p_status`) VALUES
(1, 2, 7, 1, '07M47684BS5725041', 'Completed'),
(2, 2, 2, 1, '07M47684BS5725041', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(1, 1, 2, 'kids design book', 50, 'Kids Book Design ', '1.jpg', 'best kids design book'),
(2, 1, 3, 'AIGA Eye on Design', 60, 'kids picture design book', '2.jpg', 'AIGA Eye on Design'),
(3, 1, 3, 'Cover Design Template With Happy Kids', 70, 'kids picture book design', '3.jpg', 'nice picture book'),
(4, 1, 3, 'Superb Children Theme', 80, 'picture book design for kids ', '4.png', 'children theme book'),
(5, 1, 2, 'Gorgeous Kids Picture Book', 55, 'picture book design', '5.jpg', 'superb kids picture book'),
(6, 1, 1, 'Art Flyer Brochure Design', 45, 'book cover design for picture book', '6.jpg', 'kids art book '),
(7, 1, 1, 'Funny Picture Book', 35, 'best funny picture book design', '7.jpg', 'Funny Picture Book'),
(8, 1, 4, 'Amazing Picture Book', 48, 'amazing book cover design for kids picture book', '8.jpg', 'Amazing Picture Book'),
(9, 1, 3, 'Gorgeous Picture Book', 60, 'picture book design for kids', '9.jpg', 'Gorgeous Picture Book'),
(10, 2, 6, 'Superb Rythmic Book', 80, 'rythmic book design for kids', '10.jpg', 'Superb Rythmic Book'),
(11, 2, 6, 'Amazing Rythmic Book', 60, 'kids rythmic book design', '11.jpg', 'Amazing Rythmic Book'),
(12, 2, 6, 'Mind-blowing Rythmic Book', 70, 'best rythmic book cover design', '12.jpg', 'Mind-blowing Rythmic Book'),
(13, 2, 6, 'Funny Rythmic Book', 80, 'funny book design for rythmic book', '13.jpg', 'Funny Rythmic Book'),
(14, 2, 6, 'Generally Awesome Rythmic Book', 90, 'rythmic book cover design', '14.jpg', 'Awesome Rythmic Book'),
(15, 2, 6, 'Causal Rythmic Book', 100, 'causal book cover design for kids rythmic book', '15.jpg', 'Casual book'),
(16, 3, 6, 'Awesome Folklore Book', 30, 'awesome book cover design for kids folklore book', '16.jpg', 'Awesome Book'),
(17, 3, 6, 'Horrible Folklore Book', 35, 'horrible book cover design for kids folklore book', '17.jpg', 'Horrible Book'),
(19, 3, 6, 'Horrific Folklore Book', 65, 'horrific book cover design for kids folklore book', '18.jpg', 'Horrific Book'),
(20, 3, 6, 'Terrific Folklore Book', 15, 'terrific book cover design for kids folklore book', '19.jpg', 'Terrific Book '),
(21, 3, 6, 'Fearsome Folklore Book', 25, 'fearsome book cover design for kids folklore book', '20.jpg', 'Fearsome book'),
(22, 4, 6, 'Funny Fairy Tales ', 28, 'funny book cover design for kids fairy tales book', '21.jpg', 'Funny Fairy Tales'),
(23, 4, 6, 'Amusing Fairy Tales', 58, 'amusing book cover design for kids fairy tales book', '22.jpg', 'Amusing Book Design for Kids Tales'),
(24, 4, 6, 'Incredible Tales', 88, 'incredible book cover design for kids fairy tales book', '11.jpg', 'Incredible Book Design Kids Tales'),
(25, 4, 6, 'Joky Fairy Tales', 68, 'joky book cover design for kids fairy tales book', '23.jpg', 'Joky Book Design Kids Tales'),
(26, 4, 6, 'Mock Fairy Tales', 78, 'mock book cover design for kids fairy tales book', '24.jpg', 'Mock Book Design for Kids Tales'),
(27, 4, 6, 'Merry Fairy Tales', 49, 'merry book cover design for kids fairy tales book', '25.jpg', 'Merry Book Design for Kids Tales'),
(32, 5, 0, 'Wonderful Fantasay Book', 40, 'book cover design for kids fantasy book', '26.jpg', 'Wonderful Book Design for Kids Fantasy Book'),
(33, 6, 2, 'Surprising Fun Book', 60, 'surprising book cover design for kids fun book', '27.jpg', 'Surprising Design for Kids Fun Book'),
(34, 6, 4, 'Astonishing Fun Book', 70, 'astonishing book cover design for kids fun book', '28.JPG', 'Astonishing Design for Kids Fun Book'),
(35, 6, 0, 'Kinky Fun Book', 100, 'kinky book cover design for kids fun book', '29.jpg', 'Kinky Design for Kids Fun Book'),
(36, 6, 5, 'Arresting Fun Book', 150, 'arresting book cover design for kids fun book', '30.JPG', 'Arresting Design for Kids Fun Book'),
(37, 6, 5, 'Gorgeous fun Book', 20, 'gorgeous book cover design for kids fun book', '31.jpg', 'Gorgeous Design for Kids Fun Book'),
(38, 6, 4, 'Pretty fun Book', 35, 'pretty book cover design for kids fun book', '11.jpg', 'Pretty Design for Kids Fun Book'),
(39, 6, 5, 'Mosaic Fun Book', 25, 'mosaic book cover design for kids fun book', '32.png', 'Mosaic Design for Kids Fun Book'),
(40, 2, 6, 'Awesome Rythmic Book', 30, 'awesome rythmic book cover design for kids', '33.png', 'Awesome Design for Kids Fun Book'),
(45, 1, 2, 'Attractive Picture Books for Kids', 100, 'surprising book cover design for kids picture book', '34.JPG', 'kids attractive picture book'),
(46, 1, 2, 'Attractive Picture Books for Kids', 100, 'marvelous book cover design for kids fun book', '34.JPG', 'kids attractive picture book');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`, `role`) VALUES
(1, 'Rizwan', 'Khan', 'rizwankhan.august16@gmail.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', 'Rahmat Nagar Burnpur Asansol', 'Asansol', 'user'),
(2, 'Rizwan', 'Khan', 'rizwankhan.august16@yahoo.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', 'Rahmat Nagar Burnpur Asansol', 'Asa', 'user'),
(3, 'Super', 'Admin', 'administrator@app.com', '7c6a180b36896a0a8c02787eeafb0e4c', '0145217189', 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
