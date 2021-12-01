-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 06:00 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `just_pi`
--
CREATE DATABASE IF NOT EXISTS `just_pi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `just_pi`;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `license_key` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `license_start_date` date NOT NULL,
  `license_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formula`
--

DROP TABLE IF EXISTS `formula`;
CREATE TABLE `formula` (
  `formula_id` int(11) NOT NULL,
  `formula_name` varchar(64) NOT NULL,
  `variables` varchar(256) NOT NULL,
  `formula` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formula`
--

INSERT INTO `formula` (`formula_id`, `formula_name`, `variables`, `formula`, `description`) VALUES
(1, 'Circle Area', 'radius', 'pi()*pow(radius, 2)', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\CircleArea.png'),
(2, 'Circle Circumference', 'radius', '2*pi()*radius', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\CircleCircumference.png'),
(3, 'Parallelogram Area', 'base height', 'base*height', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\ParallelogramArea.png'),
(5, 'Parallelogram Perimeter', 'base side ', '(2*side)+(2*base)', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\ParallelogramPerimeter.png'),
(6, 'Rectangle Area', 'height width', 'height*width', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\RectangleArea.png'),
(7, 'Rectangle Perimeter', 'height width', '(2*height)+(2*width)', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\RectanglePerimeter.png'),
(8, 'Square Area', 'side', 'pow(side, 2)', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\SquareArea.png'),
(9, 'Square Perimeter', 'side', '4*side', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\SquarePerimeter.png'),
(10, 'Triangle Area', 'base height', '(base*height)/2', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\TriangleArea.png'),
(11, 'Trapezoid Area', 'smallBase longBase height', '((smallBase+longBase)*height)/2', 'C:\\xampp\\htdocs\\JustPi\\justpi\\database\\Formulas\\TrapezoidArea.png');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `formula_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `variables` varchar(256) NOT NULL,
  `result` float NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pass_hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `formula`
--
ALTER TABLE `formula`
  ADD PRIMARY KEY (`formula_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `history_to_formula` (`formula_id`),
  ADD KEY `history_to_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_to_client` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formula`
--
ALTER TABLE `formula`
  MODIFY `formula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_to_formula` FOREIGN KEY (`formula_id`) REFERENCES `formula` (`formula_id`),
  ADD CONSTRAINT `history_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_to_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
