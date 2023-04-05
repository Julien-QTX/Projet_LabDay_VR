-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 05 avr. 2023 à 13:45
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `LabDay`
--

-- --------------------------------------------------------

--
-- Structure de la table `ChatGlobal`
--

CREATE TABLE `ChatGlobal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `langue` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ChatGlobal`
--

INSERT INTO `ChatGlobal` (`id`, `user_id`, `pseudo`, `message`, `langue`, `date`) VALUES
(219, 22, 'papy', 'iugiugui', 'FR', '2023-04-05 12:01:56'),
(220, 22, 'papy', 'n', 'FR', '2023-04-05 12:02:25'),
(221, 22, 'papy', 'f', 'FR', '2023-04-05 12:05:53'),
(222, 22, 'papy', 'sv', 'FR', '2023-04-05 12:09:22'),
(223, 3, 'papy', 'qzdqzd', 'EN', '2023-04-05 12:10:30'),
(224, 22, 'papy', 'bruh', 'FR', '2023-04-05 12:20:56'),
(225, 22, 'papy', 'qzdq', 'EN', '2023-04-05 12:25:07'),
(226, 22, 'papy', 'yes', 'FR', '2023-04-05 13:02:37'),
(227, 22, 'papy', 'kekw', 'EN', '2023-04-05 13:02:47'),
(228, 22, 'papy', 'hmmm', 'FR', '2023-04-05 13:10:58'),
(229, 22, 'papy', ' ,,bbjbvfydyd', 'EN', '2023-04-05 13:11:43'),
(230, 22, 'papy', 'sdfghjklpo!ètrsxcvbn,klpàç!è§redcvbn,', 'FR', '2023-04-05 13:16:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `pseudo`, `email`, `password`, `img`) VALUES
(3, 'jean Fourest', 'PapyBruh', 'jm2@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(4, 'Biko Bikidik', 'bikUman', 'ligmaballs@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/users_pfp/HiK4amAYIGc.jpg'),
(5, 'ligma', 'balls', 'kek@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/users_pfp/pieds-laids-et-orteils-masculins-affectés-par-le-champignon-de-clou-d-orteil-les-hammertoes-arhtritic-vue-détail-des-142926072.jpg'),
(6, 'bast', 'Basvit', 'b@mail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(8, 'Vidal sylvian', 'zeez', 'sylvian.vidal95@gmail.com', 'bf2cb58a68f684d95a3b78ef8f661c9a4e5b09e82cc8f9cc88cce90528caeb27', './../assets/images/def.jpeg'),
(9, 'Alexandre', 'LeBGdu91', 'alexandre@gmail.com', '31281ffcab6b588bc3416d84cc83ac6a81bb0f8e646c0dbafab1ee44ac554655', './../assets/images/def.jpeg'),
(10, 'Julien qtx', 'Snow', 'julien.quatravaux@edu.esiee-it.fr', '14424f2ffc347e3ac4f0398470e98da85ca0475843b57976805184cad818bdea', './../assets/images/def.jpeg'),
(11, 'bruh', 'bruh', 'bruh@bruh.bruh', '2926743a9d118bfe4867f4d3c673168e7ae6e91a1e354df2fbc36468cdda5138', './../assets/users_pfp/pieds-laids-et-orteils-masculins-affectés-par-le-champignon-de-clou-d-orteil-les-hammertoes-arhtritic-vue-détail-des-142926072.jpg'),
(12, 'Salut moi', 'JeanIlSentMauvais', 'Ejjsjssj@gmail.com', '8608f2b8def157c9d8c79b2124932f3f37a82f39dd8163b707bbf9674fad67b9', './../assets/images/def.jpeg'),
(13, 'Salut cmoi', 'JeanSentMauvais', 'Jean@gmail.com', 'a4c3ef533ef0e7fa839b50a39b453b0eb734d4affe16bd123cb5534ca7c9d23a', './../assets/images/def.jpeg'),
(14, 'André De Sousa', 'LaLicorne', 'andre@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/users_pfp/andre.jpeg'),
(15, 'Michel Fourest', 'michel', 'mf@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(16, 'abc', 'abc', 'abc@abc.gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(17, 'ada', 'ada', 'tutu@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(18, 'a', 'a', 'tib@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(19, 'Fabien', 'mouloude', 'test@gmail.com', '37268335dd6931045bdcdf92623ff819a64244b53d0e746d438797349d4da578', './../assets/images/def.jpeg'),
(20, 'e', 't', 'tat@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(21, 'timmy', 'timmy', 'timmy@timmy.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(22, 'papy', 'papy', 'papy@papy.papy', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(24, 'alex', 'alex', 'alex@alex.alex', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/users_pfp/HiK4amAYIGc.jpg'),
(25, 'Roberto de la Casa', 'Roberto', 'roberto@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/users_pfp/Capture d’écran 2023-03-14 à 13.22.34.png'),
(26, 'Croc&#039;eau d&#039;île', 'Croceau', 'croceau0@gmail.com', 'cefd37901a51d3953bcb45663b74bcfea38ed378391ea4d0b59617496df6ffc4', './../assets/images/def.jpeg'),
(27, 'Fabien', 'fabien', 'fabarnal1@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg'),
(28, 'Bastien Vitour', 'Robert', 'bvitour2004@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/users_pfp/bastien-vitour-developpeur-web-fullstack-stage-alternance.jpg'),
(29, 'julien QTX', 'DarkSnow', 'julien.quatravaux@live.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', './../assets/images/def.jpeg'),
(30, 'adam', 'raaaaa', 'adamboissy2004@gmail.com', 'aa3d2fe4f6d301dbd6b8fb2d2fddfb7aeebf3bec53ffff4b39a0967afa88c609', './../assets/images/def.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ChatGlobal`
--
ALTER TABLE `ChatGlobal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ChatGlobal`
--
ALTER TABLE `ChatGlobal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
