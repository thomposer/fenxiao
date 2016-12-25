<?php
/**
 * 粉丝top榜模块定义
 *
 * @author yoby
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class TopModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_GPC, $_W;
		$weid = $_W['weid'];
		if(!isset($settings['url'])) {
			$settings['url'] ="mobile.php?act=channel&name=index&weid=".$_W['weid'];
		}
		if(!isset($settings['n'])) {
			$item = pdo_fetch("SELECT num FROM ".tablename('top')." WHERE weid = :weid" , array(':weid' => $weid));
			$settings['n'] ='1000';
		}
		if(!isset($settings['t'])) {
			$settings['t'] ='1';
		}	
		if(!isset($settings['urltext'])) {
			$settings['urltext'] ='进入微站';
		}	
		if(!isset($settings['desc'])) {
			$settings['desc'] ='默认进入的是微站首页';
		}		
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$dat = array(
			'url' => $_GPC['url'],
			'n' => $_GPC['n'],
			't' => $_GPC['t'],
			'desc' => $_GPC['desc'],
			'img' => $_GPC['img'],
			'urltext' => $_GPC['urltext'],
			'isk'=>$_GPC['isk'],
			);
			
			$data1 = array(
				'weid'=>$weid,
				'num'=>$_GPC['n'],);
			$item = pdo_fetch("SELECT * FROM ".tablename('top')." WHERE weid = :weid" , array(':weid' => $weid));//查询是否存在weid

			if(empty($item)){
			pdo_insert('top', $data1);
			}else{
			pdo_update('top', $data1, array('weid' => $weid));
			}
			
			$this->saveSettings($dat);
			message('保存成功', 'refresh');
		}
		include $this->template('setting');
	}
}