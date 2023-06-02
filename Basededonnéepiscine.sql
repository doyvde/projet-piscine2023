-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 juin 2023 à 08:28
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
-- Base de données : `eceagorafrancia`
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
(1, 'valentin.denis@edu.ece.fr', 'Val', 'valentin'),
(2, 'amaury.forestier.ece.edu.fr', 'Amry', 'amaury'),
(3, 'val', 'val', 'val'),
(4, 'antoine.layani@edu.ece.fr', 'Ant', 'antoine');

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

--
-- Déchargement des données de la table `apayer`
--

INSERT INTO `apayer` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `PrixAchat`, `PrixDepart`, `Photo`, `Video`, `Description`, `TypeAchat`, `Categorie`) VALUES
(14, 6, 2, 'Montre Rolex DayJust', 17000, 15000, 'PhotoItem/Datejust.png', NULL, 'Rolex en or lunette cannelée ', 'Enchere', 'Accessible'),
(15, 7, 1, 'Rolex Milgauss', 6500, 6500, 'PhotoItem/Milgauss.png', NULL, 'Une super belle montre Rolex pas tres chere', 'Enchere', 'Accessible'),
(25, 3, 6, 'Boite Bijou en Verre', 450, 400, 'PhotoItem/Bijou4.PNG', NULL, 'Je vends cette superbe boite en or', 'Enchere', 'Accessible'),
(27, 6, 5, 'Ferrari 250 GTO', 400000, 400000, 'PhotoItem/Voiture1.PNG', NULL, 'Je vends ma Ferrari car je ne roule plus avec.', 'Enchere', 'Unique'),
(29, 8, 8, 'Tableau Lion', 300, 300, 'PhotoItem/Tableau2.PNG', NULL, 'Super tableau qui n a plus sa place chez moi, il vous fera rugir de plaisir.', 'Enchere', 'Accessible'),
(30, 8, 8, 'Vase Grec', 12000, 8000, 'PhotoItem/Vase1.PNG', NULL, 'Ce vase est un vase de collection, a ne pas rater', 'Negociation', 'Collection'),
(31, 7, 8, 'McLaren 720s', 310000, 300000, 'PhotoItem/Voiture3.PNG', NULL, 'Je vends ma voiture qui avance tres vite.', 'Enchere', 'Unique'),
(39, 6, 2, 'Nuit Ã©toilÃ©e ', 300000, 300000, 'PhotoItem/Tableau5.PNG', NULL, 'Tableau original de la nuit etoile peint par Van Gogh lui meme.', 'Enchere', 'Collection'),
(44, 1, 5, 'Omega Speedmaster', 4100, 3600, 'PhotoItem/Omega.PNG', NULL, 'Montre Omega qui est allÃ©e sur la lune, a ne pas rater, annÃ©e 2016, Etat : 8/10.', 'Negociation', 'Unique');

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
(1, 'Simpson', 'Bart', 'bartsimpson@edu.ece.fr', 'bart', 'simpson', '123 route de bart', 13009, 'Springfield', 'USA', '0625032528', NULL, 'Visa', '1234123412341234', 'Bart Simpson', '12/2020', 123, 7793, ''),
(2, 'Simpson', 'Lisa', 'lisasimpson@edu.ece.fr', 'lisa', 'simpson', '123 route de bart', 13009, 'Springfield', 'USA', '0625032529', NULL, 'Visa', '3456345634563456', 'Lisa Simpson', '08/2020', 141, 250, ''),
(3, 'Simpson', 'Maggie', 'maggiesimpson@edu.ece.fr', 'maggie', 'simpson', '123 route de bart', 13009, 'Springfield', 'USA', '0625032529', NULL, 'MasterCard', '1234567812345678', 'Maggie Simpson', '12/2022', 234, 10000, ''),
(4, 'Smith', 'Morty', 'Morty.smith@ece.fr', 'morty', 'smith', '14 rue de l\'espace', 12000, 'Mars', 'Macedoine', '0989896756', '15,22', 'American Express', '1111222233334444', 'Morty Smith', '12/2022', 567, 476300, ''),
(5, 'Messi', 'Lionel', 'lionel.messi@ece.fr', 'lionel', 'messi', '122 rue du camp nou', 78888, 'Barcelone', 'Espagne', '0855949329', NULL, 'MasterCard', '3333777788884444', 'Lionel Messi', '01/2021', 789, 780000, ''),
(6, 'Macron', 'Emmanuel', 'parcequecnotreprojet@elysee.fr', 'emmanuel', 'macron', '55 rue du Faubourg-Saint-HonorÃ©', 75008, 'Paris', 'France', '0491229939', '27', 'American Express', '6666777733338888', 'Emmanuel Macron', '09/2023', 735, 500000, ''),
(7, 'Trump', 'Donald', 'donald.trump@ece.fr', 'donald', 'trump', 'La maison Blanche', 90001, 'Washington', 'Etats_Unis', '0444955396', NULL, 'American Express', '5656454578789898', 'Donald Trump', '07/2023', 678, 800000, ''),
(8, 'Raoult', 'Didier', 'coronavirus@ece.fr', 'didier', 'raoult', '12 rue du virus', 13008, 'Marseille', 'France', '0899923939', NULL, 'MasterCard', '1222334050402839', 'Didier Raoult', '08/2021', 230, 70000, ''),
(19, 'valou', 'valou', 'valou@valou', 'valou', 'valou', 'valou', 190903, 'valouville', 'Albanie', '4446445554', NULL, 'Visa', '190903', 'valou', '09/03', 190, 9943874, 'PhotoProfil/2021-McLaren-765LT-015-1600.jpg'),
(20, 'Valentin', 'Denis', 'denisvalpro@gmail.com', 'valoup', 'valoup', '288 Rue de Vaugirard', 75015, 'Paris', 'France', '0625851838', NULL, 'Visa', '190903', 'Denis', '09/03', 197, 10000000, 'PhotoProfil/2021-Formula1-Alpine-A521-005-1600.jpg'),
(21, 'Layani', 'Antoine', 'ant@ant', 'ant', 'ant', 'antony', 78018, 'antony', 'France', '06932558', NULL, 'Visa', '454654', 'ant', '45/89', 569, 500000, 'PhotoProfil/2014-Mercedes-Benz-SLS-AMG-Black-Series-009-1600.jpg');

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
(13, 4, 1, 'Montre Pepsi', 'PhotoItem/Pepsi.png', NULL, 'Unique', 16000, 17000, 'Negociation', 'Une gmt master 2 pepsi 2015 '),
(36, 5, 2, 'collier diamant', 'PhotoItem/Bijou2.PNG', NULL, 'Unique', 44000, 120000, 'Immediat', 'Je souhaite changer de collier alors je vends celui la serti de diamants '),
(45, 4, 6, 'Tableau Iron man', 'PhotoItem/Tableau1.PNG', NULL, 'Accessible', 400, 3300, 'Immediat', 'je vends ce tableau que j ai moi meme peint dans mon garage.'),
(54, 19, 17, 'nissan gtr', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-008-1600.jpg', NULL, 'Accessible', 1600, 16000, 'Immediat', 'belle voiture'),
(55, 19, 17, 'alpine', 'PhotoItem/2023-Alpine-A110-R-003-1600.jpg', NULL, 'Collection', 1900, 19000, 'Immediat', 'alpine de collec'),
(56, 19, 17, 'Polestar 1', 'PhotoItem/2020-Polestar-1-010-1600.jpg', NULL, 'Unique', 2000, 2006, 'Negociation', 'blanc'),
(57, 19, 17, 'Singer Turbo', 'PhotoItem/2022-Singer-Turbo-Study-001-1600.jpg', NULL, 'Accessible', 1800, 3000, 'Negociation', 'pas une porsche');

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
(1, 'homersimpson@edu.ece.fr', 'homer', 'simpson', 'PhotoProfil/homer.png', 'Simpson', 'Homer', 'USA', '0625032525', 0),
(2, 'margesimpson@edu.ece.fr', 'marge', 'simpson', 'PhotoProfil/marge.png', 'Simpson', 'Marge', 'USA', '0625032526', 0),
(5, 'james.bond@ece.fr', 'james', 'bond', 'PhotoProfil/James.PNG', 'Bond', 'James', 'Royaume_Uni', '0607080910', 0),
(6, 'rickdelespace@ece.fr', 'rick', 'smith', 'PhotoProfil/Rick.PNG', 'Smith', 'Rick', 'Micronesie', '1234567891', 0),
(7, 'handoftheking@ece.fr', 'tyrion', 'lannister', 'PhotoProfil/Tyrion.PNG', 'Lannister', 'Tyrion', 'Macedoine', '0804576819', 0),
(8, 'onaletoile@om.fr', 'andre', 'villas', 'PhotoProfil/Villas.PNG', 'Villas Boas', 'AndrÃ©', 'Portugal', '0709193494', 0),
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
(58, 17, 'valentin', 'PhotoItem/2016-Ferrari-F12tdf-014-1600.jpg', NULL, 'dregfhsr', 'Accessible', 1500, 15000, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/', 'PhotoItem/'),
(59, 17, 'porsche', 'PhotoItem/2023-Porsche-911-Sport-Classic-008-1600.jpg', NULL, 'porsche', 'Accessible', 1800, 18000, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/', 'PhotoItem/'),
(60, 17, 'MclarenF1', 'PhotoItem/1998-McLaren-F1-008-1600.jpg', NULL, 'mclarenF1', 'Unique', 3000, 30000, 'Enchere', '2023-06-01', '2023-06-12', 'PhotoItem/', 'PhotoItem/'),
(61, 17, 'F1Mclaren', 'PhotoItem/2021-Formula1-McLaren-MCL35M-011-1600.jpg', NULL, 'Formul1 de Norris', 'Unique', 5000, 50000, 'Enchere', '2023-06-01', '2023-06-12', 'PhotoItem/', 'PhotoItem/'),
(62, 17, 'Mustang', 'PhotoItem/2024-Ford-Mustang-GT-002-1600.jpg', NULL, 'Mustang', 'Accessible', 1600, 16000, 'Negociation', '2023-06-01', '2023-06-12', 'PhotoItem/2024-Ford-Mustang-GT-002-1600.jpg', 'PhotoItem/'),
(63, 17, 'AMGOne', 'PhotoItem/2023-Mercedes-AMG-ONE-008-1600.jpg', NULL, 'la plus radicale des AMG', 'Unique', 50000, 500000, 'Enchere', '2023-06-01', '2023-06-03', 'PhotoItem/2023-Mercedes-AMG-ONE-005-1600.jpg', 'PhotoItem/'),
(64, 17, 'nissan gtr', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-008-1600.jpg', NULL, 'gtr r35', 'Collection', 1900, 19000, 'Enchere', '2023-06-01', '2023-06-05', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-009-1600.jpg', 'PhotoItem/2020-Nissan-GT-R-50th-Anniversary-005-1600.jpg');

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
