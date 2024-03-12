-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 mars 2024 à 10:45
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetgaspillage`
--

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

DROP TABLE IF EXISTS `aime`;
CREATE TABLE IF NOT EXISTS `aime` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_utilisateur` int NOT NULL,
  `ID_recette` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`),
  UNIQUE KEY `ID_recette` (`ID_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `titre_com` varchar(255) NOT NULL,
  `contenu_com` varchar(255) NOT NULL,
  `ID_utilisateur` int NOT NULL,
  `recette` varchar(255) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  `url_video` varchar(255) NOT NULL,
  `ID_recette` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_recette` (`ID_recette`),
  UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom_ingredient` varchar(255) NOT NULL,
  `ID_recette` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_recette` (`ID_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_utilisateur` int NOT NULL,
  `nom_recette` varchar(255) NOT NULL,
  `etape` text NOT NULL,
  `temps_preparation` int NOT NULL,
  `temps_cuisson` int NOT NULL,
  `difficulte` int NOT NULL,
  `quantite` int NOT NULL,
  `ID_aime` int NOT NULL,
  `ID_ingredient` int NOT NULL,
  `ID_commentaire` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_ingredient` (`ID_ingredient`),
  UNIQUE KEY `ID_commentaire` (`ID_commentaire`),
  UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`),
  UNIQUE KEY `ID_aime` (`ID_aime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom_du_role` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ID_role` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_role` (`ID_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aime`
--
ALTER TABLE `aime`
  ADD CONSTRAINT `aime_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `aime_ibfk_2` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `recette_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `recette_ibfk_2` FOREIGN KEY (`ID_aime`) REFERENCES `aime` (`ID`),
  ADD CONSTRAINT `recette_ibfk_3` FOREIGN KEY (`ID_ingredient`) REFERENCES `ingredient` (`ID`),
  ADD CONSTRAINT `recette_ibfk_4` FOREIGN KEY (`ID_commentaire`) REFERENCES `commentaire` (`ID`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_role`) REFERENCES `role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
