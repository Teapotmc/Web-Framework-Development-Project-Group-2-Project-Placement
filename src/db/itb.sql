-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 02, 2016 at 11:05 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajobs`
--

CREATE TABLE `ajobs` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `employerId` text NOT NULL,
  `deadline` text NOT NULL,
  `student` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ajobs`
--

INSERT INTO `ajobs` (`id`, `username`, `name`, `employerId`, `deadline`, `student`) VALUES
(4, 'mark', 'McDonalds', '001', '19/06/2016', 'Mark McCarthy'),
(5, 'mark', 'McDonalds', '001', '19/06/2016', 'Mark McCarthy');

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `age` text NOT NULL,
  `address` text NOT NULL,
  `experience` text NOT NULL,
  `extra` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `username`, `name`, `surname`, `age`, `address`, `experience`, `extra`, `photo`) VALUES
(15, 'mark', 'Mark', 'McCarthy', '22', 'Whitewell gaybrook', 'Farm Work', 'I like Video games', 'headshot4.jpg'),
(16, 'john', 'john', 'doe', '21', 'itb', 'mcdonalds', '', 'john.jpg'),
(17, 'jonny2', 'john', 'doe', '21', 'itb', 'mcdonalds', '', 'blank.jpg'),
(18, 'jones', 'john', 'doe', '21', 'itb', 'mcdonalds', '', 'blank.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `employerId` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `username`, `employerId`) VALUES
(2, 'jack', '001'),
(3, 'James52', '002');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `details` text NOT NULL,
  `employerId` text NOT NULL,
  `deadline` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `details`, `employerId`, `deadline`) VALUES
(5, 'McDonalds', 'Need new Logo', '001', '19/06/2016'),
(6, 'ITB', 'Need new Logo', '002', '19/06/2017');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `content`, `comment`) VALUES
(7, 'Hello World', 'Hello Everyone\r\n\r\n-Admin', 'All looks well. '),
(8, 'Website undergoing test', 'Website is currently undergoing testing', '');

-- --------------------------------------------------------

--
-- Table structure for table `pmessages`
--

CREATE TABLE `pmessages` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pmessages`
--

INSERT INTO `pmessages` (`id`, `username`, `subject`, `content`, `comment`) VALUES
(12, 'admin', 'test', 'test', 'test'),
(13, 'mark', 'Hello', 'Hello Mark, everything is fine.\r\n\r\n-Mark', 'Nice Picture.'),
(14, 'jack', 'Job', 'Hey Jack, we created your job, students can now apply', ''),
(15, 'jack', 'Hello', 'Hello Jack', 'Please update your Cv.'),
(16, 'admin', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `employed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `employed`) VALUES
(6, 'mark', 'Unemployed'),
(7, 'john', 'Unemployed'),
(8, 'jonny2', 'Unemployed'),
(9, 'jones', 'Unemployed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(1) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'admin', '$2y$10$I1Z1K9btVjMu1sbak6uFNOmFXZv0kTdntqseRNtK19Sengghl17P.', 2),
(46, 'mark', '$2y$10$VXt18LrFGin95uEsWz8bL.yCATpOAg8RAaVR9EekHWBCGI4fmFnxq', 1),
(47, 'jack', '$2y$10$JsLlmu2XSGoK7HZjD/6HXO/frDwpsNXJk9dQHS7am0UuTKKT3Lfn2', 3),
(48, 'john', '$2y$10$m64GvqqCPL/zikrh4G31pu4hCT6ncAw0Kniz0P4uvwUgEJBc7I.OC', 1),
(50, 'jonny2', '$2y$10$rhpZvcjMNgBcbi6A9kIjBuFyUVW7yk1VkCKukrbJSimPyu0ldcUtO', 1),
(51, 'jones', '$2y$10$UvkgCi96E.nQ4.01h7RyI.lNYnf2zQv7sk27K4FaxjjZcKkV8uSau', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajobs`
--
ALTER TABLE `ajobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmessages`
--
ALTER TABLE `pmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajobs`
--
ALTER TABLE `ajobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pmessages`
--
ALTER TABLE `pmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
