-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 juin 2023 à 10:56
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet-piscine2023`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IdAdmin` int NOT NULL AUTO_INCREMENT,
  `E-mail` varchar(100) NOT NULL,
  `Pseudo` varchar(30) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`IdAdmin`, `E-mail`, `Pseudo`, `MotDePasse`) VALUES
(3, 'valentin.denis@edu.ece.fr', 'val', 'val');

-- --------------------------------------------------------

--
-- Structure de la table `apayer`
--

DROP TABLE IF EXISTS `apayer`;
CREATE TABLE IF NOT EXISTS `apayer` (
  `IdVente` int NOT NULL,
  `IdClient` int NOT NULL,
  `IdVendeur` int NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `PrixAchat` int NOT NULL,
  `PrixDepart` int NOT NULL,
  `Photo` varchar(400) NOT NULL,
  `Video` varchar(500) DEFAULT NULL,
  `Description` varchar(500) NOT NULL,
  `TypeAchat` enum('Enchere','Negociation') NOT NULL,
  `Categorie` enum('Accessible','Collection','Unique') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`,`IdVendeur`) USING BTREE,
  KEY `c11` (`IdClient`),
  KEY `cvendapayer` (`IdVendeur`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `autoenchere`
--

DROP TABLE IF EXISTS `autoenchere`;
CREATE TABLE IF NOT EXISTS `autoenchere` (
  `IdVente` int NOT NULL,
  `IdClient` int NOT NULL,
  `PrixMax` int NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`),
  KEY `c9` (`IdClient`),
  KEY `c10` (`IdVente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `IdClient` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `E-mail` varchar(100) NOT NULL,
  `Pseudo` varchar(30) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  `Adresse` varchar(535) NOT NULL,
  `CodePostal` int NOT NULL,
  `Ville` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `Panier` varchar(30) DEFAULT NULL,
  `TypeCarte` enum('Visa','MasterCard','American Express','PayPal') NOT NULL,
  `NumCarte` varchar(16) NOT NULL,
  `NomCarte` varchar(20) NOT NULL,
  `DateExpCarte` varchar(7) NOT NULL,
  `CodeCarte` int NOT NULL,
  `PorteMonnaie` int NOT NULL,
  `Photo` varchar(535) NOT NULL,
  PRIMARY KEY (`IdClient`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IdClient`, `Nom`, `Prenom`, `E-mail`, `Pseudo`, `MotDePasse`, `Adresse`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Panier`, `TypeCarte`, `NumCarte`, `NomCarte`, `DateExpCarte`, `CodeCarte`, `PorteMonnaie`, `Photo`) VALUES
(19, 'valou', 'valou', 'valou@edu.ece.fr', 'valou', 'valou', '43 rue de grennelle', 19090, 'Valouville', 'Albanie', '4446445554', '63', 'Visa', '190903', 'valou', '09/33', 190, 9943874, 'PhotoProfil/2021-McLaren-765LT-015-1600.jpg'),
(20, 'Denis', 'Valentin', 'valentin.denis@edu.ece.fr', 'valoup', 'valoup', '10 Rue Sextius Michel', 75015, 'Paris', 'France', '0629821633', NULL, 'Visa', '190903', 'Denis', '09/33', 197, 10000000, 'PhotoProfil/2021-Formula1-Alpine-A521-005-1600.jpg'),
(21, 'Layani', 'Antoine', 'antoine.layani@edu.ece.fr', 'ant', 'ant', '18 Rue Fondouze', 78018, 'Antony', 'France', '0636768949', NULL, 'Visa', '454654', 'ant', '09/29', 569, 500000, 'PhotoProfil/2014-Mercedes-Benz-SLS-AMG-Black-Series-009-1600.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `IdVente` int NOT NULL,
  `IdClient` int NOT NULL,
  `PrixActuel` int NOT NULL,
  PRIMARY KEY (`IdVente`),
  KEY `c8` (`IdClient`),
  KEY `c7` (`IdVente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `IdVente` int NOT NULL,
  `IdClient` int NOT NULL,
  `IdVendeur` int NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Photo` varchar(500) NOT NULL,
  `Video` varchar(500) DEFAULT NULL,
  `Categorie` enum('Accessible','Collection','Unique') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PrixDepart` int NOT NULL,
  `PrixAchat` int NOT NULL,
  `TypeAchat` enum('Immediat','Enchere','Negociation') NOT NULL,
  `Description` varchar(500) NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`,`IdVendeur`),
  KEY `c5` (`IdClient`),
  KEY `c6` (`IdVendeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, `Description`) VALUES
