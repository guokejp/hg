/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : hg

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2016-03-23 10:34:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hg_bill
-- ----------------------------
DROP TABLE IF EXISTS `hg_bill`;
CREATE TABLE `hg_bill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '0-包干，多次使用\r\n1-会议\r\n2-培训\r\n3-专项\r\n4-包干，一次一申请\r\n5-采购\r\n',
  `projectid` int(10) NOT NULL COMMENT '各种类型对应的预算项目id\r\n\r\n包干科目id\r\n单个会议id\r\n专项项目id等\r\n\r\n合同id\r\n\r\n一次性包干存其预算id\r\n',
  `contractmoneyid` int(10) NOT NULL COMMENT '表 Contractmoney id',
  `contractmoneyqishuid` int(2) NOT NULL COMMENT 'contractmoney中分期期数',
  `orderid` varchar(20) NOT NULL,
  `instaid` int(10) NOT NULL COMMENT '录入人员id',
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `remark` text NOT NULL,
  `timestamp` char(10) NOT NULL,
  `termid` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '是否报销\r\n0：未报销\r\n1：已报销\r\n2：审核拒绝',
  `chestaid` int(10) NOT NULL COMMENT '审核人id',
  `unitid` int(10) NOT NULL,
  `confirm` decimal(10,2) NOT NULL COMMENT '核批金额',
  `cremark` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `billID` (`id`) USING BTREE,
  KEY `projectID` (`projectid`) USING BTREE,
  KEY `sectionID` (`sectionid`) USING BTREE,
  KEY `staffID` (`staffid`) USING BTREE,
  KEY `termID` (`termid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_bill
-- ----------------------------

-- ----------------------------
-- Table structure for hg_bill_cailv
-- ----------------------------
DROP TABLE IF EXISTS `hg_bill_cailv`;
CREATE TABLE `hg_bill_cailv` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `billid` int(10) NOT NULL,
  `place` varchar(50) NOT NULL,
  `day` tinyint(2) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1：会议\r\n2：培训\r\n3：其它',
  `people` varchar(255) NOT NULL COMMENT '出差人员',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_bill_cailv
-- ----------------------------

-- ----------------------------
-- Table structure for hg_catbudget
-- ----------------------------
DROP TABLE IF EXISTS `hg_catbudget`;
CREATE TABLE `hg_catbudget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `termid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `categoryid` int(10) NOT NULL,
  `init_money` decimal(10,2) NOT NULL COMMENT '初始化金额',
  `money` decimal(10,2) NOT NULL,
  `timestamp` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catbudgetID` (`id`) USING BTREE,
  KEY `termID` (`termid`) USING BTREE,
  KEY `unitID` (`unitid`) USING BTREE,
  KEY `sectionID` (`sectionid`) USING BTREE,
  KEY `staffID` (`staffid`) USING BTREE,
  KEY `catgroyID` (`categoryid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_catbudget
-- ----------------------------

-- ----------------------------
-- Table structure for hg_category
-- ----------------------------
DROP TABLE IF EXISTS `hg_category`;
CREATE TABLE `hg_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `once` tinyint(1) NOT NULL COMMENT '1：多次使用\r\n0：一次使用',
  `level` tinyint(2) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `bx_ord` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catgroryid` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_category
-- ----------------------------

-- ----------------------------
-- Table structure for hg_catlog
-- ----------------------------
DROP TABLE IF EXISTS `hg_catlog`;
CREATE TABLE `hg_catlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `termid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `categoryid` int(10) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `billid` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0-初始化预算\r\n1-后台修改，增加\r\n2-后台修改，减少\r\n3-预算申请，添加\r\n4-报销',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_catlog
-- ----------------------------
INSERT INTO `hg_catlog` VALUES ('209', '4', '1', '1', '1', '95', '1212.00', '1456194952', '0', '0');
INSERT INTO `hg_catlog` VALUES ('210', '4', '1', '1', '1', '97', '1212.00', '1456195315', '0', '0');
INSERT INTO `hg_catlog` VALUES ('211', '4', '1', '1', '1', '98', '21.00', '1456195590', '0', '0');

-- ----------------------------
-- Table structure for hg_conference
-- ----------------------------
DROP TABLE IF EXISTS `hg_conference`;
CREATE TABLE `hg_conference` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `termid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `number` int(10) NOT NULL,
  `month` tinyint(2) NOT NULL,
  `duration` float(3,1) NOT NULL,
  `average` decimal(10,2) NOT NULL,
  `basemoney` decimal(10,2) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `unitid` int(10) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `confirm` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_conference
-- ----------------------------

-- ----------------------------
-- Table structure for hg_contract
-- ----------------------------
DROP TABLE IF EXISTS `hg_contract`;
CREATE TABLE `hg_contract` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specialid` int(10) NOT NULL COMMENT '一次申请：存special_other表id\r\n多次：存spebudget表的id',
  `isother` tinyint(1) NOT NULL COMMENT '是否为一次一申请的\r\n0-多次申请，来自表special\r\n1-一次一申请，来自表specia_other',
  `name` varchar(60) NOT NULL,
  `procurement` tinyint(1) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `project` tinyint(1) NOT NULL,
  `goods` tinyint(1) NOT NULL,
  `service` tinyint(1) NOT NULL,
  `projectmoney` decimal(10,2) NOT NULL,
  `projectremark` text NOT NULL,
  `goodsmoney` decimal(10,2) NOT NULL,
  `goodsremark` text NOT NULL,
  `servicemoney` decimal(10,2) NOT NULL,
  `serviceremark` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `isover` tinyint(1) NOT NULL COMMENT '是否报销完结',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_contract
-- ----------------------------

-- ----------------------------
-- Table structure for hg_contract_money
-- ----------------------------
DROP TABLE IF EXISTS `hg_contract_money`;
CREATE TABLE `hg_contract_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contractid` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `first` decimal(10,2) NOT NULL,
  `second` decimal(10,2) NOT NULL,
  `third` decimal(10,2) NOT NULL,
  `fourth` decimal(10,2) NOT NULL,
  `fifth` decimal(10,2) NOT NULL,
  `warranty` decimal(10,2) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `firststatus` tinyint(1) NOT NULL,
  `secondstatus` tinyint(1) NOT NULL,
  `thirdstatus` tinyint(1) NOT NULL,
  `fourthstatus` tinyint(1) NOT NULL,
  `fifthstatus` tinyint(1) NOT NULL,
  `warrantystatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_contract_money
-- ----------------------------

-- ----------------------------
-- Table structure for hg_income
-- ----------------------------
DROP TABLE IF EXISTS `hg_income`;
CREATE TABLE `hg_income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(20) NOT NULL,
  `termid` int(10) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `categoryid` int(10) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `remark` text NOT NULL,
  `timestamp` char(10) NOT NULL,
  `once` tinyint(1) NOT NULL COMMENT '0：一次一申请\r\n1：多次申请',
  `name` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0：未审核\r\n1：审核通过\r\n2：审核拒绝',
  `confirm` decimal(10,2) NOT NULL,
  `cremark` text NOT NULL,
  `unitid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_income
-- ----------------------------

-- ----------------------------
-- Table structure for hg_oncebudget
-- ----------------------------
DROP TABLE IF EXISTS `hg_oncebudget`;
CREATE TABLE `hg_oncebudget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `termid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `categoryid` int(10) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0：未申请报销\r\n1：申请报销未审核\r\n2：申请报销并审核通过',
  `confirm` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_oncebudget
-- ----------------------------

-- ----------------------------
-- Table structure for hg_placard
-- ----------------------------
DROP TABLE IF EXISTS `hg_placard`;
CREATE TABLE `hg_placard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `highlight` tinyint(1) NOT NULL,
  `bold` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `timestamp` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_placard
-- ----------------------------

