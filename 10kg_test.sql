-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 11:53 AM
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
-- Database: `10kg_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Tees', 'T-shirts'),
(2, 'Shorts', 'sick shirts!');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,0) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_status` varchar(1) NOT NULL DEFAULT 'A',
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_category`, `item_status`, `date_added`) VALUES
(2, 'weightless', '999', 1, 'A', '2023-03-22'),
(3, 'Weightless', '350', 1, 'A', '2023-03-22'),
(4, 'Trust the Process', '499', 1, 'A', '2023-03-23'),
(5, 'test', '321', 1, 'A', '2023-03-23'),
(6, 'testt', '123', 1, 'A', '2023-03-23'),
(7, 'Test short', '288', 2, 'A', '2023-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `item_sizes`
--

CREATE TABLE `item_sizes` (
  `size_id` int(14) NOT NULL,
  `item_id` int(14) NOT NULL,
  `size_name` varchar(54) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_sizes`
--

INSERT INTO `item_sizes` (`size_id`, `item_id`, `size_name`) VALUES
(1, 2, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `item_variation`
--

CREATE TABLE `item_variation` (
  `variation_id` int(14) NOT NULL,
  `item_id` int(14) NOT NULL,
  `variation_name` varchar(54) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_variation`
--

INSERT INTO `item_variation` (`variation_id`, `item_id`, `variation_name`) VALUES
(1, 2, 'Gray');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(20) NOT NULL,
  `user_id` int(14) NOT NULL,
  `item_id` int(14) NOT NULL,
  `order_qty` int(20) NOT NULL,
  `item_variant` varchar(11) NOT NULL,
  `item_size` varchar(11) NOT NULL,
  `order_status` varchar(54) NOT NULL,
  `date_ordered` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(51) NOT NULL DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `item_id`, `order_qty`, `item_variant`, `item_size`, `order_status`, `date_ordered`, `payment_status`) VALUES
(5, 7, 2, 1, 'Gray', 'S', 'P', '2023-03-27 17:40:29', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `contact_no`, `address`, `email_address`, `password`) VALUES
(2, 'jonathan moralde', '09123456789', 'anayan, pili, camarines sur', 'jonathanhernandez.moralde@bicol-u.edu.ph', 'test123123'),
(3, 'jonathan moralde', '09123456489', 'anayan,pili,camarines sur', 'jonathanhernandez.moralde@bicol-u.edu.ph', 'test123123'),
(4, 'jonathan moralde', '09123456789', 'anayan, pili, camarines sur', 'jonathanhernandez.moralde@bicol-u.edu.ph', 'test123123'),
(5, 'asdfasdf', '12312312312', 'fadsfasdfa', 'test@email.com', 'testets123'),
(6, '123123', '12312312312', 'dsfas', 'dfasdfasdf', '3123123'),
(7, 'jonnel angelo', '09123971792', 'polangui', 'jonnel@gmail.com', 'hello'),
(8, 'nemesis the best', '09127319768', 'layon', 'nemesis@gmail.com', 'nemesis'),
(9, 'clyde bonagua david', '0912831712', 'libon', 'clyde@mail.com', 'clyde'),
(10, 'i am the best', '21893891289', 'ajkjkajka', 'adam@ladjkak', 'akldkla231'),
(11, 'adadad', '12312312312', 'asdf', 'ersaser@mda.com', '123213'),
(12, 'etsedasd', '12312312311', 'asdfasdf', 'asdfas21@emads.com', '123123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_category` (`item_category`);

--
-- Indexes for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item_variation`
--
ALTER TABLE `item_variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `item_size` (`item_size`),
  ADD KEY `item_variant` (`item_variant`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `size_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_variation`
--
ALTER TABLE `item_variation`
  MODIFY `variation_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`item_category`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD CONSTRAINT `item_sizes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `item_variation`
--
ALTER TABLE `item_variation`
  ADD CONSTRAINT `item_variation_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
