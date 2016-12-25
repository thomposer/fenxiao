<?php
/**
 * 粉丝top榜模块处理程序
 *
 * @author yoby
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

function get_timef($begin_time,$end_time)
{
	if($begin_time < $end_time){
		$starttime = $begin_time;
		$endtime = $end_time;
	} else {
		$starttime = $end_time;
		$endtime = $begin_time;
	}
	$timediff = $endtime-$starttime;
	$days = intval($timediff/86400);
	$remain = $timediff%86400;
	$hours = intval($remain/3600);
	$remain = $remain%3600;
	$mins = intval($remain/60);
	$secs = $remain%60;
	$res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
	return $res;
}

class TopModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		$content = $this->message['content'];
		$fromuser = $this->message['from'];
		$name = $_W['account']['name'];//公众号名称
		$t = $this->module['config']['t'];//0是图文，1是文本
		$n = $this->module['config']['n'];//初始化、重置粉丝数
		$url = $this->module['config']['url'];//跳转地址
		$desc = $this->module['config']['desc'];//描述
		$img = $this->module['config']['img'];//图片
		$urltext = $this->module['config']['urltext'];//超链接文本

		$isk = $this->module['config']['isk'];

		$weid = $_W['weid'];
		$item2 = pdo_fetch("SELECT num,createtime,likai FROM ".tablename('top_n')." WHERE weid = :weid and fromuser=:fromuser" , array(':weid' => $weid,':fromuser'=>$fromuser));
		if(empty($item2)){
			$item3 = pdo_fetch("SELECT num FROM ".tablename('top')." WHERE weid = :weid" , array(':weid' => $weid));
			$ttt = time();
			$data = array(
				'weid'=>$weid,
				'fromuser'=>$fromuser,
				'num'=>$item3['num']+1,
				'createtime'=>$ttt
			);
			pdo_insert('top_n',$data);
			pdo_query("update ".tablename('top')." set num=num+1 where weid=:weid", array(':weid' => $weid));
			$item = pdo_fetch("SELECT num FROM ".tablename('top')." WHERE weid = :weid" , array(':weid' => $weid));//查询是否存在weid
			$num = intval($item['num']);
			$likai = "嗨! 欢迎您在".date('Y年m月d日H点i分s秒',$ttt)."关注我们!";
		}else{
			$num =$item2['num'];
			$tian = get_timef($item2['likai'],time());
			$tian1 = get_timef($item2['createtime'],$item2['likai']);
			$likai = "最近离开时间:".date('Y年m月d日H点i分s秒,',$item2['likai'])."离开天数".$tian['day']."天".$tian['hour']."小时".$tian['min']."分钟".$tian['sec']."秒. 停留时间".$tian1['day']."天".$tian1['hour']."小时".$tian1['min']."分钟".$tian1['sec']."秒.";
		}
		$num=fans_search($fromuser, array('id'));
		$numx=$n+$num['id'];
		//$str = "嗨,欢迎关注【".$name."】,您是第".$numx."位关注人!\n".$desc."\n <a href='".$url."'>".$urltext."</a>";
		$str = str_replace('{name}', $name, $desc);
		$str = str_replace('{numx}', $numx, $str);
		return $this->respText($str);
	}
}