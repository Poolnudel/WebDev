-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Dez 2024 um 16:10
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
-- Datenbank: `blogbase`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beitrag`
--

CREATE TABLE `beitrag` (
  `kursId` int(11) NOT NULL,
  `kursTitel` varchar(255) NOT NULL,
  `kursText` text NOT NULL,
  `kursBild` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `beitrag`
--

INSERT INTO `beitrag` (`kursId`, `kursTitel`, `kursText`, `kursBild`) VALUES
(1, 'Einführung in HTML', 'HTML ist die Grundlage des Webdesigns und strukturiert Inhalte.', 'html_intro.jpg'),
(2, 'CSS für Anfänger', 'Mit CSS kannst du das Design und Layout deiner Website anpassen.', 'css_basics.jpg'),
(3, 'Dynamische Websites mit PHP', 'PHP ist eine serverseitige Sprache, die Interaktivität ermöglicht.', 'php_dynamic.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kommentare`
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
-- Daten für Tabelle `kommentare`
--

INSERT INTO `kommentare` (`kommentarId`, `userId`, `kommentarTitel`, `kommentarText`, `kommentarBild`, `kursId`) VALUES
(1, 1, 'Super Beitrag!', 'Dieser Beitrag war wirklich hilfreich, danke!', NULL, 1),
(2, 2, 'Frage zum Inhalt', 'Ich habe eine Frage zu Abschnitt 2. Könnten Sie das erklären?', NULL, 1),
(3, 3, 'Weiter so!', 'Ich hoffe, es kommen mehr Beiträge wie dieser.', NULL, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE `nutzer` (
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPasswort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`userId`, `userEmail`, `userPasswort`) VALUES
(1, 'user1@example.com', 'passwort123'),
(2, 'user2@example.com', 'geheim123'),
(3, 'user3@example.com', 'sicher321');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  ADD PRIMARY KEY (`kursId`);

--
-- Indizes für die Tabelle `kommentare`
--
ALTER TABLE `kommentare`
  ADD PRIMARY KEY (`kommentarId`),
  ADD KEY `userId` (`userId`);

--
-- Indizes für die Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  MODIFY `kursId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `kommentare`
--
ALTER TABLE `kommentare`
  MODIFY `kommentarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `kommentare`
--
ALTER TABLE `kommentare`
  ADD CONSTRAINT `kommentare_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `nutzer` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
