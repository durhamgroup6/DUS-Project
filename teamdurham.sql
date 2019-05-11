-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-05-11 19:39:42
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
-- 表的结构 `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `EventID` int(20) NOT NULL,
  `UserID` int(20) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `Price` int(20) NOT NULL,
  `FacilityID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` text CHARACTER SET utf8 NOT NULL,
  `TrainerID` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Description` longtext CHARACTER SET utf8 NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `FacilityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `TrainerID`, `Capacity`, `Description`, `StartDate`, `EndDate`, `FacilityID`) VALUES
(1, 'dance', 2, 3, 'love u', '2019-05-09 00:00:00', '2019-05-13 00:00:00', 2);

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
  `Availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `facility`
--

INSERT INTO `facility` (`FacilityID`, `FacilityName`, `Description`, `Price`, `Capacity`, `Availability`) VALUES
(2, 'ball room', 'young and beautiful', 0, 100, 1),
(3, 'Squash Courts', 'Squash Courts: &pound6 per court, per hour.', 6, 100, 1),
(4, 'Aerobics room', 'A mirrored studio is avaliable for group classes such as dance, yoga and pilates. This space can also be used for presentations and functions.\r\n\r\nAerobics Room - &pound20.00 per hour', 20, 100, 1),
(5, 'Tennis', 'Tennis (Tarmac) - &pound10.00 per court per hour', 10, 100, 1),
(6, 'Athletics Track', 'Track - &pound2.00 per person\r\n\r\nTrack (sole use) - &pound30.00 per hour', 30, 100, 1);

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
(2, '$2y$10$.wfdFWUfsvO7QQ0v6ScBQuXwXDxy5IUDMMxLh6gd8XAET41XnjaLS', '414454879@qq.com', '7851666865', 'user', 'z', 'chen', 0),
(3, '$2y$10$DIUIRhmJ44GlwRmmnUzA0.sNQm6kkPtDKke3LFqW3nGvyY3IgVrBG', '123@qq.com', '123', 'user', 'a', 'chen', 0),
(4, '$2y$10$B6213fivCLUWAFvrGYOPKOkfC2VdkGfY11kxsCTm7GkGDSDNXfkTq', '649965979@qq.com', '11223344', 'user', 'wanyu', 'hong', 1557584318);

--
-- 转储表的索引
--

--
-- 表的索引 `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`);

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
-- 使用表AUTO_INCREMENT `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `facility`
--
ALTER TABLE `facility`
  MODIFY `FacilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
