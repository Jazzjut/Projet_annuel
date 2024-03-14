-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 14 mars 2024 à 17:54
-- Version du serveur : 8.0.27
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `flempere`
--

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `mailC` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `pseudoC` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nomC` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `prenomC` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `telC` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mdpC` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `factureID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Facture`
--

CREATE TABLE `Facture` (
  `factureID` int NOT NULL,
  `ncarte` int DEFAULT NULL,
  `dateExp` date DEFAULT NULL,
  `codeV` int DEFAULT NULL,
  `montant` int DEFAULT NULL,
  `dateDon` date DEFAULT NULL,
  `mailC` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FormDemandeA`
--

CREATE TABLE `FormDemandeA` (
  `formDemandeAID` int NOT NULL,
  `dateDemandeA` date NOT NULL,
  `raisonDemandeA` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nbEnf` int NOT NULL,
  `nbHSeul` int NOT NULL,
  `ext` bit(1) NOT NULL,
  `etatDemandeA` enum('en cours de traitement','adopté','adoption refusé','envoyé') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mailC` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `petID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FormMiseA`
--

CREATE TABLE `FormMiseA` (
  `formMiseAID` int NOT NULL,
  `dateMiseA` date NOT NULL,
  `raisonMiseA` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `etatMiseA` enum('en cours de traitement','adopté','adoption refusé','proposition envoyé') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mailC` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `petID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Localisation`
--

CREATE TABLE `Localisation` (
  `numsociale` int NOT NULL,
  `telL` int NOT NULL,
  `villeL` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Pet`
--

CREATE TABLE `Pet` (
  `petID` int NOT NULL,
  `prenomP` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `espece` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `sexeP` tinyint(1) NOT NULL,
  `locaP` int NOT NULL,
  `race` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dateNP` date NOT NULL,
  `etatP` enum('en cours de traitement','adopté','à adopter') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `formDemandeAID` int DEFAULT NULL,
  `formMiseAID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `RDV`
--

CREATE TABLE `RDV` (
  `numRDV` int NOT NULL,
  `dateRDV` int NOT NULL,
  `formDemandeAID` int NOT NULL,
  `formMiseAID` int NOT NULL,
  `numsociale` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`mailC`),
  ADD UNIQUE KEY `pseudoC` (`pseudoC`),
  ADD KEY `client_FK1` (`factureID`);

--
-- Index pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD PRIMARY KEY (`factureID`),
  ADD KEY `facture_FK1` (`mailC`);

--
-- Index pour la table `FormDemandeA`
--
ALTER TABLE `FormDemandeA`
  ADD PRIMARY KEY (`formDemandeAID`),
  ADD KEY `formdemandea_FK1` (`mailC`),
  ADD KEY `formdemandea_FK2` (`petID`);

--
-- Index pour la table `FormMiseA`
--
ALTER TABLE `FormMiseA`
  ADD PRIMARY KEY (`formMiseAID`),
  ADD KEY `formmisea_FK1` (`mailC`),
  ADD KEY `formmisea_FK2` (`petID`);

--
-- Index pour la table `Localisation`
--
ALTER TABLE `Localisation`
  ADD PRIMARY KEY (`numsociale`);

--
-- Index pour la table `Pet`
--
ALTER TABLE `Pet`
  ADD PRIMARY KEY (`petID`),
  ADD KEY `pet_FK1` (`formDemandeAID`),
  ADD KEY `pet_FK2` (`formMiseAID`);

--
-- Index pour la table `RDV`
--
ALTER TABLE `RDV`
  ADD PRIMARY KEY (`numRDV`),
  ADD KEY `rdv_FK1` (`formDemandeAID`),
  ADD KEY `rdv_FK2` (`formMiseAID`),
  ADD KEY `rdv_FK3` (`numsociale`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Client`
--
ALTER TABLE `Client`
  ADD CONSTRAINT `client_FK1` FOREIGN KEY (`factureID`) REFERENCES `Facture` (`factureID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD CONSTRAINT `facture_FK1` FOREIGN KEY (`mailC`) REFERENCES `Client` (`mailC`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `FormDemandeA`
--
ALTER TABLE `FormDemandeA`
  ADD CONSTRAINT `formdemandea_FK1` FOREIGN KEY (`mailC`) REFERENCES `Client` (`mailC`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `formdemandea_FK2` FOREIGN KEY (`petID`) REFERENCES `Pet` (`petID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `FormMiseA`
--
ALTER TABLE `FormMiseA`
  ADD CONSTRAINT `formmisea_FK1` FOREIGN KEY (`mailC`) REFERENCES `Client` (`mailC`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `formmisea_FK2` FOREIGN KEY (`petID`) REFERENCES `Pet` (`petID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `Pet`
--
ALTER TABLE `Pet`
  ADD CONSTRAINT `pet_FK1` FOREIGN KEY (`formDemandeAID`) REFERENCES `FormDemandeA` (`formDemandeAID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pet_FK2` FOREIGN KEY (`formMiseAID`) REFERENCES `FormMiseA` (`formMiseAID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `RDV`
--
ALTER TABLE `RDV`
  ADD CONSTRAINT `rdv_FK1` FOREIGN KEY (`formDemandeAID`) REFERENCES `FormDemandeA` (`formDemandeAID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rdv_FK2` FOREIGN KEY (`formMiseAID`) REFERENCES `FormMiseA` (`formMiseAID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rdv_FK3` FOREIGN KEY (`numsociale`) REFERENCES `Localisation` (`numsociale`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
