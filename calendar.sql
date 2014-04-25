/*
Navicat MySQL Data Transfer

Source Server         : seemytag
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : dbfasti

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-04-25 14:55:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `calendar`
-- ----------------------------
DROP TABLE IF EXISTS `calendar`;
CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `date_ini` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `location` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of calendar
-- ----------------------------
INSERT INTO `calendar` VALUES ('10', 'jhgfc', 'test', '2014-12-31 20:40:00', null, 'asasasas');
