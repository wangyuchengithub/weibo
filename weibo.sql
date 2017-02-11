
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 02 月 06 日 11:47
-- 服务器版本: 10.0.28-MariaDB
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `u854088329_test`
--

-- --------------------------------------------------------

--
-- 表的结构 `ly_atme`
--

CREATE TABLE IF NOT EXISTS `ly_atme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wid` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ly_collect`
--

CREATE TABLE IF NOT EXISTS `ly_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `wid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ly_comment`
--

CREATE TABLE IF NOT EXISTS `ly_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '',
  `time` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `wid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- 转存表中的数据 `ly_comment`
--

INSERT INTO `ly_comment` (`id`, `content`, `time`, `uid`, `wid`) VALUES
(53, '    ', 1485783636, 1, 69),
(52, ' ', 1485783568, 1, 69),
(51, 'test//@Lii :zzz', 1485780921, 1, 59),
(50, 'test//@Lii :zzz', 1485780921, 1, 67),
(49, '233 @hhh ', 1485755939, 1, 58),
(54, 'xxxx', 1485842920, 1, 70),
(55, '挺不错', 1486221275, 1, 73),
(56, 'QQQ', 1486225982, 1, 70),
(57, 'xxxx', 1486226010, 1, 70);

-- --------------------------------------------------------

--
-- 表的结构 `ly_follow`
--

