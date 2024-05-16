-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 08, 2024 alle 12:46
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myclasshubdatabase`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `classe`
--

CREATE TABLE `classe` (
  `ID` int(5) NOT NULL,
  `professore_ID` int(5) NOT NULL,
  `anno` int(1) NOT NULL,
  `sezione` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `classe`
--

INSERT INTO `classe` (`ID`, `professore_ID`, `anno`, `sezione`) VALUES
(1, 1, 5, 'IB'),
(2, 1, 5, 'IC'),
(3, 1, 5, 'ID');

-- --------------------------------------------------------

--
-- Struttura della tabella `materia`
--

CREATE TABLE `materia` (
  `ID` int(5) NOT NULL,
  `professore_ID` int(5) NOT NULL,
  `materia` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `materia`
--

INSERT INTO `materia` (`ID`, `professore_ID`, `materia`) VALUES
(1, 1, 'Italiano'),
(2, 1, 'Storia'),
(3, 1, 'Matematica'),
(4, 1, 'Informatica'),
(5, 1, 'Sistemie e Reti');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `ID` int(5) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  `stato` int(1) NOT NULL DEFAULT 0,
  `professore_ID` int(5) NOT NULL,
  `studente_ID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `professore`
--

CREATE TABLE `professore` (
  `ID` int(5) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `professore`
--

INSERT INTO `professore` (`ID`, `cognome`, `nome`, `username`, `password`) VALUES
(1, 'Rossi', 'Paolo', 'prof_1', 'Ciao1234!');

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE `studente` (
  `ID` int(5) NOT NULL,
  `classe_ID` int(5) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `studente`
--

INSERT INTO `studente` (`ID`, `classe_ID`, `cognome`, `nome`, `username`, `password`) VALUES
(1, 1, 'Herendeu', 'Daniele', 'stud_1', 'Ciao1234!'),
(2, 1, 'Lacatena', 'Angelo', 'stud_2', 'Ciao1234!'),
(3, 2, 'Fradegrada', 'Gabriele', 'stud_3', 'Ciao1234!'),
(4, 2, 'Cominotti', 'Stefano', 'stud_4', 'Ciao1234!'),
(5, 3, 'Rinaldi', 'Filippo', 'stud_5', 'Ciao1234!'),
(6, 1, 'testID', 'testID', 'stud_6', 'Ciao1234!');

-- --------------------------------------------------------

--
-- Struttura della tabella `voto`
--

CREATE TABLE `voto` (
  `ID` int(10) NOT NULL,
  `studente_ID` int(5) NOT NULL,
  `materia_ID` int(5) NOT NULL,
  `voto` int(3) NOT NULL,
  `tipologia` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `voto`
--

INSERT INTO `voto` (`ID`, `studente_ID`, `materia_ID`, `voto`, `tipologia`) VALUES
(1, 1, 1, 90, 'scritta'),
(2, 1, 2, 87, 'scritta'),
(3, 1, 3, 70, 'scritta'),
(4, 1, 4, 77, 'scritta'),
(5, 1, 5, 45, 'scritta'),
(6, 1, 1, 60, 'orale'),
(7, 1, 2, 92, 'orale'),
(8, 1, 3, 75, 'orale'),
(9, 1, 4, 67, 'orale'),
(10, 1, 5, 100, 'orale'),
(11, 1, 1, 75, 'pratica'),
(12, 1, 2, 40, 'pratica'),
(13, 1, 3, 20, 'pratica'),
(14, 1, 4, 55, 'pratica'),
(15, 1, 5, 82, 'pratica'),
(16, 2, 1, 90, 'scritta'),
(17, 2, 2, 87, 'scritta'),
(18, 2, 3, 70, 'scritta'),
(19, 2, 4, 77, 'scritta'),
(20, 2, 5, 45, 'scritta'),
(21, 2, 1, 60, 'orale'),
(22, 2, 2, 92, 'orale'),
(23, 2, 3, 75, 'orale'),
(24, 2, 4, 67, 'orale'),
(25, 2, 5, 100, 'orale'),
(26, 2, 1, 75, 'pratica'),
(27, 2, 2, 40, 'pratica'),
(28, 2, 3, 20, 'pratica'),
(29, 2, 4, 55, 'pratica'),
(30, 2, 5, 82, 'pratica'),
(31, 6, 1, 50, 'scritta'),
(32, 6, 2, 50, 'scritta'),
(33, 6, 3, 50, 'scritta'),
(34, 6, 4, 50, 'scritta'),
(35, 6, 5, 50, 'scritta'),
(36, 6, 1, 50, 'orale'),
(37, 6, 2, 50, 'orale'),
(38, 6, 3, 50, 'orale'),
(39, 6, 4, 50, 'orale'),
(40, 6, 5, 50, 'orale'),
(41, 6, 1, 50, 'pratica'),
(42, 6, 2, 50, 'pratica'),
(43, 6, 3, 50, 'pratica'),
(44, 6, 4, 50, 'pratica'),
(45, 6, 5, 50, 'pratica');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `professore_ID` (`professore_ID`);

--
-- Indici per le tabelle `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `professore_ID` (`professore_ID`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `professore_ID` (`professore_ID`),
  ADD KEY `studente_ID` (`studente_ID`);

--
-- Indici per le tabelle `professore`
--
ALTER TABLE `professore`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `studente`
--
ALTER TABLE `studente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `classe_ID` (`classe_ID`);

--
-- Indici per le tabelle `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `studente_ID` (`studente_ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `classe`
--
ALTER TABLE `classe`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `materia`
--
ALTER TABLE `materia`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `professore`
--
ALTER TABLE `professore`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `studente`
--
ALTER TABLE `studente`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `voto`
--
ALTER TABLE `voto`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`professore_ID`) REFERENCES `professore` (`ID`);

--
-- Limiti per la tabella `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`professore_ID`) REFERENCES `professore` (`ID`);

--
-- Limiti per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`professore_ID`) REFERENCES `professore` (`ID`),
  ADD CONSTRAINT `messaggio_ibfk_2` FOREIGN KEY (`studente_ID`) REFERENCES `studente` (`ID`);

--
-- Limiti per la tabella `studente`
--
ALTER TABLE `studente`
  ADD CONSTRAINT `studente_ibfk_1` FOREIGN KEY (`classe_ID`) REFERENCES `classe` (`ID`);

--
-- Limiti per la tabella `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `voto_ibfk_1` FOREIGN KEY (`studente_ID`) REFERENCES `studente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
