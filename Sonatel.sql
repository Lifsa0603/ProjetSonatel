-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 22 juin 2024 à 03:25
-- Version du serveur : 10.6.17-MariaDB-cll-lve
-- Version de PHP : 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `c2099974c_SONATEL`
--

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `ref_contrat` varchar(64) NOT NULL,
  `sigle` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `datedebutcontrat` date NOT NULL,
  `datefincontrat` date NOT NULL,
  `secteur` varchar(64) DEFAULT NULL,
  `etatcontrat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`ref_contrat`, `sigle`, `nom`, `datedebutcontrat`, `datefincontrat`, `secteur`, `etatcontrat`) VALUES
('Contrat_ES', 'ES', 'Ecobank Sénégal', '2021-08-07', '2022-08-06', 'Economique', 0),
('Contrat_HF', 'HF', 'Hopital Fann', '2021-08-07', '2022-08-06', 'Santé', 0),
('Contrat_IM', 'IM', 'Independance Immobiliere', '2023-08-07', '2024-08-07', NULL, 1),
('Contrat_NMA', 'NMA', 'Nouvelle Minoterie Africaine', '2023-08-07', '2024-08-07', NULL, 1),
('Contrat_SGBS', 'SGBS', 'Société Générale de Banques au Sénégal', '2023-08-07', '2024-08-06', NULL, 1);

--
-- Déclencheurs `Client`
--
DELIMITER $$
CREATE TRIGGER `maj_etat_contrat` BEFORE INSERT ON `Client` FOR EACH ROW BEGIN
    IF NEW.datedebutcontrat <= NOW() AND NEW.datefincontrat >= NOW() THEN
        SET NEW.etatcontrat = 1;
    ELSE
        SET NEW.etatcontrat = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Siteclient`
--

