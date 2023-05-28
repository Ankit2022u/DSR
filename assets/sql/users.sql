-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 10:44 AM
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
-- Database: `newdsr`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0,
  `officer_name` varchar(255) NOT NULL,
  `officer_rank` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `profile_photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `created_at`, `updated_at`, `status`, `officer_name`, `officer_rank`, `user_id`, `user_type`, `password`, `district`, `sub_division`, `police_station`, `profile_photo_path`) VALUES
(1, '2023-04-19 07:20:53', '2023-05-08 08:05:28', 1, 'Test Officer', 'Test Admin', 'admin', 'admin', '$2y$10$bmawMch3nNf0ghxR8dkeCuWxT/29jZjH/m78d52bCUpUzt91.acWa', 'Surguja', '', 'Ambikapur', 'ankit.jpg'),
(2, '2023-04-19 09:47:14', '2023-04-20 02:46:55', 1, 'Officer', 'Rank', 'user', 'user', '$2y$10$bmawMch3nNf0ghxR8dkeCuWxT/29jZjH/m78d52bCUpUzt91.acWa', 'Surajpur', '', 'Bhatgaon', 'Laravel.png'),
(3, '2023-04-23 04:51:28', '2023-04-23 04:51:28', 1, 'Ankit', 'Rank Z', 'ankit', 'admin', '$2y$10$bmawMch3nNf0ghxR8dkeCuWxT/29jZjH/m78d52bCUpUzt91.acWa', 'Surguja', '', 'Ambikapur', 'DSC_7895.JPG'),
(4, '2023-05-08 11:37:57', '2023-05-08 11:37:57', 0, 'Ahvi', '1st', 'ahvi', 'admin', '$2y$10$CjaO42b7iiS3hz3WZTgBFu4BjUZNS/.gkslFVbHvll3M6BxINAOv.', 'Surajpur', '', 'Surajpur', 'WhatsApp Image 2023-02-24 at 01.16.24.jpg'),
(5, '2023-05-08 11:53:24', '2023-05-08 11:53:24', 1, 'Userx', '2nd', 'userx', 'user', '$2y$10$KZDGVnyvSSnOEMvbYuIxqeh2kbWl.TYqNIhKAaJf1TN70MjhP80S.', 'Surajpur', '', 'Bhatgaon', 'Screenshot 2022-07-21 195847.png'),
(6, '2023-05-16 07:58:37', '2023-05-16 07:58:37', 1, 'SHAILENDRA', 'IPS', 'ssarmo989', 'admin', '$2y$10$ftwL2WO4C8L3gmS60HPE9.ApEsam94NVBFvh0aMQJu6twrztKPbTa', 'सरगुजा', '', 'दरिमा', ''),
(7, '2023-05-16 10:45:30', '2023-05-16 10:45:30', 1, 'Armo', 'xyz', 'abcd', 'user', '$2y$10$HqtZ5EiGcOYpY5gjpmRhxevUtkuMBulk4o3djevWXNdgHLdYuCS0G', 'सरगुजा', '', 'दरिमा', 'golden-badge-shield-with-gold-leaves_1017-30512.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
