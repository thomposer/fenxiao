<?php
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
$id = $theone['id'];
if (checksubmit('submit') || checksubmit('submit2')) {
    $insert = array('weid' => $_W['weid'], 'terms' => htmlspecialchars_decode($_GPC['terms']), 'commtime' => 0, 'ischeck' => $_GPC['ischeck'], 'createtime' => TIMESTAMP);
    if (empty($id)) {
        pdo_insert('bj_qmxk_rules', $insert);
    } else {
        if (pdo_update('bj_qmxk_rules', $insert, array('id' => $id)) === false) {
            message('更新失败, 请稍后重试.', 'error');
        }
    }
    message('更新成功！', $this->createWebUrl('rules'), 'success');
}
include $this->template('rules');