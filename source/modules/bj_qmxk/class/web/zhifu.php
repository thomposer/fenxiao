<?php
$pindex = max(1, intval($_GPC['page']));
$psize = 20;
$weid = $_W['weid'];
$from_user = $_GPC['from_user'];
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
$cfg = $this->module['config'];
$zhifucommission = $cfg['zhifuCommission'];
if (!$zhifucommission) {
    message('请先在参数设置，设置佣金打款限额！', $this->createWebUrl('Commission'), 'success');
}
if (empty($_GPC['realname'])) {
    $realname = 0;
} else {
    $realname = $_GPC['realname'];
}
if ($op == 'list') {
    if ($_GPC['submit'] == '搜索') {
        $list = pdo_fetchall('select * from ' . tablename('bj_qmxk_member') . ' where realname = "' . $realname . '" and zhifu>0 and status = 1 and flag = 1  and weid = ' . $_W['weid'] . ' order by commission desc');
        $total = count($list);
        include $this->template('zhifu');
        die;
    }
    if (intval($_GPC['so']) == 1) {
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_member') . ' WHERE zhifu>0 and status = 1 and flag = 1 and weid = :weid ', array(':weid' => $_W['weid']));
        $pager = pagination($total, $pindex, $psize);
        $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_member') . '  WHERE zhifu>0 and weid=' . $_W['weid'] . '  AND status = 1 and flag = 1 ORDER BY commission DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
    } else {
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_member') . ' WHERE zhifu>0 and status = 1 and flag = 1  AND `weid` = :weid', array(':weid' => $_W['weid']));
        $pager = pagination($total, $pindex, $psize);
        $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE zhifu>0 and weid=' . $_W['weid'] . '  AND status = 1 and flag = 1  ORDER BY commission DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
    }
    include $this->template('zhifu');
}
if ($op == 'post') {
    if (empty($_GPC['from_user'])) {
        message('请选择会员！', create_url('site/module', array('do' => 'zhifu', 'op' => 'list', 'name' => 'bj_qmxk', 'weid' => $_W['weid'])), 'success');
    }
    if (checksubmit()) {
        $chargenum = round($_GPC['chargenum'], 2);
        if ($chargenum) {
            message('已过期');
            return;
            pdo_query('update ' . tablename('bj_qmxk_member') . ' SET zhifu=zhifu+\'' . $chargenum . '\' WHERE from_user=\'' . $_GPC['from_user'] . '\' AND  weid=' . $_W['weid'] . '  ');
            $paylog = array('type' => 'zhifu', 'weid' => $weid, 'openid' => $_GPC['from_user'], 'tid' => date('Y-m-d H:i:s'), 'fee' => $chargenum, 'module' => 'bj_qmxk', 'tag' => ' 后台打款' . $chargenum . '元');
            pdo_insert('paylog', $paylog);
            message('打款成功！', referer(), 'success');
        }
    }
    $from_user = $_GPC['from_user'];
    $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    if (!$profile) {
        message('请选择会员！', create_url('site/module', array('do' => 'zhifu', 'op' => 'list', 'name' => 'bj_qmxk', 'weid' => $_W['weid'])), 'success');
    }
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('paylog') . ' WHERE  openid=\'' . $_GPC['from_user'] . '\' AND type=\'zhifu\' AND `weid` = ' . $_W['weid']);
    $pager = pagination($total, $pindex, $psize);
    $list = pdo_fetchall('SELECT * FROM ' . tablename('paylog') . ' WHERE openid=\'' . $_GPC['from_user'] . '\' AND type=\'zhifu\' AND weid=' . $_W['weid'] . ' ORDER BY plid DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
    $mlist = pdo_fetchall('SELECT `name`,`title` FROM ' . tablename('modules'));
    $mtype = array();
    foreach ($mlist as $k => $v) {
        $mtype[$v['name']] = $v['title'];
    }
    include $this->template('zhifu_post');
}