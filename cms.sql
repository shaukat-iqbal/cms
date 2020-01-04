-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2020 at 02:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `aId` int(11) NOT NULL AUTO_INCREMENT,
  `sId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `assignmentNo` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  PRIMARY KEY (`sId`,`cId`,`aId`) USING BTREE,
  UNIQUE KEY `unique` (`aId`),
  KEY `courseId` (`cId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`aId`, `sId`, `cId`, `assignmentNo`, `marks`) VALUES
(13, 1, 4, 1, 3),
(14, 1, 4, 2, 1),
(15, 2, 4, 1, 6),
(16, 2, 4, 2, 5),
(5, 4, 1, 1, 5),
(6, 4, 1, 2, 8),
(7, 4, 1, 3, 8),
(8, 4, 1, 4, 7),
(10, 4, 1, 1, 7),
(11, 4, 1, 6, 2),
(1, 5, 1, 1, 6),
(3, 5, 1, 2, 7),
(4, 5, 1, 3, 7),
(12, 5, 1, 4, 2),
(17, 5, 1, 5, 6),
(9, 5, 4, 1, 6),
(18, 5, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `name`, `code`) VALUES
(1, 'Physics', 'cse123'),
(2, 'Chemistry', 'cse124'),
(3, 'BIO', 'cse125'),
(4, 'Pakistan Studies', 'cse126'),
(5, 'ICP', 'cse127'),
(6, 'Stats', 'cse128'),
(7, 'Linear Algebra', 'cse129'),
(8, 'Web Engg', 'cse130');

-- --------------------------------------------------------

--
-- Table structure for table `courseinstructor`
--

