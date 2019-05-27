/*
 Navicat Premium Data Transfer

 Source Server         : remote
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : 127.0.0.1:3306
 Source Schema         : webim

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 27/05/2019 23:42:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sp_mail_log
-- ----------------------------
DROP TABLE IF EXISTS `sp_mail_log`;
CREATE TABLE `sp_mail_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `to` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subject` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `body` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `errors` tinyint(1) NOT NULL COMMENT '0 未失败 1 发送错误',
  `is_deleted` tinyint(1) NOT NULL COMMENT '0 未删除 1 已删除',
  `ctime` int(11) NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sp_mail_log
-- ----------------------------
INSERT INTO `sp_mail_log` VALUES (1, 'twomiao6666@163.com', '995200452@qq.com', 'Register Sina Account', 'Welcome to register ** website and become our member!', 0, 0, 1558971738);
INSERT INTO `sp_mail_log` VALUES (2, 'twomiao6666@163.com', '995200452@qq.com', 'Register Sina Account', 'Welcome to register ** website and become our member!', 0, 0, 1558971738);
INSERT INTO `sp_mail_log` VALUES (3, 'twomiao6666@163.com', '995200452@qq.com', 'Register Sina Account', 'Welcome to register ** website and become our member!', 0, 0, 1558971738);
INSERT INTO `sp_mail_log` VALUES (4, 'twomiao6666@163.com', '995200452@qq.com', 'Register Sina Account', 'Welcome to register ** website and become our member!', 0, 0, 1558971738);

SET FOREIGN_KEY_CHECKS = 1;
