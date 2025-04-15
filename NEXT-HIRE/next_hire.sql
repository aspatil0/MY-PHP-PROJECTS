-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2025 at 08:21 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `next_hire`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `skills` text NOT NULL,
  `resume` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `job_id`, `name`, `qualification`, `experience`, `email`, `skills`, `resume`, `created_at`) VALUES
(1, 0, 'Shravani Talwar', 'Bachelor&#039;s Degree', '', 'xyz@xyz.com', 'XFD', 'uploads/Shravani AC.pdf', '2025-04-13 14:06:55'),
(3, 7, 'Neha', 'Bachelor&#039;s Degree', 'NA', 'neha@gmail.com', 'C++', 'uploads/New Text Document.txt', '2025-04-13 15:35:44'),
(7, 0, 'Shradha', '', NULL, 'shradha@gmail.com', '', '', '2025-04-13 17:06:22'),
(9, 0, 'Neha', '', NULL, 'neha@gmail.com', '', '', '2025-04-13 17:40:02'),
(10, 0, 'Priyanka', '', NULL, 'priyanka@gmail.com', '', '', '2025-04-13 18:31:21'),
(11, 0, 'Shravani ', '', NULL, 'john@example.com', '', '', '2025-04-13 18:36:22'),
(12, 0, 'Shravani ', '', NULL, 'xyz@xyz.com', '', '', '2025-04-13 19:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `description` text,
  `location` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `provider_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company`, `description`, `location`, `email`, `provider_id`) VALUES
(6, 'Front End Developer', 'Devine Tech', 'Front end developer ', 'Pune', 'devineTech@gmail.com', 0),
(7, 'backend developer', 'amazon', 'xxx', 'pune', 'xyz@xyz.com', 1),
(8, 'Frontend developer', 'Devine tech', 'xyz', 'pune', 'xyz@xyz.com', 1),
(9, 'Python developer', 'Devine Tech', 'Expert in python. At least two years of Experience', 'Pune', 'bhagyashree@gmail.com', 9),
(11, 'Cyber Security Expert', 'Devine Tech', 'Need Basic Knowledge of networking.', 'Pune', 'priyanka@gmail.com', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('provider','seeker') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Shravani', 'Talwar', 'xyz@xyz.com', '$2y$10$oHbH2pTk6nrruAF1LAeK5.O8fFdayc2Sng3Er6fI.ySJBfD03XQda', 'provider', '2025-04-12 03:44:16'),
(2, 'Shravani', 'Talwar', 'abc@abc.com', '$2y$10$EX7hc.9relwXXwZ45hVYPutT1sM7lDWavkZxONiShGIXsemuibvLK', 'seeker', '2025-04-12 03:46:13'),
(4, 'Jiya', 'Patil', 'jiya@gmail.com', '$2y$10$ulru17STBpwv4637TGokzuIvKoY6uIyhCXE.xxFLHtp/tJ3g11Hxu', 'seeker', '2025-04-12 13:33:23'),
(5, 'Parth', 'Talwar', 'Parth@gmail.com', '$2y$10$EeKm5Z/GSW5fOwreI7WCSO0TL0VwQeuFTUXEEvljeKK3CWw8WEa/a', 'provider', '2025-04-12 14:40:20'),
(6, 'Riya', 'Kumari', 'riya@gmail.com', '$2y$10$PKlaKUrMFYKwRx2ZDx5c1OuXLReas3ZDaBTWEtx796mmrnj6hlnb.', 'provider', '2025-04-12 15:51:09'),
(7, 'nutan', 'more', 'nutan@gmail.com', '$2y$10$Gv33lo4h93QPaFktHc5AyusiNH4HnQ9GnRRgqn6FtP7d7KVYddcYO', 'provider', '2025-04-13 15:00:22'),
(8, 'Neha', 'Sagare', 'neha@gmail.com', '$2y$10$1J8IuYQUOyJeSSRFK1v0He27zJ9881t9tVWg.0FZpAtlSUn9d5Z1W', 'seeker', '2025-04-13 15:31:28'),
(9, 'Bhagyashree', 'Dogre', 'bhagyashree@gmail.com', '$2y$10$BuTXstH10Xj8KAquUm0OFOfyyVzZz4qsaE3w.C7Nz4Ie3jZOHkNjy', 'provider', '2025-04-13 15:39:15'),
(10, 'Priyanka', 'Patil', 'priyanka@gmail.com', '$2y$10$SiRFkPvk7kMW9EOfPUMH9.gOigWLRl.hF3YmtDVI4dAz9vq2Qe1.a', 'provider', '2025-04-13 15:45:17'),
(11, 'Shradha', 'Dhage', 'shradha@gmail.com', '$2y$10$UMxbllMLinJqCQS1oFoBnOCK4QAx8rNAS.BsxRmm/Qhm9P8ELZsFG', 'seeker', '2025-04-13 15:49:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
