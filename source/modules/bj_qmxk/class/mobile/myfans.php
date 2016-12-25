<?php
$cfg = $this->module['config'];
$id = $profile['id'];
$count1 = 0;
$count2 = 0;
$count3 = 0;
if (true) {
    $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where mber1.realname<>\'\' and mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
    $count1 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}");
}
if (true && $cfg['globalCommissionLevel'] >= 2) {
    $level2 = 'select level2m.id from ' . tablename('bj_qmxk_member') . ' level2m where level2m.id!=level2m.shareid and  level2m.shareid = ' . $profile['id'];
    $sql2_member = 'select mber2.from_user from ' . tablename('bj_qmxk_member') . ' mber2 where mber2.realname<>\'\' and mber2.id!=mber2.shareid and mber2.shareid in (' . $level2 . ')  ';
    $count2 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ") ) and fans.weid={$_W['weid']}");
}
if (true && $cfg['globalCommissionLevel'] >= 3) {
    $level3 = 'select level3m.id from ' . tablename('bj_qmxk_member') . ' level3m where level3m.id!=level3m.shareid and level3m.shareid in( ' . $level2 . ')';
    $sql3_member = 'select mber3.from_user from ' . tablename('bj_qmxk_member') . ' mber3 where mber3.realname<>\'\' and  mber3.id!=mber3.shareid and mber3.shareid in (' . $level3 . ')  ';
    $count3 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}");
}
include $this->template('myfans');