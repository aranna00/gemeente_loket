-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2014 at 10:33 PM
-- Server version: 5.5.37
-- PHP Version: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gemeente`
--

-- --------------------------------------------------------

--
-- Table structure for table `afspraken`
--

CREATE TABLE IF NOT EXISTS `afspraken` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) NOT NULL,
  `USER` varchar(20) NOT NULL,
  `ANSWER_ID` int(10) NOT NULL,
  `REDEN` varchar(255) NOT NULL,
  `DATUM` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `afspraken`
--

INSERT INTO `afspraken` (`ID`, `USER_ID`, `USER`, `ANSWER_ID`, `REDEN`, `DATUM`) VALUES
(2, 10, 'aran', 0, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anwser`
--

CREATE TABLE IF NOT EXISTS `anwser` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ANSWER` int(10) NOT NULL,
  `ID_KAP` int(10) NOT NULL,
  `ID_AFSPRAAK` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapvergunning`
--

CREATE TABLE IF NOT EXISTS `kapvergunning` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `USER` varchar(25) NOT NULL,
  `USER_ID` int(10) NOT NULL,
  `CONFIRMED` tinyint(1) NOT NULL DEFAULT '0',
  `ACCEPTED` tinyint(1) NOT NULL DEFAULT '0',
  `ANSWER_ID` int(10) NOT NULL,
  `SPOED` tinyint(1) NOT NULL DEFAULT '0',
  `COMMENT` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `ANSWER_ID` (`ANSWER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kapvergunning`
--

INSERT INTO `kapvergunning` (`ID`, `USER`, `USER_ID`, `CONFIRMED`, `ACCEPTED`, `ANSWER_ID`, `SPOED`, `COMMENT`) VALUES
(1, 'aran', 10, 0, 0, 0, 0, 'test'),
(4, 'aran', 10, 0, 0, 0, 0, 'testuing'),
(5, 'aran', 10, 0, 0, 0, 0, 'blargh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL,
  `password` varchar(512) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `email_code` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `confirmed` int(11) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `role` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `email_code`, `time`, `confirmed`, `ip`, `role`) VALUES
(8, 'testing', '79956d0a39dfd622a928898337faa5dccc559f467f5c4f1c61e3022ba978c3c9e72b75c7c73156bddc07b0dfc2f458a14228e9bdd1eec012f13556583196a986', 'testing@test.test', '0374548c51060f5efb8fbfe58d0df65200d3fd0e', 1394536754, 1, '::1', 'user'),
(10, 'aran', '2389dd1eaf68866b6bd6308930fb908cd7ef2590550c25f0d0b1e1d0b284b772f0618702a5d7694dddc219768c1d7006a814756c902693bc74a3192b3a8e4231', 'aranna00@gmail.com', '98b178eb30206fe0529ff07395b4a2c303eaf652', 1396519578, 1, '::1', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kapvergunning`
--
ALTER TABLE `kapvergunning`
  ADD CONSTRAINT `kapvergunning_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
