-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 01:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sociatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `connection` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `username` text NOT NULL,
  `usertag` text NOT NULL,
  `occupation` text NOT NULL,
  `organisation` text NOT NULL,
  `description` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `about` text NOT NULL,
  `interests` text NOT NULL,
  `highlights` text NOT NULL,
  `experiences` text NOT NULL,
  `contacts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `connection`, `experience`, `username`, `usertag`, `occupation`, `organisation`, `description`, `state`, `country`, `about`, `interests`, `highlights`, `experiences`, `contacts`) VALUES
(1, 'liou_larissa@students.edu.sg', 'Hello123', 0, 0, 'Larissa', 'Larissa123', 'Student', 'River Valley High School', '5 years student at RV', 'I like to code and game', 'Singapore', 'Singapore', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
