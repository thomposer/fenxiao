<?php
$operation = empty($_GPC['op']) ? 'display' : $_GPC['op'];
$operation = in_array($operation, array('display')) ? $operation : 'display';
$pindex = max(1, intval($_GPC['page']));
$psize = 50;
$starttime = empty($_GPC['starttime']) ? strtotime('-1 month') : strtotime($_GPC['starttime']);
$endtime = empty($_GPC['endtime']) ? TIMESTAMP : strtotime($_GPC['endtime']) + 86399;
$where .= ' WHERE `weid` = :weid AND `createtime` >= :starttime AND `createtime` < :endtime';
$paras = array(':weid' => $_W['weid'], ':starttime' => $starttime, ':endtime' => $endtime);
$keyword = $_GPC['keyword'];
if (!empty($keyword)) {
    $where .= ' AND `feedbackid`=:feedbackid';
    $paras[':feedbackid'] = $keyword;
}
$type = empty($_GPC['type']) ? 0 : $_GPC['type'];
$type = intval($type);
if ($type != 0) {
    $where .= ' AND `type`=:type';
    $paras[':type'] = $type;
}
$status = empty($_GPC['status']) ? 0 : intval($_GPC['status']);
$status = intval($status);
if ($status != -1) {
    $where .= ' AND `status` = :status';
    $paras[':status'] = $status;
}
$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_feedback') . $where, $paras);
$list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_feedback') . $where . ' ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, $paras);
$pager = pagination($total, $pindex, $psize);
$transids = array();
foreach ($list as $row) {
    $transids[] = $row['transid'];
}
if (!empty($transids)) {
    $sql = 'SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE weid='{$_W['weid']}' AND transid IN ( '" . implode('\',\'', $transids) . '\' )';
    $orders = pdo_fetchall($sql, array(), 'transid');
}
$addressids = array();
foreach ($orders as $transid => $order) {
    $addressids[] = $order['addressid'];
}
$addresses = array();
if (!empty($addressids)) {
    $sql = 'SELECT * FROM ' . tablename('bj_qmxk_address') . " WHERE weid='{$_W['weid']}' AND id IN ( '" . implode('\',\'', $addressids) . '\' )';
    $addresses = pdo_fetchall($sql, array(), 'id');
}
foreach ($list as &$feedback) {
    $transid = $feedback['transid'];
    $order = $orders[$transid];
    $feedback['order'] = $order;
    $addressid = $order['addressid'];
    $feedback['address'] = $addresses[$addressid];
}
include $this->template('notice');