CREATE TABLE IF NOT EXISTS `ly_follow` (
  `follow` int(10) unsigned NOT NULL,
  `fans` int(10) unsigned NOT NULL,
  `gid` int(11) NOT NULL,
  KEY `follow` (`follow`),
  KEY `fans` (`fans`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ly_follow`
--

INSERT INTO `ly_follow` (`follow`, `fans`, `gid`) VALUES
(1, 2, 0),
(1, 3, 0),
(4, 1, 0),
(3, 1, 0),
(3, 2, 37),
(2, 1, 0),
(1, 4, 0),
(1, 5, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ly_group`
--

CREATE TABLE IF NOT EXISTS `ly_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '分组名称',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `ly_group`
--

INSERT INTO `ly_group` (`id`, `name`, `uid`) VALUES
(43, '嘻嘻嘻', 1),
(42, 'zzz', 1),
(41, 'xxx', 1),
(40, ' 噢噢噢', 2),
(39, 'www', 2),
(38, '哈哈', 2),
(37, '扯蛋', 2),
(35, '同事', 1),
(34, '同学', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ly_letter`
--

CREATE TABLE IF NOT EXISTS `ly_letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL COMMENT '发信人',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '私信内容',
  `time` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ly_pic`
--

CREATE TABLE IF NOT EXISTS `ly_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mini` varchar(60) NOT NULL DEFAULT '',
  `medium` varchar(60) NOT NULL DEFAULT '',
  `max` varchar(60) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ly_tweet`
--

CREATE TABLE IF NOT EXISTS `ly_tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '',
  `isturn` int(11) NOT NULL DEFAULT '0' COMMENT '存储转发内容的id号，需要与微博主键ID类型一致才能保证id号长度不会超出\n\n0为原创',
  `time` int(10) unsigned NOT NULL,
  `turn` int(10) unsigned NOT NULL DEFAULT '0',
  `collect` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `pic` varchar(60) DEFAULT NULL,
  `thumbpic` varchar(60) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `ly_tweet`
--

INSERT INTO `ly_tweet` (`id`, `content`, `isturn`, `time`, `turn`, `collect`, `comment`, `pic`, `thumbpic`, `uid`) VALUES
(70, 'MDZZ', 0, 1485786352, 0, 0, 3, './Uploads/pic/588f4cf04a6a3.jpg', './Uploads/pic/588f4cf04a6a3_thumb.jpg', 1),
(58, '原文', 0, 1485754665, 1, 0, 1, NULL, NULL, 1),
(59, '原文+图片', 0, 1485754685, 2, 0, 1, './Uploads/pic/588ed13ce2453.jpg', './Uploads/pic/588ed13ce2453_thumb.jpg', 1),
(69, 'test//@Lii :zzz', 59, 1485780921, 0, 0, 2, NULL, NULL, 1),
(68, 'zzzz', 0, 1485771444, 0, 0, 0, NULL, NULL, 2),
(66, '233 @hhh ', 58, 1485755939, 0, 0, 0, NULL, NULL, 1),
(67, 'zzz', 59, 1485765764, 1, 0, 1, NULL, NULL, 1),
(71, '', 0, 1485843042, 0, 0, 0, NULL, NULL, 1),
(72, '哈哈哈', 0, 1485843099, 1, 0, 0, NULL, NULL, 1),
(73, '哈哈', 0, 1486221248, 0, 0, 1, NULL, NULL, 1),
(74, '啊', 72, 1486221287, 0, 0, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ly_user`
--

CREATE TABLE IF NOT EXISTS `ly_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` char(20) NOT NULL COMMENT '账号\n加上索引',
  `password` char(32) NOT NULL,
  `registime` int(10) unsigned NOT NULL,
  `lock` tinyint(1) unsigned NOT NULL COMMENT '0--锁定\n1--恢复',
  PRIMARY KEY (`id`),
  KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='（innoDB索引较慢）用户表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ly_user`
--

INSERT INTO `ly_user` (`id`, `account`, `password`, `registime`, `lock`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1484706890, 0),
(2, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 1484706910, 0),
(3, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 1484706927, 0),
(4, 'admin3', '21232f297a57a5a743894a0e4a801fc3', 1484707011, 0),
(5, 'admin4', '21232f297a57a5a743894a0e4a801fc3', 1484809189, 0),
(6, 'admin5', '21232f297a57a5a743894a0e4a801fc3', 1484809287, 0),
(7, 'admin6', '21232f297a57a5a743894a0e4a801fc3', 1484809313, 0),
(8, 'admin7', '21232f297a57a5a743894a0e4a801fc3', 1484809374, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ly_userinfo`
--

CREATE TABLE IF NOT EXISTS `ly_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL COMMENT '用户昵称',
  `truename` varchar(45) DEFAULT NULL COMMENT '真实名称',
  `sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `location` varchar(45) NOT NULL DEFAULT '' COMMENT '所在地',
  `constellation` char(10) NOT NULL DEFAULT '' COMMENT '星座',
  `intro` varchar(100) NOT NULL DEFAULT '' COMMENT '简介',
  `face50` varchar(60) NOT NULL DEFAULT '' COMMENT '50*50头像',
  `face80` varchar(60) NOT NULL DEFAULT '',
  `face180` varchar(60) NOT NULL DEFAULT '',
  `style` varchar(45) NOT NULL DEFAULT 'default',
  `follow` int(10) unsigned NOT NULL DEFAULT '0',
  `fans` int(10) unsigned NOT NULL DEFAULT '0',
  `blog` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL COMMENT '所属用户ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ly_userinfo`
--

INSERT INTO `ly_userinfo` (`id`, `username`, `truename`, `sex`, `location`, `constellation`, `intro`, `face50`, `face80`, `face180`, `style`, `follow`, `fans`, `blog`, `uid`) VALUES
(2, 'hhh', '', '男', '', '', '', './Uploads/face/5888a91d5a377_50.jpg', './Uploads/face/5888a91d5a377_80.jpg', './Uploads/face/5888a91d5a377_180.jpg', 'default', 0, 0, 0, 2),
(3, 'admin2', NULL, '男', '', '', '', '', '', '', 'default', 0, 0, 0, 3),
(4, 'admin3', NULL, '男', '', '', '', '', '', '', 'default', 0, 0, 0, 4),
(5, 'admin4', NULL, '男', '', '', '', '', '', '', 'default', 0, 0, 0, 5),
(6, 'admin5', NULL, '男', '', '', '', '', '', '', 'default', 0, 0, 0, 6),
(7, 'admin6', NULL, '男', '', '', '', '', '', '', 'default', 0, 0, 0, 7),
(8, 'admin7', NULL, '男', '', '', '', '', '', '', 'default', 0, 0, 0, 8),
(1, 'Lii', '', '男', '', '', '', './Uploads/face/5888a7cf7b075_50.jpg', './Uploads/face/5888a7cf7b075_80.jpg', './Uploads/face/5888a7cf7b075_180.jpg', 'default', 0, 0, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
