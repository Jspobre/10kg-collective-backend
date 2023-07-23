-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 06:09 AM
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
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Tees'),
(2, 'Shorts'),
(3, 'Pants');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,0) NOT NULL,
  `item_category` int(11) NOT NULL,
  `image_src` varchar(255) NOT NULL,
  `item_status` varchar(1) NOT NULL DEFAULT 'A' COMMENT '"A" = active "I" = Inactive',
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_category`, `image_src`, `item_status`, `date_added`) VALUES
(23, 'Trust the Process Shirt', '450', 1, 'http://localhost/10kg-collective/uploads/thumbnail/645b70c1ec790-partner 1.jpg', 'A', '2023-05-10'),
(25, 'Plain Series Tee', '350', 1, 'http://localhost/10kg-collective/uploads/thumbnail/645b974c0bd5e-IMG20230218204014.jpg', 'A', '2023-05-10'),
(26, 'Weightless', '450', 1, 'http://localhost/10kg-collective/uploads/thumbnail/645daebff3907-WEIGHTLESS - Clone.jpg', 'A', '2023-05-12'),
(27, 'Summer Shorts', '299', 2, 'http://localhost/10kg-collective/uploads/thumbnail/645dafca7efea-2.png', 'A', '2023-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `item_image`
--

CREATE TABLE `item_image` (
  `img_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `image_location` varchar(255) NOT NULL,
  `image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_image`
--

INSERT INTO `item_image` (`img_id`, `item_id`, `image_location`, `image_name`) VALUES
(26, 23, 'http://localhost/10kg-collective/uploads/showcase/645b70c1ed517-IMG_20220918_163450.jpg', '645b70c1ed517-IMG_20220918_163450.jpg'),
(27, 23, 'http://localhost/10kg-collective/uploads/showcase/645b70c1eea23-IMG_20220918_163543.jpg', '645b70c1eea23-IMG_20220918_163543.jpg'),
(28, 23, 'http://localhost/10kg-collective/uploads/showcase/645b70c1ef182-IMG_20220918_163628.jpg', '645b70c1ef182-IMG_20220918_163628.jpg'),
(33, 25, 'http://localhost/10kg-collective/uploads/showcase/645b974c12dd2-333979215_635396045018444_9040754058387247656_n.jpg', '645b974c12dd2-333979215_635396045018444_9040754058387247656_n.jpg'),
(34, 25, 'http://localhost/10kg-collective/uploads/showcase/645b974c1370f-334112502_167154722762533_8224857963642094075_n.jpg', '645b974c1370f-334112502_167154722762533_8224857963642094075_n.jpg'),
(35, 25, 'http://localhost/10kg-collective/uploads/showcase/645b974c13e19-333643827_1967270723651859_6880391815766248661_n.jpg', '645b974c13e19-333643827_1967270723651859_6880391815766248661_n.jpg'),
(36, 25, 'http://localhost/10kg-collective/uploads/showcase/645b974c14e8e-334656953_6082167848509340_4935458176519308158_n.jpg', '645b974c14e8e-334656953_6082167848509340_4935458176519308158_n.jpg'),
(45, 26, 'http://localhost/10kg-collective/uploads/showcase/645daec0029d3-BLACK BACK.png', '645daec0029d3-BLACK BACK.png'),
(46, 26, 'http://localhost/10kg-collective/uploads/showcase/645daec003084-BLACK FRONT.png', '645daec003084-BLACK FRONT.png'),
(47, 26, 'http://localhost/10kg-collective/uploads/showcase/645daec003761-WHITE BACK.png', '645daec003761-WHITE BACK.png'),
(48, 26, 'http://localhost/10kg-collective/uploads/showcase/645daec0043a0-WHITE FRONT.png', '645daec0043a0-WHITE FRONT.png'),
(49, 27, 'http://localhost/10kg-collective/uploads/showcase/645dafca81931-IMG20230304161632.jpg', '645dafca81931-IMG20230304161632.jpg'),
(50, 27, 'http://localhost/10kg-collective/uploads/showcase/645dafca822e6-IMG20230304162035.jpg', '645dafca822e6-IMG20230304162035.jpg'),
(51, 27, 'http://localhost/10kg-collective/uploads/showcase/645dafca82da9-IMG20230304162533.jpg', '645dafca82da9-IMG20230304162533.jpg'),
(52, 27, 'http://localhost/10kg-collective/uploads/showcase/645dafca832ef-IMG20230304163256.jpg', '645dafca832ef-IMG20230304163256.jpg');

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
(34, 23, '[\"Medium\",\"Large\",\"Extra Large\"]'),
(36, 25, '[\"Small\",\"Medium\",\"Large\",\"Extra Large\"]'),
(45, 26, '[\"Medium\",\"Large\",\"Extra Large\"]'),
(46, 27, '[\"Medium\",\"Large\"]');

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
(34, 23, '[\"Black\"]'),
(36, 25, '[\"Arctic\",\"Mustard\",\"Gray\",\"Cream\"]'),
(45, 26, '[\"Black\",\"White\"]'),
(46, 27, '[\"Ash\",\"Sand\",\"Floral\",\"Tie-Dye\"]');

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
  `order_status` varchar(54) NOT NULL COMMENT '"Cart" = in Cart\r\n"P" = Pending\r\n"C" = Confirmed\r\n"Canceled" = canceled order',
  `date_ordered` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(51) NOT NULL DEFAULT 'Unpaid' COMMENT '"Unpaid" & "Paid"',
  `delivery_status` varchar(2) NOT NULL DEFAULT 'NS' COMMENT '"NS" = Not yet shipped\r\n"S" = Shipped\r\n"D" = Delivered\r\n"R" = Rejected by customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `password` char(255) NOT NULL,
  `user_type` varchar(1) NOT NULL DEFAULT 'U' COMMENT '"U" = User, "A" = Admin, "C" = Courier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `contact_no`, `address`, `email_address`, `password`, `user_type`) VALUES
(21, 'jonnel angelo bonagua', '8123818', 'kinale', 'jonneladmin@gmail.com', '$2y$10$nIwzVE5AsJUITO1uXtnNmeX/aVeF0pWYrtVKsixHACWqH7i/XUHxK', 'A'),
(22, 'courier 1', '127387178', 'layon', 'courier_10kg@10kg.com', '$2y$10$nIwzVE5AsJUITO1uXtnNmeX/aVeF0pWYrtVKsixHACWqH7i/XUHxK', 'C'),
(23, 'jack', '8912983189', 'akldkajk123', 'nemesis22@gmail.com', '$2y$10$DvTPuXaBlqQLG8FjwdgJj.WrxW4fcnu8hUk5qcHv4Cn4CZKsdBwvm', 'U');

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
-- Indexes for table `item_image`
--
ALTER TABLE `item_image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `item_id` (`item_id`);

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
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `item_image`
--
ALTER TABLE `item_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `size_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `item_variation`
--
ALTER TABLE `item_variation`
  MODIFY `variation_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`item_category`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `item_image`
--
ALTER TABLE `item_image`
  ADD CONSTRAINT `item_image_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

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
