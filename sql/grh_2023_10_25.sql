-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 25 oct. 2023 à 13:34
-- Version du serveur : 8.0.32
-- Version de PHP : 8.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grh`
--
CREATE DATABASE IF NOT EXISTS `grh` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `grh`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `adminid` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `mdpass` varchar(50) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`adminid`, `nom`, `prenom`, `ident`, `mdpass`, `estAdmin`) VALUES
(1, 'Sadmin', '', 'admin', 'admin', 1),
(2, 'Blanchard', 'Andrée', 'ablanchard', 'merguez', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `congeid` int NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `empid` int UNSIGNED NOT NULL,
  `typeid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`congeid`, `date_deb`, `date_fin`, `empid`, `typeid`) VALUES
(1, '2023-03-07', '2023-03-10', 1, 1),
(2, '2023-05-03', '2023-05-05', 1, 1),
(3, '2023-06-06', '2023-06-12', 1, 1),
(4, '2023-08-08', '2023-09-01', 1, 1),
(5, '2023-08-07', '2023-08-07', 1, 3),
(6, '2023-10-24', '2023-10-24', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `credit_ant`
--

CREATE TABLE `credit_ant` (
  `id` int NOT NULL,
  `temps` time DEFAULT NULL,
  `empid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `credit_ant`
--

INSERT INTO `credit_ant` (`id`, `temps`, `empid`) VALUES
(1, '02:20:00', 2),
(2, '01:15:00', 3),
(3, '00:00:00', 4);

-- --------------------------------------------------------

--
-- Structure de la table `demande_absence`
--

CREATE TABLE `demande_absence` (
  `demabsid` int NOT NULL,
  `date_dem` date NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `annee` year NOT NULL,
  `nb_j` int NOT NULL,
  `etat` varchar(50) NOT NULL,
  `empid` int UNSIGNED NOT NULL,
  `typeid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `demande_absence`
--

INSERT INTO `demande_absence` (`demabsid`, `date_dem`, `date_deb`, `date_fin`, `annee`, `nb_j`, `etat`, `empid`, `typeid`) VALUES
(4, '2023-02-22', '2023-03-07', '2023-03-10', 2023, 4, 'Acceptée', 1, 1),
(5, '2023-02-22', '2023-05-03', '2023-05-05', 2023, 3, 'Acceptée', 1, 1),
(6, '2023-02-22', '2023-06-06', '2023-06-12', 2023, 5, 'Acceptée', 1, 1),
(8, '2023-02-22', '2023-08-08', '2023-09-01', 2023, 18, 'Acceptée', 1, 1),
(12, '2023-04-21', '2023-05-02', '2023-05-09', 2023, 5, 'En attente', 5, 1),
(18, '2023-08-04', '2023-08-07', '2023-08-07', 2023, 1, 'Acceptée', 1, 3),
(19, '2023-10-23', '2023-10-24', '2023-10-24', 2023, 1, 'Acceptée', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `demande_pointage`
--

CREATE TABLE `demande_pointage` (
  `dempointid` int NOT NULL,
  `date` date NOT NULL,
  `ha` time NOT NULL,
  `pm1` time NOT NULL,
  `pm2` time NOT NULL,
  `hd` time NOT NULL,
  `etat` varchar(50) NOT NULL,
  `pointid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `demande_pointage`
--

INSERT INTO `demande_pointage` (`dempointid`, `date`, `ha`, `pm1`, `pm2`, `hd`, `etat`, `pointid`) VALUES
(1, '2022-11-10', '08:30:00', '11:55:00', '12:30:00', '17:58:00', 'Refusée', 1),
(2, '2023-04-05', '09:07:00', '11:56:00', '12:36:00', '17:30:00', 'En attente', 3);

-- --------------------------------------------------------

--
-- Structure de la table `droits_conges`
--

CREATE TABLE `droits_conges` (
  `droitsid` int UNSIGNED NOT NULL,
  `nb_jours` int UNSIGNED NOT NULL,
  `annee` year NOT NULL,
  `empid` int UNSIGNED NOT NULL,
  `typeid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `droits_conges`
--

INSERT INTO `droits_conges` (`droitsid`, `nb_jours`, `annee`, `empid`, `typeid`) VALUES
(1, 11, 2023, 1, 1),
(2, 15, 2023, 1, 2),
(3, 45, 2022, 2, 1),
(4, 15, 2022, 2, 2),
(5, 45, 2022, 3, 1),
(6, 15, 2022, 3, 2),
(7, 45, 2023, 4, 1),
(8, 15, 2023, 4, 2),
(9, 45, 2023, 5, 1),
(10, 15, 2023, 5, 2),
(11, 98, 2023, 1, 3),
(12, 100, 2023, 2, 3),
(13, 100, 2023, 3, 3),
(14, 100, 2023, 4, 3),
(15, 100, 2023, 5, 3),
(16, 45, 2023, 6, 1),
(17, 15, 2023, 6, 2),
(18, 100, 2023, 6, 3),
(19, 45, 2023, 7, 1),
(20, 15, 2023, 7, 2),
(21, 100, 2023, 7, 3);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `empid` int UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `mdpass` varchar(50) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `horid` int NOT NULL,
  `servid` int NOT NULL,
  `fonctid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`empid`, `nom`, `prenom`, `email`, `ident`, `mdpass`, `dateEmbauche`, `horid`, `servid`, `fonctid`) VALUES
(1, 'Blanca', 'Vincent', 'vinceblanca@gmail.com', 'vince', 'bitonio', '2022-11-10', 5, 2, 5),
(2, 'Coco', 'Laurent', 'lolococo@gmail.com', 'koko', 'koko', '2022-12-01', 5, 2, 2),
(3, 'Test', 'Alex', 'alex@yahoo.fr', 'test', 'test', '2022-12-01', 3, 2, 4),
(4, 'Vijeyalingam', 'Arvinth', 'arvinth.vijeyalingam@dgfip.finances.gouv.fr', 'arv', 'arv', '2023-01-19', 5, 2, 2),
(5, 'Blanchard', 'Andrée', 'andreeblanchard@gmail.com', 'andrée.blanchard', 'bienvenue', '2023-04-05', 5, 2, 7),
(6, 'Test Tt', 'Vince', 'vincett@gmail.com', 'vince.testtt', 'bienvenue', '2023-08-04', 5, 2, 1),
(7, 'Lottin', 'Jimmy', 'jlo@gmail.com', 'jimmy.lottin', 'jlo93', '2023-10-23', 5, 1, 6);

--
-- Déclencheurs `employe`
--
DELIMITER $$
CREATE TRIGGER `employe_ai` AFTER INSERT ON `employe` FOR EACH ROW INSERT INTO droits_conges (empid, annee, nb_jours, typeid) VALUES (NEW.empid, YEAR(NOW()), 45, 1), (NEW.empid, YEAR(NOW()), 15, 2), (NEW.empid, YEAR(NOW()), 100, 3)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE `fonction` (
  `fonctid` int NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `servid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`fonctid`, `libelle`, `servid`) VALUES
(1, 'Développeur', 2),
(2, 'Analyste', 2),
(3, 'Chef de projet', 2),
(4, 'Adm. réseau', 2),
(5, 'Adm. base de données', 2),
(6, 'Secrétaire', 1),
(7, 'Assistant RH', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mod_horaire`
--

CREATE TABLE `mod_horaire` (
  `horid` int NOT NULL,
  `hormod` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `mod_horaire`
--

INSERT INTO `mod_horaire` (`horid`, `hormod`) VALUES
(1, '07:00:00'),
(2, '07:14:00'),
(3, '07:30:00'),
(4, '07:36:00'),
(5, '07:42:00');

-- --------------------------------------------------------

--
-- Structure de la table `pointage`
--

CREATE TABLE `pointage` (
  `pointid` int NOT NULL,
  `pointdate` date NOT NULL,
  `h_arrivee` time NOT NULL,
  `h_mer1` time NOT NULL,
  `h_mer2` time NOT NULL,
  `h_depart` time NOT NULL,
  `empid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pointage`
--

INSERT INTO `pointage` (`pointid`, `pointdate`, `h_arrivee`, `h_mer1`, `h_mer2`, `h_depart`, `empid`) VALUES
(1, '2022-11-10', '08:30:00', '11:55:00', '12:30:00', '18:00:00', 1),
(2, '2022-11-02', '07:30:00', '11:55:00', '12:30:00', '18:00:00', 1),
(3, '2022-12-30', '09:07:00', '11:56:00', '12:36:00', '17:35:00', 1),
(4, '2023-04-21', '08:30:00', '12:30:00', '13:15:00', '17:12:00', 5),
(5, '2023-07-21', '08:10:00', '11:50:00', '12:30:00', '17:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `servid` int NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`servid`, `libelle`) VALUES
(1, 'Administratif'),
(2, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `type_conge`
--

CREATE TABLE `type_conge` (
  `id` int NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type_conge`
--

INSERT INTO `type_conge` (`id`, `libelle`) VALUES
(1, 'Congés'),
(2, 'Formation'),
(3, 'Télétravail');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `ident` (`ident`);

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`congeid`),
  ADD KEY `typeid` (`typeid`),
  ADD KEY `empid` (`empid`);

--
-- Index pour la table `credit_ant`
--
ALTER TABLE `credit_ant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empid` (`empid`);

--
-- Index pour la table `demande_absence`
--
ALTER TABLE `demande_absence`
  ADD PRIMARY KEY (`demabsid`),
  ADD KEY `empid` (`empid`),
  ADD KEY `typeid` (`typeid`);

--
-- Index pour la table `demande_pointage`
--
ALTER TABLE `demande_pointage`
  ADD PRIMARY KEY (`dempointid`),
  ADD KEY `pointid` (`pointid`);

--
-- Index pour la table `droits_conges`
--
ALTER TABLE `droits_conges`
  ADD PRIMARY KEY (`droitsid`),
  ADD KEY `empid` (`empid`),
  ADD KEY `typeid` (`typeid`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`empid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ident` (`ident`),
  ADD KEY `horid` (`horid`),
  ADD KEY `servid` (`servid`),
  ADD KEY `fonctid` (`fonctid`);

--
-- Index pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`fonctid`),
  ADD KEY `servid` (`servid`);

--
-- Index pour la table `mod_horaire`
--
ALTER TABLE `mod_horaire`
  ADD PRIMARY KEY (`horid`);

--
-- Index pour la table `pointage`
--
ALTER TABLE `pointage`
  ADD PRIMARY KEY (`pointid`),
  ADD KEY `empid` (`empid`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`servid`);

--
-- Index pour la table `type_conge`
--
ALTER TABLE `type_conge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `congeid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `credit_ant`
--
ALTER TABLE `credit_ant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `demande_absence`
--
ALTER TABLE `demande_absence`
  MODIFY `demabsid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `demande_pointage`
--
ALTER TABLE `demande_pointage`
  MODIFY `dempointid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `droits_conges`
--
ALTER TABLE `droits_conges`
  MODIFY `droitsid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `empid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `fonctid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `mod_horaire`
--
ALTER TABLE `mod_horaire`
  MODIFY `horid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pointage`
--
ALTER TABLE `pointage`
  MODIFY `pointid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `servid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_conge`
--
ALTER TABLE `type_conge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`),
  ADD CONSTRAINT `conges_ibfk_2` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE;

--
-- Contraintes pour la table `credit_ant`
--
ALTER TABLE `credit_ant`
  ADD CONSTRAINT `credit_ant_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`);

--
-- Contraintes pour la table `demande_absence`
--
ALTER TABLE `demande_absence`
  ADD CONSTRAINT `demande_absence_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE,
  ADD CONSTRAINT `demande_absence_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`);

--
-- Contraintes pour la table `demande_pointage`
--
ALTER TABLE `demande_pointage`
  ADD CONSTRAINT `demande_pointage_ibfk_1` FOREIGN KEY (`pointid`) REFERENCES `pointage` (`pointid`) ON DELETE CASCADE;

--
-- Contraintes pour la table `droits_conges`
--
ALTER TABLE `droits_conges`
  ADD CONSTRAINT `droits_conges_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE,
  ADD CONSTRAINT `droits_conges_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`);

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`horid`) REFERENCES `mod_horaire` (`horid`),
  ADD CONSTRAINT `employe_ibfk_2` FOREIGN KEY (`servid`) REFERENCES `service` (`servid`),
  ADD CONSTRAINT `employe_ibfk_3` FOREIGN KEY (`fonctid`) REFERENCES `fonction` (`fonctid`);

--
-- Contraintes pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD CONSTRAINT `fonction_ibfk_1` FOREIGN KEY (`servid`) REFERENCES `service` (`servid`);

--
-- Contraintes pour la table `pointage`
--
ALTER TABLE `pointage`
  ADD CONSTRAINT `pointage_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
