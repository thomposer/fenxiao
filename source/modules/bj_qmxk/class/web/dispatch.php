<?php
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_dispatch') . " WHERE weid = '{$_W['weid']}' ORDER BY displayorder ");
} elseif ($operation == 'post') {
    $id = intval($_GPC['id']);
    if (checksubmit('submit')) {
        $data = array('weid' => $_W['weid'], 'displayorder' => intval($_GPC['displayorder']), 'dispatchtype' => intval($_GPC['dispatchtype']), 'dispatchname' => $_GPC['dispatchname'], 'express' => $_GPC['express'], 'firstprice' => $_GPC['firstprice'], 'firstweight' => $_GPC['firstweight'], 'secondprice' => $_GPC['secondprice'], 'secondweight' => $_GPC['secondweight'], 'description' => $_GPC['description']);
        if (!empty($id)) {
            pdo_update('bj_qmxk_dispatch', $data, array('id' => $id));
        } else {
            pdo_insert('bj_qmxk_dispatch', $data);
            $id = pdo_insertid();
        }
        message('更新配送方式成功！', $this->createWebUrl('dispatch', array('op' => 'display')), 'success');
    }
    $dispatch = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_dispatch') . " WHERE id = '{$id}' and weid = '{$_W['weid']}'");
    $express = pdo_fetchall('select * from ' . tablename('bj_qmxk_express') . " WHERE weid = '{$_W['weid']}' ORDER BY displayorder DESC");
} elseif ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $dispatch = pdo_fetch('SELECT id  FROM ' . tablename('bj_qmxk_dispatch') . " WHERE id = '{$id}' AND weid=" . $_W['weid'] . '');
    if (empty($dispatch)) {
        message('抱歉，配送方式不存在或是已经被删除！', $this->createWebUrl('dispatch', array('op' => 'display')), 'error');
    }
    pdo_delete('bj_qmxk_dispatch', array('id' => $id));
    message('配送方式删除成功！', $this->createWebUrl('dispatch', array('op' => 'display')), 'success');
} else {
    message('请求方式不存在');
}
include $this->template('dispatch', TEMPLATE_INCLUDEPATH, true);