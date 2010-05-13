-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 05 月 13 日 12:05
-- 服务器版本: 5.0.41
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
(35, 1, 'endcms', '77fbc280bf0900b454c5b83ab0b52fb965d30811', 'endcms@endcms.com', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `end_blog`
--

INSERT INTO `end_blog` (`blog_id`, `category_id`, `name`, `content`, `create_time`, `update_time`, `status`, `order_id`) VALUES
(1, 65, 'Firebug in Firefox 3.5b4', '   &nbsp;&nbsp;前段时间装了firefox3.5b4，据说使用了新的javascript引擎。我测试了一下，的确快了不少，跟safari有的一拼。 但是很烦，升到3.5b4后，很多插件用不了，只有一些主题能够继续使用。\r\n    &nbsp;&nbsp;Firebug是做网页的必备工具，这可让我怎么<!--more-->选择，一边是快如飞的firefox3.5b4，一边是慢吞吞的firefox3但是有firebug..... 今天突然找到了firebug的最新版本，能够在firefox3.5b4下面使用～～\r\n\r\nhttp://getfirebug.com/releases/firebug/1.4X/\r\n', 1242153377, 0, 1, 0),
(2, 66, '哈哈，换服务器了~~', '以前的服务器是9466的50m空间，虽然网速比较快，但总是感觉服务器处理速度慢，现在好了:lol:换成了300m的，而且是别人送的，免费的哦。:lol::lol::lol::lol:', 1142816548, 0, 1, 0),
(3, 67, '李阳老师到我们学校演讲了！', '<div style="overflow: auto; width: 500px;"><a href="http://www.longbill.cn/blog//uploadfiles/liyang02.gif" target="_blank"><img class="ubbimg" src="http://www.longbill.cn/blog//uploadfiles/liyang02.gif" border="0" alt="http://www.longbill.cn/blog//uploadfiles/liyang02.gif" /></a></div>\r\n李阳本来说是昨天早上来的。但因为班机延误，所以取消了。当时我们都很失望，但是到11：00的时候听到广播说李阳老师已经到我们学校了，马上为我们演讲。（后来才知道是我们学校的老师直接从飞机外把李阳老师接到我们学校的~~强~~）\r\n\r\n3个小时的演讲精彩纷呈，高潮迭起，其中穿插了许多经典的东西。嘿嘿，我当时用mp3录了音的。 以后有时间整理一下贴出来大家一起分享。:lol:\r\n\r\n人太多了（全校3000多人），阶梯教室坐不完，只有到操场坐地上', 1144043282, 0, 1, 0),
(4, 68, 'longbill php文件管理器更名为phpcms文件管理器', '<span style="color:Red">4.03版请点击这里&nbsp;<a href="http://www.longbill.cn/blog/index.php?id=75" target="_blank">http://www.longbill.cn/blog/index.php?id=75</a></span>\r\n<br />\r\n<br />\r\n<br />由于longbill已经加入&nbsp;<a href="http://www.phpcms.cn" target="_blank">phpcms</a>&nbsp;开发组，所以将以前的&nbsp;longbill&nbsp;php&nbsp;文件管理器&nbsp;更名为&nbsp;phpcms&nbsp;文件管理器\r\n<br />\r\n<br />更新的版本正在编写中。。。\r\n<br />\r\n<br />:):)', 1141462286, 0, 1, 0),
(5, 69, '今天装了Mac os X Leopard！', '&nbsp;&nbsp;&nbsp;&nbsp;那天听说Mac可以装在PC上，于是google了一下。还真是呀，哈哈，然后调查了下，决定在淘宝花10块钱买一张盘。\r<br />&nbsp;&nbsp;&nbsp;&nbsp;到手后立即入手装，但是遇到了很多麻烦。首先就是安装的时候的选项问题：mac安装的时候会有一些选项，可以选择系统loader和一些硬件驱动。第一次全都选了。装上了，但是不能引导开机。删除。第二次，只选了x86&nbsp;bootloader，装上了，能引导，能开机。&nbsp;当时可把我高兴坏了，因为我看到苹果的欢迎画面了，做的非常好（后来发现原来是一个mov视频而已）。填了一些东西后，就不动了。过一会又重复欢迎画面。如此往复几次，无奈，又删掉，重装。这样经过了无数次的重装，其间经历了蓝屏、灰屏、无法找到系统等等错误。直到第二天下午，我终于装上了稳定的Mac&nbsp;OS&nbsp;X&nbsp;Leopard！\r<br />&nbsp;&nbsp;&nbsp;&nbsp;接下来就是驱动啦。我的本本的显卡是&nbsp;Intel&nbsp;GMA&nbsp;X3100&nbsp;Mac安装盘里面有驱动，所以不用担心这个。声音也可以用，但是插入耳机的时候没有什么反应！算了，忍了。可是最领人头疼的还是网卡驱动。又弄了一个晚上把&nbsp;有线网卡(Marvell&nbsp;Yukon&nbsp;8039)的驱动弄好。终于可以通过网线上网了！<img src=''http://longbill.cn/blog/admin/FCKeditor/editor/images/smiley/face6.gif'' />&nbsp;然后就是攻克无线网卡（Intel&nbsp;Pro&nbsp;Wireless&nbsp;3945），但是经过半天的折腾之后得出一个结论：这个网卡暂时还不能在Mac&nbsp;OS上使用！<img src=''http://longbill.cn/blog/admin/FCKeditor/editor/images/smiley/face46.gif'' />。\r<br />&nbsp;&nbsp;&nbsp;&nbsp;哎，算了。还是将就用吧。反正主要的功能都搞定了。接下来就是享受苹果的杰作了。&nbsp;我现在才发现为什么用过Mac的人都不再想回到Windows，因为真的很爽。界面很漂亮，但是不是像Vista那样俗艳，并且动画无处不在。操作十分简便，安装软件也是非常的方便呀。&nbsp;而且更爽的是，Mac本身自带了&nbsp;Apache2！只需要打开网络共享就可以开启Apache！', 1205466139, 0, 1, 0),
(6, 70, '八岁女童墓志铭：我来过，我很乖...', '在phpblog.cn上看到，很感动，就转过来了。\r<br />\r<br /><div style="overflow:auto;width:500px"><a href="http://www.longbill.cn/blog/uploadfiles/8girl_1.jpg" target="_blank"><img src="http://www.longbill.cn/blog/uploadfiles/8girl_1.jpg" alt="http://www.longbill.cn/blog/uploadfiles/8girl_1.jpg" border="0" class="ubbimg" /></a></div>\r<br />\r<br /><div style="overflow:auto;width:500px"><a href="http://www.longbill.cn/blog/uploadfiles/8girl_2.jpg" target="_blank"><img src="http://www.longbill.cn/blog/uploadfiles/8girl_2.jpg" alt="http://www.longbill.cn/blog/uploadfiles/8girl_2.jpg" border="0" class="ubbimg" /></a></div>\r<br />\r<br /><div style="overflow:auto;width:500px"><a href="http://www.longbill.cn/blog/uploadfiles/8girl_3.jpg" target="_blank"><img src="http://www.longbill.cn/blog/uploadfiles/8girl_3.jpg" alt="http://www.longbill.cn/blog/uploadfiles/8girl_3.jpg" border="0" class="ubbimg" /></a></div>\r<br />\r<br /><div style="overflow:auto;width:500px"><a href="http://www.longbill.cn/blog/uploadfiles/8girl_4.jpg" target="_blank"><img src="http://www.longbill.cn/blog/uploadfiles/8girl_4.jpg" alt="http://www.longbill.cn/blog/uploadfiles/8girl_4.jpg" border="0" class="ubbimg" /></a></div>\r<br />\r<br />有一个美丽的小女孩，她的名字叫做佘艳，她有一双亮晶晶的大眼睛，她有一颗透亮的童心。她是一个孤儿，她在这个世界上只活了8年，她留在这个世界上最后的话是“我来过我很乖”。她希望死在秋天，纤瘦的身体就像一朵花自然开谢的过程。在遍地黄花堆积，落叶空中旋舞时候，她会看见横空远行雁儿们。她自愿放弃治疗，把全世界华人捐给她的54万元救命钱分成了7份，把生命当成希望的蛋糕分别给了7个正徘徊在生死线的小朋友。&nbsp;\r<br />\r<br />　　我自愿放弃治疗&nbsp;\r<br />\r<br />　　她一出生就不知亲生父母，她只有收养她的“爸爸”。&nbsp;\r<br />\r<br />　　1996年11月30日，那是当年农历10月20日，因为“爸爸”佘仕友在永兴镇沈家冲一座小桥旁的草丛中发现被冻得奄奄一息的这个新生婴儿时，发现她的胸口处插着一张小纸片，上面写着：“10月20日晚上12点。”&nbsp;\r<br />\r<br />　　家住四川省双流县三星镇云崖村二组的佘仕友当时30岁，因为家里穷一直找不到对象，如果要收养这个孩子，恐怕就更没人愿意嫁进家门了。看着怀中小猫一样嘤嘤哭泣的婴儿，佘仕友几次放下又抱起，转身走又回头，这个小生命已经浑身冰冷哭声微弱，再没人管只怕随时就没命了！咬咬牙，他再次抱起婴儿，叹了一口气：“我吃什么，你就跟我吃什么吧。”&nbsp;\r<br />\r<br />　　佘仕友给孩子取名叫佘艳，因为她是秋天丰收季节出生的孩子。单身汉当起了爸爸，没有母乳，也买不起奶粉，就只好喂米汤，所以佘艳从小体弱多病，但是非常乖巧懂事。春去春又回，如同苦藤上的一朵小花，佘艳一天天长大了，出奇得聪明乖巧，乡邻都说捡来的娃娃智商高，都喜欢她。尽管从小就多病，在爸爸的担惊受怕中，佘艳慢慢地长大了。&nbsp;\r<br />\r<br />　　命苦的孩子的确不一般，从5岁起，她就懂得帮爸爸分担家务，洗衣、煮饭、割草她样样做得好，她知道自己跟别家的孩子不一样，别家的孩子有爸爸有妈妈，自己的家里只有她和爸爸，这个家得靠她和爸爸一起来支撑，她要很乖很乖，不让爸爸多一点点忧心生一点点气。&nbsp;\r<br />\r<br />　　上小学了，佘艳知道自己要好学上进要考第一名，不识字的爸爸在村里也会脸上有光，她从没让爸爸失望过。她给爸爸唱歌，把学校里发生的趣事一样一样讲给爸爸听，把获得的每一朵小红花仔仔细细贴在墙上，偶尔还会调皮地出道题目考倒爸爸……每当看到爸爸脸上的笑容，她会暗自满足：“虽然不能像别的孩子一样也有妈妈，但是能跟爸爸这样快乐地生活下去，也很幸福了。”&nbsp;\r<br />\r<br />　　2005年5月开始，她经常流鼻血。有一天早晨，佘艳正欲洗脸，突然发现一盆清水变得红红的，一看，是鼻子里的血正向下滴，不管采用什么措施，都止不住。实在没办法，佘仕友带她去乡卫生院打针，可小小的针眼也出血不止，她的腿上还出现大量“红点点”，医生说，“赶快到大医院去看！”来到成都大医院，可正值会诊高峰，她排不上轮次。独自坐在长椅上按住鼻子，鼻血像两条线直往下掉，染红了地板。他觉得不好意思，只好端起一个便盆接血，不到10分钟，盆子里的血就盛了一半。&nbsp;\r<br />\r<br />　　医生见状，连忙带孩子去检查。检查后，医生马上给他开了病危通知单。他得了“急性白血病”！&nbsp;\r<br />\r<br />　　这种病的医疗费是非常昂贵的，费用一般需要30万元！佘仕友懵了。看着病床上的女儿，他没法想太多，他只有一个念头：救女儿！借遍了亲戚朋友，东拼西凑的钱不过杯水车薪，距离30万实在太远，他决定卖掉家里唯一还能换钱的土坯房。可是因为房子太过破旧，一时找不到买主。&nbsp;\r<br />\r<br />　　看着父亲那双忧郁的眼睛和日渐消瘦的脸，佘艳总有一种酸楚的感觉。一次，佘艳拉着爸爸的手，话还未出口眼泪却冒了出来：“爸爸，我想死……”&nbsp;\r<br />\r<br />　　父亲一双惊愕的眼睛看着她：“你才8岁，为啥要死？”&nbsp;\r<br />\r<br />　　“我是捡来的娃娃，大家都说我命贱，害不起这病，让我出院吧……”&nbsp;\r<br />\r<br />　　6月18日，8岁的佘艳代替不识字的爸爸，在自己的病历本上一笔一画地签字：“自愿放弃对佘艳的治疗。”&nbsp;\r<br />\r<br />　　8岁女孩乖巧安排后事&nbsp;\r<br />\r<br />　　当天回家后，从小到大没有跟爸爸提过任何要求的佘艳，这时向爸爸提出两个要求：她想穿一件新衣服，再照一张相片，她对爸爸解释说：“以后我不在了，如果你想我了，就可以看看照片上的我。”&nbsp;\r<br />\r<br />　　第二天，爸爸叫上姑姑陪着佘艳来到镇上，花30元给佘艳买了两套新衣服，佘艳自己选了一套粉红色的短袖短裤，姑姑给她选了一套白色红点的裙子，她试穿上身就舍不得脱下来。三人来到照相馆，佘艳穿着粉红色的新衣服，双手比着V字手势，努力地微笑，最后还是忍不住掉下泪来。&nbsp;&nbsp;\r<br />\r<br />　　她已经不能上学了，她长时间背着书包站在村前的小路上，目光总是湿漉漉的。&nbsp;\r<br />\r<br />　　如果不是《成都晚报》的一个叫傅艳的记者，佘艳将像一片悄然滑落的树叶一样，静静地从风中飘下来。&nbsp;&nbsp;\r<br />\r<br />　　记者阿姨从医院方面得知了情况，写了一篇报道，详尽叙说佘艳的故事。旋即，《8岁女孩乖巧安排后事》的故事在蓉城传开了，成都被感动了，互联网也被感动了，无数市民为这位可怜的女孩心痛不已，从成都到全国乃至全世界，现实世界与互联网空间联动，所有爱心人士开始为这个弱小的生命捐款，“和谐社会”成为每个人心中的最强音。短短10天时间，来自全球华人捐助的善款就已经超过56万元，手术费用足够了，小佘艳的生命之火被大家的爱心再次点燃！宣布募捐活动结束之后，仍然源源不断收到全球各地的捐款。所有的钱都到位了，医生也尽自己最大努力，一个接一个的治疗难关也如愿地一一闯过！大家沉着地微笑着等待成功的那一天！有网友如是写道：“佘艳，我亲爱的孩子！我希望你能健康的离开医院；我祈祷你能顺利的回到学校；我盼望你能平安的长大成人；我幻想我能高兴的陪你出嫁。佘艳，我亲爱的孩子……”&nbsp;\r<br />\r<br />　　6月21日，放弃治疗回家等待死神的佘艳被重新接到成都，住进了市儿童医院。钱有了，卑微的生命有了延续下去的希望和理由。&nbsp;\r<br />\r<br />　　佘艳接受了难以忍受的化疗。玻璃门内，佘艳躺在病床上输液，床头旁边放着一把椅子，椅子上放一个塑料盆，她不时要侧身呕吐。小女孩的坚强令所有人吃惊。她的主治医生徐鸣介绍，化疗阶段胃肠道反应强烈，佘艳刚开始时经常一吐就是大半盆，可她“连吭都没吭一声”。刚入院时做骨髓穿刺检查，针头从胸骨刺入，她“没哭，没叫，眼泪都没流，动都不动一下”。&nbsp;\r<br />\r<br />　　佘艳从出生到死亡，没有得到一丝母爱的关照。当徐鸣医生提出：“佘艳，给我当女儿吧！”佘艳眼睛一闪，泪珠儿一下就涌了出来。第二天，当徐鸣医生来到她床前的时候，佘艳竟羞羞答答地叫了一声：“徐妈妈。”徐鸣开始一愣，继而笑逐颜开，甜甜地回了一声：“女儿乖。”&nbsp;\r<br />\r<br />　　所有的人都期待奇迹发生，所有的人都在盼望佘艳重生的那一刻。很多市民来到医院看望佘艳，网上很多网民都在问候这位可怜的孩子，她的生命让陌生的世界撒满了光明。&nbsp;\r<br />\r<br />　　那段时间，病房里堆满了鲜花和水果，到处弥漫着醉人的芬芳。&nbsp;\r<br />\r<br />　　两个月化疗，佘艳陆续闯过了9次“鬼门关”，感染性休克、败血症、溶血、消化道大出血……每次都逢凶化吉。由省内甚至国内权威儿童血液病专家共同会诊确定的化疗方案，效果很好，“白血病”本身已经被完全控制了！所有人都在企盼着佘艳康复的好消息。&nbsp;\r<br />\r<br />　　但是，化疗药物使用后可能引起的并发症非常可怕。而与别的很多白血病孩子比较，佘艳的体质差很多。经此手术后她的体质更差了。&nbsp;\r<br />\r<br />　　8月20日清晨，她问傅艳：“阿姨，你告诉我，他们为什么要给我捐款？”&nbsp;\r<br />\r<br />　　“因为，他们都是善良人。”&nbsp;\r<br />\r<br />　　“阿姨，我也做善良人。”&nbsp;\r<br />\r<br />　　“你自然是善良人。善良的人要相互帮助，就会变得更加善良。”&nbsp;\r<br />\r<br />　　佘艳从枕头下摸出一个数学作业本，递给傅艳：“阿姨，这是我的遗书……”&nbsp;\r<br />\r<br />　　傅艳大惊，连忙打开一看，果然是小佘艳安排的后事。这是一个年仅8岁的垂危孩子，趴在病床上用铅笔写了三页纸的《遗书》。由于孩子太小，有些字还不会写，且有个别错别字。看得出整篇文章并不是一气呵成写完的，分成了六段。开头是“傅艳阿姨”，结尾是“傅艳阿姨再见”，整篇文章“傅艳阿姨”或“傅阿姨”共出现7次，还有9次简称记者为“阿姨”。这16个称呼后面，全部是关于她离世后的“拜托”，以及她想通过记者向全社会关心她的人表达“感谢”与“再见”。&nbsp;\r<br />\r<br />　　“阿姨再见，我们在梦中见。傅艳阿姨，我爸爸房子要垮了。爸爸不要生气，不要跳楼。傅阿姨你要看好我爸爸。阿姨，医我的钱给我们学校一点点，多谢阿姨给红十字会会长说。我死后，把剩下的钱给那些和我一样病的人，让他们的病好起来……”&nbsp;\r<br />\r<br />　　这封遗书，让傅艳看得泪流满面，泣不成声。&nbsp;\r<br />\r<br />　　我来过，我很乖&nbsp;\r<br />\r<br />　　8月22日，由于消化道出血，几乎一个月不能吃东西而靠输液支撑的佘艳，第一次“偷吃东西”，她掰了一块方便面塞进嘴里。很快消化道出血加重，医生护士紧急给她输血、输液……看着佘艳腹痛难忍、痛苦不堪的样子，医生护士都哭了，大家都愿意帮她分担痛苦，可是，想尽各种办法还是无济于事。&nbsp;\r<br />\r<br />　　8岁的小佘艳终于远离病魔的摧残，安详离去。&nbsp;\r<br />\r<br />　　所有人都无法接受这个事实：那个美丽如诗、纯净如水的“小仙女”真的去了另一个世界吗？记者傅艳抚摸着佘艳渐渐冰冷的小脸，泣不成声，再也不能叫他阿姨了，再也不能笑出声来了……&nbsp;\r<br />\r<br />　　四川在线，网易等网站沉浸在泪海里，互联网被泪水打湿透了，“心痛到不能呼吸”。每个网站的消息帖子下面都有上万条跟帖，花圈如山，悼词似海，一位中年男士喃喃低语：“孩子，你本来就是天上的小天使，张开小翅膀，乖乖地飞吧……”&nbsp;8月26日，她的葬礼在小雨中举行，成都市东郊殡仪馆火化大厅内外站满了热泪盈眶的市民。他们都是8岁女孩佘艳素不相识的“爸爸妈妈”。为了让这个一出生就被遗弃、患白血病后自愿放弃自己的女孩，最后离去时不至于太孤单，来自四面八方的“爸爸妈妈们”默默地冒雨前来送行。&nbsp;\r<br />\r<br />　　她墓地有她一张笑吟吟的照片，碑文正面上方写着：“我来过，我很乖(1996.11.30.--2005.8.22)”&nbsp;\r<br />\r<br />　　后面刻着关于佘艳身世的简单介绍，最后两句是：“在她有生之年，感受到了人世的温暖。小姑娘请安息，天堂有你更美丽。”&nbsp;\r<br />\r<br />　　遵照小佘艳的遗愿，把剩下的54万元医疗费当成生命的馈赠留给其他患白血病的孩子。这7个孩子分别是杨心琳、徐黎、黄志强、刘灵璐、张雨婕、高健、王杰。这七个可怜的孩子，年龄最大的19岁，最小的只有2岁，都是家境非常困难，挣扎在死亡线上的贫困子弟。&nbsp;\r<br />\r<br />　　9月24日，第一个接受佘艳生命馈赠的女孩徐黎在华西医大成功进行手术后，她苍白的脸上挂上了一丝微笑：“我接受了你生命赠与，谢谢佘艳妹妹，你一定在天堂看着我们。请你放心，以后我们的墓碑上照样刻着：我来过，我很乖……”', 1141467035, 0, 1, 0);

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
  `item_count` int(11) NOT NULL,
  UNIQUE KEY `category_id` (`category_id`),
  KEY `alias` (`url`),
  KEY `alias_2` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `end_category`
--

INSERT INTO `end_category` (`category_id`, `parent_id`, `name`, `description`, `keywords`, `order_id`, `status`, `update_time`, `create_time`, `url`, `content`, `target`, `page_title`, `alias`, `system`, `item_count`) VALUES
(10, 9, 'Index', '返回首页', NULL, 10, 'link', 1269952671, 0, './', '', '_self', '', '', 'no', 0),
(11, 9, 'About', '刘春龙的个人简介', '刘春龙', 0, 'page', 1269953497, 0, 'about/', '<p>\r\n	哈哈哈。不错啊</p>\r\n', '', '关于刘春龙', '', 'no', 0),
(12, 9, 'Projects', 'ceshi', 'ceshi', 5, 'page', 1269962981, 0, 'projects/', '<p>\r\n	fdsaf sadfdsa</p>\r\n', '', '测试', '', 'no', 0),
(9, 0, '博客导航', '', NULL, -2, 'folder', 1270708556, 0, '', '', '', '', 'navigation', 'yes', 0),
(5, 0, '博客文章', '', NULL, 9, 'folder', 1272862115, 0, '', '', '', '', 'blog_cats', 'yes', 0),
(16, 0, '评论管理', NULL, NULL, 8, 'comment_list', 1271693365, 1270608601, '', '', '', '', '', 'yes', 0),
(17, 0, '系统设置', NULL, NULL, -3, 'config_list', 1271691282, 1271691272, '', '', '', '', '', 'no', 0),
(18, 0, '友情链接', NULL, NULL, 1, 'link_list', 1271695866, 1271693335, '', '', '', '', 'links', 'no', 0),
(70, 5, '感情', NULL, NULL, 0, 'blog_list', 0, 1273723101, 'truelove', '', '', '', '', 'no', 0),
(69, 5, '孤独苹果', NULL, NULL, 0, 'blog_list', 0, 1273723101, 'mac', '', '', '', '', 'no', 0),
(68, 5, '程序们', NULL, NULL, 0, 'blog_list', 0, 1273723101, 'programming', '', '', '', '', 'no', 0),
(67, 5, '生活', NULL, NULL, 0, 'blog_list', 0, 1273723101, 'life', '', '', '', '', 'no', 0),
(66, 5, '网络', NULL, NULL, 0, 'blog_list', 0, 1273723101, 'theweb', '', '', '', '', 'no', 0),
(65, 5, '乱七八糟', NULL, NULL, 0, 'blog_list', 0, 1273723101, 'uncategorized', '', '', '', '', 'no', 0);

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
(1, 5, 'longbill.cn@gmail.com', '刘春龙', '哈&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;哈哈&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;测试啦<br>fdsafa&nbsp;啊哈fdsa<br>哈哈&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;哈<br>不错&nbsp;sdaf&nbsp;asfdsa&nbsp;fdas<br>		elseif&nbsp;($data[''type'']&nbsp;==&nbsp;''textarea'')<br>a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b<br>啊，原来还可以这样啊<br>呵呵&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fffffffffffaaa<br>曾&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;经<br>阿凡达萨范德萨', 'http://longbill.cn', 1271777452, 0),
(2, 5, 'fdsa', '啊啊啊', '范德萨范德萨范德萨发大水发大水发<br><br><br><br>啊啊啊', 'fdsaf', 1271526075, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admin settings' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `end_config`
--

INSERT INTO `end_config` (`config_id`, `category_id`, `name`, `value`, `updated_at`, `type`, `description`, `order_id`) VALUES
(2, 17, 'site_name', '刘春龙的博客', '2010-04-19 23:37:03', 'text', '站点名字', 1),
(4, 17, 'upload_file_types', '图片：*.jpg;&nbsp;*.png;*.jpeg;*.gif;<br>文档：*.doc;*.docx;*.xls;*.ppt;<br>压缩：*.rar;*.zip;*.7z;', '2010-04-19 23:37:23', 'textarea', '全站上传文件类型限制', 0),
(5, 17, 'sub_title', 'PHP,&nbsp;Javascript&nbsp;and&nbsp;Works', '2010-04-19 23:58:07', '', '副标题', 0);

-- --------------------------------------------------------

--
-- 表的结构 `end_hook`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `end_hook`
--

INSERT INTO `end_hook` (`hook_id`, `module`, `hook`, `func_file`, `func_name`, `settings`, `create_time`, `create_by`, `title`, `status`) VALUES
(6, 'blog', 'footbar', 'end_blog/extension/blog_html_widget/function.php', 'show_blog_widget', 'array (\n  ''title'' => ''测试'',\n  ''content'' => ''测试测试<a>aaa</a>\\''";\\''\\\\\\'''',\n)', 1272966014, 'blog_html_widget', '测试', 'running');

-- --------------------------------------------------------

--
-- 表的结构 `end_link`
--

CREATE TABLE IF NOT EXISTS `end_link` (
  `link_id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL default '0',
  `name` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `end_link`
--

INSERT INTO `end_link` (`link_id`, `category_id`, `order_id`, `name`, `description`, `url`, `status`) VALUES
(1, 18, 4, 'Longbill', '刘春龙的博客', 'http://longbill.cn', 1),
(2, 18, 0, 'EndTo', '陶秋丰的网站', 'http://www.endto.com', 1),
(3, 18, 0, 'EndCMS', '易思内容管理系统', 'http://www.endcms.com', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `end_log`
--

INSERT INTO `end_log` (`log_id`, `admin_id`, `controller`, `url`, `menu`, `time`, `info`) VALUES
(1, 1, 'admin', 'admin.php?p=admin', 1, 1273723473, ' 管理管理员'),
(2, 1, 'login', '/admin.php?p=login&m=logout&module=admin&backurl=index.php', 0, 1273723476, ''),
(3, 0, 'login', '/admin.php?p=login&module=admin&backurl=admin.php%3F', 0, 1273723482, ''),
(4, 0, 'login', '/admin.php?p=login&module=admin&m=login&backurl=admin.php%3F', 0, 1273723485, ''),
(5, 35, '', '/admin.php?', 0, 1273723485, ''),
(6, 35, '', '/admin.php', 0, 1273723490, ''),
(7, 35, 'login', '/admin.php?p=login&m=logout&module=admin&backurl=index.php', 0, 1273723492, ''),
(8, 0, 'login', '/admin.php?p=login&module=admin&backurl=admin.php%3Fp%3Dextension', 0, 1273723497, ''),
(9, 0, 'login', '/admin.php?p=login&module=admin&m=login&backurl=admin.php%3Fp%3Dextension', 0, 1273723499, ''),
(10, 1, 'extension', '/admin.php?p=extension', 0, 1273723499, ''),
(11, 1, 'admin', 'admin.php?p=admin', 1, 1273723501, ' 管理管理员'),
(12, 1, 'ajax', '/admin.php?p=ajax&m=update&table=admin&column=rights_id&id=35', 0, 1273723503, ''),
(13, 1, 'login', '/admin.php?p=login&m=logout&module=admin&backurl=index.php', 0, 1273723506, ''),
(14, 0, 'login', '/admin.php?p=login&module=admin&backurl=admin.php%3Fp%3Dextension', 0, 1273723509, ''),
(15, 0, 'login', '/admin.php?p=login&module=admin&m=login&backurl=admin.php%3Fp%3Dextension', 0, 1273723512, ''),
(16, 35, 'extension', '/admin.php?p=extension', 0, 1273723512, ''),
(17, 35, 'admin', 'admin.php?p=admin', 1, 1273723516, ' 管理管理员'),
(18, 35, 'category', 'admin.php?p=category', 1, 1273723517, ' 栏目管理'),
(19, 35, 'item', '/admin.php?p=item', 0, 1273723519, ''),
(20, 35, '', '/admin.php', 0, 1273723520, ''),
(21, 35, 'item', '/admin.php?p=item', 0, 1273723521, ''),
(22, 35, 'category', 'admin.php?p=category', 1, 1273723522, ' 栏目管理'),
(23, 35, 'extension', '/admin.php?p=extension', 0, 1273723524, ''),
(24, 35, 'extension', '/admin.php?p=extension&extension=end_show_log', 0, 1273723525, '');

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
(1, '超级管理员', '拥有所有权限', 9, 'category_view,category_add,category_update,category_delete,item_view,item_add,item_update,item_delete,account_update,admin_view,admin_add,admin_update,admin_update_password,admin_delete,extension_view,extension_add,extension_update,extension_delete,config_view,config_add,config_update,config_delete,upload_add,rights_view,rights_add,rights_update,rights_delete,blog_view,blog_add,blog_update,blog_delete,comment_view,comment_add,comment_update,comment_delete,link_view,link_add,link_update,link_delete');
