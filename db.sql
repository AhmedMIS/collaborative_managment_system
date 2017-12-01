-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2014 at 05:44 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `working_hours` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `working_hours`, `user_id`, `leave`) VALUES
(2, '2014-09-26', '8', 23, 0),
(3, '2014-10-11', '8', 19, 0),
(4, '2014-10-11', '8', 27, 0),
(5, '2014-10-11', '8', 25, 0),
(6, '2014-10-11', '8', 24, 0),
(7, '2014-10-11', '8', 26, 0),
(8, '2014-10-01', '8', 23, 0),
(9, '2014-10-03', '8', 23, 0),
(11, '2014-10-11', '8', 23, 0),
(12, '2014-10-12', '8', 23, 0),
(13, '2014-10-13', '8', 23, 0),
(14, '2014-11-15', '8', 23, 0),
(15, '2014-11-17', '8', 23, 0),
(16, '2014-11-17', '8', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `dependentid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `title`, `dependentid`, `status`, `created`) VALUES
(1, 'Web Development', 0, 1, '2014-07-28 00:00:00'),
(2, 'Core PHP', 1, 1, '2014-07-28 00:00:00'),
(3, 'Joomla 2', 1, 1, '2014-07-28 00:00:00'),
(4, 'Joomla 3', 1, 1, '2014-07-28 00:00:00'),
(5, 'Drupal', 1, 1, '2014-07-28 00:00:00'),
(6, 'MVC 2', 1, 1, '2014-07-28 00:00:00'),
(7, 'MVC 3', 1, 1, '2014-07-28 00:00:00'),
(8, 'Android', 0, 1, '2014-07-28 00:00:00'),
(9, 'Gamming', 8, 1, '2014-07-28 00:00:00'),
(10, 'Bussiness Apps', 8, 1, '2014-07-28 00:00:00'),
(11, 'Entertainment App', 8, 1, '2014-07-28 00:00:00'),
(12, 'Education Apps', 8, 1, '2014-07-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `callerid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `meetingdate` datetime NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `recevier` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `callerid`, `title`, `meetingdate`, `description`, `status`, `created`, `recevier`) VALUES
(80, 14, 'ajao', '2014-10-06 00:00:00', 'meri tamana', 0, '2014-10-06 10:57:44', '17-22'),
(87, 2, 'ajao', '2014-10-07 00:00:00', 'time se', 1, '2014-10-07 11:38:18', '14'),
(109, 14, 'milo', '2014-10-07 00:00:00', 'han', 2, '2014-10-07 12:03:05', '17-22'),
(110, 14, 'ajao na', '2014-10-07 00:00:00', 'please', 1, '2014-10-07 12:03:38', '23'),
(113, 2, 'aj meeting hai', '2014-10-07 00:00:00', 'oay', 1, '2014-10-07 12:12:11', '16'),
(114, 16, 'i love u', '2014-10-07 00:00:00', 'meri jaaaaaaaaaan', 1, '2014-10-07 12:13:06', '22'),
(115, 16, 'salo kanjro', '2014-10-07 00:00:00', 'kaminey', 1, '2014-10-07 12:13:42', '19-27'),
(116, 2, 'Jaaneman', '2014-10-08 00:00:00', 'Muj se shadi kr lo', 0, '2014-10-08 10:48:07', '16'),
(117, 2, 'Lets have sex', '2014-10-18 00:00:00', 'At my place.', 2, '2014-10-18 12:59:57', '16'),
(118, 14, 'Meet me', '2014-10-23 00:00:00', 'Meri beri k peche', 1, '2014-10-19 11:51:43', '16'),
(119, 14, 'meeting', '2014-10-25 00:00:00', 'aj he ana', 0, '2014-10-25 10:47:42', '24'),
(120, 2, 'come on', '2014-10-28 00:00:00', 'meet', 1, '2014-10-28 17:07:30', '16'),
(121, 2, 'meet me halfway', '2014-11-10 00:00:00', 'ao ge jab tum', 1, '2014-11-10 10:55:43', '14'),
(122, 2, 'tu ne mari entry', '2014-11-20 00:00:00', 'yar dil mein baji ghantiya', 2, '2014-11-11 18:30:59', '15'),
(123, 14, 'meeting hai', '2014-11-25 00:00:00', 'ajana', 0, '2014-11-22 10:49:16', '17'),
(124, 14, 'meet', '2014-11-28 00:00:00', 'me', 0, '2014-11-22 10:56:03', '17'),
(131, 2, 'meet the admin', '2014-11-28 00:00:00', 'bitch', 0, '2014-11-22 11:52:16', 'all'),
(134, 14, 'kahi', '2014-11-27 00:00:00', 'lulu', 0, '2014-11-22 11:59:39', '17');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `detailid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `typeid`, `userid`, `detailid`, `status`, `date`) VALUES
(212, 3, 17, 60, 1, '2014-11-22 10:58:27'),
(213, 4, 14, 64, 1, '2014-11-22 11:07:00'),
(216, 1, 14, 131, 1, '2014-11-22 11:52:16'),
(217, 1, 15, 131, 0, '2014-11-22 11:52:16'),
(218, 1, 16, 131, 0, '2014-11-22 11:52:16'),
(219, 1, 17, 131, 0, '2014-11-22 11:52:16'),
(220, 1, 18, 131, 0, '2014-11-22 11:52:16'),
(221, 1, 19, 131, 0, '2014-11-22 11:52:16'),
(222, 1, 22, 131, 0, '2014-11-22 11:52:16'),
(223, 1, 23, 131, 0, '2014-11-22 11:52:17'),
(224, 1, 24, 131, 0, '2014-11-22 11:52:17'),
(225, 1, 25, 131, 0, '2014-11-22 11:52:17'),
(226, 1, 26, 131, 0, '2014-11-22 11:52:17'),
(227, 1, 27, 131, 0, '2014-11-22 11:52:17'),
(228, 1, 28, 131, 0, '2014-11-22 11:52:17'),
(231, 1, 17, 134, 0, '2014-11-22 11:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `notificationtypes`
--

CREATE TABLE IF NOT EXISTS `notificationtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `notificationtypes`
--

