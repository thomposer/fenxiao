<?php
defined('IN_IA') or die('Access Denied');
class bj_qmxkModuleReceiverCore extends WeModuleReceiver
{
    public function receive()
    {
        if ($this->message['msgtype'] == 'event') {
            if ($this->message['event'] == 'subscribe') {
                if (strlen($this->message['eventkey']) > 8) {
                    $eventkey = substr($this->message['eventkey'], 8);
                } else {
                    $eventkey = $this->message['eventkey'];
                }
                if (!empty($this->message['from']) && !empty($eventkey)) {
                    $isfollow = $this->saveqmxkfollow($eventkey, $GLOBALS['_W']['weid'], $this->message['from']);
                    if ($isfollow == true) {
                        $userinfo = $this->getInfoFromUser($this->message['from']);
                        $this->sendtjrtzewm($userinfo['nickname'], $eventkey, $GLOBALS['_W']['weid']);
                    }
                }
            }
        }
    }
    public function sendtjrtzewm($agentname, $to_from_user, $weid)
    {
        $time = date('Y-m-d H:i:s');
        $tmsgtemplate = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_msg_template') . ' WHERE  weid = :weid and tkey = :key', array(':weid' => $weid, ':key' => 'tjrtzewm'));
        if (!empty($tmsgtemplate['id']) && !empty($tmsgtemplate['template']) && $tmsgtemplate['tenable'] == 1) {
            $message2 = str_replace('{agent_name}', $agentname, $tmsgtemplate['template']);
            $message = str_replace('{time}', $time, $message2);
            $this->sendcustomMsg($to_from_user, $message);
        }
    }
    public function get_weixin_token()
    {
        $_W = $GLOBALS['_W'];
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
    public function sendcustomMsg($from_user, $msg)
    {
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
    public function getInfoFromUser($from_user)
    {
        $access_token = $this->get_weixin_token();
        $oauth2_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $from_user . '&lang=zh_CN';
        $content = ihttp_get($oauth2_url);
        $info = @json_decode($content['content'], true);
        return $info;
    }
    private function saveqmxkfollow($tofrom_user, $weid, $from_user)
    {
        if ($tofrom_user == $from_user) {
            return true;
        }
        $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user ', array(':weid' => $weid, ':from_user' => $tofrom_user));
        if (!empty($profile) && !empty($profile['id'])) {
            $qmjf_qr = pdo_fetch('select * from ' . tablename('bj_qmxk_share_history') . ' WHERE  weid = :weid   and from_user=:from_user', array(':weid' => $weid, ':from_user' => $from_user));
            $users = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . " WHERE weid = '{$weid}' AND from_user = '{$from_user}' limit 1");
            if (empty($qmjf_qr['id']) && $users['id'] != $profile['id']) {
                $data = array('weid' => $weid, 'from_user' => $from_user, 'sharemid' => $profile['id']);
                pdo_insert('bj_qmxk_share_history', $data);
                pdo_update('bj_qmxk_member', array('clickcount' => $profile['clickcount'] + 1), array('id' => $profile['id']));
                $theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $weid));
                if (!empty($theone['clickcredit'])) {
                    $fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid and from_user=:from_user', array(':weid' => $weid, ':from_user' => $tofrom_user));
                    if (!empty($fans['id'])) {
                        pdo_update('fans', array('credit1' => $fans['credit1'] + $theone['clickcredit']), array('id' => $fans['id'], 'weid' => $weid));
                    }
                }
                return true;
            }
        }
        return false;
    }
}