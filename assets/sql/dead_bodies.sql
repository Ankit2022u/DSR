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
-- Table structure for table `dead_bodies`
--

CREATE TABLE `dead_bodies` (
  `dbid` int(11) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `dead_body_number` varchar(255) NOT NULL,
  `penal_code` varchar(255) NOT NULL,
  `accident_date` date NOT NULL,
  `accident_time` time NOT NULL,
  `accident_place` varchar(255) NOT NULL,
  `information_date` date NOT NULL,
  `information_time` time NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `deceased_name` varchar(255) NOT NULL,
  `fir_writer` varchar(255) NOT NULL,
  `cause_of_death` text NOT NULL,
  `disposal_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dead_bodies`
--

INSERT INTO `dead_bodies` (`dbid`, `updated_by`, `created_at`, `updated_at`, `status`, `district`, `sub_division`, `police_station`, `dead_body_number`, `penal_code`, `accident_date`, `accident_time`, `accident_place`, `information_date`, `information_time`, `applicant_name`, `deceased_name`, `fir_writer`, `cause_of_death`, `disposal_date`) VALUES
(1, 'abcd', '2022-05-16 12:27:26', '2022-05-16 12:27:26', 0, 'सरगुजा', 'Option1', 'अंबिकापुर', '52/23', '174', '2023-04-30', '18:56:00', 'MIssion Hospital Ambikapur', '2022-05-08', '19:57:00', 'Kawar Singh Netam', 'Manglu Paikra', 'P.R. 137', 'Agyat Bimari Se', '2022-12-23'),
(2, 'abcd', '2023-05-16 12:29:58', '2023-05-16 12:29:58', 0, 'सरगुजा', 'Option1', 'अंबिकापुर', '53/23', '174', '2023-05-08', '17:59:00', 'Dabripani, Bathiyachuaa', '2023-05-08', '20:59:00', 'Visharam Kujur', 'Unkown person/ 50Y', 'P.R.137', 'Unknown', '2023-05-09'),
(3, 'abcd', '2023-05-16 12:32:04', '2023-05-16 12:32:04', 0, 'सरगुजा', 'Option1', 'दरिमा', '31/23', '174', '2023-05-08', '01:01:00', 'Belkharikha', '2023-05-08', '18:01:00', 'AmirShaye', 'Bhola nagesh', 'Rakesh Mishra', 'Fasi Lagane Se!', '2023-05-28'),
(4, 'abcd', '2023-05-16 12:34:51', '2023-05-16 12:34:51', 0, 'सरगुजा', 'Option1', 'लखनपुर', '40/23', '174', '2023-05-04', '01:30:00', 'Chando', '2023-05-08', '14:04:00', 'Umma Sankar Yadav', 'Rama Sankar Yadav', 'P.R. 107', 'Unknown', '2023-05-28'),
(5, 'abcd', '2023-05-16 12:37:35', '2023-05-16 12:37:35', 0, 'सरगुजा', 'Option1', 'लखनपुर', '41/23', '174', '2023-05-08', '12:10:00', 'Singhitana', '2023-05-08', '13:09:00', 'Lalmohan Pandey', 'Sonu PAndey', 'P.R. 425', 'Accident ', '2023-03-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dead_bodies`
--
ALTER TABLE `dead_bodies`
  ADD PRIMARY KEY (`dbid`),
  ADD UNIQUE KEY `dead_body_number` (`dead_body_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dead_bodies`
--
ALTER TABLE `dead_bodies`
  MODIFY `dbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
