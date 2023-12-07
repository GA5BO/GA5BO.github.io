-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 10:09 AM
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
-- Database: `lab_activity_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_entries`
--

CREATE TABLE `student_entries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `year_section` varchar(20) NOT NULL,
  `action_taken` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_entries`
--

INSERT INTO `student_entries` (`id`, `name`, `course_id`, `course_name`, `year_section`, `action_taken`, `photo`) VALUES
(1, 'Rodel V. Limpoco', 'PE 120', 'Networking II, Systems Integration and Architecture, Information Management I, Multimedia Publishing, Quantitative Methods, Web Systems and Technologies 2, Interactive Programming and Technologies 2, Individual Sports', 'BSIT', 'Enrolled', 'uploads/rodel.jpg'),
(2, 'Rusty Castor', 'PE 120', 'Networking II, Information Management I, Multimedia Publishing, Web Systems and Technologies 2, Interactive Programming and Technologies 2', 'BSFT', 'Enrolled', 'uploads/rusty.jpg'),
(3, 'Rodel V. Limpoco', 'IT 104', 'Networking II, Systems Integration and Architecture, Information Management I, Multimedia Publishing, Quantitative Methods, Individual Sports', 'BSGE', 'Enrolled', 'uploads/earl.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_entries`
--
ALTER TABLE `student_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_entries`
--
ALTER TABLE `student_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
