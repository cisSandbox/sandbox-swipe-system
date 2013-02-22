-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2013 at 01:51 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sb-swipe`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `CRN` varchar(5) NOT NULL COMMENT 'The course''s CRN',
  `meetingID` int(11) NOT NULL COMMENT 'FK to MEETING',
  `courseID` varchar(10) NOT NULL COMMENT 'FK to COURSE',
  `semesterID` varchar(5) NOT NULL COMMENT 'FK to SEMESTER',
  `professor` varchar(20) NOT NULL COMMENT 'Professor teaching this class',
  PRIMARY KEY (`CRN`),
  KEY `meetingID` (`meetingID`),
  KEY `semesterID` (`semesterID`),
  KEY `courseID` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` varchar(7) NOT NULL COMMENT 'course code NO SPACES (e.g. IT101)',
  `desc` varchar(140) DEFAULT 'There is no description for this course' COMMENT 'description of the course',
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `desc`) VALUES
('IT 101', 'Introductory Information Technology Course');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE IF NOT EXISTS `day` (
  `DayID` int(11) NOT NULL COMMENT '0 as Monday, 6 as Sunday',
  `dayName` varchar(9) NOT NULL,
  PRIMARY KEY (`DayID`),
  UNIQUE KEY `dayName` (`dayName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_time`
--

CREATE TABLE IF NOT EXISTS `meeting_time` (
  `meetingID` int(11) NOT NULL COMMENT 'PK',
  `block` varchar(20) NOT NULL COMMENT 'Meeting times as string (e.g. TR 2:10)',
  PRIMARY KEY (`meetingID`),
  UNIQUE KEY `block` (`block`),
  KEY `block_2` (`block`),
  KEY `block_3` (`block`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `roomID` varchar(8) NOT NULL COMMENT 'room name (SMI 234)',
  `roomName` varchar(20) NOT NULL COMMENT 'desc (CIS Sandbox)',
  PRIMARY KEY (`roomID`),
  UNIQUE KEY `roomName` (`roomName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `semesterID` varchar(5) NOT NULL COMMENT 'PK syyyy where s = {s,S,f} and yyyy is the year (e.g. s2013 = spring 2013)',
  `semesterCode` varchar(20) NOT NULL COMMENT 'String representation of the ID',
  PRIMARY KEY (`semesterID`),
  UNIQUE KEY `semesterCode` (`semesterCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentID` varchar(8) NOT NULL COMMENT 'bentley ID without the ''@''',
  `firstName` varchar(20) NOT NULL COMMENT 'student''s first name',
  `lastName` varchar(20) DEFAULT NULL COMMENT 'student''s last name',
  `classCode` int(11) DEFAULT NULL COMMENT 'student''s class code',
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `classCode`) VALUES
('03224844', 'Conner', 'Charlebois', NULL),
('12345678', 'Nick', 'Hentschel', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `tutorID` varchar(8) NOT NULL COMMENT 'tutor ID',
  `studentID` varchar(8) NOT NULL COMMENT 'student ID',
  PRIMARY KEY (`tutorID`),
  UNIQUE KEY `studentID` (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutorID`, `studentID`) VALUES
('99990009', '03224844'),
('99990002', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tutored_visit`
--

CREATE TABLE IF NOT EXISTS `tutored_visit` (
  `tutoredVisitID` int(11) NOT NULL,
  `tutorID` varchar(8) NOT NULL COMMENT 'FK to tutor',
  `timeTutored` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'time the tutor form was submitted',
  PRIMARY KEY (`tutoredVisitID`),
  KEY `tutorID` (`tutorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutor_ability`
--

CREATE TABLE IF NOT EXISTS `tutor_ability` (
  `abilityID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'internal',
  `tutorID` varchar(8) NOT NULL COMMENT 'FK to TUTOR',
  `courseID` varchar(7) NOT NULL COMMENT 'FK to COURSE',
  PRIMARY KEY (`abilityID`),
  KEY `tutorID` (`tutorID`,`courseID`),
  KEY `courseID` (`courseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tutor_ability`
--

INSERT INTO `tutor_ability` (`abilityID`, `tutorID`, `courseID`) VALUES
(2, '99990002', 'IT 101'),
(1, '99990009', 'IT 101');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `visitID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'internal',
  `roomID` varchar(8) NOT NULL COMMENT 'FK to ROOM',
  `studentID` varchar(8) NOT NULL COMMENT 'FK to STUDENT',
  `classID` varchar(5) NOT NULL COMMENT 'FK to CLASS',
  `timeIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timeOut` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`visitID`),
  KEY `roomID` (`roomID`,`studentID`,`classID`),
  KEY `studentID` (`studentID`),
  KEY `classID` (`classID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `work_visit`
--

CREATE TABLE IF NOT EXISTS `work_visit` (
  `workID` int(11) NOT NULL COMMENT 'FK to VISIT',
  `dayID` int(11) NOT NULL COMMENT 'FK to DAY',
  `tutorID` varchar(8) NOT NULL COMMENT 'FK to tutor',
  `startTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `endTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`workID`),
  KEY `dayID` (`dayID`,`tutorID`),
  KEY `tutorID` (`tutorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`meetingID`) REFERENCES `meeting_time` (`meetingID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`semesterID`) REFERENCES `semester` (`semesterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutored_visit`
--
ALTER TABLE `tutored_visit`
  ADD CONSTRAINT `tutored_visit_ibfk_1` FOREIGN KEY (`tutoredVisitID`) REFERENCES `visit` (`visitID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutored_visit_ibfk_2` FOREIGN KEY (`tutorID`) REFERENCES `tutor` (`tutorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutor_ability`
--
ALTER TABLE `tutor_ability`
  ADD CONSTRAINT `tutor_ability_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutor_ability_ibfk_2` FOREIGN KEY (`tutorID`) REFERENCES `tutor` (`tutorID`);

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`classID`) REFERENCES `class` (`CRN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_visit`
--
ALTER TABLE `work_visit`
  ADD CONSTRAINT `work_visit_ibfk_1` FOREIGN KEY (`tutorID`) REFERENCES `tutor` (`tutorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_visit_ibfk_2` FOREIGN KEY (`dayID`) REFERENCES `day` (`DayID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
