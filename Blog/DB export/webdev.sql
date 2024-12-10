-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 12:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `kurse`
--

CREATE TABLE `kurse` (
  `kurs_id` char(36) NOT NULL,
  `kurs_kurz_name` varchar(10) NOT NULL,
  `kurs_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurse`
--

INSERT INTO `kurse` (`kurs_id`, `kurs_kurz_name`, `kurs_name`) VALUES
('d361bd36-b6e7-11ef-8ed7-d843ae1066aa', 'App Dev', 'Application Development'),
('d3636752-b6e7-11ef-8ed7-d843ae1066aa', 'Web Dev', 'Web Development'),
('d365582a-b6e7-11ef-8ed7-d843ae1066aa', 'Data Sci', 'Data Science'),
('d367dc69-b6e7-11ef-8ed7-d843ae1066aa', 'AI', 'Artificial Intelligence'),
('d3695396-b6e7-11ef-8ed7-d843ae1066aa', 'Cloud', 'Cloud Computing');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
