-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-05-24 00:17:27
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `teamdurham`
--

-- --------------------------------------------------------

--
-- 表的结构 `blockbookings`
--

CREATE TABLE `blockbookings` (
  `BlockID` int(11) NOT NULL,
  `FacilityID` int(11) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `blockbookings`
--

INSERT INTO `blockbookings` (`BlockID`, `FacilityID`, `color`, `StartTime`, `EndTime`) VALUES
(17, 4, '#FF0000', '2019-05-20 08:00:00', '2019-05-20 09:00:00'),
(18, 4, '#FF0000', '2019-05-21 08:00:00', '2019-05-21 09:00:00'),
(20, 6, '#FF0000', '2019-05-23 04:00:00', '2019-05-23 06:00:00'),
(21, 6, '#FF0000', '2019-05-24 04:00:00', '2019-05-24 06:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(20) NOT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `Price` float NOT NULL,
  `FacilityID` int(20) NOT NULL,
  `is_cancel` tinyint(1) DEFAULT '0',
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `booking`
--

INSERT INTO `booking` (`BookingID`, `UserID`, `StartTime`, `EndTime`, `Price`, `FacilityID`, `is_cancel`, `color`) VALUES
(57, 3, '2019-05-26 08:00:00', '2019-05-26 12:00:00', 10, 4, 0, 'blue'),
(58, 2, '2019-05-23 13:00:00', '2019-05-23 15:00:00', 10, 4, 0, 'blue'),
(59, 4, '2019-05-29 08:00:00', '2019-05-29 09:00:00', 12, 5, 1, 'pink');

-- --------------------------------------------------------

--
-- 表的结构 `bookingdates`
--

CREATE TABLE `bookingdates` (
  `BookDateID` int(11) NOT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `bookingdates`
--

INSERT INTO `bookingdates` (`BookDateID`, `BookingID`, `StartTime`, `EndTime`) VALUES
(426, 57, '2019-05-26 08:00:00', '2019-05-26 09:00:00'),
(427, 57, '2019-05-26 09:00:00', '2019-05-26 10:00:00'),
(428, 57, '2019-05-26 10:00:00', '2019-05-26 11:00:00'),
(429, 57, '2019-05-26 11:00:00', '2019-05-26 12:00:00'),
(430, 58, '2019-05-23 13:00:00', '2019-05-23 14:00:00'),
(431, 58, '2019-05-23 14:00:00', '2019-05-23 15:00:00'),
(432, 59, '2019-05-29 08:00:00', '2019-05-29 09:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` text CHARACTER SET utf8 NOT NULL,
  `TrainerID` int(11) DEFAULT NULL,
  `Capacity` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `WeekDate` int(11) DEFAULT NULL,
  `FacilityID` int(11) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `TrainerID`, `Capacity`, `Description`, `StartDate`, `EndDate`, `WeekDate`, `FacilityID`, `color`) VALUES
(7, 'match', 2, 50, 'bkjhiiuiuj', '2019-05-22 08:00:00', '2019-05-24 10:00:00', 4, 3, '#3c763d');

-- --------------------------------------------------------

--
-- 表的结构 `eventdates`
--

CREATE TABLE `eventdates` (
  `EventDateID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `eventdates`
--

INSERT INTO `eventdates` (`EventDateID`, `EventID`, `StartTime`, `EndTime`) VALUES
(4, 7, '2019-05-22 08:00:00', '2019-05-22 10:00:00'),
(5, 7, '2019-05-23 08:00:00', '2019-05-23 10:00:00'),
(6, 7, '2019-05-24 08:00:00', '2019-05-24 10:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `facility`
--

CREATE TABLE `facility` (
  `FacilityID` int(11) NOT NULL,
  `FacilityName` text NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `PicURL` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `facility`
--

INSERT INTO `facility` (`FacilityID`, `FacilityName`, `Description`, `Price`, `Capacity`, `Availability`, `PicURL`) VALUES
(3, 'Squash Courts', 'Squash Courts:  Â£6 per court, per hour.', 6, 20, 1, 'Squash Courts.jpg'),
(4, 'Aerobics room', 'A mirrored studio is avaliable for group classes such as dance, yoga and pilates. This space can also be used for presentations and functions.\r\n\r\nAerobics Room - Â£20.00 per hour', 20, 6, 1, 'Aerobics room.jpg'),
(5, 'Tennis', 'Tennis (Tarmac) -  Â£10.00 per court per hour', 10, 20, 1, 'Athletics Track.jpg'),
(6, 'Athletics Track', 'Track -  Â£2.00 per person\r\n\r\nTrack (sole use) -  Â£30.00 per hour', 7, 20, 1, 'Athletics Track.jpg'),
(7, 'Fitness Suite', 'The fitness suite is fully air conditioned and benefits from a wide variety of machines and equipment including Technogym resistance machines, cable systems, free weights, cardio vascular machines, TRX suspension training system, ViPR trainers and medicine balls, as well as foam rollers and exercise balls. We also have a chilled water dispenser and large screen TVs.  We have a number of fully qualified and knowledgeable members of staff who can assist with any of your needs and provide guidance with exercises or workout plans.  You will also benefit from free parking and on-site change/shower facilities.  Opening Times:  Monday to Friday 7.00 am to 10.00 pm (last entry, 9.15 pm) Saturday & Sunday  9.00 am to 6.00 pm (last entry, 5.15 pm)\r\n\r\nAddress:Durham DH1 3SE, UK\r\n\r\nEmail:Fitness.suite@dur.ac.uk\r\n\r\nPhone:1913342178', 20, 20, 1, 'Fitness Suite.jpg'),
(8, 'Maiden Castle Physiotherapy', 'Who are we and what can we do for you?  Maiden Castle Physiotherapy (MCP) is a friendly and experienced team offering services to the athletes of Team Durham and the surrounding area. Based at the Graham Sports Centre in Maiden Castle, our specialist team offer physiotherapy for a wide range of musculoskeletal conditions including sports injuries, back, neck or joint or muscle pains or sports injuries.  Our team of experienced state registered NHS physiotherapists will assess and provide tailored treatment programmes to help get you back on track, achieve your overall fitness goals and offer preventative advice to help you stay pain free.  Physiotherapy assessment/treatment 30 minutes Â£30  Discounted rate for Durham University Staff Â£28  Discounted for Durham University Students Â£24  Sports massage 30 minutes Â£25  Book your appointment through the Graham Sports Centre reception today  Daytime and evening appointments available  Our opening hours are:  Monday afternoon/evening  Tuesday afternoon/evening  Wednesday all day  Thursday afternoon/evening  Friday morning  If you book an appointment with us:   	During physiotherapy and massage appointments you may be asked to remove items of clothing to allow for assessment and treatment of an area and adjacent joints. 	For screening please wear shorts, trainers and a sports top. 	Athletes under 16 will need to be accompanied by a chaperone. 	If you have a preference for a male or female therapist please make the request when booking your appointment.', 20, 20, 1, 'Maiden Castle Physiotherapy.jpg'),
(9, 'Ergo Gallery', 'Public:\r\nFull Room: Â£35 per hour\r\nIf a coach is required the hourly rate for a coach is Â£15 per hour\r\nStaff/Students:\r\nFull Room: Â£30 per hour\r\nIf a coach is required the hourly rate for a coach is Â£15 per hour', 30, 20, 1, 'Ergo Gallery.jpg'),
(10, 'Rowing Tank', 'Public:\r\nStatic water training: Â£35\r\nMoving water training: Â£45\r\nIf a coach is required the hourly rate for a coach is Â£15 per hour\r\nStaff/Student:\r\nStatic water training: Â£30\r\nMoving water training: Â£40\r\nIf a coach is required the hourly rate for a coach is Â£15 per hour', 30, 20, 1, 'Rowing Tank.jpg'),
(11, 'Sports Hall', 'There are multiple activites that take place in the sports hall.\r\n\r\nSquash: Â£6.00 per court per hour\r\n\r\nBadminton: Â£11.00 per court per hour\r\n\r\nBasketball: Â£27.50 per hour\r\n\r\nVolleyball: Â£27.50 per hour\r\n\r\n5 a side: Â£55.00 per hour\r\n\r\nNetball: Â£55.00 per hour\r\n\r\nCricket Nets: Â£60.00 per hour', 6, 20, 1, 'Sports Hall.jpg'),
(12, 'Rubber Crumbs', 'Staff/Student:\r\nHalf pitch Â£20 per hour\r\nFull pitch Â£40 per hour\r\nPublic:\r\nHalf pitch Â£40 per hour\r\nFull pitch Â£80 per hour', 40, 20, 1, 'Rubber Crumbs.jpg'),
(13, 'Artificial pitches', 'Staff/Student:\r\nHalf pitch - Â£20 per hour\r\nFull pitch Â£40 per hour\r\nPublic:\r\nHalf pitch Â£40 per hour\r\nFull pitch Â£80 per hour', 40, 20, 1, 'Artificial Pitches.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Role` enum('user','trainer','admin') NOT NULL DEFAULT 'user',
  `Firstname` text NOT NULL,
  `Lastname` text NOT NULL,
  `resetpasswordtime` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`UserID`, `Password`, `Email`, `Phone`, `Role`, `Firstname`, `Lastname`, `resetpasswordtime`) VALUES
(2, '$2y$10$.wfdFWUfsvO7QQ0v6ScBQuXwXDxy5IUDMMxLh6gd8XAET41XnjaLS', '414454879@qq.com', '7851666865', 'trainer', 'z', 'chen', 0),
(3, '$2y$10$DIUIRhmJ44GlwRmmnUzA0.sNQm6kkPtDKke3LFqW3nGvyY3IgVrBG', '123@qq.com', '123', 'admin', 'a', 'chen', 0),
(4, '$2y$10$rsNtb0AnMDKtGih8V.WxWu539TWT90OLg8bR/u6k4.FB0sRrqRW/.', '649965979@qq.com', '11223344', 'user', 'wanyu', 'hong', 1557793635);

--
-- 转储表的索引
--

--
-- 表的索引 `blockbookings`
--
ALTER TABLE `blockbookings`
  ADD PRIMARY KEY (`BlockID`);

--
-- 表的索引 `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`);

--
-- 表的索引 `bookingdates`
--
ALTER TABLE `bookingdates`
  ADD PRIMARY KEY (`BookDateID`);

--
-- 表的索引 `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- 表的索引 `eventdates`
--
ALTER TABLE `eventdates`
  ADD PRIMARY KEY (`EventDateID`);

--
-- 表的索引 `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`FacilityID`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blockbookings`
--
ALTER TABLE `blockbookings`
  MODIFY `BlockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- 使用表AUTO_INCREMENT `bookingdates`
--
ALTER TABLE `bookingdates`
  MODIFY `BookDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;

--
-- 使用表AUTO_INCREMENT `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `eventdates`
--
ALTER TABLE `eventdates`
  MODIFY `EventDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `facility`
--
ALTER TABLE `facility`
  MODIFY `FacilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
