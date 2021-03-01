-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 12:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `max2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `phone`, `course`, `Location`, `country`, `message`, `date_added`) VALUES
(1, 'VINODKUMAR', 'vinod.maurya1@gmail.com', '9899185034', 'MASTER OF COMPUTER', 'DELHI', 'INDIA', 'ADASD ADSASD ASDASD', '2020-08-20 13:58:19'),
(2, 'vinod', 'vinod.maurya1@gmail.com', '9899185034', 'master of comupter scoinece', 'delhi', 'India', 'test test test', '2020-08-26 12:48:20'),
(3, 'vinod', 'vinod.maurya1@gmail.com', '9899185034', 'master of comupter scoinece', 'delhi', 'India', 'test test test', '2020-08-26 12:49:05'),
(4, 'vinod', 'vinod.maurya1@gmail.com', '9899185034', 'master of comupter scoinece', 'delhi', 'India', 'test test test', '2020-08-26 12:49:05'),
(5, 'ASHISH', 'meashish10@gmail.com', '9582949880', 'MEM', 'DELHI', 'India', 'i want to enquire about the USA admission procedures.kindly revert', '2021-01-07 16:46:31'),
(6, 'umJftKMx', 'robertwells1584@gmail.com', '7617772382', 'UYjRbIleo', 'jtTOcYaN', 'RAMEJYbvF', 'SVeIntuB', '2021-01-25 22:11:34'),
(7, 'qYRkaNmplswiH', 'grimesvafth54@gmail.com', '6370909105', 'Owrsomvu', 'AaRvVUieFokf', 'VgANXdhpJT', 'AmEIQVeFdRhKuMcf', '2021-02-09 18:25:19'),
(8, 'LhHwUqbEKknrT', 'grimesvafth54@gmail.com', '6812047798', 'YtignhlFfk', 'EbOgKtdlG', 'NzBOagArt', 'xSHVsTvRKZ', '2021-02-09 18:25:20'),
(9, 'OSyArconkYBFD', 'allengerald466@gmail.com', '7181713515', 'FbeypVZkTuoJXl', 'KOJBaEUPNzeV', 'elIGTgXfOR', 'CJGbcmBk', '2021-02-22 15:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_desc` text NOT NULL,
  `short_coursedesc` text NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_image` varchar(255) NOT NULL,
  `coursepdf` varchar(255) NOT NULL,
  `coursediscount` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `product_adddate` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `course_desc`, `short_coursedesc`, `course_price`, `course_image`, `coursepdf`, `coursediscount`, `teacher_name`, `hours`, `ip_address`, `product_adddate`, `status`, `added_date`) VALUES
(4, 'Bachelor Of applied Arts -Digital Media (Guaranteed Internship *)', '', ' ', 60, 'pro5.png', 'Advanced Excel.pdf', 0, 'NA', '20', '::1', '2019-09-27 10:41:33', '1', '2020-08-24 11:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_num` bigint(20) NOT NULL,
  `card_cvc` int(5) NOT NULL,
  `card_exp_month` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `card_exp_year` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_price_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `card_num`, `card_cvc`, `card_exp_month`, `card_exp_year`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `ip_address`, `created`, `modified`) VALUES
