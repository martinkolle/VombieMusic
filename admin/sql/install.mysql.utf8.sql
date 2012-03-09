-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2012 at 01:08 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `16`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__vombiemusic`
--

CREATE TABLE IF NOT EXISTS `#__vombiemusic` (
  `id` int(11) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__vombiemusic`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__vombiemusic_playlist`
--

CREATE TABLE IF NOT EXISTS `#__vombiemusic_playlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `metadesc` varchar(255) NOT NULL,
  `metakey` varchar(255) NOT NULL,
  `metatitle` varchar(255) NOT NULL,
  `published` int(11) NOT NULL,
  `publish_up` date NOT NULL,
  `publish_down` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `#__vombiemusic_playlist`
--
-- --------------------------------------------------------

--
-- Table structure for table `#__vombiemusic_song`
--

CREATE TABLE IF NOT EXISTS `#__vombiemusic_song` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `catid` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `access` int(11) NOT NULL,
  `song_url` varchar(255) NOT NULL,
  `document1` varchar(255) NOT NULL,
  `document2` varchar(255) NOT NULL,
  `info` mediumtext NOT NULL,
  `params` text NOT NULL,
  `publish_up` date NOT NULL,
  `publish_down` date NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_by_alias` varchar(200) NOT NULL,
  `metadesc` text NOT NULL,
  `metakey` varchar(255) NOT NULL,
  `metatitle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__vombiemusic_song_playlist`
--

CREATE TABLE IF NOT EXISTS `#__vombiemusic_song_playlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `song_id` varchar(10) NOT NULL,
  `playlist_id` varchar(10) NOT NULL,
  `ordering` int(11) NOT NULL,
  `publish_up` date NOT NULL,
  `publish_down` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;