DROP TABLE IF EXISTS `courseinstructor`;
CREATE TABLE IF NOT EXISTS `courseinstructor` (
  `cId` int(11) NOT NULL,
  `fId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  PRIMARY KEY (`cId`,`fId`),
  KEY `fId` (`fId`),
  KEY `sectionId` (`sectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseinstructor`
--

INSERT INTO `courseinstructor` (`cId`, `fId`, `sectionId`) VALUES
(2, 1, 1),
(4, 1, 2),
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dropped`
--

DROP TABLE IF EXISTS `dropped`;
CREATE TABLE IF NOT EXISTS `dropped` (
  `sId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  KEY `cId` (`cId`),
  KEY `sectionId` (`sectionId`),
  KEY `sId` (`sId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

DROP TABLE IF EXISTS `enrolled`;
CREATE TABLE IF NOT EXISTS `enrolled` (
  `sid` int(20) NOT NULL AUTO_INCREMENT,
  `cid` int(20) NOT NULL,
  `sectionId` int(11) NOT NULL,
  KEY `sid` (`sid`,`cid`),
  KEY `cid` (`cid`),
  KEY `sectionId` (`sectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`sid`, `cid`, `sectionId`) VALUES
(1, 4, 2),
(2, 4, 2),
(4, 4, 2),
(5, 4, 2),
(5, 1, 4),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `fId` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(45) NOT NULL,
  `qualification` varchar(45) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` varchar(16) NOT NULL,
  PRIMARY KEY (`fId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fId`, `name`, `dob`, `gender`, `qualification`, `email`, `password`, `phone`) VALUES
(1, 'Shaukat Iqbaal', '1997-03-01', 'Male', 'PHD Physics', 'shaukat.iqbal3001@gmail.com', '12345', '03319167177');

-- --------------------------------------------------------

--
-- Table structure for table `facultyattendance`
--

DROP TABLE IF EXISTS `facultyattendance`;
CREATE TABLE IF NOT EXISTS `facultyattendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fId` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facultyId` (`fId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facultyattendance`
--

INSERT INTO `facultyattendance` (`id`, `fId`, `date`, `status`) VALUES
(1, 1, '2019-12-02', 1),
(2, 1, '2019-12-03', 1),
(3, 1, '2019-12-04', 1),
(4, 1, '2019-12-05', 1),
(5, 1, '2019-12-06', 1),
(6, 1, '2019-12-07', 1),
(7, 1, '2019-12-08', 1),
(8, 1, '2019-12-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `cId` int(11) NOT NULL,
  `sId` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  PRIMARY KEY (`cId`,`sId`),
  KEY `sId` (`sId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`cId`, `sId`, `marks`) VALUES
(1, 4, 80),
(1, 5, 56),
(4, 1, 78),
(4, 2, 92),
(4, 4, 30),
(4, 5, 47);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `sectionId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`sectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionId`, `name`) VALUES
(1, 'BSEIA'),
(2, 'BSEIIA'),
(3, 'BSEIIIA'),
(4, 'BSEIB');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `sid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(16) NOT NULL,
  `emergencyNo` varchar(16) NOT NULL,
  `activities` text,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `name`, `email`, `address`, `phone`, `emergencyNo`, `activities`) VALUES
(1, 'Waji Awan', 'waji@g.com', 'v&po Akwal', '03125954426', '03319167177', 'Cricket'),
(2, 'Malik Jalal', 'jalal@g.com', 'Park road Islamabad', '03125954426', '03319167177', 'Cricket'),
(3, 'Makki Anjum', 'makki@g.com', 'hvfja yha jygvdha uygws dhdbh hhgbia', '82347827442', '87462746876', 'jshdhs,jhagdajsg'),
(4, 'Hamza Shahid', 'hamza@g.com', 'hvfja yha jygvdha uygws dhdbh hhgbia', '82347827442', '87462746876', 'jshdhs,jhagdajsg'),
(5, 'Ammar Azed', 'ammarAzed@g.com', 'hvfja yha jygvdha uygws dhdbh hhgbia', '82347827442', '87462746876', 'jshdhs,jhagdajsg'),
(6, 'Waleed Haider', 'waleedHaider@g.com', 'hvfja yha jygvdha uygws dhdbh hhgbia', '82347827442', '87462746876', 'jshdhs,jhagdajsg');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

DROP TABLE IF EXISTS `timetable`;
CREATE TABLE IF NOT EXISTS `timetable` (
  `fId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `day` varchar(256) NOT NULL,
  `time` varchar(256) NOT NULL,
  `sectionId` int(11) NOT NULL,
  PRIMARY KEY (`fId`,`cId`,`day`) USING BTREE,
  KEY `cId` (`cId`),
  KEY `sectionId` (`sectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`fId`, `cId`, `day`, `time`, `sectionId`) VALUES
(1, 1, 'Fri', '11:30', 4),
(1, 2, 'Fri', '10:00', 1),
(1, 2, 'Mon', '10:00', 1),
(1, 4, 'Thu', '08:30', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `courseId` FOREIGN KEY (`cId`) REFERENCES `course` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentId` FOREIGN KEY (`sId`) REFERENCES `student` (`sid`);

--
-- Constraints for table `courseinstructor`
--
ALTER TABLE `courseinstructor`
  ADD CONSTRAINT `courseinstructor_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `course` (`cid`),
  ADD CONSTRAINT `courseinstructor_ibfk_2` FOREIGN KEY (`fId`) REFERENCES `faculty` (`fId`),
  ADD CONSTRAINT `courseinstructor_ibfk_3` FOREIGN KEY (`sectionId`) REFERENCES `section` (`sectionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dropped`
--
ALTER TABLE `dropped`
  ADD CONSTRAINT `dropped_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `course` (`cid`),
  ADD CONSTRAINT `dropped_ibfk_2` FOREIGN KEY (`sectionId`) REFERENCES `section` (`sectionId`),
  ADD CONSTRAINT `dropped_ibfk_3` FOREIGN KEY (`sId`) REFERENCES `student` (`sid`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolled_ibfk_3` FOREIGN KEY (`sectionId`) REFERENCES `section` (`sectionId`);

--
-- Constraints for table `facultyattendance`
--
ALTER TABLE `facultyattendance`
  ADD CONSTRAINT `facultyId` FOREIGN KEY (`fId`) REFERENCES `faculty` (`fId`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `course` (`cid`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`sId`) REFERENCES `student` (`sid`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `course` (`cid`),
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`fId`) REFERENCES `faculty` (`fId`),
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`sectionId`) REFERENCES `section` (`sectionId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
