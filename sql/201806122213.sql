/*
SQLyog Ultimate - MySQL GUI v8.2 
MySQL - 5.5.5-10.1.19-MariaDB : Database - handwrite
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`handwrite` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `handwrite`;

/*Table structure for table `role_info` */

DROP TABLE IF EXISTS `role_info`;

CREATE TABLE `role_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(45) DEFAULT NULL,
  `rolePortraitPath` text,
  `roleLiHuiPath` text,
  `roleType` varchar(45) DEFAULT NULL,
  `roleIntro` text,
  `roleSkillDesc` text,
  `unlockValue` int(10) DEFAULT NULL,
  `roleHp` int(10) DEFAULT NULL,
  `roleSkillValue` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `role_info` */

insert  into `role_info`(`id`,`roleName`,`rolePortraitPath`,`roleLiHuiPath`,`roleType`,`roleIntro`,`roleSkillDesc`,`unlockValue`,`roleHp`,`roleSkillValue`) values (1,'钢笔','res/images/rolePortrait/role_20180526221836.jpg','res\\images\\roleLiHui\\role_20180526221836.jpg','attack','攻击型','攻击',50,100,20),(2,'数位板','res/images/rolePortrait/role_20180526221850.jpg','res\\images\\roleLiHui\\role_20180526221850.jpg','defense','防御型','防御',100,100,20),(3,'墨水','res/images/rolePortrait/role_20180526221931.jpg','res\\images\\roleLiHui\\role_20180526221931.jpg','cure','治愈型','治愈',100,100,50),(4,'4号选手','res/images/rolePortrait/role_19700101000000.jpg','res\\images\\roleLiHui\\role_19700101000000.jpg','attack','未知','未知',0,0,0),(5,'5号选手','res/images/rolePortrait/role_19700101000000.jpg','res\\images\\roleLiHui\\role_19700101000000.jpg','defense','未知','未知',0,0,0),(6,'5号选手','res/images/rolePortrait/role_19700101000000.jpg','res/images/rolePortrait/role_19700101000000.jpg','cure','未知','未知',0,0,0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`account`,`password`,`token`) values (94,'9','40bd001563085fc35165329ea1ff5c5ecbdbbeef','1b4c5594832a7c6a6f3594c8aace40f1c599599b'),(95,'lymn','fcc70e9ff7ee033989226e8b854e7d36bbf782cc','4ab0cda49e5dde41b790d802947a5cc699c8d553'),(96,'123','40bd001563085fc35165329ea1ff5c5ecbdbbeef','0d849040f6ebc263bca0c0a464039d35d066d4ed');

/*Table structure for table `user_info` */

DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) DEFAULT NULL,
  `portraitPath` text,
  `defenseValue` int(10) DEFAULT '0',
  `attackValue` int(10) DEFAULT '0',
  `cureValue` int(10) DEFAULT '0',
  `userLevelInfosPath` text,
  `userErrorWordInfosPath` text,
  `userId` int(10) DEFAULT NULL,
  `level` int(10) DEFAULT '1',
  `correctNum` int(10) DEFAULT '0',
  `rank` varchar(45) DEFAULT '少尉',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Data for the table `user_info` */

insert  into `user_info`(`id`,`userName`,`portraitPath`,`defenseValue`,`attackValue`,`cureValue`,`userLevelInfosPath`,`userErrorWordInfosPath`,`userId`,`level`,`correctNum`,`rank`) values (45,'玩家','res/images/portrait/img_20180524111830.png',0,0,0,'res/userLevelInfos/userlevelInfos_2018060412475394.json','res/userErrorWordInfos/userErrorWordInfos_2018060412475394.json',94,1,0,'少尉'),(46,'fgfdh','res/images/portrait/img_20180524111830.png',456,456,456,'','res/userErrorWordInfos/userErrorWordInfos_2018060413195795.json',95,3,4,'中尉'),(47,'玩家','res/images/portrait/img_20180524111830.png',0,0,0,'res/userLevelInfos/userlevelInfos_2018060413290096.json','res/userErrorWordInfos/userErrorWordInfos_2018060413290096.json',96,1,0,'少尉');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) DEFAULT NULL,
  `role1` int(10) DEFAULT '2' COMMENT '角色状态',
  `role2` int(10) DEFAULT '2',
  `role3` int(10) DEFAULT '2',
  `role4` int(10) DEFAULT '0',
  `role5` int(10) DEFAULT '0',
  `role6` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`userId`,`role1`,`role2`,`role3`,`role4`,`role5`,`role6`) values (43,94,2,2,2,0,0,0),(44,95,2,2,1,2,1,1),(45,96,2,2,2,0,0,0);

/*Table structure for table `word` */

DROP TABLE IF EXISTS `word`;

CREATE TABLE `word` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pinyin` varchar(45) DEFAULT NULL,
  `content` varchar(45) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `word` */

insert  into `word`(`id`,`pinyin`,`content`,`detail`) values (2,'dài','戴','加在头、面、颈、。尊奉，拥护：～仰。爱～。拥～。感恩～德。'),(3,'gàn','淦','水入船中。河工称起伏很大的激浪。'),(4,'yīng','嘤','象声词，形容鸟叫或低而细微的声音。'),(5,'sì','亖','古同“四”。'),(6,'zhuó','叕','连缀。短，不足：“圣人之思脩，愚人之思～。”'),(7,'yì','燚','火貌。'),(8,'xiān','祆','〔～教〕拜火教，波斯人琐罗亚斯特所创立，崇拜火，今印度、伊朗还有信徒。'),(9,'qí','祇','地神。說文解字：“祇，地祇，提出萬物者也。”如：“神祇”。'),(10,'gǔ','汩','水流的样子：～流（急流）。～～（水流动的声音或样子）。'),(11,'gū','沽','买：～酒。～名钓誉。'),(12,'guǎng','广','指面积、范围宽阔，与“狭”相对：宽～。～博。～义。～漠。～袤（东西称“广”，南北称“袤”，指土地面积）'),(13,'dōng','东','方向，太阳出升的一边，与“西”相对：'),(14,'gōng','工','个人不占有生产资料，依靠工资收入为生的劳动者：～人。～人阶级。～农联盟。'),(15,'yè','业','国民经济中的部门：工～。农～。'),(16,'dà','大','指面积、体积、容量、数量、强度');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
