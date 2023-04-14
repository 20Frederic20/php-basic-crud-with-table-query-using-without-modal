-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 07 déc. 2022 à 20:52
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agridigital`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `nummatr` int(11) NOT NULL,
  `nomagent` varchar(20) NOT NULL,
  `prenomagent` varchar(20) NOT NULL,
  `datenais` date NOT NULL,
  `datepsce` date NOT NULL,
  `profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`nummatr`, `nomagent`, `prenomagent`, `datenais`, `datepsce`, `profil`) VALUES
(5, 'BOLLO', 'REMI', '2022-11-17', '2022-12-09', ''),
(6, 'hountinme', 'frederic', '2022-12-09', '2022-12-16', 'CamScanner 05-05-2022 21.55_1.jpg'),
(7, 'hountinme', 'frederic', '2022-12-09', '2022-12-16', 'CamScanner 05-05-2022 21.55_1.jpg'),
(8, 'huifebufe', 'jhcdbsbuswe', '2022-12-08', '2022-12-08', 'téléchargement (1).png');

-- --------------------------------------------------------

--
-- Structure de la table `entrepot`
--

CREATE TABLE `entrepot` (
  `codentrep` varchar(10) NOT NULL,
  `libentrep` varchar(40) NOT NULL,
  `adrentrep` varchar(40) NOT NULL,
  `nummatr` int(11) NOT NULL,
  `codloca` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `localite`
--

CREATE TABLE `localite` (
  `codloca` varchar(5) NOT NULL,
  `libloca` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `localite`
--

INSERT INTO `localite` (`codloca`, `libloca`) VALUES
('loko', 'Lokossa'),
('lokoZ', 'Agla'),
('mio', 'Porto-Novo'),
('poto', 'Porto-Novo'),
('tank0', 'tankpè3');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `codprod` varchar(10) NOT NULL,
  `libprod` varchar(40) NOT NULL,
  `prixunit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `signin`
--

CREATE TABLE `signin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `signin`
--

INSERT INTO `signin` (`id`, `username`, `password`) VALUES
(1, 'administrateur', 'admin'),
(2, 'frederic', 'frederic');

-- --------------------------------------------------------

--
-- Structure de la table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stocker`
--

CREATE TABLE `stocker` (
  `codentrep` varchar(10) NOT NULL,
  `codprod` varchar(10) NOT NULL,
  `qtestock` int(11) NOT NULL,
  `qteavarier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`nummatr`);

--
-- Index pour la table `entrepot`
--
ALTER TABLE `entrepot`
  ADD PRIMARY KEY (`codentrep`),
  ADD KEY `nummatr` (`nummatr`),
  ADD KEY `codloca` (`codloca`);

--
-- Index pour la table `localite`
--
ALTER TABLE `localite`
  ADD PRIMARY KEY (`codloca`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`codprod`);

--
-- Index pour la table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stocker`
--
ALTER TABLE `stocker`
  ADD PRIMARY KEY (`codentrep`,`codprod`),
  ADD KEY `codentrep` (`codentrep`),
  ADD KEY `codprod` (`codprod`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `nummatr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `signin`
--
ALTER TABLE `signin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
