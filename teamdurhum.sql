/*
SQLyog Professional v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - teamdurham
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`teamdurham` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `teamdurham`;

/*Table structure for table `blockbookings` */

DROP TABLE IF EXISTS `blockbookings`;

CREATE TABLE `blockbookings` (
  `BlockID` int(11) NOT NULL AUTO_INCREMENT,
  `FacilityID` int(11) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  PRIMARY KEY (`BlockID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `blockbookings` */

insert  into `blockbookings`(`BlockID`,`FacilityID`,`color`,`StartTime`,`EndTime`) values (14,6,'#FF0000','2019-05-28 10:50:00','2019-05-28 11:50:00'),(15,6,'#FF0000','2019-05-29 10:50:00','2019-05-29 11:50:00'),(16,6,'#FF0000','2019-05-30 10:50:00','2019-05-30 11:50:00');

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(20) NOT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `Price` float NOT NULL,
  `FacilityID` int(20) NOT NULL,
  `is_cancel` tinyint(1) DEFAULT '0',
  `color` varchar(20) NOT NULL,
  PRIMARY KEY (`BookingID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `booking` */

insert  into `booking`(`BookingID`,`UserID`,`StartTime`,`EndTime`,`Price`,`FacilityID`,`is_cancel`,`color`) values (52,5,'2019-05-21 08:30:00','2019-05-24 10:30:00',200,6,0,'#2e7b1b'),(53,3,'2019-05-21 11:30:00','2019-05-24 02:15:00',100,4,0,'#4b60b0');

/*Table structure for table `bookingdates` */

DROP TABLE IF EXISTS `bookingdates`;

CREATE TABLE `bookingdates` (
  `BookDateID` int(11) NOT NULL AUTO_INCREMENT,
  `BookingID` int(11) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  PRIMARY KEY (`BookDateID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `bookingdates` */

insert  into `bookingdates`(`BookDateID`,`BookingID`,`StartTime`,`EndTime`) values (14,52,'2019-05-21 08:30:00','2019-05-21 10:30:00'),(15,52,'2019-05-22 08:30:00','2019-05-22 10:30:00'),(16,52,'2019-05-23 08:30:00','2019-05-23 10:30:00'),(17,52,'2019-05-24 08:30:00','2019-05-24 10:30:00'),(18,53,'2019-05-21 11:30:00','2019-05-21 02:15:00'),(19,53,'2019-05-22 11:30:00','2019-05-22 02:15:00'),(20,53,'2019-05-23 11:30:00','2019-05-23 02:15:00'),(21,53,'2019-05-24 11:30:00','2019-05-24 02:15:00');

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `EventName` text CHARACTER SET utf8 NOT NULL,
  `TrainerID` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `WeekDate` int(11) DEFAULT NULL,
  `FacilityID` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `event` */

insert  into `event`(`EventID`,`EventName`,`TrainerID`,`Capacity`,`Description`,`StartDate`,`EndDate`,`WeekDate`,`FacilityID`,`color`) values (1,'dance',2,3,'love u','2019-05-09 17:00:00','2019-05-31 18:00:00',4,3,'green'),(3,'match',2,10,'bvukmfdbjikjdmc','2019-05-18 00:00:00','2019-05-19 00:00:00',NULL,5,'#00ff80'),(4,'match',2,10,'hgnyuhkjl','2019-05-20 00:00:00','2019-05-21 00:00:00',NULL,6,'#ffff00');

/*Table structure for table `facility` */

DROP TABLE IF EXISTS `facility`;

CREATE TABLE `facility` (
  `FacilityID` int(11) NOT NULL AUTO_INCREMENT,
  `FacilityName` text NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `PicURL` text,
  PRIMARY KEY (`FacilityID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `facility` */

insert  into `facility`(`FacilityID`,`FacilityName`,`Description`,`Price`,`Capacity`,`Availability`,`PicURL`) values (3,'Squash Courts','Squash Courts: &pound6 per court, per hour.',6,20,1,'4-fundamental-practices-in-IoT-software-development-1-1024x640.jpeg'),(4,'Aerobics room','A mirrored studio is avaliable for group classes such as dance, yoga and pilates. This space can also be used for presentations and functions.\r\n\r\nAerobics Room - Â£20.00 per hour',20,20,1,'4-fundamental-practices-in-IoT-software-development-1-1024x640.jpeg'),(5,'Tennis','Tennis (Tarmac) - &pound10.00 per court per hour',10,20,1,'4-fundamental-practices-in-IoT-software-development-1-1024x640.jpeg'),(6,'Athletics Track','Track - &pound2.00 per person\r\n\r\nTrack (sole use) - &pound30.00 per hour',30,20,1,'4-fundamental-practices-in-IoT-software-development-1-1024x640.jpeg'),(7,'Fitness Suite','The fitness suite is fully air conditioned and benefits from a wide variety of machines and equipment including Technogym resistance machines, cable systems, free weights, cardio vascular machines, TRX suspension training system, ViPR trainers and medicine balls, as well as foam rollers and exercise balls. We also have a chilled water dispenser and large screen TVs.  We have a number of fully qualified and knowledgeable members of staff who can assist with any of your needs and provide guidance with exercises or workout plans.  You will also benefit from free parking and on-site change/shower facilities.  Opening Times:  Monday to Friday 7.00 am to 10.00 pm (last entry, 9.15 pm) Saturday & Sunday  9.00 am to 6.00 pm (last entry, 5.15 pm)\r\n\r\nAddress:Durham DH1 3SE, UK\r\n\r\nEmail:Fitness.suite@dur.ac.uk\r\n\r\nPhone:1913342178',5,20,1,'4-fundamental-practices-in-IoT-software-development-1-1024x640.jpeg'),(8,'Maiden Castle Physiotherapy','Who are we and what can we do for you?  Maiden Castle Physiotherapy (MCP) is a friendly and experienced team offering services to the athletes of Team Durham and the surrounding area. Based at the Graham Sports Centre in Maiden Castle, our specialist team offer physiotherapy for a wide range of musculoskeletal conditions including sports injuries, back, neck or joint or muscle pains or sports injuries.  Our team of experienced state registered NHS physiotherapists will assess and provide tailored treatment programmes to help get you back on track, achieve your overall fitness goals and offer preventative advice to help you stay pain free.  Physiotherapy assessment/treatment 30 minutes &pound30  Discounted rate for Durham University Staff &pound28  Discounted for Durham University Students &pound24  Sports massage 30 minutes &pound25  Book your appointment through the Graham Sports Centre reception today  Daytime and evening appointments available  Our opening hours are:  Monday afternoon/evening  Tuesday afternoon/evening  Wednesday all day  Thursday afternoon/evening  Friday morning  If you book an appointment with us:   	During physiotherapy and massage appointments you may be asked to remove items of clothing to allow for assessment and treatment of an area and adjacent joints. 	For screening please wear shorts, trainers and a sports top. 	Athletes under 16 will need to be accompanied by a chaperone. 	If you have a preference for a male or female therapist please make the request when booking your appointment.',20,20,1,'4-fundamental-practices-in-IoT-software-development-1-1024x640.jpeg');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Role` enum('user','trainer','admin') NOT NULL DEFAULT 'user',
  `Firstname` text NOT NULL,
  `Lastname` text NOT NULL,
  `resetpasswordtime` int(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`UserID`,`Password`,`Email`,`Phone`,`Role`,`Firstname`,`Lastname`,`resetpasswordtime`) values (2,'$2y$10$.wfdFWUfsvO7QQ0v6ScBQuXwXDxy5IUDMMxLh6gd8XAET41XnjaLS','414454879@qq.com','7851666865','trainer','z','chen',0),(3,'$2y$10$DIUIRhmJ44GlwRmmnUzA0.sNQm6kkPtDKke3LFqW3nGvyY3IgVrBG','123@qq.com','123','user','a','chen',0),(4,'$2y$10$rsNtb0AnMDKtGih8V.WxWu539TWT90OLg8bR/u6k4.FB0sRrqRW/.','649965979@qq.com','11223344','user','wanyu','hong',1557793635),(5,'$2y$10$Hs34F6Jd6iHa7K6Qzk4i3eDkHSb9rAZk0pMmmfDRC10SCmm15ar9i','wanyu.hong@durham.ac.uk','1234567','user','sha','se',1557712174);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
