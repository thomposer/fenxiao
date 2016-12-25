<?php
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_express') . " WHERE weid = '{$_W['weid']}' ORDER BY displayorder DESC");
} elseif ($operation == 'post') {
    $id = intval($_GPC['id']);
    if (checksubmit('submit')) {
        if (empty($_GPC['express_name'])) {
            message('抱歉，请输入物流名称！');
        }
        $data = array('weid' => $_W['weid'], 'displayorder' => intval($_GPC['express_name']), 'express_name' => $_GPC['express_name'], 'express_url' => $_GPC['express_url'], 'express_area' => $_GPC['express_area']);
        if (!empty($id)) {
            unset($data['parentid']);
            pdo_update('bj_qmxk_express', $data, array('id' => $id));
        } else {
            pdo_insert('bj_qmxk_express', $data);
            $id = pdo_insertid();
        }
        message('更新物流成功！', $this->createWebUrl('express', array('op' => 'display')), 'success');
    }
    $express = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_express') . " WHERE id = '{$id}' and weid = '{$_W['weid']}'");
} elseif ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $express = pdo_fetch('SELECT id  FROM ' . tablename('bj_qmxk_express') . " WHERE id = '{$id}' AND weid=" . $_W['weid'] . '');
    if (empty($express)) {
        message('抱歉，物流方式不存在或是已经被删除！', $this->createWebUrl('express', array('op' => 'display')), 'error');
    }
    pdo_delete('bj_qmxk_express', array('id' => $id));
    message('物流方式删除成功！', $this->createWebUrl('express', array('op' => 'display')), 'success');
} else {
    message('请求方式不存在');
}
include $this->template('express', TEMPLATE_INCLUDEPATH, true);