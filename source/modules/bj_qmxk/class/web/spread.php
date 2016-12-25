<?php
$op = empty($_GPC['op']) ? 'leaflet' : $_GPC['op'];
$rulekeywordcount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('rule_keyword') . ' WHERE weid=:weid and module=\'bj_qmxk\' and content=\'分销专属二维码\'', array(':weid' => $_W['weid']));
$boolrule = false;
if ($rulekeywordcount >= 1) {
    $boolrule = true;
}
if ($op == 'checkspreadrule') {
    if (!empty($_GPC['boolrule'])) {
        $rulekeywordcount = pdo_fetchall('SELECT rid FROM ' . tablename('rule_keyword') . ' WHERE weid=:weid and module=\'bj_qmxk\' and content=\'分销专属二维码\'', array(':weid' => $_W['weid']));
        foreach ($rulekeywordcount as $k => $v) {
            pdo_delete('rule', array('id' => $v['rid'], 'weid' => $_W['weid'], 'module' => 'bj_qmxk'));
        }
        pdo_delete('rule_keyword', array('module' => 'bj_qmxk', 'weid' => $_W['weid'], 'content' => '分销专属二维码'));
        $insert = array('weid' => $_W['weid'], 'cid' => 0, 'name' => '分销专属二维码(系统维护)', 'module' => 'bj_qmxk', 'displayorder' => 0, 'status' => 1);
        pdo_insert('rule', $insert);
        $rid = pdo_insertid();
        $insert = array('weid' => $_W['weid'], 'rid' => $rid, 'module' => 'bj_qmxk', 'content' => '分销专属二维码', 'type' => 1, 'displayorder' => 0, 'status' => 1);
        pdo_insert('rule_keyword', $insert);
        message('设置成功,请进入自定义菜单绑定关键字\'分销专属二维码\'！', referer(), 'success');
    } else {
        if ($boolrule == true) {
            $rulekeywordcount = pdo_fetchall('SELECT rid FROM ' . tablename('rule_keyword') . ' WHERE weid=:weid and module=\'bj_qmxk\' and content=\'分销专属二维码\'', array(':weid' => $_W['weid']));
            foreach ($rulekeywordcount as $k => $v) {
                pdo_delete('rule', array('id' => $v['rid'], 'weid' => $_W['weid'], 'module' => 'bj_qmxk'));
            }
            pdo_delete('rule_keyword', array('module' => 'bj_qmxk', 'weid' => $_W['weid'], 'content' => '分销专属二维码'));
            message('系统已去除\'分销专属二维码\'关键字触发', referer(), 'success');
        }
    }
    $op = 'leaflet';
}
if ($op == 'delete') {
    pdo_update('bj_qmxk_channel', array('isdel' => 1, 'createtime' => time()), array('channel' => $_GPC['channel'], 'weid' => $_W['weid']));
    message('删除成功', referer(), 'success');
} else {
    if ($op == 'leaflet') {
        $mylist = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid and isdel=0', array(':weid' => $_W['weid']));
    } else {
        if ($op == 'active') {
            $channel = intval($_GPC['channel']);
            pdo_update('bj_qmxk_channel', array('active' => 0), array('weid' => $_W['weid']));
            pdo_update('bj_qmxk_channel', array('createtime' => time()), array('weid' => $_W['weid'], 'channel' => $item['channel']));
            pdo_update('bj_qmxk_channel', array('createtime' => time(), 'active' => 1), array('weid' => $_W['weid'], 'channel' => $channel));
            message('设定当前活跃传单成功', referer(), 'success');
        } else {
            if ($op == 'post') {
                $item = array();
                if (!empty($_GPC['channel'])) {
                    $item = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid AND channel=:channel', array(':weid' => $_W['weid'], ':channel' => $_GPC['channel']));
                }
                $item = $this->decode_channel_param($item, $item['bgparam']);
                if (checksubmit('submit')) {
                    if (strcasecmp('jpg', end(explode('.', $_GPC['bg']))) != 0) {
                        message('传单背景图必须是jpg格式。不支持png等其他格式。', referer(), 'error');
                    }
                    $bgparam = $this->encode_channel_param($_GPC);
                    $msgtype = empty($_GPC['msgtype']) ? 1 : $_GPC['msgtype'];
                    if (!empty($_GPC['channel'])) {
                        pdo_delete('bj_qmxk_qr', array('weid' => $_W['weid']));
                        pdo_update('bj_qmxk_channel', array('title' => $_GPC['title'], 'createtime' => time(), 'bg' => $_GPC['bg'], 'msgtype' => $msgtype, 'bgparam' => $bgparam, 'notice' => $_GPC['notice']), array('channel' => $_GPC['channel'], 'weid' => $_W['weid']));
                        pdo_update('bj_qmxk_qr', array('expiretime' => 1), array('channel' => $_GPC['channel']));
                        message('更新成功', referer(), 'success');
                    } else {
                        $list_count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid and isdel=0', array(':weid' => $_W['weid']));
                        $active = $list_count == 0;
                        pdo_insert('bj_qmxk_channel', array('title' => $_GPC['title'], 'createtime' => time(), 'notice' => $_GPC['notice'], 'msgtype' => $msgtype, 'bg' => $_GPC['bg'], 'bgparam' => $bgparam, 'active' => $active, 'isdel' => 0, 'weid' => $_W['weid']));
                        message('新建成功', $this->createWebUrl('spread', array('op' => 'leaflet')), 'success');
                    }
                }
            } else {
                if ($op == 'log') {
                    $pindex = max(1, intval($_GPC['page']));
                    $psize = 100;
                    $my_follows_sql = 'select a.createtime createtime, a.nickname, a.avatar, a.from_user,count(b.from_user) follower_count from ' . tablename('fans') . ' a left join  ' . tablename('bj_qmxk_share_history') . '  b on b.weid=a.weid and b.sharemid=(select x.id from ' . tablename('bj_qmxk_member') . ' x where x.weid=:weid and x.from_user=a.from_user  limit 1)  and b.from_user!=a.from_user  where a.from_user in(
select from_user from ' . tablename('fans') . '  where weid=:weid and follow=1 UNION (select from_user from ' . tablename('bj_qmxk_share_history') . ' where weid=:weid )
UNION (select m.from_user from ' . tablename('bj_qmxk_member') . ' m where m.weid = :weid)  )   group by a.from_user  ORDER BY follower_count DESC LIMIT ' . ($pindex - 1) * $psize . ",{$psize}";
                    $mylist = pdo_fetchall($my_follows_sql, array(':weid' => $_W['weid']));
                    if (!empty($mylist)) {
                        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('fans') . ' a WHERE a.weid=:weid ', array(':weid' => $_W['weid']));
                        $pager = pagination($total, $pindex, $psize);
                    }
                } else {
                    if ($op == 'user') {
                        $from_user = $_GPC['from_user'];
                        $fans = fans_search($from_user, array('nickname', 'createtime', 'credit1'));
                        $myheadimg = pdo_fetchcolumn('SELECT avatar FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
                        $fans['avatar'] = $myheadimg;
                        $mylist = pdo_fetchall('SELECT b.createtime createtime, nickname, avatar FROM ' . tablename('bj_qmxk_share_history') . ' a LEFT JOIN ' . tablename('fans') . ' b ON a.weid=b.weid and a.from_user = b.from_user WHERE a.sharemid = (select id from ' . tablename('bj_qmxk_member') . ' c where c.from_user=:leader and c.weid=:weid  limit 1) and a.from_user!=:leader AND a.weid=:weid  ', array(':leader' => $from_user, ':weid' => $_W['weid']));
                    } else {
                        message('error!', '', 'error');
                    }
                }
            }
        }
    }
}
include $this->template('spread');