-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 04 Août 2017 à 17:10
-- Version du serveur :  5.7.11-0ubuntu6
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mealoclock`
--

--
-- Contenu de la table `communities`
--

INSERT INTO `communities` (`id`, `community_name`, `short_desc`, `long_desc`, `picture`) VALUES
(2, 'Végétariens', 'Personne qui est adepte du végétarisme, qui se nourrit de végétaux et de produits d\'origine animale à l\'exclusion de la chair.', 'Le régime végétarien exclut toutes les protéines animales de l\'alimentation : ce régime est basé sur une alimentation de fruits,\n        légumes et céréales et permet de consommer des céréales et des légumes secs à chaque repas afin de consommer suffisamment de protéines. Certaines personnes\n        végétariennes s\'autorisent à manger de la viande de temps en temps. Les œufs et produits laitiers sont autorisés et apportent suffisamment de fer.', 'vegetarien.jpg'),
(3, 'Sans Gluten', 'Un régime sans gluten est un régime alimentaire excluant les aliments à base de gluten.', 'L\'intolérance au gluten touche environ 1% de la population. Cette pathologie est diagnostiquée précisément à l\'aide d\'une prise de sang suivie en cas de positivité d\'une fibroscopie gastrique.\n        Mais de nombreuses personnes ne présentant pas cette pathologie semblent se sentir mieux en éliminant totalement ou partiellement le gluten de leur alimentation.', 'sans-gluten.jpg'),
(4, 'Sans Lactose', 'Régime alimentaire sans lactose principalement présent dans le lait de vache...', 'L’intolérance au lactose est en fait, l’incapacité du corps à digérer le lactose, le sucre présent naturellement dans le lait. L’intolérance au lactose peut être évaluée cliniquement\n        par certains tests comme le test respiratoire à l’hydrogène post-charge de lactose, le test sanguin de tolérance au lactose ou par un test génétique. Une intolérance au lactose nécessite des changements\n        alimentaires pour éviter ces désagréments gastro-intestinaux.', 'sans-lait.png');

--
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`id`, `group_name`) VALUES
(1, 'member'),
(2, 'editor'),
(3, 'admin');

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `bio`, `address`, `city`, `wants_notif`, `picture`, `hangouts`, `skype`, `group_id`, `password`, `token_lost_pass`) VALUES
(3, 'Benjamin', 'Gahéry', 'benjamingahery@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Av. Leclerc', 'La Rochelle', 1, 'https://randomuser.me/api/portraits/men/97.jpg', NULL, NULL, 1, '$2y$10$pSSFSMnlVRgiwsLIADcfrehrFpXTF1KHTANIMxUFj1iDgKnH4EB4S', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
