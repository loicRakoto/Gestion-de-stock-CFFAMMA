-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 août 2022 à 19:18
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cffamma`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `Num_cli` int(15) NOT NULL AUTO_INCREMENT,
  `Nom_cli` varchar(50) NOT NULL,
  `Prenom_cli` varchar(30) NOT NULL,
  `CIN_cli` varchar(20) NOT NULL,
  `Tel_cli` varchar(20) NOT NULL,
  PRIMARY KEY (`Num_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Num_cli`, `Nom_cli`, `Prenom_cli`, `CIN_cli`, `Tel_cli`) VALUES
(27, 'RAKOTOMANDIMBY', 'Loic', '454272821421', '0348764275'),
(29, 'RAHERIMIHAMINTSOA', 'Lovatiana', '826265395586', '0349842684'),
(30, 'RASOLOFONIRINA', 'Tolojanahary', '451855562585', '0348765235'),
(31, 'RAMANANTSOA', 'Patrici', '722876454545', '0348944373'),
(32, 'RAHERIMIHAMINTSOA', 'Annita', '123456789147', '0340137596'),
(33, 'HERITIANA', 'Hery', '724243543888', '0348234645'),
(35, 'RAKOTONANDRASANA', 'Lucas', '785462568425', '0348734656'),
(36, 'RAZAFINANTOANINA', 'Koto', '484153165186', '0342575484');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Num_com` int(20) NOT NULL AUTO_INCREMENT,
  `Id_mat` varchar(15) NOT NULL,
  `Num_cli` int(15) NOT NULL,
  `Date_com` datetime NOT NULL,
  PRIMARY KEY (`Num_com`,`Id_mat`,`Num_cli`),
  KEY `Id_prod` (`Id_mat`,`Num_cli`),
  KEY `Num_cli` (`Num_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Num_com`, `Id_mat`, `Num_cli`, `Date_com`) VALUES
(14, 'ANG1', 29, '2022-07-31 11:18:00'),
(15, 'ANG2', 29, '2022-07-31 11:18:00'),
(16, 'ANG3', 29, '2022-07-31 11:18:00'),
(17, 'HAM1', 29, '2022-07-31 11:18:00'),
(23, 'ANG5', 33, '2022-08-29 08:09:00'),
(24, 'CHA1', 35, '2022-08-30 03:08:00'),
(25, 'ANG6', 29, '2022-08-30 03:22:00');

-- --------------------------------------------------------

--
-- Structure de la table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `Id_mat` varchar(15) NOT NULL,
  `Type_mat` varchar(30) NOT NULL,
  `Num_speciale` varchar(30) NOT NULL,
  `Validation_mat` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_mat`),
  UNIQUE KEY `Id_prod` (`Id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `info`
--

INSERT INTO `info` (`Id_mat`, `Type_mat`, `Num_speciale`, `Validation_mat`) VALUES
('ANG1', 'SORTIE', 'BL-8745', 'VALIDER'),
('ANG2', 'SORTIE', 'BL-8745', 'VALIDER'),
('ANG3', 'SORTIE', 'BL-8745', 'VALIDER'),
('ANG4', 'ENTREE', 'NULL', 'NON VALIDER'),
('ANG5', 'EN COURS', 'NULL', 'ATTENTE'),
('ANG6', 'EN COURS', 'NULL', 'ATTENTE'),
('CHA1', 'EN COURS', 'NULL', 'ATTENTE'),
('CHA2', 'ENTREE', 'NULL', 'NON VALIDER'),
('HAM1', 'SORTIE', 'BL-8745', 'VALIDER'),
('HAM2', 'ENTREE', 'NULL', 'NON VALIDER');

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `Id_mat` varchar(15) NOT NULL,
  `Des_mat` varchar(30) NOT NULL,
  `Prix_mat` int(20) NOT NULL,
  PRIMARY KEY (`Id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`Id_mat`, `Des_mat`, `Prix_mat`) VALUES
('ANG1', 'ANGADY', 800),
('ANG2', 'ANGADY', 800),
('ANG3', 'ANGADY', 800),
('ANG4', 'ANGADY', 800),
('ANG5', 'ANGADY', 800),
('ANG6', 'ANGADY', 800),
('CHA1', 'CHARRUE', 80000),
('CHA2', 'CHARRUE', 80000),
('HAM1', 'HAMECON', 1000),
('HAM2', 'HAMECON', 1000);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Id_user` int(30) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id_user`, `Username`, `Pass`) VALUES
(1, 'loic', 'loic'),
(5, 'lova', 'lova'),
(6, 'Millie', 'oih'),
(7, 'Mireille', 'mi'),
(8, 'Johns', 'jo');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`Num_cli`) REFERENCES `client` (`Num_cli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`Id_mat`) REFERENCES `materiel` (`Id_mat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`Id_mat`) REFERENCES `materiel` (`Id_mat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
