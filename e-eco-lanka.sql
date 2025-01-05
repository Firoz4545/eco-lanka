-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 10:55 AM
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
-- Database: `e-eco-lanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'firoz', 'firozajward12@gmail.com', 'dds', 'ssss', '2024-10-28 11:38:09'),
(2, 'firoz', 'firozajward12@gmail.com', 'dds', 'ssss', '2024-10-28 11:40:46'),
(3, 'firoz', 'firozajward12@gmail.com', 'dd', '1dqwfaEF', '2024-10-28 16:17:40'),
(4, 'firoz', 'firozajward12@gmail.com', 'dd', '1dqwfaEF', '2024-10-28 16:21:55'),
(5, 'firoz', 'firozajward12@gmail.com', 'dd', '1dqwfaEF', '2024-10-28 16:22:03'),
(6, 'firoz', 'firozajward12@gmail.com', 'gukjwsefsa', 'sEGSEAG', '2024-10-28 16:22:12'),
(7, 'firoz', 'firozajward12@gmail.com', 'gukjwsefsa', 'sEGSEAG', '2024-10-28 16:23:33'),
(8, 'firoz', 'firozajward12@gmail.com', 'gukjwsefsa', 'sEGSEAG', '2024-10-28 16:25:00'),
(9, 'firoz', 'firozajward12@gmail.com', 'gukjwsefsa', 'sEGSEAG', '2024-10-28 16:25:16'),
(10, 'firoz', 'firozajward12@gmail.com', 'dd', 'wef', '2024-10-28 16:25:25'),
(11, 'firoz', 'firozajward12@gmail.com', 'sss', 'ssss', '2024-10-28 16:25:45'),
(12, 'firoz', 'firozajward12@gmail.com', 'sss', 'ssss', '2024-10-28 16:25:55'),
(13, 'firoz', 'firozajward12@gmail.com', 'sss', 'ssss', '2024-10-28 16:26:00'),
(14, 'firoz', 'firozajward12@gmail.com', 'gukj', 'asrewgsrzdaG', '2024-10-28 16:26:12'),
(15, 'firoz', 'firozajward12@gmail.com', 'sss', 'ass', '2024-10-28 16:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`) VALUES
(1, 56, '534b52995bbffd9e1eea439b915c3abceedccbf871edab980bdb7d76b72640138a492d514e6c87279de63445f14e230c97c3', ''),
(2, 56, '33324f5f8132edb68a3642b7829c57a230efea9a945ef7a96efb73390a7674ff71e35fd906349bafe9ebac04c5f7ff8a6ac7', '1730195282'),
(3, 56, '35007621f87dec8874bc46c2ffe3b376bb0c82f7e3d5c542f0c98a495c14573d391e81d75c3c5c3e3b017f927dbdf22758f8', '1730195290'),
(4, 56, '4eb922308eab542d3667c74a09b78cff639ac9547ee0ad23b7a7f1cfe9f8e0f8f66c3f5498f1c536a389cef6968c9fafbcca', '1730195403'),
(5, 56, 'c9e3251eb03e8a6056bb337b4c982e728fcbbce1a0711e89ac0d51d75a15d9b7f89b78b27de45780ee2e8046ac2ed48ce7d1', '1730195470'),
(6, 56, 'b044ebc342f08a045ab0534d14e2727c9ae8df3cc1ff7242861886b6dbc391f02e272ac74f4eba7cf72e9560df4479ad2601', '1730195726'),
(7, 56, 'fe4dbc76fc4a43f7a8a2333b99681bd9269ac47c3bfa0f56e4e3857a7196e6cdd6983ab5327abe97f975df5a225f781f39f7', '1730195790'),
(8, 56, '5f6ca81521a9e36313770afb5a293e606e960ad9a6faa014833bc82d78847876d6c068696f48be67931ebd33e9bd129b0c7e', ''),
(9, 56, '1eb5d695e4707b9989905b68a5c6e9f23298cab15d60abb0e7b70a5fbff10ca3ec2494714b48aff4dea0f887b346af1cc3a5', '1730195951'),
(10, 56, '99c290bc4cce8cca4f46f4d0c1e7d82037b7f7c03b66a67464e9b703fb4fd18f5615b8d4b2062627c512914cb390f78f7433', '1730196025'),
(11, 56, 'a6b1f404779ba0368457f5d1711319991df83562f1f6fa8849f01284c2ee90571a88685e23c6391f1e1c451e51e4a8199c5b', '1730196122'),
(12, 56, 'e034090f800c4e20094c1415c08c42ec4fd76a80c4bee8e621cf5f68e839347a62c3d7ebf664ec8ad18b64b4f39a5a4f4284', '1730196220'),
(13, 56, 'bb77a2f19a4a2375eace35021e330eadbafd58b63459e7f4d1441a0b38c3a1f0b3f2b83ecd01eeb55547f680a84f9924880e', '1730196347'),
(14, 56, '4d839330d981ef0280e2fc509ba1c8834d8fe7b387168916d42cad72e24760dbf934b275f8351241b744bbc5755597a923b2', '1730196506'),
(15, 56, 'd37a7d179429ea57e53d07ca6f783ddcfd0f7f622220bf9c7420b5c7d995a37f1ddb357c70a9e7abcf28046839c612e575dd', '1730196540'),
(16, 59, '03accb9d9384e4fc285bd58e472c25606a3a9f4b88cfdfc1d252d31d70af3f308ce8f7e3a06d6f87dd9433a984d5d0e4bd10', '1730196644'),
(17, 56, '768706d331b891e8f78312a90cb577f197cb9517c0be45703d39cb6a0d92fef581f6889f64ad0cbfc87b71995872e0953cf0', '1730196757'),
(18, 59, '34d34cdaaefc81f1855860f287da0312d3d9e7a3eaae2f9e5e78892d7f5e429241beee94beb1163094f1e055f20503fb95b7', '1730196790');

