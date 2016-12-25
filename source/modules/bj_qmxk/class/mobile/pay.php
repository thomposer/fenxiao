<?php
$orderid = intval($_GPC['orderid']);
$order = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id and from_user=:from_user', array(':id' => $orderid, 'from_user' => $from_user));
$goodsstr = '';
$bodygoods = '';
$paytitle = '';
if (empty($order['id'])) {
    message('抱歉，未找到相关订单！');
}
if ($order['status'] != '0' && !($order['status'] == 1 && $order['paytype'] == 3)) {
    message('抱歉，您的订单已经付款或是被关闭，请重新进入付款！', $this->createMobileUrl('myorder'), 'error');
}
$ordergoods = pdo_fetchall('SELECT goodsid, total,optionid FROM ' . tablename('bj_qmxk_order_goods') . " WHERE orderid = '{$orderid}'", array(), 'goodsid');
if (!empty($ordergoods)) {
    $goods = pdo_fetchall('SELECT id, title, thumb, marketprice, unit, total,credit FROM ' . tablename('bj_qmxk_goods') . ' WHERE id IN (\'' . implode('\',\'', array_keys($ordergoods)) . '\')');
}
if (!empty($goods)) {
    foreach ($goods as $row) {
        if (empty($paytitle)) {
            $paytitle = $row['title'];
        }
        $goodsstr .= "{$row['title']}({$ordergoods[$row['id']]['total']})<br/>";
        $bodygoods .= "名称：{$row['title']} ，数量：{$ordergoods[$row['id']]['total']} <br />";
    }
}
$newpaytype = 0;
if (!empty($_GPC['dispatchid'])) {
    $dispatchid = intval($_GPC['dispatchid']);
    $dispatch = pdo_fetch('select id,dispatchname,dispatchtype from ' . tablename('bj_qmxk_dispatch') . ' where id=:id ', array(':id' => $dispatchid));
    if ($dispatch['dispatchtype'] == 0) {
        $newpaytype = 3;
    }
    if ($dispatch['dispatchtype'] == 1) {
        $newpaytype = 2;
    }
    if ($dispatch['dispatchtype'] == 3) {
        $newpaytype = 1;
    }
    if (!empty($newpaytype)) {
        if ($order['status'] == 1 && $order['paytype'] == 3 && $newpaytype != 3) {
            pdo_update('bj_qmxk_order', array('status' => 0, 'paytype' => $newpaytype, 'sendtype' => $dispatch['dispatchtype']), array('id' => $order['id']));
        } else {
            pdo_update('bj_qmxk_order', array('paytype' => $newpaytype, 'sendtype' => $dispatch['dispatchtype']), array('id' => $order['id']));
        }
        $order['sendtype'] = $dispatch['dispatchtype'];
    }
}
if (checksubmit('codsubmit') || checksubmit('credit2submit')) {
    if (checksubmit('credit2submit')) {
        $member = $this->getProfile();
        if ($member['credit2'] < $order['price']) {
            message('所剩余额不足无法购买！');
        }
    }
    if (!empty($this->module['config']['noticeemail'])) {
        $address = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => $order['addressid']));
        $body = '<h3>购买商品清单</h3> <br />';
        if (!empty($goods)) {
            $body .= $bodygoods;
        }
        $body .= "<br />总金额：{$order['price']}元 （货到付款）<br />";
        $body .= '<h3>购买用户详情</h3> <br />';
        $body .= "真实姓名：{$address['realname']} <br />";
        $body .= "地区：{$address['province']} - {$address['city']} - {$address['area']}<br />";
        $body .= "详细地址：{$address['address']} <br />";
        $body .= "手机：{$address['mobile']} <br />";
        ihttp_email($this->module['config']['noticeemail'], '微商城订单提醒', $body);
    }
    $tagent = $this->getMember($this->getShareId());
    if (checksubmit('codsubmit')) {
        $this->sendgmsptz($order['ordersn'], $order['price'], $profile['realname'], $tagent['from_user']);
        pdo_update('bj_qmxk_order', array('status' => '1', 'paytype' => '3'), array('id' => $orderid));
        $this->sendMobilePayMsg($order, $goods, '货时付款', $ordergoods);
        message('订单提交成功，请您收到货时付款！', $this->createMobileUrl('myorder'), 'success');
    }
    if (checksubmit('credit2submit')) {
        $this->sendgmsptz($order['ordersn'], $order['price'], $profile['realname'], $tagent['from_user']);
        $this->setMemberCredit2($profile['from_user'], $order['price'], 'usegold', '余款付款购买商品，订单编号为' . $order['ordersn']);
        pdo_update('bj_qmxk_order', array('status' => '1', 'paytype' => '1'), array('id' => $orderid));
        $this->sendMobilePayMsg($order, $goods, '余额付款', $ordergoods);
        message('余额付款成功，请您收到货时验货！', $this->createMobileUrl('myorder'), 'success');
    }
}
if (empty($paytitle)) {
    $paytitle = $_W['account']['name'];
}
$params['tid'] = $orderid;
$params['user'] = $from_user;
$params['fee'] = $order['price'];
$params['title'] = $paytitle;
$params['ordersn'] = $order['ordersn'];
$params['virtual'] = $order['goodstype'] == 2 ? true : false;
if (empty($_GPC['topay'])) {
    $this->bjpay($params, $order['sendtype']);
} else {
    $this->bjpay($params, $order['sendtype']);
}