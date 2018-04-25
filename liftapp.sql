-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2017 at 04:00 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liftapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bodyweights`
--

CREATE TABLE `bodyweights` (
  `id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bodyweights`
--

INSERT INTO `bodyweights` (`id`, `weight`, `user`, `date`, `created_at`, `updated_at`) VALUES
(49, 172.8, 1, '2017-10-10 19:59:55', NULL, NULL),
(50, 178, 1, '2017-10-10 21:39:54', NULL, NULL),
(51, 174.3, 1, '2017-10-10 23:15:14', NULL, NULL),
(52, 165, 1, '2017-10-11 01:13:19', NULL, NULL),
(53, 175, 2, '2017-10-11 01:15:30', NULL, NULL),
(54, 180, 2, '2017-10-11 01:15:34', NULL, NULL),
(55, 235, 3, '2017-10-11 01:23:51', NULL, NULL),
(56, 255, 3, '2017-10-11 01:28:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `calories` float NOT NULL,
  `fat` float NOT NULL,
  `carbs` float NOT NULL,
  `protein` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `user`, `name`, `calories`, `fat`, `carbs`, `protein`, `date`, `created_at`, `updated_at`) VALUES
(15, 1, 'Pancake - 1 pancake (6\" dia)', 174.79, 7.47, 21.79, 4.93, '2017-09-30 19:12:27', '0000-00-00 00:00:00', NULL),
(16, 1, 'Pancake - 1 pancake (6\" dia)', 174.79, 7.47, 21.79, 4.93, '2017-09-30 19:12:34', '0000-00-00 00:00:00', NULL),
(17, 1, 'Egg, whole, cooked, scrambled - 1 large', 90.89, 6.7, 0.98, 6.09, '2017-09-30 19:12:47', '0000-00-00 00:00:00', NULL),
(18, 1, 'Egg, whole, cooked, scrambled - 1 large', 90.89, 6.7, 0.98, 6.09, '2017-09-30 19:12:54', '0000-00-00 00:00:00', NULL),
(19, 1, 'Chicken, broilers or fryers, breast, meat only, cooked, roasted - 1 breast', 198, 4.29, 0, 37.23, '2017-09-30 19:13:13', '0000-00-00 00:00:00', NULL),
(20, 1, 'Peanut Butter - 2 tbsp', 191.36, 16.44, 7.14, 7.11, '2017-09-30 19:13:25', '0000-00-00 00:00:00', NULL),
(21, 1, 'Yogurt, plain, low fat, 12 grams protein per 8 ounce - 1 cup (8 fl oz)', 154.35, 3.8, 17.25, 12.86, '2017-09-30 22:00:05', '0000-00-00 00:00:00', NULL),
(22, 1, 'Fast foods, burrito, with beans, cheese, and beef - 1 medium burrito', 577.8, 21.83, 75.02, 22.56, '2017-10-01 21:10:06', '0000-00-00 00:00:00', NULL),
(23, 1, 'Ice Cream Sandwich, Premium Vanilla', 210, 9, 30, 3, '2017-10-02 15:54:15', '0000-00-00 00:00:00', NULL),
(24, 1, 'Bagel', 290, 1, 58, 11, '2017-10-04 19:21:00', '0000-00-00 00:00:00', NULL),
(25, 1, 'Plain Bagel - 1 mini bagel (2-1/2\" dia)', 71.5, 0.42, 13.88, 2.73, '2017-10-06 01:33:18', '0000-00-00 00:00:00', NULL),
(26, 1, '0% Fat Greek Yogurt, Vanilla', 170, 0, 23, 18, '2017-10-06 01:41:47', '0000-00-00 00:00:00', NULL),
(27, 1, 'Oikos Traditional Greek Yogurt, Cafe Latte', 160, 4.5, 19, 11, '2017-10-06 01:41:57', '0000-00-00 00:00:00', NULL),
(28, 1, 'Tortelloni, Cheese Lovers', 270, 10, 36, 11, '2017-10-06 01:44:35', '0000-00-00 00:00:00', NULL),
(29, 1, 'Chicken, broilers or fryers, breast, meat only, cooked, roasted - 1 oz', 46.78, 1.01, 0, 8.79, '2017-10-06 02:04:15', '0000-00-00 00:00:00', NULL),
(30, 1, 'Pancake - 1 pancake (6\" dia)', 174.79, 7.47, 21.79, 4.93, '2017-10-06 13:11:26', '0000-00-00 00:00:00', NULL),
(31, 1, 'Pancake - 1 pancake (6\" dia)', 174.79, 7.47, 21.79, 4.93, '2017-10-06 13:11:34', '0000-00-00 00:00:00', NULL),
(32, 1, 'Pancake - 1 pancake (6\" dia)', 174.79, 7.47, 21.79, 4.93, '2017-10-06 13:11:41', '0000-00-00 00:00:00', NULL),
(33, 1, 'Egg, whole, cooked, scrambled - 1 large', 90.89, 6.7, 0.98, 6.09, '2017-10-06 13:11:47', '0000-00-00 00:00:00', NULL),
(34, 1, 'Egg, whole, cooked, scrambled - 1 large', 90.89, 6.7, 0.98, 6.09, '2017-10-06 13:11:52', '0000-00-00 00:00:00', NULL),
(35, 1, 'White Bread - 1 slice, large', 79.8, 1, 14.83, 2.66, '2017-10-06 13:12:07', '0000-00-00 00:00:00', NULL),
(36, 1, 'White Bread - 1 slice, large', 79.8, 1, 14.83, 2.66, '2017-10-06 13:12:11', '0000-00-00 00:00:00', NULL),
(37, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-08 19:52:02', '0000-00-00 00:00:00', NULL),
(38, 1, 'Pancake - 1 pancake (6\" dia)', 174.79, 7.47, 21.79, 4.93, '2017-10-09 19:45:07', '0000-00-00 00:00:00', NULL),
(39, 1, 'Egg, whole, cooked, scrambled - 1 large', 90.89, 6.7, 0.98, 6.09, '2017-10-09 19:45:13', '0000-00-00 00:00:00', NULL),
(40, 1, 'Toast', 60, 1.5, 11, 2, '2017-10-09 19:45:25', '0000-00-00 00:00:00', NULL),
(41, 1, 'Tortelloni', 290, 10, 39, 10, '2017-10-09 19:45:34', '0000-00-00 00:00:00', NULL),
(42, 1, 'Chicken, broilers or fryers, breast, meat only, cooked, roasted - 1 oz', 46.78, 1.01, 0, 8.79, '2017-10-09 19:45:40', '0000-00-00 00:00:00', NULL),
(43, 1, 'Plain Bagel - 1 mini bagel (2-1/2\" dia)', 71.5, 0.42, 13.88, 2.73, '2017-10-09 20:53:40', '0000-00-00 00:00:00', NULL),
(44, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-10 17:37:22', '0000-00-00 00:00:00', NULL),
(45, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-10 17:37:28', '0000-00-00 00:00:00', NULL),
(46, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-10 17:37:58', '0000-00-00 00:00:00', NULL),
(47, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-10 17:50:25', '0000-00-00 00:00:00', NULL),
(48, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-10 17:50:43', '0000-00-00 00:00:00', NULL),
(49, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-10 17:51:12', '0000-00-00 00:00:00', NULL),
(50, 1, 'Plain Bagel - 1 mini bagel (2-1/2\" dia)', 71.5, 0.42, 13.88, 2.73, '2017-10-10 17:51:22', '0000-00-00 00:00:00', NULL),
(51, 1, 'Pancake - 1 pancake (4\" dia)', 86.26, 3.69, 10.75, 2.43, '2017-10-10 18:07:55', '0000-00-00 00:00:00', NULL),
(52, 1, 'Toast', 60, 1.5, 11, 2, '2017-10-10 18:08:02', '0000-00-00 00:00:00', NULL),
(53, 1, 'Plain Bagel - 1 mini bagel (2-1/2\" dia)', 71.5, 0.42, 13.88, 2.73, '2017-10-10 19:02:40', '0000-00-00 00:00:00', NULL),
(54, 1, 'Plain Bagel - 1 mini bagel (2-1/2\" dia)', 71.5, 0.42, 13.88, 2.73, '2017-10-10 19:03:46', '0000-00-00 00:00:00', NULL),
(55, 1, 'Pancake - 1 pancake (4\" dia)', 86.26, 3.69, 10.75, 2.43, '2017-10-10 19:05:44', '0000-00-00 00:00:00', NULL),
(56, 1, 'Tostitos Chips - 1 oz', 139.71, 6.12, 20.06, 2.1, '2017-10-10 23:15:30', '0000-00-00 00:00:00', NULL),
(57, 1, 'Plain Bagel - 1 large bagel (4-1/2\" dia)', 360.25, 2.1, 69.95, 13.76, '2017-10-11 01:13:28', '0000-00-00 00:00:00', NULL),
(58, 2, 'Toast', 60, 1.5, 11, 2, '2017-10-11 01:17:10', '0000-00-00 00:00:00', NULL),
(59, 2, 'Snacks, tortilla chips, nacho cheese - 1 bag', 259.51, 13.7, 30.41, 3.69, '2017-10-11 01:17:22', '0000-00-00 00:00:00', NULL),
(60, 3, 'Panera Baguette - 2.4 oz', 184.96, 1.65, 35.28, 7.31, '2017-10-11 01:24:11', '0000-00-00 00:00:00', NULL),
(61, 3, 'Latte Caramel, Small', 270, 9, 40, 9, '2017-10-11 01:24:23', '0000-00-00 00:00:00', NULL),
(62, 3, 'Mardi Gras Mustard Sauce', 100, 8, 5, 1, '2017-10-11 01:25:23', '0000-00-00 00:00:00', NULL),
(63, 3, '12\" Hand Tossed American Legends Pizza, Philly Cheese Steak', 250, 11, 27, 12, '2017-10-11 01:25:31', '0000-00-00 00:00:00', NULL),
(64, 3, 'Chicken Parm Sandwich', 780, 31, 79, 49, '2017-10-11 01:25:45', '0000-00-00 00:00:00', NULL),
(65, 3, 'Chicken & Waffles, Honey Mustard Dressing', 230, 20, 13, 1, '2017-10-11 01:25:57', '0000-00-00 00:00:00', NULL),
(66, 3, 'Monster Mozza Sticks', 770, 38, 68, 39, '2017-10-11 01:26:17', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lifts`
--

