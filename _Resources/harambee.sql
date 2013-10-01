-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2013 at 04:25 AM
-- Server version: 5.5.30-cll
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `harambee`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `GoalID` int(11) NOT NULL,
  `InReplyToID` int(11) NOT NULL,
  `CommentText` varchar(140) DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentID`),
  KEY `GoalID` (`GoalID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Donation`
--

CREATE TABLE IF NOT EXISTS `Donation` (
  `DonationID` int(11) NOT NULL AUTO_INCREMENT,
  `DonorID` int(11) NOT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `Amount` double NOT NULL,
  `Currency` char(3) NOT NULL DEFAULT 'EUR',
  `GoalID` int(11) NOT NULL,
  `CommentID` int(11) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateDisbursed` datetime DEFAULT NULL,
  PRIMARY KEY (`DonationID`),
  KEY `DonorID` (`DonorID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Donation`
--

INSERT INTO `Donation` (`DonationID`, `DonorID`, `PaymentID`, `Amount`, `Currency`, `GoalID`, `CommentID`, `DateCreated`, `DateDisbursed`) VALUES
(1, 1, NULL, 20, 'GBP', 1, NULL, '2011-05-12 18:47:12', NULL),
(2, 1, NULL, 30, 'GBP', 2, NULL, '2011-05-12 18:47:12', NULL),
(3, 1, NULL, 9.8, 'GBP', 1, NULL, '2011-05-12 22:41:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Goal`
--

CREATE TABLE IF NOT EXISTS `Goal` (
  `GoalID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `GoalAmount` double NOT NULL,
  `GoalCurrency` char(3) NOT NULL DEFAULT 'EUR',
  `DateCreated` date NOT NULL,
  `DateDeadline` datetime NOT NULL,
  `Featured` tinyint(1) NOT NULL,
  `Status` enum('collecting','funded','closed') NOT NULL DEFAULT 'collecting',
  PRIMARY KEY (`GoalID`),
  KEY `ProjectID` (`ProjectID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Goal`
--

INSERT INTO `Goal` (`GoalID`, `Name`, `Description`, `ProjectID`, `GoalAmount`, `GoalCurrency`, `DateCreated`, `DateDeadline`, `Featured`, `Status`) VALUES
(1, 'Coffee machine for Harambee coders', 'To purchase and install a filter coffee machine for the Harambee development team', 1, 29.99, 'GBP', '2011-05-05', '2011-06-05 16:17:53', 0, 'collecting'),
(2, 'Coffee Beans', 'A fund to keep our programmers in freshly ground Sacarello Sabroso coffee for one year', 1, 120, 'GBP', '2011-05-06', '2011-06-06 15:57:10', 1, 'collecting'),
(3, 'Columbia Visit', 'A trip for one of our programmers to Columbia to become acquainted with Fair Trade coffee production in that country, so as to be better informed when purchasing coffee for the Test Org organisation', 1, 1272, 'GBP', '2011-05-18', '2011-09-30 14:31:57', 0, 'collecting'),
(4, 'Raw Materials', 'We have a quotations from local hardware and building suppliers for the raw materials required, including delivery to the site.', 2, 800, 'EUR', '2011-05-19', '2011-08-01 12:28:34', 0, 'collecting');

-- --------------------------------------------------------

--
-- Table structure for table `Organisation`
--

CREATE TABLE IF NOT EXISTS `Organisation` (
  `OrgID` int(11) NOT NULL AUTO_INCREMENT,
  `ProfileID` int(11) NOT NULL,
  `OrgType` enum('GovtOrganisation','NGO','Corporation','PerformingGroup','SportsTeam') DEFAULT NULL,
  `Status` enum('active','pending','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`OrgID`),
  KEY `ProfileID` (`ProfileID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Organisation`
--

INSERT INTO `Organisation` (`OrgID`, `ProfileID`, `OrgType`, `Status`) VALUES
(1, 2, NULL, 'active'),
(2, 7, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `ProfileID` int(11) NOT NULL AUTO_INCREMENT,
  `ProfileType` enum('org','proj','user') NOT NULL DEFAULT 'user',
  `Name` varchar(60) NOT NULL,
  `Surname` varchar(60) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateFounded` date DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `City` varchar(60) NOT NULL,
  `Country` varchar(60) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ProfileID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Profile`
--

INSERT INTO `Profile` (`ProfileID`, `ProfileType`, `Name`, `Surname`, `Email`, `DateAdded`, `DateFounded`, `Address`, `City`, `Country`, `Description`, `Avatar`) VALUES
(1, 'user', 'Pete', 'Boucher', 'petebouch@gmail.com', '2011-05-05 20:17:20', NULL, 'Calle Los Naranjos 66, El Secadero, Casares, 29690', 'Malaga', 'Spain', ' ', NULL),
(2, 'org', 'Test Organisation', NULL, 'petebouch@testorg.org', '2011-05-05 22:03:12', '2011-05-05', 'Suite 8, First Floor, Leon House, 1 Secretarys Ln', 'Gibraltar', 'Gibraltar', 'A test organisation to benefit developers while evaluating code.', NULL),
(3, 'proj', 'Coffee for coders', NULL, 'coffee@testorg.org', '2011-05-05 22:14:54', '2011-05-05', NULL, 'Gibraltar', 'Gibraltar', 'To improve the accessibility of programmers to a reliable supply of fresh, hot coffee', 'http://mediumtall.files.wordpress.com/2008/03/coffee-skull.jpg'),
(7, 'org', 'ANCRAA', 'Asociacion National De Criadores De La Raza Asnal Andaluza', 'info@ancraa.org', '2011-05-19 17:39:41', '2003-01-01', 'ANCRAA, Aptdo No 32, Estepona, 29680, Malaga, Spain.', 'Estepona', 'Spain', 'This is the National Association of Breeders of the Andaluz Donkey, or in Spanish, Asociacion Nacional de Criadores de la Raza Asnal Andaluza. This particular breed of donkey is in danger of extinction as recognized by the Ministry of Agriculture and Fisheries in year 2001. The above association ANC', 'http://ancraa.org/face.jpg'),
(8, 'proj', 'Donkey Shelter', NULL, 'info@ancraa.org', '2011-05-19 17:57:50', NULL, NULL, 'Estepona', 'Spain', 'A new structure needs to be built to protect the animals from the hot sun in the summer and rain in winter.', 'http://images1.hellotrade.com/data2/CI/EY/HELLOTD-1796053/bbq_shelter-250x250.jpg'),
(10, 'proj', 'Transparency in Africa', NULL, 'transparency@test.org', '2011-05-20 22:19:33', '2011-05-20', 'Suite 8, First Floor, Leon House, 1 Secretarys Ln', 'Gibraltar', 'Gibraltar', 'To hi-light corruption in all levels of life in Africa and raise awareness for transparency in business and government.', 'http://img2.allvoices.com/thumbs/event/900/570/69203402-transparency-international.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE IF NOT EXISTS `Project` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgID` int(11) NOT NULL,
  `ProfileID` int(11) NOT NULL,
  `Category` enum('Health','Wildlife','Development','Peace') NOT NULL,
  `ProjectLastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` enum('active','pending','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`ProjectID`),
  KEY `ProfileID` (`ProfileID`),
  KEY `OrgID` (`OrgID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`ProjectID`, `OrgID`, `ProfileID`, `Category`, `ProjectLastUpdate`, `Status`) VALUES
(1, 1, 3, 'Health', '2011-05-05 23:16:12', 'active'),
(2, 2, 8, 'Wildlife', '0000-00-00 00:00:00', 'active'),
(3, 1, 10, 'Development', '2011-05-20 22:20:25', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ProjectOfficer`
--

CREATE TABLE IF NOT EXISTS `ProjectOfficer` (
  `UserID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `OfficerType` enum('employee','founder','board_member','director','executive_director') NOT NULL DEFAULT 'employee',
  `DateAssigned` datetime NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ProjectID` (`ProjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ProjectOfficer`
--

INSERT INTO `ProjectOfficer` (`UserID`, `ProjectID`, `OfficerType`, `DateAssigned`) VALUES
(1, 1, 'employee', '2011-05-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgID` int(11) DEFAULT NULL,
  `ProfileID` int(11) NOT NULL,
  `Status` enum('active','deleted') NOT NULL,
  `LastLogin` datetime NOT NULL,
  `Password` char(40) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `OrgID`, `ProfileID`, `Status`, `LastLogin`, `Password`) VALUES
(1, NULL, 1, 'active', '0000-00-00 00:00:00', 'crusader');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
