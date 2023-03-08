-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2023 at 04:08 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtmsv5`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'College of Engineering'),
(2, 'College of Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `status` enum('Draft','Forwarded','On Review','Endorsed','Approved','Signed','Released','Received') NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `current_owner_id` int(11) NOT NULL,
  `date_forwarded` datetime DEFAULT NULL,
  `date_endorsed` datetime DEFAULT NULL,
  `date_approved` datetime DEFAULT NULL,
  `date_signed` datetime DEFAULT NULL,
  `date_released` datetime DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `document_type`, `status`, `date_created`, `date_modified`, `current_owner_id`, `date_forwarded`, `date_endorsed`, `date_approved`, `date_signed`, `date_released`, `department_id`, `updated_at`, `created_at`) VALUES
(1, 'Annual and Quarterly Operational Plan', 'Endorsed', '2023-03-06 21:42:23', '2023-03-06 21:42:23', 3, '2023-03-06 21:42:23', NULL, NULL, NULL, NULL, 1, '2023-03-06 13:42:23', '2023-03-06 13:42:23'),
(2, 'Training Designs', 'Forwarded', '2023-03-06 21:43:12', '2023-03-06 21:43:12', 3, '2023-03-06 21:43:12', NULL, NULL, NULL, NULL, 2, '2023-03-06 13:43:12', '2023-03-06 13:43:12'),
(3, 'Annual and Quarterly Operational Plan', 'Approved', '2023-03-06 22:00:12', '2023-03-06 22:00:12', 3, '2023-03-06 22:00:12', NULL, NULL, NULL, NULL, 2, '2023-03-06 14:00:12', '2023-03-06 14:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `document_id`, `filename`, `file_path`, `file_type`, `file_size`, `updated_at`, `created_at`) VALUES
(1, 1, 'Doc1_1678110143.docx', 'public/documents/Doc1_1678110143.docx', 'docx', 64552, '2023-03-06 13:42:23', '2023-03-06 13:42:23'),
(2, 2, 'Doc1_1678110192.docx', 'public/documents/Doc1_1678110192.docx', 'docx', 64552, '2023-03-06 13:43:12', '2023-03-06 13:43:12'),
(3, 3, 'Doc1_1678111212.docx', 'public/documents/Doc1_1678111212.docx', 'docx', 64552, '2023-03-06 14:00:12', '2023-03-06 14:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`) VALUES
(1, 'Campus Records'),
(2, 'Campus Extension'),
(3, 'Chancellor'),
(4, 'Central Admin'),
(5, 'President'),
(6, 'VP Research'),
(7, 'University Extension'),
(8, 'Extension'),
(9, 'College');

-- --------------------------------------------------------

--
-- Table structure for table `office_users`
--

CREATE TABLE `office_users` (
  `office_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `routing`
--

CREATE TABLE `routing` (
  `routing_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `from_office_id` int(11) NOT NULL,
  `to_office_id` int(11) NOT NULL,
  `date_forwarded` datetime NOT NULL,
  `forwarded_by_user_id` int(11) NOT NULL,
  `date_endorsed` datetime DEFAULT NULL,
  `endorsed_by_office_id` int(11) DEFAULT NULL,
  `date_approved` datetime DEFAULT NULL,
  `approved_by_office_id` int(11) DEFAULT NULL,
  `date_signed` datetime DEFAULT NULL,
  `signed_by_office_id` int(11) DEFAULT NULL,
  `date_released` datetime DEFAULT NULL,
  `released_by_office_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routing`
--

INSERT INTO `routing` (`routing_id`, `document_id`, `from_office_id`, `to_office_id`, `date_forwarded`, `forwarded_by_user_id`, `date_endorsed`, `endorsed_by_office_id`, `date_approved`, `approved_by_office_id`, `date_signed`, `signed_by_office_id`, `date_released`, `released_by_office_id`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 9, 4, '2023-03-06 21:42:23', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'received', '2023-03-06 13:42:23', '2023-03-06 13:42:23'),
(2, 2, 9, 2, '2023-03-06 21:43:12', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'received', '2023-03-06 13:43:12', '2023-03-06 13:43:12'),
(3, 3, 9, 3, '2023-03-06 22:00:12', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'received', '2023-03-06 14:00:12', '2023-03-06 14:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `office_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role` enum('college','campus_records','campus_extensions','chancellor','bacnotan','central_admin','president','vp_research','university_extension','extension') NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `office_id`, `department_id`, `role`, `updated_at`, `created_at`) VALUES
(2, 'Peter Lim', 'campus_extension@example.com', '$2a$12$g0U8bazjk1b4at3bRl96R.m5AIfAcA8.0NQHuOOq.dh9hYnw5SWN6', 2, NULL, 'campus_extensions', NULL, NULL),
(3, 'Chester Allan F. Bautista', 'cfbautista@example.com', '$2a$12$rTlvjXyDN4BIcIqcw8rlc./bGXIJ5O43tUhuPBGp5LBQ5J3ewLMle', 9, 2, 'college', '2023-03-06 13:43:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `fk_current_owner_id` (`current_owner_id`),
  ADD KEY `fk_documents_department_id` (`department_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `fk_files_document_id` (`document_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_users`
--
ALTER TABLE `office_users`
  ADD PRIMARY KEY (`office_id`,`user_id`),
  ADD KEY `fk_office_users_user_id` (`user_id`);

--
-- Indexes for table `routing`
--
ALTER TABLE `routing`
  ADD PRIMARY KEY (`routing_id`),
  ADD KEY `fk_routing_from_office_id` (`from_office_id`),
  ADD KEY `fk_routing_to_office_id` (`to_office_id`),
  ADD KEY `fk_routing_forwarded_by_user_id` (`forwarded_by_user_id`),
  ADD KEY `fk_routing_endorsed_by_office_id` (`endorsed_by_office_id`),
  ADD KEY `fk_routing_approved_by_office_id` (`approved_by_office_id`),
  ADD KEY `fk_routing_signed_by_office_id` (`signed_by_office_id`),
  ADD KEY `fk_routing_released_by_office_id` (`released_by_office_id`),
  ADD KEY `fk_routing_document_id` (`document_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_id` (`office_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `routing`
--
ALTER TABLE `routing`
  MODIFY `routing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_current_owner_id` FOREIGN KEY (`current_owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documents_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_document_id` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`) ON DELETE CASCADE;

--
-- Constraints for table `office_users`
--
ALTER TABLE `office_users`
  ADD CONSTRAINT `fk_office_users_office_id` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_office_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `routing`
--
ALTER TABLE `routing`
  ADD CONSTRAINT `fk_routing_approved_by_office_id` FOREIGN KEY (`approved_by_office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_routing_document_id` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`),
  ADD CONSTRAINT `fk_routing_endorsed_by_office_id` FOREIGN KEY (`endorsed_by_office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_routing_forwarded_by_user_id` FOREIGN KEY (`forwarded_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_routing_from_office_id` FOREIGN KEY (`from_office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_routing_released_by_office_id` FOREIGN KEY (`released_by_office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_routing_signed_by_office_id` FOREIGN KEY (`signed_by_office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_routing_to_office_id` FOREIGN KEY (`to_office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
