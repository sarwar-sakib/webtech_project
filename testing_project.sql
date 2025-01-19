-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `newspaper` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `ad_type` varchar(255) NOT NULL,
  `ad_description` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `newspaper`, `price`, `publish_date`, `ad_type`, `ad_description`, `image_path`, `created_at`) VALUES
(4, 6, 'Ittefak', 750, '2025-01-19', 'Classified Text', 'dgfhdh', '', '2025-01-19 06:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(100) NOT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `campaign_domain` varchar(100) NOT NULL,
  `website_url` varchar(100) DEFAULT NULL,
  `webmaster_id` int(100) DEFAULT NULL,
  `advertising_brand` varchar(100) DEFAULT NULL,
  `advertiser_id` int(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `budget` double NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `campaign_name`, `campaign_domain`, `website_url`, `webmaster_id`, `advertising_brand`, `advertiser_id`, `status`, `budget`, `expire_date`) VALUES
(3, 'Test', 'testing', 'http://www.aiub.edu/home', 5, NULL, NULL, 'Expired', 300, '2025-01-15'),
(4, 'again', 'againing', NULL, NULL, 'Myself', 6, 'Expired', 221, '2025-01-09'),
(5, 'okay', 'showbiz', NULL, NULL, 'Surf Excel', 6, 'Expired', 521, '2025-01-16'),
(6, 'asa', 'sas', 'http://www.aiub.edu', 5, 'Bkash', 6, 'Expired', 0, '2025-01-14'),
(7, 'df', 'dsd', NULL, NULL, NULL, NULL, 'Expired', 0, '2024-12-11'),
(8, 'sa', 'sa', NULL, NULL, NULL, NULL, 'Expired', 4454, '2024-12-04'),
(9, 'aa', 'aa', NULL, NULL, NULL, NULL, 'Expired', 2, '2025-01-02'),
(10, 'sa a', 'sa', 'http://www.aiub.edu', NULL, NULL, NULL, 'Expired', 1, '2025-01-02'),
(13, 'b', 'b', NULL, NULL, NULL, NULL, 'Expired', 2, '2025-01-01'),
(15, 'f', 'f', NULL, NULL, NULL, NULL, 'Expired', 25, '2024-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(100) NOT NULL,
  `faq_topic` varchar(50) NOT NULL,
  `faq_question` varchar(100) NOT NULL,
  `faq_answer` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `faq_topic`, `faq_question`, `faq_answer`) VALUES
(1, 'Campaigns', 'How can I join a Campaign?', 'Signup and login as Advertiser.Go to'),
(2, 'Advertisement', 'How to include Advertisement to a Campaign?', 'Login as \'Advertiser\'\r\nGo to \"View Campaigns\" -> Choose an active campaign.\r\nJoin the campaign.\r\nInsert Product/Service name.\r\nSelect Add.'),
(7, 'ok', 'okay bro', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `feedback`, `created_at`) VALUES
(1, 'sa', 'this is good', '2025-01-03 18:15:07'),
(2, 'rs', 'good', '2025-01-03 22:07:16'),
(3, 'sa', 'very \r\ngood', '2025-01-04 15:30:35'),
(4, 'rs', 'dff', '2025-01-17 17:46:35'),
(5, 'rs', 'dd', '2025-01-17 17:51:17'),
(6, 'rs', 'oke', '2025-01-17 17:52:06'),
(7, 'rs', 'ddd', '2025-01-17 17:53:40'),
(8, 'rs', 'not good this', '2025-01-17 17:56:23'),
(9, 'rs', 'this is not good', '2025-01-17 17:57:59'),
(10, 'rs', 'not goood this is', '2025-01-17 17:58:54'),
(11, 'rs', 'ok', '2025-01-17 18:03:22'),
(12, 'rs', 'ddddddddddddddddddddd', '2025-01-17 18:03:41'),
(13, 'rs', 'ddddddddddddddddddddd', '2025-01-17 18:04:19'),
(14, 'rs', 'sssssssssss', '2025-01-17 18:04:41'),
(15, 'rs', 'sssssssssss', '2025-01-17 18:04:42'),
(16, 'rs', 'sssssssssss', '2025-01-17 18:04:43'),
(17, 'rs', 'sssssssssss', '2025-01-17 18:04:43'),
(18, 'rs', 'eirieieeeeee', '2025-01-17 18:05:18'),
(19, 'rs', 'eirieieeeeee', '2025-01-17 18:05:19'),
(20, 'rs', 'eirieieeeeee', '2025-01-17 18:05:26'),
(21, 'rs', 'ffffffffffffff', '2025-01-17 18:06:09'),
(22, 'rs', 'ffffffffffffff', '2025-01-17 18:06:10'),
(23, 'rs', 'ffffffffffffff', '2025-01-17 18:06:10'),
(24, 'rs', 'ffffffffffffff', '2025-01-17 18:06:10'),
(25, 'rs', 'skkkkkkkkkk', '2025-01-17 18:09:01'),
(26, 'rs', 'skkkkkkkkkk', '2025-01-17 18:09:02'),
(27, 'rs', 'rrrrrrrrrrrrr', '2025-01-17 18:10:15'),
(28, 'rs', 'dddddddddd', '2025-01-17 18:12:09'),
(29, 'rs', 'CCCCCCCCCCCC', '2025-01-17 18:18:02'),
(30, 'rs', 'ddddddcddd', '2025-01-17 18:18:37'),
(31, 'rs', 'aaaaaaaaaaa', '2025-01-18 08:39:40'),
(32, 'rs', 'this is so so good', '2025-01-18 19:46:30'),
(33, 'rono', 'sdv sdfsd sdfsdd', '2025-01-18 20:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(48, 6, 6, 'hiui', '2025-01-19 07:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE `newspapers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`id`, `name`, `price`) VALUES
(2, 'Ittefak', 750),
(3, 'News Today', 950),
(22, 'Jay Jay Din', 500);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','complete') DEFAULT 'pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submitted_ads`
--

CREATE TABLE `submitted_ads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `newspaper` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `ad_type` varchar(50) NOT NULL,
  `ad_description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submitted_ads`
--

INSERT INTO `submitted_ads` (`id`, `user_id`, `newspaper`, `price`, `publish_date`, `created_at`, `ad_type`, `ad_description`, `image_path`, `status`) VALUES
(17, 6, 'Ittefak', 750, '2025-01-22', '2025-01-19 00:51:14', 'Classified Text', 'dfg', '', 'Rejected'),
(18, 6, 'Ittefak', 750, '2025-01-21', '2025-01-19 01:13:59', 'Classified Text', '3434', '', 'Approved'),
(19, 6, 'Prothom Alo', 1450, '2025-01-20', '2025-01-19 00:44:16', 'Classified', 'cc', '', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `time_format` enum('12h','24h') DEFAULT '24h'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `username`, `time_format`) VALUES
(7, 'rono', '24h'),
(8, 'type', '24h');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `content`, `updated_at`) VALUES
(1, 'Welcome to our platform. By using our services, you agree to abide by the following terms and conditions:\r\n1. Users must provide accurate and up-to-date information.\r\n2. Unauthorized use of the platform is strictly prohibited.\r\n3. The platform reserves the right to modify these terms at any time.\r\n4. For any disputes, our decision will be final and binding.\r\n5.New terms added.\r\n6. Terms new check\r\n7. 7th terms\r\n8. Test', '2025-01-18 13:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(100) NOT NULL,
  `ticket_from` varchar(100) NOT NULL,
  `ticket_desc` varchar(200) NOT NULL,
  `ticket_status` varchar(100) NOT NULL DEFAULT 'Unresolved',
  `ticket_solution` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_from`, `ticket_desc`, `ticket_status`, `ticket_solution`) VALUES
(2, '5', 'okay', 'Unresolved', ''),
(3, '5', 'test', 'Responded', 'okay bro'),
(4, '5', 'okay bro?', 'Unresolved', ''),
(5, '6', 'hello', 'Responded', 'muri');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(100) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_from` int(100) NOT NULL,
  `transaction_to` int(100) NOT NULL,
  `transaction_amount` float NOT NULL DEFAULT 0,
  `transaction_status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_date`, `transaction_from`, `transaction_to`, `transaction_amount`, `transaction_status`) VALUES
(1, '2024-12-26', 6, 5, 200, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `question` varchar(200) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `balance` int(11) DEFAULT 0,
  `accepted_terms` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `account_type`, `question`, `answer`, `balance`, `accepted_terms`) VALUES
(3, 'rafin', 'rafin@aiub.edu', 'rafin', 'admin', 'favorite number?', '7', 2200, 1),
(5, 'abrar', 'abrar@aiub.edu', 'abrar', 'webmaster', 'favorite animal?', 'tiger', 0, 0),
(6, 'rono', 'rono@aiub.edu', 'rono', 'advertiser', 'favorite superhero?', 'batman', 800, 1),
(9, 'test', '1@aiub.edu', 'test', 'webmaster', '1', '1', 0, 0),
(10, 'user', 'hhh@h.com', '1234', 'advertiser', 'What is your favorite color?', 'Blue', 0, 0),
(11, 'gg', 'hhh@h.com', '1234', 'advertiser', 'What is your favorite color?', 'Blue', 0, 0),
(12, 'type', 'type@gmail.com', '1234', 'advertiser', 'what?', 'batman', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mails_ibfk_1` (`sender_id`),
  ADD KEY `mails_ibfk_2` (`receiver_id`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `submitted_ads`
--
ALTER TABLE `submitted_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `tran_payout_unq` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submitted_ads`
--
ALTER TABLE `submitted_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mails`
--
ALTER TABLE `mails`
  ADD CONSTRAINT `mails_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mails_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `submitted_ads`
--
ALTER TABLE `submitted_ads`
  ADD CONSTRAINT `submitted_ads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
