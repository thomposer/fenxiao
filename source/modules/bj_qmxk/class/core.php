<?php
defined('IN_IA') or die('Access Denied');
define('BAIJIA_DEVELOPMENT', false);
require_once 'common.php';
$_QMXK = array();
class bj_qmxkModuleCore extends bj_qmxkModuleCommon
{
    public function doWebAuth()
    {
        if (BAIJIA_DEVELOPMENT == true) {
            $this->autofinishorder(true);
            return true;
        }
        global $_W, $_GPC;
        $authortxt = ' 请联系作者重新授权';
        $modulename = 'bj_qmxkSP4';
        $key = BAIJIA_AUTHKEY;
        $sendapi = 'http://www.baijiaweixin.cn/';
        $do = $_GPC['do'];
        $authorinfo = $authortxt;
        $updateurl = create_url('site/module/' . $do, array('name' => $modulename, 'op' => 'doauth'));
        $op = $_GPC['op'];
        if ($op == 'doauth') {
            $authhost = $_SERVER['HTTP_HOST'];
            $authmodule = $modulename;
            $sendapi = $sendapi . '/authcode.php?act=authcode&authhost=' . $authhost . '&authmodule=' . $authmodule;
            $response = ihttp_request($sendapi, json_encode($send));
            if (!$response) {
                echo $authortxt;
                die;
            }
            $response = json_decode($response['content'], true);
            if ($response['errcode']) {
                echo $response['errmsg'] . $authorinfo;
                die;
            }
            if (!empty($response['content'])) {
                $data = array('url' => $response['content']);
                pdo_update('modules', $data, array('name' => 'bj_qmxk'));
                message('更新授权成功', referer(), 'success');
            }
        }
        $module = pdo_fetch('SELECT mid, name,url FROM ' . tablename('modules') . ' WHERE name = :name', array(':name' => 'bj_qmxk'));
        $bj_qmxk_module = pdo_fetch('SELECT * FROM ' . tablename('modules') . ' where name=\'bj_qmxk\'');
        $settingurl = create_url('member/module/setting', array('mid' => $bj_qmxk_module['mid']));
        if ($module == false) {
            message('参数错误!' . $authorinfo, '', 'error');
        }
        if (empty($module['url'])) {
            message('验证信息为空!' . $authorinfo, $settingurl, 'error');
        }
        $ident_arr = authcode(base64_decode($module['url']), 'DECODE', $key);
        if (!$ident_arr) {
            message('验证参数出错!' . $authorinfo, '', 'error');
        }
        $ident_arr = explode('#', $ident_arr);
        if ($ident_arr[0] != $modulename) {
            message('验证参数出错!' . $authorinfo, '', 'error');
        }
        if ($ident_arr[1] != $_SERVER['HTTP_HOST']) {
            message('服务器域名不符合,请重新授权!' . $authorinfo, '', 'error');
        }
        $this->autofinishorder(true);
    }
    public function checkfansfix()
    {
    }
    public function doMobileOpenBridge()
    {
        global $_GPC;
        if (!empty($_GPC['openbridge'])) {
            file_put_contents(IA_ROOT . BJ_QMXK_BASE . '/bridge.json', intval($_GPC['openbridge']));
        }
    }
    public function changeWechatSend($id, $status, $msg = '')
    {
        global $_W;
        $paylog = pdo_fetch('SELECT plid, openid, tag FROM ' . tablename('paylog') . " WHERE tid = '{$id}' AND status = 1 AND type = 'wechat'");
        if (!empty($paylog['openid'])) {
            $paylog['tag'] = iunserializer($paylog['tag']);
            $send = array('appid' => $_W['account']['payment']['wechat']['appid'], 'openid' => $paylog['openid'], 'transid' => $paylog['tag']['transaction_id'], 'out_trade_no' => $paylog['plid'], 'deliver_timestamp' => TIMESTAMP, 'deliver_status' => $status, 'deliver_msg' => $msg);
            $sign = $send;
            if ($_W['account']['payment']['wechat']['version'] == '2') {
                return true;
            }
            $sign['appkey'] = $_W['account']['payment']['wechat']['signkey'];
            ksort($sign);
            foreach ($sign as $key => $v) {
                $key = strtolower($key);
                $string .= "{$key}={$v}&";
            }
            $send['app_signature'] = sha1(rtrim($string, '&'));
            $send['sign_method'] = 'sha1';
            $token = $this->get_weixin_token();
            $sendapi = 'https://api.weixin.qq.com/pay/delivernotify?access_token=' . $token;
            $response = ihttp_request($sendapi, json_encode($send));
            $response = json_decode($response['content'], true);
            if (empty($response)) {
                message('发货失败，请检查您的公众号权限或是公众号AppId和公众号AppSecret！');
            }
            if (!empty($response['errcode'])) {
                message($response['errmsg']);
            }
        }
    }
    public function getKFcode()
    {
        $cfg = $this->module['config'];
        return !empty($cfg['kfcode']) ? htmlspecialchars_decode($cfg['kfcode']) : '';
    }
    public function payResult($params)
    {
        $fee = intval($params['fee']);
        $index = strpos($params['tid'], 'r');
        if (empty($index)) {
            $payorder = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE id = '{$params['tid']}'");
            $data = array('status' => $params['result'] == 'success' ? 1 : 0);
            if ($params['type'] == 'wechat') {
                $data['transid'] = $params['tag']['transaction_id'];
            }
            pdo_update('bj_qmxk_order', $data, array('id' => $params['tid']));
            if ($payorder['status'] == 1) {
                if ($params['from'] == 'return') {
                    $order = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_order') . " WHERE id = '{$params['tid']}'");
                    if (!empty($this->module['config']['noticeemail'])) {
                        $ordergoods = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_order_goods') . " WHERE orderid = '{$params['tid']}'", array(), 'goodsid');
                        $goods = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . ' WHERE id IN (\'' . implode('\',\'', array_keys($ordergoods)) . '\')');
                        $address = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => $order['addressid']));
                        $body = '<h3>购买商品清单</h3> <br />';
                        if (!empty($goods)) {
                            foreach ($goods as $row) {
                                $body .= "名称：{$row['title']} ，数量：{$ordergoods[$row['id']]['total']} <br />";
                            }
                        }
                        $body .= "<br />总金额：{$order['price']}元 （已付款）<br />";
                        $body .= '<h3>购买用户详情</h3> <br />';
                        $body .= "真实姓名：{$address['realname']} <br />";
                        $body .= "地区：{$address['province']} - {$address['city']} - {$address['area']}<br />";
                        $body .= "详细地址：{$address['address']} <br />";
                        $body .= "手机：{$address['mobile']} <br />";
                        ihttp_email($this->module['config']['noticeemail'], '微商城订单提醒', $body);
                    }
                    $tagent = $this->getMember($this->getShareId());
                    $profile = $this->getProfile();
                    $this->sendgmsptz($order['ordersn'], $order['price'], $profile['realname'], $tagent['from_user']);
                    $this->sendMobilePayMsg($order, $goods, '在线付款', $ordergoods);
                    if ($params['type'] == 'credit2') {
                        message('支付成功！', $this->createMobileUrl('myorder'), 'success');
                    } else {
                        message('支付成功！', '../../' . $this->createMobileUrl('myorder'), 'success');
                    }
                }
            }
        }
        if ($index >= 1) {
            $tid = $params['tid'];
            $credit_order = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_credit_order') . " WHERE crid = '{$tid}'");
            $data = array('status' => $params['result'] == 'success' ? 1 : 0);
            if ($params['type'] == 'wechat') {
                $data['transid'] = $params['tag']['transaction_id'];
            }
            if ($credit_order['status'] == 0 && $params['result'] == 'success') {
                pdo_update('bj_qmxk_credit_order', $data, array('crid' => $credit_order['crid']));
                $this->setMemberCredit2($credit_order['openid'], $credit_order['fee'], 'addgold', '余额在线充值');
            }
            if ($credit_order['status'] == 1) {
                if ($params['from'] == 'return') {
                    message('余额充值成功！', '../../' . $this->createMobileUrl('fansindex'), 'success');
                }
            }
        }
    }
    public function getShareId($from_user = '', $level = 1)
    {
        global $_W, $_GPC;
        if (empty($from_user)) {
            $from_user = $this->getFromUser();
        }
        $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        if (empty($profile['shareid'])) {
            return 0;
        } else {
            if ($level == 1) {
                return $profile['shareid'];
            }
            if ($level == 2 || $level == 3) {
                $profile2 = pdo_fetch('SELECT shareid FROM ' . tablename('bj_qmxk_member') . ' WHERE  id=:sid', array(':sid' => $profile['shareid']));
                if (empty($profile2['shareid'])) {
                    return 0;
                }
                if ($level == 2) {
                    return $profile2['shareid'];
                }
            }
            if ($level == 3) {
                $profile3 = pdo_fetch('SELECT shareid FROM ' . tablename('bj_qmxk_member') . ' WHERE  id=:sid', array(':sid' => $profile2['shareid']));
                if (empty($profile3['shareid'])) {
                    return 0;
                }
                return $profile3['shareid'];
            }
            return 0;
        }
    }
    public function time_tran($the_time)
    {
        $timediff = $the_time - time();
        $days = intval($timediff / 86400);
        if (strlen($days) <= 1) {
            $days = '0' . $days;
        }
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);
        if (strlen($hours) <= 1) {
            $hours = '0' . $hours;
        }
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        if (strlen($mins) <= 1) {
            $mins = '0' . $mins;
        }
        $secs = $remain % 60;
        if (strlen($secs) <= 1) {
            $secs = '0' . $secs;
        }
        $ret = '';
        if ($days > 0) {
            $ret .= $days . ' 天 ';
        }
        if ($hours > 0) {
            $ret .= $hours . ':';
        }
        if ($mins > 0) {
            $ret .= $mins . ':';
        }
        $ret .= $secs;
        return array('倒计时 ' . $ret, $timediff);
    }
    public function bjpay($params = array(), $paytype)
    {
        global $_W;
        if ($params['fee'] <= 0) {
            message('支付错误, 金额小于0', $this->createMobileUrl('fansindex'), 'error');
        }
        $params['module'] = $this->module['name'];
        $sql = 'SELECT * FROM ' . tablename('paylog') . ' WHERE `weid`=:weid AND `module`=:module AND `tid`=:tid';
        $pars = array();
        $pars[':weid'] = $_W['weid'];
        $pars[':module'] = $params['module'];
        $pars[':tid'] = $pars['tid'];
        $log = pdo_fetch($sql, $pars);
        if (!empty($log) && $log['status'] == '1') {
            message('这个订单已经支付成功, 不需要重复支付.', $this->createMobileUrl('fansindex'), 'error');
        }
        include $this->template('bjpay');
    }
    public function shareClick($mid, $joinway = 0)
    {
        global $_W, $_GPC;
        if (empty($joinway)) {
            $joinway = 0;
        }
        $fromuser = $this->getFromUser();
        $share = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_share_history') . ' WHERE from_user=:from_user and weid=:weid', array(':from_user' => $fromuser, ':weid' => $_W['weid']));
        $member = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . " WHERE weid = '{$_W['weid']}' AND id = '{$mid}'");
        $users = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . " WHERE weid = '{$_W['weid']}' AND from_user = '{$fromuser}' limit 1");
        $theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
        if (empty($share['sharemid']) && !empty($mid) && empty($users['id'])) {
            if (!empty($member['id']) && $member['status'] == 1) {
                pdo_update('bj_qmxk_member', array('clickcount' => $member['clickcount'] + 1), array('id' => $mid));
                if (!empty($theone['clickcredit'])) {
                    $fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid and from_user=:from_user', array(':weid' => $_W['weid'], ':from_user' => $member['from_user']));
                    if (!empty($fans)) {
                        pdo_update('fans', array('credit1' => $fans['credit1'] + $theone['clickcredit']), array('id' => $fans['id'], 'weid' => $_W['weid']));
                    }
                }
                if ($member['flag'] == 1) {
                    $data = array('weid' => $_W['weid'], 'from_user' => $fromuser, 'sharemid' => $mid, 'joinway' => $joinway);
                    pdo_insert('bj_qmxk_share_history', $data);
                    $joinfans = pdo_fetch('SELECT from_user,nickname FROM ' . tablename('fans') . ' WHERE `weid` = :weid AND from_user=:from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $fromuser));
                    $clickNickname = '';
                    if (!empty($joinfans['nickname'])) {
                        $clickNickname = $joinfans['nickname'];
                    }
                    if ($joinway == 0) {
                        $this->sendtjrtz($clickNickname, $member['from_user']);
                    } else {
                        $this->sendtjrtzewm($clickNickname, $member['from_user']);
                    }
                }
            }
        }
    }
    public function sendMobilePayMsg($order, $goods, $paytype, $ordergoods)
    {
        global $_W;
        $address = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_address') . ' WHERE id = :id', array(':id' => $order['addressid']));
        $cfg = $this->module['config'];
        $template_id = $cfg['paymsgTemplateid'];
        if (empty($template_id)) {
            if (BAIJIA_AGENT_ALL == true) {
                $template_id = BAIJIA_TEMPLATESID;
            }
        }
        if (!empty($template_id)) {
            include IA_ROOT . BJ_QMXK_BASE . '/messagetemplate/pay.php';
            $this->sendtempmsg($template_id, 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->createMobileUrl('myorder', array('orderid' => $order['id'], 'op' => 'detail')), $data, '#FF0000');
        }
    }
    public function doWebFixfans()
    {
        global $_W, $_GPC;
        $fanslist = pdo_fetchall('SELECT * FROM ' . tablename('fans') . ' WHERE  weid=:weid and nickname=\'\' and realname=\'\'', array(':weid' => $_W['weid']));
        $access_token = $this->get_weixin_token();
        foreach ($fanslist as &$fans) {
            $oauth2_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $fans['from_user'] . '&lang=zh_CN';
            $content = ihttp_get($oauth2_url);
            $info = @json_decode($content['content'], true);
            if (!empty($info['nickname'])) {
                $row = array('nickname' => $info['nickname'], 'realname' => $info['nickname'], 'gender' => $info['sex'], 'avatar' => $info['headimgurl']);
                pdo_update('fans', $row, array('id' => $fans['id']));
            }
        }
        message('检修完成', referer(), 'success');
    }
    public function checkisAgent($from_user, $profile)
    {
        global $_W, $_GPC;
        $flag = $profile['flag'];
		$settings = $this->module['config'];
		$minmoney = $settings['minmoney'];
		$orderstatus = $settings['orderstatus'];
        if (!empty($profile['id']) && $profile['flag'] == 0) {
			if ($orderstatus == 1) {
				$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_order') . ' WHERE (status= \'1\' or status= \'2\') AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
				$totalmoney = pdo_fetchcolumn('SELECT sum(price) FROM ' . tablename('bj_qmxk_order') . ' WHERE (status= \'1\' or status= \'2\') AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
				$maxmoney = pdo_fetchcolumn('SELECT max(price) as maxmoney FROM ' . tablename('bj_qmxk_order') . ' WHERE (status= \'1\' or status= \'2\') AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
				$commtime = pdo_fetch('select promotercount,promotermoney,promotertimes from ' . tablename('bj_qmxk_rules') . ' where weid = ' . $_W['weid']);
				$lastorder = pdo_fetch('SELECT createtime FROM ' . tablename('bj_qmxk_order') . ' WHERE (status= \'1\' or status= \'2\') AND  weid = :weid  AND from_user = :from_user order by createtime desc limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));				
			} else {
				$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('bj_qmxk_order') . ' WHERE status= \'3\' AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
				$totalmoney = pdo_fetchcolumn('SELECT sum(price) FROM ' . tablename('bj_qmxk_order') . ' WHERE status= \'3\' AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
				$maxmoney = pdo_fetchcolumn('SELECT max(price) as maxmoney FROM ' . tablename('bj_qmxk_order') . ' WHERE status= \'3\' AND  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
				$commtime = pdo_fetch('select promotercount,promotermoney,promotertimes from ' . tablename('bj_qmxk_rules') . ' where weid = ' . $_W['weid']);
				$lastorder = pdo_fetch('SELECT createtime FROM ' . tablename('bj_qmxk_order') . ' WHERE status= \'3\' AND  weid = :weid  AND from_user = :from_user order by createtime desc limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));				
			}

            $toagent = 0;
			
            if ($total >= 1 && $commtime['promotertimes'] == 0) {
				if ($minmoney > 0) {
					if ($maxmoney >= $minmoney) {
						$toagent = 1;
					}
				} else {
					$toagent = 1;
				}
            }
            if ($commtime['promotercount'] <= $total && $commtime['promotertimes'] == 2) {
                $toagent = 1;
            }
            if ($commtime['promotermoney'] <= $totalmoney && $commtime['promotertimes'] == 3) {
                $toagent = 1;
            }
            if ($commtime['promotertimes'] == 1) {
                $toagent = 1;
            }
            if ($toagent == 1) {
                $flagtime = $lastorder['createtime'];
                if (empty($flagtime)) {
                    $flagtime = TIMESTAMP;
                }
                pdo_update('bj_qmxk_member', array('flagtime' => $flagtime, 'flag' => 1), array('id' => $profile['id']));
                $flag = 1;
                $sharemember = pdo_fetch('SELECT from_user,id,realname FROM ' . tablename('bj_qmxk_member') . ' WHERE `weid` = :weid AND id=:id ', array(':weid' => $_W['weid'], ':id' => $profile['shareid']));
                if (!empty($sharemember) && !empty($sharemember['id'])) {
                    if (!empty($sharemember['realname'])) {
                        $realname = $sharemember['realname'];
                    } else {
                        $realname = '用户';
                    }
                    $this->sendtjrtzdl($realname, $sharemember['from_user']);
                }
            }
        }
        return $flag;
    }
    public function getMid()
    {
        global $_W, $_GPC;
        if (empty($_COOKIE['mid_' . BJ_QMXK_VERSION . $_W['weid']])) {
            $profile = $this->getProfile();
            setcookie('mid_' . BJ_QMXK_VERSION . $_W['weid'], $profile['id'], time() + 3600);
            return $profile['id'];
        } else {
            return $_COOKIE['mid_' . BJ_QMXK_VERSION . $_W['weid']];
        }
    }
    public function getMember($mid)
    {
        global $_W, $_GPC;
        $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND id = :id', array(':weid' => $_W['weid'], ':id' => $mid));
        return $profile;
    }
    public function getFans($from_user)
    {
        global $_W, $_GPC;
        $fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        return $fans;
    }
    public function getProfileByID($id)
    {
        global $_W, $_GPC;
        $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND id = :id', array(':weid' => $_W['weid'], ':id' => $id));
        return $profile;
    }
    function setMemberCredit2($from_user = '', $fee, $type, $remark)
    {
        global $_W;
        $member = $this->getProfile($from_user);
        if (!empty($member['id'])) {
            if (empty($member['credit2'])) {
                $member['credit2'] = 0;
            }
            if (!is_numeric($fee) || $fee < 0) {
                message('输入数字非法，请重新输入');
            }
            if ($type == 'addgold') {
                $data = array('credit2' => $member['credit2'] + $fee, 'tag' => $remark, 'type' => $type, 'fee' => $fee, 'createtime' => TIMESTAMP, 'openid' => $member['from_user'], 'mid' => $member['id'], 'weid' => $_W['weid']);
                pdo_insert('bj_qmxk_paylog', $data);
                pdo_update('bj_qmxk_member', array('credit2' => $member['credit2'] + $fee), array('id' => $member['id']));
                return true;
            }
            if ($type == 'usegold') {
                if ($member['credit2'] >= $fee) {
                    $data = array('credit2' => $member['credit2'] - $fee, 'tag' => $remark, 'type' => $type, 'fee' => $fee, 'createtime' => TIMESTAMP, 'openid' => $member['from_user'], 'mid' => $member['id'], 'weid' => $_W['weid']);
                    pdo_insert('bj_qmxk_paylog', $data);
                    pdo_update('bj_qmxk_member', array('credit2' => $member['credit2'] - $fee), array('id' => $member['id']));
                    return true;
                } else {
                    message('余额不足无法操作');
                }
            }
        }
        return false;
    }
    public function getProfile($from_user = '')
    {
        global $_W, $_GPC;
        if (empty($from_user)) {
            $from_user = $this->getFromUser();
        }
        $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        if (empty($profile['id'])) {
            return '';
        }
        if (!empty($profile['id']) && empty($_COOKIE['mid_' . BJ_QMXK_VERSION . $_W['weid']])) {
            setcookie('mid_' . BJ_QMXK_VERSION . $_W['weid'], $profile['id'], time() + 3600);
        }
        if ($profile['flag'] == 1 && ($profile['flagtime'] == 0 || empty($profile['flagtime'])) && !empty($profile['id'])) {
            pdo_update('bj_qmxk_member', array('flagtime' => TIMESTAMP), array('id' => $profile['id']));
        }
        if (!empty($profile['id']) && !empty($from_user)) {
            $fansscount = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('fans') . ' WHERE weid = :weid AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
            if ($fansscount > 1) {
                $mfans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user order by credit2 desc limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
                $fansfix = pdo_fetchall('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user and id!=:id order by credit2 desc', array(':id' => $mfans['id'], ':weid' => $_W['weid'], ':from_user' => $from_user));
                $index = 0;
                foreach ($fansfix as $item) {
                    $mfansitem = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  id=:id', array(':id' => $mfans['id']));
                    $index = $index + 1;
                    $mfansupdate = array();
                    if (empty($mfansitem['nickname']) && !empty($item['nickname'])) {
                        $mfansupdate['nickname'] = $item['nickname'];
                    }
                    if (empty($mfansitem['realname']) && !empty($item['realname'])) {
                        $mfansupdate['realname'] = $item['realname'];
                    }
                    if (empty($mfansitem['follow']) && !empty($item['follow'])) {
                        $mfansupdate['follow'] = $item['follow'];
                    }
                    if (empty($mfansitem['avatar']) && !empty($item['avatar'])) {
                        $mfansupdate['avatar'] = $item['avatar'];
                    }
                    if (!empty($item['credit1'])) {
                        $mfansupdate['credit1'] = $mfansitem['credit1'] + $item['credit1'];
                    }
                    if (!empty($item['credit2'])) {
                        $mfansupdate['credit2'] = $mfansitem['credit2'] + $item['credit2'];
                    }
                    pdo_update('fans', $mfansupdate, array('id' => $mfans['id']));
                    pdo_update('fans', array('from_user' => $item['from_user'] . '_' . $index), array('id' => $item['id']));
                }
            }
            $myfans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
            if (empty($myfans['id'])) {
                $row = array('weid' => $_W['weid'], 'nickname' => $profile['realname'], 'realname' => $profile['realname'], 'follow' => 1, 'gender' => 0, 'salt' => random(8), 'from_user' => $from_user, 'createtime' => TIMESTAMP);
                pdo_insert('fans', $row);
            }
        }
        return $profile;
    }
    public function getParentNickName($from_user)
    {
        global $_W;
        $myfansx = pdo_fetch('SELECT shareid FROM ' . tablename('bj_qmxk_member') . ' WHERE weid = :weid and from_user =:from_user  limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        if (!empty($myfansx['shareid']) && $myfansx['shareid'] != 0) {
            $myfansx = pdo_fetch('SELECT realname FROM ' . tablename('bj_qmxk_member') . ' WHERE weid = :weid and id =:shareid  limit 1', array(':weid' => $_W['weid'], ':shareid' => $myfansx['shareid']));
            return $myfansx['realname'];
        } else {
            return '-';
        }
    }
    public function getLevel($fanscount)
    {
        global $_W;
        $myfansx = pdo_fetch('SELECT medal_name FROM ' . tablename('bj_qmxk_phb_medal') . ' WHERE weid = :weid and  fans_count<=:fans_count order by fans_count desc  limit 1', array(':weid' => $_W['weid'], ':fans_count' => $fanscount));
        if (!empty($myfansx['medal_name'])) {
            return $myfansx['medal_name'];
        } else {
            return '普通代理';
        }
    }
    public function autoRegedit($fromaction)
    {
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $myfansx = pdo_fetch('SELECT id,from_user,nickname,follow FROM ' . tablename('fans') . ' WHERE `weid` = :weid AND from_user=:from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        $seid = 0;
        $shareids = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_share_history') . ' WHERE  from_user=:from_user and weid=:weid limit 1', array(':from_user' => $from_user, ':weid' => $_W['weid']));
        $nickname = $myfansx['nickname'];
        if (empty($nickname)) {
            $access_token = $this->get_weixin_token();
            $oauth2_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $from_user . '&lang=zh_CN';
            $content = ihttp_get($oauth2_url);
            $info = @json_decode($content['content'], true);
            $nickname = $info['nickname'];
            if (!empty($nickname)) {
                pdo_update('fans', array('nickname' => $nickname), array('id' => $myfansx['id']));
            }
            if (!empty($info['headimgurl'])) {
                pdo_update('fans', array('avatar' => $info['headimgurl']), array('id' => $myfansx['id']));
            }
        }
        $profile = pdo_fetch('SELECT from_user,id,realname FROM ' . tablename('bj_qmxk_member') . ' WHERE `weid` = :weid AND from_user=:from_user ', array(':weid' => $_W['weid'], ':from_user' => $from_user));
        if (empty($profile['id'])) {
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
                $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'realname' => $nickname, 'commission' => 0, 'createtime' => TIMESTAMP, 'flagtime' => TIMESTAMP, 'shareid' => $seid, 'status' => 1, 'flag' => 1);
            } else {
                $data = array('weid' => $_W['weid'], 'from_user' => $from_user, 'realname' => $nickname, 'commission' => 0, 'createtime' => TIMESTAMP, 'flagtime' => TIMESTAMP, 'shareid' => $seid, 'status' => 1, 'flag' => 0);
            }
            pdo_insert('bj_qmxk_member', $data);
            if (!empty($seid) && $seid != 0 && $theone['promotertimes'] == 1) {
                $sharemember = pdo_fetch('SELECT from_user,id FROM ' . tablename('bj_qmxk_member') . ' WHERE `weid` = :weid AND id=:id ', array(':weid' => $_W['weid'], ':id' => $seid));
                $joinfans = pdo_fetch('SELECT from_user,nickname FROM ' . tablename('fans') . ' WHERE `weid` = :weid AND from_user=:from_user limit 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
                if (!empty($sharemember) && !empty($sharemember['id']) && !empty($joinfans['nickname'])) {
                    $this->sendtjrtzdl($joinfans['nickname'], $sharemember['from_user']);
                }
            }
        } else {
            if (empty($profile['realname'])) {
                if (!empty($nickname)) {
                    $data = array('realname' => $nickname);
                    pdo_update('bj_qmxk_member', $data, array('id' => $profile['id']));
                }
            } else {
                $nickname = $profile['realname'];
            }
        }
        $profile = $this->getProfile();
        $this->checkisAgent($from_user, $profile);
        if (empty($nickname)) {
            $cfg = $this->module['config'];
            $ydyy = $cfg['ydyy'];
            include $this->template('register');
            die;
        }
    }
    public function memberQrcode($from_user, $recredit = false)
    {
        global $_W;
        $share = BAIJIA_COOKIE_QRCODE . $_W['weid'];
        $timex = pdo_fetchcolumn('select createtime from ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid and active=1 and isdel=0 limit 1', array(':weid' => $_W['weid']));
        $profile = $this->getProfile($from_user);
        if (!empty($profile['id'])) {
            $id = $profile['id'];
        } else {
            $id = $this->getMid();
        }
        if ($_COOKIE[$share . $timex] != $_W['weid'] . 'share' . $id || !file_exists(IA_ROOT . BJ_QMXK_BASE . '/style/images/share/share' . $id . '.png') || $recredit == true) {
            include IA_ROOT . BJ_QMXK_BASE . '/common/phpqrcode.php';
            $theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
            $listdatas = array('mid' => $id, 'weid' => $_W['weid'], 'joinway' => 1);
            if ($theone['ischeck'] == 2 && $profile['dzdflag'] == 1) {
                $listdatas['dzdid'] = $id;
            }
            $value = $_W['siteroot'] . $this->createMobileUrl('list', $listdatas);
            $errorCorrectionLevel = 'L';
            $matrixPointSize = '4';
            $imgname_qrx = "share_qrx{$id}.png";
            $imgurl_qrx = IA_ROOT . BJ_QMXK_BASE . "/style/images/share/{$imgname_qrx}";
            QRcode::png($value, $imgurl_qrx, $errorCorrectionLevel, $matrixPointSize);
            $express = pdo_fetch('select * from ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid and active=1 and isdel=0 limit 1', array(':weid' => $_W['weid']));
            $imgname = "share{$id}.png";
            $imgurl = IA_ROOT . BJ_QMXK_BASE . "/style/images/share/{$imgname}";
            if (!empty($express['channel'])) {
                $rand_file = $from_user . '.png';
                $att_target_file = 'qr-image-' . $rand_file;
                $att_head_cache_file = 'head-image-' . $from_user . '.jpg';
                $target_file = $imgurl;
                $head_cache_file = IA_ROOT . BJ_QMXK_BASE . '/tmppic/' . $att_head_cache_file;
                $bg_file = IA_ROOT . '/resource/attachment/' . $express['bg'];
                $ch = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_channel') . ' WHERE channel=:channel', array(':channel' => $express['channel']));
                $ch = $this->decode_channel_param($ch, $ch['bgparam']);
                $this->mergeImage($bg_file, $imgurl_qrx, $target_file, array('left' => $ch['qrleft'], 'top' => $ch['qrtop'], 'width' => $ch['qrwidth'], 'height' => $ch['qrheight']));
                $enableHead = $ch['avatarenable'];
                $enableName = $ch['nameenable'];
                $fans = pdo_fetch('SELECT nickname,avatar FROM ' . tablename('fans') . ' WHERE  weid=:weid and from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
                $needcache = true;
                if (!empty($fans)) {
                    if ($enableName) {
                        if (strlen($fans['nickname']) > 0) {
                            $this->writeText($target_file, $target_file, '我是' . $fans['nickname'], array('size' => $ch['namesize'], 'left' => $ch['nameleft'], 'top' => $ch['nametop']));
                        }
                    }
                    if ($enableHead) {
                        if (strlen($fans['avatar']) > 10) {
                            $head_file = $fans['avatar'];
                            if (!file_exists($head_cache_file) || filesize($head_cache_file) == 0 || filemtime($head_cache_file) < TIMESTAMP - 60 * 60) {
                                $curl = curl_init($head_file);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                $imageData = curl_exec($curl);
                                curl_close($curl);
                                $tp = fopen($head_cache_file, 'w');
                                $ws = fwrite($tp, $imageData);
                                fclose($tp);
                            }
                            $this->mergeImage($target_file, $head_cache_file, $target_file, array('left' => $ch['avatarleft'], 'top' => $ch['avatartop'], 'width' => $ch['avatarwidth'], 'height' => $ch['avatarheight']));
                        }
                    }
                }
            } else {
                $imgname = "share{$id}.png";
                $imgurl = IA_ROOT . BJ_QMXK_BASE . "/style/images/share/{$imgname}";
                QRcode::png($value, $imgurl, $errorCorrectionLevel, $matrixPointSize);
            }
            setCookie($share . $timex, $_W['weid'] . 'share' . $id, time() + 60 * 60);
        }
    }
    public function encode_channel_param($gpc)
    {
        $params = array('qrleft' => intval($gpc['qrleft']), 'qrtop' => intval($gpc['qrtop']), 'qrwidth' => intval($gpc['qrwidth']), 'qrheight' => intval($gpc['qrheight']), 'avatarleft' => intval($gpc['avatarleft']), 'avatartop' => intval($gpc['avatartop']), 'avatarwidth' => intval($gpc['avatarwidth']), 'avatarheight' => intval($gpc['avatarheight']), 'avatarenable' => intval($gpc['avatarenable']), 'nameleft' => intval($gpc['nameleft']), 'nametop' => intval($gpc['nametop']), 'namesize' => intval($gpc['namesize']), 'namecolor' => intval($gpc['namecolor']), 'nameenable' => intval($gpc['nameenable']));
        return serialize($params);
    }
    public function writeText($bg, $out, $text, $param = array())
    {
        list($bgWidth, $bgHeight) = getimagesize($bg);
        extract($param);
        $im = imagecreatefromjpeg($bg);
        $black = imagecolorallocate($im, 0, 0, 0);
        $font = IA_ROOT . '/source/modules/bj_qmxk/font/msyhbd.ttf';
        $white = imagecolorallocate($im, 255, 255, 255);
        imagettftext($im, $size, 0, $left, $top + $size / 2, $white, $font, $text);
        ob_start();
        imagejpeg($im, NULL, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        imagedestroy($im);
        $fh = fopen($out, 'w+');
        fwrite($fh, $contents);
        fclose($fh);
    }
    public function curl_file_get_contents($durl)
    {
        $r = null;
        if (function_exists('curl_init') && function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $durl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $r = curl_exec($ch);
            curl_close($ch);
        }
        return $r;
    }
    public function decode_channel_param($item, $p)
    {
        $gpc = unserialize($p);
        $item['qrleft'] = intval($gpc['qrleft']) ? intval($gpc['qrleft']) : 145;
        $item['qrtop'] = intval($gpc['qrtop']) ? intval($gpc['qrtop']) : 475;
        $item['qrwidth'] = intval($gpc['qrwidth']) ? intval($gpc['qrwidth']) : 240;
        $item['qrheight'] = intval($gpc['qrheight']) ? intval($gpc['qrheight']) : 240;
        $item['avatarleft'] = intval($gpc['avatarleft']) ? intval($gpc['avatarleft']) : 111;
        $item['avatartop'] = intval($gpc['avatartop']) ? intval($gpc['avatartop']) : 10;
        $item['avatarwidth'] = intval($gpc['avatarwidth']) ? intval($gpc['avatarwidth']) : 86;
        $item['avatarheight'] = intval($gpc['avatarheight']) ? intval($gpc['avatarheight']) : 86;
        $item['avatarenable'] = intval($gpc['avatarenable']);
        $item['nameleft'] = intval($gpc['nameleft']) ? intval($gpc['nameleft']) : 210;
        $item['nametop'] = intval($gpc['nametop']) ? intval($gpc['nametop']) : 28;
        $item['namesize'] = intval($gpc['namesize']) ? intval($gpc['namesize']) : 30;
        $item['namecolor'] = $gpc['namecolor'];
        $item['nameenable'] = intval($gpc['nameenable']);
        return $item;
    }
    public function mergeImage($bg, $qr, $out, $param)
    {
        list($bgWidth, $bgHeight) = getimagesize($bg);
        list($qrWidth, $qrHeight) = getimagesize($qr);
        extract($param);
        $tmpfile1 = IA_ROOT . BJ_QMXK_BASE . '/tmppic/' . rand(10000, 99999) . '.jpg';
        copy($bg, $tmpfile1);
        $tmpfile2 = IA_ROOT . BJ_QMXK_BASE . '/tmppic/' . rand(10000, 99999) . '.jpg';
        copy($qr, $tmpfile2);
        $bgImg = $this->imagecreate($tmpfile1);
        $qrImg = $this->imagecreate($tmpfile2);
        imagecopyresized($bgImg, $qrImg, $left, $top, 0, 0, $width, $height, $qrWidth, $qrHeight);
        ob_start();
        imagejpeg($bgImg, NULL, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        @unlink($tmpfile1);
        @unlink($tmpfile2);
        $fh = fopen($out, 'w+');
        fwrite($fh, $contents);
        fclose($fh);
    }
    public function imagecreate($bg)
    {
        $bgImg = @imagecreatefromjpeg($bg);
        if (FALSE == $bgImg) {
            $bgImg = @imagecreatefrompng($bg);
        }
        if (FALSE == $bgImg) {
            $bgImg = @imagecreatefromgif($bg);
        }
        return $bgImg;
    }
    public function xoauth()
    {
        global $_W, $_GPC;
        $weid = $_W['weid'];
        if ($_GPC['code'] == 'authdeny') {
            die;
        }
        if (isset($_GPC['code'])) {
            $appid = $_W['account']['key'];
            $secret = $_W['account']['secret'];
            if (empty($appid) || empty($secret)) {
                if (BAIJIA_AGENT_ALL == true) {
                    $appid = BAIJIA_APPID;
                    $secret = BAIJIA_SECRET;
                }
            }
            if (empty($appid) || empty($secret)) {
                message('微信公众号没有配置公众号AppId和公众号AppSecret!');
            }
            $state = $_GPC['state'];
            $code = $_GPC['code'];
            $oauth2_code = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
            $content = ihttp_get($oauth2_code);
            $token = @json_decode($content['content'], true);
            if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
                echo '<h1>1获取微信公众号授权' . $code . '失败[无法取得token以及openid], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'] . '<h1>';
                die;
            }
            $from_user = $token['openid'];
            $access_token = $this->get_weixin_token();
            $oauth2_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $from_user . '&lang=zh_CN';
            $content = ihttp_get($oauth2_url);
            $info = @json_decode($content['content'], true);
            if ($info['subscribe'] == 1) {
                $follow = 1;
            } else {
                $follow = 0;
            }
            $fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE from_user=:from_user and weid=:weid', array(':from_user' => $from_user, ':weid' => $_W['weid']));
            $nickname = $info['nickname'];
            if (empty($fans) || empty($fans['id']) || empty($fans['nickname'])) {
                if ($follow == 0 && $state == 0) {
                    $this->getFromUser(1);
                    return;
                }
                if ($follow == 0 && $state == 1) {
                    $access_token = $token['access_token'];
                    $oauth2_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $from_user . '&lang=zh_CN';
                    $content = ihttp_get($oauth2_url);
                    $info = @json_decode($content['content'], true);
                }
                if (empty($info) || !is_array($info) || empty($info['openid'])) {
                    echo '<h1>获取微信公众号授权失败[无法取得info], 请稍后重试！<h1>';
                    die;
                }
                $sex = $info['sex'];
                $nickname = $info['nickname'];
            }
            if (empty($fans['id'])) {
                $row = array('weid' => $_W['weid'], 'nickname' => $nickname, 'realname' => $nickname, 'follow' => $follow, 'gender' => $sex, 'salt' => random(8), 'from_user' => $from_user, 'createtime' => TIMESTAMP);
                pdo_insert('fans', $row);
                if (!empty($info['headimgurl'])) {
                    pdo_update('fans', array('avatar' => $info['headimgurl']), array('from_user' => $from_user));
                }
            } else {
                if ($fans['follow'] == 0 && $fans['follow'] != $follow) {
                    pdo_update('fans', array('follow' => $follow), array('from_user' => $from_user, 'weid' => $_W['weid']));
                }
                if (!empty($nickname)) {
                    $row = array('nickname' => $nickname, 'realname' => $nickname);
                    pdo_update('fans', $row, array('from_user' => $from_user));
                }
                if (!empty($info['headimgurl'])) {
                    pdo_update('fans', array('avatar' => $info['headimgurl']), array('from_user' => $from_user));
                }
            }
            return $from_user;
        } else {
            echo '<h1>网页授权域名设置出错!</h1>';
            die;
        }
    }
    public function GrabImage($url, $filename = '')
    {
        if ($url == '') {
            return false;
        }
        if ($filename == '') {
            $ext = strrchr($url, '.');
            if ($ext != '.gif' && $ext != '.jpg' && $ext != '.png') {
                return false;
            }
            $filename = date('YmdHis') . $ext;
        }
        ob_start();
        readfile($url);
        $img = ob_get_contents();
        ob_end_clean();
        $size = strlen($img);
        $fp2 = @fopen($filename, 'a');
        fwrite($fp2, $img);
        fclose($fp2);
        return $filename;
    }
    public function get_weixin_token()
    {
        global $_W, $_GPC;
        $account = $_W['account'];
        if (is_array($account['access_token']) && !empty($account['access_token']['token']) && !empty($account['access_token']['expire']) && $account['access_token']['expire'] > TIMESTAMP) {
            return $account['access_token']['token'];
        } else {
            if (empty($account['weid'])) {
                message('参数错误.');
            }
            $appid = $account['key'];
            $secret = $account['secret'];
            if (empty($appid) || empty($secret)) {
                if (BAIJIA_AGENT_ALL == true) {
                    $appid = BAIJIA_APPID;
                    $secret = BAIJIA_SECRET;
                }
            }
            if (empty($appid) || empty($secret)) {
                message('请填写公众号的appid及appsecret, (需要你的号码为微信服务号)！', create_url('account/post', array('id' => $account['weid'])), 'error');
            }
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
            $content = ihttp_get($url);
            if (empty($content)) {
                message('获取微信公众号授权失败, 请稍后重试！');
            }
            $token = @json_decode($content['content'], true);
            if (empty($token) || !is_array($token)) {
                message('获取微信公众号授权失败, 请稍后重试！ 公众平台返回原始数据为: <br />' . $token);
            }
            if (empty($token['access_token']) || empty($token['expires_in'])) {
                message('解析微信公众号授权失败, 请稍后重试！');
            }
            $record = array();
            $record['token'] = $token['access_token'];
            $record['expire'] = TIMESTAMP + $token['expires_in'];
            $row = array();
            $row['access_token'] = iserializer($record);
            pdo_update('wechats', $row, array('weid' => $account['weid']));
            return $record['token'];
        }
    }
    public function getSignPackage($urlaction = 'list', $datas = array(), $imgUrl = '', $title = '')
    {
        global $_W, $_GPC;
        if (BAIJIA_DEVELOPMENT) {
            return true;
        }
        $appid = $_W['account']['key'];
        if (empty($appid)) {
            if (BAIJIA_AGENT_ALL == true) {
                $appid = BAIJIA_APPID;
            }
        }
        $protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
        $url = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $jsapiTicket = $this->get_js_ticket();
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        $string = "jsapi_ticket={$jsapiTicket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
        $mid = $this->getMid();
        if (empty($datas)) {
            $datas = array('id' => $mid);
        } else {
            if ($urlaction == 'list') {
                $datas['id'] = $mid;
            }
        }
        $signature = sha1($string);
        $cfg = $this->module['config'];
        if (empty($title)) {
            $title = $_W['account']['name'];
        }
        if (empty($imgUrl)) {
            $imgUrl = $_W['attachurl'] . $cfg['logo'];
        }
        if (!empty($datas['sitelogo'])) {
            $imgUrl = $datas['sitelogo'];
        }
        $description = $cfg['description'];
        if (!empty($datas['description'])) {
            $description = $datas['description'];
        }
        if (!empty($datas['title'])) {
            $title = $datas['title'];
        }
        $datas['mid'] = $mid;
        $signPackage = array('appId' => $appid, 'nonceStr' => $nonceStr, 'timestamp' => $timestamp, 'url' => $url, 'title' => $title, 'imgUrl' => $imgUrl, 'link' => $_W['siteroot'] . $this->createMobileUrl($urlaction, $datas, true), 'signature' => $signature, 'description' => $description, 'rawString' => $string);
        return $signPackage;
    }
    public function createNonceStr($length = 16)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    public function get_js_ticket()
    {
        global $_W;
        $theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
        $jsapi_ticket = $theone['jsapi_ticket'];
        $jsapi_ticket_exptime = intval($theone['jsapi_ticket_exptime']);
        if (empty($jsapi_ticket) || empty($jsapi_ticket_exptime) || $jsapi_ticket_exptime < time()) {
            $accessToken = $this->get_weixin_token();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$accessToken}";
            $content = ihttp_get($url);
            $res = @json_decode($content['content'], true);
            $ticket = $res['ticket'];
            if (!empty($ticket)) {
                $data = array();
                $data['expire_time'] = time() + 7000;
                $data['jsapi_ticket'] = $ticket;
                if (empty($jsapi_ticket)) {
                    $insert = array('weid' => $_W['weid'], 'terms' => '', 'commtime' => 0, 'ischeck' => 1, 'jsapi_ticket' => $ticket, 'jsapi_ticket_exptime' => time() + 7000, 'createtime' => TIMESTAMP);
                    pdo_insert('bj_qmxk_rules', $insert);
                } else {
                    $update = array('jsapi_ticket' => $ticket, 'jsapi_ticket_exptime' => time() + 7000);
                    pdo_update('bj_qmxk_rules', $update, array('weid' => $_W['weid']));
                }
                return $ticket;
            }
            return '';
        } else {
            return $jsapi_ticket;
        }
    }
    public function validateopenid()
    {
    }
    public function getAddressSignInfo($code, $url, $signPackage)
    {
        $token = $this->getToken($code);
        $accesstoken = $token['access_token'];
        $noncestr = $this->createNonceStr(6);
        $Parameters = array();
        $Parameters['accesstoken'] = $accesstoken;
        $Parameters['appid'] = $signPackage['appId'];
        $Parameters['noncestr'] = $noncestr;
        $Parameters['timestamp'] = $signPackage['timestamp'];
        $Parameters['url'] = $url;
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        $addrSign = sha1($String);
        $infoarray = array('appId' => $signPackage['appId'], 'scope' => 'jsapi_address', 'signType' => 'sha1', 'addrSign' => $addrSign, 'timeStamp' => '' . $signPackage['timestamp'], 'nonceStr' => $noncestr);
        $result_ = json_encode($infoarray);
        return $result_;
    }
    private function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = '';
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . '=' . $v . '&';
        }
        $reqPar;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }
    public function getToken($code)
    {
        if (BAIJIA_DEVELOPMENT == true) {
            return array();
        }
        global $_W, $_GPC;
        $appid = $_W['account']['key'];
        $secret = $_W['account']['secret'];
        if (empty($appid) || empty($secret)) {
            if (BAIJIA_AGENT_ALL == true) {
                $appid = BAIJIA_APPID;
                $secret = BAIJIA_SECRET;
            }
        }
        if (empty($appid) || empty($secret)) {
            message('微信公众号没有配置公众号AppId和公众号AppSecret!');
        }
        $oauth2_code = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
        $content = ihttp_get($oauth2_code);
        $token = @json_decode($content['content'], true);
        return $token;
    }
    public function getUserTokenForAddr()
    {
        global $_W, $_GPC;
        if (BAIJIA_DEVELOPMENT == true) {
            return '';
        }
        $appid = $_W['account']['key'];
        $secret = $_W['account']['secret'];
        if (empty($appid) || empty($secret)) {
            if (BAIJIA_AGENT_ALL == true) {
                $appid = BAIJIA_APPID;
                $secret = BAIJIA_SECRET;
            }
        }
        if (empty($appid) || empty($secret)) {
            message('微信公众号没有配置公众号AppId和公众号AppSecret!');
        }
        $url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $scope = 'snsapi_base';
        $oauth2_code = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_base&state=0#wechat_redirect';
        header("location:{$oauth2_code}");
    }
    public function getFromUser($state = 0)
    {
        global $_W, $_GPC, $_QMXK;
        if (BAIJIA_DEVELOPMENT == true) {
            return $_W['fans']['from_user'];
        }
        $oauth_openid = BAIJIA_COOKIE_OPENID . $_W['weid'];
        $appid = $_W['account']['key'];
        $secret = $_W['account']['secret'];
        if (empty($appid) || empty($secret)) {
            if (BAIJIA_AGENT_ALL == true) {
                $appid = BAIJIA_APPID;
                $secret = BAIJIA_SECRET;
            }
        }
        if (empty($appid) || empty($secret)) {
            message('微信公众号没有配置公众号AppId和公众号AppSecret!');
        }
        if (empty($_COOKIE[$oauth_openid])) {
            if (!empty($_QMXK) && !empty($_QMXK['FROM_USER'])) {
                return $_QMXK['FROM_USER'];
            }
            if ($state == 1 || isset($_GPC['code']) && isset($_GPC['state']) && $_GPC['state'] == 1) {
                $scope = 'snsapi_userinfo';
                if (isset($_GPC['code']) && isset($_GPC['state']) && $_GPC['state'] == 1) {
                    $from_user = $this->xoauth();
                    setcookie($oauth_openid, $from_user, time() + 60 * 30);
                    setcookie('mid', '', time() - 1);
                    $_QMXK['FROM_USER'] = $from_user;
                    return $from_user;
                    die;
                }
            } else {
                $scope = 'snsapi_base';
                if (isset($_GPC['code'])) {
                    $from_user = $this->xoauth();
                    setcookie($oauth_openid, $from_user, time() + 60 * 30);
                    setcookie('mid', '', time() - 1);
                    $_QMXK['FROM_USER'] = $from_user;
                    return $from_user;
                    die;
                }
            }
            $url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            $oauth2_code = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=' . $scope . '&state=' . $state . '#wechat_redirect';
            header("location:{$oauth2_code}");
            die;
        } else {
            setcookie($oauth_openid, $_COOKIE[$oauth_openid], time() + 60 * 30);
            return $_COOKIE[$oauth_openid];
        }
    }
    public function sendtempmsg($template_id, $url, $data, $topcolor)
    {
        if (BAIJIA_DEVELOPMENT == true) {
            return true;
        }
        global $_W, $_GPC;
        $from_user = $this->getFromUser();
        $tokens = $this->get_weixin_token();
        if (empty($tokens)) {
            return;
        }
        $postarr = '{"touser":"' . $from_user . '","template_id":"' . $template_id . '","url":"' . $url . '","topcolor":"' . $topcolor . '","data":' . $data . '}';
        $res = ihttp_post('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $tokens, $postarr);
        return true;
    }
    public function sendcustomMsg($from_user, $msg)
    {
        if (BAIJIA_DEVELOPMENT == true) {
            return true;
        }
        $access_token = $this->get_weixin_token();
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
        $msg = str_replace('"', '\\"', $msg);
        $post = '{"touser":"' . $from_user . '","msgtype":"text","text":{"content":"' . $msg . '"}}';
        $this->curlPost($url, $post);
    }
    public function curlPost($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        curl_close($ch);
        return $info;
    }
}
if (!function_exists('pagination1')) {
    function pagination1($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => ''))
    {
        global $_W;
        $pdata = array('tcount' => 0, 'tpage' => 0, 'cindex' => 0, 'findex' => 0, 'pindex' => 0, 'nindex' => 0, 'lindex' => 0, 'options' => '');
        if ($context['ajaxcallback']) {
            $context['isajax'] = true;
        }
        $pdata['tcount'] = $tcount;
        $pdata['tpage'] = ceil($tcount / $psize);
        if ($pdata['tpage'] <= 1) {
            return '';
        }
        $cindex = $pindex;
        $cindex = min($cindex, $pdata['tpage']);
        $cindex = max($cindex, 1);
        $pdata['cindex'] = $cindex;
        $pdata['findex'] = 1;
        $pdata['pindex'] = $cindex > 1 ? $cindex - 1 : 1;
        $pdata['nindex'] = $cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage'];
        $pdata['lindex'] = $pdata['tpage'];
        if ($context['isajax']) {
            if (!$url) {
                $url = $_W['script_name'] . '?' . http_build_query($_GET);
            }
            $pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
            $pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
            $pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
            $pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
        } else {
            if ($url) {
                $pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
                $pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
                $pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
                $pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
            } else {
                $_GET['page'] = $pdata['findex'];
                $pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
                $_GET['page'] = $pdata['pindex'];
                $pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
                $_GET['page'] = $pdata['nindex'];
                $pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
                $_GET['page'] = $pdata['lindex'];
                $pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            }
        }
        $html = '<div class="pagination pagination-centered"><ul>';
        if ($pdata['cindex'] > 1) {
            $html .= "<li><a {$pdata['faa']} class=\"pager-nav\">首页</a></li>";
            $html .= "<li><a {$pdata['paa']} class=\"pager-nav\">&laquo;上一页</a></li>";
        }
        if (!$context['before'] && $context['before'] != 0) {
            $context['before'] = 5;
        }
        if (!$context['after'] && $context['after'] != 0) {
            $context['after'] = 4;
        }
        if ($context['after'] != 0 && $context['before'] != 0) {
            $range = array();
            $range['start'] = max(1, $pdata['cindex'] - $context['before']);
            $range['end'] = min($pdata['tpage'], $pdata['cindex'] + $context['after']);
            if ($range['end'] - $range['start'] < $context['before'] + $context['after']) {
                $range['end'] = min($pdata['tpage'], $range['start'] + $context['before'] + $context['after']);
                $range['start'] = max(1, $range['end'] - $context['before'] - $context['after']);
            }
            for ($i = $range['start']; $i <= $range['end']; $i++) {
                if ($context['isajax']) {
                    $aa = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $i . '\', ' . $context['ajaxcallback'] . ')"';
                } else {
                    if ($url) {
                        $aa = 'href="?' . str_replace('*', $i, $url) . '"';
                    } else {
                        $_GET['page'] = $i;
                        $aa = 'href="?' . http_build_query($_GET) . '"';
                    }
                }
            }
        }
        if ($pdata['cindex'] < $pdata['tpage']) {
            $html .= "<li><a {$pdata['naa']} class=\"pager-nav\">下一页&raquo;</a></li>";
            $html .= "<li><a {$pdata['laa']} class=\"pager-nav\">尾页</a></li>";
        }
        $html .= '</ul></div>';
        return $html;
    }
}
if (!function_exists('pagination2')) {
    function pagination2($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => ''))
    {
        global $_W;
        $pdata = array('tcount' => 0, 'tpage' => 0, 'cindex' => 0, 'findex' => 0, 'pindex' => 0, 'nindex' => 0, 'lindex' => 0, 'options' => '');
        if ($context['ajaxcallback']) {
            $context['isajax'] = true;
        }
        $pdata['tcount'] = $tcount;
        $pdata['tpage'] = ceil($tcount / $psize);
        if ($pdata['tpage'] <= 1) {
            return '';
        }
        $cindex = $pindex;
        $cindex = min($cindex, $pdata['tpage']);
        $cindex = max($cindex, 1);
        $pdata['cindex'] = $cindex;
        $pdata['findex'] = 1;
        $pdata['pindex'] = $cindex > 1 ? $cindex - 1 : 1;
        $pdata['nindex'] = $cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage'];
        $pdata['lindex'] = $pdata['tpage'];
        if ($context['isajax']) {
            if (!$url) {
                $url = $_W['script_name'] . '?' . http_build_query($_GET);
            }
            $pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
            $pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
            $pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
            $pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
        } else {
            if ($url) {
                $pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
                $pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
                $pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
                $pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
            } else {
                $_GET['page'] = $pdata['findex'];
                $pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
                $_GET['page'] = $pdata['pindex'];
                $pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
                $_GET['page'] = $pdata['nindex'];
                $pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
                $_GET['page'] = $pdata['lindex'];
                $pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            }
        }
        $html = '<div class="pagination pagination-centered"><ul class="pagination pagination-centered">';
        if ($pdata['cindex'] > 1) {
            $html .= "<li><a {$pdata['faa']} class=\"pager-nav\">首页</a></li>";
            $html .= "<li><a {$pdata['paa']} class=\"pager-nav\">&laquo;上一页</a></li>";
        }
        if (!$context['before'] && $context['before'] != 0) {
            $context['before'] = 5;
        }
        if (!$context['after'] && $context['after'] != 0) {
            $context['after'] = 4;
        }
        if ($context['after'] != 0 && $context['before'] != 0) {
            $range = array();
            $range['start'] = max(1, $pdata['cindex'] - $context['before']);
            $range['end'] = min($pdata['tpage'], $pdata['cindex'] + $context['after']);
            if ($range['end'] - $range['start'] < $context['before'] + $context['after']) {
                $range['end'] = min($pdata['tpage'], $range['start'] + $context['before'] + $context['after']);
                $range['start'] = max(1, $range['end'] - $context['before'] - $context['after']);
            }
            for ($i = $range['start']; $i <= $range['end']; $i++) {
                if ($context['isajax']) {
                    $aa = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $i . '\', ' . $context['ajaxcallback'] . ')"';
                } else {
                    if ($url) {
                        $aa = 'href="?' . str_replace('*', $i, $url) . '"';
                    } else {
                        $_GET['page'] = $i;
                        $aa = 'href="?' . http_build_query($_GET) . '"';
                    }
                }
                $html .= $i == $pdata['cindex'] ? '<li ><strong><a href="javascript:;">' . $i . '</a></strong></li>' : "<li><a {$aa}>" . $i . '</a></li>';
            }
        }
        if ($pdata['cindex'] < $pdata['tpage']) {
            $html .= "<li><a {$pdata['naa']} class=\"pager-nav\">下一页&raquo;</a></li>";
            $html .= "<li><a {$pdata['laa']} class=\"pager-nav\">尾页</a></li>";
        }
        $html .= '</ul></div>';
        return $html;
    }
}
if (!function_exists('img_url')) {
    function img_url($img = '')
    {
        global $_W;
        if (empty($img)) {
            return '';
        }
        if (substr($img, 0, 6) == 'avatar') {
            return $_W['siteroot'] . 'resource/image/avatar/' . $img;
        }
        if (substr($img, 0, 8) == './themes') {
            return $_W['siteroot'] . $img;
        }
        if (substr($img, 0, 1) == '.') {
            return $_W['siteroot'] . substr($img, 2);
        }
        if (substr($img, 0, 5) == 'http:') {
            return $img;
        }
        return $_W['attachurl'] . $img;
    }
}
if (!function_exists('tpl_form_field_date2')) {
    function tpl_form_field_date2($name, $value = array(), $ishour = false)
    {
        $s = '';
        if (!defined('INCLUDE_DATE')) {
            $s = '
		<link type="text/css" rel="stylesheet" href="./resource/style/datetimepicker.css" />
		<script type="text/javascript" src="./resource/script/datetimepicker.js"></script>';
            define('INCLUDE_DATE', true);
        }
        if (strexists($name, '[')) {
            $id = str_replace(array('[', ']'), '_', $name);
        } else {
            $id = $name;
        }
        $value = empty($value) ? date('Y-m-d', TIMESTAMP) : $value;
        $ishour = empty($ishour) ? 2 : 0;
        $s .= '
	<input type="text" class="datepicker" id="datepicker_' . $id . '" name="' . $name . '" value="' . $value . '" readonly="readonly" />
	<script type="text/javascript">
		$("#datepicker_' . $id . '").datetimepicker({
			format: "yyyy-mm-dd",
			minView: "' . $ishour . '",
			//pickerPosition: "top-right",
			autoclose: true
		});
	</script>';
        return $s;
    }
}