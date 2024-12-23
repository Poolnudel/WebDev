-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 01:08 PM
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
-- Database: `blogbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `beitrag`
--

CREATE TABLE `beitrag` (
  `kursId` int(11) NOT NULL,
  `kursTitel` varchar(255) NOT NULL,
  `kursText` text NOT NULL,
  `kursBild` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beitrag`
--

INSERT INTO `beitrag` (`kursId`, `kursTitel`, `kursText`, `kursBild`) VALUES
(1, 'Einführung in HTML', 'HTML ist die Grundlage des Webdesigns und strukturiert Inhalte.', 'html_intro.jpg'),
(2, 'CSS für Anfänger', 'Mit CSS kannst du das Design und Layout deiner Website anpassen.', 'css_basics.jpg'),
(3, 'Dynamische Websites mit PHP', 'PHP ist eine serverseitige Sprache, die Interaktivität ermöglicht.', 'php_dynamic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kommentare`
--

CREATE TABLE `kommentare` (
  `kommentarId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `kommentarTitel` varchar(255) NOT NULL,
  `kommentarText` text NOT NULL,
  `kommentarBild` varchar(255) DEFAULT NULL,
  `kursId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kommentare`
--

INSERT INTO `kommentare` (`kommentarId`, `userId`, `kommentarTitel`, `kommentarText`, `kommentarBild`, `kursId`) VALUES
(1, 1, 'Super Beitrag!', 'Dieser Beitrag war wirklich hilfreich, danke!', NULL, 1),
(2, 2, 'Frage zum Inhalt', 'Ich habe eine Frage zu Abschnitt 2. Könnten Sie das erklären?', NULL, 1),
(3, 3, 'Weiter so!', 'Ich hoffe, es kommen mehr Beiträge wie dieser.', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kurse`
--

CREATE TABLE `kurse` (
  `kurs_id` int(11) NOT NULL,
  `kurs_kurz_name` varchar(10) NOT NULL,
  `kurs_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurse`
--

INSERT INTO `kurse` (`kurs_id`, `kurs_kurz_name`, `kurs_name`) VALUES
(1, 'App Dev', 'Application Development'),
(2, 'Web Dev', 'Web Development'),
(3, 'IT Inf', 'IT Infrasktrukturen'),
(4, 'Architekur', 'IT Architekturen');

-- --------------------------------------------------------

--
-- Table structure for table `nutzer`
--

CREATE TABLE `nutzer` (
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPasswort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutzer`
--

INSERT INTO `nutzer` (`userId`, `userEmail`, `userPasswort`) VALUES
(1, 'user1@example.com', 'passwort123'),
(2, 'user2@example.com', 'geheim123'),
(3, 'user3@example.com', 'sicher321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beitrag`
--
ALTER TABLE `beitrag`
  ADD PRIMARY KEY (`kursId`);

--
-- Indexes for table `kommentare`
--
ALTER TABLE `kommentare`
  ADD PRIMARY KEY (`kommentarId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `kurse`
--
ALTER TABLE `kurse`
  ADD PRIMARY KEY (`kurs_id`);

--
-- Indexes for table `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beitrag`
--
ALTER TABLE `beitrag`
  MODIFY `kursId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kommentare`
--
ALTER TABLE `kommentare`
  MODIFY `kommentarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kurse`
--
ALTER TABLE `kurse`
  MODIFY `kurs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kommentare`
--
ALTER TABLE `kommentare`
  ADD CONSTRAINT `kommentare_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `nutzer` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
