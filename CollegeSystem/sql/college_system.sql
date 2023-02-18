-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 09:34 PM
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
-- Database: `college_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` int(11) NOT NULL,
  `college_name` int(11) NOT NULL,
  `college_address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `teacher` int(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `teacher`, `department`) VALUES
(1, 'Java', 3, 1),
(2, 'PHP', 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `college` int(11) NOT NULL DEFAULT 1,
  `department_chair` int(11) NOT NULL,
  `faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `college`, `department_chair`, `faculty`) VALUES
(1, 'Informatics', 1, 2, 2),
(2, 'Math', 1, 2, 1),
(3, 'Law', 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `college` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `college`) VALUES
(1, 'Bachelor Faculty', 1),
(2, 'Master Faculty', 1),
(3, 'New Faculty', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students_courses`
--

CREATE TABLE `students_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `faculty` int(11) NOT NULL,
  `rector_flag` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `username`, `password`, `gender`, `role`, `department`, `faculty`, `rector_flag`) VALUES
(1, 'Faraona', 'Spasov', 'admin', 'admin', '', 'admin', '', 0, NULL),
(3, 'Iliyan', 'Tachev', 'Ilkata', '123', 'Male', 'teacher', '1', 0, NULL),
(4, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(5, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(6, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(7, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(8, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(9, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(10, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(11, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(12, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(13, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(14, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(15, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(16, 'gosho', 'goshov', 'gosho', 'gosho', 'muj', 'student', '', 0, NULL),
(17, 'gosho', 'goshov', 'gosho', 'gosho', 'Male', 'teacher', '2', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_courses`
--
ALTER TABLE `students_courses`
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
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students_courses`
--
ALTER TABLE `students_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
