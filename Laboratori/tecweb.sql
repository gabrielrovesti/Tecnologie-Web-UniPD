-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Dic 15, 2022 alle 10:16
-- Versione del server: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- Versione PHP: 8.1.2-1ubuntu2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gaggi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `giocatori`
--

CREATE TABLE `giocatori` (
  `ID` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `capitano` int(11) NOT NULL,
  `dataNascita` varchar(100) NOT NULL,
  `luogo` varchar(100) NOT NULL,
  `squadra` varchar(100) NOT NULL,
  `ruolo` varchar(100) NOT NULL,
  `altezza` int(11) NOT NULL,
  `maglia` int(11) NOT NULL,
  `magliaNazionale` int(11) NOT NULL,
  `punti` int(11) NOT NULL,
  `riconoscimenti` longtext DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `immagine` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dump dei dati per la tabella `giocatori`
--

INSERT INTO `giocatori` (`ID`, `nome`, `capitano`, `dataNascita`, `luogo`, `squadra`, `ruolo`, `altezza`, `maglia`, `magliaNazionale`, `punti`, `riconoscimenti`, `note`, `immagine`) VALUES
(1, 'Simone Giannelli', 1, '09/8/1996', 'Bolzano', '<span lang=\"en\">Sir Safety</span> Susa Perugia', 'Palleggiatore', 200, 6, 6, 872, '<ul>             <li>Nelle stagioni 2014/15, 2015/16, 2016/17 vince il premio \"G. Badiali\" (miglior U23 italiano della SuperLega)</li>\n            <li>Miglior palleggiatore agli Europei 2015</li>\n            <li>Miglior palleggiatore alla <span lang=\"en\">World League</span> 2016</li>\n            <li><abbr title=\"Most Valuable Player\" lang=\"en\">MVP</abbr> Europei 2021</li>\n            <li>Miglior palleggiatore e <abbr title=\"Most Valuable Player\" lang=\"en\">MVP</abbr> ai Mondiali 2022</li>\n          </ul>', 'Ha fatto parte della squadra “Itas Trentino” fino alla stagione 2020/21 e giocava con la maglia 9', '../images/giannelli.jpg'),
(2, 'Riccardo Sbertoli', 0, '23/05/1998', 'Milano', 'Itas Trentino', 'Palleggiatore', 190, 6, 8, 393, '', 'Ha fatto parte della squadra “Allianz Milano” fino alla stagione 2020/21', '../images/sbertoli.jpg'),
(3, 'Fabio Balaso', 0, '20/10/1995', 'Camposampiero (PD)', 'Cucine Lube Civitanova', 'Libero', 178, 7, 7, 1606, '<ul>\n            <li>Nel 2013/14 vince il premio \"G. Badiali\" (miglior U23 Italiano della Serie A2)</li>\n            <li>Miglior libero ai Mondiali 2022</li>\n          </ul>', '', '../images/balaso.jpg'),
(4, 'Leonardo Scanferla', 0, '04/12/1998', 'Padova', '<span lang=\"en\">Gas Sales Bluenergy</span> Piacenza', 'Libero', 184, 10, 24, 623, '', '', '../images/scanferla.jpg'),
(5, 'Simone Anzani', 0, '24/02/1992', 'Como', 'Cucine Lube Civitanova', 'Centrale', 203, 17, 17, 2276, '', '', '../images/anzani.jpg'),
(6, 'Gianluca Galassi', 0, '24/07/1997', 'Trento', 'Vero Volley Monza', 'Centrale', 201, 11, 14, 1144, '<ul>\n            <li>Miglior centrale ai Mondiali 2022</li>\n          </ul>', '', '../images/galassi.jpg'),
(7, 'Alessandro Michieletto', 0, '05/12/2001', 'Desenzano del Garda (BS)', 'Itas Trentino', 'Schiacciatore', 211, 5, 5, 960, '', '', '../images/michieletto.jpg'),
(8, 'Daniele Lavia', 0, '04/11/1999', 'Cariati (CS)', 'Itas Trentino', 'Schiacciatore', 200, 15, 15, 1604, '<ul>\n            <li>Premio Badiali 2020 (Miglior Under 23 di SuperLega)</li>\n            <li>Premio Badiali 2018 (Miglior Under 23 di Serie A2)</li>\n            <li>Miglior giocatore Junior League (2018)</li>\n            <li>Miglior schiacciatore del Trofeo delle Regioni (2015)</li>\n            <li>Miglior schiacciatore Mondiale Under 21 (2019)</li>\n          </ul>', '', '../images/lavia.jpg'),
(9, 'Yuri Romanò', 0, '26/07/1997', 'Monza', '<span lang=\"en\">Gas Sales Bluenergy</span> Piacenza', 'Schiacciatore', 203, 17, 16, 1865, '', '', '../images/galassi.jpg');
--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `giocatori`
--
ALTER TABLE `giocatori`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `giocatori`
--
ALTER TABLE `giocatori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