-- ----------------------------
-- Table structure for hg_role
-- ----------------------------
DROP TABLE IF EXISTS `hg_role`;
CREATE TABLE `hg_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `rules` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_role
-- ----------------------------
INSERT INTO `hg_role` VALUES ('1', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39');
INSERT INTO `hg_role` VALUES ('2', '系统财务', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39');
INSERT INTO `hg_role` VALUES ('3', '系统政府采购', '20,21');
INSERT INTO `hg_role` VALUES ('5', '单位政府采购', '19,20');
INSERT INTO `hg_role` VALUES ('4', '单位财务', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35');
INSERT INTO `hg_role` VALUES ('6', '普通角色', '1,14,15,16,17,18,19');

-- ----------------------------
-- Table structure for hg_rule
-- ----------------------------
DROP TABLE IF EXISTS `hg_rule`;
CREATE TABLE `hg_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_rule
-- ----------------------------
INSERT INTO `hg_rule` VALUES ('1', 'Home/Mywages/index', '个人工资', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('2', 'Home/Wages/index', '工资管理', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('3', 'Home/Zhixingadmin/budgetadd', '预算执行/数据录入/行政预算录入', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('4', 'Home/Zhixingchoose/usechoose', '预算执行/数据录入/收入支出录入', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('5', 'Home/Zhixingchoose/wuxiangchoose', '预算执行/数据录入/五项专用录入', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('6', 'Home/Zhixingadmin/budgetggoverlook', '预算执行/数据修改/行政预算修改', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('7', 'Home/Zhixingchoose/useggchoose', '预算执行/数据修改/收入支出修改', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('8', 'Home/Zhixingchoose/wuxiangggchoose', '预算执行/数据修改/五项专用修改', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('9', 'Home/Zhixingadmin/looktypechoose', '预算执行/统计查询/行政', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('10', 'Home/Zhixingshiye/look', '预算执行/统计查询/事业', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('11', 'Home/Zhixingqiye/look', '预算执行/统计查询/企业', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('12', 'Home/Zhixingshetuan/look', '预算执行/统计查询/社团', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('13', 'Home/Zhixingwuxiang/looktypechoose', '预算执行/统计查询/五项专用查询', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('14', 'Home/Bill/add', '报销单录入', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('15', 'Home/Bill/index', '报销单查询', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('16', 'Home/Income/search', '部门预算查询', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('17', 'Home/Specialother/index', '采购查询', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('18', 'Home/Income/add', '部门预算申请', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('19', 'Home/Income/index', '预算申请查询', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('20', 'Home/Contract/add', '政府采购计划/计划录入', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('21', 'Home/Contract/index', '政府采购计划/合同录入', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('22', 'Home/Contract/look', '政府采购计划/合同查询', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('23', 'Home/Income/audit', '单位基础数据/预算申请审批', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('24', 'Home/Bill/audit', '单位基础数据/报销审批', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('25', 'Home/Specialother/audit', '单位基础数据/采购审批（其它）', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('26', 'Home/Conference/index', '单位基础数据/会议计划及预算', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('27', 'Home/Train/index', '单位基础数据/教育培训计划及预算', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('28', 'Home/Spebudget/index', '单位基础数据/专项预算', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('29', 'Home/Catbudget/index', '单位基础数据/包干项目预算', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('30', 'Home/Catbudget/report', '单位基础数据/包干项目预算汇总', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('31', 'Home/Unit/index', '单位管理', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('32', 'Home/Section/index', '部门管理', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('33', 'Home/Role/index', '角色管理', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('34', 'Home/Staff/index', '员工管理', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('35', 'Home/Placard/add', '发布公告', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('36', 'Home/Placard/index', '公告列表', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('37', 'Home/Term/index', '账期结转', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('38', 'Home/Category/index', '包干项目', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('39', 'Home/Special/index', '专项项目', '1', '1', '');
INSERT INTO `hg_rule` VALUES ('40', 'Home/Database/index', '数据库管理', '1', '1', '');

-- ----------------------------
-- Table structure for hg_section
-- ----------------------------
DROP TABLE IF EXISTS `hg_section`;
CREATE TABLE `hg_section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unitid` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `selock` tinyint(1) NOT NULL COMMENT '锁定',
  `timestamp` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_section
-- ----------------------------
INSERT INTO `hg_section` VALUES ('1', '1', '关领导', '0', '1421654658');
INSERT INTO `hg_section` VALUES ('2', '1', '财务处', '0', '1421654805');
INSERT INTO `hg_section` VALUES ('3', '2', '缉私局领导', '0', '1421654976');
INSERT INTO `hg_section` VALUES ('4', '1', '办公室', '0', '1421654698');
INSERT INTO `hg_section` VALUES ('5', '1', '法规处', '0', '1421654711');
INSERT INTO `hg_section` VALUES ('6', '1', '关税处', '0', '1421654720');
INSERT INTO `hg_section` VALUES ('7', '1', '监管通关处', '0', '1421654735');
INSERT INTO `hg_section` VALUES ('8', '1', '加工贸易监管处', '0', '1421654758');
INSERT INTO `hg_section` VALUES ('9', '1', '综合统计处', '0', '1421654768');
INSERT INTO `hg_section` VALUES ('10', '1', '稽查处', '0', '1421654776');
INSERT INTO `hg_section` VALUES ('11', '1', '风险管理处', '0', '1421654787');
INSERT INTO `hg_section` VALUES ('12', '1', '技术处', '0', '1421654797');
INSERT INTO `hg_section` VALUES ('13', '1', '关务保障处', '0', '1421654819');
INSERT INTO `hg_section` VALUES ('14', '1', '人事教育处', '0', '1421654831');
INSERT INTO `hg_section` VALUES ('15', '1', '思想政治工作办公室', '0', '1421654842');
INSERT INTO `hg_section` VALUES ('16', '1', '监察审计室', '0', '1421654850');
INSERT INTO `hg_section` VALUES ('17', '1', '审单处', '0', '1421654880');
INSERT INTO `hg_section` VALUES ('18', '1', '现场业务处', '0', '1421654889');
INSERT INTO `hg_section` VALUES ('19', '1', '机关服务中心', '0', '1421654909');
INSERT INTO `hg_section` VALUES ('20', '2', '办公室', '0', '1421654988');
INSERT INTO `hg_section` VALUES ('21', '2', '法制处', '0', '1421654999');
INSERT INTO `hg_section` VALUES ('22', '2', '情报技术处', '0', '1421655010');
INSERT INTO `hg_section` VALUES ('23', '2', '侦查处', '0', '1421655019');
INSERT INTO `hg_section` VALUES ('24', '2', '直属队', '0', '1421655028');
INSERT INTO `hg_section` VALUES ('25', '2', '查私处', '0', '1421655037');
INSERT INTO `hg_section` VALUES ('26', '2', '机场分局', '0', '1421655054');
INSERT INTO `hg_section` VALUES ('27', '2', '政治处', '0', '1421655081');
INSERT INTO `hg_section` VALUES ('28', '2', '绵阳海关缉私分局', '0', '1421655092');
INSERT INTO `hg_section` VALUES ('29', '2', '综保区海关缉私分局', '0', '1421655106');
INSERT INTO `hg_section` VALUES ('30', '2', '驻泸州办事处缉私分局', '0', '1421655159');
INSERT INTO `hg_section` VALUES ('31', '3', '机场海关领导', '0', '1421655307');
INSERT INTO `hg_section` VALUES ('32', '3', '办公室', '0', '1421655350');
INSERT INTO `hg_section` VALUES ('33', '3', '通关科', '0', '1421655359');
INSERT INTO `hg_section` VALUES ('34', '3', '监管科', '0', '1421655367');
INSERT INTO `hg_section` VALUES ('35', '3', '快件科', '0', '1421655376');
INSERT INTO `hg_section` VALUES ('36', '3', '旅检一科', '0', '1421655384');
INSERT INTO `hg_section` VALUES ('37', '3', '旅检二科', '0', '1421655396');
INSERT INTO `hg_section` VALUES ('38', '3', '旅检三科', '0', '1421655405');
INSERT INTO `hg_section` VALUES ('39', '3', '综合业务科', '0', '1421655415');
INSERT INTO `hg_section` VALUES ('40', '4', '乐山海关领导', '0', '1421655431');
INSERT INTO `hg_section` VALUES ('41', '4', '办公室', '0', '1421655443');
INSERT INTO `hg_section` VALUES ('42', '4', '通关科', '0', '1421655464');
INSERT INTO `hg_section` VALUES ('43', '4', '监管科', '0', '1421655474');
INSERT INTO `hg_section` VALUES ('44', '4', '综合业务科', '0', '1421655481');
INSERT INTO `hg_section` VALUES ('45', '4', '行财科', '0', '1421655489');
INSERT INTO `hg_section` VALUES ('46', '5', '绵阳海关领导', '0', '1421655502');
INSERT INTO `hg_section` VALUES ('47', '5', '办公室', '0', '1421655513');
INSERT INTO `hg_section` VALUES ('48', '5', '通关科', '0', '1421655557');
INSERT INTO `hg_section` VALUES ('49', '5', '监管一科', '0', '1421655566');
INSERT INTO `hg_section` VALUES ('50', '5', '监管二科', '0', '1421655574');
INSERT INTO `hg_section` VALUES ('51', '5', '综合业务科', '0', '1421655583');
INSERT INTO `hg_section` VALUES ('52', '5', '行财科', '0', '1421655590');
INSERT INTO `hg_section` VALUES ('53', '6', '攀枝花海关领导', '0', '1421655607');
INSERT INTO `hg_section` VALUES ('54', '6', '办公室', '0', '1421655618');
INSERT INTO `hg_section` VALUES ('55', '6', '通关科', '0', '1421655626');
INSERT INTO `hg_section` VALUES ('56', '6', '监管科', '0', '1421655635');
INSERT INTO `hg_section` VALUES ('57', '6', '综合业务科', '0', '1421655642');
INSERT INTO `hg_section` VALUES ('58', '7', '综保区海关领导', '0', '1421655659');
INSERT INTO `hg_section` VALUES ('59', '7', '办公室', '0', '1421655671');
INSERT INTO `hg_section` VALUES ('60', '7', '通关一科', '0', '1421655680');
INSERT INTO `hg_section` VALUES ('61', '7', '通关二科', '0', '1421655693');
INSERT INTO `hg_section` VALUES ('62', '7', '监管一科', '0', '1421655703');
INSERT INTO `hg_section` VALUES ('63', '7', '监管二科', '0', '1421655712');
INSERT INTO `hg_section` VALUES ('64', '7', '监管三科', '0', '1421655721');
INSERT INTO `hg_section` VALUES ('65', '7', '综合业务科', '0', '1421655745');
INSERT INTO `hg_section` VALUES ('66', '7', '财务科', '0', '1421655760');
INSERT INTO `hg_section` VALUES ('67', '8', '德阳海关领导', '0', '1421655780');
INSERT INTO `hg_section` VALUES ('68', '8', '办公室', '0', '1421655791');
INSERT INTO `hg_section` VALUES ('69', '8', '监管科', '0', '1421655799');
INSERT INTO `hg_section` VALUES ('70', '8', '综合业务科', '0', '1421655806');
INSERT INTO `hg_section` VALUES ('71', '9', '遂宁海关领导', '0', '1421655824');
INSERT INTO `hg_section` VALUES ('72', '9', '办公室', '0', '1421655833');
INSERT INTO `hg_section` VALUES ('73', '9', '综合业务科', '0', '1421655840');
INSERT INTO `hg_section` VALUES ('74', '10', '驻车办事处领导', '0', '1421655867');
INSERT INTO `hg_section` VALUES ('75', '10', '通关二科', '0', '1421655877');
INSERT INTO `hg_section` VALUES ('76', '10', '监管二科', '0', '1421655886');
INSERT INTO `hg_section` VALUES ('77', '11', '邮局办事处领导', '0', '1421655907');
INSERT INTO `hg_section` VALUES ('78', '11', '综合科', '0', '1421655917');
INSERT INTO `hg_section` VALUES ('79', '11', '邮检科', '0', '1421655924');
INSERT INTO `hg_section` VALUES ('80', '12', '自贡办事处领导', '0', '1421655938');
INSERT INTO `hg_section` VALUES ('81', '12', '办公室', '0', '1421655948');
INSERT INTO `hg_section` VALUES ('82', '12', '通关科', '0', '1421655956');
INSERT INTO `hg_section` VALUES ('83', '12', '监管科', '0', '1421655965');
INSERT INTO `hg_section` VALUES ('84', '12', '综合业务科', '0', '1421655973');
INSERT INTO `hg_section` VALUES ('85', '13', '泸州办事处领导', '0', '1424920603');
INSERT INTO `hg_section` VALUES ('86', '13', '办公室', '0', '1424920643');
INSERT INTO `hg_section` VALUES ('87', '13', '通关科', '0', '1424920661');
INSERT INTO `hg_section` VALUES ('88', '13', '监管科', '0', '1424920668');
INSERT INTO `hg_section` VALUES ('89', '13', '综合业务科', '0', '1424920686');
INSERT INTO `hg_section` VALUES ('90', '14', '宜宾办事处领导', '0', '1424920784');
INSERT INTO `hg_section` VALUES ('91', '14', '办公室', '0', '1424920795');
INSERT INTO `hg_section` VALUES ('92', '14', '通关科', '0', '1424920800');
INSERT INTO `hg_section` VALUES ('93', '14', '监管科', '0', '1424920805');
INSERT INTO `hg_section` VALUES ('94', '15', '南充办事处领导', '0', '1424920897');
INSERT INTO `hg_section` VALUES ('95', '15', '综合科', '0', '1424920912');
INSERT INTO `hg_section` VALUES ('96', '15', '业务科', '0', '1424920920');
INSERT INTO `hg_section` VALUES ('97', '16', '海关学会', '0', '1424921068');
INSERT INTO `hg_section` VALUES ('98', '16', '报关协会', '0', '1424921075');
INSERT INTO `hg_section` VALUES ('99', '17', '足球协会', '1', '1425350338');
INSERT INTO `hg_section` VALUES ('100', '17', '篮球协会', '1', '1425350345');
INSERT INTO `hg_section` VALUES ('102', '1', '不注册表中', '1', '1454314776');

-- ----------------------------
-- Table structure for hg_spebudget
-- ----------------------------
DROP TABLE IF EXISTS `hg_spebudget`;
CREATE TABLE `hg_spebudget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specialid` int(10) NOT NULL,
  `firstallmoney` decimal(10,2) NOT NULL COMMENT '总量',
  `money` decimal(10,2) NOT NULL COMMENT '除去报销，剩余',
  `sectionid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `spebudgetid` (`id`) USING BTREE,
  KEY `sectionID` (`sectionid`) USING BTREE,
  KEY `unitID` (`unitid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_spebudget
-- ----------------------------

-- ----------------------------
-- Table structure for hg_special
-- ----------------------------
DROP TABLE IF EXISTS `hg_special`;
CREATE TABLE `hg_special` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gov` tinyint(1) NOT NULL COMMENT '0：非政府预算\r\n1：政府预算',
  `year` smallint(4) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `bx_ord` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specialid` (`id`) USING BTREE,
  KEY `specialpid` (`pid`) USING BTREE,
  KEY `unitID` (`unitid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_special
-- ----------------------------

-- ----------------------------
-- Table structure for hg_special_other
-- ----------------------------
DROP TABLE IF EXISTS `hg_special_other`;
CREATE TABLE `hg_special_other` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `year` char(4) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `confirm` tinyint(1) NOT NULL,
  `confirmmoney` decimal(10,2) NOT NULL,
  `cremark` varchar(100) DEFAULT NULL,
  `used` tinyint(1) NOT NULL COMMENT '0-没有用\r\n1-已经用',
  `usedmoney` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_special_other
-- ----------------------------

-- ----------------------------
-- Table structure for hg_spelog
-- ----------------------------
DROP TABLE IF EXISTS `hg_spelog`;
CREATE TABLE `hg_spelog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unitid` int(10) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `spebudid` int(10) NOT NULL COMMENT '存 hg_spebudget id\r\n',
  `billid` int(10) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1：普通报销\r\n2：采购合同报销',
  `logdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of hg_spelog
-- ----------------------------

-- ----------------------------
-- Table structure for hg_staff
-- ----------------------------
DROP TABLE IF EXISTS `hg_staff`;
CREATE TABLE `hg_staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `number` char(7) NOT NULL,
  `sectionid` int(10) unsigned NOT NULL,
  `password` char(32) NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `roleid` int(10) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `stafffid` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=641 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_staff
-- ----------------------------
INSERT INTO `hg_staff` VALUES ('1', '管理员', '1111111', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '1', '1425544582', '0');
INSERT INTO `hg_staff` VALUES ('2', '财务部用户', '1111112', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '3', '1449114131', '0');
INSERT INTO `hg_staff` VALUES ('3', '办公室用户', '1111113', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('4', '窦志民', '7900001', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('5', '贾洪光', '7900002', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('6', '倪藻', '7900003', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('7', '段哲帆', '7900004', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('8', '杨泽军', '7900005', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('9', '陈明', '7900006', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('10', '续效东', '7900007', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('11', '尹卫锋', '7900008', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('12', '李之和', '7900720', '1', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('13', '王弘', '7900009', '3', 'e10adc3949ba59abbe56e057f20f883e', '2', '1', '1450841099', '0');
INSERT INTO `hg_staff` VALUES ('14', '汪道钦', '7900860', '3', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('15', '郭磊', '7902800', '3', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('16', '郝渝', '7901260', '20', 'e10adc3949ba59abbe56e057f20f883e', '2', '4', '1441762831', '0');
INSERT INTO `hg_staff` VALUES ('17', '郑艳平', '7902910', '20', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('18', '高欣', '7903110', '20', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('19', '孔圆媛', '7903380', '20', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('20', '付满洲', '7903090', '20', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('21', '林彦谷', '7904220', '20', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('22', '黄婧', '7903330', '20', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('23', '王俊蓉', '7930110', '27', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('24', '陈樨圆', '7903200', '28', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('25', '刘航颖', '7903480', '29', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('26', '倪晓旭', '7902760', '21', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('27', '赵东岳', '7902960', '21', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('28', '唐书勇', '0246970', '21', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('29', '王军', '7903020', '21', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('30', '罗静', '7903070', '21', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('31', '孙喆', '7901710', '21', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('32', '黄秀平', '7901400', '22', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('33', '江东', '7902700', '22', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('34', '张鹏', '7903050', '22', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('35', '李洪源', '7903630', '22', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('36', '曾臻', '7903100', '22', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('37', '巫平', '7902730', '23', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('38', '唐杰', '7902720', '23', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('39', '王昆', '7902890', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('40', '罗干熹', '7902940', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('41', '何哲熙', '7903500', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('42', '陈科', '7902950', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('43', '李霞', '7902830', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('44', '谢文燕', '7902990', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('45', '邓立新', '7902970', '23', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('46', '肖雪梅', '7903300', '23', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('47', '钟勇', '7902810', '24', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('48', '高磊', '7903320', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('49', '耿培文', '7903530', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('50', '吴戈', '7902600', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('51', '游勇', '7903290', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('52', '邓梦婷', '7903460', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('53', '陈远征', '7903440', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('54', '李恒', '7903600', '24', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('55', '梁陶', '7900890', '25', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('56', '李年俭', '7910100', '25', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('57', '刘强', '7903060', '25', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('58', '朱越胜', '7903250', '25', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('59', '李波', '7902980', '25', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('60', '魏巍', '7903510', '25', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('61', '夏野', '7902660', '26', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('62', '易龙', '7903170', '26', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('63', '田刚', '7902690', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('64', '邓瑶', '7903610', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('65', '孙杰', '7902900', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('66', '刘孔丽', '7903120', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('67', '左艳', '7903400', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('68', '温馨', '7903490', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('69', '杨强', '7903280', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('70', '刘如意', '7903030', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('71', '况卿', '7902930', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('72', '张鑫', '7903040', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('73', '李滨', '7903130', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('74', '王筱军', '7903360', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('75', '侯霄霏', '7903410', '26', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('76', '雷率', '7900900', '30', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('77', '张仁东', '7902740', '30', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('78', '兰智波', '7950100', '30', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('79', '田竞', '7903390', '30', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('80', '罗靖', '7903470', '30', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('81', '程为公', '7900510', '28', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('82', '兰林', '7902850', '28', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('83', '朱海波', '7901490', '28', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('84', '蒲石', '7903190', '28', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('85', '康伦　　　', '7903520', '28', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('86', '陈璐', '7903450', '28', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('87', '廖鑫', '7903430', '28', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('88', '吴林章', '7901540', '29', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('89', '杨凤', '7903240', '29', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('90', '刘将', '7930070', '29', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('91', '高菊优', '7903620', '29', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('92', '郭若', '7903160', '29', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('93', '梁凯', '7902920', '29', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('94', '刘军锋', '7903010', '29', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('95', '王双伟', '7903370', '29', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('96', '伍剑', '7901330', '4', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('97', '杨万黎', '7901930', '4', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('98', '蒲生武', '7970080', '4', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('99', '陈思', '7904170', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('100', '陈迅', '7940130', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('101', '冯英', '7904300', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('102', '卢冬', '7904050', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('103', '龙飞澜', '7904120', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('104', '罗淞文', '7904880', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('105', '刘莉', '7901870', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('106', '段图蓝', '7920070', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('107', '李莉', '7900870', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('108', '许晖月', '7903420', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('109', '赵建军', '7904790', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('110', '陈雷', '7904550', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('111', '解锦林', '7900160', '5', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('112', '毛宏飞', '7901550', '5', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('113', '国婷婷', '7902470', '5', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('114', '钟原草', '7904890', '5', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('115', '李海帆', '7900620', '6', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('116', '陈红', '7930090', '6', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('117', '孔筝', '7904320', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('118', '邹大可', '7902390', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('119', '杨博', '7904230', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('120', '谢浩林', '7950300', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('121', '张彬', '7920110', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('122', '张江江', '7900150', '6', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('123', '黄碧珠', '7900610', '6', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('124', '赵锐', '7901750', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('125', '薛杨', '7940210', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('126', '顾冰心', '7904450', '6', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('127', '易欢芝', '7901070', '7', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('128', '黄茜', '7901340', '7', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('129', '袁跃新', '7902110', '7', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('130', '陈琳', '7901790', '7', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('131', '李晓敏', '7901220', '7', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('132', '丁炜', '7901780', '7', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('133', '陆萨丽', '7900880', '7', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('134', '严洋', '7902130', '7', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('135', '牛鸣三', '7900450', '7', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('136', '张柯', '7900660', '8', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('137', '沈萍英', '7930100', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('138', '宋双庆', '7910270', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('139', '夏佳', '7904060', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('140', '王晓生', '7920100', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('141', '唐碧英', '7902310', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('142', '李科', '7904760', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('143', '谢芳', '7902650', '8', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('144', '张文瑜', '7904190', '8', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('145', '张炬', '7901050', '9', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('146', '陈晓义', '7901390', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('147', '陈颖', '7902030', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('148', '刘睿姝', '7902440', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('149', '杨溪川', '7904100', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('150', '黄怡', '7950160', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('151', '兰希', '7905250', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('152', '肖晓文', '7902250', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('153', '刘强', '7905020', '9', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('154', '徐多云', '7950010', '10', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('155', '郑大龙', '7900390', '10', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('156', '杨龙', '7902670', '10', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('157', '皮晓宇', '7904690', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('158', '陈海霞', '7904280', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('159', '袁蓉蓉', '7901970', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('160', '温学', '7901880', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('161', '田力', '7900250', '10', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('162', '牛志敏', '7902490', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('163', '衡俊', '7902090', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('164', '张玺', '7902500', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('165', '颜强', '7901090', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('166', '汪大力', '7930430', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('167', '朱攀峰', '7902280', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('168', '李爱琳', '7902590', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('169', '郭艺桥', '7902380', '10', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('170', '詹放', '7900410', '11', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('171', '田戈', '7901700', '11', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('172', '杨凯平', '7901480', '11', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('173', '张成西', '7900290', '11', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('174', '张林', '7920150', '11', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('175', '雷馥菱', '7905160', '11', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('176', '余波', '7900940', '11', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('177', '陈羽新', '7902870', '11', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('178', '李星', '7902040', '11', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('179', '古峰', '7900400', '12', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('180', '李磊', '7901320', '12', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('181', '罗承阳', '7902240', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('182', '王利生', '7900760', '12', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('183', '刘亮', '7902400', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('184', '杨启帆', '7905430', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('185', '周亦岚', '7901610', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('186', '黄薇维', '7904870', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('187', '冯翀', '7905370', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('188', '周图南', '7903150', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('189', '江山', '7902880', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('190', '冯伟', '7900670', '12', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('191', '刘彦希', '7904240', '12', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('192', '鲜学政', '7910010', '2', 'e10adc3949ba59abbe56e057f20f883e', '2', '2', '1425544621', '0');
INSERT INTO `hg_staff` VALUES ('193', '杨皓', '7901830', '2', 'e10adc3949ba59abbe56e057f20f883e', '2', '2', '1425544627', '0');
INSERT INTO `hg_staff` VALUES ('194', '林魏', '7902300', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544632', '0');
INSERT INTO `hg_staff` VALUES ('195', '晋蓉', '7901740', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544638', '0');
INSERT INTO `hg_staff` VALUES ('196', '郑梅', '7904720', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544643', '0');
INSERT INTO `hg_staff` VALUES ('197', '李果', '7902530', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544649', '0');
INSERT INTO `hg_staff` VALUES ('198', '张升文', '7905080', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544653', '0');
INSERT INTO `hg_staff` VALUES ('199', '庄玥', '3107930', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544659', '0');
INSERT INTO `hg_staff` VALUES ('200', '蒋雨琦', '7960350', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544671', '0');
INSERT INTO `hg_staff` VALUES ('201', '马娟', '7900600', '2', 'e10adc3949ba59abbe56e057f20f883e', '2', '2', '1425544676', '0');
INSERT INTO `hg_staff` VALUES ('202', '张国彬', '7900590', '2', 'e10adc3949ba59abbe56e057f20f883e', '2', '2', '1425544681', '0');
INSERT INTO `hg_staff` VALUES ('203', '金杏清', '7902080', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544688', '0');
INSERT INTO `hg_staff` VALUES ('204', '白露', '7904180', '2', 'e10adc3949ba59abbe56e057f20f883e', '1', '2', '1425544693', '0');
INSERT INTO `hg_staff` VALUES ('205', '孙永和', '7920010', '13', 'e10adc3949ba59abbe56e057f20f883e', '2', '3', '1426644180', '0');
INSERT INTO `hg_staff` VALUES ('206', '王亚梅', '7920220', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('207', '朱长林', '7901980', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('208', '王美堂', '7904330', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('209', '戴凡', '7904460', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('210', '汪浩', '7900980', '13', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('211', '周宁', '7901840', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('212', '陈薇', '7904490', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('213', '牛华明', '7901230', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('214', '钟璐', '7902370', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('215', '梁真强', '7903230', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('216', '李颖', '7902150', '13', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('217', '张筱平', '7900500', '14', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('218', '朱丹', '7910120', '14', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('219', '田中峰', '7904770', '14', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('220', '张静', '7904390', '14', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('221', '王俊杰', '7904530', '14', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('222', '李恩达', '7904730', '14', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('223', '何洪江', '7904440', '14', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('224', '张静', '7904640', '14', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('225', '付树春', '7900920', '15', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('226', '卓萍', '7901150', '15', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('227', '刘颖', '7901810', '15', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('228', '吴天', '7900700', '15', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('229', '崔红', '7901800', '15', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('230', '吴新颜', '7901200', '15', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('231', '蒋华', '7904500', '15', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('232', '杨瑷宁', '7904850', '15', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('233', '王鲁川', '7900790', '16', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('234', '钟清', '7902350', '16', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('235', '庄忆田', '7901040', '16', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('236', '方成平', '7920040', '16', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('237', '张仁灏', '7900960', '16', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('238', '张萃', '7902330', '16', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('239', '向晖', '7901140', '16', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('240', '谢勤', '7904840', '16', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('241', '贾琳伟', '7904820', '16', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('242', '侯文波', '7900850', '31', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('243', '程民', '7902710', '31', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('244', '梁珊玲', '7901450', '31', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('245', '林语婕', '7902200', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '4', '1441763404', '0');
INSERT INTO `hg_staff` VALUES ('246', '吕琳', '7902680', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('247', '陈娟', '7930330', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('248', '刘伟', '7905010', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('249', '杨昕', '7905330', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('250', '赖德贵', '7900990', '32', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('251', '邝毅君', '7902340', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('252', '陈明', '7901530', '32', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('253', '谭文豪', '7905770', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('254', '吕杰', '7905800', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('255', '胡学言', '7905810', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('256', '孙茂坤', '7905820', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('257', '李平', '7905830', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('258', '蒙君武', '7904540', '32', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('259', '蔡茂南', '7902010', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('260', '颜丽', '7904070', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('261', '张成杭', '7900460', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('262', '曹建瑶', '7901500', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('263', '李煦', '7901420', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('264', '李雯', '7904420', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('265', '申文敏', '7905040', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('266', '陈仁君', '7902420', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('267', '周航', '7970090', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('268', '钟琳', '7901510', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('269', '林璐萌', '7905570', '33', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('270', '李栋梁', '7901630', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('271', '龚燕', '7904560', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('272', '高永强', '7901670', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('273', '刘文娟', '7902450', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('274', '杨世建', '7950190', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('275', '张翔', '7904370', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('276', '张毅', '7905060', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('277', '司永忠', '7910210', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('278', '孙君东', '7905410', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('279', '李双', '7905390', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('280', '邓文芳', '7905320', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('281', '杨冲', '7905780', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('282', '李三诗', '7910290', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('283', '周蕾', '7905590', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('284', '廖思佳', '7905650', '34', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('285', '戢凌', '7901640', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('286', '钟茂佳', '7904110', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('287', '彭建波', '7901690', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('288', '古巧玲', '7910180', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('289', '李真', '7905110', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('290', '贺文娟', '7904960', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('291', '尹蒙', '7905200', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('292', '董智', '7905500', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('293', '彭涛', '7930350', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('294', '谭静娴', '7905670', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('295', '唐皓', '7905600', '35', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('296', '杨洋', '7902430', '36', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('297', '李伟琪', '7901470', '36', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('298', '田志鹏', '7905140', '36', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('299', '刘力维', '7905380', '36', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('300', '但午剑', '7902260', '36', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('301', '陈荣洲', '7900560', '36', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('302', '张麒', '7905400', '36', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('303', '李杨', '7905700', '36', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('304', '刘亚', '7901950', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('305', '梁勇', '7900470', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('306', '唐晓东', '7902570', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('307', '张寒蕾', '7904990', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('308', '冷冲', '7904430', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('309', '刘国怀', '7905120', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('310', '鲁顺伶', '7905360', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('311', '曾鹏', '7904380', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('312', '杨锐', '7900260', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('313', '伍旭', '7905690', '37', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('314', '韩文', '7901080', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('315', '开颜', '7960160', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('316', '刘加柱', '7900950', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('317', '石培峰', '7904510', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('318', '王进', '7904160', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('319', '吴钰豪', '7904410', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('320', '鹿瑶', '7904710', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('321', '胡涛', '7905520', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('322', '李小虎', '7905560', '38', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('323', '王丹', '7901190', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('324', '陈杨', '7903080', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('325', '刘朋铁', '7902460', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('326', '罗翼', '7905350', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('327', '张革', '7910110', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('328', '何砚', '7902220', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('329', '黄超凡', '7905720', '39', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('330', '于勇', '7902790', '40', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('331', '刘燕群', '7910260', '40', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('332', '邓回勇', '7903350', '40', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('333', '祝华东', '7910280', '41', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('334', '袁静', '7910060', '41', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('335', '张嘉', '7910230', '41', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('336', '雷阳刚', '7910300', '41', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('337', '黄艳虹', '7910050', '42', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('338', '游江', '7910200', '42', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('339', '汤勇', '7910030', '42', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('340', '杨峻波', '7910090', '43', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('341', '李堰', '7910420', '43', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('342', '衣庆光', '7910040', '43', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('343', '黄彤', '7901210', '44', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('344', '朱凯', '7910250', '44', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('345', '蒋霞', '7910140', '44', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('346', '徐竞', '7910310', '44', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('347', '宋亚奇', '7910080', '45', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('348', '杜丽晖', '7910070', '45', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('349', '费瑶', '7910160', '45', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('350', '肖平', '7900680', '46', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('351', '胡涛', '7930060', '46', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('352', '余驰', '7930180', '46', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('353', '陈洪训', '7930150', '46', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('354', '胡超', '7930200', '46', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('355', '刘勇', '7930340', '46', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('356', '李光财', '7930380', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('357', '李城村', '7930370', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('358', '蹇晟', '7930240', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('359', '李刚', '7930250', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('360', '李华', '7930120', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('361', '谭鹏', '7930140', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('362', '戴畅', '7904670', '47', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('363', '张栗', '7930210', '48', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('364', '何飞', '7930290', '48', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('365', '刘雁玲', '7930390', '48', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('366', '刘永攀', '7930440', '48', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('367', '周洺', '7930130', '49', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('368', '严飞', '7930270', '49', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('369', '夏国翔', '7930280', '49', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('370', '张阳', '7930510', '49', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('371', '黄勇', '7930030', '50', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('372', '杜堃', '7930260', '50', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('373', '彭涛', '7930400', '50', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('374', '周立新', '7930080', '51', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('375', '孙勇', '7930320', '51', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('376', '徐辉', '7930410', '51', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('377', '唐曼君', '7930170', '52', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('378', '范玲利', '7930500', '52', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('379', '陶毅', '7900710', '53', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('380', '宋卫红', '7920090', '53', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('381', '曾鸣', '7920250', '54', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('382', '刘代英', '7920260', '54', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('383', '苏飞', '7920230', '54', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('384', '秦莉', '7920180', '54', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('385', '姚学军', '7920050', '55', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('386', '陈伟', '7920270', '55', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('387', '任厚珍', '7920290', '55', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('388', '钟代远', '7920160', '56', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('389', '王静春', '7920170', '56', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('390', '朱莉', '7920240', '57', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('391', '龚繁强', '7920280', '57', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('392', '尹亮', '7901280', '58', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1425439272', '0');
INSERT INTO `hg_staff` VALUES ('393', '代岷', '7900820', '58', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('394', '罗亚莉', '7900630', '58', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('395', '吴凯', '7901290', '58', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('396', '刘杰', '7900640', '58', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('397', '陈永', '7900930', '58', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('398', '乔海波', '7904680', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('399', '高勇', '7901960', '59', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('400', '葛强', '7905170', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('401', '苟林', '7905220', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('402', '吕昂', '7905230', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('403', '石东', '7905280', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('404', '李波', '7905550', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('405', '刘淼', '7904580', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('406', '丁娅菲', '7905290', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('407', '龙华', '7905840', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('408', '阳佳作', '7905790', '59', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('409', '陈筱璐', '7902210', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('410', '钟敏', '7902550', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('411', '皇甫天博', '7930040', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('412', '崔捷', '7904210', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('413', '周静', '7904700', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('414', '薛雪莲', '7904480', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('415', '管成丽', '7904750', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('416', '朱强', '7904810', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('417', '谢俊梅', '7904600', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('418', '吴涵', '7904590', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('419', '张颖', '7904660', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('420', '陈颖异', '7905310', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('421', '戴琦', '7905610', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('422', '詹锴', '7905580', '60', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('423', '杨青', '7902560', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('424', '吴成兵', '7950030', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('425', '鲁小青', '7904630', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('426', '罗曦', '7960120', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('427', '黄艳', '7905150', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('428', '张薷丹', '7904570', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('429', '赵卓夫', '7905210', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('430', '杜明', '7905530', '61', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('431', '叶华伟', '7920080', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('432', '李敏', '7904740', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('433', '修勇军', '7904620', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('434', '朱瑞月', '7904910', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('435', '兰晓惠', '7905190', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('436', '何佳阳', '7905260', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('437', '陈强', '7920190', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('438', '吴俊锋', '7904780', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('439', '王戈', '7950180', '62', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('440', '曹庆华', '7920120', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('441', '郑朝辉', '7904130', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('442', '刘军', '7904400', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('443', '康晓飞', '7904250', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('444', '王磊', '7904150', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('445', '王陶', '7904920', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('446', '廖玲', '7904900', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('447', '奉友敏', '7930230', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('448', '覃伟', '7950110', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('449', '吴琦波', '7902410', '63', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('450', '孟科', '7902230', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('451', '彭科源', '7904470', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('452', '张军', '7920210', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('453', '高蓬', '7904860', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('454', '王波', '7904650', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('455', '杨海林', '7905030', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('456', '王京', '7905270', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('457', '闫军', '7905490', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('458', '王东', '7905540', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('459', '何永', '7904140', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('460', '李俊', '7904260', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('461', '方一涵', '7905630', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('462', '范志强', '7905660', '64', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('463', '沈岸', '7901760', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('464', '李均', '7910130', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('465', '刘沛', '7905760', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('466', '黄杰', '7904610', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('467', '张珂菡', '7904800', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('468', '刘国亮', '7905050', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('469', '王宇', '7905240', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('470', '肖建新', '7904310', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('471', '葛佳', '7904940', '65', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('472', '樊青', '7920130', '66', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('473', '颜莉', '7905300', '66', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('474', '薛尤仲', '7930010', '67', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('475', '施菁', '7900520', '67', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('476', '唐伟', '7905130', '68', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('477', '邓小林', '7960400', '68', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('478', '张佩佩', '7960370', '68', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('479', '何洋', '7960380', '68', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('480', '梁诗画', '7960410', '68', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('481', '肖云', '7930310', '69', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('482', '杨天刚', '7960320', '69', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('483', '何坤泽', '7960300', '69', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('484', '李彦一', '7960330', '69', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('485', '蔡娜', '7960360', '70', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('486', '沈虹', '7960340', '70', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('487', '张芯', '7960310', '70', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('488', '曾娅', '7960390', '70', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('489', '邓明昶', '7930160', '71', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('490', '阳选荣', '7940030', '71', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('491', '蒙福元', '7970070', '72', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('492', '谌军', '7970360', '72', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('493', '吴金颖', '7970320', '72', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('494', '陈雪', '7970330', '72', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('495', '王翔', '7902580', '73', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('496', '郭毅', '7970300', '73', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('497', '蔡明明', '7970310', '73', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('498', '杨敏利', '7970340', '73', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('499', '蒲领', '7970350', '73', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('500', '谢娟', '7901580', '17', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('501', '冯丽娟', '7902160', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('502', '邓文娟', '7901310', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('503', '邓臻珍', '7901350', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('504', '王珏', '7902140', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('505', '陈妮妮', '7900830', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('506', '王鹏', '7904930', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('507', '肖静', '7901600', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('508', '冯蓉', '7900180', '17', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('509', '段建萍', '7902270', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('510', '石泽亚', '7904970', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('511', '赵岚', '7901560', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('512', '贺敬满', '7900490', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('513', '杨清禄', '7901680', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('514', '梁志成', '7901850', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('515', '徐菊', '7904950', '17', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('516', '孙启樑', '7900810', '18', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('517', '史晓锦', '7900530', '18', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('518', '刘佳芹', '7901120', '18', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('519', '李忠毅', '7901520', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('520', '伍晓航', '7902180', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('521', '夏纪', '7904520', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('522', '邓新宇', '7905420', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('523', '叶子涵', '7905470', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('524', '杨珣', '7905000', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('525', '邓鹏', '7902290', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('526', '张耀升', '7904080', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('527', '刘瑞轩', '7904980', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('528', '张阳洁', '7905480', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('529', '汪雪妤', '7905440', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('530', '翁艺', '7905460', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('531', '王艳', '7950320', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('532', '程戈', '7901410', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('533', '白里', '7902100', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('534', '李嘉莉', '7940090', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('535', '梁嘉鹏', '7904270', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('536', '杨杰', '7905450', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('537', '王晨雨', '7905640', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('538', '周静', '7901010', '18', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('539', '赵伟', '7902000', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('540', '曹小燕', '7904340', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('541', '刘祥', '7902320', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('542', '郑杰', '7904090', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('543', '向岳龄', '7905620', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('544', '傅智勇', '7901820', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('545', '舒奔', '7900540', '18', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('546', '刘劼军', '7901250', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('547', '朱晓蔺', '7940180', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('548', '赵超越', '7905710', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('549', '马祺', '7905750', '18', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('550', '周励', '7901240', '77', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('551', '朱云', '7901180', '77', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('552', '李慧', '7940160', '78', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('553', '曹强', '7900800', '78', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('554', '李炳艳', '7904350', '78', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('555', '唐竹', '7902540', '78', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('556', '李刚', '7900650', '78', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('557', '汪伟', '7902060', '79', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('558', '宋毅', '7902120', '79', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('559', '王国安', '7900360', '79', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('560', '赵长文', '7901060', '79', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('561', '唐勇', '7920060', '79', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('562', '吴磊', '7904040', '79', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('563', '吴礼镇', '7905740', '79', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('564', '刘伟佳', '7901360', '80', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('565', '徐达', '7901570', '80', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('566', '谢兰', '7940060', '81', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('567', '倪凯', '7940070', '81', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('568', '詹正华', '7940140', '81', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('569', '曾晓旭', '7940230', '81', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('570', '黄立凡', '7940080', '82', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('571', '万敏', '7940220', '82', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('572', '张正勇', '7950120', '83', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('573', '程从容', '7940050', '83', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('574', '郝健', '7940200', '83', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('575', '黄旭', '7940110', '84', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('576', '郭昤', '7940040', '84', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('577', '李维华', '7900730', '85', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('578', '郭方', '7920140', '85', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('579', '张传耀', '7950020', '85', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('580', '王冀', '7950040', '85', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('581', '屈成刚', '7950060', '86', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('582', '马红玉', '7950210', '86', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('583', '陈超', '7950280', '86', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('584', '舒朗轩', '7950200', '86', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('585', '胡飞', '7950050', '87', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('586', '华一颖', '7950230', '87', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('587', '罗焰红', '7950250', '87', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('588', '胡涛', '7950310', '87', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('589', '姜茂', '7950330', '87', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('590', '王敏', '7950080', '88', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('591', '唐远兵', '7950220', '88', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('592', '赵鑫', '7950260', '88', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('593', '魏稚松', '7950270', '88', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('594', '向玫', '7950340', '88', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('595', '唐进', '7901590', '89', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('596', '周正南', '7950070', '89', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('597', '陈兴', '7950290', '89', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('598', '詹柯', '7940020', '90', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('599', '段翊', '7960040', '90', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('600', '潘希', '7960100', '91', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('601', '吴建', '7960130', '91', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('602', '谢燕妮', '7960170', '91', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('603', '廖庭翔', '7960180', '91', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('604', '王绍松', '7960050', '92', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('605', '黄斌', '7960090', '92', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('606', '陈宏浩', '7960150', '92', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('607', '叶超', '7960060', '93', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('608', '李有军', '7960070', '93', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('609', '袁银亮', '7960140', '93', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('610', '刘波', '7900270', '94', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('611', '周敏', '7901000', '94', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('612', '王艺霏', '7970050', '95', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('613', '李勇', '7970040', '95', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('614', '王瓈', '7970100', '95', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('615', '温寅', '7970110', '95', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('616', '边铃凌', '7970120', '95', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('617', '颜毅', '7902170', '96', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('618', '冯莉丽', '7970060', '96', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('619', '何艳', '7930420', '96', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('620', '付现民', '7901860', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('621', '陈越', '7901620', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('622', '王自友', '7940120', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('623', '胡棠琦', '7900240', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('624', '彭柯', '7904010', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('625', '李汀', '7903310', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('626', '范刚', '7900970', '19', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('627', '杨军', '7902070', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('628', '房浩', '7905100', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('629', '李凤生', '7901380', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('630', '肖国利', '7901160', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('631', '何全昌', '7901170', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('632', '贾海龙', '7901110', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('633', '陈波', '7904030', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('634', '蒋英鹰', '7901030', '19', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('635', '颜冬青', '7901720', '97', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1425357411', '0');
INSERT INTO `hg_staff` VALUES ('636', '潘亚林', '7902840', '98', 'e10adc3949ba59abbe56e057f20f883e', '1', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('637', '余陵', '7900230', '98', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1422163554', '0');
INSERT INTO `hg_staff` VALUES ('640', '足球协会人员', '5390192', '99', 'e10adc3949ba59abbe56e057f20f883e', '2', '6', '1425441260', '1');

-- ----------------------------
-- Table structure for hg_term
-- ----------------------------
DROP TABLE IF EXISTS `hg_term`;
CREATE TABLE `hg_term` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `staffid` int(10) unsigned NOT NULL,
  `timestamp` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_term
-- ----------------------------
INSERT INTO `hg_term` VALUES ('4', '2016', '1', '1', '1456194801');

-- ----------------------------
-- Table structure for hg_train
-- ----------------------------
DROP TABLE IF EXISTS `hg_train`;
CREATE TABLE `hg_train` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `termid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `total` tinyint(3) NOT NULL,
  `staging` tinyint(3) NOT NULL COMMENT '期数，培训报销以此期数报销',
  `number` int(10) NOT NULL,
  `place` varchar(255) NOT NULL,
  `duration` float(3,1) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `unitid` int(10) NOT NULL,
  `timestamp` char(10) NOT NULL,
  `confirm` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_train
-- ----------------------------

-- ----------------------------
-- Table structure for hg_unit
-- ----------------------------
DROP TABLE IF EXISTS `hg_unit`;
CREATE TABLE `hg_unit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `unitlock` tinyint(1) NOT NULL COMMENT '锁定',
  `timestamp` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_unit
-- ----------------------------
INSERT INTO `hg_unit` VALUES ('1', '总关', '0', '1421554286');
INSERT INTO `hg_unit` VALUES ('2', '缉私局', '0', '1421654119');
INSERT INTO `hg_unit` VALUES ('3', '双流机场海关', '0', '1421654155');
INSERT INTO `hg_unit` VALUES ('4', '乐山海关', '0', '1421654178');
INSERT INTO `hg_unit` VALUES ('5', '绵阳海关', '0', '1421654189');
INSERT INTO `hg_unit` VALUES ('6', '攀枝花海关', '0', '1421654210');
INSERT INTO `hg_unit` VALUES ('7', '综保区海关', '0', '1421654220');
INSERT INTO `hg_unit` VALUES ('8', '德阳海关', '0', '1421654245');
INSERT INTO `hg_unit` VALUES ('9', '遂宁海关', '0', '1421654258');
INSERT INTO `hg_unit` VALUES ('10', '驻车办事处', '0', '1421654328');
INSERT INTO `hg_unit` VALUES ('11', '邮局办事处', '0', '1421654340');
INSERT INTO `hg_unit` VALUES ('12', '自贡办事处', '0', '1421654348');
INSERT INTO `hg_unit` VALUES ('13', '泸州办事处', '0', '1421654362');
INSERT INTO `hg_unit` VALUES ('14', '宜宾办事处', '0', '1421654369');
INSERT INTO `hg_unit` VALUES ('15', '南充办事处', '0', '1421654379');
INSERT INTO `hg_unit` VALUES ('16', '其它人员', '0', '1421654395');
INSERT INTO `hg_unit` VALUES ('17', '成都海关公会', '1', '1425350319');
INSERT INTO `hg_unit` VALUES ('18', '阿斯蒂芬', '1', '1454305081');

-- ----------------------------
-- Table structure for hg_wagesgq
-- ----------------------------
DROP TABLE IF EXISTS `hg_wagesgq`;
CREATE TABLE `hg_wagesgq` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `num` int(10) NOT NULL COMMENT '序号',
  `section` varchar(8) NOT NULL COMMENT '部门名称',
  `name` varchar(16) NOT NULL COMMENT '用户姓名',
  `card` varchar(20) NOT NULL COMMENT '卡号',
  `level_wages` decimal(8,2) NOT NULL COMMENT '级别工资',
  `job_wages` decimal(8,2) NOT NULL COMMENT '职务工资',
  `proportion_subsidies` decimal(8,2) NOT NULL COMMENT '按比例计算的津贴',
  `gaoxin_subsidies` decimal(8,2) NOT NULL COMMENT '高新补贴',
  `port_subsidies` decimal(8,2) NOT NULL COMMENT '口岸补贴',
  `keep_subsidies` decimal(8,2) NOT NULL COMMENT '保留津贴',
  `appropriate_subsidies` decimal(8,2) NOT NULL COMMENT '适当补贴',
  `job_subsidies` decimal(8,2) NOT NULL COMMENT '职务补贴',
  `haiguan_subsidies` decimal(8,2) NOT NULL COMMENT '海关津贴',
  `onechild` decimal(8,2) NOT NULL COMMENT '独生子女费',
  `phone_subsidies` decimal(8,2) NOT NULL COMMENT '移动电话费',
  `giveadd` decimal(8,2) NOT NULL COMMENT '应发合计',
  `de_gongjijing` decimal(8,2) NOT NULL COMMENT '所得税扣除公积金',
  `de_medicalinsurance` decimal(8,2) NOT NULL COMMENT '所得税扣除医疗保险',
  `de_unemploy` decimal(8,2) NOT NULL COMMENT '所得税扣除失业保险',
  `de_onechild` decimal(8,2) NOT NULL COMMENT '所得税扣除独生子女',
  `de_phone` decimal(8,2) NOT NULL COMMENT '所得税扣除移动电话及座机',
  `de_other` decimal(8,2) NOT NULL COMMENT '所得税扣除其他扣款',
  `de_taxadd` decimal(8,2) NOT NULL COMMENT '应缴税所得额',
  `individualtax` decimal(8,2) NOT NULL COMMENT '个人所得税',
  `rent` decimal(8,2) NOT NULL COMMENT '房租',
  `deduct_add` decimal(8,2) NOT NULL COMMENT '应扣合计',
  `wages` decimal(8,2) NOT NULL COMMENT '实发工资',
  `year` varchar(7) NOT NULL,
  `time` char(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_wagesgq
-- ----------------------------

-- ----------------------------
-- Table structure for hg_wageshg
-- ----------------------------
DROP TABLE IF EXISTS `hg_wageshg`;
CREATE TABLE `hg_wageshg` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `num` int(10) NOT NULL COMMENT '序号',
  `section` varchar(8) NOT NULL COMMENT '部门名称',
  `name` varchar(16) NOT NULL COMMENT '用户姓名',
  `card` varchar(20) NOT NULL COMMENT '卡号',
  `job_wages` decimal(8,2) NOT NULL COMMENT '职务工资',
  `level_wages` decimal(8,2) NOT NULL COMMENT '级别工资',
  `job_subsidies` decimal(8,2) NOT NULL COMMENT '工作性补贴',
  `life_subsidies` decimal(8,2) NOT NULL COMMENT '生活性补贴',
  `haiguan_subsidies` decimal(8,2) NOT NULL COMMENT '海关补贴',
  `audit_subsidies` decimal(8,2) NOT NULL COMMENT '审计人员补贴',
  `secret_subsidies` decimal(8,2) NOT NULL COMMENT '机要保密津贴',
  `lifephone_subsidies` decimal(8,2) NOT NULL COMMENT '生活补贴、电话补贴',
  `phone_subsidies` decimal(8,2) NOT NULL COMMENT '移动通信补贴',
  `officialphone` decimal(8,2) NOT NULL COMMENT '公务电话费',
  `onechild` decimal(8,2) NOT NULL COMMENT '独生子女费',
  `giveadd` decimal(8,2) NOT NULL COMMENT '应发合计',
  `de_medicalinsurance` decimal(8,2) NOT NULL COMMENT '所得税扣除医疗保险',
  `de_gongjijing` decimal(8,2) NOT NULL COMMENT '所得税扣除公积金',
  `de_onechild` decimal(8,2) NOT NULL COMMENT '所得税扣除独生子女',
  `de_phone` decimal(8,2) NOT NULL COMMENT '所得税扣除移动电话及座机',
  `de_other` decimal(8,2) NOT NULL COMMENT '所得税扣除其他扣款',
  `de_taxadd` decimal(8,2) NOT NULL COMMENT '应缴税所得额',
  `individualtax` decimal(8,2) NOT NULL COMMENT '个人所得税',
  `rent` decimal(8,2) NOT NULL COMMENT '房租',
  `deduct_add` decimal(8,2) NOT NULL COMMENT '应扣合计',
  `wages` decimal(8,2) NOT NULL COMMENT '实发工资',
  `year` varchar(7) NOT NULL,
  `time` char(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_wageshg
-- ----------------------------
INSERT INTO `hg_wageshg` VALUES ('1', '1111111', '关领导', 'XXX', '6215584432102586325', '2000.00', '1000.00', '700.00', '600.00', '200.00', '200.00', '300.00', '100.00', '100.00', '50.00', '30.00', '5280.00', '200.00', '300.00', '100.00', '100.00', '50.00', '50.00', '40.00', '300.00', '1140.00', '4140.00', '201601', '');

-- ----------------------------
-- Table structure for hg_wagesjsj
-- ----------------------------
DROP TABLE IF EXISTS `hg_wagesjsj`;
CREATE TABLE `hg_wagesjsj` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `num` int(10) NOT NULL COMMENT '序号',
  `section` varchar(8) NOT NULL COMMENT '部门名称',
  `name` varchar(16) NOT NULL COMMENT '用户姓名',
  `card` varchar(20) NOT NULL COMMENT '卡号',
  `job_wages` decimal(8,2) NOT NULL COMMENT '职务工资',
  `level_wages` decimal(8,2) NOT NULL COMMENT '级别工资',
  `internship_wages` decimal(8,2) NOT NULL COMMENT '实习工资',
  `job_subsidies` decimal(8,2) NOT NULL COMMENT '工作性补贴',
  `life_subsidies` decimal(8,2) NOT NULL COMMENT '生活性补贴',
  `phone_subsidies` decimal(8,2) NOT NULL COMMENT '移动通信补贴',
  `officialphone` decimal(8,2) NOT NULL COMMENT '公务电话费',
  `bit_subsidies` decimal(8,2) NOT NULL COMMENT '警衔补贴',
  `onechild` decimal(8,2) NOT NULL COMMENT '独生子女费',
  `giveadd` decimal(8,2) NOT NULL COMMENT '应发合计',
  `de_medicalinsurance` decimal(8,2) NOT NULL COMMENT '应扣医疗保险',
  `de_gongjijing` decimal(8,2) NOT NULL COMMENT '应扣公积金',
  `de_base` decimal(8,2) NOT NULL COMMENT '扣税基数',
  `individualtax` decimal(8,2) NOT NULL COMMENT '应扣所得税',
  `rent` decimal(8,2) NOT NULL COMMENT '税后扣除项目：房租（按月）',
  `de_jobsubsidies` decimal(8,2) NOT NULL COMMENT '扣发工作性津贴',
  `deduct_add` decimal(8,2) NOT NULL COMMENT '应扣合计',
  `wages` decimal(8,2) NOT NULL COMMENT '实发工资',
  `year` varchar(7) NOT NULL,
  `time` char(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_wagesjsj
-- ----------------------------

-- ----------------------------
-- Table structure for hg_wagestx
-- ----------------------------
DROP TABLE IF EXISTS `hg_wagestx`;
CREATE TABLE `hg_wagestx` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `num` int(10) NOT NULL COMMENT '序号',
  `section` varchar(8) NOT NULL COMMENT '部门名称',
  `name` varchar(16) NOT NULL COMMENT '用户姓名',
  `card` varchar(20) NOT NULL COMMENT '卡号',
  `retire_wages` decimal(8,2) NOT NULL COMMENT '离（退）休费',
  `retire_subsidies` decimal(8,2) NOT NULL COMMENT '离（退）休人员补贴',
  `officialphone` decimal(8,2) NOT NULL COMMENT '公务电话费',
  `lawpolice_subsidies` decimal(8,2) NOT NULL COMMENT '政法干警补贴',
  `nursing` decimal(8,2) NOT NULL COMMENT '护理费',
  `keep_subsidies` decimal(8,2) NOT NULL COMMENT '保留津贴',
  `wages` decimal(8,2) NOT NULL COMMENT '合计',
  `year` varchar(7) NOT NULL,
  `time` char(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_wagestx
-- ----------------------------

-- ----------------------------
-- Table structure for hg_zxadminbudgetmoney
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxadminbudgetmoney`;
CREATE TABLE `hg_zxadminbudgetmoney` (
  `overlook_id` int(8) NOT NULL,
  `name_id` int(8) NOT NULL,
  `inbudgetadd` varchar(8) DEFAULT NULL COMMENT '收入预算合计',
  `inlastadd` varchar(20) DEFAULT NULL COMMENT '上年结转小计',
  `intwolastadd` varchar(20) DEFAULT NULL COMMENT '上年，两年前结转',
  `inthisadd` varchar(20) DEFAULT NULL COMMENT '当年收入预算小计',
  `inthiserxia` varchar(20) DEFAULT NULL COMMENT '当年收入二下数',
  `inthistiaozheng` varchar(20) DEFAULT NULL COMMENT '收入调整数',
  `outbudgetadd` varchar(20) DEFAULT NULL COMMENT '支出预算合计',
  `outjiezhuanadd` varchar(20) DEFAULT NULL COMMENT '支出，结转支出小计',
  `outjiezhuantwolast` varchar(20) DEFAULT NULL COMMENT '支出，两年前形成结转',
  `outthisinoutbudget` varchar(20) DEFAULT NULL COMMENT '当年收入支出预算'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxadminbudgetmoney
-- ----------------------------
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '1', '0.00', '', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '2', '222.00', '222', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '3', '0.00', '', '333', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '4', '444.00', '', '', '444.00', '444', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '5', '555.00', '', '', '555.00', '', '555', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '6', '0.00', '', '', '0.00', '', '', '666.00', '666', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '7', '0.00', '', '', '0.00', '', '', '0.00', '', '777', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '8', '0.00', '', '', '0.00', '', '', '888.00', '', '', '888');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '9', '0.00', '', '', '0.00', '', '', '0.00', '', '999', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '10', '0.00', '', '', '0.00', '', '', '1000.00', '1000', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '11', '1111.00', '', '', '1111.00', '', '1111', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '12', '2222.00', '', '', '2222.00', '2222', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '13', '0.00', '', '3333', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '14', '4444.00', '4444', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '15', '8998.00', '4666.00', '3666.00', '4332.00', '2666.00', '1666.00', '2554.00', '1666.00', '1776.00', '888.00');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '16', '5555.00', '5555', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '17', '0.00', '', '6666', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '18', '7777.00', '', '', '7777.00', '7777', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '19', '8888.00', '', '', '8888.00', '', '8888', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '20', '0.00', '', '', '0.00', '', '', '1212.00', '1212', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '21', '0.00', '', '', '0.00', '', '', '0.00', '', '1314', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '22', '0.00', '', '', '0.00', '', '', '2324.00', '', '', '2324');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('1', '23', '22220.00', '5555.00', '6666.00', '16665.00', '7777.00', '8888.00', '3536.00', '1212.00', '1314.00', '2324.00');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '1', '111.00', '111', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '2', '0.00', '', '222', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '3', '333.00', '', '', '333.00', '333', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '4', '444.00', '', '', '444.00', '', '444', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '5', '0.00', '', '', '0.00', '', '', '555.00', '555', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '6', '0.00', '', '', '0.00', '', '', '0.00', '', '666', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '7', '0.00', '', '', '0.00', '', '', '777.00', '', '', '777');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '8', '0.00', '', '', '0.00', '', '', '0.00', '', '888', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '9', '0.00', '', '', '0.00', '', '', '999.00', '999', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '10', '1111.00', '', '', '1111.00', '', '1111', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '11', '2222.00', '', '', '2222.00', '2222', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '12', '0.00', '', '3333', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '13', '4444.00', '4444', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '14', '5555.00', '5555', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '15', '14220.00', '10110.00', '3555.00', '4110.00', '2555.00', '1555.00', '2331.00', '1554.00', '1554.00', '777.00');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '16', '3434.00', '3434', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '17', '0.00', '', '4545', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '18', '5656.00', '', '', '5656.00', '5656', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '19', '6767.00', '', '', '6767.00', '', '6767', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '20', '0.00', '', '', '0.00', '', '', '7878.00', '7878', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '21', '0.00', '', '', '0.00', '', '', '0.00', '', '8989', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '22', '0.00', '', '', '0.00', '', '', '9090.00', '', '', '9090');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('3', '23', '15857.00', '3434.00', '4545.00', '12423.00', '5656.00', '6767.00', '16968.00', '7878.00', '8989.00', '9090.00');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '1', '123.00', '123', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '2', '0.00', '', '234', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '3', '456.00', '', '', '456.00', '456', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '4', '567.00', '', '', '567.00', '', '567', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '5', '0.00', '', '', '0.00', '', '', '890.00', '890', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '6', '0.00', '', '', '0.00', '', '', '0.00', '', '147', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '7', '0.00', '', '', '0.00', '', '', '258.00', '', '', '258');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '8', '0.00', '', '', '0.00', '', '', '0.00', '', '369', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '9', '0.00', '', '', '0.00', '', '', '852.00', '852', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '10', '741.00', '', '', '741.00', '', '741', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '11', '963.00', '', '', '963.00', '963', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '12', '0.00', '', '987', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '13', '654.00', '654', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '14', '321.00', '321', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '15', '3825.00', '1098.00', '1221.00', '2727.00', '1419.00', '1308.00', '2000.00', '1742.00', '516.00', '258.00');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '16', '357.00', '357', '', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '17', '0.00', '', '159', '0.00', '', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '18', '247.00', '', '', '247.00', '247', '', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '19', '269.00', '', '', '269.00', '', '269', '0.00', '', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '20', '0.00', '', '', '0.00', '', '', '358.00', '358', '', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '21', '0.00', '', '', '0.00', '', '', '0.00', '', '489', '');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '22', '0.00', '', '', '0.00', '', '', '578.00', '', '', '578');
INSERT INTO `hg_zxadminbudgetmoney` VALUES ('5', '23', '873.00', '357.00', '159.00', '516.00', '247.00', '269.00', '936.00', '358.00', '489.00', '578.00');

-- ----------------------------
-- Table structure for hg_zxadminname
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxadminname`;
CREATE TABLE `hg_zxadminname` (
  `id` int(8) NOT NULL,
  `name` varchar(40) NOT NULL COMMENT '执行费用名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxadminname
-- ----------------------------
INSERT INTO `hg_zxadminname` VALUES ('1', '行政运行，定员定额，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('2', '行政运行，定员定额，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('3', '行政运行，定项，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('4', '离退休，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('5', '住房公积金，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('6', '购房补贴，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('7', '一般行政事务，中央财政专项，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('8', '缉私办案，定员定额，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('9', '缉私办案，单项，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('10', '收费业务费，定员定额，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('11', '收费业务费，单项，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('12', '金关工程，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('13', '政府基金，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('14', '其他，日常公用');
INSERT INTO `hg_zxadminname` VALUES ('15', '财政资金合计');
INSERT INTO `hg_zxadminname` VALUES ('16', '海关套帐-其它资金，一般行政事务专项，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('17', '海关套帐-其它资金，一般行政事务专项，公用经费');
INSERT INTO `hg_zxadminname` VALUES ('18', '海关套帐-其它资金，其它收支，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('19', '海关套帐-其它资金，其它收支，公用经费');
INSERT INTO `hg_zxadminname` VALUES ('20', '地方罚没套帐-其它资金，地方套帐-地方罚没，人员经费');
INSERT INTO `hg_zxadminname` VALUES ('21', '地方罚没套帐-其它资金，地方套帐-地方罚没，公用经费');
INSERT INTO `hg_zxadminname` VALUES ('22', '地方罚没套帐-其它资金，中央转移支付，公用经费');
INSERT INTO `hg_zxadminname` VALUES ('23', '其他资金合计');

-- ----------------------------
-- Table structure for hg_zxadminoverlook
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxadminoverlook`;
CREATE TABLE `hg_zxadminoverlook` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `pid` int(8) NOT NULL COMMENT '父id',
  `year` int(5) NOT NULL COMMENT '年份',
  `month` int(3) DEFAULT NULL COMMENT '月份',
  `unitid` int(8) NOT NULL COMMENT '单位id',
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxadminoverlook
-- ----------------------------
INSERT INTO `hg_zxadminoverlook` VALUES ('1', '0', '2015', '0', '1', '1441762968');
INSERT INTO `hg_zxadminoverlook` VALUES ('2', '1', '2015', '1', '1', '1441763058');
INSERT INTO `hg_zxadminoverlook` VALUES ('3', '0', '2015', '0', '2', '1441763219');
INSERT INTO `hg_zxadminoverlook` VALUES ('4', '3', '2015', '1', '2', '1441763283');
INSERT INTO `hg_zxadminoverlook` VALUES ('5', '0', '2015', '0', '3', '1441763487');
INSERT INTO `hg_zxadminoverlook` VALUES ('6', '5', '2015', '1', '3', '1441763565');

-- ----------------------------
-- Table structure for hg_zxadminusemoney
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxadminusemoney`;
CREATE TABLE `hg_zxadminusemoney` (
  `overlook_id` int(8) NOT NULL,
  `name_id` int(8) NOT NULL,
  `inadd` varchar(8) DEFAULT NULL COMMENT '实际收入，合计',
  `inlast` varchar(20) DEFAULT NULL COMMENT '收入，调整上年结转',
  `inthisadd` varchar(20) DEFAULT NULL COMMENT '收入，当期实际收入',
  `outadd` varchar(20) DEFAULT NULL COMMENT '支出，合计',
  `outjzout` varchar(20) DEFAULT NULL COMMENT '支出，结转资金支出',
  `outthisout` varchar(20) DEFAULT NULL COMMENT '支出，当期收入支出'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxadminusemoney
-- ----------------------------
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '1', '222.00', '222', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '2', '333.00', '', '333', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '3', '0.00', '', '', '444.00', '444', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '4', '0.00', '', '', '555.00', '', '555');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '5', '0.00', '', '', '666.00', '666', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '6', '777.00', '', '777', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '7', '888.00', '888', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '8', '999.00', '999', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '9', '1212.00', '', '1212', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '10', '0.00', '', '', '2323.00', '2323', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '11', '0.00', '', '', '3434.00', '', '3434');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '12', '0.00', '', '', '4545.00', '4545', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '13', '5656.00', '', '5656', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '14', '6767.00', '6767', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '15', '16854.00', '8876.00', '7978.00', '11967.00', '7978.00', '3989.00');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '16', '8787.00', '8787', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '17', '7676.00', '', '7676', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '18', '0.00', '', '', '5656.00', '5656', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '19', '0.00', '', '', '6767.00', '', '6767');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '20', '0.00', '', '', '7676.00', '7676', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '21', '6565.00', '', '6565', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '22', '5454.00', '5454', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('2', '23', '28482.00', '14241.00', '14241.00', '20099.00', '13332.00', '6767.00');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '1', '2323.00', '2323', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '2', '3434.00', '', '3434', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '3', '0.00', '', '', '4545.00', '4545', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '4', '0.00', '', '', '5656.00', '', '5656');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '5', '0.00', '', '', '6767.00', '6767', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '6', '666.00', '', '666', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '7', '7777.00', '7777', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '8', '8888.00', '8888', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '9', '5555.00', '', '5555', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '10', '0.00', '', '', '9098.00', '9098', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '11', '0.00', '', '', '4545.00', '', '4545');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '12', '0.00', '', '', '5656.00', '5656', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '13', '6767.00', '', '6767', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '14', '7878.00', '7878', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '15', '43288.00', '26866.00', '16422.00', '36267.00', '26066.00', '10201.00');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '16', '4545.00', '4545', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '17', '6565.00', '', '6565', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '18', '0.00', '', '', '1212.00', '1212', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '19', '0.00', '', '', '2323.00', '', '2323');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '20', '0.00', '', '', '1122.00', '1122', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '21', '3344.00', '', '3344', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '22', '3322.00', '3322', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('4', '23', '17776.00', '7867.00', '9909.00', '4657.00', '2334.00', '2323.00');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '1', '258.00', '258', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '2', '369.00', '', '369', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '3', '0.00', '', '', '357.00', '357', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '4', '0.00', '', '', '158.00', '', '158');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '5', '0.00', '', '', '248.00', '248', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '6', '596.00', '', '596', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '7', '865.00', '865', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '8', '987.00', '', '987', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '9', '0.00', '', '', '657.00', '657', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '10', '0.00', '', '', '354.00', '', '354');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '11', '0.00', '', '', '325.00', '325', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '12', '368.00', '', '368', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '13', '965.00', '965', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '14', '598.00', '', '598', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '15', '5006.00', '2088.00', '2918.00', '2099.00', '1587.00', '512.00');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '16', '789.00', '789', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '17', '687.00', '', '687', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '18', '0.00', '', '', '658.00', '658', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '19', '0.00', '', '', '659.00', '', '659');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '20', '0.00', '', '', '548.00', '548', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '21', '687.00', '', '687', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '22', '125.00', '125', '', '0.00', '', '');
INSERT INTO `hg_zxadminusemoney` VALUES ('6', '23', '2288.00', '914.00', '1374.00', '1865.00', '1206.00', '659.00');

-- ----------------------------
-- Table structure for hg_zxqiye
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxqiye`;
CREATE TABLE `hg_zxqiye` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `unitid` int(8) NOT NULL,
  `sectionname` varchar(20) NOT NULL,
  `lastshishou` varchar(20) NOT NULL COMMENT '上年所有者权益，实收资本',
  `lastgongji` varchar(20) NOT NULL COMMENT '上年所有者权益，资本公积',
  `lastyingyu` varchar(20) NOT NULL COMMENT '上年所有者权益，盈余公积',
  `lastwei` varchar(20) NOT NULL COMMENT '上年所有者权益，未分配利润',
  `inzhuying` varchar(20) NOT NULL COMMENT '收入，主营收入',
  `inother` varchar(20) NOT NULL COMMENT '收入，其它业务收入',
  `outzhuying` varchar(20) NOT NULL COMMENT '支出，主营业务支出',
  `outother` varchar(20) NOT NULL COMMENT '支出，其它业务支出',
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxqiye
-- ----------------------------
INSERT INTO `hg_zxqiye` VALUES ('1', '2015', '1', '1', '服务中心', '3434', '', '', '', '', '', '', '', '1441763072');
INSERT INTO `hg_zxqiye` VALUES ('2', '2015', '1', '2', '数据分中心', '3466', '', '', '', '', '', '', '', '1441763331');

-- ----------------------------
-- Table structure for hg_zxshetuan
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxshetuan`;
CREATE TABLE `hg_zxshetuan` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `unitid` int(8) NOT NULL,
  `sectionname` varchar(20) NOT NULL,
  `lastadd` varchar(20) NOT NULL COMMENT '上年结余',
  `inhuifei` varchar(20) NOT NULL COMMENT '收入，会费收入',
  `inyewu` varchar(20) NOT NULL COMMENT '收入，业务收入',
  `outyewu` varchar(20) NOT NULL COMMENT '支出，业务支出',
  `outguanli` varchar(20) NOT NULL COMMENT '支出，管理支出',
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxshetuan
-- ----------------------------
INSERT INTO `hg_zxshetuan` VALUES ('1', '2015', '1', '1', '服务中心', '', '5656', '', '', '', '1441763092');
INSERT INTO `hg_zxshetuan` VALUES ('2', '2015', '1', '2', '数据分中心', '', '5677', '', '', '', '1441763341');

-- ----------------------------
-- Table structure for hg_zxshiye
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxshiye`;
CREATE TABLE `hg_zxshiye` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `unitid` int(8) NOT NULL,
  `sectionname` varchar(20) NOT NULL,
  `lastshiye` varchar(20) NOT NULL COMMENT '上年结余，事业基金',
  `lastzhuanyong` varchar(20) NOT NULL COMMENT '上年结余，专用基金',
  `inshiye` varchar(20) NOT NULL COMMENT '收入，事业收入',
  `injingying` varchar(20) NOT NULL COMMENT '收入，经营收入',
  `outshiye` varchar(20) NOT NULL COMMENT '支出，事业支出',
  `outjingying` varchar(20) NOT NULL COMMENT '支出，经营支出',
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxshiye
-- ----------------------------
INSERT INTO `hg_zxshiye` VALUES ('1', '2015', '1', '1', '服务中心', '2323', '', '', '', '', '', '1441763066');
INSERT INTO `hg_zxshiye` VALUES ('2', '2015', '1', '2', '数据分中心', '4543', '6554', '', '', '', '', '1441763323');

-- ----------------------------
-- Table structure for hg_zxwuxiangmoney
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxwuxiangmoney`;
CREATE TABLE `hg_zxwuxiangmoney` (
  `overlook_id` int(8) NOT NULL,
  `name_id` int(8) NOT NULL,
  `alladd` varchar(8) DEFAULT NULL COMMENT '总合计',
  `jingfeiztadd` varchar(20) DEFAULT NULL COMMENT '经费账套合计',
  `czadd` varchar(20) DEFAULT NULL COMMENT '财政小计',
  `czyunxing` varchar(20) DEFAULT NULL COMMENT '财政，行政运行',
  `czjishi` varchar(20) DEFAULT NULL COMMENT '财政缉私办案',
  `czshoufei` varchar(20) DEFAULT NULL COMMENT '财政，收费业务',
  `czother` varchar(20) DEFAULT NULL COMMENT '财政，其它',
  `nczadd` varchar(20) DEFAULT NULL COMMENT '非财政，小计',
  `nczotherin` varchar(20) DEFAULT NULL COMMENT '非财政，其它收支',
  `nczdfzx` varchar(20) DEFAULT NULL COMMENT '非财政，地方专项',
  `dfztadd` varchar(20) DEFAULT NULL COMMENT '地方账套合计',
  `dfdf` varchar(20) DEFAULT NULL COMMENT '地方账套，地方',
  `dfzypay` varchar(20) DEFAULT NULL COMMENT '地方套帐，转移支付'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxwuxiangmoney
-- ----------------------------
INSERT INTO `hg_zxwuxiangmoney` VALUES ('1', '1', '2323.00', '2323.00', '2323.00', '2323', '', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('1', '2', '3434.00', '3434.00', '3434.00', '', '3434', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('1', '3', '4545.00', '4545.00', '4545.00', '', '', '4545', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('1', '4', '5656.00', '5656.00', '5656.00', '', '', '', '5656', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('1', '5', '0.00', '7878.00', '0.00', '', '', '', '', '7878.00', '7878', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('2', '1', '111.00', '111.00', '111.00', '', '111', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('2', '2', '222.00', '222.00', '222.00', '', '', '222', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('2', '3', '333.00', '333.00', '333.00', '', '', '', '333', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('2', '4', '0.00', '444.00', '0.00', '', '', '', '', '444.00', '444', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('2', '5', '0.00', '555.00', '0.00', '', '', '', '', '555.00', '', '555', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('3', '1', '5656.00', '5656.00', '5656.00', '5656', '', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('3', '2', '6767.00', '6767.00', '6767.00', '', '6767', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('3', '3', '7878.00', '7878.00', '7878.00', '', '', '7878', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('3', '4', '8989.00', '8989.00', '8989.00', '', '', '', '8989', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('3', '5', '0.00', '9898.00', '0.00', '', '', '', '', '9898.00', '9898', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('4', '1', '1112.00', '1112.00', '1112.00', '1112', '', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('4', '2', '2223.00', '2223.00', '2223.00', '', '2223', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('4', '3', '3334.00', '3334.00', '3334.00', '', '', '3334', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('4', '4', '5554.00', '5554.00', '5554.00', '', '', '', '5554', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('4', '5', '0.00', '3335.00', '0.00', '', '', '', '', '3335.00', '3335', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('5', '1', '578.00', '578.00', '578.00', '578', '', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('5', '2', '598.00', '598.00', '598.00', '', '598', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('5', '3', '358.00', '358.00', '358.00', '', '', '358', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('5', '4', '327.00', '327.00', '327.00', '', '', '', '327', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('5', '5', '0.00', '546.00', '0.00', '', '', '', '', '546.00', '546', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('6', '1', '123.00', '123.00', '123.00', '123', '', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('6', '2', '321.00', '321.00', '321.00', '', '321', '', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('6', '3', '258.00', '258.00', '258.00', '', '', '258', '', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('6', '4', '147.00', '147.00', '147.00', '', '', '', '147', '0.00', '', '', '0.00', '', '');
INSERT INTO `hg_zxwuxiangmoney` VALUES ('6', '5', '0.00', '369.00', '0.00', '', '', '', '', '369.00', '369', '', '0.00', '', '');

-- ----------------------------
-- Table structure for hg_zxwuxiangname
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxwuxiangname`;
CREATE TABLE `hg_zxwuxiangname` (
  `id` int(8) NOT NULL,
  `name` varchar(40) NOT NULL COMMENT '执行费用名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxwuxiangname
-- ----------------------------
INSERT INTO `hg_zxwuxiangname` VALUES ('1', '公务车运行维护费');
INSERT INTO `hg_zxwuxiangname` VALUES ('2', '公务接待费');
INSERT INTO `hg_zxwuxiangname` VALUES ('3', '因公出国费');
INSERT INTO `hg_zxwuxiangname` VALUES ('4', '培训费');
INSERT INTO `hg_zxwuxiangname` VALUES ('5', '会议费');

-- ----------------------------
-- Table structure for hg_zxwuxiangoverlook
-- ----------------------------
DROP TABLE IF EXISTS `hg_zxwuxiangoverlook`;
CREATE TABLE `hg_zxwuxiangoverlook` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `pid` int(8) NOT NULL COMMENT '父id',
  `year` int(5) NOT NULL COMMENT '年份',
  `month` int(3) DEFAULT NULL COMMENT '月份',
  `unitid` int(8) NOT NULL COMMENT '单位id',
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hg_zxwuxiangoverlook
-- ----------------------------
INSERT INTO `hg_zxwuxiangoverlook` VALUES ('1', '0', '2015', '0', '1', '1441763118');
INSERT INTO `hg_zxwuxiangoverlook` VALUES ('2', '1', '2015', '1', '1', '1441763133');
INSERT INTO `hg_zxwuxiangoverlook` VALUES ('3', '0', '2015', '0', '2', '1441763358');
INSERT INTO `hg_zxwuxiangoverlook` VALUES ('4', '3', '2015', '1', '2', '1441763377');
INSERT INTO `hg_zxwuxiangoverlook` VALUES ('5', '0', '2015', '0', '3', '1441763615');
INSERT INTO `hg_zxwuxiangoverlook` VALUES ('6', '5', '2015', '1', '3', '1441763628');
