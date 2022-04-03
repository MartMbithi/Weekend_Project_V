-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2022 at 09:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iAfya`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(200) NOT NULL,
  `app_ref_code` varchar(200) NOT NULL,
  `app_doc_id` int(200) NOT NULL,
  `app_user_id` int(200) NOT NULL,
  `app_status` varchar(200) DEFAULT NULL,
  `app_date` varchar(200) DEFAULT NULL,
  `app_details` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `app_ref_code`, `app_doc_id`, `app_user_id`, `app_status`, `app_date`, `app_details`) VALUES
(1, 'XJLVB35689', 3, 2, 'Approved', '2022-04-25', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'QLUJG08547', 4, 8, 'Approved', '2022-03-07', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(4, 'LBOKW60923', 1, 2, 'Approved', '2022-04-04', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(5, 'UMDNA15897', 3, 8, 'Approved', '2022-04-08', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(7, 'MEOSJ90426', 1, 8, 'Approved', '2022-04-27', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(200) NOT NULL,
  `bill_ref_code` varchar(200) DEFAULT NULL,
  `bill_diag_id` int(200) NOT NULL,
  `bill_amount` varchar(200) DEFAULT NULL,
  `bill_date_added` varchar(200) DEFAULT NULL,
  `bill_added_by` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_ref_code`, `bill_diag_id`, `bill_amount`, `bill_date_added`, `bill_added_by`) VALUES
