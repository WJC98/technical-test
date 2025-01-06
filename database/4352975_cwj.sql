-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: fdb1028.awardspace.net
-- Generation Time: Jan 06, 2025 at 11:16 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4352975_cwj`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2024-12-31 09:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `status` enum('Active','Completed') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remaining_slots` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `event_date`, `location`, `capacity`, `status`, `created_at`, `updated_at`, `remaining_slots`) VALUES
(42, 'Unlock Your Unique Visibility: A Workshop for Introverted Entrepreneurs', 'Discover how to embrace your strengths, think creatively, and craft personalized visibility strategies that feel right for YOU.', '2025-01-12 09:00:00', 'Online', 50, 'Active', '2025-01-05 08:13:07', '2025-01-06 08:43:26', 46),
(44, 'Kuala Lumpur - D.R.I.V.E. Mentorship/Suladio Business Q&A Session', 'Dive into our interactive Q&A session designed to help you elevate your personal development, enhance relationships, and advance in your career.', '2025-01-16 08:00:00', 'Online', 20, 'Active', '2025-01-05 08:22:23', '2025-01-06 08:38:45', 16),
(46, 'Testing', 'For testing event fully booked feature.', '2025-01-15 10:00:00', 'Online', 2, 'Active', '2025-01-05 08:34:26', '2025-01-05 08:37:07', 0),
(47, 'House and Brew', 'Come join us at House & Brew for an afternoon of good vibes, great music, and of course, plenty of delicious brews to enjoy with friends!', '2025-01-17 09:00:00', 'Lisette\'s Café & Bakery @ Bangsar', 10, 'Active', '2025-01-05 08:35:55', '2025-01-06 10:34:44', 8),
(48, 'Hokkaido Table Live', 'Unwind and escape the city\'s rhythm at Hokkaido Table Live. Let the live music set the perfect tone for a memorable dining experience.', '2025-02-10 19:30:00', 'Hokkaido Table - The Exchange TRX', 30, 'Active', '2025-01-05 08:41:05', '2025-01-05 08:53:56', 29),
(49, 'Sunday Morning English Service', 'Join us for our English service on Sunday at 10AM. We look forward to having you with us.', '2025-01-19 10:00:00', 'HSG - His Sanctuary Glory', 5, 'Active', '2025-01-05 08:46:11', '2025-01-06 08:27:10', 2),
(50, 'Options Trading & US Market Trends of 2025', 'Get ready to level up your options trading game with expert speakers and networking opportunities!', '2025-01-22 18:30:00', 'Connexion Conference & Event Centre (Nexus)', 50, 'Active', '2025-01-05 08:51:27', '2025-01-05 08:51:27', 50),
(51, ' HI-TEA WITH LUSISO BOUTIQUE GOLDEN HOUR SALE!', 'Indulge in an exclusive shopping experience during our Golden Hour Sale, where you can enjoy special deals on our hot selling collection!', '2025-01-02 10:00:00', 'KWC Fashion Wholesale', 10, 'Completed', '2025-01-05 08:53:06', '2025-01-05 08:53:16', 10);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_id`, `name`, `email`, `registered_at`) VALUES
(40, 46, 'test', 'test1@gmail.com', '2025-01-05 08:36:51'),
(41, 46, 'test', 'test2@gmail.com', '2025-01-05 08:37:07'),
(42, 42, 'test', 'test1@gmail.com', '2025-01-05 08:37:44'),
(43, 48, 'test', 'test1@gmail.com', '2025-01-05 08:53:56'),
(44, 49, 'hi', 'hi@gmail.com', '2025-01-05 09:33:34'),
(45, 49, 'Hi', 'hello@gmail.com', '2025-01-05 16:41:05'),
(46, 49, 'test', '1111@gmail.com', '2025-01-06 08:27:10'),
(47, 42, 'test', '1111@gmail.com', '2025-01-06 08:29:05'),
(48, 44, 'test', '1111@gmail.com', '2025-01-06 08:32:22'),
(49, 44, '11', '11111@gmail.com', '2025-01-06 08:33:43'),
(50, 44, '111', '111111@gmail.com', '2025-01-06 08:34:41'),
(51, 42, 'ddd', 'ddd@gmail.com', '2025-01-06 08:35:08'),
(52, 44, 'test', '1212@gmail.com', '2025-01-06 08:38:45'),
(53, 42, 'rtt', 'rtt@gmail.com', '2025-01-06 08:43:26'),
(54, 47, 'Test', '000@gmail.com', '2025-01-06 08:53:40'),
(57, 47, 'hello', 'hello@gmail.com', '2025-01-06 10:34:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
