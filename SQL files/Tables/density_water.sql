-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 05 fév. 2023 à 10:23
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

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
-- Structure de la table `density_water`
--

DROP TABLE IF EXISTS `density_water`;
CREATE TABLE IF NOT EXISTS `density_water` (
  `Temperature` float NOT NULL,
  `Density` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `density_water`
--

INSERT INTO `density_water` (`Temperature`, `Density`) VALUES
(0.01, 999.8),
(5, 999.9),
(10, 999.7),
(15, 999.1),
(20, 998),
(25, 997),
(30, 996),
(35, 994),
(40, 992.1),
(45, 990.1),
(50, 988.1),
(55, 985.2),
(60, 983.3),
(65, 980.4),
(70, 977.5),
(75, 974.7),
(80, 971.8),
(85, 968.1),
(90, 965.3),
(95, 961.5),
(100, 957.9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
