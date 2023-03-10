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
-- Structure de la table `pipe`
--

DROP TABLE IF EXISTS `pipe`;
CREATE TABLE IF NOT EXISTS `pipe` (
  `Pipe_Type` varchar(50) NOT NULL,
  `External_Diameter` float NOT NULL,
  `Wall_Thickness` float NOT NULL,
  `Internal_Diameter` float NOT NULL,
  `admissible_stress` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pipe`
--

INSERT INTO `pipe` (`Pipe_Type`, `External_Diameter`, `Wall_Thickness`, `Internal_Diameter`, `admissible_stress`) VALUES
('E235N', 25, 5, 15, 235),
('E235N', 25, 4, 17, 235),
('E235N', 25, 3, 19, 235),
('E235N', 25, 2.5, 20, 235),
('E235N', 25, 2, 21, 235),
('E235N', 22, 4, 14, 235),
('E235N', 22, 3.5, 15, 235),
('E235N', 22, 3, 16, 235),
('E235N', 22, 2.5, 17, 235),
('E235N', 22, 2, 18, 235),
('E235N', 22, 1.5, 19, 235),
('E235N', 20, 4, 12, 235),
('E235N', 20, 3.5, 13, 235),
('E235N', 20, 3, 14, 235),
('E235N', 20, 2.5, 15, 235),
('E235N', 20, 2, 16, 235),
('E235N', 18, 4, 10, 235),
('E235N', 18, 3, 12, 235),
('E235N', 18, 2.5, 13, 235),
('E235N', 18, 2, 14, 235),
('E235N', 18, 1.5, 15, 235),
('E235N', 16, 4, 8, 235),
('E235N', 16, 3.5, 9, 235),
('E235N', 16, 3, 10, 235),
('E235N', 16, 2.5, 11, 235),
('E235N', 16, 2, 12, 235),
('E235N', 16, 1.5, 13, 235),
('E235N', 15, 3, 9, 235),
('E235N', 15, 2.5, 10, 235),
('E235N', 15, 2, 11, 235),
('E235N', 15, 1.5, 12, 235),
('E235N', 14, 3, 8, 235),
('E235N', 14, 2.5, 9, 235),
('E235N', 14, 2, 10, 235),
('E235N', 14, 1.5, 11, 235),
('E235N', 12, 3, 6, 235),
('E235N', 12, 2.5, 7, 235),
('E235N', 12, 2, 8, 235),
('E235N', 12, 1.5, 9, 235),
('E235N', 10, 3, 4, 235),
('E235N', 10, 2.5, 5, 235),
('E235N', 10, 2, 6, 235),
('E235N', 10, 1.5, 7, 235),
('E235N', 8, 2, 4, 235),
('E235N', 28, 2.5, 23, 235),
('E235N', 8, 1.5, 5, 235),
('E235N', 6, 1.5, 3, 235),
('E235N', 28, 2, 24, 235),
('E235N', 28, 3, 22, 235),
('E235N', 28, 5, 18, 235),
('E235N', 30, 2, 26, 235),
('E235N', 30, 2.5, 25, 235),
('E235N', 30, 3, 24, 235),
('E235N', 30, 4, 22, 235),
('E235N', 30, 5, 20, 235),
('E235N', 35, 2, 31, 235),
('E235N', 35, 2.5, 30, 235),
('E235N', 35, 3, 29, 235),
('E235N', 35, 4, 27, 235),
('E235N', 35, 5, 25, 235),
('E235N', 38, 3, 32, 235),
('E235N', 38, 4, 30, 235),
('E235N', 38, 5, 28, 235),
('E235N', 38, 6, 26, 235),
('E235N', 42, 3, 36, 235),
('P235', 21.3, 2, 17.3, 235),
('P235', 21.3, 3.2, 14.9, 235),
('P235', 26.9, 3.2, 20.5, 235),
('P235', 33.7, 3.2, 27.3, 235),
('P235', 33.7, 4, 25.7, 235),
('P235', 33.7, 4.5, 24.7, 235),
('P235', 33.7, 5, 23.7, 235),
('P235', 33.7, 5.6, 22.5, 235),
('P235', 42.4, 3.2, 36, 235),
('P235', 42.4, 5, 32.4, 235),
('P235', 48.3, 3.25, 41.8, 235),
('P235', 48.3, 3.6, 41.1, 235),
('P235', 51, 5, 41, 235),
('P235', 60.3, 3.6, 53.1, 235),
('P235', 60.3, 4.5, 51.3, 235),
('P235', 76.1, 4.5, 67.1, 235),
('P235', 76.1, 5.6, 64.9, 235),
('P235', 76.1, 8, 60.1, 235),
('P235', 76.1, 10, 56.1, 235),
('P235', 76.1, 12.5, 51.1, 235),
('P235', 88.9, 4, 80.9, 235),
('P235', 114.3, 4.5, 105.3, 235),
('P235', 114.3, 8, 98.3, 235),
('P235', 114.3, 12.5, 89.3, 235),
('P235', 114.3, 16, 82.3, 235),
('P235', 139.7, 4, 131.7, 235),
('P235', 168.3, 4.5, 159.3, 235),
('P235', 168.3, 6.3, 155.7, 235),
('P235', 219.1, 6.3, 206.5, 235),
('P235', 219.1, 7.1, 204.9, 235),
('P235', 273, 6.3, 260.4, 235),
('P235', 273, 8, 257, 235),
('P235', 323.9, 7.1, 309.7, 235),
('P235', 323.9, 8, 307.9, 235),
('P235', 323.9, 10, 303.9, 235),
('P235', 355.6, 8, 339.6, 235),
('P235', 355.6, 10, 335.6, 235),
('P235', 355.6, 12.5, 330.6, 235),
('P235', 457, 9.5, 438, 235),
('P235', 457, 10, 437, 235),
('P235', 457, 12.5, 432, 235),
('P235', 26.9, 3.2, 20.5, 235),
('P235', 33.7, 3.2, 27.3, 235),
('P235', 33.7, 4, 25.7, 235),
('P235', 33.7, 4.5, 24.7, 235),
('P235', 33.7, 5, 23.7, 235),
('P235', 33.7, 5.6, 22.5, 235),
('P235', 42.4, 3.2, 36, 235),
('P235', 42.4, 5, 32.4, 235),
('P235', 48.3, 3.25, 41.8, 235),
('P235', 48.3, 3.6, 41.1, 235),
('P235', 51, 5, 41, 235),
('P235', 60.3, 3.6, 53.1, 235),
('P235', 60.3, 4.5, 51.3, 235),
('P235', 76.1, 4.5, 67.1, 235),
('P235', 76.1, 5.6, 64.9, 235),
('P235', 76.1, 8, 60.1, 235),
('P235', 76.1, 10, 56.1, 235),
('P235', 76.1, 12.5, 51.1, 235),
('P235', 88.9, 4, 80.9, 235),
('P235', 114.3, 4.5, 105.3, 235),
('P235', 114.3, 8, 98.3, 235),
('P235', 114.3, 12.5, 89.3, 235),
('P235', 114.3, 16, 82.3, 235),
('P235', 139.7, 4, 131.7, 235),
('P235', 168.3, 4.5, 159.3, 235),
('P235', 168.3, 6.3, 155.7, 235),
('P235', 219.1, 6.3, 206.5, 235),
('P235', 219.1, 7.1, 204.9, 235),
('P235', 273, 6.3, 260.4, 235),
('P235', 273, 8, 257, 235),
('P235', 323.9, 7.1, 309.7, 235),
('P235', 323.9, 8, 307.9, 235),
('P235', 323.9, 10, 303.9, 235),
('P235', 355.6, 8, 339.6, 235),
('P235', 355.6, 10, 335.6, 235),
('P235', 355.6, 12.5, 330.6, 235),
('P235', 457, 9.5, 438, 235),
('P235', 457, 10, 437, 235),
('P235', 457, 12.5, 432, 235),
('S335J2H', 60.3, 10, 40.3, 335),
('S335J2H', 76.1, 8, 60.1, 335),
('S335J2H', 76.1, 12.5, 51.1, 335),
('S335J2H', 88.9, 11, 66.9, 335),
('S335J2H', 88.9, 12.5, 63.9, 335),
('S335J2H', 88.9, 16, 56.9, 335),
('S335J2H', 114.3, 16, 82.3, 335),
('S335J2H', 168.3, 16, 136.3, 335),
('S335J2H', 168.3, 20, 128.3, 335),
('P265GH', 13.5, 2.3, 8.9, 265),
('P265GH', 17.2, 2.3, 12.6, 265),
('P265GH', 21.3, 2.6, 16.1, 265),
('P265GH', 21.3, 3.6, 14.1, 265),
('P265GH', 26.9, 2.9, 21.1, 265),
('P265GH', 26.9, 4, 18.9, 265),
('P265GH', 33.7, 3.2, 27.3, 265),
('P265GH', 33.7, 3.6, 26.5, 265),
('P265GH', 33.7, 4.5, 24.7, 265),
('P265GH', 33.7, 6.3, 21.1, 265),
('P265GH', 33.7, 8.8, 16.1, 265),
('P265GH', 42.4, 2.6, 37.2, 265),
('P265GH', 42.4, 3.6, 35.2, 265),
('P265GH', 42.4, 5, 32.4, 265),
('P265GH', 42.4, 6.3, 29.8, 265),
('P265GH', 42.4, 10, 22.4, 265),
('P265GH', 48.3, 2.6, 43.1, 265),
('P265GH', 48.3, 3.6, 41.1, 265),
('P265GH', 48.3, 5, 38.3, 265),
('P265GH', 48.3, 7.1, 34.1, 265),
('P265GH', 48.3, 10, 28.3, 265),
('P265GH', 60.3, 2.9, 54.5, 265),
('P265GH', 60.3, 4, 52.3, 265),
('P265GH', 60.3, 5.6, 49.1, 265),
('P265GH', 60.3, 8.8, 42.7, 265),
('P265GH', 76.1, 2.9, 70.3, 265),
('P265GH', 88.9, 3.2, 82.5, 265),
('P265GH', 88.9, 4, 80.9, 265),
('P265GH', 88.9, 5.6, 77.7, 265),
('P265GH', 88.9, 7.1, 74.7, 265),
('P265GH', 88.9, 8, 72.9, 265),
('P265GH', 88.9, 11, 66.9, 265),
('P265GH', 114.3, 3.6, 107.1, 265),
('P265GH', 114.3, 5.6, 103.1, 265),
('P265GH', 114.3, 6.3, 101.7, 265),
('P265GH', 114.3, 8.8, 96.7, 265),
('P265GH', 114.3, 11, 92.3, 265),
('P265GH', 114.3, 14.2, 85.9, 265),
('P265GH', 114.3, 16, 82.3, 265),
('P265GH', 139.7, 4, 131.7, 265),
('P265GH', 168.3, 4.5, 159.3, 265),
('P265GH', 168.3, 6.3, 155.7, 265),
('P265GH', 168.3, 7.1, 154.1, 265),
('P265GH', 168.3, 11, 146.3, 265),
('P265GH', 168.3, 12.5, 143.3, 265),
('P265GH', 168.3, 20, 128.3, 265),
('P265GH', 219.1, 6.3, 206.5, 265),
('P265GH', 219.1, 7.1, 204.9, 265),
('P265GH', 219.1, 8, 203.1, 265),
('P265GH', 219.1, 10, 199.1, 265),
('P265GH', 273, 6.3, 260.4, 265),
('P265GH', 273, 8, 257, 265),
('P265GH', 273, 10, 253, 265),
('P265GH', 323.9, 7.1, 309.7, 265),
('P265GH', 323.9, 8, 307.9, 265),
('P265GH', 323.9, 10, 303.9, 265),
('P265GH', 355.6, 8, 339.6, 265),
('P265GH', 355.6, 10, 335.6, 265),
('P265GH', 355.6, 12.5, 330.6, 265),
('P265GH', 457, 12.5, 432, 265);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