(55, 19, 17, 'Alpine A110 R', 'PhotoItem/2023-Alpine-A110-R-003-1600.jpg', NULL, 'Collection', 65000, 65000, 'Immediat', 'Alpine a dévoilé la A110 R, la version la plus légère et la plus extrême à ce jour. Il s\'agit d\'une révision complète de l\'A110 : la suspension, l\'échappement, la carrosserie et l\'aérodynamique ont été entièrement revus. Les nouvelles pièces en fibre de carbone telles que le capot, le couvre-moteur, l\'aileron arrière, le splitter avant et les roues sont légères et contribuent à générer plus de force d\'appui et moins de traînée qu\'auparavant.'),
(56, 19, 17, 'Polestar 1', 'PhotoItem/2020-Polestar-1-010-1600.jpg', NULL, 'Accessible', 40000, 40006, 'Negociation', 'La marque de performance de Volvo, Polestar, crée de toutes nouvelles voitures GT hybrides de 600 chevaux à carrosserie en fibre de carbone. Le groupe motopropulseur hybride se compose d\'un quatre cylindres de 2,0 litres à la fois turbocompressé et suralimenté situé à l\'avant, et de deux moteurs électriques montés sur l\'essieu arrière qui entraînent les roues arrière. La Polestar 1 aura une autonomie d\'environ 160 km en mode tout électrique '),
(57, 19, 17, 'Singer Turbo', 'PhotoItem/2022-Singer-Turbo-Study-001-1600.jpg', NULL, 'Unique', 180000, 300000, 'Negociation', 'Singer a dévoilé une 911 qui reprend à la fois la 930 originale et la 964 Turbo plus récente. Comme son nom l\'indique, elle est équipée d\'un moteur 6 cylindres à plat turbocompressé construit par Porsche Motorsport North America, d\'une puissance de base de 450 ch. Une boîte de vitesses manuelle à six rapports transmettra la puissance aux roues arrière, avec l\'option d\'une transmission intégrale.');

-- --------------------------------------------------------

--
-- Structure de la table `negociation`
--

DROP TABLE IF EXISTS `negociation`;
CREATE TABLE IF NOT EXISTS `negociation` (
  `IdVente` int NOT NULL,
  `IdClient` int NOT NULL,
  `NbNego` int NOT NULL,
  `PrixNego` int NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`),
  KEY `c3` (`IdVente`),
  KEY `c2` (`IdClient`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `negociation`
--

INSERT INTO `negociation` (`IdVente`, `IdClient`, `NbNego`, `PrixNego`) VALUES
(58, 19, 0, 1505);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `IdVendeur` int NOT NULL AUTO_INCREMENT,
  `E-mail` varchar(80) NOT NULL,
  `Pseudo` varchar(30) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  `Photo` varchar(535) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `PorteMonnaie` int NOT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`IdVendeur`, `E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `Nom`, `Prenom`, `Pays`, `Telephone`, `PorteMonnaie`) VALUES
