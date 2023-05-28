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
-- Table structure for table `penal_codes`
--

CREATE TABLE `penal_codes` (
  `pcid` int(11) NOT NULL,
  `penal_code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penal_codes`
--

INSERT INTO `penal_codes` (`pcid`, `penal_code`, `type`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, '302', 'IPC-Murder', 'Section 302 of the Indian Penal Code states that a person committing murder shall be punished with a death sentence or imprisonment for life and shall also be liable to pay a fine. It is a non-bailable and non-compoundable offence, i.e., the matter cannot be settled outside the court.', '2023-05-21 19:52:47', '2023-05-21 19:52:47', 0),
(2, '303', 'IPC-Murder', '', '2023-05-21 19:54:30', '2023-05-21 19:54:30', 0),
(3, '304', 'IPC-Murder', '', '2023-05-21 19:54:51', '2023-05-21 19:54:51', 0),
(4, '304B', 'IPC-Murder', '', '2023-05-21 19:55:06', '2023-05-21 19:55:06', 0),
(5, '306', 'IPC-Murder', '', '2023-05-21 19:55:13', '2023-05-21 19:55:13', 0),
(6, '363', 'IPC-Kidnap', '', '2023-05-21 19:55:19', '2023-05-21 19:55:19', 0),
(7, '368', 'IPC-Kidnap', '', '2023-05-21 19:56:04', '2023-05-21 19:56:04', 0),
(8, '369', 'IPC-Kidnap', '', '2023-05-21 19:56:14', '2023-05-21 19:56:14', 0),
(9, '370', 'IPC-Kidnap', '', '2023-05-21 19:56:22', '2023-05-21 19:56:22', 0),
(10, '374', 'IPC-Kidnap', '', '2023-05-21 19:56:31', '2023-05-21 19:56:31', 0),
(11, '376', 'IPC-Rape', '', '2023-05-21 19:56:45', '2023-05-21 19:56:45', 0),
(12, '377', 'IPC', '', '2023-05-21 19:57:01', '2023-05-21 19:57:01', 0),
(13, '392', 'IPC-Robbery', '', '2023-05-21 19:57:27', '2023-05-21 19:57:27', 0),
(14, '393', 'IPC-Robbery', '', '2023-05-21 19:57:34', '2023-05-21 19:57:34', 0),
(15, '394', 'IPC-Robbery', '', '2023-05-21 19:57:39', '2023-05-21 19:57:39', 0),
(16, '395', 'IPC-Dacoity', '', '2023-05-21 19:57:48', '2023-05-21 19:57:48', 0),
(17, '396', 'IPC-Dacoity', '', '2023-05-21 19:57:57', '2023-05-21 19:57:57', 0),
(18, '397', 'IPC-Dacoity', '', '2023-05-21 19:58:02', '2023-05-21 19:58:02', 0),
(19, '398', 'IPC-Dacoity', '', '2023-05-21 19:58:06', '2023-05-21 19:58:06', 0),
(20, '376D', 'IPC-Gangrape', 'Where a woman is raped by one or more persons constituting a group or acting in furtherance of a common intention, each of those persons1 shall be deemed to have committed the offence of rape and shall be punished with rigorous imprisonment for a term which shall not be less than twenty years, but which may extend to life which shall mean imprisonment for the remainder of that person’s natural life, and with fine;', '2023-05-21 19:56:45', '2023-05-21 19:56:45', 0),
(21, '364A', 'IPC-Kidnapforransom', '', '2023-05-24 18:43:19', '2023-05-24 18:43:19', 0),
(22, 'आब. एक्ट', 'Minor-Act', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(23, 'जुआ एक्ट', 'Minor-Act', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(24, 'सट्टा', 'Minor-Act', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(25, 'नारको', 'Minor-Act', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(26, 'आर्म्स. एक्ट', 'Minor-Act', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(28, '107,116 जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(29, '151 जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(30, '145 जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(31, '110 जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(32, '109 जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(33, '102 जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(34, '41(1) जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(35, '41(2) जा. फौ', 'Restricted', '', '2023-05-25 00:14:12', '2023-05-25 00:14:12', 0),
(36, 'एम. वी. एक्ट', 'Minor-Act', '', '0000-00-00 00:00:00', '2023-05-25 18:30:18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penal_codes`
--
ALTER TABLE `penal_codes`
  ADD PRIMARY KEY (`pcid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penal_codes`
--
ALTER TABLE `penal_codes`
  MODIFY `pcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
