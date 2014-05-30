/*
Navicat MySQL Data Transfer

Source Server         : seemytag
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : dbfasti

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2014-05-30 10:18:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `themes`
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themes` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of themes
-- ----------------------------
INSERT INTO `themes` VALUES ('56', 'theme2', '0');
INSERT INTO `themes` VALUES ('59', 'theme1', '0');
INSERT INTO `themes` VALUES ('62', 'theme5', '0');
INSERT INTO `themes` VALUES ('63', 'theme4', '1');
