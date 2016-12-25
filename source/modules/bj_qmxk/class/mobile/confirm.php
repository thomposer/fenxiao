<?php
$id = $profile['id'];
$cfg = $this->module['config'];
$weid = $_W['weid'];
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$totalprice = 0;
$allgoods = array();
$id = intval($_GPC['id']);
$optionid = intval($_GPC['optionid']);
$total = intval($_GPC['total']);
if (empty($total)) {
    $total = 1;
}
$direct = false;
$returnurl = '';
$issendfree = 0;
$promotion = pdo_fetchall('select * from ' . tablename('bj_qmxk_pormotions') . ' where weid=' . $_W['weid'] . '');
if (!empty($id)) {
    $item = pdo_fetch('select id,thumb,ccate,title,weight,marketprice,total,type,totalcnf,sales,unit,istime,timeend,issendfree from ' . tablename('bj_qmxk_goods') . ' where id=:id limit 1', array(':id' => $id));
    foreach ($promotion as $pro) {
        if (TIMESTAMP >= $pro['starttime'] && TIMESTAMP <= $pro['endtime']) {
            if ($pro['promoteType'] == 1) {
                if ($item['marketprice'] >= $pro['condition']) {
                    $issendfree = 1;
                    $protype = $pro['promoteType'];
                }
            } else {
                if ($pro['promoteType'] == 0) {
                    if ($total >= $pro['condition']) {
                        $issendfree = 1;
                        $protype = $pro['promoteType'];
                    }
                }
            }
        }
    }
    if ($item['issendfree'] == 1) {
        $issendfree = 1;
    }
    if ($item['istime'] == 1) {
        if (time() > $item['timeend']) {
            message('抱歉，商品限购时间已到，无法购买了！', referer(), 'error');
        }
    }
    if (!empty($optionid)) {
        $option = pdo_fetch('select title,marketprice,weight,stock from ' . tablename('bj_qmxk_goods_option') . ' where id=:id limit 1', array(':id' => $optionid));
        if ($option) {
            $item['optionid'] = $optionid;
            $item['title'] = $item['title'];
            $item['optionname'] = $option['title'];
            $item['marketprice'] = $option['marketprice'];
            $item['weight'] = $option['weight'];
        }
    }
    $item['stock'] = $item['total'];
    $item['total'] = $total;
    $item['totalprice'] = $total * $item['marketprice'];
    $allgoods[] = $item;
    $totalprice += $item['totalprice'];
    if ($item['type'] == 1) {
        $needdispatch = true;
    }
    $direct = true;
    $returnurl = $this->createMobileUrl('confirm', array('id' => $id, 'optionid' => $optionid, 'total' => $total));
}
if (!$direct) {
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_cart') . " WHERE  weid = '{$_W['weid']}' AND from_user = '" . $from_user . '\'');
    if (!empty($list)) {
        foreach ($list as &$g) {
            $item = pdo_fetch('select id,thumb,ccate,title,weight,marketprice,total,type,totalcnf,sales,unit,issendfree from ' . tablename('bj_qmxk_goods') . ' where id=:id limit 1', array(':id' => $g['goodsid']));
            $option = pdo_fetch('select title,marketprice,weight,stock from ' . tablename('bj_qmxk_goods_option') . ' where id=:id limit 1', array(':id' => $g['optionid']));
            if ($option) {
                if ($item['issendfree'] == 1) {
                    $issendfree = 1;
                }
                $item['optionid'] = $g['optionid'];
                $item['title'] = $item['title'];
                $item['optionname'] = $option['title'];
                $item['marketprice'] = $option['marketprice'];
                $item['weight'] = $option['weight'];
            }
            $item['stock'] = $item['total'];
            $item['total'] = $g['total'];
            $item['totalprice'] = $g['total'] * $item['marketprice'];
            $allgoods[] = $item;
            $totalprice += $item['totalprice'];
            if ($item['type'] == 1) {
                $needdispatch = true;
            }
        }
        foreach ($promotion as $pro) {
            if (TIMESTAMP >= $pro['starttime'] && TIMESTAMP <= $pro['endtime']) {
                if ($pro['promoteType'] == 1) {
                    if ($item['totalprice'] >= $pro['condition']) {
                        $issendfree = 1;
                        $protype = $pro['promoteType'];
                    }
                } else {
                    if ($pro['promoteType'] == 0) {
                        if ($item['total'] >= $pro['condition']) {
                            $issendfree = 1;
                            $protype = $pro['promoteType'];
                        }
                    }
                }
            }
        }
        unset($g);
    }
    $returnurl = $this->createMobileUrl('confirm');
}
if (count($allgoods) <= 0) {
    header('location: ' . $this->createMobileUrl('myorder'));
    die;
}
$dispatch = pdo_fetchall('select id,dispatchname,dispatchtype,firstprice,firstweight,secondprice,secondweight from ' . tablename('bj_qmxk_dispatch') . " WHERE weid = {$_W['weid']} order by displayorder");
foreach ($dispatch as &$d) {
    $weight = 0;
    foreach ($allgoods as $g) {
        $weight += $g['weight'] * $g['total'];
        if ($g['issendfree'] == 1) {
            $issendfree = 1;
        }
    }
    $price = 0;
    if ($issendfree != 1) {
        if ($weight <= $d['firstweight']) {
            $price = $d['firstprice'];
        } else {
            $price = $d['firstprice'];
            $secondweight = $weight - $d['firstweight'];
            if ($secondweight % $d['secondweight'] == 0) {
                $price += (int) ($secondweight / $d['secondweight']) * $d['secondprice'];
            } else {
                $price += (int) ($secondweight / $d['secondweight'] + 1) * $d['secondprice'];
            }
        }
    }
    $d['price'] = $price;
}
unset($d);
if (checksubmit('submit')) {
    $address = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => intval($_GPC['address'])));
    if (empty($address)) {
        message('抱歉，请您填写收货地址！');
    }
    $goodsprice = 0;
    foreach ($allgoods as $row) {
        if ($item['stock'] != -1 && $row['total'] > $item['stock']) {
            message('抱歉，“' . $row['title'] . '”此商品库存不足！', $this->createMobileUrl('confirm'), 'error');
        }
        $goodsprice += $row['totalprice'];
        if ($row['issendfree'] == 1) {
            $issendfree = 1;
        }
    }
    $dispatchid = intval($_GPC['dispatch']);
    $dispatchitem = pdo_fetch('select dispatchtype from ' . tablename('bj_qmxk_dispatch') . ' where id=:id limit 1', array(':id' => $dispatchid));
    $dispatchprice = 0;
    if ($issendfree != 1) {
        foreach ($dispatch as $d) {
            if ($d['id'] == $dispatchid) {
                $dispatchprice = $d['price'];
            }
        }
    }
    if (empty($profile) && empty($profile['id'])) {
        $shareids = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_share_history') . ' WHERE  from_user=:from_user and weid=:weid limit 1', array(':from_user' => $from_user, ':weid' => $_W['weid']));
        if (!empty($shareids['sharemid'])) {
            $seid = $shareids['sharemid'];
            $member = $this->getMember($shareids['sharemid']);
            if ($member['flag'] != 1) {
                $seid = 0;
            }
        } else {
            $seid = 0;
        }
        $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'commission' => 0, 'createtime' => TIMESTAMP, 'flagtime' => TIMESTAMP, 'shareid' => $seid, 'status' => 1, 'flag' => 0);
        pdo_insert('bj_qmxk_member', $data);
    }
    $shareId = $this->getShareId();
    $shareId2 = $this->getShareId('', 2);
    $shareId3 = $this->getShareId('', 3);
    if ($shareId == $shareId2) {
        $shareId2 = 0;
    }
    if ($shareId == $shareId3) {
        $shareId3 = 0;
    }
    if ($shareId2 == $shareId3) {
        $shareId3 = 0;
    }
    if ($cfg['globalCommissionLevel'] < 2) {
        $shareId2 = 0;
    }
    if ($cfg['globalCommissionLevel'] < 3) {
        $shareId3 = 0;
    }
    $ordersns = date('md') . random(6, 1);
    $randomorder = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE  ordersn=:ordersn and weid=:weid limit 1', array(':ordersn' => $ordersns, ':weid' => $_W['weid']));
    if (!empty($randomorder['ordersn'])) {
        $ordersns = date('md') . random(6, 1);
    }
    $paytype = 3;
    if ($dispatchitem['dispatchtype'] == 0) {
        $paytype = 3;
    }
    if ($dispatchitem['dispatchtype'] == 1) {
        $paytype = 2;
    }
    if ($dispatchitem['dispatchtype'] == 3) {
        $paytype = 1;
    }
    $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'ordersn' => $ordersns, 'price' => $goodsprice + $dispatchprice, 'dispatchprice' => $dispatchprice, 'goodsprice' => $goodsprice, 'status' => 0, 'sendtype' => intval($dispatchitem['dispatchtype']), 'dispatch' => $dispatchid, 'paytype' => $paytype, 'goodstype' => intval($cart['type']), 'remark' => $_GPC['remark'], 'addressid' => $address['id'], 'createtime' => TIMESTAMP, 'shareid' => $shareId, 'shareid2' => $shareId2, 'shareid3' => $shareId3);
    pdo_insert('bj_qmxk_order', $data);
    $orderid = pdo_insertid();
    foreach ($allgoods as $row) {
        if (empty($row)) {
            continue;
        }
        $d = array('weid' => $_W['weid'], 'goodsid' => $row['id'], 'orderid' => $orderid, 'total' => $row['total'], 'price' => $row['marketprice'], 'createtime' => TIMESTAMP, 'optionid' => $row['optionid']);
        $o = pdo_fetch('select title from ' . tablename('bj_qmxk_goods_option') . ' where id=:id limit 1', array(':id' => $row['optionid']));
        if (!empty($o)) {
            $d['optionname'] = $o['title'];
        }
        $ccate = $row['ccate'];
        $commission = pdo_fetchcolumn(' SELECT commission FROM ' . tablename('bj_qmxk_goods') . '  WHERE id=' . $row['id']);
        $commission2 = pdo_fetchcolumn(' SELECT commission2 FROM ' . tablename('bj_qmxk_goods') . '  WHERE id=' . $row['id']);
        $commission3 = pdo_fetchcolumn(' SELECT commission3 FROM ' . tablename('bj_qmxk_goods') . '  WHERE id=' . $row['id']);
        if ($commission == false || $commission == null || $commission < 0) {
            $commission = $this->module['config']['globalCommission'];
        }
        if ($commission2 == false || $commission2 == null || $commission2 < 0) {
            $commission2 = $this->module['config']['globalCommission2'];
        }
        if ($commission3 == false || $commission3 == null || $commission3 < 0) {
            $commission3 = $this->module['config']['globalCommission3'];
        }
        if ($this->module['config']['commissionType'] == 1) {
            $commissionTotal = $row['marketprice'] * $commission / 100;
            $d['commission'] = $commissionTotal;
            $commissionTotal2 = $commissionTotal * $commission2 / 100;
            $d['commission2'] = $commissionTotal2;
            $commissionTotal3 = $commissionTotal2 * $commission3 / 100;
            $d['commission3'] = $commissionTotal3;
        } else {
            $commissionTotal = $row['marketprice'] * $commission / 100;
            $d['commission'] = $commissionTotal;
            $commissionTotal2 = $row['marketprice'] * $commission2 / 100;
            $d['commission2'] = $commissionTotal2;
            $commissionTotal3 = $row['marketprice'] * $commission3 / 100;
            $d['commission3'] = $commissionTotal3;
        }
        if ($cfg['globalCommissionLevel'] < 2) {
            $d['commission2'] = 0;
        }
        if ($cfg['globalCommissionLevel'] < 3) {
            $d['commission3'] = 0;
        }
        pdo_insert('bj_qmxk_order_goods', $d);
    }
    if (!$direct) {
        pdo_delete('bj_qmxk_cart', array('weid' => $_W['weid'], 'from_user' => $from_user));
    }
    $this->setOrderStock($orderid);
    die('<script>alert(\'提交订单成功,现在跳转到付款页面..\');location.href=\'' . $this->createMobileUrl('pay', array('orderid' => $orderid, 'topay' => '1')) . '\';</script>');
}
$carttotal = $this->getCartTotal();
$profile = pdo_fetch('SELECT resideprovince,residecity,residedist,address,realname,mobile FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
$row = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE isdefault = 1 and openid = :openid limit 1', array(':openid' => $from_user));
include $this->template('confirm');