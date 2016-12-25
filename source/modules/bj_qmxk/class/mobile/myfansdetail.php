<?php
$level = $_GPC['level'];
$id = $profile['id'];
$flag = $_GPC['flag'];
if ($level == '1' || $level == '2' || $level == '3') {
    $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where mber1.realname<>\'\' and mber1.id!=mber1.shareid ' . (!empty($flag) && $flag != 0 ? 'and mber1.flag=' . $flag : '') . ' and mber1.shareid = ' . $profile['id'];
    if ($level == '1') {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 25;
        $fansall = pdo_fetchall('	select fans.*,\'\' as avatar from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']} order by fans.createtime desc limit " . ($pindex - 1) * $psize . ',' . $psize);
        foreach ($fansall as $key => $c) {
            $fansall[$key]['avatar'] = pdo_fetchcolumn('select fans.avatar from ' . tablename('fans') . " fans where  fans.weid = {$_W['weid']} and fans.from_user='" . $c['from_user'] . '\'  limit 1');
        }
        $total = pdo_fetchcolumn('	select  count(fans.id) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}");
        $pager = pagination($total, $pindex, $psize);
    }
}
if ($level == '2' || $level == '3') {
    $level2 = 'select level2m.id from ' . tablename('bj_qmxk_member') . ' level2m where level2m.id!=level2m.shareid and  level2m.shareid = ' . $profile['id'];
    $sql2_member = 'select mber2.from_user from ' . tablename('bj_qmxk_member') . ' mber2 where mber2.realname<>\'\' and mber2.id!=mber2.shareid ' . (!empty($flag) && $flag != 0 ? 'and mber2.flag=' . $flag : '') . '  and mber2.shareid in (' . $level2 . ')  ';
    if ($level == '2') {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 25;
        $fansall = pdo_fetchall('	select fans.*,\'\' as avatar from ' . tablename('bj_qmxk_member') . " fans where  from_user!='{$from_user}' and  ( fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ") ) and fans.weid={$_W['weid']}  order by fans.createtime desc limit " . ($pindex - 1) * $psize . ',' . $psize);
        foreach ($fansall as $key => $c) {
            $fansall[$key]['avatar'] = pdo_fetchcolumn('select fans.avatar from ' . tablename('fans') . " fans where  fans.weid = {$_W['weid']} and fans.from_user='" . $c['from_user'] . '\'  limit 1');
        }
        $total = pdo_fetchcolumn('	select count(fans.id) from ' . tablename('bj_qmxk_member') . " fans where  from_user!='{$from_user}' and  ( fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ") ) and fans.weid={$_W['weid']}  ");
        $pager = pagination($total, $pindex, $psize);
    }
}
if ($level == '3') {
    $level3 = 'select level3m.id from ' . tablename('bj_qmxk_member') . ' level3m where level3m.id!=level3m.shareid and level3m.shareid in( ' . $level2 . ')';
    $sql3_member = 'select mber3.from_user from ' . tablename('bj_qmxk_member') . ' mber3 where mber3.realname<>\'\' and mber3.id!=mber3.shareid ' . (!empty($flag) && $flag != 0 ? 'and mber3.flag=' . $flag : '') . '  and mber3.shareid in (' . $level3 . ')  ';
    if ($level == '3') {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 25;
        $fansall = pdo_fetchall('	select fans.*,\'\' as avatar from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}  order by fans.createtime desc limit " . ($pindex - 1) * $psize . ',' . $psize);
        foreach ($fansall as $key => $c) {
            $fansall[$key]['avatar'] = pdo_fetchcolumn('select fans.avatar from ' . tablename('fans') . " fans where  fans.weid = {$_W['weid']} and fans.from_user='" . $c['from_user'] . '\'  limit 1');
        }
        $total = pdo_fetchcolumn('	select count(fans.id) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}  ");
        $pager = pagination($total, $pindex, $psize);
    }
}
if ($level == '4') {
    $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where mber1.realname<>\'\' and mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
    $pindex = max(1, intval($_GPC['page']));
    $psize = 25;
    $fansall = pdo_fetchall('	select fans.*,\'\' as avatar from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}  order by fans.createtime desc  limit " . ($pindex - 1) * $psize . ',' . $psize);
    foreach ($fansall as $key => $c) {
        $fansall[$key]['avatar'] = pdo_fetchcolumn('select fans.avatar from ' . tablename('fans') . " fans where  fans.weid = {$_W['weid']} and fans.from_user='" . $c['from_user'] . '\'  limit 1');
    }
    $total = pdo_fetchcolumn('	select count(fans.id) from ' . tablename('bj_qmxk_member') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}  ");
    $pager = pagination($total, $pindex, $psize);
}
if ($level == '5') {
    $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where mber1.realname<>\'\' and mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
    $pindex = max(1, intval($_GPC['page']));
    $psize = 25;
    $fansall = pdo_fetchall('	select fans.*,\'\' as avatar from ' . tablename('bj_qmxk_member') . ' fans where (select follow from ' . tablename('fans') . " wefans where wefans.from_user=fans.from_user and wefans.weid=fans.weid  limit 1)=1 and from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}  order by fans.createtime desc limit " . ($pindex - 1) * $psize . ',' . $psize);
    foreach ($fansall as $key => $c) {
        $fansall[$key]['avatar'] = pdo_fetchcolumn('select fans.avatar from ' . tablename('fans') . " fans where  fans.weid = {$_W['weid']} and fans.from_user='" . $c['from_user'] . '\'  limit 1');
    }
    $total = pdo_fetchcolumn('	select  count(fans.id) from ' . tablename('bj_qmxk_member') . ' fans where (select follow from ' . tablename('fans') . " wefans where wefans.from_user=fans.from_user and wefans.weid=fans.weid  limit 1)=1 and from_user!='{$from_user}' and ( fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}  order by fans.createtime desc");
    $pager = pagination($total, $pindex, $psize);
}
include $this->template('myfansDetail');