-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2019 at 04:41 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_checklist`
--

DROP TABLE IF EXISTS `activity_checklist`;
CREATE TABLE IF NOT EXISTS `activity_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_text` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_checklist`
--

INSERT INTO `activity_checklist` (`id`, `checklist_text`, `status`) VALUES
(1, 'The training / meeting room was appropriate', 1),
(2, 'Lunch and tea were served on time', 1),
(3, 'Participants\' DSA forms are signed and attached', 1),
(4, 'Copy of training / meeting material is received', 1),
(5, 'Participants\' attendance sheet is signed and attached', 1);

-- --------------------------------------------------------

--
-- Table structure for table `age`
--

DROP TABLE IF EXISTS `age`;
CREATE TABLE IF NOT EXISTS `age` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `age`
--

INSERT INTO `age` (`id`, `name`) VALUES
(1, '20-25'),
(2, '25-30'),
(3, '30-35'),
(4, '35-40'),
(5, '40-45'),
(6, '45-50');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `city_id` int(11) NOT NULL,
  `uc_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `city_id`, `uc_id`) VALUES
(1, 'area1', 2, 1),
(2, 'area2', 2, 2),
(3, 'area3', 1, 3),
(4, 'area4', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `assign_interview`
--

DROP TABLE IF EXISTS `assign_interview`;
CREATE TABLE IF NOT EXISTS `assign_interview` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `rollnumber` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `interview_date` datetime NOT NULL,
  `interview_person` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_interview`
--

