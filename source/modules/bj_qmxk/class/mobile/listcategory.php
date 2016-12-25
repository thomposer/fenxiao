<?php
$category = pdo_fetchall('SELECT * FROM ' . tablename('bj_qmxk_category') . " WHERE weid = '{$_W['weid']}' and enabled=1 ORDER BY parentid ASC, displayorder DESC", array(), 'id');
foreach ($category as $index => $row) {
    if (!empty($row['parentid'])) {
        $children[$row['parentid']][$row['id']] = $row;
        unset($category[$index]);
    }
}
$carttotal = $this->getCartTotal();
$cfg = $this->module['config'];
$ydyy = $cfg['ydyy'];
$id = $profile['id'];
if (CUSTOMER_CODE == '003LZ') {
    include $this->template('clz_list_category');
    die;
}
include $this->template('list_category');