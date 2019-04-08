-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2019 at 10:16 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slm`
--

-- --------------------------------------------------------

--
-- Table structure for table `leavealternate`
--

CREATE TABLE IF NOT EXISTS `leavealternate` (
`leave_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `leave_day` varchar(255) NOT NULL,
  `leave_day_type` varchar(255) NOT NULL,
  `day_peroid` int(11) NOT NULL,
  `leave_start_date` date NOT NULL,
  `leave_end_date` date NOT NULL,
  `document` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `accept_faculty_id` int(11) NOT NULL,
  `accept_hod_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leavealternate`
--

INSERT INTO `leavealternate` (`leave_id`, `faculty_id`, `leave_type`, `leave_day`, `leave_day_type`, `day_peroid`, `leave_start_date`, `leave_end_date`, `document`, `message`, `accept_faculty_id`, `accept_hod_id`, `status`) VALUES
(1, 1, 'Function', 'Monday', '', 2, '2019-04-08', '2019-04-11', '', 'hello', 2, 1, 1),
(2, 1, 'Function', 'Monday', '', 2, '2019-04-08', '2019-04-11', '', 'hello', 0, 0, 0),
(4, 1, 'Function', 'Monday', 'Half day', 2, '2019-04-08', '2019-04-11', '', 'hello', 0, 0, 0),
(5, 1, 'Function', 'Monday', 'Half day', 2, '2019-04-08', '2019-04-11', '', 'hello', 0, 0, 0),
(6, 2, 'Seek leave', 'Monday', 'Half day', 0, '2019-04-11', '2019-04-13', '0ca7ea8028f74395122e50cfe81a930f0e1945e4.png', 'my first leave', 0, 0, 0),
(7, 2, 'Seek leave', 'Monday', 'Half day', 0, '2019-04-11', '2019-04-13', '6c1f032387f0a98087296b31260d3bf495b4355b.png', 'my first leave', 0, 0, 0),
(8, 2, 'Seek leave', 'Monday', 'Half day', 0, '2019-04-11', '2019-04-13', '69d27761016284465a94c4a8cf377c5cad059e64.png', 'my first leave', 0, 0, 0),
(9, 2, 'Seek leave', 'Monday', 'Half day', 0, '2019-04-11', '2019-04-13', '', 'my first leave', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`login_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `name`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reg_faculty`
--

CREATE TABLE IF NOT EXISTS `reg_faculty` (
`fac_id` int(11) NOT NULL,
  `fac_name` varchar(255) NOT NULL,
  `fac_dob` date NOT NULL,
  `fac_doj` date NOT NULL,
  `fac_address` varchar(255) NOT NULL,
  `fac_password` varchar(25) NOT NULL,
  `fac_email` varchar(255) NOT NULL,
  `fac_mobile` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_faculty`
--

INSERT INTO `reg_faculty` (`fac_id`, `fac_name`, `fac_dob`, `fac_doj`, `fac_address`, `fac_password`, `fac_email`, `fac_mobile`) VALUES
(1, 'Hardik', '1988-09-02', '2009-06-02', 'Vasna', '12345', 'hardik.n.talsania@gmail.com', 99988812236),
(2, 'Krish Shah', '1972-04-07', '2018-04-06', 'Ahmedabad', '123', 'krish@gmail.com', 1234567980);

-- --------------------------------------------------------

--
-- Table structure for table `reg_hod`
--

CREATE TABLE IF NOT EXISTS `reg_hod` (
`hod_id` int(11) NOT NULL,
  `hod_name` varchar(255) NOT NULL,
  `hod_email` varchar(255) NOT NULL,
  `hod_password` varchar(25) NOT NULL,
  `hod_address` varchar(255) NOT NULL,
  `hod_mobile` bigint(20) NOT NULL,
  `hod_dob` date NOT NULL,
  `hod_doj` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_hod`
--

INSERT INTO `reg_hod` (`hod_id`, `hod_name`, `hod_email`, `hod_password`, `hod_address`, `hod_mobile`, `hod_dob`, `hod_doj`) VALUES
(1, 'Hardik', 'hardik.n.talsania@gmail.com', '12345', 'Vasna', 99988812236, '1988-09-02', '2009-06-02'),
(2, 'Jayesh patel', 'jp@gmail.com', '123', 'Ahmedabad', 1236548790, '1921-04-03', '1990-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`subject_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `semester`, `sub_name`) VALUES
(1, 1, 'Programming of C'),
(2, 3, 'Programming of C++'),
(3, 1, 'Programming of C'),
(4, 2, 'java');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
`timetable_id` int(11) NOT NULL,
  `lecture_type` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `class1` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `roomnumber` varchar(255) NOT NULL,
  `batch` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `lecture_type`, `semester`, `class1`, `day`, `time`, `faculty_id`, `subject_id`, `roomnumber`, `batch`) VALUES
(1, 'Leb', '3', 'com1', 'Tuesday', '11:30 -1:30', 1, 1, '101', ''),
(2, 'Leb', '3', 'com1', 'Monday', '11:30 -1:30', 1, 1, '101', 'bk1'),
(3, 'Leb', '3', 'com1', 'Monday', '11:30 -1:30', 1, 1, '101', 'bk1'),
(4, 'Lab', 'Lab', '1', 'Monday', '8 to 9', 2, 4, '203', '1'),
(5, 'Lecture', '1', '1', 'Monday', '8 to 9', 1, 1, '103', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leavealternate`
--
ALTER TABLE `leavealternate`
 ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `reg_faculty`
--
ALTER TABLE `reg_faculty`
 ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `reg_hod`
--
ALTER TABLE `reg_hod`
 ADD PRIMARY KEY (`hod_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
 ADD PRIMARY KEY (`timetable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leavealternate`
--
ALTER TABLE `leavealternate`
MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reg_faculty`
--
ALTER TABLE `reg_faculty`
MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reg_hod`
--
ALTER TABLE `reg_hod`
MODIFY `hod_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
