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
-- Table structure for table `important_achievements`
--

CREATE TABLE `important_achievements` (
  `iaid` int(11) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `arrest_in_major_crime` text NOT NULL,
  `decision_given_by_the_court` text NOT NULL,
  `missing_man_document` text NOT NULL,
  `miscellaneous` text NOT NULL,
  `robbery` text NOT NULL,
  `action_taken_under` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `important_achievements`
--

INSERT INTO `important_achievements` (`iaid`, `updated_by`, `district`, `sub_division`, `police_station`, `arrest_in_major_crime`, `decision_given_by_the_court`, `missing_man_document`, `miscellaneous`, `robbery`, `action_taken_under`, `created_at`, `updated_at`, `status`) VALUES
(1, 'abcd', 'सरगुजा', 'Option1', 'मणिपुर', 'अप.क्र. 45/23 धारा 457,380,34 भादवि कायमी दिनांक 24.04.23 के फरार आरोपी विकेश साहू उर्फ अभिषेक पिता विजय साहू उम्र 22 वर्ष सा. दर्रीपारा थाना मणीपुर को दिनां 08.05.23 को गिर कर\\r\\n', '---', '----', '----15 Kita gir0 Warrent tamil', '---', '--', '2023-05-16 12:43:16', '2023-05-16 12:43:16', 0),
(2, 'abcd', 'बलरामपुर', 'Option1', 'रामानुजगंज', '', '', '', '', '', '', '2023-05-16 12:47:48', '2023-05-16 12:47:48', 0),
(3, 'abcd', 'जशपुर', 'Option1', 'कांसाबेल', '-----', '---------', 'wrjewgfjrg', 'sfisgdgj', 'rtgthtfh', 'ewresgytdjgyjku', '2023-05-16 12:48:18', '2023-05-16 12:48:18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `important_achievements`
--
ALTER TABLE `important_achievements`
  ADD PRIMARY KEY (`iaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `important_achievements`
--
ALTER TABLE `important_achievements`
  MODIFY `iaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
