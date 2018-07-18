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
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `goods_id` varchar(128) NOT NULL,
  `good_name` varchar(128) NOT NULL,
  `kind` varchar(32) NOT NULL,
  `detail` varchar(1000) DEFAULT '',
  `type` varchar(32) DEFAULT '库存商品',
  `handler` varchar(32) DEFAULT '义成',
  `start_time` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` varchar(32) DEFAULT '',
  `del` int(11) DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES ('B123','苹果','食品','山东水晶红富士','未上架','义成','2018-07-11 10:00:01','2018-07-11 10:00:01','正常',0),('B456','铅笔','文具','日本进口','已上架','义成','2018-07-11 11:00:01','2018-07-11 11:00:01','正常',0);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
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
INSERT INTO `nav` VALUES ('进销存系统','订单管理','','bar',1,0,'site/welcome','正常',0),('进销存系统','采购管理','','bar',1,1,'site/welcome','正常',0),('进销存系统','仓库管理','','bar',1,2,'site/welcome','正常',0),('进销存系统','待办事项','','bar',1,3,'site/welcome','正常',0),('进销存系统','订单管理','订单详情','item',1,0,'order/order-info','正常',0),('进销存系统','订单管理','销售榜单','item',1,1,'order/order-rank','正常',0),('进销存系统','采购管理','商品物料','item',1,0,'site/pruch-goods','正常',0),('进销存系统','采购管理','办公设备','item',1,1,'site/purch-office','正常',0),('进销存系统','仓库管理','库存信息','item',1,0,'reper-stock','正常',0),('进销存系统','仓库管理','仓库信息','item',1,1,'reper-info','正常',0),('进销存系统','仓库管理','领用信息','item',1,2,'reper-lend','正常',0),('进销存系统','仓库管理','出入库申请','item',1,3,'reper-inout','正常',0),('进销存系统','仓库管理','退料管理','item',1,4,'reper-return','正常',0),('进销存系统','仓库管理','废料管理','item',1,5,'reper-rubbish','正常',0),('进销存系统','待办事项','流程审批','item',1,0,'site/flow-approve','正常',0);
/*!40000 ALTER TABLE `nav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` varchar(128) NOT NULL,
  `type` varchar(32) NOT NULL,
  `title` varchar(64) DEFAULT '',
  `customer_id` varchar(128) NOT NULL,
  `good_id` varchar(128) NOT NULL,
  `good_name` varchar(128) NOT NULL,
  `good_count` int(32) NOT NULL,
  `amountofmoney` decimal(9,2) NOT NULL DEFAULT '0.00',
  `logis_id` varchar(128) DEFAULT NULL,
  `handler` varchar(32) DEFAULT '义成',
  `start_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` varchar(32) DEFAULT '',
  `del` int(11) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES ('1','销售订单','李大爷的订单','1','pingguo','苹果',100,1024.00,'圆通2134234','雪辉','2018-07-09 10:42:01','2018-07-09 23:42:01','2018-07-03 21:42:01','已成交',0),('2','采购订单','王大爷的订单','1','pingguo','铅笔',200,1024.00,'圆通2134234','雪辉','2018-07-09 10:42:01','2018-07-09 23:42:01','2018-07-03 21:42:01','未成交',0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trade`
--

DROP TABLE IF EXISTS `trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trade` (
  `trade_id` varchar(128) NOT NULL,
  `title` varchar(64) DEFAULT '',
  `customer_id` varchar(128) DEFAULT NULL,
  `project_id` int(64) DEFAULT NULL,
  `order_id` int(64) DEFAULT NULL,
  `detail` varchar(1000) DEFAULT '',
  `dealer` varchar(32) DEFAULT '义成',
  `handler` varchar(32) DEFAULT '义成',
  `start_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` varchar(32) DEFAULT '',
  `del` int(11) DEFAULT '0',
  PRIMARY KEY (`trade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade`
--

LOCK TABLES `trade` WRITE;
/*!40000 ALTER TABLE `trade` DISABLE KEYS */;
INSERT INTO `trade` VALUES ('2018070706698',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 10:36:56','2018-07-07 10:36:56',NULL,'订单被创建',0),('2018070707450',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:27:17','2018-07-07 11:27:17',NULL,'订单被创建',0),('2018070723253',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:16:36','2018-07-07 11:16:36',NULL,'订单被创建',0),('2018070723516',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:19:47','2018-07-07 11:19:47',NULL,'订单被创建',0),('2018070727988','买卖红薯','李逵',0,0,'第一笔生意','100','100','2018-07-07 11:43:05','2018-07-07 11:43:05',NULL,'订单被创建',0),('2018070733216',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 10:33:18','2018-07-07 10:33:18',NULL,'订单被创建',0),('2018070738419',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 10:46:49','2018-07-07 10:46:49',NULL,'订单被创建',0),('2018070747964',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:19:28','2018-07-07 11:19:28',NULL,'订单被创建',0),('2018070756867',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:26:02','2018-07-07 11:26:02',NULL,'订单被创建',0),('2018070767613',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 10:52:29','2018-07-07 10:52:29',NULL,'订单被创建',0),('2018070779188','3333','333',3333,0,'哈哈啊','义成','义成','2018-07-07 11:37:01','2018-07-07 11:37:01',NULL,'订单被创建',0),('2018070780571',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:14:40','2018-07-07 11:14:40',NULL,'订单被创建',0),('2018070787510',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 11:21:22','2018-07-07 11:21:22',NULL,'订单被创建',0),('2018070789183',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 10:28:05','2018-07-07 10:28:05',NULL,'订单被创建',0),('2018070793709',NULL,NULL,NULL,NULL,NULL,'义成','义成','2018-07-07 10:31:26','2018-07-07 10:31:26',NULL,'订单被创建',0),('2018071074838','巨凯波','巨白裤',0,0,'撒都发生地方发','100','100','2018-07-10 12:19:29','2018-07-10 12:19:29',NULL,'订单被创建',0);
/*!40000 ALTER TABLE `trade` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-18  5:51:47
