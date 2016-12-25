<?php
$checkjsweixin = '1';
$cfg = $this->module['config'];
$title = $cfg['shopname'];
$qq= $cfg['qq'];
if (empty($title)) {
    $title = '商城首页';
}
$from_user = $this->getFromUser();
$fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE from_user=:from_user and weid=:weid', array(':from_user' => $from_user, ':weid' => $_W['weid']));
$this->validateopenid();
$day_cookies = 15;
$shareid = BAIJIA_COOKIE_SID . $_W['weid'];
if ($_GPC['mid'] != $_COOKIE[$shareid] && !empty($_GPC['mid'])) {
    $this->shareClick($_GPC['mid'], $_GPC['joinway']);
    setcookie($shareid, $this->getShareId(), time() + 3600 * 24 * $day_cookies);
}
$this->autoRegedit('list');
$profile = $this->getProfile();
$this->checkisAgent($from_user, $profile);
if ($fans['follow'] != 1) {
    $shownotice = true;
}
$pindex = max(1, intval($_GPC['page']));
$psize = 4;
$condition = '';
if (!empty($_GPC['ccate'])) {
    $cid = intval($_GPC['ccate']);
    $condition .= " AND ccate = '{$cid}'";
    $_GPC['pcate'] = pdo_fetchcolumn('SELECT parentid FROM ' . tablename('bj_qmxk_category') . ' WHERE id = :id', array(':id' => intval($_GPC['ccate'])));
} elseif (!empty($_GPC['pcate'])) {
    $cid = intval($_GPC['pcate']);
    $condition .= " AND pcate = '{$cid}'";
}
if (!empty($_GPC['keyword'])) {
    $condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
}
$children = array();
$category = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_category') . " WHERE weid = '{$_W['weid']}' and enabled=1 ORDER BY parentid ASC, displayorder DESC", array(), 'id');
foreach ($category as $index => $row) {
    if (!empty($row['parentid'])) {
        $children[$row['parentid']][$row['id']] = $row;
        unset($category[$index]);
    }
}
$recommandcategory = array();
foreach ($category as &$c) {
    if ($c['isrecommand'] == 1) {
        $c['list'] = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}' and deleted=0 AND status = '1'  and pcate='{$c['id']}'  ORDER BY displayorder DESC, sales DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
        $c['total'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0  AND status = '1' and pcate='{$c['id']}'");
        $c['pager'] = pagination($c['total'], $pindex, $psize, $url = '', $context = array('before' => 0, 'after' => 0, 'ajaxcallback' => ''));
        $recommandcategory[] = $c;
    }
    if (!empty($children[$c['id']])) {
        foreach ($children[$c['id']] as &$child) {
            if ($child['isrecommand'] == 1) {
                $child['list'] = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0 AND status = '1'  and pcate='{$c['id']}' and ccate='{$child['id']}'  ORDER BY displayorder DESC, sales DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
                $child['total'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0  AND status = '1' and pcate='{$c['id']}' and ccate='{$child['id']}' ");
                $child['pager'] = pagination($child['total'], $pindex, $psize, $url = '', $context = array('before' => 0, 'after' => 0, 'ajaxcallback' => ''));
                $recommandcategory[] = $child;
            }
        }
        unset($child);
    }
}
unset($c);
$carttotal = $this->getCartTotal();
$advs = pdo_fetchall('select * from ' . tablename('bj_qmxk_adv') . " where enabled=1 and weid= '{$_W['weid']}'  order by displayorder asc");
foreach ($advs as &$adv) {
    if (substr($adv['link'], 0, 5) != 'http:') {
        $adv['link'] = $adv['link'];
    }
}
unset($adv);
$rpindex = max(1, intval($_GPC['rpage']));
$rpsize = 6;
$condition = ' and isrecommand=1';
$rlist = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0 AND status = '1' {$condition} ORDER BY id,displayorder DESC, sales DESC ");
$cfg = $this->module['config'];
if (empty($cfg['indexss'])) {
    $cfg['indexss'] = 5;
}
$islist = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0 AND status = '1' and istime='1' ORDER BY displayorder DESC, sales DESC limit {$cfg['indexss']}");
$logo = $cfg['logo'];
$ydyy = $cfg['ydyy'];
$description = $cfg['description'];
$id = $profile['id'];
if ($profile['status'] == 0) {
    $profile['flag'] = 0;
}
$theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
if ($theone['ischeck'] == 2) {
    $signPackage = $this->getSignPackage('list', array('dzdid' => -1));
    if ($_GPC['act'] == 'module' && empty($_GPC['dzdid'])) {
        if (!empty($_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']])) {
            $_GPC['dzdid'] = $_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']];
        }
    }
    $sitelogo = $_W['attachurl'] . '/headimg_' . $_W['weid'] . '.jpg?weid=' . $_W['account']['weid'];
    if (!file_exists('./resource/attachment/headimg_' . $_W['weid'] . '.jpg')) {
        $sitelogo = BJ_QMXK_ROOT . '/recouse/images/nofile.png';
    }
    $rlistcount = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}' and deleted=0 AND status = '1'");
    if (CUSTOMER_CODE == '003LZ') {
        $dayordercount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0 AND status = '1'  and  ({$_W['timestamp']} - createtime) <=1295990 ");
    }
    if (!empty($_GPC['dzdid']) && $_GPC['dzdid'] != -1) {
        $dzdid = intval($_GPC['dzdid']);
        if (!empty($dzdid)) {
            $dzduid = $dzdid;
            $dzdprofile = $this->getProfileByID($dzduid);
            if (!empty($dzdprofile['id'])) {
                if ($dzdprofile['flag'] == 1) {
                    $title = $dzdprofile['dzdtitle'];
                    $avatar = pdo_fetchcolumn('SELECT avatar FROM ' . tablename('fans') . " WHERE weid = '{$_W['weid']}' and from_user=:from_user", array(':from_user' => $dzdprofile['from_user']));
                    if (!empty($dzdid)) {
                        $signdata = array('dzdid' => $dzdid);
                    } else {
                        $signdata = array();
                    }
                    if (!empty($avatar)) {
                        $sitelogo = $avatar;
                        $signdata['sitelogo'] = $avatar;
                    }
                    if (!empty($dzdprofile['dzdtitle'])) {
                        $signdata['title'] = $dzdprofile['dzdtitle'];
                    } else {
                        $title = $dzdprofile['realname'];
                    }
                    if (!empty($dzdprofile['dzdsendtext'])) {
                        $signdata['description'] = $dzdprofile['dzdsendtext'];
                    }
                    $signPackage = $this->getSignPackage('list', $signdata);
                }
            }
            $theone['ischeck'] = 1;
            setcookie('dzdid_' . BJ_QMXK_VERSION . $_W['weid'], $dzduid, time() + 3600);
            include $this->template('dzdlist');
            die;
        }
    }
    $theone['ischeck'] = 1;
} else {
    $signPackage = $this->getSignPackage();
}
$dzduid = -1;
setcookie('dzdid_' . BJ_QMXK_VERSION . $_W['weid'], 0, time() + 3600);
include $this->template('list');