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
-- Structure de la table `lambda_water`
--

DROP TABLE IF EXISTS `lambda_water`;
CREATE TABLE IF NOT EXISTS `lambda_water` (
  `Temperature - [°C]` float NOT NULL,
  `Thermal conductivity - [W.m-1.K-1]` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lambda_water`
--

INSERT INTO `lambda_water` (`Temperature - [°C]`, `Thermal conductivity - [W.m-1.K-1]`) VALUES
(0.01, 0.561),
(5, 0.571),
(10, 0.58),
(15, 0.589),
(20, 0.598),
(25, 0.607),
(30, 0.615),
(35, 0.623),
(40, 0.631),
(45, 0.637),
(50, 0.644),
(55, 0.649),
(60, 0.654),
(65, 0.659),
(70, 0.663),
(75, 0.667),
(80, 0.67),
(85, 0.673),
(90, 0.675),
(95, 0.677),
(100, 0.679);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
