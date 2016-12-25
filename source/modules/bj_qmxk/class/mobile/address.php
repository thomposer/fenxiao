<?php
$from = $_GPC['from'];
$returnurl = urldecode($_GPC['returnurl']);
$operation = $_GPC['op'];
if ($operation == 'post') {
    $id = intval($_GPC['id']);
    $data = array('weid' => $_W['weid'], 'openid' => $from_user, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'province' => $_GPC['province'], 'city' => $_GPC['city'], 'area' => $_GPC['area'], 'address' => $_GPC['address']);
    if (empty($_GPC['realname']) || empty($_GPC['mobile']) || empty($_GPC['address'])) {
        message('请输完善您的资料！');
    }
    if (!empty($id)) {
        unset($data['weid']);
        unset($data['openid']);
        pdo_update('bj_qmxk_address', $data, array('id' => $id));
        message($id, '', 'ajax');
    } else {
        pdo_update('bj_qmxk_address', array('isdefault' => 0), array('weid' => $_W['weid'], 'openid' => $from_user));
        $data['isdefault'] = 1;
        pdo_insert('bj_qmxk_address', $data);
        $id = pdo_insertid();
        $profile = pdo_fetch('SELECT realname,mobile FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        if (empty($profile['realname']) || empty($profile['mobile'])) {
            pdo_update('fans', array('mobile' => $_GPC['mobile']), array('from_user' => $from_user, 'weid' => $_W['weid']));
        }
        if (!empty($id)) {
            message($id, '', 'ajax');
        } else {
            message(0, '', 'ajax');
        }
    }
} elseif ($operation == 'default') {
    $id = intval($_GPC['id']);
    pdo_update('bj_qmxk_address', array('isdefault' => 0), array('weid' => $_W['weid'], 'openid' => $from_user));
    pdo_update('bj_qmxk_address', array('isdefault' => 1), array('id' => $id));
    message(1, '', 'ajax');
} elseif ($operation == 'detail') {
    $id = intval($_GPC['id']);
    $row = pdo_fetch('SELECT id, realname, mobile, province, city, area, address FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => $id));
    message($row, '', 'ajax');
} elseif ($operation == 'remove') {
    $id = intval($_GPC['id']);
    if (!empty($id)) {
        $address = pdo_fetch('select isdefault from ' . tablename('bj_qmxk_address') . " where id='{$id}' and weid='{$_W['weid']}' and openid='" . $from_user . '\' limit 1 ');
        if (!empty($address)) {
            pdo_update('bj_qmxk_address', array('deleted' => 1, 'isdefault' => 0), array('id' => $id, 'weid' => $_W['weid'], 'openid' => $from_user));
            if ($address['isdefault'] == 1) {
                $maxid = pdo_fetchcolumn('select max(id) as maxid from ' . tablename('bj_qmxk_address') . " where weid='{$_W['weid']}' and openid='" . $from_user . '\' limit 1 ');
                if (!empty($maxid)) {
                    pdo_update('bj_qmxk_address', array('isdefault' => 1), array('id' => $maxid, 'weid' => $_W['weid'], 'openid' => $from_user));
                    die(json_encode(array('result' => 1, 'maxid' => $maxid)));
                }
            }
        }
    }
    die(json_encode(array('result' => 1, 'maxid' => 0)));
} else {
    $profile = pdo_fetch('SELECT resideprovince,residecity,residedist,address,realname,mobile FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    $address = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE deleted=0 and openid = :openid', array(':openid' => $from_user));
    if (empty($address) || count($address) == 0) {
        if (BAIJIA_DEVELOPMENT == false) {
            $useAddApi = true;
            if (!isset($_GPC['code'])) {
                $this->getUserTokenForAddr();
            }
            if (isset($_GPC['code']) && $_GPC['code'] != 'authdeny') {
                $state = $_GPC['state'];
                $code = $_GPC['code'];
                $addressSignInfo = $this->getAddressSignInfo($code, 'http://' . $_SERVER[HTTP_HOST] . '' . $_SERVER['REQUEST_URI'], $signPackage);
            }
        }
    }
    $carttotal = $this->getCartTotal();
    include $this->template('address');
}