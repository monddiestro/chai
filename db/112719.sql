-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: chai
-- ------------------------------------------------------
-- Server version	10.4.8-MariaDB

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
-- Table structure for table `accounts_tbl`
--

DROP TABLE IF EXISTS `accounts_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_tbl` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `uac` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_tbl`
--

LOCK TABLES `accounts_tbl` WRITE;
/*!40000 ALTER TABLE `accounts_tbl` DISABLE KEYS */;
INSERT INTO `accounts_tbl` VALUES (1,'mond@gmail.com','692db33e4a3ff050ce164b9eeb4e46e4','Mond','Diestro','2019-09-17 14:27:28','administrator','img/z1.jpg','09178045253','mond@gmail.com');
/*!40000 ALTER TABLE `accounts_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_tbl`
--

DROP TABLE IF EXISTS `activity_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_tbl` (
  `act_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `act_desc` varchar(300) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_tbl`
--

LOCK TABLES `activity_tbl` WRITE;
/*!40000 ALTER TABLE `activity_tbl` DISABLE KEYS */;
INSERT INTO `activity_tbl` VALUES (1,1,'sign in to website','2019-11-13 08:38:51'),(2,1,'sign out to website','2019-11-13 09:03:24'),(3,1,'sign in to website','2019-11-15 04:29:42'),(4,1,'sign in to website','2019-11-15 08:29:23'),(5,1,'sign in to website','2019-11-19 08:03:11'),(6,1,'sign in to website','2019-11-20 10:09:10'),(7,1,'sign in to website','2019-11-21 03:10:29'),(8,1,'sign in to website','2019-11-21 03:24:21'),(9,2,'sign out to website','2019-11-21 03:30:27'),(10,1,'sign in to website','2019-11-21 03:30:34'),(11,1,'sign in to website','2019-11-21 08:19:14'),(12,1,'sign out to website','2019-11-21 08:49:17'),(13,1,'sign in to website','2019-11-21 08:49:24'),(14,1,'sign out to website','2019-11-21 09:00:09'),(15,1,'sign in to website','2019-11-21 09:27:47'),(16,1,'sign out to website','2019-11-21 09:28:17'),(17,1,'sign out to website','2019-11-21 09:28:17'),(18,1,'sign in to website','2019-11-21 09:28:22'),(19,1,'sign in to website','2019-11-22 02:52:47'),(20,1,'Change status of request id:2 to done','2019-11-22 04:15:47'),(21,1,'sign in to website','2019-11-22 09:42:34'),(22,1,'sign in to website','2019-11-25 05:03:10'),(23,1,'sign in to website','2019-11-25 07:07:03'),(24,1,'sign in to website','2019-11-25 09:52:15'),(25,1,'sign in to website','2019-11-26 02:43:30'),(26,1,'sign in to website','2019-11-26 06:22:10'),(27,1,'New request created for unit 2302','2019-11-26 08:46:40'),(28,1,'New request created for unit 2303','2019-11-26 09:13:13'),(29,1,'New request created for unit 2302','2019-11-26 10:45:52'),(30,1,'sign in to website','2019-11-27 07:47:22'),(31,1,'Change status of request id:5 to in-progress','2019-11-27 07:51:13');
/*!40000 ALTER TABLE `activity_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars_tbl`
--

DROP TABLE IF EXISTS `cars_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars_tbl` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `plate_number` varchar(100) NOT NULL,
  `member_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars_tbl`
--

LOCK TABLES `cars_tbl` WRITE;
/*!40000 ALTER TABLE `cars_tbl` DISABLE KEYS */;
INSERT INTO `cars_tbl` VALUES (1,'Hyundai','Elantra','Black','MR 8061',2,2,'img/DSC_0068.JPG','2019-09-13 04:57:16');
/*!40000 ALTER TABLE `cars_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpers_tbl`
--

DROP TABLE IF EXISTS `helpers_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpers_tbl` (
  `helper_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_name` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`helper_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpers_tbl`
--

LOCK TABLES `helpers_tbl` WRITE;
/*!40000 ALTER TABLE `helpers_tbl` DISABLE KEYS */;
INSERT INTO `helpers_tbl` VALUES (1,'Soriano','Reymond','reymonddiestro@gmail.com','4th Floor Mancor Corporate Center 32nd St. Bonifacio Global City','0917804525','09178045253','not available','img/DSC_0172.jpg','2019-09-28 05:34:44'),(2,'Soriano','Zia','ziasoriano@gmail.com','4th Floor Mancor Corporate Center 32nd St. Bonifacio Global City','0917804525','09178045253','not available','img/z.jpg','2019-09-28 08:46:36');
/*!40000 ALTER TABLE `helpers_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpers_work_tbl`
--

DROP TABLE IF EXISTS `helpers_work_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpers_work_tbl` (
  `helper_work_id` int(10) NOT NULL AUTO_INCREMENT,
  `work_id` int(10) NOT NULL,
  `helper_id` int(10) NOT NULL,
  PRIMARY KEY (`helper_work_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpers_work_tbl`
--

LOCK TABLES `helpers_work_tbl` WRITE;
/*!40000 ALTER TABLE `helpers_work_tbl` DISABLE KEYS */;
INSERT INTO `helpers_work_tbl` VALUES (1,2,2),(2,3,2),(4,2,1);
/*!40000 ALTER TABLE `helpers_work_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_tbl`
--

DROP TABLE IF EXISTS `members_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_tbl` (
  `member_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_name` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `type` int(10) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_tbl`
