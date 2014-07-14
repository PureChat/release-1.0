-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2014 at 04:36 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `release-1.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `pc_users`
--

CREATE TABLE IF NOT EXISTS `pc_users` (
  `id` mediumint(12) unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(35) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` mediumint(12) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `avatar` text,
  `status` mediumint(8) unsigned NOT NULL,
  `activation_status` tinyint(1) unsigned NOT NULL,
  `activation_code` varchar(128) NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `hostname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
