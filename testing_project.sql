-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 07:32 AM
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
(1, 'testing', 'testing', NULL, NULL, NULL, NULL, 'Pending', 23344, '2025-01-25'),
(2, 'sassaas', 'sassas', NULL, NULL, NULL, NULL, 'Expired', 1233, '2025-01-01');

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
(7, 'okasaas', 'okay bro', 'ok sasas');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(100) NOT NULL,
  `ticket_from` int(100) NOT NULL,
  `ticket_desc` varchar(200) NOT NULL,
  `ticket_status` varchar(100) NOT NULL DEFAULT 'Unresolved',
  `ticket_solution` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_from`, `ticket_desc`, `ticket_status`, `ticket_solution`) VALUES
(1, 5, 'sasaassaas', 'Unresolved', ''),
(2, 6, 'sasaasasas', 'Unresolved', '');

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
(4, '2025-01-15', 3, 9, 3232, 'Pending'),
(5, '2025-01-22', 10, 3, 323, 'Pending');

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
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `account_type`, `question`, `answer`) VALUES
(3, 'rafin', 'rafin@aiub.edu', 'rafin', 'admin', 'favorite number?', '7'),
(5, 'abrar', 'abrar@aiub.edu', 'abrar', 'webmaster', 'favorite animal?', 'tiger'),
(6, 'rono', 'rono@aiub.edu', 'rono', 'advertiser', 'favorite superhero?', 'batman'),
(9, 'test', '1@aiub.edu', 'test', 'webmaster', '1', '1'),
(10, 'testing', 'test@aiub.edu', 'testing', 'webmaster', '12345', '12345'),
(11, 'hello', 'hello@aiub.edu', 'hello', 'webmaster', '10000', '10000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`),
  ADD KEY `fk_campaigns_adv` (`advertiser_id`),
  ADD KEY `fk_campaigns_web_id_users` (`webmaster_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_tickets_user` (`ticket_from`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `tran_payout_unq` (`transaction_id`),
  ADD KEY `fk_transactions_from_user` (`transaction_from`),
  ADD KEY `fk_transactions_to_user` (`transaction_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `fk_campaigns_adv` FOREIGN KEY (`advertiser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_campaigns_web_id_users` FOREIGN KEY (`webmaster_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_user` FOREIGN KEY (`ticket_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_from_user` FOREIGN KEY (`transaction_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_to_user` FOREIGN KEY (`transaction_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
