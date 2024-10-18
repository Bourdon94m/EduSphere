-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 oct. 2024 à 22:48
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eduspheretest`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `created_at`) VALUES
(1, 'La formation ultime PHP', 'Cette formation PHP s’adresse aux débutants ainsi qu’aux développeurs souhaitant approfondir leurs compétences en développement web. Elle couvre les bases du langage ainsi que les concepts plus avancés pour développer des sites web dynamiques et interactifs.\r\n\r\nObjectifs de la formation :\r\nComprendre les fondamentaux du langage PHP\r\nCréer des scripts PHP pour générer du contenu dynamique\r\nInteragir avec une base de données (MySQL) pour stocker et récupérer des informations\r\nGérer les sessions et les cookies pour la personnalisation des utilisateurs\r\nSécuriser les applications web avec des techniques contre les failles courantes\r\nMaîtriser l\'intégration de PHP avec HTML, CSS, et JavaScript pour des interfaces modernes\r\nContenu de la formation :\r\nIntroduction à PHP :\r\n\r\nHistorique et présentation du langage\r\nInstallation de l’environnement de développement (WAMP, XAMPP)\r\nSyntaxe de base et structure des scripts PHP\r\nVariables, types de données et opérateurs :\r\n\r\nVariables et constantes\r\nTypes de données en PHP\r\nUtilisation des opérateurs arithmétiques, logiques et de comparaison\r\nStructures de contrôle :\r\n\r\nConditions : if, else, switch\r\nBoucles : for, while, foreach\r\nGestion des erreurs\r\nFonctions et manipulation de chaînes de caractères :\r\n\r\nCréation et utilisation de fonctions en PHP\r\nPassage de paramètres et valeurs de retour\r\nManipulation et formatage de chaînes\r\nGestion des formulaires et validation :\r\n\r\nRécupération des données des formulaires\r\nValidation des entrées utilisateur\r\nProtection contre les injections SQL\r\nInteragir avec une base de données MySQL :\r\n\r\nConnexion à une base de données\r\nRequêtes SQL : SELECT, INSERT, UPDATE, DELETE\r\nUtilisation de PDO (PHP Data Objects) pour des interactions sécurisées\r\nSessions, cookies et authentification :\r\n\r\nGestion des sessions PHP\r\nUtilisation des cookies pour stocker les informations utilisateur\r\nSystèmes d’authentification et gestion des permissions\r\nSécurité des applications PHP :\r\n\r\nProtection contre les attaques XSS et CSRF\r\nPrévention des injections SQL\r\nBonnes pratiques pour sécuriser vos scripts\r\nPHP et les frameworks :\r\n\r\nIntroduction aux frameworks PHP (Laravel, Symfony)\r\nCréation d’une application simple avec un framework\r\nProjet final :\r\n\r\nDéveloppement d’un site web complet utilisant PHP, MySQL, et intégrant HTML, CSS et JavaScript\r\nPublic cible :\r\nDéveloppeurs débutants ou intermédiaires souhaitant créer des applications web dynamiques\r\nÉtudiants en informatique ou webdesign\r\nProfessionnels en reconversion cherchant à acquérir des compétences en programmation web\r\nPrérequis :\r\nConnaissances de base en HTML et CSS recommandées\r\nAucune expérience préalable en PHP requise\r\nÀ la fin de la formation, les participants seront capables de concevoir et de développer des sites web dynamiques et sécurisés, tout en appliquant les meilleures pratiques du développement web moderne.', 39.99, 100, 'http://127.0.0.1/EduSphere/src/images/formations/phpforeveryone1.png', '2024-10-07 06:45:38'),
(2, 'La formation complète Python', 'Cette formation Python est idéale pour les débutants comme pour les développeurs cherchant à maîtriser l’un des langages les plus polyvalents et demandés du moment. Vous apprendrez à automatiser des tâches, développer des applications web, manipuler des données et bien plus encore.\r\n\r\nObjectifs de la formation :\r\nComprendre la syntaxe et les concepts fondamentaux de Python\r\nÉcrire des scripts Python pour automatiser des processus\r\nManipuler des fichiers et des bases de données\r\nUtiliser Python pour le développement web avec Django et Flask\r\nExplorer les bibliothèques populaires pour la science des données et l’intelligence artificielle\r\nCréer des interfaces utilisateurs graphiques\r\nAppliquer les bonnes pratiques de programmation\r\n\r\nContenu de la formation :\r\nIntroduction à Python :\r\n\r\nPrésentation du langage et installation\r\nSyntaxe de base : variables, types de données et opérateurs\r\nStructures de contrôle : conditions et boucles\r\nFonctions, modules et gestion des erreurs\r\n\r\nProgrammation orientée objet :\r\n\r\nClasses, objets et héritage\r\nEncapsulation, abstraction et polymorphisme\r\n\r\nManipulation de fichiers et bases de données :\r\n\r\nLire et écrire dans des fichiers\r\nConnexion et manipulation de bases de données SQL et NoSQL\r\n\r\nBibliothèques pour la science des données et IA :\r\n\r\nUtilisation de Pandas et NumPy pour le traitement des données\r\nIntroduction à la machine learning avec Scikit-learn\r\n\r\nDéveloppement web avec Python :\r\n\r\nCréation d’applications web avec Django et Flask\r\nGestion des routes, des bases de données et des sessions\r\n\r\nProjet final :\r\n\r\nDéveloppement d’une application Python complète intégrant les concepts abordés\r\n\r\nPublic cible :\r\nDéveloppeurs, analystes de données ou toute personne souhaitant apprendre Python pour divers domaines\r\nÉtudiants et professionnels en reconversion\r\n\r\nPrérequis :\r\nAucune expérience préalable en programmation n’est requise. Les participants apprendront Python à partir des bases.', 49.99, 100, 'http://127.0.0.1/EduSphere/src/images/formations/pythonforeveryone1.png', '2024-10-07 06:46:25'),
(3, 'La formation JavaScript moderne', 'Cette formation JavaScript vous apprendra à maîtriser le langage du web et à créer des interfaces utilisateur dynamiques. Que vous soyez débutant ou expérimenté, vous apprendrez à écrire des scripts robustes et à intégrer JavaScript dans des applications web modernes.\r\n\r\nObjectifs de la formation :\r\nComprendre les fondamentaux du langage JavaScript\r\nManipuler le DOM pour interagir avec les éléments HTML\r\nMaîtriser la programmation asynchrone (promesses, async/await)\r\nUtiliser JavaScript pour les applications web frontend et backend (Node.js)\r\nApprendre les frameworks modernes comme React ou Vue.js\r\n\r\nContenu de la formation :\r\nIntroduction à JavaScript :\r\n\r\nPrésentation et configuration de l’environnement\r\nSyntaxe de base, variables, types de données et opérateurs\r\nStructures de contrôle : conditions et boucles\r\nFonctions et portée des variables\r\n\r\nProgrammation orientée objet en JavaScript :\r\n\r\nPrototypes, objets et classes\r\nFonctions constructeurs et héritage\r\n\r\nManipulation du DOM :\r\n\r\nSélection et manipulation d’éléments HTML\r\nGestion des événements\r\nAnimations et transitions\r\n\r\nProgrammation asynchrone :\r\n\r\nFonctions asynchrones, callbacks, promesses et async/await\r\nRequêtes HTTP avec Fetch API\r\n\r\nJavaScript côté serveur avec Node.js :\r\n\r\nIntroduction à Node.js\r\nCréation d’un serveur et gestion des routes\r\nConnexion à une base de données avec MongoDB\r\n\r\nFrameworks modernes :\r\n\r\nIntroduction à React et Vue.js\r\nCréation d’une application avec React\r\n\r\nProjet final :\r\n\r\nCréation d’une application web dynamique intégrant JavaScript frontend et backend\r\n\r\nPublic cible :\r\nDéveloppeurs frontend et backend souhaitant approfondir leur maîtrise de JavaScript\r\nÉtudiants ou professionnels cherchant à se spécialiser dans le développement web moderne\r\n\r\nPrérequis :\r\nConnaissances de base en HTML et CSS recommandées. Aucune expérience préalable en JavaScript n’est requise.', 59.99, 100, 'http://127.0.0.1/EduSphere/src/images/formations/javascriptforeveryone1.png', '2024-10-07 06:46:37'),
(4, 'Intro To Django With Python\r\nFor Web Development', 'Apprenez à créer votre propre site e-commerce avec Django, le framework web Python puissant et flexible.\r\nProgramme :\r\n\r\nIntroduction à Django et configuration de l\'environnement\r\nModèles de données pour produits, commandes et clients\r\nVues et templates pour afficher le catalogue et les pages produits\r\nPanier d\'achat et processus de commande\r\nSystème d\'authentification et gestion des comptes clients\r\nIntégration de paiements sécurisés\r\nOptimisation des performances et mise en cache\r\nDéploiement de votre site e-commerce\r\n\r\nDurée : 5 jours (35 heures)\r\nPrérequis : Connaissances de base en Python\r\nÀ la fin de cette formation, vous serez capable de développer et de gérer votre propre plateforme e-commerce avec Django.', 69.99, 100, 'http://127.0.0.1/EduSphere/src/images/formations/djangoforeveryone1.png', '2024-10-07 22:00:00'),
(5, 'Introduction à Node.js pour le Développement Web', 'Découvrez comment créer des applications web performantes avec Node.js, la plateforme JavaScript côté serveur.\r\n        Programme :\r\n\r\n        1. Introduction à Node.js et à l\'environnement JavaScript côté serveur\r\n        2. Configuration de l\'environnement de développement Node.js\r\n        3. Concepts fondamentaux : modules, événements et streams\r\n        4. Création d\'un serveur web avec Express.js\r\n        5. Gestion des routes et middleware\r\n        6. Intégration avec les bases de données (MongoDB et SQL)\r\n        7. Authentification et autorisation des utilisateurs\r\n        8. API RESTful et gestion des requêtes AJAX\r\n        9. Temps réel avec Socket.io\r\n        10. Déploiement d\'applications Node.js\r\n\r\n        Durée : 5 jours (35 heures)\r\n        Prérequis : Connaissances de base en JavaScript\r\n        À la fin de cette formation, vous serez capable de développer des applications web complètes et évolutives avec Node.js.', 79.99, 33, 'http://127.0.0.1/EduSphere/src/images/formations/nodejsforeveryone1.png', '2024-10-07 22:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `created_at`, `reset_token`, `reset_token_expiry`) VALUES
(1, 'Jean@gmail.com', '$2y$10$LkAgVkPyCfzNJzSWer3GguU75Erm6rm4Xz33AmyIvTlnh6NfusRWq', 'Jean Mounir', '2024-10-05 10:52:13', NULL, NULL),
(2, 'matthieu.pro94@gmail.com', '$2y$10$nHSc.0sv7yDwoRVynCw9q.r0A2HXww7X8o9ROXfYr3gHVs74hAZxO', 'Matthieu Poulard', '2024-10-05 20:40:27', NULL, NULL),
(4, 'contact.bestwo@gmail.com', '$2y$10$CyuTMZ5OjOsgkXWySP9ckO9/U4Xdstblb7zDwRHz3.22c2qu0Muj2', 'Aminou', '2024-10-07 16:50:16', '2b4b4447942c4e4e9ce9e97c555ec0d93a5026b6ea105e7028470be5fb022a47', '2024-10-07 19:50:49'),
(5, 'ThomasJedusor@gmail.com', '$2y$10$yfth9f4MhHGCeUpiucFode2r5Q3cGPL445zUUpeeUzhTNcSihafoS', 'Thomas Jédusor', '2024-10-07 18:53:55', NULL, NULL),
(7, 'jetebaise@gmail.com', '$2y$10$mthQ4pR5CN3IBgPVDyfS4eTmYT41HRpNRqG6a9DcTrsERACJB5n5S', 'Jete Baise', '2024-10-07 18:56:13', NULL, NULL),
(8, 'marie@gmail.com', '$2y$10$bxvlUqAcjMGq3.iLyBKHHOknxQhXUBFs695HjwXtM0X8WoZj4EWFW', 'Marie', '2024-10-07 18:57:05', NULL, NULL),
(9, 'marie1@gmail.com', '$2y$10$ogMtMzc4yd4Go68khZEPnesZPZ5tm.Isq7mBZBUYKgejqdtn5QPr.', 'Marie', '2024-10-07 18:58:00', NULL, NULL),
(10, 'marie2@gmail.com', '$2y$10$zHKfLzpzGUPjONyIfbjH4.hjgqD0XvTPbGzC2psvYMKmw4Dzqo0Xe', 'Marie', '2024-10-07 18:59:27', NULL, NULL),
(11, 'Miamiasme@gmail.com', '$2y$10$yF5jaUlamYMWN79iDW0rQOkXKsnxP8zp6q.OGD/dKAV7VNu/TlWvi', 'Moule ', '2024-10-07 19:05:23', NULL, NULL),
(12, 'Msardou@sard.net', '$2y$10$JTKf0ngzWrh5qdzroeoB.uTilV/eQe7KHEjB9zuMiIHi1r46jlu9G', 'Michel Sardou', '2024-10-07 19:06:54', NULL, NULL),
(13, 'Msardou@sard.nete', '$2y$10$VHzP2sWVXO9izki5Ss4KHeht1EbIp9mSRv4SsAM8EThGDP7mk.pFW', 'Michel Sardou', '2024-10-07 19:07:20', NULL, NULL),
(14, 'Testuser@gmail.com', '$2y$10$/SENRts.bUckhh03mm.AluGPWMHhzdAG0l36BMJ5DJ0mvE1lwsBP.', 'Test User', '2024-10-08 14:05:01', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_reset_token` (`reset_token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
