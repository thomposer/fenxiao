<?php
$checkjsweixin = '1';
$this->validateopenid();
$weid = $_W['weid'];
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
$memnum=$cfg['memnum'];
$this->checkisAgent($from_user, $profile);
$ushareid = $this->getShareId();
if (!empty($ushareid) && $ushareid != 0) {
    $shareprofile = $this->getMember($ushareid);
    $fansrealname = $this->getFans($shareprofile['from_user']);
    if (empty($shareprofile['realname']) && !empty($fansrealname['nickname'])) {
        $shareprofile['realname'] = $fansrealname['nickname'];
    }
}
if ($profile['status'] == 0) {
    $profile['flag'] = 0;
}
if (!empty($profile['id']) && $profile['flag'] == 1) {
    $count = 0;
    if (true) {
        $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where mber1.realname<>\'\' and mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
        $count1 = pdo_fetchcolumn('	select count(*) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . " and mber1.flag=0)) and fans.weid={$_W['weid']}");
        $count1_1 = pdo_fetchcolumn('	select count(*) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . " and mber1.flag=1)) and fans.weid={$_W['weid']}");
        if (CUSTOMER_CODE == '001HEML') {
            $commission1_1 = pdo_fetchcolumn('SELECT sum((g.commission*g.total)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE o.shareid=' . $profile['id'] . ' and  o.weid = ' . $_W['weid'] . ' and o.status =3 and o.from_user != \'' . $from_user . '\' and g.createtime>=' . $profile['flagtime']);
            $price1_1 = pdo_fetchcolumn('SELECT sum((o.price)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE  o.shareid=' . $profile['id'] . ' and o.weid = ' . $_W['weid'] . ' and o.status =3 and o.from_user != \'' . $from_user . '\' and  g.createtime>=' . $profile['flagtime']);
        }
    }
    if (true && $cfg['globalCommissionLevel'] >= 2) {
        $level2 = 'select level2m.id from ' . tablename('bj_qmxk_member') . ' level2m where level2m.id!=level2m.shareid and  level2m.shareid = ' . $profile['id'];
        $sql2_member = 'select mber2.from_user from ' . tablename('bj_qmxk_member') . ' mber2 where mber2.realname<>\'\' and mber2.id!=mber2.shareid and mber2.shareid in (' . $level2 . ')  ';
        $count2 = pdo_fetchcolumn('	select count(*) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . '  and mber2.flag=0)) and ( fans.from_user not in (' . $sql1_member . "   and mber1.flag=0) ) and fans.weid={$_W['weid']}");
        $count2_1 = pdo_fetchcolumn('	select count(*) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . '  and mber2.flag=1)) and ( fans.from_user not in (' . $sql1_member . "   and mber1.flag=1) ) and fans.weid={$_W['weid']}");
        if (CUSTOMER_CODE == '001HEML') {
            $commission2_1 = pdo_fetchcolumn('SELECT sum((g.commission2*g.total)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE o.shareid2=' . $profile['id'] . ' and o.weid = ' . $_W['weid'] . ' and o.status =3 and o.from_user != \'' . $from_user . '\' and  g.createtime>=' . $profile['flagtime']);
            $price2_1 = pdo_fetchcolumn('SELECT sum((o.price)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE  o.shareid2=' . $profile['id'] . ' and o.weid = ' . $_W['weid'] . ' and o.status =3  and o.from_user != \'' . $from_user . '\' and  g.createtime>=' . $profile['flagtime']);
        }
    } else {
        $str = 0;
    }
    if (true && $cfg['globalCommissionLevel'] >= 3) {
        $level3 = 'select level3m.id from ' . tablename('bj_qmxk_member') . ' level3m where level3m.id!=level3m.shareid and level3m.shareid in( ' . $level2 . ')';
        $sql3_member = 'select mber3.from_user from ' . tablename('bj_qmxk_member') . ' mber3 where mber3.realname<>\'\' and mber3.id!=mber3.shareid and mber3.shareid in (' . $level3 . ')  ';
        $count3 = pdo_fetchcolumn('	select count(*) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . '  and mber3.flag=0)) and (fans.from_user not in (' . $sql1_member . '   and mber1.flag=0)) and (fans.from_user not in  (' . $sql2_member . "   and mber2.flag=0)) and fans.weid={$_W['weid']}");
        $count3_1 = pdo_fetchcolumn('	select count(*) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . '  and mber3.flag=1)) and (fans.from_user not in (' . $sql1_member . '   and mber1.flag=1)) and (fans.from_user not in  (' . $sql2_member . "   and mber2.flag=1)) and fans.weid={$_W['weid']}");
        if (CUSTOMER_CODE == '001HEML') {
            $commission3_1 = pdo_fetchcolumn('SELECT sum((g.commission3*g.total)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE  o.shareid3=' . $profile['id'] . '  and o.weid = ' . $_W['weid'] . ' and o.status =3 and o.from_user != \'' . $from_user . '\' and  g.createtime>=' . $profile['flagtime']);
            $price3_1 = pdo_fetchcolumn('SELECT sum((o.price)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE  o.shareid3=' . $profile['id'] . ' and o.weid = ' . $_W['weid'] . ' and o.status =3 and o.from_user != \'' . $from_user . '\' and  g.createtime>=' . $profile['flagtime']);
        }
    } else {
        $str3 = 0;
    }
    $count = $count1 + $count2 + $count3;
    $count = $count + $count1_1 + $count2_1 + $count3_1;
    if (CUSTOMER_CODE == '001HEML') {
        $commissionTotal = $commission1_1 + $commission2_1 + $commission3_1;
        $priceTotal = $price1_1 + $price2_1 + $price3_1;
    }
    $clickcount = $profile['clickcount'];
    $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
    $followcount = pdo_fetchcolumn('	select count(fans.id) from ' . tablename('fans') . " fans where fans.follow=1 and from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}");
} else {
    $count = 0;
    $followcount = 0;
}
$id = $profile['id'];
if (empty($profile['id'])) {
    include $this->template('forbidden');
    die;
}
$myheadimg = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
if (!empty($profile['id']) && $profile['flag'] == 1) {
    $commissioningpe = pdo_fetchcolumn('SELECT sum((g.commission*g.total)) FROM ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid WHERE o.shareid = ' . $id . ' and o.weid = ' . $_W['weid'] . ' and (g.status = 0 or g.status = 1) and o.status >= 3 and o.from_user != \'' . $from_user . '\' and  g.createtime>=' . $profile['flagtime']);
    $fanscount = pdo_fetchcolumn('select count(his.sharemid) count from ' . tablename('bj_qmxk_share_history') . ' his where his.sharemid=:sharemid', array(':sharemid' => $profile['id']));
    $medal_name = pdo_fetchcolumn('SELECT medal_name FROM ' . tablename('bj_qmxk_phb_medal') . ' WHERE weid = :weid and  fans_count<=:fans_count order by fans_count desc  limit 1', array(':weid' => $_W['weid'], ':fans_count' => $fanscount));
    if (empty($medal_name)) {
        $medal_name = '普通代理';
    }
} else {
    $fanscount = 0;
    $medal_name = '普通会员';
}
if (empty($commissioningpe)) {
    $commissioningpe = 0;
}
$commtime = pdo_fetch('select * from ' . tablename('bj_qmxk_rules') . ' where weid = ' . $_W['weid']);
$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_order') . ' WHERE status= \'3\' AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
$totalmoney = pdo_fetchcolumn('SELECT sum(price) FROM ' . tablename('bj_qmxk_order') . ' WHERE status= \'3\' AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
$tmsg = '购买一单升级为代理';
if ($commtime['promotercount'] > $total && $commtime['promotertimes'] == 2) {
    $tmsg = '购买' . ($commtime['promotercount'] - $total) . '单才升级为代理';
}
if ($commtime['promotermoney'] > $totalmoney && $commtime['promotertimes'] == 3) {
    $tmsg = '购买' . ($commtime['promotermoney'] - $totalmoney) . '金额升级为代理';
}
$showdzd = true;
$num=fans_search($from_user, array('id'));
$memid=$memnum+$num['id'];
//$memid=$memnum+$profile['id'];
include $this->template('newhome');