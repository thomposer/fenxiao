<?php
$needfixcount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_member') . ' WHERE flag=1 and flagtime=0');
if ($needfixcount > 0) {
    pdo_update('bj_qmxk_member', array('flagtime' => TIMESTAMP), array('flag' => 1, 'flagtime' => 0));
}
$op = $_GPC['op'] ? $_GPC['op'] : 'salereport';
if ($op == 'salereport') {
    $nowyear = intval(date('Y', time()));
    $nowmonth = intval(date('m', time()));
    $years = array(array('year' => $nowyear - 3, 'checked' => 0), array('year' => $nowyear - 2, 'checked' => 0), array('year' => $nowyear - 1, 'checked' => 0), array('year' => $nowyear, 'checked' => 1));
    $dropMonthForYaer = $_GPC['dropMonthForYaer'] ? $_GPC['dropMonthForYaer'] : $nowyear;
    $radioMonthForSaleType = $_GPC['radioMonthForSaleType'] ? $_GPC['radioMonthForSaleType'] : '0';
    $dropMonthForYaer = intval($dropMonthForYaer);
    $selectmonthSale = $_GPC['selectmonthSale'] ? $_GPC['selectmonthSale'] : $nowmonth;
    $radiodayForSaleType = $_GPC['radiodayForSaleType'] ? $_GPC['radiodayForSaleType'] : '0';
    $dropdayForYaer = $_GPC['dropdayForYaer'] ? $_GPC['dropdayForYaer'] : $nowyear;
    $dropdayForYaer = intval($dropdayForYaer);
    foreach ($years as $id => $displayorder) {
        if ($years[$id]['year'] == $dropMonthForYaer) {
            $years[$id]['checked'] = 1;
        } else {
            $years[$id]['checked'] = 0;
        }
    }
    $datas = array(array());
    $index = 0;
    $allcount = 0;
    $topcount = 0;
    for ($month = 1; $month <= 12; $month++) {
        $datas[$index]['month'] = $month;
        $lastday = date('t', strtotime($dropMonthForYaer . '-' . $month . '-1'));
        if ($radioMonthForSaleType == '0') {
            $ordercount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}'  and createtime >=" . strtotime($dropMonthForYaer . '-' . $month . '-1' . ' 00:00:01') . ' and createtime <=' . strtotime($dropMonthForYaer . '-' . $month . '-' . $lastday . ' 23:59:59'));
        }
        if ($radioMonthForSaleType == '1') {
            $ordercount = pdo_fetchcolumn('SELECT sum(cast(price as decimal(8,2))) FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}'  and createtime >=" . strtotime($dropMonthForYaer . '-' . $month . '-1' . ' 00:00:01') . ' and createtime <=' . strtotime($dropMonthForYaer . '-' . $month . '-' . $lastday . ' 23:59:59'));
        }
        if (empty($ordercount)) {
            $ordercount = 0;
        }
        if ($topcount < $ordercount) {
            $topcount = $ordercount;
        }
        $datas[$index]['month'] = $month;
        $datas[$index]['count'] = $ordercount;
        $allcount = $allcount + $ordercount;
        $index = $index + 1;
        if ($nowyear == $dropMonthForYaer) {
            if ($nowmonth == $month) {
                $month = 13;
            }
        }
    }
    foreach ($datas as $index => $row) {
        if ($allcount > 0) {
            $datas[$index]['persent'] = round($datas[$index]['count'] / $allcount, 2) * 100;
        } else {
            $datas[$index]['persent'] = 0;
        }
    }
    $dayallcount = 0;
    $daytopcount = 0;
    $daydatas = array(array());
    $dayindex = 0;
    $lastday = date('t', strtotime($dropdayForYaer . '-' . $selectmonthSale . '-1'));
    for ($day = 1; $day <= $lastday; $day++) {
        if ($radiodayForSaleType == '0') {
            $dayordercount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}'  and createtime >=" . strtotime($dropdayForYaer . '-' . $selectmonthSale . '-' . $day . ' 00:00:01') . ' and createtime <=' . strtotime($dropdayForYaer . '-' . $selectmonthSale . '-' . $day . ' 23:59:59'));
        }
        if ($radiodayForSaleType == '1') {
            $dayordercount = pdo_fetchcolumn('SELECT sum(cast(price as decimal(8,2))) FROM ' . tablename('bj_qmxk_order') . " WHERE weid = '{$_W['weid']}'  and createtime >=" . strtotime($dropdayForYaer . '-' . $selectmonthSale . '-' . $day . ' 00:00:01') . ' and createtime <=' . strtotime($dropdayForYaer . '-' . $selectmonthSale . '-' . $day . ' 23:59:59'));
        }
        if (empty($dayordercount)) {
            $dayordercount = 0;
        }
        $daydatas[$dayindex]['day'] = $day;
        $daydatas[$dayindex]['count'] = $dayordercount;
        $dayindex = $dayindex + 1;
        $dayallcount = $dayallcount + $dayordercount;
        if ($daytopcount < $dayordercount) {
            $daytopcount = $dayordercount;
        }
    }
    foreach ($daydatas as $index => $row) {
        if ($dayallcount > 0) {
            $daydatas[$index]['persent'] = round($daydatas[$index]['count'] / $dayallcount, 2) * 100;
        } else {
            $daydatas[$index]['persent'] = 0;
        }
    }
    if (!empty($_GPC['salereportEXP01'])) {
        $report = 'salereport01';
        $list = $datas;
        require_once 'report.php';
        die;
    }
    if (!empty($_GPC['salereportEXP02'])) {
        $report = 'salereport02';
        $list = $daydatas;
        require_once 'report.php';
        die;
    }
    include $this->template('salereport');
    die;
}
if ($op == 'memberranking') {
    $sortname = $_GPC['sortname'] ? $_GPC['sortname'] : 'ordermoney';
    if (!empty($_GPC['start_time']) && !empty($_GPC['end_time'])) {
        $start_time = strtotime($_GPC['start_time'] . ' 00:00:01');
        $end_time = strtotime($_GPC['end_time'] . ' 23:59:59');
    } else {
        $start_time = strtotime(date('Y-m-01 00:00:01', time()));
        $end_time = strtotime(date('Y-m-t 23:59:59', time()));
    }
    $condition1 = '';
    $condition2 = '';
    if (!empty($start_time) && !empty($end_time) && !empty($_GPC['start_time']) && !empty($_GPC['end_time'])) {
        $condition1 = ' and orders.createtime>=' . $start_time . ' and ' . 'orders.createtime<=' . $end_time;
        $condition2 = ' and orders2.createtime>=' . $start_time . ' and ' . 'orders2.createtime<=' . $end_time;
    }
    $list = pdo_fetchall('SELECT member.realname,(' . 'SELECT count(orders.id) FROM ' . tablename('bj_qmxk_order') . ' orders where orders.from_user=member.from_user and orders.weid=member.weid ' . $condition1 . ') as ordercount,(' . 'SELECT sum(cast(orders2.price as decimal(8,2))) FROM ' . tablename('bj_qmxk_order') . ' orders2 where orders2.from_user=member.from_user  and member.weid=orders2.weid ' . $condition2 . ') ordermoney FROM ' . tablename('bj_qmxk_member') . " member WHERE member.weid = '{$_W['weid']}' ORDER BY " . $sortname . '  DESC limit 100');
    if (!empty($_GPC['memberrankingEXP01'])) {
        $report = 'memberranking';
        require_once 'report.php';
        die;
    }
    include $this->template('memberranking');
    die;
}
if ($op == 'fansrange') {
    $list = pdo_fetchall('SELECT member.*,(select count(his.sharemid) from ' . tablename('bj_qmxk_share_history') . ' his where his.sharemid=member.id  ) fanscount FROM ' . tablename('bj_qmxk_member') . ' member  WHERE member.weid = :weid and member.status=1  order by fanscount desc limit 30', array(':weid' => $_W['weid']));
    include $this->template('fansrange');
    die;
}
if ($op == 'productsalestatistics') {
    $goodslist = pdo_fetchall('SELECT goods.id,goods.sales from  ' . tablename('bj_qmxk_goods') . ' goods  where goods.weid = :weid', array(':weid' => $_W['weid']));
    foreach ($goodslist as $gooditem) {
        $goodtotal = pdo_fetchcolumn('SELECT sum(goodorder.total) FROM ' . tablename('bj_qmxk_order_goods') . ' goodorder left join ' . tablename('bj_qmxk_order') . ' orders on orders.id=goodorder.orderid WHERE goodorder.goodsid = :id and orders.status>=1', array(':id' => $gooditem['id']));
        if ($goodtotal > 0 && $goodslist['sales'] != $goodtotal && !empty($goodtotal)) {
            pdo_update('bj_qmxk_goods', array('sales' => $goodtotal), array('id' => $gooditem['id']));
        }
    }
    $list = pdo_fetchall('SELECT goods.*,0 as cpersent,goods.sales salescount from ' . tablename('bj_qmxk_goods') . ' goods  where goods.weid = :weid order by salescount desc ', array(':weid' => $_W['weid']));
    foreach ($list as $id => $displayorder) {
        $list[$id]['cpersent'] = round($list[$id]['salescount'] / ($list[$id]['viewcount'] == 0 ? 1 : $list[$id]['viewcount']) * 100, 2);
        if (empty($list[$id]['viewcount'])) {
            $list[$id]['viewcount'] = 0;
        }
        if (empty($list[$id]['salescount'])) {
            $list[$id]['salescount'] = 0;
        }
        if (empty($list[$id]['cpersent'])) {
            $list[$id]['cpersent'] = 0;
        }
    }
    include $this->template('productsalestatistics');
    die;
}
if ($op == 'userincreasestatistics') {
    $usertype = $_GPC['usertype'] ? $_GPC['usertype'] : 'user';
    $condtitiontime = '';
    $conditionflag = '';
    if ($usertype == 'agent') {
        $conditionflag = ' and flag=1';
        $condtitiontime = 'flagtime';
    } else {
        $condtitiontime = 'createtime';
    }
    $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_member') . "   WHERE weid = '{$_W['weid']}' ");
    $nowyear = intval(date('Y', time()));
    $nowmonth = intval(date('m', time()));
    $years = array(array('year' => $nowyear - 3, 'checked' => 0), array('year' => $nowyear - 2, 'checked' => 0), array('year' => $nowyear - 1, 'checked' => 0), array('year' => $nowyear, 'checked' => 1));
    $nowday = date('t', time());
    $chartdata1 = array();
    $index = 0;
    for ($dateindex = 7; $dateindex >= 0; $dateindex--) {
        if ($dateindex == 0) {
            $time = date('Y-m-d', time());
        } else {
            $time = date('Y-m-d', strtotime('-' . $dateindex . ' day'));
        }
        $start_time = strtotime($time . ' 00:00:01');
        $end_time = strtotime($time . ' 23:59:59');
        $chart1data = pdo_fetch('SELECT count(*) as counts,\'' . $time . '\' as dates FROM ' . tablename('bj_qmxk_member') . "   WHERE weid = '{$_W['weid']}' {$conditionflag} and " . $condtitiontime . '>=' . $start_time . ' and  ' . $condtitiontime . '<=' . $end_time);
        $chartdata1[$index]['counts'] = $chart1data['counts'];
        $chartdata1[$index]['dates'] = $chart1data['dates'];
        $chartdata1[$index]['index'] = $index;
        $index = $index + 1;
    }
    $index = 0;
    $chartdata2 = array();
    $dropMonthForYaer = $_GPC['dropMonthForYaer'] ? $_GPC['dropMonthForYaer'] : $nowyear;
    $dropMonthForYaer = intval($dropMonthForYaer);
    $selectmonthSale = $_GPC['selectmonthSale'] ? $_GPC['selectmonthSale'] : $nowmonth;
    $lastday = date('t', strtotime($dropMonthForYaer . '-' . $selectmonthSale . '-1'));
    foreach ($years as $id => $displayorder) {
        if ($years[$id]['year'] == $dropMonthForYaer) {
            $years[$id]['checked'] = 1;
        } else {
            $years[$id]['checked'] = 0;
        }
    }
    for ($dateindex = 1; $dateindex <= $lastday; $dateindex++) {
        $time = $dropMonthForYaer . '-' . $selectmonthSale . '-' . $dateindex;
        $start_time = strtotime($time . ' 00:00:01');
        $end_time = strtotime($time . ' 23:59:59');
        $chart1data = pdo_fetch('SELECT count(*) as counts,\'' . $time . '\' as dates FROM ' . tablename('bj_qmxk_member') . "   WHERE weid = '{$_W['weid']}' {$conditionflag} and " . $condtitiontime . '>=' . $start_time . ' and  ' . $condtitiontime . '<=' . $end_time);
        $chartdata2[$index]['counts'] = $chart1data['counts'];
        $chartdata2[$index]['dates'] = $dateindex;
        $chartdata2[$index]['index'] = $index;
        $index = $index + 1;
    }
    $index = 0;
    $chartdata3 = array();
    $dropMonthForYaer2 = $_GPC['dropMonthForYaer2'] ? $_GPC['dropMonthForYaer2'] : $nowyear;
    $dropMonthForYaer2 = intval($dropMonthForYaer2);
    $years2 = array(array('year' => $nowyear - 3, 'checked' => 0), array('year' => $nowyear - 2, 'checked' => 0), array('year' => $nowyear - 1, 'checked' => 0), array('year' => $nowyear, 'checked' => 1));
    foreach ($years2 as $id => $displayorder) {
        if ($years2[$id]['year'] == $dropMonthForYaer2) {
            $years2[$id]['checked'] = 1;
        } else {
            $years2[$id]['checked'] = 0;
        }
    }
    for ($dateindex = 1; $dateindex <= 12; $dateindex++) {
        $lastday = date('t', strtotime($dropMonthForYaer2 . '-' . $dateindex . '-1'));
        $time = $dropMonthForYaer2 . '-' . $dateindex;
        $start_time = strtotime($time . '-1' . ' 00:00:01');
        $end_time = strtotime($time . '-' . $lastday . ' 23:59:59');
        $chart1data = pdo_fetch('SELECT count(*) as counts,\'' . $time . '\' as dates FROM ' . tablename('bj_qmxk_member') . "   WHERE weid = '{$_W['weid']}' {$conditionflag} and " . $condtitiontime . '>=' . $start_time . ' and  ' . $condtitiontime . '<=' . $end_time);
        $chartdata3[$index]['counts'] = $chart1data['counts'];
        $chartdata3[$index]['dates'] = $chart1data['dates'];
        $chartdata3[$index]['index'] = $index;
        $index = $index + 1;
    }
    include $this->template('userincreasestatistics');
    die;
}
if ($op == 'saletargets') {
    $allorderprice = pdo_fetchcolumn('SELECT sum(cast(price as decimal(8,2))) FROM ' . tablename('bj_qmxk_order') . " WHERE status=3 and weid = '{$_W['weid']}' ");
    $allordercount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_order') . " WHERE status=3 and weid = '{$_W['weid']}' ");
    $allmembercount = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('bj_qmxk_member') . "   WHERE weid = '{$_W['weid']}' ");
    $allorderviewcount = pdo_fetchcolumn('SELECT sum(cast(viewcount as decimal(8,0))) FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}' ");
    $haveordermembercount = pdo_fetchcolumn('SELECT count(member.id) from ' . tablename('bj_qmxk_member') . " member  WHERE member.weid = '{$_W['weid']}' and  member.from_user in (SELECT orders.from_user FROM" . tablename('bj_qmxk_order') . " orders where orders.weid = '{$_W['weid']}' group by orders.from_user)");
    include $this->template('saletargets');
    die;
}
if ($op == 'productsaleranking') {
    $condition = '';
    if (!empty($_GPC['start_time']) && !empty($_GPC['end_time'])) {
        $start_time = strtotime($_GPC['start_time'] . ' 00:00:01');
        $end_time = strtotime($_GPC['end_time'] . ' 23:59:59');
    } else {
        $start_time = strtotime(date('Y-m-01 00:00:01', time()));
        $end_time = strtotime(date('Y-m-t 23:59:59', time()));
    }
    $condition = ' and ordergoods.createtime>=' . $start_time . ' and ordergoods.createtime<=' . $end_time;
    $list = pdo_fetchall('SELECT goods.*,0 as cpersent,(select sum((ordergoods.price*ordergoods.total)) from  ' . tablename('bj_qmxk_order_goods') . " ordergoods where ordergoods.goodsid=goods.id and ordergoods.weid=goods.weid {$condition}) salesmoney,(select sum(ordergoods.total) from  " . tablename('bj_qmxk_order_goods') . " ordergoods where ordergoods.goodsid=goods.id and ordergoods.weid=goods.weid {$condition}) salescount  from " . tablename('bj_qmxk_goods') . ' goods  where goods.weid = :weid order by salesmoney  desc', array(':weid' => $_W['weid']));
    if (!empty($_GPC['productsalerankingEXP01'])) {
        $report = 'productsaleranking';
        require_once 'report.php';
        die;
    }
    include $this->template('productsaleranking');
    die;
}
if ($op == 'saledetails') {
    $condition = '';
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    if (!empty($_GPC['start_time']) && !empty($_GPC['end_time'])) {
        $start_time = strtotime($_GPC['start_time'] . ' 00:00:01');
        $end_time = strtotime($_GPC['end_time'] . ' 23:59:59');
    } else {
        $start_time = strtotime(date('Y-m-01 00:00:01', time()));
        $end_time = strtotime(date('Y-m-t 23:59:59', time()));
    }
    $condition = ' and orders.createtime>=' . $start_time . ' and orders.createtime<=' . $end_time;
    if (!empty($_GPC['saledetailsEXP01'])) {
        $psize = 9999;
        $pindex = 1;
    }
    $list = pdo_fetchall('SELECT ordergoods.price,ordergoods.total,(select title from ' . tablename('bj_qmxk_goods') . ' goods where ordergoods.goodsid=goods.id) titles,orders.createtime,orders.ordersn from  ' . tablename('bj_qmxk_order_goods') . ' ordergoods left join ' . tablename('bj_qmxk_order') . " orders  on orders.id=ordergoods.orderid where orders.weid = :weid {$condition} order by orders.createtime  desc  LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':weid' => $_W['weid']));
    $total = pdo_fetchcolumn('SELECT count(ordergoods.id) from  ' . tablename('bj_qmxk_order_goods') . ' ordergoods left join ' . tablename('bj_qmxk_order') . " orders  on orders.id=ordergoods.orderid where orders.weid = :weid {$condition} order by orders.createtime desc", array(':weid' => $_W['weid']));
    $pager = pagination($total, $pindex, $psize);
    if (!empty($_GPC['saledetailsEXP01'])) {
        $report = 'saledetails';
        require_once 'report.php';
        die;
    }
    include $this->template('saledetails');
    die;
}
if ($op == 'orderstatistics') {
    $condition = '';
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    if (!empty($_GPC['start_time']) && !empty($_GPC['end_time'])) {
        $start_time = strtotime($_GPC['start_time'] . ' 00:00:01');
        $end_time = strtotime($_GPC['end_time'] . ' 23:59:59');
    } else {
        $start_time = strtotime(date('Y-m-01 00:00:01', time()));
        $end_time = strtotime(date('Y-m-t 23:59:59', time()));
    }
    $condition = ' and t1.createtime>=' . $start_time . ' and t1.createtime<=' . $end_time;
    if (!empty($_GPC['realname'])) {
        $realname = $_GPC['realname'];
        $condition .= ' and t1.realnamestr=\'' . $realname . '\'';
    }
    if (!empty($_GPC['addressname'])) {
        $addressname = $_GPC['addressname'];
        $condition .= ' and t1.tdrealname=\'' . $addressname . '\'';
    }
    if (!empty($_GPC['ordersn'])) {
        $ordersn = $_GPC['ordersn'];
        $condition .= ' and t1.ordersn=\'' . $ordersn . '\'';
    }
    if (!empty($_GPC['allorderstatus'])) {
        $allorderstatus = 1;
        $conditionOrderStatus = 'and orders.status>=0';
    } else {
        $allorderstatus = 0;
        $conditionOrderStatus = 'and orders.status=3';
    }
    if (!empty($_GPC['orderstatisticsEXP01'])) {
        $psize = 9999;
        $pindex = 1;
    }
    $list = pdo_fetchall('select t1.* from (SELECT orders.status,orders.weid,orders.id,orders.createtime,orders.ordersn,orders.price,orders.dispatchprice,orders.paytype,(select member.realname from ' . tablename('bj_qmxk_member') . ' member where member.from_user=orders.from_user and orders.weid=member.weid limit 1 ) realnamestr,(select taddress.realname from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdrealname,(select concat(taddress.province,taddress.city,taddress.area,taddress.address) from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdaddress,(select taddress.mobile from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdmobile from ' . tablename('bj_qmxk_order') . " orders where orders.weid = :weid {$conditionOrderStatus} order by orders.createtime  desc) t1 where t1.weid = :weid   {$condition}   LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':weid' => $_W['weid']));
    foreach ($list as $id => $displayorder) {
        $list[$id]['ordergoods'] = pdo_fetchall('SELECT (select category.name	from' . tablename('bj_qmxk_category') . ' category where (0=goods.ccate and category.id=goods.pcate) or (0!=goods.ccate and category.id=goods.ccate) ) as categoryname,(select category.sn	from' . tablename('bj_qmxk_category') . ' category where (0=goods.ccate and category.id=goods.pcate) or (0!=goods.ccate and category.id=goods.ccate) ) as categorysn,goods.thumb,ordersgoods.price,ordersgoods.total,goods.title,ordersgoods.optionname from ' . tablename('bj_qmxk_order_goods') . ' ordersgoods left join ' . tablename('bj_qmxk_goods') . ' goods on goods.id=ordersgoods.goodsid  where ordersgoods.weid = :weid and ordersgoods.orderid=:oid order by ordersgoods.createtime  desc ', array(':weid' => $_W['weid'], ':oid' => $list[$id]['id']));
    }
    $total = pdo_fetchcolumn('select count(t1.id) from (SELECT orders.weid,orders.id,orders.createtime,orders.ordersn,orders.price,orders.dispatchprice,orders.paytype,(select member.realname from ' . tablename('bj_qmxk_member') . ' member where member.from_user=orders.from_user and orders.weid=member.weid limit 1 ) realnamestr,(select taddress.realname from ' . tablename('bj_qmxk_address') . ' taddress where taddress.id=orders.addressid  and orders.weid=taddress.weid limit 1 ) tdrealname from ' . tablename('bj_qmxk_order') . " orders where orders.weid = :weid {$conditionOrderStatus} order by orders.createtime  desc) t1 where t1.weid = :weid  {$condition}  ", array(':weid' => $_W['weid']));
    $pager = pagination($total, $pindex, $psize);
    if (!empty($_GPC['orderstatisticsEXP01'])) {
        $report = 'orderstatistics';
        require_once 'report.php';
        die;
    }
    include $this->template('orderstatistics');
    die;
}