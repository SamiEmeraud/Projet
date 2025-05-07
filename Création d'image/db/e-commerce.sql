-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 avr. 2025 à 10:25
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `adress`
--

DROP TABLE IF EXISTS `adress`;
CREATE TABLE IF NOT EXISTS `adress` (
  `adress_id` int NOT NULL AUTO_INCREMENT,
  `street_number` int NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `postal_code` int NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`adress_id`),
  KEY `fk_adress_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `birthdays`
--

DROP TABLE IF EXISTS `birthdays`;
CREATE TABLE IF NOT EXISTS `birthdays` (
  `id_birthday` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `date_birthday` date NOT NULL,
  PRIMARY KEY (`id_birthday`),
  KEY `fk_birthdays_users` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_orders` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `order_item_id` int NOT NULL,
  PRIMARY KEY (`id_orders`),
  KEY `fk_user_orders_id` (`id_user`),
  KEY `fk_orders_item_orders_id` (`order_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `orders_item_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `statue` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `orders_date` date NOT NULL,
  PRIMARY KEY (`orders_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int NOT NULL,
  `stock_quantity` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `id_shopping_cart` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `cart_item_id` int NOT NULL,
  PRIMARY KEY (`id_shopping_cart`),
  KEY `fk_shoppingcart` (`cart_item_id`),
  KEY `fk_shoppingcart_id` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shoppingcart_items`
--

DROP TABLE IF EXISTS `shoppingcart_items`;
CREATE TABLE IF NOT EXISTS `shoppingcart_items` (
  `cart_item_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `date_panier` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `statue` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adress`
--
ALTER TABLE `adress`
  ADD CONSTRAINT `fk_adress_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
