<?php


$sql = "
CREATE TABLE IF NOT EXISTS  `ims_bj_qmxk_msg_template` (
  `weid` int(10) NOT NULL,
  `template` varchar(5000) NOT NULL,
  `tkey` varchar(10) NOT NULL,
  `tenable` tinyint(4) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `ims_bj_qmxk_follow` (
  `weid` int(10) unsigned NOT NULL,
  `leader` varchar(100) NOT NULL,
  `follower` varchar(100) NOT NULL,
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `credit` int(10) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`weid`,`leader`,`follower`,`channel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `ims_bj_qmxk_qr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `qr_url` varchar(1024) NOT NULL,
  `createtime` int(11) NOT NULL,
  `expiretime` int(11) NOT NULL,
  `media_id` varchar(1024) NOT NULL,
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `from_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_channel` (
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
  `isdel`  int(5)  NOT NULL DEFAULT '0',
  PRIMARY KEY (`channel`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE  IF NOT EXISTS `ims_bj_qmxk_phb_medal` (
  `fans_count` int(11) DEFAULT NULL,
  `medal_name` varchar(50) DEFAULT NULL,
  `weid` int(11) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_pormotions` (
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

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_paylog` (
  `createtime` int(10) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `credit2` decimal(10,2) NOT NULL DEFAULT '0',
  `mid` int(10) NOT NULL COMMENT 'member id',
  `openid` varchar(40) NOT NULL,
  `weid` int(11) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT 'usegold使用金额 addgold充值金额 usecredit使用积分 addcredit充值积分',
  `plid` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`plid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_credit_order` (
  `createtime` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `fee` decimal(10,2) NOT NULL,
  `transid` varchar(30) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `weid` int(11) NOT NULL,
  `crid` varchar(32) NOT NULL,
  PRIMARY KEY (`crid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
";

pdo_run($sql);

if(!pdo_fieldexists('bj_qmxk_goods', 'issendfree')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_goods')." ADD COLUMN `issendfree` int(11) DEFAULT '0' COMMENT '是否包邮';");
}

if(!pdo_fieldexists('bj_qmxk_rules', 'promotercount')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_rules')." ADD COLUMN `promotercount` int(10) DEFAULT '0' COMMENT '成为代理需要成交单数';");
}

if(!pdo_fieldexists('bj_qmxk_rules', 'promotermoney')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_rules')." ADD COLUMN `promotermoney` decimal(10,2) DEFAULT '0.00' COMMENT '成为代理需要成交总金额';");
}

if(!pdo_fieldexists('bj_qmxk_share_history', 'joinway')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_share_history')." ADD COLUMN `joinway` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0默认驱动加入,1二维码加入';");
}

if(!pdo_indexexists('bj_qmxk_member', 'idx_member_from_user')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_member')." ADD INDEX `idx_member_from_user` (`from_user`);");
}
if(!pdo_indexexists('bj_qmxk_member', 'idx_weid')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_member')." ADD INDEX `idx_weid` (`weid`);");
}
if(!pdo_fieldexists('bj_qmxk_order', 'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order')." ADD COLUMN `updatetime` int(10) DEFAULT '0' COMMENT '订单更新时间';");
}

if(!pdo_fieldexists('bj_qmxk_category', 'sn')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_category')." ADD COLUMN `sn` varchar(30) DEFAULT ''  COMMENT '分类编号';");
}

if(!pdo_fieldexists('bj_qmxk_member', 'dzdflag')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_member')." ADD COLUMN `dzdflag` tinyint(3) DEFAULT '0' COMMENT '店中店开启';");
}
if(!pdo_fieldexists('bj_qmxk_member', 'dzdtitle')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_member')." ADD COLUMN `dzdtitle` varchar(100) DEFAULT '' COMMENT '店中店名称';");
}
if(!pdo_fieldexists('bj_qmxk_member', 'dzdsendtext')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_member')." ADD COLUMN `dzdsendtext` varchar(100) DEFAULT '' COMMENT '店中店转发话术';");
}

if(!pdo_fieldexists('bj_qmxk_order', 'shareid2')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order')." ADD COLUMN `shareid2` int(10) DEFAULT '0' COMMENT '2级代理id';");
	$orderlist = pdo_fetchall("select * from ".tablename('bj_qmxk_order'));
	foreach ($orderlist as &$corder){ 
		if(!empty($corder['id'])&&!empty($corder['shareid'])&&$corder['shareid']!=0)
		{
					$profile = pdo_fetch('SELECT shareid,flagtime FROM '.tablename('bj_qmxk_member')." WHERE  id=:sid" , array(':sid' => $corder['shareid']));
					if($corder['createtime']>=$profile['flagtime']&&!empty($profile['shareid'])&&$profile['shareid']!=0&&$corder['shareid']!=$profile['shareid'])
					{
						pdo_update('bj_qmxk_order',array('shareid2'=> $profile['shareid']),array('id'=>$corder['id']));
					}
						
		}
					
	}
		
}
if(!pdo_fieldexists('bj_qmxk_order', 'shareid3')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order')." ADD COLUMN `shareid3` int(10) DEFAULT '0' COMMENT '3级代理id';");
		$orderlist = pdo_fetchall("select * from ".tablename('bj_qmxk_order'));
	foreach ($orderlist as &$corder){ 
		if(!empty($corder['id'])&&!empty($corder['shareid2'])&&$corder['shareid2']!=0)
		{
					$profile = pdo_fetch('SELECT shareid,flagtime FROM '.tablename('bj_qmxk_member')." WHERE  id=:sid" , array(':sid' => $corder['shareid2']));
					if($corder['createtime']>=$profile['flagtime']&&!empty($profile['shareid'])&&$profile['shareid']!=0&&$corder['shareid2']!=$profile['shareid']&&$corder['shareid']!=$profile['shareid'])
					{
						pdo_update('bj_qmxk_order',array('shareid3'=> $profile['shareid']),array('id'=>$corder['id']));
					}
		}
					
	}
}



if(!pdo_fieldexists('bj_qmxk_order_goods', 'applytime2')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order_goods')." ADD COLUMN `applytime2` int(10) DEFAULT '0' COMMENT '2级申请时间';");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set applytime2=applytime where (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");

}
if(!pdo_fieldexists('bj_qmxk_order_goods', 'checktime2')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order_goods')." ADD COLUMN `checktime2` int(10) DEFAULT '0' COMMENT '2级审核时间';");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set checktime2=checktime  where (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");

}

if(!pdo_fieldexists('bj_qmxk_order_goods', 'applytime3')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order_goods')." ADD COLUMN `applytime3` int(10) DEFAULT '0' COMMENT '3级申请时间';");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set applytime3=applytime  where (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");

}
if(!pdo_fieldexists('bj_qmxk_order_goods', 'checktime3')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order_goods')." ADD COLUMN `checktime3` int(10) DEFAULT '0' COMMENT '3级审核时间';");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set checktime3=checktime  where (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");

}
if(!pdo_fieldexists('bj_qmxk_order_goods', 'status2')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order_goods')." ADD COLUMN `status2` tinyint(3) DEFAULT '0' COMMENT '2级申请状态';");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status2=2  where status=2 and (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status2=1  where status=1 and (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status2=0  where status=0 and (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status2=-1  where status=-1 and (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status2=-2  where status=-2 and (select g.shareid2 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
}
if(!pdo_fieldexists('bj_qmxk_order_goods', 'status3')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order_goods')." ADD COLUMN `status3` tinyint(3) DEFAULT '0' COMMENT '3级申请状态';");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status3=2  where status=2 and (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status3=1  where status=1 and (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status3=0  where status=0 and (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status3=-1  where status=-1 and (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
	pdo_query("update ".tablename('bj_qmxk_order_goods')." set status3=-2  where status=-2 and (select g.shareid3 from ".tablename('bj_qmxk_order')." as g where g.id=orderid)>0");
}

if(!pdo_fieldexists('bj_qmxk_order', 'isrest')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order')." ADD COLUMN `isrest` tinyint(1) DEFAULT '0' COMMENT '是否发生换货操作';");
}
if(!pdo_fieldexists('bj_qmxk_order', 'rsreson')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order')." ADD COLUMN `rsreson` varchar(500) DEFAULT ''  COMMENT '退货款退原因';");
}
if(!pdo_fieldexists('bj_qmxk_member', 'credit2')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_member')." ADD COLUMN `credit2` double DEFAULT '0'  COMMENT '余额';");
			$fanslist = pdo_fetchall("select * from ".tablename('fans')." where credit2>0");
	foreach ($fanslist as &$fans){ 
				$profile = pdo_fetch('SELECT * FROM '.tablename('bj_qmxk_member')." where  from_user='".$fans['from_user']."' and weid='".$fans['weid']."' limit 1");
					if(!empty($profile['id']))
					{
			 $data= array('credit2'=>$profile['credit2']+$fans['credit2'],'tag'=> '模块更新，从原始表移植的余额','type'=>'addgold','fee'=> $fans['credit2'],'createtime' => TIMESTAMP,'openid'=>$fans['from_user'],'mid'=>$profile['id'],'weid'=>$profile['weid']);
					 pdo_insert('bj_qmxk_paylog', $data);
			  
					pdo_query("update ".tablename('bj_qmxk_member')." set credit2=credit2+".$fans['credit2']."  where  id=".$profile['id']);
				}
			}
}

if(!pdo_fieldexists('bj_qmxk_order', 'sendtime')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_order')." ADD COLUMN `sendtime` int(10) NOT NULL DEFAULT '0' COMMENT '发货时间';");
}
if(!pdo_fieldexists('bj_qmxk_rules', 'autofinishcktime')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_rules')." ADD COLUMN `autofinishcktime` int(10) NOT NULL DEFAULT '0' COMMENT '自动收货检查';");
}
if(!pdo_fieldexists('bj_qmxk_rules', 'jsapi_ticket')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_rules')." ADD COLUMN `jsapi_ticket` varchar(300) NOT NULL DEFAULT '' COMMENT 'jsapi_ticket';");
}
if(!pdo_fieldexists('bj_qmxk_rules', 'jsapi_ticket_exptime')) {
	pdo_query("ALTER TABLE ".tablename('bj_qmxk_rules')." ADD COLUMN `jsapi_ticket_exptime` int(10) NOT NULL DEFAULT '0' COMMENT 'jsapi_ticket_exptime';");
}