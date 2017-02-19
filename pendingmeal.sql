-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2017 at 07:41 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pendingmeal`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactdetail`
--

CREATE TABLE IF NOT EXISTS `contactdetail` (
  `contactDetailID` varchar(16) NOT NULL,
  `userID` varchar(16) NOT NULL,
  `contactNumber` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactdetail`
--

INSERT INTO `contactdetail` (`contactDetailID`, `userID`, `contactNumber`) VALUES
('1-1', '1', '09123456789');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE IF NOT EXISTS `meal` (
`mealID` int(11) NOT NULL,
  `restaurantID` varchar(16) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`mealID`, `restaurantID`, `description`, `price`) VALUES
(0, 'rest1', 'Pepperoni Pizza', 420);

-- --------------------------------------------------------

--
-- Table structure for table `paymentoption`
--

CREATE TABLE IF NOT EXISTS `paymentoption` (
  `userID` varchar(16) NOT NULL,
  `paymentType` varchar(10) NOT NULL,
  `accountID` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentoption`
--

INSERT INTO `paymentoption` (`userID`, `paymentType`, `accountID`) VALUES
('1', 'DRAGONPAY', '4940393032'),
('1', 'PAYMAYA', '39203-482032'),
('1', 'PAYPAL', '34039294031');

-- --------------------------------------------------------

--
-- Table structure for table `pendingorder`
--

CREATE TABLE IF NOT EXISTS `pendingorder` (
`orderNo` int(11) NOT NULL,
  `userID` varchar(16) NOT NULL,
  `mealName` varchar(16) NOT NULL,
  `restaurantID` varchar(32) NOT NULL,
  `paymentType` varchar(16) NOT NULL,
  `contactDetailID` varchar(16) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pendingorder`
--

INSERT INTO `pendingorder` (`orderNo`, `userID`, `mealName`, `restaurantID`, `paymentType`, `contactDetailID`, `quantity`, `totalPrice`, `date`, `status`) VALUES
(0, '1', 'Pepperoni Pizza', 'rest1', 'CASH', '1-1', 3, 420, '2017-02-01', 0),
(0, '1', 'Pepperoni Pizza', 'rest1', 'PAYMAYA', '1-1', 2, 840, '2017-02-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
`restaurantID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `address` varchar(128) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurantID`, `name`, `address`, `userID`) VALUES
(1, 'Shakey''s Pizza', 'Harrison Plaze, Malate, Manila City', 0),
(2, 'Pizza Hut', 'Robinson''s Place, Ermita, Manila City', 0),
(3, 'Greenwich Pizza', 'Harrison, Plaze, Malate, Manila City', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `name`, `type`, `email`) VALUES
(1, 'graham', 'deadhorses', 'Joshua Graham', 0, 'downwithcaesar@yahoo.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactdetail`
--
ALTER TABLE `contactdetail`
 ADD PRIMARY KEY (`contactDetailID`,`userID`), ADD KEY `userID` (`userID`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
 ADD PRIMARY KEY (`mealID`,`restaurantID`);

--
-- Indexes for table `paymentoption`
--
ALTER TABLE `paymentoption`
 ADD PRIMARY KEY (`userID`,`paymentType`);

--
-- Indexes for table `pendingorder`
--
ALTER TABLE `pendingorder`
 ADD PRIMARY KEY (`orderNo`,`paymentType`,`contactDetailID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
 ADD PRIMARY KEY (`restaurantID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userID`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
MODIFY `mealID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pendingorder`
--
ALTER TABLE `pendingorder`
MODIFY `orderNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
MODIFY `restaurantID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
