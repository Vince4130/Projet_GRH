-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 03, 2022 at 09:02 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `mdpass` varchar(50) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `nom`, `ident`, `mdpass`, `estAdmin`) VALUES
(1, 'Sadmin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conges`
--

CREATE TABLE `conges` (
  `congeid` int(11) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `empid` int(10) UNSIGNED NOT NULL,
  `typeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conges`
--



-- --------------------------------------------------------

--
-- Table structure for table `demande_absence`
--

CREATE TABLE `demande_absence` (
  `demabsid` int(11) NOT NULL,
  `empid` int(10) UNSIGNED NOT NULL,
  `typeid` int(11) NOT NULL,
  `date_dem` date NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `annee` year(4) NOT NULL,
  `nb_j` int(11) NOT NULL,
  `etat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `demande_absence`
--



-- --------------------------------------------------------

--
-- Table structure for table `demande_pointage`
--

CREATE TABLE `demande_pointage` (
  `dempointid` int(11) NOT NULL,
  `pointid` int(11) NOT NULL,
  `date` date NOT NULL,
  `ha` time NOT NULL,
  `pm1` time NOT NULL,
  `pm2` time NOT NULL,
  `hd` time NOT NULL,
  `etat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `demande_pointage`
--


-- --------------------------------------------------------

--
-- Table structure for table `droits_conges`
--

CREATE TABLE `droits_conges` (
  `droitsid` int(10) UNSIGNED NOT NULL,
  `nb_jours` int(10) UNSIGNED NOT NULL,
  `annee` year(4) NOT NULL,
  `empid` int(10) UNSIGNED NOT NULL,
  `typeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `droits_conges`
--



-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `empid` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ident` varchar(50) NOT NULL,
  `mdpass` varchar(50) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `horid` int(11) NOT NULL,
  `servid` int(11) NOT NULL,
  `fonctid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employe`
--


--
-- Triggers `employe`
--
DELIMITER $$
CREATE TRIGGER `employe_ai` AFTER INSERT ON `employe` FOR EACH ROW INSERT INTO droits_conges (empid, annee, nb_jours, typeid) VALUES (NEW.empid, YEAR(NOW()), 45, 1), (NEW.empid, YEAR(NOW()), 15, 2)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `fonctid` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`fonctid`, `libelle`) VALUES
(1, 'Développeur'),
(2, 'Analyste'),
(3, 'Chef de projet'),
(4, 'Adm. réseau'),
(5, 'Adm. base de données'),
(6, 'Secrétaire'),
(7, 'Assistant RH');

-- --------------------------------------------------------

--
-- Table structure for table `mod_horaire`
--

CREATE TABLE `mod_horaire` (
  `horid` int(11) NOT NULL,
  `hormod` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_horaire`
--

INSERT INTO `mod_horaire` (`horid`, `hormod`) VALUES
(1, '07:00:00'),
(2, '07:14:00'),
(3, '07:30:00'),
(4, '07:36:00'),
(5, '07:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `pointage`
--

CREATE TABLE `pointage` (
  `pointid` int(11) NOT NULL,
  `pointdate` date NOT NULL,
  `h_arrivee` time NOT NULL,
  `h_mer1` time NOT NULL,
  `h_mer2` time NOT NULL,
  `h_depart` time NOT NULL,
  `empid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pointage`
--



-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `servid` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`servid`, `libelle`) VALUES
(1, 'Administratif'),
(2, 'Informatique');

-- --------------------------------------------------------

--
-- Table structure for table `type_conge`
--

CREATE TABLE `type_conge` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_conge`
--

INSERT INTO `type_conge` (`id`, `libelle`) VALUES
(1, 'Congés'),
(2, 'Formation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`congeid`),
  ADD KEY `typeid` (`typeid`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `demande_absence`
--
ALTER TABLE `demande_absence`
  ADD PRIMARY KEY (`demabsid`),
  ADD KEY `empid` (`empid`),
  ADD KEY `typeid` (`typeid`);

--
-- Indexes for table `demande_pointage`
--
ALTER TABLE `demande_pointage`
  ADD PRIMARY KEY (`dempointid`),
  ADD KEY `pointid` (`pointid`);

--
-- Indexes for table `droits_conges`
--
ALTER TABLE `droits_conges`
  ADD PRIMARY KEY (`droitsid`),
  ADD KEY `empid` (`empid`),
  ADD KEY `typeid` (`typeid`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`empid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ident` (`ident`),
  ADD KEY `horid` (`horid`),
  ADD KEY `servid` (`servid`),
  ADD KEY `fonctid` (`fonctid`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`fonctid`);

--
-- Indexes for table `mod_horaire`
--
ALTER TABLE `mod_horaire`
  ADD PRIMARY KEY (`horid`);

--
-- Indexes for table `pointage`
--
ALTER TABLE `pointage`
  ADD PRIMARY KEY (`pointid`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`servid`);

--
-- Indexes for table `type_conge`
--
ALTER TABLE `type_conge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conges`
--
ALTER TABLE `conges`
  MODIFY `congeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demande_absence`
--
ALTER TABLE `demande_absence`
  MODIFY `demabsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demande_pointage`
--
ALTER TABLE `demande_pointage`
  MODIFY `dempointid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `droits_conges`
--
ALTER TABLE `droits_conges`
  MODIFY `droitsid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `empid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `fonctid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mod_horaire`
--
ALTER TABLE `mod_horaire`
  MODIFY `horid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pointage`
--
ALTER TABLE `pointage`
  MODIFY `pointid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `servid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_conge`
--
ALTER TABLE `type_conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`),
  ADD CONSTRAINT `conges_ibfk_2` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE;

--
-- Constraints for table `demande_absence`
--
ALTER TABLE `demande_absence`
  ADD CONSTRAINT `demande_absence_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE,
  ADD CONSTRAINT `demande_absence_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`);

--
-- Constraints for table `demande_pointage`
--
ALTER TABLE `demande_pointage`
  ADD CONSTRAINT `demande_pointage_ibfk_1` FOREIGN KEY (`pointid`) REFERENCES `pointage` (`pointid`) ON DELETE CASCADE;

--
-- Constraints for table `droits_conges`
--
ALTER TABLE `droits_conges`
  ADD CONSTRAINT `droits_conges_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE,
  ADD CONSTRAINT `droits_conges_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type_conge` (`id`);

--
-- Constraints for table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`horid`) REFERENCES `mod_horaire` (`horid`),
  ADD CONSTRAINT `employe_ibfk_2` FOREIGN KEY (`servid`) REFERENCES `service` (`servid`),
  ADD CONSTRAINT `employe_ibfk_3` FOREIGN KEY (`fonctid`) REFERENCES `fonction` (`fonctid`);

--
-- Constraints for table `pointage`
--
ALTER TABLE `pointage`
  ADD CONSTRAINT `pointage_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employe` (`empid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
