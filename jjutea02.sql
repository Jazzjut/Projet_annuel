-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 12 jan. 2024 à 21:03
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
-- Base de données : `jjutea02`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `adminID` int NOT NULL,
  `pseudoA` int NOT NULL,
  `nomA` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `prenomA` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mailA` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `telA` int NOT NULL,
  `mdpA` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dateNA` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `clientID` int NOT NULL,
  `pseudoC` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nomC` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `prenomC` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mailC` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `telC` int NOT NULL,
  `mdpC` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `adresseC` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `code_postalC` int NOT NULL,
  `villeC` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dateNC` int NOT NULL,
  `factureID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Facture`
--

CREATE TABLE `Facture` (
  `FactureID` int NOT NULL,
  `NomF` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `PrenomF` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Ncarte` int NOT NULL,
  `Dateexp` int NOT NULL,
  `CodeV` int NOT NULL,
  `clienteID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FormA`
--

CREATE TABLE `FormA` (
  `formAID` int NOT NULL,
  `dateA` int NOT NULL,
  `raisonA` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `enf` int NOT NULL,
  `nbh` int NOT NULL,
  `ext` varchar(3) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `etatA` enum('en cours de traitement','adopté','adoption refusé','envoyé') COLLATE latin1_general_ci NOT NULL,
  `clientID` int NOT NULL,
  `adminID` int NOT NULL,
  `petID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FormR`
--

CREATE TABLE `FormR` (
  `formRID` int NOT NULL,
  `dateR` int NOT NULL,
  `raisonR` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `etatR` enum('en cours de traitement','adopté','adoption refusé','proposition envoyé') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `clientID` int NOT NULL,
  `petID` int NOT NULL,
  `adminID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Localisation`
--

CREATE TABLE `Localisation` (
  `numsociale` int NOT NULL,
  `telL` int NOT NULL,
  `villeL` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `adresseL` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `code_postaleL` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Pet`
--

CREATE TABLE `Pet` (
  `petID` int NOT NULL,
  `prenomP` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `especes` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `sexeP` tinyint(1) NOT NULL,
  `locaP` int NOT NULL,
  `races` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dateNP` int NOT NULL,
  `etatP` enum('en cours de traitement','adopté','à adopter') COLLATE latin1_general_ci NOT NULL,
  `formAID` int DEFAULT NULL,
  `formRID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `RDV`
--

CREATE TABLE `RDV` (
  `numRDV` int NOT NULL,
  `dateRDV` int NOT NULL,
  `formAID` int NOT NULL,
  `formRID` int NOT NULL,
  `numsociale` int NOT NULL,
  `adminID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `pseudoA` (`pseudoA`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`clientID`),
  ADD KEY `pseudoC` (`pseudoC`),
  ADD KEY `factureID` (`factureID`);

--
-- Index pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD PRIMARY KEY (`FactureID`),
  ADD KEY `clienteID` (`clienteID`);

--
-- Index pour la table `FormA`
--
ALTER TABLE `FormA`
  ADD PRIMARY KEY (`formAID`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `petID` (`petID`);

--
-- Index pour la table `FormR`
--
ALTER TABLE `FormR`
  ADD PRIMARY KEY (`formRID`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `petID` (`petID`),
  ADD KEY `adminID` (`adminID`);

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
  ADD KEY `formAID` (`formAID`),
  ADD KEY `formRID` (`formRID`);

--
-- Index pour la table `RDV`
--
ALTER TABLE `RDV`
  ADD PRIMARY KEY (`numRDV`),
  ADD KEY `formAID` (`formAID`),
  ADD KEY `formRID` (`formRID`),
  ADD KEY `numsociale` (`numsociale`),
  ADD KEY `adminID` (`adminID`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Client`
--
ALTER TABLE `Client`
  ADD CONSTRAINT `Client_ibfk_1` FOREIGN KEY (`factureID`) REFERENCES `Facture` (`FactureID`);

--
-- Contraintes pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD CONSTRAINT `Facture_ibfk_1` FOREIGN KEY (`clienteID`) REFERENCES `Client` (`clientID`);

--
-- Contraintes pour la table `FormA`
--
ALTER TABLE `FormA`
  ADD CONSTRAINT `FormA_ibfk_2` FOREIGN KEY (`adminID`) REFERENCES `Admin` (`adminID`),
  ADD CONSTRAINT `FormA_ibfk_3` FOREIGN KEY (`petID`) REFERENCES `Pet` (`petID`),
  ADD CONSTRAINT `FormA_ibfk_4` FOREIGN KEY (`clientID`) REFERENCES `Client` (`clientID`);

--
-- Contraintes pour la table `FormR`
--
ALTER TABLE `FormR`
  ADD CONSTRAINT `FormR_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `Admin` (`adminID`),
  ADD CONSTRAINT `FormR_ibfk_2` FOREIGN KEY (`petID`) REFERENCES `Pet` (`petID`),
  ADD CONSTRAINT `FormR_ibfk_3` FOREIGN KEY (`clientID`) REFERENCES `Client` (`clientID`);

--
-- Contraintes pour la table `Pet`
--
ALTER TABLE `Pet`
  ADD CONSTRAINT `Pet_ibfk_1` FOREIGN KEY (`formAID`) REFERENCES `FormA` (`formAID`),
  ADD CONSTRAINT `Pet_ibfk_2` FOREIGN KEY (`formRID`) REFERENCES `FormR` (`formRID`);

--
-- Contraintes pour la table `RDV`
--
ALTER TABLE `RDV`
  ADD CONSTRAINT `RDV_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `Admin` (`adminID`),
  ADD CONSTRAINT `RDV_ibfk_2` FOREIGN KEY (`numsociale`) REFERENCES `Localisation` (`numsociale`),
  ADD CONSTRAINT `RDV_ibfk_3` FOREIGN KEY (`formAID`) REFERENCES `FormA` (`formAID`),
  ADD CONSTRAINT `RDV_ibfk_4` FOREIGN KEY (`formRID`) REFERENCES `FormR` (`formRID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
