-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 05:10 PM
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
-- Database: `amigo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `activity` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `user_id`, `name`, `activity`, `date_time`) VALUES
(1, 1, 'Kevin Fontanoza', 'Logged out', '2023-02-17 14:51:33'),
(2, 1, 'Kevin Fontanoza', 'Logged in', '2023-02-17 14:51:35'),
(3, 1, 'Kevin Fontanoza', 'Added new client: 1', '2023-02-17 14:52:39'),
(4, 1, 'Kevin Fontanoza', 'Added client information: 1', '2023-02-17 14:53:08'),
(5, 1, 'Kevin Fontanoza', 'Updated employment information of client: 1', '2023-02-17 14:53:57'),
(6, 1, 'Kevin Fontanoza', 'Added new client: 2', '2023-02-17 14:54:44'),
(7, 1, 'Kevin Fontanoza', 'Added client information: 2', '2023-02-17 14:55:01'),
(8, 1, 'Kevin Fontanoza', 'Updated employment information of client: 2', '2023-02-17 15:00:17'),
(9, 1, 'Kevin Fontanoza', 'Added new client: 3', '2023-02-17 15:02:34'),
(10, 1, 'Kevin Fontanoza', 'Added client information: 3', '2023-02-17 15:03:08'),
(11, 1, 'Kevin Fontanoza', 'Updated employment information of client: 3', '2023-02-17 15:04:32'),
(12, 1, 'Kevin Fontanoza', 'Added new client: 4', '2023-02-17 15:05:18'),
(13, 1, 'Kevin Fontanoza', 'Added client information: 4', '2023-02-17 15:05:37'),
(14, 1, 'Kevin Fontanoza', 'Updated employment information of client: 4', '2023-02-17 15:06:26'),
(15, 1, 'Kevin Fontanoza', 'Added new client: 5', '2023-02-17 15:06:54'),
(16, 1, 'Kevin Fontanoza', 'Added client information: 5', '2023-02-17 15:07:13'),
(17, 1, 'Kevin Fontanoza', 'Updated employment information of client: 5', '2023-02-17 15:07:57'),
(18, 1, 'Kevin Fontanoza', 'Added new client: 6', '2023-02-17 15:08:16'),
(19, 1, 'Kevin Fontanoza', 'Added client information: 6', '2023-02-17 15:08:35'),
(20, 1, 'Kevin Fontanoza', 'Updated employment information of client: 6', '2023-02-17 15:09:12'),
(21, 1, 'Kevin Fontanoza', 'Added new client: 7', '2023-02-17 15:09:50'),
(22, 1, 'Kevin Fontanoza', 'Added client information: 7', '2023-02-17 15:10:07'),
(23, 1, 'Kevin Fontanoza', 'Updated employment information of client: 7', '2023-02-17 15:10:28'),
(24, 1, 'Kevin Fontanoza', 'Added new client: 8', '2023-02-17 15:11:32'),
(25, 1, 'Kevin Fontanoza', 'Added client information: 8', '2023-02-17 15:11:46'),
(26, 1, 'Kevin Fontanoza', 'Updated employment information of client: 8', '2023-02-17 15:12:14'),
(27, 1, 'Kevin Fontanoza', 'Added loan application', '2023-02-17 15:18:45'),
(28, 1, 'Kevin Fontanoza', 'Added loan application', '2023-02-17 15:28:04'),
(29, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG202302080204317', '2023-02-17 15:28:22'),
(30, 1, 'Kevin Fontanoza', 'Approved CI', '2023-02-17 15:28:39'),
(31, 1, 'Kevin Fontanoza', 'Approved loan application: AMG202302080204317', '2023-02-17 15:28:49'),
(32, 1, 'Kevin Fontanoza', 'Added loan application', '2023-02-17 15:30:37'),
(33, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG202302080237317', '2023-02-17 15:30:57'),
(34, 1, 'Kevin Fontanoza', 'Approved CI', '2023-02-17 15:31:03'),
(35, 1, 'Kevin Fontanoza', 'Approved loan application: AMG202302080237317', '2023-02-17 15:31:23'),
(36, 1, 'Kevin Fontanoza', 'Added loan application', '2023-02-17 15:34:01'),
(37, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG202302080201417', '2023-02-17 15:34:18'),
(38, 1, 'Kevin Fontanoza', 'Approved CI', '2023-02-17 15:34:22'),
(39, 1, 'Kevin Fontanoza', 'Approved loan application: AMG202302080201417', '2023-02-17 15:34:26'),
(40, 1, 'Kevin Fontanoza', 'Added loan application', '2023-02-17 15:45:47'),
(41, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG202302080247417', '2023-02-17 16:02:45'),
(42, 1, 'Kevin Fontanoza', 'Approved CI', '2023-02-17 16:02:49'),
(43, 1, 'Kevin Fontanoza', 'Approved loan application: AMG202302080247417', '2023-02-17 16:03:00'),
(44, 1, 'Kevin Fontanoza', 'Added new client: 9', '2023-02-17 17:32:24'),
(45, 1, 'Kevin Fontanoza', 'Added client information: 9', '2023-02-17 17:32:41'),
(46, 1, 'Kevin Fontanoza', 'Updated employment information of client: 9', '2023-02-17 17:33:41'),
(47, 1, 'Kevin Fontanoza', 'Added loan application', '2023-02-17 17:41:35'),
(48, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG202302100235917', '2023-02-17 17:47:34'),
(49, 1, 'Kevin Fontanoza', 'Approved CI', '2023-02-17 17:50:24'),
(50, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-01 16:06:21'),
(51, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-13 15:52:03'),
(52, 1, 'Kevin Fontanoza', 'Approved loan application: AMG202302100235917', '2023-03-13 15:57:03'),
(53, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-17 00:09:29'),
(54, 1, 'Kevin Fontanoza', 'Added loan application', '2023-03-17 00:32:42'),
(55, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG202303050342116', '2023-03-17 00:44:20'),
(56, 1, 'Kevin Fontanoza', 'Approved CI', '2023-03-17 07:42:52'),
(57, 1, 'Kevin Fontanoza', 'Logged out', '2023-03-17 07:44:52'),
(58, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-17 07:56:26'),
(59, 1, 'Kevin Fontanoza', 'Logged out', '2023-03-17 08:09:23'),
(60, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-17 08:12:07'),
(61, 1, 'Kevin Fontanoza', 'Logged out', '2023-03-17 08:45:16'),
(62, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-17 08:45:29'),
(63, 1, 'Kevin Fontanoza', 'Added new client: 10', '2023-03-17 08:56:28'),
(64, 1, 'Kevin Fontanoza', 'Added client information: 10', '2023-03-17 08:59:27'),
(65, 1, 'Kevin Fontanoza', 'Updated employment information of client: 10', '2023-03-17 09:05:20'),
(66, 1, 'Kevin Fontanoza', 'Added loan application', '2023-03-17 09:21:00'),
(67, 1, 'Kevin Fontanoza', 'Answered Questionnaire: AMG2023030203001017', '2023-03-17 09:27:50'),
(68, 1, 'Kevin Fontanoza', 'Approved CI', '2023-03-17 09:31:07'),
(69, 1, 'Kevin Fontanoza', 'Added new client: 11', '2023-03-17 09:54:57'),
(70, 1, 'Kevin Fontanoza', 'Added client information: 11', '2023-03-17 09:56:57'),
(71, 1, 'Kevin Fontanoza', 'Updated employment information of client: 11', '2023-03-17 10:00:38'),
(72, 1, 'Kevin Fontanoza', 'Added loan application', '2023-03-17 10:05:49'),
(73, 1, 'Kevin Fontanoza', 'Approved loan application: AMG2023030203001017', '2023-03-17 11:13:23'),
(74, 1, 'Kevin Fontanoza', 'Rejected loan application: AMG202303050342116', '2023-03-17 11:15:30'),
(75, 1, 'Kevin Fontanoza', 'Added new client: 12', '2023-03-17 14:33:35'),
(76, 1, 'Kevin Fontanoza', 'Added client information: 12', '2023-03-17 14:33:52'),
(77, 1, 'Kevin Fontanoza', 'Updated employment information of client: 12', '2023-03-17 14:34:35'),
(78, 1, 'Kevin Fontanoza', 'Logged out', '2023-03-23 19:52:36'),
(79, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-23 19:52:42'),
(80, 1, 'Kevin Fontanoza', 'Logged out', '2023-03-23 19:56:12'),
(81, 1, 'Kevin Fontanoza', 'Logged in', '2023-03-23 20:03:22'),
(82, 1, 'Kevin Fontanoza', 'Added new client: 13', '2023-03-28 10:02:51'),
(83, 1, 'Kevin Fontanoza', 'Added client information: 13', '2023-03-28 10:03:19'),
(84, 1, 'Kevin Fontanoza', 'Logged in', '2023-04-03 09:29:57'),
(85, 1, 'Kevin Fontanoza', 'Logged in', '2023-04-03 09:46:08'),
(86, 1, 'Kevin Fontanoza', 'Added new client: 14', '2023-04-03 09:48:49'),
(87, 1, 'Kevin Fontanoza', 'Logged out', '2023-04-03 09:57:40'),
(88, 1, 'Kevin Fontanoza', 'Logged in', '2023-04-03 09:57:46'),
(89, 1, 'Kevin Fontanoza', 'Logged out', '2023-04-03 10:03:24'),
(90, 1, 'Kevin Fontanoza', 'Logged in', '2023-04-03 10:06:51'),
(91, 1, 'Kevin Fontanoza', 'Added new client: 15', '2023-04-03 11:19:07'),
(92, 1, 'Kevin Fontanoza', 'Added client information: 15', '2023-04-03 11:22:20'),
(93, 1, 'Kevin Fontanoza', 'Added new client: 16', '2023-04-03 11:24:35'),
(94, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-19 16:57:21'),
(95, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-21 09:08:46'),
(96, 1, 'Kevin Fontanoza', 'Logged out', '2023-06-21 09:29:14'),
(97, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-21 09:31:50'),
(98, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-21 09:32:38'),
(99, 1, 'Kevin Fontanoza', 'Logged out', '2023-06-21 09:34:28'),
(100, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-21 09:34:48'),
(101, 1, 'Kevin Fontanoza', 'Logged out', '2023-06-21 09:39:39'),
(102, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-21 09:39:53'),
(103, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-21 16:40:22'),
(104, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-23 10:18:59'),
(105, 1, 'Kevin Fontanoza', 'Added client information: ', '2023-06-23 11:02:22'),
(106, 1, 'Kevin Fontanoza', 'Logged out', '2023-06-26 19:16:28'),
(107, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-27 00:24:35'),
(108, 1, 'Kevin Fontanoza', 'Logged out', '2023-06-27 02:21:53'),
(109, 1, 'Kevin Fontanoza', 'Logged in', '2023-06-29 20:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `questionnaire_id` int(11) NOT NULL,
  `contract_no` text NOT NULL,
  `question1` varchar(9) DEFAULT NULL,
  `question2` varchar(9) DEFAULT NULL,
  `question3` varchar(9) DEFAULT NULL,
  `question4` varchar(9) DEFAULT NULL,
  `question5` varchar(9) DEFAULT NULL,
  `question6` varchar(9) DEFAULT NULL,
  `question7` varchar(9) DEFAULT NULL,
  `question8` varchar(9) DEFAULT NULL,
  `question9` varchar(9) DEFAULT NULL,
  `question10` varchar(10) DEFAULT NULL,
  `question11` varchar(10) DEFAULT NULL,
  `question12` varchar(10) DEFAULT NULL,
  `question13` varchar(10) DEFAULT NULL,
  `question14` varchar(10) DEFAULT NULL,
  `question15` varchar(10) DEFAULT NULL,
  `question16` varchar(10) DEFAULT NULL,
  `question17` varchar(10) DEFAULT NULL,
  `question18` varchar(10) DEFAULT NULL,
  `question19` varchar(10) DEFAULT NULL,
  `question20` varchar(10) DEFAULT NULL,
  `question21` varchar(10) DEFAULT NULL,
  `question22` varchar(10) DEFAULT NULL,
  `question23` varchar(10) DEFAULT NULL,
  `question24` varchar(10) DEFAULT NULL,
  `question25` varchar(10) DEFAULT NULL,
  `question26` varchar(10) DEFAULT NULL,
  `question27` varchar(10) DEFAULT NULL,
  `question28` varchar(10) DEFAULT NULL,
  `question29` varchar(10) DEFAULT NULL,
  `question30` varchar(10) DEFAULT NULL,
  `question31` varchar(10) DEFAULT NULL,
  `question32` varchar(10) DEFAULT NULL,
  `question33` varchar(10) DEFAULT NULL,
  `question34` varchar(10) DEFAULT NULL,
  `question35` varchar(10) DEFAULT NULL,
  `question36` varchar(10) DEFAULT NULL,
  `question37` varchar(10) DEFAULT NULL,
  `question38` varchar(10) DEFAULT NULL,
  `question39` varchar(10) DEFAULT NULL,
  `question40` varchar(10) DEFAULT NULL,
  `question41` varchar(10) DEFAULT NULL,
  `question42` varchar(10) DEFAULT NULL,
  `question43` varchar(10) DEFAULT NULL,
  `question44` varchar(10) DEFAULT NULL,
  `question45` varchar(10) DEFAULT NULL,
  `question46` varchar(10) DEFAULT NULL,
  `question47` varchar(10) DEFAULT NULL,
  `question48` varchar(10) DEFAULT NULL,
  `question49` varchar(10) DEFAULT NULL,
  `question50` varchar(10) DEFAULT NULL,
  `question51` varchar(10) DEFAULT NULL,
  `question52` varchar(10) DEFAULT NULL,
  `question53` varchar(10) DEFAULT NULL,
  `question54` varchar(10) DEFAULT NULL,
  `question55` varchar(10) DEFAULT NULL,
  `question56` varchar(10) DEFAULT NULL,
  `question57` varchar(10) DEFAULT NULL,
  `question58` varchar(10) DEFAULT NULL,
  `question59` varchar(10) DEFAULT NULL,
  `question60` varchar(10) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`questionnaire_id`, `contract_no`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `question11`, `question12`, `question13`, `question14`, `question15`, `question16`, `question17`, `question18`, `question19`, `question20`, `question21`, `question22`, `question23`, `question24`, `question25`, `question26`, `question27`, `question28`, `question29`, `question30`, `question31`, `question32`, `question33`, `question34`, `question35`, `question36`, `question37`, `question38`, `question39`, `question40`, `question41`, `question42`, `question43`, `question44`, `question45`, `question46`, `question47`, `question48`, `question49`, `question50`, `question51`, `question52`, `question53`, `question54`, `question55`, `question56`, `question57`, `question58`, `question59`, `question60`, `date`) VALUES
(1, 'AMG202302080204317', 'a1', 'a2', 'a3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'q22', 'q23', 'q24', 'q25', 'q26', 'q27', 'q28', 'q29', 'q30', 'q31', 'q32', 'q33', 'q34', 'q35', 'q36', 'q37', 'q38', 'q39', 'q40', 'q41', 'q42', 'q43', 'q44', 'q45', 'q46', 'q47', 'q48', 'q49', 'q50', 'q51', 'q52', 'q53', 'q54', 'q55', 'q56', 'q57', 'q58', 'q59', 'q60', '2023-02-17 15:28:22'),
(2, 'AMG202302080237317', 'a1', 'a2', 'a3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'q22', 'q23', 'q24', 'q25', 'q26', 'q27', 'q28', 'q29', 'q30', 'q31', 'q32', 'q33', 'q34', 'q35', 'q36', 'q37', 'q38', 'q39', 'q40', 'q41', 'q42', 'q43', 'q44', 'q45', 'q46', 'q47', 'q48', 'q49', 'q50', 'q51', 'q52', 'q53', 'q54', 'q55', 'q56', 'q57', 'q58', 'q59', 'q60', '2023-02-17 15:30:57'),
(3, 'AMG202302080201417', 'a1', 'a2', 'a3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'q22', 'q23', 'q24', 'q25', 'q26', 'q27', 'q28', 'q29', 'q30', 'q31', 'q32', 'q33', 'q34', 'q35', 'q36', 'q37', 'q38', 'q39', 'q40', 'q41', 'q42', 'q43', 'q44', 'q45', 'q46', 'q47', 'q48', 'q49', 'q50', 'q51', 'q52', 'q53', 'q54', 'q55', 'q56', 'q57', 'q58', 'q59', 'q60', '2023-02-17 15:34:18'),
(4, 'AMG202302080247417', 'a1', 'a2', 'a3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'q22', 'q23', 'q24', 'q25', 'q26', 'q27', 'q28', 'q29', 'q30', 'q31', 'q32', 'q33', 'q34', 'q35', 'q36', 'q37', 'q38', 'q39', 'q40', 'q41', 'q42', 'q43', 'q44', 'q45', 'q46', 'q47', 'q48', 'q49', 'q50', 'q51', 'q52', 'q53', 'q54', 'q55', 'q56', 'q57', 'q58', 'q59', 'q60', '2023-02-17 16:02:45'),
(5, 'AMG202302100235917', 'a1', 'a2', 'a3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'q22', 'q23', 'q24', 'q25', 'q26', 'q27', 'q28', 'q29', 'q30', 'q31', 'q32', 'q33', 'q34', 'q35', 'q36', 'q37', 'q38', 'q39', 'q40', 'q41', 'q42', 'q43', 'q44', 'q45', 'q46', 'q47', 'q48', 'q49', 'q50', 'q51', 'q52', 'q53', 'q54', 'q55', 'q56', 'q57', 'q58', 'q59', 'q60', '2023-02-17 17:47:34'),
(6, 'AMG202303050342116', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2023-03-17 00:44:20'),
(7, 'AMG2023030203001017', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2023-03-17 09:27:50');

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
(4, 'AMG0010000001', 'Nins', '2023-06-29', '2023-06-29');

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
  `file` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_personal`