(17, 'denisvalpro@gmail.com', 'vale', 'vale', 'PhotoProfil/2019-Formula1-Renault-RS19-001-1600.jpg', 'Valentin', 'Denis', 'Albanie', '0625851838', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `IdVente` int NOT NULL AUTO_INCREMENT,
  `IdVendeur` int NOT NULL,
  `Nom` varchar(40) NOT NULL,
  `Photo` varchar(500) DEFAULT NULL,
  `Video` varchar(500) DEFAULT NULL,
  `Description` varchar(535) NOT NULL,
  `Categorie` enum('Accessible','Collection','Unique') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PrixDepart` int NOT NULL,
  `PrixAchatImmediat` int NOT NULL,
  `TypeVente` enum('Negociation','Enchere') NOT NULL,
  `DateAjout` date NOT NULL,
  `DateFin` date NOT NULL,
  `Image2` varchar(535) NOT NULL,
  `Image3` varchar(535) NOT NULL,
  PRIMARY KEY (`IdVente`),
  KEY `c1` (`IdVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`IdVente`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Description`, `Categorie`, `PrixDepart`, `PrixAchatImmediat`, `TypeVente`, `DateAjout`, `DateFin`, `Image2`, `Image3`) VALUES
(58, 17, 'Ferrari F12tdf', 'PhotoItem/2016-Ferrari-F12tdf-014-1600.jpg', NULL, 'Le nom F12tdf rend hommage au Tour de France, course automobile qui s\'est déroulée entre 1899 et 1986 et qui a été régulièrement remportée par la Ferrari 250 entre 1956 et 1964.Il s\'agit de la version la plus dépouillée, ce qui signifie que le poids a été réduit de 110 kg grâce à l\'utilisation accrue de fibre de carbone, et que la puissance a été augmentée de 30 ch. ', 'Collection', 450000, 550000, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/2016-Ferrari-F12tdf-015-1600.jpg', 'PhotoItem/2016-Ferrari-F12tdf-012-1600.jpg'),
(59, 17, 'Porsche 911 Sport Classic', 'PhotoItem/2023-Porsche-911-Sport-Classic-008-1600.jpg', NULL, 'La 911 Sport Classic à tirage limité associe le groupe motopropulseur de la Turbo S à une boîte de vitesses manuelle et à une transmission arrière. La 911 Turbo S n\'étant disponible qu\'en boîte automatique, cette édition spéciale est la seule occasion de profiter de la puissance du moteur 3,7 litres flat 6 biturbo avec une boîte manuelle à 7 rapports. Cette particularité, associée au design extérieur et aux matériaux intérieurs, fait de cette 911 l\'une des plus intrigantes depuis longtemps.', 'Accessible', 180000, 286215, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/2023-Porsche-911-Sport-Classic-007-1600.jpg', 'PhotoItem/2023-Porsche-911-Sport-Classic-010-1600.jpg'),
(60, 17, 'MclarenF1', 'PhotoItem/1998-McLaren-F1-008-1600.jpg', NULL, 'La McLaren F1 est une voiture de sport conçue et fabriquée par Gordon Murray et McLaren Automotive. Le 31 mars 1998, elle a établi le record de la voiture de série la plus rapide au monde, avec une vitesse de 240 mph (391 km/h). Depuis avril 2009, trois voitures plus rapides ont succédé à la McLaren F1 en termes de vitesse de pointe, mais elle reste la voiture de série à moteur atmosphérique la plus rapide.', 'Collection', 1000000, 11000000, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/1998-McLaren-F1-012-1600.jpg', 'PhotoItem/1998-McLaren-F1-007-1600.jpg'),
(61, 17, 'McLaren MCL35M', 'PhotoItem/2021-Formula1-McLaren-MCL35M-011-1600.jpg', NULL, 'Daniel Ricciardo rejoint l\'équipe pour 2021 aux côtés de Lando Norris. Avec Ricciardo, qui a déjà gagné des courses, et Lando, qui est un jeune pilote prometteur, McLaren a l\'air d\'avoir un duo solide qui devrait se pousser mutuellement à donner le meilleur de lui-même. L\'équipe ne rivalisera probablement pas directement avec Mercedes ou Red Bull en 2021, mais elle est en mesure de continuer à réduire l\'écart et de rester très compétitive dans un milieu de peloton très disputé.', 'Unique', 5000000, 50000000, 'Enchere', '2023-06-01', '2023-06-12', 'PhotoItem/2021-Formula1-McLaren-MCL35M-012-1600.jpg', 'PhotoItem/2021-Formula1-McLaren-MCL35M-010-1600.jpg'),
(62, 17, 'Ford Mustang Dark Horse', 'PhotoItem/2024-Ford-Mustang-GT-002-1600.jpg', NULL, 'Avec le lancement de la toute nouvelle Mustang, Ford a saisi l\'occasion de faire quelque chose de différent avec sa gamme. Le châssis reçoit des amortisseurs robustes à commande magnétique, des barres stabilisatrices arrière plus grandes, un différentiel arrière Torsen, des freins Brembo de 19 pouces à six pistons, des renforts légers et des jantes en fibre de carbone en option. Une boîte manuelle Tremac à six rapports est proposée de série pour gérer les plus de 500 ch du V8 Coyote de 5,0 L sous le capot.', 'Accessible', 59565, 70000, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/2024-Ford-Mustang-Dark-Horse-005-1600.jpg', 'PhotoItem/2024-Ford-Mustang-Dark-Horse-007-1600.jpg'),
(64, 17, 'Nissan GT-R 50th Anniversary', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-008-1600.jpg', NULL, 'Nissan célèbre les 50 ans de la première GT-R en proposant des couleurs extérieures bicolores spéciales, dont le bleu Bayside (Wangan), une couleur que l\'on n\'avait pas vue sur une GT-R depuis la génération R34. Trois combinaisons de couleurs différentes seront disponibles pour la GT-R 50e anniversaire, avec le bleu Bayside et des bandes blanches, le blanc nacré avec des bandes rouges et le super argent avec des bandes blanches. ', 'Accessible', 70000, 115000, 'Negociation', '2023-06-01', '2023-06-05', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-009-1600.jpg', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-005-1600.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apayer`
--
ALTER TABLE `apayer`
  ADD CONSTRAINT `c1apayer` FOREIGN KEY (`IdVendeur`) REFERENCES `vendeur` (`IdVendeur`),
  ADD CONSTRAINT `c2apayer` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`);

--
-- Contraintes pour la table `autoenchere`
--
ALTER TABLE `autoenchere`
  ADD CONSTRAINT `c1aa` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`),
  ADD CONSTRAINT `c2aa` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`);

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `c7` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`),
  ADD CONSTRAINT `c8` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `c5` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`),
  ADD CONSTRAINT `c6` FOREIGN KEY (`IdVendeur`) REFERENCES `vendeur` (`IdVendeur`);

--
-- Contraintes pour la table `negociation`
--
ALTER TABLE `negociation`
  ADD CONSTRAINT `c2` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`),
  ADD CONSTRAINT `c3` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`);

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `c1` FOREIGN KEY (`IdVendeur`) REFERENCES `vendeur` (`IdVendeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
