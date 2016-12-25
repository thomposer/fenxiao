<?php
$cfg = $this->module['config'];
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$members = pdo_fetchall('select id, realname, mobile from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and status = 1');
$member = array();
foreach ($members as $m) {
    $member['realname'][$m['id']] = $m['realname'];
    $member['mobile'][$m['id']] = $m['mobile'];
}
if ($op == 'display') {
    if ($_GPC['opp'] == 'check') {
        $level = $_GPC['level'];
        $zhifucommission = $cfg['zhifuCommission'];
        if (!$zhifucommission) {
            message('请先在参数设置，设置佣金打款限额！', $this->createWebUrl('Commission'), 'success');
        }
        $shareid = $_GPC['shareid'];
        $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $_GPC['shareid']);
        $bankcard = pdo_fetch('select id, bankcard, banktype,alipay from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and from_user = \'' . $user['from_user'] . '\'');
        $level = $_GPC['level'];
        if (empty($level)) {
            message('error');
        }
        if ($level == 1) {
            $status = 'og.status,';
            $conditionCommission = 'og.commission*og.total as commission';
        }
        if ($level == 2) {
            $status = 'og.status2 as status,';
            $conditionCommission = 'og.commission2*og.total as commission';
        }
        if ($level == 3) {
            $status = 'og.status3 as status,';
            $conditionCommission = 'og.commission3*og.total as commission';
        }
        $info = pdo_fetch('select og.id,og.orderid, og.total, og.price,' . $status . $conditionCommission . ', og.applytime, og.content, g.title from ' . tablename('bj_qmxk_order_goods') . ' as og left join ' . tablename('bj_qmxk_goods') . ' as g on og.goodsid = g.id and og.weid = g.weid where og.id = ' . $_GPC['id']);
        $order = pdo_fetch('select * from ' . tablename('bj_qmxk_order') . ' where id = ' . $info['orderid']);
        include $this->template('applying_detail');
        die;
    }
    if ($_GPC['opp'] == 'checked') {
        $level = $_GPC['level'];
        if (empty($level)) {
            message('error');
        }
        if ($level == 1) {
            $checked = array('status' => $_GPC['status'], 'checktime' => time());
        }
        if ($level == 2) {
            $checked = array('status2' => $_GPC['status'], 'checktime2' => time());
        }
        if ($level == 3) {
            $checked = array('status3' => $_GPC['status'], 'checktime3' => time());
        }
        $temp = pdo_update('bj_qmxk_order_goods', $checked, array('id' => $_GPC['id']));
        if ($_GPC['status'] == 2) {
            $shareid = $_GPC['shareid'];
            $ogid = $_GPC['id'];
            $level = $_GPC['level'];
            $commission = array('weid' => $_W['weid'], 'mid' => $shareid, 'ogid' => $ogid, 'commission' => $_GPC['commission'], 'content' => trim($_GPC['content']), 'isshare' => 0, 'createtime' => time());
            if ($_GPC['commission'] > 0) {
                $temp = pdo_insert('bj_qmxk_commission', $commission);
                $commission = pdo_fetch('select from_user,commission from ' . tablename('bj_qmxk_member') . ' where id = ' . $shareid);
                pdo_update('bj_qmxk_member', array('commission' => $commission['commission'] + $_GPC['commission']), array('id' => $shareid));
                pdo_query('update ' . tablename('bj_qmxk_member') . ' SET zhifu=zhifu+\'' . $_GPC['commission'] . '\' WHERE id=\'' . $shareid . '\' AND  weid=' . $_W['weid'] . '  ');
                $paylog = array('type' => 'zhifu', 'weid' => $_W['weid'], 'openid' => $commission['from_user'], 'tid' => date('Y-m-d H:i:s'), 'fee' => $_GPC['commission'], 'module' => 'bj_qmxk', 'tag' => ' 后台打款' . $_GPC['commission'] . '元【' . $level . '级会员佣金】');
                pdo_insert('paylog', $paylog);
                $this->sendsjytktz($_GPC['commission'], $level, $commission['from_user']);
            }
            message('打款完成！', $this->createWebUrl('commission'), 'success');
        }
        if (empty($temp)) {
            message('审核失败，请重新审核！', $this->createWebUrl('commission', array('opp' => 'check', 'shareid' => $_GPC['shareid'], 'id' => $_GPC['id'])), 'error');
        } else {
            message('审核成功！', $this->createWebUrl('commission'), 'success');
        }
    }
    if ($_GPC['opp'] == 'sort') {
        $sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
        $shareid = 'select id from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'';
        $list = pdo_fetchall('select 1 as level,o.shareid, o.status, g.id, g.applytime,g.commission*g.total as commission,g.checktime as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status = 1) and (o.shareid in (' . $shareid . ')) union all (select 2 as level,o.shareid2 as shareid, o.status, g.id, g.applytime2 as applytime,g.commission2*g.total as commission,g.checktime2 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status2 = 1) and (o.shareid2 in (' . $shareid . '))) union all (select 3 as level,o.shareid3 as shareid, o.status, g.id, g.applytime3 as applytime,g.commission3*g.total as commission,g.checktime3 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status3 = 1) and (o.shareid3 in (' . $shareid . ')))   order by applytime desc');
        $total = sizeof($list);
    } else {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $list = pdo_fetchall('select 1 as level,o.shareid,o.status, g.id, g.applytime,g.commission*g.total as commission,g.checktime as checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status = 1 and o.shareid!=0) ' . ' union all (select  2 as level,o.shareid2 as shareid,o.status, g.id, g.applytime2 as applytime,g.commission2*g.total as commission,g.checktime2 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status2 = 1 and o.shareid2!=0) )' . ' union all (select 3 as level,o.shareid3 as shareid,o.status, g.id, g.applytime3 as applytime,g.commission3*g.total as commission,g.checktime3 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status3 = 1 and o.shareid3!=0) ) order by applytime desc limit ' . ($pindex - 1) * $psize . ',' . $psize);
        $total = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid!=0 )  and (g.status = 1 )');
        $total2 = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid2!=0 )  and (g.status2 = 1 )');
        $total3 = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid3!=0 )  and (g.status3 = 1 )');
        $total = $total + $total2 + $total3;
        $pager = pagination1($total, $pindex, $psize);
    }
    if (!empty($list)) {
        foreach ($list as $key => $l) {
            $user = pdo_fetch('select id,shareid from ' . tablename('bj_qmxk_member') . ' where flag=1 and id = ' . $l['shareid']);
            if (empty($user['id'])) {
                $list[$key]['commission'] = 0;
                $list[$key]['commission2'] = 0;
                $list[$key]['commission3'] = 0;
            } else {
                $user2 = pdo_fetch('select id,shareid from ' . tablename('bj_qmxk_member') . ' where flag=1 and id = ' . $user['shareid']);
                if (empty($user2['id'])) {
                    $list[$key]['commission2'] = 0;
                    $list[$key]['commission3'] = 0;
                } else {
                    $user3 = pdo_fetch('select id from ' . tablename('bj_qmxk_member') . ' where flag=1 and id = ' . $user2['shareid']);
                    if (empty($user3['id'])) {
                        $list[$key]['commission3'] = 0;
                    }
                }
            }
        }
    }
    include $this->template('applying');
    die;
}
if ($op == 'applyed') {
    if ($_GPC['opp'] == 'jieyong') {
        $shareid = $_GPC['shareid'];
        $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $_GPC['shareid']);
        $bankcard = pdo_fetch('select id, bankcard, banktype,alipay from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and from_user = \'' . $user['from_user'] . '\'');
        $level = $_GPC['level'];
        if (empty($level)) {
            message('error');
        }
        if ($level == 1) {
            $conditionCommission = '(og.commission*og.total) as commission';
        }
        if ($level == 2) {
            $conditionCommission = '(og.commission2*og.total) as commission';
        }
        if ($level == 3) {
            $conditionCommission = '(og.commission3*og.total)  as commission';
        }
        $info = pdo_fetch('select og.id,og.orderid, og.total, og.price, og.status, ' . $conditionCommission . ', og.applytime, og.content, g.title from ' . tablename('bj_qmxk_order_goods') . ' as og left join ' . tablename('bj_qmxk_goods') . ' as g on og.goodsid = g.id and og.weid = g.weid where og.id = ' . $_GPC['id']);
        $order = pdo_fetch('select * from ' . tablename('bj_qmxk_order') . ' where id = ' . $info['orderid']);
        include $this->template('applyed_detail');
        die;
    }
    if ($_GPC['opp'] == 'sort') {
        $sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
        $shareid = 'select id from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'';
        $list = pdo_fetchall('select 1 as level,o.shareid, o.status, g.id, g.applytime,g.commission*g.total as commission,g.checktime as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status = 2) and (o.shareid in (' . $shareid . ')) union all (select 2 as level,o.shareid2 as shareid, o.status, g.id, g.applytime2 as applytime,g.commission2*g.total as commission,g.checktime2 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status2 = 2) and (o.shareid2 in (' . $shareid . '))) union all (select 3 as level,o.shareid3 as shareid, o.status, g.id, g.applytime3 as applytime,g.commission3*g.total as commission,g.checktime3 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status3 = 2) and (o.shareid3 in (' . $shareid . '))) order by applytime desc ');
        $total = sizeof($list);
    } else {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $list = pdo_fetchall('select 1 as level,o.shareid,o.status, g.id, g.applytime,g.commission*g.total as commission,g.checktime as checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status = 2 and o.shareid!=0)  union all (select  2 as level,o.shareid2 as shareid,o.status, g.id, g.applytime2 as applytime,g.commission2*g.total as commission,g.checktime2 as checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status2 = 2 and o.shareid2!=0) )union all (select 3 as level,o.shareid3 as shareid,o.status, g.id, g.applytime3 as applytime,g.commission3*g.total as commission,g.checktime3 as checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status3 = 2 and o.shareid3!=0) ) order by applytime desc limit ' . ($pindex - 1) * $psize . ',' . $psize);
        $total = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid!=0 )  and (g.status = 2 )');
        $total2 = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid2!=0 )  and (g.status2 = 2 )');
        $total3 = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid3!=0 )  and (g.status3 = 2 )');
        $total = $total + $total2 + $total3;
        $pager = pagination1($total, $pindex, $psize);
    }
    if (!empty($list)) {
        foreach ($list as $key => $l) {
            $user = pdo_fetch('select id,shareid from ' . tablename('bj_qmxk_member') . ' where flag=1 and id = ' . $l['shareid']);
            if (empty($user['id'])) {
                $list[$key]['commission'] = 0;
                $list[$key]['commission2'] = 0;
                $list[$key]['commission3'] = 0;
            } else {
                $user2 = pdo_fetch('select id,shareid from ' . tablename('bj_qmxk_member') . ' where flag=1 and id = ' . $user['shareid']);
                if (empty($user2['id'])) {
                    $list[$key]['commission2'] = 0;
                    $list[$key]['commission3'] = 0;
                } else {
                    $user3 = pdo_fetch('select id from ' . tablename('bj_qmxk_member') . ' where flag=1 and id = ' . $user2['shareid']);
                    if (empty($user3['id'])) {
                        $list[$key]['commission3'] = 0;
                    }
                }
            }
        }
    }
    include $this->template('applyed');
    die;
}
if ($op == 'invalid') {
    if ($_GPC['opp'] == 'delete') {
        $level = $_GPC['level'];
        if (empty($level)) {
            message('error');
        }
        if ($level == 1) {
            $delete = array('status' => -2, 'checktime' => time());
        }
        if ($level == 2) {
            $delete = array('status2' => -2, 'checktime2' => time());
        }
        if ($level == 3) {
            $delete = array('status3' => -2, 'checktime3' => time());
        }
        $temp = pdo_update('bj_qmxk_order_goods', $delete, array('id' => $_GPC['id']));
        if (empty($temp)) {
            message('删除失败，请重新删除！', $this->createWebUrl('commission', array('op' => 'invalid')), 'error');
        } else {
            message('删除成功！', $this->createWebUrl('commission', array('op' => 'invalid')), 'success');
        }
    }
    if ($_GPC['opp'] == 'sort') {
        $sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
        $shareid = 'select id from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'';
        $list = pdo_fetchall('select 1 as level,o.shareid, o.status, g.id, g.applytime,g.commission*g.total as commission,g.checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status = -1) and (o.shareid in (' . $shareid . ')) union all (select 2 as level,o.shareid2 as shareid, o.status, g.id, g.applytime2 as applytime,g.commission2*g.total as commission,g.checktime2 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status2 = -1) and (o.shareid2 in (' . $shareid . '))) union all (select 3 as level,o.shareid3 as shareid, o.status, g.id, g.applytime3 as applytime,g.commission3*g.total as commission,g.checktime3 as checktime from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status3 = -1) and (o.shareid3 in (' . $shareid . ')))  order by applytime desc ');
        $total = sizeof($list);
    } else {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $list = pdo_fetchall('select 1 as level,o.shareid,o.status, g.id, g.applytime,g.commission*g.total as commission,g.checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status = -1 and o.shareid!=0)  union all (select  2 as level,o.shareid2 as shareid,o.status, g.id, g.applytime2 as applytime,g.commission2*g.total as commission,g.checktime2 as checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status2 = -1 and o.shareid2!=0) )union all (select 3 as level,o.shareid3 as shareid,o.status, g.id, g.applytime3 as applytime,g.commission3*g.total as commission,g.checktime3 as checktime  from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (g.status3 = -1 and o.shareid3!=0) ) order by applytime desc limit ' . ($pindex - 1) * $psize . ',' . $psize);
        $total = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid!=0 )  and (g.status = -1 )');
        $total2 = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid2!=0 )  and (g.status2 = -1 )');
        $total3 = pdo_fetchcolumn('select count(o.id) from ' . tablename('bj_qmxk_order') . ' as o left join ' . tablename('bj_qmxk_order_goods') . ' as g on o.id = g.orderid and o.weid = g.weid where o.weid = ' . $_W['weid'] . ' and (o.shareid3!=0 )  and (g.status3 = -1 )');
        $total = $total + $total2 + $total3;
        $pager = pagination1($total, $pindex, $psize);
    }
    include $this->template('invalid');
    die;
}