-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 11:16 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prod`
--

-- --------------------------------------------------------

--
-- Table structure for table `imaging`
--

CREATE TABLE `imaging` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `assessment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `healthcard` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `sex`, `height`, `weight`, `healthcard`, `dob`) VALUES
(1, 'Jane Doe', 'F', 153, 80, '213894839421', '1993-04-26'),
(2, 'Jane Smith', 'F', 165, 85, '213894830991', '1992-04-11'),
(3, 'John Doe', 'M', 182, 120, '213812239421', '1989-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(11) NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idreferral` int(11) NOT NULL,
  `idreferring` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheduledvisit`
--

CREATE TABLE `scheduledvisit` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `room` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bed` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scheduledvisit`
--

INSERT INTO `scheduledvisit` (`id`, `patientid`, `doctorid`, `date`, `time`, `room`, `bed`, `notes`) VALUES
(1, 1, 1, '2017-02-28', '09:00:00', '243', '2', ''),
(2, 1, 1, '2017-02-28', '09:00:00', '243', '2', ''),
(3, 2, 1, '2017-02-28', '09:15:00', '101', '1', ''),
(4, 3, 1, '2017-02-28', '09:30:00', '22', '4', '');

-- --------------------------------------------------------

--
-- Table structure for table `testresult`
--

CREATE TABLE `testresult` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `authtoken` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `authtoken`) VALUES
(1, 'dasmall', '2d9cb3631d9ba58f33b931a904f29da5106c781b992a743dacfd0d8343695fca', 'f4e63417457dbd3', 'dasmall@lakeheadu.ca', '3031746c0d0344107daebadeccbc2237'),
(2, 'bryon', '139782ba69e6411c4c725e4fe2895d93f8a5cc2f0a244b5ae09eca8bd02612a2', '4223035be82a3ed55f6759a963e76aaa', 'email@e.com', ''),
(4, 'newuser', 'f6d80817f4345985138c038a302dd3ec64ed80967a700730ed3c72f89ca8d112', '6cd954a04bb5847a', 'user@gmail.com', '72fa288df9f22f7167dff80cf89fd4e5'),
(5, 'admin', '246e0ca83ec82fde15dd9b78d7ca07a1956aa1b63bd08a659536235aeba2e282', '7b93b11d3fdd3f51', 'admin@localhost.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnoses` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `treatment` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imaging`
--
ALTER TABLE `imaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduledvisit`
--
ALTER TABLE `scheduledvisit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testresult`
--
ALTER TABLE `testresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imaging`
--
ALTER TABLE `imaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scheduledvisit`
--
ALTER TABLE `scheduledvisit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testresult`
--
ALTER TABLE `testresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;