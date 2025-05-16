-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 06, 2025 at 04:26 PM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(3, 'Anfaz', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) DEFAULT 'pending',
  `booked_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(7, 4, 3, 'Anfazss', 22, 1, 'home-img-1.png'),
(8, 3, 2, 'Anfaz', 2, 1, 'Black White Modern Monochrome Science Technology Logo.png'),
(15, 5, 3, 'Anfazss', 22, 1, 'home-img-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 3, 'Anfaz', 'jj@gmail.com', '757194319', 'okok');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `paypal_transaction_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `paypal_transaction_id`) VALUES
(1, 3, 'shanoom', '0774422967', 'shanoom@gmail.com', 'paypal', '7, 4, sutton, liverpool, li#, South Glamorgan, United Kingdom - 1', 'Fish and chips (500 x 1) - ', 500, '2025-03-26', 'completed', NULL),
(2, 3, 'shanoom', '0774422967', 'shanoom@gmail.com', 'credit card', '7, 4, sutton, liverpool, li#, South Glamorgan, United Kingdom - 1', 'Fish and chips (500 x 1) - ', 500, '2025-03-27', 'completed', NULL),
(3, 3, 'shanoom', '0774422967', 'shanoom@gmail.com', 'paytm', '7, 4, sutton, liverpool, li#, South Glamorgan, United Kingdom - 1', 'Anfazss (22 x 1) - ', 22, '2025-03-29', 'completed', NULL),
(4, 5, 'Anfaz', '4596526526', 'anfazh@gmail.com', 'paytm', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3', 'Anfazss (22 x 1) - ', 22, '2025-04-04', 'pending', NULL),
(5, 5, 'Anfaz', '4596526526', 'anfazh@gmail.com', 'paypal', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3', 'Anfazss (22 x 1) - ', 22, '2025-04-04', '', NULL),
(6, 5, 'Anfaz', '4596526526', 'anfazh@gmail.com', 'paypal', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3', 'Anfazss (22 x 1) - ', 22, '2025-04-04', 'completed', NULL),
(7, 5, 'Anfaz', '4596526526', 'anfazh@gmail.com', 'credit card', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3', 'Anfazss (22 x 1) - ', 22, '2025-04-04', 'completed', '9Y461734CE630164H'),
(8, 5, 'Anfaz', '4596526526', 'anfazh@gmail.com', 'cash on delivery', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3', 'Anfaz (2 x 1) - ', 2, '2025-04-04', 'completed', '02A6133390214924T'),
(9, 5, 'Anfaz', '4596526526', 'anfazh@gmail.com', 'paypal', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3', 'Anfazss (22 x 1) - ', 22, '2025-04-04', 'completed', ''),
(10, 6, 'Anfaz', '7855555555', 'preeven@gamil.com', 'paypal', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 20001', 'Anfaz (2 x 1) - ', 2, '2025-05-06', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(2, 'Anfaz', 'main dish', 2, 'Black White Modern Monochrome Science Technology Logo.png'),
(3, 'Anfazss', 'main dish', 22, 'home-img-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `image`, `created_at`) VALUES
(5, 'PIZZA', 'img5 (1).jpeg', '2025-04-02 10:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `table_reservations`
--

CREATE TABLE `table_reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `Phonenumber` varchar(20) DEFAULT NULL,
  `tableNumber` varchar(10) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_reservations`
--

INSERT INTO `table_reservations` (`id`, `user_id`, `name`, `email`, `Phonenumber`, `tableNumber`, `time`, `date`, `payment_status`, `created_at`) VALUES
(13, 6, 'MUHAMMADH Anfaz Muhammadhu Juwar', 'anfazjuwar@gmail.com', '07585726191', 't45', '15:26:00', '2025-05-24', 'pending', '2025-05-06 15:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'Anfaz', 'anfazjukkar@gmail.com', '7588888888', '7c222fb2927d828af22f592134e8932480637c0d', ''),
(2, 'Anfazz', 'anfazjusswar@gmail.com', '7585555555', '236888ac87d6d7d6818ee994ec10c79e846aab4c', ''),
(3, 'shanoom', 'shanoom@gmail.com', '0774422967', '7c222fb2927d828af22f592134e8932480637c0d', '7, 4, sutton, liverpool, li#, South Glamorgan, United Kingdom - 1'),
(5, 'Anfaz', 'anfazh@gmail.com', '4596526526', '7c222fb2927d828af22f592134e8932480637c0d', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 3'),
(6, 'Anfaz', 'preeven@gamil.com', '7855555555', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '7, 4, sutton, Cardiff, Cardiff, N/A, United Kingdom - 20001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_reservations`
--
ALTER TABLE `table_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_reservations`
--
ALTER TABLE `table_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
