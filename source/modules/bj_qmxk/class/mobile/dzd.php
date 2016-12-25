<?php
if (empty($profile['dzdtitle'])) {
    $profile['dzdtitle'] = '';
}
$operation = $_GPC['op'];
if (empty($operation)) {
    message('非法操作');
}
if ($operation == 'setting') {
    if (checksubmit('submit')) {
        if (empty($_GPC['mobile'])) {
            message('请输入手机号');
        }
        if (empty($_GPC['realname'])) {
            message('请输入真实姓名');
        }
        if (empty($_GPC['dzdtitle'])) {
            message('请输入店中店名称');
        }
        pdo_update('bj_qmxk_member', array('dzdsendtext' => $_GPC['dzdsendtext'], 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'dzdtitle' => $_GPC['dzdtitle'], 'dzdflag' => 1), array('id' => $profile['id']));
        message('店中店设置成功', $this->createMobileUrl('fansindex'), 'success');
    }
    include $this->template('dzd');
}