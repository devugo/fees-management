-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 02:33 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fees_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `profile_pix` varchar(225) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `blocked_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `phone`, `profile_pix`, `logo`, `city`, `state`, `address`, `created_at`, `updated_at`, `blocked_on`) VALUES
(1, 'Devugo Designs', 'ofemco@gmail.com', 'megafemco', '$2y$10$x/B7UQTlpMgKD.ah0YfRyOrr7IJgUwTVU9.qKqU4WoanE3VQKfXKa', '8133491134', '', 'uploads/images/logos/devugo.jpg', 'Ikotun', 'Lagos', '19 Ajayi Lane', '2019-03-17 00:00:00', '2019-04-08 21:50:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins_sessions`
--

CREATE TABLE `admins_sessions` (
  `id` int(50) NOT NULL,
  `admin_id` int(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_sessions`
--

INSERT INTO `admins_sessions` (`id`, `admin_id`, `hash`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$mwkgMYgfDdoCU6/Rf4jKy.b3mT7u4s0X5qWTfV0yu6dQ7KZ28Ieum', '2019-04-07 13:43:36', '2019-04-07 13:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `admin_incomes`
--

CREATE TABLE `admin_incomes` (
  `id` int(50) NOT NULL,
  `income` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_incomes`
--

INSERT INTO `admin_incomes` (`id`, `income`, `created_at`, `updated_at`) VALUES
(1, 200, '2019-04-06 21:47:04', '2019-04-07 06:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(50) NOT NULL,
  `public_key` varchar(255) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `api_link` varchar(255) NOT NULL,
  `api_username` varchar(255) NOT NULL,
  `api_password` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `public_key`, `secret_key`, `api_link`, `api_username`, `api_password`, `sender`, `account_name`, `account_no`, `bank`, `created_at`, `updated_at`) VALUES
(1, 'pk_test_1bae26dbe6185780ae49ff975228b3bd060b8a09', 'sk_test_59517609926d5a73d3824dde742445407f06ae58', 'http://www.estoresms.com/smsapi.php', 'ncs', '65f130', 'Admin', 'uospamlam', '1111111111', 'ndkskl bank', '2019-03-24 00:00:00', '2019-03-25 03:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `arms`
--

CREATE TABLE `arms` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arms`
--

INSERT INTO `arms` (`id`, `school_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '2019-03-30 04:13:35', '2019-03-30 04:13:35'),
(2, 1, 'B', '2019-03-30 04:13:38', '2019-03-30 04:13:38'),
(3, 1, 'C', '2019-03-30 04:13:42', '2019-03-30 04:13:42'),
(4, 1, 'D', '2019-04-03 20:43:12', '2019-04-03 20:43:12'),
(5, 1, 'E', '2019-04-04 21:56:55', '2019-04-04 21:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `bonus_type` enum('percentage','amount') NOT NULL,
  `no_of_wards` int(50) NOT NULL,
  `bonus` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonuses`
--

INSERT INTO `bonuses` (`id`, `school_id`, `bonus_type`, `no_of_wards`, `bonus`, `created_at`, `updated_at`) VALUES
(1, 1, 'percentage', 2, 5, '2019-03-30 04:21:09', '2019-03-30 04:21:09'),
(2, 1, 'amount', 1, 300, '2019-03-30 04:21:26', '2019-03-30 04:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `broadcasts`
--

CREATE TABLE `broadcasts` (
  `id` int(20) NOT NULL,
  `school_id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `guardian_id` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `viewed_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `broadcasts`
--

INSERT INTO `broadcasts` (`id`, `school_id`, `title`, `description`, `guardian_id`, `created_at`, `updated_at`, `viewed_on`) VALUES
(2, 1, 'School Fees', 'This is a reminder of school fees yet to pay', 1, '2019-04-07 21:43:54', '2019-04-07 21:43:54', NULL),
(3, 1, 'testing', 'thia a testing noti', 1, '2019-04-07 21:45:20', '2019-04-11 19:13:10', '2019-04-11 19:13:10'),
(4, 1, 'testing', 'thia a testing noti', 1, '2019-04-07 21:45:41', '2019-04-11 19:21:47', '2019-04-11 19:21:47'),
(5, 1, 'Fee Reminder', 'This is just a reminder, alright. Nothing personnal', 1, '2019-04-07 21:46:38', '2019-04-07 21:46:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `level`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'JSS 1', '1', 1, '2019-03-30 04:12:36', '2019-03-30 04:12:36'),
(2, 'JSS 2', '2', 1, '2019-03-30 04:12:46', '2019-03-30 04:12:46'),
(3, 'JSS 3', '3', 1, '2019-03-30 04:12:53', '2019-03-30 04:12:53'),
(4, 'SS 1', '4', 1, '2019-03-30 04:13:05', '2019-03-30 04:13:05'),
(5, 'SS 2', '5', 1, '2019-03-30 04:13:14', '2019-04-04 05:05:39'),
(6, 'SS 3', '6', 1, '2019-04-04 21:55:56', '2019-04-04 21:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `term` enum('First Term','Second Term','Third Term') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` int(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `payment_method` enum('cash','bank deposit','transfer') NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `school_id`, `session`, `term`, `title`, `description`, `amount`, `receiver`, `payment_method`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, '2018/2019', 'First Term', 'Carpentry Works', 'This is full details of the carpentry works conducted', 10000, 'Mike Buchi', 'bank deposit', '8133491134', '2019-04-05 01:56:56', '2019-04-05 01:56:56'),
(2, 1, '2018/2019', 'Second Term', 'new fees', 'this is a new fee', 7200, 'ugochukwu', 'cash', '8133458872', '2019-04-05 02:01:54', '2019-04-05 02:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `classe_id` int(50) NOT NULL,
  `arm_id` int(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `term_id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `prepared` datetime DEFAULT NULL,
  `noti_sent` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `school_id`, `classe_id`, `arm_id`, `session`, `term_id`, `title`, `prepared`, `noti_sent`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 2, '2018/2019', 1, 'school Fees', '2019-04-02 00:00:00', '2019-04-10 16:22:12', '2019-03-30 04:19:33', '2019-04-10 16:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `fee_user`
--

CREATE TABLE `fee_user` (
  `id` bigint(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `guardian_id` int(50) NOT NULL,
  `user_id` bigint(50) NOT NULL,
  `fee_id` bigint(50) NOT NULL,
  `bonus` int(50) NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `waved_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_user`
--

INSERT INTO `fee_user` (`id`, `school_id`, `guardian_id`, `user_id`, `fee_id`, `bonus`, `payment_proof`, `confirmed_at`, `waved_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 0, NULL, '2019-04-10 00:19:51', '2019-04-10 00:19:51', '2019-04-10 00:19:51', '2019-04-10 00:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pix` varchar(255) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `blocked_on` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`id`, `school_id`, `lastname`, `firstname`, `email`, `phone`, `address`, `username`, `password`, `profile_pix`, `sex`, `created_at`, `updated_at`, `blocked_on`, `deleted_at`) VALUES
(1, 1, 'Eze', 'Moses', 'ezemoses@gmail.com', '8079604583', 'jklk  knlm;', '', '$2y$10$YYYM6XGYLyrK3xb72PD/YuZ4bT1IFs/.49Bcxbl4lqKZkAFFNFOC6', 'uploads/images/profile_pictures/imgonline-com-ua-resize-VrxJduo5wd7_1.jpg', 'Male', '2019-03-30 04:08:00', '2019-04-08 15:51:07', NULL, NULL),
(7, 1, 'Eze', 'Ugo', 'ugoezenwankwo@gmail.com', '8133491134', '', '', '$2y$10$0U23WcWeFLUCvGweV2ngKO1JIENthQlJPI/svfvIq4RVaB0r92Rp.', 'profile.png', 'Male', '2019-04-07 19:25:46', '2019-04-07 19:25:46', NULL, NULL),
(8, 1, 'Opara', 'Michelle', 'mich@gmail.com', '8133491134', '', '', '$2y$10$I.evVbB8zbkgpAc8mb3yge96gFafOGgeGLkD/lZWORKO2tMid0IMi', 'profile.png', 'Female', '2019-04-09 16:00:39', '2019-04-09 16:00:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guardians_sessions`
--

CREATE TABLE `guardians_sessions` (
  `id` int(50) NOT NULL,
  `guardian_id` int(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardians_sessions`
--

INSERT INTO `guardians_sessions` (`id`, `guardian_id`, `hash`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$w3Oa1vFKUW1CqcFZ8f1KHu7pZyADx3XbpbhrG/uVNjaoyjXQ5zdTO', '2019-04-07 14:16:16', '2019-04-07 14:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `school_id`, `amount`, `created_at`, `updated_at`) VALUES
(2, 1, 22000, '2019-04-03 23:06:42', '2019-04-07 10:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `school_id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `viewed_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `school_id`, `title`, `description`, `created_at`, `updated_at`, `viewed_on`) VALUES
(1, 1, 'new', 'this is a new notification', '2019-04-02 22:42:30', '2019-04-07 12:15:53', '2019-04-07 12:15:53'),
(2, 1, 'new project', 'This is a new project which about to kicj=k ofd, so embrace yourself', '2019-04-07 06:08:14', '2019-04-11 08:21:26', '2019-04-11 08:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'info@devugo.com', '$2y$10$5jDYXvOvnIN.3gPlAUD89ubLHAWLOxN0ZlUTcblShi5mBsi84QBIe', '2019-04-09 22:42:08', '2019-04-09 23:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `prepared_fees`
--

CREATE TABLE `prepared_fees` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `fee_id` bigint(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prepared_fees`
--

INSERT INTO `prepared_fees` (`id`, `school_id`, `fee_id`, `title`, `amount`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 'Sport', 500, '2019-03-30 04:20:14', '2019-03-30 04:20:14'),
(4, 1, 2, 'Tuition', 4200, '2019-03-30 04:20:23', '2019-03-30 04:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(50) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `logo` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `blocked_on` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `email`, `password`, `address`, `city`, `state`, `phone`, `logo`, `created_at`, `updated_at`, `activated_at`, `blocked_on`, `deleted_at`) VALUES
(1, 'Devugo Academy', 'info@devugo.com', '$2y$10$b5DZLfvxkJHSj.uuEiBnius3tIpqxDoU5mtDgCZBCzQ6Yxx2RQ1Li', 'Ojota Lane', 'Apaa', 'Lagos', '8133491134', 'uploads/images/logos/dca_4.jpg', '2019-03-29 20:46:04', '2019-04-09 23:34:43', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schools_session`
--

CREATE TABLE `schools_session` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools_session`
--

INSERT INTO `schools_session` (`id`, `school_id`, `hash`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$A8hl6/s9BjIYM/pbDgb6EeOWUQmq/c7ZfyP.pbVZsfV.ap6lHQePK', '2019-04-07 19:17:23', '2019-04-07 19:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `school_settings`
--

CREATE TABLE `school_settings` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_settings`
--

INSERT INTO `school_settings` (`id`, `school_id`, `account_no`, `account_name`, `bank`, `created_at`, `updated_at`) VALUES
(1, 1, '9290348535', 'ugo eze', 'eco', '2019-04-03 22:53:25', '2019-04-05 03:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(50) NOT NULL,
  `subscription_type_id` bigint(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `paystack_amount` int(11) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `paystack_proof` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subscription_type_id`, `school_id`, `paystack_amount`, `payment_proof`, `paystack_proof`, `created_at`, `updated_at`, `confirmed_at`) VALUES
(1, 2, 1, 50000, 'uploads/images/payment_proofs/school-panel_1.jpg', NULL, '2019-04-07 12:26:37', '2019-04-07 12:27:08', NULL),
(2, 1, 1, 20000, 'uploads/images/payment_proofs/cbt_logo.jpg', NULL, '2019-04-07 12:27:19', '2019-04-07 12:30:13', NULL),
(3, 2, 1, 50000, NULL, '2019-04-09 15:50:15', '2019-04-07 23:35:56', '2019-04-09 15:50:15', NULL),
(4, 2, 1, 50000, NULL, '2019-04-09 15:55:35', '2019-04-09 15:55:12', '2019-04-09 15:55:35', NULL),
(5, 2, 1, 50000, NULL, '2019-04-09 15:56:45', '2019-04-09 15:56:25', '2019-04-09 15:56:45', NULL),
(6, 2, 1, 50000, NULL, '2019-04-10 02:03:08', '2019-04-09 15:57:23', '2019-04-10 02:03:08', NULL),
(7, 1, 1, 20000, NULL, '2019-04-09 15:58:32', '2019-04-09 15:58:09', '2019-04-09 15:58:32', NULL),
(8, 2, 1, 50000, NULL, '2019-04-09 15:59:54', '2019-04-09 15:59:31', '2019-04-09 15:59:54', NULL),
(9, 2, 1, 50000, NULL, '2019-04-09 16:22:49', '2019-04-09 16:05:44', '2019-04-09 16:22:49', NULL),
(10, 1, 1, 20000, NULL, '2019-04-09 16:24:05', '2019-04-09 16:05:57', '2019-04-09 16:24:05', NULL),
(11, 2, 1, 50000, NULL, '2019-04-09 16:31:10', '2019-04-09 16:06:24', '2019-04-09 16:31:10', NULL),
(12, 2, 1, 50000, NULL, NULL, '2019-04-09 16:06:58', '2019-04-09 16:06:58', NULL),
(13, 2, 1, 50000, NULL, NULL, '2019-04-09 16:07:21', '2019-04-09 16:07:21', NULL),
(14, 1, 1, 20000, NULL, '2019-04-11 18:50:48', '2019-04-09 16:07:47', '2019-04-11 18:50:48', '2019-04-11 18:50:48'),
(15, 1, 1, 20000, NULL, '2019-04-10 14:16:41', '2019-04-09 16:08:40', '2019-04-10 14:16:41', '2019-04-10 14:16:41'),
(16, 2, 1, 50000, NULL, '2019-04-11 18:56:26', '2019-04-10 14:12:39', '2019-04-11 18:56:26', '2019-04-11 18:56:26'),
(17, 2, 1, 50000, NULL, NULL, '2019-04-11 18:56:06', '2019-04-11 18:56:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions_balances`
--

CREATE TABLE `subscriptions_balances` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `sms` int(255) NOT NULL,
  `email` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions_balances`
--

INSERT INTO `subscriptions_balances` (`id`, `school_id`, `sms`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 2198, 2198, '2019-04-02 17:31:49', '2019-04-11 18:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE `subscription_types` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `sms` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `blocked_on` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`id`, `name`, `amount`, `sms`, `email`, `created_at`, `updated_at`, `blocked_on`, `deleted_at`) VALUES
(1, 'Basic', '200', '100', '100', '2019-04-02 20:47:05', '2019-04-02 20:47:05', NULL, NULL),
(2, 'Intermediate', '500', '150', '150', '2019-04-07 06:04:47', '2019-04-07 06:05:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `term` enum('First Term','Second Term','Third Term') NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `school_id`, `session`, `term`, `start`, `end`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2018/2019', 'Second Term', '2019-01-07', '2019-04-12', '2019-03-30 04:11:34', '2019-03-30 04:11:34', NULL),
(2, 1, '2018/2019', 'Third Term', '2019-05-06', '2019-10-16', '2019-03-30 04:12:12', '2019-04-04 22:15:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `school_id`, `title`, `description`, `created_at`, `updated_at`, `confirmed_at`) VALUES
(1, 1, 'Dashboard', 'There is a huge problem with my dashboard, i can\'t seem to access it. Help here!', '2019-04-05 02:28:43', '2019-04-05 02:28:43', NULL),
(2, 1, 'new noti', 'This is the new notificatiobn', '2019-04-09 16:15:46', '2019-04-09 16:15:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_responses`
--

CREATE TABLE `tickets_responses` (
  `id` int(50) NOT NULL,
  `ticket_id` int(50) NOT NULL,
  `response` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(50) NOT NULL,
  `type_of_user_id` varchar(50) NOT NULL,
  `school_id` int(50) NOT NULL,
  `guardian_id` int(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `profile_pix` varchar(255) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `arm_id` varchar(50) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(225) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `age` varchar(255) NOT NULL,
  `year_of_graduation` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `blocked_on` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type_of_user_id`, `school_id`, `guardian_id`, `lastname`, `firstname`, `middlename`, `profile_pix`, `reg_no`, `arm_id`, `sex`, `email`, `address`, `city`, `state`, `age`, `year_of_graduation`, `created_at`, `updated_at`, `blocked_on`, `deleted_at`) VALUES
(1, '', 1, 1, 'Eze', 'Chigozie', 'Kingsley', 'uploads/images/profile_pictures/IMG-20180517-WA0000_6.jpg', '43940302nd', '2', 'Male', '', '', '', '', '2011-03-18', '2022', '2019-03-30 04:15:06', '2019-03-30 04:15:06', NULL, NULL),
(5, '', 1, 1, 'Opara', 'Solomon', 'Charlse', 'profile.png', '43950290jf', '5', 'Male', '', '', '', '', '2019-04-18', '2023', '2019-04-07 19:31:20', '2019-04-07 19:31:20', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins_sessions`
--
ALTER TABLE `admins_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `admin_incomes`
--
ALTER TABLE `admin_incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arms`
--
ALTER TABLE `arms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guardian_id` (`guardian_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_ibfk_1` (`school_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_ibfk_1` (`classe_id`) USING BTREE,
  ADD KEY `school_id` (`school_id`),
  ADD KEY `arm_id` (`arm_id`),
  ADD KEY `term_id` (`term_id`);

--
-- Indexes for table `fee_user`
--
ALTER TABLE `fee_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_user_ibfk_1` (`fee_id`),
  ADD KEY `fee_user_ibfk_2` (`guardian_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `guardians_sessions`
--
ALTER TABLE `guardians_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guardian_id` (`guardian_id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prepared_fees`
--
ALTER TABLE `prepared_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `fee_id` (`fee_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools_session`
--
ALTER TABLE `schools_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `school_settings`
--
ALTER TABLE `school_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `subscription_type_id` (`subscription_type_id`);

--
-- Indexes for table `subscriptions_balances`
--
ALTER TABLE `subscriptions_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `subscription_types`
--
ALTER TABLE `subscription_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `tickets_responses`
--
ALTER TABLE `tickets_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guardian_id` (`guardian_id`),
  ADD KEY `school_id` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins_sessions`
--
ALTER TABLE `admins_sessions`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_incomes`
--
ALTER TABLE `admin_incomes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arms`
--
ALTER TABLE `arms`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_user`
--
ALTER TABLE `fee_user`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guardians_sessions`
--
ALTER TABLE `guardians_sessions`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prepared_fees`
--
ALTER TABLE `prepared_fees`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schools_session`
--
ALTER TABLE `schools_session`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_settings`
--
ALTER TABLE `school_settings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subscriptions_balances`
--
ALTER TABLE `subscriptions_balances`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_types`
--
ALTER TABLE `subscription_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets_responses`
--
ALTER TABLE `tickets_responses`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins_sessions`
--
ALTER TABLE `admins_sessions`
  ADD CONSTRAINT `admins_sessions_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `arms`
--
ALTER TABLE `arms`
  ADD CONSTRAINT `arms_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD CONSTRAINT `bonuses_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD CONSTRAINT `broadcasts_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `broadcasts_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fees_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fees_ibfk_3` FOREIGN KEY (`arm_id`) REFERENCES `arms` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fees_ibfk_4` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `fee_user`
--
ALTER TABLE `fee_user`
  ADD CONSTRAINT `fee_user_ibfk_1` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fee_user_ibfk_2` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fee_user_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fee_user_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `guardians`
--
ALTER TABLE `guardians`
  ADD CONSTRAINT `guardians_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `guardians_sessions`
--
ALTER TABLE `guardians_sessions`
  ADD CONSTRAINT `guardians_sessions_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `prepared_fees`
--
ALTER TABLE `prepared_fees`
  ADD CONSTRAINT `prepared_fees_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `prepared_fees_ibfk_2` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `schools_session`
--
ALTER TABLE `schools_session`
  ADD CONSTRAINT `schools_session_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `school_settings`
--
ALTER TABLE `school_settings`
  ADD CONSTRAINT `school_settings_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`subscription_type_id`) REFERENCES `subscription_types` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `subscriptions_balances`
--
ALTER TABLE `subscriptions_balances`
  ADD CONSTRAINT `subscriptions_balances_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
  ADD CONSTRAINT `terms_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tickets_responses`
--
ALTER TABLE `tickets_responses`
  ADD CONSTRAINT `tickets_responses_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
