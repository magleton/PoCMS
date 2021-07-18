/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.56.101
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : 192.168.56.101:3306
 Source Schema         : mydb

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 18/07/2021 20:13:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agency
-- ----------------------------
DROP TABLE IF EXISTS `agency`;
CREATE TABLE `agency`  (
  `id` int(11) NOT NULL COMMENT '主键ID',
  `company_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司名字',
  `bank_account` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '银行账户',
  `bank_deposit` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开户行',
  `balance` int(11) NULL DEFAULT NULL COMMENT '余额',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '代理商' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of agency
-- ----------------------------

-- ----------------------------
-- Table structure for appointment
-- ----------------------------
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `phone` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `id_card` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号',
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '状态:\n1 待预约\n2 预约中\n3 已经预约\n4 待使用\n5 已使用',
  `ext` json NULL COMMENT '扩展字段',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `scenic_area_id` int(11) NULL DEFAULT NULL COMMENT '景区ID',
  `scenic_spot_plan_id` int(11) NULL DEFAULT NULL COMMENT '景区套餐ID',
  `agency_id` int(11) NULL DEFAULT NULL COMMENT '代理商ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '预约' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of appointment
-- ----------------------------

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `filename` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '文件名字',
  `url` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'http  Url',
  `mark` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '广告管理' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banner
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名字',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '父级ID',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '路径',
  `ext` json NULL COMMENT '扩展字段',
  `type` int(255) NULL DEFAULT NULL COMMENT '类型',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (11, '文章分类XXXXX', 0, '0', '{\"author\": \"枫叶思源XXXX\"}', NULL, 1626596561, NULL);
INSERT INTO `category` VALUES (12, '文章分类XXXXX', 11, '0,11', '{\"author\": \"枫叶思源XXXX\"}', NULL, 1626596583, NULL);
INSERT INTO `category` VALUES (13, '文章分类XXXXX', 12, '0,11,12', '{\"author\": \"枫叶思源XXXX\"}', NULL, 1626596617, NULL);
INSERT INTO `category` VALUES (14, '文章分类XXXXX', 13, '0,11,12,13', '{\"author\": \"枫叶思源XXXX\"}', NULL, 1626596626, NULL);
INSERT INTO `category` VALUES (15, '文章分类XXXXX', 14, '0,11,12,13,14', '{\"author\": \"枫叶思源XXXX\"}', NULL, 1626596629, NULL);

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `target_id` int(11) NULL DEFAULT NULL COMMENT '目标ID',
  `target_type` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '目标类型',
  `ext` json NULL COMMENT '数据',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `category_id` int(11) NULL DEFAULT NULL COMMENT '分类',
  `title` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名字',
  `keywords` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '关键字',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `ext` json NULL,
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `aaa`(`category_id`) USING BTREE,
  CONSTRAINT `aaa` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for resource_management
-- ----------------------------
DROP TABLE IF EXISTS `resource_management`;
CREATE TABLE `resource_management`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `target_id` int(11) NULL DEFAULT NULL COMMENT '目标ID',
  `url` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'URL',
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名字',
  `size` int(11) NULL DEFAULT NULL COMMENT '大小',
  `type` smallint(6) NULL DEFAULT NULL COMMENT '类型:\n1 景区缩略图\n2 景区轮播图\n3 ....',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '资源管理表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of resource_management
-- ----------------------------

-- ----------------------------
-- Table structure for scenic_area
-- ----------------------------
DROP TABLE IF EXISTS `scenic_area`;
CREATE TABLE `scenic_area`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名字',
  `price` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '价格',
  `ext` json NULL,
  `province` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '省',
  `city` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '市',
  `area` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '区',
  `tel` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '地址',
  `synopsis` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '简介',
  `detail` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '详情',
  `created_at` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '景区' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scenic_area
-- ----------------------------

-- ----------------------------
-- Table structure for scenic_spot_area_relation
-- ----------------------------
DROP TABLE IF EXISTS `scenic_spot_area_relation`;
CREATE TABLE `scenic_spot_area_relation`  (
  `scenic_spot_plan_id` int(11) NOT NULL,
  `scenic_area_id` int(11) NOT NULL,
  PRIMARY KEY (`scenic_spot_plan_id`, `scenic_area_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '景区套餐关系表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scenic_spot_area_relation
-- ----------------------------

-- ----------------------------
-- Table structure for scenic_spot_plan
-- ----------------------------
DROP TABLE IF EXISTS `scenic_spot_plan`;
CREATE TABLE `scenic_spot_plan`  (
  `id` int(11) NOT NULL COMMENT '主键',
  `category_id` int(11) NOT NULL COMMENT '分类ID',
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐名字',
  `price` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐价格',
  `synopsis` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐描述',
  `detail` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐详情',
  `status` smallint(6) NULL DEFAULT NULL COMMENT '状态:\n0 停用\n1 正常',
  `ext` json NULL COMMENT '扩展字段',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '景区套餐' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scenic_spot_plan
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(11) NOT NULL COMMENT '主键ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统设置' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for sign_up
-- ----------------------------
DROP TABLE IF EXISTS `sign_up`;
CREATE TABLE `sign_up`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `phone` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `idCard` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号',
  `ext` json NULL COMMENT '扩展字段',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '报名' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sign_up
-- ----------------------------

-- ----------------------------
-- Table structure for user_profile
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_profile
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `open_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'openId',
  `phone` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话号码',
  `idCard` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号',
  `nickname` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '{d:order}\r\n  id desc\r\n{/d:order}' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'britton', '123456', '111', NULL, NULL, '枫叶思源', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
