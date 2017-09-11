-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 01:24 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cps3351`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`paymentID` mediumint(8) unsigned NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentTypeID` tinyint(3) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `amount`, `paymentDate`, `paymentTypeID`) VALUES
(1, '200.00', '2015-11-01', 3),
(2, '600.00', '2015-12-01', 2),
(3, '1200.00', '2015-12-04', 1),
(4, '1000.00', '2015-12-04', 2),
(5, '800.00', '2015-12-07', 2),
(6, '800.00', '2015-12-07', 2),
(7, '600.00', '2015-12-03', 3),
(13, '200.00', '2015-12-06', 2),
(14, '400.00', '2015-12-06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE IF NOT EXISTS `paymenttype` (
`paymentTypeID` tinyint(3) unsigned NOT NULL,
  `paymentMethod` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`paymentTypeID`, `paymentMethod`) VALUES
(1, 'CASH'),
(2, 'CREDIT'),
(3, 'CHECK');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
`reservationID` mediumint(8) unsigned NOT NULL,
  `revDate` date NOT NULL,
  `revTime` time NOT NULL,
  `duration` smallint(6) NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `paymentID` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `revDate`, `revTime`, `duration`, `user_id`, `paymentID`) VALUES
(1, '2015-11-10', '12:00:00', 2, 6, 1),
(2, '2015-12-10', '14:00:00', 3, 6, 2),
(3, '2015-12-08', '10:00:00', 4, 6, 3),
(4, '2015-12-30', '11:00:00', 2, 7, 4),
(5, '2015-12-10', '10:00:00', 2, 6, 5),
(6, '2015-12-11', '12:00:00', 2, 6, 6),
(7, '2015-12-09', '08:00:00', 4, 7, 7),
(11, '2015-12-17', '12:00:00', 2, 6, 13),
(12, '2015-12-25', '13:00:00', 2, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `roomID` mediumint(8) unsigned NOT NULL,
  `maxOccupancy` smallint(6) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `maxOccupancy`, `price`, `description`) VALUES
(100, 100, '500.00', 'Auditorium'),
(111, 15, '150.00', 'Conference Room'),
(200, 60, '400.00', 'Conference Center'),
(300, 12, '100.00', 'Conference Room'),
(400, 20, '300.00', 'Executive Conference Room'),
(500, 35, '200.00', 'Classroom');

-- --------------------------------------------------------

--
-- Table structure for table `room_reservation`
--

CREATE TABLE IF NOT EXISTS `room_reservation` (
  `reservationID` mediumint(8) unsigned NOT NULL,
  `roomID` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_reservation`
--

INSERT INTO `room_reservation` (`reservationID`, `roomID`) VALUES
(1, 300),
(2, 500),
(3, 400),
(4, 100),
(5, 200),
(6, 200),
(7, 111),
(11, 300),
(12, 500);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` mediumint(8) unsigned NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `phone`, `email`, `pass`, `registration_date`, `role`) VALUES
(1, 'Katarina', 'Bastic', '948 Arnet Ave, Union NJ 07083', '908-810-7194', 'kbastic@kean.edu', '011c945f30ce2cbafc452f39840f025693339c42', '2015-09-25 17:23:42', 'admin'),
(2, 'kat', 'bastic', '948 Arnet Ave, Union NJ 07083', '908-810-7194', 'kbastic@kean.edu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2015-10-16 09:56:20', 'admin'),
(3, 'eric', 'nicholas', '1000 Morris Ave, Union, NJ 07083', '908-737-5326', 'ericnicholas@kean.edu', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '2015-10-16 09:59:48', 'admin'),
(4, 'Keanu', 'Reeves', '1000 Hollywood Blv., Los Angeles, CA', '908-555-5555', 'kreeves@kean.edu', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', '2015-11-17 13:06:10', 'CLIENT'),
(5, 'John', 'Smith', '1000 Morris Ave, Union, NJ 0708', '908-810-7194', 'jsmith@kean.edu', 'f56d6351aa71cff0debea014d13525e42036187a', '2015-11-17 13:14:24', 'CLIENT'),
(6, 'Jane', 'Doe', '1000 Morris Ave, Union, NJ 0708', '908-810-7194', 'jdoe@kean.edu', 'd35514736146439b7277437016cdb40d7fb65497', '2015-12-04 10:09:18', 'CLIENT'),
(7, 'Kevin', 'Smith', '1000 Morris Ave., Union NJ 07083', '908-810-7194', 'ksmith@kean.edu', 'ac70803b351199ae7bfe58452f13bb526476fcfe', '2015-12-04 17:28:52', 'CLIENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
 ADD PRIMARY KEY (`paymentTypeID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
 ADD PRIMARY KEY (`reservationID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `room_reservation`
--
ALTER TABLE `room_reservation`
 ADD PRIMARY KEY (`reservationID`,`roomID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `paymentID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
MODIFY `paymentTypeID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
MODIFY `reservationID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
