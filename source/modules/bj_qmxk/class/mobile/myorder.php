<?php
$cfg = $this->module['config'];
$id = $profile['id'];
$op = $_GPC['op'];
if ($op == 'cancelsend') {
    $orderid = intval($_GPC['orderid']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id AND from_user = :from_user', array(':id' => $orderid, ':from_user' => $from_user));
    if (empty($item)) {
        message('抱歉，您的订单不存在或是已经被取消！', $this->createMobileUrl('myorder'), 'error');
    }
    if ($item['paytype'] == 3 && $item['status'] == 1 || $item['status'] == 0) {
        pdo_update('bj_qmxk_order', array('status' => -1, 'updatetime' => time()), array('id' => $orderid, 'from_user' => $from_user));
        message('订单已关闭！', $this->createMobileUrl('myorder'), 'success');
    }
    if ($item['status'] == 2) {
        message('商家已发货无法修改订单');
    }
    message('该订单不可取消');
}
if ($op == 'returngood') {
    $orderid = intval($_GPC['orderid']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id AND from_user = :from_user', array(':id' => $orderid, ':from_user' => $from_user));
    $dispatch = pdo_fetch('select * from ' . tablename('bj_qmxk_dispatch') . ' where id=:id limit 1', array(':id' => $item['dispatch']));
    if (empty($item)) {
        message('抱歉，您的订单不存在或是已经被取消！', $this->createMobileUrl('myorder'), 'error');
    }
    if ($item['status'] != 3) {
        message('订单非完成状态不能申请退货');
    }
    $rebacktime = 1;
    if (!empty($cfg['rebacktime'])) {
        $rebacktime = intval($cfg['rebacktime']);
    }
    if (!empty($item['updatetime'])) {
        if ($item['updatetime'] < time() - $rebacktime * 24 * 60 * 60) {
            message('退货申请时间已过无法退货。');
        }
    } else {
        message('该订单无法退货');
    }
    $opname = '退货';
    if (checksubmit('submit')) {
        pdo_update('bj_qmxk_order', array('status' => -4, 'isrest' => 1, 'rsreson' => $_GPC['rsreson']), array('id' => $orderid, 'from_user' => $from_user));
        message('申请退货成功，请等待审核！', $this->createMobileUrl('myorder'), 'success');
    }
    include $this->template('order_detail_return');
    die;
}
if ($op == 'resendgood') {
    $orderid = intval($_GPC['orderid']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id AND from_user = :from_user', array(':id' => $orderid, ':from_user' => $from_user));
    $dispatch = pdo_fetch('select * from ' . tablename('bj_qmxk_dispatch') . ' where id=:id limit 1', array(':id' => $item['dispatch']));
    if (empty($item)) {
        message('抱歉，您的订单不存在或是已经被取消！', $this->createMobileUrl('myorder'), 'error');
    }
    if ($item['status'] != 3) {
        message('订单非完成状态不能申请换货');
    }
    $rebacktime = 1;
    if (!empty($cfg['rebacktime'])) {
        $rebacktime = intval($cfg['rebacktime']);
    }
    if (!empty($item['updatetime'])) {
        if ($item['updatetime'] < time() - $rebacktime * 24 * 60 * 60) {
            message('换货申请时间已过无法换货。');
        }
    } else {
        message('该订单无法退货');
    }
    $opname = '换货';
    if (checksubmit('submit')) {
        pdo_update('bj_qmxk_order', array('status' => -3, 'isrest' => 1, 'rsreson' => $_GPC['rsreson']), array('id' => $orderid, 'from_user' => $from_user));
        message('申请换货成功，请等待审核！', $this->createMobileUrl('myorder'), 'success');
    }
    include $this->template('order_detail_return');
    die;
}
if ($op == 'returnpay') {
    $orderid = intval($_GPC['orderid']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id AND from_user = :from_user', array(':id' => $orderid, ':from_user' => $from_user));
    $dispatch = pdo_fetch('select * from ' . tablename('bj_qmxk_dispatch') . ' where id=:id limit 1', array(':id' => $item['dispatch']));
    if (empty($item['id'])) {
        message('抱歉，您的订单不存在或是已经被取消！', $this->createMobileUrl('myorder'), 'error');
    }
    $opname = '退款';
    if (checksubmit('submit')) {
        if ($item['paytype'] == 3) {
            message('货到付款订单不能进行退款操作!', referer(), 'error');
        }
        if ($item['status'] != 1) {
            message('订单非已付款状态不能申请退款');
        }
        pdo_update('bj_qmxk_order', array('status' => -2, 'rsreson' => $_GPC['rsreson']), array('id' => $orderid, 'from_user' => $from_user));
        message('申请退款成功，请等待审核！', $this->createMobileUrl('myorder'), 'success');
    }
    include $this->template('order_detail_return');
    die;
} elseif ($op == 'confirm') {
    $orderid = intval($_GPC['orderid']);
    $order = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id AND from_user = :from_user', array(':id' => $orderid, ':from_user' => $from_user));
    if (empty($order)) {
        message('抱歉，您的订单不存在或是已经被取消！', $this->createMobileUrl('myorder'), 'error');
    }
    if (!empty($orderid)) {
        $this->setOrderCredit($orderid, $_W['weid']);
    }
    pdo_update('bj_qmxk_order', array('status' => 3, 'updatetime' => time()), array('id' => $orderid, 'from_user' => $from_user));
    $this->checkisAgent($from_user, $profile);
    $tagent = $this->getMember($this->getShareId());
    $this->sendxjdlshtz($order['ordersn'], $order['price'], $profile['realname'], $tagent['from_user']);
    message('确认收货完成！', $this->createMobileUrl('myorder'), 'success');
} else {
    if ($op == 'detail') {
        $dispatchlist = pdo_fetchall('select id,dispatchname,dispatchtype,firstprice,firstweight,secondprice,secondweight from ' . tablename('bj_qmxk_dispatch') . " WHERE weid = {$_W['weid']} order by displayorder");
        $orderid = intval($_GPC['orderid']);
        $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}' AND from_user = '" . $from_user . "' and id='{$orderid}' limit 1");
        if (empty($item)) {
            message('抱歉，您的订单不存或是已经被取消！', $this->createMobileUrl('myorder'), 'error');
        }
        $goodsid = pdo_fetchall('SELECT goodsid,total FROM ' . tablename('bj_qmxk_order_goods') . " WHERE orderid = '{$orderid}'", array(), 'goodsid');
        $goods = pdo_fetchall('SELECT g.id, g.title, g.thumb, g.unit, g.marketprice,o.total,o.optionid FROM ' . tablename('bj_qmxk_order_goods') . ' o left join ' . tablename('bj_qmxk_goods') . ' g on o.goodsid=g.id ' . " WHERE o.orderid='{$orderid}'");
        foreach ($goods as &$g) {
            $option = pdo_fetch('select title,marketprice,weight,stock from ' . tablename('bj_qmxk_goods_option') . ' where id=:id limit 1', array(':id' => $g['optionid']));
            if ($option) {
                $g['title'] = '[' . $option['title'] . ']' . $g['title'];
                $g['marketprice'] = $option['marketprice'];
            }
        }
        unset($g);
        $dispatch = pdo_fetch('select id,dispatchname,dispatchtype from ' . tablename('bj_qmxk_dispatch') . ' where id=:id limit 1', array(':id' => $item['dispatch']));
        include $this->template('order_detail');
    } else {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $status = intval($_GPC['status']);
        $where = " weid = '{$_W['weid']}' AND from_user = '" . $from_user . '\'';
        if ($status == -5) {
            $where .= ' and ( status=-2 or status=-3 or status=-4 )';
        } else {
            if ($status == 3) {
                $where .= ' and ( status=-5 or status=-6 or status=3 )';
            } else {
                $where .= " and status={$status}";
            }
        }
        $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE {$where} ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(), 'id');
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}' AND from_user = '" . $from_user . '\'');
        $pager = pagination($total, $pindex, $psize);
        if (!empty($list)) {
            foreach ($list as &$row) {
                $goods = pdo_fetchall('SELECT g.id, g.title, g.thumb, g.unit, g.marketprice,o.total,o.optionid FROM ' . tablename('bj_qmxk_order_goods') . ' o left join ' . tablename('bj_qmxk_goods') . ' g on o.goodsid=g.id ' . " WHERE o.orderid='{$row['id']}'");
                foreach ($goods as &$item) {
                    $option = pdo_fetch('select title,marketprice,weight,stock from ' . tablename('bj_qmxk_goods_option') . ' where id=:id limit 1', array(':id' => $item['optionid']));
                    if ($option) {
                        $item['title'] = '[' . $option['title'] . ']' . $item['title'];
                        $item['marketprice'] = $option['marketprice'];
                    }
                }
                unset($item);
                $row['goods'] = $goods;
                $row['total'] = $goodsid;
                $row['dispatch'] = pdo_fetch('select id,dispatchname from ' . tablename('bj_qmxk_dispatch') . ' where id=:id limit 1', array(':id' => $row['dispatch']));
            }
        }
        $carttotal = $this->getCartTotal();
        $fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid and from_user=:from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        include $this->template('order');
    }
}