<?php
if (checksubmit('submit')) {
    if (empty($_GPC['charge']) || round($_GPC['charge'], 2) <= 0) {
        message('请输入要充值的金额');
    }
    $crid = 'tr' . date('YmdHis', time()) . random(4, 1);
    $credit_order = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_credit_order') . " WHERE crid = '{$tid}'");
    if (!empty($credit_order['crid'])) {
        $crid = 'tr' . date('YmdHis', time()) . random(4, 1);
    }
    $data = array('weid' => $_W['weid'], 'openid' => $from_user, 'crid' => $crid, 'fee' => $_GPC['charge'], 'status' => 0, 'createtime' => TIMESTAMP);
    pdo_insert('bj_qmxk_credit_order', $data);
    $params['tid'] = $crid;
    $params['user'] = $from_user;
    $params['fee'] = $_GPC['charge'];
    $params['title'] = '余额充值:' . $_GPC['charge'] . '元';
    $params['virtual'] = true;
    $this->bjpay($params, 1);
    die;
}
include $this->template('rechargecredit2');