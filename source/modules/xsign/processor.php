<?php
/*
 * 
 *
 */
defined('IN_IA') or exit('Access Denied');

class xsignModuleProcessor extends WeModuleProcessor {
	public function isNeedInitContext() {
		return 0;
	}
	
	public function respond() {
		global $_GPC, $_W;
		$rid = $this->rule;
		$message = $this->message;
		$from = $message['from'];
		$dsign= $this->sign($from,$rid,$GLOBALS['_W']['weid']);
		$profile = fans_search($from);
		$sql = "SELECT * FROM " . tablename('xsign_reply') . " WHERE `rid`=:rid LIMIT 1";
		$row = pdo_fetch($sql, array(':rid' => $rid));
		if (empty($row['id'])) {
			return array();
		}
		return $this->respText($dsign['msg']." \n\n".$row['description']." \n\n<a href='".$this->createMobileUrl('index', array('rid' => $rid))."'>&gt;&gt;点击查看详情</a>");
	}
	
	public function sign($fromuser,$rid,$weid) {
		$now = time();
		$start_day = isset($this->module['config']['start_day']) ? $this->module['config']['start_day'] : date('Y-m-d H:i', time() );
		$start_day = strtotime($start_day);
		$end_day = isset($this->module['config']['end_day']) ? $this->module['config']['end_day'] : date('Y-m-d H:i', time()+2592000 );
		$end_day = strtotime($end_day);
		$start_time = isset($this->module['config']['start_time']) ? $this->module['config']['start_time'] : '06:00';
		$start_time = strtotime($start_time);
		$end_time = isset($this->module['config']['end_time']) ? $this->module['config']['end_time'] : '22:00';
		$end_time = strtotime($end_time);
		$times = isset($this->module['config']['times']) ? $this->module['config']['times'] : 1;
		$credit = isset($this->module['config']['credit']) ? $this->module['config']['credit'] : 2;
		$tsignnum = isset($this->module['config']['tsign']) ? $this->module['config']['tsign'] : 0;
		$taward = $this->module['config']['tsignprize'];
		$csignnum = isset($this->module['config']['csign']) ? $this->module['config']['csign'] : 0;
		$caward = $this->module['config']['csignprize'];
		$osignnum = isset($this->module['config']['osign']) ? $this->module['config']['osign'] : 0;
		$oaward = $this->module['config']['osignprize'];
		$current_date = date('Y-m-d');
		$current_date = strtotime($current_date);
		$today_allsigned_info = pdo_fetchall("SELECT * FROM " . tablename('xsign_record') . " WHERE `sign_time` >= :current_date ", array(':current_date' => $current_date));
		$today_allsigned_num = count($today_allsigned_info);
		$today_user_rank = $today_allsigned_num + 1;
		$today_usersigned_info = pdo_fetchall("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser AND sign_time >= :current_date ", array(':fromuser' => $fromuser, ':current_date' => $current_date));
		$today_usersigned_num = count($today_usersigned_info);
		$user_lastsign_info = pdo_fetch("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser ORDER BY sign_time DESC LIMIT 1 ", array(':fromuser' => $fromuser ));
		$user_last_sign_time = $user_lastsign_info['last_sign_time'];
		$user_continue_sign_days = $user_lastsign_info['continue_sign_days'];
		$user_maxcontinue_sign_days = $user_lastsign_info['maxcontinue_sign_days'];
		$user_first_sign_days = $user_lastsign_info['first_sign_days'];
		$user_maxfirst_sign_days = empty($user_lastsign_info['maxfirst_sign_days'])?0:$user_lastsign_info['maxfirst_sign_days'];
		$user_allsign_num = $user_lastsign_info['total_sign_num'];
		$user_maxallsign_num = $user_lastsign_info['maxtotal_sign_num'];
		$profile = fans_search($fromuser);
		if(!empty($fromuser)){
			if(!empty($profile['realname']) && !empty($profile['mobile']) ){
				if($now >= $start_day && $now <= $end_day){//在活动日期内
					if($now >= $start_time && $now <= $end_time){//在活动时间内
						if($today_usersigned_num == 0){
							if( $user_last_sign_time == 0){
								$user_last_sign_time = $now;
							}
							if( ($now - $user_last_sign_time) < 86400 ){
								$continue_sign_days = $user_continue_sign_days + 1;
							} else {
								$continue_sign_days = 0;
							}
							if( $continue_sign_days < $user_maxcontinue_sign_days ){
								$maxcontinue_sign_days = $user_maxcontinue_sign_days;
							} else {
								$maxcontinue_sign_days = $continue_sign_days;
							}
							if($today_user_rank == 1){
								$first_sign_days = $user_first_sign_days + 1;
								$maxfirst_sign_days = $user_maxfirst_sign_days + 1;
							}
							else{
								$first_sign_days = $user_first_sign_days;
								$maxfirst_sign_days = $user_maxfirst_sign_days;
							}
							$total_sign_num = $user_allsign_num + 1;
							$maxtotal_sign_num = $user_maxallsign_num + 1;
							$insert = array(
								'rid' => $rid,
								'fromuser' => $fromuser,
								'username' => $profile['realname'],
								'today_rank' => $today_user_rank,
								'sign_time' => $now,
								'credit' => $credit,
							);
							pdo_insert('xsign_record', $insert);
							$givecredit['credit1'] = $credit + $profile['credit1'];
							fans_update($fromuser, $givecredit);
							$update = array(
								'last_sign_time' => $now,
								'continue_sign_days' => $continue_sign_days,
								'maxcontinue_sign_days' => $maxcontinue_sign_days,
								'total_sign_num' => $total_sign_num,
								'maxtotal_sign_num' => $maxtotal_sign_num,
								'first_sign_days' => $first_sign_days,
								'maxfirst_sign_days' => $maxfirst_sign_days,
							);
							pdo_update('xsign_record', $update, array('fromuser' => $fromuser));
							$user_newsign_info = pdo_fetch("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser ORDER BY sign_time DESC LIMIT 1 ", array(':fromuser' => $fromuser ));
							$user_newcontinue_sign_days = $user_newsign_info['continue_sign_days'];
							$user_newfirst_sign_days = $user_newsign_info['first_sign_days'];
							$user_newtotal_sign_num = $user_newsign_info['total_sign_num'];
							if($user_newsign_info['id']){
								$status = 1;
								if($user_newcontinue_sign_days == $csignnum){
									$tip1 = "\n\n连续签到奖励";
									$user_newcontinue_sign_days = 0;
									$type = '连续签到奖';
									$credit=$credit+$caward;
									$unsetrecord = array(
										'continue_sign_days' => $user_newcontinue_sign_days,
										'first_sign_days' => $user_newfirst_sign_days,
										'total_sign_num' => $user_newtotal_sign_num,
									);
									pdo_update('xsign_record', $unsetrecord, array('fromuser' => $fromuser));
								}
								if($user_newfirst_sign_days == $osignnum){
									$tip2 = "\n\n第一累计奖励";
									$user_newfirst_sign_days = 0;
									$type = '第一累计奖';
									$credit=$credit+$oaward;
									$unsetrecord = array(
										'continue_sign_days' => $user_newcontinue_sign_days,
										'first_sign_days' => $user_newfirst_sign_days,
										'total_sign_num' => $user_newtotal_sign_num,
									);
									pdo_update('xsign_record', $unsetrecord, array('fromuser' => $fromuser));

								}
								if($user_newtotal_sign_num == $tsignnum){
									$tip3 = "\n\n累计签到奖励";
									$user_newtotal_sign_num = 0;
									$type = '累计签到奖';
									$credit=$credit+$taward;
									$unsetrecord = array(
										'continue_sign_days' => $user_newcontinue_sign_days,
										'first_sign_days' => $user_newfirst_sign_days,
										'total_sign_num' => $user_newtotal_sign_num,
									);
									pdo_update('xsign_record', $unsetrecord, array('fromuser' => $fromuser));
								}
								$tip = "签到成功!\n\n您已连续签到".($continue_sign_days)."天。\n\n本次签到，您获得了的奖励是：".$tip1.$tip2.$tip3."\n\n奖励".$credit."个积分";
							} else {
								$status = 0;
								$tip = '签到失败';
							}
						}
						if(0 < $today_usersigned_num && $today_usersigned_num < $times){
							if( $user_last_sign_time == 0){
								$user_last_sign_time = $now;
							}
							if ((($now - $user_last_sign_time)>86400)&&(($now - $user_last_sign_time)<(86400*2))){
								$continue_sign_days = $user_continue_sign_days + 1;
							} else {
								$continue_sign_days = $user_continue_sign_days;
							}
							if( $continue_sign_days < $user_maxcontinue_sign_days ){
								$maxcontinue_sign_days = $user_maxcontinue_sign_days;
							} else {
								$maxcontinue_sign_days = $continue_sign_days;
							}							
							$insert = array(
								'rid' => $rid,
								'fromuser' => $fromuser,
								'username' => $profile['realname'],
								'today_rank' => $today_user_rank,
								'sign_time' => $now,
								'credit' => $credit,
							);
							pdo_insert('xsign_record', $insert);
							$givecredit['credit1'] = $credit + $profile['credit1'];
							fans_update($fromuser, $givecredit);
							$total_sign_num = $user_allsign_num + 1;
							$maxtotal_sign_num = $user_maxallsign_num + 1;
							$update = array(
								'last_sign_time' => $now,
								'continue_sign_days' => $continue_sign_days,
								'maxcontinue_sign_days' => $maxcontinue_sign_days,
								'total_sign_num' => $total_sign_num,
								'maxtotal_sign_num' => $maxtotal_sign_num,
								'first_sign_days' => $user_first_sign_days,
								'maxfirst_sign_days' => $user_maxfirst_sign_days,
							);
							pdo_update('xsign_record', $update, array('fromuser' => $fromuser));
							$user_newsign_info = pdo_fetch("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser ORDER BY sign_time DESC LIMIT 1 ", array(':fromuser' => $fromuser ));
							$user_newcontinue_sign_days = $user_newsign_info['continue_sign_days'];
							$user_newfirst_sign_days = $user_newsign_info['first_sign_days'];
							$user_newtotal_sign_num = $user_newsign_info['total_sign_num'];
							if($user_newsign_info['id']){
								$status = 1;
								if($user_newtotal_sign_num == $tsignnum){
									$tip = '获得累计签到奖励';
									$user_newtotal_sign_num = 0;
									$type = '累计签到奖';
									$givecredit['credit1'] = $credit + $profile['credit1']+$taward;
									fans_update($fromuser, $givecredit);
								} else {
									$tip = '签到成功!\n您已连续签到'.$continue_sign_days.'天。\n本次签到获得'.$credit.'个积分。\n';
									$tip = "签到成功!\n\n您已连续签到".$continue_sign_days."天。\n\n本次签到，您获得了的奖励是：".$tip1.$tip2.$tip3."\n\n奖励".$credit."个积分";
								}
								if($user_newtotal_sign_num == 0){
									$unsetrecord = array(
										'total_sign_num' => $user_newtotal_sign_num,
									);
									pdo_update('xsign_record', $unsetrecord, array('fromuser' => $fromuser));
								}
							} else {
								$status = 0;
								$tip = '签到失败';
							}
						}
						if($today_usersigned_num >= $times){
							$status = 0;
							$tip = '今日签到次数用完了哟~~';
						}
					} else {
						$status = 0;
						$tip = '现在不是签到时间哟~~';
					}
				} else {
					$status = 0;
					$tip = '活动还没有开始哟~~';
				}
			} else {
				$status = 0;
				$tip = '请先注册';
			}
		} else {
			$status = 0;
			$tip = '请先注册';
		}
		$data = array(
			'msg' => $tip,
			'status' => $status,
			'url' => $url,
		);
		return $data;
	}

	public function isNeedSaveContext() {
		return false;
	}
}