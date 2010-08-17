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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;


INSERT INTO `end_admin` (`admin_id`, `rights_id`, `name`, `password`, `email`, `status`) VALUES
(36, 1, 'endcms', '77fbc280bf0900b454c5b83ab0b52fb965d30811', 'endcms@endcms.com', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;


INSERT INTO `end_category` (`category_id`, `parent_id`, `name`, `description`, `keywords`, `order_id`, `status`, `update_time`, `create_time`, `url`, `content`, `target`, `page_title`, `alias`, `system`, `item_count`, `image`) VALUES
(1, 0, 'Product Categories', NULL, NULL, 0, 'folder', 1281984800, 1281984524, 'all_categories', '', '', '', '', 'no', 0, ''),
(2, 1, 'Blue Tooth', '', '', 0, 'product_list', 1282029515, 1281984537, 'Blue Tooth', '', '', '', '', 'no', 0, 'public/2010/08/380d062f-032d-4c49-84af-e53488a7cb138351.jpg'),
(3, 1, 'Car Charge', '', '', 0, 'product_list', 1282035392, 1281984549, 'Car Charge', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_17_15_22_24_9118.png'),
(4, 1, 'Hand Free', '', '', 0, 'product_list', 1282029552, 1281984618, 'Hand Free', '', '', '', '', 'no', 0, 'public/2010/08/e164937e-6c08-43f4-ace8-91b53e075846.jpg'),
(5, 1, 'Memory Cards', '', '', 0, 'product_list', 1282035321, 1281984723, 'Memory Cards', '', '', '', '', 'no', 0, 'public/2010/08/wangxiyi2.jpg'),
(6, 0, 'Configuraton', NULL, NULL, 0, 'config_list', 1282034034, 1282027016, 'config', '', '', '', '', 'no', 0, ''),
(8, 1, 'Batteries', '', '', 0, 'product_list', 1282030197, 1282030147, 'Batteries', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_17_15_29_57_6133.png'),
(9, 1, 'Charms', '', '', 0, 'product_list', 1282030203, 1282030160, 'Charms', '', '', '', '', 'no', 0, 'public/2010/08/2010_08_17_15_30_03_1309.png'),
(10, 0, 'Information', NULL, NULL, 0, 'folder', 1282034028, 1282034019, 'info', '', '', '', '', 'no', 0, ''),
(11, 10, 'Return Policy', '', '', 0, 'page', 1282034053, 1282034048, 'Return Policy', '<p>\r\n	<meta charset="utf-8" /><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; ">Brand New items may be returned or exchanged within 30 Days from date of purchase. Returns are subject to a 15% restocking fee plus the actual cost of shipping. This amount will be deducted from the amount of your refund.&nbsp;<br />\r\n	<br />\r\n	Factory Serviced items are exchangeable for a replacement of the same model on defective items only within 30 Days from date of purchase.&nbsp;<br />\r\n	<br />\r\n	Due to overwhelming piracy on software including DVDs, CDs, and Pre-Loaded Data Cards, the manufacturer has stated that these items cannot be returned back to&nbsp;<span id="lblcompanyname2" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com. For any issues concerning the software (i.e. Defect, Troubleshooting, etc.), the customer is responsible for contacting the manufacturer directly for assistance.&nbsp;<br />\r\n	<br />\r\n	All returns or exchanges missing or with damage to the original box may be refused or may be subject to a 10% penalty fee. (i.e. missing/damaged UPC barcodes, missing/damaged manuals, missing/damaged warranties, tape on the manufacturer&rsquo;s box, etc.) Ship all returns using a traceable shipping method and a separate shipping box. DO NOT put any courier labels on the manufacturer&#39;s merchandise packaging. Doing so requires&nbsp;<span id="lblcompanyname3" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;to pay for replacement packaging. Therefore, additional fees will be charged under these circumstances.&nbsp;<br />\r\n	<br />\r\n	We will not accept items back unless they are returned with the manufacturer&#39;s original packaging.&nbsp;<br />\r\n	<br />\r\n	<span id="lblcompanyname4" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;is not liable in any way for returned packages that were lost or damaged during shipment.&nbsp;</span></p>\r\n', '', 'Return Policy', '', 'no', 0, ''),
(12, 10, 'Terms of use', '', '', 0, 'page', 1282034086, 1282034072, 'Terms of use', '<p>\r\n	<meta charset="utf-8" /><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; "><span id="lblcompanyname10" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;offers a full range of products produced by a variety of manufacturers. Please note that&nbsp;<span id="lblcompanyname11" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com does not in any manner allege any affiliation between the manufacturers and our corporation. All products that appear on&nbsp;<span id="lblcompanyname12" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com are the sole property of&nbsp;<span id="lblcompanyname13" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>, unless specified otherwise. Such materials protected by this copyright include, but are not limited to, any and all text; any and all images (including icons, logos, and other graphics); and any and all design elements of the website.&nbsp;<span id="lblcompanyname14" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&rsquo;s website is used only for the purpose of shopping on this site, placing an order on this site, or for conducting other tasks associated with shopping or placing an order on this site. By placing an order with&nbsp;<span id="lblcompanyname15" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>.com you acknowledge and agree that at no time is<span id="lblcompanyname16" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;making any representation or warranty regarding the products purchased by you the consumer.&nbsp;<br />\r\n	<br />\r\n	BY USING THIS SITE AND/OR ANY SERVICES RELATED THERETO, YOU AGREE THAT YOU HAVE READ, UNDERSTAND AND AGREE TO THE TERMS OF USE AND DISCLAIMER.</span></p>\r\n', '', 'Terms of use', '', 'no', 0, ''),
(13, 10, 'Privacy', '', '', 0, 'page', 1282034088, 1282034082, 'Privacy', '<p>\r\n	<span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; ">All information submitted to&nbsp;<span id="lblcompanyname9" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">OnlinePhoneStore</span>&nbsp;is held private. We DO NOT sell customer data. Some data may be shared with third parties only if you, the customer agrees to participate in offers available through our site. If you accept such an offer, we will disclose your contact and billing information to that third party. All data collected is secured under 128bit Verisign protection.&nbsp;<br />\r\n	<br />\r\n	<b>Email Offer Subscriptions:</b><br />\r\n	Upon placing an order through this Site, you will automatically be enrolled in the OnlinePhoneStore.com best offers email promotion list based on the billing email address information you have provided, unless you opt-out of receiving such communications. You may request at any time to opt-out from our email promotion list by&nbsp;clicking here. This simple opt-out process allows you to unsubscribe if you decide not to receive any further promotional emails from our family of web stores. Furthermore, We will never share any personally identifiable information which you have given to us with any third party marketers. In order to make our email offers more relevant and useful to you, our servers may receive a confirmation when you open an email message from OnlinePhoneStore.com. In addition, if you have any questions about receiving communications from us you may email us at&nbsp;info@phone.com&nbsp;at any time.</span></p>\r\n', '', 'Privacy Policy', '', 'no', 0, ''),
(14, 0, 'Customers', NULL, NULL, 0, 'user_list', 1282051762, 1282051755, 'Customers', '', '', '', '', 'no', 0, '');


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admin settings' AUTO_INCREMENT=12 ;


INSERT INTO `end_config` (`config_id`, `category_id`, `name`, `value`, `updated_at`, `type`, `description`, `order_id`) VALUES
(2, 6, 'site_name', 'Phone&nbsp;Accessories', '2010-08-17 14:37:44', 'text', 'Site Name', 10),
(4, 6, 'upload_file_types', 'Images:&nbsp;&nbsp;&nbsp;*.jpg;&nbsp;*.png;*.jpeg;*.gif;<br>Documents:&nbsp;*.doc;*.docx;*.xls;*.ppt;<br>Archieves:&nbsp;*.rar;*.zip;*.7z;', '2010-08-17 14:38:43', 'textarea', 'Upload file types', 0),
(8, 6, 'max_image_width', '600', '2010-08-17 16:14:05', '', 'Uploaded Image will be resize to this width', 0),
(9, 6, 'index_description', 'Phone&nbsp;Accessories&nbsp;Online&nbsp;Store', '2010-08-17 16:58:43', '', 'Index Description (SEO)', 0),
(10, 6, 'index_keywords', 'Phone&nbsp;Accessories', '2010-08-17 16:59:04', '', 'Index Keywords (SEO)', 0),
(11, 6, 'index_title', 'Phone&nbsp;Accessories&nbsp;online&nbsp;shop', '2010-08-17 17:04:21', '', 'Index Title (SEO) ', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `end_log` (`log_id`, `admin_id`, `controller`, `url`, `menu`, `time`, `info`) VALUES
(1, 36, '', '/newendcms/admin.php', 0, 1282066771, ''),
(2, 36, 'category', 'admin.php?p=category', 1, 1282066772, ' Categories'),
(3, 36, 'item', '/newendcms/admin.php?p=item', 0, 1282066772, ''),
(4, 36, '', '/newendcms/admin.php', 0, 1282066773, ''),
(5, 36, 'category', 'admin.php?p=category', 1, 1282066774, ' Categories'),
(6, 36, 'admin', 'admin.php?p=admin', 1, 1282066775, ' Administrators'),
(7, 36, '', '/newendcms/admin.php', 0, 1282066776, '');


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
  PRIMARY KEY  (`product_id`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `end_product` (`product_id`, `category_id`, `name`, `content`, `create_time`, `update_time`, `status`, `order_id`, `view_count`, `url`, `image`, `retail`, `wholesale`) VALUES
(3, 2, 'AC Blue tooth adapter', '<p>\r\n	fd afda f</p>\r\n<p>\r\n	da fsda fdsa</p>\r\n<p>\r\n	&nbsp;f</p>\r\n<p>\r\n	dsa&nbsp;</p>\r\n<p>\r\n	fasd</p>\r\n<p>\r\n	&nbsp;fsd</p>\r\n<p>\r\n	a&nbsp;</p>\r\n<p>\r\n	fda</p>\r\n<p>\r\n	&nbsp;dafdsa</p>\r\n', 0, 0, 1, 0, 1, '', 'public/2010/08/2010_08_17_16_14_57_9450.png', '10', '5'),
(4, 2, '25 Ft. Line Cord', '<p>\r\n	<meta charset="utf-8" /><span class="Apple-style-span" style="color: rgb(51, 51, 51); font-family: Verdana, Arial; border-collapse: collapse; ">This&nbsp;<span class="blackbold" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; color: rgb(0, 0, 0); font-weight: bold; ">25 Ft. line cord</span>&nbsp;is a standard telephone cord set with 4-conductors and RJ11 male connectors on both ends.</span></p>\r\n', 0, 0, 1, 0, 1, '', 'public/2010/08/att 15910  .jpeg', '100', '70');



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
(1, 'Super Admin', 'All access', 9, 'category_view,category_add,category_update,category_delete,item_view,item_add,item_update,item_delete,account_update,admin_view,admin_add,admin_update,admin_update_password,admin_delete,config_view,config_add,config_update,config_delete,extension_view,extension_add,extension_update,extension_delete,upload_add,rights_view,rights_add,rights_update,rights_delete,product_view,product_add,product_update,product_delete,user_view,user_add,user_update,user_delete');


DROP TABLE IF EXISTS `end_user`;
CREATE TABLE IF NOT EXISTS `end_user` (
  `user_id` int(11) NOT NULL auto_increment,
  `email` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `password` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `end_user` (`user_id`, `email`, `password`, `status`, `create_time`) VALUES
(1, 'longbill.cn@gmail.com', '55d7e24398e9cc418e630d1602a6609f43cefef0', 0, 1282053859),
(2, 'longbill@live.cn', '55d7e24398e9cc418e630d1602a6609f43cefef0', 1, 1282054615);
