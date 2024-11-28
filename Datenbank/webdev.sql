-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Nov 2024 um 15:22
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webdev`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL,
  `hobby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `hobbies`
--

INSERT INTO `hobbies` (`id`, `hobby`) VALUES
(1, 'Staubsaugen'),
(2, 'Wandern'),
(3, 'Löcher Starren'),
(4, 'Brumm Brumm'),
(5, 'Singen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `matching`
--

CREATE TABLE `matching` (
  `id` int(11) NOT NULL,
  `person` int(11) NOT NULL,
  `hobby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `matching`
--

INSERT INTO `matching` (`id`, `person`, `hobby`) VALUES
(1, 2, 1),
(2, 1, 3),
(3, 3, 3),
(4, 3, 1),
(5, 3, 4),
(6, 4, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registrierungsformular`
--

CREATE TABLE `registrierungsformular` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `passwort` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `anrede` varchar(1) NOT NULL,
  `portraitbild` varchar(250) NOT NULL,
  `kurzbeschreibung` text NOT NULL,
  `hobbies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `registrierungsformular`
--

INSERT INTO `registrierungsformular` (`id`, `name`, `passwort`, `email`, `anrede`, `portraitbild`, `kurzbeschreibung`, `hobbies`) VALUES
(4, 'Tina Turner', 'ayo', 'tina@turner.ded', 'm', '1732207263_85104.jpg', 'AAAAAHHHHHHHHH', 'a:1:{i:5;s:6:\"Singen\";}');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `matching`
--
ALTER TABLE `matching`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `registrierungsformular`
--
ALTER TABLE `registrierungsformular`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `matching`
--
ALTER TABLE `matching`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `registrierungsformular`
--
ALTER TABLE `registrierungsformular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
