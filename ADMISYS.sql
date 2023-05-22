-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2023 at 09:16 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ADMISYS`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id_admin` int NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrateurs`
--

INSERT INTO `administrateurs` (`id_admin`, `username`, `nom`, `prenom`, `email`, `password`) VALUES
(5, 'zineddine', 'louzanilouani', 'zaindai', 'zineddine.louzani@yahoo.com', '9e192870d8b3bc21821ceaa82d40fb013fdc50ef'),
(6, 'Soufyane', 'Soufyane', 'Soufyane', 'soufyane@gmail.com', 'e727d1464ae12436e899a726da5b2f11d8381b26');

-- --------------------------------------------------------

--
-- Table structure for table `Documents`
--

CREATE TABLE `Documents` (
  `id_doc` int NOT NULL,
  `nom_doc` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `chemin_doc_serveur` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Enseignants`
--

CREATE TABLE `Enseignants` (
  `id_enseignant` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `matiere_enseignee` int NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Enseignants`
--

INSERT INTO `Enseignants` (`id_enseignant`, `nom`, `prenom`, `email`, `matiere_enseignee`, `photo`) VALUES
(1, 'bousl', 'sidali', 'bousla@estin.dz', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Etudiants`
--

CREATE TABLE `Etudiants` (
  `id_etudiant` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `num_etudiant` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FAQ`
--

CREATE TABLE `FAQ` (
  `id_FAQ` int NOT NULL,
  `question` text COLLATE utf8mb4_general_ci NOT NULL,
  `reponse` text COLLATE utf8mb4_general_ci NOT NULL,
  `auteur_reponse` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_pub_reponse` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Inscriptions`
--

CREATE TABLE `Inscriptions` (
  `id_inscription` int NOT NULL,
  `id_etudiant` int NOT NULL,
  `statut_demande` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int NOT NULL,
  `intitule` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_heures` int NOT NULL,
  `prof_responsable` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Nouveautés`
--

CREATE TABLE `Nouveautés` (
  `id_nouveautes` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Documents`
--
ALTER TABLE `Documents`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indexes for table `Enseignants`
--
ALTER TABLE `Enseignants`
  ADD PRIMARY KEY (`id_enseignant`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Etudiants`
--
ALTER TABLE `Etudiants`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `FAQ`
--
ALTER TABLE `FAQ`
  ADD PRIMARY KEY (`id_FAQ`);

--
-- Indexes for table `Inscriptions`
--
ALTER TABLE `Inscriptions`
  ADD PRIMARY KEY (`id_inscription`),
  ADD KEY `ibfk_1` (`id_etudiant`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`),
  ADD KEY `ibfk_2` (`prof_responsable`);

--
-- Indexes for table `Nouveautés`
--
ALTER TABLE `Nouveautés`
  ADD PRIMARY KEY (`id_nouveautes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Documents`
--
ALTER TABLE `Documents`
  MODIFY `id_doc` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Enseignants`
--
ALTER TABLE `Enseignants`
  MODIFY `id_enseignant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Etudiants`
--
ALTER TABLE `Etudiants`
  MODIFY `id_etudiant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `FAQ`
--
ALTER TABLE `FAQ`
  MODIFY `id_FAQ` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Inscriptions`
--
ALTER TABLE `Inscriptions`
  MODIFY `id_inscription` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Nouveautés`
--
ALTER TABLE `Nouveautés`
  MODIFY `id_nouveautes` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Inscriptions`
--
ALTER TABLE `Inscriptions`
  ADD CONSTRAINT `ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `Etudiants` (`id_etudiant`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `ibfk_2` FOREIGN KEY (`prof_responsable`) REFERENCES `Enseignants` (`id_enseignant`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
