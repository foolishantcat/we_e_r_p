/*
Navicat MySQL Data Transfer

Source Server         : ethan_mysql
Source Server Version : 50722
Source Host           : 192.168.159.132:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-07-24 19:57:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `auth_id` varchar(128) NOT NULL,
  `authcode` int(32) NOT NULL DEFAULT '1' COMMENT '    --  当前权限分为5个等级:\r\n    -- 1 : 普通权限，所有员工所有\r\n    -- 2 : 普通管理权限（业务层）\r\n    -- 3 : 财务相关管理权限\r\n    -- 4 ： 高于财务相关权限，低于老板权限\r\n    -- 5 : 老板权限（最高权限）\r\n    -- 1314 : 运维RD权限（上帝权限）',
  `level` varchar(32) NOT NULL DEFAULT 'item' COMMENT '限定的项目，catlog，bar，item',
  `item` varchar(64) NOT NULL DEFAULT '' COMMENT '项目内容，如交易管理（bar）',
  `visibility` int(11) NOT NULL DEFAULT '1' COMMENT '是否可见，1-可见，0-不可见',
  `status` varchar(64) DEFAULT '正常' COMMENT '当前行状态',
  `del` int(11) DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth
-- ----------------------------

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` varchar(128) NOT NULL,
  `group_id` int(64) DEFAULT NULL COMMENT '客户所属团队',
  `name_ch` varchar(64) NOT NULL DEFAULT '' COMMENT '客户中文名',
  `age` int(32) DEFAULT NULL COMMENT '年龄',
  `education` varchar(64) DEFAULT NULL COMMENT '教育经历',
  `profession` varchar(64) DEFAULT NULL COMMENT '专业',
  `company` varchar(64) DEFAULT NULL COMMENT '公司',
  `country` varchar(64) DEFAULT NULL COMMENT '国家',
  `city` varchar(64) DEFAULT NULL COMMENT '城市',
  `address` varchar(128) DEFAULT NULL COMMENT '地址',
  `birthday` datetime DEFAULT NULL COMMENT '生日（需要校验）',
  `phone` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `proxy` int(11) DEFAULT '0',
  `follow_degree` int(11) NOT NULL DEFAULT '1',
  `satisfied` int(11) NOT NULL DEFAULT '7',
  `start_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `status` varchar(64) NOT NULL DEFAULT '',
  `del` int(11) DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `goods_id` varchar(128) NOT NULL,
  `good_name` varchar(128) NOT NULL COMMENT '商品名称，如：苹果',
  `kind` varchar(32) NOT NULL COMMENT '商品种类，如：水果',
  `detail` varchar(1000) DEFAULT '' COMMENT '商品详细信息',
  `type` varchar(32) DEFAULT '库存商品' COMMENT '商品类型，其他，例如：需求商品,未上架，已下架',
  `handler` varchar(32) DEFAULT '义成' COMMENT '操作人，填写员工姓名',
  `start_time` datetime DEFAULT NULL COMMENT '第一次录入时间',
  `update_date` datetime DEFAULT NULL COMMENT '最后一次操作时间',
  `status` varchar(32) DEFAULT '' COMMENT '当前记录状态',
  `del` int(11) DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('B123', '苹果', '食品', '山东水晶红富士', '未上架', '义成', '2018-07-11 10:00:01', '2018-07-11 10:00:01', '正常', '0');
INSERT INTO `goods` VALUES ('B456', '铅笔', '文具', '日本进口', '已上架', '义成', '2018-07-11 11:00:01', '2018-07-11 11:00:01', '正常', '0');

-- ----------------------------
-- Table structure for nav
-- ----------------------------
DROP TABLE IF EXISTS `nav`;
CREATE TABLE `nav` (
  `catalog_id` varchar(64) NOT NULL COMMENT '目录，对应页面如“进销存管理”',
  `bar_id` varchar(64) DEFAULT '' COMMENT '导航栏一级栏目，如：订单管理',
  `item_id` varchar(64) DEFAULT '' COMMENT '导航二级栏目，如：订单详情',
  `level` varchar(32) NOT NULL DEFAULT 'item' COMMENT '限定的项目，如当前行限定“item”',
  `authcode` int(32) NOT NULL DEFAULT '1' COMMENT '    当前权限分为5个等级:\r\n    1 : 普通权限，所有员工所有\r\n    2 : 普通管理权限（业务层）\r\n    3 : 财务相关管理权限\r\n    4 ： 高于财务相关权限，低于老板权限\r\n    5 : 老板权限（最高权限）\r\n    1314 : 运维RD权限（上帝权限）',
  `seq_num` int(32) NOT NULL DEFAULT '0' COMMENT '导航位置顺序索引,从0开始计数',
  `view` varchar(256) DEFAULT 'site/welcome' COMMENT '当前二级栏目重定向页面',
  `status` varchar(64) DEFAULT '正常' COMMENT '导航栏项目的状态',
  `del` int(11) DEFAULT '0' COMMENT '是否删除，1表示删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nav
-- ----------------------------
INSERT INTO `nav` VALUES ('进销存系统', '订单管理', '', 'bar', '1', '0', 'site/welcome', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '采购管理', '', 'bar', '1', '1', 'site/welcome', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '', 'bar', '1', '2', 'site/welcome', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '待办事项', '', 'bar', '1', '3', 'site/welcome', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '订单管理', '订单详情', 'item', '1', '0', 'order/order-info', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '订单管理', '销售榜单', 'item', '1', '1', 'order/order-rank', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '采购管理', '商品物料', 'item', '1', '0', 'purch/pruch-goods', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '采购管理', '办公设备', 'item', '1', '1', 'purch/purch-office', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '库存信息', 'item', '1', '0', 'reper/reper-stock', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '仓库信息', 'item', '1', '1', 'reper/reper-info', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '领用信息', 'item', '1', '2', 'reper/reper-lend', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '出入库申请', 'item', '1', '3', 'reper/reper-inout', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '退料管理', 'item', '1', '4', 'reper/reper-return', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '仓库管理', '废料管理', 'item', '1', '5', 'reper/reper-rubbish', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '待办事项', '流程审批', 'item', '1', '0', 'jxcitem/flow-approve', '正常', '0');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` varchar(128) NOT NULL COMMENT '订单编号（大写字符串+日期数字）',
  `type` varchar(32) NOT NULL COMMENT '订单类型，如采购，销售',
  `title` varchar(64) DEFAULT '' COMMENT '订单标题，如：某人的某些订单（只能由数字、字母、汉字组成）',
  `customer_id` varchar(128) NOT NULL COMMENT '客户id，为customer表的外键',
  `good_id` varchar(128) NOT NULL COMMENT '商品id，为goods表外键',
  `good_name` varchar(128) NOT NULL COMMENT '商品名称（只能由数字、字母、汉字组成）',
  `good_count` int(32) NOT NULL COMMENT '商品数量，单位“件”',
  `amountofmoney` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `logis_id` varchar(128) DEFAULT NULL COMMENT '货运单号，为logistic表外键',
  `handler` varchar(32) DEFAULT '义成' COMMENT '最后操作人',
  `start_time` datetime DEFAULT NULL COMMENT '订单开始时间',
  `update_time` datetime DEFAULT NULL COMMENT '订单最后更新时间',
  `end_time` datetime DEFAULT NULL COMMENT '订单结束时间',
  `status` varchar(32) DEFAULT '' COMMENT '订单当前状态',
  `del` int(11) DEFAULT '0' COMMENT '是否删除订单',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '销售订单', '李大爷的订单', '1', 'pingguo', '苹果', '100', '1024.00', '圆通2134234', '雪辉', '2018-07-09 10:42:01', '2018-07-09 23:42:01', '2018-07-03 21:42:01', '已成交', '0');
INSERT INTO `orders` VALUES ('2', '采购订单', '王大爷的订单', '1', 'pingguo', '铅笔', '200', '1024.00', '圆通2134234', '雪辉', '2018-07-09 10:42:01', '2018-07-09 23:42:01', '2018-07-03 21:42:01', '未成交', '0');
