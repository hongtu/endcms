-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 08 月 24 日 15:55
-- 服务器版本: 5.0.41
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `phone`
--

-- --------------------------------------------------------

--
-- 表的结构 `end_admin`
--

DROP TABLE IF EXISTS `end_admin`;
CREATE TABLE IF NOT EXISTS `end_admin` (
  `admin_id` int(10) unsigned NOT NULL auto_increment,
  `rights_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `password` varchar(200) collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `status` varchar(100) collate utf8_unicode_ci default NULL,
  UNIQUE KEY `id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `end_admin`
--

INSERT INTO `end_admin` (`admin_id`, `rights_id`, `name`, `password`, `email`, `status`) VALUES
(36, 1, 'endcms', '77fbc280bf0900b454c5b83ab0b52fb965d30811', 'endcms@endcms.com', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `end_category`
--

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
  `image` varchar(200) collate utf8_unicode_ci default '',
  UNIQUE KEY `category_id` (`category_id`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `end_category`
--

INSERT INTO `end_category` (`category_id`, `parent_id`, `name`, `description`, `keywords`, `order_id`, `status`, `update_time`, `create_time`, `url`, `content`, `target`, `page_title`, `alias`, `system`, `item_count`, `image`) VALUES
(1, 0, 'Product Categories', NULL, NULL, 0, 'folder', 1282548227, 1281984524, 'all_categories', '', '', '', '', 'yes', 0, ''),
(2, 1, 'Blue Tooth', '', '', 0, 'product_list', 1282550676, 1281984537, 'Blue Tooth', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_23_16_04_36_4241.png'),
(3, 1, 'Car Charge', '', '', 0, 'product_list', 1282035392, 1281984549, 'Car Charge', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_17_15_22_24_9118.png'),
(4, 1, 'Hand Free', '', '', 0, 'product_list', 1282029552, 1281984618, 'Hand Free', '', '', '', '', 'no', 0, 'public/2010/08/e164937e-6c08-43f4-ace8-91b53e075846.jpg'),
(5, 1, 'Memory Cards', '', '', 0, 'product_list', 1282035321, 1281984723, 'Memory Cards', '', '', '', '', 'no', 0, 'public/2010/08/wangxiyi2.jpg'),
(6, 0, 'Configuraton', NULL, NULL, -1, 'config_list', 1282550551, 1282027016, 'config', '', '', '', '', 'yes', 0, ''),
(8, 1, 'Batteries', '', '', 0, 'product_list', 1282030197, 1282030147, 'Batteries', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_17_15_29_57_6133.png'),
(9, 1, 'Charms', '', '', 0, 'product_list', 1282030203, 1282030160, 'Charms', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_17_15_30_03_1309.png'),
(10, 0, 'Information', NULL, NULL, 0, 'folder', 1282548228, 1282034019, 'info', '', '', '', '', 'yes', 0, ''),
(11, 10, 'Return Policy', '', '', 0, 'page', 1282034053, 1282034048, 'Return Policy', '<p>\r\n	<meta charset="utf-8" /><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; ">Brand New items may be returned or exchanged within 30 Days from date of purchase. Returns are subject to a 15% restocking fee plus the actual cost of shipping. This amount will be deducted from the amount of your refund.&nbsp;<br />\r\n	<br />\r\n	Factory Serviced items are exchangeable for a replacement of the same model on defective items only within 30 Days from date of purchase.&nbsp;<br />\r\n	<br />\r\n	Due to overwhelming piracy on software including DVDs, CDs, and Pre-Loaded Data Cards, the manufacturer has stated that these items cannot be returned back to&nbsp;<span id="lblcompanyname2" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com. For any issues concerning the software (i.e. Defect, Troubleshooting, etc.), the customer is responsible for contacting the manufacturer directly for assistance.&nbsp;<br />\r\n	<br />\r\n	All returns or exchanges missing or with damage to the original box may be refused or may be subject to a 10% penalty fee. (i.e. missing/damaged UPC barcodes, missing/damaged manuals, missing/damaged warranties, tape on the manufacturer&rsquo;s box, etc.) Ship all returns using a traceable shipping method and a separate shipping box. DO NOT put any courier labels on the manufacturer&#39;s merchandise packaging. Doing so requires&nbsp;<span id="lblcompanyname3" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;to pay for replacement packaging. Therefore, additional fees will be charged under these circumstances.&nbsp;<br />\r\n	<br />\r\n	We will not accept items back unless they are returned with the manufacturer&#39;s original packaging.&nbsp;<br />\r\n	<br />\r\n	<span id="lblcompanyname4" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;is not liable in any way for returned packages that were lost or damaged during shipment.&nbsp;</span></p>\r\n', '', 'Return Policy', '', 'no', 0, ''),
(12, 10, 'Terms of use', '', '', 0, 'page', 1282034086, 1282034072, 'Terms of use', '<p>\r\n	<meta charset="utf-8" /><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; "><span id="lblcompanyname10" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;offers a full range of products produced by a variety of manufacturers. Please note that&nbsp;<span id="lblcompanyname11" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com does not in any manner allege any affiliation between the manufacturers and our corporation. All products that appear on&nbsp;<span id="lblcompanyname12" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com are the sole property of&nbsp;<span id="lblcompanyname13" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>, unless specified otherwise. Such materials protected by this copyright include, but are not limited to, any and all text; any and all images (including icons, logos, and other graphics); and any and all design elements of the website.&nbsp;<span id="lblcompanyname14" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&rsquo;s website is used only for the purpose of shopping on this site, placing an order on this site, or for conducting other tasks associated with shopping or placing an order on this site. By placing an order with&nbsp;<span id="lblcompanyname15" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com you acknowledge and agree that at no time is<span id="lblcompanyname16" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;making any representation or warranty regarding the products purchased by you the consumer.&nbsp;<br />\r\n	<br />\r\n	BY USING THIS SITE AND/OR ANY SERVICES RELATED THERETO, YOU AGREE THAT YOU HAVE READ, UNDERSTAND AND AGREE TO THE TERMS OF USE AND DISCLAIMER.</span></p>\r\n', '', 'Terms of use', '', 'no', 0, ''),
(13, 10, 'Privacy', '', '', 0, 'page', 1282034088, 1282034082, 'Privacy', '<p>\r\n	<span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; ">All information submitted to&nbsp;<span id="lblcompanyname9" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;is held private. We DO NOT sell customer data. Some data may be shared with third parties only if you, the customer agrees to participate in offers available through our site. If you accept such an offer, we will disclose your contact and billing information to that third party. All data collected is secured under 128bit Verisign protection.&nbsp;<br />\r\n	<br />\r\n	<b>Email Offer Subscriptions:</b><br />\r\n	Upon placing an order through this Site, you will automatically be enrolled in the OnlinePhoneStore.com best offers email promotion list based on the billing email address information you have provided, unless you opt-out of receiving such communications. You may request at any time to opt-out from our email promotion list by&nbsp;clicking here. This simple opt-out process allows you to unsubscribe if you decide not to receive any further promotional emails from our family of web stores. Furthermore, We will never share any personally identifiable information which you have given to us with any third party marketers. In order to make our email offers more relevant and useful to you, our servers may receive a confirmation when you open an email message from OnlinePhoneStore.com. In addition, if you have any questions about receiving communications from us you may email us at&nbsp;info@phone.com&nbsp;at any time.</span></p>\r\n', '', 'Privacy Policy', '', 'no', 0, ''),
(14, 0, 'Customers', NULL, NULL, 0, 'user_list', 1282548230, 1282051755, 'Customers', '', '', '', '', 'yes', 0, ''),
(15, 0, 'Orders', NULL, NULL, 0, 'order_list', 1282550535, 1282226923, 'Orders', '', '', '', '', 'yes', 0, ''),
(16, 0, 'Slideshow', NULL, NULL, 0, 'slideshow_list', 1282550539, 1282226933, 'Slideshow', '', '', '', '', 'yes', 0, ''),
(17, 0, 'Coupons', NULL, NULL, 0, 'coupon_list', 1282550545, 1282229250, 'Coupons', '', '', '', '', 'yes', 0, ''),
(18, 0, 'Carriers', NULL, NULL, 0, 'link_list', 1282550542, 1282544270, 'carriers', '', '', '', '', 'yes', 0, ''),
(20, 0, 'Brands', NULL, NULL, 0, 'link_list', 1282550547, 1282545798, 'brands', '', '', '', '', 'yes', 0, ''),
(21, 0, 'Navigation', NULL, NULL, 0, 'link_list', 1282550549, 1282546919, 'navi', '', '', '', '', 'yes', 0, ''),
(22, 10, 'Contact Us', '', '', 0, 'page', 1282547082, 1282547077, 'Contact Us', '<p>\r\n	<img src="public/2010/08/08_23_16_06_01_5562.jpg" />Contact Us</p>\r\n<p>\r\n	Contact Us</p>\r\n<p>\r\n	Contact Us</p>\r\n<p>\r\n	Contact Us</p>\r\n', '', 'Contact Us', '', 'no', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `end_config`
--

DROP TABLE IF EXISTS `end_config`;
CREATE TABLE IF NOT EXISTS `end_config` (
  `config_id` int(11) unsigned NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `value` text collate utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `type` varchar(20) collate utf8_unicode_ci NOT NULL,
  `description` varchar(200) collate utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admin settings' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `end_config`
--

INSERT INTO `end_config` (`config_id`, `category_id`, `name`, `value`, `updated_at`, `type`, `description`, `order_id`) VALUES
(2, 6, 'site_name', 'Phone&nbsp;Accessories', '2010-08-17 14:37:44', 'text', 'Site Name', 10),
(4, 6, 'upload_file_types', 'Images:&nbsp;&nbsp;&nbsp;*.jpg;&nbsp;*.png;*.jpeg;*.gif;<br>Documents:&nbsp;*.doc;*.docx;*.xls;*.ppt;<br>Archieves:&nbsp;*.rar;*.zip;*.7z;', '2010-08-17 14:38:43', 'textarea', 'Upload file types', 0),
(8, 6, 'max_image_width', '600', '2010-08-17 16:14:05', '', 'Uploaded Image will be resize to this width', 0),
(9, 6, 'index_description', 'Phone&nbsp;Accessories&nbsp;Online&nbsp;Store', '2010-08-17 16:58:43', '', 'Index Description (SEO)', 0),
(10, 6, 'index_keywords', 'Phone&nbsp;Accessories', '2010-08-17 16:59:04', '', 'Index Keywords (SEO)', 0),
(11, 6, 'index_title', 'Phone&nbsp;Accessories&nbsp;online&nbsp;shop', '2010-08-17 17:04:21', '', 'Index Title (SEO) ', 0),
(12, 6, 'reg_email', 'Dear&nbsp;value&nbsp;customer&nbsp;<br><br>Thank&nbsp;you&nbsp;for&nbsp;signing&nbsp;up&nbsp;{http_host}&nbsp;account.&nbsp;We&nbsp;are&nbsp;reviewing&nbsp;your&nbsp;<br>application&nbsp;and&nbsp;our&nbsp;representative&nbsp;will&nbsp;contact&nbsp;you&nbsp;shortly.&nbsp;By&nbsp;creating&nbsp;<br>an&nbsp;account&nbsp;at&nbsp;{http_host}&nbsp;will&nbsp;be&nbsp;able&nbsp;to&nbsp;shop&nbsp;faster,&nbsp;be&nbsp;up&nbsp;to&nbsp;date&nbsp;on&nbsp;an&nbsp;<br>orders&nbsp;status,&nbsp;and&nbsp;keep&nbsp;track&nbsp;of&nbsp;the&nbsp;orders&nbsp;you&nbsp;have&nbsp;previously&nbsp;made.&nbsp;<br><br>Your&nbsp;login&nbsp;id&nbsp;is&nbsp;{user_email}.<br>Password:&nbsp;The&nbsp;one&nbsp;when&nbsp;you&nbsp;created&nbsp;account.&nbsp;<br><br>Regard<br>{http_host}&nbsp;Group', '2010-08-19 22:35:15', '', 'Register Email', 0),
(13, 6, 'copyright', 'gobilecity&nbsp;(c)&nbsp;all&nbsp;rgihts&nbsp;are&nbsp;reserved', '2010-08-19 22:13:24', '', 'Copyright information', 0),
(14, 6, 'slideshow_interval', '4000', '2010-08-19 22:28:19', '', 'Slideshow Interval (ms)', 0),
(16, 6, 'payment_method', 'paypal,credit&nbsp;card,xxx,aaa', '2010-08-24 01:48:00', '', 'Payment Methods(seperated with comma)', 0);

-- --------------------------------------------------------

--
-- 表的结构 `end_coupon`
--

DROP TABLE IF EXISTS `end_coupon`;
CREATE TABLE IF NOT EXISTS `end_coupon` (
  `coupon_id` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `description` varchar(250) NOT NULL default '',
  `from_time` int(11) unsigned NOT NULL default '0',
  `to_time` int(11) unsigned NOT NULL default '0',
  `count` int(10) unsigned NOT NULL default '0',
  `price` varchar(200) NOT NULL default '0',
  `status` tinyint(4) NOT NULL default '0',
  `start_price` float NOT NULL default '0',
  PRIMARY KEY  (`coupon_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `end_coupon`
--

INSERT INTO `end_coupon` (`coupon_id`, `name`, `description`, `from_time`, `to_time`, `count`, `price`, `status`, `start_price`) VALUES
(1, 'NOSHIPPING', 'free shippment', 1282207814, 1313743814, 998, '{shipping}', 0, 200),
(2, 'ONE_PERCENT_OFF', '1% off', 1282207980, 1313743980, 10000, '0.01*{total}', 0, 100),
(3, '10', '$10 off', 1282210143, 1284888543, 100, '10', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `end_link`
--

DROP TABLE IF EXISTS `end_link`;
CREATE TABLE IF NOT EXISTS `end_link` (
  `link_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `url` varchar(300) NOT NULL default '',
  `target` varchar(10) NOT NULL default '_self',
  `order_id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `end_link`
--

INSERT INTO `end_link` (`link_id`, `name`, `url`, `target`, `order_id`, `category_id`) VALUES
(1, 'AT&T / CINGULAR', '?search&q=AT&T', '_self', 2, 18),
(2, 'LG', '?search&q=LG', '_self', 1, 20),
(3, 'Samsung', '?search&amp;q=Samsung', '_self', 0, 20),
(4, 'SPRINT / NEXTEL', '?search&q=sprint', '_self', 0, 18),
(5, 'Home', './', '_self', 0, 21),
(6, 'All Products', '?cats', '_self', 0, 21),
(7, 'Specials', '?search/special', '_self', 0, 21),
(8, 'Contact us', '?page/22', '_self', 0, 21);

-- --------------------------------------------------------

--
-- 表的结构 `end_log`
--

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

--
-- 转存表中的数据 `end_log`
--


-- --------------------------------------------------------

--
-- 表的结构 `end_order`
--

DROP TABLE IF EXISTS `end_order`;
CREATE TABLE IF NOT EXISTS `end_order` (
  `order_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `email` varchar(200) NOT NULL default '',
  `shipping` varchar(1000) NOT NULL default '',
  `billing` varchar(1000) NOT NULL default '',
  `create_time` int(11) NOT NULL default '0',
  `status` int(10) NOT NULL default '0',
  `product_ids` varchar(1000) NOT NULL default '',
  `total` float NOT NULL default '0',
  `shipping_price` float NOT NULL default '0',
  `ship_method` varchar(10) NOT NULL default '',
  `coupon` varchar(200) NOT NULL default '',
  `coupon_price` float NOT NULL default '0',
  `payment_method` varchar(200) NOT NULL default 'paypal',
  PRIMARY KEY  (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `end_order`
--

INSERT INTO `end_order` (`order_id`, `user_id`, `name`, `email`, `shipping`, `billing`, `create_time`, `status`, `product_ids`, `total`, `shipping_price`, `ship_method`, `coupon`, `coupon_price`, `payment_method`) VALUES
(1, 1, 'Liu Chunlong', 'longbill.cn@gmail.com', 'Liu Chunlong<br />street<br />city, NY 12121', 'Liu Chunlong<br />street<br />city, NY 12121', 1282229582, 0, '4=1', 128.76, 28.76, '1DA', 'NOSHIPPING', 0, ''),
(2, 1, 'Liu Chunlong', 'longbill.cn@gmail.com', 'Liu Chunlong<br />street<br />city, NY 12121', 'Liu Chunlong<br />street<br />city, NY 12121', 1282229692, 0, '4=4', 400, 28.76, '1DA', 'NOSHIPPING', 28.76, ''),
(3, 1, 'fname lname', 'longbill.cn@gmail.com', 'fname lname<br />street<br />city, AL 11214', 'fname lname<br />street<br />city, AL 11214', 1282585537, 0, '5=1', 169.88, 59.88, '1DM', '', 0, ''),
(4, 1, 'fname lname', 'longbill.cn@gmail.com', 'fname lname<br />street<br />city, AL 11214', 'fname lname<br />street<br />city, AL 11214', 1282593220, 0, '5=1', 169.88, 59.88, '1DM', 'NOSHIPPING', 0, 'credit card');

-- --------------------------------------------------------

--
-- 表的结构 `end_product`
--

DROP TABLE IF EXISTS `end_product`;
CREATE TABLE IF NOT EXISTS `end_product` (
  `product_id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `name` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `order_id` int(11) NOT NULL,
  `view_count` int(11) unsigned NOT NULL default '1',
  `url` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `image` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `retail` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `wholesale` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `special` tinyint(4) NOT NULL default '0',
  `weight` int(11) NOT NULL default '0',
  `new` tinyint(4) NOT NULL default '0',
  `brand` varchar(200) NOT NULL default '',
  `carrier` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`product_id`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `end_product`
--

INSERT INTO `end_product` (`product_id`, `category_id`, `name`, `content`, `create_time`, `update_time`, `status`, `order_id`, `view_count`, `url`, `image`, `retail`, `wholesale`, `special`, `weight`, `new`, `brand`, `carrier`) VALUES
(3, 2, 'AC Blue tooth adapter', '<p>\r\n	fd afda f</p>\r\n<p>\r\n	da fsda fdsa</p>\r\n<p>\r\n	&nbsp;f</p>\r\n<p>\r\n	dsa&nbsp;</p>\r\n<p>\r\n	fasd</p>\r\n<p>\r\n	&nbsp;fsd</p>\r\n<p>\r\n	a&nbsp;</p>\r\n<p>\r\n	fda</p>\r\n<p>\r\n	&nbsp;dafdsa</p>\r\n', 0, 0, 1, 0, 1, '', 'public/2010/08/2010_08_17_16_14_57_9450.png', '10', '5', 1, 0, 1, 'Moto', ''),
(4, 2, 'LG 25 Ft. Line Cord', '<p>\r\n	<meta charset="utf-8" /><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; ">This&nbsp;<span class="blackbold" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; color: rgb(0, 0, 0); font-weight: bold; ">25 Ft. line cord</span>&nbsp;is a standard telephone cord set with 4-conductors and RJ11 male connectors on both ends.</span></p>\r\n', 0, 0, 1, 0, 1, '', 'public/2010/08/att 15910  .jpeg', '100', '70', 1, 0, 1, 'HTC', ''),
(5, 2, 'hello', '<p>\r\n	fdsa fdas fda fasf das</p>\r\n', 0, 0, 1, 0, 1, '', 'public/2010/08/bluetooth2945.jpeg|public/2010/08/2010_08_24_00_44_40_3279.png|public/2010/08/aaa_bbb5577.jpg', '110', '100', 0, 2, 0, 'LG', 'Sprint'),
(6, 2, 'test', '<p>\r\n	fdsafa fdsa fdsa fsa fa</p>\r\n', 0, 0, 1, 0, 1, '', 'public/2010/08/small.jpg', '9', '7', 1, 2, 1, 'LG', 'AT&T');

-- --------------------------------------------------------

--
-- 表的结构 `end_rights`
--

DROP TABLE IF EXISTS `end_rights`;
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
(1, 'Super Admin', 'All access', 9, 'category_view,category_add,category_update,category_delete,item_view,item_add,item_update,item_delete,account_update,admin_view,admin_add,admin_update,admin_update_password,admin_delete,config_view,config_add,config_update,config_delete,extension_view,extension_add,extension_update,extension_delete,upload_add,rights_view,rights_add,rights_update,rights_delete,coupon_view,coupon_add,coupon_update,coupon_delete,link_view,link_add,link_update,link_delete,order_view,order_add,order_update,order_delete,product_view,product_add,product_update,product_delete,slideshow_view,slideshow_add,slideshow_update,slideshow_delete,user_view,user_add,user_update,user_delete');

-- --------------------------------------------------------

--
-- 表的结构 `end_slideshow`
--

DROP TABLE IF EXISTS `end_slideshow`;
CREATE TABLE IF NOT EXISTS `end_slideshow` (
  `slideshow_id` int(11) NOT NULL auto_increment,
  `status` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL,
  `name` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `image` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`slideshow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `end_slideshow`
--


-- --------------------------------------------------------

--
-- 表的结构 `end_user`
--

DROP TABLE IF EXISTS `end_user`;
CREATE TABLE IF NOT EXISTS `end_user` (
  `user_id` int(11) NOT NULL auto_increment,
  `email` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `password` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  `create_time` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL default '',
  `city` varchar(100) default NULL,
  `street` varchar(250) default NULL,
  `fax` varchar(100) default NULL,
  `states` varchar(50) default NULL,
  `phone` varchar(100) default NULL,
  `zip` varchar(10) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `end_user`
--

INSERT INTO `end_user` (`user_id`, `email`, `password`, `status`, `create_time`, `fname`, `lname`, `city`, `street`, `fax`, `states`, `phone`, `zip`) VALUES
(1, 'longbill.cn@gmail.com', '55d7e24398e9cc418e630d1602a6609f43cefef0', 0, 1282230798, 'fname', 'lname', 'city', 'street', '', 'AL', '121212121', '11214');
