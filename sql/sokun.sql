-- ---------------------------------------------------
-- sokun Schema definition
-- 
-- This file is part of sokun.
-- 
--  sokun is free software: you can redistribute it and/or modify
--  it under the terms of the GNU General Public License as published by
--  the Free Software Foundation, either version 3 of the License, or
--  (at your option) any later version.
-- 
--  sokun is distributed in the hope that it will be useful,
--  but WITHOUT ANY WARRANTY; without even the implied warranty of
--  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
--  GNU General Public License for more details.
-- 
--  You should have received a copy of the GNU General Public License
--  along with sokun.  If not, see <http://www.gnu.org/licenses/>.
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Structure of table `tests`
--
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `creator` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure of table `steps`
--
CREATE TABLE IF NOT EXISTS `steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` int(11) NOT NULL,
  `ord` INT NOT NULL,
  `name` varchar(1024) NOT NULL,
  `action` text DEFAULT NULL,
  `expected` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test` (`test`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure of table `campaigns`
--
CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `startdate` DATE NULL,
  `enddate` DATE NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure of table `campaigntests`
--
CREATE TABLE IF NOT EXISTS `campaigntests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign` (`campaign`),
  KEY `test` (`test`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure of table `testsexecution`
--
CREATE TABLE IF NOT EXISTS `testexecution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaigntest` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `description` text DEFAULT NULL,
  `executiondate` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `executed_by` int(11) NOT NULL,
  `status` int(11)  NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `creator` (`campaigntest`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure of table `stepsexecution`
--
CREATE TABLE IF NOT EXISTS `stepsexecution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testexecution` int(11) NOT NULL,
  `status` int(11)  NULL DEFAULT '1',
  `ord` INT NOT NULL,
  `name` varchar(1024) NOT NULL,
  `action` text DEFAULT NULL,
  `expected` text DEFAULT NULL,
  `actual` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test` (`testexecution`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure of table `roles`
--
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Content of table `roles`
--
INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Structure of table `status`
--
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Content of table `status`
--
INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Not Run'),
(2, 'Passed'),
(3, 'Failed'),
(4, 'N/A');

--
-- Structure of table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `login` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `language` varchar(2) CHARACTER SET utf8 NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Content of table `users`
--
INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `email`, `password`, `role`, `language`) VALUES
(1, 'Benjamin', 'BALET', 'bbalet', 'benjamin.balet@gmail.com', '$2a$08$LeUbaGFqJjLSAN7to9URsuHB41zcmsMBgBhpZuFp2y2OTxtVcMQ.C', 1, 'en'),
(2, 'John', 'DOE', 'jdoe', 'jdoe@sokun.org', '$2a$08$Vk8FdteT25t.3Q9yU6pZWOCkc3rvXYc5jfV4Wq4b3Tg4WwwomeiJO', 2, 'en');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
