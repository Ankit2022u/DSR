-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 10:43 AM
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
-- Table structure for table `minor_crimes`
--

CREATE TABLE `minor_crimes` (
  `mcid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `fir_writer` varchar(255) NOT NULL,
  `time_date` datetime NOT NULL,
  `culprit_number` int(11) NOT NULL,
  `penal_code` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `crime_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minor_crimes`
--

INSERT INTO `minor_crimes` (`mcid`, `created_at`, `updated_at`, `status`, `fir_writer`, `time_date`, `culprit_number`, `penal_code`, `updated_by`, `district`, `sub_division`, `police_station`, `crime_number`) VALUES
(1, '2023-05-16 13:07:31', '2023-05-16 13:07:31', 0, '---', '2023-05-17 21:37:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '1'),
(2, '2023-05-16 13:08:27', '2023-05-16 13:08:27', 0, '--', '2023-05-16 19:39:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '2'),
(3, '2023-05-16 13:09:01', '2023-05-16 13:09:01', 0, '----', '2023-05-16 19:35:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '3'),
(4, '2023-05-16 13:09:50', '2023-05-16 13:09:50', 0, 'armo', '2023-05-16 20:40:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '4'),
(5, '2023-05-16 13:10:30', '2023-05-16 13:10:30', 0, 'armo', '2023-05-16 20:42:00', 1, '151 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'धौरपुर', '5'),
(6, '2023-05-16 13:11:08', '2023-05-16 13:11:08', 0, 'armo', '2023-05-16 18:41:00', 1, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'धौरपुर', '6'),
(7, '2023-05-16 13:12:13', '2023-05-16 13:12:13', 0, 'armo', '2023-05-16 20:43:00', 1, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'दरिमा', '7'),
(8, '2023-05-16 13:13:07', '2023-05-16 13:13:07', 0, 'armo', '2023-05-16 19:46:00', 1, 'आव. एक्ट', 'abcd', 'जशपुर', 'Option1', 'नारायणपुर', '9'),
(9, '2023-05-16 13:14:46', '2023-05-16 13:14:46', 0, 'afrmo', '2023-05-16 20:45:00', 300, 'एम. वी. एक्ट', 'abcd', 'सरगुजा', 'Option1', 'उदयपुर', '11'),
(10, '2023-05-16 13:15:24', '2023-05-16 13:15:24', 0, 'afrmo', '2023-05-16 19:46:00', 900, 'एम. वी. एक्ट', 'abcd', 'सरगुजा', 'Option1', 'उदयपुर', '11'),
(11, '2023-05-16 13:07:31', '2023-05-16 13:07:31', 0, '---', '2023-05-17 21:37:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '1'),
(12, '2023-05-16 13:08:27', '2023-05-16 13:08:27', 0, '--', '2023-05-16 19:39:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '2'),
(13, '2023-05-16 13:09:01', '2023-05-16 13:09:01', 0, '----', '2023-05-16 19:35:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '3'),
(14, '2023-05-16 13:09:50', '2023-05-16 13:09:50', 0, 'armo', '2023-05-16 20:40:00', 2, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'सीतापुर', '4'),
(15, '2023-05-16 13:10:30', '2023-05-16 13:10:30', 0, 'armo', '2023-05-16 20:42:00', 1, '151 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'धौरपुर', '5'),
(16, '2023-05-16 13:11:08', '2023-05-16 13:11:08', 0, 'armo', '2023-05-16 18:41:00', 1, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'धौरपुर', '6'),
(17, '2023-05-16 13:12:13', '2023-05-16 13:12:13', 0, 'armo', '2023-05-16 20:43:00', 1, '107,116 जा. फौ', 'abcd', 'सरगुजा', 'Option1', 'दरिमा', '7'),
(18, '2023-05-16 13:13:07', '2023-05-16 13:13:07', 0, 'armo', '2023-05-16 19:46:00', 1, 'आव. एक्ट', 'abcd', 'जशपुर', 'Option1', 'नारायणपुर', '9'),
(19, '2023-05-16 13:14:46', '2023-05-16 13:14:46', 0, 'afrmo', '2023-05-16 20:45:00', 300, 'एम. वी. एक्ट', 'abcd', 'सरगुजा', 'Option1', 'उदयपुर', '11'),
(20, '2023-05-16 13:15:24', '2023-05-16 13:15:24', 0, 'afrmo', '2023-05-16 19:46:00', 900, 'एम. वी. एक्ट', 'abcd', 'सरगुजा', 'Option1', 'उदयपुर', '11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `minor_crimes`
--
ALTER TABLE `minor_crimes`
  ADD PRIMARY KEY (`mcid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `minor_crimes`
--
ALTER TABLE `minor_crimes`
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
