<?php
$cfg = $this->module['config'];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $status = !isset($_GPC['status']) ? 1 : $_GPC['status'];
    $sendtype = !isset($_GPC['sendtype']) ? 0 : $_GPC['sendtype'];
    $condition = '';
    if (!empty($_GPC['keyword'])) {
        $condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
    }
    $param_ordersn = $_GPC['ordersn'];
    if (!empty($_GPC['ordersn'])) {
        $condition .= " AND ordersn LIKE '%{$_GPC['ordersn']}%'";
    }
    if (!empty($_GPC['cate_2'])) {
        $cid = intval($_GPC['cate_2']);
        $condition .= " AND ccate = '{$cid}'";
    } elseif (!empty($_GPC['cate_1'])) {
        $cid = intval($_GPC['cate_1']);
        $condition .= " AND pcate = '{$cid}'";
    }
    if ($status == '3') {
        $condition .= ' and ( status = 3 or status = -5 or status = -6)';
    } else {
        if ($status != '-99') {
            $condition .= ' AND status = \'' . intval($status) . '\'';
        }
    }
    if (!empty($_GPC['from_user'])) {
        $condition .= ' AND from_user = \'' . $_GPC['from_user'] . '\'';
    }
    if (!empty($_GPC['shareid'])) {
        $shareid = $_GPC['shareid'];
        $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $shareid . ' and weid = ' . $_W['weid']);
        $condition .= ' AND (shareid = \'' . intval($_GPC['shareid']) . '\' or shareid2 = \'' . intval($_GPC['shareid']) . '\' or shareid3 = \'' . intval($_GPC['shareid']) . '\') AND createtime>=' . $user['flagtime'] . ' AND from_user<>\'' . $user['from_user'] . '\'';
    }
    if (!empty($sendtype)) {
        $condition .= ' AND sendtype = \'' . intval($sendtype) . '\' AND status != \'3\'';
    }
    if (checksubmit('sendbatexpress')) {
        foreach ($_GPC['check'] as $k) {
            $isexpress = $_GPC['express' . $k];
            if ($isexpress != '-1' && empty($_GPC['expressno' . $k])) {
                message('有订单没有快递单号，请填写完整！');
            }
        }
        $index = 0;
        foreach ($_GPC['check'] as $k) {
            $item = pdo_fetch('SELECT transid FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $k));
            $express = $_GPC['express' . $k];
            if ($express == '-1') {
                $express == '';
            }
            if (!empty($item['transid'])) {
                $this->changeWechatSend($k, 1);
            }
            pdo_update('bj_qmxk_order', array('status' => 2, 'sendtime' => TIMESTAMP, 'express' => $express, 'expresscom' => $_GPC['expresscom' . $k], 'expresssn' => $_GPC['expressno' . $k]), array('id' => $k));
            $index = $index + 1;
        }
        message('批量发货操作完成,成功处理' . $index . '条订单', referer(), 'success');
    }
    if (!empty($_GPC['orderstatisticsEXP01'])) {
        $report = 'orderstatistics';
        $condition = '';
        if (!empty($_GPC['ordersn'])) {
            $condition .= " AND t1.ordersn LIKE '%{$_GPC['ordersn']}%'";
        }
        if (!empty($_GPC['shareid'])) {
            $shareid = $_GPC['shareid'];
            $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $shareid . ' and weid = ' . $_W['weid']);
            $condition .= ' AND t1.shareid = \'' . intval($_GPC['shareid']) . '\' AND t1.createtime>=' . $user['flagtime'] . ' AND t1.from_user<>\'' . $user['from_user'] . '\'';
        }
        if ($status != '-99') {
            $condition .= ' AND t1.status = \'' . intval($status) . '\'';
        }
        if ($status == '3') {
            $condition .= ' and ( t1.status = 3 or t1.status = -5 or t1.status = -6)';
        }
        if (!empty($_GPC['orderstatisticsEXP01'])) {
            $psize = 9999;
            $pindex = 1;
        }
        $list = pdo_fetchall('select t1.* from (SELECT orders.from_user,orders.status,orders.sendtype,orders.weid,orders.id,orders.createtime,orders.ordersn,orders.price,orders.dispatchprice,orders.paytype,orders.shareid,(select member.realname from ' . tablename('bj_qmxk_member') . ' member where member.from_user=orders.from_user and orders.weid=member.weid limit 1 ) realnamestr,(select taddress.realname from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdrealname,(select concat(taddress.province,taddress.city,taddress.area,taddress.address) from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdaddress,(select taddress.mobile from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdmobile from ' . tablename('bj_qmxk_order') . " orders where orders.weid = :weid {$conditionOrderStatus} order by orders.createtime  desc) t1 where t1.weid = :weid   {$condition}   LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':weid' => $_W['weid']));
        foreach ($list as $id => $displayorder) {
            $list[$id]['ordergoods'] = pdo_fetchall('SELECT (select category.name	from' . tablename('bj_qmxk_category') . ' category where (0=goods.ccate and category.id=goods.pcate) or (0!=goods.ccate and category.id=goods.ccate) ) as categoryname,(select category.sn	from' . tablename('bj_qmxk_category') . ' category where (0=goods.ccate and category.id=goods.pcate) or (0!=goods.ccate and category.id=goods.ccate) ) as categorysn,goods.thumb,ordersgoods.price,ordersgoods.total,goods.title,ordersgoods.optionname from ' . tablename('bj_qmxk_order_goods') . ' ordersgoods left join ' . tablename('bj_qmxk_goods') . ' goods on goods.id=ordersgoods.goodsid  where ordersgoods.weid = :weid and ordersgoods.orderid=:oid order by ordersgoods.createtime  desc ', array(':weid' => $_W['weid'], ':oid' => $list[$id]['id']));
        }
        require_once 'report.php';
        die;
    }
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}' {$condition} ORDER BY  createtime DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}' {$condition}");
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
    $members = pdo_fetchall('select id, realname from ' . tablename('bj_qmxk_member'));
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
        pdo_update('bj_qmxk_order', array('status' => 2, 'express' => $_GPC['express'], 'expresscom' => $_GPC['expresscom'], 'expresssn' => $_GPC['expresssn'], 'sendtime' => TIMESTAMP), array('id' => $id));
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
        if ($item['status'] != 3) {
            $this->setOrderCredit($id, $_W['weid']);
        }
        pdo_update('bj_qmxk_order', array('status' => 3, 'updatetime' => time()), array('id' => $id));
        message('订单操作成功！', referer(), 'success');
    }
    if (checksubmit('cancelpay')) {
        pdo_update('bj_qmxk_order', array('status' => 0), array('id' => $id));
        $this->setOrderStock($id, false);
        message('取消订单付款操作成功！', referer(), 'success');
    }
    if (checksubmit('confrimpay')) {
        pdo_update('bj_qmxk_order', array('status' => 1, 'paytype' => 2, 'remark' => $_GPC['remark']), array('id' => $id));
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
    if (checksubmit('cancelreturn')) {
        $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
        $ostatus = 3;
        if ($item['status'] == -2) {
            $ostatus = 1;
        }
        if ($item['status'] == -3) {
            $ostatus = 3;
        }
        if ($item['status'] == -4) {
            $ostatus = 3;
        }
        pdo_update('bj_qmxk_order', array('status' => $ostatus), array('id' => $id));
        message('退回操作成功！', referer(), 'success');
    }
    if (checksubmit('returnpay')) {
        $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
        if ($item['paytype'] == 3) {
            message('货到付款订单不能进行退款操作!', referer(), 'error');
        }
        pdo_update('bj_qmxk_order', array('status' => -6), array('id' => $id));
        $this->setOrderStock($id, false);
        $this->setMemberCredit2($item['from_user'], $item['price'], 'addgold', '订单:' . $item['ordersn'] . '退款返还余额');
        message('退款操作成功！', referer(), 'success');
    }
    if (checksubmit('returngood')) {
        $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
        pdo_update('bj_qmxk_order', array('status' => -5), array('id' => $id));
        $this->setOrderStock($id, false);
        $this->setOrderCredit($item['openid'], $id, false, '订单:' . $item['ordersn'] . '退货扣除积分');
        $this->setMemberCredit2($item['from_user'], $item['price'], 'addgold', '订单:' . $item['ordersn'] . '退货返还余额');
        message('退货操作成功！', referer(), 'success');
    }
    $dispatch = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_dispatch') . ' WHERE id = :id', array(':id' => $item['dispatch']));
    if (!empty($dispatch) && !empty($dispatch['express'])) {
        $express = pdo_fetch('select * from ' . tablename('bj_qmxk_express') . ' WHERE id=:id limit 1', array(':id' => $dispatch['express']));
    }
    $item['user'] = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . " WHERE id = {$item['addressid']}");
    $goods = pdo_fetchall('SELECT g.id,o.total,o.commission,o.commission2,o.commission3, g.title, g.status,g.thumb, g.unit,g.goodssn,g.productsn,g.marketprice,o.total,g.type,o.optionname,o.optionid,o.price as orderprice FROM ' . tablename('bj_qmxk_order_goods') . ' o left join ' . tablename('bj_qmxk_goods') . ' g on o.goodsid=g.id ' . " WHERE o.orderid='{$id}'");
    $item['goods'] = $goods;
}
if ($operation == 'normal_print') {
    $id = intval($_GPC['print_orderid']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
    $address = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => $item['addressid']));
    $pid = intval($_GPC['print_modle_id']);
    $entry = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_printer') . ' WHERE  id=:id', array(':id' => $pid));
    $buyer = '';
    $bj_qmxk_member = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid=:weid and from_user=:from_user', array(':weid' => $_W['weid'], ':from_user' => $item['from_user']));
    $buyer = $bj_qmxk_member['realname'];
    if (empty($buyer)) {
        $buyer = $address['realname'];
    }
    echo '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>';
    $previewtmp = $entry['printerconfig'];
    for ($i = 1; $i < 3; $i++) {
        $previewtmp = str_replace('{buyer}', $buyer, $previewtmp);
        $previewtmp = str_replace('{consignee}', $address['realname'], $previewtmp);
        $previewtmp = str_replace('{tel}', $address['mobile'], $previewtmp);
        $previewtmp = str_replace('{address}', $address['province'] . $address['city'] . $address['area'] . $address['address'], $previewtmp);
        $previewtmp = str_replace('{pay_type}', $item['paytype'] == 1 ? '余额支付' : ($item['paytype'] == 2 ? '在线支付' : ($item['paytype'] == 3 ? '货到付款' : '')), $previewtmp);
        $previewtmp = str_replace('{dispatch_type}', $item['expresscom'], $previewtmp);
        $previewtmp = str_replace('{dispatch_sn}', $item['expresssn'], $previewtmp);
        $previewtmp = str_replace('{order_sn}', $item['ordersn'], $previewtmp);
        $previewtmp = str_replace('{time}', $item['createtime'], $previewtmp);
        $previewtmp = str_replace('{order_price}', $item['price'], $previewtmp);
        $previewtmp = str_replace('{dispatch_price}', $item['dispatchprice'], $previewtmp);
        $previewtmp = str_replace('{good_price}', $item['goodsprice'], $previewtmp);
        $previewtmp = str_replace('{print_time}', date('Y-m-d H:i:s', time()), $previewtmp);
        $good_line = '<table width="100%" border="1" style="border-collapse:collapse;border-color:#000;">
    <tr align="center">
        <td bgcolor="#cccccc">商品名称 </td>
        <td bgcolor="#cccccc">价格 </td>
        <td bgcolor="#cccccc">数量</td>
        <td bgcolor="#cccccc">小计</td>
    </tr>';
        $goods = pdo_fetchall('SELECT g.*,o.price  as \'order_price\' ,o.total as \'order_total\',o.optionname as \'order_optionname\' FROM ' . tablename('bj_qmxk_order_goods') . ' o left join ' . tablename('bj_qmxk_goods') . ' g on o.goodsid=g.id ' . " WHERE o.orderid='{$id}'");
        $goodsmoney = 0;
        foreach ($goods as $good) {
            $goodmoney = $good['order_price'] * $good['order_total'];
            $goodsmoney = $goodsmoney + $goodmoney;
            $good_line = $good_line . '  <tr>
        <td>&nbsp;' . $good['title'] . '&nbsp&nbsp&nbsp' . $good['order_optionname'] . '</td>
        <td align="right">￥' . $good['order_price'] . '元&nbsp;</td>
        <td align="right">' . $good['order_total'] . '&nbsp;</td>
        <td align="right">￥' . $goodmoney . '元&nbsp;</td>
    </tr>';
        }
        $good_line = $good_line . ' <tr>
        <td colspan="4" align="right">商品总金额：￥' . $goodsmoney . '元</td>
    </tr>
</table>';
        $previewtmp = str_replace('{good_line}', $good_line, $previewtmp);
    }
    echo htmlspecialchars_decode($previewtmp);
    echo '<script>this.focus();this.print();</script></body>';
    die;
}
if ($operation == 'express_print') {
    $id = intval($_GPC['print_express_orderid']);
    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id', array(':id' => $id));
    $address = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => $item['addressid']));
    $pid = intval($_GPC['print_modle_id']);
    $entry = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_printer') . ' WHERE  id=:id', array(':id' => $pid));
    $buyer = '';
    $bj_qmxk_member = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid=:weid and from_user=:from_user', array(':weid' => $_W['weid'], ':from_user' => $item['from_user']));
    $buyer = $bj_qmxk_member['realname'];
    $previewtmp = $entry['printerconfig'];
    if (!empty($entry['expressconfig'])) {
        $t_expressconfig = iunserializer($entry['expressconfig']);
        $entry['print_from_compy'] = $t_expressconfig['print_from_compy'];
        $entry['print_from_uname'] = $t_expressconfig['print_from_uname'];
        $entry['print_from_addr'] = $t_expressconfig['print_from_addr'];
        $entry['print_from_tel'] = $t_expressconfig['print_from_tel'];
    }
    for ($i = 1; $i < 3; $i++) {
        $previewtmp = str_replace('购货人', $buyer, $previewtmp);
        $previewtmp = str_replace('收货姓名', $address['realname'], $previewtmp);
        $previewtmp = str_replace('收货电话', $address['mobile'], $previewtmp);
        $previewtmp = str_replace('收货地址', $address['province'] . $address['city'] . $address['area'] . $address['address'], $previewtmp);
        $previewtmp = str_replace('支付方式', $item['paytype'] == 1 ? '余额支付' : ($item['paytype'] == 2 ? '在线支付' : ($item['paytype'] == 3 ? '货到付款' : '')), $previewtmp);
        $previewtmp = str_replace('配送方式', $item['expresscom'], $previewtmp);
        $previewtmp = str_replace('发货单号', $item['expresssn'], $previewtmp);
        $previewtmp = str_replace('订单编号', $item['ordersn'], $previewtmp);
        $previewtmp = str_replace('下单时间', date('Y-m-d H:i:s', $item['createtime']), $previewtmp);
        $previewtmp = str_replace('订单金额', $item['price'], $previewtmp);
        $previewtmp = str_replace('配送费用', $item['dispatchprice'], $previewtmp);
        $previewtmp = str_replace('商品金额', $item['goodsprice'], $previewtmp);
        $previewtmp = str_replace('打印时间', date('Y-m-d H:i:s', time()), $previewtmp);
        $previewtmp = str_replace('寄件公司', $entry['print_from_compy'], $previewtmp);
        $previewtmp = str_replace('寄件人', $entry['print_from_uname'], $previewtmp);
        $previewtmp = str_replace('寄件地址', $entry['print_from_addr'], $previewtmp);
        $previewtmp = str_replace('寄件电话', $entry['print_from_tel'], $previewtmp);
        $previewtmp = str_replace('年', date('Y', time()), $previewtmp);
        $previewtmp = str_replace('月', date('m', time()), $previewtmp);
        $previewtmp = str_replace('日', date('d', time()), $previewtmp);
    }
    $onlyprint = true;
    include $this->template('printer_express_print');
    die;
}
$normal_order_list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_printer') . ' WHERE weid = :weid and printertype=0 order by isdefault desc', array(':weid' => $_W['weid']));
$express_order_list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_printer') . ' WHERE weid = :weid and printertype=1 order by isdefault desc', array(':weid' => $_W['weid']));
if (!empty($_GPC['dobatch'])) {
    include $this->template('orderbat');
    die;
}
include $this->template('order');