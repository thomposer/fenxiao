<?php
/**
 * 粉丝top榜模块订阅器
 *
 * @author yoby
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class TopModuleReceiver extends WeModuleReceiver {
	public function receive() {
		$type = $this->message['type'];
		if($this->message['event'] == 'unsubscribe') {
			pdo_update('top_n', array(
				'likai' => TIMESTAMP,
			), array('fromuser' => $this->message['fromusername'], 'weid' => $GLOBALS['_W']['weid']));
		}
	}
}