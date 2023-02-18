-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 31 jan. 2023 à 11:06
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
-- Base de données : `oilgear`
--

-- --------------------------------------------------------

--
-- Structure de la table `specificheat_water`
--

DROP TABLE IF EXISTS `specificheat_water`;
CREATE TABLE IF NOT EXISTS `specificheat_water` (
  `Temperature - [°C]` float NOT NULL,
  `Specific heat - Cp (T) [J.kg-1.K-1]` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `specificheat_water`
--

INSERT INTO `specificheat_water` (`Temperature - [°C]`, `Specific heat - Cp (T) [J.kg-1.K-1]`) VALUES
(0.01, 4217),
(5, 4205),
(10, 4194),
(15, 4185),
(20, 4182),
(25, 4180),
(30, 4178),
(35, 4178),
(40, 4179),
(45, 4180),
(50, 4181),
(55, 4183),
(60, 4185),
(65, 4187),
(70, 4190),
(75, 4193),
(80, 4197),
(85, 4201),
(90, 4206),
(95, 4212),
(100, 4217);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