(1, 'vinod', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI5', 200.00, 'usd', '200', 'usd', 'txn_1FQuI5Cc9mm8SSABxhQUoTDI', 'succeeded', '', '2019-10-07 22:22:14', '2019-10-07 22:22:14'),
(2, 'vinod', 'manoj@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI20191007F0705', 200.00, 'usd', '200', 'usd', 'txn_1FQuL8Cc9mm8SSABlQf3nanG', 'succeeded', '', '2019-10-07 22:25:22', '2019-10-07 22:25:22'),
(3, 'vinod', 'sinu@gmail.com', 0, 0, '', '', 'DATA ANALYTICS', 'CI201910077F6C3', 10000.00, 'usd', '10000', 'usd', 'txn_1FQuvJCc9mm8SSAB4vn8S75G', 'succeeded', '', '2019-10-07 23:02:46', '2019-10-07 23:02:46'),
(4, 'vinod', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI201910092AA85', 200.00, 'usd', '200', 'usd', 'txn_1FRXPTCc9mm8SSABaRUTYhQN', 'succeeded', '', '2019-10-09 16:08:38', '2019-10-09 16:08:38'),
(5, 'vinod', 'sona@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI2019100978695', 200.00, 'usd', '200', 'usd', 'txn_1FRXUeCc9mm8SSABM7vBCCTs', 'succeeded', '', '2019-10-09 16:13:59', '2019-10-09 16:13:59'),
(6, 'vinod', 'ded@gmail.com', 0, 0, '', '', 'DATA ANALYTICS', 'CI201910090D1F3', 10000.00, 'usd', '10000', 'usd', 'txn_1FRXg8Cc9mm8SSABIJMMtcPI', 'succeeded', '::1', '2019-10-09 16:25:51', '2019-10-09 16:25:51'),
(7, 'vinod', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'ADVANCED EXCEL', 'CI201910107B014', 60.00, 'usd', '60', 'usd', 'txn_1FRxEdCc9mm8SSABbhMqtdIz', 'succeeded', '::1', '2019-10-10 19:43:04', '2019-10-10 19:43:04'),
(8, 'vinod maurya', 'arbaz@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI201910104E165', 200.00, 'usd', '200', 'usd', 'txn_1FS0j0Cc9mm8SSABeDQ8x4Kx', 'succeeded', '::1', '2019-10-10 23:26:34', '2019-10-10 23:26:34'),
(9, 'vinod maurya', 'sonu45@gmail.com', 0, 0, '', '', 'CYBER SECURITY', 'CI20191010856A1', 55.00, 'usd', '55', 'usd', 'txn_1FS0kDCc9mm8SSABovB7qEkd', 'succeeded', '::1', '2019-10-10 23:27:49', '2019-10-10 23:27:49'),
(10, 'vinod maurya', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'PENETRATION TESTER', 'CI201910102EE32', 80.00, 'usd', '80', 'usd', 'txn_1FS0nuCc9mm8SSABPx8Qwub0', 'succeeded', '::1', '2019-10-10 23:31:38', '2019-10-10 23:31:38'),
(11, 'vinod maurya', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'DATA ANALYTICS', 'CI201910211C323', 10000.00, 'usd', '10000', 'usd', 'txn_1FVyu7Cc9mm8SSABxLmh0oe3', 'succeeded', '::1', '2019-10-21 22:18:35', '2019-10-21 22:18:35'),
(12, 'vinod maurya', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI20191104E7E25', 200.00, 'usd', '200', 'usd', 'txn_1Fb095Cc9mm8SSAB5pXJ04at', 'succeeded', '::1', '2019-11-04 18:38:39', '2019-11-04 18:38:39'),
(13, 'vinod maurya', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'DIGITAL MARKETING', 'CI20191115F52A5', 200.00, 'usd', '200', 'usd', 'txn_1Ff38aCc9mm8SSABQbykIbdt', 'succeeded', '::1', '2019-11-15 22:38:52', '2019-11-15 22:38:52'),
(14, 'vinod maurya', 'vinod.maurya1@gmail.com', 0, 0, '', '', 'CISM', 'CI202003063D586', 300.00, 'usd', '300', 'usd', 'txn_1GJYuYCc9mm8SSABh6gTJR6O', 'succeeded', '::1', '2020-03-06 16:39:54', '2020-03-06 16:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `page_seo`
--

CREATE TABLE `page_seo` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_seo`
--

INSERT INTO `page_seo` (`id`, `page_name`, `title`, `meta_keywords`, `meta_description`, `date_added`) VALUES
(1, '', 'Max Scholarship | Study Abroad, Admission, IELTS, Scholarship %', 'Max Scholarship', 'Max Scholarship collected the right expertise and knowledge to facilitate admission in any of the top universities in the USA, UK, Australia, Canada, Europe and New Zealand.', '2020-08-20 16:16:19'),
(2, 'aboutus', 'aboutus', 'about maxscholarship, About us, Abroad Unified Pathway Program, Study in Newzealand , about Newzealand education consultant', '<p>Maxscholarship Pathway Program is specifically designed for students, who wish to continue their Bachelor, Undergraduate, Master &amp; Post Graduate Degree in Australia.</p>', '2020-08-24 11:39:36'),
(3, 'contactus', 'Contact Us - Maxscholarship| Best Study in Australia Consultancy', 'contact maxscholarship, contact A pathway program, contact number of maxscholarship, contact details of maxscholarship, Email ID & Phone number of maxscholarship, contact Australia education consultants', 'Contact Maxscholarship - India\'s biggest Australia Education Consultants in New Delhi provide you best study in Australia with top Universities,etc.', '2020-08-22 14:35:10'),
(4, 'ielts', 'ielts', 'ielts', 'ielts', '2020-08-20 16:20:14'),
(5, 'ourservices', 'ourservices', 'ourservices', 'ourservices', '2020-08-20 16:20:52'),
(6, 'study-in-uk', 'study-in-uk', 'study in uk', 'study in uk', '2020-08-22 13:40:00'),
(7, 'study-in-australia', 'study-in-australia', 'study in australia', 'study in australia', '2020-08-22 13:40:12'),
(8, 'study-in-new-zealand', 'study-in-new-zealand', 'study in new zealand', 'study in new zealand', '2020-08-22 13:40:28'),
(9, 'study-in-canada', 'study-in-canada', 'study in canada', 'study in canada', '2020-08-22 13:40:41'),
(10, 'study-in-usa', 'study-in-uk', 'study in uk', 'study in uk', '2020-08-22 13:40:54'),
(11, 'study-in-europe', 'study-in-europe', 'study in europe', 'study in europe', '2020-08-22 13:41:04'),
(12, 'accounts-banking-and-finance', 'accounts-banking-and-finance', 'accounts banking and finance', 'accounts banking and finance', '2020-08-22 13:41:16'),
(13, 'arts', 'arts', 'arts', 'arts', '2020-08-20 17:31:29'),
(14, 'business-and-management', 'business-and-management', 'business and management', 'business and management', '2020-08-22 13:41:26'),
(15, 'computer-science-and-it', 'computer-science-and-it', 'computer science and it', 'computer science and it', '2020-08-22 13:41:46'),
(16, 'engineering', 'engineering', 'engineering', 'engineering', '2020-08-20 18:23:31'),
(17, 'fashion-and-ethics', 'fashion and ethics', 'fashion and ethics', 'fashion and ethics', '2020-08-20 18:24:05'),
(18, 'hospitality-tourism-and-hotelmanagement', 'hospitality tourism and hotel management', 'hospitality tourism and hotel management', 'hospitality tourism and hotel management', '2020-08-20 18:24:47'),
(19, 'law', 'law', 'law', 'law', '2020-08-20 18:25:12'),
(20, 'media-and-creative-arts', 'media and creative arts', 'media and creative arts', 'media and creative arts', '2020-08-20 18:26:02'),
(21, 'nursing', 'nursing', 'nursing', 'nursing', '2020-08-20 18:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `txn_id` int(11) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `PayerStatus` varchar(50) NOT NULL,
  `PayerMail` int(100) NOT NULL,
  `Total` decimal(19,2) NOT NULL,
  `SubTotal` decimal(19,2) NOT NULL,
  `Tax` decimal(19,2) NOT NULL,
  `Payment_state` varchar(50) NOT NULL,
  `CreateTime` varchar(50) NOT NULL,
  `UpdateTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `txn_id`, `PaymentMethod`, `PayerStatus`, `PayerMail`, `Total`, `SubTotal`, `Tax`, `Payment_state`, `CreateTime`, `UpdateTime`) VALUES
(1, 87309154, 'paypal', 'UNVERIFIED', 0, '14.00', '7.00', '7.00', 'completed', '2019-10-11T08:23:30Z', '2019-10-11T08:23:30Z'),
(2, 0, 'paypal', 'UNVERIFIED', 0, '14.00', '7.00', '7.00', 'completed', '2019-10-11T09:48:50Z', '2019-10-11T09:48:50Z'),
(3, 2, 'paypal', 'UNVERIFIED', 0, '14.00', '7.00', '7.00', 'completed', '2019-10-11T09:53:07Z', '2019-10-11T09:53:07Z'),
(4, 13, 'paypal', 'UNVERIFIED', 0, '14.00', '7.00', '7.00', 'completed', '2019-11-05T10:16:58Z', '2019-11-05T10:16:58Z'),
(5, 1, 'paypal', 'UNVERIFIED', 0, '14.00', '7.00', '7.00', 'completed', '2019-11-05T12:15:51Z', '2019-11-05T12:15:51Z');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `currency` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_user`
--

CREATE TABLE `subscribe_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe_user`
--

INSERT INTO `subscribe_user` (`id`, `email`, `added_date`) VALUES
(1, 'vvvvvv@gmail.com', '2019-10-03 15:36:53'),
(2, 'vvvvvv@gmail.com', '2019-10-03 15:39:46'),
(3, 'vvvvvv@gmail.com', '2019-10-03 15:40:11'),
(4, 'vvvvvv@gmail.com', '2019-10-03 15:41:30'),
(5, 'vvvvvv@gmail.com', '2019-10-03 15:41:53'),
(6, 'vvvvvv@gmail.com', '2019-10-03 15:42:00'),
(7, 'vvvvvv@gmail.com', '2019-10-03 15:43:44'),
(8, 'vvvvvv@gmail.com', '2019-10-03 15:44:16'),
(9, 'vinod@gmail.com', '2019-10-03 15:45:27'),
(10, 'vvvvvv@gmail.com', '2019-10-03 15:46:18'),
(11, 'vvvvvv@gmail.com', '2019-10-03 15:46:49'),
(12, 'vvvvvv@gmail.com', '2019-10-03 15:47:04'),
(13, 'shubham@gmail.com', '2019-10-03 15:51:06'),
(14, 'vinod22@gmail.com', '2019-10-04 13:48:23'),
(15, 'vinod.maurya1@gmail.com', '2020-08-12 20:08:00'),
(16, 'sakshi@gmail.com', '2020-08-12 20:09:09'),
(17, '', '2020-08-12 20:11:11'),
(18, 'asdasdasdasd', '2020-08-12 20:28:19'),
(19, 'adAd', '2020-08-12 20:50:18'),
(20, 'adfasfas', '2020-08-12 20:55:32'),
(21, 'asdasd', '2020-08-12 21:01:13'),
(22, 'vvy@gmail.com', '2020-08-12 21:15:50'),
(23, 'asdasdas@gmail.com', '2020-08-18 23:03:28'),
(24, 'VVVVV@gmail.com', '2020-08-25 16:26:39'),
(25, 'vijay@gmail.com', '2020-09-02 18:33:30'),
(26, 'priyanka.ballia@gmail.com', '2020-09-08 18:23:30'),
(27, 'ausafahmad08@gmail.com', '2020-10-07 20:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '180.151.87.210', '', '', '', '2018-05-04 05:19:56'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '180.151.87.210', '', '', '', '2018-05-04 05:40:30'),
(3, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '180.151.87.210', '', '', '', '2018-05-17 05:06:05'),
(4, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '180.151.87.210', '', '', '', '2018-05-17 08:07:27'),
(5, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '180.151.87.210', '', '', '', '2018-05-17 08:53:26'),
(6, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-06 14:50:00'),
(7, 19, '{\"role\":\"2\",\"roleText\":\"AdminManager\",\"name\":\"Sunil\"}', '::1', '', '', '', '2018-07-06 14:53:58'),
(8, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-06 14:55:18'),
(9, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-06 16:09:33'),
(10, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-07 10:10:09'),
(11, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-07 10:38:39'),
(12, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-07 10:45:55'),
(13, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-07 17:59:09'),
(14, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-09 10:00:40'),
(15, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-09 12:40:03'),
(16, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-09 15:39:54'),
(17, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-09 15:47:12'),
(18, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-09 15:49:31'),
(19, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-10 13:41:39'),
(20, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-10 17:45:47'),
(21, 43, '{\"role\":\"2\",\"roleText\":\"AdminManager\",\"name\":\"Jay\"}', '::1', '', '', '', '2018-07-10 17:47:10'),
(22, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-11 10:06:38'),
(23, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-12 10:22:00'),
(24, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-13 11:15:52'),
(25, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-13 16:45:29'),
(26, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-16 11:23:21'),
(27, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-16 15:53:44'),
(28, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-17 10:21:55'),
(29, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-18 10:08:41'),
(30, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-18 17:28:08'),
(31, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-19 13:44:30'),
(32, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-19 15:14:22'),
(33, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-20 10:10:30'),
(34, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-20 15:36:19'),
(35, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-21 17:18:01'),
(36, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-23 11:18:48'),
(37, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-24 17:37:07'),
(38, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 10:09:20'),
(39, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 10:58:28'),
(40, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 12:34:49'),
(41, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 14:53:20'),
(42, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 18:16:59'),
(43, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 18:17:18'),
(44, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 18:18:01'),
(45, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 18:18:15'),
(46, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-25 18:18:40'),
(47, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-26 10:41:23'),
(48, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-26 12:39:22'),
(49, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-27 09:55:31'),
(50, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-27 10:28:43'),
(51, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-27 14:38:17'),
(52, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-30 11:29:12'),
(53, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-30 14:15:58'),
(54, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-31 09:46:16'),
(55, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-07-31 16:36:11'),
(56, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-08 15:20:11'),
(57, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-09 13:30:50'),
(58, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-13 11:19:55'),
(59, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-14 09:58:26'),
(60, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-14 17:52:07'),
(61, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-21 15:16:32'),
(62, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-22 10:51:34'),
(63, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-23 13:37:54'),
(64, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-24 11:21:57'),
(65, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-29 17:23:51'),
(66, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-29 18:22:19'),
(67, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-30 15:28:52'),
(68, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-30 16:03:25'),
(69, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-31 12:11:34'),
(70, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-08-31 12:11:57'),
(71, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-04 14:22:57'),
(72, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-04 15:11:40'),
(73, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-05 10:09:46'),
(74, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-05 10:14:16'),
(75, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-07 12:39:05'),
(76, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-11 10:21:40'),
(77, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-11 10:38:15'),
(78, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-11 11:09:07'),
(79, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-11 17:49:17'),
(80, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-13 11:09:34'),
(81, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-18 10:25:12'),
(82, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-18 16:19:52'),
(83, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 10:10:34'),
(84, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 10:28:14'),
(85, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 12:04:53'),
(86, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 12:12:24'),
(87, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 12:13:02'),
(88, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 14:25:24'),
(89, 44, '{\"role\":\"2\",\"roleText\":\"AdminManager\",\"name\":\"Sunil\"}', '::1', '', '', '', '2018-09-19 14:26:03'),
(90, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 15:12:10'),
(91, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 16:43:30'),
(92, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-19 17:03:23'),
(93, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-20 10:54:59'),
(94, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-24 10:12:49'),
(95, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-24 10:18:17'),
(96, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-24 13:30:05'),
(97, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-24 13:49:30'),
(98, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-25 13:09:27'),
(99, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-26 09:38:36'),
(100, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-26 10:22:37'),
(101, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-26 17:53:51'),
(102, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-27 14:44:32'),
(103, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-28 09:51:03'),
(104, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-28 12:18:47'),
(105, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-28 12:18:48'),
(106, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-28 12:21:56'),
(107, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-28 12:23:45'),
(108, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-29 10:22:20'),
(109, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-29 10:22:20'),
(110, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-29 15:21:16'),
(111, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-09-29 15:26:59'),
(112, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-01 10:19:01'),
(113, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-05 15:36:56'),
(114, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-08 10:53:36'),
(115, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-08 11:24:08'),
(116, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-09 10:10:19'),
(117, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-09 10:24:40'),
(118, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-09 13:51:30'),
(119, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-10 10:48:34'),
(120, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-10 10:50:19'),
(121, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-11 14:48:54'),
(122, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-12 14:30:43'),
(123, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-15 10:05:19'),
(124, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-15 13:06:37'),
(125, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-15 16:32:47'),
(126, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-16 09:48:20'),
(127, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-17 09:49:08'),
(128, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-20 16:17:51'),
(129, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-22 13:36:52'),
(130, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-23 10:47:42'),
(131, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-23 17:17:34'),
(132, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-10-24 09:55:36'),
(133, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-11-01 14:05:52'),
(134, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-05 16:48:58'),
(135, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-05 16:49:02'),
(136, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-07 11:17:46'),
(137, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-13 17:53:30'),
(138, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-19 10:25:52'),
(139, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-20 10:19:34'),
(140, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-27 10:09:13'),
(141, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2018-12-28 11:48:48'),
(142, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-06 11:47:29'),
(143, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 10:25:21'),
(144, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 11:55:08'),
(145, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 11:55:40'),
(146, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:01:22'),
(147, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:01:42'),
(148, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:03:10'),
(149, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:03:55'),
(150, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:05:02'),
(151, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:06:07'),
(152, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 12:06:16'),
(153, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-11 17:32:42'),
(154, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-12 11:00:03'),
(155, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-14 10:25:38'),
(156, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-14 13:33:42'),
(157, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-15 11:44:58'),
(158, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-16 14:08:12'),
(159, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-19 10:34:08'),
(160, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-19 17:44:12'),
(161, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-20 16:13:55'),
(162, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-21 12:16:24'),
(163, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-25 11:14:29'),
(164, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-02-25 13:44:05'),
(165, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-03-02 13:43:41'),
(166, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-04-05 15:23:26'),
(167, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-09-26 11:14:11'),
(168, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-09-26 11:32:43'),
(169, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-09-26 17:13:48'),
(170, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-09-27 10:20:42'),
(171, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-09-30 12:10:30'),
(172, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-09-30 17:07:47'),
(173, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-01 10:31:02'),
(174, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-03 18:44:54'),
(175, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-04 10:13:47'),
(176, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-04 17:54:33'),
(177, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-05 11:10:34'),
(178, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-11 18:15:11'),
(179, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-15 15:11:10'),
(180, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-16 18:04:42'),
(181, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-22 12:04:59'),
(182, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-23 11:27:06'),
(183, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-10-23 15:02:40'),
(184, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2019-11-06 16:16:42'),
(185, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-03-19 13:18:57'),
(186, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-03-19 18:08:50'),
(187, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-03-20 11:34:29'),
(188, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-07-10 10:50:33'),
(189, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-07-13 11:39:49'),
(190, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-07-16 16:56:20'),
(191, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-07-16 17:32:51'),
(192, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-08-18 23:14:44'),
(193, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-08-22 14:36:36'),
(194, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-08-24 11:26:26'),
(195, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-08-24 15:29:47'),
(196, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-08-25 15:15:35'),
(197, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2020-08-25 18:25:56'),
(198, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '47.30.206.142', '', '', '', '2020-08-26 12:51:18'),
(199, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2021-02-24 18:27:23'),
(200, 41, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', '', '', '', '2021-03-01 16:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'AdminManager'),
(3, 'Digital Team');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(41, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'System Administrator', '9890098900', 1, 0, 0, '2015-07-01 18:56:49', 1, '2018-01-05 05:56:34'),
(42, 'vmaurya@aina.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vinod', '9899185034', 2, 0, 1, '2018-07-06 11:35:05', 1, '2019-02-06 07:18:01'),
(44, 'vijay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Sunil', '8971283712', 2, 0, 1, '2018-09-19 10:55:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `id` int(11) NOT NULL,
  `oauth_uid` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `sourcemedia` varchar(500) NOT NULL,
  `token_security` varchar(255) NOT NULL,
  `siteid` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenid` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deviceid` varchar(500) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `user_name` varchar(500) NOT NULL,
  `user_dob` varchar(500) NOT NULL,
  `user_gender` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_mobile` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `country` varchar(300) NOT NULL,
  `city` varchar(300) NOT NULL,
  `link` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `create_at` varchar(255) NOT NULL,
  `update_at` varchar(255) NOT NULL,
  `modified` datetime NOT NULL,
  `status` varchar(500) NOT NULL,
  `notificationsetting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`id`, `oauth_uid`, `oauth_provider`, `sourcemedia`, `token_security`, `siteid`, `tokenid`, `deviceid`, `photo`, `user_name`, `user_dob`, `user_gender`, `user_email`, `user_mobile`, `password`, `country`, `city`, `link`, `latitude`, `longitude`, `created`, `create_at`, `update_at`, `modified`, `status`, `notificationsetting`) VALUES
(1, '112724371401906254355', 'google', 'Desktop', '', 'iwilpro', '', '', 'https://lh3.googleusercontent.com/a-/AOh14Ghm2WWQ3jySB3bF6aSUhHhRcavponW3Hxp2qbqnXaA', 'vinod maurya', '', '', 'vinod.maurya1@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '2019-09-30 20:02:16', '1569837736193', '1569837736193', '2020-03-06 16:38:57', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_register_inquiry`
--

CREATE TABLE `user_register_inquiry` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phoneno` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_equiry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_register_inquiry`
--

INSERT INTO `user_register_inquiry` (`id`, `firstname`, `lastname`, `email`, `phoneno`, `address`, `message`, `added_date`, `date_equiry`) VALUES
(2, 'asdasdasd', 'asdasdasd', 'vinod@gmail.com', '23424232', '32423432', '234234', '2019-09-30 11:14:05', '2019-09-30 03:09:05'),
(3, 'asdasdasd', 'asdasdasd', 'asdasdasd@asdasd.com', '322342432', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'asdasdas', '2019-09-30 11:54:53', '2019-09-30 04:09:53'),
(4, 'asdasdasd', 'asdasdasd', 'asdasdasd@asdasd.com', '322342432', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'asdasdas', '2019-09-30 11:55:19', '2019-09-30 04:09:19'),
(5, 'asdasdasd', 'asdasdasd', 'asdasdasd@asdasd.com', '322342432', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'asdasdas', '2019-09-30 11:55:50', '2019-09-30 04:09:50'),
(6, 'asdasdasd', 'asdasdasd', 'asdasdasd@asdasd.com', '322342432', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'asdasdas', '2019-09-30 11:56:00', '2019-09-30 04:09:00'),
(7, 'vinod', 'maurya', 'vinod@gmail.com', '112342423', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'zxczczxczx', '2019-09-30 12:08:52', '2019-09-30 04:09:52'),
(8, 'vinod', 'maurya', 'vinod@gmail.com', '112342423', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'zxczczxczx', '2019-09-30 12:09:27', '2019-09-30 04:09:27'),
(9, 'vinod', 'maurya', 'vinod@gmail.com', '112342423', 'R-70 ADVOCATE COLONY, SECTOR-12 PRATAP VIHAR', 'zxczczxczx', '2019-09-30 12:09:51', '2019-09-30 04:09:51'),
(10, 'asdasdasd', 'asdasdasd', 'asdasdasd@asdasd.com', '9899185034', '640 Whiteville Rd NW, Shallotte, NC', 'asdas', '2019-10-14 11:52:45', '2019-10-14 05:10:45'),
(11, 'asdasdasd', 'asdasdasd', 'asdasdasd@asdasd.com', '9899185034', '640 Whiteville Rd NW, Shallotte, NC', 'asdasdasdasdasdasdasd', '2019-10-14 12:25:59', '2019-10-14 05:10:59'),
(12, 'vinod', 'maurya', 'vinod.maurya1@gmail.com', '9899185034', 'delhi', 'delhi india testing atmc', '2020-07-10 11:22:44', '2020-07-10 03:07:44'),
(13, 'vinod', 'maurya', 'vinod.maurya1@gmail.com', '1231231231', 'delhiasdasdas', 'asdasdasdasdasdas', '2020-07-13 15:24:56', '2020-07-13 07:07:56'),
(14, 'vinod', 'maurya', 'vinod.maurya1@gmail.com', '1231231231', 'delhiasdasdas', 'asdasdasdasdasdas', '2020-07-13 18:03:55', '2020-07-13 10:07:55'),
(15, 'vinod', 'maurya', 'vinod.maurya1@gmail.com', '9899185034', 'ghaziabad delhi', 'testing  testing testing', '2020-07-13 19:13:47', '2020-07-13 11:07:47'),
(16, 'vinod', 'maurya', 'vinod.maurya1@gmail.com', '9899185034', 'ghaziabad delhi', 'testing  testing testing', '2020-07-13 19:15:00', '2020-07-13 11:07:00'),
(17, 'vinod', 'maurya', 'vinod.maurya1@gmail.com', '9899185034', 'ghaziabad delhi', 'testing  testing testing', '2020-07-13 19:15:05', '2020-07-13 11:07:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_seo`
--
ALTER TABLE `page_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe_user`
--
ALTER TABLE `subscribe_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_register_inquiry`
--
ALTER TABLE `user_register_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page_seo`
--
ALTER TABLE `page_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribe_user`
--
ALTER TABLE `subscribe_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_register_inquiry`
--
ALTER TABLE `user_register_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
