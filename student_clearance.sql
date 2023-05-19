-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 09:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_name` varchar(250) NOT NULL,
  `department_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_name`, `department_number`) VALUES
('Computer System And Mathematics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `form_id` bigint(20) NOT NULL,
  `student` varchar(50) NOT NULL,
  `form_step` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_comment`
--

CREATE TABLE `form_comment` (
  `comment_id` int(11) NOT NULL,
  `form` bigint(20) NOT NULL,
  `staff` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL,
  `step` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_step`
--

CREATE TABLE `form_step` (
  `step_id` int(11) NOT NULL,
  `step_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_step`
--

INSERT INTO `form_step` (`step_id`, `step_name`) VALUES
(1, 'Librarian'),
(2, 'Games Coach'),
(3, 'Halls of Residence'),
(4, 'Accounts Section'),
(5, 'Director of Students Services'),
(6, 'Academic Administration'),
(7, 'Head Of Department');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
(1, 'Female'),
(2, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_number` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `staff_role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `department` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_number`, `first_name`, `middle_name`, `staff_role`, `email`, `password`, `last_name`, `department`, `title`) VALUES
('admin_number', 'clarencen', 'clarencen', 100, 'admin@ardhi.edu.tz', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'lane', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_role`
--

CREATE TABLE `staff_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_role`
--

INSERT INTO `staff_role` (`role_id`, `role_name`) VALUES
(1, 'Librarian'),
(2, 'Game Coach'),
(7, 'Head Of Department'),
(100, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_number` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `completion_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_number`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`form_id`),
  ADD KEY `stud` (`student`),
  ADD KEY `fs` (`form_step`);

--
-- Indexes for table `form_comment`
--
ALTER TABLE `form_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `rfr` (`form`),
  ADD KEY `dddd` (`staff`),
  ADD KEY `ee` (`step`);

--
-- Indexes for table `form_step`
--
ALTER TABLE `form_step`
  ADD PRIMARY KEY (`step_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_number`),
  ADD KEY `staff_type` (`staff_role`),
  ADD KEY `drp` (`department`);

--
-- Indexes for table `staff_role`
--
ALTER TABLE `staff_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_number`),
  ADD KEY `gender` (`gender`),
  ADD KEY `depart` (`department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `form_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `form_comment`
--
ALTER TABLE `form_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`student`) REFERENCES `student` (`student_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `form_ibfk_2` FOREIGN KEY (`form_step`) REFERENCES `form_step` (`step_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `form_comment`
--
ALTER TABLE `form_comment`
  ADD CONSTRAINT `form_comment_ibfk_2` FOREIGN KEY (`step`) REFERENCES `form_step` (`step_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `form_comment_ibfk_3` FOREIGN KEY (`staff`) REFERENCES `staff` (`staff_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `form_comment_ibfk_4` FOREIGN KEY (`form`) REFERENCES `form` (`form_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`department_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`staff_role`) REFERENCES `staff_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `gender` (`gender_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`department`) REFERENCES `department` (`department_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
