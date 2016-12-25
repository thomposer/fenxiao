<?php
$weid = $_W['weid'];
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$id = $profile['id'];
if ($op == 'display') {
    $opp = $_GPC['opp'];
    $rule = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE `weid` = :weid ', array(':weid' => $_W['weid']));
    $fans = pdo_fetch('SELECT realname FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    if (empty($profile['realname'])) {
        $profile['realname'] = $fans['realname'];
    }
    $cfg = $this->module['config'];
    $ydyy = $cfg['ydyy'];
    include $this->template('register');
    die;
}
$myfansx = pdo_fetch('SELECT nickname FROM ' . tablename('fans') . ' WHERE `weid` = :weid AND from_user=:from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
if (empty($myfansx['nickname']) && !empty($_GPC['realname'])) {
    pdo_update('fans', array('nickname' => $_GPC['realname']), array('id' => $myfansx['id']));
}
if (!empty($profile['id'])) {
    if (empty($_GPC['bankcard']) || empty($_GPC['banktype'])) {
        echo -1;
        die;
    }
    $data = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'pwd' => $_GPC['password'], 'bankcard' => $_GPC['bankcard'], 'banktype' => $_GPC['banktype'], 'alipay' => $_GPC['alipay'], 'wxhao' => $_GPC['wxhao']);
    pdo_update('bj_qmxk_member', $data, array('id' => $profile['id']));
    echo 2;
    die;
}
if ($op == 'add') {
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
    $theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
    if ($theone['promotertimes'] == 1) {
        $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'pwd' => $_GPC['password'], 'alipay' => $_GPC['alipay'], 'wxhao' => $_GPC['wxhao'], 'commission' => 0, 'createtime' => TIMESTAMP, 'flagtime' => TIMESTAMP, 'shareid' => $seid, 'status' => 1, 'flag' => 1);
    } else {
        $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'pwd' => $_GPC['password'], 'alipay' => $_GPC['alipay'], 'wxhao' => $_GPC['wxhao'], 'commission' => 0, 'createtime' => TIMESTAMP, 'flagtime' => 0, 'shareid' => $seid, 'status' => 1, 'flag' => 0);
    }
    if ($data['from_user'] == $profile['from_user']) {
        pdo_update('bj_qmxk_member', $data, array('id' => $profile['id']));
    } else {
        pdo_insert('bj_qmxk_member', $data);
    }
    if ($seid > 0) {
        $sharemember = pdo_fetch('SELECT from_user,id FROM ' . tablename('bj_qmxk_member') . ' WHERE `weid` = :weid AND id=:id ', array(':weid' => $_W['weid'], ':id' => $seid));
        $joinfans = pdo_fetch('SELECT from_user,nickname FROM ' . tablename('fans') . ' WHERE `weid` = :weid AND from_user=:from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        if (!empty($sharemember) && !empty($sharemember['id']) && !empty($joinfans['nickname']) && $theone['promotertimes'] == 1) {
            $this->sendtjrtzdl($joinfans['nickname'], $sharemember['from_user']);
        }
    }
    $theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
    echo 1;
    die;
}