/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.5.37-log : Database - forum_st
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`forum_st` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `forum_st`;

/*Table structure for table `st_messages` */

DROP TABLE IF EXISTS `st_messages`;

CREATE TABLE `st_messages` (
  `messageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `topicId` int(10) unsigned NOT NULL,
  `themeId` int(10) unsigned NOT NULL,
  `messageDate` datetime NOT NULL,
  `messageAuthor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`messageId`),
  KEY `st_message_user` (`messageAuthor`),
  KEY `st_message_theme` (`themeId`),
  KEY `st_message_topic` (`topicId`),
  CONSTRAINT `st_message_theme` FOREIGN KEY (`themeId`) REFERENCES `st_themes` (`themeId`),
  CONSTRAINT `st_message_topic` FOREIGN KEY (`topicId`) REFERENCES `st_topic` (`topicId`),
  CONSTRAINT `st_message_user` FOREIGN KEY (`messageAuthor`) REFERENCES `st_users` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_messages` */

/*Table structure for table `st_themes` */

DROP TABLE IF EXISTS `st_themes`;

CREATE TABLE `st_themes` (
  `themeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themeAuthor` int(10) unsigned NOT NULL,
  `themeTitle` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `themeDate` datetime NOT NULL,
  PRIMARY KEY (`themeId`),
  KEY `st_theme_user` (`themeAuthor`),
  CONSTRAINT `st_theme_user` FOREIGN KEY (`themeAuthor`) REFERENCES `st_users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `st_themes` */

insert  into `st_themes`(`themeId`,`themeAuthor`,`themeTitle`,`tag`,`themeDate`) values (1,2,'Theme 1','T1','2014-07-22 00:46:23'),(2,5,'Theme 2','T1','2014-07-22 00:46:23'),(3,3,'Theme 3','T3','2014-07-22 00:46:23'),(4,4,'Theme 4','T3','2014-07-22 00:46:23'),(5,4,'Theme 5','T2','2014-07-22 00:46:23'),(6,4,'Theme 6','T4','2014-07-22 00:46:23'),(7,7,'Theme 7','T4','2014-07-22 00:46:23'),(8,7,'Theme 8','T4','2014-07-22 00:46:23'),(9,3,'Theme 9','T5','2014-07-22 00:46:23'),(10,7,'Theme 10','T6','2014-07-22 00:46:23'),(11,2,'Theme 11','T7','2014-07-22 00:46:23'),(12,4,'Theme 12','T8','2014-07-22 00:46:23'),(13,4,'Theme 13','T10','2014-07-22 00:46:23'),(14,3,'Theme 14','T11','2014-07-22 00:46:23'),(15,2,'Theme 15','T12','2014-07-22 00:46:23');

/*Table structure for table `st_topic` */

DROP TABLE IF EXISTS `st_topic`;

CREATE TABLE `st_topic` (
  `topicId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themeId` int(10) unsigned NOT NULL,
  `topicAuthor` int(10) unsigned NOT NULL,
  `topicStatus` enum('open','close') NOT NULL,
  `topicName` varchar(100) NOT NULL,
  `topicDate` datetime NOT NULL,
  PRIMARY KEY (`topicId`),
  KEY `st_topic_user` (`topicAuthor`),
  KEY `st_topic_theme` (`themeId`),
  CONSTRAINT `st_topic_theme` FOREIGN KEY (`themeId`) REFERENCES `st_themes` (`themeId`),
  CONSTRAINT `st_topic_user` FOREIGN KEY (`topicAuthor`) REFERENCES `st_users` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_topic` */

/*Table structure for table `st_users` */

DROP TABLE IF EXISTS `st_users`;

CREATE TABLE `st_users` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'user',
  `userDateReg` datetime NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `st_users` */

insert  into `st_users`(`userId`,`login`,`email`,`password`,`status`,`userDateReg`) values (1,'User1','user1@user.us','123','user','2014-07-07 13:15:00'),(2,'User2','user2@user.us','123','user','2014-07-07 13:15:00'),(3,'User3','user3@user.us','123','user','2014-07-07 13:15:00'),(4,'User4','user4@user.us','456','user','2014-07-07 13:15:00'),(5,'User5','user5@user.us','456','user','2014-07-07 13:15:00'),(6,'Admin1','admin1@user.us','admin','admin','2014-07-07 13:15:00'),(7,'Admin2','admin2@user.us','admin','admin','2014-07-07 13:15:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
