-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: green_village-db-1    Database: greenvillage
-- ------------------------------------------------------
-- Server version	11.5.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresse` (
  `Id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) DEFAULT NULL,
  `adresse_complementaire` varchar(255) DEFAULT NULL,
  `code_postal` varchar(5) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `statut` tinyint(1) NOT NULL,
  `telephone_suplementaire` varchar(20) DEFAULT NULL,
  `Id_fournisseur` int(11) DEFAULT NULL,
  `Id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_adresse`),
  KEY `IDX_C35F0816E3E87F1D` (`Id_fournisseur`),
  KEY `IDX_C35F0816C90EF3D7` (`Id_user`),
  CONSTRAINT `FK_C35F0816C90EF3D7` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`),
  CONSTRAINT `FK_C35F0816E3E87F1D` FOREIGN KEY (`Id_fournisseur`) REFERENCES `fournisseur` (`Id_fournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
INSERT INTO `adresse` VALUES
(1,'723, boulevard de Pinto','Étage 824','03468','Martineau-sur-Torres',1,'',4,NULL),
(2,'5, rue Lopez','Apt. 355','77754','Lopez',0,'',4,NULL),
(3,'36, avenue Lopez','Suite 671','20305','Fernandez-sur-Joly',1,'',2,NULL),
(4,'67, rue Lebrun','Suite 857','42728','Barbier-les-Bains',0,'',NULL,7),
(5,'818, avenue Victoire Dupuy','Bât. 512','10829','Le Roux',0,'',3,NULL),
(6,'70, impasse Lorraine Cohen','Chambre 921','18293','Gautier',1,'',NULL,11),
(7,'60, chemin Jérôme De Oliveira','Chambre 693','16852','Joseph',0,'',NULL,7),
(8,'boulevard Briand','Apt. 260','93440','Raynaud',0,'',NULL,6),
(9,'725, impasse Michelle Lagarde','Suite 224','80419','Seguin',1,'',NULL,11),
(10,'place de Humbert','Apt. 830','86561','Goncalves',1,'',3,NULL),
(11,'77, boulevard de Da Costa','Suite 224','29450','Chauvet-sur-Baron',0,'',3,NULL),
(12,'3, place Clémence Chauveau','Chambre 204','99853','Moreau-sur-Lucas',0,'',1,NULL),
(13,'44, avenue de Marion','Étage 490','74815','Masson-sur-Barre',1,'',NULL,20),
(14,'70, place Adélaïde Andre','Apt. 434','55010','Pinto',0,'',NULL,12),
(15,'2, avenue Bazin','Suite 191','47446','Fernandez-la-Forêt',0,'',1,NULL),
(16,'96, place de Gros','Étage 141','51291','Fouquet-sur-Jean',0,'',NULL,4),
(17,'25, chemin Timothée Marchal','Suite 231','20178','Vidal',1,'',5,NULL),
(18,'rue de Raymond','Apt. 052','96067','Morel',1,'',NULL,5),
(19,'98, impasse Rousseau','Suite 105','24667','Ledoux',1,'',4,NULL),
(20,'place de Pereira','Chambre 172','06464','Munoz',1,'',5,NULL),
(21,'15, boulevard Reynaud','Suite 220','55443','Mendes-sur-Ribeiro',0,'',NULL,8),
(22,'31, place Mathilde Jacob','Bât. 091','49938','Da Silva-sur-Mer',1,'',3,NULL),
(23,'rue Émile Riviere','Suite 284','59572','Royer-sur-Mer',0,'',NULL,17),
(24,'1, chemin de Guilbert','Étage 263','49538','Germain',1,'',3,NULL),
(25,'483, impasse Robert Breton','Chambre 299','86164','AdamBourg',1,'',NULL,20);
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `Id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  `statut_commande` varchar(50) NOT NULL,
  `montant_total` decimal(15,2) NOT NULL,
  `mode_paiement` tinyint(1) NOT NULL,
  `reduction` decimal(15,2) DEFAULT NULL,
  `date_paiement` date DEFAULT NULL,
  `reference_facture` varchar(50) NOT NULL,
  `date_facture` date NOT NULL,
  `Id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_commande`),
  KEY `IDX_6EEAA67DC90EF3D7` (`Id_user`),
  CONSTRAINT `FK_6EEAA67DC90EF3D7` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_commande`
