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
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `coid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `fid` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `major_crimes`
--

CREATE TABLE `major_crimes` (
  `cid` int(11) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL COMMENT '0 - Pending\r\n1- Disposed',
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `crime_number` varchar(255) NOT NULL,
  `penal_code` varchar(255) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `applicant_address` text NOT NULL,
  `incident_date` date DEFAULT NULL,
  `incident_time` time DEFAULT NULL,
  `incident_place` text NOT NULL,
  `reporting_date` date DEFAULT NULL,
  `reporting_time` time DEFAULT NULL,
  `fir_writer` varchar(255) NOT NULL,
  `culprit_name` varchar(255) NOT NULL,
  `culprit_address` varchar(255) NOT NULL,
  `arrest_date` date DEFAULT NULL,
  `arrest_time` time DEFAULT NULL,
  `victim_name` varchar(255) NOT NULL,
  `description_of_crime` text NOT NULL,
  `is_major_crime` int(1) NOT NULL,
  `disposal_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major_crimes`
--

INSERT INTO `major_crimes` (`cid`, `updated_by`, `created_at`, `updated_at`, `status`, `district`, `sub_division`, `police_station`, `crime_number`, `penal_code`, `applicant_name`, `applicant_address`, `incident_date`, `incident_time`, `incident_place`, `reporting_date`, `reporting_time`, `fir_writer`, `culprit_name`, `culprit_address`, `arrest_date`, `arrest_time`, `victim_name`, `description_of_crime`, `is_major_crime`, `disposal_date`) VALUES
(1, 'abcd', '2023-05-16 10:54:46', '2023-05-16 10:54:46', 0, 'सरगुजा', 'Option1', 'दरिमा', '279/23', '379 Bhadvi', 'Shammim Ahmed / Khalil Ahmed / 52 years', 'Rasulpur  Thana Kotwali ', '2023-05-07', '09:30:00', ' Near by Indravatika  Ambikapur', '2023-05-08', '13:20:00', 'Mr. Srujanram Porte', 'Unknown', 'Unknown ', '2023-05-16', '16:23:00', '', 'stolen bike worth 5000/-', 0, '2023-05-15 07:20:54'),
(2, 'abcd', '2023-05-16 11:12:21', '2023-05-16 11:12:21', 0, 'सरगुजा', 'Option1', 'सीतापुर', ' 94/23', ' 294, 506,323', 'आलोक गिरी पिता बुटट्टु गिरी उम्र 30', 'सा. केपी बतास पहाड़ी अ.पुर कोतवाली', '2023-05-08', '16:31:00', 'ग्राम विशुनपुर ', '2023-05-08', '20:05:00', 'सउनि शशि प्रभा दास', ' पिन्टु गिरी पिता केश्वरव गिरी उम्र 35', 'विशुनपुर जंगल पारा', NULL, NULL, '', 'मां बहन की गंदी गंदी गुप्ता कर जान से मारने की धमकी देते मारपीट करने पर से।', 0, NULL),
(3, 'abcd', '2023-05-16 11:19:12', '2023-05-16 11:19:12', 0, 'सरगुजा', 'Option1', 'लखनपुर', '19/23', '304', 'लाल मोहन पण्डो पिता स्व. सोन', 'ग्राम सिगीटाना ', '2023-05-08', '11:00:00', 'ग्राम सिगीटाना ', '2023-05-08', '12:40:00', ' प्र.आर. 425', 'ट्रक क्र. सीजी 04 सीडब्लू 7545 का चालक', 'Unknown ', NULL, NULL, '', 'आरोपी द्वारा तेन परापूर्वक वाहन चलाकर सायकल सदार व्यक्ति को टोकर मारकर एक्सीडेन्ट कर पोत करने पर से।\\r\\n', 0, NULL),
(4, 'abcd', '2023-05-16 11:26:09', '2023-05-16 11:26:09', 0, 'सरगुजा', 'Option1', 'मणिपुर\\r\\n', '53/23', '379', 'पंकज कुमार सिंह पिता पिताम्बर सिंह उम्र 22', 'सा. कोटमी', '2023-05-07', '10:46:00', 'जिला अस्प. अ.', '2023-05-08', '08:54:00', 'प्र.आर. मनोज', 'Unkown', '', NULL, NULL, '', 'अज्ञात चोर के द्वारा मोटर सायकल चोरी कर ले जाने पर से।\\r\\n', 0, NULL),
(5, 'abcd', '2023-05-16 12:09:01', '2023-05-16 12:09:01', 0, 'सूरजपुर', 'Option1', 'चांदनी', '41/23', '363', 'Mansingh', 'Chandani', '2023-05-07', '17:38:00', 'Gram- Kachiya', '2023-05-08', '17:37:00', 'Manager Kurre', 'Unkown', '', NULL, NULL, '', 'Nablik Ladki Ko Bahla Fusla kr Bhaga le jana.', 1, NULL),
(6, 'abcd', '2023-05-16 12:15:40', '2023-05-16 12:15:40', 0, 'सूरजपुर', 'Option1', 'रामनुजनगर', '68/23', '366, 376(2D) , 376 , 313, Pasco act  section 6', 'Pidita hi Prarthi hai', 'Can\\\'t Disclose', '2022-04-20', '17:41:00', 'Sariya para', '2023-05-08', '18:42:00', 'Anita Prabha Minj', 'Dhanshwar/ S.O. Muneshwar/ 25Y', 'Salka Thana Udhaypur', NULL, NULL, 'Pidita hi Prarthi hai', 'Nabalik Ldki Ko Bahla Pusla kr ,Bhagakr Sadi Ka Jhansha Dekar Jabarn Balatkatr krne per Garbh Dhane per ,Garbhpaath Krna.', 1, NULL),
(7, 'abcd', '2023-05-16 12:19:38', '2023-05-16 12:19:38', 0, 'बलरामपुर', 'Option1', 'बसंतपुर', '62/23', '376, 506', 'Mahila Pidita', 'Can\\\'t Disclose', '2022-10-05', '17:48:00', 'Korva para  Jangle', '2023-05-08', '18:48:00', 'Sukhen Singh', 'Anil Korwa', 'Basantpur', NULL, NULL, 'Mahila pidita', 'Sadi ka Jhansa dekhr Dara Dhmka kr Jabarjasti balatkar krna.', 1, NULL),
(8, 'abcd', '2023-05-16 12:24:26', '2023-05-16 12:24:26', 0, 'बलरामपुर', 'Option1', 'बसंतपुर', '61/23', '376,341, section4,6 Pasco act', 'Nabalic Pidita', 'Can\\\'t Disclose', '2023-04-06', '18:52:00', 'Syahi main Patra Jangle', '2023-05-08', '18:52:00', 'R.N. Patel', '1. Akhilesh thakur 2. Ramjanak thakar ka damad', 'Ghagharara UP', NULL, NULL, 'Nabalic ke sath Apradh', 'Nabalic Ldki Ko Raste Per Rok Kr Balatkar krna.', 1, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `ongoing_cases`
--

CREATE TABLE `ongoing_cases` (
  `ocid` int(11) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `crime_number` varchar(255) NOT NULL,
  `penal_code` varchar(255) NOT NULL,
  `fir_date` date NOT NULL,
  `culprit_name` varchar(255) NOT NULL,
  `case_status` varchar(255) NOT NULL,
  `name_of_court` text NOT NULL,
  `culprit_address` text NOT NULL,
  `judgement_of_court` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `police_stations`
--

CREATE TABLE `police_stations` (
  `psid` int(11) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `sub_division` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_stations`
