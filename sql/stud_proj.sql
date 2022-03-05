-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2022 at 01:33 PM
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
-- Database: `stud_proj`
--
CREATE DATABASE IF NOT EXISTS `stud_proj` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stud_proj`;
-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `nog` int(2) NOT NULL,
  `spg` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `nog`, `spg`) VALUES
(2, 'First project', 5, 5),
(3, 'Summer time', 2, 2),
(4, 'Sports', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `namesurname` varchar(255) COLLATE utf8_bin NOT NULL,
  `project` int(11) NOT NULL,
  `s_group` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `namesurname`, `project`, `s_group`) VALUES
(5, 'ASd', 1, 2),
(9, 'Tadas Kalinauskas', 1, 1),
(10, 'Antanas Baranauskas', 1, 1),
(11, 'asdd', 1, 0),
(12, 'Fasd', 1, 0),
(13, 'Testas', 1, 0),
(14, 'Testas', 5, 0),
(15, 'Testas1', 1, 0),
(16, 'asd', 1, 0),
(17, 'asddd', 1, 0),
(18, 'asddd', 1, 0),
(19, 'asddd', 1, 0),
(20, 'asd', 6, 0),
(27, 'Tomas', 3, 1),
(30, 'Tom Brady', 2, 1),
(32, 'Tomas Brazdys', 2, 1),
(41, 'fdsf', 5, 0),
(42, 'LeBron James', 2, 3),
(43, 'James Harden', 2, 5),
(44, 'Jonas ValanÄiÅ«nas', 2, 1),
(45, 'Antanas GrineviÄius', 2, 4),
(46, 'LeBron James', 3, 1),
(47, 'Vilius JasikeviÄius', 3, 2),
(49, 'Kotryna BudrytÄ—', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
