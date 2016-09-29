-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Sam 24 Septembre 2016 à 13:34
-- Version du serveur: 5.5.49-cll-lve
-- Version de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ensakfor_examen`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `password`, `email`) VALUES
(1, 'Hafidi', 'Imad', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'imad.hafidi@gmail.com'),
(2, 'Fatima Ezzahra', 'Zouhir', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'fatimaezahrazouhir@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `correctionexamen`
--

CREATE TABLE IF NOT EXISTS `correctionexamen` (
  `id_examen` int(10) NOT NULL,
  `qcm` int(2) NOT NULL,
  `cours` int(2) NOT NULL,
  `exercices` int(2) NOT NULL,
  KEY `id_examen` (`id_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `correctionexamen`
--

INSERT INTO `correctionexamen` (`id_examen`, `qcm`, `cours`, `exercices`) VALUES
(7, 1, 1, 1),
(8, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `creationexamen`
--

CREATE TABLE IF NOT EXISTS `creationexamen` (
  `id_examen` int(10) NOT NULL,
  `qcm` int(2) NOT NULL,
  `cours` int(2) NOT NULL,
  `exercices` int(2) NOT NULL,
  KEY `id_examen` (`id_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `creationexamen`
--

INSERT INTO `creationexamen` (`id_examen`, `qcm`, `cours`, `exercices`) VALUES
(7, 1, 1, 1),
(8, 1, 1, 1),
(9, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `CIN` varchar(20) NOT NULL,
  `validation` int(2) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_filiere` (`id_filiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `prenom`, `password`, `email`, `CIN`, `validation`, `id_filiere`) VALUES
(20, 'Tanfioui', 'khaoula', 'JbZ9x3GkKw2LRYzQf*q+', 'khaoula.tanfioui@gmail.com', 'ML567139', 0, 3),
(47, 'Ghabti', 'Ikram', 'f6657542e456972e1043a7b30b11d26abb79fe1c', 'ikram.ghabti@gmail.com', 'AI369852', 0, 2),
(48, 'fatrah', 'aicha', '0e1c54fe546a07e7ae271b60f00c1fdec1d69535', 'aicha.fatrah@gmail.com', 'EM123456789', 0, 1),
(50, 'Hafidi', 'Imad', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'imad.hafidi@gmail.com', 'OS147258', 1, 1),

-- --------------------------------------------------------

--
-- Structure de la table `examens`
--

CREATE TABLE IF NOT EXISTS `examens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `id_filiere` int(10) NOT NULL,
  `id_module` int(10) NOT NULL,
  `id_professeur` int(10) NOT NULL,
  `p_date` datetime NOT NULL,
  `duree` time NOT NULL,
  `description` varchar(1000) NOT NULL,
  `isCreated` int(2) NOT NULL,
  `isQCM` int(2) NOT NULL,
  `isCoure` int(2) NOT NULL,
  `isExercice` int(2) NOT NULL,
  `isCorrection` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_filiere` (`id_filiere`),
  KEY `id_module` (`id_module`),
  KEY `id_professeur` (`id_professeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `examens`
--

INSERT INTO `examens` (`id`, `title`, `id_filiere`, `id_module`, `id_professeur`, `p_date`, `duree`, `description`, `isCreated`, `isQCM`, `isCoure`, `isExercice`, `isCorrection`) VALUES
(7, 'Examen final', 2, 3, 2, '2015-08-20 13:00:00', '02:03:00', 'Examen final en C++', 1, 1, 1, 1, 0),
(8, 'Controle', 3, 5, 2, '2015-09-03 09:15:00', '01:00:00', 'Controle  test', 1, 1, 1, 1, 0),
(9, 'Examen final', 2, 3, 2, '2015-09-24 08:30:00', '02:30:00', 'chapitre 1 -> 6', 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

CREATE TABLE IF NOT EXISTS `filieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `nbrModule` int(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `filieres`
--

INSERT INTO `filieres` (`id`, `intitule`, `niveau`, `nbrModule`, `description`) VALUES
(1, 'GÃ©nie Informatique', 'DeuxiÃ¨me annÃ©e', 16, 'Le Lorem Ipsum est simplement du faux texte employÃ© dans la composition et la mise en page avant impression.'),
(2, 'Tronc commun', 'premiÃ¨re annÃ©e cycle ingÃ©nieur', 16, 'Le Lorem Ipsum est simplement du faux texte employÃ© dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les annÃ©es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour rÃ©aliser un livre spÃ©cimen de polices de texte.'),
(3, 'genie logiciel', 'Licence', 2, 'Filiere formation continue : ensa khouribga'),
(4, 'Informatique appliquÃ©e', 'DeuxiÃ¨me annÃ©e', 8, 'just a test'),
(5, 'Licence Administration rÃ©seaux', 'Licence', 8, 'FiliÃ¨re formation continue');

-- --------------------------------------------------------

--
-- Structure de la table `linkmodule`
--

CREATE TABLE IF NOT EXISTS `linkmodule` (
  `id_module` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_professeur` int(11) NOT NULL,
  `semestre` varchar(2) NOT NULL,
  KEY `id_module` (`id_module`,`id_filiere`,`id_professeur`),
  KEY `id_filiere` (`id_filiere`),
  KEY `id_professeur` (`id_professeur`),
  KEY `id_professeur_2` (`id_professeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `linkmodule`
--

INSERT INTO `linkmodule` (`id_module`, `id_filiere`, `id_professeur`, `semestre`) VALUES
(3, 2, 2, 'S2'),
(4, 5, 9, 'S1');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `intitule`, `description`) VALUES
(1, 'Programmation procÃ©durale & Algorithmique', 'modification'),
(3, 'Unix et programmation : Shell-C++', 'Plusieurs variations de Lorem Ipsum peuvent Ãªtre trouvÃ©es ici ou lÃ , mais la majeure partie d''entre elles a Ã©tÃ© altÃ©rÃ©e par l''addition d''humour ou de mots alÃ©atoires qui ne ressemblent pas une seconde Ã  du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez Ãªtre sÃ»r qu''il n''y a rien d''embarrassant cachÃ© dans le texte. '),
(4, 'C', 'Langage c'),
(5, 'SI BD', 'Base de donnes '),
(8, 'JEE', 'JEE'),
(9, 'Gestion projet', 'MS project'),
(10, 'Programation web', 'php html');

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE IF NOT EXISTS `professeurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `professeurs`
--

INSERT INTO `professeurs` (`id`, `nom`, `prenom`, `password`, `email`, `description`) VALUES
(2, 'Hakimi', 'Driss', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'driss.hakimi@gmail.com', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empÃªche de se concentrer sur la mise en page elle-mÃªme. L''avantage du Lorem Ipsum sur un texte gÃ©nÃ©rique comme ''Du texte. Du texte.'),
(3, 'Hafidi', 'Imad', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'imad.hafidi@gmail.com', 'Le Lorem Ipsum est simplement du faux texte employÃ© dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les annÃ©es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour rÃ©aliser un livre spÃ©cimen de polices de texte.'),
(9, 'amnai', 'mohammed', 'd94fcb127b0d48b9340c79eeba33f1e925101cff', 'amant.mahammed@gmail.com', 'Professeur Admin Base donnÃ©es et BI'),
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `correctionexamen`
--
ALTER TABLE `correctionexamen`
  ADD CONSTRAINT `correctionexamen_ibfk_2` FOREIGN KEY (`id_examen`) REFERENCES `examens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `creationexamen`
--
ALTER TABLE `creationexamen`
  ADD CONSTRAINT `creationexamen_ibfk_2` FOREIGN KEY (`id_examen`) REFERENCES `examens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `examens`
--
ALTER TABLE `examens`
  ADD CONSTRAINT `examens_ibfk_5` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examens_ibfk_6` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examens_ibfk_7` FOREIGN KEY (`id_professeur`) REFERENCES `professeurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `linkmodule`
--
ALTER TABLE `linkmodule`
  ADD CONSTRAINT `linkmodule_ibfk_4` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linkmodule_ibfk_5` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linkmodule_ibfk_6` FOREIGN KEY (`id_professeur`) REFERENCES `professeurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
