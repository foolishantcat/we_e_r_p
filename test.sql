/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50718
Source Host           : 192.168.8.128:3306
Source Database       : we_erp

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2018-08-02 16:11:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `auth_id` bigint(22) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `authcode` int(32) NOT NULL DEFAULT '1' COMMENT '    --  当前权限分为5个等级:\r\n    -- 1 : 普通权限，所有员工所有\r\n    -- 2 : 普通管理权限（业务层）\r\n    -- 4 : 财务相关管理权限\r\n    -- 8 ： 高于财务相关权限，低于老板权限\r\n    -- 16 : 老板权限（最高权限）\r\n    -- 32 : 运维RD权限（上帝权限）',
  `level` varchar(32) NOT NULL DEFAULT '' COMMENT '限定的项目，catlog，bar，item',
  `item` varchar(64) NOT NULL DEFAULT '' COMMENT '项目内容，如交易管理（bar）',
  `visibility` int(11) NOT NULL DEFAULT '1' COMMENT '是否可见，1-可见，0-不可见',
  `status` varchar(64) NOT NULL DEFAULT '正常' COMMENT '当前行状态',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '变更时间',
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
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `group_id` int(64) NOT NULL DEFAULT '0' COMMENT '客户所属团队',
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
  `goods_id` bigint(128) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `goods_name` varchar(128) NOT NULL DEFAULT '' COMMENT '商品名称，如：苹果',
  `kind` varchar(32) NOT NULL DEFAULT '' COMMENT '商品种类，如：水果',
  `detail` varchar(1000) NOT NULL DEFAULT '' COMMENT '商品详细信息',
  `type` varchar(32) NOT NULL DEFAULT '库存商品' COMMENT '商品类型，其他，例如：需求商品,未上架，已下架',
  `handler_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作员ID',
  `handler` varchar(32) NOT NULL DEFAULT '义成' COMMENT '操作人，填写员工姓名',
  `start_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '第一次录入时间',
  `status` varchar(32) NOT NULL DEFAULT '' COMMENT '当前记录状态',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后一次操作时间',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COMMENT='【商品】商品种类表';

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '铅笔', '文具', '日本进口', '已上架', '0', '义成', '2018-07-11 11:00:01', '正常', '0', '2018-07-28 14:22:51');
INSERT INTO `goods` VALUES ('123', '苹果', '食品', '山东水晶红富士', '未上架', '0', '义成', '2018-07-11 10:00:01', '正常', '0', '2018-07-28 14:22:49');
INSERT INTO `goods` VALUES ('124', '1212121', '电脑耗材', '121212', '新建', '0', '义成', '1970-01-01 00:00:00', '正常', '0', '2018-07-28 14:24:28');
INSERT INTO `goods` VALUES ('125', '1212121', '电脑耗材', '121212', '新建', '0', '义成', '1970-01-01 00:00:00', '正常', '0', '2018-07-28 14:24:37');
INSERT INTO `goods` VALUES ('126', 'sdfdsf', '食品', 'sdfsdf', '新建', '0', '义成', '1970-01-01 00:00:00', '正常', '0', '2018-07-28 14:25:04');
INSERT INTO `goods` VALUES ('127', 'sdfdsf', '食品', 'sdfsdf', '新建', '0', '义成', '1970-01-01 00:00:00', '正常', '0', '2018-07-28 14:35:28');
INSERT INTO `goods` VALUES ('128', 'sdfdsf', '食品', 'sdfsdf', '新建', '0', '义成', '1970-01-01 00:00:00', '正常', '0', '2018-07-28 14:35:50');
INSERT INTO `goods` VALUES ('129', '第三方', '食品', '萨芬的说法', '新建', '0', '义成', '1970-01-01 00:00:00', '正常', '0', '2018-07-28 14:36:31');

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
INSERT INTO `nav` VALUES ('进销存系统', '采购管理', '商品物料', 'item', '1', '0', 'purch/purch-goods', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '采购管理', '办公设备', 'item', '1', '1', 'purch/purch-office', '正常', '0');
INSERT INTO `nav` VALUES ('进销存系统', '采购管理', '采购列表', 'item', '1', '2', 'purch/purch-list', '正常', '0');
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
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '订单编号（大写字符串+日期数字）',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '订单类型，如采购，销售',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '订单标题，如：某人的某些订单（只能由数字、字母、汉字组成）',
  `customer_id` varchar(128) NOT NULL DEFAULT '' COMMENT '客户id，为customer表的外键',
  `goods_id` varchar(128) NOT NULL DEFAULT '' COMMENT '商品id，为goods表外键',
  `goods_name` varchar(128) NOT NULL DEFAULT '' COMMENT '商品名称（只能由数字、字母、汉字组成）',
  `goods_count` int(32) NOT NULL DEFAULT '0' COMMENT '商品数量，单位“件”',
  `amountofmoney` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `logis_id` varchar(128) NOT NULL DEFAULT '' COMMENT '货运单号，为logistic表外键',
  `handler_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作人ID',
  `handler` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `start_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '订单开始时间',
  `end_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '订单结束时间',
  `end_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '结束日期',
  `status` varchar(32) NOT NULL DEFAULT '' COMMENT '订单当前状态',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除订单',
  `update_time` timestamp NOT NULL DEFAULT '1970-01-01 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '订单最后更新时间',
  PRIMARY KEY (`order_id`),
  KEY `end_time` (`end_time`),
  KEY `end_date` (`end_date`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '销售订单', '李大爷的订单', '1', 'pingguo', '苹果', '100', '1024.00', '圆通2134234', '1', '雪辉', '2018-07-09 10:42:01', '2018-07-30 21:42:01', '2018-07-30', '已成交', '0', '2018-07-25 22:42:32');
INSERT INTO `orders` VALUES ('2', '采购订单', '王大爷的订单', '1', 'pingguo', '铅笔', '200', '1024.00', '圆通2134234', '1', '雪辉', '2018-07-09 10:42:01', '2018-07-24 21:42:01', '2018-07-16', '未成交', '0', '2018-07-25 22:42:36');
INSERT INTO `orders` VALUES ('7', '1', '', '', '', '', '150', '0.00', '', '2', '议程', '2018-07-30 00:00:00', '2018-07-30 00:00:00', '2018-07-30', '', '0', '2018-07-25 23:32:02');
INSERT INTO `orders` VALUES ('8', '', '', '', '', '', '250', '0.00', '', '3', 'sd', '2018-07-30 00:00:00', '2018-07-31 00:00:00', '1970-01-01', '', '0', '2018-07-26 10:48:53');

-- ----------------------------
-- Table structure for trade
-- ----------------------------
DROP TABLE IF EXISTS `trade`;
CREATE TABLE `trade` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `trade_id` varchar(128) NOT NULL DEFAULT '' COMMENT '交易编号',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '交易名称',
  `customer_id` varchar(128) NOT NULL DEFAULT '' COMMENT '顾客ID',
  `project_id` int(64) NOT NULL DEFAULT '0' COMMENT '项目ID',
  `order_id` int(64) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `detail` varchar(255) NOT NULL DEFAULT '' COMMENT '详细信息',
  `dealer` varchar(32) NOT NULL DEFAULT '' COMMENT '跟单员',
  `handler` varchar(32) NOT NULL DEFAULT '' COMMENT '操作员',
  `start_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '开始时间',
  `end_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '订单完成时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='【交易】交易明细记录表';

-- ----------------------------
-- Records of trade
-- ----------------------------
