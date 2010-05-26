SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
  

DROP TABLE IF EXISTS `end_admin`;
CREATE TABLE IF NOT EXISTS `end_admin` (
  `admin_id` int(10) unsigned NOT NULL auto_increment,
  `rights_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `password` varchar(200) collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `status` varchar(100) collate utf8_unicode_ci default NULL,
  UNIQUE KEY `id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;


INSERT INTO `end_admin` (`admin_id`, `rights_id`, `name`, `password`, `email`, `status`) VALUES
(35, 1, 'endcms', '77fbc280bf0900b454c5b83ab0b52fb965d30811', 'endcms@endcms.com', NULL);


DROP TABLE IF EXISTS `end_blog`;
CREATE TABLE IF NOT EXISTS `end_blog` (
  `blog_id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `name` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `order_id` int(11) NOT NULL,
  `view_count` int(11) unsigned NOT NULL default '1',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `url` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`blog_id`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `end_blog` (`blog_id`, `category_id`, `name`, `content`, `create_time`, `update_time`, `status`, `order_id`, `view_count`, `comment_count`, `url`) VALUES
(1, 126, '欢迎使用基于EndCMS搭建的博客系统。', '<p>\r\n	这是一篇测试文章。</p>\r\n', 1273850432, 0, 1, 0, 3, 1, 'welcome'),
(2, 3, '关于', '<p>\r\n	测试页面。</p>\r\n', 1273850488, 0, 1, 0, 2, 0, 'about');


DROP TABLE IF EXISTS `end_category`;
CREATE TABLE IF NOT EXISTS `end_category` (
  `category_id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `description` varchar(250) collate utf8_unicode_ci default NULL,
  `keywords` varchar(250) collate utf8_unicode_ci default NULL,
  `order_id` int(11) NOT NULL default '0',
  `status` varchar(20) collate utf8_unicode_ci NOT NULL default '1',
  `update_time` int(11) unsigned NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `url` varchar(200) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `target` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT 'link',
  `page_title` varchar(250) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `system` enum('yes','no') collate utf8_unicode_ci NOT NULL default 'no',
  `item_count` int(11) NOT NULL,
  UNIQUE KEY `category_id` (`category_id`),
  KEY `alias` (`url`),
  KEY `alias_2` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=127 ;


INSERT INTO `end_category` (`category_id`, `parent_id`, `name`, `description`, `keywords`, `order_id`, `status`, `update_time`, `create_time`, `url`, `content`, `target`, `page_title`, `alias`, `system`, `item_count`) VALUES
(5, 0, '博客文章', '', NULL, 9, 'folder', 1272862115, 0, '', '', '', '', 'blog_cats', 'yes', 0),
(16, 0, '评论管理', NULL, NULL, 8, 'comment_list', 1271693365, 1270608601, '', '', '', '', '', 'yes', 0),
(17, 0, '系统设置', NULL, NULL, -3, 'config_list', 1273783135, 1271691272, '', '', '', '', '', 'yes', 0),
(18, 0, '友情链接', NULL, NULL, 1, 'friendlink_list', 1273783133, 1271693335, '', '', '', '', 'links', 'yes', 0),
(3, 0, '页面', NULL, NULL, 8, 'blog_list', 1273783130, 1273783096, '2010-05-14-04-38-30', '', '', '', 'page_cat', 'yes', 0),
(126, 5, '默认栏目', NULL, NULL, 0, 'blog_list', 1273840934, 1273840925, '默认栏目', '', '', '', '', 'no', 0);


DROP TABLE IF EXISTS `end_comment`;
CREATE TABLE IF NOT EXISTS `end_comment` (
  `comment_id` int(10) unsigned NOT NULL auto_increment,
  `blog_id` int(11) NOT NULL,
  `email` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `parent_comment_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


INSERT INTO `end_comment` (`comment_id`, `blog_id`, `email`, `name`, `content`, `url`, `time`, `status`, `parent_comment_id`) VALUES
(5, 1, 'longbill.cn@gmail.com', 'Longbill', '测试评论', 'http://www.longbill.cn', 1273850471, 1, 0);


DROP TABLE IF EXISTS `end_config`;
CREATE TABLE IF NOT EXISTS `end_config` (
  `config_id` int(11) unsigned NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `value` varchar(200) collate utf8_unicode_ci default NULL,
  `updated_at` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `type` varchar(20) collate utf8_unicode_ci NOT NULL,
  `description` varchar(200) collate utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admin settings' AUTO_INCREMENT=8 ;


INSERT INTO `end_config` (`config_id`, `category_id`, `name`, `value`, `updated_at`, `type`, `description`, `order_id`) VALUES
(2, 17, 'site_name', '刘春龙的博客', '2010-05-14 20:36:38', 'text', '博客标题', 10),
(4, 17, 'upload_file_types', '图片：*.jpg;&nbsp;*.png;*.jpeg;*.gif;<br>文档：*.doc;*.docx;*.xls;*.ppt;<br>压缩：*.rar;*.zip;*.7z;', '2010-04-19 23:37:23', 'textarea', '全站上传文件类型限制', 0),
(5, 17, 'sub_title', 'PHP,&nbsp;Javascript&nbsp;and&nbsp;Works', '2010-05-14 20:36:41', '', '博客副标题', 9),
(6, 17, 'site_url', 'http://endcms.cn/', '2010-05-14 20:36:44', '', '博客网址', 8),
(7, 17, 'admin_email', 'longbill.cn@gmail.com', '2010-05-14 20:36:47', '', '管理员邮箱，用于接收评论提醒', 7);


DROP TABLE IF EXISTS `end_friendlink`;
CREATE TABLE IF NOT EXISTS `end_friendlink` (
  `friendlink_id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL default '0',
  `name` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL default '0',
  `rel` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`friendlink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `end_friendlink` (`friendlink_id`, `category_id`, `order_id`, `name`, `description`, `url`, `status`, `rel`) VALUES
(1, 18, 0, 'Longbill', 'EndCMS创始人', 'http://www.longbill.cn', 1, 'friend'),
(2, 18, 0, 'EndTo', 'EndCMS创始人', 'http://www.endto.com', 1, 'friend'),
(3, 18, 0, 'EndCMS', '一款神奇的内容管理系统。', 'http://www.endcms.com', 1, 'friend');


DROP TABLE IF EXISTS `end_hook`;
CREATE TABLE IF NOT EXISTS `end_hook` (
  `hook_id` int(11) NOT NULL auto_increment,
  `module` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `hook` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `func_file` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `func_name` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `settings` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `create_by` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`hook_id`),
  KEY `module_2` (`module`,`hook`),
  KEY `create_by` (`create_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `end_log`;
CREATE TABLE IF NOT EXISTS `end_log` (
  `log_id` int(10) unsigned NOT NULL auto_increment,
  `admin_id` int(10) unsigned NOT NULL,
  `controller` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `menu` tinyint(4) NOT NULL,
  `time` int(11) NOT NULL default '0',
  `info` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `end_rights`;
CREATE TABLE IF NOT EXISTS `end_rights` (
  `rights_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(250) character set utf8 collate utf8_unicode_ci default NULL,
  `description` varchar(250) character set utf8 collate utf8_unicode_ci default NULL,
  `order_id` int(11) NOT NULL default '0',
  `rights` text character set utf8 collate utf8_unicode_ci,
  UNIQUE KEY `rights_id` (`rights_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


INSERT INTO `end_rights` (`rights_id`, `name`, `description`, `order_id`, `rights`) VALUES
(1, '超级管理员', '拥有所有权限', 9, 'category_view,category_add,category_update,category_delete,item_view,item_add,item_update,item_delete,account_update,admin_view,admin_add,admin_update,admin_update_password,admin_delete,extension_view,extension_add,extension_update,extension_delete,config_view,config_add,config_update,config_delete,upload_add,rights_view,rights_add,rights_update,rights_delete,blog_view,blog_add,blog_update,blog_delete,comment_view,comment_add,comment_update,comment_delete,friendlink_view,friendlink_add,friendlink_update,friendlink_delete');
