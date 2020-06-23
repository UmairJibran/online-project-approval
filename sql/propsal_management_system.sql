-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 04:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propsal_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `hod_record`
--

CREATE TABLE `hod_record` (
  `hod_ID` int(11) NOT NULL,
  `hod_FIRST_NAME` varchar(50) NOT NULL,
  `hod_LAST_NAME` varchar(50) NOT NULL,
  `hod_EMAIL` varchar(50) NOT NULL,
  `hod_DEPT` varchar(30) NOT NULL,
  `hod_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_record`
--

CREATE TABLE `project_record` (
  `project_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `hod_ID` int(11) NOT NULL,
  `project_TITLE` varchar(50) NOT NULL,
  `project_YEAR` int(11) NOT NULL,
  `project_PROFESSOR` varchar(50) DEFAULT NULL,
  `project_BATCH` int(11) NOT NULL,
  `project_COURSE` varchar(50) NOT NULL,
  `project_COMMENT` varchar(500) DEFAULT NULL,
  `project_STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `project_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_ID` int(11) NOT NULL,
  `student_EMAIL` varchar(50) NOT NULL,
  `student_FIRST_NAME` varchar(50) NOT NULL,
  `student_LAST_NAME` varchar(50) NOT NULL,
  `student_PASSWORD` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hod_record`
--
ALTER TABLE `hod_record`
  ADD PRIMARY KEY (`hod_ID`),
  ADD UNIQUE KEY `hod_EMAIL` (`hod_EMAIL`);

--
-- Indexes for table `project_record`
--
ALTER TABLE `project_record`
  ADD PRIMARY KEY (`project_ID`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_ID`),
  ADD UNIQUE KEY `student_EMAIL` (`student_EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hod_record`
--
ALTER TABLE `hod_record`
  MODIFY `hod_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `project_record`
--
ALTER TABLE `project_record`
  MODIFY `project_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
