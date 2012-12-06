-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2012 at 03:07 PM
-- Server version: 5.1.66
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crn` int(11) NOT NULL,
  `school` varchar(5) NOT NULL,
  `coursenumber` int(5) NOT NULL,
  `section` int(2) NOT NULL,
  `coursemeta` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credithours` int(2) NOT NULL,
  `maxseats` int(4) NOT NULL,
  `takenseats` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1762 ;

-- --------------------------------------------------------

--
-- Table structure for table `classtimerelation`
--

CREATE TABLE IF NOT EXISTS `classtimerelation` (
  `classid` int(11) NOT NULL,
  `timeid` int(11) NOT NULL,
  UNIQUE KEY `classid` (`classid`,`timeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -------------------------sd-------------------------------

--
-- Table structure for table `classtimes`
--

CREATE TABLE IF NOT EXISTS `classtimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `instructor` varchar(255) NOT NULL,
  `days` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2098 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `facebookid` bigint(20) NOT NULL,
  `friendid` bigint(20) NOT NULL,
  UNIQUE KEY `friendrelation` (`facebookid`,`friendid`),
  KEY `facebookid` (`facebookid`),
  KEY `friendid` (`friendid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `userid` bigint(20) NOT NULL,
  `classid` int(11) NOT NULL,
  UNIQUE KEY `userid` (`userid`,`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'Gotten from facebook',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
