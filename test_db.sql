-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.7.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth` (
  `auth_id` varchar(128) NOT NULL,
  `authcode` int(32) NOT NULL DEFAULT '1',
  `level` varchar(32) NOT NULL DEFAULT 'item',
  `item` varchar(64) NOT NULL DEFAULT '',
  `visibility` int(11) NOT NULL DEFAULT '1',
  `status` varchar(64) DEFAULT '正常',
  `del` int(11) DEFAULT '0',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` varchar(128) NOT NULL,
  `group_id` int(64) DEFAULT NULL,
  `name_ch` varchar(64) NOT NULL DEFAULT '',
  `age` int(32) DEFAULT NULL,
  `education` varchar(64) DEFAULT NULL,
  `profession` varchar(64) DEFAULT NULL,
  `company` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nav`
--

DROP TABLE IF EXISTS `nav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nav` (
  `catalog_id` varchar(64) NOT NULL,
  `bar_id` varchar(64) DEFAULT '',
  `item_id` varchar(64) DEFAULT '',
  `level` varchar(32) NOT NULL DEFAULT 'item',
  `authcode` int(32) NOT NULL DEFAULT '1',
  `seq_num` int(32) NOT NULL DEFAULT '0',
  `view` varchar(256) DEFAULT 'site/welcome',
  `status` varchar(64) DEFAULT '正常',
  `del` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nav`
--

