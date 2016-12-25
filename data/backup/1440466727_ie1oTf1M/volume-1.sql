DROP TABLE IF EXISTS ims_article;
CREATE TABLE `ims_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `iscommend` tinyint(1) NOT NULL DEFAULT '0',
  `ishot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pcate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级分类',
  `ccate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级分类',
  `template` varchar(300) NOT NULL DEFAULT '' COMMENT '内容模板',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `source` varchar(50) NOT NULL DEFAULT '' COMMENT '来源',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `linkurl` varchar(500) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_iscommend` (`iscommend`),
  KEY `idx_ishot` (`ishot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_article_category;
CREATE TABLE `ims_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `nid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联导航id',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `icontype` tinyint(1) unsigned NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '分类图标',
  `css` varchar(500) NOT NULL,
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '分类描述',
  `template` varchar(300) NOT NULL DEFAULT '' COMMENT '分类模板',
  `templatefile` varchar(100) NOT NULL DEFAULT '',
  `linkurl` varchar(500) NOT NULL DEFAULT '',
  `ishomepage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_article_reply;
CREATE TABLE `ims_article_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `isfill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_attachment;
CREATE TABLE `ims_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL COMMENT '1为图片',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO ims_attachment VALUES 
('1','2','2','codebg_副本.jpg','/images/2/2015/08/U1S0pFML1sl25G4fGp5P1l25l5gEP0.jpg','1','1440039490'),
('2','2','2','1.png','/images/2/2015/08/e10z0OLl7w0qjJlwtlijvG6v6i0fQO.png','1','1440040452'),
('3','2','2','1.gif','/images/2/2015/08/hfJm6Mg3fFD67nz2FNN3nnnFz3fMsN.gif','1','1440040978'),
('4','2','2','tp.jpg','/images/2/2015/08/LidsZ1F6b1dDWDUiz27dIYDdY2dBL7.jpg','1','1440049347'),
('5','2','2','积分兑换.jpg','/images/2/2015/08/sINmaIqA6EQ5QjB76JQnaU776jF15K.jpg','1','1440049462'),
('6','0','0','000000000123153618_1_800x800.jpg','/images//2015/08/LK1Vk8gVNjk0yJkllgg81GJYyby88G.jpg','1','1440050148'),
('7','0','0','000000000123153618_2_800x800.jpg','/images//2015/08/ErdNR522DCwW5Wqdm3U3RNyyMl33Qd.jpg','1','1440050148'),
('8','0','0','000000000123153618_4_800x800.jpg','/images//2015/08/Mh5ukRbHEjGGRGmGH5jAxUAJe8jKAJ.jpg','1','1440050148'),
('9','0','0','000000000123153618_5_800x800.jpg','/images//2015/08/VoDbh7D76W9BzMM7gBJ2fqJgObMVfV.jpg','1','1440050148'),
('10','2','2','22750524_20150403144428.jpg','','1','1440050704'),
('11','2','2','22750524_20150403144410.jpg','','1','1440050704'),
('12','2','2','22750524_20150403144417.jpg','','1','1440050705'),
('13','2','2','22750524_20150403144422.jpg','','1','1440050706'),
('14','0','0','_1_800x800.jpg','/images//2015/08/S9w21JxuHAxdZDf2DevWWeXsFfwaGa.jpg','1','1440050931'),
('15','0','0','2_800x800.jpg','/images//2015/08/gfgS0O2sIHJhC22Wqjg2uSicIFSPoO.jpg','1','1440050931'),
('16','0','0','6_800x800.jpg','/images//2015/08/yCNB7ibXdxcSWIqnR9xPimPXTBTpn2.jpg','1','1440050931'),
('17','0','0','000000000123493564_1_800x800.jpg','/images//2015/08/GF4F5cfv8VBBRq8GvofTbB2CfORfAS.jpg','1','1440051179'),
('18','0','0','000000000123493564_2_800x800.jpg','/images//2015/08/imj7ErM8El86zJcNz7a882RlCMaLnf.jpg','1','1440051180'),
('19','0','0','000000000123493564_3_800x800.jpg','/images//2015/08/lzAS74RS0x4ch7FSXR4CcAFbFsxA6f.jpg','1','1440051180'),
('20','0','0','000000000123493564_4_800x800.jpg','/images//2015/08/B1E5ACepYn1VfYn1bYzn1efYVemTeI.jpg','1','1440051181'),
('21','0','0','000000000123493564_5_800x800.jpg','/images//2015/08/nb0ChGGGq2znunrHRaBHCv2dqdfOB3.jpg','1','1440051181'),
('22','2','2','201501220325176287_x.jpg','','1','1440051275'),
('23','2','2','201501220324597893_x.jpg','','1','1440051276'),
('24','2','2','201501220325098636_x.jpg','','1','1440051278'),
('25','2','2','104885896_20150731183148.jpg','','1','1440052078'),
('26','2','2','104885896_20150731183202.jpg','','1','1440052079'),
('27','0','0','000000000107798285_5_800x800.jpg','/images//2015/08/RitwTIJ1Q0iNc7jOxWeiI0NwTT18I1.jpg','1','1440052459'),
('28','0','0','000000000107798285_1_800x800.jpg','/images//2015/08/cT7JCsqSFzc71cXaos6tC8fTQMF8Z7.jpg','1','1440052459'),
('29','0','0','000000000107798285_2_800x800.jpg','/images//2015/08/yrRuqRK86S6rWsZYq4qCrxKcQS24Xz.jpg','1','1440052459'),
('30','0','0','000000000107798285_4_800x800.jpg','/images//2015/08/UoCC51x1O5kGkqknRKuWRByNRWeSYC.jpg','1','1440052460'),
('31','2','2','107798285_20150803141946.jpg','','1','1440052500'),
('32','2','2','107798285_20150803141952.jpg','','1','1440052501'),
('33','2','2','107798285_20150803142004.jpg','','1','1440052501'),
('34','2','2','201402201157523235_x.jpg','','1','1440052768'),
('35','2','2','201402201157549964_x (1).jpg','','1','1440052768'),
('36','2','2','201402201157549964_x.jpg','','1','1440052769'),
('37','2','2','shangcheng.jpg','/images/2/2015/08/RI576IQjja4C1oX5O46D459J15I0Zi.jpg','1','1440053311'),
('38','2','2','积分兑换.jpg','/images/2/2015/08/usuas1XOq6UlU6Fuk1quaKyeXzyXqu.jpg','1','1440053342'),
('39','2','2','qiandao.jpg','/images/2/2015/08/Dk69H8hM8h6n8K886vh698zBmS2s8h.jpg','1','1440053383'),
('40','2','2','广告1.jpg','/images/2/2015/08/PglOUTG34cW4u57ogH6u60Hv3oz5t5.jpg','1','1440053401'),
('41','2','2','积分兑换.jpg','/images/2/2015/08/vYtOpQM2ybEv44fpMtfP1HqzfOpTEL.jpg','1','1440060822'),
('42','2','2','000000000131167099_1_800x800.jpg','/images/2/2015/08/dOQk3ovCHMsaT58XCDXOvcXq33sWVt.jpg','1','1440061366'),
('43','2','2','442729301007493528272700_x.jpg','','1','1440061408'),
('44','2','2','125059666911307950973608_x.jpg','','1','1440061409'),
('45','2','2','163950697015318413722240_x.jpg','','1','1440061410'),
('46','2','1','144014670242461417.jpg','/images/2/2015/08/BxAolYKkxXoRzakzX7RkZxNkXmkokk.jpg','1','1440317628'),
('47','2','1','144014665749562571.jpg','/images/2/2015/08/B6khRl5lnreCE5e6cLKlHKrlgENNNJ.jpg','1','1440317644'),
('48','2','1','144014661666148616.jpg','/images/2/2015/08/Q0OBqqo55DAax7EVaxdMBq70855AVO.jpg','1','1440317667'),
('49','2','1','维航.jpg','/images/2/2015/08/sJScSZ8ZeTwIESii09t8z8iASJw99I.jpg','1','1440344826');


DROP TABLE IF EXISTS ims_basic_reply;
CREATE TABLE `ims_basic_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `content` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_basic_reply VALUES 
('1','1','这里是默认文字回复');


DROP TABLE IF EXISTS ims_bigwheel_award;
CREATE TABLE `ims_bigwheel_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `fansID` int(11) DEFAULT '0',
  `from_user` varchar(50) DEFAULT '0' COMMENT '用户ID',
  `name` varchar(50) DEFAULT '' COMMENT '名称',
  `description` varchar(200) DEFAULT '' COMMENT '描述',
  `prizetype` varchar(10) DEFAULT '' COMMENT '类型',
  `award_sn` varchar(50) DEFAULT '' COMMENT 'SN',
  `createtime` int(10) DEFAULT '0',
  `consumetime` int(10) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_weid` (`weid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bigwheel_fans;
CREATE TABLE `ims_bigwheel_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT '0',
  `fansID` int(11) DEFAULT '0',
  `from_user` varchar(50) DEFAULT '' COMMENT '用户ID',
  `tel` varchar(20) DEFAULT '' COMMENT '登记信息(手机等)',
  `todaynum` int(11) DEFAULT '0',
  `totalnum` int(11) DEFAULT '0',
  `awardnum` int(11) DEFAULT '0',
  `last_time` int(10) DEFAULT '0',
  `createtime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ims_bigwheel_fans VALUES 
('1','5','7','oPnnXjhhhk4MrPgUXTR5siiOPlnQ','','1','1','0','1440000000','1440058921'),
('2','5','21','oPnnXjonpPspUJsxW2gtwThKI9DY','','1','1','0','1440172800','1440180016'),
('3','5','28','oPnnXjql-zgFLwtn09YOtd4yPzVA','','0','0','0','0','1440316949'),
('4','5','31','oPnnXjjY8t4RCQ5qWqfWegcZpJG0','','1','1','0','1440259200','1440338262'),
('5','5','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','','0','0','0','0','1440344310'),
('6','5','34','oPnnXjhLl4j6Fn19b337JYe1pGgg','','1','1','0','1440345600','1440408555');


DROP TABLE IF EXISTS ims_bigwheel_reply;
CREATE TABLE `ims_bigwheel_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0',
  `weid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `content` varchar(200) DEFAULT '',
  `start_picurl` varchar(200) DEFAULT '',
  `isshow` tinyint(1) DEFAULT '0',
  `ticket_information` varchar(200) DEFAULT '',
  `starttime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `repeat_lottery_reply` varchar(50) DEFAULT '',
  `end_theme` varchar(50) DEFAULT '',
  `end_instruction` varchar(200) DEFAULT '',
  `end_picurl` varchar(200) DEFAULT '',
  `c_type_one` varchar(20) DEFAULT '',
  `c_name_one` varchar(50) DEFAULT '',
  `c_num_one` int(11) DEFAULT '0',
  `c_draw_one` int(11) DEFAULT '0',
  `c_rate_one` double DEFAULT '0',
  `c_type_two` varchar(20) DEFAULT '',
  `c_name_two` varchar(50) DEFAULT '',
  `c_num_two` int(11) DEFAULT '0',
  `c_draw_two` int(11) DEFAULT '0',
  `c_rate_two` double DEFAULT '0',
  `c_type_three` varchar(20) DEFAULT '',
  `c_name_three` varchar(50) DEFAULT '',
  `c_num_three` int(11) DEFAULT '0',
  `c_draw_three` int(11) DEFAULT '0',
  `c_rate_three` double DEFAULT '0',
  `c_type_four` varchar(20) DEFAULT '',
  `c_name_four` varchar(50) DEFAULT '',
  `c_num_four` int(11) DEFAULT '0',
  `c_draw_four` int(11) DEFAULT '0',
  `c_rate_four` double DEFAULT '0',
  `c_type_five` varchar(20) DEFAULT '',
  `c_name_five` varchar(50) DEFAULT '',
  `c_num_five` int(11) DEFAULT '0',
  `c_draw_five` int(11) DEFAULT '0',
  `c_rate_five` double DEFAULT '0',
  `c_type_six` varchar(20) DEFAULT '',
  `c_name_six` varchar(50) DEFAULT '',
  `c_num_six` int(11) DEFAULT '0',
  `c_draw_six` int(10) DEFAULT '0',
  `c_rate_six` double DEFAULT '0',
  `total_num` int(11) DEFAULT '0' COMMENT '总获奖人数(自动加)',
  `probability` double DEFAULT '0',
  `award_times` int(11) DEFAULT '0',
  `number_times` int(11) DEFAULT '0',
  `most_num_times` int(11) DEFAULT '0',
  `sn_code` tinyint(4) DEFAULT '0',
  `sn_rename` varchar(20) DEFAULT '',
  `tel_rename` varchar(20) DEFAULT '',
  `copyright` varchar(20) DEFAULT '',
  `show_num` tinyint(2) DEFAULT '0',
  `viewnum` int(11) DEFAULT '0',
  `fansnum` int(11) DEFAULT '0',
  `createtime` int(10) DEFAULT '0',
  `share_title` varchar(200) DEFAULT '',
  `share_desc` varchar(300) DEFAULT '',
  `share_url` varchar(100) DEFAULT '',
  `share_txt` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_weid` (`weid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_bigwheel_reply VALUES 
('1','5','2','幸运大转盘活动开始了!','欢迎参加幸运大转盘活动','','./source/modules/bigwheel/template/style/activity-lottery-start.jpg','1','兑奖请联系我们,电话: 13888888888','1440038400','1476355080','亲，继续努力哦~~','幸运大转盘活动已经结束了','亲，活动已经结束，请继续关注我们的后续活动哦~','./source/modules/bigwheel/template/style/activity-lottery-end.jpg','一等奖','苹果手机','1','0','1','二等奖','三星手机','20','0','2','三等奖','华为手机','30','0','3','','','0','0','0','','','0','0','0','','','0','0','0','51','0','1','1','1','0','SN码','手机号','','1','12','6','1440038491','欢迎参加大转盘活动','亲，欢迎参加大转盘抽奖活动，祝您好运哦！！ 亲，需要绑定账号才可以参加哦','','&lt;p&gt;1. 关注微信公众账号&quot;()&quot;&lt;/p&gt;&lt;p&gt;2. 发送消息&quot;大转盘&quot;, 点击返回的消息即可参加&lt;/p&gt;');


DROP TABLE IF EXISTS ims_bj_qmxk_address;
CREATE TABLE `ims_bj_qmxk_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_address VALUES 
('1','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','赵','13926128888','广东省','广州市','从化市','生生世世爱','1','0'),
('2','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','卢孙荣','13851734013','北京市','北京辖区','东城区','测试号','1','0');


DROP TABLE IF EXISTS ims_bj_qmxk_adv;
CREATE TABLE `ims_bj_qmxk_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_enabled` (`enabled`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_adv VALUES 
('1','2','','','images/2/2015/08/BxAolYKkxXoRzakzX7RkZxNkXmkokk.jpg','0','1'),
('2','2','','','images/2/2015/08/B6khRl5lnreCE5e6cLKlHKrlgENNNJ.jpg','0','1'),
('3','2','','','images/2/2015/08/PglOUTG34cW4u57ogH6u60Hv3oz5t5.jpg','0','1'),
('4','2','','','images/2/2015/08/Q0OBqqo55DAax7EVaxdMBq70855AVO.jpg','3','1');


DROP TABLE IF EXISTS ims_bj_qmxk_cart;
CREATE TABLE `ims_bj_qmxk_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `goodsid` int(11) NOT NULL,
  `goodstype` tinyint(1) NOT NULL DEFAULT '1',
  `from_user` varchar(50) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `optionid` int(10) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_openid` (`from_user`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_cart VALUES 
('3','2','5','0','oPnnXjlsjyg3h7lSgKSXkKb-9EEc','1','0','3200.00');


DROP TABLE IF EXISTS ims_bj_qmxk_category;
CREATE TABLE `ims_bj_qmxk_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `commission` int(10) unsigned DEFAULT '0' COMMENT '推荐该类商品所能获得的佣金',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) NOT NULL COMMENT '分类介绍',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `sn` varchar(30) DEFAULT '' COMMENT '分类编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_category VALUES 
('3','2','0','手机','','2','1','','0','1',''),
('2','2','0','手机','','0','1','','0','1',''),
('4','2','0','手机配件','','2','1','手机配件','0','1',''),
('5','2','0','电脑','','0','1','','0','1',''),
('6','2','0','电脑整机','','5','1','电脑整机','0','1',''),
('7','2','0','平板电脑','','5','1','平板电脑','0','1',''),
('8','2','0','电器','','0','1','','0','1',''),
('9','2','0','空调','','8','1','空调','0','1',''),
('10','2','0','电视','','8','1','电视','0','1',''),
('11','2','0','冰箱','','8','1','冰箱','0','1','');


DROP TABLE IF EXISTS ims_bj_qmxk_channel;
CREATE TABLE `ims_bj_qmxk_channel` (
  `channel` int(10) NOT NULL AUTO_INCREMENT,
  `active` int(10) unsigned NOT NULL DEFAULT '0',
  `bg` varchar(1024) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `bgparam` varchar(10240) NOT NULL,
  `notice` varchar(1024) NOT NULL,
  `click_credit` int(10) NOT NULL COMMENT '未关注的用户关注,送分享者积分',
  `sub_click_credit` int(10) NOT NULL COMMENT '未关注的用户关注,送上线积分',
  `newbie_credit` int(10) NOT NULL COMMENT '通过本渠道关注微信号，送新用户大礼包积分',
  `weid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `msgtype` int(10) unsigned NOT NULL DEFAULT '1',
  `isdel` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`channel`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_channel VALUES 
('1','1','images/2/2015/08/U1S0pFML1sl25G4fGp5P1l25l5gEP0.jpg','维航微商城','a:14:{s:6:\"qrleft\";i:145;s:5:\"qrtop\";i:385;s:7:\"qrwidth\";i:240;s:8:\"qrheight\";i:240;s:10:\"avatarleft\";i:90;s:9:\"avatartop\";i:28;s:11:\"avatarwidth\";i:86;s:12:\"avatarheight\";i:86;s:12:\"avatarenable\";i:1;s:8:\"nameleft\";i:230;s:7:\"nametop\";i:40;s:8:\"namesize\";i:20;s:9:\"namecolor\";i:0;s:10:\"nameenable\";i:1;}','','0','0','0','2','1440039591','2','0');


DROP TABLE IF EXISTS ims_bj_qmxk_commission;
CREATE TABLE `ims_bj_qmxk_commission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '粉丝ID',
  `ogid` int(10) unsigned DEFAULT NULL COMMENT '订单商品ID',
  `commission` decimal(10,2) unsigned NOT NULL COMMENT '佣金',
  `content` text,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为账户充值记录，1为提现记录',
  `isout` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为未导出，1为已导出',
  `isshare` int(11) DEFAULT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_credit_award;
CREATE TABLE `ims_bj_qmxk_credit_award` (
  `award_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `deadline` datetime NOT NULL,
  `credit_cost` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '100',
  `content` text NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_credit_award VALUES 
('2','2','御泥坊补水亮颜蚕丝面膜贴14片 补水保湿亮肤正品','images/2/2015/08/dOQk3ovCHMsaT58XCDXOvcXq33sWVt.jpg','10','2015-11-28 23:55:00','20','208','&lt;p&gt;&lt;img src=&quot;./resource/attachment/images/2/2015/08/qCO2p233Cp2X2EA42c523DDuGouX4G.jpg&quot; style=&quot;float:none;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;./resource/attachment/images/2/2015/08/rjLPJVjKvQKr9dQlVpJrdeSCjrjp1j.jpg&quot; style=&quot;float:none;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;./resource/attachment/images/2/2015/08/lVwAwJTQgBsa5ttmeWzybetSu0QXUB.jpg&quot; style=&quot;float:none;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','1440061708');


DROP TABLE IF EXISTS ims_bj_qmxk_credit_order;
CREATE TABLE `ims_bj_qmxk_credit_order` (
  `createtime` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `fee` decimal(10,2) NOT NULL,
  `transid` varchar(30) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `weid` int(11) NOT NULL,
  `crid` varchar(32) NOT NULL,
  PRIMARY KEY (`crid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_credit_order VALUES 
('1440349820','0','100.00','','oPnnXjtKc-3bI8s48GyRP6v74k0o','2','tr201508240110200676');


DROP TABLE IF EXISTS ims_bj_qmxk_credit_request;
CREATE TABLE `ims_bj_qmxk_credit_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `award_id` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_dispatch;
CREATE TABLE `ims_bj_qmxk_dispatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `dispatchname` varchar(50) DEFAULT '',
  `dispatchtype` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `firstprice` decimal(10,2) DEFAULT '0.00',
  `secondprice` decimal(10,2) DEFAULT '0.00',
  `firstweight` int(11) DEFAULT '0',
  `secondweight` int(11) DEFAULT '0',
  `express` int(11) DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_dispatch VALUES 
('1','2','微信支付','1','1','10.00','10.00','1000','1000','0',''),
('3','2','余额支付','3','2','10.00','10.00','1000','1000','0',''),
('4','2','货到付款','0','3','20.00','10.00','1000','1000','0','');


DROP TABLE IF EXISTS ims_bj_qmxk_express;
CREATE TABLE `ims_bj_qmxk_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `express_name` varchar(50) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `express_price` varchar(10) DEFAULT '',
  `express_area` varchar(100) DEFAULT '',
  `express_url` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_express VALUES 
('1','2','顺丰','0','','','shunfeng');


DROP TABLE IF EXISTS ims_bj_qmxk_feedback;
CREATE TABLE `ims_bj_qmxk_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为维权，2为告擎',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态0未解决，1用户同意，2用户拒绝',
  `feedbackid` varchar(30) NOT NULL COMMENT '投诉单号',
  `transid` varchar(30) NOT NULL COMMENT '订单号',
  `reason` varchar(1000) NOT NULL COMMENT '理由',
  `solution` varchar(1000) NOT NULL COMMENT '期待解决方案',
  `remark` varchar(1000) NOT NULL COMMENT '备注',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_weid` (`weid`),
  KEY `idx_feedbackid` (`feedbackid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_transid` (`transid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_follow;
CREATE TABLE `ims_bj_qmxk_follow` (
  `weid` int(10) unsigned NOT NULL,
  `leader` varchar(100) NOT NULL,
  `follower` varchar(100) NOT NULL,
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `credit` int(10) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`weid`,`leader`,`follower`,`channel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_follow VALUES 
('2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0','1440040912'),
('2','oPnnXjvuz5TdSdIVzR6spVlE3OwM','oPnnXjvuz5TdSdIVzR6spVlE3OwM','0','0','1440235081'),
('2','oPnnXjqA3s3HnRXLCcZB0jDQ2D8k','oPnnXjqA3s3HnRXLCcZB0jDQ2D8k','0','0','1440321838'),
('2','oPnnXjtKc-3bI8s48GyRP6v74k0o','oPnnXjtKc-3bI8s48GyRP6v74k0o','0','0','1440349944');


DROP TABLE IF EXISTS ims_bj_qmxk_goods;
CREATE TABLE `ims_bj_qmxk_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL DEFAULT '0',
  `ccate` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为实体，2为虚拟',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `xsthumb` varchar(255) DEFAULT '',
  `unit` varchar(5) NOT NULL DEFAULT '',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `goodssn` varchar(50) NOT NULL DEFAULT '',
  `productsn` varchar(50) NOT NULL DEFAULT '',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `costprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` int(10) NOT NULL DEFAULT '0',
  `totalcnf` int(11) DEFAULT '0' COMMENT '0 拍下减库存 1 付款减库存 2 永久不减',
  `sales` int(10) unsigned NOT NULL DEFAULT '0',
  `spec` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit` int(11) DEFAULT '0',
  `maxbuy` int(11) DEFAULT '0',
  `hasoption` int(11) DEFAULT '0',
  `dispatch` int(11) DEFAULT '0',
  `thumb_url` text,
  `isnew` int(11) DEFAULT '0',
  `ishot` int(11) DEFAULT '0',
  `issendfree` int(11) DEFAULT '0',
  `isdiscount` int(11) DEFAULT '0',
  `isrecommand` int(11) DEFAULT '0',
  `istime` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `viewcount` int(11) DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `commission2` int(3) DEFAULT NULL,
  `commission3` int(3) DEFAULT NULL,
  `commission` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_goods VALUES 
('1','2','1','0','0','1','0','联想电脑','images/2015/08/fkA8LA9cB08ebegbA0Qt6BbKkT3baA.jpg','images/2015/08/KSs80Isz7Te6gGZ4tZyX3T7eV9m9I3.jpg','','','<p>这里是联想电脑</p>','','','5000.00','5600.00','0.00','98','1','2','','1440037482','0.00','5','0','0','0','N;','0','0','1','0','1','0','1440037320','1440037320','3','1','5','3','10'),
('2','2','2','3','0','1','0','苹果（Apple）iPhone 6 （16G）（金）（全网通）移动联通电信4G手机','images/2015/08/ZBY8yl1E8H51ep71pprXrjb7J56y8S.jpg','images/2015/08/lftF9j930e0t386GfB03mz369M0B99.jpg','','品牌：苹果型号：iPhone6上市时间：2014年10月颜色：金色手机操作系统：IOS手机制式：多模(TD-LTE+FDD-LTE+WCDMA/GSM+CDMA2000/CDMA)屏幕尺寸：4.7英寸摄像头像素：800万像素','<table class=\"pro-para-tbl\" width=\"747\" style=\"width: 489px;\"><tbody><tr class=\"firstRow\"><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">包裹清单</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\">包裹清单</td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">iPhone 6×1、具有线控功能和麦克风的 Apple EarPods×1、Lightning to USB 连接线×1、USB 电源适配器×1、保修卡×1</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr></tbody></table><table id=\"itemParameter\" class=\"pro-para-tbl\" width=\"747\" style=\"width: 489px;\"><tbody><tr class=\"firstRow\"><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">基本参数</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">品牌</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">苹果</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">型号</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">iPhone6</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">上市时间</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">2014年10月</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">外观样式</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">直板</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">颜色</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">金色</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">智能机</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">是</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">系统版本</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">iOS 8.0</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">CPU型号</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">64 位架构的 A8 芯片，M8 运动协处理器</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">手机操控方式</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">电容触摸屏</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">手机操作系统</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">IOS</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">SIM卡尺寸</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">Nano SIM卡</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">视频通话</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">支持</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">网络</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">4G网络制式</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">移动4G(TD-LTE),联通4G(TD-LTE),移动4G(TD-LTE),联通4G（FDD-LTE）,电信4G（FDD-LTE）</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">3G网络制式</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">电信3G(CDMA2000),移动3G(TD-SCDMA),电信3G(CDMA2000),联通3G（WCDMA）</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">2G网络制式</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">电信2G（CDMA）,移动2G/联通2G(GSM)</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">手机制式</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">多模(TD-LTE+FDD-LTE+WCDMA/GSM+CDMA2000/CDMA)</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">网络频率</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">FDD-LTE/TD-LTE/WCDMA/TD-SCDMA/CDMA2000/GSM</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">存储功能</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">机身内存</span>&nbsp;</p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">16GB</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">屏幕显示</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">屏幕尺寸</span>&nbsp;</p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">4.7英寸</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">屏幕分辨率</span>&nbsp;</p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">1334×750</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">陀螺仪</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">支持</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">拍照摄像</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">摄像头像素</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">800万像素</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">闪光灯类型</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">支持</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">传感器类型</span>&nbsp;</p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">CMOS</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">其他</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">电池更换</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">不支持</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">外形尺寸</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">138.1*67.*6.9毫米</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">重量</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">129克</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">耳机接口</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">3.5mm</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">数据线</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">Lightning</td><td class=\"err hover\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr></tbody></table><p><br/></p>','','','4688.00','7688.00','0.00','9995','1','5','','1440050405','0.00','0','0','1','0','a:4:{i:0;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/LK1Vk8gVNjk0yJkllgg81GJYyby88G.jpg\";}i:1;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/ErdNR522DCwW5Wqdm3U3RNyyMl33Qd.jpg\";}i:2;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/Mh5ukRbHEjGGRGmGH5jAxUAJe8jKAJ.jpg\";}i:3;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/VoDbh7D76W9BzMM7gBJ2fqJgObMVfV.jpg\";}}','0','0','1','0','1','0','1440049980','1440049980','15','0','0','0','0'),
('3','2','2','3','0','1','0','三星 Galaxy S6（G9200）32G版 铂光金 全网通4G手机 双卡双待','images/2015/08/fvp0fdbfNczqPhPp0jpcROpFbQZ5v0.jpg','images/2015/08/VDhDbYT4583w77bLIwUdi6rl733RBY.jpg','','','<p><br/></p><p><br/></p><p><br/></p><p><img src=\"./resource/attachment/images/2/2015/08/Au8M8uaYHiB6N4zN4MP6hOPh48x4hB.jpg\" style=\"float: none; width: 499px; height: 741px;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/R4e0464TT2mGZE4P4E8uA48S6CrtrA.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/myDGtQITRo6iDz6oM1WmRm1CivqCsm.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/peA44my2CjTs1mKLtgy2S4kZLKsymY.jpg\" style=\"float:none;\"/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p>','','','3500.00','4000.00','0.00','8888','1','0','','1440050956','0.00','2','0','1','0','a:3:{i:0;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/S9w21JxuHAxdZDf2DevWWeXsFfwaGa.jpg\";}i:1;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/gfgS0O2sIHJhC22Wqjg2uSicIFSPoO.jpg\";}i:2;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/yCNB7ibXdxcSWIqnR9xPimPXTBTpn2.jpg\";}}','0','0','1','0','1','1','1440050460','1447408800','6','0','5','3','10'),
('4','2','2','4','0','1','0','友多闻(Youwin) UDN7 无线蓝牙音箱 威武小钢炮(红色) 苹果三星小米手机车载电脑MP3播放器 插卡便携户外音响 收音机','images/2015/08/CgOhJeOO9oZsvORoRATklew5KTW64H.jpg','images/2015/08/jXExkWjTJEHCN35EiE9se5tjs3E3nE.jpg','','','<table class=\"pro-para-tbl\" width=\"747\" style=\"width: 489px;\"><tbody><tr class=\"firstRow\"><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">包裹清单</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\">包裹清单</td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">友多闻(Youwin) 无线蓝牙音箱 UDN7威武小钢炮(红色)x1、充电线x1、说明书x1、保修卡x1、合格证x1</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr></tbody></table><p><br/></p><table id=\"itemParameter\" class=\"pro-para-tbl\" width=\"747\" style=\"width: 489px;\"><tbody><tr class=\"firstRow\"><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">基本参数</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">品牌</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">友多闻(Youwin)</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">产品类型</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">手机配件套装</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">产品组合</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">无线蓝牙音箱</td><td class=\"err\" style=\"margin: 0px; padding: 3px 20px 3px 5px; border-left-width: 0px; color: rgb(102, 102, 102); text-align: right;\"><br/></td></tr><tr><th colspan=\"3\" style=\"margin: 0px; padding: 0px; height: 30px; background-color: rgb(240, 240, 240); vertical-align: middle; text-indent: 5px;\">规格参数</th></tr><tr><td class=\"name\" style=\"margin: 0px; padding: 3px 5px; color: rgb(102, 102, 102);\" width=\"176\"><p><span style=\"margin: 0px; padding: 0px; vertical-align: middle;\">重量</span></p></td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\">230克</td><td class=\"val\" style=\"margin: 0px; padding: 3px 5px; border-right-width: 0px; color: rgb(102, 102, 102); line-height: 24px;\" width=\"456\"><br/></td></tr></tbody></table><p><br/></p><p><br/></p><p><img src=\"./resource/attachment/images/2/2015/08/rP887PVvm9o8n8V5clxZpTvD989Mpn.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/R9ps51sJDOrfELZZ6d1yF9E5Cs11cj.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/Df3Dd1DV74v1MDLlGrLVgV3vZ7KVdm.jpg\" style=\"float:none;\"/></p><p><br/></p>','','','50.00','150.00','0.00','2991','1','6','','1440051408','0.00','2','0','1','0','a:5:{i:0;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/GF4F5cfv8VBBRq8GvofTbB2CfORfAS.jpg\";}i:1;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/imj7ErM8El86zJcNz7a882RlCMaLnf.jpg\";}i:2;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/lzAS74RS0x4ch7FSXR4CcAFbFsxA6f.jpg\";}i:3;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/B1E5ACepYn1VfYn1bYzn1efYVemTeI.jpg\";}i:4;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/nb0ChGGGq2znunrHRaBHCv2dqdfOB3.jpg\";}}','0','0','1','0','1','0','1440051120','1440051120','8','1','0','0','0'),
('5','2','5','7','0','1','0','Apple iPad Air 银色 32G WLAN版 9.7英寸平板电脑 MD789CH/B','images/2015/08/TSXS858k55Z5StZdw49p48TyPSpFK8.jpg','images/2015/08/I3b3P0ffs4ee2m4REumR4EebESewKU.jpg','','','<ul class=\"cnt clearfix list-paddingleft-2\" style=\"list-style-type: none;\"><li><p><span style=\"margin: 0px; padding: 0px;\">品牌：<a href=\"http://www.suning.com/pinpai/8759-0-0.html\" target=\"_blank\" style=\"color: rgb(51, 51, 51); text-decoration: none; outline: 0px; margin: 0px; padding: 0px;\">Apple</a></span></p></li><li><p>商品名称：Apple iPad Air MD789CH/B WiFi版 9.7英寸平板电脑 32G 银色</p></li><li><p>型号：Apple iPad Air MD789CH/B WiFi版 9.7英寸平板电脑 32G 银色</p></li><li><p>存储容量：32GB</p></li><li><p>核心：双核心</p></li><li><p>系统内存：1GB</p></li><li><p>屏幕尺寸：9.7英寸</p></li><li><p>屏幕分辨率：2048×1536</p></li></ul><p><img src=\"./resource/attachment/images/2/2015/08/zBW2nCnCMjzpM84cIew8r8cWVEegnc.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/gmQUUtlptPV7lzLAmpbU2mT66DTmLM.jpg\" style=\"float:none;\"/></p><p><br/></p>','','','3200.00','4800.00','0.00','9998','0','1','','1440052086','0.00','5','0','0','0','N;','0','0','0','0','1','1','1440051840','1451112600','10','0','0','0','0'),
('6','2','8','9','0','1','0','奥克斯(AUX) KFR-26GW/BPF02B+3（纯铜管） 1匹家用 挂壁式冷暖变频空调','images/2015/08/j8S00AEVNh8zea8bl8EQ7qb458zP8g.jpg','images/2015/08/hFohhZgh7gl4Ee3Zg43JazzpClCJcL.jpg','','','<p><img src=\"./resource/attachment/images/2/2015/08/hOY694o1u3ULRY82Uz95Wu8OOor22O.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/wHgo094g5gO6KGxeYEowyK5w4W1505.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/Pma1m54F558fy5UMlE531gaMaMA36F.jpg\" style=\"float:none;\"/></p><p><br/></p>','','','2099.00','2799.00','0.00','886','1','2','','1440052505','0.00','0','0','0','0','a:4:{i:0;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/RitwTIJ1Q0iNc7jOxWeiI0NwTT18I1.jpg\";}i:1;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/cT7JCsqSFzc71cXaos6tC8fTQMF8Z7.jpg\";}i:2;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/yrRuqRK86S6rWsZYq4qCrxKcQS24Xz.jpg\";}i:3;a:1:{s:10:\"attachment\";s:51:\"/images//2015/08/UoCC51x1O5kGkqknRKuWRByNRWeSYC.jpg\";}}','0','0','1','0','1','0','1440052200','1440052200','6','0','0','0','0'),
('7','2','5','6','0','1','0','联想(Lenovo) G40-70 14英寸 笔记本(I5-4200U 4G 500G 2G 独显 DOS 黑色)','images/2015/08/H0q1rqS4Tqb0z24Hr0rBHnQ2QgA3Ng.jpg','images/2015/08/q3CZ7Q5iXQ7NesP1FmMfq1S31Xxepe.jpg','','','<p><img src=\"./resource/attachment/images/2/2015/08/l2iC23DOCCZDb6Qd2Q913o7z49id4C.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/c0H24lCD2Dmd21LH4M1lT0MCo2TZ1O.jpg\" style=\"float:none;\"/></p><p><img src=\"./resource/attachment/images/2/2015/08/hYrODDhrR4TL1lLOOlI9ghoL3YH9dO.jpg\" style=\"float:none;\"/></p><p><br/></p>','','','3500.00','4500.00','0.00','499','1','1','','1440052772','0.00','0','0','0','0','N;','0','0','1','0','1','0','1440052560','1440052560','9','0','0','0','0');


DROP TABLE IF EXISTS ims_bj_qmxk_goods_option;
CREATE TABLE `ims_bj_qmxk_goods_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_goods_option VALUES 
('1','2','白色','','6588.00','4688.00','0.00','4999','0.00','0','2'),
('2','2','金色','','6588.00','4688.00','0.00','4996','0.00','0','1'),
('3','3','','','0.00','0.00','0.00','0','0.00','0',''),
('4','4','白色','','200.00','60.00','50.00','998','0.00','0','5'),
('5','4','红色','','200.00','80.00','50.00','997','0.00','0','3'),
('6','4','蓝色','','200.00','100.00','50.00','996','0.00','0','4');


DROP TABLE IF EXISTS ims_bj_qmxk_goods_param;
CREATE TABLE `ims_bj_qmxk_goods_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `value` text,
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_member;
CREATE TABLE `ims_bj_qmxk_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `shareid` int(11) DEFAULT NULL,
  `from_user` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `bankcard` varchar(20) DEFAULT NULL,
  `banktype` varchar(20) DEFAULT NULL,
  `alipay` varchar(100) DEFAULT NULL,
  `wxhao` varchar(100) DEFAULT NULL,
  `commission` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '已结佣佣金',
  `zhifu` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '已打款佣金',
  `content` text,
  `createtime` int(10) NOT NULL,
  `flagtime` int(10) DEFAULT NULL COMMENT '为成推广人的时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '0为禁用，1为可用',
  `flag` tinyint(1) DEFAULT '0' COMMENT '0为会推广人，1为推广人',
  `clickcount` int(11) NOT NULL DEFAULT '0' COMMENT '点击次数',
  `dzdflag` tinyint(3) DEFAULT '0' COMMENT '店中店开启',
  `dzdtitle` varchar(100) DEFAULT '' COMMENT '店中店名称',
  `dzdsendtext` varchar(100) DEFAULT '' COMMENT '店中店转发话术',
  `credit2` double DEFAULT '0' COMMENT '余额',
  PRIMARY KEY (`id`),
  KEY `idx_member_from_user` (`from_user`),
  KEY `idx_weid` (`weid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_member VALUES 
('1','2','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','快乐每一天，军','13926000000','','','','','','0.00','0.00','','1440037295','1440039899','1','1','1','1','快乐小店','亲，欢迎来的快乐小店','991123'),
('2','2','0','oPnnXjtKc-3bI8s48GyRP6v74k0o','卢孙荣','','','','','','','0.00','0.00','','1440039412','1440164921','1','1','0','0','','','0'),
('3','2','0','oPnnXjgdCoOh7n2LZ-X474y26KSY',' 奇迹梦想','','','','','','','0.00','0.00','','1440040377','1440040377','1','1','0','0','','','0'),
('4','2','0','oPnnXjhhhk4MrPgUXTR5siiOPlnQ','King®阿晓','','','','','','','0.00','0.00','','1440058542','1440058542','1','1','0','0','','','0'),
('5','2','1','oPnnXjh_GFV00mqGnvv9yO54QADk','靖文-维航分销','','','','','','','0.00','0.00','','1440063199','1440063199','1','1','0','0','','','0'),
('6','2','0','oPnnXjkPiHEE6KL9tKufj3oNKPhY','沐言','','','','','','','0.00','0.00','','1440069429','1440069429','1','1','0','0','','','0'),
('7','2','0','oPnnXjnVqYN0KGlcjNae5XTclQBM','版哥','','','','','','','0.00','0.00','','1440074179','1440074179','1','1','0','0','','','0'),
('8','2','0','oPnnXjgbk7XpFnG9WhFcjEFFKnZU','森然互联','','','','','','','0.00','0.00','','1440082492','1440082492','1','1','0','0','','','0'),
('9','2','0','oPnnXju7fxC-Rj5_Z24LgVCaLm7M','奋斗！','','','','','','','0.00','0.00','','1440128688','1440128688','1','1','0','0','','','0'),
('10','2','0','oPnnXjhkAGtJwxO7ueFOOU3cpV2E','晓锋 ','','','','','','','0.00','0.00','','1440143205','1440143205','1','1','0','0','','','0'),
('11','2','0','oPnnXju6zatMpfHEToDH_WRaPrh4','吉米','','','','','','','0.00','0.00','','1440145993','1440145993','1','1','0','0','','','0'),
('12','2','0','oPnnXjmU7eMIRU06C47MbAQAu5Uw','LEEOK','','','','','','','0.00','0.00','','1440155396','1440155396','1','1','0','0','','','0'),
('13','2','0','oPnnXjiLY72Hmeb8YiYhZLY68Co8','蒋承智公众号w593hy','','','','','','','0.00','0.00','','1440160550','1440160550','1','1','0','0','','','0'),
('14','2','0','oPnnXjvuz5TdSdIVzR6spVlE3OwM','a','','','','','','','0.00','0.00','','1440166883','1440166883','1','1','0','0','','','0'),
('15','2','0','oPnnXjonpPspUJsxW2gtwThKI9DY','小哲','','','','','','','0.00','0.00','','1440179712','1440179712','1','1','0','0','','','0'),
('16','2','0','oPnnXjgouwhXE5Ud-KFF6JKV19Y0','、屹','','','','','','','0.00','0.00','','1440186043','1440186043','1','1','0','0','','','0'),
('17','2','0','oPnnXjrp3GLg3udsS117agP_nrXE','黄5','','','','','','','0.00','0.00','','1440197803','1440197803','1','1','0','0','','','0'),
('18','2','0','oPnnXjsIy2j_xiYU3WcHuVhV3CFU','阳光总在风雨后~','','','','','','','0.00','0.00','','1440216949','1440216949','1','1','0','0','','','0'),
('19','2','0','oPnnXjlsjyg3h7lSgKSXkKb-9EEc','欧阳','','','','','','','0.00','0.00','','1440224675','1440224675','1','1','0','0','','','0'),
('20','2','0','oPnnXjnViF9dbsX7-4OWYEHS76kc','合肥360度全景','','','','','','','0.00','0.00','','1440259089','1440259089','1','1','0','0','','','0'),
('21','2','0','oPnnXjql-zgFLwtn09YOtd4yPzVA','HunterX','','','','','','','0.00','0.00','','1440316928','1440316928','1','1','0','0','','','0'),
('22','2','0','oPnnXjqA3s3HnRXLCcZB0jDQ2D8k','万兆亿✈微商运营','','','','','','','0.00','0.00','','1440321779','1440321779','1','1','0','0','','','0'),
('23','2','0','oPnnXjjY8t4RCQ5qWqfWegcZpJG0','赵玉广','','','','','','','0.00','0.00','','1440338139','1440338139','1','1','0','0','','','0'),
('24','2','0','oPnnXjlH6wpyvF_5_Bu-33L9-XZg','草莓奥特曼','','','','','','','0.00','0.00','','1440403096','1440403096','1','1','0','0','','','0'),
('25','2','0','oPnnXjhLl4j6Fn19b337JYe1pGgg','蔡黄建','','','','','','','0.00','0.00','','1440408481','1440408481','1','1','0','0','','','0'),
('26','2','0','oPnnXjrDFBRz8VGcEUkNFYt1aLe0','洞信','','','','','','','0.00','0.00','','1440417412','1440417412','1','1','0','0','','','0'),
('27','2','0','oPnnXjrW36hLtPAufYMiCNU18c5U','台湾实戰移商學院 林院长','','','','','','','0.00','0.00','','1440459376','1440459376','1','1','0','0','','','0');


DROP TABLE IF EXISTS ims_bj_qmxk_msg_template;
CREATE TABLE `ims_bj_qmxk_msg_template` (
  `weid` int(10) NOT NULL,
  `template` varchar(5000) NOT NULL,
  `tkey` varchar(10) NOT NULL,
  `tenable` tinyint(4) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_msg_template VALUES 
('2','尊敬的阁下，您的下级会员{agent_name}在{time}购买了订单编号为：{order_sn}，订单金额：{order_price}的商品','gmsptz','1','8'),
('2','尊敬的阁下，你的下级：{agent_name}通过分享关注，关注了您，关注时间：{time}','tjrtz','1','9'),
('2','尊敬的阁下，你的下级：{agent_name}通过二维码关注，关注了您，关注时间：{time}','tjrtzewm','1','10'),
('2','尊敬的阁下，你的下级：{agent_name}申请代理时间：{time}已申请成功！','tjrtzdl','1','11'),
('2','尊敬的阁下，您的下级{agent_name}在{time}确认收货，\r\n订单编号为：{order_sn}，订单金额：{order_price}的商品','xjdlshtz','1','12'),
('2','尊敬的阁下，您的下级{agent_name}在{time}申请佣金','yjsqtz','1','13'),
('2','尊敬的阁下，商家已在：{time}时按：{agent_level}打款，打款金额为：{agent_money}','sjytktz','1','14');


DROP TABLE IF EXISTS ims_bj_qmxk_order;
CREATE TABLE `ims_bj_qmxk_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `shareid` int(10) unsigned DEFAULT '0' COMMENT '推荐人ID',
  `ordersn` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '-1取消状态，0普通状态，1为已付款，2为已发货，3为成功',
  `sendtype` tinyint(1) unsigned NOT NULL COMMENT '1为快递，2为自提',
  `paytype` tinyint(1) unsigned NOT NULL COMMENT '1为余额，2为在线，3为到付',
  `transid` varchar(30) NOT NULL DEFAULT '0' COMMENT '微信支付单号',
  `goodstype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(1000) NOT NULL DEFAULT '',
  `addressid` int(10) unsigned NOT NULL,
  `expresscom` varchar(30) NOT NULL DEFAULT '',
  `expresssn` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(200) NOT NULL DEFAULT '',
  `goodsprice` decimal(10,2) DEFAULT '0.00',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatch` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) DEFAULT '0' COMMENT '订单更新时间',
  `shareid2` int(10) DEFAULT '0' COMMENT '2级代理id',
  `shareid3` int(10) DEFAULT '0' COMMENT '3级代理id',
  `isrest` tinyint(1) DEFAULT '0' COMMENT '是否发生换货操作',
  `rsreson` varchar(500) DEFAULT '' COMMENT '退货款退原因',
  `sendtime` int(10) NOT NULL DEFAULT '0' COMMENT '发货时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_order VALUES 
('1','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820412409','5000','3','1','2','0','0','','1','','256556','shunfeng','5000.00','0.00','1','1440037551','1440053990','0','0','0','','1440053915'),
('2','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','0','0820946945','5000','-1','1','2','0','0','','2','','','','5000.00','0.00','1','1440039459','0','0','0','0','','0'),
('3','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820848885','100','-1','1','2','0','0','','1','','','','100.00','0.00','1','1440058046','0','0','0','0','','0'),
('4','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820622822','100','-1','3','1','0','0','','1','','','','100.00','0.00','3','1440058181','0','0','0','0','','0'),
('5','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820207606','80','-1','1','2','0','0','','1','','','','80.00','0.00','1','1440058217','0','0','0','0','','0'),
('6','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820705484','80','-1','1','2','0','0','','1','','','','80.00','0.00','1','1440058409','0','0','0','0','','0'),
('7','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820640266','100','-1','1','2','0','0','','1','','','','100.00','0.00','1','1440058563','0','0','0','0','','0'),
('8','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820268486','4688','-1','1','2','0','0','','1','','','','4688.00','0.00','1','1440058771','0','0','0','0','','0'),
('9','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820714584','60','-1','1','2','0','0','','1','','','','60.00','0.00','1','1440059244','0','0','0','0','','0'),
('10','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820807762','4688','-1','1','2','0','0','','1','','','','4688.00','0.00','1','1440059317','0','0','0','0','','0'),
('11','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820236073','3210','-1','1','2','0','0','','1','','','','3200.00','10.00','1','1440059368','0','0','0','0','','0'),
('12','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820823202','3500','-1','1','2','0','0','','1','','','','3500.00','0.00','1','1440059479','0','0','0','0','','0'),
('13','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820024728','2099','-1','1','2','0','0','','1','','','','2099.00','0.00','1','1440059529','0','0','0','0','','0'),
('14','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820693046','4688','3','1','2','0','0','','1','','','','4688.00','0.00','1','1440059608','1440059709','0','0','0','','1440059703'),
('15','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0820692246','4688','3','3','1','0','0','','1','','','-1','4688.00','0.00','1','1440060249','1440231347','0','0','0','','1440231304'),
('16','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0822158421','4688','3','3','1','0','0','','1','','','-1','4688.00','0.00','3','1440231195','1440231334','0','0','0','','1440231304'),
('17','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','0','0822426467','3500','-5','3','1','0','0','','1','','','','3500.00','0.00','3','1440231393','1440231450','0','0','1','测试','1440231427'),
('18','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','0','0824228984','2099','0','1','2','0','0','','2','','','','2099.00','0.00','1','1440349713','0','0','0','0','','0');


DROP TABLE IF EXISTS ims_bj_qmxk_order_goods;
CREATE TABLE `ims_bj_qmxk_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `orderid` int(10) unsigned NOT NULL,
  `goodsid` int(10) unsigned NOT NULL,
  `commission` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '该订单的推荐佣金',
  `commission2` decimal(10,2) unsigned DEFAULT '0.00',
  `commission3` decimal(10,2) unsigned DEFAULT '0.00',
  `applytime` int(10) unsigned DEFAULT NULL COMMENT '申请时间',
  `checktime` int(10) unsigned DEFAULT NULL COMMENT '审核时间',
  `status` tinyint(3) DEFAULT '0' COMMENT '申请状态，-2为标志删除，-1为审核无效，0为未申请，1为正在申请，2为审核通过',
  `content` text,
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(10) unsigned NOT NULL DEFAULT '1',
  `optionid` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `optionname` text,
  `applytime2` int(10) DEFAULT '0' COMMENT '2级申请时间',
  `checktime2` int(10) DEFAULT '0' COMMENT '2级审核时间',
  `applytime3` int(10) DEFAULT '0' COMMENT '3级申请时间',
  `checktime3` int(10) DEFAULT '0' COMMENT '3级审核时间',
  `status2` tinyint(3) DEFAULT '0' COMMENT '2级申请状态',
  `status3` tinyint(3) DEFAULT '0' COMMENT '3级申请状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_order_goods VALUES 
('1','2','1','1','500.00','250.00','150.00','','','0','','5000.00','1','0','1440037551','','0','0','0','0','0','0'),
('2','2','2','1','500.00','250.00','150.00','','','0','','5000.00','1','0','1440039459','','0','0','0','0','0','0'),
('3','2','3','4','10.00','5.00','3.00','','','0','','100.00','1','4','1440058046','蓝色','0','0','0','0','0','0'),
('4','2','4','4','10.00','5.00','3.00','','','0','','100.00','1','4','1440058181','蓝色','0','0','0','0','0','0'),
('5','2','5','4','8.00','4.00','2.40','','','0','','80.00','1','6','1440058217','红色','0','0','0','0','0','0'),
('6','2','6','4','8.00','4.00','2.40','','','0','','80.00','1','6','1440058409','红色','0','0','0','0','0','0'),
('7','2','7','4','10.00','5.00','3.00','','','0','','100.00','1','4','1440058563','蓝色','0','0','0','0','0','0'),
('8','2','8','2','468.80','234.40','140.64','','','0','','4688.00','1','2','1440058771','金色','0','0','0','0','0','0'),
('9','2','9','4','6.00','3.00','1.80','','','0','','60.00','1','4','1440059244','白色','0','0','0','0','0','0'),
('10','2','10','2','468.80','234.40','140.64','','','0','','4688.00','1','2','1440059317','金色','0','0','0','0','0','0'),
('11','2','11','5','320.00','160.00','96.00','','','0','','3200.00','1','0','1440059368','','0','0','0','0','0','0'),
('12','2','12','7','350.00','175.00','105.00','','','0','','3500.00','1','0','1440059479','','0','0','0','0','0','0'),
('13','2','13','6','209.90','104.95','62.97','','','0','','2099.00','1','0','1440059529','','0','0','0','0','0','0'),
('14','2','14','2','468.80','234.40','140.64','','','0','','4688.00','1','2','1440059608','金色','0','0','0','0','0','0'),
('15','2','15','2','468.80','234.40','140.64','','','0','','4688.00','1','2','1440060249','金色','0','0','0','0','0','0'),
('16','2','16','2','468.80','234.40','140.64','','','0','','4688.00','1','1','1440231195','白色','0','0','0','0','0','0'),
('17','2','17','3','350.00','175.00','105.00','','','0','','3500.00','1','0','1440231393','','0','0','0','0','0','0'),
('18','2','18','6','209.90','104.95','62.97','','','0','','2099.00','1','0','1440349713','','0','0','0','0','0','0');


DROP TABLE IF EXISTS ims_bj_qmxk_paylog;
CREATE TABLE `ims_bj_qmxk_paylog` (
  `createtime` int(10) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `credit2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mid` int(10) NOT NULL COMMENT 'member id',
  `openid` varchar(40) NOT NULL,
  `weid` int(11) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT 'usegold使用金额 addgold充值金额 usecredit使用积分 addcredit充值积分',
  `plid` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`plid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_paylog VALUES 
('1440060050',' 后台充值500元','500.00','500.00','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4','2','addgold','12'),
('1440231147',' 后台充值999999元','999999.00','1000499.00','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4','2','addgold','13'),
('1440231199','余款付款购买商品，订单编号为0822158421','4688.00','995811.00','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4','2','usegold','14'),
('1440231236','余款付款购买商品，订单编号为0820692246','4688.00','991123.00','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4','2','usegold','15'),
('1440231398','余款付款购买商品，订单编号为0822426467','3500.00','987623.00','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4','2','usegold','16'),
('1440231498','订单:0822426467退货返还余额','3500.00','991123.00','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4','2','addgold','17');


DROP TABLE IF EXISTS ims_bj_qmxk_phb_medal;
CREATE TABLE `ims_bj_qmxk_phb_medal` (
  `fans_count` int(11) DEFAULT NULL,
  `medal_name` varchar(50) DEFAULT NULL,
  `weid` int(11) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_pormotions;
CREATE TABLE `ims_bj_qmxk_pormotions` (
  `description` varchar(200) DEFAULT NULL COMMENT '描述(预留)',
  `endtime` int(10) NOT NULL COMMENT '束结时间',
  `starttime` int(10) NOT NULL COMMENT '开始时间',
  `condition` decimal(10,2) NOT NULL COMMENT '条件',
  `promoteType` int(11) NOT NULL COMMENT '0 按订单数包邮 1满额包邮',
  `weid` int(11) NOT NULL COMMENT '务号服id',
  `pname` varchar(100) NOT NULL COMMENT '名称',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_product;
CREATE TABLE `ims_bj_qmxk_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL,
  `productsn` varchar(50) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `marketprice` decimal(10,0) unsigned NOT NULL,
  `productprice` decimal(10,0) unsigned NOT NULL,
  `total` int(11) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `spec` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_goodsid` (`goodsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_qr;
CREATE TABLE `ims_bj_qmxk_qr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `qr_url` varchar(1024) NOT NULL,
  `createtime` int(11) NOT NULL,
  `expiretime` int(11) NOT NULL,
  `media_id` varchar(1024) NOT NULL,
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `from_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_qr VALUES 
('1','2','/source/modules/bj_qmxk/tmppic/qr-image-oPnnXjt7uKBidn0MXwm3UiaRHHP4.jpg','1440040897','1440213697','DxHapj-9CEndsGA7C0DfVjKZ0_H0e_WMYkse0u_jhNNfMMQKT0Imy5HDbi2gf1TE','1','oPnnXjt7uKBidn0MXwm3UiaRHHP4'),
('2','2','/source/modules/bj_qmxk/tmppic/qr-image-oPnnXjvuz5TdSdIVzR6spVlE3OwM.jpg','1440235066','1440407866','XBFl1vfKtVTmat5XDGNRMv6l18OCojat31Xyh528GirQE1BEH6lk_ueIBAKguWH5','1','oPnnXjvuz5TdSdIVzR6spVlE3OwM'),
('3','2','/source/modules/bj_qmxk/tmppic/qr-image-oPnnXjqA3s3HnRXLCcZB0jDQ2D8k.jpg','1440321823','1440494623','yyOTL__ToGmqP-M1czdm0lRXFcshPt-v8a_05ALH3So1JUZlfbbjx8zcPgynRAZz','1','oPnnXjqA3s3HnRXLCcZB0jDQ2D8k'),
('4','2','/source/modules/bj_qmxk/tmppic/qr-image-oPnnXjtKc-3bI8s48GyRP6v74k0o.jpg','1440349929','1440522729','CQtW8F1vQ35H99CwkPC_Qf3aay9JDL5OhaPvVy844j-kz1HTyIiUvblCPYZzHdHg','1','oPnnXjtKc-3bI8s48GyRP6v74k0o');


DROP TABLE IF EXISTS ims_bj_qmxk_rule;
CREATE TABLE `ims_bj_qmxk_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `rule` text,
  `terms` text,
  `createtime` int(10) NOT NULL,
  `gzurl` varchar(255) NOT NULL,
  `teamfy` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_bj_qmxk_rules;
CREATE TABLE `ims_bj_qmxk_rules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `rule` text,
  `terms` text,
  `createtime` int(10) NOT NULL,
  `commtime` int(5) NOT NULL DEFAULT '15' COMMENT '默认15天',
  `promotertimes` int(10) NOT NULL DEFAULT '1' COMMENT '1购买一单 成为会员 0无条件成为会员 2达到单数 3达到金额',
  `promotercount` int(10) NOT NULL DEFAULT '0' COMMENT '成为代理需要成交单数',
  `promotermoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成为代理需要成交总金额',
  `ischeck` tinyint(1) DEFAULT '1' COMMENT '0为未审核，1为审核',
  `clickcredit` int(10) NOT NULL DEFAULT '0' COMMENT '点击获取积分',
  `autofinishcktime` int(10) NOT NULL DEFAULT '0' COMMENT '自动收货检查',
  `jsapi_ticket` varchar(300) NOT NULL DEFAULT '' COMMENT 'jsapi_ticket',
  `jsapi_ticket_exptime` int(10) NOT NULL DEFAULT '0' COMMENT 'jsapi_ticket_exptime',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=581 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_rules VALUES 
('1','2','<p>这里是帮助文件</p>','<br />','1440409382','0','1','0','0.00','2','2','1440463105','','0'),
('2','2','','','1440037295','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044295'),
('3','2','','','1440037485','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044485'),
('4','2','','','1440037488','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044488'),
('5','2','','','1440037490','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044491'),
('6','2','','','1440037494','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044494'),
('7','2','','','1440037495','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044495'),
('8','2','','','1440037502','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044502'),
('9','2','','','1440037503','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044503'),
('10','2','','','1440037503','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044503'),
('11','2','','','1440037546','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044546'),
('12','2','','','1440037547','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044548'),
('13','2','','','1440037551','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044551'),
('14','2','','','1440037556','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440044556'),
('15','2','','','1440039236','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046236'),
('16','2','','','1440039236','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046237'),
('17','2','','','1440039412','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046412'),
('18','2','','','1440039421','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046421'),
('19','2','','','1440039429','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046429'),
('20','2','','','1440039432','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046432'),
('21','2','','','1440039435','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046435'),
('22','2','','','1440039438','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046438'),
('23','2','','','1440039446','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046446'),
('24','2','','','1440039447','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046447'),
('25','2','','','1440039455','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046455'),
('26','2','','','1440039455','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046455'),
('27','2','','','1440039459','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046459'),
('28','2','','','1440039461','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046461'),
('29','2','','','1440039609','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046609'),
('30','2','','','1440039703','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046703'),
('31','2','','','1440039708','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046708'),
('32','2','','','1440039724','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046724'),
('33','2','','','1440039737','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046738'),
('34','2','','','1440039740','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046740'),
('35','2','','','1440039743','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046743'),
('36','2','','','1440039746','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046746'),
('37','2','','','1440039752','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046752'),
('38','2','','','1440039805','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046805'),
('39','2','','','1440039861','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046861'),
('40','2','','','1440039899','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046899'),
('41','2','','','1440039926','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046926'),
('42','2','','','1440039984','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440046985'),
('43','2','','','1440040000','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047000'),
('44','2','','','1440040034','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047034'),
('45','2','','','1440040041','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047041'),
('46','2','','','1440040128','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047128'),
('47','2','','','1440040148','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047148'),
('48','2','','','1440040377','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047378'),
('49','2','','','1440040380','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047380'),
('50','2','','','1440040392','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047392'),
('53','2','','','1440040545','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047545'),
('54','2','','','1440040563','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047563'),
('51','2','','','1440040497','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047497'),
('52','2','','','1440040504','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047504'),
('55','2','','','1440040853','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT88Q66E4DmG_VeEOv6ad-ypsrZQsKTXpSIMeNnDvMR1g','1440047853'),
('56','2','','','1440051014','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440058014'),
('57','2','','','1440051413','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440058413'),
('58','2','','','1440051416','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440058417'),
('59','2','','','1440051421','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440058422'),
('60','2','','','1440051878','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440058878'),
('61','2','','','1440052089','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059089'),
('62','2','','','1440052510','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059511'),
('63','2','','','1440052554','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059555'),
('64','2','','','1440052558','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059558'),
('65','2','','','1440052821','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059821'),
('66','2','','','1440052872','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059872'),
('67','2','','','1440052883','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059884'),
('68','2','','','1440052888','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059888'),
('69','2','','','1440052951','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440059951'),
('70','2','','','1440053064','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060065'),
('71','2','','','1440053223','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060223'),
('72','2','','','1440053257','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060257'),
('73','2','','','1440053404','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060404'),
('74','2','','','1440053927','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060927'),
('75','2','','','1440053933','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060933'),
('76','2','','','1440053938','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060938'),
('77','2','','','1440053940','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060941'),
('78','2','','','1440053944','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060944'),
('79','2','','','1440053975','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060976'),
('80','2','','','1440053981','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060981'),
('81','2','','','1440053984','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060984'),
('82','2','','','1440053986','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060987'),
('83','2','','','1440053990','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060990'),
('84','2','','','1440053994','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440060994'),
('85','2','','','1440054010','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440061010'),
('86','2','','','1440054012','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440061012'),
('87','2','','','1440054106','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440061106'),
('88','2','','','1440054113','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440061114'),
('89','2','','','1440054123','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440061123'),
('90','2','','','1440054128','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440061129'),
('91','2','','','1440056199','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440063199'),
('92','2','','','1440056696','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS95KrC0X-xMWnrmcovznHJhowvGDY89UySJUmA-LGpBg','1440063697'),
('93','2','','','1440057902','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440064903'),
('94','2','','','1440057904','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440064904'),
('95','2','','','1440057942','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440064942'),
('96','2','','','1440057947','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440064948'),
('97','2','','','1440057993','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440064993'),
('98','2','','','1440058000','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065001'),
('99','2','','','1440058005','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065005'),
('100','2','','','1440058005','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065005'),
('101','2','','','1440058022','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065022'),
('102','2','','','1440058038','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065038'),
('103','2','','','1440058046','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065046'),
('104','2','','','1440058051','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065052'),
('105','2','','','1440058111','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065112'),
('106','2','','','1440058130','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065130'),
('107','2','','','1440058148','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065148'),
('108','2','','','1440058153','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065153'),
('109','2','','','1440058156','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065156'),
('110','2','','','1440058156','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065156'),
('111','2','','','1440058160','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065160'),
('112','2','','','1440058175','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065176'),
('113','2','','','1440058181','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065181'),
('114','2','','','1440058189','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065189'),
('115','2','','','1440058190','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065190'),
('116','2','','','1440058200','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065200'),
('117','2','','','1440058204','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065205'),
('118','2','','','1440058204','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065205'),
('119','2','','','1440058208','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065208'),
('120','2','','','1440058213','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065213'),
('121','2','','','1440058217','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065217'),
('122','2','','','1440058220','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065220'),
('123','2','','','1440058387','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065388'),
('124','2','','','1440058394','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065394'),
('125','2','','','1440058405','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065405'),
('126','2','','','1440058409','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065409'),
('127','2','','','1440058412','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065412'),
('128','2','','','1440058526','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065527'),
('129','2','','','1440058536','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065536'),
('130','2','','','1440058542','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065542'),
('131','2','','','1440058543','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065543'),
('132','2','','','1440058546','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065547'),
('133','2','','','1440058546','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065547'),
('134','2','','','1440058554','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065555'),
('135','2','','','1440058557','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065557'),
('136','2','','','1440058560','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065560'),
('137','2','','','1440058563','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065563'),
('138','2','','','1440058566','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065566'),
('139','2','','','1440058570','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065570'),
('140','2','','','1440058571','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065572'),
('141','2','','','1440058572','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065572'),
('142','2','','','1440058576','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065576'),
('143','2','','','1440058755','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065755'),
('144','2','','','1440058759','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065759'),
('145','2','','','1440058767','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065767'),
('146','2','','','1440058771','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065772'),
('147','2','','','1440058773','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065773'),
('148','2','','','1440058960','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065961'),
('149','2','','','1440058969','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440065969'),
('150','2','','','1440059215','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066215'),
('151','2','','','1440059231','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066231'),
('152','2','','','1440059231','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066231'),
('153','2','','','1440059240','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066240'),
('154','2','','','1440059244','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066244'),
('155','2','','','1440059247','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066247'),
('156','2','','','1440059291','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066291'),
('157','2','','','1440059300','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066300'),
('158','2','','','1440059313','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066314'),
('159','2','','','1440059317','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066318'),
('160','2','','','1440059319','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066320'),
('161','2','','','1440059349','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066350'),
('162','2','','','1440059358','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066359'),
('163','2','','','1440059362','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066363'),
('164','2','','','1440059368','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066368'),
('165','2','','','1440059371','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066371'),
('166','2','','','1440059434','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066434'),
('167','2','','','1440059440','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066440'),
('168','2','','','1440059475','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066476'),
('169','2','','','1440059479','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066479'),
('170','2','','','1440059481','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066481'),
('171','2','','','1440059508','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066508'),
('172','2','','','1440059518','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066518'),
('173','2','','','1440059526','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066526'),
('174','2','','','1440059529','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066529'),
('175','2','','','1440059531','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066531'),
('176','2','','','1440059558','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066558'),
('177','2','','','1440059576','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066576'),
('178','2','','','1440059582','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066582'),
('179','2','','','1440059584','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066584'),
('180','2','','','1440059588','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066588'),
('181','2','','','1440059590','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066590'),
('182','2','','','1440059590','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066591'),
('183','2','','','1440059596','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066596'),
('184','2','','','1440059601','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066601'),
('185','2','','','1440059608','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066608'),
('186','2','','','1440059622','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066623'),
('187','2','','','1440059643','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066644'),
('188','2','','','1440059661','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066662'),
('189','2','','','1440059718','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066718'),
('190','2','','','1440059735','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066735'),
('191','2','','','1440059822','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440066823'),
('192','2','','','1440060194','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067194'),
('193','2','','','1440060220','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067220'),
('194','2','','','1440060231','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067232'),
('195','2','','','1440060231','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067232'),
('196','2','','','1440060235','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067235'),
('197','2','','','1440060243','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067243'),
('198','2','','','1440060249','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067250'),
('199','2','','','1440060252','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440067252'),
('200','2','','','1440061662','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440068662'),
('201','2','','','1440061721','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440068721'),
('202','2','','','1440061758','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440068758'),
('203','2','','','1440061780','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440068780'),
('204','2','','','1440061785','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440068785'),
('205','2','','','1440063199','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440070199'),
('206','2','','','1440063199','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRBE30Bd49Nd-V45VlisthfwyeWBoi2trlF2Qpj2MfagQ','1440070199'),
('207','2','','','1440069429','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT_YhJPrFd71HGmv6L_29n_8QRZguabjaM4cSOPY2dGeA','1440076430'),
('208','2','','','1440069603','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT_YhJPrFd71HGmv6L_29n_8QRZguabjaM4cSOPY2dGeA','1440076603'),
('209','2','','','1440074179','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081179'),
('210','2','','','1440074184','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081185'),
('211','2','','','1440074195','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081195'),
('212','2','','','1440074202','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081203'),
('213','2','','','1440074205','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081206'),
('214','2','','','1440074207','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081208'),
('215','2','','','1440074210','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081210'),
('216','2','','','1440074212','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081212'),
('217','2','','','1440074222','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081222'),
('218','2','','','1440074227','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081227'),
('219','2','','','1440074230','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081231'),
('220','2','','','1440074230','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQWNQvWlr1kjbx6Q8zh9SjcS9a-U2Pw19AUpFqrhr7vWg','1440081231'),
('221','2','','','1440082492','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089493'),
('222','2','','','1440082493','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089493'),
('223','2','','','1440082691','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089691'),
('224','2','','','1440082698','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089698'),
('225','2','','','1440082700','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089700'),
('226','2','','','1440082702','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089702'),
('227','2','','','1440082704','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089704'),
('228','2','','','1440082708','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089708'),
('229','2','','','1440082716','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089716'),
('230','2','','','1440082747','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089747'),
('231','2','','','1440082859','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089859'),
('232','2','','','1440082866','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089866'),
('233','2','','','1440082883','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089883'),
('234','2','','','1440082885','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089885'),
('235','2','','','1440082892','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089892'),
('236','2','','','1440082895','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089895'),
('237','2','','','1440082898','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089898'),
('238','2','','','1440082901','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440089901'),
('239','2','','','1440083023','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440090023'),
('240','2','','','1440083178','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440090179'),
('241','2','','','1440083200','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440090201'),
('242','2','','','1440084275','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTpqaaM4FA81HZ8TcS-bLj6pI28RPN8dMgQXRn39j9JtQ','1440091275'),
('243','2','','','1440128688','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTVeFzOwHr_X-5Daq7ErQ4um6agbpUmbnGqYE66PnGkXA','1440135688'),
('244','2','','','1440137616','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS4xS-MqR77wEmww_4DZp4mqQ8XolHsk-aFDMqy4lAiZg','1440144616'),
('245','2','','','1440143205','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS4xS-MqR77wEmww_4DZp4mqQ8XolHsk-aFDMqy4lAiZg','1440150206'),
('246','2','','','1440143223','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS4xS-MqR77wEmww_4DZp4mqQ8XolHsk-aFDMqy4lAiZg','1440150224'),
('247','2','','','1440143251','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS4xS-MqR77wEmww_4DZp4mqQ8XolHsk-aFDMqy4lAiZg','1440150251'),
('248','2','','','1440145993','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSBaVmh1QOMHu6vweJ87sC9PNCbylf_sf6YHsJ2D3H4ew','1440152994'),
('249','2','','','1440146001','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSBaVmh1QOMHu6vweJ87sC9PNCbylf_sf6YHsJ2D3H4ew','1440153002'),
('250','2','','','1440155396','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162397'),
('251','2','','','1440155408','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162408'),
('252','2','','','1440155411','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162412'),
('253','2','','','1440155422','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162423'),
('254','2','','','1440155427','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162427'),
('255','2','','','1440155428','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162428'),
('256','2','','','1440155428','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT6ZBfiNNpzdFz4emr9Cm2mnkkvJ3F35SPhPtMU05lbUQ','1440162428'),
('257','2','','','1440160550','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440167551'),
('258','2','','','1440160550','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440167551'),
('259','2','','','1440160570','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440167570'),
('260','2','','','1440164921','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440171922'),
('261','2','','','1440164933','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440171933'),
('262','2','','','1440164939','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440171939'),
('263','2','','','1440165429','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172430'),
('264','2','','','1440165437','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172437'),
('265','2','','','1440165442','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172442'),
('266','2','','','1440165452','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172452'),
('267','2','','','1440165460','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172460'),
('268','2','','','1440165468','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172468'),
('269','2','','','1440165476','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172476'),
('270','2','','','1440165483','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172483'),
('271','2','','','1440165516','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172517'),
('272','2','','','1440165521','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS9cD-ZHLmxdeKJ0uDN9mta3b8lpzjvnyNTgKFonWYB_Q','1440172521'),
('273','2','','','1440165784','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440172785'),
('274','2','','','1440166883','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440173884'),
('275','2','','','1440166895','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440173896'),
('276','2','','','1440166904','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440173904'),
('277','2','','','1440168050','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440175050'),
('278','2','','','1440168059','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440175059'),
('279','2','','','1440170031','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440177031'),
('280','2','','','1440170244','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRAJZTLs8DYLmYDjmip8i0ViAz6cjzuYXtzmR7D2h5qzA','1440177244'),
('281','2','','','1440179698','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186698'),
('282','2','','','1440179698','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186698'),
('283','2','','','1440179712','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186712'),
('284','2','','','1440179717','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186717'),
('285','2','','','1440179725','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186725'),
('286','2','','','1440179783','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186784'),
('287','2','','','1440179788','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186788'),
('288','2','','','1440179792','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzR56b2VTnZZYaIjdCKd5y7zn36qTkg8OfDEjsBMHFzmkQ','1440186793'),
('289','2','','','1440186043','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193044'),
('290','2','','','1440186049','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193050'),
('291','2','','','1440186052','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193052'),
('292','2','','','1440186062','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193062'),
('293','2','','','1440186062','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193063'),
('294','2','','','1440186082','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193082'),
('295','2','','','1440186096','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193096'),
('296','2','','','1440186098','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193099'),
('297','2','','','1440186107','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193107'),
('298','2','','','1440186121','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193121'),
('299','2','','','1440186127','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193128'),
('300','2','','','1440186129','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193130');
INSERT INTO ims_bj_qmxk_rules VALUES 
('301','2','','','1440186138','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193138'),
('302','2','','','1440186144','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193144'),
('303','2','','','1440186149','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193149'),
('304','2','','','1440186172','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193172'),
('305','2','','','1440186188','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193188'),
('306','2','','','1440186206','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193206'),
('307','2','','','1440186226','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193226'),
('308','2','','','1440186229','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193229'),
('309','2','','','1440186234','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193234'),
('310','2','','','1440186236','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193237'),
('311','2','','','1440186242','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193242'),
('312','2','','','1440186245','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193245'),
('313','2','','','1440186256','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193257'),
('314','2','','','1440186261','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193261'),
('315','2','','','1440186275','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193275'),
('316','2','','','1440186279','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193279'),
('317','2','','','1440186282','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193282'),
('318','2','','','1440186285','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193285'),
('319','2','','','1440186288','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193288'),
('320','2','','','1440186292','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193292'),
('321','2','','','1440186302','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193302'),
('322','2','','','1440186308','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193309'),
('323','2','','','1440186313','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193313'),
('324','2','','','1440186316','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193316'),
('325','2','','','1440186316','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193316'),
('326','2','','','1440186347','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193348'),
('327','2','','','1440186349','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193349'),
('328','2','','','1440186401','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSgF2WFGDgehpsnleMs3f_Th7wg5kaP2Ahiy3kg6D-U0Q','1440193402'),
('329','2','','','1440197803','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204804'),
('330','2','','','1440197811','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204811'),
('331','2','','','1440197820','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204821'),
('332','2','','','1440197826','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204826'),
('333','2','','','1440197828','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204828'),
('334','2','','','1440197829','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204829'),
('335','2','','','1440197831','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204831'),
('336','2','','','1440197881','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204881'),
('337','2','','','1440197912','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204913'),
('338','2','','','1440197964','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204965'),
('339','2','','','1440197966','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRyPPywg5M2jPdUJNH4bIV5a0ZLPoJ5J9p04WmRRdHMAA','1440204967'),
('340','2','','','1440213041','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220041'),
('341','2','','','1440213058','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220058'),
('342','2','','','1440213061','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220062'),
('343','2','','','1440213072','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220072'),
('344','2','','','1440213079','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220079'),
('345','2','','','1440213091','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220091'),
('346','2','','','1440213103','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220103'),
('347','2','','','1440213103','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220103'),
('348','2','','','1440213108','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220108'),
('349','2','','','1440213122','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220122'),
('350','2','','','1440213122','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220123'),
('351','2','','','1440213141','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220141'),
('352','2','','','1440213165','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSAlEl4llfY5QjcIg_5yaCZh0dcaNR9zjyUVlSTCatxAw','1440220165'),
('353','2','','','1440216949','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzQ_0ygyVipYMqmJyi_nQU74W15ZXWHZAMxXkatI5T-srw','1440223949'),
('354','2','','','1440224675','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231675'),
('355','2','','','1440224693','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231694'),
('356','2','','','1440224714','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231714'),
('357','2','','','1440224734','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231734'),
('358','2','','','1440224738','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231738'),
('359','2','','','1440224741','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231741'),
('360','2','','','1440224743','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231744'),
('361','2','','','1440224749','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231749'),
('362','2','','','1440224753','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231753'),
('363','2','','','1440224760','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231760'),
('364','2','','','1440224764','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440231764'),
('365','2','','','1440225047','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440232047'),
('366','2','','','1440225051','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS6TgreF6FlOtiQIEH3WRanfi_xbWEFGqNMgko1BG6M5g','1440232051'),
('367','2','','','1440230502','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237503'),
('368','2','','','1440230723','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237723'),
('369','2','','','1440230821','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237822'),
('370','2','','','1440230822','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237822'),
('371','2','','','1440230830','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237830'),
('372','2','','','1440230830','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237830'),
('373','2','','','1440230970','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440237970'),
('374','2','','','1440231007','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238007'),
('375','2','','','1440231072','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238072'),
('376','2','','','1440231152','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238152'),
('377','2','','','1440231166','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238166'),
('378','2','','','1440231172','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238173'),
('379','2','','','1440231190','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238190'),
('380','2','','','1440231195','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238195'),
('381','2','','','1440231198','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238198'),
('382','2','','','1440231199','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238199'),
('383','2','','','1440231204','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238205'),
('384','2','','','1440231211','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238211'),
('385','2','','','1440231218','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238218'),
('386','2','','','1440231224','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238224'),
('387','2','','','1440231230','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238230'),
('388','2','','','1440231235','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238235'),
('389','2','','','1440231236','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238236'),
('390','2','','','1440231240','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238241'),
('391','2','','','1440231280','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238280'),
('392','2','','','1440231294','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238294'),
('393','2','','','1440231321','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238321'),
('394','2','','','1440231324','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238324'),
('395','2','','','1440231327','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238327'),
('396','2','','','1440231330','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238330'),
('397','2','','','1440231334','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238334'),
('398','2','','','1440231338','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238339'),
('399','2','','','1440231342','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238342'),
('400','2','','','1440231343','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238343'),
('401','2','','','1440231347','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238347'),
('402','2','','','1440231351','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238351'),
('403','2','','','1440231354','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238354'),
('404','2','','','1440231357','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238357'),
('405','2','','','1440231362','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238362'),
('406','2','','','1440231369','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238369'),
('407','2','','','1440231369','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238369'),
('408','2','','','1440231372','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238372'),
('409','2','','','1440231384','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238384'),
('410','2','','','1440231393','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238393'),
('411','2','','','1440231397','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238397'),
('412','2','','','1440231398','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238399'),
('413','2','','','1440231403','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238404'),
('414','2','','','1440231408','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238408'),
('415','2','','','1440231445','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238446'),
('416','2','','','1440231450','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238450'),
('417','2','','','1440231454','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238454'),
('418','2','','','1440231457','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238458'),
('419','2','','','1440231460','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238460'),
('420','2','','','1440231464','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238464'),
('421','2','','','1440231477','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238477'),
('422','2','','','1440231481','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238481'),
('423','2','','','1440231501','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238501'),
('424','2','','','1440231508','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238508'),
('425','2','','','1440231672','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238672'),
('426','2','','','1440231683','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238683'),
('427','2','','','1440231715','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238715'),
('428','2','','','1440231790','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238790'),
('429','2','','','1440231802','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238802'),
('430','2','','','1440231806','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238806'),
('431','2','','','1440231820','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238820'),
('432','2','','','1440231994','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238995'),
('433','2','','','1440231999','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440238999'),
('434','2','','','1440232076','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440239076'),
('435','2','','','1440232091','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440239091'),
('436','2','','','1440232094','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440239095'),
('437','2','','','1440234456','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440241456'),
('438','2','','','1440234486','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzS40UZMvyVwdJ6zOv2_FoNdTkCjgyah2fkjtiOCHhl1TQ','1440241486'),
('439','2','','','1440259089','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266089'),
('440','2','','','1440259089','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266089'),
('441','2','','','1440259096','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266096'),
('442','2','','','1440259115','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266115'),
('443','2','','','1440259118','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266119'),
('444','2','','','1440259121','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266121'),
('445','2','','','1440259135','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266135'),
('446','2','','','1440259139','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266139'),
('447','2','','','1440259153','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266153'),
('448','2','','','1440259153','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266153'),
('449','2','','','1440259160','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266160'),
('450','2','','','1440259161','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266161'),
('451','2','','','1440259163','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266163'),
('452','2','','','1440259167','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266167'),
('453','2','','','1440259174','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT1fy7qVJI6_6IzJ_mXedpbXX_de40JXmWpx4HpyfSr1Q','1440266174'),
('454','2','','','1440316890','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323891'),
('455','2','','','1440316928','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323928'),
('456','2','','','1440316931','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323931'),
('457','2','','','1440316933','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323933'),
('458','2','','','1440316936','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323936'),
('459','2','','','1440316939','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323939'),
('460','2','','','1440316964','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323964'),
('461','2','','','1440316972','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323972'),
('462','2','','','1440316972','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323972'),
('463','2','','','1440316975','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323975'),
('464','2','','','1440316977','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323978'),
('465','2','','','1440316982','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323982'),
('466','2','','','1440316984','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323985'),
('467','2','','','1440316986','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323986'),
('468','2','','','1440316996','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323996'),
('469','2','','','1440316999','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440323999'),
('470','2','','','1440317005','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440324006'),
('471','2','','','1440317013','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440324013'),
('472','2','','','1440317019','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440324020'),
('473','2','','','1440317260','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440324260'),
('474','2','','','1440317264','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440324264'),
('475','2','','','1440317719','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440324720'),
('476','2','','','1440318290','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440325290'),
('477','2','','','1440318940','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440325941'),
('478','2','','','1440320837','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440327838'),
('479','2','','','1440320837','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440327838'),
('480','2','','','1440320841','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440327841'),
('481','2','','','1440321779','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzRFVGoWFcxP2nb2EqJrtjZI2kruFyCkINTXTVmloJtCFA','1440328779'),
('482','2','','','1440338139','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345139'),
('483','2','','','1440338151','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345151'),
('484','2','','','1440338173','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345173'),
('485','2','','','1440338187','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345188'),
('486','2','','','1440338198','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345198'),
('487','2','','','1440338205','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345205'),
('488','2','','','1440338213','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345213'),
('489','2','','','1440338219','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345219'),
('490','2','','','1440338221','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345221'),
('491','2','','','1440338226','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345226'),
('492','2','','','1440338228','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345229'),
('493','2','','','1440338231','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345232'),
('494','2','','','1440338251','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSK-WMqjRSec1nzEL9tS5rvh3CqEELxGK1_bAQb3tigUA','1440345251'),
('495','2','','','1440344266','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSDVNqKE7mPlRX2KlmwRd7atwg8QeF_vcxiW-rNp4J08g','1440351267'),
('496','2','','','1440349598','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356598'),
('497','2','','','1440349651','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356652'),
('498','2','','','1440349669','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356669'),
('499','2','','','1440349672','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356672'),
('500','2','','','1440349676','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356676'),
('501','2','','','1440349691','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356692'),
('502','2','','','1440349699','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356700'),
('503','2','','','1440349713','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356713'),
('504','2','','','1440349715','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356715'),
('505','2','','','1440349727','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356728'),
('506','2','','','1440349736','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356736'),
('507','2','','','1440349741','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356741'),
('508','2','','','1440349744','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356744'),
('509','2','','','1440349751','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356752'),
('510','2','','','1440349760','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356761'),
('511','2','','','1440349770','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356770'),
('512','2','','','1440349777','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356777'),
('513','2','','','1440349798','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356799'),
('514','2','','','1440349812','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356812'),
('515','2','','','1440349820','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356820'),
('516','2','','','1440349840','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356841'),
('517','2','','','1440349843','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356843'),
('518','2','','','1440349846','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356847'),
('519','2','','','1440349855','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356856'),
('520','2','','','1440349863','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356864'),
('521','2','','','1440349871','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356871'),
('522','2','','','1440349879','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356879'),
('523','2','','','1440349887','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356888'),
('524','2','','','1440349917','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356917'),
('525','2','','','1440349925','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356925'),
('526','2','','','1440349967','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356967'),
('527','2','','','1440349975','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440356975'),
('528','2','','','1440352037','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359037'),
('529','2','','','1440352043','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359044'),
('530','2','','','1440352047','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359047'),
('531','2','','','1440352058','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359058'),
('532','2','','','1440352066','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359066'),
('533','2','','','1440352066','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359066'),
('534','2','','','1440352068','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359068'),
('535','2','','','1440352070','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359070'),
('536','2','','','1440352081','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359081'),
('537','2','','','1440352095','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359095'),
('538','2','','','1440352097','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8JB9q8PR7PI2d80tSoF50zjXA14jcbCsSTrWiYXUKxw','1440359098'),
('539','2','','','1440379274','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTFaVzZxwY8PDz4RLiiD8AnfVgFKk730VH7ER0Uh6cBZg','1440386275'),
('540','2','','','1440379293','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTFaVzZxwY8PDz4RLiiD8AnfVgFKk730VH7ER0Uh6cBZg','1440386293'),
('541','2','','','1440379319','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTFaVzZxwY8PDz4RLiiD8AnfVgFKk730VH7ER0Uh6cBZg','1440386320'),
('542','2','','','1440379328','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTFaVzZxwY8PDz4RLiiD8AnfVgFKk730VH7ER0Uh6cBZg','1440386328'),
('543','2','','','1440379338','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTFaVzZxwY8PDz4RLiiD8AnfVgFKk730VH7ER0Uh6cBZg','1440386338'),
('544','2','','','1440379343','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTFaVzZxwY8PDz4RLiiD8AnfVgFKk730VH7ER0Uh6cBZg','1440386344'),
('545','2','','','1440403096','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzSN-B9fB1ADipCtSPMX3EN_ZYYcvXs23yob4lQDqd9z1Q','1440410096'),
('546','2','','','1440408481','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415482'),
('547','2','','','1440408489','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415489'),
('548','2','','','1440408496','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415496'),
('549','2','','','1440408503','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415503'),
('550','2','','','1440408517','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415517'),
('551','2','','','1440408528','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415528'),
('552','2','','','1440408616','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415616'),
('553','2','','','1440408627','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTJkMNh4812QoXoi61lXjcgyK_jw3g31d8QH23pEsDFKw','1440415628'),
('554','2','','','1440417412','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424412'),
('555','2','','','1440417421','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424421'),
('556','2','','','1440417425','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424425'),
('557','2','','','1440417429','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424429'),
('558','2','','','1440417431','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424432'),
('559','2','','','1440417433','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424433'),
('560','2','','','1440417434','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424435'),
('561','2','','','1440417436','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424436'),
('562','2','','','1440417439','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTCMk7c29KfDhOWXjCr1YiFvQAKOCdB-nq4ELRGeshwww','1440424439'),
('563','2','','','1440459376','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466377'),
('564','2','','','1440459387','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466387'),
('565','2','','','1440459565','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466565'),
('566','2','','','1440459626','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466626'),
('567','2','','','1440459638','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466638'),
('568','2','','','1440459644','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466644'),
('569','2','','','1440459647','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466648'),
('570','2','','','1440459651','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466651'),
('571','2','','','1440459654','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466654'),
('572','2','','','1440459663','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466663'),
('573','2','','','1440459669','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466669'),
('574','2','','','1440459669','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466669'),
('575','2','','','1440459696','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466696'),
('576','2','','','1440459714','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466714'),
('577','2','','','1440459724','0','1','0','0.00','1','0','1440463105','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ','1440466724'),
('578','2','','','1440461313','0','1','0','0.00','1','0','0','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTrV3MApmJcl9CmpNlag0HBj7HZqvFkaoFfueRumPOJDg','1440468313'),
('579','2','','','1440461313','0','1','0','0.00','1','0','0','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTrV3MApmJcl9CmpNlag0HBj7HZqvFkaoFfueRumPOJDg','1440468313'),
('580','2','','','1440461329','0','1','0','0.00','1','0','0','bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzTrV3MApmJcl9CmpNlag0HBj7HZqvFkaoFfueRumPOJDg','1440468330');


DROP TABLE IF EXISTS ims_bj_qmxk_share_history;
CREATE TABLE `ims_bj_qmxk_share_history` (
  `sharemid` int(11) DEFAULT NULL,
  `weid` int(11) DEFAULT NULL,
  `from_user` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joinway` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0默认驱动加入,1二维码加入',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_share_history VALUES 
('1','2','oPnnXjh_GFV00mqGnvv9yO54QADk','1','0');


DROP TABLE IF EXISTS ims_bj_qmxk_spec;
CREATE TABLE `ims_bj_qmxk_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `displaytype` tinyint(3) unsigned NOT NULL,
  `content` text NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_spec VALUES 
('1','2','iphome6','','0','a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}','2','0'),
('2','2','颜色','','0','a:3:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"5\";}','4','0');


DROP TABLE IF EXISTS ims_bj_qmxk_spec_item;
CREATE TABLE `ims_bj_qmxk_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_specid` (`specid`),
  KEY `indx_show` (`show`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ims_bj_qmxk_spec_item VALUES 
('1','2','1','金色','i','1','0'),
('2','2','1','白色','i','1','1'),
('3','2','2','红色','images/2015/08/dO29MZngsk5KKMk5SM1UsJOJo1lmk2.jpg','1','0'),
('4','2','2','蓝色','images/2015/08/WVWlf9X7XGxB790x7HdGhxWHMMUgXv.jpg','1','1'),
('5','2','2','白色','images/2015/08/xje5cq1OoavenE1sQjVoslgag2JawN.jpg','1','2');


DROP TABLE IF EXISTS ims_card;
CREATE TABLE `ims_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(255) NOT NULL DEFAULT '',
  `background` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `format` varchar(50) NOT NULL DEFAULT '',
  `fields` varchar(1000) NOT NULL DEFAULT '',
  `snpos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_card_coupon;
CREATE TABLE `ims_card_coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `starttime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL,
  `pretotal` int(11) NOT NULL DEFAULT '1',
  `total` int(11) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_card_log;
CREATE TABLE `ims_card_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1积分，2金额，3优惠券',
  `content` varchar(255) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_card_members;
CREATE TABLE `ims_card_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL DEFAULT '',
  `cardsn` varchar(20) NOT NULL DEFAULT '',
  `credit1` varchar(15) NOT NULL DEFAULT '0',
  `credit2` varchar(15) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_card_members_coupon;
CREATE TABLE `ims_card_members_coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `couponid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1为正常状态，2为已使用',
  `receiver` varchar(50) NOT NULL,
  `consumetime` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_card_password;
CREATE TABLE `ims_card_password` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_cover_reply;
CREATE TABLE `ims_cover_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL DEFAULT '',
  `do` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ims_cover_reply VALUES 
('1','2','3','bj_qmxk','list','购物商城','','',''),
('2','2','6','bj_qmxk','fansindex','代理中心','','',''),
('3','2','7','bj_qmxk','phb','排行榜','','',''),
('4','2','11','bj_qmxk','award','积分兑换','','images/2/2015/08/sINmaIqA6EQ5QjB76JQnaU776jF15K.jpg','');


DROP TABLE IF EXISTS ims_default_reply_log;
CREATE TABLE `ims_default_reply_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL COMMENT '微信号ID，关联wechats表',
  `from_user` varchar(50) NOT NULL COMMENT '用户的唯一身份ID',
  `lastupdate` int(10) unsigned NOT NULL COMMENT '用户最后发送信息时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_fans;
CREATE TABLE `ims_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `from_user` varchar(50) NOT NULL COMMENT '用户的唯一身份ID',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '加密盐',
  `follow` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否订阅',
  `credit1` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `credit2` double unsigned NOT NULL DEFAULT '0' COMMENT '余额',
  `createtime` int(10) unsigned NOT NULL COMMENT '加入时间',
  `realname` varchar(10) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(200) NOT NULL DEFAULT '' COMMENT '头像',
  `qq` varchar(15) NOT NULL DEFAULT '' COMMENT 'QQ号',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `fakeid` varchar(30) NOT NULL DEFAULT '',
  `vip` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'VIP级别,0为普通会员',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别(0:保密 1:男 2:女)',
  `birthyear` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '生日年',
  `birthmonth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '生日月',
  `birthday` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `constellation` varchar(10) NOT NULL DEFAULT '' COMMENT '星座',
  `zodiac` varchar(5) NOT NULL DEFAULT '' COMMENT '生肖',
  `telephone` varchar(15) NOT NULL DEFAULT '' COMMENT '固定电话',
  `idcard` varchar(30) NOT NULL DEFAULT '' COMMENT '证件号码',
  `studentid` varchar(50) NOT NULL DEFAULT '' COMMENT '学号',
  `grade` varchar(10) NOT NULL DEFAULT '' COMMENT '班级',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `zipcode` varchar(10) NOT NULL DEFAULT '' COMMENT '邮编',
  `nationality` varchar(30) NOT NULL DEFAULT '' COMMENT '国籍',
  `resideprovince` varchar(30) NOT NULL DEFAULT '' COMMENT '居住省份',
  `residecity` varchar(30) NOT NULL DEFAULT '' COMMENT '居住城市',
  `residedist` varchar(30) NOT NULL DEFAULT '' COMMENT '居住行政区/县',
  `graduateschool` varchar(50) NOT NULL DEFAULT '' COMMENT '毕业学校',
  `company` varchar(50) NOT NULL DEFAULT '' COMMENT '公司',
  `education` varchar(10) NOT NULL DEFAULT '' COMMENT '学历',
  `occupation` varchar(30) NOT NULL DEFAULT '' COMMENT '职业',
  `position` varchar(30) NOT NULL DEFAULT '' COMMENT '职位',
  `revenue` varchar(10) NOT NULL DEFAULT '' COMMENT '年收入',
  `affectivestatus` varchar(30) NOT NULL DEFAULT '' COMMENT '情感状态',
  `lookingfor` varchar(255) NOT NULL DEFAULT '' COMMENT ' 交友目的',
  `bloodtype` varchar(5) NOT NULL DEFAULT '' COMMENT '血型',
  `height` varchar(5) NOT NULL DEFAULT '' COMMENT '身高',
  `weight` varchar(5) NOT NULL DEFAULT '' COMMENT '体重',
  `alipay` varchar(30) NOT NULL DEFAULT '' COMMENT '支付宝帐号',
  `msn` varchar(30) NOT NULL DEFAULT '' COMMENT 'MSN',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `taobao` varchar(30) NOT NULL DEFAULT '' COMMENT '阿里旺旺',
  `site` varchar(30) NOT NULL DEFAULT '' COMMENT '主页',
  `bio` text NOT NULL COMMENT '自我介绍',
  `interest` text NOT NULL COMMENT '兴趣爱好',
  PRIMARY KEY (`id`),
  KEY `weid` (`weid`),
  KEY `idx_from_user` (`from_user`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO ims_fans VALUES 
('1','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','SA15P651','1','13','0','1440461297','快乐每一天，军','快乐每一天，军','http://wx.qlogo.cn/mmopen/XjXeicgRNwsiczbCD6BqTUiaBc9zrCNfolPiaQJ0e92tzOSjrcUf1KKuPLvQQZMjxqpcO9pQYLJJXgwZiaTQBHBtV4tz6IUE9cTlic/0','','13926128888','','0','1','0','0','0','','','','','','','','','中国','广东省','广州市','','','','','','','','','','','','','','','','','','',''),
('2','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','lo24HQHT','1','6','0','1440350224','卢孙荣','卢孙荣','http://wx.qlogo.cn/mmopen/VNDQtnw16icKtXnO0eUiaQfYicbfxtdFicNKbGdIhDBTtCzHHPjGkVBdOV8r6ibsJlIYf64HkKiavaC9mEvwgnJxkMzg/0','','13851734013','','0','1','0','0','0','','','','','','','','','中国','江苏省','南京市','','','','','','','','','','','','','','','','','','',''),
('3','2','oPnnXjgdCoOh7n2LZ-X474y26KSY','Kn2A629n','1','0','0','1435741953',' 奇迹梦想',' 奇迹梦想','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKG6NKoqKvTPRDtvhCOEuc0iblic4Thl6CF6MFEugZY2Leb8C988YllR644pWawvicGicu2UjVRHibf6j0sGgDHDJUicKA0ibryKnxauo/0','','','','0','1','0','0','0','','','','','','','','','中国','湖北省','荆州市','','','','','','','','','','','','','','','','','','',''),
('4','2','oPnnXjvv49slQRwm3QnKhRpfZoF0','Cs27LEYV','0','0','0','1440048593','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('5','2','oPnnXjlSDNgCBgvz-L5j1zHs85DQ','pmOoN4zc','1','0','0','1433215454','','箭头↗','http://wx.qlogo.cn/mmopen/I6TlfkuPEmKnMAK3VKVqYtbfpHrARqhOwsibKIrIfaOVEodqyfribpEZ1RlAalhhMUpK2ib1l7tuVQ4PSYwNPaSsiazOPcHoOxpB/132','','','','0','1','0','0','0','','','','','','','','','中国','广东省','深圳市','','','','','','','','','','','','','','','','','','',''),
('6','2','oPnnXjmU7eMIRU06C47MbAQAu5Uw','g38xa8kT','1','0','0','1440155407','LEEOK','LEEOK','http://wx.qlogo.cn/mmopen/XjXeicgRNwsiczbCD6BqTUiaD2EW7kOW0t50JIGeTlSo54Eic48CZYlmu6A88m8tzxictzdXkwYibyZzGz86Voh0NR5BJrAprvXkXp/0','','','','0','1','0','0','0','','','','','','','','','中国','江苏省','徐州市','','','','','','','','','','','','','','','','','','',''),
('7','2','oPnnXjhhhk4MrPgUXTR5siiOPlnQ','Wa7r0aXz','1','0','0','1436165720','King®阿晓','King®阿晓','http://wx.qlogo.cn/mmopen/Q3auHgzwzM45sHibtBIc9qKZbllFw05zg1Kz0cEHxmsqoTDNdf1OOJ9kyiavEffybq5MSBRDLnYaJpvnEvs6ic4Cg/0','','','','0','1','0','0','0','','','','','','','','','中国','浙江省','杭州市','','','','','','','','','','','','','','','','','','',''),
('8','2','oPnnXjh_GFV00mqGnvv9yO54QADk','VjR5erxg','1','0','0','1440063197','靖文-维航分销','靖文-维航分销','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCVgNwX83TRwSh6Ip3vsLY7kV6k9IlCByFibH2Ae6LKHvFtwUnZ6q5OLanXGj5IGc1EiawYpN2Uia3QA/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('9','2','oPnnXjkPiHEE6KL9tKufj3oNKPhY','Khu6g1xM','1','0','0','1440069602','沐言','沐言','http://wx.qlogo.cn/mmopen/VNDQtnw16icLaOic5Uxj0Xb7ZJP4UZsm2MhsEFSXw8TwlCIuaic9jUqFKqpqDSl3DIP4IndzkMPoNwG1SOiboT8FVgHNllGnNJvA/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('10','2','oPnnXjnVqYN0KGlcjNae5XTclQBM','s4E54B8I','1','0','0','1440074178','版哥','版哥','http://wx.qlogo.cn/mmopen/I6TlfkuPEmIRAvwNdtDjiaZfPXwM9bXS90agprwS5Rdn4P4In5EsBXkicyPqpbyZdfB7VckmecPInRiaQespwnLakSyOON5fJJ5/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('11','2','oPnnXjgbk7XpFnG9WhFcjEFFKnZU','zh2S7598','1','0','0','1440137612','森然互联','森然互联','http://wx.qlogo.cn/mmopen/XjXeicgRNwsiczbCD6BqTUiaIfXeJysATodIu64TgRrMTe9D2sONILPoz1KYydVNo2Y70TQJnj6mUMpskD3WCwHeLAGSmRFAM80/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('12','2','oPnnXju7fxC-Rj5_Z24LgVCaLm7M','rClaSOLq','1','0','0','1440128687','奋斗！','奋斗！','http://wx.qlogo.cn/mmopen/I6TlfkuPEmIRAvwNdtDjiaQ1oFSQfJEujH9kEueN4oJOgHoj3JdMf5hyWcBdY7euu4ibNiatZvpXuNdINJkDnuBG6vRKsvYh79y/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('13','2','oPnnXjtQ9dcvXQHUt_Z7-slvg0xI','y9cEfdeR','1','0','0','1440128962','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('14','2','oPnnXjhkAGtJwxO7ueFOOU3cpV2E','lpakdj7y','1','0','0','1440234454','晓锋 ','晓锋 ','http://wx.qlogo.cn/mmopen/PiajxSqBRaEJvM3R7Hpl9TwF7kUMXIoVFdJP3vfUGzUUuib873Y6RW9f2AkwIZsWPWL9fHAROZwa34leJHvQqF9g/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('15','2','oPnnXju6zatMpfHEToDH_WRaPrh4','rcT1X2V9','0','0','0','1440146034','吉米','吉米','http://wx.qlogo.cn/mmopen/I6TlfkuPEmIRAvwNdtDjiabt16PKtLkly5GBdZE1q7CEW7oRQaFtQKbw94tRwBPKa4L4RVgWl6ltMovWbrwV62bMF6ib20JiaFV/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('16','2','oPnnXjsgNU0Y9Tz8bYhxslqVA0IY','O72O3M3j','1','0','0','1440149760','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('17','2','oPnnXjvaRv80838nZDRciGMuc5Lo','VlTaIl4Z','1','0','0','1440154417','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('18','2','oPnnXjiLY72Hmeb8YiYhZLY68Co8','df7p6ml6','1','0','0','1440160549','蒋承智公众号w593','蒋承智公众号w593hy','http://wx.qlogo.cn/mmopen/XjXeicgRNws98fAicCgOrzKCYDNTwDpiadefDknAkaf39Cuhly1HAmZ7BMxjibEnppoMK6oOPj5UHPl0KRBsANBBEunAqpJsFQB1/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('19','2','oPnnXjoafcYT2TVm3ndHAwgB3Or0','VaRZxPrg','1','0','0','1440165765','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('20','2','oPnnXjvuz5TdSdIVzR6spVlE3OwM','SJVzz0Y0','1','0','0','1440235066','a','a','http://wx.qlogo.cn/mmopen/VNDQtnw16icLm7Tialb60Uia3tMzkoEeiarThic62RoaSe3cv5NS2FJiaXyulIib55iaHTabGia3tvCHwkxibiaEiaf9AA8O8A/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('21','2','oPnnXjonpPspUJsxW2gtwThKI9DY','j9nkvGk9','0','0','0','1440180036','小哲','小哲','http://wx.qlogo.cn/mmopen/VNDQtnw16icJ2JiauIdmGwlNSX3VELIgwmssRUZnr0pXKhVEjbnA50LZd6Q1WL7kWPY6E7DAyWicBm3Qr5lRvdZFQ/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('22','2','oPnnXjgouwhXE5Ud-KFF6JKV19Y0','d7IBfeZ6','1','0','0','1440352095','、屹','、屹','http://wx.qlogo.cn/mmopen/XjXeicgRNwsiczbCD6BqTUiaAxcoxib9GJTyeEQu5ZsAJ2SBDhRiaAvl87a8MWibypTexSjicNgWF44V5ibAbrsXlGL7Z9ytz1TticDic9/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('23','2','oPnnXjrp3GLg3udsS117agP_nrXE','EC15HMC5','1','0','0','1440197912','黄5','黄5','http://wx.qlogo.cn/mmopen/I6TlfkuPEmKnMAK3VKVqYt1F5x2u82UCDYHVM7Ak720ne3oeiacWiaymLQYVAQ6BqoLWWIZDeoCboGpwgH0gZQq6KvG9H9SKIE/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('24','2','oPnnXjsIy2j_xiYU3WcHuVhV3CFU','J87rewX6','1','0','0','1440216977','阳光总在风雨后~','阳光总在风雨后~','http://wx.qlogo.cn/mmopen/I6TlfkuPEmIRAvwNdtDjiaRmLbsLNQ8tficoNlLaGh5ItyzgvoVT0U9yn1IIhvbcqga7glJP4Y28gcrE9EhA1icEh8el5DvrHDG/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('25','2','oPnnXjlsjyg3h7lSgKSXkKb-9EEc','E11q0HtX','1','0','0','1440379273','欧阳','欧阳','http://wx.qlogo.cn/mmopen/XjXeicgRNws9Oc0X0hlGKYng1UBibyzzQ00ML2uMLnGzbGPK4NT4tm7OkpAuhrsria7oETFD6EdO5mTlPLvQnyicKCWocficwZcCo/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('26','2','oPnnXjiY1DNf1JxYxJMDxydo3Xtg','eSBIgeme','1','0','0','1440230251','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('27','2','oPnnXjnViF9dbsX7-4OWYEHS76kc','xPxYmxWX','1','0','0','1440259088','合肥360度全景','合肥360度全景','http://wx.qlogo.cn/mmopen/XjXeicgRNws8zFSpNSgbN0xGENzQ9aDjFKoiaS3KoIgSQOTcPSJN9rlib2ooLlYHeDLNMWibzIY8icFWI4qUVBLI0K9LxdvnicwsHx/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('28','2','oPnnXjql-zgFLwtn09YOtd4yPzVA','R4WWfpet','1','0','0','1440320836','HunterX','HunterX','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDrX1RUOB3QRQb0wLdwuSoVAX6q39seaickvpI6ckQ1tcZndNRMqhL1G5Z5rblseLIfu5QbKKfdRVg/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('29','2','oPnnXjqA3s3HnRXLCcZB0jDQ2D8k','FGDTJatZ','1','0','0','1440321823','万兆亿✈微商运营','万兆亿✈微商运营','http://wx.qlogo.cn/mmopen/VNDQtnw16icJgjMib8ZYebMSibrbHiaN2GqK1Wcdq12IZWtZAzRHfFhicUMvwUibu1zn61tFKggSPumEXxslG7KbibqHQ/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('30','2','oPnnXjvlTxJPEx44fuQBdKOLbSxA','SF4XMHgX','1','0','0','1440322041','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('31','2','oPnnXjjY8t4RCQ5qWqfWegcZpJG0','GEnzFU9N','1','0','0','1440338258','赵玉广','赵玉广','http://wx.qlogo.cn/mmopen/I6TlfkuPEmIRAvwNdtDjiaRZZMQWZl3iaOHgDdxoGWT9RQiajjQML2fRk0k0L9E9YQ6OmJ9kkTd0bgqibTicZGsibdqeBYZCdsruRR/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('32','2','oPnnXjsT96bnU5v2V0DzR_bRprAE','yJ2KUjqR','1','0','0','1440384300','','','','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('33','2','oPnnXjlH6wpyvF_5_Bu-33L9-XZg','dtLi8LNC','1','0','0','1440403095','草莓奥特曼','草莓奥特曼','http://wx.qlogo.cn/mmopen/I6TlfkuPEmIRAvwNdtDjiaQZMs7ESbziaiaXiblcwEBHb1gvrVicBzRx0lNgLUaTc88w9JWQ18dKVunIzcQMFH7hnfMicFmY2oZIJx/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('34','2','oPnnXjhLl4j6Fn19b337JYe1pGgg','sG8bCtdP','1','0','0','1440408616','蔡黄建','蔡黄建','http://wx.qlogo.cn/mmopen/VNDQtnw16icKJcYDunYib9hapuNLu1uxw9Is8V1K1VOwz3ib5ibF9mxAuPwScKTbDaqr8qiccwsFhq6ztO4znmibaicf2kzcdJ6yZ6mnn1IviaPXg8U/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('35','2','oPnnXjrDFBRz8VGcEUkNFYt1aLe0','hAN5Dl5Q','1','0','0','1440417412','洞信','洞信','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4l7c5gvBpGh17JvDHnicJqS9QmrHevK5icgJJVJ9NTsSuWtazroUEgJKEfkma39S9ictfKuU5cTS2tQ/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
('36','2','oPnnXjrW36hLtPAufYMiCNU18c5U','L083a9a2','1','0','0','1440459713','台湾实戰移商學院 林','台湾实戰移商學院 林院长','http://wx.qlogo.cn/mmopen/XjXeicgRNwsiczbCD6BqTUiaHJzHDYbq31LucAYtliabq5QdGiaYZWI1x2TjzRbYKJpoe32d9w3Tonfedeq3EXsaUIM2pHIeq0htp/0','','','','0','0','0','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');


DROP TABLE IF EXISTS ims_members;
CREATE TABLE `ims_members` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(200) NOT NULL COMMENT '用户密码',
  `salt` varchar(10) NOT NULL COMMENT '加密盐',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态，0正常，-1禁用',
  `joindate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `joinip` varchar(15) NOT NULL DEFAULT '',
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(15) NOT NULL DEFAULT '',
  `remark` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

INSERT INTO ims_members VALUES 
('1','0','admin','4c568ba58cf4fbfc8a07cab3635744029fa9e3e1','f2a3d1b6','0','1432643707','','1440466261','120.197.62.169',''),
('2','1','weihangyun','4f651ba490e84874fee379cba9a60c5011148c66','a3c3GcdG','0','1440035998','120.197.62.169','1440231105','120.197.62.169','');


DROP TABLE IF EXISTS ims_members_group;
CREATE TABLE `ims_members_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `modules` varchar(5000) NOT NULL DEFAULT '',
  `templates` varchar(5000) NOT NULL DEFAULT '',
  `maxaccount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0为不限制',
  `maxsubaccount` int(10) unsigned NOT NULL COMMENT '子公号最多添加数量，为0为不可以添加',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_members_group VALUES 
('1','测试','a:11:{i:0;s:1:\"5\";i:1;s:1:\"7\";i:2;s:1:\"8\";i:3;s:1:\"9\";i:4;s:2:\"10\";i:5;s:2:\"11\";i:6;s:2:\"12\";i:7;s:2:\"13\";i:8;s:2:\"14\";i:9;s:2:\"15\";i:10;s:2:\"16\";}','a:2:{i:0;s:1:\"2\";i:1;s:1:\"3\";}','1','1');


DROP TABLE IF EXISTS ims_members_permission;
CREATE TABLE `ims_members_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `resourceid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为模块,2为模板',
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO ims_members_permission VALUES 
('1','2','5','1'),
('2','2','7','1'),
('3','2','8','1'),
('4','2','9','1'),
('5','2','10','1'),
('6','2','11','1'),
('7','2','12','1'),
('8','2','13','1'),
('9','2','14','1'),
('10','2','15','1'),
('11','2','16','1');


DROP TABLE IF EXISTS ims_members_profile;
CREATE TABLE `ims_members_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL COMMENT '加入时间',
  `realname` varchar(10) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(100) NOT NULL DEFAULT '' COMMENT '头像',
  `qq` varchar(15) NOT NULL DEFAULT '' COMMENT 'QQ号',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `fakeid` varchar(30) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'VIP级别,0为普通会员',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别(0:保密 1:男 2:女)',
  `birthyear` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '生日年',
  `birthmonth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '生日月',
  `birthday` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `constellation` varchar(10) NOT NULL DEFAULT '' COMMENT '星座',
  `zodiac` varchar(5) NOT NULL DEFAULT '' COMMENT '生肖',
  `telephone` varchar(15) NOT NULL DEFAULT '' COMMENT '固定电话',
  `idcard` varchar(30) NOT NULL DEFAULT '' COMMENT '证件号码',
  `studentid` varchar(50) NOT NULL DEFAULT '' COMMENT '学号',
  `grade` varchar(10) NOT NULL DEFAULT '' COMMENT '班级',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `zipcode` varchar(10) NOT NULL DEFAULT '' COMMENT '邮编',
  `nationality` varchar(30) NOT NULL DEFAULT '' COMMENT '国籍',
  `resideprovince` varchar(30) NOT NULL DEFAULT '' COMMENT '居住省份',
  `residecity` varchar(30) NOT NULL DEFAULT '' COMMENT '居住城市',
  `residedist` varchar(30) NOT NULL DEFAULT '' COMMENT '居住行政区/县',
  `graduateschool` varchar(50) NOT NULL DEFAULT '' COMMENT '毕业学校',
  `company` varchar(50) NOT NULL DEFAULT '' COMMENT '公司',
  `education` varchar(10) NOT NULL DEFAULT '' COMMENT '学历',
  `occupation` varchar(30) NOT NULL DEFAULT '' COMMENT '职业',
  `position` varchar(30) NOT NULL DEFAULT '' COMMENT '职位',
  `revenue` varchar(10) NOT NULL DEFAULT '' COMMENT '年收入',
  `affectivestatus` varchar(30) NOT NULL DEFAULT '' COMMENT '情感状态',
  `lookingfor` varchar(255) NOT NULL DEFAULT '' COMMENT ' 交友目的',
  `bloodtype` varchar(5) NOT NULL DEFAULT '' COMMENT '血型',
  `height` varchar(5) NOT NULL DEFAULT '' COMMENT '身高',
  `weight` varchar(5) NOT NULL DEFAULT '' COMMENT '体重',
  `alipay` varchar(30) NOT NULL DEFAULT '' COMMENT '支付宝帐号',
  `msn` varchar(30) NOT NULL DEFAULT '' COMMENT 'MSN',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `taobao` varchar(30) NOT NULL DEFAULT '' COMMENT '阿里旺旺',
  `site` varchar(30) NOT NULL DEFAULT '' COMMENT '主页',
  `bio` text NOT NULL COMMENT '自我介绍',
  `interest` text NOT NULL COMMENT '兴趣爱好',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_menu_event;
CREATE TABLE `ims_menu_event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT '事件类型',
  `picmd5` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`weid`),
  KEY `picmd5` (`picmd5`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS ims_modules;
CREATE TABLE `ims_modules` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '标识',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `version` varchar(10) NOT NULL DEFAULT '' COMMENT '版本',
  `ability` varchar(500) NOT NULL COMMENT '功能描述',
  `description` varchar(1000) NOT NULL COMMENT '介绍',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `url` varchar(255) NOT NULL COMMENT '发布页面',
  `settings` tinyint(1) NOT NULL DEFAULT '0' COMMENT '扩展设置项',
  `subscribes` varchar(500) NOT NULL DEFAULT '' COMMENT '订阅的消息类型',
  `handles` varchar(500) NOT NULL DEFAULT '' COMMENT '能够直接处理的消息类型',
  `isrulefields` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有规则嵌入项',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是系统模块',
  PRIMARY KEY (`mid`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ims_modules VALUES 
('1','basic','','基本文字回复','1.0','和您进行简单对话','一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.','WeEngine Team','http://www.we7.cc/','0','','','1','1'),
('2','news','','基本混合图文回复','1.0','为你提供生动的图文资讯','一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.','WeEngine Team','http://www.we7.cc/','0','','','1','1'),
('3','music','','基本语音回复','1.0','提供语音、音乐等音频类回复','在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。','WeEngine Team','http://www.we7.cc/','0','','','1','1'),
('4','userapi','','自定义接口回复','1.1','更方便的第三方接口设置','自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。','WeEngine Team','http://www.we7.cc/','0','','','1','1'),
('5','fans','customer','粉丝管理','1.2','关注的粉丝管理','','WeEngine Team','http://bbs.we7.cc/forum.php?mod=forumdisplay&fid=36&filter=typeid&typeid=1','0','a:8:{i:0;s:4:\"text\";i:1;s:5:\"image\";i:2;s:5:\"voice\";i:3;s:5:\"video\";i:4;s:8:\"location\";i:5;s:4:\"link\";i:6;s:9:\"subscribe\";i:7;s:11:\"unsubscribe\";}','a:0:{}','0','0'),
('6','member','customer','微会员','1.2','会员管理','会员管理','WeEngine Team','','0','a:0:{}','','0','1'),
('7','xsign','business','签到','1.0','签到','签到','微橙电商','','1','a:0:{}','a:1:{i:0;s:4:\"text\";}','1','0'),
('8','bj_qmxk','business','分销系统','2.8.5','分销系统','分销系统','分销系统','','1','a:1:{i:0;s:9:\"subscribe\";}','a:2:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";}','1','0'),
('9','stat','other','数据统计','1.3','提供消息记录及分析统计功能','能够提供按公众号码查询, 分析统计消息记录, 以及规则关键字命中情况统计','WeEngine Team','http://www.we7.cc','1','a:7:{i:0;s:4:\"text\";i:1;s:5:\"image\";i:2;s:8:\"location\";i:3;s:4:\"link\";i:4;s:9:\"subscribe\";i:5;s:11:\"unsubscribe\";i:6;s:5:\"click\";}','a:0:{}','0','0'),
('10','vote','activity','微投票','1.04','投票系统','图片、文字，单选，多选','WeEngine Team & ewei','','0','a:0:{}','a:1:{i:0;s:4:\"text\";}','1','0'),
('11','ppcrmtransfer','other','多客服转接','1.0.0','用来接入腾讯的多客服系统','','WeEngine Team','http://bbs.we7.cc','0','a:0:{}','a:6:{i:0;s:5:\"image\";i:1;s:5:\"voice\";i:2;s:5:\"video\";i:3;s:8:\"location\";i:4;s:4:\"link\";i:5;s:4:\"text\";}','1','0'),
('12','site','business','微文章(CMS)','2.1','展示一个手机网页来介绍你的公众号','','WeEngine Team','http://www.we7.cc','0','a:0:{}','a:1:{i:0;s:4:\"text\";}','1','0'),
('13','multisearch','services','万能查询','1.8','万能查询数据','万能查询数据','WeEngine Team','http://we7.cc','0','a:0:{}','a:1:{i:0;s:4:\"text\";}','1','0'),
('14','shopping','business','微商城','2.9.3','微商城','微商城','WeEngine Team & ewei','','1','a:0:{}','a:1:{i:0;s:4:\"text\";}','0','0'),
('15','bigwheel','activity','大转盘','1.1.2','大转盘营销抽奖','大转盘营销抽奖','ewei','','0','a:0:{}','a:1:{i:0;s:4:\"text\";}','1','0'),
('16','weihaom_wb','activity','踩白块','1.0','拆包装,踩虫子,抽老板耳光...无所不能','拆包装,踩虫子,抽老板耳光...无所不能','皓蓝 & WeEngine Team','','0','a:1:{i:0;s:4:\"text\";}','a:1:{i:0;s:4:\"text\";}','1','0');


DROP TABLE IF EXISTS ims_modules_bindings;
CREATE TABLE `ims_modules_bindings` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(30) NOT NULL DEFAULT '',
  `entry` varchar(10) NOT NULL DEFAULT '',
  `call` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL,
  `do` varchar(30) NOT NULL,
  `state` varchar(200) NOT NULL,
  `direct` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`),
  KEY `idx_module` (`module`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

INSERT INTO ims_modules_bindings VALUES 
('4','fans','menu','','粉丝列表','display','','0'),
('5','fans','profile','','我的资料','profile','','0'),
('6','member','menu','','消费密码管理','password','','0'),
('7','member','profile','','我的会员卡','mycard','','0'),
('8','member','menu','','优惠券管理','coupon','','0'),
('9','member','menu','','商家设置','store','','0'),
('10','member','menu','','会员管理','member','','0'),
('11','member','menu','','会员卡设置','card','','0'),
('12','member','cover','','优惠券入口设置','entrycoupon','','0'),
('13','member','cover','','会员卡入口设置','card','','0'),
('14','member','profile','','我的充值记录','mycredit','','0'),
('15','member','profile','','我的优惠券','entrycoupon','','0'),
('16','xsign','rule','','签到统计','record','','0'),
('17','xsign','home','gethometiles','','','','0'),
('18','bj_qmxk','cover','','购物入口设置','list','','0'),
('19','bj_qmxk','cover','','代理入口','fansindex','','0'),
('20','bj_qmxk','cover','','排行榜入口设置','phb','','0'),
('21','bj_qmxk','cover','','积分兑换入口设置','award','','0'),
('22','bj_qmxk','menu','','订单管理','order','','0'),
('23','bj_qmxk','menu','','会员管理','charge','','0'),
('24','bj_qmxk','menu','','代理管理','fansmanager','','0'),
('25','bj_qmxk','menu','','佣金审核','commission','','0'),
('26','bj_qmxk','menu','','商品管理','goods','','0'),
('27','bj_qmxk','menu','','积分兑换管理','credit','','0'),
('28','bj_qmxk','menu','','数据统计','statistics','','0'),
('29','bj_qmxk','menu','','配送支付设置','dispatch','','0'),
('30','bj_qmxk','menu','','专属二维码','Spread','','0'),
('33','bj_qmxk','menu','','广告促销设置','adv','','0'),
('34','bj_qmxk','menu','','首页类型设置','rules','','0'),
('35','bj_qmxk','menu','','消息通知设置','messagetmp','','0'),
('36','stat','menu','','聊天记录','history','','0'),
('37','stat','menu','','规则使用率','rule','','0'),
('38','stat','menu','','关键字命中率','keyword','','0'),
('39','vote','rule','','查看投票记录','votelist','','0'),
('40','vote','menu','','微投票管理','manage','','0'),
('41','vote','home','getItemTiles','','','','0'),
('42','site','menu','','文章管理','article','','0'),
('43','site','menu','','文章分类','category','','0'),
('44','site','home','getCategoryTiles','','','','0'),
('45','multisearch','menu','getMenuTiles','','','','0'),
('46','multisearch','menu','','查询数据结构管理','struct','','0'),
('47','shopping','cover','','商城入口设置','list','','0'),
('48','shopping','menu','','订单管理','order','','0'),
('49','shopping','menu','','商品管理','goods','','0'),
('50','shopping','menu','','商品分类','category','','0'),
('51','shopping','menu','','物流管理','express','','0'),
('52','shopping','menu','','配送方式','dispatch','','0'),
('53','shopping','menu','','幻灯片管理','adv','','0'),
('54','shopping','menu','','维权与告警','notice','','0'),
('55','shopping','home','','商城','list','','0'),
('56','shopping','profile','','我的订单','myorder','','0'),
('57','bigwheel','menu','','大转盘管理','manage','','0'),
('58','bigwheel','home','getItemTiles','','','','0');


DROP TABLE IF EXISTS ims_multisearch;
CREATE TABLE `ims_multisearch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `isresearch` tinyint(1) NOT NULL DEFAULT '0',
  `cover` varchar(255) NOT NULL DEFAULT '',
  `template` varchar(100) NOT NULL DEFAULT '',
  `status` varchar(1000) NOT NULL DEFAULT '',
  `noticeemail` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_multisearch_fields;
CREATE TABLE `ims_multisearch_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reid` int(10) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `variable` varchar(50) NOT NULL DEFAULT '',
  `bind` varchar(20) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `search` tinyint(1) NOT NULL DEFAULT '0',
  `likesearch` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `options` varchar(2000) NOT NULL DEFAULT '',
  `displayorder` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_reid` (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_multisearch_reply;
CREATE TABLE `ims_multisearch_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `reid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_multisearch_research;
CREATE TABLE `ims_multisearch_research` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `reid` int(10) unsigned NOT NULL,
  `rowid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `remark` varchar(1000) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_music_reply;
CREATE TABLE `ims_music_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
  `url` varchar(300) NOT NULL DEFAULT '' COMMENT '音乐地址',
  `hqurl` varchar(300) NOT NULL DEFAULT '' COMMENT '高清地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_news_reply;
CREATE TABLE `ims_news_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ims_news_reply VALUES 
('1','2','0','这里是默认图文回复','这里是默认图文描述','images/2013/01/d090d8e61995e971bb1f8c0772377d.png','这里是默认图文原文这里是默认图文原文这里是默认图文原文',''),
('2','2','1','这里是默认图文回复内容','','images/2013/01/112487e19d03eaecc5a9ac87537595.jpg','这里是默认图文回复原文这里是默认图文回复原文<br />',''),
('3','9','0','欢迎您关注维航微信分销系统','','/images/2/2015/08/hfJm6Mg3fFD67nz2FNN3nnnFz3fMsN.gif','<p>欢迎你关注维航微信分销系统，期待与您合作！</p><p>购买电话：13851734013 QQ:86165698</p>','');


DROP TABLE IF EXISTS ims_paylog;
CREATE TABLE `ims_paylog` (
  `plid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL DEFAULT '',
  `weid` int(11) NOT NULL,
  `openid` varchar(40) NOT NULL DEFAULT '',
  `tid` varchar(64) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `module` varchar(50) NOT NULL DEFAULT '',
  `tag` varchar(2000) NOT NULL DEFAULT '',
  PRIMARY KEY (`plid`),
  KEY `idx_weid` (`weid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_tid` (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=2015082026 DEFAULT CHARSET=utf8;

INSERT INTO ims_paylog VALUES 
('2015082010','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','1','5000.00','0','bj_qmxk',''),
('2015082011','wechat','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','2','5000.00','0','bj_qmxk',''),
('2015082012','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','3','100.00','0','bj_qmxk',''),
('2015082013','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','5','80.00','0','bj_qmxk',''),
('2015082014','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','6','80.00','0','bj_qmxk',''),
('2015082015','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','7','100.00','0','bj_qmxk',''),
('2015082016','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','8','4688.00','0','bj_qmxk',''),
('2015082017','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','9','60.00','0','bj_qmxk',''),
('2015082018','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','10','4688.00','0','bj_qmxk',''),
('2015082019','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','11','3210.00','0','bj_qmxk',''),
('2015082020','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','12','3500.00','0','bj_qmxk',''),
('2015082021','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','13','2099.00','0','bj_qmxk',''),
('2015082022','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','14','4688.00','0','bj_qmxk',''),
('2015082023','wechat','2','oPnnXjt7uKBidn0MXwm3UiaRHHP4','15','4688.00','0','bj_qmxk',''),
('2015082024','wechat','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','18','2099.00','0','bj_qmxk',''),
('2015082025','wechat','2','oPnnXjtKc-3bI8s48GyRP6v74k0o','tr201508240110200676','100.00','0','bj_qmxk','');


DROP TABLE IF EXISTS ims_profile_fields;
CREATE TABLE `ims_profile_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否必填',
  `unchangeable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否不可修改',
  `showinregister` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示在注册表单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO ims_profile_fields VALUES 
('1','realname','1','真实姓名','','0','1','1','1'),
('2','nickname','1','昵称','','1','1','0','1'),
('3','avatar','1','头像','','1','0','0','0'),
('4','qq','1','QQ号','','0','0','0','1'),
('5','mobile','1','手机号码','','0','0','0','0'),
('6','vip','1','VIP级别','','0','0','0','0'),
('7','gender','1','性别','','0','0','0','0'),
('8','birthyear','1','出生生日','','0','0','0','0'),
('9','constellation','1','星座','','0','0','0','0'),
('10','zodiac','1','生肖','','0','0','0','0'),
('11','telephone','1','固定电话','','0','0','0','0'),
('12','idcard','1','证件号码','','0','0','0','0'),
('13','studentid','1','学号','','0','0','0','0'),
('14','grade','1','班级','','0','0','0','0'),
('15','address','1','邮寄地址','','0','0','0','0'),
('16','zipcode','1','邮编','','0','0','0','0'),
('17','nationality','1','国籍','','0','0','0','0'),
('18','resideprovince','1','居住地址','','0','0','0','0'),
('19','graduateschool','1','毕业学校','','0','0','0','0'),
('20','company','1','公司','','0','0','0','0'),
('21','education','1','学历','','0','0','0','0'),
('22','occupation','1','职业','','0','0','0','0'),
('23','position','1','职位','','0','0','0','0'),
('24','revenue','1','年收入','','0','0','0','0'),
('25','affectivestatus','1','情感状态','','0','0','0','0'),
('26','lookingfor','1',' 交友目的','','0','0','0','0'),
('27','bloodtype','1','血型','','0','0','0','0'),
('28','height','1','身高','','0','0','0','0'),
('29','weight','1','体重','','0','0','0','0'),
('30','alipay','1','支付宝帐号','','0','0','0','0'),
('31','msn','1','MSN','','0','0','0','0'),
('32','email','1','电子邮箱','','0','0','0','0'),
('33','taobao','1','阿里旺旺','','0','0','0','0'),
('34','site','1','主页','','0','0','0','0'),
('35','bio','1','自我介绍','','0','0','0','0'),
('36','interest','1','兴趣爱好','','0','0','0','0');


DROP TABLE IF EXISTS ims_rule;
CREATE TABLE `ims_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `cid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `name` varchar(50) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '规则状态，0禁用，1启用，2置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO ims_rule VALUES 
('1','1','0','默认文字回复','basic','0','1'),
('2','1','0','默认图文回复','news','0','1'),
('3','2','0','购物入口设置','cover','0','1'),
('4','2','0','签到','xsign','0','1'),
('5','2','0','大转盘','bigwheel','0','1'),
('6','2','0','代理入口','cover','0','1'),
('7','2','0','排行榜入口设置','cover','0','1'),
('8','2','0','分销专属二维码(系统维护)','bj_qmxk','0','1'),
('9','2','0','欢迎您','news','0','1'),
('10','2','0','投票','vote','0','1'),
('11','2','0','积分兑换入口设置','cover','0','1'),
('12','2','0','客服','ppcrmtransfer','0','1');


DROP TABLE IF EXISTS ims_rule_keyword;
CREATE TABLE `ims_rule_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则ID',
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `module` varchar(50) NOT NULL COMMENT '对应模块',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型1匹配，2包含，3正则',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '规则排序，255为置顶，其它为普通排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '规则状态，0禁用，1启用',
  PRIMARY KEY (`id`),
  KEY `idx_content` (`content`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO ims_rule_keyword VALUES 
('1','1','1','basic','文字','2','1','1'),
('2','2','1','news','图文','2','1','1'),
('3','3','2','cover','购物商城','1','0','1'),
('4','4','2','xsign','签到','1','0','1'),
('5','5','2','bigwheel','大转盘','1','0','1'),
('6','6','2','cover','代理中心','1','0','1'),
('7','7','2','cover','排行榜','1','0','1'),
('8','8','2','bj_qmxk','分销专属二维码','1','0','1'),
('15','9','2','news','欢迎关注','1','0','1'),
('10','10','2','vote','投票','1','0','1'),
('11','11','2','cover','积分兑换','1','0','1'),
('12','12','2','ppcrmtransfer','','4','0','1');


DROP TABLE IF EXISTS ims_settings;
CREATE TABLE `ims_settings` (
  `key` varchar(200) NOT NULL COMMENT '设置键名',
  `value` text NOT NULL COMMENT '设置内容，大量数据将序列化',
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ims_settings VALUES 
('site','a:2:{s:3:\"key\";s:5:\"36886\";s:5:\"token\";s:32:\"f219b0b7f6ee14105bbb121900ed1818\";}'),
('basic','a:1:{s:8:\"template\";s:5:\"wdl06\";}');


DROP TABLE IF EXISTS ims_shopping_address;
CREATE TABLE `ims_shopping_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_adv;
CREATE TABLE `ims_shopping_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_enabled` (`enabled`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_cart;
CREATE TABLE `ims_shopping_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `goodsid` int(11) NOT NULL,
  `goodstype` tinyint(1) NOT NULL DEFAULT '1',
  `from_user` varchar(50) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `optionid` int(10) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_openid` (`from_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_category;
CREATE TABLE `ims_shopping_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) NOT NULL COMMENT '分类介绍',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_dispatch;
CREATE TABLE `ims_shopping_dispatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `dispatchname` varchar(50) DEFAULT '',
  `dispatchtype` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `firstprice` decimal(10,2) DEFAULT '0.00',
  `secondprice` decimal(10,2) DEFAULT '0.00',
  `firstweight` int(11) DEFAULT '0',
  `secondweight` int(11) DEFAULT '0',
  `express` int(11) DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ims_shopping_dispatch VALUES 
('1','2','付款发货','0','0','20.00','10.00','2000','1000','0',''),
('2','2','货到付款','1','0','30.00','10.00','2000','1000','0','');


DROP TABLE IF EXISTS ims_shopping_express;
CREATE TABLE `ims_shopping_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `express_name` varchar(50) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `express_price` varchar(10) DEFAULT '',
  `express_area` varchar(100) DEFAULT '',
  `express_url` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ims_shopping_express VALUES 
('1','2','顺丰','0','','','shunfeng'),
('2','2','申通','0','','','shentong');


DROP TABLE IF EXISTS ims_shopping_feedback;
CREATE TABLE `ims_shopping_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为维权，2为告擎',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态0未解决，1用户同意，2用户拒绝',
  `feedbackid` varchar(30) NOT NULL COMMENT '投诉单号',
  `transid` varchar(30) NOT NULL COMMENT '订单号',
  `reason` varchar(1000) NOT NULL COMMENT '理由',
  `solution` varchar(1000) NOT NULL COMMENT '期待解决方案',
  `remark` varchar(1000) NOT NULL COMMENT '备注',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_weid` (`weid`),
  KEY `idx_feedbackid` (`feedbackid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_transid` (`transid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_goods;
CREATE TABLE `ims_shopping_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL DEFAULT '0',
  `ccate` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为实体，2为虚拟',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `unit` varchar(5) NOT NULL DEFAULT '',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `goodssn` varchar(50) NOT NULL DEFAULT '',
  `productsn` varchar(50) NOT NULL DEFAULT '',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `costprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` int(10) NOT NULL DEFAULT '0',
  `totalcnf` int(11) DEFAULT '0' COMMENT '0 拍下减库存 1 付款减库存 2 永久不减',
  `sales` int(10) unsigned NOT NULL DEFAULT '0',
  `spec` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit` int(11) DEFAULT '0',
  `maxbuy` int(11) DEFAULT '0',
  `hasoption` int(11) DEFAULT '0',
  `dispatch` int(11) DEFAULT '0',
  `thumb_url` text,
  `isnew` int(11) DEFAULT '0',
  `ishot` int(11) DEFAULT '0',
  `isdiscount` int(11) DEFAULT '0',
  `isrecommand` int(11) DEFAULT '0',
  `istime` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `viewcount` int(11) DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_goods_option;
CREATE TABLE `ims_shopping_goods_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_goods_param;
CREATE TABLE `ims_shopping_goods_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `value` text,
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_order;
CREATE TABLE `ims_shopping_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `ordersn` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '-1取消状态，0普通状态，1为已付款，2为已发货，3为成功',
  `sendtype` tinyint(1) unsigned NOT NULL COMMENT '1为快递，2为自提',
  `paytype` tinyint(1) unsigned NOT NULL COMMENT '1为余额，2为在线，3为到付',
  `transid` varchar(30) NOT NULL DEFAULT '0' COMMENT '微信支付单号',
  `goodstype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(1000) NOT NULL DEFAULT '',
  `addressid` int(10) unsigned NOT NULL,
  `expresscom` varchar(30) NOT NULL DEFAULT '',
  `expresssn` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(200) NOT NULL DEFAULT '',
  `goodsprice` decimal(10,2) DEFAULT '0.00',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatch` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_order_goods;
CREATE TABLE `ims_shopping_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `orderid` int(10) unsigned NOT NULL,
  `goodsid` int(10) unsigned NOT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(10) unsigned NOT NULL DEFAULT '1',
  `optionid` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `optionname` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_product;
CREATE TABLE `ims_shopping_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL,
  `productsn` varchar(50) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `marketprice` decimal(10,0) unsigned NOT NULL,
  `productprice` decimal(10,0) unsigned NOT NULL,
  `total` int(11) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `spec` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_goodsid` (`goodsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_spec;
CREATE TABLE `ims_shopping_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `displaytype` tinyint(3) unsigned NOT NULL,
  `content` text NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_shopping_spec_item;
CREATE TABLE `ims_shopping_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_specid` (`specid`),
  KEY `indx_show` (`show`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_site_nav;
CREATE TABLE `ims_site_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL DEFAULT '',
  `displayorder` smallint(5) unsigned NOT NULL COMMENT '排序',
  `name` varchar(50) NOT NULL COMMENT '导航名称',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `position` tinyint(4) NOT NULL DEFAULT '1' COMMENT '显示位置，1首页，2个人中心',
  `url` varchar(500) NOT NULL DEFAULT '' COMMENT '链接地址',
  `icon` varchar(500) NOT NULL DEFAULT '' COMMENT '图标',
  `css` varchar(1000) NOT NULL DEFAULT '' COMMENT '扩展CSS',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0为隐藏，1为显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_site_slide;
CREATE TABLE `ims_site_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `displayorder` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `weid` (`weid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_site_styles;
CREATE TABLE `ims_site_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `templateid` int(10) unsigned NOT NULL COMMENT '风格ID',
  `variable` varchar(50) NOT NULL COMMENT '模板预设变量',
  `content` text NOT NULL COMMENT '变量值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ims_site_styles VALUES 
('1','1','1','indexbgcolor','#e06666'),
('2','1','1','fontfamily','Tahoma,Helvetica,\'SimSun\',sans-serif'),
('3','1','1','fontsize','12px/1.5'),
('4','1','1','fontcolor','#434343'),
('5','1','1','fontnavcolor','#ffffff'),
('6','1','1','linkcolor','#ffffff'),
('7','1','1','indexbgimg','bg_index.jpg');


DROP TABLE IF EXISTS ims_site_templates;
CREATE TABLE `ims_site_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '标识',
  `title` varchar(30) NOT NULL COMMENT '名称',
  `description` varchar(500) NOT NULL DEFAULT '' COMMENT '描述',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '发布页面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ims_site_templates VALUES 
('1','default','微站默认模板','由微擎提供默认微站模板套系','微擎团队','http://we7.cc'),
('2','style2','微站默认模板2','由微擎提供默认微站模板套系','WeEngine Team','http://bbs.we7.cc'),
('3','style1','微站默认模板1','由微擎提供默认微站模板套系','WeEngine Team','http://bbs.we7.cc');


DROP TABLE IF EXISTS ims_stat_keyword;
CREATE TABLE `ims_stat_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '所属帐号ID',
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `kid` int(10) unsigned NOT NULL COMMENT '关键字ID',
  `hit` int(10) unsigned NOT NULL COMMENT '命中次数',
  `lastupdate` int(10) unsigned NOT NULL COMMENT '最后触发时间',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ims_stat_keyword VALUES 
('1','2','4','4','4','1440083152','1440000000'),
('2','2','3','3','1','1440039227','1440000000'),
('3','2','5','5','3','1440058918','1440000000'),
('4','2','8','8','3','1440062006','1440000000'),
('5','2','9','9','1','1440041021','1440000000'),
('6','2','10','10','2','1440058954','1440000000'),
('7','2','4','4','2','1440165827','1440086400'),
('8','2','8','8','2','1440259084','1440172800'),
('9','2','10','10','1','1440180008','1440172800'),
('10','2','5','5','1','1440180012','1440172800'),
('11','2','4','4','2','1440213019','1440172800'),
('12','2','5','5','3','1440344306','1440259200'),
('13','2','4','4','1','1440344679','1440259200'),
('14','2','4','4','2','1440350211','1440345600'),
('15','2','5','5','2','1440408551','1440345600'),
('16','2','10','10','3','1440350224','1440345600');


DROP TABLE IF EXISTS ims_stat_msg_history;
CREATE TABLE `ims_stat_msg_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '所属帐号ID',
  `rid` int(10) unsigned NOT NULL COMMENT '命中规则ID',
  `kid` int(10) unsigned NOT NULL COMMENT '命中关键字ID',
  `from_user` varchar(50) NOT NULL COMMENT '用户的唯一身份ID',
  `module` varchar(50) NOT NULL COMMENT '命中模块',
  `message` varchar(1000) NOT NULL COMMENT '用户发送的消息',
  `type` varchar(10) NOT NULL DEFAULT '' COMMENT '消息类型',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

INSERT INTO ims_stat_msg_history VALUES 
('1','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440037265'),
('2','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','welcome','','event','1440037289'),
('3','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440037292'),
('4','2','4','4','oPnnXjt7uKBidn0MXwm3UiaRHHP4','xsign','签到','text','1440038674'),
('5','2','0','0','oPnnXjtJHYvR36LwQw52X2UopHaQ','default','','event','1440039200'),
('6','2','3','3','oPnnXjt7uKBidn0MXwm3UiaRHHP4','cover','购物商城','event','1440039227'),
('7','2','0','0','oPnnXjtKc-3bI8s48GyRP6v74k0o','default','','event','1440039410'),
('8','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440039604'),
('9','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440039702'),
('10','2','0','0','oPnnXjtKc-3bI8s48GyRP6v74k0o','default','','event','1440039723'),
('11','2','0','0','oPnnXjtKc-3bI8s48GyRP6v74k0o','default','','event','1440039737'),
('12','2','0','0','oPnnXjtKc-3bI8s48GyRP6v74k0o','default','','event','1440039739'),
('13','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440039751'),
('14','2','5','5','oPnnXjt7uKBidn0MXwm3UiaRHHP4','bigwheel','大转盘','event','1440039762'),
('15','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440039855'),
('16','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440039922'),
('17','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440040000'),
('18','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440040148'),
('19','2','8','8','oPnnXjgdCoOh7n2LZ-X474y26KSY','bj_qmxk','分销专属二维码','event','1440040373'),
('20','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440040544'),
('21','2','5','5','oPnnXjt7uKBidn0MXwm3UiaRHHP4','bigwheel','大转盘','event','1440040879'),
('22','2','9','9','oPnnXjt7uKBidn0MXwm3UiaRHHP4','news','欢迎关注','text','1440041021'),
('23','2','0','0','oPnnXjvv49slQRwm3QnKhRpfZoF0','welcome','','event','1440048578'),
('24','2','0','0','oPnnXjvv49slQRwm3QnKhRpfZoF0','default','','event','1440048586'),
('25','2','0','0','oPnnXjlSDNgCBgvz-L5j1zHs85DQ','default','','event','1440049684'),
('26','2','0','0','oPnnXjlSDNgCBgvz-L5j1zHs85DQ','default','','event','1440049688'),
('27','2','0','0','oPnnXjlSDNgCBgvz-L5j1zHs85DQ','default','qr','event','1440049692'),
('28','2','0','0','oPnnXjlSDNgCBgvz-L5j1zHs85DQ','default','','event','1440049699'),
('29','2','0','0','oPnnXjlSDNgCBgvz-L5j1zHs85DQ','default','','event','1440049707'),
('30','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440051006'),
('31','2','10','10','oPnnXjt7uKBidn0MXwm3UiaRHHP4','vote','投票','event','1440051868'),
('32','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440051877'),
('33','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440052951'),
('34','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440053212'),
('35','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440053926'),
('36','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440053975'),
('37','2','4','4','oPnnXjt7uKBidn0MXwm3UiaRHHP4','xsign','签到','event','1440054091'),
('38','2','0','0','oPnnXjt7uKBidn0MXwm3UiaRHHP4','default','','event','1440054106');


DROP TABLE IF EXISTS ims_stat_rule;
CREATE TABLE `ims_stat_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '所属帐号ID',
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `hit` int(10) unsigned NOT NULL COMMENT '命中次数',
  `lastupdate` int(10) unsigned NOT NULL COMMENT '最后触发时间',
  `createtime` int(10) unsigned NOT NULL COMMENT '记录新建的日期',
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

INSERT INTO ims_stat_rule VALUES 
('1','2','0','1','1440037265','1440000000'),
('2','2','0','1','1440037289','1440000000'),
('3','2','0','1','1440037292','1440000000'),
('4','2','4','4','1440083152','1440000000'),
('5','2','0','1','1440039200','1440000000'),
('6','2','3','1','1440039227','1440000000'),
('7','2','0','1','1440039410','1440000000'),
('8','2','0','1','1440039604','1440000000'),
('9','2','0','1','1440039702','1440000000'),
('10','2','0','1','1440039723','1440000000'),
('11','2','0','1','1440039737','1440000000'),
('12','2','0','1','1440039739','1440000000'),
('13','2','0','1','1440039751','1440000000'),
('14','2','5','3','1440058918','1440000000'),
('15','2','0','1','1440039855','1440000000'),
('16','2','0','1','1440039922','1440000000'),
('17','2','0','1','1440040000','1440000000'),
('18','2','0','1','1440040148','1440000000'),
('19','2','8','3','1440062006','1440000000'),
('20','2','0','1','1440040544','1440000000'),
('21','2','9','1','1440041021','1440000000'),
('22','2','0','1','1440048578','1440000000'),
('23','2','0','1','1440048586','1440000000'),
('24','2','0','1','1440049684','1440000000'),
('25','2','0','1','1440049688','1440000000'),
('26','2','0','1','1440049692','1440000000'),
('27','2','0','1','1440049699','1440000000'),
('28','2','0','1','1440049707','1440000000'),
('29','2','0','1','1440051006','1440000000'),
('30','2','10','2','1440058954','1440000000'),
('31','2','0','1','1440051877','1440000000'),
('32','2','0','1','1440052951','1440000000'),
('33','2','0','1','1440053212','1440000000'),
('34','2','0','1','1440053926','1440000000'),
('35','2','0','1','1440053975','1440000000'),
('36','2','0','1','1440054106','1440000000'),
('37','2','0','1','1440056192','1440000000'),
('38','2','0','1','1440058109','1440000000'),
('39','2','0','1','1440058203','1440000000'),
('40','2','0','1','1440058385','1440000000'),
('41','2','0','1','1440058520','1440000000'),
('42','2','0','1','1440058540','1440000000'),
('43','2','0','1','1440058755','1440000000'),
('44','2','0','1','1440058960','1440000000'),
('45','2','0','1','1440058968','1440000000'),
('46','2','0','1','1440059128','1440000000'),
('47','2','0','1','1440059215','1440000000'),
('48','2','0','1','1440059290','1440000000'),
('49','2','0','1','1440059349','1440000000'),
('50','2','0','1','1440059433','1440000000'),
('51','2','0','1','1440059507','1440000000'),
('52','2','0','1','1440059557','1440000000'),
('53','2','0','1','1440059643','1440000000'),
('54','2','0','1','1440059718','1440000000'),
('55','2','0','1','1440059901','1440000000'),
('56','2','0','1','1440060001','1440000000'),
('57','2','0','1','1440060189','1440000000'),
('58','2','0','1','1440061658','1440000000'),
('59','2','0','1','1440061720','1440000000'),
('60','2','0','1','1440063108','1440000000'),
('61','2','0','1','1440063166','1440000000'),
('62','2','0','1','1440063197','1440000000'),
('63','2','0','1','1440069424','1440000000'),
('64','2','0','1','1440074177','1440000000'),
('65','2','0','1','1440082485','1440000000'),
('66','2','0','1','1440082746','1440000000'),
('67','2','0','1','1440082858','1440000000'),
('68','2','0','1','1440082865','1440000000'),
('69','2','0','1','1440083178','1440000000'),
('70','2','0','1','1440128683','1440086400'),
('71','2','0','1','1440128953','1440086400'),
('72','2','0','1','1440128958','1440086400'),
('73','2','0','1','1440132764','1440086400'),
('74','2','0','1','1440137612','1440086400'),
('75','2','0','1','1440143201','1440086400'),
('76','2','0','1','1440145991','1440086400'),
('77','2','0','1','1440146034','1440086400'),
('78','2','0','1','1440154417','1440086400'),
('79','2','0','1','1440155393','1440086400'),
('80','2','0','1','1440155407','1440086400'),
('81','2','0','1','1440160548','1440086400'),
('82','2','0','1','1440164918','1440086400'),
('83','2','0','1','1440164933','1440086400'),
('84','2','0','1','1440165429','1440086400'),
('85','2','0','1','1440165437','1440086400'),
('86','2','0','1','1440165764','1440086400'),
('87','2','4','2','1440165827','1440086400'),
('88','2','0','1','1440166864','1440086400'),
('89','2','0','1','1440166879','1440086400'),
('90','2','0','1','1440170029','1440086400'),
('91','2','0','1','1440170243','1440086400'),
('92','2','0','1','1440179672','1440172800'),
('93','2','8','2','1440259084','1440172800'),
('94','2','0','1','1440179692','1440172800'),
('95','2','0','1','1440179783','1440172800'),
('96','2','10','1','1440180008','1440172800'),
('97','2','5','1','1440180012','1440172800'),
('98','2','0','1','1440180035','1440172800'),
('99','2','0','1','1440186042','1440172800'),
('100','2','0','1','1440186121','1440172800'),
('101','2','0','1','1440186127','1440172800'),
('102','2','0','1','1440186138','1440172800'),
('103','2','0','1','1440186188','1440172800'),
('104','2','0','1','1440186401','1440172800'),
('105','2','0','1','1440197801','1440172800'),
('106','2','0','1','1440197912','1440172800'),
('107','2','4','2','1440213019','1440172800'),
('108','2','0','1','1440216876','1440172800'),
('109','2','0','1','1440216941','1440172800'),
('110','2','0','1','1440224672','1440172800'),
('111','2','0','1','1440230243','1440172800'),
('112','2','0','1','1440230251','1440172800'),
('113','2','0','1','1440230495','1440172800'),
('114','2','0','1','1440230738','1440172800'),
('115','2','0','1','1440230775','1440172800'),
('116','2','0','1','1440230819','1440172800'),
('117','2','0','1','1440230970','1440172800'),
('118','2','0','1','1440231006','1440172800'),
('119','2','0','1','1440231165','1440172800'),
('120','2','0','1','1440231200','1440172800'),
('121','2','0','1','1440231237','1440172800'),
('122','2','0','1','1440231319','1440172800'),
('123','2','0','1','1440231399','1440172800'),
('124','2','0','1','1440231671','1440172800'),
('125','2','0','1','1440231789','1440172800'),
('126','2','0','1','1440231819','1440172800'),
('127','2','0','1','1440232075','1440172800'),
('128','2','0','1','1440234454','1440172800'),
('129','2','0','1','1440259074','1440172800'),
('130','2','0','1','1440316888','1440259200'),
('131','2','0','1','1440316926','1440259200'),
('132','2','5','3','1440344306','1440259200'),
('133','2','0','1','1440316964','1440259200'),
('134','2','0','1','1440317719','1440259200'),
('135','2','0','1','1440320836','1440259200'),
('136','2','0','1','1440321774','1440259200'),
('137','2','0','1','1440322041','1440259200'),
('138','2','0','1','1440338134','1440259200'),
('139','2','0','1','1440338187','1440259200'),
('140','2','0','1','1440344265','1440259200'),
('141','2','0','1','1440344333','1440259200'),
('142','2','0','1','1440344549','1440259200'),
('143','2','4','1','1440344679','1440259200'),
('144','2','0','1','1440348743','1440345600'),
('145','2','0','1','1440349524','1440345600'),
('146','2','0','1','1440349596','1440345600'),
('147','2','0','1','1440349727','1440345600'),
('148','2','0','1','1440349840','1440345600'),
('149','2','4','2','1440350211','1440345600'),
('150','2','0','1','1440349917','1440345600'),
('151','2','0','1','1440349925','1440345600'),
('152','2','5','2','1440408551','1440345600'),
('153','2','10','3','1440350224','1440345600'),
('154','2','0','1','1440349967','1440345600'),
('155','2','0','1','1440352036','1440345600'),
('156','2','0','1','1440352095','1440345600'),
('157','2','0','1','1440379273','1440345600'),
('158','2','0','1','1440384300','1440345600'),
('159','2','0','1','1440403055','1440345600'),
('160','2','0','1','1440403088','1440345600'),
('161','2','0','1','1440403094','1440345600'),
('162','2','0','1','1440408471','1440345600'),
('163','2','0','1','1440408478','1440345600'),
('164','2','0','1','1440408615','1440345600'),
('165','2','0','1','1440417401','1440345600'),
('166','2','0','1','1440417412','1440345600'),
('167','2','0','1','1440422337','1440345600'),
('168','2','0','1','1440459365','1440432000'),
('169','2','0','1','1440459371','1440432000'),
('170','2','0','1','1440459565','1440432000'),
('171','2','0','1','1440459713','1440432000'),
('172','2','0','1','1440461297','1440432000');


DROP TABLE IF EXISTS ims_userapi_cache;
CREATE TABLE `ims_userapi_cache` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL COMMENT 'apiurl缓存标识',
  `content` text NOT NULL COMMENT '回复内容',
  `lastupdate` int(10) unsigned NOT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_userapi_reply;
CREATE TABLE `ims_userapi_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `description` varchar(300) NOT NULL DEFAULT '',
  `apiurl` varchar(300) NOT NULL DEFAULT '' COMMENT '接口地址',
  `token` varchar(32) NOT NULL DEFAULT '',
  `default_text` varchar(100) NOT NULL DEFAULT '' COMMENT '默认回复文字',
  `cachetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '返回数据的缓存时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_vote_fans;
CREATE TABLE `ims_vote_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` varchar(50) DEFAULT '',
  `rid` int(11) DEFAULT '0',
  `votes` varchar(255) DEFAULT '',
  `votetime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_votetime` (`votetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_vote_option;
CREATE TABLE `ims_vote_option` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `content` text,
  `vote_num` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_vote_reply;
CREATE TABLE `ims_vote_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) DEFAULT '0',
  `weid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `votetype` tinyint(4) DEFAULT '0',
  `votetotal` int(10) DEFAULT '0',
  `status` int(10) DEFAULT '0',
  `votenum` int(10) DEFAULT '0',
  `votetimes` int(10) DEFAULT '0',
  `votelimit` int(10) DEFAULT '0',
  `viewnum` int(10) DEFAULT '0',
  `starttime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `isimg` int(10) DEFAULT '0',
  `isshow` int(10) DEFAULT '0',
  `share_title` varchar(200) DEFAULT '',
  `share_desc` varchar(300) DEFAULT '',
  `share_url` varchar(100) DEFAULT '',
  `share_txt` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_weid` (`weid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_vote_reply VALUES 
('1','10','2','投票','','images/2/2015/08/LidsZ1F6b1dDWDUiz27dIYDdY2dBL7.jpg','0','0','1','0','0','0','2','1440049320','1451468460','0','1','欢迎参加投票活动','亲，欢迎参加投票活动！ 亲，需要绑定账号才可以参加哦','','&lt;p&gt;1. 关注微信公众账号&quot;()&quot;&lt;/p&gt;&lt;p&gt;2. 发送消息&quot;投票&quot;, 点击返回的消息即可参加&lt;/p&gt;');


DROP TABLE IF EXISTS ims_wechats;
CREATE TABLE `ims_wechats` (
  `weid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` char(5) NOT NULL COMMENT '用户标识. 随机生成保持不重复',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '公众号类型，1微信，2易信',
  `uid` int(10) unsigned NOT NULL COMMENT '关联的用户',
  `token` varchar(32) NOT NULL COMMENT '随机生成密钥',
  `EncodingAESKey` varchar(43) NOT NULL,
  `access_token` varchar(1000) NOT NULL DEFAULT '' COMMENT '存取凭证结构',
  `level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '接口权限级别, 0 普通订阅号, 1 认证订阅号|普通服务号, 2认证服务号',
  `name` varchar(30) NOT NULL COMMENT '公众号名称',
  `account` varchar(30) NOT NULL COMMENT '微信帐号',
  `original` varchar(50) NOT NULL,
  `signature` varchar(100) NOT NULL COMMENT '功能介绍',
  `country` varchar(10) NOT NULL,
  `province` varchar(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `welcome` varchar(1000) NOT NULL,
  `default` varchar(1000) NOT NULL,
  `default_message` varchar(500) NOT NULL DEFAULT '' COMMENT '其他消息类型默认处理器',
  `default_period` tinyint(3) unsigned NOT NULL COMMENT '回复周期时间',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `styleid` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '风格ID',
  `payment` varchar(5000) NOT NULL DEFAULT '',
  `shortcuts` varchar(2000) NOT NULL DEFAULT '',
  `quickmenu` varchar(2000) NOT NULL DEFAULT '',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `subwechats` varchar(1000) NOT NULL DEFAULT '',
  `siteinfo` varchar(1000) NOT NULL DEFAULT '',
  `menuset` text NOT NULL,
  `jsapi_ticket` varchar(1000) NOT NULL,
  PRIMARY KEY (`weid`),
  UNIQUE KEY `hash` (`hash`),
  KEY `idx_parentid` (`parentid`),
  KEY `idx_key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ims_wechats VALUES 
('1','56e91','1','1','888a25d3cdd93464a60514959b927f0a','','','0','默认公众号','默认公众号','','','','','','','','欢迎信息','默认回复','','0','0','','','1','','','','0','','','',''),
('2','MNhsM','1','2','J4UjNN8y040Aq84YQeNa4sa0AJH8q85U','M7R9ZWUVl9tPLV7D1J4LPTL73ExWTdpLttD77X1JX7C','a:2:{s:5:\"token\";s:107:\"ZibeRGXTKqNelY9Hp1vxdjviWvj_U07fV3zI5FnY78Ibdb6bMLTXN7y2bPqhXtoV3z__b8aWHqku96Msmx3941CTEuEnN90dh5ZHxdcpiLc\";s:6:\"expire\";i:1440466575;}','2','维航','lqxycom','gh_7452496dad4e','南京维航网络科技有限公司是南京的一家互联网科技公司，总部位于古都南京的秦淮区，由卢孙荣先生创办。南京维航网络科技有限公的主要服务有企业网络营销企划、网络营销人才培训、WIFI广告路由系统建设、以及微营','','','','86165698@qq.com','babed45e10eca04905fb8ed26374e23a','a:2:{s:6:\"module\";s:4:\"news\";s:2:\"id\";i:9;}','','','0','1440036396','wx87d75870a3e2636e','6671e8034bd52d0b142ac3dde85eebe8','1','a:5:{s:6:\"credit\";a:1:{s:6:\"switch\";b:1;}s:6:\"alipay\";a:4:{s:6:\"switch\";b:0;s:7:\"account\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:6:\"secret\";s:0:\"\";}s:6:\"wechat\";a:8:{s:6:\"switch\";b:1;s:5:\"appid\";s:18:\"wx87d75870a3e2636e\";s:6:\"secret\";s:32:\"6671e8034bd52d0b142ac3dde85eebe8\";s:7:\"signkey\";s:32:\"CaD7YZ9aSQWMvXwECWBdv8qeRQx8XQRY\";s:7:\"partner\";s:0:\"\";s:3:\"key\";s:0:\"\";s:7:\"version\";s:1:\"2\";s:5:\"mchid\";s:10:\"1240544602\";}s:7:\"offline\";a:2:{s:6:\"switch\";b:1;s:7:\"account\";s:31:\"&lt;p&gt;汇款支付&lt;/p&gt;\";}s:8:\"delivery\";a:1:{s:6:\"switch\";b:1;}}','','','0','','','YToyOntzOjU6Im1lbnVzIjthOjM6e2k6MDthOjI6e3M6NDoibmFtZSI7czozNjoiJUU3JUJCJUI0JUU4JTg4JUFBJUU1JTk1JTg2JUU1JTlGJThFIjtzOjEwOiJzdWJfYnV0dG9uIjthOjI6e2k6MDthOjM6e3M6NDoibmFtZSI7czoxODoiJUU1JTk1JTg2JUU1JTlGJThFIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly93d3cuMTkyNjUuY29tL21vYmlsZS5waHA/YWN0PWVudHJ5JmVpZD0xOCZ3ZWlkPTIjIjt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjM2OiIlRTklOTklOTAlRTYlOTclQjYlRTclQTclOTIlRTYlOUQlODAiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo4MToiaHR0cDovL3d3dy4xOTI2NS5jb20vbW9iaWxlLnBocD9hY3Q9bW9kdWxlJmlzdGltZT0xJm5hbWU9YmpfcW14ayZkbz1saXN0MiZ3ZWlkPTIjIjt9fX1pOjE7YToyOntzOjQ6Im5hbWUiO3M6MzY6IiVFNCVCQyU5QSVFNSU5MSU5OCVFNCVCOCVBRCVFNSVCRiU4MyI7czoxMDoic3ViX2J1dHRvbiI7YTo1OntpOjA7YTozOntzOjQ6Im5hbWUiO3M6MTg6IiVFNyVBRCVCRSVFNSU4OCVCMCI7czo0OiJ0eXBlIjtzOjU6ImNsaWNrIjtzOjM6ImtleSI7czoxODoiJUU3JUFEJUJFJUU1JTg4JUIwIjt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjM2OiIlRTQlQkIlQTMlRTclOTAlODYlRTQlQjglQUQlRTUlQkYlODMiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1NjoiaHR0cDovL3d3dy4xOTI2NS5jb20vbW9iaWxlLnBocD9hY3Q9ZW50cnkmZWlkPTE5JndlaWQ9MiMiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6Mjc6IiVFNiU4RSU5MiVFOCVBMSU4QyVFNiVBNiU5QyI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU2OiJodHRwOi8vd3d3LjE5MjY1LmNvbS9tb2JpbGUucGhwP2FjdD1lbnRyeSZlaWQ9MjAmd2VpZD0yIyI7fWk6MzthOjM6e3M6NDoibmFtZSI7czozNjoiJUU2JThFJUE4JUU1JUI5JUJGJUU1JTkwJThEJUU3JTg5JTg3IjtzOjQ6InR5cGUiO3M6NToiY2xpY2siO3M6Mzoia2V5IjtzOjYzOiIlRTUlODglODYlRTklOTQlODAlRTQlQjglOTMlRTUlQjElOUUlRTQlQkElOEMlRTclQkIlQjQlRTclQTAlODEiO31pOjQ7YTozOntzOjQ6Im5hbWUiO3M6MzY6IiVFNyVBNyVBRiVFNSU4OCU4NiVFNSU4NSU5MSVFNiU4RCVBMiI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU2OiJodHRwOi8vd3d3LjE5MjY1LmNvbS9tb2JpbGUucGhwP2FjdD1lbnRyeSZlaWQ9MjEmd2VpZD0yIyI7fX19aToyO2E6Mjp7czo0OiJuYW1lIjtzOjM2OiIlRTYlQjQlQkIlRTUlOEElQTglRTQlQjglQUQlRTUlQkYlODMiO3M6MTA6InN1Yl9idXR0b24iO2E6NDp7aTowO2E6Mzp7czo0OiJuYW1lIjtzOjI3OiIlRTUlQTQlQTclRTglQkQlQUMlRTclOUIlOTgiO3M6NDoidHlwZSI7czo1OiJjbGljayI7czozOiJrZXkiO3M6Mjc6IiVFNSVBNCVBNyVFOCVCRCVBQyVFNyU5QiU5OCI7fWk6MTthOjM6e3M6NDoibmFtZSI7czoxODoiJUU2JThBJTk1JUU3JUE1JUE4IjtzOjQ6InR5cGUiO3M6NToiY2xpY2siO3M6Mzoia2V5IjtzOjE4OiIlRTYlOEElOTUlRTclQTUlQTgiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6MzY6IiVFNyVBNyVBRiVFNSU4OCU4NiVFNSU4NSU5MSVFNiU4RCVBMiI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU2OiJodHRwOi8vd3d3LjE5MjY1LmNvbS9tb2JpbGUucGhwP2FjdD1lbnRyeSZlaWQ9MjEmd2VpZD0yIyI7fWk6MzthOjM6e3M6NDoibmFtZSI7czoxODoiJUU3JUFEJUJFJUU1JTg4JUIwIjtzOjQ6InR5cGUiO3M6NToiY2xpY2siO3M6Mzoia2V5IjtzOjE4OiIlRTclQUQlQkUlRTUlODglQjAiO319fX1zOjEwOiJjcmVhdGV0aW1lIjtpOjE0NDAzNDQzMjU7fQ==','a:2:{s:6:\"ticket\";s:86:\"bxLdikRXVbTPdHSM05e5u9SAHpXAEUMqTs3sfd4rmzT8Pz2r5F3gz7oVC_JgLiCmoPsgDJx75x0at9lt_5PZdQ\";s:6:\"expire\";i:1440466575;}');


DROP TABLE IF EXISTS ims_wechats_modules;
CREATE TABLE `ims_wechats_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `settings` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ims_wechats_modules VALUES 
('1','2','8','1','a:26:{s:10:\"autofinish\";i:3;s:13:\"agentRegister\";N;s:11:\"noticeemail\";N;s:8:\"shopname\";s:12:\"维航商城\";s:8:\"commtime\";i:10;s:10:\"rebacktime\";i:7;s:15:\"zhifuCommission\";s:3:\"100\";s:21:\"globalCommissionLevel\";s:1:\"3\";s:16:\"globalCommission\";s:2:\"10\";s:17:\"globalCommission2\";s:1:\"5\";s:17:\"globalCommission3\";s:1:\"3\";s:7:\"indexss\";i:0;s:4:\"ydyy\";s:25:\"http://www.dwz.cn/weihang\";s:16:\"paymsgTemplateid\";s:43:\"yLQOMlXutY5Gkl9TKoRGPaxQbM2JEOIFa_5OTEX2w60\";s:14:\"commissionType\";s:1:\"0\";s:7:\"address\";N;s:5:\"phone\";N;s:6:\"kfcode\";s:0:\"\";s:11:\"officialweb\";N;s:11:\"description\";s:24:\"维航分销转发话术\";s:6:\"footer\";s:12:\"维航商城\";s:9:\"footerurl\";s:0:\"\";s:8:\"minmoney\";N;s:2:\"qq\";s:8:\"86165698\";s:11:\"orderstatus\";i:1;s:4:\"logo\";s:51:\"images/2/2015/08/sJScSZ8ZeTwIESii09t8z8iASJw99I.jpg\";}'),
('2','2','7','1','a:14:{s:8:\"qmxkdoor\";i:1;s:5:\"times\";i:1;s:6:\"credit\";i:2;s:8:\"showrank\";i:10;s:5:\"tsign\";i:10;s:5:\"csign\";i:30;s:5:\"osign\";i:5;s:10:\"tsignprize\";s:1:\"5\";s:10:\"csignprize\";s:2:\"10\";s:10:\"osignprize\";s:1:\"2\";s:9:\"start_day\";s:16:\"2015-08-20 10:27\";s:7:\"end_day\";s:16:\"2020-09-19 10:27\";s:10:\"start_time\";s:5:\"00:00\";s:8:\"end_time\";s:5:\"24:00\";}'),
('3','2','9','1','a:3:{s:11:\"msg_history\";b:0;s:10:\"msg_maxday\";i:0;s:9:\"use_ratio\";b:1;}');


DROP TABLE IF EXISTS ims_weihaom_wb_reply;
CREATE TABLE `ims_weihaom_wb_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `description` text,
  `title1` varchar(255) DEFAULT NULL,
  `description1` text,
  `fimg` varchar(255) DEFAULT NULL,
  `bimg` varchar(255) DEFAULT NULL,
  `bgmusic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_weihaom_wb_user;
CREATE TABLE `ims_weihaom_wb_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `score` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS ims_xsign_record;
CREATE TABLE `ims_xsign_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `fromuser` text NOT NULL,
  `username` text NOT NULL,
  `today_rank` int(11) NOT NULL,
  `sign_time` int(11) NOT NULL,
  `last_sign_time` int(11) NOT NULL,
  `continue_sign_days` int(11) NOT NULL,
  `maxcontinue_sign_days` int(11) NOT NULL,
  `total_sign_num` int(11) NOT NULL,
  `maxtotal_sign_num` int(11) NOT NULL,
  `first_sign_days` int(11) NOT NULL,
  `maxfirst_sign_days` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ims_xsign_record VALUES 
('1','4','oPnnXjt7uKBidn0MXwm3UiaRHHP4','快乐每一天，军','1','1440038674','1440213012','0','1','2','2','2','2','2'),
('2','4','oPnnXjtKc-3bI8s48GyRP6v74k0o','卢孙荣','1','1440165827','1440349893','1','1','3','3','3','3','2'),
('3','4','oPnnXjt7uKBidn0MXwm3UiaRHHP4','快乐每一天，军','1','1440213012','1440213012','0','1','2','2','2','2','2'),
('4','4','oPnnXjtKc-3bI8s48GyRP6v74k0o','卢孙荣','1','1440344680','1440349893','1','1','3','3','3','3','2'),
('5','4','oPnnXjtKc-3bI8s48GyRP6v74k0o','卢孙荣','1','1440349893','1440349893','1','1','3','3','3','3','2');


DROP TABLE IF EXISTS ims_xsign_reply;
CREATE TABLE `ims_xsign_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `title` text NOT NULL,
  `picture` text NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ims_xsign_reply VALUES 
('1','4','','','','<p>每日签到1次，签到1次获得2个积分</p>');


----WeEngine MySQL Dump End