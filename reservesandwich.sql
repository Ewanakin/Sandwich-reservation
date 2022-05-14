-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 20, 2022 at 12:03 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reservesandwich`
--
CREATE DATABASE IF NOT EXISTS `reservesandwich` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `reservesandwich`;

-- --------------------------------------------------------

--
-- Table structure for table `accueil`
--

CREATE TABLE `accueil` (
  `id_accueil` int(11) NOT NULL,
  `texte_accueil` text NOT NULL,
  `lien_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `boisson`
--

CREATE TABLE `boisson` (
  `id_boisson` int(11) NOT NULL,
  `nom_boisson` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispo_boisson` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boisson`
--

INSERT INTO `boisson` (`id_boisson`, `nom_boisson`, `dispo_boisson`) VALUES
(1, 'Coca-Cola', 1),
(2, 'Fanta', 1),
(3, 'Eau', 1),
(4, 'Sprite', 1),
(5, 'SevenUp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_com` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_sandwich_id` int(11) NOT NULL,
  `fk_boisson_id` int(11) NOT NULL,
  `fk_dessert_id` int(11) NOT NULL,
  `chips_com` tinyint(1) NOT NULL,
  `date_heure_com` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_heure_livraison_com` datetime NOT NULL,
  `annule_com` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dessert`
--

CREATE TABLE `dessert` (
  `id_dessert` int(11) NOT NULL,
  `nom_dessert` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispo_dessert` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dessert`
--

INSERT INTO `dessert` (`id_dessert`, `nom_dessert`, `dispo_dessert`) VALUES
(1, 'Cookie', 1),
(2, 'Brownie', 1),
(3, 'Donut\'s', 1),
(4, 'Beignet pomme', 1),
(5, 'Beignet chocolat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `historique`
--

CREATE TABLE `historique` (
  `id_hist` int(11) NOT NULL,
  `dateDebut_hist` date NOT NULL,
  `dateFin_hist` date NOT NULL,
  `dateInsertion_hist` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sandwich`
--

CREATE TABLE `sandwich` (
  `id_sandwich` int(11) NOT NULL,
  `nom_sandwich` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispo_sandwich` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sandwich`
--

INSERT INTO `sandwich` (`id_sandwich`, `nom_sandwich`, `dispo_sandwich`) VALUES
(1, 'Sandwich Jambon', 1),
(2, 'Sandwich Poulet', 1),
(3, 'Sandwich Thon', 1),
(4, 'Sandwich Crudités', 1),
(5, 'Panini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `role_user` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_user` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `role_user`, `email_user`, `password_user`, `nom_user`, `prenom_user`, `active_user`) VALUES
(1, 'a', 'administrateur@wanadoo.fr', 'password', 'IDASIAK', 'Mikael', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accueil`
--
ALTER TABLE `accueil`
  ADD PRIMARY KEY (`id_accueil`);

--
-- Indexes for table `boisson`
--
ALTER TABLE `boisson`
  ADD PRIMARY KEY (`id_boisson`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `IDX_B15F29ADCF8EC6B0` (`fk_sandwich_id`),
  ADD KEY `IDX_B15F29AD10326266` (`fk_boisson_id`),
  ADD KEY `IDX_B15F29AD83C52771` (`fk_dessert_id`),
  ADD KEY `IDX_B15F29AD996F9D6F` (`fk_user_id`);

--
-- Indexes for table `dessert`
--
ALTER TABLE `dessert`
  ADD PRIMARY KEY (`id_dessert`);

--
-- Indexes for table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id_hist`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `sandwich`
--
ALTER TABLE `sandwich`
  ADD PRIMARY KEY (`id_sandwich`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_user` (`email_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boisson`
--
ALTER TABLE `boisson`
  MODIFY `id_boisson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dessert`
--
ALTER TABLE `dessert`
  MODIFY `id_dessert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `historique`
--
ALTER TABLE `historique`
  MODIFY `id_hist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sandwich`
--
ALTER TABLE `sandwich`
  MODIFY `id_sandwich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_B15F29AD10326266` FOREIGN KEY (`fk_boisson_id`) REFERENCES `boisson` (`id_boisson`),
  ADD CONSTRAINT `FK_B15F29AD83C52771` FOREIGN KEY (`fk_dessert_id`) REFERENCES `dessert` (`id_dessert`),
  ADD CONSTRAINT `FK_B15F29AD996F9D6F` FOREIGN KEY (`fk_user_id`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `FK_B15F29ADCF8EC6B0` FOREIGN KEY (`fk_sandwich_id`) REFERENCES `sandwich` (`id_sandwich`);

--
-- Constraints for table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `utilisateur` (`id_user`);
