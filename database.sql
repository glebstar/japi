SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `test_task` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_task`;

CREATE TABLE IF NOT EXISTS `News` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParticipantId` int(11) NOT NULL,
  `NewsTitle` varchar(255) NOT NULL,
  `NewsMessage` text NOT NULL,
  `LikesCounter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `News` (`ID`, `ParticipantId`, `NewsTitle`, `NewsMessage`, `LikesCounter`) VALUES
(1, 1, 'New agenda!', 'Please visit our site!', 0);

CREATE TABLE IF NOT EXISTS `Participant` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `Participant` (`ID`, `Email`, `Name`) VALUES
(1, 'user@example.com', 'The first user'),
(2, 'user2@example.com', ''),
(3, 'user3@example.com', ''),
(4, 'user4@example.com', '');

CREATE TABLE IF NOT EXISTS `Session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `TimeOfEvent` datetime NOT NULL,
  `Seats` int(2) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `Session` (`ID`, `Name`, `TimeOfEvent`, `Seats`, `Description`) VALUES
(1, 'The first', '2018-08-20 20:00', 3, 'The first session');

CREATE TABLE IF NOT EXISTS `SessionUser` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SessionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `Speaker` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `Speaker` (`ID`, `Name`) VALUES
(1, 'Watson'),
(2, 'Arnold');
