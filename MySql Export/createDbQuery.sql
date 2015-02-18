# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Hôte: 127.0.0.1 (MySQL 5.6.10)
# Base de données: just4you
# Temps de génération: 2015-02-18 00:23:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table client
# ------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `idClient` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) NOT NULL DEFAULT '',
  `lastname` varchar(64) NOT NULL DEFAULT '',
  `address` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`idClient`),
  UNIQUE KEY `idClient` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;

INSERT INTO `client` (`idClient`, `firstname`, `lastname`, `address`)
VALUES
	(1,'Amanzou','Amine','16, rue de la route'),
	(2,'Foucault','Dimitri','2, Rue des 2 avenues'),
	(3,'Robert','LMoutchou','43, Rue de l\'himalaya'),
	(4,'Christophe','Hu','12, Avenue porte d\'ivry');

/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `idOrder` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idClient` int(11) unsigned NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateOrder` datetime DEFAULT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idOrder`),
  UNIQUE KEY `idCommande` (`idOrder`),
  KEY `idClient` (`idClient`),
  KEY `codeBarre` (`idProduct`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`idOrder`, `idClient`, `idProduct`, `quantity`, `dateOrder`, `payed`)
VALUES
	(1,1,1,3,'2015-02-17 17:19:22',0),
	(2,3,4,3,NULL,0),
	(3,4,1,7,NULL,0);

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `idProduct` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `customer` varchar(64) NOT NULL DEFAULT '',
  `limit` float NOT NULL,
  `quantitySupply` int(11) NOT NULL,
  `quantityToReorder` int(11) NOT NULL,
  PRIMARY KEY (`idProduct`),
  UNIQUE KEY `codeBarre` (`idProduct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`idProduct`, `name`, `customer`, `limit`, `quantitySupply`, `quantityToReorder`)
VALUES
	(1,'iPhone','Apple',5,3,20),
	(2,'Galaxy','Samsung',2,1,10),
	(4,'Xperia','Sony',5,7,6);

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `onNewProduct` AFTER INSERT ON `product` FOR EACH ROW BEGIN
    IF NEW.quantitySupply < NEW.limit THEN
        INSERT INTO reorder(quantityReorder,idProduct) 
		VALUES (NEW.quantityToReorder,NEW.idProduct);
    END IF;
END */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `onNewOrder` BEFORE UPDATE ON `product` FOR EACH ROW BEGIN
    IF OLD.quantitySupply >= OLD.limit and NEW.quantitySupply < OLD.limit THEN
        INSERT INTO reorder(quantityReorder,idProduct) 
		VALUES (OLD.quantityToReorder,OLD.idProduct);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Affichage de la table reorder
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reorder`;

CREATE TABLE `reorder` (
  `idReorder` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantityReorder` int(11) NOT NULL,
  `dateDelivery` datetime DEFAULT NULL,
  `idProduct` int(11) NOT NULL,
  PRIMARY KEY (`idReorder`),
  UNIQUE KEY `idReapp` (`idReorder`),
  KEY `codeBarre` (`idProduct`),
  CONSTRAINT `reorder_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reorder` WRITE;
/*!40000 ALTER TABLE `reorder` DISABLE KEYS */;

INSERT INTO `reorder` (`idReorder`, `date`, `quantityReorder`, `dateDelivery`, `idProduct`)
VALUES
	(1,'2015-02-17 16:49:01',10,NULL,2),
	(2,'2015-02-18 01:21:57',20,NULL,1);

/*!40000 ALTER TABLE `reorder` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
