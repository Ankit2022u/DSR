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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `major_crimes`
--
ALTER TABLE `major_crimes`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `crime_number` (`crime_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `major_crimes`
--
ALTER TABLE `major_crimes`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
