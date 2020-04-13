-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 07:33 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `self`
--
CREATE DATABASE IF NOT EXISTS `self` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `self`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_name` varchar(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `song_added` varchar(100) NOT NULL,
  `song_deleted` varchar(100) NOT NULL,
  `song_category` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `artist_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `admin`
--

TRUNCATE TABLE `admin`;
-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `song_category` varchar(100) NOT NULL,
  `song_name` varchar(100) NOT NULL,
  `artist_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `category`
--

TRUNCATE TABLE `category`;
-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

DROP TABLE IF EXISTS `liked`;
CREATE TABLE `liked` (
  `song_id` int(11) NOT NULL,
  `song_name` varchar(100) NOT NULL,
  `album_name` varchar(100) NOT NULL,
  `artist_name` varchar(100) NOT NULL,
  `downloaded` varchar(100) NOT NULL,
  `liked_email` varchar(100) NOT NULL,
  `premium_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `liked`
--

TRUNCATE TABLE `liked`;
-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `loginemail` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `phonenumber` text NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `login`
--

TRUNCATE TABLE `login`;
--
-- Dumping data for table `login`
--

INSERT DELAYED IGNORE INTO `login` (`login_id`, `fname`, `loginemail`, `password`, `date_birth`, `phonenumber`, `status`) VALUES
(3, 'abc2', 'akankshaladdha0@gmail.com', '1234', NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `most_liked`
--

DROP TABLE IF EXISTS `most_liked`;
CREATE TABLE `most_liked` (
  `song_id` int(11) NOT NULL,
  `msid` int(11) NOT NULL,
  `song_name` varchar(100) NOT NULL,
  `number_likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `most_liked`
--

TRUNCATE TABLE `most_liked`;
-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

DROP TABLE IF EXISTS `premium`;
CREATE TABLE `premium` (
  `premium_id` int(11) NOT NULL,
  `membership_no` int(11) NOT NULL,
  `premium_email` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `premium`
--

TRUNCATE TABLE `premium`;
-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `registration`
--

TRUNCATE TABLE `registration`;
--
-- Dumping data for table `registration`
--

INSERT DELAYED IGNORE INTO `registration` (`firstname`, `lastname`, `email`, `password`, `gender`, `code`) VALUES
('abc', 'abc', 'akanksha.cs18@bmsce.ac.in', '1234', 'female', '7180139'),
('abc2', 'abc2', 'akankshaladdha0@gmail.com', '1234', 'female', '3659174');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_email` (`admin_email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `liked_email` (`liked_email`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `premium_id` (`premium_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`,`loginemail`),
  ADD KEY `loginemail` (`loginemail`);

--
-- Indexes for table `most_liked`
--
ALTER TABLE `most_liked`
  ADD PRIMARY KEY (`song_id`,`msid`);

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`premium_id`),
  ADD KEY `premium_email` (`premium_email`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `premium`
--
ALTER TABLE `premium`
  MODIFY `premium_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_email`) REFERENCES `login` (`loginemail`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`admin_email`) REFERENCES `login` (`loginemail`) ON DELETE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `liked`
--
ALTER TABLE `liked`
  ADD CONSTRAINT `liked_ibfk_1` FOREIGN KEY (`liked_email`) REFERENCES `login` (`loginemail`) ON DELETE CASCADE,
  ADD CONSTRAINT `liked_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `liked_ibfk_3` FOREIGN KEY (`premium_id`) REFERENCES `premium` (`premium_id`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`loginemail`) REFERENCES `registration` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`premium_email`) REFERENCES `login` (`loginemail`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
