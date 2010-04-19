-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 04 月 19 日 23:41
-- 服务器版本: 5.0.41
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `endcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `end_admin`
--

CREATE TABLE IF NOT EXISTS `end_admin` (
  `admin_id` int(10) unsigned NOT NULL auto_increment,
  `rights_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `password` varchar(200) collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `status` varchar(100) collate utf8_unicode_ci default NULL,
  UNIQUE KEY `id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `end_admin`
--

INSERT INTO `end_admin` (`admin_id`, `rights_id`, `name`, `password`, `email`, `status`) VALUES
(1, 1, 'longbill', '55d7e24398e9cc418e630d1602a6609f43cefef0', 'aaa@aaa.com', 'admin'),
(35, 0, 'endcms', '77fbc280bf0900b454c5b83ab0b52fb965d30811', 'endcms@endcms.com', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `end_blog`
--

CREATE TABLE IF NOT EXISTS `end_blog` (
  `blog_id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `name` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `order_id` int(11) NOT NULL,
  PRIMARY KEY  (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `end_blog`
--

INSERT INTO `end_blog` (`blog_id`, `category_id`, `name`, `content`, `create_time`, `update_time`, `status`, `order_id`) VALUES
(1, 7, '发布AIR应用程序：空气域名查询。哈哈 真的的确不错', '<div class="entry-content" done0="7" done2="7" done4="7">\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;最近对Adobe 的Air技术非常感兴趣。 有了这种技术，我们以后就能很轻易的把B/S程序扩展到桌面，成为C/S程序！</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;下面是我的第一个AIR应用程序：空气域名查询。 &ldquo;空气&rdquo;二字源于 Air。 主要功能是快速查询某个域名是否被注册。输入一串字符串，选中下面的后缀，程序会自动查询对应的域名。 当然你也可以自定义查询任意后缀，如果想这样，只需要输入完整的域名即可（当然，不包含www）。比如：当我输入longbill，并选中com，和net。那么程序会自动查询longbill.com和longbill.net。如果我输入longbill.la，那么程序只会查询longbill.la。</p>\r\n	<p done0="7" done2="7" done3="7">\r\n		下面是截图：<br />\r\n		<a href="http://www.longbill.cn/blog/wp-content/uploads/2009/10/airdomainchecker.gif"><img alt="空气域名查询" class="alignnone size-full wp-image-694" height="418" src="http://www.longbill.cn/blog/wp-content/uploads/2009/10/airdomainchecker.gif" title="空气域名查询" width="366" /></a></p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;此外，我还在尝试做一些附加功能，比如whois查询和域名收藏（方便以后从收藏的域名中找出最好的）。现在只实现了在新窗口种查询whois，实现方式也很机械：调用http://who.is/longbill.cn的网页内容。</p>\r\n	<p done0="8" done2="8" done3="8">\r\n		&nbsp;&nbsp;&nbsp;&nbsp;如果你对此程序感兴趣，可以<a href="http://www.longbill.cn/down/air/airdomainchecker.air" target="_blank"><font color="#4eb0e9">点击这里</font></a>下载。 不过，前提是你的电脑上有Adobe Air 运行环境。如果没有，你可以去<a href="http://get.adobe.com/cn/air/" target="_blank"><font color="#4eb0e9">这里</font></a>安装。</p>\r\n</div>\r\n', 1269158634, 0, 0, 0),
(2, 8, '最近换手机有点频繁。。终于走入3G时代。', '<p>\r\n	过年的时候买的魅族M8 。玩了2个月，觉得不稳定，信号不好，经常漏电话。然后一次偶然机会入手Nokia E71。这可是我第一次买诺基亚的手机哦。。水货，带wifi ,gps, wcdma。 那时候联通3G正在商用,本来打算申请一个号试试的。结果哪知道联通把价格定那么高。最次的套餐都是93元/月。。。。就算了。。只有等了！不过E71真的挺不错的。主要是稳定，操作流畅，软件多。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;&nbsp;暑假完了，开学，电信的天翼进校园。那资费，看着就爽啊，大概是：19元月租（包40分市话，30M流量，300条短信），然后在学校里面打市话是0.08元每分。 如果寝室是包月上网，每月还要返一半的网费成话费。。。。天哪。跟联通比，简直太划算了。。于是，果断卖掉E71，在淘宝入手一台HKC mythos(神话)。刚好2K。 配置超高，wifi gps evdo一应俱全。。于是，哥们终于在经过了数年的漫长等待后用上了日思夜想的速度超快资费便宜信号超好的3G网络。</p>\r\n<p>\r\n	&nbsp;&nbsp;晕，怎么觉得自己在给电信打广告。。不过我觉得电信天翼真的不错，覆盖很广。 不过可能是因为3G网络才建好，客服方面经常出问题。 有时查不到话费。。。。</p>\r\n', 1269158683, 0, 1, 0),
(3, 7, '推荐在线模型制作网站：MockingBird', '<p>\r\n	MockingBird是一个免费的在线模型制作网站，可以帮助你快速制作，分享你的网站或者应用程序模型。 它有几个特点：1，在线，不用安装任何软件。2，简单，容易上手。3，功能齐全，包括各种组件和链接。4，可以和别人分享。 <img alt="在线模型制作" src="http://www.longbill.cn/blog/wp-content/uploads/2009/11/main-screenshot.png" title="main-screenshot" /></p>\r\n', 1269158930, 0, 0, 0),
(4, 7, 'TextMate 开发AS3应用', '<div class="entry-content" done0="7" done1="4" done2="7" done4="7">\r\n	<p done0="7" done2="7" done3="7">\r\n		记得08年flashplayer10刚出来的时候，我看到过一个视频（<a href="http://www.gotoandlearn.com/play?id=74" target="_blank"><font color="#4eb0e9">http://www.gotoandlearn.com/play?id=74</font></a>） ，Adobe的人就是用Textmate开发的Flash。 他是用Flex SDK里面的mxmlc命令编译的。当年我还用Mac OS的Automation功能做了一个应用程序，功能是把AS文件拖动到上面就自动给你编译成swf文件。</p>\r\n	<p done0="8" done2="8" done3="8">\r\n		今年再回头看的时候，发现其实有更简单的方法。那就是用TextMate的Actionscript3 Bundle：<a href="http://blog.simongregory.com/10/textmate-actionscript-3-and-flex-bundles/" target="_blank"><font color="#4eb0e9">http://blog.simongregory.com/10/textmate-actionscript-3-and-flex-bundles/</font></a>。然后我就尝试去配置这个环境，结果发现还很不容易。 下面把我的过程跟大家分享一下：</p>\r\n	<ol done1="4">\r\n		<li>\r\n			当然你要有一台Mac</li>\r\n		<li>\r\n			你得先安装 TextMate。</li>\r\n		<li>\r\n			安装上面提到过的actionscript 3 bundle。</li>\r\n		<li>\r\n			到http://www.adobe.com/cfusion/entitlement/index.cfm?e=flex3sdk 下载flex sdk</li>\r\n		<li>\r\n			将sdk解压，放到一个方便找到的位置</li>\r\n		<li>\r\n			然后打开Textmate-&gt;prefrences-&gt;advanced-&gt;shell variables，添加一个PATH变量，值是你的flex sdk里bin的位置，比如：/Developer/SDK/flex_sdk_3.5/bin。 如果已经存在PATH变量，那么请不要改动原来的数据，在原来数据的后面加冒号（:），然后再加上bin目录的位置。</li>\r\n		<li>\r\n			同样是在Shell Variables里面，添加一个LC_ALL变量，值是en_US.UTF-8。因为我发现flex会根据系统语言来显示错误信息，但是显示出来的是乱码，所以还是统一用英文的错误信息算了</li>\r\n		<li>\r\n			打开flex sdk的目录，进入frameworks，编辑flex-config.xml，把&lt;target-player&gt;9xxx&lt;/target-player&gt;替换成&lt;target-player&gt;10.0.0&lt;/target-player&gt;</li>\r\n	</ol>\r\n	<p>\r\n		然后就爽把，新建一个as文件，写一些东西，然后按苹果键+B，就会自动调用mxmlc编译你的as文件，生成swf。</p>\r\n	<p>\r\n		当然actionscript3 bundle的功能还有很多，自己去发觉吧～</p>\r\n</div>\r\n', 1269166007, 0, 0, 0),
(5, 7, '呵呵太好了afdaa', '<p>\r\n	太好啦<br />\r\n	fdafda fdsa fda</p>\r\n<p>\r\n	真不错啊。aaa</p>\r\n', 1269501447, 0, 1, 23),
(6, 8, ' 测试文章fdsaf dsa fdsa fdsa fdsa fdsa das fdsa fdasaaa', '<p>\r\n	哈哈，不错啊。原来可以这样啊。</p>\r\n', 1269574717, 0, -1, 0),
(7, 7, ' 你好啊。原来你在这里啊。我也在这里，呵呵哈哈', '<p>\r\n	很好。</p>\r\n', 1269600915, 0, 1, 0),
(8, 7, '测试啊。', '<p>\r\n	很好。不错啊。。呵呵</p>\r\n', 1269860553, 0, 0, 0),
(9, 8, '哈哈', '<p>\r\n	<img alt="null" src="end_system/plugin/ckeditor/plugins/smiley/images/46.gif" title="null" /></p>\r\n', 1270555532, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `end_category`
--

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
  UNIQUE KEY `category_id` (`category_id`),
  KEY `alias` (`url`),
  KEY `alias_2` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `end_category`
--

INSERT INTO `end_category` (`category_id`, `parent_id`, `name`, `description`, `keywords`, `order_id`, `status`, `update_time`, `create_time`, `url`, `content`, `target`, `page_title`, `alias`, `system`) VALUES
(10, 9, 'Index', '返回首页', NULL, 10, 'link', 1269952671, 0, './', '', '_self', '', '', 'no'),
(11, 9, 'About', '刘春龙的个人简介', '刘春龙', 0, 'page', 1269953497, 0, 'about/', '<p>\r\n	哈哈哈。不错啊</p>\r\n', '', '关于刘春龙', '', 'no'),
(12, 9, 'Projects', 'ceshi', 'ceshi', 5, 'page', 1269962981, 0, 'projects/', '<p>\r\n	fdsaf sadfdsa</p>\r\n', '', '测试', '', 'no'),
(9, 0, '博客导航', '', NULL, -2, 'folder', 1270708556, 0, '', '', '', '', 'navigation', 'yes'),
(5, 0, '博客分类', '', NULL, 1, 'folder', 1270608613, 0, '', '', '', '', '', 'yes'),
(6, 5, 'Works', NULL, NULL, 0, 'blog_list', 1269226114, 0, '', '', '', '', '', 'no'),
(7, 5, 'Mac', NULL, NULL, 0, 'blog_list', 1269226116, 0, '', '', '', '', '', 'no'),
(8, 5, 'Other', NULL, NULL, 0, 'blog_list', 1269226119, 0, '', '', '', '', '', 'no'),
(16, 0, '评论管理', NULL, NULL, 0, 'comment_list', 1270708559, 1270608601, '', '', '', '', '', 'yes'),
(17, 0, '系统设置', NULL, NULL, -3, 'config_list', 1271691282, 1271691272, '', '', '', '', '', 'no');

-- --------------------------------------------------------

--
-- 表的结构 `end_comment`
--

CREATE TABLE IF NOT EXISTS `end_comment` (
  `comment_id` int(10) unsigned NOT NULL auto_increment,
  `blog_id` int(11) NOT NULL,
  `email` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `end_comment`
--

INSERT INTO `end_comment` (`comment_id`, `blog_id`, `email`, `name`, `content`, `url`, `time`, `status`) VALUES
(1, 5, 'longbill.cn@gmail.com', '刘春龙', '哈&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;哈哈&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;测试啦<br>fdsafa&nbsp;啊哈fdsa<br>哈哈&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;哈<br>不错&nbsp;sdaf&nbsp;asfdsa&nbsp;fdas<br>		elseif&nbsp;($data[''type'']&nbsp;==&nbsp;''textarea'')<br>a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b<br>啊，原来还可以这样啊<br>呵呵&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fffffffffffaaa<br>曾&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;经<br>阿凡达萨范德萨', 'http://longbill.cn', 1270608801, 1),
(2, 5, 'fdsa', '啊啊啊', '范德萨范德萨范德萨发大水发大水发大', 'fdsaf', 1270625551, 0);

-- --------------------------------------------------------

--
-- 表的结构 `end_config`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admin settings' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `end_config`
--

INSERT INTO `end_config` (`config_id`, `category_id`, `name`, `value`, `updated_at`, `type`, `description`, `order_id`) VALUES
(2, 17, 'site_name', '刘春龙的博客', '2010-04-19 23:37:03', 'text', '站点名字', 1),
(4, 17, 'upload_file_types', '图片：*.jpg;&nbsp;*.png;*.jpeg;*.gif;<br>文档：*.doc;*.docx;*.xls;*.ppt;<br>压缩：*.rar;*.zip;*.7z;', '2010-04-19 23:37:23', 'textarea', '全站上传文件类型限制', 0);

-- --------------------------------------------------------

--
-- 表的结构 `end_log`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=228 ;

--
-- 转存表中的数据 `end_log`
--

INSERT INTO `end_log` (`log_id`, `admin_id`, `controller`, `url`, `menu`, `time`, `info`) VALUES
(79, 0, 'login', '/admin.php?p=login&module=admin&backurl=admin.php%3Fp%3Dadmin', 0, 1271691179, ''),
(80, 0, 'login', '/admin.php?p=login&module=admin&m=login&backurl=admin.php%3Fp%3Dadmin', 0, 1271691182, ''),
(81, 1, 'admin', 'admin.php?p=admin', 1, 1271691182, ' 管理管理员'),
(82, 1, 'ajax', '/admin.php?p=ajax&m=delete&table=admin&id=33', 0, 1271691188, ''),
(83, 1, 'admin', '/admin.php?m=new_admin&p=admin', 0, 1271691202, ''),
(84, 1, 'admin', 'admin.php?p=admin', 1, 1271691204, ' 管理管理员'),
(85, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691205, ' 栏目管理&gt;'),
(86, 1, 'item', '/admin.php?p=item', 0, 1271691206, ''),
(87, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691208, ' 栏目管理&gt;'),
(88, 1, 'item', '/admin.php?p=item', 0, 1271691208, ''),
(89, 1, 'item', 'admin.php?p=item&category_id=16', 1, 1271691216, ' 内容管理&gt;评论管理'),
(90, 1, 'item', 'admin.php?p=item&category_id=8', 1, 1271691219, ' 内容管理&gt;Other'),
(91, 1, 'item', 'admin.php?p=item&category_id=7', 1, 1271691219, ' 内容管理&gt;Mac'),
(92, 1, 'item', 'admin.php?p=item&category_id=6', 1, 1271691220, ' 内容管理&gt;Works'),
(93, 1, 'item', '/admin.php?p=item&category_id=10', 0, 1271691228, ''),
(94, 1, 'item', '/admin.php?p=item&category_id=10', 0, 1271691229, ''),
(95, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691230, ''),
(96, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691232, ''),
(97, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691234, ''),
(98, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691235, ''),
(99, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691236, ''),
(100, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691237, ''),
(101, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691238, ''),
(102, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691239, ''),
(103, 1, 'item', '/admin.php?p=item&category_id=10', 0, 1271691241, ''),
(104, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691242, ''),
(105, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691243, ''),
(106, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691244, ''),
(107, 1, 'item', '/admin.php?p=item&category_id=10', 0, 1271691246, ''),
(108, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691247, ''),
(109, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691247, ''),
(110, 1, 'item', '/admin.php?p=item&category_id=10', 0, 1271691248, ''),
(111, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691249, ''),
(112, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691249, ''),
(113, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691250, ''),
(114, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691253, ''),
(115, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691254, ''),
(116, 1, 'item', 'admin.php?p=item&category_id=16', 1, 1271691261, ' 内容管理&gt;评论管理'),
(117, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691267, ' 栏目管理&gt;'),
(118, 1, 'category', '/admin.php?m=new_category&p=category&category_id=0', 0, 1271691272, ''),
(119, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691273, ' 栏目管理&gt;'),
(120, 1, 'ajax', '/admin.php?p=ajax&m=update&table=category&column=order_id&id=17', 0, 1271691279, ''),
(121, 1, 'ajax', '/admin.php?p=ajax&m=update&table=category&column=status&id=17', 0, 1271691282, ''),
(122, 1, 'item', '/admin.php?p=item', 0, 1271691284, ''),
(123, 1, 'item', '/admin.php?p=item', 0, 1271691285, ''),
(124, 1, 'item', '/admin.php?p=item&category_id=17', 0, 1271691285, ''),
(125, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691303, ' 内容管理&gt;系统设置'),
(126, 1, 'ajax', '/admin.php?p=ajax&m=update&table=config&column=value&id=4', 0, 1271691360, ''),
(127, 1, 'item', '/admin.php?p=item&action=edit_item&category_id=17&item_id=2', 0, 1271691422, ''),
(128, 1, 'item', '/admin.php?m=edit_item&p=item&item_id=2&category_id=17', 0, 1271691423, ''),
(129, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691424, ' 内容管理&gt;系统设置'),
(130, 1, 'item', '/admin.php?p=item&action=edit_item&category_id=17&item_id=4', 0, 1271691426, ''),
(131, 1, 'item', '/admin.php?m=edit_item&p=item&item_id=4&category_id=17', 0, 1271691430, ''),
(132, 1, 'item', '/admin.php?m=edit_item&p=item&item_id=4&category_id=17', 0, 1271691443, ''),
(133, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691444, ' 内容管理&gt;系统设置'),
(134, 1, 'item', '/admin.php?p=item&action=edit_item&category_id=17&item_id=4', 0, 1271691448, ''),
(135, 1, 'item', '/admin.php?m=edit_item&p=item&item_id=4&category_id=17', 0, 1271691450, ''),
(136, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691451, ' 内容管理&gt;系统设置'),
(137, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691466, ' 栏目管理&gt;'),
(138, 1, '', '/admin.php', 0, 1271691467, ''),
(139, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691469, ' 栏目管理&gt;'),
(140, 1, '', '/admin.php', 0, 1271691476, ''),
(141, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691478, ' 栏目管理&gt;'),
(142, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691485, ' 栏目管理&gt;'),
(143, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691486, ' 栏目管理&gt;'),
(144, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691486, ' 栏目管理&gt;'),
(145, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(146, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(147, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(148, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(149, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(150, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(151, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691487, ' 栏目管理&gt;'),
(152, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691488, ' 栏目管理&gt;'),
(153, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691488, ' 栏目管理&gt;'),
(154, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691488, ' 栏目管理&gt;'),
(155, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691488, ' 栏目管理&gt;'),
(156, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691488, ' 栏目管理&gt;'),
(157, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691489, ' 栏目管理&gt;'),
(158, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691489, ' 栏目管理&gt;'),
(159, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691489, ' 栏目管理&gt;'),
(160, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691489, ' 栏目管理&gt;'),
(161, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691489, ' 栏目管理&gt;'),
(162, 1, '', '/admin.php', 0, 1271691490, ''),
(163, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691492, ' 栏目管理&gt;'),
(164, 1, '', '/admin.php', 0, 1271691494, ''),
(165, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691495, ' 内容管理&gt;系统设置'),
(166, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691503, ' 栏目管理&gt;'),
(167, 1, 'item', '/admin.php?p=item', 0, 1271691505, ''),
(168, 1, 'item', 'admin.php?p=item&category_id=7', 1, 1271691509, ' 内容管理&gt;Mac'),
(169, 1, 'item', '/admin.php?p=item', 0, 1271691511, ''),
(170, 1, '', '/admin.php', 0, 1271691513, ''),
(171, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691517, ' 内容管理&gt;系统设置'),
(172, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691518, ' 栏目管理&gt;'),
(173, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691519, ' 栏目管理&gt;博客分类'),
(174, 1, 'category', 'admin.php?p=category&category_id=7', 1, 1271691521, ' 栏目管理&gt;Mac'),
(175, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691522, ' 栏目管理&gt;博客分类'),
(176, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691523, ' 栏目管理&gt;博客分类'),
(177, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691524, ' 栏目管理&gt;博客分类'),
(178, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691524, ' 栏目管理&gt;博客分类'),
(179, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691525, ' 栏目管理&gt;博客分类'),
(180, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691525, ' 栏目管理&gt;博客分类'),
(181, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691525, ' 栏目管理&gt;博客分类'),
(182, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691525, ' 栏目管理&gt;博客分类'),
(183, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691525, ' 栏目管理&gt;博客分类'),
(184, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691526, ' 栏目管理&gt;博客分类'),
(185, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691526, ' 栏目管理&gt;博客分类'),
(186, 1, 'category', 'admin.php?p=category&category_id=5', 1, 1271691526, ' 栏目管理&gt;博客分类'),
(187, 1, '', '/admin.php', 0, 1271691527, ''),
(188, 1, 'item', 'admin.php?p=item&category_id=17', 1, 1271691530, ' 内容管理&gt;系统设置'),
(189, 1, '', '/admin.php', 0, 1271691533, ''),
(190, 1, 'item', '/admin.php?p=item', 0, 1271691545, ''),
(191, 1, 'item', 'admin.php?p=item&category_id=8', 1, 1271691547, ' 内容管理&gt;Other'),
(192, 1, 'item', 'admin.php?p=item&category_id=7', 1, 1271691548, ' 内容管理&gt;Mac'),
(193, 1, 'item', 'admin.php?p=item&category_id=6', 1, 1271691549, ' 内容管理&gt;Works'),
(194, 1, '', '/admin.php', 0, 1271691550, ''),
(195, 1, 'item', '/admin.php?p=item', 0, 1271691552, ''),
(196, 1, 'item', '/admin.php?p=item&category_id=10', 0, 1271691554, ''),
(197, 1, 'item', '/admin.php?p=item&category_id=12', 0, 1271691555, ''),
(198, 1, 'item', '/admin.php?p=item&category_id=11', 0, 1271691556, ''),
(199, 1, '', '/admin.php', 0, 1271691557, ''),
(200, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691559, ' 栏目管理&gt;'),
(201, 1, 'category', 'admin.php?p=category&category_id=9', 1, 1271691560, ' 栏目管理&gt;博客导航'),
(202, 1, 'category', 'admin.php?p=category&category_id=10', 1, 1271691561, ' 栏目管理&gt;Index'),
(203, 1, 'category', 'admin.php?p=category&category_id=12', 1, 1271691561, ' 栏目管理&gt;Projects'),
(204, 1, 'category', 'admin.php?p=category&category_id=11', 1, 1271691562, ' 栏目管理&gt;About'),
(205, 1, '', '/admin.php', 0, 1271691563, ''),
(206, 1, 'admin', 'admin.php?p=admin', 1, 1271691582, ' 管理管理员'),
(207, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691585, ' 栏目管理&gt;'),
(208, 1, 'item', '/admin.php?p=item', 0, 1271691587, ''),
(209, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691635, ' 栏目管理&gt;'),
(210, 1, 'admin', 'admin.php?p=admin', 1, 1271691636, ' 管理管理员'),
(211, 1, '', '/admin.php', 0, 1271691637, ''),
(212, 1, 'item', '/admin.php?p=item', 0, 1271691638, ''),
(213, 1, '', '/admin.php', 0, 1271691639, ''),
(214, 1, 'item', '/admin.php?p=item', 0, 1271691645, ''),
(215, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691646, ' 栏目管理&gt;'),
(216, 1, 'item', '/admin.php?p=item', 0, 1271691647, ''),
(217, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691648, ' 栏目管理&gt;'),
(218, 1, 'item', '/admin.php?p=item', 0, 1271691648, ''),
(219, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691649, ' 栏目管理&gt;'),
(220, 1, 'item', '/admin.php?p=item', 0, 1271691652, ''),
(221, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691653, ' 栏目管理&gt;'),
(222, 1, 'item', '/admin.php?p=item', 0, 1271691654, ''),
(223, 1, 'category', 'admin.php?p=category&category_id=', 1, 1271691655, ' 栏目管理&gt;'),
(224, 1, 'admin', 'admin.php?p=admin', 1, 1271691656, ' 管理管理员'),
(225, 1, 'rights', 'admin.php?p=rights', 1, 1271691658, '管理角色/权限'),
(226, 1, 'admin', 'admin.php?p=admin', 1, 1271691666, ' 管理管理员'),
(227, 1, 'item', '/admin.php?p=item', 0, 1271691669, '');

-- --------------------------------------------------------

--
-- 表的结构 `end_rights`
--

CREATE TABLE IF NOT EXISTS `end_rights` (
  `rights_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(250) character set utf8 collate utf8_unicode_ci default NULL,
  `description` varchar(250) character set utf8 collate utf8_unicode_ci default NULL,
  `order_id` int(11) NOT NULL default '0',
  `rights` text character set utf8 collate utf8_unicode_ci,
  UNIQUE KEY `rights_id` (`rights_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `end_rights`
--

INSERT INTO `end_rights` (`rights_id`, `name`, `description`, `order_id`, `rights`) VALUES
(1, '超级管理员', '拥有所有权限', 9, 'category_add,category_update,category_delete,item_view,item_add,item_update,item_delete,account_update,admin_add,admin_update,admin_update_password,admin_delete,config_add,config_update,config_delete,upload_add,rights_add,rights_update,rights_delete,blog_view,blog_add,blog_update,blog_delete,comment_add,comment_update,comment_delete');
