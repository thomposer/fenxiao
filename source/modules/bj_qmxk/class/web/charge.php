<?php
$pindex = max(1, intval($_GPC['page']));
$psize = 20;
$weid = $_W['weid'];
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
if ($op == 'list') {
    if ($_GPC['submit'] == '搜索') {
        $gpmobile = $_GPC['mobile'];
        $gprealname = $_GPC['realname'];
        $list = pdo_fetchall('SELECT * FROM ' . tablename('fans') . '  WHERE weid=' . $_W['weid'] . '   AND (mobile like \'%' . $gpmobile . '%\' and realname like \'%' . $gprealname . '%\')  and realname<>\'\' ORDER BY id DESC');
        $total = pdo_fetchcolumn('SELECT  COUNT(*) FROM ' . tablename('fans') . '  WHERE weid=' . $_W['weid'] . '   AND (mobile like \'%' . $gpmobile . '%\' and realname like \'%' . $gprealname . '%\')   and realname<>\'\'    ORDER BY id DESC');
        foreach ($list as $key => $item) {
            $member = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $item['from_user']));
            $credit2 = 0;
            if (!empty($member['credit2'])) {
                $credit2 = $member['credit2'];
            }
            if (!empty($member['mobile'])) {
                $list[$key]['mobile'] = $member['mobile'];
            }
            $list[$key]['credit2'] = $credit2;
        }
        include $this->template('charge');
        die;
    }
    if (intval($_GPC['so']) == 1) {
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fans') . ' WHERE weid = :weid    and realname<>\'\'  ', array(':weid' => $_W['weid']));
        $pager = pagination($total, $pindex, $psize);
        $list = pdo_fetchall('SELECT * FROM ' . tablename('fans') . '  WHERE weid=' . $_W['weid'] . '   and realname<>\'\'   ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
    } else {
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fans') . ' WHERE `weid` = :weid   and realname<>\'\'  ', array(':weid' => $_W['weid']));
        $pager = pagination($total, $pindex, $psize);
        $list = pdo_fetchall('SELECT * FROM ' . tablename('fans') . ' WHERE weid=' . $_W['weid'] . '   and realname<>\'\'   ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
    }
    foreach ($list as $key => $item) {
        $member = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $item['from_user']));
        $credit2 = 0;
        if (!empty($member['credit2'])) {
            $credit2 = $member['credit2'];
        }
        $list[$key]['credit2'] = $credit2;
    }
    include $this->template('charge');
}
if ($op == 'post') {
    if (empty($_GPC['from_user'])) {
        message('请选择会员！', create_url('site/module', array('do' => 'charge', 'op' => 'list', 'name' => 'bj_qmxk', 'weid' => $_W['weid'])), 'success');
    }
    if (checksubmit()) {
        if ($_GPC['chargeType'] == 'charge') {
            $fee = round($_GPC['chargenum'], 2);
            if ($fee) {
                if ($_GPC['credit2type'] == 1) {
                    $this->setMemberCredit2($_GPC['from_user'], $fee, 'addgold', ' 后台充值' . $fee . '元');
                    message('充值成功！', referer(), 'success');
                }
                if ($_GPC['credit2type'] == 2) {
                    $this->setMemberCredit2($_GPC['from_user'], $fee, 'usegold', ' 后台提现' . $fee . '元');
                    message('提现成功！', referer(), 'success');
                }
            }
        }
        if ($_GPC['chargeType'] == 'credit1') {
            if (is_int($_GPC['credit1num'])) {
                message('充值积分必须是整数！', referer(), 'error');
            }
            if (intval($_GPC['credit1num']) <= 0) {
                message('充值积分不能为负数或者0', referer(), 'error');
            }
            $credit1num = intval($_GPC['credit1num']);
            if ($credit1num) {
                pdo_query('update ' . tablename('fans') . ' SET credit1=credit1+\'' . $credit1num . '\' WHERE from_user=\'' . $_GPC['from_user'] . '\' AND  weid=' . $_W['weid'] . '  ');
                $paylog = array('type' => 'credit1', 'weid' => $weid, 'openid' => $_GPC['from_user'], 'tid' => date('Y-m-d H:i:s'), 'fee' => $credit1num, 'module' => 'bj_qmxk', 'tag' => ' 充值' . $credit1num . '积分');
                pdo_insert('paylog', $paylog);
                message('充值成功！', referer(), 'success');
            }
        }
    }
    $profile = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $_GPC['from_user']));
    $profile2 = $this->getProfile($_GPC['from_user']);
    if (empty($profile2['credit2'])) {
        $profile2['credit2'] = 0;
    }
    if (empty(${$profile['mobile']})) {
        $profile2['mobile'] = $profile['mobile'];
    }
    if (!$profile) {
        message('请选择会员！', create_url('site/module', array('do' => 'charge', 'op' => 'list', 'name' => 'bj_qmxk', 'weid' => $_W['weid'])), 'success');
    }
    $where = '';
    if ($_GPC['chargeType'] == 'charge') {
        $where = ' and (`type`=\'addgold\' or `type`=\'usegold\')';
    } else {
        $where = ' and `type`=\'' . $_GPC['chargeType'] . '\'';
    }
    $tablename = tablename('paylog');
    if ($_GPC['chargeType'] == 'charge') {
        $tablename = tablename('bj_qmxk_paylog');
    }
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . $tablename . ' WHERE  openid=\'' . $_GPC['from_user'] . '\' ' . $where . ' AND `weid` = ' . $_W['weid']);
    $pager = pagination($total, $pindex, $psize);
    $list = pdo_fetchall('SELECT * FROM ' . $tablename . ' WHERE openid=\'' . $_GPC['from_user'] . '\' ' . $where . '  AND weid=' . $_W['weid'] . ' ORDER BY plid DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
    $mlist = pdo_fetchall('SELECT `name`,`title` FROM ' . tablename('modules'));
    $mtype = array();
    foreach ($mlist as $k => $v) {
        $mtype[$v['name']] = $v['title'];
    }
    if ($_GPC['chargeType'] == 'charge') {
        include $this->template('charge_post');
    }
    if ($_GPC['chargeType'] == 'credit1') {
        include $this->template('charge_post_credit1');
    }
}