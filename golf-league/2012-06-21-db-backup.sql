-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 50.63.235.36
-- Generation Time: Jun 21, 2012 at 07:31 AM
-- Server version: 5.0.92
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bcbsscgl`
--
CREATE DATABASE `bcbsscgl` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bcbsscgl`;

-- --------------------------------------------------------

--
-- Table structure for table `activation`
--

CREATE TABLE `activation` (
  `userid` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `record` date NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activation`
--


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `body` varchar(4000) NOT NULL,
  `post_id` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` VALUES(1, 'Windermere');

-- --------------------------------------------------------

--
-- Table structure for table `handicap_history`
--

CREATE TABLE `handicap_history` (
  `id` int(11) NOT NULL auto_increment,
  `playerId` int(11) NOT NULL,
  `handicap` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=326 ;

--
-- Dumping data for table `handicap_history`
--

INSERT INTO `handicap_history` VALUES(1, 7, 9, '2012-05-30');
INSERT INTO `handicap_history` VALUES(2, 10, 6, '2012-05-30');
INSERT INTO `handicap_history` VALUES(3, 12, 2, '2012-05-30');
INSERT INTO `handicap_history` VALUES(4, 4, 7, '2012-05-30');
INSERT INTO `handicap_history` VALUES(5, 33, 13, '2012-05-30');
INSERT INTO `handicap_history` VALUES(6, 15, 11, '2012-05-30');
INSERT INTO `handicap_history` VALUES(7, 16, 10, '2012-05-30');
INSERT INTO `handicap_history` VALUES(8, 18, 7, '2012-05-30');
INSERT INTO `handicap_history` VALUES(9, 20, 12, '2012-05-30');
INSERT INTO `handicap_history` VALUES(10, 14, 14, '2012-05-30');
INSERT INTO `handicap_history` VALUES(11, 22, 15, '2012-05-30');
INSERT INTO `handicap_history` VALUES(12, 24, 10, '2012-05-30');
INSERT INTO `handicap_history` VALUES(13, 25, 14, '2012-05-30');
INSERT INTO `handicap_history` VALUES(14, 21, 20, '2012-05-30');
INSERT INTO `handicap_history` VALUES(15, 35, 12, '2012-05-30');
INSERT INTO `handicap_history` VALUES(16, 31, 17, '2012-05-30');
INSERT INTO `handicap_history` VALUES(17, 5, 8, '2012-05-30');
INSERT INTO `handicap_history` VALUES(18, 39, 18, '2012-05-30');
INSERT INTO `handicap_history` VALUES(19, 28, 11, '2012-05-30');
INSERT INTO `handicap_history` VALUES(20, 30, 12, '2012-05-30');
INSERT INTO `handicap_history` VALUES(21, 19, 15, '2012-05-30');
INSERT INTO `handicap_history` VALUES(22, 17, 13, '2012-05-30');
INSERT INTO `handicap_history` VALUES(23, 26, 25, '2012-05-30');
INSERT INTO `handicap_history` VALUES(24, 6, 19, '2012-05-30');
INSERT INTO `handicap_history` VALUES(25, 32, 10, '2012-05-30');
INSERT INTO `handicap_history` VALUES(26, 37, 19, '2012-05-30');
INSERT INTO `handicap_history` VALUES(27, 8, 16, '2012-05-30');
INSERT INTO `handicap_history` VALUES(28, 11, 16, '2012-05-30');
INSERT INTO `handicap_history` VALUES(29, 34, 7, '2012-05-30');
INSERT INTO `handicap_history` VALUES(30, 36, 13, '2012-05-30');
INSERT INTO `handicap_history` VALUES(31, 3, 21, '2012-05-30');
INSERT INTO `handicap_history` VALUES(32, 27, 18, '2012-05-30');
INSERT INTO `handicap_history` VALUES(33, 13, 22, '2012-05-30');
INSERT INTO `handicap_history` VALUES(34, 29, 14, '2012-05-30');
INSERT INTO `handicap_history` VALUES(35, 23, 19, '2012-05-30');
INSERT INTO `handicap_history` VALUES(36, 38, 6, '2012-05-30');
INSERT INTO `handicap_history` VALUES(37, 44, 18, '2012-05-30');
INSERT INTO `handicap_history` VALUES(38, 2, 0, '2012-05-30');
INSERT INTO `handicap_history` VALUES(39, 52, 14, '2012-05-30');
INSERT INTO `handicap_history` VALUES(40, 43, 8, '2012-05-30');
INSERT INTO `handicap_history` VALUES(41, 47, 10, '2012-05-30');
INSERT INTO `handicap_history` VALUES(42, 49, 8, '2012-05-30');
INSERT INTO `handicap_history` VALUES(43, 53, 16, '2012-05-30');
INSERT INTO `handicap_history` VALUES(44, 55, 22, '2012-05-30');
INSERT INTO `handicap_history` VALUES(45, 56, 16, '2012-05-30');
INSERT INTO `handicap_history` VALUES(46, 41, 13, '2012-05-30');
INSERT INTO `handicap_history` VALUES(47, 40, 21, '2012-05-30');
INSERT INTO `handicap_history` VALUES(48, 42, 17, '2012-05-30');
INSERT INTO `handicap_history` VALUES(49, 50, 18, '2012-05-30');
INSERT INTO `handicap_history` VALUES(50, 48, 11, '2012-05-30');
INSERT INTO `handicap_history` VALUES(53, 7, 10, '2012-06-04');
INSERT INTO `handicap_history` VALUES(54, 10, 7, '2012-06-04');
INSERT INTO `handicap_history` VALUES(55, 12, 2, '2012-06-04');
INSERT INTO `handicap_history` VALUES(56, 4, 6, '2012-06-04');
INSERT INTO `handicap_history` VALUES(57, 33, 13, '2012-06-04');
INSERT INTO `handicap_history` VALUES(58, 15, 10, '2012-06-04');
INSERT INTO `handicap_history` VALUES(59, 16, 10, '2012-06-04');
INSERT INTO `handicap_history` VALUES(60, 18, 6, '2012-06-04');
INSERT INTO `handicap_history` VALUES(61, 20, 14, '2012-06-04');
INSERT INTO `handicap_history` VALUES(62, 14, 14, '2012-06-04');
INSERT INTO `handicap_history` VALUES(63, 22, 17, '2012-06-04');
INSERT INTO `handicap_history` VALUES(64, 24, 9, '2012-06-04');
INSERT INTO `handicap_history` VALUES(65, 25, 13, '2012-06-04');
INSERT INTO `handicap_history` VALUES(66, 21, 20, '2012-06-04');
INSERT INTO `handicap_history` VALUES(67, 35, 12, '2012-06-04');
INSERT INTO `handicap_history` VALUES(68, 31, 17, '2012-06-04');
INSERT INTO `handicap_history` VALUES(69, 5, 7, '2012-06-04');
INSERT INTO `handicap_history` VALUES(70, 39, 18, '2012-06-04');
INSERT INTO `handicap_history` VALUES(71, 28, 11, '2012-06-04');
INSERT INTO `handicap_history` VALUES(72, 30, 11, '2012-06-04');
INSERT INTO `handicap_history` VALUES(73, 19, 17, '2012-06-04');
INSERT INTO `handicap_history` VALUES(74, 17, 12, '2012-06-04');
INSERT INTO `handicap_history` VALUES(75, 26, 24, '2012-06-04');
INSERT INTO `handicap_history` VALUES(76, 6, 20, '2012-06-04');
INSERT INTO `handicap_history` VALUES(77, 32, 8, '2012-06-04');
INSERT INTO `handicap_history` VALUES(78, 37, 19, '2012-06-04');
INSERT INTO `handicap_history` VALUES(79, 8, 16, '2012-06-04');
INSERT INTO `handicap_history` VALUES(80, 11, 16, '2012-06-04');
INSERT INTO `handicap_history` VALUES(81, 34, 6, '2012-06-04');
INSERT INTO `handicap_history` VALUES(82, 36, 13, '2012-06-04');
INSERT INTO `handicap_history` VALUES(83, 3, 18, '2012-06-04');
INSERT INTO `handicap_history` VALUES(84, 27, 19, '2012-06-04');
INSERT INTO `handicap_history` VALUES(85, 13, 21, '2012-06-04');
INSERT INTO `handicap_history` VALUES(86, 29, 14, '2012-06-04');
INSERT INTO `handicap_history` VALUES(87, 23, 17, '2012-06-04');
INSERT INTO `handicap_history` VALUES(88, 38, 4, '2012-06-04');
INSERT INTO `handicap_history` VALUES(89, 44, 18, '2012-06-04');
INSERT INTO `handicap_history` VALUES(90, 2, 0, '2012-06-04');
INSERT INTO `handicap_history` VALUES(91, 61, 6, '2012-06-04');
INSERT INTO `handicap_history` VALUES(92, 52, 13, '2012-06-04');
INSERT INTO `handicap_history` VALUES(93, 43, 8, '2012-06-04');
INSERT INTO `handicap_history` VALUES(94, 62, 11, '2012-06-04');
INSERT INTO `handicap_history` VALUES(95, 49, 8, '2012-06-04');
INSERT INTO `handicap_history` VALUES(96, 47, 10, '2012-06-04');
INSERT INTO `handicap_history` VALUES(97, 53, 16, '2012-06-04');
INSERT INTO `handicap_history` VALUES(98, 55, 22, '2012-06-04');
INSERT INTO `handicap_history` VALUES(99, 56, 16, '2012-06-04');
INSERT INTO `handicap_history` VALUES(100, 41, 13, '2012-06-04');
INSERT INTO `handicap_history` VALUES(101, 40, 21, '2012-06-04');
INSERT INTO `handicap_history` VALUES(102, 42, 17, '2012-06-04');
INSERT INTO `handicap_history` VALUES(103, 50, 18, '2012-06-04');
INSERT INTO `handicap_history` VALUES(104, 57, 13, '2012-06-04');
INSERT INTO `handicap_history` VALUES(105, 48, 11, '2012-06-04');
INSERT INTO `handicap_history` VALUES(106, 3, 24, '2012-05-03');
INSERT INTO `handicap_history` VALUES(107, 7, 10, '2012-06-05');
INSERT INTO `handicap_history` VALUES(108, 10, 7, '2012-06-05');
INSERT INTO `handicap_history` VALUES(109, 12, 2, '2012-06-05');
INSERT INTO `handicap_history` VALUES(110, 4, 6, '2012-06-05');
INSERT INTO `handicap_history` VALUES(111, 33, 13, '2012-06-05');
INSERT INTO `handicap_history` VALUES(112, 15, 10, '2012-06-05');
INSERT INTO `handicap_history` VALUES(113, 16, 10, '2012-06-05');
INSERT INTO `handicap_history` VALUES(114, 18, 6, '2012-06-05');
INSERT INTO `handicap_history` VALUES(115, 20, 14, '2012-06-05');
INSERT INTO `handicap_history` VALUES(116, 14, 14, '2012-06-05');
INSERT INTO `handicap_history` VALUES(117, 22, 17, '2012-06-05');
INSERT INTO `handicap_history` VALUES(118, 24, 9, '2012-06-05');
INSERT INTO `handicap_history` VALUES(119, 25, 13, '2012-06-05');
INSERT INTO `handicap_history` VALUES(120, 21, 20, '2012-06-05');
INSERT INTO `handicap_history` VALUES(121, 35, 12, '2012-06-05');
INSERT INTO `handicap_history` VALUES(122, 31, 17, '2012-06-05');
INSERT INTO `handicap_history` VALUES(123, 5, 7, '2012-06-05');
INSERT INTO `handicap_history` VALUES(124, 39, 18, '2012-06-05');
INSERT INTO `handicap_history` VALUES(125, 28, 11, '2012-06-05');
INSERT INTO `handicap_history` VALUES(126, 30, 11, '2012-06-05');
INSERT INTO `handicap_history` VALUES(127, 19, 17, '2012-06-05');
INSERT INTO `handicap_history` VALUES(128, 17, 12, '2012-06-05');
INSERT INTO `handicap_history` VALUES(129, 26, 24, '2012-06-05');
INSERT INTO `handicap_history` VALUES(130, 6, 20, '2012-06-05');
INSERT INTO `handicap_history` VALUES(131, 32, 8, '2012-06-05');
INSERT INTO `handicap_history` VALUES(132, 37, 19, '2012-06-05');
INSERT INTO `handicap_history` VALUES(133, 8, 16, '2012-06-05');
INSERT INTO `handicap_history` VALUES(134, 11, 16, '2012-06-05');
INSERT INTO `handicap_history` VALUES(135, 34, 6, '2012-06-05');
INSERT INTO `handicap_history` VALUES(136, 36, 13, '2012-06-05');
INSERT INTO `handicap_history` VALUES(137, 3, 18, '2012-06-05');
INSERT INTO `handicap_history` VALUES(138, 27, 19, '2012-06-05');
INSERT INTO `handicap_history` VALUES(139, 13, 21, '2012-06-05');
INSERT INTO `handicap_history` VALUES(140, 29, 14, '2012-06-05');
INSERT INTO `handicap_history` VALUES(141, 23, 17, '2012-06-05');
INSERT INTO `handicap_history` VALUES(142, 38, 4, '2012-06-05');
INSERT INTO `handicap_history` VALUES(143, 44, 18, '2012-06-05');
INSERT INTO `handicap_history` VALUES(144, 2, 0, '2012-06-05');
INSERT INTO `handicap_history` VALUES(145, 61, 6, '2012-06-05');
INSERT INTO `handicap_history` VALUES(146, 52, 13, '2012-06-05');
INSERT INTO `handicap_history` VALUES(147, 43, 8, '2012-06-05');
INSERT INTO `handicap_history` VALUES(148, 62, 11, '2012-06-05');
INSERT INTO `handicap_history` VALUES(149, 49, 8, '2012-06-05');
INSERT INTO `handicap_history` VALUES(150, 47, 10, '2012-06-05');
INSERT INTO `handicap_history` VALUES(151, 53, 16, '2012-06-05');
INSERT INTO `handicap_history` VALUES(152, 55, 22, '2012-06-05');
INSERT INTO `handicap_history` VALUES(153, 56, 16, '2012-06-05');
INSERT INTO `handicap_history` VALUES(154, 41, 13, '2012-06-05');
INSERT INTO `handicap_history` VALUES(155, 40, 21, '2012-06-05');
INSERT INTO `handicap_history` VALUES(156, 42, 17, '2012-06-05');
INSERT INTO `handicap_history` VALUES(157, 50, 18, '2012-06-05');
INSERT INTO `handicap_history` VALUES(158, 57, 13, '2012-06-05');
INSERT INTO `handicap_history` VALUES(159, 48, 11, '2012-06-05');
INSERT INTO `handicap_history` VALUES(160, 7, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(161, 10, 7, '2012-06-07');
INSERT INTO `handicap_history` VALUES(162, 12, 2, '2012-06-07');
INSERT INTO `handicap_history` VALUES(163, 4, 7, '2012-06-07');
INSERT INTO `handicap_history` VALUES(164, 33, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(165, 15, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(166, 16, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(167, 18, 6, '2012-06-07');
INSERT INTO `handicap_history` VALUES(168, 20, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(169, 14, 15, '2012-06-07');
INSERT INTO `handicap_history` VALUES(170, 22, 17, '2012-06-07');
INSERT INTO `handicap_history` VALUES(171, 24, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(172, 25, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(173, 21, 22, '2012-06-07');
INSERT INTO `handicap_history` VALUES(174, 35, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(175, 31, 16, '2012-06-07');
INSERT INTO `handicap_history` VALUES(176, 5, 8, '2012-06-07');
INSERT INTO `handicap_history` VALUES(177, 39, 18, '2012-06-07');
INSERT INTO `handicap_history` VALUES(178, 28, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(179, 30, 11, '2012-06-07');
INSERT INTO `handicap_history` VALUES(180, 19, 16, '2012-06-07');
INSERT INTO `handicap_history` VALUES(181, 17, 11, '2012-06-07');
INSERT INTO `handicap_history` VALUES(182, 26, 23, '2012-06-07');
INSERT INTO `handicap_history` VALUES(183, 6, 20, '2012-06-07');
INSERT INTO `handicap_history` VALUES(184, 32, 8, '2012-06-07');
INSERT INTO `handicap_history` VALUES(185, 37, 17, '2012-06-07');
INSERT INTO `handicap_history` VALUES(186, 8, 16, '2012-06-07');
INSERT INTO `handicap_history` VALUES(187, 11, 17, '2012-06-07');
INSERT INTO `handicap_history` VALUES(188, 34, 5, '2012-06-07');
INSERT INTO `handicap_history` VALUES(189, 36, 14, '2012-06-07');
INSERT INTO `handicap_history` VALUES(190, 3, 18, '2012-06-07');
INSERT INTO `handicap_history` VALUES(191, 27, 19, '2012-06-07');
INSERT INTO `handicap_history` VALUES(192, 13, 19, '2012-06-07');
INSERT INTO `handicap_history` VALUES(193, 29, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(194, 23, 18, '2012-06-07');
INSERT INTO `handicap_history` VALUES(195, 38, 3, '2012-06-07');
INSERT INTO `handicap_history` VALUES(196, 44, 18, '2012-06-07');
INSERT INTO `handicap_history` VALUES(197, 2, 0, '2012-06-07');
INSERT INTO `handicap_history` VALUES(198, 61, 6, '2012-06-07');
INSERT INTO `handicap_history` VALUES(199, 52, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(200, 43, 8, '2012-06-07');
INSERT INTO `handicap_history` VALUES(201, 62, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(202, 49, 8, '2012-06-07');
INSERT INTO `handicap_history` VALUES(203, 47, 10, '2012-06-07');
INSERT INTO `handicap_history` VALUES(204, 53, 16, '2012-06-07');
INSERT INTO `handicap_history` VALUES(205, 63, 6, '2012-06-07');
INSERT INTO `handicap_history` VALUES(206, 55, 22, '2012-06-07');
INSERT INTO `handicap_history` VALUES(207, 56, 16, '2012-06-07');
INSERT INTO `handicap_history` VALUES(208, 41, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(209, 40, 21, '2012-06-07');
INSERT INTO `handicap_history` VALUES(210, 42, 17, '2012-06-07');
INSERT INTO `handicap_history` VALUES(211, 50, 18, '2012-06-07');
INSERT INTO `handicap_history` VALUES(212, 57, 13, '2012-06-07');
INSERT INTO `handicap_history` VALUES(213, 48, 11, '2012-06-07');
INSERT INTO `handicap_history` VALUES(214, 7, 11, '2012-06-13');
INSERT INTO `handicap_history` VALUES(215, 10, 8, '2012-06-13');
INSERT INTO `handicap_history` VALUES(216, 12, 3, '2012-06-13');
INSERT INTO `handicap_history` VALUES(217, 4, 7, '2012-06-13');
INSERT INTO `handicap_history` VALUES(218, 33, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(219, 15, 10, '2012-06-13');
INSERT INTO `handicap_history` VALUES(220, 16, 9, '2012-06-13');
INSERT INTO `handicap_history` VALUES(221, 18, 6, '2012-06-13');
INSERT INTO `handicap_history` VALUES(222, 20, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(223, 14, 15, '2012-06-13');
INSERT INTO `handicap_history` VALUES(224, 22, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(225, 24, 9, '2012-06-13');
INSERT INTO `handicap_history` VALUES(226, 25, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(227, 21, 22, '2012-06-13');
INSERT INTO `handicap_history` VALUES(228, 35, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(229, 31, 15, '2012-06-13');
INSERT INTO `handicap_history` VALUES(230, 5, 8, '2012-06-13');
INSERT INTO `handicap_history` VALUES(231, 39, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(232, 28, 11, '2012-06-13');
INSERT INTO `handicap_history` VALUES(233, 30, 10, '2012-06-13');
INSERT INTO `handicap_history` VALUES(234, 19, 16, '2012-06-13');
INSERT INTO `handicap_history` VALUES(235, 17, 11, '2012-06-13');
INSERT INTO `handicap_history` VALUES(236, 26, 23, '2012-06-13');
INSERT INTO `handicap_history` VALUES(237, 6, 20, '2012-06-13');
INSERT INTO `handicap_history` VALUES(238, 32, 8, '2012-06-13');
INSERT INTO `handicap_history` VALUES(239, 37, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(240, 8, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(241, 11, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(242, 34, 4, '2012-06-13');
INSERT INTO `handicap_history` VALUES(243, 36, 14, '2012-06-13');
INSERT INTO `handicap_history` VALUES(244, 3, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(245, 27, 19, '2012-06-13');
INSERT INTO `handicap_history` VALUES(246, 13, 20, '2012-06-13');
INSERT INTO `handicap_history` VALUES(247, 29, 12, '2012-06-13');
INSERT INTO `handicap_history` VALUES(248, 23, 17, '2012-06-13');
INSERT INTO `handicap_history` VALUES(249, 38, 3, '2012-06-13');
INSERT INTO `handicap_history` VALUES(250, 44, 18, '2012-06-13');
INSERT INTO `handicap_history` VALUES(251, 65, 29, '2012-06-13');
INSERT INTO `handicap_history` VALUES(252, 2, 0, '2012-06-13');
INSERT INTO `handicap_history` VALUES(253, 61, 6, '2012-06-13');
INSERT INTO `handicap_history` VALUES(254, 52, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(255, 43, 8, '2012-06-13');
INSERT INTO `handicap_history` VALUES(256, 62, 10, '2012-06-13');
INSERT INTO `handicap_history` VALUES(257, 49, 8, '2012-06-13');
INSERT INTO `handicap_history` VALUES(258, 47, 10, '2012-06-13');
INSERT INTO `handicap_history` VALUES(259, 53, 16, '2012-06-13');
INSERT INTO `handicap_history` VALUES(260, 63, 6, '2012-06-13');
INSERT INTO `handicap_history` VALUES(261, 55, 22, '2012-06-13');
INSERT INTO `handicap_history` VALUES(262, 56, 16, '2012-06-13');
INSERT INTO `handicap_history` VALUES(263, 41, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(264, 40, 21, '2012-06-13');
INSERT INTO `handicap_history` VALUES(265, 64, 18, '2012-06-13');
INSERT INTO `handicap_history` VALUES(266, 42, 18, '2012-06-13');
INSERT INTO `handicap_history` VALUES(267, 50, 18, '2012-06-13');
INSERT INTO `handicap_history` VALUES(268, 57, 13, '2012-06-13');
INSERT INTO `handicap_history` VALUES(269, 48, 11, '2012-06-13');
INSERT INTO `handicap_history` VALUES(270, 7, 11, '2012-06-18');
INSERT INTO `handicap_history` VALUES(271, 10, 8, '2012-06-18');
INSERT INTO `handicap_history` VALUES(272, 12, 3, '2012-06-18');
INSERT INTO `handicap_history` VALUES(273, 4, 7, '2012-06-18');
INSERT INTO `handicap_history` VALUES(274, 33, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(275, 15, 9, '2012-06-18');
INSERT INTO `handicap_history` VALUES(276, 16, 9, '2012-06-18');
INSERT INTO `handicap_history` VALUES(277, 18, 5, '2012-06-18');
INSERT INTO `handicap_history` VALUES(278, 20, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(279, 14, 15, '2012-06-18');
INSERT INTO `handicap_history` VALUES(280, 22, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(281, 24, 10, '2012-06-18');
INSERT INTO `handicap_history` VALUES(282, 25, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(283, 21, 23, '2012-06-18');
INSERT INTO `handicap_history` VALUES(284, 35, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(285, 31, 16, '2012-06-18');
INSERT INTO `handicap_history` VALUES(286, 5, 7, '2012-06-18');
INSERT INTO `handicap_history` VALUES(287, 39, 16, '2012-06-18');
INSERT INTO `handicap_history` VALUES(288, 28, 9, '2012-06-18');
INSERT INTO `handicap_history` VALUES(289, 30, 9, '2012-06-18');
INSERT INTO `handicap_history` VALUES(290, 19, 17, '2012-06-18');
INSERT INTO `handicap_history` VALUES(291, 17, 10, '2012-06-18');
INSERT INTO `handicap_history` VALUES(292, 26, 22, '2012-06-18');
INSERT INTO `handicap_history` VALUES(293, 6, 20, '2012-06-18');
INSERT INTO `handicap_history` VALUES(294, 32, 7, '2012-06-18');
INSERT INTO `handicap_history` VALUES(295, 37, 17, '2012-06-18');
INSERT INTO `handicap_history` VALUES(296, 8, 17, '2012-06-18');
INSERT INTO `handicap_history` VALUES(297, 11, 17, '2012-06-18');
INSERT INTO `handicap_history` VALUES(298, 34, 4, '2012-06-18');
INSERT INTO `handicap_history` VALUES(299, 36, 15, '2012-06-18');
INSERT INTO `handicap_history` VALUES(300, 3, 16, '2012-06-18');
INSERT INTO `handicap_history` VALUES(301, 27, 19, '2012-06-18');
INSERT INTO `handicap_history` VALUES(302, 13, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(303, 29, 11, '2012-06-18');
INSERT INTO `handicap_history` VALUES(304, 23, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(305, 38, 3, '2012-06-18');
INSERT INTO `handicap_history` VALUES(306, 44, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(307, 65, 22, '2012-06-18');
INSERT INTO `handicap_history` VALUES(308, 2, 0, '2012-06-18');
INSERT INTO `handicap_history` VALUES(309, 61, 6, '2012-06-18');
INSERT INTO `handicap_history` VALUES(310, 52, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(311, 43, 8, '2012-06-18');
INSERT INTO `handicap_history` VALUES(312, 62, 10, '2012-06-18');
INSERT INTO `handicap_history` VALUES(313, 49, 8, '2012-06-18');
INSERT INTO `handicap_history` VALUES(314, 47, 10, '2012-06-18');
INSERT INTO `handicap_history` VALUES(315, 53, 15, '2012-06-18');
INSERT INTO `handicap_history` VALUES(316, 63, 6, '2012-06-18');
INSERT INTO `handicap_history` VALUES(317, 55, 22, '2012-06-18');
INSERT INTO `handicap_history` VALUES(318, 56, 16, '2012-06-18');
INSERT INTO `handicap_history` VALUES(319, 41, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(320, 40, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(321, 64, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(322, 42, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(323, 50, 18, '2012-06-18');
INSERT INTO `handicap_history` VALUES(324, 57, 13, '2012-06-18');
INSERT INTO `handicap_history` VALUES(325, 48, 11, '2012-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `holes`
--

CREATE TABLE `holes` (
  `id` int(11) NOT NULL auto_increment,
  `number` varchar(20) NOT NULL,
  `mens_handicap` int(11) NOT NULL,
  `womens_handicap` int(11) NOT NULL,
  `par` int(11) NOT NULL,
  `side` varchar(50) NOT NULL,
  `courseId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `holes`
--

INSERT INTO `holes` VALUES(1, '1', 13, 7, 4, 'Front', 1);
INSERT INTO `holes` VALUES(2, '2', 3, 5, 4, 'Front', 1);
INSERT INTO `holes` VALUES(3, '3', 7, 1, 5, 'Front', 1);
INSERT INTO `holes` VALUES(4, '4', 15, 13, 3, 'Front', 1);
INSERT INTO `holes` VALUES(5, '5', 17, 17, 4, 'Front', 1);
INSERT INTO `holes` VALUES(6, '6', 11, 11, 5, 'Front', 1);
INSERT INTO `holes` VALUES(7, '7', 5, 9, 4, 'Front', 1);
INSERT INTO `holes` VALUES(8, '8', 1, 3, 4, 'Front', 1);
INSERT INTO `holes` VALUES(9, '9', 9, 15, 3, 'Front', 1);
INSERT INTO `holes` VALUES(10, '10', 6, 4, 5, 'Back', 1);
INSERT INTO `holes` VALUES(11, '11', 10, 16, 4, 'Back', 1);
INSERT INTO `holes` VALUES(12, '12', 8, 10, 4, 'Back', 1);
INSERT INTO `holes` VALUES(13, '13', 14, 14, 3, 'Back', 1);
INSERT INTO `holes` VALUES(14, '14', 16, 12, 4, 'Back', 1);
INSERT INTO `holes` VALUES(15, '15', 2, 2, 4, 'Back', 1);
INSERT INTO `holes` VALUES(16, '16', 4, 6, 4, 'Back', 1);
INSERT INTO `holes` VALUES(17, '17', 18, 18, 3, 'Back', 1);
INSERT INTO `holes` VALUES(18, '18', 12, 8, 5, 'Back', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(300) NOT NULL,
  `body` varchar(4000) NOT NULL,
  `published` int(11) NOT NULL default '0',
  `created_at` date NOT NULL,
  `updated_at` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES(1, '2012 Session 1 Teams Announced', 'The teams have been announced for the first session of 2012, please check out the teams link on the left to see what team you are on.', 1, '2012-03-12', '2012-03-12');
INSERT INTO `posts` VALUES(7, 'First practice round is here!!!!', 'Remember to give yourself enough time to be at your designated tee box by 5:00 pm.', 1, '2012-03-15', '2012-03-15');
INSERT INTO `posts` VALUES(8, 'The Game is on!!!', 'Ok everything else didn\\''t count up until tonight. Hit em straight and enjoy yourselves!!!', 1, '2012-03-29', '2012-03-29');
INSERT INTO `posts` VALUES(9, 'The Leader after 1st Round', 'Rick Johnson\\''s in the lead with 26 points in the Stableford competition.  He shot an amazing net 28.  ', 1, '2012-04-03', '2012-04-03');
INSERT INTO `posts` VALUES(10, 'Next Week\\''s Round', 'Don\\''t forget that next week we will play on Tuesday April 17 and not Thursday April 19.', 1, '2012-04-12', '2012-04-12');
INSERT INTO `posts` VALUES(11, 'League is Tuesday Night this week!!!', 'REMINDER: The league is being played on Tuesday night this week.', 1, '2012-04-30', '2012-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL,
  `home` int(11) NOT NULL,
  `away` int(11) NOT NULL,
  `side` varchar(100) NOT NULL,
  `startingHole` int(11) NOT NULL default '0',
  `course` int(11) NOT NULL default '1',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` VALUES(1, '2012-03-22', 4, 6, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(2, '2012-03-22', 5, 22, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(3, '2012-03-22', 7, 21, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(4, '2012-03-22', 8, 20, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(5, '2012-03-22', 9, 19, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(6, '2012-03-22', 10, 18, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(7, '2012-03-22', 11, 17, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(8, '2012-03-22', 13, 16, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(9, '2012-03-22', 14, 15, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(23, '2012-03-29', 10, 19, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(22, '2012-03-29', 9, 20, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(21, '2012-03-29', 8, 21, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(20, '2012-03-29', 5, 6, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(19, '2012-03-29', 4, 7, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(24, '2012-03-29', 11, 18, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(25, '2012-03-29', 13, 17, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(26, '2012-03-29', 14, 16, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(27, '2012-03-29', 15, 22, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(28, '2012-06-05', 4, 8, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(29, '2012-06-05', 5, 7, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(30, '2012-06-05', 6, 22, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(31, '2012-06-05', 9, 21, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(32, '2012-06-05', 10, 20, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(33, '2012-06-05', 11, 19, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(34, '2012-06-05', 13, 18, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(35, '2012-06-05', 14, 17, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(36, '2012-06-05', 15, 16, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(37, '2012-04-12', 4, 9, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(38, '2012-04-12', 5, 8, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(39, '2012-04-12', 6, 7, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(40, '2012-04-12', 10, 21, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(41, '2012-04-12', 11, 20, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(42, '2012-04-12', 13, 19, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(43, '2012-04-12', 14, 18, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(44, '2012-04-12', 15, 17, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(45, '2012-04-12', 16, 22, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(46, '2012-04-17', 4, 10, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(47, '2012-04-17', 5, 9, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(48, '2012-04-17', 6, 8, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(49, '2012-04-17', 7, 22, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(50, '2012-04-17', 11, 21, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(51, '2012-04-17', 13, 20, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(52, '2012-04-17', 14, 19, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(53, '2012-04-17', 15, 18, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(54, '2012-04-17', 16, 17, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(55, '2012-04-26', 4, 11, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(56, '2012-04-26', 5, 10, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(57, '2012-04-26', 6, 9, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(58, '2012-04-26', 7, 8, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(59, '2012-04-26', 13, 21, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(60, '2012-04-26', 14, 20, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(61, '2012-04-26', 15, 19, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(62, '2012-04-26', 16, 18, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(63, '2012-04-26', 17, 22, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(64, '2012-05-01', 4, 13, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(65, '2012-05-01', 5, 11, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(66, '2012-05-01', 6, 10, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(67, '2012-05-01', 7, 9, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(68, '2012-05-01', 8, 22, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(69, '2012-05-01', 14, 21, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(70, '2012-05-01', 15, 20, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(71, '2012-05-01', 16, 19, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(72, '2012-05-01', 17, 18, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(73, '2012-05-10', 4, 14, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(74, '2012-05-10', 5, 13, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(75, '2012-05-10', 6, 11, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(76, '2012-05-10', 7, 10, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(77, '2012-05-10', 8, 9, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(78, '2012-05-10', 15, 21, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(79, '2012-05-10', 16, 20, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(80, '2012-05-10', 17, 19, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(81, '2012-05-10', 18, 22, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(82, '2012-05-22', 4, 15, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(83, '2012-05-22', 5, 14, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(84, '2012-05-22', 6, 13, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(85, '2012-05-22', 7, 11, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(86, '2012-05-22', 8, 10, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(87, '2012-05-22', 9, 22, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(88, '2012-05-22', 16, 21, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(89, '2012-05-22', 17, 20, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(90, '2012-05-22', 18, 19, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(91, '2012-05-24', 4, 16, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(92, '2012-05-24', 5, 15, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(93, '2012-05-24', 6, 14, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(94, '2012-05-24', 7, 13, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(95, '2012-05-24', 8, 11, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(96, '2012-05-24', 9, 10, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(97, '2012-05-24', 17, 21, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(98, '2012-05-24', 18, 20, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(99, '2012-05-24', 19, 22, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(100, '2012-05-31', 4, 17, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(101, '2012-05-31', 5, 16, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(102, '2012-05-31', 6, 15, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(103, '2012-05-31', 7, 14, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(104, '2012-05-31', 8, 13, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(105, '2012-05-31', 9, 11, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(106, '2012-05-31', 10, 22, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(107, '2012-05-31', 18, 21, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(108, '2012-05-31', 19, 20, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(109, '2012-06-07', 4, 18, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(110, '2012-06-07', 5, 17, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(111, '2012-06-07', 6, 16, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(112, '2012-06-07', 7, 15, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(113, '2012-06-07', 8, 14, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(114, '2012-06-07', 9, 13, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(115, '2012-06-07', 10, 11, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(116, '2012-06-07', 19, 21, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(117, '2012-06-07', 20, 22, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(118, '2012-06-14', 4, 19, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(119, '2012-06-14', 5, 18, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(120, '2012-06-14', 6, 17, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(121, '2012-06-14', 7, 16, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(122, '2012-06-14', 8, 15, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(123, '2012-06-14', 9, 14, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(124, '2012-06-14', 10, 13, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(125, '2012-06-14', 11, 22, 'Back', 18, 1);
INSERT INTO `schedule` VALUES(126, '2012-06-14', 20, 21, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(127, '2012-06-21', 4, 20, 'Front', 9, 1);
INSERT INTO `schedule` VALUES(128, '2012-06-21', 5, 19, 'Front', 4, 1);
INSERT INTO `schedule` VALUES(129, '2012-06-21', 6, 18, 'Front', 6, 1);
INSERT INTO `schedule` VALUES(130, '2012-06-21', 7, 17, 'Front', 2, 1);
INSERT INTO `schedule` VALUES(131, '2012-06-21', 8, 16, 'Front', 3, 1);
INSERT INTO `schedule` VALUES(132, '2012-06-21', 9, 15, 'Front', 1, 1);
INSERT INTO `schedule` VALUES(133, '2012-06-21', 10, 14, 'Front', 8, 1);
INSERT INTO `schedule` VALUES(134, '2012-06-21', 11, 13, 'Front', 5, 1);
INSERT INTO `schedule` VALUES(135, '2012-06-21', 21, 22, 'Front', 7, 1);
INSERT INTO `schedule` VALUES(136, '2012-06-28', 4, 21, 'Back', 12, 1);
INSERT INTO `schedule` VALUES(137, '2012-06-28', 5, 20, 'Back', 17, 1);
INSERT INTO `schedule` VALUES(138, '2012-06-28', 6, 19, 'Back', 11, 1);
INSERT INTO `schedule` VALUES(139, '2012-06-28', 7, 18, 'Back', 15, 1);
INSERT INTO `schedule` VALUES(140, '2012-06-28', 8, 17, 'Back', 13, 1);
INSERT INTO `schedule` VALUES(141, '2012-06-28', 9, 16, 'Back', 16, 1);
INSERT INTO `schedule` VALUES(142, '2012-06-28', 10, 15, 'Back', 10, 1);
INSERT INTO `schedule` VALUES(143, '2012-06-28', 11, 14, 'Back', 14, 1);
INSERT INTO `schedule` VALUES(144, '2012-06-28', 13, 22, 'Back', 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_notes`
--

CREATE TABLE `schedule_notes` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL,
  `notes` varchar(3000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `schedule_notes`
--

INSERT INTO `schedule_notes` VALUES(1, '2012-04-17', '*** (moved to Tuesday)');
INSERT INTO `schedule_notes` VALUES(2, '2012-05-01', '*** (moved to Tuesday)');
INSERT INTO `schedule_notes` VALUES(3, '2012-09-06', '*** (aerifying ... greens bumby)');
INSERT INTO `schedule_notes` VALUES(5, '2012-05-10', '');
INSERT INTO `schedule_notes` VALUES(6, '2012-05-22', '*** Rain date make up');
INSERT INTO `schedule_notes` VALUES(7, '2012-06-05', '***Rain Date Makeup from 4/5/12***');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_subs`
--

CREATE TABLE `schedule_subs` (
  `id` int(11) NOT NULL auto_increment,
  `match_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `schedule_subs`
--

INSERT INTO `schedule_subs` VALUES(1, 40, 18, 40);
INSERT INTO `schedule_subs` VALUES(2, 42, 33, 41);
INSERT INTO `schedule_subs` VALUES(3, 44, 26, 42);
INSERT INTO `schedule_subs` VALUES(4, 43, 31, 43);
INSERT INTO `schedule_subs` VALUES(5, 37, 8, 44);
INSERT INTO `schedule_subs` VALUES(14, 61, 32, 50);
INSERT INTO `schedule_subs` VALUES(13, 55, 8, 44);
INSERT INTO `schedule_subs` VALUES(15, 58, 4, 48);
INSERT INTO `schedule_subs` VALUES(16, 58, 14, 49);
INSERT INTO `schedule_subs` VALUES(17, 57, 16, 47);
INSERT INTO `schedule_subs` VALUES(18, 57, 17, 42);
INSERT INTO `schedule_subs` VALUES(19, 64, 8, 44);
INSERT INTO `schedule_subs` VALUES(20, 64, 22, 40);
INSERT INTO `schedule_subs` VALUES(21, 73, 8, 44);
INSERT INTO `schedule_subs` VALUES(22, 81, 38, 42);
INSERT INTO `schedule_subs` VALUES(23, 67, 14, 50);
INSERT INTO `schedule_subs` VALUES(29, 73, 24, 41);
INSERT INTO `schedule_subs` VALUES(30, 73, 6, 56);
INSERT INTO `schedule_subs` VALUES(28, 74, 23, 55);
INSERT INTO `schedule_subs` VALUES(27, 79, 34, 40);
INSERT INTO `schedule_subs` VALUES(40, 90, 31, 47);
INSERT INTO `schedule_subs` VALUES(50, 105, 16, 57);
INSERT INTO `schedule_subs` VALUES(49, 102, 13, 59);
INSERT INTO `schedule_subs` VALUES(41, 87, 17, 42);
INSERT INTO `schedule_subs` VALUES(36, 85, 4, 40);
INSERT INTO `schedule_subs` VALUES(48, 98, 31, 53);
INSERT INTO `schedule_subs` VALUES(44, 82, 8, 44);
INSERT INTO `schedule_subs` VALUES(42, 85, 14, 60);
INSERT INTO `schedule_subs` VALUES(51, 101, 10, 42);
INSERT INTO `schedule_subs` VALUES(53, 107, 37, 53);
INSERT INTO `schedule_subs` VALUES(54, 101, 5, 61);
INSERT INTO `schedule_subs` VALUES(55, 28, 3, 40);
INSERT INTO `schedule_subs` VALUES(56, 30, 39, 62);
INSERT INTO `schedule_subs` VALUES(57, 36, 27, 63);
INSERT INTO `schedule_subs` VALUES(58, 32, 18, 60);
INSERT INTO `schedule_subs` VALUES(59, 28, 8, 60);
INSERT INTO `schedule_subs` VALUES(61, 112, 4, 64);
INSERT INTO `schedule_subs` VALUES(62, 116, 33, 47);
INSERT INTO `schedule_subs` VALUES(63, 115, 18, 42);
INSERT INTO `schedule_subs` VALUES(64, 115, 19, 53);
INSERT INTO `schedule_subs` VALUES(65, 111, 27, 65);
INSERT INTO `schedule_subs` VALUES(66, 119, 11, 53);
INSERT INTO `schedule_subs` VALUES(67, 122, 25, 40);
INSERT INTO `schedule_subs` VALUES(68, 121, 14, 65);
INSERT INTO `schedule_subs` VALUES(69, 125, 38, 42);
INSERT INTO `schedule_subs` VALUES(74, 133, 18, 66);
INSERT INTO `schedule_subs` VALUES(71, 127, 8, 63);
INSERT INTO `schedule_subs` VALUES(72, 131, 27, 40);
INSERT INTO `schedule_subs` VALUES(78, 134, 23, 60);
INSERT INTO `schedule_subs` VALUES(75, 134, 20, 47);
INSERT INTO `schedule_subs` VALUES(76, 135, 37, 53);
INSERT INTO `schedule_subs` VALUES(77, 135, 38, 62);
INSERT INTO `schedule_subs` VALUES(79, 130, 28, 42);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL auto_increment,
  `hole_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `score` varchar(3) NOT NULL default 'X',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` VALUES(1, 10, 7, 82, '5');
INSERT INTO `scores` VALUES(2, 11, 7, 82, '4');
INSERT INTO `scores` VALUES(3, 12, 7, 82, '4');
INSERT INTO `scores` VALUES(4, 13, 7, 82, '3');
INSERT INTO `scores` VALUES(5, 14, 7, 82, '4');
INSERT INTO `scores` VALUES(6, 15, 7, 82, '4');
INSERT INTO `scores` VALUES(7, 16, 7, 82, '4');
INSERT INTO `scores` VALUES(8, 17, 7, 82, '3');
INSERT INTO `scores` VALUES(9, 18, 7, 82, '5');
INSERT INTO `scores` VALUES(10, 10, 55, 82, '6');
INSERT INTO `scores` VALUES(11, 11, 55, 82, '6');
INSERT INTO `scores` VALUES(12, 12, 55, 82, '6');
INSERT INTO `scores` VALUES(13, 13, 55, 82, '6');
INSERT INTO `scores` VALUES(14, 14, 55, 82, '6');
INSERT INTO `scores` VALUES(15, 15, 55, 82, '6');
INSERT INTO `scores` VALUES(16, 16, 55, 82, '6');
INSERT INTO `scores` VALUES(17, 17, 55, 82, '6');
INSERT INTO `scores` VALUES(18, 18, 55, 82, '6');
INSERT INTO `scores` VALUES(19, 10, 25, 82, '3');
INSERT INTO `scores` VALUES(20, 11, 25, 82, 'x');
INSERT INTO `scores` VALUES(21, 12, 25, 82, '5');
INSERT INTO `scores` VALUES(22, 13, 25, 82, '4');
INSERT INTO `scores` VALUES(23, 14, 25, 82, '4');
INSERT INTO `scores` VALUES(24, 15, 25, 82, '4');
INSERT INTO `scores` VALUES(25, 16, 25, 82, '4');
INSERT INTO `scores` VALUES(26, 17, 25, 82, '4');
INSERT INTO `scores` VALUES(27, 18, 25, 82, '6');
INSERT INTO `scores` VALUES(28, 10, 26, 82, '6');
INSERT INTO `scores` VALUES(29, 11, 26, 82, '6');
INSERT INTO `scores` VALUES(30, 12, 26, 82, '6');
INSERT INTO `scores` VALUES(31, 13, 26, 82, '6');
INSERT INTO `scores` VALUES(32, 14, 26, 82, '6');
INSERT INTO `scores` VALUES(33, 15, 26, 82, '6');
INSERT INTO `scores` VALUES(34, 16, 26, 82, '6');
INSERT INTO `scores` VALUES(35, 17, 26, 82, '6');
INSERT INTO `scores` VALUES(36, 18, 26, 82, '7');
INSERT INTO `scores` VALUES(37, 1, 49, 58, '6');
INSERT INTO `scores` VALUES(38, 2, 49, 58, '5');
INSERT INTO `scores` VALUES(39, 3, 49, 58, '8');
INSERT INTO `scores` VALUES(40, 4, 49, 58, '5');
INSERT INTO `scores` VALUES(41, 5, 49, 58, '4');
INSERT INTO `scores` VALUES(42, 6, 49, 58, '8');
INSERT INTO `scores` VALUES(43, 7, 49, 58, '3');
INSERT INTO `scores` VALUES(44, 8, 49, 58, 'x');
INSERT INTO `scores` VALUES(45, 9, 49, 58, '3');
INSERT INTO `scores` VALUES(46, 1, 48, 58, '5');
INSERT INTO `scores` VALUES(47, 2, 48, 58, '5');
INSERT INTO `scores` VALUES(48, 3, 48, 58, '6');
INSERT INTO `scores` VALUES(49, 4, 48, 58, '4');
INSERT INTO `scores` VALUES(50, 5, 48, 58, '4');
INSERT INTO `scores` VALUES(51, 6, 48, 58, '8');
INSERT INTO `scores` VALUES(52, 7, 48, 58, '5');
INSERT INTO `scores` VALUES(53, 8, 48, 58, '6');
INSERT INTO `scores` VALUES(54, 9, 48, 58, '3');
INSERT INTO `scores` VALUES(55, 1, 15, 58, '7');
INSERT INTO `scores` VALUES(56, 2, 15, 58, '7');
INSERT INTO `scores` VALUES(57, 3, 15, 58, '8');
INSERT INTO `scores` VALUES(58, 4, 15, 58, '4');
INSERT INTO `scores` VALUES(59, 5, 15, 58, '5');
INSERT INTO `scores` VALUES(60, 6, 15, 58, '5');
INSERT INTO `scores` VALUES(61, 7, 15, 58, '6');
INSERT INTO `scores` VALUES(62, 8, 15, 58, '5');
INSERT INTO `scores` VALUES(63, 9, 15, 58, '3');
INSERT INTO `scores` VALUES(64, 1, 3, 58, '7');
INSERT INTO `scores` VALUES(65, 2, 3, 58, '6');
INSERT INTO `scores` VALUES(66, 3, 3, 58, '8');
INSERT INTO `scores` VALUES(67, 4, 3, 58, '7');
INSERT INTO `scores` VALUES(68, 5, 3, 58, '4');
INSERT INTO `scores` VALUES(69, 6, 3, 58, '8');
INSERT INTO `scores` VALUES(70, 7, 3, 58, '7');
INSERT INTO `scores` VALUES(71, 8, 3, 58, '8');
INSERT INTO `scores` VALUES(72, 9, 3, 58, '5');
INSERT INTO `scores` VALUES(73, 10, 15, 86, '5');
INSERT INTO `scores` VALUES(74, 11, 15, 86, '7');
INSERT INTO `scores` VALUES(75, 12, 15, 86, '5');
INSERT INTO `scores` VALUES(76, 13, 15, 86, '2');
INSERT INTO `scores` VALUES(77, 14, 15, 86, '5');
INSERT INTO `scores` VALUES(78, 15, 15, 86, '5');
INSERT INTO `scores` VALUES(79, 16, 15, 86, '4');
INSERT INTO `scores` VALUES(80, 17, 15, 86, '3');
INSERT INTO `scores` VALUES(81, 18, 15, 86, '7');
INSERT INTO `scores` VALUES(82, 10, 3, 86, '5');
INSERT INTO `scores` VALUES(83, 11, 3, 86, '6');
INSERT INTO `scores` VALUES(84, 12, 3, 86, '6');
INSERT INTO `scores` VALUES(85, 13, 3, 86, '4');
INSERT INTO `scores` VALUES(86, 14, 3, 86, '4');
INSERT INTO `scores` VALUES(87, 15, 3, 86, 'x');
INSERT INTO `scores` VALUES(88, 16, 3, 86, '4');
INSERT INTO `scores` VALUES(89, 17, 3, 86, '3');
INSERT INTO `scores` VALUES(90, 18, 3, 86, '7');
INSERT INTO `scores` VALUES(91, 10, 18, 86, '6');
INSERT INTO `scores` VALUES(92, 11, 18, 86, '5');
INSERT INTO `scores` VALUES(93, 12, 18, 86, '6');
INSERT INTO `scores` VALUES(94, 13, 18, 86, '4');
INSERT INTO `scores` VALUES(95, 14, 18, 86, '4');
INSERT INTO `scores` VALUES(96, 15, 18, 86, '5');
INSERT INTO `scores` VALUES(97, 16, 18, 86, '5');
INSERT INTO `scores` VALUES(98, 17, 18, 86, '2');
INSERT INTO `scores` VALUES(99, 18, 18, 86, '5');
INSERT INTO `scores` VALUES(100, 10, 19, 86, 'x');
INSERT INTO `scores` VALUES(101, 11, 19, 86, '3');
INSERT INTO `scores` VALUES(102, 12, 19, 86, '5');
INSERT INTO `scores` VALUES(103, 13, 19, 86, '4');
INSERT INTO `scores` VALUES(104, 14, 19, 86, '6');
INSERT INTO `scores` VALUES(105, 15, 19, 86, '6');
INSERT INTO `scores` VALUES(106, 16, 19, 86, '8');
INSERT INTO `scores` VALUES(107, 17, 19, 86, '4');
INSERT INTO `scores` VALUES(108, 18, 19, 86, '9');
INSERT INTO `scores` VALUES(109, 10, 15, 104, '6');
INSERT INTO `scores` VALUES(110, 11, 15, 104, '5');
INSERT INTO `scores` VALUES(111, 12, 15, 104, '4');
INSERT INTO `scores` VALUES(112, 13, 15, 104, '3');
INSERT INTO `scores` VALUES(113, 14, 15, 104, '3');
INSERT INTO `scores` VALUES(114, 15, 15, 104, '5');
INSERT INTO `scores` VALUES(115, 16, 15, 104, '6');
INSERT INTO `scores` VALUES(116, 17, 15, 104, '3');
INSERT INTO `scores` VALUES(117, 18, 15, 104, '6');
INSERT INTO `scores` VALUES(118, 10, 3, 104, '8');
INSERT INTO `scores` VALUES(119, 11, 3, 104, '4');
INSERT INTO `scores` VALUES(120, 12, 3, 104, '4');
INSERT INTO `scores` VALUES(121, 13, 3, 104, '4');
INSERT INTO `scores` VALUES(122, 14, 3, 104, '5');
INSERT INTO `scores` VALUES(123, 15, 3, 104, '8');
INSERT INTO `scores` VALUES(124, 16, 3, 104, '5');
INSERT INTO `scores` VALUES(125, 17, 3, 104, '5');
INSERT INTO `scores` VALUES(126, 18, 3, 104, '6');
INSERT INTO `scores` VALUES(127, 10, 22, 104, '6');
INSERT INTO `scores` VALUES(128, 11, 22, 104, '5');
INSERT INTO `scores` VALUES(129, 12, 22, 104, 'x');
INSERT INTO `scores` VALUES(130, 13, 22, 104, '3');
INSERT INTO `scores` VALUES(131, 14, 22, 104, '8');
INSERT INTO `scores` VALUES(132, 15, 22, 104, 'x');
INSERT INTO `scores` VALUES(133, 16, 22, 104, '5');
INSERT INTO `scores` VALUES(134, 17, 22, 104, '6');
INSERT INTO `scores` VALUES(135, 18, 22, 104, '7');
INSERT INTO `scores` VALUES(136, 10, 23, 104, '6');
INSERT INTO `scores` VALUES(137, 11, 23, 104, '5');
INSERT INTO `scores` VALUES(138, 12, 23, 104, '6');
INSERT INTO `scores` VALUES(139, 13, 23, 104, '4');
INSERT INTO `scores` VALUES(140, 14, 23, 104, '4');
INSERT INTO `scores` VALUES(141, 15, 23, 104, '7');
INSERT INTO `scores` VALUES(142, 16, 23, 104, '4');
INSERT INTO `scores` VALUES(143, 17, 23, 104, '3');
INSERT INTO `scores` VALUES(144, 18, 23, 104, '7');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL auto_increment,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` VALUES(1, '2012-03-14', '2012-06-29');
INSERT INTO `seasons` VALUES(2, '2012-06-30', '2012-11-01');
INSERT INTO `seasons` VALUES(3, '2013-03-14', '2013-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `players` varchar(50) default NULL,
  `season` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` VALUES(5, 'Team 2', '10,11', 1);
INSERT INTO `teams` VALUES(4, 'Team 1', '7,8', 1);
INSERT INTO `teams` VALUES(6, 'Team 3', '12,13', 1);
INSERT INTO `teams` VALUES(7, 'Team 4', '4,14', 1);
INSERT INTO `teams` VALUES(8, 'Team 5', '15,3', 1);
INSERT INTO `teams` VALUES(9, 'Team 6', '16,17', 1);
INSERT INTO `teams` VALUES(10, 'Team 7', '18,19', 1);
INSERT INTO `teams` VALUES(11, 'Team 8', '20,21', 1);
INSERT INTO `teams` VALUES(13, 'Team 9', '22,23', 1);
INSERT INTO `teams` VALUES(14, 'Team 10', '24,6', 1);
INSERT INTO `teams` VALUES(15, 'Team 11', '25,26', 1);
INSERT INTO `teams` VALUES(16, 'Team 12', '5,27', 1);
INSERT INTO `teams` VALUES(17, 'Team 13', '28,29', 1);
INSERT INTO `teams` VALUES(18, 'Team 14', '30,31', 1);
INSERT INTO `teams` VALUES(19, 'Team 15', '32,33', 1);
INSERT INTO `teams` VALUES(20, 'Team 16', '34,35', 1);
INSERT INTO `teams` VALUES(21, 'Team 17', '36,37', 1);
INSERT INTO `teams` VALUES(22, 'Team 18', '38,39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` int(11) NOT NULL default '0',
  `team` int(11) default NULL,
  `email` varchar(70) NOT NULL,
  `admin` int(11) NOT NULL default '0',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) default NULL,
  `handicap` int(11) default NULL,
  `fulltime` int(11) NOT NULL default '0',
  `usercontrolled` int(11) NOT NULL default '1',
  `password_hint` varchar(200) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`,`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(40, 'xcn4', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'patrick.stoyer@bcbssc.com', 0, 'Patrick', 'Stoyer', '31522', 18, 0, 0, '');
INSERT INTO `users` VALUES(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, 'admin@jonathonsturdevant.com', 1, 'Admin', 'Demo', NULL, 0, 0, 1, '');
INSERT INTO `users` VALUES(3, 'jc33', 'e88ce4f58891f8fe42c5684a59f3d1f9', 1, 8, 'jonathon.sturdevant@gmail.com', 1, 'Jon', 'Sturdevant', '(856)266-1535', 16, 1, 1, '');
INSERT INTO `users` VALUES(4, 'x55u', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 7, 'bob.dissinger@bcbssc.com', 1, 'Bob', 'Dissinger', '', 7, 1, 0, '');
INSERT INTO `users` VALUES(5, 'ji58', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 16, 'mark.law@bcbssc.com', 0, 'Mark', 'Law', '', 7, 1, 1, '');
INSERT INTO `users` VALUES(6, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 14, 'john.quigley@bcbssc.com', 0, 'John', 'Quigley', NULL, 20, 1, 0, '');
INSERT INTO `users` VALUES(7, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 4, 'michael.battani@bcbssc.com', 0, 'Michael', 'Battani', NULL, 11, 1, 0, '');
INSERT INTO `users` VALUES(8, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 4, 'pressley.sanders@bcbssc.com', 0, 'Pressley', 'Sanders', NULL, 17, 1, 0, '');
INSERT INTO `users` VALUES(10, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 5, 'timothy.belt@bcbssc.com', 0, 'Tim', 'Belt', '(803)730-4255', 8, 1, 0, '');
INSERT INTO `users` VALUES(11, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 5, 'bill.schmidt@bcbssc.com', 0, 'Bill', 'Schmidt', '(843)997-1018', 17, 1, 0, '');
INSERT INTO `users` VALUES(12, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 6, 'nicholas.borie@bcbssc.com', 0, 'Nicholas', 'Borie', '34765', 3, 1, 0, '');
INSERT INTO `users` VALUES(13, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 6, 'tom.walsh@bcbssc.com', 0, 'Tom', 'Walsh', '45364', 18, 1, 0, '');
INSERT INTO `users` VALUES(14, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 7, 'tina.head@bcbssc.com', 0, 'Tina', 'Head', '38079', 15, 1, 0, '');
INSERT INTO `users` VALUES(15, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 8, 'akash.elhence@bcbssc.com', 0, 'Akash', 'Elhence', '46907', 9, 1, 0, '');
INSERT INTO `users` VALUES(16, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 9, 'george.ellis@bcbssc.com', 0, 'George', 'Ellis', '(803)586-3528', 9, 1, 0, '');
INSERT INTO `users` VALUES(17, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 9, 'doug.northam@bcbssc.com', 0, 'Doug', 'Northam', '32027', 10, 1, 0, '');
INSERT INTO `users` VALUES(18, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 10, 'mike.gurrera@bcbssc.com', 0, 'Mike', 'Gurrera', '32106', 5, 1, 0, '');
INSERT INTO `users` VALUES(19, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 10, 'glenn.a.mitchell@bcbssc.com', 0, 'Glenn A', 'Mitchell', '(803)312-1761', 17, 1, 0, '');
INSERT INTO `users` VALUES(20, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 11, 'douglas.head@bcbssc.com', 0, 'Douglas', 'Head', '(803)239-7245', 13, 1, 0, '');
INSERT INTO `users` VALUES(21, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 11, 'richard.johnson@bcbssc.com', 0, 'Richard', 'Johnson', '(417)343-8256', 23, 1, 0, '');
INSERT INTO `users` VALUES(22, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 13, 'trey.hinson@bcbssc.com', 0, 'Trey', 'Hinson', '44550', 18, 1, 0, '');
INSERT INTO `users` VALUES(23, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 13, 'diane.h.wilson@bcbssc.com', 0, 'Diane H', 'Wilson', '41794', 18, 1, 0, '');
INSERT INTO `users` VALUES(24, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 14, 'bill.hodge@bcbssc.com', 0, 'Bill', 'Hodge', '45263', 10, 1, 0, '');
INSERT INTO `users` VALUES(25, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 15, 'fred.jahnke@bcbssc.com', 0, 'Fred', 'Jahnke', '44469', 13, 1, 0, '');
INSERT INTO `users` VALUES(26, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 15, 'stephen.portnall@bcbssc.com', 0, 'Stephen', 'Portnall', '(803)807-3908', 22, 1, 0, '');
INSERT INTO `users` VALUES(27, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 16, 'mike.upfield@bcbssc.com', 0, 'Mike', 'Upfield', '47913', 19, 1, 0, '');
INSERT INTO `users` VALUES(28, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 17, 'patrick.mcnally@bcbssc.com', 0, 'Patrick', 'McNally', '37225', 9, 1, 0, '');
INSERT INTO `users` VALUES(29, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 17, 'brian.warman@bcbssc.com', 0, 'Brian', 'Warman', '(215)896-5573', 11, 1, 0, '');
INSERT INTO `users` VALUES(30, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 18, 'blake.meekins@bcbssc.com', 0, 'Blake', 'Meekins', '(803)429-6162', 9, 1, 0, '');
INSERT INTO `users` VALUES(31, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 18, 'robert.keck@bcbssc.com', 0, 'Robert', 'Keck', '47827', 16, 1, 0, '');
INSERT INTO `users` VALUES(32, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 19, 'ed.rathbun@bcbssc.com', 0, 'Ed', 'Rathbun', '45823', 7, 1, 0, '');
INSERT INTO `users` VALUES(33, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 19, 'curt.dockter@bcbssc.com', 0, 'Curt', 'Dockter', '41884', 13, 1, 0, '');
INSERT INTO `users` VALUES(34, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 20, 'john.springer@bcbssc.com', 0, 'John', 'Springer', '(803)566-9203', 4, 1, 0, '');
INSERT INTO `users` VALUES(35, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 20, 'peter.karnuth@bcbssc.com', 0, 'Peter', 'Karnuth', '31083', 13, 1, 0, '');
INSERT INTO `users` VALUES(36, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 21, 'rick.starnes@bcbssc.com', 0, 'Rick', 'Starnes', '31519', 15, 1, 0, '');
INSERT INTO `users` VALUES(37, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 21, 'jerry.record@bcbssc.com', 0, 'Jerry', 'Record', '35507', 17, 1, 0, '');
INSERT INTO `users` VALUES(38, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 22, 'hunter.wilson@bcbssc.com', 0, 'Hunter', 'Wilson', '43790', 3, 1, 0, '');
INSERT INTO `users` VALUES(39, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, 22, 'william.mcdonald@bcbssc.com', 0, 'William', 'McDonald', '(803)467-3164', 16, 1, 0, '');
INSERT INTO `users` VALUES(41, 'hd91', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'greg.sox@bcbssc.com', 0, 'Greg', 'Sox', '48584', 13, 0, 0, '');
INSERT INTO `users` VALUES(42, 'diane.urban', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'unknown@unknown.com', 0, 'Diane', 'Urban', NULL, 18, 0, 0, '');
INSERT INTO `users` VALUES(43, 'mitch.kiser', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'unknown@unknown.com', 0, 'Mitch', 'Kiser', NULL, 8, 0, 0, '');
INSERT INTO `users` VALUES(44, 'hu79', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'russell.comeaux@bcbssc.com', 0, 'Rusty', 'Comeaux', '47091', 18, 0, 0, '');
INSERT INTO `users` VALUES(47, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'noah.miller@bcbssc.com', 0, 'Noah', 'Miller', '(803)264-1830', 10, 0, 0, '');
INSERT INTO `users` VALUES(48, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'kevin.wyatt@bcbssc.com', 0, 'Kevin', 'Wyatt', '(803)264-3863', 11, 0, 0, '');
INSERT INTO `users` VALUES(49, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'bradley.miller@bcbssc.com', 0, 'Brad', 'Miller', '(803)264-6180', 8, 0, 0, '');
INSERT INTO `users` VALUES(50, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'unknown@unknown.com', 0, 'Andray', 'Williams', '', 18, 0, 0, '');
INSERT INTO `users` VALUES(51, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'lisette.brown@bcbssc.com', 0, 'Lisette', 'Brown', '', NULL, 0, 0, '');
INSERT INTO `users` VALUES(52, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'david.gimber@bcbssc.com', 0, 'David', 'Gimber', '', 13, 0, 0, '');
INSERT INTO `users` VALUES(53, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'david.nesbitt@bcbssc.com', 0, 'David', 'Nesbitt', '', 15, 0, 0, '');
INSERT INTO `users` VALUES(55, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Keith.Richards@bcbssc.com', 0, 'Keith', 'Richards', '', 22, 0, 0, '');
INSERT INTO `users` VALUES(56, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'John.Scott@bcbssc.com', 0, 'John', 'Scott', '', 16, 0, 0, '');
INSERT INTO `users` VALUES(57, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Benny.Woodlief@bcbssc.com', 0, 'Benny', 'Woodlief', '', 13, 0, 0, '');
INSERT INTO `users` VALUES(58, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Russell.Leadbetter@bcbssc.com', 0, 'Russell', 'Leadbetter', '', NULL, 0, 0, '');
INSERT INTO `users` VALUES(59, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Charles.Norton@bcbssc.com', 0, 'Charles', 'Norton', '', NULL, 0, 0, '');
INSERT INTO `users` VALUES(60, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, '', 0, 'SUB', 'NEEDED', '', NULL, 0, 0, '');
INSERT INTO `users` VALUES(61, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Tony.Dickey@bcbssc.com', 0, 'Tony', 'Dickey', '', 6, 0, 0, NULL);
INSERT INTO `users` VALUES(62, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Ed.McDaniel@bcbssc.com', 0, 'Ed', 'McDaniel', '', 10, 0, 0, NULL);
INSERT INTO `users` VALUES(63, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'dpoole@firstcommunitysc.com', 0, 'David', 'Poole', '', 6, 0, 0, NULL);
INSERT INTO `users` VALUES(64, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Ken.Summers@bcbssc.com', 0, 'Ken', 'Summers', '', 18, 0, 0, NULL);
INSERT INTO `users` VALUES(65, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, '', 0, 'Annemarie', 'Cosenza', '', 22, 0, 0, NULL);
INSERT INTO `users` VALUES(66, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 1, NULL, 'Corey.coleman@bcbssc.com', 0, 'Corey', 'Coleman', '', NULL, 0, 0, NULL);
