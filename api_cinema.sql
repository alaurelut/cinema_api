-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 11 Juillet 2014 à 08:09
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `api_cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_user_followed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `following`
--

INSERT INTO `following` (`id`, `id_user`, `id_user_followed`) VALUES
(1, 4, 6),
(2, 4, 7),
(5, 8, 7),
(6, 9, 7);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id`, `genre`) VALUES
(1, 'aventure'),
(2, 'animation'),
(3, 'dramatique'),
(4, 'comedie'),
(5, 'science fiction'),
(6, 'documentaire'),
(7, 'horreur');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `genre` int(11) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`, `cover`) VALUES
(1, 'Star Wars', 1, 'http://www.leretourdujedi.fr/wp-content/uploads/2014/03/star-wars2.jpg'),
(2, 'Indiana Jones', 2, 'http://images.amcnetworks.com/ifc.com/wp-content/uploads/2012/06/062612-indiana-jones.jpg'),
(3, 'Dragons', 3, 'http://fr.web.img4.acsta.net/medias/nmedia/18/73/01/74/19343191.jpg'),
(6, 'Le Prestige', 4, 'http://articlemarin.a.r.pic.centerblog.net/o/e3d53061.jpg'),
(7, 'Pulp Fiction', 5, 'http://www.maxstreaming.com/wp-content/uploads/2013/12/Pulp-Fiction.jpg'),
(8, 'Le roi lion', 6, 'http://www.cinemapassion.com/film/Le-Roi-Lion-3709.php'),
(11, 'test2title', 1, 'test2cover'),
(12, 'Romain chez mémé', 4, 'http://media.melty.fr/article-721092-ajust_930/va-t-il-connaitre-le-meme-succes-en-f1-qu.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`) VALUES
(4, 'Quentin'),
(6, 'thomas'),
(7, 'jean'),
(8, 'Pierre'),
(9, 'Jacky'),
(10, 'Vincent'),
(11, 'Titi'),
(12, 'Mark'),
(13, 'Gerard'),
(14, 'Gogol'),
(15, 'Jennifer'),
(17, 'Romain'),
(18, 'Axel'),
(19, 'Jean Pierre'),
(20, 'Michel'),
(21, 'Michelou'),
(22, 'Rachelle'),
(23, 'Phoebe'),
(24, 'Joey'),
(25, 'Ross'),
(26, 'Chandler'),
(27, 'Monica'),
(28, 'Monicette'),
(29, 'Yvonne'),
(30, 'CHuck'),
(31, 'jojo'),
(32, 'terence'),
(33, 'edouard'),
(34, 'Alexis'),
(35, 'TestRom'),
(36, 'Gandalf');

-- --------------------------------------------------------

--
-- Structure de la table `user_movie`
--

CREATE TABLE IF NOT EXISTS `user_movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `liking` varchar(10) DEFAULT NULL,
  `watching` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `user_movie`
--

INSERT INTO `user_movie` (`id`, `id_user`, `id_movie`, `liking`, `watching`) VALUES
(11, 4, 1, 'no', NULL),
(13, 4, 2, 'yes', NULL),
(16, 4, 6, 'no', NULL),
(17, 4, 7, 'no', NULL),
(18, 4, 3, 'no', NULL),
(21, 4, 3, 'yes', NULL),
(22, 4, 3, NULL, 'yes'),
(23, 4, 1, NULL, 'no'),
(24, 4, 2, NULL, 'yes'),
(25, 8, 3, 'yes', NULL),
(27, 18, 8, 'yes', NULL),
(31, 18, 1, NULL, 'yes'),
(32, 18, 2, NULL, 'yes'),
(33, 18, 3, NULL, 'yes'),
(35, 18, 6, NULL, 'no'),
(37, 18, 7, NULL, 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
