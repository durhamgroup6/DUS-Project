-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-05-23 03:40:13
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
(14, 6, '#FF0000', '2019-05-28 10:50:00', '2019-05-28 11:50:00'),
(15, 6, '#FF0000', '2019-05-29 10:50:00', '2019-05-29 11:50:00'),
(16, 6, '#FF0000', '2019-05-30 10:50:00', '2019-05-30 11:50:00'),
(17, 4, '#FF0000', '2019-05-09 07:00:00', '2019-05-09 11:00:00'),
(18, 4, '#FF0000', '2019-05-10 07:00:00', '2019-05-10 11:00:00'),
(19, 4, '#FF0000', '2019-05-11 07:00:00', '2019-05-11 11:00:00'),
(20, 4, '#FF0000', '2019-05-12 07:00:00', '2019-05-12 11:00:00'),
(21, 4, '#FF0000', '2019-05-13 07:00:00', '2019-05-13 11:00:00'),
(22, 4, '#FF0000', '2019-05-14 07:00:00', '2019-05-14 11:00:00'),
(23, 4, '#FF0000', '2019-05-15 07:00:00', '2019-05-15 11:00:00');

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
(52, 5, '2019-05-21 08:30:00', '2019-05-24 10:30:00', 200, 6, 0, '#2e7b1b'),
(53, 3, '2019-05-21 11:30:00', '2019-05-24 02:15:00', 100, 4, 0, '#4b60b0'),
(54, 4, '2019-05-30 07:00:00', '2019-05-30 11:00:00', 10, 3, 0, '#fffb00'),
(55, 8, '2019-06-06 09:00:00', '2019-06-06 12:00:00', 54, 4, 1, 'blue'),
(56, 8, '2019-06-06 09:00:00', '2019-06-06 11:00:00', 10.8, 3, 0, 'yellow'),
(57, 9, '2019-05-31 11:00:00', '2019-05-31 12:00:00', 9, 5, 0, 'pink');

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
(14, 52, '2019-05-21 08:30:00', '2019-05-21 10:30:00'),
(15, 52, '2019-05-22 08:30:00', '2019-05-22 10:30:00'),
(16, 52, '2019-05-23 08:30:00', '2019-05-23 10:30:00'),
(17, 52, '2019-05-24 08:30:00', '2019-05-24 10:30:00'),
(18, 53, '2019-05-21 11:30:00', '2019-05-21 02:15:00'),
(19, 53, '2019-05-22 11:30:00', '2019-05-22 02:15:00'),
(20, 53, '2019-05-23 11:30:00', '2019-05-23 02:15:00'),
(21, 53, '2019-05-24 11:30:00', '2019-05-24 02:15:00'),
(22, 54, '2019-05-30 07:00:00', '2019-05-30 11:00:00'),
(23, 55, '2019-06-06 09:00:00', '2019-06-06 10:00:00'),
(24, 55, '2019-06-06 10:00:00', '2019-06-06 11:00:00'),
(25, 55, '2019-06-06 11:00:00', '2019-06-06 12:00:00'),
(26, 56, '2019-06-06 09:00:00', '2019-06-06 10:00:00'),
(27, 56, '2019-06-06 10:00:00', '2019-06-06 11:00:00'),
(28, 57, '2019-05-31 11:00:00', '2019-05-31 12:00:00');

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
(1, 'dance', 2, 3, 'love u', '2019-05-09 17:00:00', '2019-05-31 18:00:00', 4, 3, 'green'),
(3, 'match', 2, 10, 'bvukmfdbjikjdmc', '2019-05-18 00:00:00', '2019-05-19 00:00:00', NULL, 5, '#00ff80'),
(4, 'match', 2, 10, 'hgnyuhkjl', '2019-05-20 00:00:00', '2019-05-21 00:00:00', NULL, 6, '#ffff00'),
(5, 'Test', 2, 20, 'Test', '2019-05-21 10:00:00', '2019-05-21 12:00:00', NULL, 8, '#00f900');

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
(3, 'Squash Courts', 'Squash Courts: Â£6 per court, per hour.', 6, 20, 1, 'Squash Courts.jpg'),
(4, 'Aerobics room', 'A mirrored studio is avaliable for group classes such as dance, yoga and pilates. This space can also be used for presentations and functions.\r\n\r\nAerobics Room - Â£20.00 per hour', 20, 20, 1, 'Aerobics room.jpg'),
(5, 'Sports Hall', 'There are multiple activites that take place in the sports hall.\r\n\r\nSquash: Â£6.00 per court per hour\r\n\r\nBadminton: Â£11.00 per court per hour\r\n\r\nBasketball: Â£27.50 per hour\r\n\r\nVolleyball: Â£27.50 per hour\r\n\r\n5 a side: Â£55.00 per hour\r\n\r\nNetball: Â£55.00 per hour\r\n\r\nCricket Nets: Â£60.00 per hour', 6, 100, 1, 'Sports Hall.jpg'),
(6, 'Athletics Track', 'Track - Â£2.00 per person\r\n\r\nTrack (sole use) - Â£30.00 per hour', 30, 20, 1, 'Athletics Track.jpg'),
(7, 'Fitness Suite', 'The fitness suite is fully air conditioned and benefits from a wide variety of machines and equipment including Technogym resistance machines, cable systems, free weights, cardio vascular machines, TRX suspension training system, ViPR trainers and medicine balls, as well as foam rollers and exercise balls. We also have a chilled water dispenser and large screen TVs.  We have a number of fully qualified and knowledgeable members of staff who can assist with any of your needs and provide guidance with exercises or workout plans.  You will also benefit from free parking and on-site change/shower facilities.  Opening Times:  Monday to Friday 7.00 am to 10.00 pm (last entry, 9.15 pm) Saturday & Sunday  9.00 am to 6.00 pm (last entry, 5.15 pm)\r\n\r\nAddress:Durham DH1 3SE, UK\r\n\r\nEmail:Fitness.suite@dur.ac.uk\r\n\r\nPhone:1913342178', 5, 20, 1, 'Fitness Suite.jpg'),
(8, 'Maiden Castle Physiotherapy', 'Who are we and what can we do for you?  Maiden Castle Physiotherapy (MCP) is a friendly and experienced team offering services to the athletes of Team Durham and the surrounding area. Based at the Graham Sports Centre in Maiden Castle, our specialist team offer physiotherapy for a wide range of musculoskeletal conditions including sports injuries, back, neck or joint or muscle pains or sports injuries.  Our team of experienced state registered NHS physiotherapists will assess and provide tailored treatment programmes to help get you back on track, achieve your overall fitness goals and offer preventative advice to help you stay pain free.  Physiotherapy assessment/treatment 30 minutesï¿½Â£30  Discounted rate for Durham University Staffï¿½Â£28  Discounted for Durham University Studentsï¿½Â£24  Sports massageï¿½30 minutesï¿½Â£25  Book your appointmentï¿½through the Graham Sports Centre reception today  Daytime and evening appointments available  Our opening hours are:  Mondayï¿½afternoon/evening  Tuesdayï¿½afternoon/evening  Wednesdayï¿½all day  Thursdayï¿½afternoon/evening  Fridayï¿½morning  If you book an appointment with us:   	During physiotherapy and massage appointments you may be asked to remove itemsï¿½of clothing to allow for assessment and treatment of an area and adjacent joints. 	For screening please wear shorts, trainers and a sports top. 	Athletes under 16 will need to be accompanied by a chaperone. 	If you have a preference for a male or female therapist please make the request when booking your appointment.', 20, 20, 1, 'Maiden Castle Physiotherapy.jpg'),
(9, 'Fencing Salle', 'More details please contact durham fencing society', 100, 60, 1, 'Fencing Salle.jpg'),
(10, 'Artificial pitches', 'Water-based Astro - (hockey)\r\nStaff/Student:\r\nHalf pitch - Â£20 per hour\r\nFull pitch Â£40 per hour\r\nPublic:\r\nHalf pitch Â£40 per hour\r\nFull pitch Â£80 per hour', 20, 100, 1, 'Artificial Pitches.jpg'),
(11, 'Rubber Crumbs', 'Staff/Student:\r\nHalf pitch Â£20 per hour\r\nFull pitch Â£40 per hour\r\nPublic:\r\nHalf pitch Â£40 per hour\r\nFull pitch Â£80 per hour', 20, 100, 1, 'Rubber Crumbs.jpg'),
(12, 'Ergo Gallery', 'Public:\r\nFull Room: Â£35 per hour\r\nIf a coach is required the hourly rate for a coach is Â£15 per hour\r\nStaff/Students:\r\nFull Room: Â£30 per hour\r\nIf a coach is required the hourly rate for a coach is Â£15 per hour', 30, 30, 1, 'Ergo Gallery.jpg');

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
(4, '$2y$10$rsNtb0AnMDKtGih8V.WxWu539TWT90OLg8bR/u6k4.FB0sRrqRW/.', '649965979@qq.com', '11223344', 'user', 'wanyu', 'hong', 1557793635),
(5, '$2y$10$Hs34F6Jd6iHa7K6Qzk4i3eDkHSb9rAZk0pMmmfDRC10SCmm15ar9i', 'wanyu.hong@durham.ac.uk', '1234567', 'user', 'sha', 'se', 1557712174),
(6, '$2y$10$NrrywEq7.CWlq6Uz7pUobu8akLJY98.ILK2d33/2FA8jmAblkEYje', 'admin@durham.com', '03125263194', 'admin', 'Awan', 'Zain', 0),
(7, '$2y$10$EX4zyXwWP6OV2CEhN.2EPu/UeB6k2BN4kJqb1FZCyOwIPWl7VuL7S', 'test@yahoo.com', '123', 'user', 'Test', 'test', 0),
(8, '$2y$10$ZvFsnzH2EOxoHQ1o39vffe5NOJq6jej05FUqP.JZAd8LOFtGL6U.q', 'chen.pan2@durham.ac.uk', '+447384752845', 'user', 'ollie', 'p', 0),
(9, '$2y$10$WHqXGNUWiBga2Lepz/ZTyO1u3XFXockETRTlrkHjyGMDUjhbit5IC', '453514235@qq.com', '+447384755444', 'user', 'nessa', 'n', 0);

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
  MODIFY `BlockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 使用表AUTO_INCREMENT `bookingdates`
--
ALTER TABLE `bookingdates`
  MODIFY `BookDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `facility`
--
ALTER TABLE `facility`
  MODIFY `FacilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
