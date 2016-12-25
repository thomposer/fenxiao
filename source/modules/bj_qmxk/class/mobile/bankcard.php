<?php
$weid = $_W['weid'];
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$rule = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rule') . ' WHERE `weid` = :weid ', array(':weid' => $_W['weid']));
if (empty($from_user)) {
    message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
    die;
}
$id = $profile['id'];
if (empty($profile['id'])) {
    include $this->template('forbidden');
    die;
}
if (empty($profile)) {
    message('请先注册', $this->createMobileUrl('register'), 'error');
    die;
}
if ($op == 'edit') {
    $data = array('bankcard' => $_GPC['bankcard'], 'banktype' => $_GPC['banktype'], 'alipay' => $_GPC['alipay'], 'wxhao' => $_GPC['wxhao']);
    if (!empty($data['bankcard']) && !empty($data['banktype'])) {
        pdo_update('bj_qmxk_member', $data, array('from_user' => $from_user));
        if ($_GPC['opp'] == 'complated') {
            echo 3;
            die;
        }
        echo 1;
    } else {
        echo 0;
    }
    die;
}
include $this->template('bankcard');