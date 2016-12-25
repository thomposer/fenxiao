<?php
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'post') {
    $award_id = intval($_GPC['award_id']);
    if (!empty($award_id)) {
        $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_credit_award') . ' WHERE award_id = :award_id', array(':award_id' => $award_id));
        if (empty($item)) {
            message('抱歉，兑换商品不存在或是已经删除！', '', 'error');
        }
    }
    if (checksubmit('submit')) {
        if (empty($_GPC['title'])) {
            message('请输入兑换商品名称！');
        }
        if (empty($_GPC['credit_cost'])) {
            message('请输入兑换商品需要消耗的积分数量！');
        }
        if (empty($_GPC['price'])) {
            message('请输入商品实际价值！');
        }
        $credit_cost = intval($_GPC['credit_cost']);
        $price = intval($_GPC['price']);
        $amount = intval($_GPC['amount']);
        $data = array('weid' => $_W['weid'], 'title' => $_GPC['title'], 'logo' => $_GPC['logo'], 'deadline' => $_GPC['deadline'], 'amount' => $amount, 'credit_cost' => $credit_cost, 'price' => $price, 'content' => $_GPC['content'], 'createtime' => TIMESTAMP);
        if (!empty($award_id)) {
            pdo_update('bj_qmxk_credit_award', $data, array('award_id' => $award_id));
        } else {
            pdo_insert('bj_qmxk_credit_award', $data);
        }
        message('商品更新成功！', create_url('site/module/award', array('name' => 'bj_qmxk', 'op' => 'display')), 'success');
    }
} else {
    if ($operation == 'delete') {
        $award_id = intval($_GPC['award_id']);
        $row = pdo_fetch('SELECT award_id FROM ' . tablename('bj_qmxk_credit_award') . ' WHERE award_id = :award_id', array(':award_id' => $award_id));
        if (empty($row)) {
            message('抱歉，商品' . $award_id . '不存在或是已经被删除！');
        }
        pdo_delete('bj_qmxk_credit_award', array('award_id' => $award_id));
        message('删除成功！', referer(), 'success');
    } else {
        if ($operation == 'display') {
            $condition = '';
            $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_credit_award') . " WHERE weid = '{$_W['weid']}' {$condition} ORDER BY createtime DESC");
        }
    }
}
include $this->template('credit_award');