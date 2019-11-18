-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 18 nov. 2019 à 15:43
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `localhost`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `reported` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `reported`) VALUES
(4, 2, 'John', 'Preum\'s !', '2010-03-27 18:59:49', 0),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13', 0),
(6, 2, 'Noémie', 'Wow...', '2019-10-16 15:03:29', 0),
(7, 2, 'Haroun', '<p><strong><del>Je crois en mon mentor... mais je vais quand même avoir besoin d\'actualiser !&nbsp;</del></strong></p>', '2019-10-16 16:49:09', 0),
(26, 12, 'Marion', 'C\'est cool ce site', '2019-11-08 13:39:49', 0),
(28, 12, 'Testeur', 'Ca marche ou pas?', '2019-11-08 13:48:24', 0),
(29, 12, 'Testeur', 'LA ca risque de bloquer', '2019-11-08 13:51:23', 0),
(30, 12, 'Testeur', 'Pourquoi n\'est-ce pas lent ?', '2019-11-08 13:53:10', 0),
(32, 12, 'Testeur', 'Allez, la, ca devrait etre invisible mais quand meme s\'ecrire dans la BDD', '2019-11-08 13:57:06', 0),
(33, 12, 'Testeur', 'Et la, ca devrait l\'afficher lentement&amp;nbsp;', '2019-11-08 13:57:41', 0),
(34, 12, 'Testeur', 'Bon... cette fois ci ?', '2019-11-08 13:59:03', 0),
(38, 12, 'Putain', '(Commentaire modéré par l\'administrateur.)', '2019-11-08 14:04:55', 0),
(42, 12, 'M&eacute;chant Monsieur', '(Commentaire modéré par l\'administrateur.)', '2019-11-14 15:31:17', 0),
(14, 2, 'Stan', '(Commentaire modéré par l\'Administrateur tout puissant)', '2019-10-16 17:54:51', 0),
(17, 2, 'Hackeur 2', '(Commentaire modéré par l\'Administrateur)', '2019-10-16 18:33:50', 0);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`) VALUES
(2, 'Le PHP à la conquête du monde !', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"éléPHPant\". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11'),
(12, 'Lorem Ipsum', 'Contrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s\'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d\'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l\'éthique. Les premières lignes du Lorem Ipsum, \"Lorem ipsum dolor sit amet...\", proviennent de la section 1.10.32.', '2019-11-27 18:29:25'),
(15, 'Marion est trop moche', '<p><strong>Je l\'aime finalement que moyennement ...</strong></p><p>dfgkjsdfgjsqdlmfnqdfhjmlqsdfjklqjgklqdnslmjdflg,lmdsfsdfgsd</p><p>smdfgjkdslfhjqjdgmlkghljsmqgjsdfj</p>', '2019-11-13 13:42:48'),
(14, 'J\'essaye un truc v2', '<p>J\'ai modifié deux trois trucs, ok ?<br>Tu connais le pain ? c\'est <strong>super</strong> bon ;) <sup>zerazerazer<br>Ecoute moi bienqsdfsqdfqsdfqsdf<br></sup></p><p><hr>kljlkremgegz</p>', '2019-11-12 15:32:23');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` int(4) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rank`, `token`) VALUES
(1, 'test', '$2y$10$cF0bRxUK8oAqeCy12bVH5OlpjJPeRk17Wgbq/UyIzNHF0HIx7pS.y', 1, 'd54f8409c001d7be6eb81e789ad24266713024d8316d6d7f14b14367b3c80790'),
(2, 'test2', '$2y$10$VVfxSkY.uRrHtoXcYlAvk.oeErS8bdUnrHXsv6NgaJD0muTlNjLNa', 0, ''),
(3, 'BaKooN', '$2y$10$gQaLBW1nZQfyHri66GGa1emyCog6q6EclDnzbByxCQ1o3VfwVPMYq', 0, '9a86df87377cd929781e412a963b28b47a19ed3c7c832d0d88afc7c9338cf1e1'),
(4, 'Stan', '$2y$10$ZcfWOgF.ezsZncfe2EDdn.EVxDnTfh02SxsZYv4MC.Wr90lZiB826', 0, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