--

DROP TABLE IF EXISTS `detail_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_commande` (
  `quantite_commander` int(11) NOT NULL,
  `prix_unitaire` decimal(15,2) NOT NULL,
  `Id_produit` int(11) NOT NULL,
  `Id_commande` int(11) NOT NULL,
  PRIMARY KEY (`Id_produit`,`Id_commande`),
  KEY `IDX_98344FA6B8654687` (`Id_produit`),
  KEY `IDX_98344FA6B8ADC53F` (`Id_commande`),
  CONSTRAINT `FK_98344FA6B8654687` FOREIGN KEY (`Id_produit`) REFERENCES `produit` (`Id_produit`),
  CONSTRAINT `FK_98344FA6B8ADC53F` FOREIGN KEY (`Id_commande`) REFERENCES `commande` (`Id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_commande`
--

LOCK TABLES `detail_commande` WRITE;
/*!40000 ALTER TABLE `detail_commande` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_livraison`
--

DROP TABLE IF EXISTS `detail_livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_livraison` (
  `quantite_livrer` int(11) NOT NULL,
  `Id_produit` int(11) NOT NULL,
  `Id_livraison` int(11) NOT NULL,
  PRIMARY KEY (`Id_produit`,`Id_livraison`),
  KEY `IDX_B7FB4AAAB8654687` (`Id_produit`),
  KEY `IDX_B7FB4AAA3E08F8C0` (`Id_livraison`),
  CONSTRAINT `FK_B7FB4AAA3E08F8C0` FOREIGN KEY (`Id_livraison`) REFERENCES `livraison` (`Id_livraison`),
  CONSTRAINT `FK_B7FB4AAAB8654687` FOREIGN KEY (`Id_produit`) REFERENCES `produit` (`Id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_livraison`
--

LOCK TABLES `detail_livraison` WRITE;
/*!40000 ALTER TABLE `detail_livraison` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `echange`
--

DROP TABLE IF EXISTS `echange`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `echange` (
  `Id_echange` int(11) NOT NULL AUTO_INCREMENT,
  `date_echange` date NOT NULL,
  `sujet_echange` varchar(50) NOT NULL,
  `type_echange` varchar(255) DEFAULT NULL,
  `description_echange` varchar(255) DEFAULT NULL,
  `Id_user` int(11) DEFAULT NULL,
  `Id_employe` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_echange`),
  KEY `IDX_B577E3BFC90EF3D7` (`Id_user`),
  KEY `IDX_B577E3BF69C47919` (`Id_employe`),
  CONSTRAINT `FK_B577E3BF69C47919` FOREIGN KEY (`Id_employe`) REFERENCES `employe` (`Id_employe`),
  CONSTRAINT `FK_B577E3BFC90EF3D7` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `echange`
--

LOCK TABLES `echange` WRITE;
/*!40000 ALTER TABLE `echange` DISABLE KEYS */;
/*!40000 ALTER TABLE `echange` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employe`
--

DROP TABLE IF EXISTS `employe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employe` (
  `Id_employe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_employe` varchar(255) NOT NULL,
  `reference_employe` varchar(255) NOT NULL,
  `telephone_employe` varchar(50) NOT NULL,
  `email_employe` varchar(255) DEFAULT NULL,
  `Id_service` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_employe`),
  KEY `IDX_F804D3B9705D3072` (`Id_service`),
  CONSTRAINT `FK_F804D3B9705D3072` FOREIGN KEY (`Id_service`) REFERENCES `service` (`Id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employe`
--

LOCK TABLES `employe` WRITE;
/*!40000 ALTER TABLE `employe` DISABLE KEYS */;
INSERT INTO `employe` VALUES
(1,'Blanc','EMP-VV469','0620685744','eduval@example.net',2),
(2,'Adam','EMP-VW985','0614129152','bonnin.guy@example.com',1),
(3,'Garcia','EMP-TS324','0635876538','denis20@example.com',3),
(4,'Bigot','EMP-TE092','0658520102',NULL,4),
(5,'Courtois','EMP-HU862','0601464417',NULL,4),
(6,'Lecoq','EMP-KS198','0632927196',NULL,4),
(7,'Michel','EMP-ST360','0644391275','maury.olivie@example.com',5),
(8,'Perrier','EMP-TF497','0610375393',NULL,1),
(9,'Lacroix','EMP-CR261','0659082334','thomas21@example.net',4),
(10,'Simon','EMP-BX511','0694464865','luc.fernandes@example.com',3),
(11,'Denis','EMP-HA320','0684909224','bernier.alexandria@example.org',4),
(12,'Morel','EMP-CW809','0695293188','denise.fernandes@example.com',2),
(13,'Leclercq','EMP-SQ015','0639527388',NULL,5),
(14,'Dupuy','EMP-MO699','0643164784',NULL,5),
(15,'Voisin','EMP-SP580','0652528778','omarie@example.net',1),
(16,'Picard','EMP-BN849','0688478268',NULL,1),
(17,'Berthelot','EMP-UA767','0624956221',NULL,5),
(18,'Raynaud','EMP-WZ388','0661160936',NULL,5),
(19,'Da Costa','EMP-QR621','0669332402',NULL,5),
(20,'Nicolas','EMP-EK302','0651426677',NULL,5);
/*!40000 ALTER TABLE `employe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fournisseur` (
  `Id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(50) NOT NULL,
  `telephone_fournisseur` varchar(20) NOT NULL,
  `siret` varchar(14) NOT NULL,
  `reference_fournisseur` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`Id_fournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES
(1,'Gilbert S.A.','0603472643','11835832932844','REF-3144-co','grenier.alex@herve.net','Constructeur'),
(2,'Bernier','0634712250','67338834009153','REF-1427-yc','marc79@gmail.com','Constructeur'),
(3,'Diaz Meyer SA','0611751790','70656958507734','REF-3809-uf','omorel@tele2.fr','Constructeur'),
(4,'Fernandez Evrard et Fils','0616919116','31053939636485','REF-2106-wn','weber.victoire@joseph.com','Constructeur'),
(5,'Bouchet','0649095824','24363572868653','REF-6812-mm','traore.nicolas@tele2.fr','Constructeur');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_produit`
--

DROP TABLE IF EXISTS `image_produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_produit` (
  `Id_image_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_image` varchar(255) NOT NULL,
  `Id_produit` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_image_produit`),
  KEY `IDX_BCB5BBFBB8654687` (`Id_produit`),
  CONSTRAINT `FK_BCB5BBFBB8654687` FOREIGN KEY (`Id_produit`) REFERENCES `produit` (`Id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_produit`
--

LOCK TABLES `image_produit` WRITE;
/*!40000 ALTER TABLE `image_produit` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livraison` (
  `Id_livraison` int(11) NOT NULL AUTO_INCREMENT,
  `date_edition` date DEFAULT NULL,
  `statut_livraison` tinyint(1) NOT NULL,
  `reference_livraison` varchar(50) NOT NULL,
  `Id_commande` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_livraison`),
  KEY `IDX_A60C9F1FB8ADC53F` (`Id_commande`),
  CONSTRAINT `FK_A60C9F1FB8ADC53F` FOREIGN KEY (`Id_commande`) REFERENCES `commande` (`Id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livraison`
--

LOCK TABLES `livraison` WRITE;
/*!40000 ALTER TABLE `livraison` DISABLE KEYS */;
/*!40000 ALTER TABLE `livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produit` (
  `Id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_court` varchar(50) NOT NULL,
  `description_long` varchar(255) NOT NULL,
  `prix_achat_ht` decimal(15,2) NOT NULL,
  `statut_produit` tinyint(1) DEFAULT NULL,
  `stock_produit` varchar(50) DEFAULT NULL,
  `marque` varchar(255) DEFAULT NULL,
  `libelle_modele` varchar(255) NOT NULL,
  `Id_fournisseur` int(11) DEFAULT NULL,
  `Id_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_produit`),
  KEY `IDX_29A5EC27E3E87F1D` (`Id_fournisseur`),
  KEY `IDX_29A5EC2799485701` (`Id_parent`),
  CONSTRAINT `FK_29A5EC2799485701` FOREIGN KEY (`Id_parent`) REFERENCES `rubrique` (`Id_rubrique`),
  CONSTRAINT `FK_29A5EC27E3E87F1D` FOREIGN KEY (`Id_fournisseur`) REFERENCES `fournisseur` (`Id_fournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES
(1,'Guitare électrique','Dignissimos earum aut repudiandae tempora. Vel error nihil possimus repellendus. Cupiditate natus laboriosam est cum perferendis voluptatem magni aliquid. Soluta quia aliquam molestias numquam excepturi ab a.',552.58,1,'38','Fender','dolore',5,5),
(2,'Guitare acoustique','Optio maxime ex quis odio labore ut et possimus. Recusandae praesentium voluptate delectus aut libero consequatur natus et. Perferendis accusantium maiores aliquid veniam.',403.41,1,'22','Gibson','labore',2,5),
(3,'Violon','Repellat fugit rerum accusamus. Cum labore sed et ut quibusdam. Saepe culpa est sunt. Molestiae molestiae dolorum et quas ex ut veritatis.',651.19,1,'42','Stradivarius','corporis',3,6),
(4,'Flûte traversière','Commodi dolor porro inventore quis ut nulla. Dicta et et fugit nemo et quod libero. Voluptatem dolor non reprehenderit officia ut delectus.',495.67,1,'47','Yamaha','ab',4,7),
(5,'Trombone','Tenetur accusantium voluptates fugiat ab qui praesentium. Quae maiores cupiditate dignissimos eum explicabo. Mollitia distinctio ut sit porro quis sunt repudiandae.',343.49,1,'9','Yamaha','non',4,8),
(6,'Batterie acoustique','Ex qui dolore impedit non et ratione. Nesciunt officia eum quia et. Tempora sed ea corporis veritatis at laboriosam velit. Minus aut velit et est et nemo sed. Ab ducimus dolorum optio ducimus.',627.46,1,'9','Pearl','quis',2,9),
(7,'Synthétiseur','Ut voluptas error rerum vel quam. Dicta et est accusantium voluptatem voluptate quisquam sunt. Odit sit provident fuga et qui earum quia qui.',669.01,1,'43','Yamaha','quas',4,10);
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `Id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(255) NOT NULL,
  `niveau_role` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES
(1,'Commercial','niveau_4'),
(2,'Manager','niveau_2'),
(3,'Utilisateur','niveau_5'),
(4,'Administrateur','niveau_1');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubrique`
--

DROP TABLE IF EXISTS `rubrique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rubrique` (
  `Id_rubrique` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_image` varchar(255) NOT NULL,
  `label_rubrique` varchar(255) NOT NULL,
  `Id_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_rubrique`),
  KEY `IDX_8FA4097C99485701` (`Id_parent`),
  CONSTRAINT `FK_8FA4097C99485701` FOREIGN KEY (`Id_parent`) REFERENCES `rubrique` (`Id_rubrique`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubrique`
--

LOCK TABLES `rubrique` WRITE;
/*!40000 ALTER TABLE `rubrique` DISABLE KEYS */;
INSERT INTO `rubrique` VALUES
(1,'nobis','Instruments à cordes',NULL),
(2,'tempore','Instruments à vent',NULL),
(3,'voluptas','Instruments à percussion',NULL),
(4,'quod','Instruments électroniques',NULL),
(5,'eum','Guitares',1),
(6,'hic','Violons',1),
(7,'qui','Flûtes',2),
(8,'aut','Trombones',2),
(9,'voluptatem','Batteries',3),
(10,'minus','Synthétiseurs',4);
/*!40000 ALTER TABLE `rubrique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `Id_service` int(11) NOT NULL AUTO_INCREMENT,
  `nom_service` varchar(255) NOT NULL,
  `telephone_service` varchar(20) NOT NULL,
  `email_service` varchar(255) NOT NULL,
  `Id_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_service`),
  KEY `IDX_E19D9AD213F4AFF4` (`Id_role`),
  CONSTRAINT `FK_E19D9AD213F4AFF4` FOREIGN KEY (`Id_role`) REFERENCES `role` (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES
(1,'Service commercial professionnel','0660123407','pguerin@example.net',1),
(2,'Service commercial particulier','0690497176','catherine.payet@vincent.net',1),
(3,'Service gestion','0641436267','uaubert@example.net',4),
(4,'Service après vente','0671565290','lamy.michelle@live.com',2),
(5,'Service comptabilité','0641699275','thibault.antoine@noos.fr',2);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `telephone_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `coef` decimal(10,2) NOT NULL,
  `siret` varchar(14) DEFAULT NULL,
  `reference` varchar(20) NOT NULL,
  `Id_employe` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_user`),
  UNIQUE KEY `UNIQ_8D93D649AEA34913` (`reference`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  KEY `IDX_8D93D64969C47919` (`Id_employe`),
  CONSTRAINT `FK_8D93D64969C47919` FOREIGN KEY (`Id_employe`) REFERENCES `employe` (`Id_employe`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'Joseph','Claude','0692759161','bonnin.jacques@example.org','audrey.gaudin@wanadoo.fr','[\"ROLE_USER\"]','$2y$13$45CT8vI33MOxDtBcoX5iMepmGmt2eec6oy1aWMx6Y.TG48FeOydtO',1.50,NULL,'USER-673f40fd4dfaa',NULL),
(2,'Perez','Adrien','0637937140','agathe.bigot@example.net','susan62@giraud.com','[\"ROLE_USER\"]','$2y$13$TrC8UqmO3XzCoKDWziDEfepBjrHB8/myMMcDpY7GWSjPvWtachfMi',1.50,'07019369245555','USER-673f40fdac0ab',NULL),
(3,'Leclercq','Étienne','0646382893','letellier.vincent@example.com','dvincent@besson.fr','[\"ROLE_USER\"]','$2y$13$73HeVUVNNOdV3di2/hRQR.ACccRHwaedT54uE.R/RjdKouxqbsIyi',1.50,NULL,'USER-673f40fe15e60',NULL),
(4,'Lacombe','Laure','0669182605','brunet.timothee@example.net','muller.ines@dbmail.com','[\"ROLE_USER\"]','$2y$13$99mopYGW1lZuODFWKO/5euHCe2rG/agO0fv7FMlHZD1NdMRYHAEyO',1.50,NULL,'USER-673f40fe74630',NULL),
(5,'Laroche','Susanne','0639744320','jeannine19@example.net','marie00@pelletier.fr','[\"ROLE_USER\"]','$2y$13$S08Lzf31JWniiVd2T8fqCukEPKc4fMW0hcR3a0qojQiI8opfFDgqi',1.50,NULL,'USER-673f40fed257f',NULL),
(6,'Bouvet','Claudine','0654716744','alexandria38@example.com','delattre.lucie@yahoo.fr','[\"ROLE_USER\"]','$2y$13$7CC703M3OX4mrAiA5HcaN.J7B8tJRjqDKjQTjtCcKABPU4rYDJw.W',1.50,NULL,'USER-673f40ff3bf8e',NULL),
(7,'Olivier','Augustin','0608158780','antoine.vaillant@example.com','alphonse84@gomez.org','[\"ROLE_USER\"]','$2y$13$EU7H9f39AJ86M375rZ08tOXH33RpHx6IONsaRXMlKCfA3tGhQJbSy',1.50,'96681908864492','USER-673f40ff9a172',NULL),
(8,'Blot','Timothée','0642464608','fdeschamps@example.com','alix53@yahoo.fr','[\"ROLE_USER\"]','$2y$13$XBCx.RbceyDHNDu8F4Xw2ODxoD0roTOhUlLTyfOROf5FjCwSZfKh2',1.50,'00861780600292','USER-673f410003904',NULL),
(9,'Texier','Hugues','0655528133','dneveu@example.org','bonneau.oceane@caron.net','[\"ROLE_USER\"]','$2y$13$9Qa7.a3cHu.vLB46I8Fepu4BNkdnvKwAea1w9PH2Y5fxBRlH59ox.',1.50,NULL,'USER-673f410061384',NULL),
(10,'Lemoine','Juliette','0679431238','bernard.guichard@example.net','yves.levy@bodin.net','[\"ROLE_USER\"]','$2y$13$K7LnZJOoZBV2/Npx8zAP/e7pf17e2C8DVULQ2pF8CgwXuY/A5rql6',1.50,NULL,'USER-673f4100bf608',NULL),
(11,'Charrier','Aimé','0672338678','zgirard@example.net','zbernier@tele2.fr','[\"ROLE_USER\"]','$2y$13$JF/PgmnYBtppEMg9AjW7l.qwV75KQKQ7vPK.EWznR4dmw2UZ08OJC',1.50,'53110025912313','USER-673f41012935c',NULL),
(12,'Guibert','Michelle','0633120967','guillaume52@example.org','charpentier.laure@bruneau.com','[\"ROLE_USER\"]','$2y$13$rgEr8uTE0DupVCAl/clxq.fGxIV4VfGZjRhaAecT.H10BjpI4MyRe',1.50,'30997900369978','USER-673f410186aa7',NULL),
(13,'Rossi','Georges','0688984308','schmitt.henri@example.net','delannoy.martine@live.com','[\"ROLE_USER\"]','$2y$13$szPfzuVPmr2/ZxkS4LwJseYUAKmuXQkUU0/i/UKi0z0F1eVMxTx/y',1.50,'21919122197367','USER-673f4101e5030',NULL),
(14,'Dufour','Sébastien','0647119633','rletellier@example.com','philippe.blanchet@turpin.com','[\"ROLE_USER\"]','$2y$13$p/31MZZqzyvSf9CGjoiZ3uLMWWr1CFFXuuEiPJbCIx5bUbdycinxO',1.50,'88952902708373','USER-673f41024de71',NULL),
(15,'Diallo','Élise','0643444372','philippine.legrand@example.com','svoisin@hotmail.fr','[\"ROLE_USER\"]','$2y$13$MZn9UQQaMY8E/r2jbMaLiuW1iCe.3UmnsvB1yagn79XkDoAk1QOoO',1.50,NULL,'USER-673f4102aa444',NULL),
(16,'Levy','Alphonse','0661060006','giraud.jules@example.net','duval.hugues@noos.fr','[\"ROLE_USER\"]','$2y$13$FMUwopJGYh3vrZmx63pXIOmsJqPp2yDSjqWjir7oFLZjJ4dWAfDpq',1.50,'92027035232736','USER-673f410313dd4',NULL),
(17,'Pottier','Chantal','0639771890','suzanne66@example.com','rcharles@courtois.fr','[\"ROLE_USER\"]','$2y$13$.VPI3bPeKyWdL2vqQTxa8u1yklOHhGjWlFd2P5GIE0/Dg6P9nc/96',1.50,'62532309967609','USER-673f4103725eb',NULL),
(18,'Toussaint','Gilbert','0614293853','gilbert13@example.net','marcel.louis@laposte.net','[\"ROLE_USER\"]','$2y$13$s6JaHYaUx5.rTz4ae2t73OfC9XqPD/wRTpvDJhxOkWsP59B64poRi',1.50,NULL,'USER-673f4103cf42e',NULL),
(19,'Jacques','Lucas','0637350828','guillaume28@example.com','mercier.patrick@toussaint.fr','[\"ROLE_USER\"]','$2y$13$yzhqHispYFHECMQcMMOe..J0nlNjultbpOM0R9kCnp0kC03E8avk6',1.50,'27688118807823','USER-673f41043968a',NULL),
(20,'Gilles','Rémy','0626523198','gabriel.costa@example.org','hparis@cousin.net','[\"ROLE_USER\"]','$2y$13$Hr2LeJMoglKnu1cACMMOmOTmUKd9neXdH/ON4MUL/DOh9bkGjpWd.',1.50,NULL,'USER-673f41049778c',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-21 15:07:57
