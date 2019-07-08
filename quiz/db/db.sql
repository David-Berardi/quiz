-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 05, 2019 alle 22:14
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--
CREATE DATABASE IF NOT EXISTS `quiz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quiz`;

-- --------------------------------------------------------

--
-- Struttura della tabella `domande`
--

DROP TABLE IF EXISTS `domande`;
CREATE TABLE `domande` (
  `id` int(11) NOT NULL,
  `descrizione` varchar(256) NOT NULL,
  `id_quiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `domande`
--

INSERT INTO `domande` (`id`, `descrizione`, `id_quiz`) VALUES
(2, 'Dave e\' pelato?', 1),
(3, 'E\' Carlo bello?', 1),
(4, 'Qual e\' il tuo colore preferito', 2),
(5, 'Come ti definiresti', 3),
(6, 'Che cibo preferisci', 3),
(7, 'Che tipo di musica ascolti', 3),
(8, 'Quale\' il tuo animale preferito?', 3),
(9, 'Dove vai a mangiare la frutta?', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `titolo` varchar(64) NOT NULL,
  `descrizione` varchar(256) DEFAULT NULL,
  `data_creazione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `quiz`
--

INSERT INTO `quiz` (`id`, `titolo`, `descrizione`, `data_creazione`) VALUES
(1, 'Che frutto sei?', 'Scopri che frutto sei compilando questo quiz che andra\' a scoprire le parti piu\' nascoste di te', '2019-03-27'),
(2, 'Che taglio di capelli ti si addice meglio?', 'gay', '2019-03-27'),
(3, 'Che colore ti rappresenta', 'fai questo quiz e scopri il colore della tua anima', '2019-05-05');

-- --------------------------------------------------------

--
-- Struttura della tabella `risposte`
--

DROP TABLE IF EXISTS `risposte`;
CREATE TABLE `risposte` (
  `id` int(11) NOT NULL,
  `contenuto` varchar(512) NOT NULL,
  `id_domanda` int(11) NOT NULL,
  `id_risultato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `risposte`
--

INSERT INTO `risposte` (`id`, `contenuto`, `id_domanda`, `id_risultato`) VALUES
(15, 'si', 2, 2),
(16, 'no', 2, 4),
(17, 'Calmo', 5, 5),
(18, 'Agitato', 5, 6),
(19, 'Stupido', 5, 7),
(20, 'Pesce', 6, 5),
(21, 'Fritto', 6, 6),
(22, 'Vegano', 6, 7),
(23, 'Classica', 7, 5),
(24, 'EDM', 7, 6),
(25, 'k-pop (gay)', 7, 7),
(26, 'Gatto', 8, 5),
(27, 'Canguro', 8, 6),
(28, 'Cane', 8, 7),
(29, 'Parco', 9, 5),
(30, 'Libia', 9, 6),
(31, 'Ad un campo di concentramento', 9, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `risultati`
--

DROP TABLE IF EXISTS `risultati`;
CREATE TABLE `risultati` (
  `id` int(11) NOT NULL,
  `titolo` varchar(256) NOT NULL,
  `descrizione` varchar(256) NOT NULL,
  `id_quiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `risultati`
--

INSERT INTO `risultati` (`id`, `titolo`, `descrizione`, `id_quiz`) VALUES
(2, 'Sei un Beter!', 'Proprio cosi\', sei un vero e proprio Betere come tale ti piace molestare le mogli altrui ingerendo stomaci di bambini asiatici', 1),
(4, 'Sei un Dave!', 'Pelato', 1),
(5, 'Blu', 'I\'m blue da ba dee da ba daa Da ba dee da ba daa, da ba dee da ba daa, da ba dee da ba daa Da ba dee da ba daa, da ba dee da ba daa, da ba dee da ba daa', 3),
(6, 'Rosso', 'Bianco come il latte, Rosso come il sangue', 3),
(7, 'Verde', 'Povero', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`) VALUES
(3, 'admin', 'admin');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `domande`
--
ALTER TABLE `domande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domande_ibfk_1` (`id_quiz`);

--
-- Indici per le tabelle `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `risposte`
--
ALTER TABLE `risposte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vincolo` (`id_domanda`),
  ADD KEY `vincolo2` (`id_risultato`);

--
-- Indici per le tabelle `risultati`
--
ALTER TABLE `risultati`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risultati_ibfk_1` (`id_quiz`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `domande`
--
ALTER TABLE `domande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `risposte`
--
ALTER TABLE `risposte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la tabella `risultati`
--
ALTER TABLE `risultati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `domande`
--
ALTER TABLE `domande`
  ADD CONSTRAINT `domande_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `risposte`
--
ALTER TABLE `risposte`
  ADD CONSTRAINT `vincolo` FOREIGN KEY (`id_domanda`) REFERENCES `domande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vincolo2` FOREIGN KEY (`id_risultato`) REFERENCES `risultati` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `risultati`
--
ALTER TABLE `risultati`
  ADD CONSTRAINT `risultati_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