--

INSERT INTO `applicants_personal` (`applicant_id`, `applicant_code`, `firstname`, `middlename`, `lastname`, `suffix`, `nickname`, `age`, `gender`, `contact1`, `mstatus`, `dob1`, `pob1`, `block1`, `street1`, `phase1`, `brgy1`, `city1`, `province1`, `map_url`, `residence1`, `lwith1`, `block2`, `street2`, `phase2`, `brgy2`, `city2`, `province2`, `residence2`, `lwith2`, `mothername`, `mothercon`, `fathername`, `fathercon`, `file`, `date_encoded`) VALUES
(4, 'AMG0010000001', 'June Simeone Elmer', 'Go', 'Ebcas', 'Jr.', 'Simsim', '', 'Male', '09924334454', 'Married', '2023-06-29', 'BATAAN, ORANI', 'Block 2', 'Million', 'Zone 69', 'BAGUTONG', 'FLORA', 'APAYAO', '11.013128996612425, 124.59931147662442', 'Owned', 'Wife/Husband/Live-in Partner', 'Block 2', 'Million', 'Zone 69', 'BAGUTONG', 'FLORA', 'APAYAO', 'Owned', 'Wife/Husband/Live-in Partner', 'Maricel Go Ebcas', '09457545454', 'Jose Elmer C. Ebcas', '09467673275', '', '2023-06-29');

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
(4, 'AMG0010000001', 'Leaflets', 'Pay Bills', 'facebook lang', '2023-06-29');

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
(4, 'AMG0010000001', 'Rogelio P. Ebcas', '0944564564', 'Grandfather', '23:09', '0000-00-00');

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
(4, 'AMG0010000001', 'Niña Rova Dejito-Ebcas', '09164574545', '2023-06-29', 'ALBAY, DARAGA (LOCSIN)', 'AGUSAN DEL SUR, LORETO, KATIPUNAN', 'Student', 'EVSU', '2023-06-29');

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
  `max_loanable_amt` float NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants_work`
--

INSERT INTO `applicants_work` (`work_id`, `applicant_code`, `employer`, `sector_type`, `tob`, `com_address`, `a_location`, `sup_name`, `hr_number`, `date_hired`, `e_status`, `m_salary`, `bank_name`, `atm_card`, `loan`, `monthly_salary`, `s_period`, `other_source`, `specify`, `max_loanable_amt`, `date_encoded`) VALUES
(4, 'AMG0010000001', 'City Hall', 'Government Sector', 'Technology', 'Cogon, Ormoc City', 'Cogon', 'Kevin Fontanoza', '09425454545', '2023-06-29', 'CASUAL', 'Cash', 'BPI', 'ATM Card', 'None actually. It\'s just a joke', '24000', 'Every 2nd Saturday', 'None', 'None to specify', 0, '2023-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `archive_child`
--

CREATE TABLE `archive_child` (
  `ar_child_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `child_name` text NOT NULL,
  `child_dob` date NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_personal`
--

CREATE TABLE `archive_personal` (
  `ar_personal_id` int(11) NOT NULL,
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
  `file` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_reference`