--

INSERT INTO `police_stations` (`psid`, `police_station`, `sub_division`, `district`, `created_at`, `updated_at`, `status`) VALUES
(1, 'दरिमा', 'Option1', 'सरगुजा', '2023-04-12 15:03:29', '2023-04-12 15:03:29', 0),
(2, 'उदयपुर', 'Option1', 'सरगुजा', '2023-04-12 15:04:13', '2023-04-12 15:04:13', 0),
(3, 'लखनपुर', 'Option1', 'सरगुजा', '2023-04-12 15:06:09', '2023-04-12 15:06:09', 0),
(4, 'अंबिकापुर', 'Option1', 'सरगुजा', '2023-04-12 15:06:42', '2023-04-12 15:06:42', 0),
(5, 'गांधीनगर', 'Option1', 'सरगुजा', '2023-04-12 15:06:59', '2023-04-12 15:06:59', 0),
(6, 'सीतापुर', 'Option1', 'सरगुजा', '2023-04-12 15:07:14', '2023-04-12 15:07:14', 0),
(7, 'बटौली', 'Option1', 'सरगुजा', '2023-04-12 15:07:33', '2023-04-12 15:07:33', 0),
(8, 'मैनपाट', 'Option1', 'सरगुजा', '2023-04-12 15:08:21', '2023-04-12 15:08:21', 0),
(9, 'लुंड्रा', 'Option1', 'सरगुजा', '2023-04-12 15:09:40', '2023-04-12 15:09:40', 0),
(10, 'धौरपुर', 'Option1', 'सरगुजा', '2023-04-12 15:12:07', '2023-04-12 15:12:07', 0),
(11, 'अजक', 'Option1', 'सरगुजा', '2023-04-12 15:13:05', '2023-04-12 15:13:05', 0),
(12, ' भटगाव', 'Option1', 'सूरजपुर', '2023-04-12 15:16:21', '2023-04-12 15:16:21', 0),
(13, 'चांदनी', 'Option1', 'सूरजपुर', '2023-04-12 15:16:32', '2023-04-12 15:16:32', 0),
(14, 'चंदौरा', 'Option1', 'सूरजपुर', '2023-04-12 15:18:16', '2023-04-12 15:18:16', 0),
(15, 'जयनगर', 'Option1', 'सूरजपुर', '2023-04-12 15:23:31', '2023-04-12 15:23:31', 0),
(16, 'झिल्मिली', 'Option1', 'सूरजपुर', '2023-04-12 15:23:56', '2023-04-12 15:23:56', 0),
(17, 'उड़ागी', 'Option1', 'सूरजपुर', '2023-04-12 15:24:14', '2023-04-12 15:24:14', 0),
(18, 'प्रतापपुर', 'Option1', 'सूरजपुर', '2023-04-12 15:24:26', '2023-04-12 15:24:26', 0),
(19, 'प्रेमनगर', 'Option1', 'सूरजपुर', '2023-04-12 15:24:45', '2023-04-12 15:24:45', 0),
(20, 'रामनुजनगर', 'Option1', 'सूरजपुर', '2023-04-12 15:24:57', '2023-04-12 15:24:57', 0),
(21, 'रामकोला', 'Option1', 'सूरजपुर', '2023-04-12 15:25:08', '2023-04-12 15:25:08', 0),
(22, 'सूरजपुर', 'Option1', 'सूरजपुर', '2023-04-12 15:25:18', '2023-04-12 15:25:18', 0),
(23, 'जशपुर', 'Option1', 'जशपुर', '2023-04-12 15:56:57', '2023-04-12 15:56:57', 0),
(24, 'आस्ता', 'Option1', 'जशपुर', '2023-04-12 15:57:19', '2023-04-12 15:57:19', 0),
(25, 'बागबहार', 'Option1', 'जशपुर', '2023-04-12 15:57:40', '2023-04-12 15:57:40', 0),
(26, 'बगीचा', 'Option1', 'जशपुर', '2023-04-12 15:57:53', '2023-04-12 15:57:53', 0),
(27, 'दुलदुला', 'Option1', 'जशपुर', '2023-04-12 15:58:06', '2023-04-12 15:58:06', 0),
(28, 'फरसाबहार', 'Option1', 'जशपुर', '2023-04-12 15:58:20', '2023-04-12 15:58:20', 0),
(29, 'कांसाबेल', 'Option1', 'जशपुर', '2023-04-12 15:58:31', '2023-04-12 15:58:31', 0),
(30, 'कुनकुरी', 'Option1', 'जशपुर', '2023-04-12 15:58:43', '2023-04-12 15:58:43', 0),
(31, 'नारायणपुर', 'Option1', 'जशपुर', '2023-04-12 15:58:56', '2023-04-12 15:58:56', 0),
(32, 'पत्थलगांव', 'Option1', 'जशपुर', '2023-04-12 15:59:07', '2023-04-12 15:59:07', 0),
(33, 'सन्ना', 'Option1', 'जशपुर', '2023-04-12 15:59:29', '2023-04-12 15:59:29', 0),
(34, 'तपकारा', 'Option1', 'जशपुर', '2023-04-12 15:59:52', '2023-04-12 15:59:52', 0),
(35, 'तुमला', 'Option1', 'जशपुर', '2023-04-12 16:00:06', '2023-04-12 16:00:06', 0),
(49, 'नारायणपुर', 'Option1', 'कोरिया', '2023-04-12 16:21:12', '2023-04-12 16:21:12', 0),
(50, 'चरचा', 'Option1', 'कोरिया', '2023-04-12 16:21:12', '2023-04-12 16:21:12', 0),
(51, 'पटना', 'Option1', 'कोरिया', '2023-04-12 16:21:12', '2023-04-12 16:21:12', 0),
(52, 'सोनहत', 'Option1', 'कोरिया', '2023-04-12 16:21:12', '2023-04-12 16:21:12', 0),
(55, 'रामगढ़', 'Option1', 'कोरिया', '2023-04-12 16:22:18', '2023-04-12 16:22:18', 0),
(56, 'महेंद्रगढ़ ', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:28:44', '2023-04-12 16:28:44', 0),
(57, 'झगराखाड़', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:28:44', '2023-04-12 16:28:44', 0),
(58, 'कैल्हरी', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:28:44', '2023-04-12 16:28:44', 0),
(59, 'जनकपुर', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:29:28', '2023-04-12 16:29:28', 0),
(60, 'कुँवरपुर', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:29:28', '2023-04-12 16:29:28', 0),
(61, 'कोड़ा', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:29:28', '2023-04-12 16:29:28', 0),
(62, 'कोटाडोल', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:30:06', '2023-04-12 16:30:06', 0),
(63, 'खोंगापानी', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:30:06', '2023-04-12 16:30:06', 0),
(64, 'चिरमीरी', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:30:06', '2023-04-12 16:30:06', 0),
(65, 'पोड़ी', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:38:01', '2023-04-12 16:38:01', 0),
(66, 'खडगांवा', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:38:01', '2023-04-12 16:38:01', 0),
(67, 'भरतपुर', 'Option1', 'मनेंद्रगढ़-चिरमीरी-भरतपुर', '2023-04-12 16:38:01', '2023-04-12 16:38:01', 0),
(71, 'अजाक', 'Option1', 'कोरिया', '2023-05-14 09:02:54', '2023-05-14 09:02:54', 0),
(72, 'बलरामपुर', 'Option1', 'बलरामपुर', '2023-05-16 08:03:26', '2023-05-16 08:03:26', 0),
(73, 'पस्ता', 'Option1', 'बलरामपुर', '2023-05-16 08:04:17', '2023-05-16 08:04:17', 0),
(74, 'रामानुजगंज', 'Option1', 'बलरामपुर', '2023-05-16 08:04:30', '2023-05-16 08:04:30', 0),
(75, 'रामचंद्रपुर', 'Option1', 'बलरामपुर', '2023-05-16 08:06:10', '2023-05-16 08:06:10', 0),
(76, 'त्रिंकुउा', 'Option1', 'बलरामपुर', '2023-05-16 08:08:49', '2023-05-16 08:08:49', 0),
(77, 'बसंतपुर', 'Option1', 'बलरामपुर', '2023-05-16 08:10:03', '2023-05-16 08:10:03', 0),
(78, 'रघुनाथनगर', 'Option1', 'बलरामपुर', '2023-05-16 08:10:16', '2023-05-16 08:10:16', 0),
(79, 'चलगली', 'Option1', 'बलरामपुर', '2023-05-16 08:10:30', '2023-05-16 08:10:30', 0),
(80, 'सनावल', 'Option1', 'बलरामपुर', '2023-05-16 08:10:55', '2023-05-16 08:10:55', 0),
(81, 'शंकरगढ़', 'Option1', 'बलरामपुर', '2023-05-16 08:12:12', '2023-05-16 08:12:12', 0),
(82, 'कुसमी', 'Option1', 'बलरामपुर', '2023-05-16 08:12:26', '2023-05-16 08:12:26', 0),
(83, 'करौंधा', 'Option1', 'बलरामपुर', '2023-05-16 08:12:38', '2023-05-16 08:12:38', 0),
(84, 'राजपुर', 'Option1', 'बलरामपुर', '2023-05-16 08:12:53', '2023-05-16 08:12:53', 0),
(85, 'सामरीपाठ', 'Option1', 'बलरामपुर', '2023-05-16 08:13:18', '2023-05-16 08:13:18', 0),
(86, 'चांदो', 'Option1', 'बलरामपुर', '2023-05-16 08:13:36', '2023-05-16 08:13:36', 0),
(87, 'अजाक', 'Option1', 'बलरामपुर', '2023-05-16 08:13:58', '2023-05-16 08:13:58', 0),
(88, 'मणिपुर', 'Option1', 'सरगुजा', '2023-04-12 15:13:05', '2023-04-12 15:13:05', 0);

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
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`coid`);

--
-- Indexes for table `court_judgements`
--
ALTER TABLE `court_judgements`
  ADD PRIMARY KEY (`cjid`);

--
-- Indexes for table `dead_bodies`
--
ALTER TABLE `dead_bodies`
  ADD PRIMARY KEY (`dbid`),
  ADD UNIQUE KEY `dead_body_number` (`dead_body_number`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `important_achievements`
--
ALTER TABLE `important_achievements`
  ADD PRIMARY KEY (`iaid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `major_crimes`
--
ALTER TABLE `major_crimes`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `crime_number` (`crime_number`);

--
-- Indexes for table `minor_crimes`
--
ALTER TABLE `minor_crimes`
  ADD PRIMARY KEY (`mcid`);

--
-- Indexes for table `ongoing_cases`
--
ALTER TABLE `ongoing_cases`
  ADD PRIMARY KEY (`ocid`);

--
-- Indexes for table `penal_codes`
--
ALTER TABLE `penal_codes`
  ADD PRIMARY KEY (`pcid`);

--
-- Indexes for table `police_stations`
--
ALTER TABLE `police_stations`
  ADD PRIMARY KEY (`psid`);

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
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `coid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court_judgements`
--
ALTER TABLE `court_judgements`
  MODIFY `cjid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dead_bodies`
--
ALTER TABLE `dead_bodies`
  MODIFY `dbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `important_achievements`
--
ALTER TABLE `important_achievements`
  MODIFY `iaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `major_crimes`
--
ALTER TABLE `major_crimes`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `minor_crimes`
--
ALTER TABLE `minor_crimes`
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ongoing_cases`
--
ALTER TABLE `ongoing_cases`
  MODIFY `ocid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penal_codes`
--
ALTER TABLE `penal_codes`
  MODIFY `pcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `police_stations`
--
ALTER TABLE `police_stations`
  MODIFY `psid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
