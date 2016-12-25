<?php
$modules = 'promotion';
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $prolist = pdo_fetchall('select * from ' . tablename('bj_qmxk_pormotions') . "where weid='{$_W['weid']}' order by id desc");
} else {
    if ($operation == 'post') {
        $id = intval($_GPC['id']);
        if (checksubmit('submit')) {
            $data = array('weid' => $_W['weid'], 'promoteType' => $_GPC['radioPromotionType'], 'condition' => (int) intval($_GPC['promotionmoney']), 'pname' => $_GPC['promotionname'], 'starttime' => strtotime($_GPC['start_time']), 'endtime' => strtotime($_GPC['end_time']), 'description' => $GPC['description']);
            if ($data['starttime'] > $data['endtime']) {
                message('设置错误，开始时间不能大于结束时间', $this->createWebUrl('promotion', array('op' => 'post', 'stup' => 1)), 'error');
                return;
            }
            if (empty($data['pname'])) {
                message('请输入活动名称', $this->createWebUrl('promotion', array('op' => 'post', 'stup' => 1)), 'error');
                return;
            }
            if (empty($data['condition'])) {
                message('请输入满额(件)数量', $this->createWebUrl('promotion', array('op' => 'post', 'stup' => 1)), 'error');
                return;
            }
            if (!empty($id)) {
                pdo_update('bj_qmxk_pormotions', $data, array('id' => $id, 'weid' => $_W['weid']));
            } else {
                pdo_insert('bj_qmxk_pormotions', $data);
                $id = pdo_insertid();
            }
            message('更新活动内容成功！', $this->createWebUrl('promotion', array('op' => 'display'), 'success'));
        }
        $pro = pdo_fetch('select * from ' . tablename('bj_qmxk_pormotions') . 'where id=:id and weid=:weid limit 1', array(':id' => $id, ':weid' => $_W['weid']));
    } else {
        if ($operation == 'delete') {
            $id = intval($_GPC['id']);
            $pro = pdo_fetch('select id from' . tablename('bj_qmxk_pormotions') . "where id='{$id}' and weid=" . $_W['weid'] . '');
            if (empty($pro['id'])) {
                message('促销活动不存在或者已被删除', $this->createWebUrl('promotion', array('op' => 'display', 'stup' => 2)), 'error');
            }
            pdo_delete('bj_qmxk_pormotions', array('id' => $id, 'weid' => $_W['weid']));
            message('删除成功', $this->createWebUrl('promotion', array('op' => 'display', 'stup' => 2)), 'success');
        } else {
            message('请求方法不存在');
        }
    }
}
include $this->template('promotion', TEMPLATE_INCLUDEPATH, true);