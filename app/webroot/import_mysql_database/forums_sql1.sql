-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2015 at 07:06 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `attachement` varchar(255) DEFAULT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `block_notification` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fullname`, `username`, `password`, `email`, `mobile`, `image`, `job_title`, `role`, `approved`, `block_notification`) VALUES
(1, 'Mohamed Elsayed', 'master', '1228a4fb70b51bf896be98a35717af389ce84325', 'me@mohamedelsayed.net', '0108076143', 'parade2011100522_29e82.jpg', 'Web Developer', 0, 1, 0),
(3, 'Test 1', 'admin', '88326122b923be10c6b1dbfe118867c886b15c49', 'me2@mohamedelsayed.net', NULL, 'parade2011100522_82897.jpg', '', 1, 1, 0),
(5, 'user2', 'user2', '3d56e47d30f79d3b3a3a3a11d868746810d273df', 'user1@mmmm.com', '2222', '', 'fffff', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` longtext,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(355) DEFAULT NULL,
  `attachement` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
