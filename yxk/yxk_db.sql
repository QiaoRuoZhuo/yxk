-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2018 年 06 月 11 日 03:16
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `yxk_db`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `classname_tb`
-- 

CREATE TABLE `classname_tb` (
  `id` int(11) NOT NULL auto_increment,
  `className` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- 
-- 导出表中的数据 `classname_tb`
-- 

INSERT INTO `classname_tb` VALUES (1, '高一1');
INSERT INTO `classname_tb` VALUES (2, '2');
INSERT INTO `classname_tb` VALUES (3, '3');
INSERT INTO `classname_tb` VALUES (4, '4');
INSERT INTO `classname_tb` VALUES (5, '5');
INSERT INTO `classname_tb` VALUES (6, '6');
INSERT INTO `classname_tb` VALUES (7, '7');
INSERT INTO `classname_tb` VALUES (8, '8');
INSERT INTO `classname_tb` VALUES (9, '9');
INSERT INTO `classname_tb` VALUES (10, '10');
INSERT INTO `classname_tb` VALUES (11, '11');
INSERT INTO `classname_tb` VALUES (12, '12');
INSERT INTO `classname_tb` VALUES (13, '13');
INSERT INTO `classname_tb` VALUES (14, '14');
INSERT INTO `classname_tb` VALUES (15, '15');
INSERT INTO `classname_tb` VALUES (16, '16');

-- --------------------------------------------------------

-- 
-- 表的结构 `km_tb`
-- 

CREATE TABLE `km_tb` (
  `id` int(11) NOT NULL auto_increment,
  `className` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `studentNum` int(11) NOT NULL default '0',
  `studentName` varchar(10) collate utf8_unicode_ci NOT NULL,
  `sex` char(1) collate utf8_unicode_ci NOT NULL default 'm',
  `password` varchar(50) collate utf8_unicode_ci NOT NULL default '123456',
  `course1` tinyint(1) NOT NULL default '0',
  `course2` tinyint(1) NOT NULL default '0',
  `course3` tinyint(1) NOT NULL default '0',
  `course4` tinyint(1) NOT NULL default '0',
  `course5` tinyint(1) NOT NULL default '0',
  `course6` tinyint(1) NOT NULL default '0',
  `course7` tinyint(1) NOT NULL default '0',
  `visible` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `km_tb`
-- 

INSERT INTO `km_tb` VALUES (1, '高一1', 1, '1', 'm', '1', 1, 1, 0, 0, 0, 0, 1, 1);
INSERT INTO `km_tb` VALUES (2, '2', 2, '2', 'm', '2', 1, 1, 0, 1, 0, 0, 0, 1);
