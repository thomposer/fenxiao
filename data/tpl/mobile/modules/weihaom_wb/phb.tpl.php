<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta content="telephone=no" name="format-detection"> 
<title><?php  echo $weibb['title'];?></title>
<link href="./source/modules/weihaom_wb/style/css/style1.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="page-load-container" style="min-height: 771px; opacity: 1;">
<div class="page-load-page ranking-page"  style="min-height: 771px;">
	
	<div class="ranking-body" style="padding-top:0px;">
		<div class="ranking-banner">
			<img src="./source/modules/weihaom_wb/images/ranking-banner.jpg" border="0" alt="">
			<span class="ranking-banner-text"><?php  echo $str;?></span>
			<span class="ranking-time"></span>
				<a target='_blank' class="to-index-button" href="<?php  echo $this->createMobileUrl('index', array('rid' => $rid))?>#mp.weixin.qq.com#wechat_redirect">返回<br>游戏</a>
		</div>
		
		<div class="ranking-list" >
			<div class="tr">
				<div class="th th1">名次<span class="arrow arrow-bottom"></span></div>
				<div class="th th2">姓名<span class="arrow arrow-bottom"></span></div>
				<div class="th th3">最高分<span class="arrow arrow-bottom"></span></div>
			</div>

			<?php  $num=1?>
			<?php  if(is_array($users)) { foreach($users as $user) { ?>
			
			<div class="tr">
			
				<div class="td td1 r<?php  echo $num;?>"></div>
				
				<div class="td td2">
				
				<div class="user-head ellipsis">
					<span class="week-crown">
					
					
					</span>
					<?php  echo $user['realname'];?>
				</div>
				</div>
				<div class="td td3"><?php  echo $user['score'];?></div>
			</div>
			<div class="tr">
				<div class="td"></div>
				<div class="td"></div>
				<div class="td"></div>
			</div>
			<?php  $num++?>
			<?php  } } ?>
	
		</div>
	</div>
	<div class="power-by">
		@<?php  echo $_W['account']['name'];?>
	</div>
		<script type="text/javascript">
	window.shareData = {
	        "imgUrl": "<?php  echo $_W['siteroot'];?>resource/attachment/<?php  echo $set['fimg'];?>",
	        "timeLineLink": "<?php  echo $_W['siteroot'];?><?php  echo $this->createMobileUrl('index', array('rid' => $rid))?>",
	        "tTitle": "<?php  echo $set['title1'];?>",
	        "tContent": "<?php  echo $set['description1'];?>"
	    };
	
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	    
	    WeixinJSBridge.on('menu:share:appmessage', function(argv) {
	        WeixinJSBridge.invoke('sendAppMessage', {
	            "img_url": window.shareData.imgUrl,
	            "link": window.shareData.timeLineLink,
	            "desc": window.shareData.tContent,
	            "title": window.shareData.tTitle
	        }, function(res) {
	        })
	    });

	    WeixinJSBridge.on('menu:share:timeline', function(argv) {
	        WeixinJSBridge.invoke('shareTimeline', {
	            "img_url": window.shareData.imgUrl,
	            "img_width": "640",
	            "img_height": "640",
	            "link": window.shareData.timeLineLink,
	            "desc": window.shareData.tContent,
	            "title": window.shareData.tTitle
	        }, function(res) {
			
	        });
	    });
	}, false);
</script>
</div>
</div>
</body>
</html>