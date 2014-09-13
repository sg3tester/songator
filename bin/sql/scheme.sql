-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nadpis` varchar(80) NOT NULL,
  `perex` text NOT NULL,
  `content` longtext NOT NULL,
  `datum` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `blog_tag_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blog_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `heading` varchar(70) NOT NULL,
  `body` longtext NOT NULL,
  `data` mediumtext NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `interpret`;
CREATE TABLE `interpret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `interpret_id` int(11) DEFAULT NULL,
  `valid` tinyint(4) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pridal` varchar(255) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `interpret_id` (`interpret_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `interpret_ibfk_1` FOREIGN KEY (`interpret_id`) REFERENCES `interpret` (`id`) ON DELETE SET NULL,
  CONSTRAINT `interpret_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `who` varchar(255) NOT NULL,
  `message` text,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `navbar`;
CREATE TABLE `navbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factory` varchar(255) NOT NULL,
  `config` mediumtext NOT NULL,
  `dock` varchar(16) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `song`;
CREATE TABLE `song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `interpret_name` varchar(255) NOT NULL,
  `interpret_id` int(11) DEFAULT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'waiting',
  `zanr_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zadatel` varchar(255) NOT NULL,
  `link` varchar(512) NOT NULL,
  `note` varchar(255) NOT NULL,
  `pecka` tinyint(4) NOT NULL,
  `instro` tinyint(4) NOT NULL,
  `remix` tinyint(4) NOT NULL,
  `wishlist_only` tinyint(4) NOT NULL,
  `reason_code` varchar(32) DEFAULT NULL COMMENT 'R10_GENERAL, R20_DUPLICITY, R21_QUALITY, R22_UNACCEPTABLE, R30_ILEGAL, R31_RULES, R40_INVALID, R99_UNKNOWN',
  `revisor` int(11) DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vzkaz` text NOT NULL,
  `private_vzkaz` tinyint(4) NOT NULL,
  `image` text NOT NULL COMMENT 'JSON',
  PRIMARY KEY (`id`),
  KEY `interpret_id` (`interpret_id`),
  KEY `user_id` (`user_id`),
  KEY `revisor` (`revisor`),
  KEY `zanr_id` (`zanr_id`),
  CONSTRAINT `song_ibfk_1` FOREIGN KEY (`interpret_id`) REFERENCES `interpret` (`id`) ON DELETE SET NULL,
  CONSTRAINT `song_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `song_ibfk_3` FOREIGN KEY (`revisor`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `song_ibfk_4` FOREIGN KEY (`zanr_id`) REFERENCES `zanr` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `song_likes`;
CREATE TABLE `song_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `song_id` (`song_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `song_likes_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE,
  CONSTRAINT `song_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `storage`;
CREATE TABLE `storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `type` varchar(64) NOT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(64) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(24) NOT NULL,
  `auth_service` varchar(24) NOT NULL,
  `auth_token` varchar(32) NOT NULL,
  `first_login` tinyint(1) NOT NULL DEFAULT '1',
  `realname` varchar(255) NOT NULL,
  `about` varchar(512) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `twitter_acc` varchar(64) NOT NULL,
  `www` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `zanr`;
CREATE TABLE `zanr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `popis` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2014-09-13 08:50:13
