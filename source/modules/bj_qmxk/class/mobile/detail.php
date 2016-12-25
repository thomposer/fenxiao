<?php
$checkjsweixin = '1';
$from_user = $this->getFromUser();
$fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE from_user=:from_user and weid=:weid', array(':from_user' => $from_user, ':weid' => $_W['weid']));
if (!empty($fans) && !empty($fans['id']) && $fans['follow'] != 1 && empty($_COOKIE[BAIJIA_COOKIE_OPENID . '_checkfollow' . $_W['weid']])) {
    setcookie(BAIJIA_COOKIE_OPENID . $_W['weid'], '', time() - 1);
    setcookie(BAIJIA_COOKIE_OPENID . '_checkfollow' . $_W['weid'], '1', time() + 300);
    $from_user = $this->getFromUser();
}
$this->validateopenid();
$cfg = $this->module['config'];
$day_cookies = 15;
$shareid = BAIJIA_COOKIE_SID . $_W['weid'];
if ($_GPC['mid'] != $_COOKIE[$shareid] && !empty($_GPC['mid'])) {
    $this->shareClick($_GPC['mid'], $_GPC['joinway']);
    setcookie($shareid, $this->getShareId(), time() + 3600 * 24 * $day_cookies);
}
$this->autoRegedit('list');
$profile = $this->getProfile();
$this->checkisAgent($from_user, $profile);
$goodsid = intval($_GPC['id']);
$goods = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_goods') . ' WHERE id = :id', array(':id' => $goodsid));
$arr = $this->time_tran($goods['timeend']);
$goods['timelaststr'] = $arr[0];
$goods['timelast'] = $arr[1];
$ccate = intval($goods['ccate']);
$commission = pdo_fetchcolumn(' SELECT commission FROM ' . tablename('bj_qmxk_goods') . ' WHERE id=' . $goodsid . ' ');
$member = $profile;
if ($commission == false || $commission == null || $commission < 0) {
    $commission = $this->module['config']['globalCommission'];
}
if (empty($goods)) {
    message('抱歉，商品不存在或是已经被删除！');
}
if ($goods['totalcnf'] != 2 && empty($goods['total'])) {
    message('抱歉，商品库存不足！');
}
if ($goods['istime'] == 1) {
    if (time() < $goods['timestart']) {
        //message('抱歉，还未到购买时间, 暂时无法购物哦~', referer(), 'error');
    }
    if (time() > $goods['timeend']) {
        //message('抱歉，商品限购时间已到，不能购买了哦~', referer(), 'error');
    }
}
$this->memberQrcode($from_user);
pdo_query('update ' . tablename('bj_qmxk_goods') . " set viewcount=viewcount+1 where id=:id and weid='{$_W['weid']}' ", array(':id' => $goodsid));
$piclist = array(array('attachment' => $goods['thumb']));
if ($goods['thumb_url'] != 'N;') {
    $urls = unserialize($goods['thumb_url']);
    if (is_array($urls)) {
        $piclist = array_merge($piclist, $urls);
    }
}
$signPackage = $this->getSignPackage('detail', array('id' => $goods['id']), $_W['attachurl'] . $goods['thumb'], $goods['title']);
$marketprice = $goods['marketprice'];
$productprice = $goods['productprice'];
$stock = $goods['total'];
$allspecs = pdo_fetchall('select * from ' . tablename('bj_qmxk_spec') . ' where goodsid=:id order by displayorder asc', array(':id' => $goodsid));
foreach ($allspecs as &$s) {
    $s['items'] = pdo_fetchall('select * from ' . tablename('bj_qmxk_spec_item') . ' where  `show`=1 and specid=:specid order by displayorder asc', array(':specid' => $s['id']));
}
unset($s);
$options = pdo_fetchall('select id,title,thumb,marketprice,productprice,costprice, stock,weight,specs from ' . tablename('bj_qmxk_goods_option') . ' where goodsid=:id order by id asc', array(':id' => $goodsid));
$specs = array();
if (count($options) > 0) {
    $specitemids = explode('_', $options[0]['specs']);
    foreach ($specitemids as $itemid) {
        foreach ($allspecs as $ss) {
            $items = $ss['items'];
            foreach ($items as $it) {
                if ($it['id'] == $itemid) {
                    $specs[] = $ss;
                    break;
                }
            }
        }
    }
}
$params = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods_param') . ' WHERE goodsid=:goodsid order by displayorder asc', array(':goodsid' => $goods['id']));
$carttotal = $this->getCartTotal();
$rmlist = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_goods') . " WHERE weid = '{$_W['weid']}'  and deleted=0 AND status = '1' and ishot='1' ORDER BY displayorder DESC, sales DESC limit 4 ");
$ydyy = $cfg['ydyy'];
$description = $cfg['description'];
$id = $profile['id'];
$theone = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_rules') . ' WHERE  weid = :weid', array(':weid' => $_W['weid']));
$fans = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE from_user=:from_user and weid=:weid', array(':from_user' => $from_user, ':weid' => $_W['weid']));
if ($fans['follow'] != 1) {
    $shownotice = true;
}
if ($profile['status'] == 0) {
    $profile['flag'] = 0;
}
if ($member['status'] == 0) {
    $member['flag'] = 0;
}
include $this->template('detail');