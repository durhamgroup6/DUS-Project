-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2019 at 04:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamdurham`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(20) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `Price` float NOT NULL,
  `FacilityID` int(20) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `UserID`, `StartTime`, `EndTime`, `Price`, `FacilityID`, `color`) VALUES
(1, 4, '2019-05-22 10:00:00', '2019-05-22 11:00:00', 5, 3, 'yellow'),
(2, 4, '2019-05-22 10:00:00', '2019-05-22 11:00:00', 5, 3, 'yellow'),
(3, 4, '2019-05-22 10:00:00', '2019-05-22 11:00:00', 5, 3, 'yellow'),
(4, 4, '2019-05-22 10:00:00', '2019-05-22 11:00:00', 5, 3, 'yellow'),
(5, 4, '2019-05-22 10:00:00', '2019-05-22 11:00:00', 5, 3, 'yellow'),
(6, 4, '2019-05-22 09:00:00', '2019-05-22 10:00:00', 18, 4, 'blue'),
(7, 4, '2019-05-22 10:00:00', '2019-05-22 11:00:00', 18, 4, 'blue'),
(8, 4, '2019-05-31 09:00:00', '2019-05-31 10:00:00', 9, 5, 'pink'),
(9, 4, '2019-05-31 10:00:00', '2019-05-31 11:00:00', 9, 5, 'pink'),
(10, 4, '2019-05-31 11:00:00', '2019-05-31 12:00:00', 9, 5, 'pink'),
(11, 4, '2019-05-27 14:00:00', '2019-05-27 15:00:00', 27, 6, 'orange'),
(12, 4, '2019-05-14 11:00:00', '2019-05-14 12:00:00', 27, 6, 'orange'),
(13, 4, '2019-05-16 21:00:00', '2019-05-16 22:00:00', 5, 3, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` text CHARACTER SET utf8 NOT NULL,
  `TrainerID` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `FacilityID` int(11) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `TrainerID`, `Capacity`, `Description`, `StartDate`, `EndDate`, `FacilityID`, `color`) VALUES
(1, 'dance', 2, 3, 'love u', '2019-05-09 00:00:00', '2019-05-13 00:00:00', 3, 'green');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
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
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`FacilityID`, `FacilityName`, `Description`, `Price`, `Capacity`, `Availability`) VALUES
(3, 'Squash Courts', 'Squash Courts: &pound6 per court, per hour.', 6, 20, 1),
(4, 'Aerobics room', 'A mirrored studio is avaliable for group classes such as dance, yoga and pilates. This space can also be used for presentations and functions.\r\n\r\nAerobics Room - &pound20.00 per hour', 20, 20, 1),
(5, 'Tennis', 'Tennis (Tarmac) - &pound10.00 per court per hour', 10, 20, 1),
(6, 'Athletics Track', 'Track - &pound2.00 per person\r\n\r\nTrack (sole use) - &pound30.00 per hour', 30, 20, 1),
(7, 'Fitness Suite', 'The fitness suite is fully air conditioned and benefits from a wide variety of machines and equipment including Technogym resistance machines, cable systems, free weights, cardio vascular machines, TRX suspension training system, ViPR trainers and medicine balls, as well as foam rollers and exercise balls. We also have a chilled water dispenser and large screen TVs.  We have a number of fully qualified and knowledgeable members of staff who can assist with any of your needs and provide guidance with exercises or workout plans.  You will also benefit from free parking and on-site change/shower facilities.  Opening Times:  Monday to Friday 7.00 am to 10.00 pm (last entry, 9.15 pm) Saturday & Sunday  9.00 am to 6.00 pm (last entry, 5.15 pm)\r\n\r\nAddress:Durham DH1 3SE, UK\r\n\r\nEmail:Fitness.suite@dur.ac.uk\r\n\r\nPhone:1913342178', 5, 20, 1),
(8, 'Maiden Castle Physiotherapy', 'Who are we and what can we do for you?  Maiden Castle Physiotherapy (MCP) is a friendly and experienced team offering services to the athletes of Team Durham and the surrounding area. Based at the Graham Sports Centre in Maiden Castle, our specialist team offer physiotherapy for a wide range of musculoskeletal conditions including sports injuries, back, neck or joint or muscle pains or sports injuries.  Our team of experienced state registered NHS physiotherapists will assess and provide tailored treatment programmes to help get you back on track, achieve your overall fitness goals and offer preventative advice to help you stay pain free.  Physiotherapy assessment/treatment 30 minutes &pound30  Discounted rate for Durham University Staff &pound28  Discounted for Durham University Students &pound24  Sports massage 30 minutes &pound25  Book your appointment through the Graham Sports Centre reception today  Daytime and evening appointments available  Our opening hours are:  Monday afternoon/evening  Tuesday afternoon/evening  Wednesday all day  Thursday afternoon/evening  Friday morning  If you book an appointment with us:   	During physiotherapy and massage appointments you may be asked to remove items of clothing to allow for assessment and treatment of an area and adjacent joints. 	For screening please wear shorts, trainers and a sports top. 	Athletes under 16 will need to be accompanied by a chaperone. 	If you have a preference for a male or female therapist please make the request when booking your appointment.', 20, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Password`, `Email`, `Phone`, `Role`, `Firstname`, `Lastname`, `resetpasswordtime`) VALUES
(2, '$2y$10$.wfdFWUfsvO7QQ0v6ScBQuXwXDxy5IUDMMxLh6gd8XAET41XnjaLS', '414454879@qq.com', '7851666865', 'trainer', 'z', 'chen', 0),
(3, '$2y$10$DIUIRhmJ44GlwRmmnUzA0.sNQm6kkPtDKke3LFqW3nGvyY3IgVrBG', '123@qq.com', '123', 'user', 'a', 'chen', 0),
(4, '$2y$10$B6213fivCLUWAFvrGYOPKOkfC2VdkGfY11kxsCTm7GkGDSDNXfkTq', '649965979@qq.com', '11223344', 'user', 'wanyu', 'hong', 1557712525),
(5, '$2y$10$Hs34F6Jd6iHa7K6Qzk4i3eDkHSb9rAZk0pMmmfDRC10SCmm15ar9i', 'wanyu.hong@durham.ac.uk', '1234567', 'user', 'sha', 'se', 1557712174);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`FacilityID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `FacilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
