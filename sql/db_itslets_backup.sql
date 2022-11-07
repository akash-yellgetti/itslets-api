-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: itslets
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `country_mas`
--

DROP TABLE IF EXISTS `country_mas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country_mas` (
  `country_id` bigint NOT NULL AUTO_INCREMENT,
  `country_code` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_img` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` int NOT NULL DEFAULT '0',
  `country_phone_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_mobile` int NOT NULL,
  `max_mobile` int NOT NULL,
  `min_phone` int NOT NULL,
  `max_phone` int NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `iso` (`country_code`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_mas`
--

LOCK TABLES `country_mas` WRITE;
/*!40000 ALTER TABLE `country_mas` DISABLE KEYS */;
INSERT INTO `country_mas` VALUES (1,'AF','Afghanistan','',0,'',0,0,0,0,0),(2,'AL','Albania','',0,'',0,0,0,0,0),(3,'DZ','Algeria','',0,'',0,0,0,0,0),(4,'AS','American Samoa','',0,'',0,0,0,0,0),(5,'AD','Andorra','',0,'',0,0,0,0,0),(6,'AO','Angola','',0,'',0,0,0,0,0),(7,'AI','Anguilla','',0,'',0,0,0,0,0),(8,'AQ','Antarctica','',0,'',0,0,0,0,0),(9,'AG','Antigua and Barbuda','',0,'',0,0,0,0,0),(10,'AR','Argentina','',0,'',0,0,0,0,0),(11,'AM','Armenia','',0,'',0,0,0,0,0),(12,'AW','Aruba','',0,'',0,0,0,0,0),(13,'AU','Australia','',0,'61',9,9,0,0,0),(14,'AT','Austria','',0,'',0,0,0,0,0),(15,'AZ','Azerbaijan','',0,'',0,0,0,0,0),(16,'BS','Bahamas','',0,'',0,0,0,0,0),(17,'BH','Bahrain','',0,'',0,0,0,0,0),(18,'BD','Bangladesh','',0,'',0,0,0,0,0),(19,'BB','Barbados','',0,'',0,0,0,0,0),(20,'BY','Belarus','',0,'',0,0,0,0,0),(21,'BE','Belgium','',0,'',0,0,0,0,0),(22,'BZ','Belize','',0,'',0,0,0,0,0),(23,'BJ','Benin','',0,'',0,0,0,0,0),(24,'BM','Bermuda','',0,'',0,0,0,0,0),(25,'BT','Bhutan','',0,'',0,0,0,0,0),(26,'BO','Bolivia','',0,'',0,0,0,0,0),(27,'BA','Bosnia and Herzegovina','',0,'',0,0,0,0,0),(28,'BW','Botswana','',0,'',0,0,0,0,0),(29,'BV','Bouvet Island','',0,'',0,0,0,0,0),(30,'BR','Brazil','',0,'55',11,11,0,0,0),(31,'IO','British Indian Ocean Territory','',0,'',0,0,0,0,0),(32,'BN','Brunei Darussalam','',0,'',0,0,0,0,0),(33,'BG','Bulgaria','',0,'',0,0,0,0,0),(34,'BF','Burkina Faso','',0,'',0,0,0,0,0),(35,'BI','Burundi','',0,'',0,0,0,0,0),(36,'KH','Cambodia','',0,'',0,0,0,0,0),(37,'CM','Cameroon','',0,'',0,0,0,0,0),(38,'CA','Canada','',0,'',0,0,0,0,0),(39,'CV','Cape Verde','',0,'',0,0,0,0,0),(40,'KY','Cayman Islands','',0,'',0,0,0,0,0),(41,'CF','Central African Republic','',0,'',0,0,0,0,0),(42,'TD','Chad','',0,'',0,0,0,0,0),(43,'CL','Chile','',0,'',0,0,0,0,0),(44,'CN','China','',0,'',0,0,0,0,0),(45,'CX','Christmas Island','',0,'',0,0,0,0,0),(46,'CC','Cocos (Keeling) Islands','',0,'',0,0,0,0,0),(47,'CO','Colombia','',0,'57',10,10,0,0,0),(48,'KM','Comoros','',0,'',0,0,0,0,0),(49,'CG','Congo','',0,'',0,0,0,0,0),(50,'CD','Congo, the Democratic Republic of the','',0,'',0,0,0,0,0),(51,'CK','Cook Islands','',0,'',0,0,0,0,0),(52,'CR','Costa Rica','',0,'',0,0,0,0,0),(53,'CI','Cote D\'Ivoire','',0,'',0,0,0,0,0),(54,'HR','Croatia','',0,'',0,0,0,0,0),(55,'CU','Cuba','',0,'',0,0,0,0,0),(56,'CY','Cyprus','',0,'',0,0,0,0,0),(57,'CZ','Czech Republic','',0,'',0,0,0,0,0),(58,'DK','Denmark','',0,'',0,0,0,0,0),(59,'DJ','Djibouti','',0,'',0,0,0,0,0),(60,'DM','Dominica','',0,'',0,0,0,0,0),(61,'DO','Dominican Republic','',0,'',0,0,0,0,0),(62,'EC','Ecuador','',0,'',0,0,0,0,0),(63,'EG','Egypt','',0,'',0,0,0,0,0),(64,'SV','El Salvador','',0,'',0,0,0,0,0),(65,'GQ','Equatorial Guinea','',0,'',0,0,0,0,0),(66,'ER','Eritrea','',0,'',0,0,0,0,0),(67,'EE','Estonia','',0,'',0,0,0,0,0),(68,'ET','Ethiopia','',0,'',0,0,0,0,0),(69,'FK','Falkland Islands (Malvinas)','',0,'',0,0,0,0,0),(70,'FO','Faroe Islands','',0,'',0,0,0,0,0),(71,'FJ','Fiji','',0,'',0,0,0,0,0),(72,'FI','Finland','',0,'',0,0,0,0,0),(73,'FR','France','',0,'',0,0,0,0,0),(74,'GF','French Guiana','',0,'',0,0,0,0,0),(75,'PF','French Polynesia','',0,'',0,0,0,0,0),(76,'TF','French Southern Territories','',0,'',0,0,0,0,0),(77,'GA','Gabon','',0,'',0,0,0,0,0),(78,'GM','Gambia','',0,'',0,0,0,0,0),(79,'GE','Georgia','',0,'',0,0,0,0,0),(80,'DE','Germany','',0,'49',10,11,0,0,0),(81,'GH','Ghana','',0,'',0,0,0,0,0),(82,'GI','Gibraltar','',0,'',0,0,0,0,0),(83,'GR','Greece','',0,'',0,0,0,0,0),(84,'GL','Greenland','',0,'',0,0,0,0,0),(85,'GD','Grenada','',0,'',0,0,0,0,0),(86,'GP','Guadeloupe','',0,'',0,0,0,0,0),(87,'GU','Guam','',0,'',0,0,0,0,0),(88,'GT','Guatemala','',0,'',0,0,0,0,0),(89,'GN','Guinea','',0,'',0,0,0,0,0),(90,'GW','Guinea-Bissau','',0,'',0,0,0,0,0),(91,'GY','Guyana','',0,'',0,0,0,0,0),(92,'HT','Haiti','',0,'',0,0,0,0,0),(93,'HM','Heard Island and Mcdonald Islands','',0,'',0,0,0,0,0),(94,'VA','Holy See (Vatican City State)','',0,'',0,0,0,0,0),(95,'HN','Honduras','',0,'',0,0,0,0,0),(96,'HK','Hong Kong','',0,'',0,0,0,0,0),(97,'HU','Hungary','',0,'',0,0,0,0,0),(98,'IS','Iceland','',0,'',0,0,0,0,0),(99,'IN','India','',1,'91',10,10,0,0,0),(100,'ID','Indonesia','',0,'',0,0,0,0,0),(101,'IR','Iran, Islamic Republic of','',0,'',0,0,0,0,0),(102,'IQ','Iraq','',0,'',0,0,0,0,0),(103,'IE','Ireland','',0,'',0,0,0,0,0),(104,'IL','Israel','',0,'',0,0,0,0,0),(105,'IT','Italy','',0,'',0,0,0,0,0),(106,'JM','Jamaica','',0,'',0,0,0,0,0),(107,'JP','Japan','',0,'',0,0,0,0,0),(108,'JO','Jordan','',0,'',0,0,0,0,0),(109,'KZ','Kazakhstan','',0,'',0,0,0,0,0),(110,'KE','Kenya','',0,'',0,0,0,0,0),(111,'KI','Kiribati','',0,'',0,0,0,0,0),(112,'KP','Korea, Democratic People\'s Republic of','',0,'',0,0,0,0,0),(113,'KR','Korea, Republic of','',0,'',0,0,0,0,0),(114,'KW','Kuwait','',0,'',0,0,0,0,0),(115,'KG','Kyrgyzstan','',0,'',0,0,0,0,0),(116,'LA','Lao People\'s Democratic Republic','',0,'',0,0,0,0,0),(117,'LV','Latvia','',0,'',0,0,0,0,0),(118,'LB','Lebanon','',0,'',0,0,0,0,0),(119,'LS','Lesotho','',0,'',0,0,0,0,0),(120,'LR','Liberia','',0,'',0,0,0,0,0),(121,'LY','Libyan Arab Jamahiriya','',0,'',0,0,0,0,0),(122,'LI','Liechtenstein','',0,'',0,0,0,0,0),(123,'LT','Lithuania','',0,'',0,0,0,0,0),(124,'LU','Luxembourg','',0,'',0,0,0,0,0),(125,'MO','Macao','',0,'',0,0,0,0,0),(126,'MK','Macedonia, the Former Yugoslav Republic of','',0,'',0,0,0,0,0),(127,'MG','Madagascar','',0,'',0,0,0,0,0),(128,'MW','Malawi','',0,'',0,0,0,0,0),(129,'MY','Malaysia','',0,'',0,0,0,0,0),(130,'MV','Maldives','',0,'',0,0,0,0,0),(131,'ML','Mali','',0,'',0,0,0,0,0),(132,'MT','Malta','',0,'',0,0,0,0,0),(133,'MH','Marshall Islands','',0,'',0,0,0,0,0),(134,'MQ','Martinique','',0,'',0,0,0,0,0),(135,'MR','Mauritania','',0,'',0,0,0,0,0),(136,'MU','Mauritius','',0,'',0,0,0,0,0),(137,'YT','Mayotte','',0,'',0,0,0,0,0),(138,'MX','Mexico','',0,'',0,0,0,0,0),(139,'FM','Micronesia, Federated States of','',0,'',0,0,0,0,0),(140,'MD','Moldova, Republic of','',0,'',0,0,0,0,0),(141,'MC','Monaco','',0,'',0,0,0,0,0),(142,'MN','Mongolia','',0,'',0,0,0,0,0),(143,'MS','Montserrat','',0,'',0,0,0,0,0),(144,'MA','Morocco','',0,'',0,0,0,0,0),(145,'MZ','Mozambique','',0,'',0,0,0,0,0),(146,'MM','Myanmar','',0,'',0,0,0,0,0),(147,'NA','Namibia','',0,'',0,0,0,0,0),(148,'NR','Nauru','',0,'',0,0,0,0,0),(149,'NP','Nepal','',0,'',0,0,0,0,0),(150,'NL','Netherlands','',0,'',0,0,0,0,0),(151,'AN','Netherlands Antilles','',0,'',0,0,0,0,0),(152,'NC','New Caledonia','',0,'',0,0,0,0,0),(153,'NZ','New Zealand','',0,'',0,0,0,0,0),(154,'NI','Nicaragua','',0,'',0,0,0,0,0),(155,'NE','Niger','',0,'',0,0,0,0,0),(156,'NG','Nigeria','',0,'',0,0,0,0,0),(157,'NU','Niue','',0,'',0,0,0,0,0),(158,'NF','Norfolk Island','',0,'',0,0,0,0,0),(159,'MP','Northern Mariana Islands','',0,'',0,0,0,0,0),(160,'NO','Norway','',0,'',0,0,0,0,0),(161,'OM','Oman','',0,'',0,0,0,0,0),(162,'PK','Pakistan','',0,'',0,0,0,0,0),(163,'PW','Palau','',0,'',0,0,0,0,0),(164,'PS','Palestinian Territory, Occupied','',0,'',0,0,0,0,0),(165,'PA','Panama','',0,'',0,0,0,0,0),(166,'PG','Papua New Guinea','',0,'',0,0,0,0,0),(167,'PY','Paraguay','',0,'',0,0,0,0,0),(168,'PE','Peru','',0,'',0,0,0,0,0),(169,'PH','Philippines','',0,'',0,0,0,0,0),(170,'PN','Pitcairn','',0,'',0,0,0,0,0),(171,'PL','Poland','',0,'',0,0,0,0,0),(172,'PT','Portugal','',0,'',0,0,0,0,0),(173,'PR','Puerto Rico','',0,'',0,0,0,0,0),(174,'QA','Qatar','',0,'',0,0,0,0,0),(175,'RE','Reunion','',0,'',0,0,0,0,0),(176,'RO','Romania','',0,'',0,0,0,0,0),(177,'RU','Russian Federation','',0,'',0,0,0,0,0),(178,'RW','Rwanda','',0,'',0,0,0,0,0),(179,'SH','Saint Helena','',0,'',0,0,0,0,0),(180,'KN','Saint Kitts and Nevis','',0,'',0,0,0,0,0),(181,'LC','Saint Lucia','',0,'',0,0,0,0,0),(182,'PM','Saint Pierre and Miquelon','',0,'',0,0,0,0,0),(183,'VC','Saint Vincent and the Grenadines','',0,'',0,0,0,0,0),(184,'WS','Samoa','',0,'',0,0,0,0,0),(185,'SM','San Marino','',0,'',0,0,0,0,0),(186,'ST','Sao Tome and Principe','',0,'',0,0,0,0,0),(187,'SA','Saudi Arabia','',0,'',0,0,0,0,0),(188,'SN','Senegal','',0,'',0,0,0,0,0),(189,'CS','Serbia and Montenegro','',0,'',0,0,0,0,0),(190,'SC','Seychelles','',0,'',0,0,0,0,0),(191,'SL','Sierra Leone','',0,'',0,0,0,0,0),(192,'SG','Singapore','',0,'',0,0,0,0,0),(193,'SK','Slovakia','',0,'',0,0,0,0,0),(194,'SI','Slovenia','',0,'',0,0,0,0,0),(195,'SB','Solomon Islands','',0,'',0,0,0,0,0),(196,'SO','Somalia','',0,'',0,0,0,0,0),(197,'ZA','South Africa','',0,'',0,0,0,0,0),(198,'GS','South Georgia and the South Sandwich Islands','',0,'',0,0,0,0,0),(199,'ES','Spain','',0,'',0,0,0,0,0),(200,'LK','Sri Lanka','',0,'',0,0,0,0,0),(201,'SD','Sudan','',0,'',0,0,0,0,0),(202,'SR','Suriname','',0,'',0,0,0,0,0),(203,'SJ','Svalbard and Jan Mayen','',0,'',0,0,0,0,0),(204,'SZ','Swaziland','',0,'',0,0,0,0,0),(205,'SE','Sweden','',0,'',0,0,0,0,0),(206,'CH','Switzerland','',0,'',0,0,0,0,0),(207,'SY','Syrian Arab Republic','',0,'',0,0,0,0,0),(208,'TW','Taiwan, Province of China','',0,'',0,0,0,0,0),(209,'TJ','Tajikistan','',0,'',0,0,0,0,0),(210,'TZ','Tanzania, United Republic of','',0,'',0,0,0,0,0),(211,'TH','Thailand','',0,'',0,0,0,0,0),(212,'TL','Timor-Leste','',0,'',0,0,0,0,0),(213,'TG','Togo','',0,'',0,0,0,0,0),(214,'TK','Tokelau','',0,'',0,0,0,0,0),(215,'TO','Tonga','',0,'',0,0,0,0,0),(216,'TT','Trinidad and Tobago','',0,'',0,0,0,0,0),(217,'TN','Tunisia','',0,'',0,0,0,0,0),(218,'TR','Turkey','',0,'',0,0,0,0,0),(219,'TM','Turkmenistan','',0,'',0,0,0,0,0),(220,'TC','Turks and Caicos Islands','',0,'',0,0,0,0,0),(221,'TV','Tuvalu','',0,'',0,0,0,0,0),(222,'UG','Uganda','',0,'',0,0,0,0,0),(223,'UA','Ukraine','',0,'',0,0,0,0,0),(224,'AE','United Arab Emirates','',6,'971',9,9,0,0,0),(225,'GB','United Kingdom','',0,'44',9,9,0,0,0),(226,'US','United States','',0,'1',10,10,0,0,0),(227,'UM','United States Minor Outlying Islands','',0,'',0,0,0,0,0),(228,'UY','Uruguay','',0,'',0,0,0,0,0),(229,'UZ','Uzbekistan','',0,'',0,0,0,0,0),(230,'VU','Vanuatu','',0,'',0,0,0,0,0),(231,'VE','Venezuela','',0,'',0,0,0,0,0),(232,'VN','Viet Nam','',0,'',0,0,0,0,0),(233,'VG','Virgin Islands, British','',0,'',0,0,0,0,0),(234,'VI','Virgin Islands, U.s.','',0,'',0,0,0,0,0),(235,'WF','Wallis and Futuna','',0,'',0,0,0,0,0),(236,'EH','Western Sahara','',0,'',0,0,0,0,0),(237,'YE','Yemen','',0,'',0,0,0,0,0),(238,'ZM','Zambia','',0,'',0,0,0,0,0),(239,'ZW','Zimbabwe','',0,'',0,0,0,0,0);
/*!40000 ALTER TABLE `country_mas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ignored_lets`
--

DROP TABLE IF EXISTS `ignored_lets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ignored_lets` (
  `ignore_lets_id` int NOT NULL AUTO_INCREMENT,
  `lets_id` int NOT NULL,
  `user_id` int NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ignore_lets_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ignored_lets`
--

LOCK TABLES `ignored_lets` WRITE;
/*!40000 ALTER TABLE `ignored_lets` DISABLE KEYS */;
INSERT INTO `ignored_lets` VALUES (1,5,20,'2022-07-08 09:23:55',0),(2,6,19,'2022-07-08 14:00:54',0),(3,10,19,'2022-07-08 15:08:30',0);
/*!40000 ALTER TABLE `ignored_lets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lets_keywords_mas`
--

DROP TABLE IF EXISTS `lets_keywords_mas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lets_keywords_mas` (
  `lets_keyword_id` int NOT NULL AUTO_INCREMENT,
  `lets_keyword` varchar(120) NOT NULL,
  `added_date` datetime NOT NULL,
  `active_flag` int NOT NULL DEFAULT '1' COMMENT '0-InActive, 1-Active',
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`lets_keyword_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lets_keywords_mas`
--

LOCK TABLES `lets_keywords_mas` WRITE;
/*!40000 ALTER TABLE `lets_keywords_mas` DISABLE KEYS */;
/*!40000 ALTER TABLE `lets_keywords_mas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lets_receiver_log`
--

DROP TABLE IF EXISTS `lets_receiver_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lets_receiver_log` (
  `receiver_log_id` int NOT NULL AUTO_INCREMENT,
  `lets_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `log_flag` int NOT NULL COMMENT '1- Accepted, 2- Rejected, 3-Expired',
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0',
  `receiver_lat` double NOT NULL,
  `receiver_lng` double NOT NULL,
  PRIMARY KEY (`receiver_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lets_receiver_log`
--

LOCK TABLES `lets_receiver_log` WRITE;
/*!40000 ALTER TABLE `lets_receiver_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lets_receiver_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lets_reports`
--

DROP TABLE IF EXISTS `lets_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lets_reports` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `report_user_id` int NOT NULL,
  `lets_id` int NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lets_reports`
--

LOCK TABLES `lets_reports` WRITE;
/*!40000 ALTER TABLE `lets_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `lets_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lets_request`
--

DROP TABLE IF EXISTS `lets_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lets_request` (
  `lets_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `lets_text` varchar(120) NOT NULL,
  `lets_keyword_id` int NOT NULL,
  `lets_duration` int NOT NULL,
  `gender_id` int NOT NULL,
  `lets_status` int NOT NULL DEFAULT '0' COMMENT '0-Running, 1-Expired,2-Cancelled,3-Accepted',
  `expires_at` datetime NOT NULL,
  `accepted_user_flag` int NOT NULL DEFAULT '0' COMMENT '0-Open,1-Accepted',
  `accepted_user_id` int NOT NULL DEFAULT '0',
  `accepted_user_lat` float NOT NULL DEFAULT '0',
  `accepted_user_lng` float NOT NULL DEFAULT '0',
  `locality` text NOT NULL,
  `lets_lat` double NOT NULL,
  `lets_lng` double NOT NULL,
  `added_date` datetime NOT NULL,
  `active_flag` int NOT NULL DEFAULT '1' COMMENT '0-Inactive, 1-Active',
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1- Deleted',
  PRIMARY KEY (`lets_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lets_request`
--

LOCK TABLES `lets_request` WRITE;
/*!40000 ALTER TABLE `lets_request` DISABLE KEYS */;
INSERT INTO `lets_request` VALUES (1,2,'talk',0,30,2,2,'2022-06-04 12:17:55',0,0,0,0,'Vidyaranyapura Bengaluru 560097',13.075721010296,77.562855445614,'2022-06-04 11:47:55',1,0),(2,2,'g',0,5,2,2,'2022-06-26 21:47:22',0,0,0,0,' Muscat ',23.610561179822,58.592402224251,'2022-06-26 21:42:22',1,0),(3,19,'Have Tea',0,10,2,0,'2022-07-07 19:25:27',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2757907,72.8688628,'2022-07-07 19:15:27',1,0),(4,20,'Watch a movie ',0,5,1,2,'2022-07-08 09:24:52',1,19,19.2758,72.8688,'Mira Road Mira Bhayandar 401107',19.2757924,72.8688108,'2022-07-08 09:19:52',1,0),(5,19,'Watch a Movie',0,10,2,2,'2022-07-08 09:31:12',1,20,19.2758,72.8688,'Mira Road Mira Bhayandar 401107',19.275792,72.8688257,'2022-07-08 09:21:12',1,0),(6,22,'Have tea',0,2,1,0,'2022-07-08 14:00:54',1,19,19.2758,72.8688,'Mira Road Mira Bhayandar 401107',19.2757767,72.8688339,'2022-07-08 13:58:54',1,0),(7,19,'Have TEA',0,2,1,2,'2022-07-08 14:00:57',1,22,19.2758,72.8688,'Mira Road Mira Bhayandar 401107',19.2757828,72.8688323,'2022-07-08 13:58:57',1,0),(8,19,'Have tea',0,2,1,2,'2022-07-08 15:04:19',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2760108,72.8685509,'2022-07-08 15:02:19',1,0),(9,19,'Habe coffee',0,2,1,0,'2022-07-08 15:09:05',1,24,19.276,72.8686,'Mira Road Mira Bhayandar 401107',19.276053,72.8685618,'2022-07-08 15:07:05',1,0),(10,24,'Have coffee ',0,2,1,0,'2022-07-08 15:09:05',1,19,19.276,72.8686,'Mira Road Mira Bhayandar 401107',19.2760193,72.8685752,'2022-07-08 15:07:05',1,0),(11,2,'Coffee ',0,5,1,3,'2022-07-08 15:19:23',1,19,19.276,72.8686,'Jakkuru Bengaluru 560092',13.0683963,77.5976352,'2022-07-08 15:14:23',1,0),(12,2,'Coffee',0,1,1,0,'2022-07-08 15:25:30',0,0,0,0,'Jakkuru Bengaluru 560092',13.0683621,77.5976338,'2022-07-08 15:24:30',1,0),(13,25,'Drink',0,30,2,0,'2022-07-08 16:18:35',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.27635,72.8570419,'2022-07-08 15:48:35',1,0),(14,20,'Meet for coffee',0,20,1,2,'2022-07-08 16:31:54',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2757918,72.8688154,'2022-07-08 16:11:54',1,0),(15,27,'Ok',0,30,2,0,'2022-07-11 21:18:35',0,0,0,0,'Bandra East Mumbai 400051',19.0661139,72.8558049,'2022-07-11 20:48:35',1,0),(16,21,'Meet',0,60,2,0,'2022-07-13 10:31:29',0,0,0,0,'Bhandup East Mumbai 400080',19.152616,72.9479875,'2022-07-13 09:31:29',1,0),(17,29,'Go for a movie ',0,60,2,0,'2022-08-22 14:37:04',0,0,0,0,'Goregaon Mumbai 400063',19.1736818,72.8600856,'2022-08-22 13:37:04',1,0),(18,33,'Enjoying ',0,30,2,2,'2022-08-30 18:37:35',0,0,0,0,'Chowk Lucknow 226003',26.8617459,80.9061638,'2022-08-30 18:07:35',1,0),(19,33,'Enjoying ',0,2,2,0,'2022-08-30 18:10:08',0,0,0,0,'Chowk Lucknow 226003',26.8617436,80.9061689,'2022-08-30 18:08:08',1,0),(20,19,'Meet for Coffee',0,5,2,2,'2022-09-01 10:25:33',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2758166,72.8688262,'2022-09-01 10:20:33',1,0),(21,34,'Python',0,30,2,0,'2022-09-01 20:48:07',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2871587,72.8636589,'2022-09-01 20:18:07',1,0),(22,34,'Car',0,30,1,0,'2022-09-03 12:17:17',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2842563,72.8634943,'2022-09-03 11:47:17',1,0),(23,34,'Car',0,10000,2,2,'2022-09-10 16:23:05',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2842638,72.863484,'2022-09-03 17:43:05',1,0),(24,34,'Drive',0,30,2,2,'2022-09-03 18:44:40',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2842741,72.8634745,'2022-09-03 18:14:40',1,0),(25,34,'Anyone up tea',0,10,2,2,'2022-09-03 21:26:12',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2842681,72.8634921,'2022-09-03 21:16:12',1,0),(26,34,'Have a tea',0,30,2,2,'2022-09-15 12:29:02',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2840907,72.8639173,'2022-09-15 11:59:02',1,0),(27,35,'Jog',0,12,1,2,'2022-09-17 13:20:48',0,0,0,0,'Jogeshwari West Mumbai 400102',19.1382981,72.8448264,'2022-09-17 13:08:48',1,0),(28,35,'Play video games',0,2,1,0,'2022-09-17 13:14:58',1,2,13.0685,77.5977,'Jogeshwari West Mumbai 400102',19.1382981,72.8448264,'2022-09-17 13:12:58',1,0),(29,34,'Shop',0,30,2,0,'2022-09-21 13:26:15',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2843016,72.8634899,'2022-09-21 12:56:15',1,0),(30,34,'Go for coffee ',0,30,2,2,'2022-10-08 18:43:18',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2843051,72.8634886,'2022-10-08 18:13:18',1,0),(31,34,'Watch a movie',0,30,2,2,'2022-10-08 18:44:35',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2843009,72.86349,'2022-10-08 18:14:35',1,0),(32,34,'Go for tea',0,30,2,0,'2022-10-09 16:24:21',0,0,0,0,'Mira Road Mira Bhayandar 401107',19.2721953,72.8642536,'2022-10-09 15:54:21',1,0);
/*!40000 ALTER TABLE `lets_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lets_selfi_pics`
--

DROP TABLE IF EXISTS `lets_selfi_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lets_selfi_pics` (
  `lets_selfi_id` int NOT NULL AUTO_INCREMENT,
  `lets_id` int NOT NULL,
  `user_id` int NOT NULL,
  `img_name` varchar(500) NOT NULL,
  `img_ord` int NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`lets_selfi_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lets_selfi_pics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_mas` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lets_selfi_pics`
--

LOCK TABLES `lets_selfi_pics` WRITE;
/*!40000 ALTER TABLE `lets_selfi_pics` DISABLE KEYS */;
/*!40000 ALTER TABLE `lets_selfi_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restricted_keywords`
--

DROP TABLE IF EXISTS `restricted_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restricted_keywords` (
  `keyword_id` int NOT NULL AUTO_INCREMENT,
  `keyword_text` varchar(120) NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`keyword_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restricted_keywords`
--

LOCK TABLES `restricted_keywords` WRITE;
/*!40000 ALTER TABLE `restricted_keywords` DISABLE KEYS */;
INSERT INTO `restricted_keywords` VALUES (1,'FUCK','2021-02-23 02:43:31',0);
/*!40000 ALTER TABLE `restricted_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_plans` (
  `subscription_plan_id` int NOT NULL AUTO_INCREMENT,
  `plan_type` int NOT NULL COMMENT '1-General, 2-Package',
  `plan_price` float NOT NULL,
  `discount_price` float NOT NULL,
  `num_of_lets` int NOT NULL,
  `validity_days` int NOT NULL,
  `cap_perday` int NOT NULL,
  `apple_product_key` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apple_title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apple_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_flag` int NOT NULL DEFAULT '1' COMMENT '0-Inactive, 1-Active',
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`subscription_plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_plans`
--

LOCK TABLES `subscription_plans` WRITE;
/*!40000 ALTER TABLE `subscription_plans` DISABLE KEYS */;
INSERT INTO `subscription_plans` VALUES (1,1,250,179,1,1,1,'Plan99','Plan 250','Get 1 Lets for 1 Day',1,'2021-02-01 00:00:00',0),(2,1,3500,799,10,30,0,'Plan799','Plan 3500','Get 10 Lets for 30 Days',1,'2021-02-01 00:00:00',0),(3,1,5000,1399,30,30,0,'Plan1399','Plan 5000','Get 30 Lets for 30 Days',1,'2021-02-01 00:00:00',0),(4,2,4999,4499,0,90,48,'','','  ',1,'2021-02-01 00:00:00',0),(5,2,8999,8499,0,180,48,'','','',1,'2021-02-01 00:00:00',0),(6,2,11999,11499,0,360,48,'','','',1,'2021-02-01 00:00:00',0);
/*!40000 ALTER TABLE `subscription_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_mas`
--

DROP TABLE IF EXISTS `tag_mas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_mas` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(250) NOT NULL,
  `active_flag` int NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Inactive',
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active,1-Deleted',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_mas`
--

LOCK TABLES `tag_mas` WRITE;
/*!40000 ALTER TABLE `tag_mas` DISABLE KEYS */;
INSERT INTO `tag_mas` VALUES (1,'Male',1,'2020-03-09 16:41:41',0),(2,'Female',1,'2020-03-09 16:41:48',0),(3,'Transgender',1,'2020-03-09 16:42:23',0),(4,'Couple',1,'2020-03-09 16:42:30',0),(5,'Cross - dresser',1,'2020-03-09 16:43:09',0);
/*!40000 ALTER TABLE `tag_mas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `tags` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES ('KCUF'),('FUCK'),('FCUK'),('FKUC'),('SEX'),('SXE'),('NSFW'),('HUMP'),('GRIND'),('PUMP'),('BANG'),('CHILL'),('NETFLIX'),('NFLIX'),('CILL'),('HANG'),('COCKY'),('KINK'),('KINKY'),('CNC'),('RAPE'),('420'),('DRUNK'),('2SUM'),('TWO SOME'),('TWOSOME'),('2SOME'),('THREE SOME'),('THREESOME'),('3SOME'),('FOUR SOME'),('FOURSOME'),('4SOME'),('FIVE SOME'),('FIVESOME'),('5SOME'),('MAKEOUT'),('MAKE OUT'),('HIGH'),('SMOKEUP'),('SMOKE UP'),('SLUTTY'),('PNP'),('FWB'),('LOOKING'),('PLAYTHING'),('PLAY THING'),('ORGY'),('ORAL'),('SUICIDE'),('KILL'),('MO'),('FRIENDS'),('SWING');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_lets_request`
--

DROP TABLE IF EXISTS `temp_lets_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_lets_request` (
  `temp_lets_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `lets_text` varchar(120) NOT NULL,
  `lets_keyword_id` int NOT NULL,
  `lets_duration` int NOT NULL,
  `gender_id` int NOT NULL,
  `expires_at` datetime NOT NULL,
  `locality` text NOT NULL,
  `lets_lat` double NOT NULL,
  `lets_lng` double NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1- Deleted',
  PRIMARY KEY (`temp_lets_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_lets_request`
--

LOCK TABLES `temp_lets_request` WRITE;
/*!40000 ALTER TABLE `temp_lets_request` DISABLE KEYS */;
INSERT INTO `temp_lets_request` VALUES (1,2,'Fuck',0,10,2,'0000-00-00 00:00:00','',0,0,'2021-02-23 13:11:19',0),(2,2,'Cofee',0,10,1,'0000-00-00 00:00:00','',0,0,'2021-02-26 19:08:12',0),(3,2,'Cofee',0,30,2,'0000-00-00 00:00:00','',0,0,'2021-03-25 21:03:30',0),(4,2,'Coffee',0,10,1,'0000-00-00 00:00:00','',0,0,'2021-06-23 17:43:43',0),(5,2,'Coffe',0,10,1,'0000-00-00 00:00:00','',0,0,'2021-06-23 17:50:15',0),(6,2,'Coffee',0,10,1,'0000-00-00 00:00:00','',0,0,'2021-06-23 18:01:42',0),(7,2,'Coffee',0,10,2,'0000-00-00 00:00:00','',0,0,'2021-06-23 18:07:33',0),(8,1,'Coffee',0,12,1,'0000-00-00 00:00:00','',0,0,'2021-06-23 18:29:21',0),(9,2,'Coffee',0,5,1,'0000-00-00 00:00:00','',0,0,'2021-06-24 12:21:22',0),(10,2,'Work',0,5,1,'0000-00-00 00:00:00','',0,0,'2021-06-24 12:24:05',0),(11,13,'Debate',0,30,2,'0000-00-00 00:00:00','',0,0,'2022-06-23 20:27:31',0),(12,13,'Debate',0,30,2,'0000-00-00 00:00:00','',0,0,'2022-06-23 21:30:34',0),(13,2,'Coffee ',0,5,1,'0000-00-00 00:00:00','',0,0,'2022-07-08 15:11:48',0),(14,2,'Gym',0,30,2,'0000-00-00 00:00:00','',0,0,'2022-07-26 17:14:03',0);
/*!40000 ALTER TABLE `temp_lets_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_user_mas`
--

DROP TABLE IF EXISTS `temp_user_mas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_user_mas` (
  `temp_user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `profile_pic` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `country_phone_code` varchar(20) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `country_id` int NOT NULL,
  `password` varchar(200) NOT NULL,
  `reg_otp` varchar(10) NOT NULL COMMENT 'OTP for mobile number change',
  `active_flag` int NOT NULL DEFAULT '1' COMMENT '1-Active,0-Inctive',
  `last_device_type` int NOT NULL DEFAULT '0' COMMENT '1- Android, 2- IOS',
  `last_device_id` varchar(300) NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '1-Deleted,0-Active',
  PRIMARY KEY (`temp_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_user_mas`
--

LOCK TABLES `temp_user_mas` WRITE;
/*!40000 ALTER TABLE `temp_user_mas` DISABLE KEYS */;
INSERT INTO `temp_user_mas` VALUES (1,'','','','91','9481540027',99,'','123456',1,0,'','2020-02-25 17:44:42',0),(2,'','','','91','9901679949',99,'','123456',1,0,'','2020-02-25 20:04:56',0),(3,'','','','91','9901679948',99,'','123456',1,0,'','2020-02-28 19:22:30',0),(4,'','','','91','1111111111',99,'','123456',1,0,'','2020-02-28 19:23:50',0),(5,'','','','91','1111111111',99,'','123456',1,0,'','2020-02-28 19:26:23',0),(6,'','','','91','1111111111',99,'','123456',1,0,'','2020-02-28 19:28:41',0),(7,'','','','91','7506946448',99,'','123456',1,0,'','2020-02-29 12:18:09',0),(8,'','','','91','7506946448',99,'','123456',1,0,'','2020-02-29 12:24:13',0),(9,'','','','91','1234567890',99,'','123456',1,0,'','2020-03-20 17:10:41',0),(10,'','','','91','9582447884',99,'','123456',1,0,'','2020-03-21 00:20:14',0),(11,'','','','91','7506946449',99,'','123456',1,0,'','2020-03-21 20:55:23',0),(12,'','','','91','9035466603',99,'','123456',1,0,'','2021-01-11 13:43:38',0),(13,'','','','91','8792040168',99,'','123456',1,0,'','2021-01-11 13:43:47',0),(14,'','','','91','8901245432',99,'','123456',1,0,'','2021-02-04 20:06:57',0),(15,'','','','91','1234567871',99,'','123456',1,0,'','2021-02-04 20:08:00',0),(16,'','','','91','1234567898',99,'','123456',1,0,'','2021-02-04 20:09:10',0),(17,'','','','91','1234567891',99,'','123456',1,0,'','2021-02-04 20:10:03',0),(18,'','','','91','1234567898',99,'','123456',1,0,'','2021-02-04 20:10:26',0),(19,'','','','91','1234567898',99,'','123456',1,0,'','2021-02-04 20:11:30',0),(20,'','','','91','7208727450',99,'','123456',1,0,'','2021-02-05 15:37:27',0),(21,'','','','91','7208727450',99,'','123456',1,0,'','2021-02-05 15:38:06',0),(22,'','','','91','7208727450',99,'','123456',1,0,'','2021-02-05 15:39:24',0),(23,'','','','91','1234567891',99,'','123456',1,0,'','2021-02-05 19:24:44',0),(24,'','','','91','7406091563',99,'','123456',1,0,'','2021-02-06 19:30:38',0),(25,'','','','91','9820913006',99,'','123456',1,0,'','2021-02-10 12:10:04',0),(26,'','','','91','7208727450',99,'','123456',1,0,'','2021-02-15 09:25:46',0),(27,'','','','91','9635552258',99,'','123456',1,0,'','2021-02-23 21:49:01',0),(28,'','','','91','9157379728',99,'','123456',1,0,'','2021-02-23 22:26:08',0),(29,'','','','91','6262929235',99,'','123456',1,0,'','2021-02-25 20:28:30',0),(30,'','','','91','9901679948',99,'','123456',1,0,'','2021-02-25 20:29:13',0),(31,'','','','91','1234123423',99,'','123456',1,0,'','2021-02-26 18:52:21',0),(32,'','','','91','1234123423',99,'','123456',1,0,'','2021-02-26 18:53:02',0),(33,'','','','91','9481540037',99,'','123456',1,0,'','2021-02-26 18:54:01',0),(34,'','','','91','1234567812',99,'','123456',1,0,'','2021-02-26 18:55:01',0),(35,'','','','91','1234561231',99,'','123456',1,0,'','2021-02-26 18:55:55',0),(36,'','','','91','9999999999',99,'','123456',1,0,'','2021-04-22 19:57:06',0),(37,'','','','91','9591387472',99,'VdlUHpFRCNnYHpERkZkVVVGVCZVVB1TP','123456',1,0,'','2022-06-23 14:37:27',0),(38,'','','','91','9930720207',99,'=AFVxI1VrpVYW1mTYpVRaxWYEZkVZtGd3JGbslkUsJFa','123456',1,0,'','2022-07-01 19:17:14',0),(39,'','','','91','9930720207',99,'=AFVxI1VrpVYW1mTYpVRaxWYEZkVZtGd3JGbslkUsJFa','123456',1,0,'','2022-07-01 19:19:02',0),(40,'','','','91','9526000817',99,'=UlVKdFVV50UidkSzM2R0dlUrpVcVZlU0IlMGhmVsR2UX1Ge1ZVb0gnVGFUP','123456',1,0,'','2022-07-07 10:05:33',0),(41,'','','','91','9526000817',99,'=UlVKdFVV50UidkSzM2R0dlUrpVcVZlU0IlMGhmVsR2UX1Ge1ZVb0gnVGFUP','895205',1,0,'','2022-07-07 14:21:34',0),(42,'','','','91','8976652258',99,'iZkWyZleCtmVtlUMPRkQXJVMaZVVB1TP','556013',1,0,'','2022-07-08 09:11:02',0),(43,'','','','91','9892988999',99,'=UlVKdFVW50TSxGZ2NVb4p1VEZlcUdlRTFWMShnVqpEaZdFaWZleNhnVGFUP','970587',1,0,'','2022-07-08 09:13:50',0),(44,'','','','91','8652459606',99,'=UlVKdFVYBnUSxGZ6NFbWp1YrpVRUxWT4ZFMx82UrRmTNd1c4ZFbJhnVGFUP','465315',1,0,'','2022-07-08 12:29:52',0),(45,'','','','91','9870444334',99,'=AFVxIkVWh2UXZkWWN2RxclUwA3cVtGZ3JGbalXVqpEahZkWyVleGNnYHp0QW1GcXVWRWdVVB1TP','767312',1,0,'','2022-07-08 13:12:43',0),(46,'','','','91','9833606095',99,'=UlVKdFVW50TSxmWYN2R0ZlUxAncaZkV0IlMGZnVsR2VZdFaXZFbJhnVGFUP','594607',1,0,'','2022-07-08 15:03:37',0),(47,'','','','91','9870866466',99,'=UlVKdFVYBnUSxGZ6dVb0ZlUxolVUZVT4ZFMxcHVsR2UkJDeyZVb0gnVGFUP','125953',1,0,'','2022-07-08 15:44:07',0),(48,'','','','91','9930720207',99,'=AFVxI1VrpVYW1mTYpVRaxWYEZkVZtGd3JGbslkUsJFa','610296',1,0,'','2022-07-09 14:09:38',0),(49,'','','','91','9867892474',99,'=UlVKdFVV50USxGZ6NGRCd1UFB3VUZlT3JmVOlnTWZVaOZkSZZleNhnVGFUP','381826',1,0,'','2022-07-11 06:34:39',0),(50,'','','','91','7428730894',99,'=AFVxIkVWZ1RhxmVWN2RxIFVwkVeZhFaSZlRallUtBHahpnRYZFVaNXTVFzMadEdWVGVCZVVB1TP','104315',1,0,'','2022-08-05 20:06:19',0),(51,'','','','91','9930903090',99,'=UlVadUWsp1USxmWMNGRGd1UGBncaZkV0IlMGhmUrRmTX1GeZZleNhnVGFUP','813713',1,0,'','2022-08-18 20:10:50',0),(52,'','','','91','8369470507',99,'=AFVxIkVWZ1RhxmVWN2RxIFVwkVeZhFaSZlRallUtBHahpnRYZFVaNXTVFzMadEdWVGVCZVVB1TP','767372',1,0,'','2022-08-22 13:33:49',0),(53,'','','','91','9867886715',99,'VZlSHlVVsNnYHpEUadEeWVmVWZVVB1TP','046260',1,0,'','2022-08-27 21:54:53',0),(54,'','','','91','8689989786',99,'idEayZlRstmUsRGUadEdaZlM4ZVVB1TP','667022',1,0,'','2022-08-27 23:28:20',0),(55,'','','','91','8689989786',99,'idEayZlRstmUsRGUadEdaZlM4ZVVB1TP','940610',1,0,'','2022-08-28 00:38:18',0),(56,'','','','91','7652080579',99,'=UlVKNnVWx2aSxGZXJVbwdVZIRGSUdFehJlVwlnUrRmTkJzZ4ZFbJhnVGFUP','425507',1,0,'','2022-08-28 23:46:23',0),(57,'','','','91','7705083803',99,'=UlVKdFVYBnUidkSy50V0dlUspURUZFavJVbOBVTUJ0VNZkWGZlaNhnVGFUP','392791',1,0,'','2022-08-30 18:03:04',0),(58,'','','','91','9967995820',99,'=AFVxIkVWh2UWFjSWVVb4dVYFVzcVtGZv1UMsdUVqpkV','351794',1,0,'','2022-09-01 20:15:59',0),(59,'','','','91','9324884083',99,'=AFVxIlVIJ1UiVVNWR2RxM1UGB3cUV1c1IVMapXYEpEa','744245',1,0,'','2022-09-17 13:05:40',0),(60,'','','','91','9920021074',99,'=AFVxIkVWZ1RhxmRV5UVklmUwoFSZ5mTDJGbWp3VthnV','771073',1,0,'','2022-10-06 21:48:40',0),(61,'','','','91','9920021073',99,'=AFVxIkVWZ1RhxmRV5UVklmUwoFSZ5mTDJGbWp3VthnV','332540',1,0,'','2022-10-06 21:49:11',0);
/*!40000 ALTER TABLE `temp_user_mas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_user_subscription`
--

DROP TABLE IF EXISTS `temp_user_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_user_subscription` (
  `temp_subscription_id` int NOT NULL AUTO_INCREMENT,
  `subscription_plan_id` int NOT NULL,
  `user_id` int NOT NULL,
  `plan_type` int NOT NULL COMMENT '1-General, 2-Package',
  `plan_price` float NOT NULL,
  `discount_price` float NOT NULL,
  `num_of_lets` int NOT NULL,
  `validity_days` int NOT NULL,
  `payable_amt` float NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`temp_subscription_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_user_subscription`
--

LOCK TABLES `temp_user_subscription` WRITE;
/*!40000 ALTER TABLE `temp_user_subscription` DISABLE KEYS */;
INSERT INTO `temp_user_subscription` VALUES (9,5,1,2,2000,1000,0,180,1000,NULL,'0000-00-00 00:00:00',0),(10,2,1,1,3500,799,10,30,799,NULL,'0000-00-00 00:00:00',0),(11,2,1,1,3500,799,10,30,799,NULL,'0000-00-00 00:00:00',0),(12,5,2,2,2000,1000,0,180,1000,NULL,'0000-00-00 00:00:00',0),(13,6,2,2,2000,1000,0,360,1000,NULL,'0000-00-00 00:00:00',0),(14,2,2,1,3500,799,10,30,799,NULL,'0000-00-00 00:00:00',0),(15,1,2,1,250,99,1,1,99,NULL,'0000-00-00 00:00:00',0),(16,1,1,1,250,99,1,1,99,'2021-02-20','0000-00-00 00:00:00',0),(17,1,1,1,250,99,1,1,99,'2021-02-20','0000-00-00 00:00:00',0),(18,1,2,1,250,99,1,1,99,'2021-02-23','0000-00-00 00:00:00',0),(19,1,2,1,250,99,1,1,99,'2021-02-24','2021-02-23 13:11:20',0),(20,1,2,1,250,99,1,1,99,'2021-02-26','2021-02-25 20:17:28',0),(21,1,2,1,250,99,1,1,99,'2021-02-27','2021-02-26 19:08:24',0),(22,2,2,1,3500,799,10,30,799,'2021-04-24','2021-03-25 21:03:44',0),(23,1,2,1,250,99,1,1,99,'2021-06-24','2021-06-23 17:43:47',0),(24,1,2,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:01:44',0),(25,1,1,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:29:25',0),(26,1,8,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:32:05',0),(27,1,8,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:32:06',0),(28,1,1,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:33:14',0),(29,1,1,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:33:16',0),(30,1,1,1,250,99,1,1,99,'2021-06-24','2021-06-23 18:33:41',0),(31,1,1,1,250,99,1,1,99,'2021-06-25','2021-06-24 10:58:46',0),(32,1,2,1,250,99,1,1,99,'2021-06-25','2021-06-24 12:21:29',0),(33,1,13,1,250,179,1,1,179,'2022-06-24','2022-06-23 21:30:47',0),(34,1,2,1,250,179,1,1,179,'2022-07-09','2022-07-08 15:11:50',0),(35,5,2,2,8999,8499,0,180,8499,'2023-01-22','2022-07-26 17:14:07',0),(36,4,2,2,4999,4499,0,90,4499,'2022-10-24','2022-07-26 17:14:21',0),(37,6,2,2,11999,11499,0,360,11499,'2023-07-21','2022-07-26 17:14:25',0),(38,6,2,2,11999,11499,0,360,11499,'2023-07-21','2022-07-26 17:14:31',0),(39,3,2,1,5000,1399,30,30,1399,'2022-09-11','2022-08-12 06:41:52',0);
/*!40000 ALTER TABLE `temp_user_subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_device`
--

DROP TABLE IF EXISTS `user_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_device` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `device_id` varchar(250) NOT NULL,
  `fcm_token_id` varchar(250) NOT NULL,
  `os_type` int NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '1 - Deleted, 0 - Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_device`
--

LOCK TABLES `user_device` WRITE;
/*!40000 ALTER TABLE `user_device` DISABLE KEYS */;
INSERT INTO `user_device` VALUES (1,1,'65ccdd9b999a81b6','foeAmZ58I90:APA91bHhZuxbPg9WM7P_4kPtbQAzPB9PnvmmtaLYZE1OijJaGoRTNE8qsCw2d16BEE3pvkh27zdoqkCgGWilwg8OKPxfdddrt62NaoTDQmA6fSsgL8PBKwZkBKVktZgHZBaeygQTmpdI',1,'2021-02-24 15:41:00','2021-06-25 14:29:00',0),(2,2,'ff31449d3e5c7127','cAvHCcxDHJ0:APA91bG5kwUqb3UzYKDjjtPEj2pTLgQtIqH-x8hjUEvc7Id7dD9IRlTIA56K-zE4TLdxCxpI4tH3u0t9YFJzgjQSPI_82O6pr_yXjCt_8NAjG-s5oCqOKfCb5jzidXVjyPcRIf15fO__',1,'2021-02-25 20:43:00','2021-06-23 19:28:00',0),(3,13,'e769f7c052ca4aea','c5b1YGArMlo:APA91bGuloeOUIm2_GBTtjCbMHHXy75YBqR6BrScky-eI7qQaYga3_4AvaCBSMWcBJn_yQ-cJ6jrcoeYvmep47hp_bHwWVP2nkIiyzitC5aYZ_WIaqswkdfYAol6vrn7iznkaKLHeWoW',1,'2021-02-25 20:17:00','2021-02-27 17:23:00',0),(4,14,'4a49a2af811b4ef6','c5Q8zjfnEmM:APA91bFZdOPZu8zqFNZERlG5PHSdGfYYW6KH-A1MdBDuTx1uRXqn0-rcpdkThBSA8Px0EZn5aLMGDmiNs4N_KiGoP-AHZk2S3U2nPd4zCDGKUtAThjbT3zYpu2XmSdU_S1kvod0LZAYL',1,'2021-02-25 20:02:00','2021-04-23 15:32:00',0),(5,8,'b05f0cea9dd417a7','dHnd6wy4Q78:APA91bEciTwq2hDpN2ST2tQ4xCO-mc2Ql91SmrBrrTqCr4MMGGpbKHduG_vHzBg9_x3mMIyzH90XH9jyRIkpYpZ5iGRLS6SWarBVt7YA6XHMG9AbQHcx9HYRo7UiFINUKJ5pa_SrqkUK',1,'2021-06-04 12:56:00','2021-06-16 12:23:00',0),(6,8,'48f49526fdcb9b08','f8WA-poqjrM:APA91bFWE6CF1Di5ARnBUmDtZ3PUZlx-wMHNGnf23DuZSFtsQ9Vg2f_vzLln43bWhK8nMfeJtg2NO7kF14zoibUpOPDz0WK4oj5-zsbvUXZ2tCuQUvdn25KqZO_5jp5qUeMAWcRHBwnm',1,'2021-06-16 10:16:00','2021-06-17 11:12:00',0),(7,1,'1a3c086896b8be9a','eOroZBHi3qY:APA91bF__Kltlm4hbIIk3jj_a7RgyOX-0U8Gk7IH-wcDomCrLonqjM_-RAa7MJlsWS3OyqMVEkjFRzgxHbrbMnbwGqOggdd69-tlxJlNlqun2uX4mYnG2yPaO45iP3oaw3Imn2K-eE6Q',1,'2021-06-17 17:33:00','2021-06-25 04:24:00',0),(8,2,'3ed26c63d77fb402','dHpeXGguC-U:APA91bGRH_SRV3-82XA7h8ab21OKwgwLMH_eOI74T6EhJnpl_SA7CbrJbcxgKxR417w1zFqtmnVYew3lxGdJ1xF4NxA-wU1Y_q5nuBWZuwtBbX907KxYtGYziA4HPiirbP6g8Xdlbfqh',1,'2021-06-24 12:06:00','2021-06-24 13:28:00',0),(9,1,'af84d691f305b03b','eogjM9s1MvQ:APA91bHNM1f2Y6Ud-CmCucJT9wyBbWKpjQ10rglUM3NU-ScWjQYZ9mtQz4Kr4GCj5uERu3WjO8Ki21DwvwbhTzw_C6SsRpFOpneVXt_BkyhgB7bXx960xe7LtMackK-KVBDFCCrH9Jxd',1,'2021-06-29 12:41:00','2021-06-29 12:20:00',0),(10,2,'91c25b91538c123c','dY1j9QamdWU:APA91bEzuFP4CeOYvUH0cB5XYRUQYXwlCqGEGHE5zFjHMK7S3JZGit27NkrJF15Y2OMtdA2rtIG4CBoyPU_iAAp1N-ugdUUWrv1dfq0xWX6l2y_I3ahgXxESzS88odtLKKWDTa3sgpqt',1,'2022-06-01 01:41:00','2022-09-17 13:00:00',0),(11,13,'e4d2504ebd5dd3ed','c8V_VtI9FGQ:APA91bHEXYIMBPK7pdtRfjxGUSfCWpzJE0e6GlGPQ2O175x7R_waL2bQKzzlQdVEBsUVf88wUBhIlb_3dBbCFqadJEvXzx9rAiNWiji55sUoRek6j64Q0P8R-9z8jKWonGlf3KmTRDuS',1,'2022-06-05 08:56:00','2022-11-06 22:30:00',0),(12,19,'214f007482573a72','eveXyqQrFso:APA91bF0A2yGf1o9-GtisYShMbhxaKUQv64gsp9N4OiKrRG5IBuhz4r2vdLUNB8gWwjEHjBh7fYIRurMl2fBsu3DV-pj_BmIBTZuvOCZIDIC1T0ZGPywjWtTgxFqfmqbgdrj7QvvDpQA',1,'2022-06-17 20:24:00','2022-11-02 14:13:00',0),(13,20,'2a17082db305209e','ceIkPiJ1qMY:APA91bFhC1kHH7nJuaPD_YhOWnzZDqRUh8Nm-5sGfcnoZkOCxl029Wdj0WH44M29RJSfnizgUAVyPLz9shQk87EUa2fCTnGi2lf-bQBkEA3Su04MUlotTYKhBKetupmGmIdwrr9pXSj1',1,'2022-07-08 09:51:00','2022-07-10 17:16:00',0),(14,22,'a582e65933ad7156','eqb-LOP-bX0:APA91bHNIlrn5Fil1aLZIwU0BmpQZDmPyXuOCWukD8QuPAomNmkzKlrpoV7HNFbCCn-fSI4jofcwLTj2NobtuNbVC4tA8YXzrYAp2pI5rKX5yzPk7_C456Ep9IDuMjCkvH9p5MEOaW7j',1,'2022-07-08 12:12:00','0000-00-00 00:00:00',0),(15,16,'bb0d71998b5f002d','dORqQXwbYpU:APA91bGiiIoqNciqrpb-JSvzMNiYedRxnIPTK33DUqodZFU-4zI8robX9chUJQqgab9YBM_lkeCa-Rs0YHiYCHd_0qieRc1nyKuEfM4lcOvcDHZlof7SD2s4f99AalSvJ7wc-389eMQX',1,'2022-07-08 14:08:00','2022-09-27 22:09:00',0),(16,24,'97b1c40b2a649973','dulVnBNAltI:APA91bF1GZFWw3QPR2zzl_OnA0IyA3WG_iQ76P4myG9SLaRtISBoEwAX47jFuDmTfe6N_ovdPMt_kuUuGGbfWrQXP9EIENlxIHza090WqIPX1T-Z_g-kEvejo58GEEcNt5r5cPo_o3eT',1,'2022-07-08 14:13:00','2022-07-08 15:55:00',0),(17,25,'2a464537336e3a14','cpgMIuy0twg:APA91bG3hnISb0akvZjpxG3X3tBvKYF6tCfGUWA7yGTPyFlrO-b_NPEno2NDeCo1QuyDwDCUMmmkGlNMF3JNNz3xKiMrA52nltb9MWzbKNALbHKdqCRkkQVNuYJlWisTYUKHUFsgKsc0',1,'2022-07-08 15:10:00','0000-00-00 00:00:00',0),(18,27,'45d5feac42bffeea','fIdT1ge1GR0:APA91bFMTFVYaa0oVmKEjbWZ1IV9HK57d0HVO8PeIbAR6-oM4Xi9zH_y6BUyy3XCEhVkgwEcKPenjsJ45L12VUXGS8U9OMkveIF--GfzgFiFjsrrRR5My3jVKpir9lzrAj_53SrxO4HG',1,'2022-07-11 20:45:00','2022-07-12 19:35:00',0),(19,21,'c811e763fec52de9','dZnyqV1R4wU:APA91bFE9IwqatF7ZR8MJV2NnATFdVDLtbNnxUqRiEz8C9EWAwpX1_T7t4JpWqXuJO6jQrvyjd5Jh0CFVv__WTn9pID-XdODGI2CeIXWGaO4hhnKi9aWq6xV8xMMAq03fT6Qe7HqP0Gk',1,'2022-07-13 09:27:00','2022-10-29 17:15:00',0),(20,14,'cee725cb9216852e','c4W4CCeuies:APA91bGi6PZGLuhX1SM0kYGcEvPfNrgpoifCqUgWKOYj0944CRlUq_TNV5gBGtHR7yYSRT30dXTrjaOzUWcr0JULNr-Q_4s76przoF7pTfipAt2VX4WgOZfAJtH-xVIF2UhMZ7TqjAY-',1,'2022-07-23 10:53:00','0000-00-00 00:00:00',0),(21,2,'e3558cd89b28e3cf','cPQFYWdxTx4:APA91bFIgZiePevtLS465yhQu_hQbreObX68-TK_g7jsysTEgSVm1j-8dK5797QrtBeHdSO1hdxgJQ7o9pnH7etvyEh4QpVuxX1oRy35syw83bT6iOKa1vUHV-FX-feJZorcBBguilYV',1,'2022-07-26 17:33:00','0000-00-00 00:00:00',0),(22,29,'221780e53e6314a9','c4pE9_FJomQ:APA91bEyWfX2Q5xy2TO1E5AIXl5wTEtenx3_dz-vu630sQJw1OfWuzfmJy6KdLQgT-9noADXxjF9EshAnTep9hGU5S-_MgyjrUj8aZSEgeTCIZM-OugQamGpd5K3TvG1HN13HhMQxQ72',1,'2022-08-22 13:39:00','2022-08-28 17:09:00',0),(23,33,'1eb525c0fbfe1369','eu8_fI9LYxM:APA91bE-YIKv33ElhlCy6ecp5qh-MA91ZnuruMJIHtzRbHtMBLwpLAIfzodOIs5MH7QugDfGVz15jJpDV_Pstxlvl6ef1TgZ3LB2uOxi0B4yL4s440QpZ55QSawhvh91AmtIhg9VoatW',1,'2022-08-30 18:40:00','2022-10-16 12:04:00',0),(24,34,'4964e587a1d21c25','eqK3t81lECY:APA91bE5G-s-jwCZguAKtrtfTNoPlOYz6P4hGHXMFfvznlXSRZGzwrIzNTcAT4HneZseblWARkwSdzz3fVrO98TVIvCGKpRo2X6Z-m64YZtv9bun3uJ8gkv7wMFGHssE3LazkTkN1GS3',1,'2022-09-01 20:44:00','2022-10-23 21:29:00',0),(25,35,'e8f744e5bb8b7eba','c6XLKLe0bz8:APA91bF_FMC6um3Mq6v_h7uGqBXyZ62dWQ1Gw1N5KWqhsbH8XcWTNoRUAr2CMV_jUw0bGaaFi2JzRiozWAYzasM68SBHyH1f8PHklxCpITPKJ9bCyBwOxTRyfphLz7J9oS-7VgmUO6GA',1,'2022-09-17 13:08:00','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `user_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_gallery_pics`
--

DROP TABLE IF EXISTS `user_gallery_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_gallery_pics` (
  `user_gallery_id` int NOT NULL AUTO_INCREMENT,
  `img_ord` int NOT NULL,
  `user_id` int NOT NULL,
  `img_name` varchar(500) NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`user_gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_gallery_pics`
--

LOCK TABLES `user_gallery_pics` WRITE;
/*!40000 ALTER TABLE `user_gallery_pics` DISABLE KEYS */;
INSERT INTO `user_gallery_pics` VALUES (1,1,1,'gallery_53cee0085ab4396c9f2a77dcaefe3254.jpeg','2021-06-17 10:00:36',0),(2,2,2,'gallery_ebc054cdcf1f17023c4fc4348a7738df.jpeg','2022-07-08 13:59:27',0),(3,1,2,'gallery_fd762aa144310a492e9f7b9c6b2b4869.jpeg','2022-06-30 14:47:36',0),(4,1,7,'gallery_563afc99f3fee6aa55402c4b222eb49f.jpeg','2020-03-21 20:57:32',0),(5,1,3,'gallery_ea9347dd1d7020b5fd82720f7e094d93.jpeg','2020-06-05 09:52:36',0),(6,3,2,'gallery_f85de560b0b0fb2da8666dc7f3df5719.jpeg','2022-06-23 18:26:53',0),(7,4,2,'gallery_f230847a9703e022f486319a9567e69b.jpeg','2020-11-17 15:44:20',0),(8,2,1,'gallery_087bd0baef1a1cc53787b069dc6b2b42.jpeg','2021-06-16 16:54:01',0),(9,1,10,'gallery_3ded34e795a18faf026540e486a7e191.jpeg','2021-02-10 12:16:50',0),(10,2,10,'gallery_0c3efb553d0a651dca8042e4414612af.jpeg','2021-02-10 12:17:01',0),(11,1,11,'gallery_7a268292344c745850a00b3fb0c46637.jpeg','2021-02-15 09:27:14',0),(12,2,11,'gallery_389e23d30d8ae002bc47a3b73463ff05.jpeg','2021-02-15 09:27:26',0),(13,3,11,'gallery_42fe26ebd48cbcd94cb64893977dc2c7.jpeg','2021-02-15 09:28:02',0),(14,3,1,'gallery_794b44a56444f65b107483e054a35429.jpeg','2021-02-19 23:44:01',0),(15,1,15,'gallery_c2388ffe30ae9984eef32d969a3ea42b.jpeg','2021-02-25 20:30:36',0),(16,1,17,'gallery_ae676f73224f338060d9dcab0fa625a3.jpeg','2021-04-22 19:58:16',0),(17,1,22,'gallery_c2d573f7e3572710133a82bee7b73d80.jpeg','2022-07-08 12:31:06',0),(18,2,22,'gallery_9f2f7afaeea875d35b6c6014e497291a.jpeg','2022-07-08 12:31:14',0),(19,3,22,'gallery_2f24bc7f72ac51007195feb93ef00926.jpeg','2022-07-08 12:31:26',0),(20,4,22,'gallery_bc7e9db68fa29bfb071a68b16f454a2d.jpeg','2022-07-08 12:32:06',0),(21,1,29,'gallery_805b007f7adc74b434582cb363fa487b.jpeg','2022-08-22 13:35:03',0),(22,1,33,'gallery_ec820ad19264b5a094f6446403be3c38.jpeg','2022-09-01 12:18:52',0),(23,1,34,'gallery_60d8c4e010e9b452e3a6c7cda0d2ab2f.jpeg','2022-10-23 21:19:45',0);
/*!40000 ALTER TABLE `user_gallery_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mas`
--

DROP TABLE IF EXISTS `user_mas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_mas` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `profile_pic` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `country_phone_code` varchar(20) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `country_id` int NOT NULL,
  `gender_id` int NOT NULL DEFAULT '0' COMMENT 'tag_id',
  `vaccination_status` int NOT NULL COMMENT '1-Not Vaccinated, 2-Partial Vaccinated, 3-Fully Vaccinated',
  `dob` date DEFAULT NULL,
  `marital_status` int NOT NULL DEFAULT '0' COMMENT '1-Single, 2-Married',
  `pet_type` int NOT NULL DEFAULT '0' COMMENT '1-Dog, 2-Cat, 3-Others, ',
  `pet_type_text` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `login_otp` varchar(10) NOT NULL,
  `reset_code` varchar(10) NOT NULL COMMENT 'OTP for mobile number change',
  `referral_code` varchar(15) NOT NULL,
  `active_flag` int NOT NULL DEFAULT '1' COMMENT '1-Active,0-Inctive',
  `last_device_type` int NOT NULL DEFAULT '0' COMMENT '1- Android, 2- IOS',
  `last_device_id` varchar(300) NOT NULL,
  `socket_id` varchar(250) NOT NULL,
  `current_lat` double NOT NULL,
  `current_lng` double NOT NULL,
  `added_date` datetime NOT NULL,
  `profile_complete_flag` int NOT NULL DEFAULT '0' COMMENT '0-Incomplete,1-Complete,2-Details Complete,3-Gallery complete',
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '1-Deleted,0-Active',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mas`
--

LOCK TABLES `user_mas` WRITE;
/*!40000 ALTER TABLE `user_mas` DISABLE KEYS */;
INSERT INTO `user_mas` VALUES (1,'Shailesh','profile_b5238bda6a82a482804a6df5e9431c03.jpeg','shailesh@gmail.com','91','9481540027',99,1,0,'1989-02-28',1,0,'','','123456','','We2RtBN1',1,1,'af84d691f305b03b','gWqfWBctRGV5BfrYAADd',25.3985015,81.880971,'2020-02-25 17:44:48',3,0),(2,'text','profile_f14975c51c56650e17d84b7414c421b1.jpeg','amarnathshetty@gmail.com','91','9901679949',99,1,2,'1980-03-27',1,0,'','=AFVxIkVWZ1RhxmVZ5kVkZVTUJkRZ5mT3JGbah3YEJEa','123456','123456','12AE3GT7',1,2,'058B0BBF-C61C-4E71-8487-6E3F41B93185','TYDZGQ19UdpAMGOVAAQc',13.0685196,77.5976755,'2020-02-25 20:05:02',3,0),(3,'Sheeraz','profile_5a6f3cdc2a1856b1e5a15355d976ddbd.jpeg','sheeraz@email.com','91','1111111111',99,2,0,NULL,1,0,'','','123456','','',1,1,'00000000-0000-0000-65cc-dd9b999a81b6','',13.0332557,77.5973921,'2020-02-28 19:28:45',3,0),(4,'G','profile_248c04c85ac3a579e632f9349094373b.jpeg','G@h.com','91','7506946448',99,2,0,NULL,1,0,'','','123456','','',1,1,'7d7f7a93-c2a3-90c6-3590-930530524478','',23.6104685,58.5923809,'2020-02-29 12:24:50',3,0),(5,'Jay','profile_ddc38a62bda4b2603ade1d55502a84ee.jpeg','jaydk142@gmail.com','91','1234567890',99,2,0,NULL,1,0,'','','','','',1,1,'214f007482573a72','',19.2761326,72.8684594,'2020-03-20 17:10:53',3,0),(6,'T','profile_8cb3de0c79203c494ce3b73604f31138.jpeg','T@2.com','91','9582447884',99,1,0,NULL,1,0,'','','','','',1,1,'97b1c40b2a649973','',19.2760764,72.8685646,'2020-03-21 00:20:25',3,0),(7,'A','profile_21cb5adcd5d409c1d64aa9c740308e95.jpeg','S@r.com','91','7506946449',99,1,0,NULL,1,0,'','','','','',1,1,'073cfdfe-1537-66c2-b353-421070526125','',0,0,'2020-03-21 20:55:29',3,0),(8,'sheeraz','profile_a71fff248e0eeaea9f268eb907eb4c90.jpeg','sheeraz@favworks.com','91','8792040168',99,2,0,NULL,1,0,'','','123456','','',1,1,'1a3c086896b8be9a','6KPidLkq1he-e_4GAAAp',25.3985639,81.8810098,'2021-01-11 13:44:03',3,0),(9,'Nanu','profile_b70a7b27aa496e1afe8dba32b4d554f7.jpeg','aliiyaa185@gmail.com','91','7406091563',99,1,0,NULL,1,0,'','','','','',1,1,'','',0,0,'2021-02-06 19:30:45',3,0),(10,'Reshma','','Reshma.i.shaikh@gmail.com','91','9820913006',99,1,0,NULL,2,0,'','','','','',1,1,'','',19.2981912,72.8744968,'2021-02-10 12:10:17',3,0),(11,'Ashfaq','','ashfaqvajawalla@gmail.com','91','7208727450',99,2,0,NULL,2,0,'','','','','',1,1,'74f58896-cf48-1ce5-3539-750715862718','',19.2798204,72.8567555,'2021-02-15 09:26:00',3,0),(12,'Jay','profile_2965133bffe74e094fb151087b08f8b1.jpeg','jaydk14@gmail.com','91','9635552258',99,2,0,NULL,1,1,'','','','','',1,1,'','',23.6104664,58.5923738,'2021-02-23 21:49:06',3,0),(13,'D','profile_6dc4a5aad8a2f05edc79e370e27a060b.jpeg','Dk@gmail.com','91','9157379728',99,2,0,NULL,1,1,'','','','','',1,1,'e4d2504ebd5dd3ed','',23.6105638,58.5923675,'2021-02-23 22:26:16',3,0),(14,'hsue','profile_63b3543db89f6252cd34d0049f80a4a1.jpeg','jwus782@gmail.com','91','6262929235',99,2,0,NULL,1,1,'','','','','',1,1,'cee725cb9216852e','',12.9185183,77.605083,'2021-02-25 20:28:37',3,0),(15,'Amar','','amarnath@favworks.com','91','9901679948',99,2,0,NULL,1,3,'Donkey','','','','',1,1,'1a3c086896b8be9a','LJWb9rKEB0cyNT_VAAAy',13.0685059,77.5976757,'2021-02-25 20:29:19',3,0),(16,'Ramesh','','ramesh@email.com','91','1234561231',99,2,0,NULL,1,0,'','','','','',1,1,'bb0d71998b5f002d','',19.287835,72.860723,'2021-02-26 18:56:08',2,0),(17,'Amar','','amarnathshetty@favworks.com','91','9999999999',99,2,0,NULL,1,0,'','','','','',1,1,'ff31449d3e5c7127','I_LupCfZverrBBoIAAAQ',12.8902101,74.8271356,'2021-04-22 19:57:11',3,0),(18,'test','','test@test.com','91','9591387472',99,1,3,NULL,1,0,'','VdlUHpFRCNnYHpERkZkVVVGVCZVVB1TP','','','aBnDU45z',1,0,'','',0,0,'2022-06-23 14:37:40',2,0),(19,'Ashfaq Usman ','profile_b794e9ed2226f243991fc180dd8dfec3.jpeg','ashfaqvajawalla@yahoo.com','91','9526000817',99,1,3,NULL,2,0,'','=UlVKdFVV50UidkSzM2R0dlUrpVcVZlU0IlMGhmVsR2UX1Ge1ZVb0gnVGFUP','','','yHBQx1oO',1,1,'214f007482573a72','',19.2996636,72.8533472,'2022-07-07 14:21:49',3,0),(20,'Sumaiya','profile_320371729dfc31e077efc444548872db.jpeg','suma9907@gmail.com','91','8976652258',99,2,3,NULL,2,0,'','iZkWyZleCtmVtlUMPRkQXJVMaZVVB1TP','','','jFIH6Ko5',1,1,'2a17082db305209e','',19.2757743,72.8688415,'2022-07-08 09:11:50',3,0),(21,'Rashida darukhanawala','profile_7e0b14387d720c055c61b6bc1e57ddd0.jpeg','Rashida.darukhanawala@gmail.com','91','9892988999',99,2,3,NULL,2,0,'','=UlVKdFVW50TSxGZ2NVb4p1VEZlcUdlRTFWMShnVqpEaZdFaWZleNhnVGFUP','','','1eBxzpuy',1,1,'c811e763fec52de9','',19.232468,72.9852049,'2022-07-08 09:14:09',3,0),(22,'Waqar','','Waqaer1233@gmail.com','91','8652459606',99,1,3,NULL,1,0,'','=UlVKdFVYBnUSxGZ6NFbWp1YrpVRUxWT4ZFMx82UrRmTNd1c4ZFbJhnVGFUP','','','hyUHcDMY',1,1,'a582e65933ad7156','',19.2758936,72.8686535,'2022-07-08 12:30:12',3,0),(23,'','','','91','9870444334',99,0,0,NULL,0,0,'','=AFVxIkVWh2UXZkWWN2RxclUwA3cVtGZ3JGbalXVqpEahZkWyVleGNnYHp0QW1GcXVWRWdVVB1TP','','','b82371bE',1,1,'3fd0979c4d307c09','',19.2903913,72.8784096,'2022-07-08 13:13:10',0,0),(24,'$oh@i!','profile_ca12ff72203cae729a899e39ec9615ac.jpeg','shsohel1429@yahoo.in','91','9833606095',99,1,3,NULL,1,0,'','=UlVKdFVW50TSxmWYN2R0ZlUxAncaZkV0IlMGZnVsR2VZdFaXZFbJhnVGFUP','','','yzwNvbjU',1,1,'97b1c40b2a649973','',19.2760784,72.8685657,'2022-07-08 15:03:57',3,0),(25,'Shakti Makwana','profile_ae9cec002369b8ec924a584f95cdbb0b.jpeg','shaktimakwana66@yahoo.com','91','9870866466',99,1,3,NULL,2,0,'','=UlVKdFVYBnUSxGZ6dVb0ZlUxolVUZVT4ZFMxcHVsR2UkJDeyZVb0gnVGFUP','','','JwcU1xxn',1,1,'2a464537336e3a14','',19.2763471,72.8570458,'2022-07-08 15:44:36',3,0),(26,'Nilofer Farhan Ansari','','nilofer.farhan@hotmail.com','91','9930720207',99,2,3,NULL,2,0,'','=AFVxI1VrpVYW1mTYpVRaxWYEZkVZtGd3JGbslkUsJFa','','','frgpPGB5',1,0,'','',0,0,'2022-07-09 14:09:57',2,0),(27,'Rizwan ','profile_c8e16393f7f0197b03f6de56fd0d3a4d.jpeg','Rizwanur20@gmail.com','91','9867892474',99,1,3,NULL,1,2,'','=UlVKdFVV50USxGZ6NGRCd1UFB3VUZlT3JmVOlnTWZVaOZkSZZleNhnVGFUP','','','UH9TOqok',1,1,'45d5feac42bffeea','',19.0654934,72.8569245,'2022-07-11 06:35:05',3,0),(28,'Jigar','','Jigar.nathwani@gmail.com','91','9930903090',99,1,3,NULL,2,1,'','=UlVadUWsp1USxmWMNGRGd1UGBncaZkV0IlMGhmUrRmTX1GeZZleNhnVGFUP','','','bsZ7PdZB',1,0,'','',0,0,'2022-08-18 20:11:33',2,0),(29,'Prashant','profile_e7646106b64f265ebb67399e812f8ead.jpeg','prashant.gonga@gmail.com','91','8369470507',99,1,3,NULL,1,2,'','=AFVxIkVWZ1RhxmVWN2RxIFVwkVeZhFaSZlRallUtBHahpnRYZFVaNXTVFzMadEdWVGVCZVVB1TP','','','X8OQpI7u',1,1,'221780e53e6314a9','',3.0665346,101.659556,'2022-08-22 13:34:04',3,0),(30,'','','','91','9867886715',99,0,0,NULL,0,1,'','VZlSHlVVsNnYHpEUadEeWVmVWZVVB1TP','','','f6mMVjHT',1,1,'118547bcf336f4c9','',12.9195691,77.6905844,'2022-08-27 21:55:09',0,0),(31,'Sameer Pathan','','pdm.sameer@gmail.com','91','8689989786',99,1,3,NULL,2,0,'','idEayZlRstmUsRGUadEdaZlM4ZVVB1TP','','','cVfPgSBm',1,0,'','',0,0,'2022-08-28 00:38:48',2,0),(32,'abdul mannan','','slaveofalwadood@gmail.com','91','7652080579',99,1,3,NULL,2,0,'','=UlVKNnVWx2aSxGZXJVbwdVZIRGSUdFehJlVwlnUrRmTkJzZ4ZFbJhnVGFUP','','','Iz1cqcBI',1,0,'','',0,0,'2022-08-28 23:46:47',2,0),(33,'Shama Sayeed','profile_2fd20a55fad846c1e6f4703efa23cead.jpeg','Shamashaikh447@gmail.com','91','7705083803',99,2,3,NULL,2,0,'','=UlVKdFVYBnUidkSy50V0dlUspURUZFavJVbOBVTUJ0VNZkWGZlaNhnVGFUP','','','8de7Uhym',1,1,'1eb525c0fbfe1369','',26.8617386,80.9061798,'2022-08-30 18:03:36',3,0),(34,'Xyz','profile_62f1f02b1a7586baa399b296814c005b.jpeg','Abc@yahoo.co.in','91','9967995820',99,1,3,NULL,1,2,'','=AFVxIkVWh2UWFjSWVVb4dVYFVzcVtGZv1UMsdUVqpkV','','','BhwJLmpi',1,1,'4964e587a1d21c25','',19.2842921,72.8634763,'2022-09-01 20:16:13',3,0),(35,'Usama Shaikh','profile_a76aba6deb0998fc7f92c0a555835c57.jpeg','usamask169@gmail.com','91','9324884083',99,1,3,NULL,1,0,'','=AFVxIlVIJ1UiVVNWR2RxM1UGB3cUV1c1IVMapXYEpEa','','','VnDMUznK',1,1,'e8f744e5bb8b7eba','',19.1382981,72.8448264,'2022-09-17 13:05:58',3,0),(36,'Akash Y','','aakash5792@gmail.com','91','9920021073',99,1,3,NULL,1,0,'','U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP','','762661','pukFDazO',1,2,'7ac44698-9638-4827-a28e-ac168714a21b','',19.2690322,72.8867974,'2022-10-06 21:49:22',2,0);
/*!40000 ALTER TABLE `user_mas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_reports`
--

DROP TABLE IF EXISTS `user_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_reports` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reported_user_id` int NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_reports`
--

LOCK TABLES `user_reports` WRITE;
/*!40000 ALTER TABLE `user_reports` DISABLE KEYS */;
INSERT INTO `user_reports` VALUES (1,2,3,'2022-06-24 13:38:27',0);
/*!40000 ALTER TABLE `user_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_subscription`
--

DROP TABLE IF EXISTS `user_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_subscription` (
  `subscription_id` int NOT NULL AUTO_INCREMENT,
  `subscription_plan_id` int NOT NULL,
  `user_id` int NOT NULL,
  `plan_type` int NOT NULL COMMENT '1-General, 2-Package',
  `plan_price` float NOT NULL,
  `discount_price` float NOT NULL,
  `num_of_lets` int NOT NULL,
  `validity_days` int NOT NULL,
  `payable_amt` float NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `transaction_device` int NOT NULL DEFAULT '0',
  `transaction_id` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active, 1-Deleted',
  PRIMARY KEY (`subscription_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_subscription`
--

LOCK TABLES `user_subscription` WRITE;
/*!40000 ALTER TABLE `user_subscription` DISABLE KEYS */;
INSERT INTO `user_subscription` VALUES (4,2,1,1,3500,799,10,30,799,NULL,0,'','2021-02-03 20:20:56',0),(5,1,2,1,250,99,1,1,99,NULL,0,'','2021-02-04 17:23:07',1),(6,1,2,1,250,99,1,1,99,'2021-02-24',0,'','2021-02-23 13:11:51',1),(7,4,12,2,0,0,0,90,0,'2021-05-24',0,'','2021-02-23 21:49:06',0),(8,4,13,2,0,0,0,90,0,'2021-05-24',0,'','2021-02-23 22:26:16',0),(9,4,14,2,0,0,0,90,0,'2021-05-26',0,'','2021-02-25 20:28:37',0),(10,4,15,2,0,0,0,90,0,'2021-05-26',0,'','2021-02-25 20:29:19',0),(11,4,16,2,0,0,0,90,0,'2021-05-27',0,'','2021-02-26 18:56:08',0),(12,1,2,1,250,99,1,1,99,'2021-02-27',0,'','2021-02-26 19:08:42',1),(13,2,2,1,3500,799,10,30,799,'2021-04-24',0,'','2021-03-25 21:04:05',1),(14,4,17,2,0,0,0,90,0,'2021-07-21',0,'','2021-04-22 19:57:11',0),(15,1,2,1,250,99,1,1,99,'2021-06-24',0,'','2021-06-23 17:44:32',1),(16,1,2,1,250,99,1,1,99,'2021-06-24',0,'','2021-06-23 18:02:16',1),(17,1,1,1,250,99,1,1,99,'2021-06-24',0,'','2021-06-23 18:30:23',0),(18,1,1,1,250,99,1,1,99,'2021-06-24',0,'','2021-06-23 18:34:22',0),(19,1,2,1,250,99,1,1,99,'2021-06-25',0,'','2021-06-24 12:21:53',1),(20,1,2,1,250,179,1,30,179,'2022-07-02',0,'','2022-06-01 19:28:35',1),(21,1,2,1,250,179,1,1,179,'2022-06-02',0,'','2022-06-01 19:28:35',1),(22,1,2,1,250,179,1,1,179,'2022-06-02',0,'','2022-06-01 19:28:35',1),(23,1,2,1,250,179,1,1,179,'2022-06-02',0,'','2022-06-01 19:28:35',1),(24,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 01:31:27',1),(25,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:04:44',1),(26,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:04:45',1),(27,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:04:45',1),(28,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:04:45',1),(29,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:04:45',1),(30,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:08:03',1),(31,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:08:03',1),(32,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:08:03',1),(33,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:08:03',1),(34,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:08:03',1),(35,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:08:03',1),(36,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:12:00',1),(37,1,2,1,250,179,1,1,179,'2022-06-05',0,'','2022-06-04 03:12:26',1),(38,1,2,1,250,179,1,1,179,'2022-06-05',0,'','2022-06-04 03:15:06',1),(39,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:22:04',1),(40,2,2,1,3500,799,10,30,799,'2022-07-04',0,'','2022-06-04 03:33:01',1),(41,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:33:17',1),(42,1,2,1,250,179,1,1,179,'2022-06-05',0,'','2022-06-04 03:33:37',1),(43,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:34:23',1),(44,1,2,1,250,179,1,1,179,'2022-06-05',0,'','2022-06-04 03:49:01',1),(45,3,2,1,5000,1399,30,30,1399,'2022-07-04',0,'','2022-06-04 03:49:18',1),(46,4,18,2,0,0,0,90,0,'2022-09-21',0,'','2022-06-23 14:37:40',0),(47,3,2,1,5000,1399,30,30,1399,'2022-07-23',0,'','2022-06-23 20:44:39',1),(48,2,2,1,3500,799,10,30,799,'2022-08-24',2,'0','2022-06-24 12:56:13',1),(49,4,19,2,0,0,0,90,0,'2022-10-05',0,'','2022-07-07 14:21:49',0),(50,4,20,2,0,0,0,90,0,'2022-10-06',0,'','2022-07-08 09:11:50',0),(51,4,21,2,0,0,0,90,0,'2022-10-06',0,'','2022-07-08 09:14:09',0),(52,4,22,2,0,0,0,90,0,'2022-10-06',0,'','2022-07-08 12:30:12',0),(53,4,23,2,0,0,0,90,0,'2022-10-06',0,'','2022-07-08 13:13:10',0),(54,4,24,2,0,0,0,90,0,'2022-10-06',0,'','2022-07-08 15:03:57',0),(55,4,25,2,0,0,0,90,0,'2022-10-06',0,'','2022-07-08 15:44:36',0),(56,4,26,2,0,0,0,90,0,'2022-10-07',0,'','2022-07-09 14:09:57',0),(57,4,27,2,0,0,0,90,0,'2022-10-09',0,'','2022-07-11 06:35:05',0),(58,4,28,2,0,0,0,90,0,'2022-11-16',0,'','2022-08-18 20:11:33',0),(59,4,29,2,0,0,0,90,0,'2022-11-20',0,'','2022-08-22 13:34:04',0),(60,4,30,2,0,0,0,90,0,'2022-11-25',0,'','2022-08-27 21:55:09',0),(61,4,31,2,0,0,0,90,0,'2022-11-26',0,'','2022-08-28 00:38:48',0),(62,4,32,2,0,0,0,90,0,'2022-11-26',0,'','2022-08-28 23:46:47',0),(63,4,33,2,0,0,0,90,0,'2022-11-28',0,'','2022-08-30 18:03:36',0),(64,4,34,2,0,0,0,90,0,'2022-11-30',0,'','2022-09-01 20:16:13',0),(65,4,35,2,0,0,0,90,0,'2022-12-16',0,'','2022-09-17 13:05:58',0),(66,4,36,2,0,0,0,90,0,'2023-01-04',0,'','2022-10-06 21:49:22',0);
/*!40000 ALTER TABLE `user_subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tag`
--

DROP TABLE IF EXISTS `user_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_tag` (
  `user_tag_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `tag_id` int NOT NULL DEFAULT '0',
  `added_date` datetime NOT NULL,
  `del_flag` int NOT NULL DEFAULT '0' COMMENT '0-Active,1-Deleted',
  PRIMARY KEY (`user_tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tag`
--

LOCK TABLES `user_tag` WRITE;
/*!40000 ALTER TABLE `user_tag` DISABLE KEYS */;
INSERT INTO `user_tag` VALUES (1,4,1,'2020-03-21 00:22:05',0),(2,4,2,'2020-03-21 00:22:05',0),(3,4,3,'2020-03-21 00:22:05',0),(4,4,5,'2020-03-21 00:22:05',0),(5,19,1,'2021-02-25 17:50:12',0),(6,19,2,'2021-02-25 17:50:12',0),(7,1,1,'2021-02-26 19:04:56',0),(8,1,2,'2021-02-26 19:04:56',0),(12,13,2,'2022-06-23 20:26:45',0),(13,19,4,'2022-07-07 14:27:07',0),(14,2,2,'2022-07-08 13:59:44',0),(15,2,5,'2022-07-08 13:59:44',0),(16,2,1,'2022-07-08 15:11:34',0),(17,24,4,'2022-07-08 15:15:32',0),(18,24,2,'2022-07-08 15:15:32',0),(19,24,1,'2022-07-08 15:15:32',0),(20,27,2,'2022-07-11 20:50:24',0),(21,33,2,'2022-09-01 12:18:29',0),(22,34,2,'2022-09-03 13:29:10',0),(23,34,1,'2022-09-15 11:59:25',0);
/*!40000 ALTER TABLE `user_tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-07  7:13:31
