/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.5.37-log : Database - vm_forum
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`vm_forum` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `vm_forum`;

/*Table structure for table `f_categories` */

DROP TABLE IF EXISTS `f_categories`;

CREATE TABLE `f_categories` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `messNum` int(8) unsigned DEFAULT NULL,
  `user_id` int(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `f_categories` */

insert  into `f_categories`(`id`,`title`,`messNum`,`user_id`) values (1,'Новая тема',9,3),(9,'2323',4,5),(11,'232324',3,7),(12,'вапвапвп',1,13);

/*Table structure for table `f_messages` */

DROP TABLE IF EXISTS `f_messages`;

CREATE TABLE `f_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postId` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `post_Message` FOREIGN KEY (`id`) REFERENCES `f_posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `f_messages` */

/*Table structure for table `f_posts` */

DROP TABLE IF EXISTS `f_posts`;

CREATE TABLE `f_posts` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(8) unsigned DEFAULT NULL,
  `user_id` int(8) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `dateAdd` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_posts_2_users` (`user_id`),
  KEY `FK_posts_2_categories` (`category_id`),
  CONSTRAINT `FK_posts_2_categories` FOREIGN KEY (`category_id`) REFERENCES `f_categories` (`id`),
  CONSTRAINT `FK_posts_2_users` FOREIGN KEY (`user_id`) REFERENCES `f_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

/*Data for the table `f_posts` */

insert  into `f_posts`(`id`,`category_id`,`user_id`,`title`,`text`,`dateAdd`) values (1,1,5,'Новая тема','Новая тема','2014-07-16 15:14:30'),(2,1,6,'Новая етма2 ','123123123','2014-07-16 15:15:41'),(3,1,7,'Админсккий пост','Добро пожаловать','2014-07-16 15:24:31'),(52,1,13,'йцукен','фывфывфывфывчсячсячсыываываваывафывфыафы','2014-07-19 00:14:15'),(53,12,13,'вапвап','смттмитмитарпапркыпрпивпаврич','2014-07-19 00:14:41');

/*Table structure for table `f_statuses` */

DROP TABLE IF EXISTS `f_statuses`;

CREATE TABLE `f_statuses` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `f_statuses` */

insert  into `f_statuses`(`id`,`name`) values (1,'admin'),(2,'user'),(3,'banned');

/*Table structure for table `f_tag` */

DROP TABLE IF EXISTS `f_tag`;

CREATE TABLE `f_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `f_tag` */

insert  into `f_tag`(`id`,`tagName`) values (1,'tag1'),(2,'tag2'),(3,'tag3'),(4,'tag4'),(5,'tag5'),(6,'tag6'),(7,'tag7'),(8,'tag8'),(9,'tag9'),(10,'tag10');

/*Table structure for table `f_tag_to_post` */

DROP TABLE IF EXISTS `f_tag_to_post`;

CREATE TABLE `f_tag_to_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `f_tag_to_post_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `f_posts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `f_tag_to_post_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `f_tag` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `f_tag_to_post` */

insert  into `f_tag_to_post`(`id`,`post_id`,`tag_id`) values (1,1,6),(2,1,5),(3,1,1),(4,2,2),(5,2,4),(6,3,3),(7,52,10),(8,53,9),(9,53,8),(10,53,10);

/*Table structure for table `f_users` */

DROP TABLE IF EXISTS `f_users`;

CREATE TABLE `f_users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `status_id` int(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_user` (`login`,`email`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `FK_users_2_statuses` FOREIGN KEY (`status_id`) REFERENCES `f_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `f_users` */

insert  into `f_users`(`id`,`login`,`dateAdd`,`email`,`password`,`about`,`status_id`) values (5,'jaro1999','2014-07-16 15:00:58','vmentuz89@gmail.com1','c8837b23ff8aaa8a2dde915473ce0991','asdjhflakjshf',2),(6,'jaro1989','2014-07-16 15:09:22','vmentuz89@gmail.com','c8837b23ff8aaa8a2dde915473ce0991','asjkdhfjakls',2),(7,'admin','2014-07-16 15:15:54','vmentuz89@gmail.com2','c8837b23ff8aaa8a2dde915473ce0991','admin',1),(13,'User1','2014-07-19 00:13:35','example@mail.com','41890cd2ac71e06b5f2c9ad5ccc07b45','йцукен',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
