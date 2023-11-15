-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2022 at 09:07 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--
CREATE DATABASE IF NOT EXISTS `school` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `school`;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classname`) VALUES
(3, 'Dip/ND 1'),
(4, 'Dip/ND 2');

-- --------------------------------------------------------

--
-- Table structure for table `dep`
--

CREATE TABLE `dep` (
  `id` int(11) NOT NULL,
  `depname` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dep`
--

INSERT INTO `dep` (`id`, `depname`) VALUES
(1, 'Computer Science'),
(2, 'Mechanical Engineering'),
(4, 'Food Science Technology'),
(5, 'Civil Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `courseid` varchar(50) NOT NULL,
  `qpaper` varchar(100) NOT NULL,
  `mans` varchar(100) NOT NULL,
  `sdate` varchar(60) NOT NULL,
  `cdate` varchar(60) NOT NULL,
  `session` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `user`, `classid`, `courseid`, `qpaper`, `mans`, `sdate`, `cdate`, `session`, `semester`) VALUES
(6, 2, 4, '2', 'yes', 'yes', '2022-09-03', '', '2021/2022', 'FIRST'),
(7, 3, 4, '3', 'yes', 'yes', '2022-09-03', 'yes', '2021/2022', 'FIRST');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subjectID` varchar(50) NOT NULL,
  `subjectName` varchar(200) NOT NULL,
  `subjectType` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subjectID`, `subjectName`, `subjectType`, `semester`) VALUES
(1, 'COM 101', 'INTRODUCTION TO COMPUTER', 3, 'FIRST'),
(2, 'MECH 223', 'INTRODUCTION TO AUTOMOBILES', 4, 'FIRST'),
(3, 'COM 221', 'INTRODUCTION TO AUTOMOBILE', 4, 'FIRST');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Role` varchar(30) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `courseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Password`, `Role`, `fullname`, `courseid`) VALUES
(1, 'admin', '$2y$10$IDJhjFoHEbL816MwRwWzku0veBQyGGTRtGPo29QStYwB78lYGlFyC', 'Admin', '', 0),
(2, 'aliko', '$2y$10$GHA5.ot0wxAcBLlKycnENu09GFkFqxiP1hd1djIZScVRmAzLPpA/.', 'HOD', 'Issa Ali', 2),
(3, 'musa2', '$2y$10$IDJhjFoHEbL816MwRwWzku0veBQyGGTRtGPo29QStYwB78lYGlFyC', 'Teacher', 'Musa Ali', 3),
(4, '', '', '', 'Tenn Whiterose', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dep`
--
ALTER TABLE `dep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
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
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dep`
--
ALTER TABLE `dep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
