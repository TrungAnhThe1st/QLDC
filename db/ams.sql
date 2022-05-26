-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2022 at 11:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `branch_id` int(11) NOT NULL,
  `area_id` int(11) DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `b_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `b_contact_no` int(15) NOT NULL,
  `b_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `security_guard_mobile` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secrataty_mobile` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `moderator_mobile` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_make_year` int(11) DEFAULT NULL,
  `building_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_status` tinyint(4) NOT NULL DEFAULT 1,
  `builder_company_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_company_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_company_address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_rule` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`branch_id`, `area_id`, `branch_name`, `b_email`, `b_contact_no`, `b_address`, `security_guard_mobile`, `secrataty_mobile`, `moderator_mobile`, `building_make_year`, `building_image`, `b_status`, `builder_company_name`, `builder_company_phone`, `builder_company_address`, `building_rule`, `created_date`) VALUES
(7, 1, 'Silver Tower', 'mirpur.1@gmail.com', 1717445566, 'F-Block,Mirpur-1,Dhaka-1216', '+880167119889', '+880911909090', '+88090909090', 9, 'E9EB1C1F-9D88-0FD8-CE34-92F3421FA31D.jpg', 1, 'Golden Developer Company', '+8850505050', 'Test Address\r\nUK', '<p style=\"text-align:center\"><span style=\"color:#e67e22\"><u><span style=\"font-size:36px\"><span style=\"font-family:Trebuchet MS,Helvetica,sans-serif\"><strong>Love Bird Building Rules</strong></span></span></u></span></p>\r\n\r\n<blockquote>\r\n<p><strong><span style=\"color:#16a085\"><span style=\"font-size:20px\">1) Gate Close 10 PM.</span></span></strong></p>\r\n</blockquote>\r\n\r\n<blockquote>\r\n<p><strong><span style=\"color:#16a085\"><span style=\"font-size:20px\">2) New commer must be intruduce with guard.</span></span></strong></p>\r\n</blockquote>\r\n', '2016-06-22 09:50:30'),
(8, 2, 'Da-viruz Systems', 'avinash@mail.com', 1212121212, 'Bolgatanga', '+880167119889', '+880911909090', '+88090909090', 9, '6F7882BD-85CD-8D98-EDCA-1FF65F0BFABA.jpg', 1, 'Da-viruz Systems', '+8850505050', 'test address\r\nGhana', '<p style=\"text-align:center\"><span style=\"color:#e67e22\"><u><span style=\"font-size:36px\"><span style=\"font-family:Trebuchet MS,Helvetica,sans-serif\"><strong>Love Bird Building Rules</strong></span></span></u></span></p>\r\n\r\n<blockquote>\r\n<p><strong><span style=\"color:#16a085\"><span style=\"font-size:20px\">1) Gate Close 10 PM.</span></span></strong></p>\r\n</blockquote>\r\n\r\n<blockquote>\r\n<p><strong><span style=\"color:#16a085\"><span style=\"font-size:20px\">2) New commer must be intruduce with guard.</span></span></strong></p>\r\n</blockquote>\r\n', '2016-06-22 10:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblsuper_admin`
--

CREATE TABLE `tblsuper_admin` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblsuper_admin`
--

INSERT INTO `tblsuper_admin` (`user_id`, `name`, `email`, `contact`, `password`, `added_date`) VALUES
(1, 'Admin 01', 'devsolver@gmail.com', '+8801679110711', 'MTIzNDU2', '2015-06-29 06:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_admin`
--

CREATE TABLE `tbl_add_admin` (
  `aid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_admin`
--

INSERT INTO `tbl_add_admin` (`aid`, `name`, `email`, `contact`, `password`, `image`, `branch_id`, `added_date`) VALUES
(7, 'Sub admin 0', 'subadmin@gmail.com', '+8801679110711', 'MTIzNDU2', 'B7962E98-0550-407D-01A7-3C088DCCD2EF.jpg', 8, '2019-08-27 04:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_bill`
--

CREATE TABLE `tbl_add_bill` (
  `bill_id` int(11) NOT NULL,
  `bill_type` int(11) NOT NULL,
  `bill_date` varchar(200) NOT NULL,
  `bill_month` int(11) NOT NULL,
  `bill_year` int(11) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `deposit_bank_name` varchar(200) NOT NULL,
  `bill_details` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_bill`
--

INSERT INTO `tbl_add_bill` (`bill_id`, `bill_type`, `bill_date`, `bill_month`, `bill_year`, `total_amount`, `deposit_bank_name`, `bill_details`, `branch_id`, `added_date`) VALUES
(14, 4, '27/08/2019', 8, 11, '5000.00', 'DBBL', 'purfect', 8, '2019-08-27 04:37:27'),
(15, 1, '23/05/2022', 5, 15, '12000.00', 'shk', 'dfsfsdfsdf', 8, '2022-05-09 20:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_bill_type`
--

CREATE TABLE `tbl_add_bill_type` (
  `bt_id` int(11) NOT NULL,
  `bill_type` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_bill_type`
--

INSERT INTO `tbl_add_bill_type` (`bt_id`, `bill_type`, `added_date`) VALUES
(1, 'Gas', '2016-05-05 09:49:35'),
(3, 'Water', '2016-05-05 09:50:39'),
(4, 'Electric', '2016-05-05 09:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_builder_info`
--

CREATE TABLE `tbl_add_builder_info` (
  `bldrid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_building_info`
--

CREATE TABLE `tbl_add_building_info` (
  `bldid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `security_guard_mobile` varchar(200) NOT NULL,
  `secrataty_mobile` varchar(200) NOT NULL,
  `moderator_mobile` varchar(200) NOT NULL,
  `building_make_year` varchar(200) NOT NULL,
  `b_name` varchar(200) NOT NULL,
  `b_address` varchar(200) NOT NULL,
  `b_phone` varchar(200) NOT NULL,
  `building_image` varchar(200) NOT NULL,
  `building_rules` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_complain`
--

CREATE TABLE `tbl_add_complain` (
  `complain_id` int(11) NOT NULL,
  `c_title` varchar(200) NOT NULL,
  `c_description` varchar(1000) NOT NULL,
  `c_date` varchar(200) NOT NULL,
  `c_month` int(11) NOT NULL,
  `c_year` varchar(50) NOT NULL,
  `c_userid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `job_status` int(1) NOT NULL DEFAULT 0,
  `assign_employee_id` int(11) DEFAULT 0,
  `solution` varchar(500) NOT NULL,
  `complain_by` varchar(100) DEFAULT NULL,
  `person_name` varchar(250) DEFAULT NULL,
  `person_email` varchar(100) DEFAULT NULL,
  `person_contact` varchar(50) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_complain`
--

INSERT INTO `tbl_add_complain` (`complain_id`, `c_title`, `c_description`, `c_date`, `c_month`, `c_year`, `c_userid`, `branch_id`, `job_status`, `assign_employee_id`, `solution`, `complain_by`, `person_name`, `person_email`, `person_contact`, `added_date`) VALUES
(35, 'Water Problem', 'We need to solve water issue soon.', '27/08/2019', 8, '2019', 0, 8, 0, 12, '', NULL, NULL, NULL, NULL, '2019-08-27 04:38:09'),
(36, 'Flat color issue', 'How flat color condition is really bad kindly solve it.', '28/08/2019', 8, '2019', 20, 8, 2, 0, 'đ', 'tenant', 'Jim Cary', 'jimcary@yahoo.com', '+8801679110711', '2019-08-27 19:29:06'),
(37, 'gdhgg', 'fgfgg', '06/04/2022', 5, '2022', 0, 8, 0, 0, '', NULL, NULL, NULL, NULL, '2022-05-09 20:47:53'),
(38, 'gdhgg', 'sdfsdff', '27/02/2020', 2, '2020', 0, 8, 0, 0, '', NULL, NULL, NULL, NULL, '2022-05-09 20:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_employee`
--

CREATE TABLE `tbl_add_employee` (
  `eid` int(11) NOT NULL,
  `e_name` varchar(200) NOT NULL,
  `e_email` varchar(200) NOT NULL,
  `e_contact` varchar(200) NOT NULL,
  `e_pre_address` varchar(200) NOT NULL,
  `e_per_address` varchar(200) NOT NULL,
  `e_nid` varchar(200) NOT NULL,
  `e_designation` int(11) NOT NULL,
  `e_date` varchar(200) NOT NULL,
  `ending_date` varchar(200) NOT NULL,
  `e_status` int(1) NOT NULL DEFAULT 0,
  `e_password` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `salary` decimal(15,2) NOT NULL DEFAULT 0.00,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_employee`
--

INSERT INTO `tbl_add_employee` (`eid`, `e_name`, `e_email`, `e_contact`, `e_pre_address`, `e_per_address`, `e_nid`, `e_designation`, `e_date`, `ending_date`, `e_status`, `e_password`, `image`, `branch_id`, `salary`, `added_date`) VALUES
(12, 'John Sina', 'johnsina@gmail.com', '+8801679110711', '799 Princess Drive\r\nNorwood, MA 02062', '799 Princess Drive\r\nNorwood, MA 02062', '343434-909090-1212121', 5, '01/09/2019', '', 1, 'MTIzNDU2', '82F6AE8B-7DF6-E937-6095-101FC0BB66A3.jpg', 8, '8000.00', '2019-08-26 19:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_employee_salary_setup`
--

CREATE TABLE `tbl_add_employee_salary_setup` (
  `emp_id` int(11) NOT NULL,
  `emp_name` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `month_id` int(11) NOT NULL,
  `xyear` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `issue_date` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_employee_salary_setup`
--

INSERT INTO `tbl_add_employee_salary_setup` (`emp_id`, `emp_name`, `designation`, `month_id`, `xyear`, `amount`, `issue_date`, `branch_id`, `added_date`) VALUES
(19, 12, 'Security Gard', 8, 11, '8000.00', '05/09/2019', 8, '2019-08-26 19:36:26'),
(20, 12, 'Security Gard', 1, 11, '8000.00', '15/01/2019', 8, '2022-05-09 18:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_fair`
--

CREATE TABLE `tbl_add_fair` (
  `f_id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `rid` int(11) NOT NULL DEFAULT 0,
  `month_id` int(11) NOT NULL,
  `xyear` varchar(200) NOT NULL,
  `rent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `water_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `electric_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `gas_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `security_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `utility_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `other_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_rent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `issue_date` varchar(200) NOT NULL,
  `paid_date` varchar(25) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `bill_status` tinyint(1) NOT NULL DEFAULT 0,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_fair`
--

INSERT INTO `tbl_add_fair` (`f_id`, `type`, `floor_no`, `unit_no`, `rid`, `month_id`, `xyear`, `rent`, `water_bill`, `electric_bill`, `gas_bill`, `security_bill`, `utility_bill`, `other_bill`, `total_rent`, `issue_date`, `paid_date`, `branch_id`, `bill_status`, `added_date`) VALUES
(47, 'Rented', 13, 30, 20, 5, '2022', '50000.00', '2000.00', '1000.00', '800.00', '900.00', '0.00', '0.00', '54700.00', '17/05/2022', '21/05/2022', 8, 0, '2022-05-17 08:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_floor`
--

CREATE TABLE `tbl_add_floor` (
  `fid` int(11) NOT NULL,
  `floor_no` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_floor`
--

INSERT INTO `tbl_add_floor` (`fid`, `floor_no`, `branch_id`, `added_date`) VALUES
(12, '1', 8, '2019-08-26 18:56:32'),
(13, '2', 8, '2019-08-27 04:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_fund`
--

CREATE TABLE `tbl_add_fund` (
  `fund_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `xyear` varchar(200) NOT NULL,
  `f_date` varchar(200) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `purpose` varchar(400) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_fund`
--

INSERT INTO `tbl_add_fund` (`fund_id`, `owner_id`, `month_id`, `xyear`, `f_date`, `total_amount`, `purpose`, `branch_id`, `added_date`) VALUES
(13, 19, 8, '11', '27/08/2019', '200.00', 'Monthly Fund', 8, '2019-08-27 04:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_maintenance_cost`
--

CREATE TABLE `tbl_add_maintenance_cost` (
  `mcid` int(11) NOT NULL,
  `m_title` varchar(200) NOT NULL,
  `m_date` varchar(200) NOT NULL,
  `m_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `m_details` varchar(200) NOT NULL,
  `xmonth` int(11) NOT NULL DEFAULT 0,
  `xyear` int(11) NOT NULL DEFAULT 0,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_maintenance_cost`
--

INSERT INTO `tbl_add_maintenance_cost` (`mcid`, `m_title`, `m_date`, `m_amount`, `m_details`, `xmonth`, `xyear`, `branch_id`, `added_date`) VALUES
(8, 'bla ba', '11/05/2022', '10000.00', 'ụokkl', 5, 15, 8, '2022-05-09 19:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_management_committee`
--

CREATE TABLE `tbl_add_management_committee` (
  `mc_id` int(11) NOT NULL,
  `mc_name` varchar(200) NOT NULL,
  `mc_email` varchar(200) NOT NULL,
  `mc_contact` varchar(200) NOT NULL,
  `mc_pre_address` varchar(500) NOT NULL,
  `mc_per_address` varchar(500) NOT NULL,
  `mc_nid` varchar(200) NOT NULL,
  `member_type` varchar(200) NOT NULL,
  `mc_joining_date` varchar(200) NOT NULL,
  `mc_ending_date` varchar(200) NOT NULL,
  `mc_status` int(1) NOT NULL DEFAULT 0,
  `image` varchar(200) NOT NULL,
  `mc_password` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_management_committee`
--

INSERT INTO `tbl_add_management_committee` (`mc_id`, `mc_name`, `mc_email`, `mc_contact`, `mc_pre_address`, `mc_per_address`, `mc_nid`, `member_type`, `mc_joining_date`, `mc_ending_date`, `mc_status`, `image`, `mc_password`, `branch_id`, `added_date`) VALUES
(9, 'Peter Anderson', 'peter@gmail.com', '121212121', '63 Creek St.\r\nEastpointe, MI 48021', '799 Princess Drive\r\nNorwood, MA 02062', '121212-56565-121212-565656', '1', '27/08/2019', '', 1, '4CF8FD9E-9916-0820-1049-6CD5C211B460.jpg', '123456', 8, '2019-08-27 04:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_member_type`
--

CREATE TABLE `tbl_add_member_type` (
  `member_id` int(11) NOT NULL,
  `member_type` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_member_type`
--

INSERT INTO `tbl_add_member_type` (`member_id`, `member_type`, `added_date`) VALUES
(1, 'Moderator', '2016-04-10 11:56:20'),
(2, 'Secretary General', '2016-04-10 11:59:10'),
(3, 'Member', '2016-04-10 11:59:22'),
(4, 'Pion', '2016-04-10 11:59:29'),
(5, 'Security Gard', '2016-04-10 11:59:41'),
(6, 'Caretaker', '2016-04-10 12:00:17'),
(7, 'Maker', '2017-09-16 17:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_month_setup`
--

CREATE TABLE `tbl_add_month_setup` (
  `m_id` int(11) NOT NULL,
  `month_name` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_month_setup`
--

INSERT INTO `tbl_add_month_setup` (`m_id`, `month_name`, `added_date`) VALUES
(1, '1', '2016-04-11 12:16:15'),
(2, '2', '2016-04-11 12:16:25'),
(3, '3', '2016-04-11 12:16:30'),
(4, '4', '2016-04-11 12:16:36'),
(5, '5', '2016-04-11 12:16:41'),
(6, '6', '2016-04-11 12:16:48'),
(7, '7', '2016-04-11 12:16:53'),
(8, '8', '2016-04-11 12:16:59'),
(9, '9', '2016-04-11 12:17:06'),
(10, '10', '2016-04-11 12:17:14'),
(11, '11', '2016-04-11 12:17:24'),
(12, '12', '2016-04-11 12:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_owner`
--

CREATE TABLE `tbl_add_owner` (
  `ownid` int(11) NOT NULL,
  `o_name` varchar(200) NOT NULL,
  `o_email` varchar(200) NOT NULL,
  `o_contact` varchar(200) NOT NULL,
  `o_pre_address` varchar(500) NOT NULL,
  `o_per_address` varchar(500) NOT NULL,
  `o_nid` varchar(200) NOT NULL,
  `o_password` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_owner`
--

INSERT INTO `tbl_add_owner` (`ownid`, `o_name`, `o_email`, `o_contact`, `o_pre_address`, `o_per_address`, `o_nid`, `o_password`, `image`, `branch_id`, `created_date`) VALUES
(19, 'John Peterson', 'john@gmail.com', '+8801679110711', '7790 4th St.\r\nWoodhaven, NY 11421', '8349 Marlborough Dr.\r\nMarlborough, MA 01752', '90909-4343434-1212121', 'MTIzNDU2', 'B616EE89-C1D1-8984-3C2F-2D192CC5699E.png', 8, '2019-08-26 19:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_owner_unit_relation`
--

CREATE TABLE `tbl_add_owner_unit_relation` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_owner_unit_relation`
--

INSERT INTO `tbl_add_owner_unit_relation` (`id`, `owner_id`, `unit_id`) VALUES
(1, 19, 30),
(2, 19, 32);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_owner_utility`
--

CREATE TABLE `tbl_add_owner_utility` (
  `owner_utility_id` int(11) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `rent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `water_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `electric_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `gas_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `security_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `utility_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `other_bill` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_rent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `issue_date` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_rent`
--

CREATE TABLE `tbl_add_rent` (
  `rid` int(11) NOT NULL,
  `r_name` varchar(200) NOT NULL,
  `r_dob` varchar(200) NOT NULL,
  `r_email` varchar(200) NOT NULL,
  `r_contact` varchar(200) DEFAULT '+84 ',
  `r_address` varchar(200) NOT NULL,
  `r_nid` varchar(200) NOT NULL,
  `r_floor_id` int(11) DEFAULT NULL,
  `r_unit_id` int(11) DEFAULT NULL,
  `r_advance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `r_rent_pm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `r_date` varchar(200) NOT NULL,
  `r_gone_date` varchar(200) DEFAULT NULL,
  `r_password` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `r_status` int(1) NOT NULL DEFAULT 1,
  `r_month` int(11) NOT NULL,
  `r_year` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_rent`
--

INSERT INTO `tbl_add_rent` (`rid`, `r_name`, `r_dob`, `r_email`, `r_contact`, `r_address`, `r_nid`, `r_floor_id`, `r_unit_id`, `r_advance`, `r_rent_pm`, `r_date`, `r_gone_date`, `r_password`, `image`, `r_status`, `r_month`, `r_year`, `branch_id`, `added_date`) VALUES
(20, 'Nguyễn Văn An', '12/01/2000', 'citizen1@gmail.com', '+8801679110711', '63 Creek St.Eastpointe, MI 48021', '232323-565656-212121', 13, 30, '100000.00', '0.00', '27/08/2019', '', 'MTIzNDU2', '1D7A8F0A-8D07-A9A6-5A2E-08384D592F53.png', 1, 8, 11, 8, '2019-08-26 19:33:04'),
(34, 'Phạm Tiến Duật', '03/07/2000', 'cuongnew37@gmail.com', '+84 ', 'Số 16A, Ngách 79/40 Dương Quảng Hàm , Tổ 19, Quan Hoa, Cầu Giấy, Hà Nội', '001200006400', 12, 31, '0.00', '0.00', '26/05/2022', NULL, 'MTIzNDU2', '', 1, 5, 15, 8, '2022-05-26 20:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_service`
--

CREATE TABLE `tbl_add_service` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `utility_id` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `first_month_free` tinyint(1) NOT NULL DEFAULT 0,
  `count` int(11) NOT NULL DEFAULT -1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_add_service`
--

INSERT INTO `tbl_add_service` (`id`, `name`, `utility_id`, `sub_type`, `first_month_free`, `count`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Gói beginner', 2, 1, 0, -1, '15000.00', '2022-05-23 15:53:51', '2022-05-23 23:03:33'),
(3, 'Gói returner', 2, 1, 0, -1, '1000000.00', '2022-05-24 23:03:34', '2022-05-24 23:03:34'),
(4, 'Gói vui chơi tri ân khách hàng', 4, 1, 0, -1, '1000000.00', '2022-05-25 08:45:17', '2022-05-25 08:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_subscription`
--

CREATE TABLE `tbl_add_subscription` (
  `id` int(11) NOT NULL,
  `rent_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `usage_count` int(11) NOT NULL DEFAULT -1,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_add_subscription`
--

INSERT INTO `tbl_add_subscription` (`id`, `rent_id`, `service_id`, `usage_count`, `month`, `year`, `status`, `joined_at`, `unsubscribed_at`) VALUES
(2, 20, 3, -1, 5, 15, 1, '2022-05-25 02:32:06', '2022-05-25 05:42:30'),
(3, 20, 4, -1, 5, 15, 0, '2022-05-25 09:28:11', '2022-05-25 11:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_unit`
--

CREATE TABLE `tbl_add_unit` (
  `uid` int(11) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `unit_no` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `rent_pm` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(1) NOT NULL DEFAULT 0,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_unit`
--

INSERT INTO `tbl_add_unit` (`uid`, `floor_no`, `unit_no`, `branch_id`, `rent_pm`, `status`, `added_date`) VALUES
(30, 13, 'Flat 2C', 8, '50000.00', 1, '2019-08-26 18:56:56'),
(31, 12, 'Flat 1B', 8, '10000.00', 1, '2019-08-26 18:57:09'),
(32, 13, 'Flat 2A', 8, '0.00', 0, '2019-08-27 04:07:08'),
(33, 13, 'Flat 2B', 8, '0.00', 0, '2019-08-27 04:07:35'),
(34, 12, 'Flat 1F', 8, '190000.00', 0, '2022-05-11 09:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_utility`
--

CREATE TABLE `tbl_add_utility` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `area_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_add_utility`
--

INSERT INTO `tbl_add_utility` (`id`, `name`, `area_id`, `created_at`, `updated_at`) VALUES
(2, 'Phòng GYM', 1, '2022-05-23 19:01:49', '2022-05-23 23:13:53'),
(4, 'Khu vui chơi', 2, '2022-05-25 08:07:04', '2022-05-25 08:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_utility_bill`
--

CREATE TABLE `tbl_add_utility_bill` (
  `utility_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT 0,
  `gas_bill` varchar(200) NOT NULL,
  `security_bill` varchar(200) NOT NULL,
  `water_bill` varchar(200) NOT NULL,
  `electric_bill` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_utility_bill`
--

INSERT INTO `tbl_add_utility_bill` (`utility_id`, `branch_id`, `gas_bill`, `security_bill`, `water_bill`, `electric_bill`, `added_date`) VALUES
(5, 7, '850', '800', '', '', '2018-05-14 06:31:40'),
(7, 8, '800', '900', '1000', '500', '2022-05-17 07:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_year_setup`
--

CREATE TABLE `tbl_add_year_setup` (
  `y_id` int(11) NOT NULL,
  `xyear` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_year_setup`
--

INSERT INTO `tbl_add_year_setup` (`y_id`, `xyear`, `added_date`) VALUES
(4, '2012', '2016-04-13 14:02:38'),
(5, '2013', '2016-04-13 14:02:42'),
(6, '2014', '2016-04-13 14:02:47'),
(7, '2015', '2016-04-13 14:02:51'),
(8, '2016', '2016-04-13 14:02:56'),
(9, '2017', '2016-04-13 14:03:04'),
(10, '2018', '2016-04-13 14:03:08'),
(11, '2019', '2016-04-13 14:03:12'),
(12, '2020', '2016-04-13 14:03:17'),
(13, '2021', '2018-04-20 06:12:54'),
(14, '2021', '2018-05-18 14:13:10'),
(15, '2022', '2018-05-18 14:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Khu A', '2022-05-19 02:30:52', '2022-05-19 03:21:25'),
(2, 'Khu B', '2022-05-19 03:10:20', '2022-05-19 03:21:25'),
(3, 'Khu D', '2022-05-19 03:35:39', '2022-05-19 04:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currency`
--

CREATE TABLE `tbl_currency` (
  `cid` int(11) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_currency`
--

INSERT INTO `tbl_currency` (`cid`, `symbol`, `name`) VALUES
(1, 'Â£', 'Pound'),
(2, '$', 'Dollar'),
(3, 'â‚¨', 'Rupee'),
(5, 'â‚¦', 'Naira'),
(6, 'â‚¬', 'Euro'),
(7, 'Br', 'Belarussian Ruble'),
(8, 'à§³', 'Taka'),
(9, 'kr', 'Swedish Krona'),
(10, 'â‚±', 'Philippine Peso'),
(11, 'Â¥', 'Yuan'),
(12, 'đ', 'VNĐ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_leave_request`
--

CREATE TABLE `tbl_employee_leave_request` (
  `leave_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `leave_text` varchar(5000) NOT NULL,
  `request_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employee_leave_request`
--

INSERT INTO `tbl_employee_leave_request` (`leave_id`, `employee_id`, `branch_id`, `from`, `to`, `leave_text`, `request_status`, `request_date`) VALUES
(1, 12, 8, '2022-05-20', '2022-06-03', 'xxc', 'Pending', '2022-05-20 09:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_notice`
--

CREATE TABLE `tbl_employee_notice` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(500) NOT NULL,
  `notice_description` text NOT NULL,
  `notice_status` tinyint(4) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meeting`
--

CREATE TABLE `tbl_meeting` (
  `meeting_id` int(11) NOT NULL,
  `meeting_title` varchar(300) NOT NULL,
  `meeting_description` text NOT NULL,
  `issue_date` date NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_meeting`
--

INSERT INTO `tbl_meeting` (`meeting_id`, `meeting_title`, `meeting_description`, `issue_date`, `branch_id`) VALUES
(6, 'Water Problem', '<p><strong>We need to solve water problem soon.</strong></p>\r\n', '2019-08-27', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notice_board`
--

CREATE TABLE `tbl_notice_board` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(500) NOT NULL,
  `notice_description` text NOT NULL,
  `notice_status` tinyint(1) NOT NULL DEFAULT 1,
  `branch_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_notice_board`
--

INSERT INTO `tbl_notice_board` (`notice_id`, `notice_title`, `notice_description`, `notice_status`, `branch_id`, `created_date`) VALUES
(8, 'bla bls ', '<p>adsfaadasdasd</p>\r\n', 1, 8, '2022-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_alert`
--

CREATE TABLE `tbl_notification_alert` (
  `notification_Id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1=sms,2=email,3=both',
  `user_details` varchar(5000) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner_notice_board`
--

CREATE TABLE `tbl_owner_notice_board` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(500) NOT NULL,
  `notice_description` text NOT NULL,
  `notice_status` tinyint(1) NOT NULL DEFAULT 1,
  `branch_id` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `lang_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `currency` varchar(20) CHARACTER SET utf8 NOT NULL,
  `currency_seperator` varchar(5) CHARACTER SET utf8 NOT NULL,
  `currency_position` varchar(10) CHARACTER SET utf8 NOT NULL,
  `currency_decimal` int(11) NOT NULL DEFAULT 2,
  `mail_protocol` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'mail',
  `super_admin_image` varchar(350) CHARACTER SET utf8 NOT NULL,
  `date_format` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `smtp_hostname` varchar(250) DEFAULT NULL,
  `smtp_username` varchar(250) DEFAULT NULL,
  `smtp_password` varchar(250) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT NULL,
  `smtp_secure` varchar(10) DEFAULT NULL,
  `cat_username` varchar(50) DEFAULT NULL,
  `cat_password` varchar(100) DEFAULT NULL,
  `cat_apikey` varchar(100) DEFAULT NULL,
  `bank_type` varchar(200) NOT NULL,
  `bank_number` varchar(200) NOT NULL,
  `bank_owner` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `lang_code`, `currency`, `currency_seperator`, `currency_position`, `currency_decimal`, `mail_protocol`, `super_admin_image`, `date_format`, `smtp_hostname`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_secure`, `cat_username`, `cat_password`, `cat_apikey`, `bank_type`, `bank_number`, `bank_owner`) VALUES
(10, 'Vietnam', 'đ', ',', 'right', 2, 'mail', 'DDE19E53-4F61-4189-7C09-0143DF0C32BA.png', NULL, '', '', '', '', 'tls', '', '', '', 'OceanBank', '112836331323', 'Nguyen Yu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitor`
--

CREATE TABLE `tbl_visitor` (
  `vid` int(11) NOT NULL,
  `issue_date` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(500) CHARACTER SET utf8 NOT NULL,
  `floor_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `intime` varchar(50) CHARACTER SET utf8 NOT NULL,
  `outtime` varchar(50) CHARACTER SET utf8 NOT NULL,
  `xmonth` int(11) NOT NULL,
  `xyear` varchar(50) CHARACTER SET utf8 NOT NULL,
  `branch_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_visitor`
--

INSERT INTO `tbl_visitor` (`vid`, `issue_date`, `name`, `mobile`, `address`, `floor_id`, `unit_id`, `intime`, `outtime`, `xmonth`, `xyear`, `branch_id`, `added_date`) VALUES
(17, '27/08/2019', 'Kalvin Peter', '1212121212', '799 Princess Drive\r\nNorwood, MA 02062', 12, 30, '12:50 PM', '05:50 PM', 8, '2019', 8, '2019-08-27 04:40:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `building_make_year` (`building_make_year`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tblsuper_admin`
--
ALTER TABLE `tblsuper_admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_add_admin`
--
ALTER TABLE `tbl_add_admin`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_bill`
--
ALTER TABLE `tbl_add_bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bill_type` (`bill_type`),
  ADD KEY `bill_month` (`bill_month`),
  ADD KEY `bill_year` (`bill_year`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_bill_type`
--
ALTER TABLE `tbl_add_bill_type`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `tbl_add_builder_info`
--
ALTER TABLE `tbl_add_builder_info`
  ADD PRIMARY KEY (`bldrid`);

--
-- Indexes for table `tbl_add_building_info`
--
ALTER TABLE `tbl_add_building_info`
  ADD PRIMARY KEY (`bldid`);

--
-- Indexes for table `tbl_add_complain`
--
ALTER TABLE `tbl_add_complain`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `c_month` (`c_month`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_employee`
--
ALTER TABLE `tbl_add_employee`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `e_designation` (`e_designation`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_employee_salary_setup`
--
ALTER TABLE `tbl_add_employee_salary_setup`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `emp_name` (`emp_name`),
  ADD KEY `month_id` (`month_id`),
  ADD KEY `xyear` (`xyear`);

--
-- Indexes for table `tbl_add_fair`
--
ALTER TABLE `tbl_add_fair`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `unit_no` (`unit_no`),
  ADD KEY `floor_no` (`floor_no`),
  ADD KEY `month_id` (`month_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `tbl_add_floor`
--
ALTER TABLE `tbl_add_floor`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_fund`
--
ALTER TABLE `tbl_add_fund`
  ADD PRIMARY KEY (`fund_id`);

--
-- Indexes for table `tbl_add_maintenance_cost`
--
ALTER TABLE `tbl_add_maintenance_cost`
  ADD PRIMARY KEY (`mcid`),
  ADD KEY `xmonth` (`xmonth`),
  ADD KEY `xyear` (`xyear`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_management_committee`
--
ALTER TABLE `tbl_add_management_committee`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `tbl_add_member_type`
--
ALTER TABLE `tbl_add_member_type`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_add_month_setup`
--
ALTER TABLE `tbl_add_month_setup`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_add_owner`
--
ALTER TABLE `tbl_add_owner`
  ADD PRIMARY KEY (`ownid`);

--
-- Indexes for table `tbl_add_owner_unit_relation`
--
ALTER TABLE `tbl_add_owner_unit_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `tbl_add_owner_utility`
--
ALTER TABLE `tbl_add_owner_utility`
  ADD PRIMARY KEY (`owner_utility_id`);

--
-- Indexes for table `tbl_add_rent`
--
ALTER TABLE `tbl_add_rent`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `r_floor_id` (`r_floor_id`),
  ADD KEY `r_unit_id` (`r_unit_id`),
  ADD KEY `r_month` (`r_month`),
  ADD KEY `r_year` (`r_year`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_service`
--
ALTER TABLE `tbl_add_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_add_service_ibfk_1` (`utility_id`);

--
-- Indexes for table `tbl_add_subscription`
--
ALTER TABLE `tbl_add_subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_id` (`rent_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `month` (`month`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `tbl_add_unit`
--
ALTER TABLE `tbl_add_unit`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `floor_no` (`floor_no`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_utility`
--
ALTER TABLE `tbl_add_utility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tbl_add_utility_bill`
--
ALTER TABLE `tbl_add_utility_bill`
  ADD PRIMARY KEY (`utility_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_add_year_setup`
--
ALTER TABLE `tbl_add_year_setup`
  ADD PRIMARY KEY (`y_id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_currency`
--
ALTER TABLE `tbl_currency`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_employee_leave_request`
--
ALTER TABLE `tbl_employee_leave_request`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_employee_notice`
--
ALTER TABLE `tbl_employee_notice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_meeting`
--
ALTER TABLE `tbl_meeting`
  ADD PRIMARY KEY (`meeting_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_notice_board`
--
ALTER TABLE `tbl_notice_board`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_notification_alert`
--
ALTER TABLE `tbl_notification_alert`
  ADD PRIMARY KEY (`notification_Id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_owner_notice_board`
--
ALTER TABLE `tbl_owner_notice_board`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `floor_id` (`floor_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `xmonth` (`xmonth`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbranch`
--
ALTER TABLE `tblbranch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblsuper_admin`
--
ALTER TABLE `tblsuper_admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_add_admin`
--
ALTER TABLE `tbl_add_admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_add_bill`
--
ALTER TABLE `tbl_add_bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_add_bill_type`
--
ALTER TABLE `tbl_add_bill_type`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_add_builder_info`
--
ALTER TABLE `tbl_add_builder_info`
  MODIFY `bldrid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_add_building_info`
--
ALTER TABLE `tbl_add_building_info`
  MODIFY `bldid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_add_complain`
--
ALTER TABLE `tbl_add_complain`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_add_employee`
--
ALTER TABLE `tbl_add_employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_add_employee_salary_setup`
--
ALTER TABLE `tbl_add_employee_salary_setup`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_add_fair`
--
ALTER TABLE `tbl_add_fair`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_add_floor`
--
ALTER TABLE `tbl_add_floor`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_add_fund`
--
ALTER TABLE `tbl_add_fund`
  MODIFY `fund_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_add_maintenance_cost`
--
ALTER TABLE `tbl_add_maintenance_cost`
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_add_management_committee`
--
ALTER TABLE `tbl_add_management_committee`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_add_member_type`
--
ALTER TABLE `tbl_add_member_type`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_add_month_setup`
--
ALTER TABLE `tbl_add_month_setup`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_add_owner`
--
ALTER TABLE `tbl_add_owner`
  MODIFY `ownid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_add_owner_unit_relation`
--
ALTER TABLE `tbl_add_owner_unit_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_add_owner_utility`
--
ALTER TABLE `tbl_add_owner_utility`
  MODIFY `owner_utility_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_add_rent`
--
ALTER TABLE `tbl_add_rent`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_add_service`
--
ALTER TABLE `tbl_add_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_add_subscription`
--
ALTER TABLE `tbl_add_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_add_unit`
--
ALTER TABLE `tbl_add_unit`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_add_utility`
--
ALTER TABLE `tbl_add_utility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_add_utility_bill`
--
ALTER TABLE `tbl_add_utility_bill`
  MODIFY `utility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_add_year_setup`
--
ALTER TABLE `tbl_add_year_setup`
  MODIFY `y_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_currency`
--
ALTER TABLE `tbl_currency`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_employee_leave_request`
--
ALTER TABLE `tbl_employee_leave_request`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_employee_notice`
--
ALTER TABLE `tbl_employee_notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_meeting`
--
ALTER TABLE `tbl_meeting`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_notice_board`
--
ALTER TABLE `tbl_notice_board`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_notification_alert`
--
ALTER TABLE `tbl_notification_alert`
  MODIFY `notification_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_owner_notice_board`
--
ALTER TABLE `tbl_owner_notice_board`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD CONSTRAINT `tblbranch_ibfk_1` FOREIGN KEY (`building_make_year`) REFERENCES `tbl_add_year_setup` (`y_id`),
  ADD CONSTRAINT `tblbranch_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `tbl_area` (`id`);

--
-- Constraints for table `tbl_add_admin`
--
ALTER TABLE `tbl_add_admin`
  ADD CONSTRAINT `tbl_add_admin_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_bill`
--
ALTER TABLE `tbl_add_bill`
  ADD CONSTRAINT `tbl_add_bill_ibfk_1` FOREIGN KEY (`bill_type`) REFERENCES `tbl_add_bill_type` (`bt_id`),
  ADD CONSTRAINT `tbl_add_bill_ibfk_2` FOREIGN KEY (`bill_month`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_bill_ibfk_3` FOREIGN KEY (`bill_year`) REFERENCES `tbl_add_year_setup` (`y_id`),
  ADD CONSTRAINT `tbl_add_bill_ibfk_4` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_complain`
--
ALTER TABLE `tbl_add_complain`
  ADD CONSTRAINT `tbl_add_complain_ibfk_1` FOREIGN KEY (`c_month`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_complain_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_employee`
--
ALTER TABLE `tbl_add_employee`
  ADD CONSTRAINT `tbl_add_employee_ibfk_1` FOREIGN KEY (`e_designation`) REFERENCES `tbl_add_member_type` (`member_id`),
  ADD CONSTRAINT `tbl_add_employee_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_employee_salary_setup`
--
ALTER TABLE `tbl_add_employee_salary_setup`
  ADD CONSTRAINT `tbl_add_employee_salary_setup_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`),
  ADD CONSTRAINT `tbl_add_employee_salary_setup_ibfk_2` FOREIGN KEY (`emp_name`) REFERENCES `tbl_add_employee` (`eid`),
  ADD CONSTRAINT `tbl_add_employee_salary_setup_ibfk_3` FOREIGN KEY (`month_id`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_employee_salary_setup_ibfk_4` FOREIGN KEY (`xyear`) REFERENCES `tbl_add_year_setup` (`y_id`);

--
-- Constraints for table `tbl_add_fair`
--
ALTER TABLE `tbl_add_fair`
  ADD CONSTRAINT `tbl_add_fair_ibfk_1` FOREIGN KEY (`unit_no`) REFERENCES `tbl_add_unit` (`uid`),
  ADD CONSTRAINT `tbl_add_fair_ibfk_2` FOREIGN KEY (`floor_no`) REFERENCES `tbl_add_floor` (`fid`),
  ADD CONSTRAINT `tbl_add_fair_ibfk_3` FOREIGN KEY (`month_id`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_fair_ibfk_4` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`),
  ADD CONSTRAINT `tbl_add_fair_ibfk_5` FOREIGN KEY (`rid`) REFERENCES `tbl_add_rent` (`rid`);

--
-- Constraints for table `tbl_add_floor`
--
ALTER TABLE `tbl_add_floor`
  ADD CONSTRAINT `tbl_add_floor_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_maintenance_cost`
--
ALTER TABLE `tbl_add_maintenance_cost`
  ADD CONSTRAINT `tbl_add_maintenance_cost_ibfk_1` FOREIGN KEY (`xmonth`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_maintenance_cost_ibfk_2` FOREIGN KEY (`xyear`) REFERENCES `tbl_add_year_setup` (`y_id`),
  ADD CONSTRAINT `tbl_add_maintenance_cost_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_rent`
--
ALTER TABLE `tbl_add_rent`
  ADD CONSTRAINT `tbl_add_rent_ibfk_1` FOREIGN KEY (`r_floor_id`) REFERENCES `tbl_add_floor` (`fid`),
  ADD CONSTRAINT `tbl_add_rent_ibfk_2` FOREIGN KEY (`r_unit_id`) REFERENCES `tbl_add_unit` (`uid`),
  ADD CONSTRAINT `tbl_add_rent_ibfk_3` FOREIGN KEY (`r_month`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_rent_ibfk_4` FOREIGN KEY (`r_year`) REFERENCES `tbl_add_year_setup` (`y_id`),
  ADD CONSTRAINT `tbl_add_rent_ibfk_5` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_service`
--
ALTER TABLE `tbl_add_service`
  ADD CONSTRAINT `tbl_add_service_ibfk_1` FOREIGN KEY (`utility_id`) REFERENCES `tbl_add_utility` (`id`);

--
-- Constraints for table `tbl_add_subscription`
--
ALTER TABLE `tbl_add_subscription`
  ADD CONSTRAINT `tbl_add_subscription_ibfk_1` FOREIGN KEY (`rent_id`) REFERENCES `tbl_add_rent` (`rid`),
  ADD CONSTRAINT `tbl_add_subscription_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `tbl_add_service` (`id`),
  ADD CONSTRAINT `tbl_add_subscription_ibfk_3` FOREIGN KEY (`month`) REFERENCES `tbl_add_month_setup` (`m_id`),
  ADD CONSTRAINT `tbl_add_subscription_ibfk_4` FOREIGN KEY (`year`) REFERENCES `tbl_add_year_setup` (`y_id`);

--
-- Constraints for table `tbl_add_unit`
--
ALTER TABLE `tbl_add_unit`
  ADD CONSTRAINT `tbl_add_unit_ibfk_1` FOREIGN KEY (`floor_no`) REFERENCES `tbl_add_floor` (`fid`),
  ADD CONSTRAINT `tbl_add_unit_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_add_utility`
--
ALTER TABLE `tbl_add_utility`
  ADD CONSTRAINT `tbl_add_utility_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `tbl_area` (`id`);

--
-- Constraints for table `tbl_add_utility_bill`
--
ALTER TABLE `tbl_add_utility_bill`
  ADD CONSTRAINT `tbl_add_utility_bill_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_employee_leave_request`
--
ALTER TABLE `tbl_employee_leave_request`
  ADD CONSTRAINT `tbl_employee_leave_request_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_add_employee` (`eid`),
  ADD CONSTRAINT `tbl_employee_leave_request_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_employee_notice`
--
ALTER TABLE `tbl_employee_notice`
  ADD CONSTRAINT `tbl_employee_notice_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_meeting`
--
ALTER TABLE `tbl_meeting`
  ADD CONSTRAINT `tbl_meeting_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_notice_board`
--
ALTER TABLE `tbl_notice_board`
  ADD CONSTRAINT `tbl_notice_board_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_notification_alert`
--
ALTER TABLE `tbl_notification_alert`
  ADD CONSTRAINT `tbl_notification_alert_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`);

--
-- Constraints for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  ADD CONSTRAINT `tbl_visitor_ibfk_1` FOREIGN KEY (`floor_id`) REFERENCES `tbl_add_floor` (`fid`),
  ADD CONSTRAINT `tbl_visitor_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tblbranch` (`branch_id`),
  ADD CONSTRAINT `tbl_visitor_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `tbl_add_unit` (`uid`),
  ADD CONSTRAINT `tbl_visitor_ibfk_4` FOREIGN KEY (`xmonth`) REFERENCES `tbl_add_month_setup` (`m_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