(3, 'UV7ZKWXFSY', 5, '35000', '31 Mar 2022', 1),
(4, 'F4S238UZPL', 4, '50000', '01 Apr 2022', 3),
(5, 'FU68JOGK3S', 6, '96000', '01 Apr 2022', 1),
(6, '7OK2YXUHTD', 7, '96000', '01 Apr 2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diagonisis`
--

CREATE TABLE `diagonisis` (
  `diag_id` int(200) NOT NULL,
  `diad_ref` varchar(200) DEFAULT NULL,
  `diag_patient_id` int(11) DEFAULT NULL,
  `diag_doctor_id` int(11) DEFAULT NULL,
  `diag_title` longtext DEFAULT NULL,
  `diag_details` longtext DEFAULT NULL,
  `diag_date_created` varchar(200) DEFAULT NULL,
  `diag_cost` varchar(200) DEFAULT NULL,
  `diag_payment_status` varchar(200) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagonisis`
--

INSERT INTO `diagonisis` (`diag_id`, `diad_ref`, `diag_patient_id`, `diag_doctor_id`, `diag_title`, `diag_details`, `diag_date_created`, `diag_cost`, `diag_payment_status`) VALUES
(1, 'WZVBG39021', 2, 1, 'Pneumonia', 'Infection that inflames air sacs in one or both lungs, which may fill with fluid.  With pneumonia, the air sacs may fill with fluid or pus. The infection can be life-threatening to anyone, but particularly to infants, children and people over 65. Symptoms include a cough with phlegm or pus, fever, chills and difficulty breathing. Antibiotics can treat many forms of pneumonia. Some forms of pneumonia can be prevented by vaccines.\n\nRequires a medical diagnosis Symptoms include a cough with phlegm or pus, fever, chills and difficulty breathing.\nPeople may experience: Pain types: can be sharp in the chest Whole body: fever, chills, dehydration, fatigue, loss of appetite, malaise, clammy skin, or sweating Respiratory: fast breathing, shallow breathing, shortness of breath, or wheezing Also common: cough or fast heart rate\nAntibiotics can treat many forms of pneumonia. Some forms of pneumonia can be prevented by vaccines.  Infection that inflames air sacs in one or both lungs, which may fill with fluid. With pneumonia, the air sacs may fill with fluid or pus. The infection can be life-threatening to anyone, but particularly to infants, children and people over 65. Symptoms include a cough with phlegm or pus, fever, chills and difficulty breathing. Antibiotics can treat many forms of pneumonia. Some forms of pneumonia can be prevented by vaccines. Requires a medical diagnosis Symptoms include a cough with phlegm or pus, fever, chills and difficulty breathing. People may experience: Pain types: can be sharp in the chest Whole body: fever, chills, dehydration, fatigue, loss of appetite, malaise, clammy skin, or sweating Respiratory: fast breathing, shallow breathing, shortness of breath, or wheezing Also common: cough or fast heart rate Antibiotics can treat many forms of pneumonia. Some forms of pneumonia can be prevented by vaccines.   Infection that inflames air sacs in one or both lungs, which may fill with fluid. With pneumonia, the air sacs may fill with fluid or pus. The infection can be life-threatening to anyone, but particularly to infants, children and people over 65. Symptoms include a cough with phlegm or pus, fever, chills and difficulty breathing. Antibiotics can treat many forms of pneumonia. Some forms of pneumonia can be prevented by vaccines. Requires a medical diagnosis Symptoms include a cough with phlegm or pus, fever, chills and difficulty breathing. People may experience: Pain types: can be sharp in the chest Whole body: fever, chills, dehydration, fatigue, loss of appetite, malaise, clammy skin, or sweating Respiratory: fast breathing, shallow breathing, shortness of breath, or wheezing Also common: cough or fast heart rate Antibiotics can treat many forms of pneumonia. Some forms of pneumonia can be prevented by vaccines. ', '2022-03-31', '90000', 'Paid'),
(4, 'BXSJG65103', 2, 1, 'Lorem Ipsum -femo', 'Medical diagnosis is the process of determining which disease or condition explains a person\'s symptoms and signs. It is most often referred to as diagnosis with the medical context being implicit. Wikipedia', '2022-04-01', '50000', 'Paid'),
(5, 'MICWG58264', 8, 3, 'Pneumonia', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2022-04-01', '35000', 'Paid'),
(6, 'QUZIY95726', 8, 1, 'Cancer Screening', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2022-04-01', '96000', 'Paid'),
(7, 'PWNKS81462', 8, 1, 'Cancer Screening', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2022-04-01', '96000', 'Paid'),
(8, 'SJOGW01759', 8, 5, 'Chest XRAY', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2022-04-19', '5500', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sys_id` int(200) NOT NULL,
  `sys_name` longtext NOT NULL,
  `sys_website` longtext NOT NULL,
  `sys_tagline` longtext NOT NULL,
  `sys_contacts` longtext NOT NULL,
  `sys_postal_addr` longtext NOT NULL,
  `sys_email` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sys_id`, `sys_name`, `sys_website`, `sys_tagline`, `sys_contacts`, `sys_postal_addr`, `sys_email`) VALUES
(1, 'iAfya', 'www.iafya.com', 'The Ultimate Healthcare Information Management System.', '+257737229776 / +254740847563', 'P.O BOX 123-90763 NAIROBI', 'info@iafya.com');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int(200) NOT NULL,
  `survey_ref` varchar(200) NOT NULL,
  `survey_user_id` int(200) NOT NULL,
  `survey_user_dob` varchar(200) DEFAULT NULL,
  `survey_user_gender` varchar(200) DEFAULT NULL,
  `survey_syptoms` longtext DEFAULT NULL,
  `survey_other_difficulties` longtext DEFAULT NULL,
  `survey_user_ailments` longtext DEFAULT NULL,
  `survey_travel_history` longtext DEFAULT NULL,
  `survey_user_travel` longtext DEFAULT NULL,
  `survey_user_people_contacted` longtext DEFAULT NULL,
  `survey_user_fam_members` longtext DEFAULT NULL,
  `survey_user_tests` longtext DEFAULT NULL,
  `survey_user_vaccination` longtext DEFAULT NULL,
  `survey_date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `survey_ref`, `survey_user_id`, `survey_user_dob`, `survey_user_gender`, `survey_syptoms`, `survey_other_difficulties`, `survey_user_ailments`, `survey_travel_history`, `survey_user_travel`, `survey_user_people_contacted`, `survey_user_fam_members`, `survey_user_tests`, `survey_user_vaccination`, `survey_date_added`) VALUES
(1, 'JHMAB05812', 2, '20', 'Muscle Pain', NULL, '', 'None', 'Nairobi', 'Yes', '100-200', '2-4', 'No', 'No', '2022-04-01 09:59:19'),
(2, 'ZLFYB06584', 2, '20', 'Male', 'Colds', '', 'None', 'Machakos', 'Yes', '0-100', '0-2', 'Yes', 'Yes', '2022-04-01 10:10:58'),
(3, 'VJKWG83017', 2, '20', 'Male', 'Muscle Pain', '', 'Bronchitis', 'Machakos', 'Yes', '0-100', '0-2', 'Yes', 'Yes', '2022-04-01 10:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(200) NOT NULL,
  `user_number` varchar(200) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `user_phone` varchar(200) DEFAULT NULL,
  `user_age` varchar(200) DEFAULT NULL,
  `user_address` longtext DEFAULT NULL,
  `user_passport` longtext DEFAULT NULL,
  `user_date_added` varchar(200) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_access_level` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_number`, `user_name`, `user_email`, `user_phone`, `user_age`, `user_address`, `user_passport`, `user_date_added`, `user_password`, `user_access_level`) VALUES
(1, 'USR-00952FD', 'Sys Admin', 'sysadmin@gmail.com', '0977865-0987', '39', '9078741 Localhost', NULL, '12/12/2012', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'admin'),
(2, 'USR-00952FD', 'James Doe', 'jdoe@iafya.com', '0977865-0987', '39', '9078741 Localhost', NULL, '12/12/2012', '13374ffc272cc6c4c2e4dd5327aaae9d08eb4e4f', 'patient'),
(3, 'UYSTM56789', 'Doctor Apache', 'docpache@gmail.com', '09888778990', '30', '90126 Localhost', NULL, '27 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'doctor'),
(4, 'YJFIT60173', 'Doc Wilfred K', 'wilfred123@gmail.com', '1234567889', '29', '902276 Lake View', NULL, '27 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'doctor'),
(5, 'WMNVZ92367', 'Janet D Monroe', 'janettmonroe@protonmail.com', '9977654233', '33', '66558 KLakeview', NULL, '27 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'doctor'),
(6, 'CIZGR69378', 'Arnold Kovacs', 'ak889765@gmail.com', '776564246', '55', '90765 Kiev', NULL, '27 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL),
(8, 'ZNWVC01627', 'Janet D Monroe', 'janetmon899@gmail.com', '0988765342', '25', '1289Localhost', NULL, '28 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'patient'),
(9, 'JNOYL14056', 'Larry  K', 'larryk@gmail.com', '908865433', '25', '12900 Localhost', NULL, '28 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'patient'),
(11, 'MSTRU05821', 'Dr Martin', 'mart@gmail.com', '+254009013498', '20', 'Demo Localhost', NULL, '31 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'doctor'),
(12, 'WDBKS68419', 'Test Patient', 'test@test.com', '+099494203e', '20', '90 MACHAKOS\r\n', NULL, '31 Mar 2022', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `DoctorID` (`app_doc_id`),
  ADD KEY `PatientID` (`app_user_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `BillDoctor` (`bill_added_by`),
  ADD KEY `BillDiagID` (`bill_diag_id`);

--
-- Indexes for table `diagonisis`
--
ALTER TABLE `diagonisis`
  ADD PRIMARY KEY (`diag_id`),
  ADD KEY `DiagDoc` (`diag_doctor_id`),
  ADD KEY `DiagPatient` (`diag_patient_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `Survey_User_ID` (`survey_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diagonisis`
--
ALTER TABLE `diagonisis`
  MODIFY `diag_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sys_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `DoctorID` FOREIGN KEY (`app_doc_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PatientID` FOREIGN KEY (`app_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `BillDiagID` FOREIGN KEY (`bill_diag_id`) REFERENCES `diagonisis` (`diag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BillDoctor` FOREIGN KEY (`bill_added_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagonisis`
--
ALTER TABLE `diagonisis`
  ADD CONSTRAINT `DiagDoc` FOREIGN KEY (`diag_doctor_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DiagPatient` FOREIGN KEY (`diag_patient_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `Survey_User_ID` FOREIGN KEY (`survey_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