-- --------------------------------------------------------

--
-- Table structure for table `pickups`
--

CREATE TABLE `pickups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pickups`
--

INSERT INTO `pickups` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `date`, `time`, `created_at`) VALUES
(3, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-10-31', '21:46:00', '2024-10-28 16:12:50'),
(4, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-10-31', '21:46:00', '2024-10-28 16:14:24'),
(5, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-10-31', '21:46:00', '2024-10-28 16:14:27'),
(6, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-09-30', '21:50:00', '2024-10-28 16:14:52'),
(7, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-09-30', '21:50:00', '2024-10-28 16:16:52'),
(8, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-10-08', '21:52:00', '2024-10-28 16:17:22'),
(9, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-10-04', '21:01:00', '2024-10-28 16:27:41'),
(10, 56, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-10-22', '22:03:00', '2024-10-28 16:30:15'),
(11, 59, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-11-07', '15:23:00', '2024-10-29 09:50:43'),
(12, 59, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-11-07', '15:23:00', '2024-10-29 09:51:09'),
(13, 59, 'firoz', 'firozajward12@gmail.com', '0757666729', 'no 2/9, megoda kolonnawa wellampitiya', '2024-11-07', '15:23:00', '2024-10-29 09:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`, `confirm_password`) VALUES
(56, 'fff', 'firozajward12@gmail.com', '$2y$10$N9pD3llVjidRatF5tg6S0OCZYtWnvI4JEdzk0uwvXlYd1mbtPPyQ6', NULL),
(58, 'ggg', 'firozajward12@gmail.com', '$2y$10$HhofcEd7TZ3iioLGn8BkxuDg5RAGOLkSwvpt3G5MHRJjqEQdMbsK6', NULL),
(59, 'amna', 'ameerdilshana@gmail.com', '$2y$10$5PT8uH6u7Mb/8nxr1nsP0ePYTofE/ATMKgXQySgWfoH/B.HzAW/re', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pickups`
--
ALTER TABLE `pickups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pickups`
--
ALTER TABLE `pickups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pickups`
--
ALTER TABLE `pickups`
  ADD CONSTRAINT `pickups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE `orders` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `order_items` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
);

CREATE TABLE `products` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `qty` INT NOT NULL,
    `category` VARCHAR(255) NOT NULL
);

CREATE TABLE `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

INSERT INTO `products` (`title`, `image`, `price`, `qty`, `category`) VALUES
('Product 1', 'product1.jpg', 100.00, 10, 'Consumer Electronics'),
('Product 2', 'product2.jpg', 150.00, 5, 'Home Appliances'),
('Product 3', 'product3.jpg', 200.00, 8, 'Office Equipment'),
('Product 4', 'product4.jpg', 250.00, 12, 'Industrial Electronics'),
('Product 5', 'product5.jpg', 300.00, 15, 'Batteries & Power Supplies'),
('Product 6', 'product6.jpg', 350.00, 20, 'Miscellaneous Electronics'),
('Product 7', 'product7.jpg', 400.00, 25, 'E-Waste Recycling Services'),
('Product 8', 'product8.jpg', 450.00, 30, 'Educational Resources'),
('Product 9', 'product9.jpg', 500.00, 35, 'Renewable Energy Devices'),
('Product 10', 'product10.jpg', 550.00, 40, 'Electronics Repair Services');