--

CREATE TABLE `archive_reference` (
  `ar_reference_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `source` text NOT NULL,
  `loan_purpose` text NOT NULL,
  `fb_acct` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_relative`
--

CREATE TABLE `archive_relative` (
  `ar_relative_id` int(11) NOT NULL,
  `relative_id` int(11) NOT NULL,
  `applicant_code` text NOT NULL,
  `relative_name` text NOT NULL,
  `r_contact` text NOT NULL,
  `r_relationship` text NOT NULL,
  `r_ta` text NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_spouse`
--

CREATE TABLE `archive_spouse` (
  `ar_spouse_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `archive_work`
--

CREATE TABLE `archive_work` (
  `ar_work_id` int(11) NOT NULL,
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
  `max_loanable_amt` float NOT NULL,
  `date_encoded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `pob` text NOT NULL,
  `mobile` text NOT NULL,
  `street` text NOT NULL,
  `brgy` text NOT NULL,
  `city` text NOT NULL,
  `province` text NOT NULL,
  `zipcode` int(11) NOT NULL,
  `res_status` text NOT NULL,
  `yrs_res` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_encoded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `gender`, `dob`, `pob`, `mobile`, `street`, `brgy`, `city`, `province`, `zipcode`, `res_status`, `yrs_res`, `status`, `date_encoded`) VALUES
(2, 'A2', 'A2', 'A2', '', 'M', '2000-03-02', 'ORMOC', '09688513053', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 4, 0, '2023-02-17 14:54:44'),
(3, 'A3', 'A3', 'A3', '', 'M', '1998-09-30', 'ALBUERA', '09688513053', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 14, 0, '2023-02-17 15:02:34'),
(4, 'A4', 'A4', 'A4', '', 'M', '1993-02-28', 'ORMOC CITY', '9950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 6, 0, '2023-02-17 15:05:18'),
(5, 'B1', 'B1', 'B1', '', 'M', '1995-12-31', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 4, 0, '2023-02-17 15:06:54'),
(6, 'B2', 'B2', 'B2', '', 'M', '2001-01-06', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 3, 0, '2023-02-17 15:08:16'),
(7, 'B3', 'B3', 'B3', '', 'M', '2000-02-20', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 4, 0, '2023-02-17 15:09:50'),
(8, 'B4', 'B4', 'B4', '', 'M', '1993-07-14', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 5, 0, '2023-02-17 15:11:32'),
(9, 'SAMPLE', 'SAMPLE', 'SAMPLE', '', 'M', '2000-01-01', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 3, 0, '2023-02-17 17:32:24'),
(10, 'FIRST', 'MIDDLE', 'LAST', '', 'M', '1992-02-11', 'PAMPANGA', '09955055555', 'BLOCK 4 LOT 40', 'DEL ROSARIO', 'SAN FERNANDO', 'PAMPANGA', 2000, 'OWNED', 2, 0, '2023-03-17 08:56:28'),
(11, 'LARRES BEA MAE', 'EULA', 'ASAYAS', '', 'F', '2001-11-17', 'PALO LEYTE', '09665610361', 'GAMMBOA BLDG', 'DEL ROSARIO', 'SAN FERNANDO', 'PAMPANGA', 2000, 'RENTED', 1, 0, '2023-03-17 09:54:57'),
(12, 'NEW', 'NEW', 'NEW', '', 'M', '1995-01-11', 'ORMOC', '09950003321', 'B', 'TIBAY', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 2, 0, '2023-03-17 14:33:35'),
(14, 'KEVIN', 'BUZON', 'FONTANOZA', '', 'M', '2023-04-03', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 1, 0, '2023-04-03 09:48:49'),
(16, 'SIM', 'GO', 'EBCAS', '', 'M', '2023-04-03', 'ORMOC CITY', '09950083505', 'BLK. 4 LOT 39 DECA HOMES', 'CONCEPCION', 'ORMOC CITY', 'LEYTE', 6541, 'OWNED', 1, 0, '2023-04-03 11:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE `client_info` (
  `client_info_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `mother_name` text NOT NULL,
  `mother_contact` text NOT NULL,
  `father_name` text NOT NULL,
  `father_contact` text NOT NULL,
  `living_with` text NOT NULL,
  `marital_status` text NOT NULL,
  `spouse_name` text NOT NULL,
  `spouse_contact` text NOT NULL,
  `spouse_dob` date NOT NULL,
  `spouse_pob` text NOT NULL,
  `spouse_address` text NOT NULL,
  `spouse_occupation` text NOT NULL,
  `spouse_position` text NOT NULL,
  `spouse_employer` text NOT NULL,
  `spouse_employer_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_info`
--

INSERT INTO `client_info` (`client_info_id`, `client_id`, `mother_name`, `mother_contact`, `father_name`, `father_contact`, `living_with`, `marital_status`, `spouse_name`, `spouse_contact`, `spouse_dob`, `spouse_pob`, `spouse_address`, `spouse_occupation`, `spouse_position`, `spouse_employer`, `spouse_employer_contact`) VALUES
(2, 2, 'A2 MOTHER', '09288819281', 'A2 FATHER', '09198092201', 'RELATIVES', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(3, 3, 'A3 MOTHER', '09357773265', 'A3 FATHER', '09176549865', 'FAMILY', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(4, 4, 'A4 MOTHER', '09210092011', 'A4 FATHER', '09280019281', 'FAMILY', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(5, 5, 'B1 MOTHER', '09357773265', 'B1 FATHER', '09176549865', 'FAMILY', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(6, 6, 'B2 MOTHER', '', 'B2 FATHER', '09198092201', 'PARENTS', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(7, 7, 'B3 MOTHER', '09357773265', 'B3 FATHER', '09176549865', 'PARENTS', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(8, 8, 'B4 MOTHER', '09357773265', 'B4 FATHER', '09176549865', 'PARENTS', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(9, 9, 'TERESITA BUZON FONTANOZA', '09357773265', 'REYNALDO CABALJIN FONTANOZA', '09176549865', 'PARENTS', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(10, 10, 'MOTHER', '09100009999', 'FATHER', '09109992222', 'PARENTS', 'MARRIED', 'SPOUSE', '09110909090', '1992-11-03', 'PAMPANGA', 'SAN FERNANDO, PAMPANGA', 'GOV. EMPLOYEE', 'STAFF', 'LGU SAN FERNANDO', '09556564652'),
(11, 11, 'LOURDES CHYRELLE ASAYAS', '09129914500', 'LARRY ASAYAS', '', 'RELATIVES', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(12, 12, 'MOTHER', '09100009999', 'FATHER', '09109992222', 'PARENTS', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', ''),
(15, 0, 'A', '09999999999', 'TEST', '09999999999', '', 'SINGLE', '', '', '1970-01-01', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `dependent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`dependent_id`, `client_id`, `name`, `dob`) VALUES
(1, 10, 'Dependent', '2020-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `employer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employer_name` text NOT NULL,
  `address` text NOT NULL,
  `employer_contact` text NOT NULL,
  `occupation` text NOT NULL,
  `date_hired` date NOT NULL,
  `employment_status` text NOT NULL,
  `employment_type` text NOT NULL,
  `nature_of_business` text NOT NULL,
  `gross_monthly` double NOT NULL,
  `other_income` double NOT NULL,
  `max_loanable_amt` double NOT NULL,
  `hr_personnel` text NOT NULL,
  `hr_contact` text NOT NULL,
  `supervisor` text NOT NULL,
  `supervisor_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`employer_id`, `client_id`, `employer_name`, `address`, `employer_contact`, `occupation`, `date_hired`, `employment_status`, `employment_type`, `nature_of_business`, `gross_monthly`, `other_income`, `max_loanable_amt`, `hr_personnel`, `hr_contact`, `supervisor`, `supervisor_contact`) VALUES
(2, 2, 'ACCENTURE', 'CEBU CITY', '09653336989', 'ASSOCIATE SOFTWARE ENGINEER', '2015-06-21', 'REGULAR', 'PRIVATE', 'INFORMATION TECHNOLOGY', 12000, 10000, 0, 'DANNY SANCHEZ', '09563336598', 'LITO QUEZON', '09210029102'),
(3, 3, 'LEYECO V', 'BRGY. SAN PABLO, ORMOC CITY', '09120002910', 'CUSTOMER SERVICE AIDE I', '2016-11-12', 'REGULAR', 'PRIVATE', 'ELECTRIC COOPERATIVE', 12000, 0, 0, 'DANNY SANCHEZ', '09563336598', 'PETER PARKER', '09210029102'),
(4, 4, 'CITY GOVERNMENT OF ORMOC', 'NEW ORMOC CITY HALL BLDG., BRGY. COGON, ORMOC CITY', '09653336989', 'SR. ADMINISTRATIVE ASSISTANT II', '2022-12-21', 'REGULAR', 'GOVERNMENT', 'INFORMATION TECHNOLOGY', 12000, 24000, 0, 'FARICA ZGUMBA', '09109920192', 'MELCHIZEDEC YAP', '09210029102'),
(5, 5, 'CITY GOVERNMENT OF ORMOC', 'NEW ORMOC CITY HALL BLDG., BRGY. COGON, ORMOC CITY', '09289938102', 'ADMIN AIDE I', '2019-01-06', 'CASUAL', 'GOVERNMENT', 'INFORMATION TECHNOLOGY', 12000, 0, 0, 'FARICA ZGUMBA', '09109920192', 'MELCHIZEDEC YAP', '09210029102'),
(6, 6, 'CITY GOVERNMENT OF ORMOC', 'NEW ORMOC CITY HALL BLDG., BRGY. COGON, ORMOC CITY', '09653336989', 'ADMIN AIDE I', '2019-01-06', 'CASUAL', 'GOVERNMENT', 'INFORMATION TECHNOLOGY', 12000, 10000, 0, 'FARICA ZGUMBA', '09109920192', 'MELCHIZEDEC YAP', '09210029102'),
(7, 7, 'CITY GOVERNMENT OF ORMOC', 'NEW ORMOC CITY HALL BLDG., BRGY. COGON, ORMOC CITY', '09653336989', 'ADMIN AIDE I', '2019-01-06', 'CASUAL', 'GOVERNMENT', 'INFORMATION TECHNOLOGY', 12000, 0, 0, 'FARICA ZGUMBA', '09109920192', 'MELCHIZEDEC YAP', '09210029102'),
(8, 8, 'CITY GOVERNMENT OF ORMOC', 'NEW ORMOC CITY HALL BLDG., BRGY. COGON, ORMOC CITY', '09289938102', 'ADMIN AIDE I', '2019-01-06', 'CASUAL', 'GOVERNMENT', 'INFORMATION TECHNOLOGY', 12000, 12000, 0, 'FARICA ZGUMBA', '09109920192', 'MELCHIZEDEC YAP', '09210029102'),
(9, 9, 'CITY GOVERNMENT OF ORMOC', 'NEW ORMOC CITY HALL BLDG., BRGY. COGON, ORMOC CITY', '09289938102', 'ADMIN AIDE I', '2000-01-31', 'REGULAR', 'GOVERNMENT', 'INFORMATION TECHNOLOGY', 12000, 10000, 0, 'FARICA ZGUMBA', '09109920192', 'MELCHIZEDEC YAP', '09210029102'),
(10, 10, 'LGU SAN FERNANDO', 'SAN FERNANDO, PAMPANGA', '09102365652', 'STAFF', '2018-01-06', 'REGULAR', 'GOVERNMENT', 'IT', 18000, 6000, 0, 'HR', '09556665555', 'SUPERVISOR', '09565554213'),
(11, 11, 'AMIGO LENDING CORP', 'GROUND FLOOR GAMBOA BLDG BRGY DEL ROSARIO SAN FERNANDO PAMPANGA', '09203212121', 'COLLECTION ASSISTANT', '2023-01-03', 'REGULAR', 'PRIVATE', 'LENDING COMPANY', 15000, 0, 0, 'CHERRY MAE EULA', '09203212121', 'CHERRY MAE EULA', '09203212121'),
(12, 12, 'LGU SAN FERNANDO', 'SAN FERNANDO, PAMPANGA', '09102365652', 'STAFF', '2022-12-08', 'REGULAR', 'GOVERNMENT', 'GOVERNMENT', 50000, 1000, 0, 'HR', '09556665555', 'SUPERVISOR', '09565554213');

-- --------------------------------------------------------

--
-- Table structure for table `gov_issued_id`
--

CREATE TABLE `gov_issued_id` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `id_type` text NOT NULL,
  `id_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_applications`
--

CREATE TABLE `loan_applications` (
  `loan_id` int(11) NOT NULL,
  `contract_no` text NOT NULL,
  `client_id` int(11) NOT NULL,
  `loan_type` int(11) NOT NULL,
  `loan_duration` int(11) NOT NULL,
  `loan_amount` double NOT NULL,
  `interest_amount` double NOT NULL,
  `other_fee` double NOT NULL,
  `total_cashout` double NOT NULL,
  `monthly_amortization` int(11) NOT NULL,
  `application_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ci_status` int(11) NOT NULL,
  `ci_by` text NOT NULL,
  `ci_date` datetime DEFAULT NULL,
  `approval` int(11) NOT NULL,
  `processed_by` text NOT NULL,
  `date_flagged` datetime DEFAULT NULL,
  `remarks` text NOT NULL,
  `paid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_applications`
--

INSERT INTO `loan_applications` (`loan_id`, `contract_no`, `client_id`, `loan_type`, `loan_duration`, `loan_amount`, `interest_amount`, `other_fee`, `total_cashout`, `monthly_amortization`, `application_date`, `ci_status`, `ci_by`, `ci_date`, `approval`, `processed_by`, `date_flagged`, `remarks`, `paid`) VALUES
(1, 'AMG202302080204317', 3, 2, 3, 12000, 2880, 300, 8820, 2000, '2023-02-17 15:28:04', 1, 'Kevin Fontanoza', '2023-02-17 08:28:39', 1, 'Kevin Fontanoza', '2023-02-17 08:28:49', 'paid', 1),
(2, 'AMG202302080237317', 3, 2, 2, 16000, 2560, 300, 13140, 4000, '2023-02-17 15:30:37', 1, 'Kevin Fontanoza', '2023-02-17 08:31:03', 1, 'Kevin Fontanoza', '2023-02-17 08:31:23', 'paid', 1),
(3, 'AMG202302080201417', 4, 2, 3, 24000, 5760, 300, 17940, 4000, '2023-02-17 15:34:01', 1, 'Kevin Fontanoza', '2023-02-17 08:34:22', 1, 'Kevin Fontanoza', '2023-02-17 08:34:26', 'paid', 1),
(4, 'AMG202302080247417', 4, 2, 3, 12000, 2880, 300, 8820, 2000, '2023-02-17 15:45:47', 1, 'Kevin Fontanoza', '2023-02-17 09:02:49', 1, 'Kevin Fontanoza', '2023-02-17 09:03:00', 'paid', 1),
(5, 'AMG202302100235917', 9, 2, 3, 24000, 5760, 300, 17940, 4000, '2023-02-17 17:41:35', 1, 'Kevin Fontanoza', '2023-02-17 10:50:24', 1, 'Kevin Fontanoza', '2023-03-13 08:57:03', '', 0),
(6, 'AMG202303050342116', 1, 1, 3, 24000, 5760, 300, 17940, 4000, '2023-03-17 00:32:42', 1, 'Kevin Fontanoza', '2023-03-17 00:42:52', 2, 'Kevin Fontanoza', '2023-03-17 04:15:30', 'Not qualified', 0),
(7, 'AMG2023030203001017', 10, 2, 3, 13650, 3276, 300, 10074, 2275, '2023-03-17 09:21:00', 1, 'Kevin Fontanoza', '2023-03-17 02:31:07', 1, 'Kevin Fontanoza', '2023-03-17 04:13:23', '', 0),
(8, 'AMG2023030303491117', 11, 2, 3, 13650, 3276, 300, 10074, 2275, '2023-03-17 10:05:49', 0, '', NULL, 0, '', NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `loan_type_id` int(11) NOT NULL,
  `loan_type` text NOT NULL,
  `interest` double NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`loan_type_id`, `loan_type`, `interest`, `min`, `max`, `description`) VALUES
(1, 'Multipurpose Loan', 10, 1, 3, 'Multipurpose'),
(2, 'Emergency Loan', 6, 1, 3, 'For emergency purposes');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `contract_no` text NOT NULL,
  `payment_code` text NOT NULL,
  `amount` double NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`) VALUES
(1, 'Pangalan ng kumpanya'),
(2, 'Anong klaseng kumpanya'),
(3, 'Kumusta ang produksyon ng kumpanya'),
(4, 'Gaano karami ang mga empleyado'),
(5, 'May mga regular o contractual bang empleyado'),
(6, 'Hindi ba nagbabawas o naglilipat ng mga tao sa ibang lugar'),
(7, 'Possible ba na mailipat ng area o ma-shuffle'),
(8, 'Stable ba ang work'),
(9, 'Ano ang ginagamit na ATM'),
(10, 'Tuwing kailan ang sweldo'),
(11, 'Hindi ba nadedelay ang sahod'),
(12, 'Magkano umaabot ang sweldo ni Client'),
(13, 'Kaano-ano si Client'),
(14, 'Gaano na katagal katrabaho'),
(15, 'Gaano na katagal kakilala'),
(16, 'Ano ang department at posisyon ni Client'),
(17, 'Saan naka-assign'),
(18, 'Kumusta si Client bilang empleyado'),
(19, 'Kumusta ang performance o record'),
(20, 'May nakakaalitan ba sa katrabaho'),
(21, 'May problema ba sa trabaho'),
(22, 'May nagawa na bang offense sa kumpanya o katrabaho'),
(23, 'May warning ba ng memo, suspension o termination'),
(24, 'May bad attitude ba na napapansin'),
(25, 'Pala-absent ba'),
(26, 'Madalas bang malate'),
(27, 'Ano ang masasabi sa character ng empleyado'),
(28, 'May pagkakautang ba sa kumpanya o katrabaho'),
(29, 'Hindi ba nagkakaproblema sa Financial'),
(30, 'Kaano-ano si Client'),
(31, 'Ano ang address'),
(32, 'Gaano na katagal nakatira sa address'),
(33, 'Nangungupa ba o sariling bahay'),
(34, 'May balak bang lumipat ng tirahan'),
(35, 'Saan ang probinsya'),
(36, 'Sino ang Nakatira'),
(37, 'Sino-sino ang mga kasama sa bahay'),
(38, 'Gaano katagal kasama'),
(39, 'Ilan ang mga anak'),
(40, 'Aware ba na magloloan si Client'),
(41, 'Saan gagamitin ang loan'),
(42, 'Saan nagtatrabaho'),
(43, 'Magkano ang inaabot ng sweldo sa kinsenas'),
(44, 'Gaano na katagal sa trabaho'),
(45, 'Hindi ba nagkakaproblema sa trabaho'),
(46, 'May balak bang mag-resign sa trabaho'),
(47, 'May plano bang mag-abroad'),
(48, 'May iba pa bang pinagkakakitaan'),
(49, 'Kumusta ang pakikitungo'),
(50, 'Naireklamo na ba sa Barangay tungkol sa pagkakautang'),
(51, 'May naniningil ba sa bahay'),
(52, 'May trabaho ba ang (asawa)'),
(53, 'Anong mga gastusin sa araw-araw'),
(54, 'May binabayaran bang hulugan na pera o gamit'),
(55, 'Magkano ang binabayaran sa kuryente at tubig'),
(56, 'Hindi ba nahihirapan sa budget'),
(57, 'Hindi ba magkukulang ang budget kung makakaltasan'),
(58, 'May pinagkakautangan ba sa individual o sa microfinance'),
(59, 'May loan ba sa ibang kumpanya SSS, Pag-ibig'),
(60, 'Maliban sa Fuerte may iba pa bang pinagkakautangan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `position`, `username`, `password`, `access_level`) VALUES
(1, 'Kevin Fontanoza', 'Admin', 'kevin', '$2y$10$.u1Oc/WtOaWGMdXUciTpjOX.q5kjIFNeYGfgablbGl32WoUizm7Zu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`questionnaire_id`);

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
-- Indexes for table `archive_child`
--
ALTER TABLE `archive_child`
  ADD PRIMARY KEY (`ar_child_id`);

--
-- Indexes for table `archive_personal`
--
ALTER TABLE `archive_personal`
  ADD PRIMARY KEY (`ar_personal_id`);

--
-- Indexes for table `archive_reference`
--
ALTER TABLE `archive_reference`
  ADD PRIMARY KEY (`ar_reference_id`);

--
-- Indexes for table `archive_relative`
--
ALTER TABLE `archive_relative`
  ADD PRIMARY KEY (`ar_relative_id`);

--
-- Indexes for table `archive_spouse`
--
ALTER TABLE `archive_spouse`
  ADD PRIMARY KEY (`ar_spouse_id`);

--
-- Indexes for table `archive_work`
--
ALTER TABLE `archive_work`
  ADD PRIMARY KEY (`ar_work_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_info`
--
ALTER TABLE `client_info`
  ADD PRIMARY KEY (`client_info_id`);

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`dependent_id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`employer_id`);

--
-- Indexes for table `gov_issued_id`
--
ALTER TABLE `gov_issued_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`loan_type_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `applicants_child`
--
ALTER TABLE `applicants_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applicants_personal`
--
ALTER TABLE `applicants_personal`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applicants_reference`
--
ALTER TABLE `applicants_reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applicants_relative`
--
ALTER TABLE `applicants_relative`
  MODIFY `relative_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applicants_spouse`
--
ALTER TABLE `applicants_spouse`
  MODIFY `spouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applicants_work`
--
ALTER TABLE `applicants_work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `archive_child`
--
ALTER TABLE `archive_child`
  MODIFY `ar_child_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_personal`
--
ALTER TABLE `archive_personal`
  MODIFY `ar_personal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_reference`
--
ALTER TABLE `archive_reference`
  MODIFY `ar_reference_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_relative`
--
ALTER TABLE `archive_relative`
  MODIFY `ar_relative_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_spouse`
--
ALTER TABLE `archive_spouse`
  MODIFY `ar_spouse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_work`
--
ALTER TABLE `archive_work`
  MODIFY `ar_work_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `client_info`
--
ALTER TABLE `client_info`
  MODIFY `client_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dependents`
--
ALTER TABLE `dependents`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `employer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gov_issued_id`
--
ALTER TABLE `gov_issued_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_applications`
--
ALTER TABLE `loan_applications`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `loan_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