INSERT INTO `assign_interview` (`id`, `rollnumber`, `email`, `city_id`, `interview_date`, `interview_person`, `status`, `sdt`) VALUES
(8, 6, 'mail@mail.com', 1, '2019-05-29 12:31:06', 3, 0, '2019-05-29 12:31:06'),
(17, 5, 'mail@mail.com', 1, '2019-09-26 08:25:07', 4, 0, '2019-06-10 03:32:04'),
(12, 15, 'mail@mail.com', 1, '2019-05-29 12:31:06', 4, 0, '2019-06-01 08:17:32'),
(18, 17, 'mail@mail.com', 2, '2019-09-27 05:25:07', 4, 0, '2019-07-27 10:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `assign_test`
--

DROP TABLE IF EXISTS `assign_test`;
CREATE TABLE IF NOT EXISTS `assign_test` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `rollnumber` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `test_date` datetime NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_test`
--

INSERT INTO `assign_test` (`id`, `rollnumber`, `email`, `test_date`, `city_id`, `status`, `sdt`) VALUES
(12, '6', 'mail@mail.com', '2019-05-29 12:31:06', 1, 0, '2019-05-29 12:32:41'),
(16, '15', 'mail@mail.com', '1979-09-28 21:25:07', 1, 0, '2019-06-01 08:16:12'),
(17, '17', 'mail@mail.com', '2019-09-25 05:25:07', 1, 0, '2019-07-27 10:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

DROP TABLE IF EXISTS `blood_group`;
CREATE TABLE IF NOT EXISTS `blood_group` (
  `blood_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `blood_group_name` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`blood_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`blood_group_id`, `blood_group_name`, `created_at`, `created_by`) VALUES
(1, 'A+', NULL, NULL),
(2, 'A-', NULL, NULL),
(3, 'B+', NULL, NULL),
(4, 'B-', NULL, NULL),
(5, 'O+', NULL, NULL),
(6, 'O-', NULL, NULL),
(7, 'AB+', NULL, NULL),
(8, 'AB-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `card_request_reasons`
--

DROP TABLE IF EXISTS `card_request_reasons`;
CREATE TABLE IF NOT EXISTS `card_request_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_text` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_request_reasons`
--

INSERT INTO `card_request_reasons` (`id`, `reason_text`, `added_by`, `created_at`, `status`) VALUES
(1, 'Lost ', 1, NULL, 0x31),
(2, 'Expired', 1, NULL, 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `province_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `province_id`) VALUES
(1, 'mardan', 4),
(2, 'swat', 4);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `complaint_desc` text,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `tehsil_id` int(11) DEFAULT NULL,
  `uc_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','waiting','resolved','review','process') DEFAULT NULL,
  `closing_remarks` text,
  `remarks_by` int(11) DEFAULT NULL,
  `remarks_at` datetime DEFAULT NULL,
  `visibility` tinyint(1) DEFAULT NULL,
  `complaint_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `name`, `contact_no`, `email`, `subject`, `complaint_desc`, `province_id`, `district_id`, `tehsil_id`, `uc_id`, `created_at`, `status`, `closing_remarks`, `remarks_by`, `remarks_at`, `visibility`, `complaint_no`) VALUES
(1, 'ABCD', '48398484849', 'abcd@email.com', 'subject', 'Detail of complaint', 4, 2, 1, 2, '2019-06-19 05:14:24', 'pending', NULL, NULL, NULL, NULL, 'CTC-001'),
(2, 'XYZ', '83829329388', 'xyz@email.com', 'Test subject', 'complaint details', 4, 2, 2, 1, '2019-06-19 05:15:55', 'pending', NULL, NULL, NULL, NULL, 'CTC-002'),
(3, 'XYZ', '83829329388', 'xyz@email.com', 'Test subject', 'complaint details', 4, 2, 2, 1, '2019-06-19 05:19:00', 'pending', NULL, NULL, NULL, NULL, 'CTC-003'),
(4, 'ASDF', '39209329392', 'asdf@email.com', 'Subject 1', 'Detail 1', 4, 2, 1, 2, '2019-06-19 05:19:58', 'pending', NULL, NULL, NULL, NULL, 'CTC-004');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_internal`
--

DROP TABLE IF EXISTS `complaint_internal`;
CREATE TABLE IF NOT EXISTS `complaint_internal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_no` varchar(15) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `other_reason` text,
  `evidence` binary(1) DEFAULT NULL,
  `evidence_date` date DEFAULT NULL,
  `description` text,
  `reported_by` varchar(25) DEFAULT NULL,
  `reported_date` date DEFAULT NULL,
  `closing_remarks` text,
  `remarks_by` int(11) DEFAULT NULL,
  `remarks_at` date DEFAULT NULL,
  `status` enum('pending','process','review','resolved') DEFAULT NULL,
  `visibility` binary(1) DEFAULT NULL,
  `entry_by` int(11) DEFAULT NULL,
  `entry_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sdt` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

DROP TABLE IF EXISTS `discipline`;
CREATE TABLE IF NOT EXISTS `discipline` (
  `discipline_id` int(11) NOT NULL AUTO_INCREMENT,
  `discipline_name` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`discipline_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`discipline_id`, `discipline_name`, `created_at`, `created_by`) VALUES
(1, 'Social Sciences', NULL, NULL),
(2, 'Communication', NULL, NULL),
(3, 'Business Administration', NULL, NULL),
(4, 'Science ', NULL, NULL),
(5, 'Arts', NULL, NULL),
(6, 'Computer Sciences ', NULL, NULL),
(7, 'Civil Engineering ', NULL, NULL),
(8, 'Electrical Engineering ', NULL, NULL),
(9, 'English', NULL, NULL),
(10, 'Education', NULL, NULL),
(11, 'Commerce ', NULL, NULL),
(12, 'Mechanical Engineering ', NULL, NULL),
(13, 'Chemistry', NULL, NULL),
(14, 'Biology', NULL, NULL),
(15, 'Mathematics ', NULL, NULL),
(16, 'Statistics', NULL, NULL),
(17, 'Accountancy', NULL, NULL),
(18, 'Info not available', NULL, NULL),
(19, 'Madrassa Education/Quarnic Education', NULL, NULL),
(20, 'veterinary degree', NULL, NULL),
(21, 'Health education', NULL, NULL),
(22, 'Engineering', NULL, NULL),
(23, 'LAW', NULL, NULL),
(24, 'Public Administration', NULL, NULL),
(25, 'Islamiat', NULL, NULL),
(26, 'Urdu', NULL, NULL),
(27, 'Political Science', NULL, NULL),
(28, 'Economics', NULL, NULL),
(29, 'Primary', NULL, NULL),
(30, 'Nursing', NULL, NULL),
(31, 'LHV', NULL, NULL),
(32, 'Pharmacy', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `province_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
(1, 'mardan', 4),
(2, 'swat', 4),
(3, 'peshawar', 4),
(4, 'nowshera', 4);

-- --------------------------------------------------------

--
-- Table structure for table `domicile`
--

DROP TABLE IF EXISTS `domicile`;
CREATE TABLE IF NOT EXISTS `domicile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domicile`
--

INSERT INTO `domicile` (`id`, `name`) VALUES
(1, 'pakistani'),
(2, 'Afghanistani'),
(3, 'kp'),
(4, 'punjab');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `name`) VALUES
(1, 'MA'),
(2, 'MSC'),
(3, 'BA'),
(4, 'BSC'),
(5, 'FA'),
(6, 'FSC'),
(7, 'Matric Arts'),
(8, 'Matric Science');

-- --------------------------------------------------------

--
-- Table structure for table `employee_bank_information_info`
--

DROP TABLE IF EXISTS `employee_bank_information_info`;
CREATE TABLE IF NOT EXISTS `employee_bank_information_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `bank_id` bigint(20) NOT NULL,
  `account_id` varchar(250) NOT NULL,
  `branch_code` varchar(100) NOT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_bank_information_info`
--

INSERT INTO `employee_bank_information_info` (`id`, `user_id`, `bank_id`, `account_id`, `branch_code`, `sdt`) VALUES
(1, 5, 1, '12121245451', '0221', '2019-05-18 07:59:23'),
(2, 6, 0, '', '0', '2019-05-31 12:16:30'),
(3, 14, 0, '', '0', '2019-06-01 08:30:44'),
(4, 17, 0, '', '0', '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee_basic_info`
--

DROP TABLE IF EXISTS `employee_basic_info`;
CREATE TABLE IF NOT EXISTS `employee_basic_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `relation_id` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `marital_status` varchar(200) DEFAULT NULL,
  `date_of_joining` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cnic` varchar(200) DEFAULT NULL,
  `cnic_expiry_date` varchar(200) DEFAULT NULL,
  `other_cnic_type_id` varchar(200) DEFAULT NULL,
  `employee_contract_type` varchar(200) DEFAULT NULL,
  `other_id_name` varchar(200) DEFAULT NULL,
  `other_passport_id` varchar(200) DEFAULT NULL,
  `tribe` varchar(200) DEFAULT NULL,
  `ethnicity` varchar(200) DEFAULT NULL,
  `language` varchar(200) DEFAULT NULL,
  `other_languages` varchar(200) DEFAULT NULL,
  `nationality` varchar(200) DEFAULT NULL,
  `religion` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  `personal_contact` varchar(200) DEFAULT NULL,
  `contact_other` varchar(200) DEFAULT NULL,
  `bloodgroup` varchar(200) DEFAULT NULL,
  `email_address` varchar(200) DEFAULT NULL,
  `contract_expiry_date` varchar(200) DEFAULT NULL,
  `remarks` text,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_basic_info`
--

INSERT INTO `employee_basic_info` (`id`, `user_id`, `job_title`, `department_id`, `father_name`, `relation_id`, `gender`, `date_of_birth`, `marital_status`, `date_of_joining`, `cnic`, `cnic_expiry_date`, `other_cnic_type_id`, `employee_contract_type`, `other_id_name`, `other_passport_id`, `tribe`, `ethnicity`, `language`, `other_languages`, `nationality`, `religion`, `contact_number`, `personal_contact`, `contact_other`, `bloodgroup`, `email_address`, `contract_expiry_date`, `remarks`, `status`, `sdt`) VALUES
(1, 18, 'abc', 0, 'father name', '1', '0', '2019-05-29 12:31:06', '1', '2019-05-29 12:31:06', '1730174788420', '05/28/2019', '0', NULL, 'Cnic', '', '11', '4', '12', 'Urdu', 'Pakistani', 'Islam', '', '0310-9873197', '032454545445', '3', 'mail@mail.com', NULL, '2-years Polio worker experience.', 1, '2019-05-18 07:59:23'),
(2, 6, 'abc', 1, '', '', '0', '2019-05-29 12:31:06', '', '2019-05-29 12:31:06', '1730174788420', '02-May-2019', '0', NULL, 'Cnic', '', '', '', '', 'Urdu', 'Pakistani', 'Islam', '', '0310-9873197', '', '', 'mail@mail.com', NULL, '2-years Polio worker experience.', 1, '2019-05-31 12:16:30'),
(3, 14, 'abc', 5, '', '', '', '2019-05-29 12:31:06', '', '2019-05-29 12:31:06', '1730174788420', '02-May-2019', '0', NULL, 'Cnic', '', '', '', '', 'Urdu', 'Pakistani', 'Islam', '', '0310-9873197', '', '', 'mail@mail.com', NULL, '2-years Polio worker experience.', 1, '2019-06-01 08:30:44'),
(4, 17, 'abc', NULL, '', '', '0', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1730174788420', '02-May-2019', '0', NULL, 'Cnic', '', '', '', '', 'Urdu', 'Pakistani', 'Islam', '', '0310-9873197', '', '', 'mail@mail.com', NULL, '2-years Polio worker experience.', 1, '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee_cards`
--

DROP TABLE IF EXISTS `employee_cards`;
CREATE TABLE IF NOT EXISTS `employee_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `card_status` enum('pending','printed','delivered','received') DEFAULT NULL,
  `request_reason` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `print_date` date DEFAULT NULL,
  `deliver_date` date DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_cards`
--

INSERT INTO `employee_cards` (`id`, `employee_id`, `card_status`, `request_reason`, `request_date`, `issue_date`, `expiry_date`, `print_date`, `deliver_date`, `receive_date`) VALUES
(1, 1, 'pending', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', '2019-07-19'),
(2, 2, 'printed', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', NULL),
(3, 3, 'pending', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', NULL),
(4, 4, 'received', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', '2019-07-19'),
(6, 6, 'printed', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', '2019-07-19'),
(7, 7, 'received', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', '2019-07-19'),
(8, 8, 'delivered', NULL, NULL, NULL, NULL, '2019-07-19', '2019-07-19', '2019-07-19'),
(12, 6, 'pending', 1, '2019-07-20', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_contract`
--

DROP TABLE IF EXISTS `employee_contract`;
CREATE TABLE IF NOT EXISTS `employee_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `basic_salery` varchar(100) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `contract_manager` bigint(20) NOT NULL,
  `contract_type` bigint(20) NOT NULL,
  `long_description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `rejection_reason` text NOT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_contract`
--

INSERT INTO `employee_contract` (`id`, `user_id`, `basic_salery`, `from_date`, `to_date`, `contract_manager`, `contract_type`, `long_description`, `status`, `rejection_reason`, `sdt`) VALUES
(5, 6, '200', '2019-05-29 12:31:06', '2019-05-29 12:31:06', 4, 6, 'saSCXZCZXCXZC ZXCCZXC ', 1, '', '2019-05-31 12:13:31'),
(6, 18, '500', '2019-05-29 12:31:06', '2019-05-29 12:31:06', 3, 4, '\r\nEmployment Contract\r\n\r\nTHIS AGREEMENT made as of Apr 1st, 2019, at Islamabad between CHIP Training and Consulting (Pvt) Ltd (hereinafter referred to as Employer) having its principal place of business at Islamabad and Mr. Aftab Khan (hereinafter referred to as Employee), TANK – KPK.\r\n\r\nWHEREAS the Employer desires to obtain the benefit of the services of the Employee for fixed period and the Employee desires to render such services on the terms and conditions set forth.\r\n\r\nIN CONSIDERATION of the promises and goods and valuable consideration the parties agrees as follows:\r\n\r\n \r\n\r\n1.       Position Title\r\nThe employee shall be designated as District Health Communication Support Officer (DHCSO) for Community Based Vaccination (CBV) Program as part of  Polio Eradication Initiative (PEI) in Pakistan.\r\n\r\n\r\n\r\n2.       Contract Validity\r\nThe employment contract will be valid from Apr 1st, 2019 to Sep 30th, 2019. The extension in this agreement will be subject to satisfactory performance of employee and employer\'s contract with its principal contractor UNICEF. This employment contract will be considered discontinued/ concluded if not extended expressly.\r\n\r\n\r\n\r\n3.       Duty Station & Reporting Line\r\nThe employee shall be based in TANK – KPK and shall be reporting directly to the CBV Manager with close coordination of both Provincial UNICEF Team and CTC Regional Office for all day to day/ Program activities.\r\n\r\n\r\n\r\n4.       Salary and Benefits\r\n\r\n(a) Gross salary including all allowances of PKR. 145,400/-  per month shall be paid subject to withholding tax. \r\n\r\n(b) It will essentially remain the responsibility of the employee to keep his/her tax affairs in order. By accepting this agreement, the employee has categorically exonerated the employer from any responsibility of his/her tax affairs i.e., NTN, tax return etc.\r\n\r\n(c) The employee shall be entitled for EOBI benefits. A contribution shall be deducted from the salary on monthly basis and deposited to EOBI along with employer’s contribution as per rules.\r\n\r\n(d) The employee shall be entitled for death and accidental insurance as per employer’s policy.\r\n\r\n \r\n\r\n5.       Timings\r\n\r\nThe employee shall be required to perform duties on a full time basis. The timings of Provincial/District Government shall be followed which may include weekends, however instructions of the Provincial EOC/UNICEF PO shall be considered final.\r\n\r\n\r\n6.       Leaves\r\nThe employee will be for leaves as per the employer’s leave policy. The employee may avail leaves subject to compliance with leaves guidelines and procedures as well as approval of the competent authority.', 1, '', '2019-06-01 06:46:39'),
(7, 14, '200', '2019-05-29 12:31:06', '2019-05-29 12:31:06', 3, 4, 'dasdasd', 1, '', '2019-06-01 08:27:31'),
(8, 17, '200', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 3, 'asdasdas', 0, '', '2019-07-27 10:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `employee_contract_files`
--

DROP TABLE IF EXISTS `employee_contract_files`;
CREATE TABLE IF NOT EXISTS `employee_contract_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `file_name` varchar(111) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_contract_files`
--

INSERT INTO `employee_contract_files` (`file_id`, `emp_id`, `file_name`) VALUES
(113, 7, '582a43cb64f49e2ba34e4b531eb8587e.png'),
(114, 7, 'f21ec511dc34722ac59ffc3e9ca6d490.jpg'),
(107, 6, 'd80703564f95257e13ec55028aaace6b.jpg'),
(108, 6, '1e2fd71c482cf6b6bff95072060b9c96.png'),
(109, 6, '5a5e58af49632d0f0adc7da3996806a9.png'),
(110, 6, '4b3c2774e5392dbd1b83183a7de7e8e5.jpg'),
(111, 7, 'e9abe4f3038cf87ea88aa38c51d6fbc0.png'),
(112, 7, '219bbbbef6861f6ef3b8580ce9f96b5c.jpg'),
(106, 8, 'Capture.PNG'),
(105, 8, '65463552_2122287124735090_5365059261086826496_n.png'),
(104, 8, '65460994_2282614765120722_474894143076696064_n.jpg'),
(103, 8, '5ApWge.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee_educational_info`
--

DROP TABLE IF EXISTS `employee_educational_info`;
CREATE TABLE IF NOT EXISTS `employee_educational_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `last_qualification_name` varchar(100) NOT NULL,
  `qualification_id` varchar(100) NOT NULL,
  `discipline_id` varchar(100) NOT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_educational_info`
--

INSERT INTO `employee_educational_info` (`id`, `user_id`, `last_qualification_name`, `qualification_id`, `discipline_id`, `sdt`) VALUES
(1, 5, 'MA', '', '7', '2019-05-18 07:59:23'),
(2, 6, 'MA', '', '5', '2019-05-31 12:16:30'),
(3, 14, 'MA', '', '5', '2019-06-01 08:30:44'),
(4, 17, 'MA', '', '5', '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee_permanent_location_info`
--

DROP TABLE IF EXISTS `employee_permanent_location_info`;
CREATE TABLE IF NOT EXISTS `employee_permanent_location_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `permanent_yesno` varchar(100) DEFAULT NULL,
  `permanent_province` varchar(100) DEFAULT NULL,
  `permanent_district` varchar(100) DEFAULT NULL,
  `permanent_tehsil` varchar(100) DEFAULT NULL,
  `permanent_uc` varchar(100) DEFAULT NULL,
  `permanent_address_details` text,
  `local_id` varchar(100) DEFAULT NULL,
  `verify_local_id` int(11) DEFAULT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_permanent_location_info`
--

INSERT INTO `employee_permanent_location_info` (`id`, `user_id`, `permanent_yesno`, `permanent_province`, `permanent_district`, `permanent_tehsil`, `permanent_uc`, `permanent_address_details`, `local_id`, `verify_local_id`, `sdt`) VALUES
(1, 5, '1', '2', '40', '346', '', ' Complete Permanent Address of Applicant (Mohalla/Village/Street/City etc) ', '2', 4, '2019-05-18 07:59:23'),
(2, 6, '2', '', '', '', '', '', '', 0, '2019-05-31 12:16:30'),
(3, 14, '2', '', '', '', '', '', '', 0, '2019-06-01 08:30:44'),
(4, 17, '2', '', '', '', '', '', '', 0, '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee_residential_info`
--

DROP TABLE IF EXISTS `employee_residential_info`;
CREATE TABLE IF NOT EXISTS `employee_residential_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `resident_province` varchar(100) NOT NULL,
  `resident_district` varchar(100) NOT NULL,
  `resident_tehsil` varchar(100) NOT NULL,
  `resident_uc` varchar(100) NOT NULL,
  `resident_address_details` text NOT NULL,
  `sdt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_residential_info`
--

INSERT INTO `employee_residential_info` (`id`, `user_id`, `resident_province`, `resident_district`, `resident_tehsil`, `resident_uc`, `resident_address_details`, `sdt`) VALUES
(1, 5, '1', '40', '346', '', 'Gulababad, Luwar Lakhti, Sufaid Dheri', '2019-05-18 07:59:23'),
(2, 6, '', '', '', '', 'Gulababad, Luwar Lakhti, Sufaid Dheri', '2019-05-31 12:16:30'),
(3, 14, '', '', '', '', 'Gulababad, Luwar Lakhti, Sufaid Dheri', '2019-06-01 08:30:44'),
(4, 17, '', '', '', '', 'Gulababad, Luwar Lakhti, Sufaid Dheri', '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee_supervisor_details`
--

DROP TABLE IF EXISTS `employee_supervisor_details`;
CREATE TABLE IF NOT EXISTS `employee_supervisor_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ds_id` bigint(20) NOT NULL,
  `ts_id` bigint(20) NOT NULL,
  `us_id` bigint(20) NOT NULL,
  `as_id` bigint(20) NOT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_supervisor_details`
--

INSERT INTO `employee_supervisor_details` (`id`, `user_id`, `ds_id`, `ts_id`, `us_id`, `as_id`, `sdt`) VALUES
(1, 5, 0, 7, 5, 5, '2019-05-18 07:59:23'),
(2, 6, 0, 5, 5, 5, '2019-05-31 12:16:30'),
(3, 14, 0, 5, 5, 5, '2019-06-01 08:30:44'),
(4, 17, 0, 5, 5, 5, '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee_total_experience_info`
--

DROP TABLE IF EXISTS `employee_total_experience_info`;
CREATE TABLE IF NOT EXISTS `employee_total_experience_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `total_polio_experience_year` varchar(100) DEFAULT NULL,
  `total_polio_experience_month` varchar(100) DEFAULT NULL,
  `total_polio_experience_day` varchar(100) DEFAULT NULL,
  `other_experience_year` varchar(100) DEFAULT NULL,
  `other_experience_month` varchar(100) DEFAULT NULL,
  `other_experience_day` varchar(100) DEFAULT NULL,
  `summary_total_experience_year` varchar(100) DEFAULT NULL,
  `summary_total_experience_month` varchar(100) DEFAULT NULL,
  `summary_total_experience_day` varchar(100) DEFAULT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_total_experience_info`
--

INSERT INTO `employee_total_experience_info` (`id`, `user_id`, `total_polio_experience_year`, `total_polio_experience_month`, `total_polio_experience_day`, `other_experience_year`, `other_experience_month`, `other_experience_day`, `summary_total_experience_year`, `summary_total_experience_month`, `summary_total_experience_day`, `sdt`) VALUES
(1, 5, '2', '0', '0', '0', '0', '0', '2', '0', '0', '2019-05-18 07:59:23'),
(2, 6, '2', '0', '0', '0', '0', '0', '2', '0', '0', '2019-05-31 12:16:30'),
(3, 14, '2', '0', '0', '0', '0', '0', '2', '0', '0', '2019-06-01 08:30:44'),
(4, 17, '2', '0', '0', '0', '0', '0', '2', '0', '0', '2019-07-27 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `ethnicity`
--

DROP TABLE IF EXISTS `ethnicity`;
CREATE TABLE IF NOT EXISTS `ethnicity` (
  `ethnicity_id` int(11) NOT NULL AUTO_INCREMENT,
  `ethnicity_name` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ethnicity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ethnicity`
--

INSERT INTO `ethnicity` (`ethnicity_id`, `ethnicity_name`, `created_at`, `created_by`) VALUES
(1, 'Pakhtoon', NULL, NULL),
(2, 'Baloch', NULL, NULL),
(3, 'Sindhi', NULL, NULL),
(4, 'Punjabi', NULL, NULL),
(5, 'Saraiki', NULL, NULL),
(6, 'Kashmiri', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events_calendar`
--

DROP TABLE IF EXISTS `events_calendar`;
CREATE TABLE IF NOT EXISTS `events_calendar` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `province` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `trg_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_calendar`
--

INSERT INTO `events_calendar` (`event_id`, `title`, `province`, `district`, `project`, `designation`, `trg_type`, `start_date`, `end_date`) VALUES
(1, 'Training for DHCSOs', 4, 2, 5, 22, 1, '2019-07-05', '2019-07-08'),
(2, 'Refresher training for internal staff', 4, 1, 4, 23, 2, '2019-07-05', '2019-07-08'),
(4, 'ASO', 4, 2, 4, 24, 1, '2019-07-09', '2019-07-12'),
(5, 'DSO', 4, 1, 4, 25, 1, '2019-08-15', '2019-08-18'),
(6, 'ASO', 4, 2, 4, 26, 1, '2019-10-12', '2019-10-15'),
(7, 'UCSO', 4, 2, 4, 24, 1, '2019-01-13', '2019-01-16'),
(8, 'ASO', 4, 1, 4, 22, 2, '2019-01-18', '2019-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `ex_admin`
--

DROP TABLE IF EXISTS `ex_admin`;
CREATE TABLE IF NOT EXISTS `ex_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(15) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edited` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_admin`
--

INSERT INTO `ex_admin` (`id`, `username`, `fullname`, `email`, `cnic`, `mobile`, `password`, `date_added`, `date_edited`, `status`) VALUES
(1, 'johndoe', 'John Doe', 'johndoe12@gmail.com', '12234-0989098-9', '00923348909334', '6c074fa94c98638dfe3e3b74240573eb128b3d16', '2019-03-07 03:58:03', '2019-03-07 10:58:03', 1),
(1, 'johndoe', 'John Doe', 'johndoe12@gmail.com', '12234-0989098-9', '00923348909334', '6c074fa94c98638dfe3e3b74240573eb128b3d16', '2019-03-07 05:58:03', '2019-03-07 10:58:03', 1),
(1, 'johndoe', 'John Doe', 'johndoe12@gmail.com', '12234-0989098-9', '00923348909334', '6c074fa94c98638dfe3e3b74240573eb128b3d16', '2019-03-07 05:58:03', '2019-03-07 10:58:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ex_answers`
--

DROP TABLE IF EXISTS `ex_answers`;
CREATE TABLE IF NOT EXISTS `ex_answers` (
  `ans_id` int(15) UNSIGNED NOT NULL,
  `q_id` int(15) NOT NULL,
  `ans_name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_answers`
--

INSERT INTO `ex_answers` (`ans_id`, `q_id`, `ans_name`, `status`) VALUES
(1, 1, 'Imran Khan', 1),
(2, 1, 'Nawaz Sharif', 0),
(3, 1, 'Pervez Musharraf', 0),
(4, 1, 'Abdul Karim', 0),
(124, 2, 'Karachi', 0),
(125, 2, 'Lahore', 0),
(126, 2, 'Islamabad', 1),
(127, 2, 'Peshawar', 0),
(202, 6, 'Benazir Bhutto', 0),
(203, 6, 'M A Jinnah', 0),
(204, 6, 'Khwaja Nazimuddin', 0),
(205, 6, 'Ghulam Ishaq Khan', 1),
(206, 7, '306', 0),
(207, 7, '206', 1),
(208, 7, '406', 0),
(209, 7, '106', 0),
(210, 8, '1994', 1),
(211, 8, '1995', 0),
(212, 8, '1996', 0),
(213, 8, '1993', 0),
(218, 10, 'Rasmus Lerdorf', 1),
(219, 10, 'Mark Zuckerberg', 0),
(220, 10, 'Larray Page', 0),
(221, 10, 'Guido Van Rossum', 0),
(222, 11, 'Friendly', 1),
(223, 11, 'Final', 0),
(224, 11, 'Public', 0),
(225, 11, 'Static', 0),
(226, 12, '1', 0),
(227, 12, '2', 0),
(228, 12, '3', 1),
(229, 12, '4', 0),
(230, 13, '1', 0),
(231, 13, '2', 1),
(232, 13, '3', 0),
(233, 13, '4', 0),
(234, 15, 'Functions', 0),
(235, 15, 'Classes', 0),
(236, 15, 'Flags', 1),
(237, 15, 'None of these', 0),
(238, 30, 'Rasmus Lerdorf in 1994', 1),
(239, 30, 'Guido Van Rossum in 2000', 0),
(240, 30, 'Mark Zuckerberg in 2004', 0),
(241, 30, 'Bill Gates in 1991', 0),
(250, 40, 'Quality Assurance', 1),
(251, 40, 'Quantity Analysis', 0),
(252, 40, 'Quantity Assurance', 0),
(253, 40, 'None of these', 0),
(254, 42, 'Debit', 0),
(255, 42, 'Credit', 1),
(256, 42, 'Addition', 0),
(257, 42, 'None of these', 0),
(258, 43, 'xyz', 1),
(259, 43, 'exy', 0),
(260, 43, 'exy', 0),
(261, 43, 'eec', 0),
(1, 1, 'Imran Khan', 1),
(2, 1, 'Nawaz Sharif', 0),
(3, 1, 'Pervez Musharraf', 0),
(4, 1, 'Abdul Karim', 0),
(124, 2, 'Karachi', 0),
(125, 2, 'Lahore', 0),
(126, 2, 'Islamabad', 1),
(127, 2, 'Peshawar', 0),
(202, 6, 'Benazir Bhutto', 0),
(203, 6, 'M A Jinnah', 0),
(204, 6, 'Khwaja Nazimuddin', 0),
(205, 6, 'Ghulam Ishaq Khan', 1),
(206, 7, '306', 0),
(207, 7, '206', 1),
(208, 7, '406', 0),
(209, 7, '106', 0),
(210, 8, '1994', 1),
(211, 8, '1995', 0),
(212, 8, '1996', 0),
(213, 8, '1993', 0),
(218, 10, 'Rasmus Lerdorf', 1),
(219, 10, 'Mark Zuckerberg', 0),
(220, 10, 'Larray Page', 0),
(221, 10, 'Guido Van Rossum', 0),
(222, 11, 'Friendly', 1),
(223, 11, 'Final', 0),
(224, 11, 'Public', 0),
(225, 11, 'Static', 0),
(226, 12, '1', 0),
(227, 12, '2', 0),
(228, 12, '3', 1),
(229, 12, '4', 0),
(230, 13, '1', 0),
(231, 13, '2', 1),
(232, 13, '3', 0),
(233, 13, '4', 0),
(234, 15, 'Functions', 0),
(235, 15, 'Classes', 0),
(236, 15, 'Flags', 1),
(237, 15, 'None of these', 0),
(238, 30, 'Rasmus Lerdorf in 1994', 1),
(239, 30, 'Guido Van Rossum in 2000', 0),
(240, 30, 'Mark Zuckerberg in 2004', 0),
(241, 30, 'Bill Gates in 1991', 0),
(250, 40, 'Quality Assurance', 1),
(251, 40, 'Quantity Analysis', 0),
(252, 40, 'Quantity Assurance', 0),
(253, 40, 'None of these', 0),
(254, 42, 'Debit', 0),
(255, 42, 'Credit', 1),
(256, 42, 'Addition', 0),
(257, 42, 'None of these', 0),
(258, 43, 'xyz', 1),
(259, 43, 'exy', 0),
(260, 43, 'exy', 0),
(261, 43, 'eec', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ex_applicants`
--

DROP TABLE IF EXISTS `ex_applicants`;
CREATE TABLE IF NOT EXISTS `ex_applicants` (
  `test_id` int(15) NOT NULL AUTO_INCREMENT,
  `question_id` int(15) NOT NULL,
  `answer_id` int(15) NOT NULL,
  `applicant_id` int(15) NOT NULL,
  `exam_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ex_applicants`
--

INSERT INTO `ex_applicants` (`test_id`, `question_id`, `answer_id`, `applicant_id`, `exam_date`) VALUES
(2, 1, 1, 1, '2019-04-24 03:34:03'),
(3, 2, 126, 1, '2019-04-24 03:34:03'),
(4, 4, 113, 1, '2019-04-24 03:34:03'),
(5, 5, 120, 1, '2019-04-24 03:34:03'),
(6, 6, 205, 1, '2019-04-24 03:34:03'),
(7, 7, 207, 1, '2019-04-24 03:34:03'),
(8, 8, 210, 1, '2019-04-24 03:34:03'),
(9, 1, 1, 2, '2019-04-24 03:34:03'),
(10, 2, 126, 2, '2019-04-24 03:34:03'),
(11, 4, 113, 2, '2019-04-24 03:34:03'),
(12, 5, 123, 2, '2019-04-24 03:34:03'),
(13, 6, 203, 2, '2019-04-24 03:34:03'),
(14, 7, 207, 2, '2019-04-24 03:34:03'),
(15, 8, 210, 2, '2019-04-24 03:34:03'),
(16, 9, 217, 2, '2019-04-24 03:34:03'),
(17, 1, 3, 18, '2019-06-01 03:40:17'),
(18, 2, 127, 18, '2019-06-01 03:40:17'),
(19, 6, 204, 18, '2019-06-01 03:40:17'),
(20, 7, 208, 18, '2019-06-01 03:40:17'),
(21, 8, 212, 18, '2019-06-01 03:40:17'),
(22, 10, 218, 18, '2019-06-01 03:40:17'),
(23, 11, 223, 18, '2019-06-01 03:40:17'),
(24, 12, 227, 18, '2019-06-01 03:40:17'),
(25, 13, 231, 18, '2019-06-01 03:40:17'),
(26, 15, 235, 18, '2019-06-01 03:40:17'),
(27, 30, 239, 18, '2019-06-01 03:40:17'),
(28, 40, 251, 18, '2019-06-01 03:40:17'),
(29, 42, 255, 18, '2019-06-01 03:40:17'),
(30, 43, 259, 18, '2019-06-01 03:40:17'),
(31, 1, 1, 0, '2019-07-27 10:23:45'),
(32, 2, 124, 0, '2019-07-27 10:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `ex_questions`
--

DROP TABLE IF EXISTS `ex_questions`;
CREATE TABLE IF NOT EXISTS `ex_questions` (
  `id` int(15) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_questions`
--

INSERT INTO `ex_questions` (`id`, `question`, `status`) VALUES
(1, 'Who is the Prime Minister of Pakistan ?', 1),
(2, 'Which of the following is the capital of Pakistan ? ', 1),
(3, 'How many number of bones are there in the human body ?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name`, `created_at`, `created_by`) VALUES
(1, 'Male', NULL, NULL),
(2, 'Female', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interview_result`
--

DROP TABLE IF EXISTS `interview_result`;
CREATE TABLE IF NOT EXISTS `interview_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollnumber` varchar(20) NOT NULL,
  `obtain_marks` varchar(20) NOT NULL,
  `total_marks` varchar(20) NOT NULL,
  `comments` text NOT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interview_result`
--

INSERT INTO `interview_result` (`id`, `rollnumber`, `obtain_marks`, `total_marks`, `comments`, `sdt`) VALUES
(16, '15', '64', '70', '', '2019-06-01 08:18:50'),
(17, '5', '70', '70', '', '2019-07-26 02:28:27'),
(18, '17', '64', '70', '', '2019-07-27 10:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `investigation`
--

DROP TABLE IF EXISTS `investigation`;
CREATE TABLE IF NOT EXISTS `investigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` int(11) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `sender_remarks` text,
  `receiver` int(11) DEFAULT '0',
  `send_from` enum('head','legal','local') DEFAULT NULL,
  `intended_for` enum('head','legal','local') DEFAULT NULL COMMENT 'Project head, legal dpt, local manager or supervisor',
  `r_date` datetime DEFAULT NULL COMMENT 'Recieving date. This single attribute gives us both the sending and receiving date',
  `status` enum('waiting','pending','resolved','review','process') DEFAULT NULL,
  `type` enum('internal','external') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigation`
--

INSERT INTO `investigation` (`id`, `complaint_id`, `sender`, `sender_remarks`, `receiver`, `send_from`, `intended_for`, `r_date`, `status`, `type`) VALUES
(1, 4, 4, 'asdf', 0, 'head', 'legal', '2019-07-24 10:34:18', 'resolved', 'internal'),
(2, 4, 4, 'xyz', 0, 'legal', 'head', '2019-07-24 10:34:30', 'resolved', 'internal'),
(3, 5, 4, 'askdj', 0, 'head', 'legal', '2019-07-24 10:38:41', 'resolved', 'internal'),
(4, 1, 4, 'lsdkjf', 0, 'head', 'legal', '2019-07-24 10:55:09', 'resolved', 'external'),
(5, 1, 6, 'slkdf', 2, 'legal', 'local', '2019-07-24 11:06:40', 'resolved', 'external'),
(6, 5, 6, 'lsdkf', 2, 'legal', 'local', '2019-07-24 11:29:50', 'resolved', 'internal'),
(7, 5, 2, 'done', 0, 'local', 'legal', '2019-07-24 15:55:43', 'resolved', 'internal'),
(8, 5, 4, 'complete', 0, 'legal', 'head', '2019-07-24 15:56:02', 'resolved', 'internal'),
(9, 7, 4, 'djk', 0, 'head', 'legal', '2019-07-25 07:04:26', 'review', 'internal'),
(10, 7, 6, 'sdklj', 2, 'legal', 'local', '2019-07-25 07:04:50', 'resolved', 'internal'),
(11, 2, 4, 'Sort this issue', 0, 'head', 'legal', '2019-07-25 09:50:51', 'resolved', 'external'),
(12, 2, 6, 'Ok', 2, 'legal', 'local', '2019-07-25 09:51:18', 'resolved', 'external'),
(13, 2, 2, 'Done', 0, 'local', 'legal', '2019-07-25 09:51:45', 'resolved', 'external'),
(14, 2, 4, 'Complete', 0, 'legal', 'head', '2019-07-25 09:52:08', 'resolved', 'external'),
(15, 1, 2, 'sdjf', 0, 'local', 'legal', '2019-07-25 09:52:54', 'resolved', 'external'),
(16, 1, 4, 'djsd', 0, 'legal', 'head', '2019-07-25 09:53:11', 'resolved', 'external'),
(17, 8, 4, 'ksdj', 0, 'head', 'legal', '2019-07-25 09:53:31', 'process', 'internal'),
(18, 8, 6, 'sjd', 2, 'legal', 'local', '2019-07-25 09:53:48', 'pending', 'internal'),
(19, 7, 2, 'skdj', 0, 'local', 'legal', '2019-07-25 09:54:01', 'review', 'internal'),
(20, 6, 4, 'ksjd', 0, 'head', 'legal', '2019-07-25 09:54:14', 'review', 'internal'),
(21, 6, 6, 'djfs', 3, 'legal', 'local', '2019-07-25 09:54:32', 'resolved', 'internal'),
(22, 6, 3, 'sjd', 0, 'local', 'legal', '2019-07-25 09:54:54', 'review', 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `investigation_files`
--

DROP TABLE IF EXISTS `investigation_files`;
CREATE TABLE IF NOT EXISTS `investigation_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_name` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `file_sender` enum('legal','local') DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `investigation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigation_files`
--

INSERT INTO `investigation_files` (`id`, `original_name`, `file_name`, `upload_date`, `complaint_id`, `file_sender`, `uploaded_by`, `investigation_id`) VALUES
(1, 'Annotation_2019-05-28_140751.png', 'add9173a510d0f40205081314c825c4f.png', '2019-07-22 12:11:16', 4, 'legal', NULL, 9),
(2, 'Annotation_2019-05-28_140751.png', 'd2fc750f3c66887b48916c2a5ab99c01.png', '2019-07-22 12:13:05', 4, 'legal', NULL, 10),
(3, 'Annotation_2019-05-28_140751.png', '13f85627aa92c8317d119ae813e7c25d.png', '2019-07-22 12:13:34', 4, 'legal', NULL, 11),
(4, 'Annotation_2019-05-28_140751.png', '9c1f40ff0c55e6b6e08757020d9c5810.png', '2019-07-22 12:14:29', 4, 'legal', NULL, 12),
(5, 'Annotation_2019-05-28_140751.png', '4ff51fb35528bb320c248aa79082b44f.png', '2019-07-22 12:27:21', 5, 'legal', NULL, 15),
(6, 'Annotation_2019-05-28_140751.png', '13184d7f256150e217808ff8ad99da39.png', '2019-07-22 13:25:35', 2, 'legal', NULL, 2),
(7, 'Annotation_2019-05-28_140751.png', 'c5a4775a5206d76d94416d7afcbc28ff.png', '2019-07-22 13:26:24', 5, 'legal', NULL, 4),
(8, 'card-front.png', '4d0bae94490341e64383d3790de5ae08.png', '2019-07-22 15:25:10', 5, 'legal', NULL, 8),
(9, 'Annotation_2019-05-28_140751.png', '1451e433039073cebb11a19e071781dc.png', '2019-07-24 07:32:28', 1, 'local', NULL, 4),
(10, 'Annotation_2019-05-28_140751.png', '055e4656cff056481c3b063892ea11cb.png', '2019-07-24 07:32:44', 1, 'legal', NULL, 5),
(11, 'Annotation_2019-05-28_140751.png', '0ddcbe4d8e08bab18aed1e17a89a56e2.png', '2019-07-24 07:57:57', 2, 'local', NULL, 11),
(12, 'card-front.png', '473bba9d23caea3764d5d3972d03513e.png', '2019-07-24 08:07:59', 4, 'local', NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `investigation_reasons`
--

DROP TABLE IF EXISTS `investigation_reasons`;
CREATE TABLE IF NOT EXISTS `investigation_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_text` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `added_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigation_reasons`
--

INSERT INTO `investigation_reasons` (`id`, `reason_text`, `parent_id`, `added_by`, `created_at`) VALUES
(1, 'Concealment of information', 0, 1, '2019-07-20 15:26:37'),
(2, 'Kinship', 1, 1, '2019-07-20 15:26:45'),
(3, 'Locality', 1, 1, '2019-07-20 15:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `job_experience`
--

DROP TABLE IF EXISTS `job_experience`;
CREATE TABLE IF NOT EXISTS `job_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_job_position`
--

DROP TABLE IF EXISTS `location_job_position`;
CREATE TABLE IF NOT EXISTS `location_job_position` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL DEFAULT '0',
  `province_id` bigint(20) NOT NULL DEFAULT '0',
  `city_id` bigint(20) NOT NULL DEFAULT '0',
  `district_id` bigint(20) NOT NULL DEFAULT '0',
  `tehsil_id` bigint(20) NOT NULL DEFAULT '0',
  `uc_id` bigint(20) NOT NULL DEFAULT '0',
  `area_id` bigint(20) NOT NULL DEFAULT '0',
  `sub_area_id` bigint(20) NOT NULL DEFAULT '0',
  `designation_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `job_code` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_job_position`
--

INSERT INTO `location_job_position` (`id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt`) VALUES
(14, 1, 8, 1, 1, 1, 1, 1, 1, 1, 4, 3, '11', 0, '2019-06-20 16:59:40'),
(13, 1, 4, 2, 1, 1, 1, 1, 1, 1, 5, 4, '66', 0, '2019-06-20 16:58:12'),
(12, 1, 7, 3, 2, 1, 1, 1, 1, 1, 5, 4, '55', 0, '2019-06-20 16:58:12'),
(11, 1, 4, 4, 3, 1, 1, 1, 1, 1, 5, 4, '33', 0, '2019-06-20 16:58:12'),
(19, 2, 5, 2, 0, 2, 2, 1, 1, 1, 4, 4, 'ab', 0, '2019-07-27 09:22:20'),
(31, 8, 7, 1, 0, 1, 1, 1, 1, 1, 3, 4, '43', 0, '2019-07-30 17:52:55'),
(32, 8, 7, 1, 0, 1, 1, 1, 1, 1, 3, 4, '34', 0, '2019-07-30 17:52:55'),
(33, 6, 6, 1, 0, 1, 1, 2, 1, 2, 6, 3, '31', 0, '2019-07-30 17:53:34'),
(34, 6, 6, 1, 0, 1, 1, 2, 1, 2, 6, 3, '31', 0, '2019-07-30 17:53:34'),
(35, 6, 6, 1, 0, 1, 1, 2, 1, 2, 6, 3, '31', 0, '2019-07-30 17:53:34'),
(36, 8, 7, 1, 0, 1, 1, 1, 1, 1, 2, 3, '11', 0, '2019-07-30 18:13:44'),
(37, 7, 8, 1, 0, 1, 1, 1, 1, 1, 3, 3, '31', 0, '2019-07-30 18:17:23'),
(38, 7, 8, 1, 0, 1, 1, 1, 1, 1, 3, 3, '31', 0, '2019-07-30 18:17:23'),
(39, 7, 8, 1, 0, 1, 1, 1, 1, 1, 3, 3, '31', 0, '2019-07-30 18:17:23'),
(40, 17, 12, 4, 0, 2, 2, 2, 2, 2, 3, 4, 'S32', 0, '2019-07-30 19:02:37'),
(41, 17, 12, 4, 0, 2, 2, 2, 2, 2, 3, 4, 'A543', 0, '2019-07-30 19:02:37'),
(42, 17, 12, 4, 0, 2, 2, 2, 2, 2, 3, 4, '543', 0, '2019-07-30 19:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

DROP TABLE IF EXISTS `marital_status`;
CREATE TABLE IF NOT EXISTS `marital_status` (
  `marital_id` int(11) NOT NULL AUTO_INCREMENT,
  `marital_name` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`marital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`marital_id`, `marital_name`, `created_at`, `created_by`) VALUES
(1, 'Married', NULL, NULL),
(2, 'Unmarried', NULL, NULL),
(4, 'Divorced', NULL, NULL),
(5, 'Widowed', NULL, NULL),
(6, 'Separated', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `slug` varchar(25) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `url`, `parent`, `created_at`, `created_by`) VALUES
(1, 'user panel', 'user_panel', 'User_panel', 0, '2019-07-11 12:52:21', 1),
(2, 'investigation', 'investigation', 'investigation', 0, '2019-07-11 12:52:31', 1),
(3, 'reports', 'reports', 'Reports', 0, '2019-07-11 12:52:43', 1),
(4, 'resignations', 'resignations', 'Resignations', 0, '2019-07-11 15:22:57', 1),
(5, 'terminations', 'terminations', 'Terminations', 0, '2019-07-11 15:23:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `create` binary(1) DEFAULT NULL,
  `read` binary(1) DEFAULT NULL,
  `update` binary(1) DEFAULT NULL,
  `delete` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `page_id`, `group_id`, `create`, `read`, `update`, `delete`) VALUES
(1, 1, 1, 0x31, 0x31, 0x31, 0x31),
(2, 2, 1, 0x31, 0x31, 0x31, 0x31),
(3, 3, 1, 0x31, 0x31, 0x31, 0x31),
(4, 4, 1, 0x31, 0x31, 0x31, 0x31),
(5, 5, 1, 0x31, 0x31, 0x31, 0x31),
(6, 1, 2, 0x31, 0x31, 0x31, 0x31),
(7, 2, 2, 0x31, 0x31, 0x31, 0x31),
(8, 3, 2, 0x31, 0x31, 0x31, 0x31),
(9, 4, 2, 0x31, 0x31, 0x31, 0x31),
(10, 5, 2, 0x31, 0x31, 0x31, 0x31),
(11, 1, 3, 0x30, 0x31, 0x30, 0x30),
(12, 2, 3, 0x30, 0x31, 0x30, 0x30),
(13, 3, 3, 0x30, 0x31, 0x30, 0x30),
(14, 4, 3, 0x30, 0x31, 0x30, 0x30),
(15, 5, 3, 0x30, 0x31, 0x30, 0x30),
(16, 1, 4, 0x30, 0x31, 0x30, 0x31),
(17, 2, 4, 0x30, 0x31, 0x30, 0x31),
(18, 3, 4, 0x30, 0x31, 0x30, 0x31),
(19, 4, 4, 0x30, 0x31, 0x30, 0x31),
(20, 5, 4, 0x30, 0x31, 0x30, 0x31),
(21, 1, 5, 0x31, 0x31, 0x31, 0x31),
(22, 2, 5, 0x31, 0x31, 0x31, 0x31),
(23, 3, 5, 0x31, 0x31, 0x31, 0x31),
(24, 4, 5, 0x31, 0x31, 0x31, 0x31),
(25, 5, 5, 0x31, 0x31, 0x31, 0x31),
(26, 1, 6, 0x31, 0x31, 0x31, 0x31),
(27, 2, 6, 0x31, 0x31, 0x31, 0x31),
(28, 3, 6, 0x31, 0x31, 0x31, 0x31),
(29, 4, 6, 0x31, 0x31, 0x31, 0x31),
(30, 5, 6, 0x31, 0x31, 0x31, 0x31),
(31, 1, 7, 0x31, 0x31, 0x31, 0x31),
(32, 2, 7, 0x31, 0x31, 0x31, 0x31),
(33, 3, 7, 0x31, 0x31, 0x31, 0x31),
(34, 4, 7, 0x31, 0x31, 0x31, 0x31),
(35, 5, 7, 0x31, 0x31, 0x31, 0x31),
(36, 1, 8, 0x31, 0x31, 0x31, 0x31),
(37, 2, 8, 0x31, 0x31, 0x31, 0x31),
(38, 3, 8, 0x31, 0x31, 0x31, 0x31),
(39, 4, 8, 0x31, 0x31, 0x31, 0x31),
(40, 5, 8, 0x31, 0x31, 0x31, 0x31),
(41, 1, 9, 0x31, 0x31, 0x31, 0x31),
(42, 2, 9, 0x31, 0x31, 0x31, 0x31),
(43, 3, 9, 0x31, 0x31, 0x31, 0x31),
(44, 4, 9, 0x31, 0x31, 0x31, 0x31),
(45, 5, 9, 0x31, 0x31, 0x31, 0x31),
(46, 1, 10, 0x31, 0x31, 0x31, 0x31),
(47, 2, 10, 0x31, 0x31, 0x31, 0x31),
(48, 3, 10, 0x31, 0x31, 0x31, 0x31),
(49, 4, 10, 0x31, 0x31, 0x31, 0x31),
(50, 5, 10, 0x31, 0x31, 0x31, 0x31),
(51, 1, 11, 0x31, 0x31, 0x31, 0x31),
(52, 2, 11, 0x31, 0x31, 0x31, 0x31),
(53, 3, 11, 0x31, 0x31, 0x31, 0x31),
(54, 4, 11, 0x31, 0x31, 0x31, 0x31),
(55, 5, 11, 0x31, 0x31, 0x31, 0x31),
(56, 1, 12, 0x31, 0x31, 0x31, 0x31),
(57, 2, 12, 0x31, 0x31, 0x31, 0x31),
(58, 3, 12, 0x31, 0x31, 0x31, 0x31),
(59, 4, 12, 0x31, 0x31, 0x31, 0x31),
(60, 5, 12, 0x31, 0x31, 0x31, 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `sortname`, `name`, `slug`) VALUES
(1, '', 'islamabad', 'islamabad'),
(2, '', 'punjab', 'punjab'),
(3, '', 'balochistan', 'balochistan'),
(4, '', 'kp', 'kp');

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

DROP TABLE IF EXISTS `qualification`;
CREATE TABLE IF NOT EXISTS `qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`id`, `name`) VALUES
(1, 'Master'),
(2, 'Graduate'),
(3, 'Intermediate'),
(4, 'Matric'),
(5, 'Middle'),
(6, 'Literate'),
(7, 'Illiterate'),
(8, 'Diploma'),
(9, 'ALem (Islamic Taleem)'),
(10, 'MPhil/MS'),
(11, 'BS (4 Years)'),
(12, 'Madrassa Educated'),
(13, 'DVM'),
(14, 'DAE'),
(15, 'PHD');

-- --------------------------------------------------------

--
-- Table structure for table `resignation_reasons`
--

DROP TABLE IF EXISTS `resignation_reasons`;
CREATE TABLE IF NOT EXISTS `resignation_reasons` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_text` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resignation_reasons`
--

INSERT INTO `resignation_reasons` (`reason_id`, `reason_text`, `added_by`, `created_at`, `status`) VALUES
(1, 'Further Studies', 1, '2019-05-16', 1),
(2, 'Relocation', 1, '2019-05-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `selected_candidates`
--

DROP TABLE IF EXISTS `selected_candidates`;
CREATE TABLE IF NOT EXISTS `selected_candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected_candidates`
--

INSERT INTO `selected_candidates` (`id`, `job_id`, `user_id`, `status`, `sdt`) VALUES
(18, 10, 18, 1, '2019-05-29 10:24:30'),
(19, 10, 14, 1, '2019-05-29 10:24:48'),
(20, 10, 6, 1, '2019-05-31 11:46:14'),
(21, 10, 17, 1, '2019-07-27 10:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `sub_area`
--

DROP TABLE IF EXISTS `sub_area`;
CREATE TABLE IF NOT EXISTS `sub_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `area_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_area`
--

INSERT INTO `sub_area` (`id`, `name`, `area_id`) VALUES
(1, 'sub area1', 1),
(2, 'sub area 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tehsil`
--

DROP TABLE IF EXISTS `tehsil`;
CREATE TABLE IF NOT EXISTS `tehsil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `district_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tehsil`
--

INSERT INTO `tehsil` (`id`, `name`, `district_id`) VALUES
(1, 'kabal', 2),
(2, 'mingovera', 2),
(3, 'bara', 3),
(4, 'jalozai', 3);

-- --------------------------------------------------------

--
-- Table structure for table `termination`
--

DROP TABLE IF EXISTS `termination`;
CREATE TABLE IF NOT EXISTS `termination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `description` text,
  `notice_date` date DEFAULT NULL,
  `terminated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `confirmed_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termination`
--

INSERT INTO `termination` (`id`, `employee_id`, `reason_id`, `other_reason`, `description`, `notice_date`, `terminated_by`, `status`, `confirmed_by`, `confirmed_date`) VALUES
(1, 6, 13, 'None', 'Description', '2019-06-17', 5, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `termination_reasons`
--

DROP TABLE IF EXISTS `termination_reasons`;
CREATE TABLE IF NOT EXISTS `termination_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_text` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termination_reasons`
--

INSERT INTO `termination_reasons` (`id`, `reason_text`, `added_by`, `created_at`, `status`) VALUES
(1, 'Layoff', 1, '2019-06-14 10:12:32', 1),
(2, 'Damaging Company Property', 1, '2019-06-14 10:12:32', 1),
(3, 'Drug or Alcohol Possession at Work', 1, '2019-06-14 10:12:32', 1),
(4, 'Falsifying Company Records', 1, '2019-06-14 10:12:32', 1),
(5, 'Insubordination', 1, '2019-06-14 10:12:32', 1),
(6, 'Misconduct', 1, '2019-06-14 10:12:32', 1),
(7, 'Poor Performance', 1, '2019-06-14 10:12:32', 1),
(8, 'Stealing', 1, '2019-06-14 10:12:32', 1),
(9, 'Using Company Property for Personal Business', 1, '2019-06-14 10:12:32', 1),
(10, 'Taking Too Much Time Off', 1, '2019-06-14 10:12:32', 1),
(11, 'Violating Company Policy', 1, '2019-06-14 10:12:32', 1),
(12, 'Voluntary Termination', 1, '2019-06-14 10:12:32', 1),
(13, 'Involuntary Termination', 1, '2019-06-14 10:12:32', 1),
(14, 'Discriminatory Conduct Towards others', 1, '2019-06-14 10:12:32', 1),
(15, 'Harassment (Sexual and Otherwise)', 1, '2019-06-14 10:12:32', 1),
(16, '', NULL, '2019-06-17 22:24:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

DROP TABLE IF EXISTS `test_result`;
CREATE TABLE IF NOT EXISTS `test_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollnumber` varchar(20) NOT NULL,
  `obtain_marks` varchar(20) NOT NULL,
  `total_marks` varchar(20) NOT NULL,
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`id`, `rollnumber`, `obtain_marks`, `total_marks`, `sdt`) VALUES
(11, '15', '44', '66', '2019-06-01 13:20:03'),
(12, '17', '10', '20', '2019-07-27 15:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `training_attendance`
--

DROP TABLE IF EXISTS `training_attendance`;
CREATE TABLE IF NOT EXISTS `training_attendance` (
  `attendance_id` int(111) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) NOT NULL,
  `training_id` int(111) NOT NULL,
  `emp_id` int(111) NOT NULL,
  `project_id` int(111) NOT NULL,
  `attendance_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`attendance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_attendance`
--

INSERT INTO `training_attendance` (`attendance_id`, `status`, `training_id`, `emp_id`, `project_id`, `attendance_date`) VALUES
(1, 'Absent', 1, 1, 4, '2019-05-25 01:48:20'),
(2, 'Present', 1, 2, 4, '2019-05-25 01:48:20'),
(3, 'Absent', 1, 3, 4, '2019-05-25 01:48:20'),
(4, 'Present', 1, 8, 4, '2019-05-25 01:48:20'),
(9, 'Present', 2, 4, 5, '2019-05-25 01:48:20'),
(30, 'Present', 7, 8, 4, '2019-06-13 05:49:10'),
(29, 'Absent', 7, 7, 4, '2019-06-13 05:49:10'),
(28, 'Present', 7, 6, 4, '2019-06-13 05:49:10'),
(66, 'Present', 6, 8, 4, '2019-06-15 06:57:44'),
(26, 'Present', 7, 3, 4, '2019-06-13 05:49:10'),
(65, 'Present', 6, 7, 4, '2019-06-15 06:57:44'),
(24, 'Present', 7, 1, 4, '2019-06-13 05:49:10'),
(64, 'Present', 6, 6, 4, '2019-06-15 06:57:44'),
(63, 'Absent', 6, 4, 4, '2019-06-15 06:57:44'),
(33, 'Present', 7, 2, 4, '2019-06-13 05:52:15'),
(62, 'Present', 6, 3, 4, '2019-06-15 06:57:44'),
(61, 'Present', 6, 2, 4, '2019-06-15 06:57:44'),
(37, 'Absent', 7, 7, 4, '2019-06-13 05:52:15'),
(60, 'Present', 6, 1, 4, '2019-06-15 06:57:44'),
(58, 'Present', 8, 7, 4, '2019-06-14 10:00:00'),
(57, 'Present', 8, 6, 4, '2019-06-14 10:00:00'),
(56, 'Present', 8, 4, 4, '2019-06-14 10:00:00'),
(55, 'Present', 8, 3, 4, '2019-06-14 10:00:00'),
(54, 'Present', 8, 2, 4, '2019-06-14 10:00:00'),
(53, 'Absent', 8, 1, 4, '2019-06-14 10:00:00'),
(59, 'Absent', 8, 8, 4, '2019-06-14 10:00:00'),
(67, 'Absent', 7, 1, 4, '2019-06-17 08:11:27'),
(68, 'Present', 7, 2, 4, '2019-06-17 08:11:27'),
(69, 'Present', 7, 3, 4, '2019-06-17 08:11:27'),
(70, 'Present', 7, 4, 4, '2019-06-17 08:11:27'),
(71, 'Present', 7, 6, 4, '2019-06-17 08:11:27'),
(72, 'Present', 7, 7, 4, '2019-06-17 08:11:27'),
(73, 'Present', 7, 8, 4, '2019-06-17 08:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `tribe`
--

DROP TABLE IF EXISTS `tribe`;
CREATE TABLE IF NOT EXISTS `tribe` (
  `tribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `tribe_name` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`tribe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=542 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tribe`
--

INSERT INTO `tribe` (`tribe_id`, `tribe_name`, `created_at`, `created_by`) VALUES
(1, 'Yousafzai', NULL, NULL),
(2, 'Afridi', NULL, NULL),
(3, 'Khattak', NULL, NULL),
(4, 'Wazir', NULL, NULL),
(5, 'Yousaf Zai', NULL, NULL),
(6, 'Mughal', NULL, NULL),
(7, 'Mangrio', NULL, NULL),
(8, 'Rajpoot', NULL, NULL),
(9, 'Chughtai', NULL, NULL),
(10, 'Khattak', NULL, NULL),
(11, 'Naul (Rajput)', NULL, NULL),
(12, 'Arain', NULL, NULL),
(13, 'Jatt', NULL, NULL),
(14, 'Bhutta', NULL, NULL),
(15, 'Niazi', NULL, NULL),
(16, 'Khan', NULL, NULL),
(17, 'Laang', NULL, NULL),
(18, 'Noon', NULL, NULL),
(19, 'Bukhari', NULL, NULL),
(20, 'Khokhar', NULL, NULL),
(21, 'Malik', NULL, NULL),
(22, 'Chaudhry', NULL, NULL),
(23, 'Qazi', NULL, NULL),
(24, 'Alyani', NULL, NULL),
(25, 'Khoja', NULL, NULL),
(26, 'Manjotha', NULL, NULL),
(27, 'Bubar', NULL, NULL),
(28, 'Wattoo', NULL, NULL),
(29, 'Gujjar', NULL, NULL),
(30, 'Awan', NULL, NULL),
(31, 'Mohmand', NULL, NULL),
(32, 'Sheikh', NULL, NULL),
(33, 'Dhoon Awan', NULL, NULL),
(34, 'Kassar', NULL, NULL),
(35, 'Saraiki', NULL, NULL),
(36, 'Sayed', NULL, NULL),
(37, 'Tajra', NULL, NULL),
(38, 'Nonari', NULL, NULL),
(39, 'Hashmi', NULL, NULL),
(40, 'Jatoi', NULL, NULL),
(41, 'kashmiri', NULL, NULL),
(42, 'Siddiqui', NULL, NULL),
(43, 'Sardar', NULL, NULL),
(44, 'Bhatti', NULL, NULL),
(45, 'Butt', NULL, NULL),
(46, 'Safi', NULL, NULL),
(47, 'Rana', NULL, NULL),
(48, 'Qureshi', NULL, NULL),
(49, 'Moucher', NULL, NULL),
(50, 'Bohar', NULL, NULL),
(51, 'Rao', NULL, NULL),
(52, 'Naqvi', NULL, NULL),
(53, 'Sindila', NULL, NULL),
(54, 'Khaki', NULL, NULL),
(55, 'kohkhar', NULL, NULL),
(56, 'Kazmi', NULL, NULL),
(57, 'Baloch', NULL, NULL),
(58, 'Marha', NULL, NULL),
(59, 'Gazar', NULL, NULL),
(60, 'Jutt odhana', NULL, NULL),
(61, 'Shah', NULL, NULL),
(62, 'Daha', NULL, NULL),
(63, 'Jam', NULL, NULL),
(64, 'Taragar', NULL, NULL),
(65, 'Dharkan', NULL, NULL),
(66, 'Mughlani', NULL, NULL),
(67, 'Jogyani', NULL, NULL),
(68, 'Zohrani', NULL, NULL),
(69, 'Lashair', NULL, NULL),
(70, 'Mithwani', NULL, NULL),
(71, 'Khosa', NULL, NULL),
(72, 'Nutkani', NULL, NULL),
(73, 'Lagrana', NULL, NULL),
(74, 'Mulghani Baloch', NULL, NULL),
(75, 'Ansari', NULL, NULL),
(76, 'Kitchi', NULL, NULL),
(77, 'Afridi', NULL, NULL),
(78, 'Chatta', NULL, NULL),
(79, 'Khalil', NULL, NULL),
(80, 'Swati', NULL, NULL),
(81, 'Muhammad zai', NULL, NULL),
(82, 'Mumakzai', NULL, NULL),
(83, 'Bahacher', NULL, NULL),
(84, 'Mian', NULL, NULL),
(85, 'Wali Khel', NULL, NULL),
(86, 'Hassan Khel', NULL, NULL),
(87, 'Meo', NULL, NULL),
(88, 'Sial', NULL, NULL),
(89, 'Abbasi', NULL, NULL),
(90, 'Meyo', NULL, NULL),
(91, 'Kambho', NULL, NULL),
(92, 'Sawati', NULL, NULL),
(93, 'Mehar', NULL, NULL),
(94, 'Chachar', NULL, NULL),
(95, 'Sheen', NULL, NULL),
(96, 'Chinoti', NULL, NULL),
(97, 'Khoso', NULL, NULL),
(98, 'Hashmi syed', NULL, NULL),
(99, 'Mahsud', NULL, NULL),
(100, 'Jadoon', NULL, NULL),
(101, 'Momand', NULL, NULL),
(102, 'Gadani', NULL, NULL),
(103, 'Memon', NULL, NULL),
(104, 'Magsi', NULL, NULL),
(105, 'Soomro', NULL, NULL),
(106, 'Abro', NULL, NULL),
(107, 'Mahar', NULL, NULL),
(108, 'Mallah', NULL, NULL),
(109, 'Unar', NULL, NULL),
(110, 'Ahmedani', NULL, NULL),
(111, 'Laghari', NULL, NULL),
(112, 'Chandia', NULL, NULL),
(113, 'Wagan', NULL, NULL),
(114, 'Syed', NULL, NULL),
(115, 'Bhutto', NULL, NULL),
(116, 'Baldai', NULL, NULL),
(117, 'Bungash', NULL, NULL),
(118, 'Langar', NULL, NULL),
(119, 'Pechuho', NULL, NULL),
(120, 'Lashari', NULL, NULL),
(121, 'Kohistani', NULL, NULL),
(122, 'Mangi', NULL, NULL),
(123, 'Hashmani', NULL, NULL),
(124, 'Atman Zai', NULL, NULL),
(125, 'Quresh Sayyad', NULL, NULL),
(126, 'Barakzai', NULL, NULL),
(127, 'Shinwari', NULL, NULL),
(128, 'Durrani', NULL, NULL),
(129, 'Akbari', NULL, NULL),
(130, 'Arbab', NULL, NULL),
(131, 'Jamali', NULL, NULL),
(132, 'Meghwar', NULL, NULL),
(133, 'Sawand', NULL, NULL),
(134, 'Jafri', NULL, NULL),
(135, 'Popalzai', NULL, NULL),
(136, 'Khawaja', NULL, NULL),
(137, 'Veesar', NULL, NULL),
(138, 'Marwat', NULL, NULL),
(139, 'Khuhawar', NULL, NULL),
(140, 'Nahyoon', NULL, NULL),
(141, 'Lodo', NULL, NULL),
(142, 'Gopang', NULL, NULL),
(143, 'Awan Malik', NULL, NULL),
(144, 'Mehmoodani', NULL, NULL),
(145, 'Mastoi', NULL, NULL),
(146, 'Halipoto', NULL, NULL),
(147, 'Alwi', NULL, NULL),
(148, 'Bhakhatri', NULL, NULL),
(149, 'Arani', NULL, NULL),
(150, 'Wazir', NULL, NULL),
(151, 'Saleh Khail', NULL, NULL),
(152, 'Lodhi', NULL, NULL),
(153, 'Godhra', NULL, NULL),
(154, 'Usman Khel', NULL, NULL),
(155, 'Behari', NULL, NULL),
(156, 'Qaimkhani', NULL, NULL),
(157, 'Salarzai', NULL, NULL),
(158, 'Channa', NULL, NULL),
(159, 'Akakheel', NULL, NULL),
(160, 'Qurashi', NULL, NULL),
(161, 'Bangash', NULL, NULL),
(162, 'Shirazi', NULL, NULL),
(163, 'Mnalak', NULL, NULL),
(164, 'Golani', NULL, NULL),
(165, 'Lasi', NULL, NULL),
(166, 'Khan khel', NULL, NULL),
(167, 'Tanoli', NULL, NULL),
(168, 'Suneer', NULL, NULL),
(169, 'Sindhi', NULL, NULL),
(170, 'KhasKelli', NULL, NULL),
(171, 'Durzada', NULL, NULL),
(172, 'Toori Bangash', NULL, NULL),
(173, 'Farooqi', NULL, NULL),
(174, 'Qutteawal', NULL, NULL),
(175, 'syed hashmi', NULL, NULL),
(176, 'Pitafi ', NULL, NULL),
(177, 'Lund', NULL, NULL),
(178, 'Rind', NULL, NULL),
(179, 'Samat', NULL, NULL),
(180, 'Lasahri', NULL, NULL),
(181, 'Dasti', NULL, NULL),
(182, 'Naich', NULL, NULL),
(183, 'Sethi', NULL, NULL),
(184, 'Syed Qazi', NULL, NULL),
(185, 'Dayo', NULL, NULL),
(186, 'Kalwar', NULL, NULL),
(187, 'Golo', NULL, NULL),
(188, 'khyber', NULL, NULL),
(189, 'Chandio', NULL, NULL),
(190, 'Khalhi', NULL, NULL),
(191, 'Uthman khel', NULL, NULL),
(192, 'Dahri', NULL, NULL),
(193, 'Mirza', NULL, NULL),
(194, 'Halim zai', NULL, NULL),
(195, 'Mithani', NULL, NULL),
(196, 'Khashkelly ', NULL, NULL),
(197, 'Achakzai', NULL, NULL),
(198, 'Bugho', NULL, NULL),
(199, 'barohi', NULL, NULL),
(200, 'peshaweri', NULL, NULL),
(201, 'merwat', NULL, NULL),
(202, 'Solangi', NULL, NULL),
(203, 'Khalil Mohmand', NULL, NULL),
(204, 'Mohammadzai', NULL, NULL),
(205, 'Bittani', NULL, NULL),
(206, 'Maleezai', NULL, NULL),
(207, 'Nawab Khel', NULL, NULL),
(208, 'Daudzai', NULL, NULL),
(209, 'Ahmad Zai', NULL, NULL),
(210, 'Orakzai', NULL, NULL),
(211, 'Sadaat', NULL, NULL),
(212, 'Khaikhwankhail', NULL, NULL),
(213, 'Waraich', NULL, NULL),
(214, 'Gigyani', NULL, NULL),
(215, 'Taran', NULL, NULL),
(216, 'Kaka khel', NULL, NULL),
(217, 'Batakzai', NULL, NULL),
(218, 'Tahi Khel', NULL, NULL),
(219, 'Batoor Khel', NULL, NULL),
(220, 'Banochi', NULL, NULL),
(221, 'Banusi', NULL, NULL),
(222, 'Sahi', NULL, NULL),
(223, 'Singhar', NULL, NULL),
(224, 'Kundi', NULL, NULL),
(225, 'Quraish', NULL, NULL),
(226, 'Bajaj', NULL, NULL),
(227, 'Gandapur', NULL, NULL),
(228, 'Parachgan', NULL, NULL),
(229, 'Dagwal', NULL, NULL),
(230, 'Kakar', NULL, NULL),
(231, 'Sahibzadgan', NULL, NULL),
(232, 'Sayyed', NULL, NULL),
(233, 'Akka Khel', NULL, NULL),
(234, 'Mast Khel', NULL, NULL),
(235, 'Sultan Khel', NULL, NULL),
(236, 'Tarkalani', NULL, NULL),
(237, 'Gorsain', NULL, NULL),
(238, 'Sardar khel', NULL, NULL),
(239, 'Umarzai', NULL, NULL),
(240, 'Kamal Khel', NULL, NULL),
(241, 'Miagan', NULL, NULL),
(242, 'Lohar', NULL, NULL),
(243, 'Sabz Khel', NULL, NULL),
(244, 'Peeran', NULL, NULL),
(245, 'Sarwan', NULL, NULL),
(246, 'Taizai', NULL, NULL),
(247, 'Uthmanzai', NULL, NULL),
(248, 'Mahajir', NULL, NULL),
(249, 'Hashnaghri', NULL, NULL),
(250, 'Mohajar', NULL, NULL),
(251, 'Uttra', NULL, NULL),
(252, 'Hargan', NULL, NULL),
(253, 'Siyal', NULL, NULL),
(254, 'Kanera', NULL, NULL),
(255, 'Sipra', NULL, NULL),
(256, 'Chinwar', NULL, NULL),
(257, 'Malana', NULL, NULL),
(258, 'Sakhani Baloch', NULL, NULL),
(259, 'Issar', NULL, NULL),
(260, 'Machi', NULL, NULL),
(261, 'Jara', NULL, NULL),
(262, 'Kati Khail', NULL, NULL),
(263, 'Babu Khel', NULL, NULL),
(264, 'Saggu', NULL, NULL),
(265, 'Mehsud', NULL, NULL),
(266, 'Gandroya', NULL, NULL),
(267, 'Azam khel', NULL, NULL),
(268, 'Bhittani', NULL, NULL),
(269, 'Burki', NULL, NULL),
(270, 'Dawar', NULL, NULL),
(271, 'Tarakzai', NULL, NULL),
(272, 'Mula khel', NULL, NULL),
(273, 'Syed khel', NULL, NULL),
(274, 'Satti', NULL, NULL),
(275, 'Bajouri', NULL, NULL),
(276, 'Saafi', NULL, NULL),
(277, 'Sumalani', NULL, NULL),
(278, 'Lehri', NULL, NULL),
(279, 'Kasi', NULL, NULL),
(280, 'Miani', NULL, NULL),
(281, 'Marri', NULL, NULL),
(282, 'Harrifal', NULL, NULL),
(283, 'Nasar', NULL, NULL),
(284, 'Langov', NULL, NULL),
(285, 'Sasoli', NULL, NULL),
(286, 'Mengal', NULL, NULL),
(287, 'Bughti', NULL, NULL),
(288, 'Mandokhail', NULL, NULL),
(289, 'Pirkani', NULL, NULL),
(290, 'Barech', NULL, NULL),
(291, 'Tareen', NULL, NULL),
(292, 'Bhanger', NULL, NULL),
(293, 'Pechuha', NULL, NULL),
(294, 'Khajak', NULL, NULL),
(295, 'Khilji', NULL, NULL),
(296, 'Bangulzai', NULL, NULL),
(297, 'Ayuobi', NULL, NULL),
(298, 'Badini', NULL, NULL),
(299, 'Muhammad Hassni', NULL, NULL),
(300, 'Samulani', NULL, NULL),
(301, 'Khorasani', NULL, NULL),
(302, 'Zehri', NULL, NULL),
(303, 'Domar', NULL, NULL),
(304, 'Batani', NULL, NULL),
(305, 'Noorzai', NULL, NULL),
(306, 'kakezai', NULL, NULL),
(307, 'Rakhshani', NULL, NULL),
(308, 'Muhammad Shai', NULL, NULL),
(309, 'Batti', NULL, NULL),
(310, 'Luni', NULL, NULL),
(311, 'Pechwa', NULL, NULL),
(312, 'Umrani', NULL, NULL),
(313, 'Mastio', NULL, NULL),
(314, 'Chukhra', NULL, NULL),
(315, 'Behrani', NULL, NULL),
(316, 'Chalgari', NULL, NULL),
(317, 'Mostoi', NULL, NULL),
(318, 'Ghunia', NULL, NULL),
(319, 'Katbar', NULL, NULL),
(320, 'Babar', NULL, NULL),
(321, 'Khostai', NULL, NULL),
(322, 'Satakzai', NULL, NULL),
(323, 'Thari wall', NULL, NULL),
(324, 'Adi Zai', NULL, NULL),
(325, 'Koki Khel', NULL, NULL),
(326, 'Oba Khel', NULL, NULL),
(327, 'Wora Bacha Khel', NULL, NULL),
(328, 'Bacha Khel', NULL, NULL),
(329, 'Sarmat Khel', NULL, NULL),
(330, 'Ostaryani', NULL, NULL),
(331, 'Khewzai Mohman', NULL, NULL),
(332, 'Rabia Khel', NULL, NULL),
(333, 'Ali Sherzai', NULL, NULL),
(334, 'Tori', NULL, NULL),
(335, 'Yar gul Khel', NULL, NULL),
(336, 'Mulaghori', NULL, NULL),
(337, 'Loyi Shalman', NULL, NULL),
(338, 'Qalaqai Khewzai', NULL, NULL),
(339, 'Halmzai', NULL, NULL),
(340, 'Khewzai Khalodaq', NULL, NULL),
(341, 'Burhan Khel', NULL, NULL),
(342, 'Shinwari Safi', NULL, NULL),
(343, 'Gurbaz safi', NULL, NULL),
(344, 'Ala Khel', NULL, NULL),
(345, 'Tor Khel', NULL, NULL),
(346, 'Sadat Khel', NULL, NULL),
(347, 'Sarkani Khel', NULL, NULL),
(348, 'Tarkani', NULL, NULL),
(349, 'Prachamkani', NULL, NULL),
(350, 'Ghalji', NULL, NULL),
(351, 'Musaki', NULL, NULL),
(352, 'Sher Khel', NULL, NULL),
(353, 'Miami Kabal Khel', NULL, NULL),
(354, 'Dottani', NULL, NULL),
(355, 'Malak Khan', NULL, NULL),
(356, 'Malak din khel', NULL, NULL),
(357, 'Kamar Khel', NULL, NULL),
(358, 'Sandokhel', NULL, NULL),
(359, 'Darwazgai', NULL, NULL),
(360, 'Tokhti Khel', NULL, NULL),
(361, 'Karmat Khel', NULL, NULL),
(362, 'Otizai', NULL, NULL),
(363, 'Ganda Pur', NULL, NULL),
(364, 'Hindo', NULL, NULL),
(365, 'Not Available', NULL, NULL),
(366, 'Mian Khel', NULL, NULL),
(367, 'Ghani Khel', NULL, NULL),
(368, 'Dogar', NULL, NULL),
(369, 'Saidgi', NULL, NULL),
(370, 'Lghari', NULL, NULL),
(371, 'Malghani', NULL, NULL),
(372, 'Qaisrani', NULL, NULL),
(373, 'Hashmi Makhdom', NULL, NULL),
(374, 'Babbar', NULL, NULL),
(375, 'Punjabi', NULL, NULL),
(376, 'Pathan', NULL, NULL),
(377, 'Khangor Mian', NULL, NULL),
(378, 'Sewera', NULL, NULL),
(379, 'Khitran', NULL, NULL),
(380, 'Sikhani', NULL, NULL),
(381, 'Langrana', NULL, NULL),
(382, 'Khalung', NULL, NULL),
(383, 'Orangzai', NULL, NULL),
(384, 'Wazeer', NULL, NULL),
(385, 'Rehmani', NULL, NULL),
(386, 'Kutt', NULL, NULL),
(387, 'Chohan', NULL, NULL),
(388, 'Ronga', NULL, NULL),
(389, 'Christian', NULL, NULL),
(390, 'ghori', NULL, NULL),
(391, 'Dado Khel', NULL, NULL),
(392, 'Kakayzai', NULL, NULL),
(393, 'Jaitoi', NULL, NULL),
(394, 'Qasisrani', NULL, NULL),
(395, 'Musa Khel', NULL, NULL),
(396, 'Langha', NULL, NULL),
(397, 'Lakhani', NULL, NULL),
(398, 'Ahmadani', NULL, NULL),
(399, 'Dhandla', NULL, NULL),
(400, 'Dashti', NULL, NULL),
(401, 'Mohana', NULL, NULL),
(402, 'Sangi', NULL, NULL),
(403, 'Achakzai', NULL, NULL),
(404, 'Hazara', NULL, NULL),
(405, 'Afghani', NULL, NULL),
(406, 'Bajwa', NULL, NULL),
(407, 'Bakarzai(Syed Tribe)', NULL, NULL),
(408, 'Alkozai', NULL, NULL),
(409, 'Ishaqzai', NULL, NULL),
(410, 'Jatak', NULL, NULL),
(411, 'Kharooti', NULL, NULL),
(412, 'Meerani', NULL, NULL),
(413, 'Saagzai', NULL, NULL),
(414, 'Sherani', NULL, NULL),
(415, 'Suleman Khel', NULL, NULL),
(416, 'Tarakai', NULL, NULL),
(417, 'Wardag', NULL, NULL),
(418, '99-Info not available ', NULL, NULL),
(419, 'Watak', NULL, NULL),
(420, 'Ghakkar', NULL, NULL),
(421, 'Kiyani', NULL, NULL),
(422, 'Yashkin', NULL, NULL),
(423, 'Virk', NULL, NULL),
(424, 'Shahwani', NULL, NULL),
(425, 'Mishwani ', NULL, NULL),
(426, 'sulemani', NULL, NULL),
(427, 'Khurasani', NULL, NULL),
(428, 'Dehwar', NULL, NULL),
(429, 'Azasani', NULL, NULL),
(430, 'Raisani', NULL, NULL),
(431, 'Kurd', NULL, NULL),
(432, 'Kolojat', NULL, NULL),
(433, 'Qambrani', NULL, NULL),
(434, 'M.Shahi', NULL, NULL),
(435, 'Ababaki', NULL, NULL),
(436, 'zinran pashto', NULL, NULL),
(437, 'Adrakzai', NULL, NULL),
(438, 'Zarkon', NULL, NULL),
(439, 'Ali zai', NULL, NULL),
(440, 'Yar Muhammadzai', NULL, NULL),
(441, 'Arozai', NULL, NULL),
(442, 'urduzai', NULL, NULL),
(443, 'Tamarzai', NULL, NULL),
(444, 'Awan zai', NULL, NULL),
(445, 'Tajak', NULL, NULL),
(446, 'Badezai', NULL, NULL),
(447, 'surkhani', NULL, NULL),
(448, 'Baloch umarani', NULL, NULL),
(449, 'sumrani', NULL, NULL),
(450, 'Barozai', NULL, NULL),
(451, 'saypad', NULL, NULL),
(452, 'Bazai', NULL, NULL),
(453, 'Sarpara', NULL, NULL),
(454, 'Bilalzai ashezai', NULL, NULL),
(455, 'sarangzai', NULL, NULL),
(456, 'biyanzai', NULL, NULL),
(457, 'Bulaida', NULL, NULL),
(458, 'Santra', NULL, NULL),
(459, 'Buzdar', NULL, NULL),
(460, 'Salmanzai', NULL, NULL),
(461, 'Cheema', NULL, NULL),
(462, 'Dar', NULL, NULL),
(463, 'Rodani', NULL, NULL),
(464, 'Reki', NULL, NULL),
(465, 'Rehmatzai', NULL, NULL),
(466, 'Denarzai', NULL, NULL),
(467, 'Rahes', NULL, NULL),
(468, 'Qalandarani', NULL, NULL),
(469, 'Farsi', NULL, NULL),
(470, 'Pnazai', NULL, NULL),
(471, 'Garmani', NULL, NULL),
(472, 'Gashkori', NULL, NULL),
(473, 'Pandrani', NULL, NULL),
(474, 'Ghabzai', NULL, NULL),
(475, 'Ghazi Khail', NULL, NULL),
(476, 'Uzbeq', NULL, NULL),
(477, 'Ghramzai', NULL, NULL),
(478, 'noorani baloch', NULL, NULL),
(479, 'Gill', NULL, NULL),
(480, 'Nosherwani', NULL, NULL),
(481, 'Nichari', NULL, NULL),
(482, 'Gull', NULL, NULL),
(483, 'Gull Mani', NULL, NULL),
(484, 'Nazarzai', NULL, NULL),
(485, 'Hamedzai', NULL, NULL),
(486, 'Naai', NULL, NULL),
(487, 'Hindko', NULL, NULL),
(488, 'Miralizai', NULL, NULL),
(489, 'jagro', NULL, NULL),
(490, 'Metarzai', NULL, NULL),
(491, 'Jamot', NULL, NULL),
(492, 'Kabul', NULL, NULL),
(493, 'Mankazai', NULL, NULL),
(494, 'Kamrani', NULL, NULL),
(495, 'Mahterzai', NULL, NULL),
(496, 'Mahal', NULL, NULL),
(497, 'kerahi', NULL, NULL),
(498, 'Madkhanzai', NULL, NULL),
(499, 'Khosa', NULL, NULL),
(500, 'Kujazai', NULL, NULL),
(501, 'Kujakhel', NULL, NULL),
(502, 'Boda Khel', NULL, NULL),
(503, 'Chitrali', NULL, NULL),
(504, 'Kada khel', NULL, NULL),
(505, 'Koi Khel', NULL, NULL),
(506, 'Sebadin Khel', NULL, NULL),
(507, 'Utizai', NULL, NULL),
(508, 'Adam Khel', NULL, NULL),
(509, 'Akhoonzada', NULL, NULL),
(510, 'Baghwanan', NULL, NULL),
(511, 'Barki', NULL, NULL),
(512, 'Sadozai', NULL, NULL),
(513, 'Samezai', NULL, NULL),
(514, 'Sanzerkhail', NULL, NULL),
(515, 'Babai', NULL, NULL),
(516, 'Baltistani', NULL, NULL),
(517, 'Chamdir ', NULL, NULL),
(518, 'Derawal', NULL, NULL),
(519, 'Durakzai', NULL, NULL),
(520, 'Elaka', NULL, NULL),
(521, 'Ghosti', NULL, NULL),
(522, 'Harai', NULL, NULL),
(523, 'Hassani', NULL, NULL),
(524, 'Jamaldini', NULL, NULL),
(525, 'Jogezai', NULL, NULL),
(526, 'Juiya', NULL, NULL),
(527, 'Karlal', NULL, NULL),
(528, 'Kulachi', NULL, NULL),
(529, 'Kumar', NULL, NULL),
(530, 'mamshai', NULL, NULL),
(531, 'Marghzani', NULL, NULL),
(532, 'Meer', NULL, NULL),
(533, 'Merwani', NULL, NULL),
(534, 'Metezai', NULL, NULL),
(535, 'Mullazai', NULL, NULL),
(536, 'Mutkani', NULL, NULL),
(537, 'Raghi', NULL, NULL),
(538, 'Zandran', NULL, NULL),
(539, 'Narooi', NULL, NULL),
(540, 'Teli', NULL, NULL),
(541, 'Thaheem', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `union_councel`
--

DROP TABLE IF EXISTS `union_councel`;
CREATE TABLE IF NOT EXISTS `union_councel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `tehsil_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `union_councel`
--

INSERT INTO `union_councel` (`id`, `name`, `tehsil_id`) VALUES
(1, 'UC1', 1),
(2, 'UC 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `department_id`, `created_at`, `created_by`) VALUES
(1, 'manager', 5, '2019-07-12 07:20:30', 1),
(2, 'data entry', 5, '2019-07-12 07:20:36', 1),
(3, 'data entry', 1, '2019-07-12 08:08:46', 1),
(4, 'manager', 2, '2019-07-12 09:40:11', 1),
(5, 'data entry', 2, '2019-07-12 09:40:24', 1),
(6, 'manager', 3, '2019-07-12 09:40:31', 1),
(7, 'data entry', 3, '2019-07-12 09:40:38', 1),
(8, 'manager', 4, '2019-07-12 09:41:01', 1),
(9, 'data entry', 4, '2019-07-12 09:52:10', 1),
(10, 'view only', 4, '2019-07-12 09:52:38', 1),
(11, 'view only', 5, '2019-07-12 09:53:17', 1),
(12, 'manager', 1, '2019-07-13 07:11:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xin_activity_reporting`
--

DROP TABLE IF EXISTS `xin_activity_reporting`;
CREATE TABLE IF NOT EXISTS `xin_activity_reporting` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `trg_id` int(11) NOT NULL,
  `trg_type` varchar(255) NOT NULL,
  `staff_travel` varchar(100) NOT NULL,
  `rooms` varchar(100) NOT NULL,
  `budget_amount` varchar(111) NOT NULL,
  `actual_expenses` varchar(111) NOT NULL,
  `checklist` varchar(111) NOT NULL,
  `chip_rep` varchar(255) NOT NULL,
  `unicef_rep` varchar(255) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_activity_reporting`
--

INSERT INTO `xin_activity_reporting` (`activity_id`, `trg_id`, `trg_type`, `staff_travel`, `rooms`, `budget_amount`, `actual_expenses`, `checklist`, `chip_rep`, `unicef_rep`) VALUES
(1, 6, 'Residential', '15', '4', '25000', '23000', '1,2,,4,5', 'Mubeen, Finance Manger', 'Saddam, Area Manger');

-- --------------------------------------------------------

--
-- Table structure for table `xin_advance_salaries`
--

DROP TABLE IF EXISTS `xin_advance_salaries`;
CREATE TABLE IF NOT EXISTS `xin_advance_salaries` (
  `advance_salary_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `month_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advance_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `one_time_deduct` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `monthly_installment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_paid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_deducted_from_salary` int(11) NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`advance_salary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_announcements`
--

DROP TABLE IF EXISTS `xin_announcements`;
CREATE TABLE IF NOT EXISTS `xin_announcements` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `company_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `published_by` int(111) NOT NULL,
  `summary` text NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_attendance_time`
--

DROP TABLE IF EXISTS `xin_attendance_time`;
CREATE TABLE IF NOT EXISTS `xin_attendance_time` (
  `time_attendance_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `attendance_date` varchar(255) NOT NULL,
  `clock_in` varchar(255) NOT NULL,
  `clock_out` varchar(255) NOT NULL,
  `clock_in_out` varchar(255) NOT NULL,
  `time_late` varchar(255) NOT NULL,
  `early_leaving` varchar(255) NOT NULL,
  `overtime` varchar(255) NOT NULL,
  `total_work` varchar(255) NOT NULL,
  `total_rest` varchar(255) NOT NULL,
  `attendance_status` varchar(100) NOT NULL,
  PRIMARY KEY (`time_attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_attendance_time`
--

INSERT INTO `xin_attendance_time` (`time_attendance_id`, `employee_id`, `attendance_date`, `clock_in`, `clock_out`, `clock_in_out`, `time_late`, `early_leaving`, `overtime`, `total_work`, `total_rest`, `attendance_status`) VALUES
(1, 2, '2019-03-09', '2019-03-09 11:47:23', '2019-03-09 11:48:02', '0', '2019-03-09 11:47:23', '2019-03-09 11:48:02', '2019-03-09 11:48:02', '0:0', '', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `xin_awards`
--

DROP TABLE IF EXISTS `xin_awards`;
CREATE TABLE IF NOT EXISTS `xin_awards` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(200) NOT NULL,
  `award_type_id` int(200) NOT NULL,
  `gift_item` varchar(200) NOT NULL,
  `cash_price` varchar(200) NOT NULL,
  `award_photo` varchar(255) NOT NULL,
  `award_month_year` varchar(200) NOT NULL,
  `award_information` text NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_award_type`
--

DROP TABLE IF EXISTS `xin_award_type`;
CREATE TABLE IF NOT EXISTS `xin_award_type` (
  `award_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `award_type` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`award_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_award_type`
--

INSERT INTO `xin_award_type` (`award_type_id`, `award_type`, `created_at`) VALUES
(1, 'Performer of the Year', '28-04-2017'),
(2, 'Most Consistent Employee', '28-04-2017'),
(3, 'Employee of the Month', '28-04-2017'),
(4, 'Employee of the Year', '28-04-2017'),
(5, 'Hard Worker Award', '28-04-2017'),
(6, 'Certificate of Excellence', '28-04-2017'),
(7, 'Certificate of Project Completion', '28-04-2017'),
(8, 'Outstanding Leadership', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_companies`
--

DROP TABLE IF EXISTS `xin_companies`;
CREATE TABLE IF NOT EXISTS `xin_companies` (
  `company_id` int(111) NOT NULL AUTO_INCREMENT,
  `type_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `trading_name` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `government_tax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `project_description` text,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_companies`
--

INSERT INTO `xin_companies` (`company_id`, `type_id`, `name`, `trading_name`, `registration_no`, `government_tax`, `email`, `logo`, `contact_number`, `website_url`, `project_description`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `added_by`, `created_at`) VALUES
(4, 5, 'Ayat HRIS', 'Ayat HRIS', '123213', '34555', 'pm_developer@yahoo.com', 'logo_1551973488.png', '123454', 'abc.com', NULL, '1005, Damac Smart Heights, TECOM', '', 'pakistan', 'pakistan', '46000', 228, 1, '27-04-2017'),
(5, 2, 'project name', '', '', '', 'admin@mail.com', 'logo_1552058235.png', '03339480846', 'addd.com', NULL, '', '', 'islamabad', 'Islamabad', '46000', 167, 1, '08-03-2019'),
(6, 2, 'project three', '', '', '', 'shop@mail.com', 'logo_1552058331.png', '0325645454', 'wxdwdfdsfgds.com', NULL, '', '', 'Islamabad', 'Islamabad', '46000', 167, 1, '08-03-2019'),
(7, 1, 'ctc project ', '', '', '', 'mail@test.com', 'logo_1552124009.jpg', '021548565454', 'wxdwdfdsfgds.com', NULL, 'gulbarg', '', 'lahore', '', '40000', 167, 1, '09-03-2019'),
(8, 4, 'polio', '', '', '', 'mail@test.com', 'logo_1552658544.png', '0211245454', 'unicef.com', NULL, '', '', 'lahore', 'lahore', '40000', 167, 1, '15-03-2019'),
(9, 1, 'xyz', '', '', '', 'mail@mail.com', 'logo_1555512341.png', '051548744', 'abc.com', NULL, '', '', '', '', '', 0, 1, '17-04-2019'),
(10, 3, 'PTPP', '', '', '', 'mail@test.com', 'logo_1559375373.jpg', '034548545', 'ctc.org.pk', NULL, '', '', '', '', '', 0, 1, '01-06-2019'),
(11, 1, 'ABCD', '', '', '', 'abc@gmail.com', 'logo_1564218213.jpg', '03361964975', 'addd.com', NULL, '', '', '', '', '', 0, 1, '27-07-2019'),
(12, 3, 'ACCC', '', '', '', 'mail@test.com', 'logo_1564512999.jpg', '444444', 'ctc.org.pk', NULL, '', '', '', '', '', 0, 1, '30-07-2019');

-- --------------------------------------------------------

--
-- Table structure for table `xin_company_info`
--

DROP TABLE IF EXISTS `xin_company_info`;
CREATE TABLE IF NOT EXISTS `xin_company_info` (
  `company_info_id` int(111) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `logo_second` varchar(255) NOT NULL,
  `sign_in_logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `website_url` text NOT NULL,
  `starting_year` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`company_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_company_info`
--

INSERT INTO `xin_company_info` (`company_info_id`, `logo`, `logo_second`, `sign_in_logo`, `favicon`, `website_url`, `starting_year`, `company_name`, `company_email`, `company_contact`, `contact_person`, `email`, `phone`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `updated_at`) VALUES
(1, 'logo_1552572341.png', 'logo2_1552572341.png', 'signin_logo_1552572315.png', 'favicon_1552572341.png', '', '', 'Ayat HRMS', '', '', 'ayat ullah', 'pm_developer@yahoo.com', '551543272', 'G-9/2, st: 09 Islamabad', '', 'pakistan', 'pakistan', '46000', 167, '2017-05-20 12:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `xin_company_policy`
--

DROP TABLE IF EXISTS `xin_company_policy`;
CREATE TABLE IF NOT EXISTS `xin_company_policy` (
  `policy_id` int(111) NOT NULL AUTO_INCREMENT,
  `company_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`policy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_company_policy`
--

INSERT INTO `xin_company_policy` (`policy_id`, `company_id`, `title`, `description`, `added_by`, `created_at`) VALUES
(1, 4, 'Smoke-free work environment', '&lt;p&gt;&lt;span style=&quot;\\\\\\&quot;font-weight:&quot; bold;\\\\\\&quot;=&quot;&quot;&gt;Wz Smoke-Free Work Environment Policy&lt;/span&gt;&lt;/p&gt;', 1, '28-04-2017'),
(2, 5, 'Dress Code Policy', 'Please wear only the defined clothes&lt;p&gt;&lt;/p&gt;', 1, '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_company_type`
--

DROP TABLE IF EXISTS `xin_company_type`;
CREATE TABLE IF NOT EXISTS `xin_company_type` (
  `type_id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_company_type`
--

INSERT INTO `xin_company_type` (`type_id`, `name`, `created_at`) VALUES
(1, 'Corporation', ''),
(2, 'Exempt Organization', ''),
(3, 'Partnership', ''),
(4, 'Private Foundation', ''),
(5, 'Limited Liability Company', '');

-- --------------------------------------------------------

--
-- Table structure for table `xin_contract_type`
--

DROP TABLE IF EXISTS `xin_contract_type`;
CREATE TABLE IF NOT EXISTS `xin_contract_type` (
  `contract_type_id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`contract_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_contract_type`
--

INSERT INTO `xin_contract_type` (`contract_type_id`, `name`, `created_at`) VALUES
(1, 'Permanent', '28-04-2017'),
(2, 'Internship', '28-04-2017'),
(3, 'Regular', '28-04-2017'),
(4, 'Probation', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_countries`
--

DROP TABLE IF EXISTS `xin_countries`;
CREATE TABLE IF NOT EXISTS `xin_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_flag` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xin_countries`
--

INSERT INTO `xin_countries` (`country_id`, `country_code`, `country_name`, `country_flag`) VALUES
(1, '93', 'Afghanistan', 'flag_1500831780.gif'),
(2, '355', 'Albania', 'flag_1500831815.gif'),
(3, 'DZ', 'Algeria', ''),
(4, 'DS', 'American Samoa', ''),
(5, 'AD', 'Andorra', ''),
(6, 'AO', 'Angola', ''),
(7, 'AI', 'Anguilla', ''),
(8, 'AQ', 'Antarctica', ''),
(9, 'AG', 'Antigua and Barbuda', ''),
(10, 'AR', 'Argentina', ''),
(11, 'AM', 'Armenia', ''),
(12, 'AW', 'Aruba', ''),
(13, 'AU', 'Australia', ''),
(14, 'AT', 'Austria', ''),
(15, 'AZ', 'Azerbaijan', ''),
(16, 'BS', 'Bahamas', ''),
(17, 'BH', 'Bahrain', ''),
(18, 'BD', 'Bangladesh', ''),
(19, 'BB', 'Barbados', ''),
(20, 'BY', 'Belarus', ''),
(21, 'BE', 'Belgium', ''),
(22, 'BZ', 'Belize', ''),
(23, 'BJ', 'Benin', ''),
(24, 'BM', 'Bermuda', ''),
(25, 'BT', 'Bhutan', ''),
(26, 'BO', 'Bolivia', ''),
(27, 'BA', 'Bosnia and Herzegovina', ''),
(28, 'BW', 'Botswana', ''),
(29, 'BV', 'Bouvet Island', ''),
(30, 'BR', 'Brazil', ''),
(31, 'IO', 'British Indian Ocean Territory', ''),
(32, 'BN', 'Brunei Darussalam', ''),
(33, 'BG', 'Bulgaria', ''),
(34, 'BF', 'Burkina Faso', ''),
(35, 'BI', 'Burundi', ''),
(36, 'KH', 'Cambodia', ''),
(37, 'CM', 'Cameroon', ''),
(38, 'CA', 'Canada', ''),
(39, 'CV', 'Cape Verde', ''),
(40, 'KY', 'Cayman Islands', ''),
(41, 'CF', 'Central African Republic', ''),
(42, 'TD', 'Chad', ''),
(43, 'CL', 'Chile', ''),
(44, 'CN', 'China', ''),
(45, 'CX', 'Christmas Island', ''),
(46, 'CC', 'Cocos (Keeling) Islands', ''),
(47, 'CO', 'Colombia', ''),
(48, 'KM', 'Comoros', ''),
(49, 'CG', 'Congo', ''),
(50, 'CK', 'Cook Islands', ''),
(51, 'CR', 'Costa Rica', ''),
(52, 'HR', 'Croatia (Hrvatska)', ''),
(53, 'CU', 'Cuba', ''),
(54, 'CY', 'Cyprus', ''),
(55, 'CZ', 'Czech Republic', ''),
(56, 'DK', 'Denmark', ''),
(57, 'DJ', 'Djibouti', ''),
(58, 'DM', 'Dominica', ''),
(59, 'DO', 'Dominican Republic', ''),
(60, 'TP', 'East Timor', ''),
(61, 'EC', 'Ecuador', ''),
(62, 'EG', 'Egypt', ''),
(63, 'SV', 'El Salvador', ''),
(64, 'GQ', 'Equatorial Guinea', ''),
(65, 'ER', 'Eritrea', ''),
(66, 'EE', 'Estonia', ''),
(67, 'ET', 'Ethiopia', ''),
(68, 'FK', 'Falkland Islands (Malvinas)', ''),
(69, 'FO', 'Faroe Islands', ''),
(70, 'FJ', 'Fiji', ''),
(71, 'FI', 'Finland', ''),
(72, 'FR', 'France', ''),
(73, 'FX', 'France, Metropolitan', ''),
(74, 'GF', 'French Guiana', ''),
(75, 'PF', 'French Polynesia', ''),
(76, 'TF', 'French Southern Territories', ''),
(77, 'GA', 'Gabon', ''),
(78, 'GM', 'Gambia', ''),
(79, 'GE', 'Georgia', ''),
(80, 'DE', 'Germany', ''),
(81, 'GH', 'Ghana', ''),
(82, 'GI', 'Gibraltar', ''),
(83, 'GK', 'Guernsey', ''),
(84, 'GR', 'Greece', ''),
(85, 'GL', 'Greenland', ''),
(86, 'GD', 'Grenada', ''),
(87, 'GP', 'Guadeloupe', ''),
(88, 'GU', 'Guam', ''),
(89, 'GT', 'Guatemala', ''),
(90, 'GN', 'Guinea', ''),
(91, 'GW', 'Guinea-Bissau', ''),
(92, 'GY', 'Guyana', ''),
(93, 'HT', 'Haiti', ''),
(94, 'HM', 'Heard and Mc Donald Islands', ''),
(95, 'HN', 'Honduras', ''),
(96, 'HK', 'Hong Kong', ''),
(97, 'HU', 'Hungary', ''),
(98, 'IS', 'Iceland', ''),
(99, 'IN', 'India', ''),
(100, 'IM', 'Isle of Man', ''),
(101, 'ID', 'Indonesia', ''),
(102, 'IR', 'Iran (Islamic Republic of)', ''),
(103, 'IQ', 'Iraq', ''),
(104, 'IE', 'Ireland', ''),
(105, 'IL', 'Israel', ''),
(106, 'IT', 'Italy', ''),
(107, 'CI', 'Ivory Coast', ''),
(108, 'JE', 'Jersey', ''),
(109, 'JM', 'Jamaica', ''),
(110, 'JP', 'Japan', ''),
(111, 'JO', 'Jordan', ''),
(112, 'KZ', 'Kazakhstan', ''),
(113, 'KE', 'Kenya', ''),
(114, 'KI', 'Kiribati', ''),
(115, 'KP', 'Korea, Democratic People\'s Republic of', ''),
(116, 'KR', 'Korea, Republic of', ''),
(117, 'XK', 'Kosovo', ''),
(118, 'KW', 'Kuwait', ''),
(119, 'KG', 'Kyrgyzstan', ''),
(120, 'LA', 'Lao People\'s Democratic Republic', ''),
(121, 'LV', 'Latvia', ''),
(122, 'LB', 'Lebanon', ''),
(123, 'LS', 'Lesotho', ''),
(124, 'LR', 'Liberia', ''),
(125, 'LY', 'Libyan Arab Jamahiriya', ''),
(126, 'LI', 'Liechtenstein', ''),
(127, 'LT', 'Lithuania', ''),
(128, 'LU', 'Luxembourg', ''),
(129, 'MO', 'Macau', ''),
(130, 'MK', 'Macedonia', ''),
(131, 'MG', 'Madagascar', ''),
(132, 'MW', 'Malawi', ''),
(133, 'MY', 'Malaysia', ''),
(134, 'MV', 'Maldives', ''),
(135, 'ML', 'Mali', ''),
(136, 'MT', 'Malta', ''),
(137, 'MH', 'Marshall Islands', ''),
(138, 'MQ', 'Martinique', ''),
(139, 'MR', 'Mauritania', ''),
(140, 'MU', 'Mauritius', ''),
(141, 'TY', 'Mayotte', ''),
(142, 'MX', 'Mexico', ''),
(143, 'FM', 'Micronesia, Federated States of', ''),
(144, 'MD', 'Moldova, Republic of', ''),
(145, 'MC', 'Monaco', ''),
(146, 'MN', 'Mongolia', ''),
(147, 'ME', 'Montenegro', ''),
(148, 'MS', 'Montserrat', ''),
(149, 'MA', 'Morocco', ''),
(150, 'MZ', 'Mozambique', ''),
(151, 'MM', 'Myanmar', ''),
(152, 'NA', 'Namibia', ''),
(153, 'NR', 'Nauru', ''),
(154, 'NP', 'Nepal', ''),
(155, 'NL', 'Netherlands', ''),
(156, 'AN', 'Netherlands Antilles', ''),
(157, 'NC', 'New Caledonia', ''),
(158, 'NZ', 'New Zealand', ''),
(159, 'NI', 'Nicaragua', ''),
(160, 'NE', 'Niger', ''),
(161, 'NG', 'Nigeria', ''),
(162, 'NU', 'Niue', ''),
(163, 'NF', 'Norfolk Island', ''),
(164, 'MP', 'Northern Mariana Islands', ''),
(165, 'NO', 'Norway', ''),
(166, 'OM', 'Oman', ''),
(167, 'PK', 'Pakistan', ''),
(168, 'PW', 'Palau', ''),
(169, 'PS', 'Palestine', ''),
(170, 'PA', 'Panama', ''),
(171, 'PG', 'Papua New Guinea', ''),
(172, 'PY', 'Paraguay', ''),
(173, 'PE', 'Peru', ''),
(174, 'PH', 'Philippines', ''),
(175, 'PN', 'Pitcairn', ''),
(176, 'PL', 'Poland', ''),
(177, 'PT', 'Portugal', ''),
(178, 'PR', 'Puerto Rico', ''),
(179, 'QA', 'Qatar', ''),
(180, 'RE', 'Reunion', ''),
(181, 'RO', 'Romania', ''),
(182, 'RU', 'Russian Federation', ''),
(183, 'RW', 'Rwanda', ''),
(184, 'KN', 'Saint Kitts and Nevis', ''),
(185, 'LC', 'Saint Lucia', ''),
(186, 'VC', 'Saint Vincent and the Grenadines', ''),
(187, 'WS', 'Samoa', ''),
(188, 'SM', 'San Marino', ''),
(189, 'ST', 'Sao Tome and Principe', ''),
(190, 'SA', 'Saudi Arabia', ''),
(191, 'SN', 'Senegal', ''),
(192, 'RS', 'Serbia', ''),
(193, 'SC', 'Seychelles', ''),
(194, 'SL', 'Sierra Leone', ''),
(195, 'SG', 'Singapore', ''),
(196, 'SK', 'Slovakia', ''),
(197, 'SI', 'Slovenia', ''),
(198, 'SB', 'Solomon Islands', ''),
(199, 'SO', 'Somalia', ''),
(200, 'ZA', 'South Africa', ''),
(201, 'GS', 'South Georgia South Sandwich Islands', ''),
(202, 'ES', 'Spain', ''),
(203, 'LK', 'Sri Lanka', ''),
(204, 'SH', 'St. Helena', ''),
(205, 'PM', 'St. Pierre and Miquelon', ''),
(206, 'SD', 'Sudan', ''),
(207, 'SR', 'Suriname', ''),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', ''),
(209, 'SZ', 'Swaziland', ''),
(210, 'SE', 'Sweden', ''),
(211, 'CH', 'Switzerland', ''),
(212, 'SY', 'Syrian Arab Republic', ''),
(213, 'TW', 'Taiwan', ''),
(214, 'TJ', 'Tajikistan', ''),
(215, 'TZ', 'Tanzania, United Republic of', ''),
(216, 'TH', 'Thailand', ''),
(217, 'TG', 'Togo', ''),
(218, 'TK', 'Tokelau', ''),
(219, 'TO', 'Tonga', ''),
(220, 'TT', 'Trinidad and Tobago', ''),
(221, 'TN', 'Tunisia', ''),
(222, 'TR', 'Turkey', ''),
(223, 'TM', 'Turkmenistan', ''),
(224, 'TC', 'Turks and Caicos Islands', ''),
(225, 'TV', 'Tuvalu', ''),
(226, 'UG', 'Uganda', ''),
(227, 'UA', 'Ukraine', ''),
(228, 'AE', 'United Arab Emirates', ''),
(229, 'GB', 'United Kingdom', ''),
(230, 'US', 'United States', ''),
(231, 'UM', 'United States minor outlying islands', ''),
(232, 'UY', 'Uruguay', ''),
(233, 'UZ', 'Uzbekistan', ''),
(234, 'VU', 'Vanuatu', ''),
(235, 'VA', 'Vatican City State', ''),
(236, 'VE', 'Venezuela', ''),
(237, 'VN', 'Vietnam', ''),
(238, 'VG', 'Virgin Islands (British)', ''),
(239, 'VI', 'Virgin Islands (U.S.)', ''),
(240, 'WF', 'Wallis and Futuna Islands', ''),
(241, 'EH', 'Western Sahara', ''),
(242, 'YE', 'Yemen', ''),
(243, 'ZR', 'Zaire', ''),
(244, 'ZM', 'Zambia', ''),
(245, 'ZW', 'Zimbabwe', '');

-- --------------------------------------------------------

--
-- Table structure for table `xin_currencies`
--

DROP TABLE IF EXISTS `xin_currencies`;
CREATE TABLE IF NOT EXISTS `xin_currencies` (
  `currency_id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_currencies`
--

INSERT INTO `xin_currencies` (`currency_id`, `name`, `code`, `symbol`) VALUES
(19, 'Pounds', 'GBP', '£‎'),
(25, 'Yuan Renminbi', 'CNY', '¥'),
(44, 'Dollars', 'HKD', '$'),
(47, 'Rupees', 'INR', 'Rp'),
(53, 'Yen', 'JPY', '¥'),
(63, 'Switzerland Francs', 'CHF', 'CHF'),
(66, 'Ringgits', 'MYR', 'RM'),
(73, 'Guilders', 'ANG', 'ƒ'),
(74, 'Dollars', 'NZD', '$'),
(92, 'Dollars', 'SGD', '$'),
(94, 'Shillings', 'SOS', 'S'),
(112, 'Zimbabwe Dollars', 'ZWD', 'Z$'),
(113, 'UAE Dirhams', 'AED', 'Dhs');

-- --------------------------------------------------------

--
-- Table structure for table `xin_database_backup`
--

DROP TABLE IF EXISTS `xin_database_backup`;
CREATE TABLE IF NOT EXISTS `xin_database_backup` (
  `backup_id` int(111) NOT NULL AUTO_INCREMENT,
  `backup_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_departments`
--

DROP TABLE IF EXISTS `xin_departments`;
CREATE TABLE IF NOT EXISTS `xin_departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `location_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_departments`
--

INSERT INTO `xin_departments` (`department_id`, `department_name`, `company_id`, `location_id`, `employee_id`, `added_by`, `created_at`, `status`) VALUES
(1, 'Designers & Developers', 4, 1, 1, 1, '27-04-2017', 1),
(2, 'Sales', 4, 1, 1, 1, '28-04-2017', 1),
(3, 'Administration', 4, 1, 1, 1, '28-04-2017', 1),
(4, 'operation', 8, 3, 2, 1, '15-03-2019', 1),
(5, 'HR', 8, 3, 4, 1, '12-06-2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xin_designations`
--

DROP TABLE IF EXISTS `xin_designations`;
CREATE TABLE IF NOT EXISTS `xin_designations` (
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(200) NOT NULL,
  `designation_name` varchar(200) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`designation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_designations`
--

INSERT INTO `xin_designations` (`designation_id`, `department_id`, `designation_name`, `added_by`, `created_at`, `status`) VALUES
(1, 1, 'Finance Manager', 1, '27-04-2017', 1),
(2, 2, 'System Administrator', 1, '28-04-2017', 1),
(3, 4, 'Assistant Manager', 1, '28-04-2017', 1),
(4, 4, 'Manager', 1, '28-04-2017', 1),
(5, 6, 'Assistant Surveyor', 1, '28-04-2017', 1),
(6, 6, 'Surveyor', 1, '28-04-2017', 1),
(7, 5, 'Fresher PHP Developer', 1, '28-04-2017', 1),
(8, 5, 'Senior PHP Developer', 1, '28-04-2017', 1),
(9, 3, 'Graphics Designer', 1, '28-04-2017', 1),
(10, 4, 'Senior Testers', 1, '28-04-2017', 1),
(12, 5, 'Intern', 1, '28-04-2017', 1),
(13, 1, 'Finance Executive', 1, '28-04-2017', 1),
(14, 4, 'Learning Manager', 1, '28-04-2017', 1),
(15, 4, 'Learning Executive', 1, '28-04-2017', 1),
(16, 5, 'Software Engineer', 1, '28-04-2017', 1),
(17, 5, 'Project Manager', 1, '28-04-2017', 1),
(18, 5, 'Chief Technology Officer', 1, '28-04-2017', 1),
(19, 5, 'Chief Executive Officer', 1, '28-04-2017', 1),
(20, 3, 'President', 1, '28-04-2017', 1),
(21, 1, 'lead', 1, '13-06-2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xin_document_type`
--

DROP TABLE IF EXISTS `xin_document_type`;
CREATE TABLE IF NOT EXISTS `xin_document_type` (
  `document_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`document_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_document_type`
--

INSERT INTO `xin_document_type` (`document_type_id`, `document_type`, `created_at`) VALUES
(1, 'Driving License', '28-04-2017'),
(2, 'Passport', '28-04-2017'),
(3, 'Visa', '28-04-2017'),
(4, 'Emirates ID', '18-10-2017 12:49:58'),
(5, 'Insurance', '18-10-2017 12:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `xin_email_template`
--

DROP TABLE IF EXISTS `xin_email_template`;
CREATE TABLE IF NOT EXISTS `xin_email_template` (
  `template_id` int(111) NOT NULL AUTO_INCREMENT,
  `template_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_email_template`
--

INSERT INTO `xin_email_template` (`template_id`, `template_code`, `name`, `subject`, `message`, `status`) VALUES
(1, 'test', 'Payslip generated', 'Payslip generated', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;Your payslip generated for the month of {var payslip_date}.&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The&amp;nbsp;{var site_name}&amp;nbsp;Team&lt;/p&gt;', 1),
(2, 'test2', 'Forgot Password', 'Forgot Password', '&lt;p&gt;There was recently a request for password for your &amp;nbsp;{var site_name}&amp;nbsp;account.&lt;/p&gt;&lt;p&gt;Please, keep it in your records so you don&#039;t forget it.&lt;/p&gt;&lt;p&gt;Your username: {var username}&lt;br&gt;Your email address: {var email}&lt;br&gt;Your password: {var password}&lt;/p&gt;&lt;p&gt;Thank you,&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(3, '', 'New Project', 'New Project', '&lt;p&gt;Dear {var name},&lt;/p&gt;&lt;p&gt;New project has been assigned to you.&lt;/p&gt;&lt;p&gt;Project Name: {var project_name}&lt;/p&gt;&lt;p&gt;Project Start Date:&amp;nbsp;&lt;span 1rem;\\&quot;=&quot;&quot;&gt;{var project_start_date}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span 1rem;\\&quot;=&quot;&quot;&gt;Thank you,&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(4, '', 'Announcement', 'New Announcement', '&lt;p&gt;Dear &amp;nbsp;User,&lt;/p&gt;&lt;p&gt;New&amp;nbsp;Announcement has been published by admin,&amp;nbsp;please click on below link:&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://demo.workablezone.com/%7Bvar%20site_url%7D&quot;&gt;New&amp;nbsp;Announcement...&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Have fun!&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(5, '', 'Leave Request ', 'A Leave Request from you', '&lt;p&gt;Dear Admin,&lt;/p&gt;&lt;p&gt;{var employee_name}&amp;nbsp;wants a leave from you.&lt;/p&gt;&lt;p&gt;You can view this leave request by logging in to the portal using the link below.&lt;br&gt;&lt;a href=&quot;{var site_url}&quot;&gt;View Application&lt;/a&gt;&lt;br&gt;&lt;br&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(6, '', 'Leave Approve', 'Your leave request has been approved', '&lt;p&gt;Your leave request has been approved&lt;/p&gt;&lt;p&gt;&lt;font color=&quot;#333333&quot; face=&quot;sans-serif, Arial, Verdana, Trebuchet MS&quot;&gt;Congratulations!&amp;nbsp;Your leave request from&amp;nbsp;&lt;/font&gt;{var leave_start_date}&amp;nbsp;to&amp;nbsp;{var leave_end_date}&amp;nbsp;has been approved by your company management.&lt;/p&gt;&lt;p&gt;Regards&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(7, '', 'Leave Reject', 'Your leave request has been Rejected', '&lt;p&gt;Your leave request has been Rejected&lt;/p&gt;&lt;p&gt;Unfortunately !&amp;nbsp;Your leave request from&amp;nbsp;{var leave_start_date}&amp;nbsp;to&amp;nbsp;{var leave_end_date}&amp;nbsp;has been Rejected by your company management.&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(8, '', 'Welcome Email ', 'Welcome Email ', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;Welcome to&amp;nbsp;{var site_name}&amp;nbsp;.Thanks for joining&amp;nbsp;{var site_name}. We listed your sign in details below, make sure you keep them safe.&lt;/p&gt;&lt;p&gt;Your Username: {var username}&lt;/p&gt;&lt;p&gt;Your Employee ID: {var employee_id}&lt;br&gt;Your Email Address: {var email}&lt;br&gt;Your Password: {var password}&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;{var site_url}&quot;&gt;Login Panel&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Have fun!&lt;/p&gt;&lt;p&gt;The&amp;nbsp;{var site_name}&amp;nbsp;Team.&lt;/p&gt;', 1),
(9, '', 'Transfer', 'New Transfer', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;You have been&amp;nbsp;transfered to another department and location.&lt;/p&gt;&lt;p&gt;You can view the transfer details by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://demo.workablezone.com/%7Bvar%20site_url%7D&quot;&gt;Login Panel&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(10, '', 'Award', 'Award Received', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;You have been&amp;nbsp;awarded&amp;nbsp;{var award_name}.&lt;/p&gt;&lt;p&gt;You can view this award by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://demo.workablezone.com/settings/email_template/%7Bvar%20site_url%7D&quot;&gt;Login Panel&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(11, '', 'New job application', 'New job application submitted', '&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;Hi,&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;strong&gt;{var employee_name}&amp;nbsp;&lt;/strong&gt;has submitted the job application for&amp;nbsp;&lt;span style=&quot;font-weight: bolder; font-size: 1rem;&quot;&gt;{var job_title}&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;You can view the Job Application online at:&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-weight: bolder; font-size: 1rem;&quot;&gt;&lt;a href=&quot;http://localhost/mm/ultimate_hrm/job_candidates&quot;&gt;&lt;a href=&quot;{var site_url}&quot;&gt;View Job Application&lt;/a&gt;&lt;/a&gt;&lt;/span&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;Best Regards,&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;The {var site_name} Team&lt;/p&gt;', 1),
(12, '', 'Resignation', 'Resignation Notice', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;Resignation Notice has been sent to you.&lt;/p&gt;&lt;p&gt;You can view the notice details by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;{var site_url}&quot;&gt;Login Panel&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(13, '', 'New Training', 'Training  Assigned ', '&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;Dear Employee,&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;A new Training &amp;nbsp;&lt;strong&gt;{var training_name}&lt;/strong&gt;&amp;nbsp;&amp;nbsp;has been assigned to you.&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;You can view this Training by logging in to the portal using the link below.&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;strong style=&quot;font-size: 1rem;&quot;&gt;&lt;a href=&quot;http://localhost/mm/ultimate_hrm/training_details.php?training_id=5&amp;amp;mode=view&quot;&gt;View Training&lt;/a&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Regards&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;The {var site_name} Team&lt;/span&gt;&lt;/p&gt;', 1),
(14, '', 'New Task', 'Task assigned', '&lt;p&gt;Dear Employee,&lt;/p&gt;&lt;p&gt;A new task&amp;nbsp;&lt;span style=&quot;font-weight: bolder;&quot;&gt;{var task_name}&lt;/span&gt;&amp;nbsp;has been assigned to you by&amp;nbsp;&lt;span style=&quot;font-weight: bolder;&quot;&gt;{var task_assigned_by}&lt;/span&gt;.&lt;/p&gt;&lt;p&gt;You can view this task by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://demo.workablezone.com/%7Bvar%20site_url%7D&quot;&gt;View Task&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Link doesn&#039;t work? Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards,&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(15, '', 'New Ticket', 'New Ticket [#{var ticket_code}]', '&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dear Admin,&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Your received a new ticket.&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Ticket Code: #{var ticket_code}&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;Status : Open&lt;br&gt;&lt;br&gt;Click on the below link to see the ticket details and post additional comments.&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;&lt;big&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;&lt;a href=&quot;http://demo.workablezone.com/settings/email_template/%7Bvar%20site_url%7D&quot;&gt;View Ticket&lt;/a&gt;&lt;/span&gt;&lt;/big&gt;&lt;br&gt;&lt;br&gt;Regards&lt;/p&gt;&lt;p style=&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;&quot;&gt;The {var site_name} Team&lt;/p&gt;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xin_employees`
--

DROP TABLE IF EXISTS `xin_employees`;
CREATE TABLE IF NOT EXISTS `xin_employees` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(200) NOT NULL,
  `office_shift_id` int(111) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_role_id` int(100) NOT NULL,
  `designation_id` int(20) NOT NULL,
  `department_id` int(100) NOT NULL,
  `company_id` int(111) NOT NULL,
  `salary_template` varchar(255) NOT NULL,
  `hourly_grade_id` int(111) NOT NULL,
  `monthly_grade_id` int(111) NOT NULL,
  `date_of_joining` varchar(200) NOT NULL,
  `date_of_leaving` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `salary` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `profile_picture` text NOT NULL,
  `profile_background` text NOT NULL,
  `resume` text NOT NULL,
  `skype_id` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `facebook_link` text NOT NULL,
  `twitter_link` text NOT NULL,
  `blogger_link` text NOT NULL,
  `linkdedin_link` text NOT NULL,
  `google_plus_link` text NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `pinterest_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `last_login_date` varchar(255) NOT NULL,
  `last_logout_date` varchar(255) NOT NULL,
  `last_login_ip` varchar(255) NOT NULL,
  `is_logged_in` int(111) NOT NULL,
  `online` int(111) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employees`
--

INSERT INTO `xin_employees` (`user_id`, `employee_id`, `office_shift_id`, `first_name`, `last_name`, `username`, `email`, `password`, `user_role_id`, `designation_id`, `department_id`, `company_id`, `salary_template`, `hourly_grade_id`, `monthly_grade_id`, `date_of_joining`, `date_of_leaving`, `marital_status`, `salary`, `address`, `profile_picture`, `profile_background`, `resume`, `skype_id`, `contact_no`, `facebook_link`, `twitter_link`, `blogger_link`, `linkdedin_link`, `google_plus_link`, `instagram_link`, `pinterest_link`, `youtube_link`, `is_active`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_logged_in`, `online`, `status`, `created_at`) VALUES
(1, '1', 1, 'admin', 'admin', 'admin', 'admin@gmail.com', 'admin', 1, 20, 3, 4, 'monthly', 0, 1, '2016-10-16', '2017-08-24', 'Married', '', '1355 Market Street, Suite 900', '', 'profile_background_1499896596.jpg', '', '', '551543272', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.blogger.com/', 'https://www.linkedin.com/', 'https://plus.google.com/', '', '', '', 1, '30-07-2019 15:59:47', '28-07-2019 19:32:37', '::1', 1, 0, 0, '15-06-2017'),
(2, '2', 1, 'raja ', 'sab', 'naseem', 'asad@gmail.com', '123456', 9, 2, 2, 4, '', 0, 0, '2017-05-22', '', 'Single', '', 'address', '', '', '', '', '54545454', '', '', '', '', '', '', '', '', 1, '09-03-2019 11:45:52', '09-03-2019 11:51:11', '::1', 0, 0, 0, '29-11-2017'),
(3, '3', 1, 'sana', 'sana', 'ali', 'sana@gmail.com', 'sana@123', 9, 2, 2, 4, '', 0, 0, '2017-08-24', '', '', '', 'pakistan', '', '', '', '', '055-1814987, 0342-8118858', '', '', '', '', '', '', '', '', 1, '', '', '', 0, 0, 0, '04-12-2017'),
(4, '4', 1, 'Faisal', 'Ijaz', 'user2', 'faisal@gmail.com', 'user2', 9, 13, 1, 4, '', 0, 0, '2017-05-17', '', '', '', 'swat', '', '', '', '', '544545454', '', '', '', '', '', '', '', '', 1, '14-03-2019 14:53:20', '', '::1', 1, 0, 0, '04-12-2017'),
(6, '6', 1, 'abc', 'khalid', 'tamoor', 'khalid@gmail.com', 'khalid@123', 9, 13, 1, 4, '', 0, 0, '2016-04-05', '', '', '', 'peshaware', '', '', '', '', '055-1894369, 0342-4477403, 0300-6194745', '', '', '', '', '', '', '', '', 1, '', '', '', 0, 0, 0, '04-12-2017'),
(7, '7', 1, 'ali', 'asim', 'khan', 'asim@gmail.com', 'asim@123', 9, 2, 2, 4, '', 0, 0, '2017-06-19', '', '', '', 'isb', '', '', '', '', '45454545', '', '', '', '', '', '', '', '', 1, '', '', '', 0, 0, 0, '04-12-2017'),
(8, '8', 2, 'ayat', 'khan', 'ayat', 'ayat@mail.com', '123456', 9, 2, 2, 4, '', 0, 0, '2019-03-05', '', 'Married', '', '', '', '', '', '', '03254878787', '', '', '', '', '', '', '', '', 1, '', '', '', 0, 0, 0, '05-03-2019'),
(9, '17', 0, 'Assssd', NULL, 'Assssd', 'mail@mail.com', '123456', 0, 0, 0, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, 0, 0, '2019-07-27 10:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_bankaccount`
--

DROP TABLE IF EXISTS `xin_employee_bankaccount`;
CREATE TABLE IF NOT EXISTS `xin_employee_bankaccount` (
  `bankaccount_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `is_primary` int(11) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_code` varchar(255) NOT NULL,
  `bank_branch` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`bankaccount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_complaints`
--

DROP TABLE IF EXISTS `xin_employee_complaints`;
CREATE TABLE IF NOT EXISTS `xin_employee_complaints` (
  `complaint_id` int(111) NOT NULL AUTO_INCREMENT,
  `complaint_from` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `complaint_date` varchar(255) NOT NULL,
  `complaint_against` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_contacts`
--

DROP TABLE IF EXISTS `xin_employee_contacts`;
CREATE TABLE IF NOT EXISTS `xin_employee_contacts` (
  `contact_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `is_primary` int(111) NOT NULL,
  `is_dependent` int(111) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `work_phone_extension` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `work_email` varchar(255) NOT NULL,
  `personal_email` varchar(255) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_contract`
--

DROP TABLE IF EXISTS `xin_employee_contract`;
CREATE TABLE IF NOT EXISTS `xin_employee_contract` (
  `contract_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `contract_type_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_contract`
--

INSERT INTO `xin_employee_contract` (`contract_id`, `employee_id`, `contract_type_id`, `from_date`, `designation_id`, `title`, `to_date`, `description`, `created_at`) VALUES
(3, 1, 2, '2017-06-01', 4, 'dfdfd', '2017-06-30', 'asdfadsfsdafd', '07-06-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_documents`
--

DROP TABLE IF EXISTS `xin_employee_documents`;
CREATE TABLE IF NOT EXISTS `xin_employee_documents` (
  `document_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `document_type_id` int(111) NOT NULL,
  `date_of_expiry` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notification_email` varchar(255) NOT NULL,
  `is_alert` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_documents`
--

INSERT INTO `xin_employee_documents` (`document_id`, `employee_id`, `document_type_id`, `date_of_expiry`, `title`, `notification_email`, `is_alert`, `description`, `document_file`, `created_at`) VALUES
(2, 1, 2, '2024-10-09', 'Passport', 'Khuram@wistech.biz', 1, '', 'document_1508349776.jpg', '18-10-2017'),
(3, 1, 3, '2018-01-03', 'UAE Visa', 'khuram@wistech.biz', 1, '', 'document_1508349834.jpg', '18-10-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_exit`
--

DROP TABLE IF EXISTS `xin_employee_exit`;
CREATE TABLE IF NOT EXISTS `xin_employee_exit` (
  `exit_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `exit_date` varchar(255) NOT NULL,
  `exit_type_id` int(111) NOT NULL,
  `exit_interview` int(111) NOT NULL,
  `is_inactivate_account` int(111) NOT NULL,
  `reason` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`exit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_exit_type`
--

DROP TABLE IF EXISTS `xin_employee_exit_type`;
CREATE TABLE IF NOT EXISTS `xin_employee_exit_type` (
  `exit_type_id` int(111) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`exit_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_exit_type`
--

INSERT INTO `xin_employee_exit_type` (`exit_type_id`, `type`, `created_at`) VALUES
(1, 'Resignation', ''),
(2, 'Retirement', ''),
(3, 'End of Contract', ''),
(4, 'End of Project', ''),
(5, 'Dismissal', ''),
(6, 'Layoff', ''),
(7, 'Termination by Mutual Agreement', ''),
(8, 'Forced Resignation', ''),
(9, 'End of Temporary Appointment', ''),
(10, 'Death', ''),
(11, 'Abadonment', ''),
(12, 'Transfer', '');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_immigration`
--

DROP TABLE IF EXISTS `xin_employee_immigration`;
CREATE TABLE IF NOT EXISTS `xin_employee_immigration` (
  `immigration_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `document_type_id` int(111) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `eligible_review_date` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`immigration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_leave`
--

DROP TABLE IF EXISTS `xin_employee_leave`;
CREATE TABLE IF NOT EXISTS `xin_employee_leave` (
  `leave_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `contract_id` int(111) NOT NULL,
  `casual_leave` varchar(255) NOT NULL,
  `medical_leave` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_leave`
--

INSERT INTO `xin_employee_leave` (`leave_id`, `employee_id`, `contract_id`, `casual_leave`, `medical_leave`, `created_at`) VALUES
(7, 23, 2, '3', '2', '02-06-2017'),
(8, 23, 2, '12', '23', '07-06-2017'),
(9, 1, 3, '30', '14', '07-06-2018'),
(10, 1, 3, '30', '14', '07-06-2018');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_location`
--

DROP TABLE IF EXISTS `xin_employee_location`;
CREATE TABLE IF NOT EXISTS `xin_employee_location` (
  `office_location_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`office_location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_location`
--

INSERT INTO `xin_employee_location` (`office_location_id`, `employee_id`, `location_id`, `from_date`, `to_date`, `created_at`) VALUES
(1, 23, 1, '2017-01-02', '2017-11-02', '2017-04-28 06:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_promotions`
--

DROP TABLE IF EXISTS `xin_employee_promotions`;
CREATE TABLE IF NOT EXISTS `xin_employee_promotions` (
  `promotion_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `promotion_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_qualification`
--

DROP TABLE IF EXISTS `xin_employee_qualification`;
CREATE TABLE IF NOT EXISTS `xin_employee_qualification` (
  `qualification_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `education_level_id` int(111) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `language_id` int(111) NOT NULL,
  `to_year` varchar(255) NOT NULL,
  `skill_id` text NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`qualification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_qualification`
--

INSERT INTO `xin_employee_qualification` (`qualification_id`, `employee_id`, `name`, `education_level_id`, `from_year`, `language_id`, `to_year`, `skill_id`, `description`, `created_at`) VALUES
(1, 1, 'Announcement', 1, '2017-08-02', 2, '2017-08-15', '2', 'adfdfadfd', '16-08-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_resignations`
--

DROP TABLE IF EXISTS `xin_employee_resignations`;
CREATE TABLE IF NOT EXISTS `xin_employee_resignations` (
  `resignation_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `resignation_date` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`resignation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_shift`
--

DROP TABLE IF EXISTS `xin_employee_shift`;
CREATE TABLE IF NOT EXISTS `xin_employee_shift` (
  `emp_shift_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `shift_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`emp_shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_shift`
--

INSERT INTO `xin_employee_shift` (`emp_shift_id`, `employee_id`, `shift_id`, `from_date`, `to_date`, `created_at`) VALUES
(6, 1, 1, '2017-02-01', '2017-11-30', '2017-02-25 02:53:48'),
(9, 23, 1, '2017-01-02', '2017-12-29', '2017-04-28 03:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_terminations`
--

DROP TABLE IF EXISTS `xin_employee_terminations`;
CREATE TABLE IF NOT EXISTS `xin_employee_terminations` (
  `termination_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `terminated_by` int(111) NOT NULL,
  `termination_type_id` int(111) NOT NULL,
  `termination_date` varchar(255) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`termination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_transfer`
--

DROP TABLE IF EXISTS `xin_employee_transfer`;
CREATE TABLE IF NOT EXISTS `xin_employee_transfer` (
  `transfer_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `transfer_date` varchar(255) NOT NULL,
  `transfer_department` int(111) NOT NULL,
  `transfer_location` int(111) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_travels`
--

DROP TABLE IF EXISTS `xin_employee_travels`;
CREATE TABLE IF NOT EXISTS `xin_employee_travels` (
  `travel_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `visit_purpose` varchar(255) NOT NULL,
  `visit_place` varchar(255) NOT NULL,
  `travel_mode` int(111) NOT NULL,
  `arrangement_type` int(111) NOT NULL,
  `expected_budget` varchar(255) NOT NULL,
  `actual_budget` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`travel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_warnings`
--

DROP TABLE IF EXISTS `xin_employee_warnings`;
CREATE TABLE IF NOT EXISTS `xin_employee_warnings` (
  `warning_id` int(111) NOT NULL AUTO_INCREMENT,
  `warning_to` int(111) NOT NULL,
  `warning_by` int(111) NOT NULL,
  `warning_date` varchar(255) NOT NULL,
  `warning_type_id` int(111) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`warning_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_warnings`
--

INSERT INTO `xin_employee_warnings` (`warning_id`, `warning_to`, `warning_by`, `warning_date`, `warning_type_id`, `subject`, `description`, `status`, `created_at`) VALUES
(2, 23, 24, '2017-08-15', 2, 'Test Ticket', '&lt;p&gt;asdasdsds&lt;/p&gt;', 0, '16-08-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_employee_work_experience`
--

DROP TABLE IF EXISTS `xin_employee_work_experience`;
CREATE TABLE IF NOT EXISTS `xin_employee_work_experience` (
  `work_experience_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`work_experience_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_employee_work_experience`
--

INSERT INTO `xin_employee_work_experience` (`work_experience_id`, `employee_id`, `company_name`, `from_date`, `to_date`, `post`, `description`, `created_at`) VALUES
(1, 23, 'Workable Zone2', '2017-06-02', '2017-06-08', 'software engineer', 'test description goes here..w', '02-06-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_expenses`
--

DROP TABLE IF EXISTS `xin_expenses`;
CREATE TABLE IF NOT EXISTS `xin_expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(200) NOT NULL,
  `expense_type_id` int(200) NOT NULL,
  `billcopy_file` text NOT NULL,
  `amount` varchar(200) NOT NULL,
  `purchase_date` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `status_remarks` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_expenses`
--

INSERT INTO `xin_expenses` (`expense_id`, `employee_id`, `expense_type_id`, `billcopy_file`, `amount`, `purchase_date`, `remarks`, `status`, `status_remarks`, `created_at`) VALUES
(1, 2, 1, 'bill_copy_1503617200.jpg', '1500', '2017-08-10', '&lt;p&gt;testtttt&lt;/p&gt;', 0, '', '19-08-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_expense_type`
--

DROP TABLE IF EXISTS `xin_expense_type`;
CREATE TABLE IF NOT EXISTS `xin_expense_type` (
  `expense_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`expense_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_expense_type`
--

INSERT INTO `xin_expense_type` (`expense_type_id`, `name`, `status`, `created_at`) VALUES
(1, 'Utilities', 1, '2017-04-27 08:52:10'),
(2, 'Rent', 1, '2017-04-28 07:46:18'),
(3, 'Insurance', 1, '2017-04-28 07:46:23'),
(5, 'Supplies', 1, '2017-04-28 07:46:34'),
(7, 'Wages', 1, '2017-04-28 07:47:09'),
(8, 'Taxes', 1, '2017-04-28 08:03:29'),
(9, 'Interest', 1, '2017-04-28 08:03:35'),
(10, 'Maintenance', 1, '2017-04-28 08:03:46'),
(11, 'Meals and Entertainment', 1, '2017-04-28 08:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `xin_file_manager`
--

DROP TABLE IF EXISTS `xin_file_manager`;
CREATE TABLE IF NOT EXISTS `xin_file_manager` (
  `file_id` int(111) NOT NULL AUTO_INCREMENT,
  `user_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `file_extension` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_file_manager_settings`
--

DROP TABLE IF EXISTS `xin_file_manager_settings`;
CREATE TABLE IF NOT EXISTS `xin_file_manager_settings` (
  `setting_id` int(111) NOT NULL AUTO_INCREMENT,
  `allowed_extensions` text NOT NULL,
  `maximum_file_size` varchar(255) NOT NULL,
  `is_enable_all_files` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_file_manager_settings`
--

INSERT INTO `xin_file_manager_settings` (`setting_id`, `allowed_extensions`, `maximum_file_size`, `is_enable_all_files`, `updated_at`) VALUES
(1, 'gif,png,pdf,txt,mp3,mp4,flv,doc,docx,xls,jpg,jpeg', '10', '', '2017-09-11 05:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_bankcash`
--

DROP TABLE IF EXISTS `xin_finance_bankcash`;
CREATE TABLE IF NOT EXISTS `xin_finance_bankcash` (
  `bankcash_id` int(111) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bankcash_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `xin_finance_bankcash`
--

INSERT INTO `xin_finance_bankcash` (`bankcash_id`, `account_name`, `account_balance`, `account_number`, `branch_code`, `bank_branch`, `created_at`) VALUES
(1, 'test', '232', '2323', '32', 'test', '20-06-2018 08:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_deposit`
--

DROP TABLE IF EXISTS `xin_finance_deposit`;
CREATE TABLE IF NOT EXISTS `xin_finance_deposit` (
  `deposit_id` int(111) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(111) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deposit_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(111) NOT NULL,
  `payer_id` int(111) NOT NULL,
  `payment_method` int(111) NOT NULL,
  `deposit_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deposit_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`deposit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_expense`
--

DROP TABLE IF EXISTS `xin_finance_expense`;
CREATE TABLE IF NOT EXISTS `xin_finance_expense` (
  `expense_id` int(111) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(111) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(111) NOT NULL,
  `payee_id` int(111) NOT NULL,
  `payment_method` int(111) NOT NULL,
  `expense_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_payees`
--

DROP TABLE IF EXISTS `xin_finance_payees`;
CREATE TABLE IF NOT EXISTS `xin_finance_payees` (
  `payee_id` int(11) NOT NULL AUTO_INCREMENT,
  `payee_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_payers`
--

DROP TABLE IF EXISTS `xin_finance_payers`;
CREATE TABLE IF NOT EXISTS `xin_finance_payers` (
  `payer_id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_transactions`
--

DROP TABLE IF EXISTS `xin_finance_transactions`;
CREATE TABLE IF NOT EXISTS `xin_finance_transactions` (
  `transaction_id` int(111) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(111) NOT NULL,
  `deposit_id` int(111) NOT NULL,
  `expense_id` int(111) NOT NULL,
  `transfer_id` int(111) NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_debit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_credit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_finance_transfer`
--

DROP TABLE IF EXISTS `xin_finance_transfer`;
CREATE TABLE IF NOT EXISTS `xin_finance_transfer` (
  `transfer_id` int(111) NOT NULL AUTO_INCREMENT,
  `from_account_id` int(111) NOT NULL,
  `to_account_id` int(111) NOT NULL,
  `transfer_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transfer_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `transfer_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xin_holidays`
--

DROP TABLE IF EXISTS `xin_holidays`;
CREATE TABLE IF NOT EXISTS `xin_holidays` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `is_publish` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_holidays`
--

INSERT INTO `xin_holidays` (`holiday_id`, `event_name`, `description`, `start_date`, `end_date`, `is_publish`, `created_at`) VALUES
(1, 'National Holidays', '&lt;p&gt;National Holidays&lt;br&gt;&lt;/p&gt;', '2017-06-08', '2017-06-09', 1, '28-04-2017'),
(2, 'Festival', '&lt;span style=&quot;color: rgb(79, 81, 84); font-family: &quot; open=&quot;&quot; sans&quot;,=&quot;&quot; arial;&quot;=&quot;&quot;&gt;Festival&lt;/span&gt;', '2017-04-13', '2017-04-14', 1, '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_hourly_templates`
--

DROP TABLE IF EXISTS `xin_hourly_templates`;
CREATE TABLE IF NOT EXISTS `xin_hourly_templates` (
  `hourly_rate_id` int(111) NOT NULL AUTO_INCREMENT,
  `hourly_grade` varchar(255) NOT NULL,
  `hourly_rate` varchar(255) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`hourly_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_income_categories`
--

DROP TABLE IF EXISTS `xin_income_categories`;
CREATE TABLE IF NOT EXISTS `xin_income_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_income_categories`
--

INSERT INTO `xin_income_categories` (`category_id`, `name`, `status`, `created_at`) VALUES
(1, 'Envato', 1, '25-07-2017 09:36:20'),
(2, 'Salary', 1, '25-07-2017 09:36:28'),
(3, 'Other Income', 1, '25-07-2017 09:36:32'),
(4, 'Interest Income', 1, '25-07-2017 09:36:53'),
(5, 'Part Time Work', 1, '25-07-2017 09:37:13'),
(6, 'Regular Income', 1, '25-07-2017 09:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `xin_jobs`
--

DROP TABLE IF EXISTS `xin_jobs`;
CREATE TABLE IF NOT EXISTS `xin_jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `company` bigint(20) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `department_id` bigint(10) NOT NULL,
  `job_type` int(225) NOT NULL,
  `job_vacancy` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `minimum_experience` varchar(255) NOT NULL,
  `date_of_closing` varchar(200) NOT NULL,
  `province` bigint(20) NOT NULL,
  `city_name` bigint(20) NOT NULL,
  `district_id` bigint(10) NOT NULL,
  `tehsil_id` bigint(10) NOT NULL,
  `uc_id` bigint(10) NOT NULL,
  `sub_area_id` bigint(10) NOT NULL,
  `area_name` bigint(20) NOT NULL,
  `domicile` bigint(20) NOT NULL,
  `cnic` varchar(50) NOT NULL,
  `education` bigint(20) NOT NULL,
  `age` bigint(20) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_jobs`
--

INSERT INTO `xin_jobs` (`job_id`, `company`, `job_title`, `designation_id`, `department_id`, `job_type`, `job_vacancy`, `gender`, `minimum_experience`, `date_of_closing`, `province`, `city_name`, `district_id`, `tehsil_id`, `uc_id`, `sub_area_id`, `area_name`, `domicile`, `cnic`, `education`, `age`, `short_description`, `long_description`, `status`, `created_at`) VALUES
(1, 4, 'Software Engineer', 16, 3, 2, 2, '1', '4', '2019-08-14', 2, 2, 0, 0, 0, 0, 2, 3, '', 2, 2, 'At least 3 years of work experience as Software Engineer in a reputable company / organization', 'At least 3 years of work experience as Software Engineer in a reputable company / organization.&lt;p&gt;&lt;/p&gt;', 1, '2017-04-28 04:32:07'),
(2, 4, 'sale person', 6, 3, 5, 5, '1', '0', '2019-07-23', 2, 2, 0, 0, 0, 0, 0, 0, '', 0, 2, 'only smart people are encouraged to apply ', '&lt;p&gt;this is a long term position for ...&lt;br&gt;&lt;/p&gt;', 1, '2019-03-11 03:23:08'),
(3, 4, 'web designer', 9, 3, 5, 8, '0', '4', '2019-03-28', 2, 2, 0, 0, 0, 0, 0, 0, '', 0, 2, 'Your covering message for sale person Short Description', '&lt;p&gt;Your covering message for sale person&lt;/p&gt;', 1, '2019-03-14 02:56:46'),
(4, 4, 'test', 15, 3, 6, 2, '0', '4', '2019-03-28', 2, 2, 0, 0, 0, 0, 0, 0, '', 0, 2, 'short desc', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, '2019-03-14 03:43:15'),
(9, 8, 'jobtitle', 5, 3, 5, 3, '0', '0', '2019-03-30', 2, 2, 0, 0, 0, 0, 1, 3, '1584714458665', 1, 2, 'Short Description', '&lt;p&gt;long description&lt;br&gt;&lt;/p&gt;', 1, '2019-03-26 02:33:15'),
(10, 8, 'abc', 4, 3, 6, 20, '0', '4', '2019-11-22', 2, 2, 0, 0, 0, 0, 1, 3, '1584714458665', 1, 2, 'Short Description', '&lt;p&gt;long &lt;label for=\\&quot;short_description\\&quot;&gt;Short Description&lt;/label&gt;&lt;/p&gt;', 1, '2019-03-26 03:36:28'),
(11, 8, 'cde', 5, 3, 6, 3, '0', '4', '2019-04-24', 2, 2, 0, 0, 0, 0, 1, 2, '1584714458665', 0, 2, 'short test', '&lt;p&gt;long test&lt;br&gt;&lt;/p&gt;', 1, '2019-04-02 01:30:05'),
(12, 8, 'jobtitless', 5, 3, 6, 5, '0', '5', '2019-04-27', 2, 2, 0, 0, 0, 0, 2, 3, '', 2, 2, 'vcvcvc', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, '2019-04-02 04:01:36'),
(13, 8, 'polio-islamabad-Finance Manager-mardan-kabal-UC1 area1-(sub area1)', 4, 3, 5, 1, '0', '6', '2019-09-25', 1, 1, 1, 1, 1, 1, 1, 1, '1460158865584', 0, 1, 'Short Description Short Description', 'Long Description Long Description', 1, '2019-07-27 08:47:00'),
(14, 4, 'Ayat HRIS-punjab-Finance Manager-mardan-kabal-UC1 area1-(sub area1)', 4, 3, 5, 1, '1', '6', '2019-07-31', 2, 1, 1, 1, 1, 1, 1, 2, '1460158865584', 2, 2, 'Short Description Short Description vShort Description', 'Long Description Long Description', 1, '2019-07-27 08:54:42'),
(15, 4, 'Ayat HRIS-punjab-Finance Manager-mardan-kabal-UC1 area1-(sub area1)', 4, 3, 5, 1, '1', '6', '2019-08-28', 2, 1, 1, 1, 1, 1, 1, 1, '1460158865584', 2, 1, 'Short Description', 'Long Description Long Description', 1, '2019-07-27 09:34:55'),
(16, 8, 'polio-islamabad-Finance Manager-mardan-kabal-UC1 area1-(sub area1)', 4, 3, 5, 1, '0', '6', '', 1, 1, 1, 1, 1, 1, 1, 1, '', 1, 1, '', '', 1, '2019-07-27 11:41:47'),
(17, 8, 'polio-islamabad-Finance Manager-mardan-kabal-UC1 area1-(sub area1)', 4, 3, 5, 1, '0', '6', '', 1, 1, 1, 1, 1, 1, 1, 1, '', 1, 1, '', '', 1, '2019-07-27 11:46:52'),
(18, 8, 'polio-islamabad-mardan-kabal-UC1 area1-sub area1 (Finance Manager)', 4, 3, 5, 1, '0', '4', '2019-10-02', 1, 1, 1, 1, 1, 1, 1, 1, '1', 1, 1, 'Short Description', 'job description', 1, '2019-07-30 07:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `xin_job_applications`
--

DROP TABLE IF EXISTS `xin_job_applications`;
CREATE TABLE IF NOT EXISTS `xin_job_applications` (
  `application_id` int(111) NOT NULL AUTO_INCREMENT,
  `job_id` int(111) NOT NULL,
  `user_id` int(111) NOT NULL,
  `fullname` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `education` int(10) DEFAULT NULL,
  `minimum_experience` varchar(20) DEFAULT NULL,
  `domicile` int(10) DEFAULT NULL,
  `province` int(10) DEFAULT NULL,
  `city_name` int(10) DEFAULT NULL,
  `message` text NOT NULL,
  `job_resume` text,
  `application_status` varchar(200) NOT NULL,
  `application_remarks` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_job_applications`
--

INSERT INTO `xin_job_applications` (`application_id`, `job_id`, `user_id`, `fullname`, `email`, `gender`, `age`, `education`, `minimum_experience`, `domicile`, `province`, `city_name`, `message`, `job_resume`, `application_status`, `application_remarks`, `created_at`) VALUES
(4, 10, 1, 'Ayat', 'mail@mail.com', 0, 2, 1, '4', 3, 2, 2, 'Your covering message for abc', 'resume_1552575517.pdf', '2', '', '2019-04-01 02:27:06'),
(5, 10, 1, 'aslam', 'mail@mail.com', 0, 2, 1, '4', 3, 2, 2, 'Your covering message for abc', 'resume_1552575517.pdf', '2', '', '2019-04-01 02:27:47'),
(6, 10, 1, 'zaaaak', 'mail@mail.com', 0, 2, 1, '4', 3, 2, 2, 'Your covering message for abc', 'resume_1552575517.pdf', '12', '', '2019-04-01 02:27:52'),
(7, 8, 1, 'khattak', 'mail@mail.com', 2, 3, 1, '4', 3, 2, 2, 'Your covering message for abc', 'resume_1554129256.txt', '1', '', '2019-04-01 02:34:16'),
(8, 9, 1, 'shenwari', 'mail@mail.com', 2, 2, 2, '4', 2, 2, 1, 'cszczx', 'resume_1554131062.txt', '1', '', '2019-04-01 03:04:21'),
(9, 12, 1, 'javeed', 'mail@mail.com', 2, 2, 2, '4', 2, 2, 1, 'cszczx', 'resume_1554131144.txt', '1', '', '2019-04-01 03:05:43'),
(12, 4, 1, 'asad', 'mail@mail.com', 0, 2, 1, '4', 1, 2, 2, 'some text', 'resume_1554215720.txt', '1', '', '2019-04-02 02:35:19'),
(13, 6, 1, 'ALi', 'mail@mail.com', 0, 2, 2, '6', 2, 2, 2, 'vbvb', 'resume_1554220991.txt', '1', '', '2019-04-02 04:03:10'),
(14, 10, 1, 'sadam', 'mail@mail.com', 2, 3, 1, '6', 1, 2, 2, 'some text', 'resume_1554532794.txt', '12', '', '2019-04-06 06:39:53'),
(15, 10, 1, 'kkkk', 'mail@mail.com', 2, 3, 1, '4', 1, 2, 2, 'some text', 'resume_1554533040.txt', '2', '', '2019-04-06 06:44:00'),
(16, 10, 1, 'wajid', 'mail@mail.com', 0, 2, 2, '8', 1, 2, 2, 'aaaa', 'resume_1554535338.txt', '1', '', '2019-04-06 07:22:17'),
(17, 10, 1, 'Assssd', 'mail@mail.com', 0, 2, 2, '5', 1, 2, 2, 'dfsfsdfsdf', 'resume_1554535475.txt', '12', '', '2019-04-06 07:24:34'),
(18, 10, 1, 'amjad', 'mail@mail.com', 0, 2, 2, '8', 1, 2, 2, 'dfsfsdfsdf', 'resume_1554535891.txt', '2', '', '2019-04-06 07:31:30'),
(19, 13, 1, 'asad', 'asad@mail.com', 0, 2, 2, '6', 2, 4, 1, 'sadasdasd', NULL, '1', '', '2019-07-27 10:10:30'),
(20, 13, 1, 'ali', 'ali@mail.com', 1, 1, 2, '6', 1, 4, 1, '', NULL, '1', '', '2019-07-27 10:15:08'),
(21, 13, 1, 'ali', 'ali@mail.com', 1, 1, 2, '6', 1, 4, 1, 'fggfhgf', NULL, '1', '', '2019-07-27 10:15:16'),
(22, 1, 1, '', '', 0, 0, 0, '4', 0, 0, 0, '', NULL, '1', '', '2019-07-28 07:43:03'),
(23, 1, 1, 'ali test', 'asad@mail.com', 1, 1, 1, '5', 1, 4, 1, 'ssss', NULL, '1', '', '2019-07-29 02:50:35'),
(24, 1, 1, '', '', 0, 0, 0, '4', 0, 0, 0, '', NULL, '1', '', '2019-07-29 02:52:09'),
(25, 1, 1, 'asad', 'asad@mail.com', 0, 2, 0, '4', 1, 4, 1, 'ddddddddddddd', NULL, '1', '', '2019-07-29 03:29:12'),
(26, 1, 1, '', '', 0, 0, 0, '4', 0, 0, 0, '', NULL, '1', '', '2019-07-29 03:31:04'),
(27, 1, 1, 'ali', 'mail@test.com', 0, 2, 2, '4', 1, 4, 1, 'bjgbhgjhghj', 'resume_1552575517.pdf', '1', '', '2019-07-30 07:27:45'),
(28, 1, 1, 'ali test', 'mail@test.com', 1, 2, 2, '9', 1, 4, 2, 'bvnvnvnvbn', 'resume_1552575517.pdf', '1', '', '2019-07-30 07:41:23'),
(29, 1, 1, 'ali', 'asad@mail.com', 1, 2, 1, '9', 1, 4, 1, 'Your covering message for Software Engineer', 'resume_1552575517.pdf', '1', '', '2019-07-30 07:43:34'),
(30, 1, 1, 'asad', 'asad@mail.com', 1, 2, 2, '4', 2, 2, 0, 'Your covering message for Software Engineer', 'resume_1552575517.pdf', '2', '', '2019-07-30 07:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `xin_job_interviews`
--

DROP TABLE IF EXISTS `xin_job_interviews`;
CREATE TABLE IF NOT EXISTS `xin_job_interviews` (
  `job_interview_id` int(111) NOT NULL AUTO_INCREMENT,
  `job_id` int(111) NOT NULL,
  `interviewers_id` varchar(255) NOT NULL,
  `interview_place` varchar(255) NOT NULL,
  `interview_date` varchar(255) NOT NULL,
  `interview_time` varchar(255) NOT NULL,
  `interviewees_id` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`job_interview_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_job_interviews`
--

INSERT INTO `xin_job_interviews` (`job_interview_id`, `job_id`, `interviewers_id`, `interview_place`, `interview_date`, `interview_time`, `interviewees_id`, `description`, `added_by`, `created_at`) VALUES
(1, 2, '3', 'isb', '2019-03-28', '17:55', '1', '&lt;p&gt;Job Interview Description&lt;/p&gt;', 1, '2019-03-11 03:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `xin_job_type`
--

DROP TABLE IF EXISTS `xin_job_type`;
CREATE TABLE IF NOT EXISTS `xin_job_type` (
  `job_type_id` int(111) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`job_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_job_type`
--

INSERT INTO `xin_job_type` (`job_type_id`, `type`, `created_at`) VALUES
(1, 'Intern', '2017-03-22 07:07:55'),
(2, 'Freelancer', '2017-03-22 07:07:55'),
(5, 'Full-Time', '2017-03-22 07:07:55'),
(6, 'Part-Time', '2017-03-22 07:08:00'),
(7, 'Contract', '2017-03-22 07:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `xin_leave_applications`
--

DROP TABLE IF EXISTS `xin_leave_applications`;
CREATE TABLE IF NOT EXISTS `xin_leave_applications` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(222) NOT NULL,
  `leave_type_id` int(222) NOT NULL,
  `from_date` varchar(200) NOT NULL,
  `to_date` varchar(200) NOT NULL,
  `applied_on` varchar(200) NOT NULL,
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_leave_applications`
--

INSERT INTO `xin_leave_applications` (`leave_id`, `employee_id`, `leave_type_id`, `from_date`, `to_date`, `applied_on`, `reason`, `remarks`, `status`, `created_at`) VALUES
(4, 23, 1, '2017-06-01', '2017-06-13', '2017-06-06 08:35:10', 'asdfasd', '&lt;p&gt;fasdfadsfad&lt;/p&gt;', 3, '2017-06-06 08:35:10'),
(6, 1, 2, '2017-06-01', '2017-06-06', '2017-06-08 07:29:42', 'sdasdsa', '&lt;p&gt;asdsadsds&lt;/p&gt;', 1, '2017-06-08 07:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `xin_leave_type`
--

DROP TABLE IF EXISTS `xin_leave_type`;
CREATE TABLE IF NOT EXISTS `xin_leave_type` (
  `leave_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) NOT NULL,
  `days_per_year` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_leave_type`
--

INSERT INTO `xin_leave_type` (`leave_type_id`, `type_name`, `days_per_year`, `status`, `created_at`) VALUES
(1, 'Casual Leave', '26', 1, '2017-04-28 07:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `xin_make_payment`
--

DROP TABLE IF EXISTS `xin_make_payment`;
CREATE TABLE IF NOT EXISTS `xin_make_payment` (
  `make_payment_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `payment_date` varchar(200) NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `payment_amount` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `total_allowances` varchar(255) NOT NULL,
  `total_deductions` varchar(255) NOT NULL,
  `net_salary` varchar(255) NOT NULL,
  `house_rent_allowance` varchar(255) NOT NULL,
  `medical_allowance` varchar(255) NOT NULL,
  `travelling_allowance` varchar(255) NOT NULL,
  `dearness_allowance` varchar(255) NOT NULL,
  `provident_fund` varchar(255) NOT NULL,
  `tax_deduction` varchar(255) NOT NULL,
  `security_deposit` varchar(255) NOT NULL,
  `overtime_rate` varchar(255) NOT NULL,
  `is_advance_salary_deduct` int(11) NOT NULL,
  `advance_salary_amount` varchar(255) NOT NULL,
  `is_payment` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `hourly_rate` varchar(255) NOT NULL,
  `total_hours_work` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`make_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_make_payment`
--

INSERT INTO `xin_make_payment` (`make_payment_id`, `employee_id`, `department_id`, `company_id`, `location_id`, `designation_id`, `payment_date`, `basic_salary`, `payment_amount`, `gross_salary`, `total_allowances`, `total_deductions`, `net_salary`, `house_rent_allowance`, `medical_allowance`, `travelling_allowance`, `dearness_allowance`, `provident_fund`, `tax_deduction`, `security_deposit`, `overtime_rate`, `is_advance_salary_deduct`, `advance_salary_amount`, `is_payment`, `payment_method`, `hourly_rate`, `total_hours_work`, `comments`, `status`, `created_at`) VALUES
(1, 1, 3, 4, 1, 20, '2018-08', '2000', '4000', '2000', '2000', '0', '4000', '1000', '0', '1000', '0', '0', '0', '0', '10', 0, '0', 1, 4, '', '', 'sd', 1, '01-08-2018 07:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `xin_office_location`
--

DROP TABLE IF EXISTS `xin_office_location`;
CREATE TABLE IF NOT EXISTS `xin_office_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(111) NOT NULL,
  `province_id` bigint(20) NOT NULL,
  `city_id` bigint(20) DEFAULT '0',
  `district_id` bigint(20) DEFAULT '0',
  `tehsil_id` bigint(20) DEFAULT '0',
  `uc_id` bigint(20) DEFAULT '0',
  `area_id` bigint(20) DEFAULT '0',
  `sub_area_id` bigint(20) DEFAULT '0',
  `location_head` int(111) NOT NULL,
  `location_manager` int(111) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `added_by` int(111) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `sdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_office_location`
--

INSERT INTO `xin_office_location` (`location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `location_head`, `location_manager`, `location_name`, `added_by`, `status`, `sdt`) VALUES
(1, 4, 1, 0, 1, 1, 1, 1, 1, 1, 1, 'Islamabad Head Office', 1, 1, '2019-06-17 19:53:45'),
(2, 5, 2, 0, 2, 2, 1, 1, 1, 7, 7, 'swat', 1, 1, '2019-06-17 19:53:45'),
(3, 8, 3, 0, 2, 1, 1, 1, 1, 2, 2, 'banu', 1, 1, '2019-06-17 19:53:45'),
(4, 8, 4, 0, 1, 1, 1, 1, 1, 2, 2, 'sawabi1', 1, 1, '2019-06-17 19:53:45'),
(5, 6, 1, 0, 1, 1, 1, 1, 2, 0, 0, '', 1, 1, '2019-05-29 12:31:06'),
(6, 6, 1, 0, 1, 1, 2, 1, 2, 0, 0, '', 1, 1, '2019-06-17 03:46:24'),
(7, 8, 1, 0, 1, 1, 1, 1, 1, 0, 0, '', 1, 1, '2019-07-01 03:58:57'),
(8, 7, 1, 0, 1, 1, 1, 1, 1, 0, 0, '', 1, 1, '2019-07-01 04:05:01'),
(12, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, 1, '2019-07-03 02:07:56'),
(13, 5, 4, 0, 2, 1, 0, 0, 0, 0, 0, '', 1, 1, '2019-07-03 02:20:14'),
(14, 11, 4, 0, 2, 2, 2, 2, 2, 0, 0, '', 1, 1, '2019-07-27 09:11:40'),
(15, 11, 4, 0, 2, 0, 0, 0, 0, 0, 0, '', 1, 1, '2019-07-27 09:15:07'),
(16, 11, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, 1, '2019-07-30 04:03:46'),
(17, 12, 4, 0, 2, 2, 2, 2, 2, 0, 0, '', 1, 1, '2019-07-30 07:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `xin_office_shift`
--

DROP TABLE IF EXISTS `xin_office_shift`;
CREATE TABLE IF NOT EXISTS `xin_office_shift` (
  `office_shift_id` int(111) NOT NULL AUTO_INCREMENT,
  `shift_name` varchar(255) NOT NULL,
  `default_shift` int(111) NOT NULL,
  `monday_in_time` varchar(222) NOT NULL,
  `monday_out_time` varchar(222) NOT NULL,
  `tuesday_in_time` varchar(222) NOT NULL,
  `tuesday_out_time` varchar(222) NOT NULL,
  `wednesday_in_time` varchar(222) NOT NULL,
  `wednesday_out_time` varchar(222) NOT NULL,
  `thursday_in_time` varchar(222) NOT NULL,
  `thursday_out_time` varchar(222) NOT NULL,
  `friday_in_time` varchar(222) NOT NULL,
  `friday_out_time` varchar(222) NOT NULL,
  `saturday_in_time` varchar(222) NOT NULL,
  `saturday_out_time` varchar(222) NOT NULL,
  `sunday_in_time` varchar(222) NOT NULL,
  `sunday_out_time` varchar(222) NOT NULL,
  `created_at` varchar(222) NOT NULL,
  PRIMARY KEY (`office_shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_office_shift`
--

INSERT INTO `xin_office_shift` (`office_shift_id`, `shift_name`, `default_shift`, `monday_in_time`, `monday_out_time`, `tuesday_in_time`, `tuesday_out_time`, `wednesday_in_time`, `wednesday_out_time`, `thursday_in_time`, `thursday_out_time`, `friday_in_time`, `friday_out_time`, `saturday_in_time`, `saturday_out_time`, `sunday_in_time`, `sunday_out_time`, `created_at`) VALUES
(1, 'Morning Shift', 1, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '16:00', '10:00', '15:00', '', '', '2017-04-28'),
(2, 'Afternoon Shift', 0, '15:00', '23:00', '15:00', '23:00', '15:00', '23:00', '15:00', '23:00', '15:00', '23:00', '15:00', '21:00', '', '', '2017-04-28'),
(4, 'Night Shift', 0, '18:00', '02:00', '18:00', '02:00', '18:00', '02:00', '18:58', '02:00', '18:00', '02:00', '18:00', '00:00', '', '', '2017-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `xin_payment_method`
--

DROP TABLE IF EXISTS `xin_payment_method`;
CREATE TABLE IF NOT EXISTS `xin_payment_method` (
  `payment_method_id` int(111) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_payment_method`
--

INSERT INTO `xin_payment_method` (`payment_method_id`, `method_name`, `created_at`) VALUES
(10, 'Cash', '24-02-2017'),
(11, 'Credit Card', '24-02-2017'),
(12, 'Bank', '24-02-2017'),
(13, 'Visa Debit Cart', '24-02-2017'),
(14, 'Online', '24-02-2017'),
(15, 'By Hand', '24-02-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_payroll_settings`
--

DROP TABLE IF EXISTS `xin_payroll_settings`;
CREATE TABLE IF NOT EXISTS `xin_payroll_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankcash_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `payroll_item` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '2017-12-31 18:01:01',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_payroll_settings`
--

INSERT INTO `xin_payroll_settings` (`id`, `bankcash_id`, `name`, `payroll_item`, `created_at`, `updated_at`) VALUES
(1, 1, 'test2', 'addition', '2018-06-21 01:54:00', '2018-06-19 11:00:00'),
(9, 1, 'test3', 'deduction', '2018-06-21 01:54:06', '2017-12-31 18:01:01'),
(10, 1, 'test4', 'deduction', '2017-12-31 18:01:01', '2017-12-31 18:01:01'),
(11, 1, 'test5', 'addition', '2017-12-31 18:01:01', '2017-12-31 18:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `xin_performance_appraisal`
--

DROP TABLE IF EXISTS `xin_performance_appraisal`;
CREATE TABLE IF NOT EXISTS `xin_performance_appraisal` (
  `performance_appraisal_id` int(111) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `appraisal_year_month` varchar(255) NOT NULL,
  `customer_experience` int(111) NOT NULL,
  `marketing` int(111) NOT NULL,
  `management` int(111) NOT NULL,
  `administration` int(111) NOT NULL,
  `presentation_skill` int(111) NOT NULL,
  `quality_of_work` int(111) NOT NULL,
  `efficiency` int(111) NOT NULL,
  `integrity` int(111) NOT NULL,
  `professionalism` int(111) NOT NULL,
  `team_work` int(111) NOT NULL,
  `critical_thinking` int(111) NOT NULL,
  `conflict_management` int(111) NOT NULL,
  `attendance` int(111) NOT NULL,
  `ability_to_meet_deadline` int(111) NOT NULL,
  `remarks` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`performance_appraisal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_performance_appraisal`
--

INSERT INTO `xin_performance_appraisal` (`performance_appraisal_id`, `employee_id`, `appraisal_year_month`, `customer_experience`, `marketing`, `management`, `administration`, `presentation_skill`, `quality_of_work`, `efficiency`, `integrity`, `professionalism`, `team_work`, `critical_thinking`, `conflict_management`, `attendance`, `ability_to_meet_deadline`, `remarks`, `added_by`, `created_at`) VALUES
(1, 23, '2017-03', 2, 3, 2, 3, 3, 2, 2, 2, 3, 2, 3, 1, 3, 2, '&lt;p&gt;Test Remarksss&lt;/p&gt;', 0, '28-04-2017'),
(2, 2, '2019-03', 3, 2, 3, 2, 2, 3, 4, 2, 3, 3, 3, 3, 2, 2, '&lt;p&gt;weldone man&lt;br&gt;&lt;/p&gt;', 1, '14-03-2019');

-- --------------------------------------------------------

--
-- Table structure for table `xin_performance_indicator`
--

DROP TABLE IF EXISTS `xin_performance_indicator`;
CREATE TABLE IF NOT EXISTS `xin_performance_indicator` (
  `performance_indicator_id` int(111) NOT NULL AUTO_INCREMENT,
  `designation_id` int(111) NOT NULL,
  `customer_experience` int(111) NOT NULL,
  `marketing` int(111) NOT NULL,
  `management` int(111) NOT NULL,
  `administration` int(111) NOT NULL,
  `presentation_skill` int(111) NOT NULL,
  `quality_of_work` int(111) NOT NULL,
  `efficiency` int(111) NOT NULL,
  `integrity` int(111) NOT NULL,
  `professionalism` int(111) NOT NULL,
  `team_work` int(111) NOT NULL,
  `critical_thinking` int(111) NOT NULL,
  `conflict_management` int(111) NOT NULL,
  `attendance` int(111) NOT NULL,
  `ability_to_meet_deadline` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`performance_indicator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_performance_indicator`
--

INSERT INTO `xin_performance_indicator` (`performance_indicator_id`, `designation_id`, `customer_experience`, `marketing`, `management`, `administration`, `presentation_skill`, `quality_of_work`, `efficiency`, `integrity`, `professionalism`, `team_work`, `critical_thinking`, `conflict_management`, `attendance`, `ability_to_meet_deadline`, `added_by`, `created_at`) VALUES
(1, 14, 0, 3, 2, 3, 3, 3, 2, 2, 3, 2, 2, 3, 3, 3, 1, '28-04-2017'),
(3, 2, 2, 1, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 1, '01-06-2017'),
(5, 2, 1, 3, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 1, '03-07-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_projects`
--

DROP TABLE IF EXISTS `xin_projects`;
CREATE TABLE IF NOT EXISTS `xin_projects` (
  `project_id` int(111) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `company_id` int(111) NOT NULL,
  `assigned_to` text NOT NULL,
  `priority` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `description` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `project_progress` varchar(255) NOT NULL,
  `project_note` longtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_projects_attachment`
--

DROP TABLE IF EXISTS `xin_projects_attachment`;
CREATE TABLE IF NOT EXISTS `xin_projects_attachment` (
  `project_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(200) NOT NULL,
  `upload_by` int(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_description` text NOT NULL,
  `attachment_file` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`project_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_projects_bugs`
--

DROP TABLE IF EXISTS `xin_projects_bugs`;
CREATE TABLE IF NOT EXISTS `xin_projects_bugs` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(111) NOT NULL,
  `user_id` int(200) NOT NULL,
  `attachment_file` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_projects_discussion`
--

DROP TABLE IF EXISTS `xin_projects_discussion`;
CREATE TABLE IF NOT EXISTS `xin_projects_discussion` (
  `discussion_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(111) NOT NULL,
  `user_id` int(200) NOT NULL,
  `attachment_file` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_qualification_education_level`
--

DROP TABLE IF EXISTS `xin_qualification_education_level`;
CREATE TABLE IF NOT EXISTS `xin_qualification_education_level` (
  `education_level_id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`education_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_qualification_education_level`
--

INSERT INTO `xin_qualification_education_level` (`education_level_id`, `name`, `created_at`) VALUES
(1, 'High School Diploma / GED', '28-04-2017'),
(2, 'Associate Degree', '28-04-2017'),
(3, 'Graduate', '28-04-2017'),
(4, 'Post Graduate', '28-04-2017'),
(5, 'Doctorate', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_qualification_language`
--

DROP TABLE IF EXISTS `xin_qualification_language`;
CREATE TABLE IF NOT EXISTS `xin_qualification_language` (
  `language_id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_qualification_language`
--

INSERT INTO `xin_qualification_language` (`language_id`, `name`, `created_at`) VALUES
(1, 'English', '28-04-2017'),
(2, 'French', '28-04-2017'),
(3, 'Arabic', '28-04-2017'),
(4, 'Russian', '28-04-2017'),
(5, 'Spanish', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_qualification_skill`
--

DROP TABLE IF EXISTS `xin_qualification_skill`;
CREATE TABLE IF NOT EXISTS `xin_qualification_skill` (
  `skill_id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_qualification_skill`
--

INSERT INTO `xin_qualification_skill` (`skill_id`, `name`, `created_at`) VALUES
(1, 'PHP 4/5/6/7', '28-04-2017'),
(2, 'jQuery', '28-04-2017'),
(3, 'Ajax', '28-04-2017'),
(4, 'Magento', '28-04-2017'),
(5, 'CodeIgniter', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_salary_templates`
--

DROP TABLE IF EXISTS `xin_salary_templates`;
CREATE TABLE IF NOT EXISTS `xin_salary_templates` (
  `salary_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_grades` varchar(255) NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `overtime_rate` varchar(255) NOT NULL,
  `house_rent_allowance` varchar(255) NOT NULL,
  `medical_allowance` varchar(255) NOT NULL,
  `travelling_allowance` varchar(255) NOT NULL,
  `dearness_allowance` varchar(255) NOT NULL,
  `security_deposit` varchar(255) NOT NULL,
  `provident_fund` varchar(255) NOT NULL,
  `tax_deduction` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `total_allowance` varchar(255) NOT NULL,
  `total_deduction` varchar(255) NOT NULL,
  `net_salary` varchar(255) NOT NULL,
  `payroll_item` varchar(11) DEFAULT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`salary_template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_salary_templates`
--

INSERT INTO `xin_salary_templates` (`salary_template_id`, `salary_grades`, `basic_salary`, `overtime_rate`, `house_rent_allowance`, `medical_allowance`, `travelling_allowance`, `dearness_allowance`, `security_deposit`, `provident_fund`, `tax_deduction`, `gross_salary`, `total_allowance`, `total_deduction`, `net_salary`, `payroll_item`, `added_by`, `created_at`) VALUES
(1, 'Default', '2000', '10', '1000', '0', '1000', '0', '0', '0', '0', '4000', '2000', '0', '4000', 'addition', 1, '07-06-2018 12:16:13'),
(2, 'test', '234', '3', '234', '23', '2', '23', '23', '234', '234', '516', '282', '491', '25', 'deduction', 1, '26-06-2018 07:56:29'),
(3, 'duduction', '323', '3', '23', '23', '232', '23', '23', '23', '23', '624', '301', '69', '555', 'deduction', 1, '26-06-2018 09:51:35'),
(4, 'addition', '234', '2', '23', '2', '2', '23', '2', '23', '23', '284', '50', '48', '236', 'addition', 1, '26-06-2018 09:51:54'),
(5, 'test3', '232', '23', '323', '23', '232', '232', '23', '232', '232', '1042', '810', '487', '555', NULL, 1, '27-06-2018 08:14:03'),
(6, 'test3', '234', '23', '23', '2342', '234', '234234', '3', '234', '234', '237067', '236833', '471', '236596', NULL, 1, '27-06-2018 08:15:14'),
(7, 'test5', '234', '234', '342', '232', '232', '232', '23', '22', '2332', '1272', '1038', '2377', '-1105', NULL, 1, '27-06-2018 08:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `xin_support_tickets`
--

DROP TABLE IF EXISTS `xin_support_tickets`;
CREATE TABLE IF NOT EXISTS `xin_support_tickets` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_code` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `ticket_priority` varchar(255) NOT NULL,
  `department_id` int(111) NOT NULL,
  `assigned_to` text NOT NULL,
  `message` text NOT NULL,
  `description` text NOT NULL,
  `ticket_remarks` text NOT NULL,
  `ticket_status` varchar(200) NOT NULL,
  `ticket_note` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_support_ticket_files`
--

DROP TABLE IF EXISTS `xin_support_ticket_files`;
CREATE TABLE IF NOT EXISTS `xin_support_ticket_files` (
  `ticket_file_id` int(111) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `ticket_files` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`ticket_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_system_setting`
--

DROP TABLE IF EXISTS `xin_system_setting`;
CREATE TABLE IF NOT EXISTS `xin_system_setting` (
  `setting_id` int(111) NOT NULL AUTO_INCREMENT,
  `application_name` varchar(255) NOT NULL,
  `default_currency` varchar(255) NOT NULL,
  `default_currency_symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show_currency` varchar(255) NOT NULL,
  `currency_position` varchar(255) NOT NULL,
  `notification_position` varchar(255) NOT NULL,
  `notification_close_btn` varchar(255) NOT NULL,
  `notification_bar` varchar(255) NOT NULL,
  `enable_registration` varchar(255) NOT NULL,
  `login_with` varchar(255) NOT NULL,
  `date_format_xi` varchar(255) NOT NULL,
  `employee_manage_own_contact` varchar(255) NOT NULL,
  `employee_manage_own_profile` varchar(255) NOT NULL,
  `employee_manage_own_qualification` varchar(255) NOT NULL,
  `employee_manage_own_work_experience` varchar(255) NOT NULL,
  `employee_manage_own_document` varchar(255) NOT NULL,
  `employee_manage_own_picture` varchar(255) NOT NULL,
  `employee_manage_own_social` varchar(255) NOT NULL,
  `employee_manage_own_bank_account` varchar(255) NOT NULL,
  `enable_attendance` varchar(255) NOT NULL,
  `enable_clock_in_btn` varchar(255) NOT NULL,
  `enable_email_notification` varchar(255) NOT NULL,
  `payroll_include_day_summary` varchar(255) NOT NULL,
  `payroll_include_hour_summary` varchar(255) NOT NULL,
  `payroll_include_leave_summary` varchar(255) NOT NULL,
  `enable_job_application_candidates` varchar(255) NOT NULL,
  `job_logo` varchar(255) NOT NULL,
  `payroll_logo` varchar(255) NOT NULL,
  `is_payslip_password_generate` int(11) NOT NULL,
  `payslip_password_format` varchar(255) NOT NULL,
  `enable_profile_background` varchar(255) NOT NULL,
  `enable_policy_link` varchar(255) NOT NULL,
  `enable_layout` varchar(255) NOT NULL,
  `job_application_format` text NOT NULL,
  `project_email` varchar(255) NOT NULL,
  `holiday_email` varchar(255) NOT NULL,
  `leave_email` varchar(255) NOT NULL,
  `payslip_email` varchar(255) NOT NULL,
  `award_email` varchar(255) NOT NULL,
  `recruitment_email` varchar(255) NOT NULL,
  `announcement_email` varchar(255) NOT NULL,
  `training_email` varchar(255) NOT NULL,
  `task_email` varchar(255) NOT NULL,
  `compact_sidebar` varchar(255) NOT NULL,
  `fixed_header` varchar(255) NOT NULL,
  `fixed_sidebar` varchar(255) NOT NULL,
  `boxed_wrapper` varchar(255) NOT NULL,
  `layout_static` varchar(255) NOT NULL,
  `system_skin` varchar(255) NOT NULL,
  `animation_effect` varchar(255) NOT NULL,
  `animation_effect_modal` varchar(255) NOT NULL,
  `animation_effect_topmenu` varchar(255) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `enable_page_rendered` varchar(255) NOT NULL,
  `enable_current_year` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_system_setting`
--

INSERT INTO `xin_system_setting` (`setting_id`, `application_name`, `default_currency`, `default_currency_symbol`, `show_currency`, `currency_position`, `notification_position`, `notification_close_btn`, `notification_bar`, `enable_registration`, `login_with`, `date_format_xi`, `employee_manage_own_contact`, `employee_manage_own_profile`, `employee_manage_own_qualification`, `employee_manage_own_work_experience`, `employee_manage_own_document`, `employee_manage_own_picture`, `employee_manage_own_social`, `employee_manage_own_bank_account`, `enable_attendance`, `enable_clock_in_btn`, `enable_email_notification`, `payroll_include_day_summary`, `payroll_include_hour_summary`, `payroll_include_leave_summary`, `enable_job_application_candidates`, `job_logo`, `payroll_logo`, `is_payslip_password_generate`, `payslip_password_format`, `enable_profile_background`, `enable_policy_link`, `enable_layout`, `job_application_format`, `project_email`, `holiday_email`, `leave_email`, `payslip_email`, `award_email`, `recruitment_email`, `announcement_email`, `training_email`, `task_email`, `compact_sidebar`, `fixed_header`, `fixed_sidebar`, `boxed_wrapper`, `layout_static`, `system_skin`, `animation_effect`, `animation_effect_modal`, `animation_effect_topmenu`, `footer_text`, `enable_page_rendered`, `enable_current_year`, `updated_at`) VALUES
(1, 'Ayat HRMS', 'GBP - £?', 'GBP - £‎', 'symbol', 'Prefix', 'toast-top-center', 'false', 'true', 'no', 'username', 'd-M-Y', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'job_logo_1533105140.png', 'payroll_logo_1533105126.png', 0, 'dateofbirth', 'yes', 'yes', 'yes', 'doc,docx,jpeg,jpg,pdf,txt,excel', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '', 'fixed-header', 'fixed-sidebar', '', 'static', 'skin-6', 'fadeInDown', 'pulse', 'pulse', 'Ayat HRMS', 'yes', 'yes', '2017-05-09 04:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `xin_tasks`
--

DROP TABLE IF EXISTS `xin_tasks`;
CREATE TABLE IF NOT EXISTS `xin_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(111) NOT NULL,
  `created_by` int(111) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `assigned_to` varchar(255) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `task_hour` varchar(200) NOT NULL,
  `task_progress` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `task_status` int(5) NOT NULL,
  `task_note` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_tasks_attachment`
--

DROP TABLE IF EXISTS `xin_tasks_attachment`;
CREATE TABLE IF NOT EXISTS `xin_tasks_attachment` (
  `task_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(200) NOT NULL,
  `upload_by` int(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_description` text NOT NULL,
  `attachment_file` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`task_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_tasks_comments`
--

DROP TABLE IF EXISTS `xin_tasks_comments`;
CREATE TABLE IF NOT EXISTS `xin_tasks_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `task_comments` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_termination_type`
--

DROP TABLE IF EXISTS `xin_termination_type`;
CREATE TABLE IF NOT EXISTS `xin_termination_type` (
  `termination_type_id` int(111) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`termination_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_termination_type`
--

INSERT INTO `xin_termination_type` (`termination_type_id`, `type`, `created_at`) VALUES
(1, 'Layoff', ''),
(2, 'Damaging Company Property', ''),
(3, 'Drug or Alcohol Possession at Work', ''),
(4, 'Falsifying Company Records', ''),
(5, 'Insubordination', ''),
(6, 'Misconduct', ''),
(7, 'Poor Performance', ''),
(8, 'Stealing', ''),
(9, 'Using Company Property for Personal Business', ''),
(10, 'Taking Too Much Time Off', ''),
(11, 'Violating Company Policy', ''),
(12, 'Voluntary Termination', ''),
(13, 'Involuntary Termination', ''),
(14, 'Discriminatory Conduct Towards others', ''),
(15, 'Harassment (Sexual and Otherwise)', '');

-- --------------------------------------------------------

--
-- Table structure for table `xin_tickets_attachment`
--

DROP TABLE IF EXISTS `xin_tickets_attachment`;
CREATE TABLE IF NOT EXISTS `xin_tickets_attachment` (
  `ticket_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(200) NOT NULL,
  `upload_by` int(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_description` text NOT NULL,
  `attachment_file` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`ticket_attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_tickets_comments`
--

DROP TABLE IF EXISTS `xin_tickets_comments`;
CREATE TABLE IF NOT EXISTS `xin_tickets_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `ticket_comments` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xin_trainers`
--

DROP TABLE IF EXISTS `xin_trainers`;
CREATE TABLE IF NOT EXISTS `xin_trainers` (
  `trainer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `expertise` text NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_trainers`
--

INSERT INTO `xin_trainers` (`trainer_id`, `first_name`, `last_name`, `contact_number`, `email`, `designation_id`, `expertise`, `address`, `status`, `created_at`) VALUES
(1, 'trainer', 'user', '0323256565', 'trainer@mail.com', 4, '&lt;p&gt;just trainer&lt;br&gt;&lt;/p&gt;', 'islamabad', 1, '14-03-2019');

-- --------------------------------------------------------

--
-- Table structure for table `xin_training`
--

DROP TABLE IF EXISTS `xin_training`;
CREATE TABLE IF NOT EXISTS `xin_training` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(200) NOT NULL,
  `training_type_id` int(200) NOT NULL,
  `trainer_id` int(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `finish_date` varchar(200) NOT NULL,
  `training_cost` varchar(200) NOT NULL,
  `training_status` int(200) NOT NULL,
  `description` text NOT NULL,
  `performance` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training`
--

INSERT INTO `xin_training` (`training_id`, `employee_id`, `training_type_id`, `trainer_id`, `start_date`, `finish_date`, `training_cost`, `training_status`, `description`, `performance`, `remarks`, `created_at`) VALUES
(1, '4', 1, 1, '2019-03-14', '2019-03-28', '200', 0, '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '14-03-2019 02:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `xin_trainings`
--

DROP TABLE IF EXISTS `xin_trainings`;
CREATE TABLE IF NOT EXISTS `xin_trainings` (
  `trg_id` int(111) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `trg_type` int(11) NOT NULL,
  `trainer_one` int(11) NOT NULL,
  `trainer_two` int(11) NOT NULL,
  `facilitator_name` varchar(111) NOT NULL,
  `trainee_employees` varchar(200) NOT NULL,
  `target_group` varchar(111) NOT NULL,
  `start_date` varchar(111) NOT NULL,
  `end_date` varchar(111) NOT NULL,
  `venue` int(11) NOT NULL,
  `hall_detail` text NOT NULL,
  `session` varchar(255) NOT NULL,
  `approval_type` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` varchar(20) NOT NULL,
  PRIMARY KEY (`trg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_trainings`
--

INSERT INTO `xin_trainings` (`trg_id`, `project`, `location`, `district`, `trg_type`, `trainer_one`, `trainer_two`, `facilitator_name`, `trainee_employees`, `target_group`, `start_date`, `end_date`, `venue`, `hall_detail`, `session`, `approval_type`, `status`, `created_at`) VALUES
(1, 4, 4, 1, 2, 1, 1, 'Saddam Hussain', '1,2,3,8', 'CHW', '2019-07-18', '2019-07-22', 4, 'Auditorium Hall', '1', 'Planned', 2, '2019-05-14'),
(2, 5, 4, 2, 2, 1, 1, 'Saddam Hussain', '4', 'CHW', '2019-07-25', '2019-07-29', 4, 'Auditorium Hall', '1', 'Planned', 2, '2019-05-17'),
(6, 4, 4, 1, 1, 1, 1, 'Imran Khan', '1,2,3,4,6,7,8', 'FCM', '2019-06-11', '2019-06-15', 1, 'Auditorium Hall', '2', 'Planned', 2, '2019-06-11'),
(5, 5, 4, 3, 1, 1, 1, 'Imran Khan', '1,2,3,4,6,7,8', 'FCM', '2019-06-15', '2019-06-19', 8, 'Auditorium Hall', '2', 'Planned', 1, '2019-06-11'),
(7, 4, 4, 1, 2, 1, 1, 'Imran Khan', '1,2,3,4,6,7,8', 'FCM', '2019-06-12', '2019-06-15', 8, 'Auditorium Hall', '1', 'Planned', 0, '2019-06-12'),
(8, 4, 4, 2, 2, 1, 1, 'Saddam Hussain', '1,2,3,4,6,7,8', 'FCM', '2019-06-13', '2019-06-15', 4, 'Hall 3', '2', 'Planned', 3, '2019-06-13'),
(9, 5, 4, 1, 1, 1, 1, 'Imran Khan', '1,2,3,4,6,7,8', 'FCM', '2019-06-17', '2019-06-19', 1, 'Hall 3', '2', 'Planned', 1, '2019-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `xin_training_allowances`
--

DROP TABLE IF EXISTS `xin_training_allowances`;
CREATE TABLE IF NOT EXISTS `xin_training_allowances` (
  `allowance_id` int(111) NOT NULL AUTO_INCREMENT,
  `project` int(111) NOT NULL,
  `designation` int(111) NOT NULL,
  `behavior` varchar(255) NOT NULL,
  `dsa` varchar(255) DEFAULT NULL,
  `travel` varchar(255) NOT NULL,
  `stay_allowance` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`allowance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training_allowances`
--

INSERT INTO `xin_training_allowances` (`allowance_id`, `project`, `designation`, `behavior`, `dsa`, `travel`, `stay_allowance`) VALUES
(1, 4, 1, 'local', NULL, '500', NULL),
(2, 5, 5, 'out', '1000', '500', '500');

-- --------------------------------------------------------

--
-- Table structure for table `xin_training_amenities`
--

DROP TABLE IF EXISTS `xin_training_amenities`;
CREATE TABLE IF NOT EXISTS `xin_training_amenities` (
  `amenity_id` int(111) NOT NULL AUTO_INCREMENT,
  `room_type_id` varchar(500) NOT NULL,
  `amenities` varchar(500) NOT NULL,
  PRIMARY KEY (`amenity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training_amenities`
--

INSERT INTO `xin_training_amenities` (`amenity_id`, `room_type_id`, `amenities`) VALUES
(1, '2', 'Bed & Breakfast, AC Room,'),
(2, '1', 'Bed & Breakfast, AC Room, Attach Bath, TV Facility, Carpeted Room, '),
(3, '3', 'Bed & Breakfast, Attach Bath, Carpeted Room, '),
(4, '1', 'Bed & Breakfast, AC Room, Attach Bath, TV Facility, Carpeted Room'),
(5, '4', 'Bed & Breakfast, AC Room, Attach Bath, TV Facility, Carpeted Room'),
(6, '2', 'Bed & Breakfast, Attach Bath, Carpeted Room'),
(7, '5', 'Bed & Breakfast, AC Room, Carpeted Room'),
(8, '6', 'Bed & Breakfast, AC Room, Attach Bath, TV Facility, Carpeted Room');

-- --------------------------------------------------------

--
-- Table structure for table `xin_training_hotels`
--

DROP TABLE IF EXISTS `xin_training_hotels`;
CREATE TABLE IF NOT EXISTS `xin_training_hotels` (
  `hotel_id` int(111) NOT NULL AUTO_INCREMENT,
  `province` int(111) NOT NULL,
  `city` int(111) NOT NULL,
  `hotel_name` text NOT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training_hotels`
--

INSERT INTO `xin_training_hotels` (`hotel_id`, `province`, `city`, `hotel_name`) VALUES
(1, 4, 2, 'Hotel Swat Serena'),
(2, 4, 2, 'Swat Continental Hotel'),
(3, 4, 2, 'PTDC Motel');

-- --------------------------------------------------------

--
-- Table structure for table `xin_training_locations`
--

DROP TABLE IF EXISTS `xin_training_locations`;
CREATE TABLE IF NOT EXISTS `xin_training_locations` (
  `location_id` int(111) NOT NULL AUTO_INCREMENT,
  `province` int(111) NOT NULL,
  `city` int(111) NOT NULL,
  `location` text NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training_locations`
--

INSERT INTO `xin_training_locations` (`location_id`, `province`, `city`, `location`) VALUES
(1, 4, 1, 'UET Mardan'),
(2, 4, 2, 'University of Sargodha'),
(4, 4, 1, 'Abdul Wali Khan University Mardan'),
(8, 4, 1, 'UET Peshawar');

-- --------------------------------------------------------

--
-- Table structure for table `xin_training_prices`
--

DROP TABLE IF EXISTS `xin_training_prices`;
CREATE TABLE IF NOT EXISTS `xin_training_prices` (
  `price_id` int(111) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(255) NOT NULL,
  `charges` varchar(100) NOT NULL,
  `hotel_id` int(111) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training_prices`
--

INSERT INTO `xin_training_prices` (`price_id`, `room_type`, `charges`, `hotel_id`) VALUES
(1, 'VIP Room', '2500', 1),
(2, '2 Seats', '1500', 1),
(3, '3 Seats', '1200', 1),
(4, 'VIP Room', '2500', 2),
(5, '3 Seats', '1200', 2),
(6, 'VIP Room', '2500', 3);

-- --------------------------------------------------------

--
-- Table structure for table `xin_training_types`
--

DROP TABLE IF EXISTS `xin_training_types`;
CREATE TABLE IF NOT EXISTS `xin_training_types` (
  `training_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`training_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_training_types`
--

INSERT INTO `xin_training_types` (`training_type_id`, `type`, `created_at`, `status`) VALUES
(1, 'Job Training', '28-04-2017', 1),
(2, 'Promotional Training', '28-04-2017', 1),
(3, 'Workshop', '28-04-2017', 1),
(4, 'Webinar', '28-04-2017', 1),
(5, 'Seminar', '28-04-2017', 1),
(6, 'Online Training', '28-04-2017', 1),
(7, 'technology training', '14-03-2019 02:40:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xin_travel_arrangement_type`
--

DROP TABLE IF EXISTS `xin_travel_arrangement_type`;
CREATE TABLE IF NOT EXISTS `xin_travel_arrangement_type` (
  `arrangement_type_id` int(111) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`arrangement_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_travel_arrangement_type`
--

INSERT INTO `xin_travel_arrangement_type` (`arrangement_type_id`, `type`, `status`, `created_at`) VALUES
(1, 'Personal Arrangment', 1, '2017-04-28 07:47:55'),
(2, 'Hotel', 1, '2017-04-28 07:48:00'),
(3, 'Guest House', 1, '2017-04-28 07:48:06'),
(4, 'Motel', 1, '2017-04-28 07:48:11'),
(5, 'AirBnB', 1, '2017-04-28 07:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `xin_user_roles`
--

DROP TABLE IF EXISTS `xin_user_roles`;
CREATE TABLE IF NOT EXISTS `xin_user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) NOT NULL,
  `role_access` varchar(200) NOT NULL,
  `role_resources` text NOT NULL,
  `created_at` varchar(200) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_user_roles`
--

INSERT INTO `xin_user_roles` (`role_id`, `role_name`, `role_access`, `role_resources`, `created_at`) VALUES
(1, 'Super Admin', '1', '0,1,3,4,5,6,8,9,10,11,13,14,15,16,17,18,20,21,22,23,26,27,240,24,25,28,29,30,31,58,32,34,35,36,38,39,40,59,60,41,42,7,33,19,43,44,45,46,47,48,49,50,51,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,57,52,53,54,55,56', '20-11-2016'),
(9, 'Employee', '2', '0,57', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `xin_warning_type`
--

DROP TABLE IF EXISTS `xin_warning_type`;
CREATE TABLE IF NOT EXISTS `xin_warning_type` (
  `warning_type_id` int(111) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`warning_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xin_warning_type`
--

INSERT INTO `xin_warning_type` (`warning_type_id`, `type`, `created_at`) VALUES
(1, 'Verbal Warning', '2017-04-28 07:43:33'),
(2, 'First Written Warning', '2017-04-28 07:43:38'),
(3, 'Second Written Warning', '2017-04-28 07:43:44'),
(4, 'Final Written Warning', '2017-04-28 07:43:49'),
(5, 'Incident Explanation Request', '2017-04-28 07:43:56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