CREATE TABLE `lifts` (
  `id` int(11) NOT NULL,
  `weight` double NOT NULL,
  `reps` int(11) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifts`
--

INSERT INTO `lifts` (`id`, `weight`, `reps`, `type`, `date`, `user`, `created_at`, `updated_at`) VALUES
(32, 185, 5, 'Bench_press', '2017-09-27 19:23:47', 1, '0000-00-00 00:00:00', NULL),
(33, 195, 7, 'Bench_press', '2017-09-27 19:23:59', 1, '0000-00-00 00:00:00', NULL),
(34, 200, 5, 'Squat', '2017-09-27 19:24:10', 1, '0000-00-00 00:00:00', NULL),
(35, 190, 5, 'Squat', '2017-09-27 19:24:23', 1, '0000-00-00 00:00:00', NULL),
(38, 225, 5, 'Squat', '2017-09-27 19:25:05', 1, '0000-00-00 00:00:00', NULL),
(39, 210, 5, 'Squat', '2017-09-27 19:25:15', 1, '0000-00-00 00:00:00', NULL),
(40, 230, 6, 'Squat', '2017-09-27 19:25:25', 1, '0000-00-00 00:00:00', NULL),
(41, 280, 5, 'Deadlift', '2017-09-27 19:25:38', 1, '0000-00-00 00:00:00', NULL),
(42, 285, 5, 'Deadlift', '2017-09-27 19:25:46', 1, '0000-00-00 00:00:00', NULL),
(43, 285, 3, 'Deadlift', '2017-09-27 19:25:56', 1, '0000-00-00 00:00:00', NULL),
(44, 290, 6, 'Deadlift', '2017-09-27 19:26:04', 1, '0000-00-00 00:00:00', NULL),
(45, 290, 5, 'Deadlift', '2017-09-27 19:26:13', 1, '0000-00-00 00:00:00', NULL),
(46, 300, 5, 'Deadlift', '2017-09-27 19:26:23', 1, '0000-00-00 00:00:00', NULL),
(50, 170, 5, 'Bench_press', '2017-09-27 19:46:01', 1, '0000-00-00 00:00:00', NULL),
(52, 225, 4, 'Bench_press', '2017-09-28 01:47:17', 1, '0000-00-00 00:00:00', NULL),
(54, 225, 5, 'Bench_press', '2017-09-30 18:39:07', 1, '0000-00-00 00:00:00', NULL),
(59, 200, 5, 'Bench_press', '2017-10-03 00:17:01', 1, '0000-00-00 00:00:00', NULL),
(60, 155, 5, 'Bench_press', '2017-10-03 00:17:59', 1, '0000-00-00 00:00:00', NULL),
(62, 200, 5, 'Squat', '2017-10-03 00:33:34', 1, '0000-00-00 00:00:00', NULL),
(63, 200, 5, 'Squat', '2017-10-04 00:25:36', 1, '0000-00-00 00:00:00', NULL),
(64, 500, 2, 'Bench_press', '2017-10-04 13:14:42', 2, '0000-00-00 00:00:00', NULL),
(65, 155, 5, 'Squat', '2017-10-04 13:17:36', 1, '0000-00-00 00:00:00', NULL),
(66, 500, 2, 'Squat', '2017-10-04 13:19:27', 2, '0000-00-00 00:00:00', NULL),
(67, 200, 5, 'Bench_press', '2017-10-05 01:19:43', 1, '0000-00-00 00:00:00', NULL),
(68, 200, 5, 'Bench_press', '2017-10-05 01:20:12', 1, '0000-00-00 00:00:00', NULL),
(69, 250, 5, 'Squat', '2017-10-05 01:21:27', 1, '0000-00-00 00:00:00', NULL),
(77, 180, 5, 'Bench_press', '2017-10-10 03:06:49', 1, '0000-00-00 00:00:00', NULL),
(78, 155, 5, 'Squat', '2017-10-11 00:55:34', 1, '0000-00-00 00:00:00', NULL),
(80, 150, 5, 'Bench_press', '2017-10-11 01:01:20', 1, '0000-00-00 00:00:00', NULL),
(81, 155, 5, 'Bench_press', '2017-10-11 01:04:56', 1, '0000-00-00 00:00:00', NULL),
(82, 175, 5, 'Bench_press', '2017-10-11 03:40:20', 1, '0000-00-00 00:00:00', NULL),
(83, 175, 5, 'Bench_press', '2017-09-28 04:00:00', 1, '0000-00-00 00:00:00', NULL),
(84, 300, 1, 'Bench_press', '2017-10-11 07:13:09', 1, '0000-00-00 00:00:00', NULL),
(85, 230, 5, 'Bench_press', '2017-10-11 07:13:50', 1, '0000-00-00 00:00:00', NULL),
(86, 155, 5, 'Bench_press', '2017-10-11 07:15:02', 2, '0000-00-00 00:00:00', NULL),
(87, 100, 1, 'Bench_press', '2017-10-11 07:15:18', 1, '0000-00-00 00:00:00', NULL),
(88, 35, 10, 'Lateral_Raises', '2017-10-11 07:17:38', 2, '0000-00-00 00:00:00', NULL),
(89, 155, 5, 'Lateral_Raises', '2017-10-11 07:19:31', 2, '0000-00-00 00:00:00', NULL),
(90, 560, 20, 'Pizza', '1979-05-05 04:00:00', 3, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lifttypes`
--

CREATE TABLE `lifttypes` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifttypes`
--

INSERT INTO `lifttypes` (`id`, `name`, `user`, `created_at`, `updated_at`) VALUES
(25, 'Bench_press', 1, '2017-09-27 19:23:09', NULL),
(26, 'Squat', 1, '2017-09-27 19:24:10', NULL),
(27, 'Deadlift', 1, '2017-09-27 19:25:38', NULL),
(28, 'Bench_press', 2, '2017-10-04 13:15:07', NULL),
(30, 'Squat', 2, '2017-10-04 13:19:27', NULL),
(31, 'Lateral_Raises', 2, '2017-10-11 01:17:38', NULL),
(32, 'Pizza', 3, '2017-10-11 01:22:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Austin', 'austin', 'password', '2017-10-10 23:18:59', NULL),
(2, 'testUser', 'test', 'test', '2017-10-11 00:20:24', NULL),
(3, 'Peter Tsokanis', 'pjt', 'pjt', '2017-10-11 01:21:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodyweights`
--
ALTER TABLE `bodyweights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifts`
--
ALTER TABLE `lifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifttypes`
--
ALTER TABLE `lifttypes`
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
-- AUTO_INCREMENT for table `bodyweights`
--
ALTER TABLE `bodyweights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `lifts`
--
ALTER TABLE `lifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `lifttypes`
--
ALTER TABLE `lifttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
