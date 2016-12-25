<?php
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
if ($op == 'delete') {
    pdo_update('bj_qmxk_member', array('status' => intval($_GPC['isstatus'])), array('id' => $_GPC['id'], 'weid' => $_W['weid']));
    $op = 'display';
}
if ($op == 'display') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $list = pdo_fetchall('select qmxk.*,\'\' as credit1 from ' . tablename('bj_qmxk_member') . ' qmxk where  qmxk.flag = 1 and qmxk.weid = ' . $_W['weid'] . ' and qmxk.realname<>\'\'  ORDER BY qmxk.id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
    foreach ($list as $key => $c) {
        $list[$key]['credit1'] = pdo_fetchcolumn('select fans.credit1 from ' . tablename('fans') . ' fans where  fans.weid = ' . $_W['weid'] . ' and fans.from_user=\'' . $c['from_user'] . '\'  ORDER BY fans.credit1 DESC limit 1');
    }
    $total = pdo_fetchcolumn('select count(id) from' . tablename('bj_qmxk_member') . 'where flag = 1 and realname<>\'\' and weid =' . $_W['weid']);
    $pager = pagination1($total, $pindex, $psize);
}
if ($op == 'nocheck') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $list = pdo_fetchall('select qmxk.*,\'\' as credit1  from ' . tablename('bj_qmxk_member') . ' qmxk where qmxk.flag = 0 and qmxk.realname<>\'\' and qmxk.weid = ' . $_W['weid'] . '  ORDER BY qmxk.id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
    foreach ($list as $key => $c) {
        $list[$key]['credit1'] = pdo_fetchcolumn('select fans.credit1 from ' . tablename('fans') . ' fans where  fans.weid = ' . $_W['weid'] . ' and fans.from_user=\'' . $c['from_user'] . '\'  ORDER BY fans.credit1 DESC limit 1');
    }
    $total = pdo_fetchcolumn('select count(id) from' . tablename('bj_qmxk_member') . 'where flag = 0 and realname<>\'\' and weid =' . $_W['weid']);
    $pager = pagination1($total, $pindex, $psize);
    include $this->template('fansmanagered');
    die;
}
if ($op == 'sort') {
    $sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
    if ($_GPC['opp'] == 'nocheck') {
        $status = 0;
    } else {
        $status = 1;
    }
    $list = pdo_fetchall('select qmxk.*,\'\' as credit1  from ' . tablename('bj_qmxk_member') . ' qmxk where qmxk.flag = ' . $status . ' and qmxk.weid =' . $_W['weid'] . ' and qmxk.realname like \'%' . $sort['realname'] . '%\' and qmxk.mobile like \'%' . $sort['mobile'] . '%\'ORDER BY qmxk.id DESC');
    foreach ($list as $key => $c) {
        $list[$key]['credit1'] = pdo_fetchcolumn('select fans.credit1 from ' . tablename('fans') . ' fans where  fans.weid = ' . $_W['weid'] . ' and fans.from_user=\'' . $c['from_user'] . '\'  ORDER BY fans.credit1 DESC limit 1');
    }
    $commissions = pdo_fetchall('select mid, sum(commission) as commission from ' . tablename('bj_qmxk_commission') . ' where weid = ' . $_W['weid'] . ' and flag = 0  group by mid');
    $commission = array();
    foreach ($commissions as $c) {
        $commission[$c['mid']] = $c['commission'];
    }
    if ($_GPC['opp'] == 'nocheck') {
        include $this->template('fansmanagered');
        die;
    }
}
if ($op == 'user') {
    $from_user = $_GPC['from_user'];
    $fans = pdo_fetch('SELECT nickname,createtime,credit1 FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    $myheadimg = pdo_fetchcolumn('SELECT avatar FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    $fans['avatar'] = $myheadimg;
    $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    if (!empty($profile['id'])) {
        $count = 0;
        if (true) {
            $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where    mber1.realname<>\'\' and mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
            $count1 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql1_member . ")) and fans.weid={$_W['weid']}");
            $mylist1 = pdo_fetchall('	select *,1 as level from ' . tablename('fans') . " fans where  from_user!='{$from_user}' and (fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}");
        }
        if (true && $cfg['globalCommissionLevel'] >= 2) {
            $level2 = pdo_fetchall('select id from ' . tablename('bj_qmxk_member') . ' where id!=shareid and  shareid = ' . $profile['id']);
            $rowindex = 0;
            $str = '';
            foreach ($level2 as &$citem) {
                $str = $str . $citem['id'] . ',';
            }
            $str = $str . '-1';
            $sql2_member = 'select mber2.from_user from ' . tablename('bj_qmxk_member') . ' mber2 where  mber2.realname<>\'\' and mber2.id!=mber2.shareid and mber2.shareid in (' . $str . ')  ';
            $count2 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ")) and fans.weid={$_W['weid']}");
            $mylist2 = pdo_fetchall('	select * ,2 as level from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ")) and fans.weid={$_W['weid']}");
        }
        if (true && $cfg['globalCommissionLevel'] >= 3) {
            $level3 = pdo_fetchall('select id from ' . tablename('bj_qmxk_member') . ' where id!=shareid and shareid in( ' . $str . ')');
            $rowindex = 0;
            $str3 = '';
            foreach ($level3 as &$citem) {
                $str3 = $str3 . $citem['id'] . ',';
            }
            $str3 = $str3 . '-1';
            $sql3_member = 'select mber3.from_user from ' . tablename('bj_qmxk_member') . ' mber3 where  mber3.realname<>\'\' and mber3.id!=mber3.shareid and mber3.shareid in (' . $str3 . ')  ';
            $count3 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}");
            $mylist3 = pdo_fetchall('	select * ,3 as level from ' . tablename('fans') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}");
        }
        $count = $count1 + $count2 + $count3;
    } else {
        $count = 0;
    }
    include $this->template('clicklog');
    die;
}
if ($op == 'detail') {
    $id = $_GPC['id'];
    $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $id);
    if ($_GPC['opp'] == 'nocheck') {
        include $this->template('fansmanagered_detail');
    } else {
        include $this->template('fansmanager_detail');
    }
    die;
}
if ($op == 'status') {
    $status = array('status' => $_GPC['status'], 'content' => trim($_GPC['content']));
    if ($_GPC['opp'] == 'nocheck' && $_GPC['flag'] == 1) {
        $status['flag'] = $_GPC['flag'];
        $status['flagtime'] = TIMESTAMP;
    }
    $temp = pdo_update('bj_qmxk_member', $status, array('id' => $_GPC['id']));
    if (empty($temp)) {
        if ($_GPC['opp'] == 'nocheck') {
            message('设置用户权限失败，请重新设置！', $this->createWebUrl('fansmanager', array('op' => 'detail', 'opp' => 'nocheck', 'id' => $_GPC['id'])), 'error');
        } else {
            message('设置用户权限失败，请重新设置！', $this->createWebUrl('fansmanager', array('op' => 'detail', 'id' => $_GPC['id'])), 'error');
        }
    } else {
        if ($_GPC['opp'] == 'nocheck') {
            message('设置用户权限成功！', $this->createWebUrl('fansmanager', array('op' => 'nocheck')), 'success');
        } else {
            message('设置用户权限成功！', $this->createWebUrl('fansmanager'), 'success');
        }
    }
}
if ($op == 'recharge') {
    $id = $_GPC['id'];
    if ($_GPC['opp'] == 'recharged') {
        if (!is_numeric($_GPC['commission'])) {
            message('佣金请输入合法数字！', '', 'error');
        }
        $recharged = array('weid' => $_W['weid'], 'mid' => $id, 'flag' => 1, 'content' => trim($_GPC['content']), 'commission' => $_GPC['commission'], 'createtime' => time());
        $temp = pdo_insert('bj_qmxk_commission', $recharged);
        $commission = pdo_fetchcolumn('select commission from ' . tablename('bj_qmxk_member') . ' where id = ' . $id);
        if (empty($temp)) {
            message('充值失败，请重新充值！', $this->createWebUrl('fansmanager', array('op' => 'recharge', 'id' => $_GPC['id'])), 'error');
        } else {
            pdo_update('bj_qmxk_member', array('commission' => $commission + $_GPC['commission']), array('id' => $id));
            message('充值成功！', $this->createWebUrl('fansmanager', array('op' => 'recharge', 'id' => $_GPC['id'])), 'success');
        }
    }
    $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $id);
    $commission = pdo_fetchcolumn('select sum(commission) from ' . tablename('bj_qmxk_commission') . ' where mid = ' . $id . ' and flag = 0 and weid = ' . $_W['weid']);
    $commission = empty($commission) ? 0 : $commission;
    $commission = $commission - $user['commission'];
    $commissions = pdo_fetchall('select * from ' . tablename('bj_qmxk_commission') . ' where mid = ' . $id . ' and weid = ' . $_W['weid'] . ' and flag = 1');
    include $this->template('fansmanager_recharge');
    die;
}
include $this->template('fansmanager');