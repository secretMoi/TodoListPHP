
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2020 at 02:50 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `IDPers` int DEFAULT NULL,
  `IDTodo` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDPers` (`IDPers`),
  KEY `IDTodo` (`IDTodo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gerer`
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
-- Table structure for table `personnes`
--

DROP TABLE IF EXISTS `personnes`;
CREATE TABLE IF NOT EXISTS `personnes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) DEFAULT NULL,
  `Prenom` varchar(30) DEFAULT NULL,
  `AdresseMail` varchar(100) DEFAULT NULL,
  `MotDePasse` char(64) DEFAULT NULL,
  `Role` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Role`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personnes`
--

INSERT INTO `personnes` (`ID`, `Nom`, `Prenom`, `AdresseMail`, `MotDePasse`, `Role`) VALUES
(1, ':Nom', ':Prenom', NULL, NULL, NULL),
(3, 'a', 'az', NULL, NULL, NULL),
(4, 'a', 'az', NULL, NULL, NULL),
(5, 'a', 'az', NULL, NULL, NULL),
(6, 'a', 'az', NULL, NULL, NULL),
(7, 'a', 'az', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `Nom`) VALUES
(1, 'Staff'),
(2, 'Client'),
(3, 'Travailleur');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `Nom`) VALUES
(1, 'Terminée'),
(2, 'En cours'),
(4, 'Urgent');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(30) DEFAULT NULL,
  `DateCreation` datetime DEFAULT NULL,
  `DateModif` datetime DEFAULT NULL,
  `Contenu` varchar(100) DEFAULT NULL,
  `Status` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`ID`, `Titre`, `DateCreation`, `DateModif`, `Contenu`, `Status`) VALUES
(1, 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'z', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`IDPers`) REFERENCES `personnes` (`ID`),
  ADD CONSTRAINT `gerer_ibfk_2` FOREIGN KEY (`IDTodo`) REFERENCES `todo` (`ID`);

--
-- Constraints for table `personnes`
--
ALTER TABLE `personnes`
  ADD CONSTRAINT `personnes_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `role` (`ID`);

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`Status`) REFERENCES `status` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
