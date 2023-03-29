-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 02 juil. 2022 à 19:37
-- Version du serveur :  8.0.29-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `graine_public`
--

-- --------------------------------------------------------

--
-- Structure de la table `dataSite`
--

CREATE TABLE `dataSite` (
  `idDataSite` int NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sousTitre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titreHTML` varchar(120) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dataSite`
--

INSERT INTO `dataSite` (`idDataSite`, `titre`, `sousTitre`, `description`, `titreHTML`) VALUES
(1, 'Graines public', 'Un cadre de travail', 'Je, suis, un, joli, oiseau, de, nuit, qui, se, fait, beau, pour, l\'aurore', 'Graines Public');

-- --------------------------------------------------------

--
-- Structure de la table `journaux`
--

CREATE TABLE `journaux` (
  `idConnexion` int NOT NULL,
  `ipUser` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idUser` int NOT NULL DEFAULT '0',
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `mdpHacker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `dateHeure` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `okConnexion` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `journaux`
--

INSERT INTO `journaux` (`idConnexion`, `ipUser`, `idUser`, `login`, `mdpHacker`, `dateHeure`, `okConnexion`) VALUES
(1, '127.0.0.1', 5, 'Aresh', '0', '2022-06-09 23:25:02', 1),
(2, '127.0.0.1', 5, 'Aresh', '0', '2022-06-09 23:26:53', 1),
(3, '127.0.0.1', 0, 'Gandalf', 'dusud', '2022-06-09 23:28:06', 0),
(4, '127.0.0.1', 0, 'Gandalf', 'christophe', '2022-06-12 14:20:00', 0),
(5, '127.0.0.1', 5, 'Aresh', '0', '2022-06-12 14:23:51', 1),
(6, '127.0.0.1', 7, 'Admin', '0', '2022-06-12 14:26:59', 1),
(7, '127.0.0.1', 0, 'Admin', 'dusud', '2022-06-12 14:27:32', 0),
(8, '127.0.0.1', 7, 'Admin', '0', '2022-06-12 14:27:41', 1),
(9, '127.0.0.1', 5, 'Aresh', '0', '2022-06-12 14:37:46', 1),
(10, '127.0.0.1', 0, 'Admin', 'dusud', '2022-06-12 14:37:55', 0),
(11, '127.0.0.1', 7, 'Admin', '0', '2022-06-12 14:38:05', 1),
(12, '127.0.0.1', 0, 'Admin', 'dusud', '2022-06-12 15:15:05', 0),
(13, '127.0.0.1', 7, 'Admin', '0', '2022-06-12 15:15:14', 1),
(14, '127.0.0.1', 7, 'Admin', '0', '2022-06-13 00:14:57', 1),
(15, '127.0.0.1', 7, 'Admin', '0', '2022-06-13 21:44:06', 1),
(16, '127.0.0.1', 7, 'Admin', '0', '2022-06-14 23:03:04', 1),
(17, '127.0.0.1', 7, 'Admin', '0', '2022-06-15 03:12:04', 1),
(18, '127.0.0.1', 7, 'Admin', '0', '2022-06-15 22:51:21', 1),
(19, '127.0.0.1', 0, 'Admin', 'dusud', '2022-06-15 22:52:27', 0),
(20, '127.0.0.1', 7, 'Admin', '0', '2022-06-15 22:52:36', 1),
(21, '127.0.0.1', 7, 'Admin', '0', '2022-06-17 17:19:41', 1),
(22, '127.0.0.1', 0, 'Admin', 'Christophe', '2022-07-02 19:26:26', 0),
(23, '127.0.0.1', 0, 'Gandalf', 'Christophe', '2022-07-02 19:26:38', 0),
(24, '127.0.0.1', 0, 'Admin', 'Christophe', '2022-07-02 19:29:06', 0),
(25, '127.0.0.1', 0, 'Aresh', 'Christophe', '2022-07-02 19:29:23', 0),
(26, '127.0.0.1', 7, 'Admin', '0', '2022-07-02 19:29:31', 1),
(27, '127.0.0.1', 7, 'Admin', '0', '2022-07-02 19:31:49', 1),
(28, '127.0.0.1', 5, 'Aresh', '0', '2022-07-02 19:35:40', 1);

-- --------------------------------------------------------

--
-- Structure de la table `menuNav`
--

CREATE TABLE `menuNav` (
  `idMenuDeroulant` int NOT NULL,
  `titreMenu` varchar(80) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menuNav`
--

INSERT INTO `menuNav` (`idMenuDeroulant`, `titreMenu`) VALUES
(1, 'Administration du site');

-- --------------------------------------------------------

--
-- Structure de la table `navigation`
--

CREATE TABLE `navigation` (
  `idNav` int NOT NULL,
  `nomNav` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cheminNav` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menuVisible` tinyint(1) NOT NULL,
  `zoneMenu` int NOT NULL,
  `ordre` tinyint NOT NULL,
  `niveau` tinyint(1) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `deroulant` tinyint NOT NULL DEFAULT '0',
  `targetRoute` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `navigation`
--

INSERT INTO `navigation` (`idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`) VALUES
(72, 'connexion', 'modules/connexion/connexion.php', 1, 0, 10, 0, 1, 0, '9444705349052466'),
(73, 'inscription', 'modules/users/inscription.php', 0, 0, 0, 0, 1, 0, '0211961865789'),
(74, 'Deco', 'modules/securiter/deconnexion.php', 1, 0, 20, 1, 1, 0, '271881300251503'),
(75, 'Deco', 'modules/securiter/deconnexion.php', 1, 0, 20, 2, 1, 0, '513297588769387'),
(76, 'Administration du site', 'modules/navigation/erreurNav.php', 1, 0, 1, 2, 1, 1, '7459317352246924'),
(77, 'Ajout lien de nav', 'modules/navigation/menuAdmin/creationNouveuMenu.php', 1, 1, 1, 2, 1, 0, '4460480696650814'),
(78, 'Titres et SEO', 'modules/dataSite/titreInfo.php', 1, 1, 2, 2, 1, 0, '645409946603'),
(81, 'Brassage des liens', 'modules/navigation/menuAdmin/dynamique.php', 1, 1, 2, 2, 1, 0, '145064404698076'),
(82, 'Ajout menu déroulant', 'modules/navigation/menuAdmin/ajoutMenuDeroulant.php', 1, 1, 2, 2, 1, 0, '6664349098544'),
(83, 'Test menu déroulant', 'modules/navigation/erreurNav.php', 1, 0, 0, 2, 1, 5, 'SWo4PFzEfQQFkxrT');

-- --------------------------------------------------------

--
-- Structure de la table `routageForm`
--

CREATE TABLE `routageForm` (
  `idForm` int NOT NULL,
  `chemin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `securiter` tinyint(1) NOT NULL DEFAULT '0',
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `route` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `routageForm`
--

INSERT INTO `routageForm` (`idForm`, `chemin`, `securiter`, `valide`, `route`) VALUES
(1, 'modules/users/CUD/Create/inscriptionUser.php', 0, 1, '123456132'),
(2, 'modules/securiter/connexionUser.php', 0, 1, '45658945122'),
(3, 'modules/users/CUD/Update/activationUser.php', 0, 1, '22334455669988'),
(4, 'modules/navigation/CUD/Create/addLien.php', 2, 1, '44566513256'),
(5, 'modules/dataSite/CUD/Update/updateDataSite.php', 2, 1, '45612345gdggd'),
(6, 'modules/navigation/CUD/Create/addMenusDeroulant.php', 2, 1, 'zclkckpcplzclm');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `token` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `token`, `email`, `prenom`, `nom`, `login`, `mdp`, `valide`, `role`, `dateCreation`) VALUES
(5, 'f0PSAmRaAjdlKiom', 'christophe.calmes2020@laposte.net', 'Christophe', 'Calmes', 'Aresh', '$2y$10$g9ygbbVi1Fo2WqBpWXOG8uh4q2g8SGA9sb4mHeAXsHvXZ/Rtz5NtO', 1, 1, '2022-06-09 22:59:58'),
(7, 'uMRZYrWyA9sfKPod', 'christophe.massage@orange.fr', 'Christophe', 'Calmes', 'Admin', '$2y$10$oADkGPsXhTD1m1.vawEEJevfSC1BwODMOuCHCntUrBQgpV5TmLy6S', 1, 2, '2022-06-12 14:26:13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dataSite`
--
ALTER TABLE `dataSite`
  ADD PRIMARY KEY (`idDataSite`);

--
-- Index pour la table `journaux`
--
ALTER TABLE `journaux`
  ADD PRIMARY KEY (`idConnexion`);

--
-- Index pour la table `menuNav`
--
ALTER TABLE `menuNav`
  ADD PRIMARY KEY (`idMenuDeroulant`);

--
-- Index pour la table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`idNav`);

--
-- Index pour la table `routageForm`
--
ALTER TABLE `routageForm`
  ADD PRIMARY KEY (`idForm`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dataSite`
--
ALTER TABLE `dataSite`
  MODIFY `idDataSite` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `journaux`
--
ALTER TABLE `journaux`
  MODIFY `idConnexion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `menuNav`
--
ALTER TABLE `menuNav`
  MODIFY `idMenuDeroulant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `idNav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `routageForm`
--
ALTER TABLE `routageForm`
  MODIFY `idForm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
