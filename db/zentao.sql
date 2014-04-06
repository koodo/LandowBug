/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : zentao

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2014-03-01 18:00:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zt_action
-- ----------------------------
DROP TABLE IF EXISTS `zt_action`;
CREATE TABLE `zt_action` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `objectType` varchar(30) NOT NULL DEFAULT '',
  `objectID` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product` varchar(255) NOT NULL,
  `project` mediumint(9) NOT NULL,
  `actor` varchar(30) NOT NULL DEFAULT '',
  `action` varchar(30) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `comment` text NOT NULL,
  `extra` varchar(255) NOT NULL,
  `read` enum('0','1') NOT NULL DEFAULT '0',
  `assignto` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=527 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_bug
-- ----------------------------
DROP TABLE IF EXISTS `zt_bug`;
CREATE TABLE `zt_bug` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `plan` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `story` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `storyVersion` smallint(6) NOT NULL DEFAULT '1',
  `task` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `toTask` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `toStory` mediumint(8) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `severity` tinyint(4) NOT NULL DEFAULT '0',
  `pri` tinyint(3) unsigned NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '',
  `os` varchar(30) NOT NULL DEFAULT '',
  `browser` varchar(30) NOT NULL DEFAULT '',
  `hardware` varchar(30) NOT NULL,
  `found` varchar(30) NOT NULL DEFAULT '',
  `steps` text NOT NULL,
  `status` enum('active','resolved','suspend','closed','needcheck') NOT NULL DEFAULT 'active',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `activatedCount` smallint(6) NOT NULL,
  `mailto` varchar(255) NOT NULL DEFAULT '',
  `openedBy` varchar(30) NOT NULL DEFAULT '',
  `openedDate` datetime NOT NULL,
  `openedBuild` varchar(255) NOT NULL,
  `assignedTo` varchar(30) NOT NULL DEFAULT '',
  `assignedDate` datetime NOT NULL,
  `resolvedBy` varchar(30) NOT NULL DEFAULT '',
  `resolution` varchar(30) NOT NULL DEFAULT '',
  `resolvedBuild` varchar(30) NOT NULL DEFAULT '',
  `resolvedDate` datetime NOT NULL,
  `closedBy` varchar(30) NOT NULL DEFAULT '',
  `closedDate` datetime NOT NULL,
  `duplicateBug` mediumint(8) unsigned NOT NULL,
  `linkBug` varchar(255) NOT NULL,
  `case` mediumint(8) unsigned NOT NULL,
  `caseVersion` smallint(6) NOT NULL DEFAULT '1',
  `result` mediumint(8) unsigned NOT NULL,
  `lastEditedBy` varchar(30) NOT NULL DEFAULT '',
  `lastEditedDate` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=370 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_build
-- ----------------------------
DROP TABLE IF EXISTS `zt_build`;
CREATE TABLE `zt_build` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(150) NOT NULL,
  `scmPath` char(255) DEFAULT NULL,
  `filePath` char(255) DEFAULT NULL,
  `date` date NOT NULL,
  `stories` text,
  `bugs` text,
  `builder` char(30) NOT NULL DEFAULT '',
  `desc` text,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_burn
-- ----------------------------
DROP TABLE IF EXISTS `zt_burn`;
CREATE TABLE `zt_burn` (
  `project` mediumint(8) unsigned NOT NULL,
  `date` date NOT NULL,
  `left` float NOT NULL,
  `consumed` float NOT NULL,
  PRIMARY KEY (`project`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_case
-- ----------------------------
DROP TABLE IF EXISTS `zt_case`;
CREATE TABLE `zt_case` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `path` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `story` mediumint(30) unsigned NOT NULL DEFAULT '0',
  `storyVersion` smallint(6) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `precondition` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `pri` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `type` char(30) NOT NULL DEFAULT '1',
  `stage` varchar(255) NOT NULL,
  `howRun` varchar(30) NOT NULL,
  `scriptedBy` varchar(30) NOT NULL,
  `scriptedDate` date NOT NULL,
  `scriptStatus` varchar(30) NOT NULL,
  `scriptLocation` varchar(255) NOT NULL,
  `status` char(30) NOT NULL DEFAULT '1',
  `frequency` enum('1','2','3') NOT NULL DEFAULT '1',
  `order` tinyint(30) unsigned NOT NULL DEFAULT '0',
  `openedBy` char(30) NOT NULL DEFAULT '',
  `openedDate` datetime NOT NULL,
  `lastEditedBy` char(30) NOT NULL DEFAULT '',
  `lastEditedDate` datetime NOT NULL,
  `version` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `linkCase` varchar(255) NOT NULL,
  `fromBug` mediumint(8) unsigned NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `lastRunner` varchar(30) NOT NULL,
  `lastRunDate` datetime NOT NULL,
  `lastRunResult` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_casestep
-- ----------------------------
DROP TABLE IF EXISTS `zt_casestep`;
CREATE TABLE `zt_casestep` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `case` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `version` smallint(3) unsigned NOT NULL DEFAULT '0',
  `desc` text NOT NULL,
  `expect` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `case` (`case`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_company
-- ----------------------------
DROP TABLE IF EXISTS `zt_company`;
CREATE TABLE `zt_company` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(120) DEFAULT NULL,
  `phone` char(20) DEFAULT NULL,
  `fax` char(20) DEFAULT NULL,
  `address` char(120) DEFAULT NULL,
  `zipcode` char(10) DEFAULT NULL,
  `website` char(120) DEFAULT NULL,
  `backyard` char(120) DEFAULT NULL,
  `guest` enum('1','0') NOT NULL DEFAULT '0',
  `admins` char(255) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_config
-- ----------------------------
DROP TABLE IF EXISTS `zt_config`;
CREATE TABLE `zt_config` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` char(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL,
  `section` char(30) NOT NULL DEFAULT '',
  `key` char(30) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`owner`,`module`,`section`,`key`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_dept
-- ----------------------------
DROP TABLE IF EXISTS `zt_dept`;
CREATE TABLE `zt_dept` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(60) NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `position` char(30) NOT NULL DEFAULT '',
  `function` char(255) NOT NULL DEFAULT '',
  `manager` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_doc
-- ----------------------------
DROP TABLE IF EXISTS `zt_doc`;
CREATE TABLE `zt_doc` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL,
  `project` mediumint(8) unsigned NOT NULL,
  `lib` varchar(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `digest` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `views` smallint(5) unsigned NOT NULL,
  `addedBy` varchar(30) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedBy` varchar(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_doclib
-- ----------------------------
DROP TABLE IF EXISTS `zt_doclib`;
CREATE TABLE `zt_doclib` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_effort
-- ----------------------------
DROP TABLE IF EXISTS `zt_effort`;
CREATE TABLE `zt_effort` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` char(30) NOT NULL DEFAULT '',
  `todo` enum('1','0') NOT NULL DEFAULT '1',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `begin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` enum('1','2','3') NOT NULL DEFAULT '1',
  `idvalue` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `desc` char(255) NOT NULL DEFAULT '',
  `status` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_extension
-- ----------------------------
DROP TABLE IF EXISTS `zt_extension`;
CREATE TABLE `zt_extension` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `code` varchar(30) NOT NULL,
  `version` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `license` text NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'extension',
  `site` varchar(150) NOT NULL,
  `zentaoCompatible` varchar(100) NOT NULL,
  `installedTime` datetime NOT NULL,
  `depends` varchar(100) NOT NULL,
  `dirs` text NOT NULL,
  `files` text NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `addedTime` (`installedTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_file
-- ----------------------------
DROP TABLE IF EXISTS `zt_file`;
CREATE TABLE `zt_file` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pathname` char(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `extension` char(30) NOT NULL,
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `objectType` char(30) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `addedBy` char(30) NOT NULL DEFAULT '',
  `addedDate` datetime NOT NULL,
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_group
-- ----------------------------
DROP TABLE IF EXISTS `zt_group`;
CREATE TABLE `zt_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `role` char(30) NOT NULL DEFAULT '',
  `desc` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_grouppriv
-- ----------------------------
DROP TABLE IF EXISTS `zt_grouppriv`;
CREATE TABLE `zt_grouppriv` (
  `group` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module` char(30) NOT NULL DEFAULT '',
  `method` char(30) NOT NULL DEFAULT '',
  UNIQUE KEY `group` (`group`,`module`,`method`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_history
-- ----------------------------
DROP TABLE IF EXISTS `zt_history`;
CREATE TABLE `zt_history` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `action` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field` varchar(30) NOT NULL DEFAULT '',
  `old` text NOT NULL,
  `new` text NOT NULL,
  `diff` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_lang
-- ----------------------------
DROP TABLE IF EXISTS `zt_lang`;
CREATE TABLE `zt_lang` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `section` varchar(30) NOT NULL,
  `key` varchar(60) NOT NULL,
  `value` text NOT NULL,
  `system` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `lang` (`lang`,`module`,`section`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_lastproject
-- ----------------------------
DROP TABLE IF EXISTS `zt_lastproject`;
CREATE TABLE `zt_lastproject` (
  `account` varchar(255) NOT NULL,
  `lastproject` int(11) DEFAULT NULL,
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for zt_module
-- ----------------------------
DROP TABLE IF EXISTS `zt_module`;
CREATE TABLE `zt_module` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `root` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(60) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` char(30) NOT NULL,
  `owner` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_module1
-- ----------------------------
DROP TABLE IF EXISTS `zt_module1`;
CREATE TABLE `zt_module1` (
  `project` int(11) NOT NULL,
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(255) COLLATE utf8_bin NOT NULL,
  `assignto` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for zt_product
-- ----------------------------
DROP TABLE IF EXISTS `zt_product`;
CREATE TABLE `zt_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `code` varchar(45) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `PO` varchar(30) NOT NULL,
  `QD` varchar(30) NOT NULL,
  `RD` varchar(30) NOT NULL,
  `acl` enum('open','private','custom') NOT NULL DEFAULT 'open',
  `whitelist` varchar(255) NOT NULL,
  `createdBy` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdVersion` varchar(20) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_productplan
-- ----------------------------
DROP TABLE IF EXISTS `zt_productplan`;
CREATE TABLE `zt_productplan` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL,
  `title` varchar(90) NOT NULL,
  `desc` text NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_project
-- ----------------------------
DROP TABLE IF EXISTS `zt_project`;
CREATE TABLE `zt_project` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `isCat` enum('1','0') NOT NULL DEFAULT '0',
  `catID` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'sprint',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(90) NOT NULL,
  `code` varchar(45) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `days` smallint(5) unsigned NOT NULL,
  `status` varchar(10) NOT NULL,
  `statge` enum('1','2','3','4','5') NOT NULL DEFAULT '1',
  `pri` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `desc` text NOT NULL,
  `goal` text NOT NULL,
  `openedBy` varchar(30) NOT NULL DEFAULT '',
  `openedDate` int(10) unsigned NOT NULL DEFAULT '0',
  `openedVersion` varchar(20) NOT NULL,
  `closedBy` varchar(30) NOT NULL DEFAULT '',
  `closedDate` int(10) unsigned NOT NULL DEFAULT '0',
  `canceledBy` varchar(30) NOT NULL DEFAULT '',
  `canceledDate` int(10) unsigned NOT NULL DEFAULT '0',
  `PO` varchar(30) NOT NULL DEFAULT '',
  `PM` varchar(30) NOT NULL DEFAULT '',
  `QD` varchar(30) NOT NULL DEFAULT '',
  `RD` varchar(30) NOT NULL DEFAULT '',
  `teamid` int(11) DEFAULT NULL,
  `team` varchar(30) NOT NULL,
  `acl` enum('open','private','custom') NOT NULL DEFAULT 'open',
  `whitelist` varchar(255) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project` (`type`,`parent`,`begin`,`end`,`status`,`statge`,`pri`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_projectproduct
-- ----------------------------
DROP TABLE IF EXISTS `zt_projectproduct`;
CREATE TABLE `zt_projectproduct` (
  `project` mediumint(8) unsigned NOT NULL,
  `product` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`project`,`product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_projectstory
-- ----------------------------
DROP TABLE IF EXISTS `zt_projectstory`;
CREATE TABLE `zt_projectstory` (
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product` mediumint(8) unsigned NOT NULL,
  `story` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `version` smallint(6) NOT NULL DEFAULT '1',
  UNIQUE KEY `project` (`project`,`story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_release
-- ----------------------------
DROP TABLE IF EXISTS `zt_release`;
CREATE TABLE `zt_release` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `build` mediumint(8) unsigned NOT NULL,
  `name` char(30) NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `stories` text NOT NULL,
  `bugs` text NOT NULL,
  `desc` text NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_story
-- ----------------------------
DROP TABLE IF EXISTS `zt_story`;
CREATE TABLE `zt_story` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `plan` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `source` varchar(20) NOT NULL,
  `fromBug` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '',
  `pri` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `estimate` float unsigned NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `stage` varchar(30) NOT NULL,
  `mailto` varchar(255) NOT NULL DEFAULT '',
  `openedBy` varchar(30) NOT NULL DEFAULT '',
  `openedDate` datetime NOT NULL,
  `assignedTo` varchar(30) NOT NULL DEFAULT '',
  `assignedDate` datetime NOT NULL,
  `lastEditedBy` varchar(30) NOT NULL DEFAULT '',
  `lastEditedDate` datetime NOT NULL,
  `reviewedBy` varchar(255) NOT NULL,
  `reviewedDate` date NOT NULL,
  `closedBy` varchar(30) NOT NULL DEFAULT '',
  `closedDate` datetime NOT NULL,
  `closedReason` varchar(30) NOT NULL,
  `toBug` mediumint(9) NOT NULL,
  `childStories` varchar(255) NOT NULL,
  `linkStories` varchar(255) NOT NULL,
  `duplicateStory` mediumint(8) unsigned NOT NULL,
  `version` smallint(6) NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product` (`product`,`module`,`plan`,`type`,`pri`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_storyspec
-- ----------------------------
DROP TABLE IF EXISTS `zt_storyspec`;
CREATE TABLE `zt_storyspec` (
  `story` mediumint(9) NOT NULL,
  `version` smallint(6) NOT NULL,
  `title` varchar(90) NOT NULL,
  `spec` text NOT NULL,
  `verify` text NOT NULL,
  UNIQUE KEY `story` (`story`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_task
-- ----------------------------
DROP TABLE IF EXISTS `zt_task`;
CREATE TABLE `zt_task` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `story` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `storyVersion` smallint(6) NOT NULL DEFAULT '1',
  `fromBug` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pri` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `estimate` float unsigned NOT NULL,
  `consumed` float unsigned NOT NULL,
  `left` float unsigned NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('wait','doing','done','cancel','closed') NOT NULL DEFAULT 'wait',
  `statusCustom` tinyint(3) unsigned NOT NULL,
  `mailto` varchar(255) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `openedBy` varchar(30) NOT NULL,
  `openedDate` datetime NOT NULL,
  `assignedTo` varchar(30) NOT NULL,
  `assignedDate` datetime NOT NULL,
  `estStarted` date NOT NULL,
  `realStarted` date NOT NULL,
  `finishedBy` varchar(30) NOT NULL,
  `finishedDate` datetime NOT NULL,
  `canceledBy` varchar(30) NOT NULL,
  `canceledDate` datetime NOT NULL,
  `closedBy` varchar(30) NOT NULL,
  `closedDate` datetime NOT NULL,
  `closedReason` varchar(30) NOT NULL,
  `lastEditedBy` varchar(30) NOT NULL,
  `lastEditedDate` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `statusOrder` (`statusCustom`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_taskestimate
-- ----------------------------
DROP TABLE IF EXISTS `zt_taskestimate`;
CREATE TABLE `zt_taskestimate` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `task` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `left` float unsigned NOT NULL DEFAULT '0',
  `consumed` float unsigned NOT NULL,
  `account` char(30) NOT NULL DEFAULT '',
  `work` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task` (`task`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_team
-- ----------------------------
DROP TABLE IF EXISTS `zt_team`;
CREATE TABLE `zt_team` (
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) NOT NULL DEFAULT '',
  `join` date NOT NULL DEFAULT '0000-00-00',
  `isadmin` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_teamlist
-- ----------------------------
DROP TABLE IF EXISTS `zt_teamlist`;
CREATE TABLE `zt_teamlist` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tname` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` date DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `creator` varchar(255) COLLATE utf8_bin NOT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`tid`,`tname`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for zt_team_cm
-- ----------------------------
DROP TABLE IF EXISTS `zt_team_cm`;
CREATE TABLE `zt_team_cm` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) NOT NULL DEFAULT '',
  `join` date NOT NULL DEFAULT '0000-00-00',
  `isadmin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`,`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_testresult
-- ----------------------------
DROP TABLE IF EXISTS `zt_testresult`;
CREATE TABLE `zt_testresult` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `run` mediumint(8) unsigned NOT NULL,
  `case` mediumint(8) unsigned NOT NULL,
  `version` smallint(5) unsigned NOT NULL,
  `caseResult` char(30) NOT NULL,
  `stepResults` text NOT NULL,
  `lastRunner` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `run` (`run`),
  KEY `case` (`case`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_testrun
-- ----------------------------
DROP TABLE IF EXISTS `zt_testrun`;
CREATE TABLE `zt_testrun` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `task` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `case` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `version` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `assignedTo` char(30) NOT NULL DEFAULT '',
  `lastRunner` varchar(30) NOT NULL,
  `lastRunDate` datetime NOT NULL,
  `lastRunResult` char(30) NOT NULL,
  `status` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task` (`task`,`case`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_testtask
-- ----------------------------
DROP TABLE IF EXISTS `zt_testtask`;
CREATE TABLE `zt_testtask` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(90) NOT NULL,
  `product` mediumint(8) unsigned NOT NULL,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `build` char(30) NOT NULL,
  `owner` varchar(30) NOT NULL,
  `pri` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `desc` text NOT NULL,
  `report` text NOT NULL,
  `status` char(30) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_todo
-- ----------------------------
DROP TABLE IF EXISTS `zt_todo`;
CREATE TABLE `zt_todo` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `begin` smallint(4) unsigned zerofill NOT NULL,
  `end` smallint(4) unsigned zerofill NOT NULL,
  `type` char(10) NOT NULL,
  `idvalue` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pri` tinyint(3) unsigned NOT NULL,
  `name` char(150) NOT NULL,
  `desc` text NOT NULL,
  `status` char(20) NOT NULL DEFAULT '',
  `private` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_user
-- ----------------------------
DROP TABLE IF EXISTS `zt_user`;
CREATE TABLE `zt_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `dept` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `role` char(10) NOT NULL DEFAULT '',
  `realname` char(30) NOT NULL DEFAULT '',
  `nickname` char(60) NOT NULL DEFAULT '',
  `commiter` varchar(100) NOT NULL,
  `avatar` char(30) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `gender` enum('f','m') NOT NULL DEFAULT 'f',
  `email` char(90) NOT NULL DEFAULT '',
  `skype` char(90) NOT NULL DEFAULT '',
  `qq` char(20) NOT NULL DEFAULT '',
  `yahoo` char(90) NOT NULL DEFAULT '',
  `gtalk` char(90) NOT NULL DEFAULT '',
  `wangwang` char(90) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `phone` char(20) NOT NULL DEFAULT '',
  `address` char(120) NOT NULL DEFAULT '',
  `zipcode` char(10) NOT NULL DEFAULT '',
  `join` date NOT NULL DEFAULT '0000-00-00',
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `last` int(10) unsigned NOT NULL DEFAULT '0',
  `fails` tinyint(5) NOT NULL DEFAULT '0',
  `locked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`),
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `dept` (`dept`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_usercontact
-- ----------------------------
DROP TABLE IF EXISTS `zt_usercontact`;
CREATE TABLE `zt_usercontact` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `listName` varchar(60) NOT NULL,
  `userList` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `zt_usergroup`;
CREATE TABLE `zt_usergroup` (
  `account` char(30) NOT NULL DEFAULT '',
  `group` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `account` (`account`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_userquery
-- ----------------------------
DROP TABLE IF EXISTS `zt_userquery`;
CREATE TABLE `zt_userquery` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `title` varchar(90) NOT NULL,
  `form` text NOT NULL,
  `sql` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_usertpl
-- ----------------------------
DROP TABLE IF EXISTS `zt_usertpl`;
CREATE TABLE `zt_usertpl` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `type` char(30) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zt_webapp
-- ----------------------------
DROP TABLE IF EXISTS `zt_webapp`;
CREATE TABLE `zt_webapp` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `appid` mediumint(9) NOT NULL,
  `module` mediumint(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `target` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `abstract` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `addedBy` char(30) NOT NULL,
  `addedDate` datetime NOT NULL,
  `addType` varchar(20) NOT NULL DEFAULT 'system',
  `views` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `zt_grouppriv` VALUES ('1', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('1', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('1', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('1', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'admin', 'checkDB');
INSERT INTO `zt_grouppriv` VALUES ('1', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('1', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'build', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'build', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'build', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'checkBugFree');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'checkConfig');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'checkRedmine');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'convertBugFree');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'convertRedmine');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'execute');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'selectSource');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'setBugfree');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'setConfig');
INSERT INTO `zt_grouppriv` VALUES ('1', 'convert', 'setRedmine');
INSERT INTO `zt_grouppriv` VALUES ('1', 'dept', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'dept', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'dept', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('1', 'dept', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'createLib');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'deleteLib');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'editor', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'editor', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'editor', 'extend');
INSERT INTO `zt_grouppriv` VALUES ('1', 'editor', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'editor', 'newPage');
INSERT INTO `zt_grouppriv` VALUES ('1', 'editor', 'save');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'deactivate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'erase');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'install');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'uninstall');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'upgrade');
INSERT INTO `zt_grouppriv` VALUES ('1', 'extension', 'upload');
INSERT INTO `zt_grouppriv` VALUES ('1', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('1', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'copy');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'manageMember');
INSERT INTO `zt_grouppriv` VALUES ('1', 'group', 'managePriv');
INSERT INTO `zt_grouppriv` VALUES ('1', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'mail', 'detect');
INSERT INTO `zt_grouppriv` VALUES ('1', 'mail', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'mail', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'mail', 'save');
INSERT INTO `zt_grouppriv` VALUES ('1', 'mail', 'test');
INSERT INTO `zt_grouppriv` VALUES ('1', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('1', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'close');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'order');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('1', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'batchUnlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('1', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'close');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'computeBurn');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'importBug');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'importtask');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'manageMembers');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'manageProducts');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'order');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'putoff');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'start');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'unlinkMember');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('1', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'release', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'release', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'release', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('1', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('1', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('1', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('1', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('1', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('1', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('1', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('1', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('1', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('1', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'change');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'close');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'review');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('1', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('1', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('1', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'cancel');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'close');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'start');
INSERT INTO `zt_grouppriv` VALUES ('1', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'batchAssign');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'batchRun');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'close');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'linkcase');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'runcase');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'start');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'unlinkcase');
INSERT INTO `zt_grouppriv` VALUES ('1', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('1', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'browseTask');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'fix');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('1', 'tree', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'unlock');
INSERT INTO `zt_grouppriv` VALUES ('1', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'create');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'install');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'uninstall');
INSERT INTO `zt_grouppriv` VALUES ('1', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('2', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'build', 'create');
INSERT INTO `zt_grouppriv` VALUES ('2', 'build', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('2', 'build', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('2', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('2', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('2', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('2', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('2', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'computeBurn');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'importBug');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'importtask');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('2', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('2', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('2', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('2', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('2', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('2', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('2', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('2', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('2', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('2', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('2', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('2', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('2', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('2', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('2', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('2', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('2', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'cancel');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'close');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'create');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'start');
INSERT INTO `zt_grouppriv` VALUES ('2', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'create');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('2', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('2', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('2', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('2', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('2', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('2', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'build', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'build', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('3', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('3', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('3', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('3', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('3', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'computeBurn');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'importBug');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'importtask');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('3', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('3', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('3', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('3', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('3', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('3', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('3', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('3', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('3', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('3', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('3', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('3', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('3', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('3', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('3', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('3', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('3', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'cancel');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'close');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'start');
INSERT INTO `zt_grouppriv` VALUES ('3', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'batchAssign');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'batchRun');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'close');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'linkcase');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'runcase');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'start');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'unlinkcase');
INSERT INTO `zt_grouppriv` VALUES ('3', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('3', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'tree', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('3', 'tree', 'browseTask');
INSERT INTO `zt_grouppriv` VALUES ('3', 'tree', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('3', 'tree', 'fix');
INSERT INTO `zt_grouppriv` VALUES ('3', 'tree', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('3', 'tree', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('3', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('3', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('3', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('3', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('4', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('4', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('4', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('4', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'build', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'build', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'build', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('4', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'createLib');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'deleteLib');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('4', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('4', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('4', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('4', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('4', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'close');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'computeBurn');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'importBug');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'importtask');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'manageMembers');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'manageProducts');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'order');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'putoff');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'start');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'unlinkMember');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('4', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('4', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('4', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('4', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('4', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('4', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('4', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('4', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('4', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('4', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('4', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('4', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('4', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('4', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('4', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('4', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('4', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'cancel');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'close');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'start');
INSERT INTO `zt_grouppriv` VALUES ('4', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('4', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('4', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'browseTask');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'fix');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('4', 'tree', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('4', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('4', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('4', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('4', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('5', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('5', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('5', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('5', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('5', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'createLib');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'deleteLib');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('5', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('5', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('5', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('5', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'close');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'order');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('5', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'batchUnlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('5', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'manageProducts');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('5', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'release', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'release', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'release', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('5', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('5', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('5', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('5', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('5', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('5', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('5', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('5', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('5', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('5', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'change');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'close');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'review');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('5', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('5', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('5', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('5', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('5', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('5', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('5', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('5', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'browseTask');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'fix');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('5', 'tree', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('5', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('5', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('5', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('5', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('6', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('6', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('6', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('6', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'build', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'build', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'build', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('6', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'createLib');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'deleteLib');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('6', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('6', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('6', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('6', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('6', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'close');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'computeBurn');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'importBug');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'importtask');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'manageMembers');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'manageProducts');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'order');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'putoff');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'start');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'unlinkMember');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('6', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('6', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('6', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('6', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('6', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('6', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('6', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('6', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('6', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('6', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('6', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('6', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('6', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('6', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('6', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('6', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('6', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'cancel');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'close');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'start');
INSERT INTO `zt_grouppriv` VALUES ('6', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('6', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('6', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('6', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('6', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('6', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('6', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('7', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('7', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('7', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'admin', 'checkDB');
INSERT INTO `zt_grouppriv` VALUES ('7', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('7', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('7', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'createLib');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'deleteLib');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('7', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('7', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('7', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('7', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'close');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'order');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('7', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'batchUnlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('7', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'linkStory');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'manageProducts');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'unlinkStory');
INSERT INTO `zt_grouppriv` VALUES ('7', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'release', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'release', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'release', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('7', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('7', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('7', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('7', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('7', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('7', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('7', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('7', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('7', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('7', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'change');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'close');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'review');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('7', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('7', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('7', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('7', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('7', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('7', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('7', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('7', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'browseTask');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'fix');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('7', 'tree', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('7', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('7', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('7', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('7', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('8', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('8', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('8', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'confirmBug');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'deleteTemplate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'resolve');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'saveTemplate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('8', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'build', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'build', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'build', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('8', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'createLib');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'deleteLib');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'editLib');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('8', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('8', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('8', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('8', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('8', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'importBug');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'importtask');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('8', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('8', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('8', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('8', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('8', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('8', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('8', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('8', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('8', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('8', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('8', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('8', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('8', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('8', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('8', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('8', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('8', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'assignTo');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'batchClose');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'cancel');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'close');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'start');
INSERT INTO `zt_grouppriv` VALUES ('8', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'confirmStoryChange');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'batchAssign');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'batchRun');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'close');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'linkcase');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'runcase');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'start');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'unlinkcase');
INSERT INTO `zt_grouppriv` VALUES ('8', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('8', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'browseTask');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'fix');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('8', 'tree', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'deleteContacts');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'manageContacts');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('8', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('8', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'action', 'hideAll');
INSERT INTO `zt_grouppriv` VALUES ('9', 'action', 'hideOne');
INSERT INTO `zt_grouppriv` VALUES ('9', 'action', 'trash');
INSERT INTO `zt_grouppriv` VALUES ('9', 'action', 'undelete');
INSERT INTO `zt_grouppriv` VALUES ('9', 'admin', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'customFields');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'export');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('9', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('9', 'company', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('9', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'dept', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'dept', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('9', 'dept', 'manageChild');
INSERT INTO `zt_grouppriv` VALUES ('9', 'dept', 'updateOrder');
INSERT INTO `zt_grouppriv` VALUES ('9', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'extension', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'extension', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('9', 'extension', 'structure');
INSERT INTO `zt_grouppriv` VALUES ('9', 'file', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('9', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('9', 'file', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('9', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'project');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'story');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('9', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'project');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('9', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'burnData');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'computeBurn');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('9', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'release', 'export');
INSERT INTO `zt_grouppriv` VALUES ('9', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('9', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('9', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('9', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('9', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('9', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('9', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('9', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('9', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('9', 'search', 'select');
INSERT INTO `zt_grouppriv` VALUES ('9', 'story', 'export');
INSERT INTO `zt_grouppriv` VALUES ('9', 'story', 'report');
INSERT INTO `zt_grouppriv` VALUES ('9', 'story', 'review');
INSERT INTO `zt_grouppriv` VALUES ('9', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('9', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'svn', 'apiSync');
INSERT INTO `zt_grouppriv` VALUES ('9', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('9', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('9', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('9', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('9', 'task', 'export');
INSERT INTO `zt_grouppriv` VALUES ('9', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('9', 'task', 'report');
INSERT INTO `zt_grouppriv` VALUES ('9', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testcase', 'export');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('9', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('9', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('9', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'create');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'install');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'uninstall');
INSERT INTO `zt_grouppriv` VALUES ('9', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'api', 'getModel');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'activate');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'close');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'create');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('10', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('10', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('10', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'changePassword');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'editProfile');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'task');
INSERT INTO `zt_grouppriv` VALUES ('10', 'my', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('10', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('10', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('10', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('10', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('10', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('10', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('10', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('10', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('10', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('10', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('10', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('10', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('10', 'search', 'deleteQuery');
INSERT INTO `zt_grouppriv` VALUES ('10', 'search', 'saveQuery');
INSERT INTO `zt_grouppriv` VALUES ('10', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('10', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'task', 'deleteEstimate');
INSERT INTO `zt_grouppriv` VALUES ('10', 'task', 'editEstimate');
INSERT INTO `zt_grouppriv` VALUES ('10', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('10', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'batchCreate');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'batchEdit');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'batchFinish');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'create');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'delete');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'edit');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'export');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'finish');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'import2Today');
INSERT INTO `zt_grouppriv` VALUES ('10', 'todo', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('10', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('10', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('10', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('10', 'webapp', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'bug', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'bug', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'bug', 'recheck');
INSERT INTO `zt_grouppriv` VALUES ('11', 'bug', 'report');
INSERT INTO `zt_grouppriv` VALUES ('11', 'bug', 'suspend');
INSERT INTO `zt_grouppriv` VALUES ('11', 'bug', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'build', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'company', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'company', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('11', 'company', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'company', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'doc', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'doc', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'doc', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'file', 'download');
INSERT INTO `zt_grouppriv` VALUES ('11', 'group', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'index', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'misc', 'ping');
INSERT INTO `zt_grouppriv` VALUES ('11', 'my', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'product', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'product', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('11', 'product', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('11', 'product', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'product', 'roadmap');
INSERT INTO `zt_grouppriv` VALUES ('11', 'product', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'productplan', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'productplan', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'build');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'burn');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'doc');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'grouptask');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'story');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'task');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'team');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'testtask');
INSERT INTO `zt_grouppriv` VALUES ('11', 'project', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'qa', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'release', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'release', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'report', 'bugAssign');
INSERT INTO `zt_grouppriv` VALUES ('11', 'report', 'bugSummary');
INSERT INTO `zt_grouppriv` VALUES ('11', 'report', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'report', 'productInfo');
INSERT INTO `zt_grouppriv` VALUES ('11', 'report', 'projectDeviation');
INSERT INTO `zt_grouppriv` VALUES ('11', 'report', 'workload');
INSERT INTO `zt_grouppriv` VALUES ('11', 'search', 'buildForm');
INSERT INTO `zt_grouppriv` VALUES ('11', 'search', 'buildQuery');
INSERT INTO `zt_grouppriv` VALUES ('11', 'story', 'tasks');
INSERT INTO `zt_grouppriv` VALUES ('11', 'story', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'svn', 'cat');
INSERT INTO `zt_grouppriv` VALUES ('11', 'svn', 'diff');
INSERT INTO `zt_grouppriv` VALUES ('11', 'task', 'recordEstimate');
INSERT INTO `zt_grouppriv` VALUES ('11', 'task', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testcase', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testcase', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testcase', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testtask', 'browse');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testtask', 'cases');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testtask', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testtask', 'results');
INSERT INTO `zt_grouppriv` VALUES ('11', 'testtask', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'bug');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'dynamic');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'profile');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'project');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'story');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'task');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'testCase');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'testTask');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'todo');
INSERT INTO `zt_grouppriv` VALUES ('11', 'user', 'view');
INSERT INTO `zt_grouppriv` VALUES ('11', 'webapp', 'index');
INSERT INTO `zt_grouppriv` VALUES ('11', 'webapp', 'obtain');
INSERT INTO `zt_grouppriv` VALUES ('11', 'webapp', 'view');