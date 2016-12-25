<?php
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $children = array();
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_phb_medal') . " WHERE weid = '{$_W['weid']}' ORDER BY fans_count desc");
    include $this->template('phbmedal');
} elseif ($operation == 'post') {
    $id = intval($_GPC['id']);
    $phbmedal = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_phb_medal') . " WHERE id = '{$id}'");
    if (checksubmit('submit')) {
        if (empty($_GPC['medal_name'])) {
            message('抱歉，请输入分类名称！');
        }
        $data = array('weid' => $_W['weid'], 'medal_name' => $_GPC['medal_name'], 'fans_count' => intval($_GPC['fans_count']));
        if (!empty($id)) {
            pdo_update('bj_qmxk_phb_medal', $data, array('id' => $id, 'weid' => $_W['weid']));
        } else {
            pdo_insert('bj_qmxk_phb_medal', $data);
            $id = pdo_insertid();
        }
        message('更新头衔成功！', $this->createWebUrl('phbmedal', array('op' => 'display')), 'success');
    }
    include $this->template('phbmedal');
} elseif ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $category = pdo_fetch('SELECT id FROM ' . tablename('bj_qmxk_phb_medal') . " WHERE id = '{$id}'");
    if (empty($category)) {
        message('抱歉，头衔不存在或是已经被删除！', $this->createWebUrl('phbmedal', array('op' => 'display')), 'error');
    }
    pdo_delete('bj_qmxk_phb_medal', array('id' => $id, 'weid' => $_W['weid']));
    message('头衔删除成功！', $this->createWebUrl('phbmedal', array('op' => 'display')), 'success');
}