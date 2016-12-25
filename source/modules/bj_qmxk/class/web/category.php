<?php
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$modules = 'category';
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    if (!empty($_GPC['displayorder'])) {
        foreach ($_GPC['displayorder'] as $id => $displayorder) {
            pdo_update('bj_qmxk_category', array('displayorder' => $displayorder), array('id' => $id));
        }
        message('分类排序更新成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
    }
    $children = array();
    $category = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_category') . " WHERE weid = '{$_W['weid']}' ORDER BY parentid ASC, displayorder DESC");
    foreach ($category as $index => $row) {
        if (!empty($row['parentid'])) {
            $children[$row['parentid']][] = $row;
            unset($category[$index]);
        }
    }
    include $this->template('category');
} elseif ($operation == 'post') {
    $parentid = intval($_GPC['parentid']);
    $id = intval($_GPC['id']);
    if (!empty($id)) {
        $category = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_category') . " WHERE id = '{$id}'");
    } else {
        $category = array('displayorder' => 0);
    }
    if (!empty($parentid)) {
        $parent = pdo_fetch('SELECT id, name FROM ' . tablename('bj_qmxk_category') . " WHERE id = '{$parentid}'");
        if (empty($parent)) {
            message('抱歉，上级分类不存在或是已经被删除！', $this->createWebUrl('post'), 'error');
        }
    }
    if (checksubmit('submit')) {
        if (empty($_GPC['catename'])) {
            message('抱歉，请输入分类名称！');
        }
        $data = array('weid' => $_W['weid'], 'name' => $_GPC['catename'], 'sn' => $_GPC['sn'], 'enabled' => intval($_GPC['enabled']), 'displayorder' => intval($_GPC['displayorder']), 'isrecommand' => intval($_GPC['isrecommand']), 'description' => $_GPC['description'], 'parentid' => intval($parentid));
        if (!empty($_FILES['thumb']['tmp_name'])) {
            file_delete($_GPC['thumb_old']);
            $upload = file_upload($_FILES['thumb']);
            if (is_error($upload)) {
                message($upload['message'], '', 'error');
            }
            $data['thumb'] = $upload['path'];
        }
        if (!empty($id)) {
            unset($data['parentid']);
            pdo_update('bj_qmxk_category', $data, array('id' => $id, 'weid' => $_W['weid']));
        } else {
            pdo_insert('bj_qmxk_category', $data);
            $id = pdo_insertid();
        }
        message('更新分类成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
    }
    include $this->template('category');
} elseif ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $category = pdo_fetch('SELECT id, parentid FROM ' . tablename('bj_qmxk_category') . " WHERE id = '{$id}' and weid = '{$_W['weid']}'");
    if (empty($category)) {
        message('抱歉，分类不存在或是已经被删除！', $this->createWebUrl('category', array('op' => 'display')), 'error');
    }
    pdo_delete('bj_qmxk_category', array('id' => $id, 'parentid' => $id), 'OR');
    message('分类删除成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
}