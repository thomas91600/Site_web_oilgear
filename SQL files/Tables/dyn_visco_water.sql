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
-- Structure de la table `dyn_visco_water`
--

DROP TABLE IF EXISTS `dyn_visco_water`;
CREATE TABLE IF NOT EXISTS `dyn_visco_water` (
  `Dynamic viscosity - [kg.m-1.s-1]` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dyn_visco_water`
--

INSERT INTO `dyn_visco_water` (`Dynamic viscosity - [kg.m-1.s-1]`) VALUES
(0.001792),
(0.001519),
(0.001307),
(0.001138),
(0.001002),
(0.000891),
(0.000798),
(0.00072),
(0.000653),
(0.000596),
(0.000547),
(0.000504),
(0.000467),
(0.000433),
(0.000404),
(0.000378),
(0.000355),
(0.000333),
(0.000315),
(0.000297),
(0.000282);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
