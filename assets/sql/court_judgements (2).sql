-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 10:41 AM
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
-- Table structure for table `court_judgements`
--

CREATE TABLE `court_judgements` (
  `cjid` int(11) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `court_name` varchar(255) NOT NULL,
  `judgement_of_court` varchar(255) NOT NULL,
  `penal_code` varchar(255) NOT NULL,
  `result_date` date DEFAULT NULL,
  `crime_number` varchar(255) NOT NULL,
  `culprit_name` varchar(255) NOT NULL,
  `culprit_address` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_judgements`
--

INSERT INTO `court_judgements` (`cjid`, `district`, `sub_division`, `police_station`, `court_name`, `judgement_of_court`, `penal_code`, `result_date`, `crime_number`, `culprit_name`, `culprit_address`, `updated_at`, `updated_by`, `created_at`, `status`) VALUES
(1, 'सरगुजा', 'Option1', 'अंबिकापुर', 'CJM Court Ambikapur', 'Jamanat Swikar', '420, 467, 468, 471, 120B, 201', '2023-01-10', '41/23', 'Satrughan Singh / Kailash Singh /32 years', 'Mission Chowk kedarpur', '2023-05-16 13:03:35', 'abcd', '2023-05-16 13:03:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `court_judgements`
--
ALTER TABLE `court_judgements`
  ADD PRIMARY KEY (`cjid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `court_judgements`
--
ALTER TABLE `court_judgements`
  MODIFY `cjid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