--

LOCK TABLES `members_tbl` WRITE;
/*!40000 ALTER TABLE `members_tbl` DISABLE KEYS */;
INSERT INTO `members_tbl` VALUES (2,'Soriano','Darnel','darnelsoriano@gmail.com','01234567','091234567890','img/14368790_1220511234635928_5303831724447372926_n.jpg','2019-08-29 20:50:03',2,1),(3,'Valencia','Ashee','asheevalencia@gmail.com','091234567890','091234567890','img/ashee.png','2019-08-29 21:14:02',2,2);
/*!40000 ALTER TABLE `members_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_type_tbl`
--

DROP TABLE IF EXISTS `pet_type_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_type_tbl` (
  `type_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_type_tbl`
--

LOCK TABLES `pet_type_tbl` WRITE;
/*!40000 ALTER TABLE `pet_type_tbl` DISABLE KEYS */;
INSERT INTO `pet_type_tbl` VALUES (2,'Dog'),(3,'Cat'),(4,'Snake'),(5,'Fish');
/*!40000 ALTER TABLE `pet_type_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets_tbl`
--

DROP TABLE IF EXISTS `pets_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pets_tbl` (
  `pet_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_id` int(10) DEFAULT NULL,
  `breed` varchar(100) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`pet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets_tbl`
--

LOCK TABLES `pets_tbl` WRITE;
/*!40000 ALTER TABLE `pets_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `pets_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_log_tbl`
--

DROP TABLE IF EXISTS `request_log_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_log_tbl` (
  `log_id` int(10) NOT NULL,
  `request_id` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_log_tbl`
--

LOCK TABLES `request_log_tbl` WRITE;
/*!40000 ALTER TABLE `request_log_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_log_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_tbl`
--

DROP TABLE IF EXISTS `request_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_tbl` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_id` int(10) NOT NULL,
  `work_id` int(10) NOT NULL,
  `request_desc` varchar(200) NOT NULL,
  `helper_id` int(10) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_request` date NOT NULL,
  `date_done` date DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_tbl`
--

LOCK TABLES `request_tbl` WRITE;
/*!40000 ALTER TABLE `request_tbl` DISABLE KEYS */;
INSERT INTO `request_tbl` VALUES (1,1,2,'Pakilinis agad',1,'done',1,'2019-10-28 04:10:09','2019-11-02','2019-11-03'),(2,2,3,'asdasdsa',2,'done',1,'2019-11-06 06:11:58','2019-11-07',NULL),(3,1,2,'test',1,'in-progress',1,'2019-11-26 08:11:40','2019-11-30',NULL),(4,2,3,'sadsa',0,'pending',1,'2019-11-26 09:11:12','2019-11-30',NULL),(5,1,2,'asdasd',2,'in-progress',1,'2019-11-26 10:11:52','2019-11-23',NULL);
/*!40000 ALTER TABLE `request_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units_tbl`
--

DROP TABLE IF EXISTS `units_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units_tbl` (
  `unit_id` int(10) NOT NULL AUTO_INCREMENT,
  `number` varchar(100) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units_tbl`
--

LOCK TABLES `units_tbl` WRITE;
/*!40000 ALTER TABLE `units_tbl` DISABLE KEYS */;
INSERT INTO `units_tbl` VALUES (1,'2302','House','9 Iris St. West Fairview Quezon City 118','2019-08-15 23:18:32'),(2,'2303','House','9 Iris St. West Fairview Quezon City 118',NULL);
/*!40000 ALTER TABLE `units_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_tbl`
--

DROP TABLE IF EXISTS `work_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_tbl` (
  `work_id` int(10) NOT NULL AUTO_INCREMENT,
  `work_title` varchar(300) NOT NULL,
  `work_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_tbl`
--

LOCK TABLES `work_tbl` WRITE;
/*!40000 ALTER TABLE `work_tbl` DISABLE KEYS */;
INSERT INTO `work_tbl` VALUES (2,'Gardener','Cut grasses in garden'),(3,'Cabin Cleaner','Taga linis ng cabinet');
/*!40000 ALTER TABLE `work_tbl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-27 16:10:52