INSERT INTO `notificationtypes` (`id`, `tablename`, `alias`, `details`, `status`) VALUES
(1, 'New Meeting', 'meeting', 'You have a meeting', 1),
(2, 'New Task', 'task', 'You have a task', 1),
(3, 'Task Updated', 'Task Updated', 'Your current task has been updated', 1),
(4, 'Review Task', 'Review Task', 'Review task', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `startingdate` datetime DEFAULT NULL,
  `endingdate` datetime DEFAULT NULL,
  `assigneeid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `fieldid`, `startingdate`, `endingdate`, `assigneeid`, `status`, `created`) VALUES
(1, 'Static Website2', 'This is a static website develop2', 2, '2014-08-01 00:00:00', '2014-08-31 00:00:00', 16, 1, '2014-07-30 00:00:00'),
(2, 'Temple run 3', 'Complete this game as soon as possible.', 9, '2014-08-02 00:00:00', '0000-00-00 00:00:00', 15, 1, '2014-08-01 09:13:14'),
(7, 'TRS', 'Description', 4, '2014-08-21 00:00:00', '2014-08-14 00:00:00', 14, 1, '2014-08-01 13:44:23'),
(10, 'Accounts Management', 'Its very important and essential system for development. So work hard and keep in touch for future details.  ', 6, '2014-09-15 00:00:00', '2014-10-25 00:00:00', 15, 1, '2014-09-01 02:02:03'),
(11, 'APS', 'It is the online web based system that is develop for the University of Gujrat. So it must be complete on due date.', 2, '2014-09-05 00:00:00', '2014-10-31 00:00:00', 14, 1, '2014-09-01 02:07:29'),
(12, 'Project Monitoring App', 'Its your responsibility Wasif Imdad.', 10, '2014-09-09 00:00:00', '2014-09-30 00:00:00', 16, 1, '2014-09-01 02:12:25'),
(13, 'Ali Enterprise App', 'Should work regularly', 5, '2014-09-10 00:00:00', '2014-09-27 00:00:00', 14, 0, '2014-09-01 23:25:04'),
(14, 'ATM App', 'It is very important App for the organization. And Security panel must be develop very very carefully.', 10, '2014-09-05 00:00:00', '2014-11-29 00:00:00', 16, 1, '2014-09-03 16:01:47'),
(15, 'School Management App', 'For DPS School.', 7, '2014-09-04 00:00:00', '2014-10-21 00:00:00', 15, 1, '2014-09-03 16:03:51'),
(16, 'Attendance System', 'There are no details', 2, '2014-09-05 00:00:00', '2014-10-04 00:00:00', 14, 1, '2014-09-06 07:24:44'),
(17, 'B2B App', 'Its an App for software House.', 2, '2014-09-10 00:00:00', '2014-10-31 00:00:00', 14, 1, '2014-09-07 01:57:36'),
(18, 'Bussiness App', 'It would be complete on time.', 10, '2014-09-27 00:00:00', '2014-10-31 00:00:00', 16, 1, '2014-09-07 22:47:33'),
(19, 'Online Shoping Website', 'Its the website for Webster College Kamoke.', 4, '2014-09-13 00:00:00', '2014-09-30 00:00:00', 16, 1, '2014-09-12 20:15:42'),
(21, 'Hassan Enterprise', 'ABCD', 11, '2014-09-30 00:00:00', '2014-10-31 00:00:00', 15, 0, '2014-09-30 10:25:08'),
(22, 'Online Sex Education', 'Sex education at its best.', 12, '2014-10-18 00:00:00', '2014-10-24 00:00:00', 15, 1, '2014-10-18 09:40:19'),
(24, 'naya project', 'brand new', 2, '2014-11-19 00:00:00', '2014-11-20 00:00:00', 14, 1, '2014-11-18 07:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `status`, `created`) VALUES
(1, 'Designer', 1, '2014-07-26 00:00:00'),
(2, 'Coder', 1, '2014-07-26 00:00:00'),
(3, 'Tester', 1, '2014-08-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `taskcomments`
--

CREATE TABLE IF NOT EXISTS `taskcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `comment_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `taskcomments`
--

INSERT INTO `taskcomments` (`id`, `taskid`, `userid`, `comment`, `comment_time`) VALUES
(5, 60, 14, 'okay', '2014-10-28 16:49:22'),
(6, 61, 14, 'theek hai', '2014-11-01 14:15:09'),
(7, 61, 14, 'new comment', '2014-11-01 14:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `projectid` int(11) NOT NULL,
  `assigneeid` int(11) NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `startingdate` datetime DEFAULT NULL,
  `endingdate` datetime DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `projectid`, `assigneeid`, `filename`, `startingdate`, `endingdate`, `description`, `status`, `created`) VALUES
(58, 'Kamran Task', 15, 39, '../data/projects/School Management App/Kamran Task', '2014-10-03 00:00:00', NULL, 'test', 0, '2014-10-03 17:15:14'),
(60, 'mera task', 21, 56, '../data/projects/Hassan Enterprise/mera task', '2014-10-07 00:00:00', NULL, 'testis', 2, '2014-10-04 09:08:46'),
(61, 'Shoaib Task 1', 11, 55, '../data/projects/APS/Shoaib Task 1', '2014-10-05 00:00:00', NULL, 'test', 2, '2014-10-05 07:08:51'),
(63, 'New title', 7, 31, '../data/projects/TRS/New title', '2014-10-19 00:00:00', NULL, 'New Details', 2, '2014-10-19 10:00:27'),
(64, 'attendance', 16, 56, '../data/projects/Attendance System/attendance', '2014-10-28 00:00:00', NULL, 'kuch nai', 1, '2014-10-28 15:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE IF NOT EXISTS `teammembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `teammembers`
--

INSERT INTO `teammembers` (`id`, `teamid`, `userid`, `roleid`, `status`, `created`) VALUES
(6, 2, 18, 2, 1, '2014-08-19 05:38:17'),
(7, 3, 23, 2, 1, '2014-08-19 05:38:17'),
(8, 3, 17, 3, 1, '2014-08-19 05:38:17'),
(9, 2, 20, 1, 1, '2014-08-19 05:38:17'),
(10, 2, 19, 1, 1, '2014-08-19 05:38:17'),
(15, 1, 25, 1, 1, '2014-08-21 00:45:15'),
(16, 6, 24, 2, 1, '2014-08-21 00:45:15'),
(17, 6, 28, 3, 1, '2014-08-21 00:45:15'),
(18, 1, 27, 1, 1, '2014-08-21 00:45:15'),
(19, 1, 26, 3, 1, '2014-08-21 00:45:15'),
(24, 5, 25, 3, 1, '2014-08-21 04:03:33'),
(25, 5, 24, 2, 1, '2014-08-21 04:03:33'),
(26, 5, 23, 2, 1, '2014-08-21 04:03:33'),
(30, 7, 17, 1, 1, '2014-09-01 00:07:16'),
(31, 7, 18, 2, 1, '2014-09-01 00:07:16'),
(32, 7, 19, 3, 1, '2014-09-01 00:07:16'),
(35, 8, 22, 2, 1, '2014-09-01 02:48:05'),
(36, 9, 23, 3, 1, '2014-09-03 16:15:29'),
(37, 9, 24, 1, 1, '2014-09-03 16:15:29'),
(38, 9, 25, 2, 1, '2014-09-03 16:15:29'),
(39, 10, 28, 3, 1, '2014-09-03 16:17:20'),
(40, 10, 27, 2, 1, '2014-09-03 16:17:20'),
(41, 10, 26, 1, 1, '2014-09-03 16:17:20'),
(46, 12, 17, 1, 1, '2014-09-03 16:34:48'),
(47, 12, 23, 3, 1, '2014-09-03 16:34:48'),
(48, 12, 24, 2, 1, '2014-09-03 16:34:48'),
(49, 13, 19, 2, 1, '2014-09-03 16:37:04'),
(50, 13, 28, 3, 1, '2014-09-03 16:37:04'),
(51, 13, 27, 1, 1, '2014-09-03 16:37:04'),
(52, 14, 19, 2, 1, '2014-09-03 16:37:56'),
(53, 14, 28, 3, 1, '2014-09-03 16:37:56'),
(54, 14, 27, 1, 1, '2014-09-03 16:37:56'),
(55, 15, 23, 3, 1, '2014-09-07 02:03:40'),
(56, 15, 17, 1, 1, '2014-09-07 02:03:40'),
(57, 15, 24, 2, 1, '2014-09-07 02:03:40'),
(58, 15, 22, 2, 1, '2014-09-07 02:03:40'),
(59, 16, 27, 3, 1, '2014-09-07 22:50:31'),
(60, 16, 27, 1, 1, '2014-09-07 22:50:31'),
(61, 16, 28, 1, 1, '2014-09-07 22:50:31'),
(62, 22, 19, 1, 1, '2014-10-13 09:09:35'),
(63, 22, 19, 2, 1, '2014-10-13 09:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `pmid` int(11) NOT NULL,
  `leaderid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `title`, `pmid`, `leaderid`, `status`, `created`) VALUES
(1, 'Zain group', 15, 25, 1, '2014-08-18 00:00:00'),
(2, 'joomla developers1', 16, 19, 1, '2014-08-20 05:38:17'),
(3, 'Waqar group', 15, 26, 1, '2014-08-19 05:38:17'),
(5, 'ZAin Group joomla', 16, 27, 1, '2014-08-21 03:42:31'),
(6, 'joomla 3 meeting', 15, 25, 1, '2014-08-21 15:15:27'),
(7, 'Red Rose', 14, 24, 1, '2014-09-01 00:03:27'),
(8, 'PMA', 16, 19, 1, '2014-09-01 02:44:32'),
(9, 'Sid Star', 15, 26, 1, '2014-09-03 16:15:29'),
(10, 'Kids', 15, 25, 1, '2014-09-03 16:17:20'),
(12, 'Enterprise', 14, 22, 1, '2014-09-03 16:34:48'),
(13, 'ATM', 16, 27, 1, '2014-09-03 16:37:04'),
(14, 'PMA', 16, 19, 1, '2014-09-03 16:37:56'),
(15, 'B2B Maria', 14, 22, 1, '2014-09-07 02:03:40'),
(16, 'Business Team', 16, 28, 1, '2014-09-07 22:50:30'),
(22, 'Wasif Team', 16, 19, 1, '2014-10-13 09:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `userfields`
--

CREATE TABLE IF NOT EXISTS `userfields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `userfields`
--

INSERT INTO `userfields` (`id`, `userid`, `fieldid`, `status`, `created`) VALUES
(16, 4, 2, 1, '2014-08-13 05:19:26'),
(17, 4, 4, 1, '2014-08-13 05:19:26'),
(18, 4, 5, 1, '2014-08-13 05:19:26'),
(24, 7, 2, 1, '2014-08-15 21:19:23'),
(25, 7, 3, 1, '2014-08-15 21:19:23'),
(26, 7, 4, 1, '2014-08-15 21:19:23'),
(27, 7, 6, 1, '2014-08-15 21:19:23'),
(32, 12, 2, 1, '2014-08-18 20:28:20'),
(33, 12, 3, 1, '2014-08-18 20:28:20'),
(34, 12, 4, 1, '2014-08-18 20:28:20'),
(35, 12, 5, 1, '2014-08-18 20:28:20'),
(36, 12, 6, 1, '2014-08-18 20:28:20'),
(42, 3, 3, 1, '2014-08-18 23:24:17'),
(43, 3, 5, 1, '2014-08-18 23:24:17'),
(44, 1, 2, 1, '2014-08-21 00:59:40'),
(47, 9, 3, 1, '2014-08-24 13:45:23'),
(48, 9, 4, 1, '2014-08-24 13:45:23'),
(49, 10, 3, 1, '2014-08-26 11:58:57'),
(50, 10, 4, 1, '2014-08-26 11:58:57'),
(51, 13, 2, 1, '2014-09-01 00:19:42'),
(52, 13, 3, 1, '2014-09-01 00:19:42'),
(53, 13, 4, 1, '2014-09-01 00:19:42'),
(54, 13, 5, 1, '2014-09-01 00:19:42'),
(55, 13, 6, 1, '2014-09-01 00:19:42'),
(58, 15, 6, 1, '2014-09-01 00:48:00'),
(61, 16, 10, 1, '2014-09-01 00:52:37'),
(62, 16, 11, 1, '2014-09-01 00:52:37'),
(63, 17, 9, 1, '2014-09-01 00:59:12'),
(64, 18, 6, 1, '2014-09-01 01:03:08'),
(65, 19, 7, 1, '2014-09-01 01:07:58'),
(66, 19, 10, 1, '2014-09-01 01:07:58'),
(67, 22, 2, 1, '2014-09-03 15:25:37'),
(68, 22, 5, 1, '2014-09-03 15:25:37'),
(69, 23, 4, 1, '2014-09-03 15:28:18'),
(70, 23, 9, 1, '2014-09-03 15:28:18'),
(71, 24, 2, 1, '2014-09-03 15:34:28'),
(72, 24, 3, 1, '2014-09-03 15:34:28'),
(73, 24, 5, 1, '2014-09-03 15:34:28'),
(74, 25, 7, 1, '2014-09-03 15:38:16'),
(75, 25, 11, 1, '2014-09-03 15:38:16'),
(76, 26, 6, 1, '2014-09-03 15:42:13'),
(77, 26, 7, 1, '2014-09-03 15:42:13'),
(78, 27, 6, 1, '2014-09-03 15:46:17'),
(79, 27, 10, 1, '2014-09-03 15:46:17'),
(82, 28, 7, 1, '2014-09-03 16:32:34'),
(83, 28, 12, 1, '2014-09-03 16:32:34'),
(84, 14, 2, 1, '2014-09-09 00:16:38'),
(85, 14, 9, 1, '2014-09-09 00:16:38'),
(91, 32, 2, 1, '2014-10-16 14:19:15'),
(92, 32, 9, 1, '2014-10-16 14:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE IF NOT EXISTS `userroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `userid`, `roleid`, `status`, `created`) VALUES
(7, 7, 1, 1, '2014-08-15 21:19:23'),
(8, 7, 2, 1, '2014-08-15 21:19:23'),
(14, 3, 1, 1, '2014-08-18 23:24:17'),
(15, 1, 1, 1, '2014-08-21 00:59:40'),
(18, 9, 1, 1, '2014-08-24 13:45:23'),
(19, 9, 2, 1, '2014-08-24 13:45:23'),
(20, 13, 1, 1, '2014-09-01 00:19:42'),
(21, 13, 2, 1, '2014-09-01 00:19:42'),
(22, 13, 3, 1, '2014-09-01 00:19:42'),
(24, 15, 2, 1, '2014-09-01 00:48:00'),
(26, 16, 1, 1, '2014-09-01 00:52:37'),
(27, 17, 1, 1, '2014-09-01 00:59:12'),
(28, 18, 3, 1, '2014-09-01 01:03:08'),
(29, 19, 2, 1, '2014-09-01 01:07:58'),
(30, 22, 2, 1, '2014-09-03 15:25:37'),
(31, 23, 3, 1, '2014-09-03 15:28:18'),
(32, 24, 1, 1, '2014-09-03 15:34:28'),
(33, 24, 2, 1, '2014-09-03 15:34:28'),
(34, 25, 1, 1, '2014-09-03 15:38:16'),
(35, 25, 3, 1, '2014-09-03 15:38:16'),
(36, 26, 2, 1, '2014-09-03 15:42:13'),
(37, 27, 1, 1, '2014-09-03 15:46:17'),
(38, 27, 3, 1, '2014-09-03 15:46:17'),
(41, 14, 3, 1, '2014-09-09 00:16:38'),
(45, 28, 1, 1, '2014-09-03 00:00:00'),
(47, 32, 1, 1, '2014-10-16 14:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `qualification` varchar(50) NOT NULL,
  `joiningdate` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype_id` tinyint(4) NOT NULL,
  `pmid` int(11) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `gender`, `nic`, `email`, `phone`, `qualification`, `joiningdate`, `username`, `password`, `usertype_id`, `pmid`, `address`, `status`, `created`) VALUES
(2, 'MUHAMMAD', 'Rizwan', 1, '34102-54678905-4', 'rizwan3319@gmail.com', '03217490063', 'BSCS', '2014-08-31 00:00:00', 'rizwan', '81dc9bdb52d04dc20036dbd8313ed055', 1, 0, 'Muhalla:Islamabad,Street:Shahbaz Virk Wali,Toleky Road Kamoke. ', 1, '2011-01-14 00:00:00'),
(14, 'Shoiab', 'Mushtaq', 1, '34102-39695129-5', 'shebi@gmail.com', '03338136740', 'BSCS', '2014-09-03 00:00:00', 'shoaib', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0, 'Kamonke', 1, '2014-09-01 00:41:22'),
(15, 'MUHAMMAD', 'Kamran', 1, '34102-45205215-6', 'kami@gmial.com', '03333035422', 'BSCS', '2014-09-04 00:00:00', 'kamran', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0, 'Vihari', 1, '2014-09-01 00:48:00'),
(16, 'Wasif', 'Imdad', 1, '34104-45432332-3', 'wasif@hotmail.com', '03002200582', 'Bcs', '2014-09-06 00:00:00', 'wasif', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0, 'Wadala Shoutout', 1, '2014-09-01 00:51:16'),
(17, 'Kashif', 'Baig', 1, '3416-34357432-2', 'kashif@yahoo.com', '0322454774', 'Mcs', '2014-08-31 00:00:00', 'kashif', '81dc9bdb52d04dc20036dbd8313ed055', 3, 14, 'From Kamonke', 1, '2014-09-01 00:59:12'),
(18, 'Rajab', 'Naveed', 1, '34103-35566455-9', 'rajab@uog.edu.pk', '03216490543', 'MIT', '2014-09-08 00:00:00', 'rajab', '81dc9bdb52d04dc20036dbd8313ed055', 3, 15, 'Vihari', 1, '2014-09-01 01:03:08'),
(19, 'Atif', 'Malik', 1, '34106-35434543-4', 'atif@gmail.com', '03335644320', 'MBA', '2014-09-10 00:00:00', 'atif', '81dc9bdb52d04dc20036dbd8313ed055', 3, 16, 'Vihari', 1, '2014-09-01 01:07:58'),
(22, 'Maria', 'Nawaz', 1, '34102-43587131-8', 'maria10@gmail.com', '03218492123', 'BSCS', '2014-10-03 00:00:00', 'maria', '81dc9bdb52d04dc20036dbd8313ed055', 3, 14, 'From Gujrat', 1, '2014-09-03 15:23:43'),
(23, 'Fiza', 'Ashraf', 1, '34102-36542456-9', 'fiza@gmail.com', '03334524452', 'Bcs', '2014-09-01 00:00:00', 'fiza', '81dc9bdb52d04dc20036dbd8313ed055', 3, 14, 'From Kamonke', 1, '2014-09-03 15:27:13'),
(24, 'Hamid', 'Malik', 1, '34102-45343542-9', 'hamid@gmail.com', '03215689324', 'BSSE', '2014-09-02 00:00:00', 'hamid', '81dc9bdb52d04dc20036dbd8313ed055', 3, 14, 'Kamonke', 1, '2014-09-03 15:34:27'),
(25, 'Talha', 'Rana', 1, '34102-34494321-4', 'talha@gmail.com', '03214590832', 'BSCS', '2014-09-03 00:00:00', 'talha', '81dc9bdb52d04dc20036dbd8313ed055', 3, 15, 'Sialkot', 1, '2014-09-03 15:38:16'),
(26, 'Sidra', 'Mumtaz', 0, '34102-43523213-9', 'sidra37@gmail.com', '03224568643', 'BS(CS)', '2014-09-03 00:00:00', 'sidra', '81dc9bdb52d04dc20036dbd8313ed055', 3, 15, 'Vihari', 1, '2014-09-03 15:42:13'),
(27, 'Saima', 'Ashfaq', 0, '34103-45394282-4', 'saima@gmail.com', '03238476087', 'Mcs', '2014-09-03 00:00:00', 'saima', '81dc9bdb52d04dc20036dbd8313ed055', 3, 16, 'Wadala', 1, '2014-09-03 15:46:17'),
(28, 'Zulifqar', 'Rao', 1, '34104-34003185-3', 'zulfi@gmail.com', '03224598507', 'BBA', '2014-09-03 00:00:00', 'zulfi', '81dc9bdb52d04dc20036dbd8313ed055', 3, 16, 'Wadala', 1, '2014-09-03 15:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `foldername` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `title`, `foldername`, `status`) VALUES
(1, 'Administrator', 'admin', 1),
(2, 'Project Manager', 'pm', 1),
(3, 'Developer', 'developer', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
