<?php
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$modules = 'credit';
if ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $row = pdo_fetch('SELECT id FROM ' . tablename('bj_qmxk_credit_request') . ' WHERE id = :id', array(':id' => $id));
    if (empty($row)) {
        message('抱歉，编号为' . $id . '的兑换请求不存在或是已经被删除！');
    }
    pdo_delete('bj_qmxk_credit_request', array('id' => $id));
    message('删除成功！', referer(), 'success');
} else {
    if ($operation == 'display') {
        $condition = '';
        $sql = 'SELECT * FROM ' . tablename('bj_qmxk_credit_award') . ' as t1,' . tablename('bj_qmxk_credit_request') . "as t2 WHERE t1.award_id=t2.award_id AND t1.weid = '{$_W['weid']}' ORDER BY t2.createtime DESC";
        $list = pdo_fetchall($sql);
        $ar = pdo_fetchall($sql, array(), 'from_user');
        $arrayAR = array_keys($ar);
        $fans = pdo_fetchall('SELECT from_user,realname,mobile,credit1,residedist FROM ' . tablename('fans') . ' WHERE from_user IN (\'' . implode('\',\'', $arrayAR) . "') and weid = '{$_W['weid']}'", array(), 'from_user');
    }
}
include $this->template('credit_request');