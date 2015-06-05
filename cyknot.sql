/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cyknot

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-05 17:52:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for knot_message
-- ----------------------------
DROP TABLE IF EXISTS `knot_message`;
CREATE TABLE `knot_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) DEFAULT NULL COMMENT 'openid',
  `stuid` int(10) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `college` varchar(50) DEFAULT NULL,
  `hometown` varchar(30) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `way` varchar(20) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `introduce` varchar(255) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `perfect` tinyint(1) DEFAULT '0',
  `has_img` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of knot_message
-- ----------------------------
INSERT INTO `knot_message` VALUES ('22', 'ouRCyjo24q67OUj5uH-e-ra_Jcp8', '2013211689', '王齐超', '计算机学院', '山东', 'QQ', '1269779078', '男', '帅帅帅', null, '0', '0');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `stu_id` int(10) unsigned NOT NULL,
  `weixin_id` varchar(15) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `hometown` varchar(16) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `way` varchar(30) NOT NULL,
  `introduce` varchar(255) DEFAULT NULL,
  `photo` varchar(20) NOT NULL,
  `sex` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('2013211567', '18883866922', '向文杰', '新疆', '理学院', '微信', '18883866933', '没人样刷卡费计算机地方卡死了塑料袋疯狂就斯洛伐克的森林狼考虑法规尽快离开', '2013211567.jpeg', '');
INSERT INTO `message` VALUES ('2013211678', null, '孔祥会', '山东', '通信工程', '手机', '18883866922', '挫的很', '2013211678.png', null);
INSERT INTO `message` VALUES ('2013211689', null, '王齐超', '山东', '计算机', 'QQ', '1269779078', '帅爆了', '2013211689.jpg', null);
