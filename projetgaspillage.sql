-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 13 mars 2024 à 12:48
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `racook`
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
  `ID_recette` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_recette` (`ID_recette`),
  UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`ID`, `titre_com`, `contenu_com`, `ID_utilisateur`, `ID_recette`) VALUES
(1, 'Super bon !!!!!!', 'Très rapide à faire.', 11, 4);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom_ingredient` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`ID`, `nom_ingredient`) VALUES
(1, 'Tomate'),
(2, 'Mozza');

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
  `url_recette` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`ID`, `ID_utilisateur`, `nom_recette`, `etape`, `temps_preparation`, `temps_cuisson`, `difficulte`, `quantite`, `url_recette`) VALUES
(4, 10, 'gratin de courgette', 'faire ça :\r\nensuite :', 1, 2, 3, 6, 'https://th.bing.com/th/id/OSK.7a6e97e2075a4545399cdba837b0f56b?pid=ImgDet&w=100&h=100&c=7&dpr=1,3');

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingredient`
--

DROP TABLE IF EXISTS `recette_ingredient`;
CREATE TABLE IF NOT EXISTS `recette_ingredient` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_recette` int NOT NULL,
  `ID_ingredient` int NOT NULL,
  `quantite` int NOT NULL,
  `unite` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_recette` (`ID_recette`),
  KEY `ID_ingredient` (`ID_ingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recette_ingredient`
--

INSERT INTO `recette_ingredient` (`ID`, `ID_recette`, `ID_ingredient`, `quantite`, `unite`) VALUES
(1, 4, 1, 4, ''),
(2, 4, 2, 250, 'g');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom_du_role` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`ID`, `nom_du_role`) VALUES
(3, 'administrateur'),
(4, 'utilisateur');

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
  KEY `ID_role` (`ID_role`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `prenom`, `nom`, `age`, `username`, `email`, `password`, `ID_role`) VALUES
(10, 'antoine', 'gobbe', 20, 'antoineg', 'antoine@gmail.com', 'antoine', 4),
(11, 'tayib', 'bzr', 22, 'tayibbzr', 'tayib@gmail.com', 'tayib', 4);

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
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `recette_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`);

--
-- Contraintes pour la table `recette_ingredient`
--
ALTER TABLE `recette_ingredient`
  ADD CONSTRAINT `recette_ingredient_ibfk_1` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID`),
  ADD CONSTRAINT `recette_ingredient_ibfk_2` FOREIGN KEY (`ID_ingredient`) REFERENCES `ingredient` (`ID`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_role`) REFERENCES `role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
