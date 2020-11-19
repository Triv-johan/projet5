-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 19 nov. 2020 à 13:03
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `immeuble`
--

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etage` varchar(255) NOT NULL,
  `mission` varchar(255) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id`, `etage`, `mission`, `debut`, `fin`) VALUES
(7, '1', 'groupe chauffe eau', '2020-11-16', '2020-11-17'),
(6, '9', 'changements baes', '2020-11-06', '2020-11-07'),
(9, '3', ' reglages du groom', '2020-11-03', '2020-11-04'),
(18, '4', 'toilettes', '2020-11-10', '2020-11-11'),
(12, '8', 'Nettoyage vmc', '2020-11-02', '2020-11-09'),
(13, '4', 'changement neon', '2020-10-28', '2020-10-29'),
(19, '1', 'cage d\'escalier ', '2020-11-03', '2020-11-06'),
(20, '10', 'store', '2020-11-03', '2020-11-10'),
(21, 'rez-de-chaussez', 'garage', '2020-11-05', '2020-11-12'),
(22, '8', 'joint', '2020-11-04', '2020-11-05'),
(23, '5', 'porte', '2020-11-04', '2020-11-05'),
(24, '6', 'poigner', '2020-11-03', '2020-11-05'),
(25, '11', 'toiture', '2020-10-29', '2020-11-04');

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `registration`
--

INSERT INTO `registration` (`id`, `username`, `email`, `password`) VALUES
(1, 'concierge', 'concierge@concierge.concierge', 'concierge'),
(2, 'concierge', 'concierge@concierge.fr', 'cbe370481704cef068c18bdcbe262329c59824d6c87e96510a53f022e899ab04'),
(3, 'johan', 'johan@johan.fr', 'd9a31550033ee07d6e14302eea8202c07c266b633154513d817ca8bb91de40d1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
