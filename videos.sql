/*
Navicat MySQL Data Transfer

Source Server         : seemytag
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : dbfasti

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-04-25 14:55:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `videos`
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contents` int(11) DEFAULT NULL,
  `id_content_type` int(11) DEFAULT NULL,
  `video` text,
  `class` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of videos
-- ----------------------------
