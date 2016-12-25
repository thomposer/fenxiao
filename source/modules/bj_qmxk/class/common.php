<?php
defined('IN_IA') or die('Access Denied');
require_once 'dev.php';
define('BAIJIA_COOKIE_QRCODE', 'qrcode_' . BJ_QMXK_VERSION);
define('BAIJIA_COOKIE_SID', 'sid_' . BJ_QMXK_VERSION);
define('BAIJIA_COOKIE_OPENID', 'oid_' . BJ_QMXK_VERSION);
define('BAIJIA_COOKIE_XOAUHURL', 'xaurl_' . BJ_QMXK_VERSION);
define('BAIJIA_AUTHKEY', 'bj_qmxkcco1905cmodule');
class bj_qmxkModuleCommon extends WeModuleSite
{
    public function __web($f_name)
    {
        global $_W, $_GPC;
        checklogin();
        //$this->doWebAuth();
        $this->checkfansfix();
        if (strtolower(substr($f_name, 5)) != 'spread') {
            $GLOBALS['handlestips'] = '';
        }
        include_once 'web/' . strtolower(substr($f_name, 5)) . '.php';
    }
    public function doMobilerefreshTicket()
    {
        global $_W;
        $update = array('jsapi_ticket_exptime' => 0);
        pdo_update('bj_qmxk_rules', $update, array('weid' => $_W['weid']));
    }
    public function doWebPrinter()
    {
        $this->__web(__FUNCTION__);
    }	
    public function doWebMessagetmp()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebStatistics()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebCategory()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebSetGoodsProperty()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $type = $_GPC['type'];
        $data = intval($_GPC['data']);
        empty($data) ? $data = 1 : ($data = 0);
        if (!in_array($type, array('new', 'hot', 'recommand', 'discount', 'status', 'sendfree'))) {
            die(json_encode(array('result' => 0)));
        }
        if ($_GPC['type'] == 'status') {
            pdo_update('bj_qmxk_goods', array($type => $data), array('id' => $id, 'weid' => $_W['weid']));
        } else {
            pdo_update('bj_qmxk_goods', array('is' . $type => $data), array('id' => $id, 'weid' => $_W['weid']));
        }
        die(json_encode(array('result' => 1, 'data' => $data)));
    }
    public function doWebGoods()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebOrder()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebOrdermy()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebNotice()
    {
        $this->__web(__FUNCTION__);
    }
    public function getCartTotal()
    {
        global $_W;
        $from_user = $this->getFromUser();
        $cartotal = pdo_fetchcolumn('select sum(total) from ' . tablename('bj_qmxk_cart') . " where weid = '{$_W['weid']}' and from_user='" . $from_user . '\'');
        return empty($cartotal) ? 0 : $cartotal;
    }
    public function getFeedbackType($type)
    {
        $types = array(1 => '维权', 2 => '告警');
        return $types[intval($type)];
    }
    public function getFeedbackStatus($status)
    {
        $statuses = array('未解决', '用户同意', '用户拒绝');
        return $statuses[intval($status)];
    }
    public function doWebPhbmedal()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebfansmanager()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebCommission()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebOutCommission()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebRules()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebSpread()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebExpress()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebDispatch()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebAdv()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebAward()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebCredit()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebZhifu()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebCharge()
    {
        $this->__web(__FUNCTION__);
    }
    public function setOrderStock($id = '', $minus = true)
    {
        $goods = pdo_fetchall('SELECT g.id, g.title, g.thumb, g.unit, g.marketprice,g.total as goodstotal,o.total,o.optionid,g.sales FROM ' . tablename('bj_qmxk_order_goods') . ' o left join ' . tablename('bj_qmxk_goods') . ' g on o.goodsid=g.id ' . " WHERE o.orderid='{$id}'");
        foreach ($goods as $item) {
            if ($minus) {
                if (!empty($item['optionid'])) {
                    pdo_query('update ' . tablename('bj_qmxk_goods_option') . ' set stock=stock-:stock where id=:id', array(':stock' => $item['total'], ':id' => $item['optionid']));
                }
                $data = array();
                if (!empty($item['goodstotal']) && $item['goodstotal'] != -1) {
                    $data['total'] = $item['goodstotal'] - $item['total'];
                }
                $data['sales'] = $item['sales'] + $item['total'];
                pdo_update('bj_qmxk_goods', $data, array('id' => $item['id']));
            } else {
                if (!empty($item['optionid'])) {
                    pdo_query('update ' . tablename('bj_qmxk_goods_option') . ' set stock=stock+:stock where id=:id', array(':stock' => $item['total'], ':id' => $item['optionid']));
                }
                $data = array();
                if (!empty($item['goodstotal']) && $item['goodstotal'] != -1) {
                    $data['total'] = $item['goodstotal'] + $item['total'];
                }
                $data['sales'] = $item['sales'] - $item['total'];
                pdo_update('bj_qmxk_goods', $data, array('id' => $item['id']));
            }
        }
    }
    public function sendgmsptz($ordersn, $orderprice, $agentname, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'gmsptz'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message1 = str_replace('{order_price}', $orderprice, $tmsgtemplate['template']);
            $message2 = str_replace('{order_sn}', $ordersn, $message1);
            $message3 = str_replace('{agent_name}', $agentname, $message2);
            $message = str_replace('{time}', $time, $message3);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function sendtjrtz($agentname, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtz'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message2 = str_replace('{agent_name}', $agentname, $tmsgtemplate['template']);
            $message = str_replace('{time}', $time, $message2);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function sendtjrtzewm($agentname, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtzewm'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message2 = str_replace('{agent_name}', $agentname, $tmsgtemplate['template']);
            $message = str_replace('{time}', $time, $message2);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function sendtjrtzdl($agentname, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'tjrtzdl'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message2 = str_replace('{agent_name}', $agentname, $tmsgtemplate['template']);
            $message = str_replace('{time}', $time, $message2);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function sendxjdlshtz($ordersn, $orderprice, $agentname, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'xjdlshtz'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message1 = str_replace('{order_price}', $orderprice, $tmsgtemplate['template']);
            $message2 = str_replace('{order_sn}', $ordersn, $message1);
            $message3 = str_replace('{agent_name}', $agentname, $message2);
            $message = str_replace('{time}', $time, $message3);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function sendyjsqtz($agent_money, $agentname, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'yjsqtz'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message1 = str_replace('{agent_money}', $agent_money, $tmsgtemplate['template']);
            $message2 = str_replace('{agent_name}', $agentname, $message1);
            $message = str_replace('{time}', $time, $message2);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function sendsjytktz($agent_money, $agent_level, $to_from_user)
    {
        global $_W;
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $_W['weid'], ':key' => 'sjytktz'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message1 = str_replace('{agent_money}', $agent_money, $tmsgtemplate['template']);
            $message2 = str_replace('{agent_level}', $agent_level, $message1);
            $message = str_replace('{time}', $time, $message2);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function doWebOption()
    {
        $tag = random(32);
        global $_GPC;
        include $this->template('option');
    }
    public function doWebSpec()
    {
        global $_GPC;
        $spec = array('id' => random(32), 'title' => $_GPC['title']);
        include $this->template('spec');
    }
    public function doWebSpecItem()
    {
        global $_GPC;
        $spec = array('id' => $_GPC['specid']);
        $specitem = array('id' => random(32), 'title' => $_GPC['title'], 'show' => 1);
        include $this->template('spec_item');
    }
    public function doWebParam()
    {
        $tag = random(32);
        global $_GPC;
        include $this->template('param');
    }
    public function getDzdname($profile)
    {
        global $_W;
        if ($_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']] == $profile['id']) {
            return '我的小店';
        }
        if (!empty($_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']])) {
            $users = $this->getProfileByID($_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']]);
            if (!empty($users['dzdtitle'])) {
                return $users['dzdtitle'];
            }
        }
        return $_W['account']['name'] . '商城';
    }
    public function getDzdid($dzduid = 0)
    {
        global $_W;
        if (!empty($dzduid)) {
            return $dzduid;
        }
        return $_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']];
    }
    public function isDzdMode($profile, $dzduid = 0)
    {
        global $_W;
        if (empty($profile['id'])) {
            $profile = $this->getProfile();
        }
        if (!empty($dzduid)) {
            if ($profile['id'] == $dzduid) {
                return true;
            }
            if ($dzduid == -1) {
                $theone = pdo_fetch('SELECT ischeck FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
                if ($profile['dzdflag'] == 1 && $profile['flag'] == 1 && $theone['ischeck'] == 2) {
                    return true;
                }
                return false;
            }
            if ($profile['id'] != $dzduid) {
                return false;
            }
        }
        if (!empty($_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']])) {
            if ($_COOKIE['dzdid_' . BJ_QMXK_VERSION . $_W['weid']] == $profile['id']) {
                return true;
            } else {
                return false;
            }
        }
        $theone = pdo_fetch('SELECT ischeck FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
        if ($profile['dzdflag'] == 1 && $profile['flag'] == 1 && $theone['ischeck'] == 2) {
            return true;
        }
        return false;
    }
    public function __mobile($f_name)
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $profile = $this->getProfile();
        $this->autofinishorder();
        $modulephp = strtolower(substr($f_name, 8));
        if (empty($profile['id'])) {
            $this->autoRegedit($modulephp);
            $profile = $this->getProfile();
        }
        $signPackage = $this->getSignPackage();
        include_once 'mobile/' . $modulephp . '.php';
    }
    public function doMobilePhb()
    {
        global $_W, $_GPC;
        $signPackage = $this->getSignPackage();
        $ranklist = pdo_fetchall('select bqsh.sharemid from ims_bj_qmxk_share_history bqsh left join ' . tablename('bj_qmxk_member') . ' member on   bqsh.sharemid=member.id  where  member.status=1 and bqsh.weid=:weid group by bqsh.sharemid having  count(bqsh.sharemid)  > 0 order by  count(bqsh.sharemid)  desc limit 30', array(':weid' => $_W['weid']));
        $str = '';
        foreach ($ranklist as &$citem) {
            $str = $str . $citem['sharemid'] . ',';
        }
        $str = $str . '-1';
        $list = pdo_fetchall('SELECT member.*,(select avatar from ' . tablename('fans') . ' fs where fs.from_user=member.from_user and avatar<>\'\' limit 1) avatar,(select count(his.sharemid) from ' . tablename('bj_qmxk_share_history') . ' his where his.sharemid=member.id) fanscount FROM ' . tablename('bj_qmxk_member') . ' member  WHERE member.weid = :weid and member.id in(' . $str . ') order by fanscount desc', array(':weid' => $_W['weid']));
        include $this->template('phb');
    }
    public function doMobileFansIndex()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doWebPromotion()
    {
        $this->__web(__FUNCTION__);
    }
    public function doMobileErwema()
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $signPackage = $this->getSignPackage();
        $profile = $this->getProfile();
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $weid = $_W['weid'];
            $id = $profile['id'];
        } else {
            $profile = $this->getProfileByID($id);
        }
        $this->memberQrcode($profile['from_user'], true);
        include $this->template('homeerwema');
    }
    public function doMobileDzd()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileRegister()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileCommission()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileBankcard()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileFansorder()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileRule()
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $weid = $_W['weid'];
        $op = $_GPC['op'] ? $_GPC['op'] : 'display';
        $rule = pdo_fetchcolumn('SELECT rule FROM ' . tablename('bj_qmxk_rules') . ' WHERE weid = :weid', array(':weid' => $_W['weid']));
        $id = pdo_fetchcolumn('SELECT id FROM ' . tablename('bj_qmxk_member') . ' WHERE weid = :weid AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        $signPackage = $this->getSignPackage();
        include $this->template('rule');
    }
    public function doMobilelist()
    {
        global $_GPC, $_W;
        $this->autofinishorder();
        include_once 'mobile/list.php';
    }
    public function doMobilelistmore_rec()
    {
        global $_GPC, $_W;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 6;
        $condition = ' and isrecommand=1 ';
        $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0 AND status = '1' {$condition} ORDER BY displayorder DESC, sales DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
        $signPackage = $this->getSignPackage();
        include $this->template('list_more');
    }
    public function doMobilelistmore()
    {
        global $_GPC, $_W;
        $signPackage = $this->getSignPackage();
        $pindex = max(1, intval($_GPC['page']));
        $psize = 6;
        $condition = '';
        if (!empty($_GPC['ccate'])) {
            $cid = intval($_GPC['ccate']);
            $condition .= " AND ccate = '{$cid}'";
            $_GPC['pcate'] = pdo_fetchcolumn('SELECT parentid FROM ' . tablename('bj_qmxk_category') . ' WHERE id = :id', array(':id' => intval($_GPC['ccate'])));
        } elseif (!empty($_GPC['pcate'])) {
            $cid = intval($_GPC['pcate']);
            $condition .= " AND pcate = '{$cid}'";
        }
        $list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}' AND status = '1' {$condition} ORDER BY displayorder DESC, sales DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
        include $this->template('list_more');
    }
    public function doMobilelist2()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileRechargecredit2()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobilelistCategory()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobiletuiguang()
    {
        global $_GPC, $_W;
        $carttotal = $this->getCartTotal();
        $share = BAIJIA_COOKIE_QRCODE . $_W['weid'];
        $gid = $_GPC['gid'];
        $from_user = $this->getFromUser();
        $goods = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_goods') . ' WHERE id = :id', array(':id' => $gid));
        $rule = pdo_fetchcolumn('SELECT rule FROM ' . tablename('bj_qmxk_rules') . ' WHERE weid = :weid', array(':weid' => $_W['weid']));
        $profile = $this->getProfile();
        $id = $profile['id'];
        $signPackage = $this->getSignPackage();
        $this->memberQrcode($from_user);
        if (intval($profile['id']) && $profile['status'] == 0) {
            include $this->template('forbidden');
            die;
        }
        if (empty($profile)) {
            $rule = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE `weid` = :weid ', array(':weid' => $_W['weid']));
            include $this->template('register');
            die;
        }
        $cfg = $this->module['config'];
        $logo = $cfg['logo'];
        $description = $cfg['description'];
        include $this->template('tgym');
    }
    public function doMobileMyfans()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileMyfansDetail()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileMyCart()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileConfirm()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function setOrderCredit($orderid, $weid, $add = true)
    {
        $order = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . ' WHERE id = :id limit 1', array(':id' => $orderid));
        if (empty($order['id'])) {
            return;
        }
        $ordergoods = pdo_fetchall('SELECT goodsid FROM ' . tablename('bj_qmxk_order_goods') . " WHERE orderid = '{$orderid}'", array(), 'goodsid');
        if (!empty($ordergoods)) {
            $goods = pdo_fetchall('SELECT id, title, thumb, marketprice, unit, total,credit FROM ' . tablename('bj_qmxk_goods') . ' WHERE id IN (\'' . implode('\',\'', array_keys($ordergoods)) . '\')');
        }
        if (!empty($goods)) {
            $credits = 0;
            foreach ($goods as $g) {
                $credits += $g['credit'];
            }
            $fans = pdo_fetch('SELECT credit1 FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $weid, ':from_user' => $order['from_user']));
            if (!empty($fans)) {
                if ($add) {
                    $new_credit = $credits + $fans['credit1'];
                    pdo_update('fans', array('credit1' => $new_credit), array('from_user' => $order['from_user'], 'weid' => $weid));
                } else {
                    $new_credit = $fans['credit1'] - $credits;
                    if ($new_credit <= 0) {
                        $new_credit = 0;
                    }
                    pdo_update('fans', array('credit1' => $new_credit), array('from_user' => $order['from_user'], 'weid' => $weid));
                }
            }
        }
    }
    public function doMobilePay()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileContactUs()
    {
        global $_W;
        $cfg = $this->module['config'];
        $signPackage = $this->getSignPackage();
        include $this->template('contactus');
    }
    public function doMobileMyOrder()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileDetail()
    {
        global $_W, $_GPC;
        include_once 'mobile/detail.php';
    }
    public function doMobileCheck()
    {
    }
    public function doMobileAddress()
    {
        $this->__mobile(__FUNCTION__);
    }
    public function doMobileAjaxdelete()
    {
        global $_GPC;
        $delurl = $_GPC['pic'];
        if (file_delete($delurl)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function doMobileAward()
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $award_list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_credit_award') . " WHERE weid = '{$_W['weid']}' and NOW() < deadline and amount > 0");
        $profile = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        $signPackage = $this->getSignPackage();
        include $this->template('credit_new');
    }
    public function doMobileFillInfo()
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $award_id = intval($_GPC['award_id']);
        $profile = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        $signPackage = $this->getSignPackage();
        $award_info = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_credit_award') . " WHERE award_id = {$award_id} AND weid = '{$_W['weid']}'");
        include $this->template('credit_fillinfo_new');
    }
    public function doMobileCredit()
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $signPackage = $this->getSignPackage();
        $award_id = intval($_GPC['award_id']);
        if (!empty($_GPC['award_id'])) {
            $fans = pdo_fetch('SELECT credit1 FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
            $award_info = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_credit_award') . " WHERE award_id = {$award_id} AND weid = '{$_W['weid']}'");
            if ($fans['credit1'] >= $award_info['credit_cost'] && $award_info['amount'] > 0) {
                $data = array('amount' => $award_info['amount'] - 1);
                pdo_update('bj_qmxk_credit_award', $data, array('weid' => $_W['weid'], 'award_id' => $award_id));
                $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'award_id' => $award_id, 'createtime' => TIMESTAMP);
                pdo_insert('bj_qmxk_credit_request', $data);
                $data = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'credit1' => $fans['credit1'] - $award_info['credit_cost'], 'residedist' => $_GPC['residedist']);
                pdo_update('fans', $data, array('from_user' => $from_user, 'weid' => $_W['weid']));
                message('积分兑换成功！', create_url('mobile/module/mycredit', array('weid' => $_W['weid'], 'name' => 'bj_qmxk', 'do' => 'mycredit', 'op' => 'display')), 'success');
            } else {
                message('积分不足或商品已经兑空，请重新选择商品！<br>当前商品所需积分:' . $award_info['credit_cost'] . '<br>您的积分:' . $fans['credit1'] . '. 商品剩余数量:' . $award_info['amount'] . '<br><br>小提示：<br>每日签到，在线订票，宾馆预订可以赚取积分', create_url('mobile/module/award', array('weid' => $_W['weid'], 'name' => 'bj_qmxk')), 'error');
            }
        } else {
            message('请选择要兑换的商品！', create_url('mobile/module/award', array('weid' => $_W['weid'], 'name' => 'bj_qmxk')), 'error');
        }
    }
    public function doMobileSearch()
    {
        global $_GPC, $_W;
        $keyword = $_GPC['keyword'];
        $url = $this->createMobileUrl('list2', array('name' => 'bj_qmxk', 'weid' => $_W['weid'], 'keyword' => $keyword, 'sort' => 1));
        header("location:{$url}");
        die;
    }
    public function doMobileMycredit()
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $signPackage = $this->getSignPackage();
        $award_list = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_credit_award') . ' as t1,' . tablename('bj_qmxk_credit_request') . 'as t2 WHERE t1.award_id=t2.award_id AND from_user=\'' . $from_user . "' AND t1.weid = '{$_W['weid']}' ORDER BY t2.createtime DESC");
        $profile = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        $user = $this->getProfile();
        include $this->template('credit_mycredit_new');
    }
    public function doMobileZhifu()
    {
        global $_GPC, $_W;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 30;
        $weid = $_W['weid'];
        $from_user = $this->getFromUser();
        $cfg = $this->module['config'];
        $zhifucommission = $cfg['zhifuCommission'];
        $signPackage = $this->getSignPackage();
        $profile = $this->getProfile();
        $id = $profile['id'];
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('paylog') . ' WHERE  openid=\'' . $from_user . '\' AND type=\'zhifu\' AND `weid` = ' . $_W['weid']);
        $pager = pagination($total, $pindex, $psize);
        $list = pdo_fetchall('SELECT * FROM ' . tablename('paylog') . ' WHERE openid=\'' . $from_user . '\' AND type=\'zhifu\' AND weid=' . $_W['weid'] . ' ORDER BY plid DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
        $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        $id = $profile['id'];
        include $this->template('dakuan');
    }
    public function autofinishorder($needcheck = false)
    {
        global $_W;
        if (empty($_COOKIE['orderchk_' . BJ_QMXK_VERSION . $_W['weid']]) || $needcheck == true) {
            $settings = $this->module['config'];
            $autofinish = intval($settings['autofinish']);
            if (!empty($autofinish)) {
                $rules = pdo_fetch('SELECT autofinishcktime FROM ' . tablename('bj_qmxk_rules') . ' WHERE weid = :weid', array(':weid' => $_W['weid']));
                if (empty($rules['autofinishcktime']) || intval($rules['autofinishcktime']) <= TIMESTAMP) {
                    $autofinishtime = time() - intval($settings['autofinish']) * 24 * 60 * 60;
                    pdo_query('update ' . tablename('bj_qmxk_order') . ' set status=3, updatetime=:updatetime where status=2 and sendtime>0 and sendtime<:sendtime and  weid = :weid', array(':weid' => $_W['weid'], ':sendtime' => $autofinishtime, ':updatetime' => TIMESTAMP));
                }
                pdo_update('bj_qmxk_rules', array('autofinishcktime' => TIMESTAMP + 30 * 60), array('weid' => $_W['weid']));
            }
            if ($needcheck == false) {
                setcookie('orderchk_' . BJ_QMXK_VERSION . $_W['weid'], 1, TIMESTAMP + 20 * 60);
            }
        }
    }
}