LOCK TABLES `nav` WRITE;
/*!40000 ALTER TABLE `nav` DISABLE KEYS */;
INSERT INTO `nav` VALUES ('进销存系统','交易管理','','bar',1,0,'site/welcome','正常',0),('进销存系统','订单管理','','bar',1,1,'site/welcome','正常',0),('进销存系统','采购管理','','bar',1,2,'site/welcome','正常',0),('进销存系统','库存管理','','bar',1,3,'site/welcome','正常',0),('进销存系统','商品管理','','bar',1,4,'site/welcome','正常',0),('进销存系统','仓库管理','','bar',1,5,'site/welcome','正常',0),('客户管理系统','客户信息','','bar',1,0,'site/welcome','正常',0),('客户管理系统','客户关怀','','bar',1,1,'site/welcome','正常',0),('客户管理系统','需求信息','','bar',1,2,'site/welcome','正常',0),('客户管理系统','售后服务','','bar',1,3,'site/welcome','正常',0),('客户管理系统','客户团队','','bar',1,4,'site/welcome','正常',0),('客户管理系统','客户挖掘','','bar',1,5,'site/welcome','正常',0),('客户管理系统','代理渠道','','bar',1,6,'site/welcome','正常',0),('客户管理系统','客户信息','特征画像','item',1,0,'site/client_info','正常',0),('客户管理系统','客户信息','客户项目','item',1,1,'site/client_project','正常',0),('客户管理系统','客户信息','合同信息','item',1,2,'site/client_contract','正常',0),('客户管理系统','客户关怀','礼品申请','item',1,0,'site/client_gift_ask','正常',0),('客户管理系统','客户关怀','往期关怀','item',1,1,'site/client_gift_history','正常',0),('客户管理系统','需求信息','查询需求','item',1,0,'site/client_demand','正常',0),('客户管理系统','需求信息','分析需求','item',1,1,'site/client_demand_analysis','正常',0),('客户管理系统','售后服务','申请售后','item',1,0,'site/client_service','正常',0),('客户管理系统','售后服务','服务记录','item',1,1,'site/client_service_history','正常',0),('客户管理系统','客户团队','大客户信息','item',1,0,'site/client_important','正常',0),('客户管理系统','客户团队','团队跟踪','item',1,1,'site/client_follow','正常',0),('客户管理系统','代理渠道','代理管理','item',1,1,'site/client_proxy','正常',0),('客户管理系统','代理渠道','渠道分析','item',1,2,'site/clinet_proxy_analysis','正常',0),('财务管理系统','固定资产','','bar',1,0,'site/welcome','正常',0),('财务管理系统','现金管理','','bar',1,1,'site/welcome','正常',0),('财务管理系统','应收款项','','bar',1,2,'site/welcome','正常',0),('财务管理系统','应付款项','','bar',1,3,'site/welcome','正常',0),('财务管理系统','薪资管理','','bar',1,4,'site/welcome','正常',0),('财务管理系统','报销管理','','bar',1,5,'site/welcome','正常',0),('财务管理系统','固定资产','资产信息','item',3,0,'site/permanent_info','正常',0),('财务管理系统','现金管理','现金信息','item',5,0,'site/cash_info','正常',0),('财务管理系统','应收款项','应收款管理','item',3,0,'site/receivable_mgr','正常',0),('财务管理系统','应付款项','应付款管理','item',3,0,'site/payable_mgr','正常',0),('财务管理系统','薪资管理','员工薪资管理','item',5,0,'site/salary_mgr','正常',0),('财务管理系统','薪资管理','员工薪资信息','item',3,1,'site/salary_info','正常',0),('财务管理系统','报销管理','员工报销审批','item',4,0,'site/claim_approve','正常',0),('ERP','员工信息','','bar',1,0,'site/welcome','正常',0),('ERP','差旅管理','','bar',1,1,'site/welcome','正常',0),('ERP','工资查询','','bar',1,3,'site/welcome','正常',0),('ERP','员工信息','我的信息','item',1,0,'site/staff_info','正常',0),('ERP','员工信息','员工信息管理','item',4,1,'site/staff_mgr','正常',0),('ERP','差旅管理','差旅申请','item',1,0,'site/trip_ask','正常',0),('ERP','差旅管理','差旅审批','item',4,1,'site/trip_approve','正常',0),('ERP','工资查询','我的工资条','item',1,0,'site/salary_info','正常',0),('公司管理','员工管理','','bar',1,0,'site/welcome','正常',0),('公司管理','审批管理','','bar',1,1,'site/welcome','正常',0),('公司管理','员工管理','入职/转正审批','item',5,0,'site/transform_mgr','正常',0),('公司管理','员工管理','离职审批','item',5,1,'site/leave_approve','正常',0),('公司管理','员工管理','权限管理','item',5,2,'site/auth_mgr','正常',0),('公司管理','审批管理','差旅审批','item',5,0,'site/trip_approve','正常',0),('公司管理','审批管理','休假审批','item',5,1,'site/leave_mgr','正常',0),('公司管理','工资管理','工资调整','item',5,0,'site/salary_info','正常',0),('进销存系统','交易管理','查询交易','item',1,0,'site/trade-query','正常',0),('进销存系统','交易管理','交易分析','item',1,1,'site/trade-analysis','正常',0),('进销存系统','交易管理','销售榜单','item',1,2,'site/trade-rank','正常',0),('进销存系统','交易管理','交易操作','item',2,3,'site/trade-handle','正常',0),('进销存系统','订单管理','查询订单','item',1,0,'site/order-query','正常',0),('进销存系统','订单管理','未支付订单','item',1,1,'site/order-unpay','正常',0),('进销存系统','订单管理','待发货订单','item',1,2,'site/order-unsend','正常',0),('进销存系统','订单管理','物流追踪','item',1,3,'site/order-logistics','正常',0),('进销存系统','订单管理','订单操作','item',2,4,'site/order-mgr','正常',0),('进销存系统','采购管理','礼品采购','item',1,0,'site/purch-gift','正常',0),('进销存系统','采购管理','办公采购','item',1,1,'site/purch-office','正常',0),('进销存系统','采购管理','商品采购','item',1,2,'site/purch-goods','正常',0),('进销存系统','采购管理','采购操作','item',1,3,'site/purch-handle','正常',0),('进销存系统','库存管理','查询库存','item',1,0,'supply-query','正常',0),('进销存系统','库存管理','领用申请','item',1,1,'supply-borrow','正常',0),('进销存系统','库存管理','申请入库','item',1,2,'supply-store','正常',0),('进销存系统','库存管理','申请出库','item',1,3,'supply-fetch','正常',0),('进销存系统','库存管理','库存操作','item',2,4,'supply-handle','正常',0),('进销存系统','商品管理','查询商品','item',1,0,'goods-query','正常',0),('进销存系统','商品管理','商品操作','item',2,1,'goods-handle','正常',0),('进销存系统','仓库管理','仓库信息','item',1,0,'repertory-info','正常',0),('进销存系统','仓库管理','申请仓库','item',1,1,'repertory-ask','正常',0),('进销存系统','仓库管理','废料管理','item',1,2,'repertory-rubbish','正常',0),('进销存系统','仓库管理','退料管理','item',1,3,'repertory-return','正常',0),('进销存系统','仓库管理','物流配送','item',1,4,'repertory-logistics','正常',0),('进销存系统','仓库管理','检验管理','item',1,5,'repertory-qa','正常',0),('进销存系统','仓库管理','仓库整理','item',2,6,'repertory-clean','正常',0);
/*!40000 ALTER TABLE `nav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` varchar(128) NOT NULL DEFAULT '' COMMENT '订单ID',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '订单类型',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '订单标题',
  `customer_id` varchar(128) NOT NULL,
  `good_id` varchar(128) NOT NULL DEFAULT '' COMMENT '商品ID',
  `good_name` varchar(128) NOT NULL DEFAULT '' COMMENT '商品名',
  `good_count` int(11) NOT NULL DEFAULT '0' COMMENT '订单商品数量',
  `logis_id` int(11) NOT NULL,
  `hander_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单所属人ID',
  `handler` varchar(32) NOT NULL DEFAULT '' COMMENT '订单所属人',
  `start_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  `end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '结束时间',
  `status` varchar(32) NOT NULL DEFAULT '',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '删除标记',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单基础表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--


--
-- Table structure for table `trade`
--

DROP TABLE IF EXISTS `trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `start_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  `end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '订单完成时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='【交易】交易明细记录表';


/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade`
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-09  7:39:58
