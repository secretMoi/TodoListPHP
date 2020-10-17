-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 17 oct. 2020 à 18:27
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `todo`
--

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDPers` int(11) DEFAULT NULL,
  `IDTodo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDPers` (`IDPers`),
  KEY `IDTodo` (`IDTodo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `gerer`
--

INSERT INTO `gerer` (`ID`, `IDPers`, `IDTodo`) VALUES
(1, 7, 1),
(2, 7, 1),
(3, 7, 1),
(4, 7, 1),
(5, 7, 1),
(6, 7, 1),
(7, 7, 1),
(8, 7, 1),
(15, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

DROP TABLE IF EXISTS `personnes`;
CREATE TABLE IF NOT EXISTS `personnes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) DEFAULT NULL,
  `Prenom` varchar(30) DEFAULT NULL,
  `AdresseMail` varchar(100) DEFAULT NULL,
  `MotDePasse` char(64) DEFAULT NULL,
  `Role` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Role`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personnes`
--

INSERT INTO `personnes` (`ID`, `Nom`, `Prenom`, `AdresseMail`, `MotDePasse`, `Role`) VALUES
(1, ':Nom', ':Prenom', NULL, NULL, NULL),
(3, 'a', 'az', NULL, NULL, NULL),
(4, 'a', 'az', NULL, NULL, NULL),
(5, 'a', 'az', NULL, NULL, NULL),
(6, 'a', 'az', NULL, NULL, NULL),
(7, 'a', 'az', NULL, NULL, NULL),
(8, 'Damsin', 'SÃ©bastien', 'sebastien.damsin@gmail.com', 'c17ba3d5612012c16e80303eeba85f27494a9832660dd595db60184360267308', 2),
(9, 'Struys', 'Magali', 'magali@mail.be', 'e44b718114d335340b3224d4f73f9a1313d480b2b6cb75630b81eef6241cf6dc', 2),
(10, 'Liege', 'Philippe', 'phil@mail.be', 'f50f9b89c88ec82d836191fd523bdd9aba94fb51c92e2013cb6e9910f5ea47c4', 2),
(11, 'test', 'test', 'test@mail.be', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`ID`, `Nom`) VALUES
(1, 'Staff'),
(2, 'Client'),
(3, 'Travailleur');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`ID`, `Nom`) VALUES
(1, 'Terminée'),
(2, 'En cours'),
(4, 'Urgent');

-- --------------------------------------------------------

--
-- Structure de la table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(30) DEFAULT NULL,
  `DateCreation` datetime DEFAULT NULL,
  `DateModif` datetime DEFAULT NULL,
  `Contenu` varchar(100) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `todo`
--

INSERT INTO `todo` (`ID`, `Titre`, `DateCreation`, `DateModif`, `Contenu`, `Status`) VALUES
(1, 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'z', 1),
(2, 'Pour Quentin', '2020-10-17 18:23:53', '2020-10-17 18:23:53', 'Jouer avec Goku', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`IDPers`) REFERENCES `personnes` (`ID`),
  ADD CONSTRAINT `gerer_ibfk_2` FOREIGN KEY (`IDTodo`) REFERENCES `todo` (`ID`);

--
-- Contraintes pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD CONSTRAINT `personnes_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `role` (`ID`);

--
-- Contraintes pour la table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`Status`) REFERENCES `status` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
