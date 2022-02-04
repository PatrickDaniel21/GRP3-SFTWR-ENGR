-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 02:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `orgs`
--

CREATE TABLE `orgs` (
  `org_id` int(255) NOT NULL,
  `orgadmin_id` int(100) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `org_president` varchar(255) NOT NULL,
  `org_contact` varchar(255) NOT NULL,
  `org_about` text NOT NULL,
  `org_representative` varchar(255) NOT NULL,
  `org_reptupid` varchar(255) NOT NULL,
  `org_status` int(1) NOT NULL,
  `org_verification_key` varchar(255) NOT NULL,
  `org_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`org_id`, `orgadmin_id`, `org_name`, `org_president`, `org_contact`, `org_about`, `org_representative`, `org_reptupid`, `org_status`, `org_verification_key`, `org_image`) VALUES
(6, 83, 'Dance Triumph', 'Jersey M. Sodela', 'caballero.aliana@gmail.com', 'This organization is a sample organization for the project', 'Aliana M. Caballero', 'TUPM-18-1234', 1, 'a39262f8e7d8420d459a73ec8878d96a', ''),
(7, 84, 'Youth Discipleship', 'who called I AM', 'jerseymadrenian19@gmail.com', 'This other organization is a sample org', 'Jersey M. Sodela', 'TUPM-14-1234', 1, '220921f588100016a6665cb1402582b0', '');

-- --------------------------------------------------------

--
-- Table structure for table `orgs_posts`
--

CREATE TABLE `orgs_posts` (
  `orgpost_id` int(255) NOT NULL,
  `orgpadmin_id` int(255) NOT NULL,
  `org_post` text NOT NULL,
  `org_published_date` datetime NOT NULL,
  `org_postimage` varchar(255) NOT NULL,
  `org_status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orgs_posts`
--

INSERT INTO `orgs_posts` (`orgpost_id`, `orgpadmin_id`, `org_post`, `org_published_date`, `org_postimage`, `org_status`) VALUES
(12, 83, 'This Announcement is for sample test only', '2022-01-21 14:02:28', '', 1),
(13, 83, 'This Post is for sample test only\r\n', '2022-01-21 14:02:59', '', 2),
(15, 84, 'This post is for sample test only\r\n', '2022-01-21 14:18:55', '', 2),
(16, 84, 'This announcement is for sample test only\r\n', '2022-01-21 14:19:14', '', 1),
(17, 83, 'This Second Announcement is for sample test only', '2022-01-27 13:51:27', '', 1),
(20, 83, 'Another sample post for the test', '2022-01-27 13:58:00', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `org_member`
--

CREATE TABLE `org_member` (
  `id` int(11) NOT NULL,
  `orgm_id` int(255) NOT NULL,
  `orgmember_id` int(255) NOT NULL,
  `orgmember_fullname` varchar(5000) NOT NULL,
  `orgmember_section` varchar(100) NOT NULL,
  `orgmember_college` varchar(255) NOT NULL,
  `orgmember_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `id` int(100) NOT NULL,
  `post` text NOT NULL,
  `published_date` datetime NOT NULL,
  `status_post` int(1) NOT NULL,
  `status1` varchar(255) NOT NULL,
  `report` int(1) NOT NULL,
  `feedback` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `id`, `post`, `published_date`, `status_post`, `status1`, `report`, `feedback`) VALUES
(23, 84, 'Another sample anonymous post for different user :)) ', '2022-01-21 13:37:44', 1, 'anonymous', 0, ''),
(24, 83, 'Be sure the content you\'re writing for your post is valuable and will connect with your audience.', '2022-01-21 13:28:28', 1, 'public', 0, ''),
(26, 83, 'Sample post from no one', '2022-01-27 14:11:03', 0, 'anonymous', 0, ''),
(27, 83, 'Literally No one', '2022-01-27 14:12:45', 1, 'anonymous', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `verification_key` varchar(250) NOT NULL,
  `is_email_verified` enum('no','yes') NOT NULL,
  `rules_regulations` int(1) NOT NULL,
  `code_verification` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `status`, `verification_key`, `is_email_verified`, `rules_regulations`, `code_verification`, `image`) VALUES
(79, 'admin', 'ADMIN01', 'clikitstuff@gmail.com', 'afe3ffbfccb0470513dbf3411f7002e6dac1f378', '1', '9db7798fa3adcbebe2e88d7d82537dcf', 'yes', 1, '', 'logo.jpg'),
(83, 'Aliana M. Caballero', 'ooo', 'aliana.caballero@gmail.com', '679da235956418c84f0bd9966ff40fd84bd535ba', '0', '8ae142b0b05ccd2d9ec0c0428c5f3e37', 'yes', 1, '', 'aliana_-_square3.jpg'),
(84, 'Jersey M. Sodela', 'Aye', 'jerseymadrenian19@gmail.com', '679da235956418c84f0bd9966ff40fd84bd535ba', '0', 'c4f54cdbc096360f1d8c94e9485a859c', 'yes', 1, '', 'aliana.jpg'),
(87, 'Aliana Caballero', 'Ali', 'caballero.aliana@gmail.com', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', '0', '60300c6945f7980048396e89c4d4d25a', 'yes', 1, '', 'aliana_-_square4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orgs`
--
ALTER TABLE `orgs`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `orgs_posts`
--
ALTER TABLE `orgs_posts`
  ADD PRIMARY KEY (`orgpost_id`);

--
-- Indexes for table `org_member`
--
ALTER TABLE `org_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orgs`
--
ALTER TABLE `orgs`
  MODIFY `org_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orgs_posts`
--
ALTER TABLE `orgs_posts`
  MODIFY `orgpost_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `org_member`
--
ALTER TABLE `org_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
