<?php
defined('IN_IA') or exit('Access Denied');
class xsignModuleSite extends WeModuleSite {	
	public function getProfileTiles() {
	}
	
	public function getHomeTiles() {
		global $_W;
		$urls = array();
		$list = pdo_fetchall("SELECT name, id FROM ".tablename('rule')." WHERE weid = '{$_W['weid']}' AND module = 'xsign'");
		if (!empty($list)) {
			foreach ($list as $row) {
				$urls[] = array('title'=>$row['name'], 'url'=> $this->createMobileUrl('index', array('rid' => $row['id'])));
			}
		}
		return $urls;
	}
	
	public function getThisMonth($date){
		$firstday = date("Y-m-01",strtotime($date));
		$lastday = date("Y-m-d",strtotime("$firstday +1 month -1 day"));
		return array($firstday,$lastday);
	}
	
	public function getLastMonth($date){
		$timestamp=strtotime($date);
		$firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1).'-01'));
		$lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
		return array($firstday,$lastday);
	}
	
	public function getNextMonth($date){
		$timestamp=strtotime($date);
		$arr=getdate($timestamp);
		if($arr['mon'] == 12){
			$year=$arr['year'] +1;
			$month=$arr['mon'] -11;
			$firstday=$year.'-0'.$month.'-01';
			$lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
		} else {
			$firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)+1).'-01'));
			$lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
		}
		return array($firstday,$lastday);
	}
	
	public function doWebRecord(){
		global $_GPC, $_W;
		checklogin();
		$rid = intval($_GPC['id']);
		$condition = '';
		if (!empty($_GPC['username'])) {
			$condition .= " AND A.username = '{$_GPC['username']}' ";
		}
		if (!empty($_GPC['mobile'])) {
			$condition .= " AND B.mobile = '{$_GPC['mobile']}' ";
		}
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$list = pdo_fetchall("SELECT A.id AS newid, A.*, B.mobile, B.credit1 AS allcredit FROM ".tablename('xsign_record')." A LEFT JOIN ".tablename('fans')." B ON A.fromuser = B.from_user WHERE A.rid = '$rid' $condition ORDER BY allcredit DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('xsign_record') . " A WHERE A.rid = '$rid' ");
		$pager = pagination($total, $pindex, $psize);
		$memberlist = pdo_fetchall("SELECT distinct fromuser FROM ".tablename('xsign_record')."  WHERE rid = '$rid' ");
		$membertotal = count($memberlist);
		include $this->template('record');
	}
	
	public function doMobileIndex() {
		global $_GPC,$_W;
		$fromuser = $_W['fans']['from_user'];
		fans_require($fromuser, array('nickname','realname', 'mobile'), '请先注册');
		$rid = $_GPC['rid'];
		$weid = $_W['weid'];
		$current_date = date('Y-m-d');
		$times = isset($this->module['config']['times']) ? $this->module['config']['times'] : 1;
		$bd = $_GPC['bd'];
		$ed = $_GPC['ed'];
		if (!empty($bd) && !empty($ed) ){
			$current_month = $this -> getThisMonth($bd);
			$current_last_month = $this -> getLastMonth($bd);
			$current_next_month = $this -> getNextMonth($bd);
		} else {
			$current_month = $this -> getThisMonth($current_date);
			$current_last_month = $this -> getLastMonth($current_date);
			$current_next_month = $this -> getNextMonth($current_date);
		}
		$this_month_b = $current_month['0'];
		$this_month_e = $current_month['1'];
		$this_year = substr($this_month_b,0,4);
		$this_month = substr($this_month_b,5,2);
		$last_month_b = $current_last_month['0'];
		$last_month_e = $current_last_month['1']; 
		$last_month = substr(str_replace('-','',$last_month_b),0,6);
		$next_month_b = $current_next_month['0'];
		$next_month_e = $current_next_month['1'];
		$next_month = substr(str_replace('-','',$next_month_b),0,6);
		$month_usersigned_info = pdo_fetchall("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser AND `sign_time` >= :this_month_b AND `sign_time` <= :this_month_e", array(':fromuser' => $fromuser, ':this_month_b' => strtotime($this_month_b), ':this_month_e' => strtotime($this_month_e) ));
		$value = array(); 
		foreach( $month_usersigned_info as $value )	{
			$user_signed_days .= date('d',$value['sign_time']).',';
		}
		$user_signed_days = '['.$user_signed_days.']';
		$user_lastsign_info = pdo_fetch("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser ORDER BY sign_time DESC LIMIT 1 ", array(':fromuser' => $fromuser ));
		$user_maxallsign_num = $user_lastsign_info['maxtotal_sign_num'];
		$today_usersigned_info = pdo_fetchall("SELECT * FROM " . tablename('xsign_record') . " WHERE `fromuser` = :fromuser AND sign_time >= :current_date ", array(':fromuser' => $fromuser, ':current_date' => strtotime($current_date) ));
		$today_usersigned_num = count($today_usersigned_info);
		if(empty($user_maxallsign_num)){
			$user_maxallsign_num = 0;
		}
		$profile = fans_search($fromuser);
		if (!empty($rid)) {
			$reply = pdo_fetch("SELECT * FROM ".tablename('xsign_reply')." WHERE rid = :rid ", array(':rid' => $rid));			
		}
		$Picurl = $_W['attachurl'].$reply['picture'];
		$dataw=date('w');
		$fansinfo = pdo_fetch("SELECT * FROM " . tablename('fans') . " WHERE `from_user` = :fromuser and `weid`=:weid ", array(':fromuser' => $fromuser,':weid' => $_W['weid'] ));
		if(!empty($this->module['config']['qmxkdoor']))
		{
			$qmxkdoor=true;
			$homeurl=$GLOBALS['_W']['siteroot']."mobile.php?act=module&name=bj_qmxk&do=list&weid=".$GLOBALS['_W']['weid'];
		}
		if(empty($user_lastsign_info['continue_sign_days'])){
			$datawp = 0;	
		} else {
			if($user_lastsign_info['continue_sign_days'] == 1){ $datawp = 1;}
			if($user_lastsign_info['continue_sign_days'] == 2){ $datawp = 2;}
			if($user_lastsign_info['continue_sign_days'] == 3){ $datawp = 3;}
			if($user_lastsign_info['continue_sign_days'] == 4){ $datawp = 4;}
			if($user_lastsign_info['continue_sign_days'] == 5){ $datawp = 5;}
			if($user_lastsign_info['continue_sign_days'] == 6){ $datawp = 6;}
			if($user_lastsign_info['continue_sign_days'] >= 7){ $datawp = 7;}
		}
		include $this->template('index');
	}

	public function doMobileSign() {
		global $_GPC,$_W;
		$id = $_GPC['id'];
		$rid = $_GPC['rid'];
		$weid = $_W['weid'];
		$fromuser = $_W['fans']['from_user'];
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
		$user_maxfirst_sign_days = $user_lastsign_info['maxfirst_sign_days'];
		$user_allsign_num = $user_lastsign_info['total_sign_num'];
		$user_maxallsign_num = $user_lastsign_info['maxtotal_sign_num'];
		$profile = fans_search($fromuser);
		if(!empty($fromuser)){
			if(!empty($profile['realname']) && !empty($profile['mobile']) ){
				if($now >= $start_day && $now <= $end_day){
					if($now >= $start_time && $now <= $end_time){
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
			$tip = '请先注册'.$_W['account']['name'];
		}
		$data = array(
			'msg' => $tip,
			'status' => $status,
			'url' => $url,
		);
		$msg = json_encode($data);
		return $msg;
	}

	public function doMobileRule() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$reply = pdo_fetch("SELECT * FROM ".tablename('xsign_reply')." WHERE rid = :rid ", array(':rid' => $rid));			
		include $this->template('rule');
	}
}