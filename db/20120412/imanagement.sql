-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: imanagement
-- ------------------------------------------------------
-- Server version	5.5.16-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `branchId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Group|',
  `myCompanyId` int(11) NOT NULL,
  `branchSequence` int(11) NOT NULL,
  `branchCode` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branchDesc` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'English|',
  `isDefault` tinyint(1) NOT NULL COMMENT 'Default|',
  `isNew` tinyint(1) NOT NULL COMMENT 'New|',
  `isDraft` tinyint(1) NOT NULL COMMENT 'Draft|',
  `isUpdate` tinyint(1) NOT NULL COMMENT 'Updated|',
  `isDelete` tinyint(1) NOT NULL COMMENT 'Delete|',
  `isActive` tinyint(1) NOT NULL COMMENT 'Active|',
  `isApproved` tinyint(1) NOT NULL COMMENT 'Approved|',
  `isReview` tinyint(1) NOT NULL,
  `isPost` tinyint(1) NOT NULL,
  `executeBy` int(11) NOT NULL COMMENT 'By|',
  `executeTime` datetime NOT NULL,
  PRIMARY KEY (`branchId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `myCompanyId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Group|',
  `myCompanySequence` int(11) NOT NULL,
  `myCompanyCode` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `myCompanyDesc` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'English|',
  `isDefault` tinyint(1) NOT NULL COMMENT 'Default|',
  `isNew` tinyint(1) NOT NULL COMMENT 'New|',
  `isDraft` tinyint(1) NOT NULL COMMENT 'Draft|',
  `isUpdate` tinyint(1) NOT NULL COMMENT 'Updated|',
  `isDelete` tinyint(1) NOT NULL COMMENT 'Delete|',
  `isActive` tinyint(1) NOT NULL COMMENT 'Active|',
  `isApproved` tinyint(1) NOT NULL COMMENT 'Approved|',
  `isReview` tinyint(1) NOT NULL,
  `isPost` tinyint(1) NOT NULL,
  `executeBy` int(11) NOT NULL COMMENT 'By|',
  `executeTime` datetime NOT NULL,
  PRIMARY KEY (`myCompanyId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,1,'MIS','Management Information System',0,1,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(2,2,'QIS','Quality Insurance',0,1,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(3,3,'CRM','Marketing',0,1,0,0,0,1,0,0,0,2,'2011-08-25 12:25:49'),(4,4,'MGT','Management',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(5,5,'HRM','Human Resources',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(6,6,'FIN','Finance',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(7,7,'MEC','Mechanical',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(8,8,'ECL','Electrical',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(9,9,'LDS','Landscape',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(10,10,'MSC','Music',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(11,11,'HPL','Hospitality',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(12,12,'PRT','Production',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `departmentId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Group|',
  `myCompanyId` int(11) NOT NULL,
  `branchId` int(11) NOT NULL,
  `departmentSequence` int(11) NOT NULL,
  `departmentCode` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `departmentDesc` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'English|',
  `isDefault` tinyint(1) NOT NULL COMMENT 'Default|',
  `isNew` tinyint(1) NOT NULL COMMENT 'New|',
  `isDraft` tinyint(1) NOT NULL COMMENT 'Draft|',
  `isUpdate` tinyint(1) NOT NULL COMMENT 'Updated|',
  `isDelete` tinyint(1) NOT NULL COMMENT 'Delete|',
  `isActive` tinyint(1) NOT NULL COMMENT 'Active|',
  `isApproved` tinyint(1) NOT NULL COMMENT 'Approved|',
  `isReview` tinyint(1) NOT NULL,
  `isPost` tinyint(1) NOT NULL,
  `executeBy` int(11) NOT NULL COMMENT 'By|',
  `executeTime` datetime NOT NULL,
  PRIMARY KEY (`departmentId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,0,0,1,'MIS','Management Information System',0,1,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(2,0,0,2,'QIS','Quality Insurance',0,1,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(3,0,0,3,'CRM','Marketing',0,1,0,0,0,1,0,0,0,2,'2011-08-25 12:25:49'),(4,0,0,4,'MGT','Management',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(5,0,0,5,'HRM','Human Resources',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(6,0,0,6,'FIN','Finance',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(7,0,0,7,'MEC','Mechanical',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(8,0,0,8,'ECL','Electrical',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(9,0,0,9,'LDS','Landscape',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(10,0,0,10,'MSC','Music',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(11,0,0,11,'HPL','Hospitality',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(12,0,0,12,'PRT','Production',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `locationId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Group|',
  `myCompanyId` int(11) NOT NULL,
  `branchId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL,
  `locationSequence` int(11) NOT NULL,
  `locationCode` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `locationDesc` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'English|',
  `isDefault` tinyint(1) NOT NULL COMMENT 'Default|',
  `isNew` tinyint(1) NOT NULL COMMENT 'New|',
  `isDraft` tinyint(1) NOT NULL COMMENT 'Draft|',
  `isUpdate` tinyint(1) NOT NULL COMMENT 'Updated|',
  `isDelete` tinyint(1) NOT NULL COMMENT 'Delete|',
  `isActive` tinyint(1) NOT NULL COMMENT 'Active|',
  `isApproved` tinyint(1) NOT NULL COMMENT 'Approved|',
  `isReview` tinyint(1) NOT NULL,
  `isPost` tinyint(1) NOT NULL,
  `executeBy` int(11) NOT NULL COMMENT 'By|',
  `executeTime` datetime NOT NULL,
  PRIMARY KEY (`locationId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,0,0,0,1,'MIS','Management Information System',0,1,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(2,0,0,0,2,'QIS','Quality Insurance',0,1,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(3,0,0,0,3,'CRM','Marketing',0,1,0,0,0,1,0,0,0,2,'2011-08-25 12:25:49'),(4,0,0,0,4,'MGT','Management',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(5,0,0,0,5,'HRM','Human Resources',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(6,0,0,0,6,'FIN','Finance',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(7,0,0,0,7,'MEC','Mechanical',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(8,0,0,0,8,'ECL','Electrical',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(9,0,0,0,9,'LDS','Landscape',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(10,0,0,0,10,'MSC','Music',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(11,0,0,0,11,'HPL','Hospitality',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25'),(12,0,0,0,12,'PRT','Production',0,1,0,1,0,1,0,0,0,2,'2011-08-25 12:31:25');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staffId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Staff|',
  `teamId` int(11) NOT NULL COMMENT 'crew|',
  `departmentId` int(11) NOT NULL,
  `languageId` int(11) NOT NULL COMMENT 'Language|',
  `staffPassword` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password|',
  `staffName` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name|',
  `staffNo` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Number|',
  `staffIc` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Identification|',
  `isDefault` int(1) NOT NULL,
  `isNew` tinyint(1) NOT NULL COMMENT 'New|',
  `isDraft` tinyint(1) NOT NULL COMMENT 'Draft|',
  `isUpdate` tinyint(1) NOT NULL COMMENT 'Updated|',
  `isDelete` tinyint(1) NOT NULL COMMENT 'Delete|',
  `isActive` tinyint(1) NOT NULL COMMENT 'Active|',
  `isApproved` tinyint(1) NOT NULL COMMENT 'Approved|',
  `isReview` tinyint(1) NOT NULL,
  `isPost` tinyint(1) NOT NULL,
  `executeBy` int(11) NOT NULL COMMENT 'By|',
  `executeTime` datetime NOT NULL,
  PRIMARY KEY (`staffId`),
  KEY `isPost` (`isPost`),
  KEY `isReview` (`isReview`),
  KEY `isApproved` (`isApproved`),
  KEY `isActive` (`isActive`),
  KEY `isDelete` (`isDelete`),
  KEY `isUpdate` (`isUpdate`),
  KEY `isNew` (`isNew`),
  KEY `isDraft` (`isDraft`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Clerk,System Admin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (2,1,1,21,'690b2646e03f5411e297d208b79d4807','root','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00'),(3,1,1,21,'690b2646e03f5411e297d208b79d4807','admin','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00'),(4,2,1,21,'690b2646e03f5411e297d208b79d4807','supervisor','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00'),(5,3,1,21,'690b2646e03f5411e297d208b79d4807','staff','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00'),(6,4,1,21,'690b2646e03f5411e297d208b79d4807','member','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00'),(7,5,1,21,'690b2646e03f5411e297d208b79d4807','demo','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00'),(8,6,1,21,'690b2646e03f5411e297d208b79d4807','manager','','',0,0,0,1,0,1,2,0,0,2,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `teamId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Group|',
  `teamSequence` int(11) NOT NULL,
  `teamCode` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teamDesc` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'English|',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isDefault` tinyint(1) NOT NULL COMMENT 'Default|',
  `isNew` tinyint(1) NOT NULL COMMENT 'New|',
  `isDraft` tinyint(1) NOT NULL COMMENT 'Draft|',
  `isUpdate` tinyint(1) NOT NULL COMMENT 'Updated|',
  `isDelete` tinyint(1) NOT NULL COMMENT 'Delete|',
  `isActive` tinyint(1) NOT NULL COMMENT 'Active|',
  `isApproved` tinyint(1) NOT NULL COMMENT 'Approved|',
  `isReview` tinyint(4) NOT NULL,
  `isPost` tinyint(4) NOT NULL,
  `executeBy` int(11) NOT NULL COMMENT 'By|',
  `executeTime` datetime NOT NULL,
  PRIMARY KEY (`teamId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci COMMENT='synomim to group';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,1,'ad','Administrator',1,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(2,2,'sp','Supervisor',0,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(3,3,'sf','Staff',0,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(4,4,'mbr','Member',0,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(5,5,'demo','Demo',0,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(6,6,'mgr','Manager',0,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00'),(7,7,'prt','Portal User',0,0,0,0,0,0,1,0,0,0,2,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-04-22 16:21:40
