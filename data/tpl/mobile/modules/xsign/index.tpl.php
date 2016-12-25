<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
<html>
    <head>
    	 <meta charset="utf-8">
   <!--   <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
 <meta content="telephone=no, address=no" name="format-detection">
            <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <title>签到</title>
    <!-- meta viewport -->
    <!-- CSS -->
    <link rel="stylesheet" href="./source/modules/xsign/template/style/css/base.css" onerror="_cdnFallback(this)">        
    <link rel="stylesheet" href="./source/modules/xsign/template/style/css/checkin.css?x=1" onerror="_cdnFallback(this)">    </head>
    </head>
<body class=" body-fixed-bottom" style="width:100%">
        <!-- container -->
    <div class="container ">
                <div class="apps-game">
        <div class="apps-checkin">
    <div class="apps-checkin-nav">
 
            <div class="apps-checkin-avatar"><img src="<?php  echo $fansinfo['avatar'];?>"></div>
     
        <div class="apps-checkin-nav-opt">
            <a class="btn btn-opt" href="<?php  echo $this->createMobileUrl('rule', array('rid' => $rid ));?>">签到规则</a>
        </div>
        <div class="apps-checkin-userinfo">
            <p class="apps-checkin-userinfo-row"><?php  echo $profile['nickname'];?></p>
            <p class="apps-checkin-userinfo-row apps-checkin-userinfo-points">积分：<span class="js-points"><?php  echo $profile['credit1'];?></span></p>
        </div>
    </div>
    <div class="apps-checkin-content" style="width:100%">
        <div class="apps-checkin-center-content" style="width:100%; visibility: visible;">
            <div class="apps-checkin-center-block" >
                <div class="apps-checkin-center-info">
                    <h4 class="apps-checkin-center-info-title">连续签到</h4>
                    <p class="apps-checkin-center-info-row">
                        <span class="apps-checkin-center-info-days">
                        	<?php echo empty($user_lastsign_info['continue_sign_days'])?'0':$user_lastsign_info['continue_sign_days']?></span>
                        <span class="apps-checkin-center-info-small">天</span>
                    </p>
                </div>
            </div>
            
            <div class="apps-checkin-runway" style="width:100%">
             <div class="apps-checkin-progress apps-checkin-progress-fromzero" style="width:100%"></div>
                <div class="apps-checkin-progress-filled-wrap" style="width:100%">
                    <div class="apps-checkin-progress-filled"></div>
                </div>
                <div class="apps-checkin-prize-wrap" style="margin:0 auto; left:30%;vertical-align: middle;">
                    您有<span class="js-prize-need"><?php  echo $profile['credit1'];?></span>可用积分，签到增加积分！
                </div>
             <!---->
                <ul class="apps-checkin-days-wrap">
					 <!--<li class="apps-checkin-day <?php echo $dataw==11?'apps-checkin-day-at':''?>" style="width:5%">周</li>-->
                    <li class="apps-checkin-day <?php echo $datawp==1?'apps-checkin-day-at':''?>" style="width:5%">1</li>
                    <li class="apps-checkin-day <?php echo $datawp==2?'apps-checkin-day-at':''?>" style="width:5%">2</li>
                    <li class="apps-checkin-day <?php echo $datawp==3?'apps-checkin-day-at':''?>" style="width:5%">3</li>
                    <li class="apps-checkin-day <?php echo $datawp==4?'apps-checkin-day-at':''?>" style="width:5%">4</li>
                    <li class="apps-checkin-day <?php echo $datawp==5?'apps-checkin-day-at':''?>" style="width:5%">5</li>
                    <li class="apps-checkin-day <?php echo $datawp==6?'apps-checkin-day-at':''?>" style="width:5%">6</li>
                    <li class="apps-checkin-day <?php echo $datawp==7?'apps-checkin-day-at':''?>" style="width:5%">7</li>
                </ul>
             <!--    <div class="apps-checkin-man" style="left: <?php echo $dataw>0?($dataw-1)*14:(6*14)?>%;"></div> --> 
            </div>
            

        </div>
    </div>


    <div class="apps-checkin-footer">
    					<?php  if($today_usersigned_num >= $times) { ?>
        <button class="btn btn-checkin js-checkin" disabled="disabled">已签到</button>
					<?php  } else { ?>
					  <button class="btn btn-checkin js-checkin"  onclick="dosignin()">签到</button>
					<?php  } ?>		
    </div>
</div>

<div id="wxcover"></div>

    
        <!--      <div class="custom-store">        <a class="custom-store-link clearfix" >
     
        <div class="custom-store-name"></div>
        <span class="custom-store-enter"></span>
    </a>     </div> -->                         
       <div class="custom-store">
       	<?php  if($qmxkdoor==true) { ?>
    <a class="custom-store-link clearfix" href="<?php  echo $homeurl;?>">
        <div class="custom-store-img"></div>
        <div class="custom-store-name">分销商城</div>
        <span class="custom-store-enter">进入商城首页</span>
    </a>
    		<?php  } ?>	
</div>  </div>

     <div class="js-footer" style="min-height: 1px;">
        
    <div class="footer">
        <div class="copyright">
                         <div class="ft-links">
                   </div>
                        <div class="ft-copyright">
   &copy<?php  echo $_W['account']['name'];?>
</div>
        </div>
    </div>
    </div>            </div>

 		<script type="text/javascript" src="./source/modules/xsign/template/style/js/jquery_min.js"></script>
		<script>
			/**
 			 * 积分签到
			*/
			function dosignin() {
				//提交信息
				$.ajax({
					type: "post",  
					url: "<?php  echo $this->createMobileUrl('sign', array('rid' => $rid));?>",
					dataType: "json",  
					success: function(html){
				    	if (html.status == 1) {
							alert(html.msg,1500);
							setTimeout("location.reload();",1500);
				    	} else {
				    		alert(html.msg,1500);
				    			setTimeout("location.reload();",1500);
							//window.location.href=html.url;
				    	}
					}
				});
				
				
			}
		</script>
</body>
</html>



 





                
                    
                
                
                
                
                
                
                    
                
                
                
                
                
                