/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : blog_demo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-12 21:32:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blogs
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time_created` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_updated` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES ('13', 'title 1', 'Lorem Ipsum is simply dummy text of the printing', '1499906117.828', null);
INSERT INTO `blogs` VALUES ('14', 'title 2', 'Lorem Ipsum is simply dummy text of the printing', '1499906128.5067', null);
INSERT INTO `blogs` VALUES ('15', 'title 3', 'Lorem Ipsum is simply dummy text of the printing', '1499906135.8495', null);
INSERT INTO `blogs` VALUES ('16', 'title 4', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '1499906321.1241', null);
