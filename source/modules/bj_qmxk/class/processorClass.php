<?php
defined('IN_IA') or die('Access Denied');
class bj_qmxkModuleProcessorCore extends WeModuleProcessor
{
    public function respond()
    {
        if ($this->message['content'] == '分销专属二维码') {
            $account = $GLOBALS['_W']['account'];
            $express = pdo_fetch('select * from ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid and active=1 and isdel=0 limit 1', array(':weid' => $GLOBALS['_W']['weid']));
            $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE status=1 and flag=1 and weid = :weid  AND from_user = :from_user ', array(':weid' => $GLOBALS['_W']['weid'], ':from_user' => $this->message['from']));
            if (empty($profile['id'])) {
                $regurl = $GLOBALS['_W']['siteroot'] . 'mobile.php?act=module&name=bj_qmxk&do=fansIndex&weid=' . $GLOBALS['_W']['weid'];
                return $this->respText('请先注册成代理！ <a href=\'' . $regurl . '\'>马上注册成为分销员</a>');
            }
            if (!empty($express['channel'])) {
                $homeurl = $GLOBALS['_W']['siteroot'] . 'mobile.php?act=module&name=bj_qmxk&do=list&weid=' . $GLOBALS['_W']['weid'] . '&mid=' . $profile['id'];
                $theone = pdo_fetch('SELECT ischeck FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $GLOBALS['_W']['weid']));
                if ($profile['dzdflag'] == 1 && $profile['flag'] == 1 && $theone['ischeck'] == 2) {
                    $homeurl = $homeurl . '&dzdid=' . $profile['id'];
                }
                $follow = pdo_fetch('select * from ' . tablename('bj_qmxk_follow') . ' WHERE weid=:weid and follower=:from_user  limit 1', array(':weid' => $GLOBALS['_W']['weid'], ':from_user' => $this->message['from']));
                if (empty($follow['follower'])) {
                    $insert = array('weid' => $GLOBALS['_W']['weid'], 'follower' => $this->message['from'], 'leader' => $this->message['from'], 'channel' => '', 'credit' => 0, 'createtime' => TIMESTAMP + 5);
                    pdo_insert('bj_qmxk_follow', $insert);
                }
                $follow = pdo_fetch('select * from ' . tablename('bj_qmxk_follow') . ' WHERE weid=:weid and follower=:from_user  limit 1', array(':weid' => $GLOBALS['_W']['weid'], ':from_user' => $this->message['from']));
                $qmjf_qr = pdo_fetch('select * from ' . tablename('bj_qmxk_qr') . ' WHERE weid=:weid and from_user=:from_user and channel=:channel  limit 1', array(':weid' => $GLOBALS['_W']['weid'], ':from_user' => $this->message['from'], ':channel' => $express['channel']));
                if (empty($qmjf_qr['id']) || empty($qmjf_qr['qr_url']) || empty($qmjf_qr['media_id']) || empty($qmjf_qr['id']) || !empty($qmjf_qr['expiretime']) && $qmjf_qr['expiretime'] <= TIMESTAMP) {
                    pdo_update('bj_qmxk_follow', array('createtime' => TIMESTAMP + 15), array('weid' => $GLOBALS['_W']['weid'], 'follower' => $this->message['from']));
                    if (empty($qmjf_qr['id'])) {
                        $insert = array('weid' => $GLOBALS['_W']['weid'], 'from_user' => $this->message['from'], 'channel' => $express['channel'], 'qr_url' => '', 'media_id' => 0, 'expiretime' => TIMESTAMP + 60 * 24 * 6, 'createtime' => TIMESTAMP);
                        pdo_insert('bj_qmxk_qr', $insert);
                    }
                    $tqmjf_qr = pdo_fetch('select * from ' . tablename('bj_qmxk_qr') . ' WHERE weid=:weid and from_user=:from_user and channel=:channel  limit 1', array(':weid' => $GLOBALS['_W']['weid'], ':from_user' => $this->message['from'], ':channel' => $express['channel']));
                    $newid = $tqmjf_qr['id'];
                    if ($express['msgtype'] == 2) {
                        $qrfile = $this->getLimitQR($account, $tqmjf_qr['from_user']);
                    } else {
                        if (!empty($profile['id'])) {
                            $qrfile = $this->getURLQR($profile['id'], $this->message['from'], $homeurl);
                        } else {
                            $qrfile = $this->getURLQR(0, $this->message['from'], $homeurl);
                        }
                    }
                    $tmplfile = IA_ROOT . BJ_QMXK_BASE . '/tmppic/tmp' . $this->message['from'];
                    if (!file_exists($tmplfile) || filemtime($tmplfile) < TIMESTAMP - 15) {
                        file_put_contents($tmplfile, '');
                    } else {
                        die;
                    }
                    if (!empty($express['notice'])) {
                        $this->sendcustomMsg($account, $this->message['from'], $express['notice']);
                    }
                    $qrpic = $this->genImage($express['bg'], $qrfile, $GLOBALS['_W']['weid'], $this->message['from']);
                    $media_id = $this->uploadImage($account, IA_ROOT . $qrpic);
                    $content = @json_decode($media_id, true);
                    pdo_update('bj_qmxk_qr', array('expiretime' => TIMESTAMP + 86400 * 2, 'media_id' => $content['media_id'], 'qr_url' => $qrpic), array('id' => $newid));
                    $this->sendcustomIMG($account, $this->message['from'], $content['media_id']);
                } else {
                    return $this->respImage($qmjf_qr['media_id']);
                }
                die;
            } else {
                return $this->respText('商家未设置二维码生成');
            }
        }
    }
    public function uploadImage($account, $img)
    {
        return $this->uploadRes($this->get_weixin_token($account), $img, 'image');
    }
    public function sendcustomMsg($account, $from_user, $msg)
    {
        $access_token = $this->get_weixin_token($account);
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
        $post = '{"touser":"' . $from_user . '","msgtype":"text","text":{"content":"' . $msg . '"}}';
        $this->curlPost($url, $post);
    }
    public function sendcustomIMG($account, $from_user, $msg)
    {
        $access_token = $this->get_weixin_token($account);
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
        $post = '{"touser":"' . $from_user . '","msgtype":"image","image":{"media_id":"' . $msg . '"}}';
        $this->curlPost($url, $post);
    }
    public function getURLQR($mid, $from_user, $homeurl)
    {
        include IA_ROOT . BJ_QMXK_BASE . '/common/phpqrcode.php';
        $value = $homeurl . '&mid=' . $mid;
        $errorCorrectionLevel = 'L';
        $matrixPointSize = '4';
        $rand_file = $from_user . '.png';
        $att_target_file = 'qr-' . $rand_file;
        $target_file = IA_ROOT . BJ_QMXK_BASE . '/tmppic/' . $att_target_file;
        QRcode::png($value, $target_file, $errorCorrectionLevel, $matrixPointSize);
        return $target_file;
    }
    public function uploadRes($access_token, $img, $type)
    {
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type={$type}";
        $post = array('media' => '@' . $img);
        $ret = $this->curlPost($url, $post);
        return $ret;
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
    private function genImage($bg, $qr_file, $weid, $from_user)
    {
        $express = pdo_fetch('select * from ' . tablename('bj_qmxk_channel') . ' WHERE weid=:weid  and active=1 and isdel=0 limit 1', array(':weid' => $weid));
        if (!empty($express['channel'])) {
            $rand_file = $from_user . '.jpg';
            $att_target_file = 'qr-image-' . $rand_file;
            $att_head_cache_file = 'head-image-' . $rand_file;
            $target_file = IA_ROOT . BJ_QMXK_BASE . '/tmppic/' . $att_target_file;
            $head_cache_file = IA_ROOT . BJ_QMXK_BASE . '/tmppic/' . $att_head_cache_file;
            if (!file_exists(IA_ROOT . BJ_QMXK_BASE . '/tmppic/')) {
                mkdir(IA_ROOT . BJ_QMXK_BASE . '/tmppic/');
            }
            $bg_file = IA_ROOT . '/resource/attachment/' . $bg;
            $ch = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_channel') . ' WHERE channel=:channel', array(':channel' => $express['channel']));
            $ch = $this->decode_channel_param($ch, $ch['bgparam']);
            $this->mergeImage($bg_file, $qr_file, $target_file, array('left' => $ch['qrleft'], 'top' => $ch['qrtop'], 'width' => $ch['qrwidth'], 'height' => $ch['qrheight']));
            $enableHead = $ch['avatarenable'];
            $enableName = $ch['nameenable'];
            $fans = pdo_fetch('SELECT nickname,avatar FROM ' . tablename('fans') . ' WHERE  weid=:weid and from_user = :from_user LIMIT 1', array(':weid' => $weid, ':from_user' => $from_user));
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
                            $tourl = $head_file;
                            $curl = curl_init($tourl);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                            $imageData = curl_exec($curl);
                            curl_close($curl);
                            $tp = fopen($head_cache_file, 'w');
                            fwrite($tp, $imageData);
                            fclose($tp);
                        }
                        $this->mergeImage($target_file, $head_cache_file, $target_file, array('left' => $ch['avatarleft'], 'top' => $ch['avatartop'], 'width' => $ch['avatarwidth'], 'height' => $ch['avatarheight']));
                    }
                }
            }
            return BJ_QMXK_BASE . '/tmppic/' . $att_target_file;
        }
        return '';
    }
    public function writeText($bg, $out, $text, $param = array())
    {
        list($bgWidth, $bgHeight) = getimagesize($bg);
        extract($param);
        $im = imagecreatefromjpeg($bg);
        $black = imagecolorallocate($im, 0, 0, 0);
        $font = IA_ROOT . BJ_QMXK_BASE . '/font/msyhbd.ttf';
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
    public static function decode_channel_param($item, $p)
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
        $item['nameleft'] = intval($gpc['nameleft']) ? intval($gpc['nameleft']) : 211;
        $item['nametop'] = intval($gpc['nametop']) ? intval($gpc['nametop']) : 68;
        $item['namesize'] = intval($gpc['namesize']) ? intval($gpc['namesize']) : 16;
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
    public function getLimitQR($account, $scene_id)
    {
        $qr_url = null;
        $data = array('action_name' => 'QR_LIMIT_STR_SCENE', 'action_info' => array('scene' => array('scene_str' => $scene_id)));
        $content = $this->getQRTicket($this->get_weixin_token($account), $data);
        if ($content['errcode'] == 0) {
            $qr_url = $this->getQRImage($content['ticket']);
        }
        return $qr_url;
    }
    private function getQRTicket($token, $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$token}";
        $ret = ihttp_request($url, json_encode($data));
        $content = @json_decode($ret['content'], true);
        return $content;
    }
    public function getQRImage($ticket)
    {
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($ticket);
        return $url;
    }
    public function get_weixin_token($account)
    {
        if (is_array($account['access_token']) && !empty($account['access_token']['token']) && !empty($account['access_token']['expire']) && $account['access_token']['expire'] > TIMESTAMP) {
            return $account['access_token']['token'];
        } else {
            if (empty($account['weid'])) {
                return '';
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
                return '';
            }
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
            $content = ihttp_get($url);
            if (empty($content)) {
                return '';
            }
            $token = @json_decode($content['content'], true);
            if (empty($token) || !is_array($token)) {
                return '';
            }
            if (empty($token['access_token']) || empty($token['expires_in'])) {
                return '';
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
}