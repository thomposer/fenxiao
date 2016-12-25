<?php
$cfg = $this->module['config'];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if (empty($_GPC['from_user'])) {
    message('请选择会员！', create_url('site/module', array('do' => 'charge', 'op' => 'list', 'name' => 'bj_qmxk', 'weid' => $_W['weid'])), 'success');
    die;
}
if ($operation == 'display') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $status = !isset($_GPC['status']) ? 1 : $_GPC['status'];
    $sendtype = !isset($_GPC['sendtype']) ? 0 : $_GPC['sendtype'];
    $condition = '';
    if (!empty($_GPC['keyword'])) {
        $condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
    }
    if (!empty($_GPC['cate_2'])) {
        $cid = intval($_GPC['cate_2']);
        $condition .= " AND ccate = '{$cid}'";
    } elseif (!empty($_GPC['cate_1'])) {
        $cid = intval($_GPC['cate_1']);
        $condition .= " AND pcate = '{$cid}'";
    }
    if ($status != '-1') {
        $condition .= ' AND status = \'' . intval($status) . '\'';
    }
    if (!empty($_GPC['shareid'])) {
        $shareid = $_GPC['shareid'];
        $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $shareid . ' and weid = ' . $_W['weid']);
        $condition .= ' AND (shareid = \'' . intval($_GPC['shareid']) . '\' or shareid2 = \'' . intval($_GPC['shareid']) . '\' or shareid3 = \'' . intval($_GPC['shareid']) . '\') AND createtime>=' . $user['flagtime'] . ' AND from_user<>\'' . $user['from_user'] . '\'';
    }
    if (!empty($sendtype)) {
        $condition .= ' AND sendtype = \'' . intval($sendtype) . '\' AND status != \'3\'';
    }
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE from_user = '{$_GPC['from_user']}' AND weid = '{$_W['weid']}'{$condition} ORDER BY status ASC, createtime DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_order') . " WHERE from_user = '{$_GPC['from_user']}' AND weid = '{$_W['weid']}'{$condition}");
    $pager = pagination($total, $pindex, $psize);
    if (!empty($list)) {
        foreach ($list as $key => $l) {
            $commissions = pdo_fetchall('select total,commission as commission, commission2 as commission2, commission3 as commission3 from ' . tablename('bj_qmxk_order_goods') . ' where orderid = ' . $l['id']);
            foreach ($commissions as $commission) {
                $list[$key]['commission'] = $commission['commission'] * $commission['total'];
                if ($cfg['globalCommissionLevel'] >= 2) {
                    $list[$key]['commission2'] = $commission['commission2'] * $commission['total'];
                } else {
                    $list[$key]['commission2'] = 0;
                }
                if ($cfg['globalCommissionLevel'] >= 3) {
                    $list[$key]['commission3'] = $commission['commission3'] * $commission['total'];
                } else {
                    $list[$key]['commission3'] = 0;
                }
            }
        }
    }
    if (!empty($list)) {
        foreach ($list as &$row) {
            !empty($row['addressid']) && ($addressids[$row['addressid']] = $row['addressid']);
            $row['dispatch'] = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_dispatch') . ' WHERE id = :id', array(':id' => $row['dispatch']));
        }
        unset($row);
    }
    if (!empty($addressids)) {
        $address = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id IN (\'' . implode('\',\'', $addressids) . '\')', array(), 'id');
    }
} elseif ($operation == 'detail') {
    $members = pdo_fetchall('select id, realname from ' . tablename('bj_qmxk_member') . ' where weid = ' . $_W['weid'] . ' and status = 1');
    $member = array();
    foreach ($members as $m) {
        $member[$m['id']] = $m['realname'];
    }
    $id = intval($_GPC['id']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
    if (empty($item)) {
        message('抱歉，订单不存在!', referer(), 'error');
    }
    if (checksubmit('confirmsend')) {
        if (!empty($_GPC['isexpress']) && empty($_GPC['expresssn'])) {
            message('请输入快递单号！');
        }
        $item = pdo_fetch('SELECT transid FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
        if (!empty($item['transid'])) {
            $this->changeWechatSend($id, 1);
        }
        pdo_update('bj_qmxk_order', array('status' => 2, 'remark' => $_GPC['remark'], 'express' => $_GPC['express'], 'expresscom' => $_GPC['expresscom'], 'expresssn' => $_GPC['expresssn']), array('id' => $id));
        message('发货操作成功！', referer(), 'success');
    }
    if (checksubmit('cancelsend')) {
        $item = pdo_fetch('SELECT transid FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
        if (!empty($item['transid'])) {
            $this->changeWechatSend($id, 0, $_GPC['cancelreson']);
        }
        pdo_update('bj_qmxk_order', array('status' => 1, 'remark' => $_GPC['remark']), array('id' => $id));
        message('取消发货操作成功！', referer(), 'success');
    }
    if (checksubmit('finish')) {
        $this->setOrderCredit($id, $_W['weid']);
        pdo_update('bj_qmxk_order', array('status' => 3, 'remark' => $_GPC['remark']), array('id' => $id));
        $tagent = $this->getMember($item['shareid']);
        $profile = $this->getProfile($item['from_user']);
        $this->sendxjdlshtz($item['ordersn'], $item['price'], $profile['realname'], $tagent['from_user']);
        message('订单操作成功！', referer(), 'success');
    }
    if (checksubmit('cancelpay')) {
        pdo_update('bj_qmxk_order', array('status' => 0, 'remark' => $_GPC['remark']), array('id' => $id));
        $this->setOrderStock($id, false);
        message('取消订单付款操作成功！', referer(), 'success');
    }
    if (checksubmit('confrimpay')) {
        pdo_update('bj_qmxk_order', array('status' => 1, 'paytype' => 2, 'remark' => $_GPC['remark']), array('id' => $id));
        $this->setOrderStock($id);
        message('确认订单付款操作成功！', referer(), 'success');
    }
    if (checksubmit('close')) {
        $item = pdo_fetch('SELECT transid FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
        if (!empty($item['transid'])) {
            $this->changeWechatSend($id, 0, $_GPC['reson']);
        }
        pdo_update('bj_qmxk_order', array('status' => -1, 'remark' => $_GPC['remark']), array('id' => $id));
        message('订单关闭操作成功！', referer(), 'success');
    }
    if (checksubmit('open')) {
        pdo_update('bj_qmxk_order', array('status' => 0, 'remark' => $_GPC['remark']), array('id' => $id));
        message('开启订单操作成功！', referer(), 'success');
    }
    $dispatch = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_dispatch') . ' WHERE id = :id', array(':id' => $item['dispatch']));
    if (!empty($dispatch) && !empty($dispatch['express'])) {
        $express = pdo_fetch('select * from ' . tablename('bj_qmxk_express') . ' WHERE id=:id limit 1', array(':id' => $dispatch['express']));
    }
    $item['user'] = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . " WHERE id = {$item['addressid']}");
    $goods = pdo_fetchall('SELECT g.id, g.title, g.status,g.thumb, g.unit,g.goodssn,g.productsn,g.marketprice,o.total,g.type,o.optionname,o.optionid,o.price as orderprice FROM ' . tablename('bj_qmxk_order_goods') . ' o left join ' . tablename('bj_qmxk_goods') . ' g on o.goodsid=g.id ' . " WHERE o.orderid='{$id}'");
    $item['goods'] = $goods;
}
include $this->template('ordermy');