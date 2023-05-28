-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 10:42 AM
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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `lid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `table_name` varchar(255) NOT NULL,
  `table_id` int(11) NOT NULL,
  `operation` varchar(255) NOT NULL,
  `log_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`lid`, `status`, `created_by`, `created_at`, `table_name`, `table_id`, `operation`, `log_desc`) VALUES
(1, 1, 'ankit', '2023-05-16 07:19:14', 'No table', 3, 'login', 'Ankit logged in the system.'),
(2, 1, 'ankit', '2023-05-16 07:58:37', 'users', 6, 'insert', 'User Created.'),
(3, 1, 'ankit', '2023-05-16 07:58:58', 'No table', 3, 'logout', 'Ankit logged out of the system.'),
(4, 1, 'ankit', '2023-05-16 07:59:34', 'No table', 3, 'login', 'Ankit logged in the system.'),
(5, 1, 'ankit', '2023-05-16 07:59:51', 'users', 6, 'update', 'User Activated/Deactivated.'),
(6, 1, 'ankit', '2023-05-16 07:59:56', 'No table', 3, 'logout', 'Ankit logged out of the system.'),
(7, 1, 'ssarmo989', '2023-05-16 08:00:19', 'No table', 6, 'login', 'SHAILENDRA logged in the system.'),
(8, 1, 'ssarmo989', '2023-05-16 08:03:26', 'police_stations', 72, 'insert', 'Police Station Added.'),
(9, 1, 'ssarmo989', '2023-05-16 08:04:17', 'police_stations', 73, 'insert', 'Police Station Added.'),
(10, 1, 'ssarmo989', '2023-05-16 08:04:30', 'police_stations', 74, 'insert', 'Police Station Added.'),
(11, 1, 'ssarmo989', '2023-05-16 08:06:10', 'police_stations', 75, 'insert', 'Police Station Added.'),
(12, 1, 'ssarmo989', '2023-05-16 08:08:49', 'police_stations', 76, 'insert', 'Police Station Added.'),
(13, 1, 'ssarmo989', '2023-05-16 08:10:03', 'police_stations', 77, 'insert', 'Police Station Added.'),
(14, 1, 'ssarmo989', '2023-05-16 08:10:16', 'police_stations', 78, 'insert', 'Police Station Added.'),
(15, 1, 'ssarmo989', '2023-05-16 08:10:30', 'police_stations', 79, 'insert', 'Police Station Added.'),
(16, 1, 'ssarmo989', '2023-05-16 08:10:55', 'police_stations', 80, 'insert', 'Police Station Added.'),
(17, 1, 'ssarmo989', '2023-05-16 08:12:12', 'police_stations', 81, 'insert', 'Police Station Added.'),
(18, 1, 'ssarmo989', '2023-05-16 08:12:26', 'police_stations', 82, 'insert', 'Police Station Added.'),
(19, 1, 'ssarmo989', '2023-05-16 08:12:38', 'police_stations', 83, 'insert', 'Police Station Added.'),
(20, 1, 'ssarmo989', '2023-05-16 08:12:53', 'police_stations', 84, 'insert', 'Police Station Added.'),
(21, 1, 'ssarmo989', '2023-05-16 08:13:18', 'police_stations', 85, 'insert', 'Police Station Added.'),
(22, 1, 'ssarmo989', '2023-05-16 08:13:36', 'police_stations', 86, 'insert', 'Police Station Added.'),
(23, 1, 'ssarmo989', '2023-05-16 08:13:58', 'police_stations', 87, 'insert', 'Police Station Added.'),
(24, 1, 'ssarmo989', '2023-05-16 09:09:44', 'No table', 6, 'logout', 'SHAILENDRA logged out of the system.'),
(25, 1, 'user', '2023-05-16 09:10:20', 'No table', 2, 'login', 'Officer logged in the system.'),
(26, 1, 'user', '2023-05-16 09:20:58', 'No table', 2, 'logout', 'Officer logged out of the system.'),
(27, 1, 'ankit', '2023-05-16 09:33:59', 'No table', 3, 'login', 'Ankit logged in the system.'),
(28, 1, 'ankit', '2023-05-16 10:26:56', 'No table', 3, 'logout', 'Ankit logged out of the system.'),
(29, 1, 'ssarmo989', '2023-05-16 10:27:14', 'No table', 6, 'login', 'SHAILENDRA logged in the system.'),
(30, 1, 'ssarmo989', '2023-05-16 10:43:28', 'No table', 6, 'logout', 'SHAILENDRA logged out of the system.'),
(31, 1, 'ssarmo989', '2023-05-16 10:43:33', 'No table', 6, 'login', 'SHAILENDRA logged in the system.'),
(32, 1, 'ssarmo989', '2023-05-16 10:45:30', 'users', 7, 'insert', 'User Created.'),
(33, 1, 'ssarmo989', '2023-05-16 10:45:37', 'No table', 6, 'logout', 'SHAILENDRA logged out of the system.'),
(34, 1, 'ssarmo989', '2023-05-16 10:46:07', 'No table', 6, 'login', 'SHAILENDRA logged in the system.'),
(35, 1, 'ssarmo989', '2023-05-16 10:46:19', 'users', 7, 'update', 'User Activated/Deactivated.'),
(36, 1, 'ssarmo989', '2023-05-16 10:46:33', 'No table', 6, 'logout', 'SHAILENDRA logged out of the system.'),
(37, 1, 'abcd', '2023-05-16 10:46:48', 'No table', 7, 'login', 'Armo logged in the system.'),
(38, 1, 'abcd', '2023-05-16 10:54:46', 'major_crimes', 1, 'insert', 'Major Crime  Data Filled.'),
(39, 1, 'abcd', '2023-05-16 11:12:21', 'major_crimes', 2, 'insert', 'Major Crime  Data Filled.'),
(40, 1, 'abcd', '2023-05-16 11:19:12', 'major_crimes', 3, 'insert', 'Major Crime  Data Filled.'),
(41, 1, 'abcd', '2023-05-16 11:26:09', 'major_crimes', 4, 'insert', 'Major Crime  Data Filled.'),
(42, 1, 'abcd', '2023-05-16 12:09:01', 'major_crimes', 5, 'insert', 'Major Crime  Data Filled.'),
(43, 1, 'abcd', '2023-05-16 12:15:40', 'major_crimes', 6, 'insert', 'Major Crime  Data Filled.'),
(44, 1, 'abcd', '2023-05-16 12:19:38', 'major_crimes', 7, 'insert', 'Major Crime  Data Filled.'),
(45, 1, 'abcd', '2023-05-16 12:24:26', 'major_crimes', 8, 'insert', 'Major Crime  Data Filled.'),
(46, 1, 'abcd', '2023-05-16 12:27:26', 'dead_bodies', 1, 'insert', 'Dead Body Data Filled.'),
(47, 1, 'abcd', '2023-05-16 12:29:58', 'dead_bodies', 2, 'insert', 'Dead Body Data Filled.'),
(48, 1, 'abcd', '2023-05-16 12:32:04', 'dead_bodies', 3, 'insert', 'Dead Body Data Filled.'),
(49, 1, 'abcd', '2023-05-16 12:34:51', 'dead_bodies', 4, 'insert', 'Dead Body Data Filled.'),
(50, 1, 'abcd', '2023-05-16 12:37:35', 'dead_bodies', 5, 'insert', 'Dead Body Data Filled.'),
(51, 1, 'abcd', '2023-05-16 12:43:16', 'important_achievements', 1, 'insert', 'Important Achievement Data Filled.'),
(52, 1, 'abcd', '2023-05-16 12:47:48', 'important_achievements', 2, 'insert', 'Important Achievement Data Filled.'),
(53, 1, 'abcd', '2023-05-16 12:48:18', 'important_achievements', 3, 'insert', 'Important Achievement Data Filled.'),
(54, 1, 'abcd', '2023-05-16 13:03:35', 'court_judgements', 1, 'insert', 'Court Judgement Data Filled.'),
(55, 1, 'abcd', '2023-05-16 13:07:31', 'minor_crimes', 1, 'insert', 'Minor Crime Data Filled.'),
(56, 1, 'abcd', '2023-05-16 13:08:27', 'minor_crimes', 2, 'insert', 'Minor Crime Data Filled.'),
(57, 1, 'abcd', '2023-05-16 13:09:01', 'minor_crimes', 3, 'insert', 'Minor Crime Data Filled.'),
(58, 1, 'abcd', '2023-05-16 13:09:50', 'minor_crimes', 4, 'insert', 'Minor Crime Data Filled.'),
(59, 1, 'abcd', '2023-05-16 13:10:30', 'minor_crimes', 5, 'insert', 'Minor Crime Data Filled.'),
(60, 1, 'abcd', '2023-05-16 13:11:08', 'minor_crimes', 6, 'insert', 'Minor Crime Data Filled.'),
(61, 1, 'abcd', '2023-05-16 13:12:13', 'minor_crimes', 7, 'insert', 'Minor Crime Data Filled.'),
(62, 1, 'abcd', '2023-05-16 13:13:07', 'minor_crimes', 8, 'insert', 'Minor Crime Data Filled.'),
(63, 1, 'abcd', '2023-05-16 13:14:46', 'minor_crimes', 9, 'insert', 'Minor Crime Data Filled.'),
(64, 1, 'abcd', '2023-05-16 13:15:24', 'minor_crimes', 10, 'insert', 'Minor Crime Data Filled.'),
(65, 1, 'abcd', '2023-05-16 13:15:44', 'No table', 7, 'logout', 'Armo logged out of the system.'),
(66, 1, 'ssarmo989', '2023-05-16 13:15:50', 'No table', 6, 'login', 'SHAILENDRA logged in the system.'),
(67, 1, 'ankit', '2023-05-17 07:04:31', 'No table', 3, 'login', 'Ankit logged in the system.'),
(68, 1, 'ankit', '2023-05-17 11:18:14', 'No table', 3, 'logout', 'Ankit logged out of the system.'),
(69, 1, 'ankit', '2023-05-18 13:49:22', 'No table', 3, 'login', 'Ankit logged in the system.'),
(70, 1, 'ankit', '2023-05-21 08:52:34', 'No table', 3, 'login', 'Ankit logged in the system.'),
(71, 1, 'ankit', '2023-05-21 09:43:58', 'No table', 3, 'login', 'Ankit logged in the system.'),
(72, 1, 'ankit', '2023-05-22 08:47:28', 'No table', 3, 'login', 'Ankit logged in the system.'),
(73, 1, 'ankit', '2023-05-25 12:40:15', 'No table', 3, 'login', 'Ankit logged in the system.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`lid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
