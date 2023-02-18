-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 fév. 2023 à 08:56
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
-- Structure de la table `fluid_data_water`
--

DROP TABLE IF EXISTS `fluid_data_water`;
CREATE TABLE IF NOT EXISTS `fluid_data_water` (
  `FluideEauGlacelf` varchar(50) NOT NULL,
  `Density` float NOT NULL,
  `Specific_heat` float NOT NULL,
  `Kinematic_viscosity` float NOT NULL,
  `Thermal_conductivity` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fluid_data_water`
--

INSERT INTO `fluid_data_water` (`FluideEauGlacelf`, `Density`, `Specific_heat`, `Kinematic_viscosity`, `Thermal_conductivity`) VALUES
('Fresh Water', 0, 0, 0, 0),
('Glacelf 10 %', 0, 0, 0, 0),
('Glacelf 20 %', 0, 0, 0, 0),
('Glacelf 30 %', 0, 0, 0, 0),
('Glacelf 40 %', 0, 0, 0, 0),
('Glacelf 50 %', 0, 0, 0, 0),
('Sea Water', 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
