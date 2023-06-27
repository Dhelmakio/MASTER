-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amigo_registry`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants_child`
--

CREATE TABLE `applicants_child` (
  `child_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `child_name` text NOT NULL,
  `child_dob` date NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_child`
--

INSERT INTO `applicants_child` (`child_id`, `applicant_code`, `child_name`, `child_dob`, `date_encoded`) VALUES
(16, 'AMG0010000004', 'dhelmark', '2023-06-19', '2023-06-19'),
(17, 'AMG0010000004', 'yes', '2023-06-19', '2023-06-19'),
(18, 'AMG0010000008', 'a', '2023-06-19', '2023-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `applicants_personal`
--

CREATE TABLE `applicants_personal` (
  `applicant_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `suffix` text NOT NULL,
  `nickname` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `contact1` text NOT NULL,
  `mstatus` text NOT NULL,
  `dob1` date NOT NULL,
  `pob1` text NOT NULL,
  `block1` text NOT NULL,
  `street1` text NOT NULL,
  `phase1` text NOT NULL,
  `brgy1` text NOT NULL,
  `city1` text NOT NULL,
  `province1` text NOT NULL,
  `map_url` text NOT NULL,
  `residence1` text NOT NULL,
  `lwith1` text NOT NULL,
  `block2` text NOT NULL,
  `street2` text NOT NULL,
  `phase2` text NOT NULL,
  `brgy2` text NOT NULL,
  `city2` text NOT NULL,
  `province2` text NOT NULL,
  `residence2` text NOT NULL,
  `lwith2` text NOT NULL,
  `mothername` text NOT NULL,
  `mothercon` text NOT NULL,
  `fathername` text NOT NULL,
  `fathercon` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_personal`
--

INSERT INTO `applicants_personal` (`applicant_id`, `applicant_code`, `firstname`, `middlename`, `lastname`, `suffix`, `nickname`, `age`, `gender`, `contact1`, `mstatus`, `dob1`, `pob1`, `block1`, `street1`, `phase1`, `brgy1`, `city1`, `province1`, `map_url`, `residence1`, `lwith1`, `block2`, `street2`, `phase2`, `brgy2`, `city2`, `province2`, `residence2`, `lwith2`, `mothername`, `mothercon`, `fathername`, `fathercon`, `date_encoded`) VALUES
(37, 'AMG0010000001', 'test', 'test', 'test', 'test', 'test', '23', 'Male', '09999999999', 'Single', '2023-06-15', 'san isidro', 'test', 'test', 'test', 'test', 'test', 'test', '11.075604, 124.690768', 'Owned', 'Parents', 'test', 'test', 'test', 'test', 'test', 'test', 'Owned', 'Parents', 'test', '09999999999', 'test', '09999999999', '2023-06-15'),
(39, 'AMG0010000003', 'test', 'test', 'Single', '23', 'test', '23', 'Male', '09999999999', 'Single', '2023-06-15', '', 'test', 'test', 'test', 'test', 'test', 'test', '11.075604, 124.690768', 'Owned', 'Relatives', 'test', 'test', 'test', 'test', 'test', 'test', 'Owned', 'Relatives', 'test', '09999999999', 'test', '09999999999', '2023-06-15'),
(40, 'AMG0010000004', 'dhel', 'S.', 'baylon', 'jr', 'dhel', '23', 'Male', '09999999999', 'Married', '2023-06-19', 'AURORA', 'asd', 'sitio capangian', 'asdas', 'ILANG-ILANG', 'GUIGUINTO', 'BULACAN', '11.075604, 124.690768', 'boarding', 'boarders', 'asd', 'sitio capangian', 'asdas', 'ILANG-ILANG', 'GUIGUINTO', 'BULACAN', 'boarding', 'boarders', 'test', '09999999999', 'asd', '09777555331', '2023-06-19'),
(41, 'AMG0010000005', 'a', 'A', 'a', '', '', '', '', '1', '', '0000-00-00', ', ', 'a', 'a', '1', 'DITAWINI', 'DINALUNGAN', 'AURORA', '11.075604, 124.690768', 'aa', 'aa', 'a', 'a', '1', 'DITAWINI', 'DINALUNGAN', 'AURORA', 'aa', 'aa', '', '', '', '', '2023-06-19'),
(42, 'AMG0010000006', 'a', 'a', 'a', '', '', '', '', '11', '', '0000-00-00', ', ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2023-06-19'),
(43, 'AMG0010000007', 'a', 'a', 'a', 'a', '', '', '', '11', '', '2023-06-19', 'PAMPANGA, CANDABA', 'a', 'a', 'a', 'SAN NICOLAS (POB.)', 'MASANTOL', 'PAMPANGA', '11.075604, 124.690768', 'a', 'a', 'a', 'a', 'a', 'SAN NICOLAS (POB.)', 'MASANTOL', 'PAMPANGA', 'a', 'a', 'a', '1', 'a', '1', '2023-06-19'),
(44, 'AMG0010000008', 'a', 'a', 'a', 'a', 'a', '12', 'Female', '111111111', 'Married', '2023-06-19', 'PAMPANGA, SAN LUIS', 'a', 'a', 'a', 'LICIADA', 'BUSTOS', 'BULACAN', '11.075604, 124.690768', 'aaaaaa', 'aaaaaaa', 'a', 'a', 'a', 'LICIADA', 'BUSTOS', 'BULACAN', 'aaaaaa', 'aaaaaaa', 'a', '1', 'a', '1', '2023-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `applicants_reference`
--

CREATE TABLE `applicants_reference` (
  `reference_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `source` text NOT NULL,
  `loan_purpose` text NOT NULL,
  `fb_acct` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_reference`
--

INSERT INTO `applicants_reference` (`reference_id`, `applicant_code`, `source`, `loan_purpose`, `fb_acct`, `date_encoded`) VALUES
(31, 'AMG0010000001', 'Facebook', '', '', '2023-06-15'),
(33, 'AMG0010000003', 'Facebook', '', '', '2023-06-15'),
(34, 'AMG0010000004', 'marites', 'pay bills', 'dhelmark@facebook.com', '2023-06-19'),
(35, 'AMG0010000005', 'a', 'a', 'a', '2023-06-19'),
(36, 'AMG0010000006', 'aa', 'aa', 'aa', '2023-06-19'),
(37, 'AMG0010000007', 'aa', 'aa', 'aa', '2023-06-19'),
(38, 'AMG0010000008', 'aaaaaaa', 'aaaa', '111111', '2023-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `applicants_relative`
--

CREATE TABLE `applicants_relative` (
  `relative_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `relative_name` text NOT NULL,
  `r_contact` text NOT NULL,
  `r_relationship` text NOT NULL,
  `r_ta` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_relative`
--

INSERT INTO `applicants_relative` (`relative_id`, `applicant_code`, `relative_name`, `r_contact`, `r_relationship`, `r_ta`, `date_encoded`) VALUES
(23, 'AMG0010000001', 'test', '09999999999', 'test', '09:51', '0000-00-00'),
(26, 'AMG0010000003', 'tes', '09999999999', 'test', '10:36', '0000-00-00'),
(27, 'AMG0010000004', 'dhelmark', '09999999999', 'friend', '12:50', '0000-00-00'),
(28, 'AMG0010000005', 'a', '1', 'a', '13:06', '0000-00-00'),
(29, 'AMG0010000006', 'aa', '11', 'aa', '13:11', '0000-00-00'),
(30, 'AMG0010000007', 'aa', '122', 'aa', '13:14', '0000-00-00'),
(31, 'AMG0010000008', 'aa', '1111', 'aaa', '13:19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `applicants_spouse`
--

CREATE TABLE `applicants_spouse` (
  `spouse_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `spouse_name` text NOT NULL,
  `contact` text NOT NULL,
  `s_dob` date NOT NULL,
  `s_pob` text NOT NULL,
  `s_address` text NOT NULL,
  `s_occupation` text NOT NULL,
  `s_company` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_spouse`
--

INSERT INTO `applicants_spouse` (`spouse_id`, `applicant_code`, `spouse_name`, `contact`, `s_dob`, `s_pob`, `s_address`, `s_occupation`, `s_company`, `date_encoded`) VALUES
(25, 'AMG0010000004', 'denise', '09999999999', '2023-06-19', 'BATAAN', 'NUEVA ECIJA', 'test', 'test', '2023-06-19'),
(26, 'AMG0010000008', 'a', '1', '2023-06-19', 'AURORA, DILASAG', 'PAMPANGA, MINALIN,SAN FRANCISCO 2ND', 'a', 'a', '2023-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `applicants_work`
--

CREATE TABLE `applicants_work` (
  `work_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `employer` text NOT NULL,
  `sector_type` text NOT NULL,
  `tob` text NOT NULL,
  `com_address` text NOT NULL,
  `a_location` text NOT NULL,
  `sup_name` text NOT NULL,
  `hr_number` text NOT NULL,
  `date_hired` date NOT NULL,
  `e_status` text NOT NULL,
  `m_salary` text NOT NULL,
  `bank_name` text NOT NULL,
  `atm_card` text NOT NULL,
  `loan` text NOT NULL,
  `monthly_salary` text NOT NULL,
  `s_period` text NOT NULL,
  `other_source` text NOT NULL,
  `specify` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_work`
--

INSERT INTO `applicants_work` (`work_id`, `applicant_code`, `employer`, `sector_type`, `tob`, `com_address`, `a_location`, `sup_name`, `hr_number`, `date_hired`, `e_status`, `m_salary`, `bank_name`, `atm_card`, `loan`, `monthly_salary`, `s_period`, `other_source`, `specify`, `date_encoded`) VALUES
(37, 'AMG0010000001', 'vincci', 'Private Sector', 'test', 'test', 'test', 'test', '09999999999', '2023-06-15', 'Regular', 'Cash', 'test', 'credit card', 'No', '80000', '6/21', 'test', 'test', '2023-06-15'),
(39, 'AMG0010000003', 'vincci', 'Private Sector', 'test', 'test', 'test', 'dadsd', '09999999999', '2023-06-15', 'Regular', 'Cash', 'test', 'credit card', 'No', '222222222', '5/20', 'test', 'test', '2023-06-15'),
(40, 'AMG0010000004', 'vincci gayo', 'Government Sector', 'business', 'sadas', 'cogon', 'dadsd', '', '0000-00-00', '', 'Cash', 'bpi', 'credit card', 'No', '24000', 'Weekly (Every Friday)', 'test', 'test', '2023-06-19'),
(41, 'AMG0010000005', 'a', 'Private Sector', 'a', 'a', 'a', 'a', '1', '2023-06-19', 'Regular', 'ATM', 'a', 'a', 'a', '22222222', '8/23', 'a', 'a', '2023-06-19'),
(42, 'AMG0010000006', 'a', 'Private Sector', '', '', '', '', '', '0000-00-00', '', '', '', '', 'aa', '', '', '', '', '2023-06-19'),
(43, 'AMG0010000007', 'a', 'Private Sector', 'aa', 'a', '', '', '', '0000-00-00', 'Regular', 'Cash', 'a', 'a', 'aa2', '22333', '15/30', 'aa', 'aa', '2023-06-19'),
(44, 'AMG0010000008', 'a', 'Private Sector', 'a', 'a', 'a', 'a', '1', '2023-06-19', 'Regular', 'ATM', 'a', 'a', 'aaaaaaaaa', '1222', '8/23', 'aaa', 'aa', '2023-06-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants_child`
--
ALTER TABLE `applicants_child`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `applicants_personal`
--
ALTER TABLE `applicants_personal`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `applicants_reference`
--
ALTER TABLE `applicants_reference`
  ADD PRIMARY KEY (`reference_id`);

--
-- Indexes for table `applicants_relative`
--
ALTER TABLE `applicants_relative`
  ADD PRIMARY KEY (`relative_id`);

--
-- Indexes for table `applicants_spouse`
--
ALTER TABLE `applicants_spouse`
  ADD PRIMARY KEY (`spouse_id`);

--
-- Indexes for table `applicants_work`
--
ALTER TABLE `applicants_work`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants_child`
--
ALTER TABLE `applicants_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `applicants_personal`
--
ALTER TABLE `applicants_personal`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `applicants_reference`
--
ALTER TABLE `applicants_reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `applicants_relative`
--
ALTER TABLE `applicants_relative`
  MODIFY `relative_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `applicants_spouse`
--
ALTER TABLE `applicants_spouse`
  MODIFY `spouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `applicants_work`
--
ALTER TABLE `applicants_work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
