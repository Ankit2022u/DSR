-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 10:18 AM
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
-- Table structure for table `important_actions`
--

CREATE TABLE `important_actions` (
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
  `action_taken_under` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `important_actions`
--

INSERT INTO `important_actions` (`iaid`, `updated_by`, `district`, `sub_division`, `police_station`, `arrest_in_major_crime`, `decision_given_by_the_court`, `missing_man_document`, `miscellaneous`, `robbery`, `action_taken_under`) VALUES
(1, 'ahvi', '', '', 'kjh bv srvsjkh', 'dsewuym jvs', 'fvewsfj sesuifes', 'efgehjs fce', 'fgweiyukf esffiuewf', 'fgewhiugbesr fgews', 'efgehwuf ewf'),
(2, 'userx', '', '', 'hello ', 'Guys', 'huhce udyfbviusr', 'vrsdjhg rfewsriufytew', 'verf se fewsriuyf n', 'grfghjkrfg f7e', 'fgewryf ewefu7ewi'),
(3, 'ahvi', '', '', 'fdgbgfdhcvb bdthg ', 'rtrhxtyerx', 'fdgerhgfx fdrhg', 'drfhgfcbb edryr', 'rhge45 rtuh', 'fdrh45shcvbn56 fgh', 'b fdthjtyhdd nntb fdryd e5t4t4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `important_actions`
--
ALTER TABLE `important_actions`
  ADD PRIMARY KEY (`iaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `important_actions`
--
ALTER TABLE `important_actions`
  MODIFY `iaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