CREATE TABLE `Siteclient` (
  `nomsite` varchar(128) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `Contrat` varchar(128) NOT NULL,
  `adresse` varchar(120) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Siteclient`
--

INSERT INTO `Siteclient` (`nomsite`, `Contrat`, `adresse`, `email`, `telephone`) VALUES
('Grand Site NMA', 'Contrat_NMA', 'KM 11, Rte de Rufisque, Dakar 05722', 'nmasiege@gmail.com', 770000000),
('Siege IndependanceImmo', 'Contrat_IM', 'Av. Fadiga, Immeuble Lahad Mbacké BP 2975', 'Independanceimmo@gmail.com', 774870000),
('Usine Potou', 'Contrat_NMA', 'Rte de Rufisque, Dakar', 'nmapotou@gmail.com', 771110000);

-- --------------------------------------------------------

--
-- Structure de la table `Systeme`
--

CREATE TABLE `Systeme` (
  `ref_systeme_client` varchar(128) NOT NULL,
  `nomsite_systeme` varchar(128) NOT NULL,
  `clientproprietaire` varchar(64) DEFAULT NULL,
  `typesysteme` text NOT NULL,
  `Version` text NOT NULL,
  `contrat` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Déchargement des données de la table `Systeme`
--

INSERT INTO `Systeme` (`ref_systeme_client`, `nomsite_systeme`, `clientproprietaire`, `typesysteme`, `Version`, `contrat`) VALUES
('Contrat_IM_PABX06_1', 'Siege IndependanceImmo', 'Independance Immobiliere', 'PABX', '06', NULL),
('Contrat_NMA_OXO14_1', 'Grand Site NMA', 'Nouvelle Minoterie Africaine', 'OXO', '14.0.1', NULL),
('Contrat_NMA_OXO14_2', 'Usine Potou', 'Nouvelle Minoterie Africaine', 'OXO ', '14.0.2', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Ticket`
--

CREATE TABLE `Ticket` (
  `ref_ticket` varchar(64) NOT NULL,
  `numtechnicien` bigint(20) NOT NULL,
  `systemeclient` varchar(128) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `etat_ticket` enum('Validation','Traitement En Cours') DEFAULT 'Traitement En Cours',
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `datecloturation` timestamp NULL DEFAULT NULL,
  `typeMaintenance` varchar(120) DEFAULT NULL,
  `note_ticket` tinyint(4) DEFAULT NULL,
  `observation_client` text DEFAULT NULL,
  `urlfichemaintenance` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Ticket`
--

INSERT INTO `Ticket` (`ref_ticket`, `numtechnicien`, `systemeclient`, `etat_ticket`, `dateCreation`, `datecloturation`, `typeMaintenance`, `note_ticket`, `observation_client`, `urlfichemaintenance`) VALUES
('Ref-1001', 1, 'Contrat_IM_PABX06_1', 'Validation', '2023-08-07 21:27:38', '2023-08-28 11:45:47', 'Préventive', 5, 'Rien à signaler. Les problèmes ont été réglés même si la durée du travail est longue.', 'profil_Lifsid_1/Independance Immobiliere_T-001N_11.pdf'),
('Ref-1002', 1, 'Contrat_IM_PABX06_1', 'Validation', '2023-08-28 07:04:25', '2024-02-16 10:10:18', 'Curative', 4, 'RAS', 'profil_Lifsid_1/Independance Immobiliere_T-001N_15.pdf'),
('Ref-1003', 2, 'Contrat_IM_PABX06_1', 'Traitement En Cours', '2023-08-28 07:09:25', NULL, 'Préventive', NULL, NULL, NULL),
('Ref-1004', 1, 'Contrat_NMA_OXO14_1', 'Validation', '2023-08-28 07:09:25', '2023-08-28 11:47:23', 'Préventive', 3, 'Travail bon dans l\'ensemble mais il reste quelques dépannages', 'profil_Lifsid_1/Nouvelle Minoterie Africaine_T-001N_12.pdf'),
('Ref-1005', 3, 'Contrat_NMA_OXO14_2', 'Traitement En Cours', '2023-08-28 07:09:25', NULL, 'Curative', NULL, NULL, NULL),
('Ref-1006', 1, 'Contrat_NMA_OXO14_1', 'Validation', '2023-08-28 07:09:25', '2023-10-16 12:08:57', 'Curative', 4, 'RAS', 'profil_Lifsid_1/Nouvelle Minoterie Africaine_T-001N_13.pdf'),
('Ref-1007', 3, 'Contrat_IM_PABX06_1', 'Traitement En Cours', '2023-08-28 07:09:25', NULL, 'Préventive', NULL, NULL, NULL),
('Ref-1008', 2, 'Contrat_IM_PABX06_1', 'Traitement En Cours', '2023-08-28 07:09:25', NULL, 'Curative', NULL, NULL, NULL),
('Ref-1009', 1, 'Contrat_NMA_OXO14_2', 'Traitement En Cours', '2023-08-28 07:11:23', NULL, 'Curative', NULL, NULL, NULL),
('Ref-1010', 2, 'Contrat_IM_PABX06_1', 'Validation', '2023-09-21 11:31:23', '2023-09-21 09:35:27', 'Curative', 4, 'Rien à signaler bon travail ', 'profil_Lifsa_2/Independance Immobiliere_T-002N_21.pdf'),
('Ref-1012', 5, 'Contrat_NMA_OXO14_1', 'Validation', '2023-10-16 14:41:43', '2023-10-16 12:50:04', 'Préventive', 4, 'Rien a signaler Bon Travail', 'profil_Ibrahima12_5/Nouvelle Minoterie Africaine_T-005N_51.pdf'),
('Ref890', 1, 'Contrat_NMA_OXO14_1', 'Validation', '2024-01-23 14:11:08', '2024-01-23 13:13:21', 'Préventive', 4, 'Ras', 'profil_Lifsid_1/Nouvelle Minoterie Africaine_T-001N_14.pdf');

--
-- Déclencheurs `Ticket`
--
DELIMITER $$
CREATE TRIGGER `check_etat_Ticket` BEFORE INSERT ON `Ticket` FOR EACH ROW BEGIN
    IF NEW.datecloturation IS NOT NULL THEN
   		SET NEW.etat_Ticket="Validation";
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id_technicien` bigint(20) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `identifiant` varchar(120) DEFAULT NULL,
  `motdepasse` varchar(64) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `directory_Technicien` text DEFAULT NULL,
  `categorie_user` enum('Technicien','Admin') CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id_technicien`, `prenom`, `nom`, `email`, `identifiant`, `motdepasse`, `telephone`, `directory_Technicien`, `categorie_user`) VALUES
(1, 'El Hadji Sidya', 'Badji', 'sidlifdiaba@gmail.com', 'Lifsid', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '777777777', NULL, 'Technicien'),
(2, 'Salif', 'Diallo', 'salifdiallo@esp.sn', 'Lifsa', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', NULL, NULL, 'Technicien'),
(3, 'Pape Ismaila', 'Ngningue', 'papeismaila@gmail.com', 'Pape450', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, 'Technicien'),
(4, 'Mouhamadou', 'Ba', 'mouhamed.ba@orange-sonatel.com', 'Mouhamadou097776', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '776446407', NULL, 'Admin'),
(5, 'Ibrahima', 'Coly', 'salIbrahima.coly@orange-sonatel.com', 'Ibrahima12', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, 'Technicien');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`ref_contrat`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD UNIQUE KEY `sigle` (`sigle`);

--
-- Index pour la table `Siteclient`
--
ALTER TABLE `Siteclient`
  ADD PRIMARY KEY (`nomsite`),
  ADD KEY `Fk_ContratClient` (`Contrat`);

--
-- Index pour la table `Systeme`
--
ALTER TABLE `Systeme`
  ADD PRIMARY KEY (`ref_systeme_client`),
  ADD KEY `Fk_siteSysteme` (`nomsite_systeme`);

--
-- Index pour la table `Ticket`
--
ALTER TABLE `Ticket`
  ADD PRIMARY KEY (`ref_ticket`),
  ADD KEY `FK_Technicien` (`numtechnicien`),
  ADD KEY `Fk_Systeme` (`systemeclient`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id_technicien`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `UC_identifiant` (`identifiant`),
  ADD UNIQUE KEY `directory_Technicien` (`directory_Technicien`) USING HASH;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id_technicien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Siteclient`
--
ALTER TABLE `Siteclient`
  ADD CONSTRAINT `Fk_ContratClient` FOREIGN KEY (`Contrat`) REFERENCES `Client` (`ref_contrat`);

--
-- Contraintes pour la table `Systeme`
--
ALTER TABLE `Systeme`
  ADD CONSTRAINT `Fk_siteSysteme` FOREIGN KEY (`nomsite_systeme`) REFERENCES `Siteclient` (`nomsite`);

--
-- Contraintes pour la table `Ticket`
--
ALTER TABLE `Ticket`
  ADD CONSTRAINT `FK_Technicien` FOREIGN KEY (`numtechnicien`) REFERENCES `Utilisateur` (`id_Technicien`),
  ADD CONSTRAINT `Fk_Systeme` FOREIGN KEY (`systemeclient`) REFERENCES `Systeme` (`ref_systeme_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
