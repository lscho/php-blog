SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ey_categorys`
-- ----------------------------
DROP TABLE IF EXISTS `ey_categorys`;
CREATE TABLE `ey_categorys` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `tid` int(1) DEFAULT NULL COMMENT '1标签，2分类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of ey_categorys
-- ----------------------------
INSERT INTO `ey_categorys` VALUES ('1', '默认分类', '2');
INSERT INTO `ey_categorys` VALUES ('2', '分类二', '1');
INSERT INTO `ey_categorys` VALUES ('3', '分类一', '1');

-- ----------------------------
-- Table structure for `ey_comments`
-- ----------------------------
DROP TABLE IF EXISTS `ey_comments`;
CREATE TABLE `ey_comments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `email` varchar(30) DEFAULT NULL,
  `tid` int(1) DEFAULT NULL COMMENT '1:文章，2:心情',
  `nid` int(20) DEFAULT NULL COMMENT '节点ID',
  `pid` int(5) DEFAULT NULL COMMENT '评论对象',
  `comment` varchar(200) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_comments
-- ----------------------------

-- ----------------------------
-- Table structure for `ey_contents`
-- ----------------------------
DROP TABLE IF EXISTS `ey_contents`;
CREATE TABLE `ey_contents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `uid` int(3) DEFAULT '1',
  `abscontent` text,
  `text` text,
  `time` int(15) DEFAULT NULL,
  `tid` int(3) DEFAULT NULL,
  `cid` int(3) DEFAULT NULL,
  `ispage` int(1) DEFAULT '1',
  `iscomment` int(1) DEFAULT '1',
  `status` int(1) DEFAULT '1',
  `view` int(5) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_contents
-- ----------------------------
INSERT INTO `ey_contents` VALUES ('1', '关于', '1', '\n	\n		\n			easyou 1.0\n		\n		\n			easyou是一个简单的博客，没有复杂的功能。从一开始它的定位就是简单和速度。\n                                放弃了许多华而不实的东', '<p>\n	<div id=\"collapse-panel-2\" class=\"am-panel-bd am-in\">\n		<p class=\"am-text-success am-serif\">\n			easyou 1.0\n		</p>\n		<p class=\"am-text-success am-serif\">\n			easyou是一个简单的博客，没有复杂的功能。从一开始它的定位就是简单和速度。\n                                放弃了许多华而不实的东西。从开始到结束，都没有忘记它是一个博客，而非CMS。\n		</p>\n		<p class=\"am-text-success am-serif\">\n			如果您想使用好它，可能需要一点点HTML知识。相信我。仅仅是一点点。\n                                多学一点，总是没有坏处的。\n		</p>\n		<p class=\"am-text-success am-serif\">\n			easyou是由<a target=\"_blank\" href=\"http://document.thinkphp.cn/manual_3_2.html\">thinkPHP</a> 和<a target=\"_blank\" href=\"http://amazeui.org/css/\">amazeUI</a>的支持下完成的。如果您想要对它进行修改，请点击上面的链接来熟悉他们！\n		</p>\n		<p class=\"am-text-success monospace\">\n			2015-06-30 大萌\n		</p>\n	</div>\n</p>', '1423889668', '1', '2', '2', '2', '1', '6');
INSERT INTO `ey_contents` VALUES ('2', '留言', '1', '留点什么吧~', '留点什么吧~', '1423892271', '1', '2', '2', '1', '1', '4');
INSERT INTO `ey_contents` VALUES ('3', '恭喜您：安装成功', '1', '\n	恭喜您：安装成功\n\n\n	恭喜您：安装成功\n\n\n	恭喜您：安装成功\n\n\n	恭喜您：安装成功\n\n\n	恭喜您：安装成功\n\n\n	恭喜您：安装成功\n\n\n	恭喜您：安装成功\n\n\n	', '<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>\n<p>\n	恭喜您：安装成功\n</p>', '1433143456', '2', '3', '1', '1', '1', '0');

-- ----------------------------
-- Table structure for `ey_images`
-- ----------------------------
DROP TABLE IF EXISTS `ey_images`;
CREATE TABLE `ey_images` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(3) DEFAULT NULL COMMENT '相册ID',
  `src` varchar(200) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_images
-- ----------------------------

-- ----------------------------
-- Table structure for `ey_moods`
-- ----------------------------
DROP TABLE IF EXISTS `ey_moods`;
CREATE TABLE `ey_moods` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `uid` int(3) DEFAULT '1',
  `mood` varchar(200) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_moods
-- ----------------------------

-- ----------------------------
-- Table structure for `ey_photos`
-- ----------------------------
DROP TABLE IF EXISTS `ey_photos`;
CREATE TABLE `ey_photos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `src` varchar(200) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `abstract` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_photos
-- ----------------------------

-- ----------------------------
-- Table structure for `ey_tags`
-- ----------------------------
DROP TABLE IF EXISTS `ey_tags`;
CREATE TABLE `ey_tags` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `tid` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_tags
-- ----------------------------
INSERT INTO `ey_tags` VALUES ('1', '标签1', '1');
INSERT INTO `ey_tags` VALUES ('2', '标签2', '1');

-- ----------------------------
-- Table structure for `ey_users`
-- ----------------------------
DROP TABLE IF EXISTS `ey_users`;
CREATE TABLE `ey_users` (
  `id` int(1) NOT NULL,
  `user` varchar(10) NOT NULL,
  `qq` varchar(11) DEFAULT NULL,
  `weibo` varchar(50) DEFAULT NULL,
  `email` varchar(15) DEFAULT NULL,
  `brief` varchar(500) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_users
-- ----------------------------
INSERT INTO `ey_users` VALUES ('1', 'admin', '5555555', 'weibo.com', 'admin@eyblog', '6的飞起', null, '8f9216fdfffc5728ec2332f3fd380312');
