<?php
$weid = $_W['weid'];
$settings = $this->module['config'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$msgtemplate = array();
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'gmsptz'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['gmsptz'] = $tmsgtemplate['template'];
    $msgtemplate['gmsptzenable'] = $tmsgtemplate['tenable'];
}
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtz'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['tjrtz'] = $tmsgtemplate['template'];
    $msgtemplate['tjrtzenable'] = $tmsgtemplate['tenable'];
}
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtzewm'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['tjrtzewm'] = $tmsgtemplate['template'];
    $msgtemplate['tjrtzewmenable'] = $tmsgtemplate['tenable'];
}
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtzdl'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['tjrtzdl'] = $tmsgtemplate['template'];
    $msgtemplate['tjrtzdlenable'] = $tmsgtemplate['tenable'];
}
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'xjdlshtz'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['xjdlshtz'] = $tmsgtemplate['template'];
    $msgtemplate['xjdlshtzenable'] = $tmsgtemplate['tenable'];
}
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'yjsqtz'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['yjsqtz'] = $tmsgtemplate['template'];
    $msgtemplate['yjsqtzenable'] = $tmsgtemplate['tenable'];
}
$tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'sjytktz'));
if (!empty($tmsgtemplate['id'])) {
    $msgtemplate['sjytktz'] = $tmsgtemplate['template'];
    $msgtemplate['sjytktzenable'] = $tmsgtemplate['tenable'];
}
if (checksubmit('submit') || checksubmit('submit2')) {
    if (!empty($_GPC['noticeemail'])) {
        $settings['noticeemail'] = $_GPC['noticeemail'];
    }
    if (!empty($_GPC['paymsgTemplateid'])) {
        $settings['paymsgTemplateid'] = $_GPC['paymsgTemplateid'];
    }
    if (pdo_fetchcolumn('SELECT mid FROM ' . tablename('wechats_modules') . ' WHERE mid = :mid AND weid = :weid', array(':mid' => $_W['modules']['bj_qmxk']['mid'], ':weid' => $_W['weid']))) {
        pdo_update('wechats_modules', array('settings' => iserializer($settings)), array('weid' => $_W['weid'], 'mid' => $_W['modules']['bj_qmxk']['mid'])) === 1;
    } else {
        pdo_insert('wechats_modules', array('settings' => iserializer($settings), 'mid' => $_W['modules']['bj_qmxk']['mid'], 'weid' => $_W['weid'], 'enabled' => 1)) === 1;
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'gmsptz'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'gmsptz', 'template' => $_GPC['gmsptz'], 'tenable' => intval($_GPC['gmsptzenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['gmsptz'], 'tenable' => intval($_GPC['gmsptzenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtz'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'tjrtz', 'template' => $_GPC['tjrtz'], 'tenable' => intval($_GPC['tjrtzenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['tjrtz'], 'tenable' => intval($_GPC['tjrtzenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtzewm'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'tjrtzewm', 'template' => $_GPC['tjrtzewm'], 'tenable' => intval($_GPC['tjrtzewmenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['tjrtzewm'], 'tenable' => intval($_GPC['tjrtzewmenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtzdl'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'tjrtzdl', 'template' => $_GPC['tjrtzdl'], 'tenable' => intval($_GPC['tjrtzdlenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['tjrtzdl'], 'tenable' => intval($_GPC['tjrtzdlenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'xjdlshtz'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'xjdlshtz', 'template' => $_GPC['xjdlshtz'], 'tenable' => intval($_GPC['xjdlshtzenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['xjdlshtz'], 'tenable' => intval($_GPC['xjdlshtzenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'yjsqtz'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'yjsqtz', 'template' => $_GPC['yjsqtz'], 'tenable' => intval($_GPC['yjsqtzenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['yjsqtz'], 'tenable' => intval($_GPC['yjsqtzenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'sjytktz'));
    if (empty($tmsgtemplate['id'])) {
        $datas = array('weid' => $_W['weid'], 'tkey' => 'sjytktz', 'template' => $_GPC['sjytktz'], 'tenable' => intval($_GPC['sjytktzenable']));
        pdo_insert('bj_qmxk_msg_template', $datas);
    } else {
        $datas = array('template' => $_GPC['sjytktz'], 'tenable' => intval($_GPC['sjytktzenable']));
        pdo_update('bj_qmxk_msg_template', $datas, array('id' => $tmsgtemplate['id']));
    }
    message('更新成功！', $this->createWebUrl('messagetmp'), 'success');
}
include $this->template('messagetmp');