-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 05:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventmanage`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventlist`
--

CREATE TABLE `eventlist` (
  `evn_id` int(20) NOT NULL,
  `evn_type` varchar(20) NOT NULL,
  `evn_name` varchar(100) NOT NULL,
  `evn_desc` varchar(255) NOT NULL,
  `evn_price` varchar(20) NOT NULL,
  `evn_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventlist`
--

INSERT INTO `eventlist` (`evn_id`, `evn_type`, `evn_name`, `evn_desc`, `evn_price`, `evn_img`) VALUES
(8, 'weadding', 'Lamp', 'These cordless lamps from TDC Cordless Lighting are a great alternative to floral centrepieces.', '4 Lakh', 'uploads/w-event1.png'),
(9, 'weadding', 'Kashmiri wedding ceremony', 'The Kashmiri wedding ceremony is known as lagan. It follows all the normal vedic rituals.', '5 Lakh', 'uploads/w-event2.png'),
(10, 'weadding', 'French Decoration', 'French design is romantic, featuring ornate crown molding, gold mirrors, parquet flooring, dark wood furniture, and nature-inspired patterns. French interiors feel collected over time.', '9 Lakh', 'uploads/french_decoration.jpg'),
(11, 'engagement', 'Pinterest obsessed', 'Pinterest obsessed? We bet you\'ll have seen a gorgeous engagement party sign like this one. It\'s on the pricier side of the scale but you can re-use it on your wedding day too. Buy It Now.', '50k', 'uploads/princess.png'),
(12, 'engagement', 'Beach Side Event', '\"Hosting an outdoor event on the beach requires careful planning and consideration due to the unique environment.\"', '5 Lakh', 'uploads/e-evn2.jpg'),
(13, 'birthday', 'Ballon Decoration', 'We provide Birthday Decoration, Balloon Decoration, Anniversary Decoration, Stage Decoration, Couple Room Decoration, and Theme Party Organization services.', '20k', 'uploads/Screenshot_43.png'),
(14, 'birthday', 'Garden Theme', 'A garden is a planned area of land near a house, used for growing plants, flowers, and fruits.', '50k', 'uploads/b-evn2.png'),
(15, 'engagement', 'Pakistani Engagement Ceremony', 'adsfsadfsdfdsf', '2 Lakh', 'uploads/DECO-176-1024x678.jpg'),
(16, 'firstmeet', 'Resturant ', 'Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore', '10k', 'uploads/story-4.png'),
(17, 'others', 'Friends Party', '\"Introduce yourself, ask questions, be attentive, engage in conversations, and start activities like dancing or karaoke.\"', '10k', 'uploads/Screenshot_60.png'),
(18, 'others', 'Sometinig', 'wqewqe', '40k', 'uploads/Screenshot_65.png');

-- --------------------------------------------------------

--
-- Table structure for table `occation`
--

CREATE TABLE `occation` (
  `evn_id` int(10) NOT NULL,
  `selected_event` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `evn_type` varchar(20) NOT NULL,
  `evn_name` varchar(20) NOT NULL,
  `evn_desc` varchar(255) NOT NULL,
  `evn_price` varchar(40) NOT NULL,
  `evn_date` date NOT NULL,
  `evn_time` varchar(20) NOT NULL,
  `evn_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `occation`
--

INSERT INTO `occation` (`evn_id`, `selected_event`, `user_id`, `evn_type`, `evn_name`, `evn_desc`, `evn_price`, `evn_date`, `evn_time`, `evn_img`) VALUES
(2, 10, 3, 'weadding', 'French Decoration', 'French design is romantic and embraces old-world beauty with ornate crown molding, gold mirrors, parquet flooring, dark wood furniture, and nature-inspired patterns. However, French interiors also feel collected over time.', '9 Lakh', '2010-09-24', '07 : 00 PM', 'uploads/french_stage.jpg'),
(3, 10, 4, 'weadding', 'French Decoration', 'French design is romantic and embraces old-world beauty with ornate crown molding, gold mirrors, parquet flooring, dark wood furniture, and nature-inspired patterns. However, French interiors also feel collected over time.', '9 Lakh', '2010-09-24', '07 : 00 PM', 'uploads/french_stage.jpg'),
(9, 8, 3, 'weadding', 'Lamp', 'These cordless lamps from TDC Cordless Lighting are a great alternative to floral centrepieces.', '4 Lakh', '2024-06-13', '21:12', 'uploads/w-event1.png'),
(11, 14, 5, 'birthday', 'Garden Theme', 'A garden is a planned area of land near a house, used for growing plants, flowers, and fruits.', '50k', '2024-06-10', '12:59', 'uploads/b-evn2.png'),
(12, 17, 5, 'others', 'Friends Party', '\"Introduce yourself, ask questions, be attentive, engage in conversations, and start activities like dancing or karaoke.\"', '10k', '2024-07-15', '20:01', 'uploads/Screenshot_60.png'),
(13, 8, 5, 'weadding', 'Lamp', 'These cordless lamps from TDC Cordless Lighting are a great alternative to floral centrepieces.', '4 Lakh', '2024-06-18', '14:22', 'uploads/w-event1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `u_password` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_name`, `email`, `u_password`, `reg_date`, `profile_image`, `phone`, `designation`) VALUES
(1, 'Fahad', 'fahadnakib27@gmail.com', '123', '2024-06-10 10:39:07', 'uploads/fahad.jpg', '01963642898', 'admin'),
(3, 'Nafis', 'nafis@gmail.com', '123', '2024-06-10 06:25:00', 'uploads/Screenshot_38.png', '01963642898', 'user'),
(4, 'Zamil', 'zamil@gmail.com', '123', '2024-06-10 06:29:21', 'uploads/Screenshot_42.png', '019342323', 'user'),
(5, 'Fahad Nakib', 'fahadnakib272@gmail.com', '1234', '2025-06-02 14:49:44', 'uploads/Screenshot_47.png', '01963642897', 'user'),
(6, 'Shihabur_Rahman', 'shihab@gmail.com', '1234', '2024-06-11 12:47:16', 'uploads/Screenshot_46.png', '01876545623', 'user'),
(7, 'Nadia Akter', 'nadia@gmail.com', '1234', '2024-06-11 12:51:59', 'uploads/Screenshot_48.png', '01756376534', 'user'),
(8, 'Saim Ahmed', 'saim@gmail.com', '123', '2024-06-11 12:58:12', 'uploads/Screenshot_49.png', '01382478327', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventlist`
--
ALTER TABLE `eventlist`
  ADD PRIMARY KEY (`evn_id`);

--
-- Indexes for table `occation`
--
ALTER TABLE `occation`
  ADD PRIMARY KEY (`evn_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventlist`
--
ALTER TABLE `eventlist`
  MODIFY `evn_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `occation`
--
ALTER TABLE `occation`
  MODIFY `evn_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
