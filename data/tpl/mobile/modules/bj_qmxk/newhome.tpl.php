<?php defined('IN_IA') or exit('Access Denied');?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom1.css?v=<?php echo BJ_QMXK_VERSION;?>">
	<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.js?v=<?php echo BJ_QMXK_VERSION;?>"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/css/func.js?v=<?php echo BJ_QMXK_VERSION;?>"></script>
	<style>
	.foot{
		width:100%;
		min-width:300px;
		margin-top:10px;
		margin-bottom:30px;
		padding:10px 0;
		color:#555;
		text-align:center;
		}
	.foot a{
		color:#555;
		margin:0 3px;
		}  
</style>
</head>

<body class="body-gray">


    <div class="panel memberhead">
        <div class="header-l">
			<img class="icon-level-p1" src="<?php  if(empty($myheadimg['avatar'])) { ?><?php echo BJ_QMXK_ROOT;?>/style/images/yh.png<?php  } else { ?><?php  echo $myheadimg['avatar'];?><?php  } ?>"/>
		</div>
		<div class="header-r">
            <ul class="distributor-infor">
                <li><span class="distributor-infor-label">昵称：</span><span class="distributor-infor-c"><?php  echo $profile['realname'];?></span></li>
                <li><span class="distributor-infor-label">ID号：</span><span class="distributor-infor-c"><?php  echo $memid;?></span></li>				
                <li><span class="distributor-infor-label">等级：</span><span class="distributor-infor-c"><?php  if($profile['flag']==0) { ?>普通会员<?php  } else { ?><?php  echo $medal_name;?><?php  } ?>(<a class="txt-link"href="<?php  echo $this->createMobileUrl('list')?>" >  <?php  if($profile['flag']==0) { ?><?php  echo $tmsg;?></a> <?php  } else { ?>分享微店赚佣金<?php  } ?></a>)</span>
                </li>
                <li><span class="distributor-infor-label">关注：</span><span class="distributor-infor-c">
                   <?php  echo date('Y-m-d', $profile['createtime'])?></span>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <!--head end-->
    <!--count begin-->
    <div class="row count">
        <div class="small-4 large-3 columns mid">
        	 	<?php  if(CUSTOMER_CODE=='001HEML') { ?>
        	 <a href="#" class="count-a">
                <p class="count-dis-mony"><?php  echo $priceTotal;?></p>
                <span class="count-title">销售总额</span></a>
                		<?php  } else { ?> 
                		 <a href="#" class="count-a">
                <p class="count-dis-mony"><?php  echo $myheadimg['credit1'];?></p>
                <span class="count-title">总积分</span></a>
                		<?php  } ?> 
        </div>
        <div class="small-4 large-3 columns mid">
        	  	 	<?php  if(CUSTOMER_CODE=='001HEML') { ?>
        	 <a href="#" class="count-a">
                <p class="count-dis-mony"><?php  echo $commissionTotal;?></p>
                <span class="count-title">分销金额</span></a>
                			<?php  } else { ?> 
                	<a href="#" class="count-a">
                <p class="count-dis-mony"><?php  echo $profile['credit2'];?></p>
                <span class="count-title">账户余额</span></a>
                	<?php  } ?> 
            <!-- -->
        </div>
		
       <div class="small-4 large-3 columns last">
            <a href="#" class="count-a">
                <p class="count-dis-mony"><?php  echo $profile['commission'];?></p>
                <span class="count-title">已结佣金</span></a>
        </div>
	
    </div>
    <!--count end-->
    
    	  
        <div class="text-center" style=" margin-top:5px;margin-bottom:5px; font-size:14px;">
        	 	<?php  if(!empty($shareprofile['realname'])) { ?>
        	你是由【<?php  echo $shareprofile['realname'];?>】推荐
        		<?php  } else { ?> 
        	你是由【<?php  echo $_W['account']['name'];?>】推荐
         	<?php  } ?> 
        </div>
         
        
            	
		  	<?php  if($profile['flag']==1) { ?>
	   <div class="panel member-nav">
        <ul class="side-nav">
       <?php  if($profile['flag']==1) { ?>
				 <li><a href="<?php  echo $this->createMobileUrl('Erwema')?>"><i class="icon-qrcode"></i><span class="text">我的二维码</span><i class="arrow"></i></a></li>
           	<?php  } ?> 
           
              <?php  if($profile['flag']==1&&$commtime['ischeck']==2) { ?>
				 <li><a href="<?php  echo $this->createMobileUrl('dzd',array('op'=>'setting'))?>"><i class="icon-account"></i><span class="text">我要开店</span><i class="arrow"></i></a></li>
        
           	    <?php  if(false&&$profile['flag']==1&&$profile['dzdflag']==1) { ?>
				 <li><a href="<?php  echo $this->createMobileUrl('list',array('dzdid'=>$profile['id']))?>"><i class="icon-qrcode"></i><span class="text">我的小店</span><i class="arrow"></i></a></li>
           	<?php  } ?>    	<?php  } ?> 
			<li>
                <a id="disstroe" href="javascript:void(0)"><i class="icon-lowLevel"></i><span class="text"><?php  if($profile['flag']==1&&$profile['dzdflag']==1&&$commtime['ischeck']==2) { ?> 小店会员<?php  } else { ?>我的会员<?php  } ?></span><i class="arrow"></i> <span class="tip-number"><?php  echo $count;?></span>
                    
                </a>
                <div id="disstroe-sub" class="member-nav-sub" style="display: none;">
                    <ul class="member-nav-sub-ul">
               <?php  if(CUSTOMER_CODE=='001HEML') { ?>
                        <li class="member-nav-sub-li"  id="shop"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>1,'flag'=>0))?>"><span class="text">一级普通会员</span><i class="arrow"></i>
                            
                       <span class="tip-number"><?php  echo $count1;?></span> </a></li>
                       	
                       	 <li class="member-nav-sub-li"  id="shop"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>1,'flag'=>1))?>"><span class="text">一级销售代理</span><i class="arrow"></i>
                            
                       <span class="tip-number"><?php  echo $count1_1;?></span> </a></li>
											   <?php  if($cfg['globalCommissionLevel']>=2) { ?>
						            <li class="member-nav-sub-li" id="subShop"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>2,'flag'=>0))?>"><span class="text">二级普通会员</span><i class="arrow"></i>
                            
                       <span class="tip-number"><?php  echo $count2;?></span> </a></li>
                       	           <li class="member-nav-sub-li" id="subShop"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>2,'flag'=>1))?>"><span class="text">二级销售代理</span><i class="arrow"></i>
                            
                       <span class="tip-number"><?php  echo $count2_1;?></span> </a></li>
                       	
                       	<?php  } ?>
										     <?php  if($cfg['globalCommissionLevel']>=3) { ?>
											<li class="member-nav-sub-li"  id="subShop1"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>3,'flag'=>0))?>"><span class="text">三级普通会员</span><i class="arrow"></i>
                            
                       <span class="tip-number"><?php  echo $count3;?></span> </a></li>
                       		<li class="member-nav-sub-li"  id="subShop1"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>3,'flag'=>1))?>"><span class="text">三级销售代理</span><i class="arrow"></i>
                            
                       <span class="tip-number"><?php  echo $count3_1;?></span> </a></li>
                       	
                       	<?php  } ?>
                       	
                <?php  } else { ?> 
                
                           <li class="member-nav-sub-li"  id="shop"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>1))?>"><span class="text">一级普通会员</span><i class="arrow"></i>
                            
			                       <span class="tip-number"><?php  echo $count1+$count1_1?></span> </a></li>
			                       	
			                          <?php  if($cfg['globalCommissionLevel']>=2) { ?>
									            <li class="member-nav-sub-li" id="subShop"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>2))?>"><span class="text">二级普通会员</span><i class="arrow"></i>
			                            
			                       <span class="tip-number"><?php  echo $count2+$count2_1?></span> </a></li>
			                       	  
			                       	<?php  } ?>
													     <?php  if($cfg['globalCommissionLevel']>=3) { ?>
														<li class="member-nav-sub-li"  id="subShop1"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>3))?>"><span class="text">三级普通会员</span><i class="arrow"></i>
			                            
			                       <span class="tip-number"><?php  echo $count3+$count3_1?></span> </a></li>
			                        	
			                       	<?php  } ?>
                
                <?php  } ?> 
                    </ul>
                </div>
            </li>
			
			<li>
                <a id="disstroe1" href="javascript:void(0)"><i class="icon-set"></i><span class="text"><?php  if($profile['flag']==1&&$profile['dzdflag']==1&&$commtime['ischeck']==2) { ?> 小店推广数据<?php  } else { ?>我的推广<?php  } ?></span><i class="arrow"></i> <span class="tip-number"><?php  echo ($clickcount+$followcount)?></span>
                    
                </a>
                <div id="disstroe-sub1" class="member-nav-sub" style="display: none;">
                    <ul class="member-nav-sub-ul">
                         <li class="member-nav-sub-li"  id="shop2"><a href="<?php  echo $this->createMobileUrl('fansorder')?>"><span class="text"><?php  if($profile['flag']==1&&$commtime['ischeck']==2) { ?> 小店订单<?php  } else { ?>推广订单<?php  } ?></span><i class="arrow"></i></a></li>
                            
                        <li class="member-nav-sub-li" id="subShop3"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>4))?>"><span class="text">推广点击</span><i class="arrow"></i> <span class="tip-number"><?php  echo $clickcount;?></span></a></li>
                            
                       <li class="member-nav-sub-li" id="subShop4"><a href="<?php  echo $this->createMobileUrl('myfansDetail',array('level'=>5))?>"><span class="text">成功关注</span><i class="arrow"></i><span class="tip-number"><?php  echo $followcount;?></span></a></li>
                    </ul>
                </div>
            </li>
			
              <li class="last"><a href="<?php  echo $this->createMobileUrl('commission')?>"><i class="icon-commission"></i><span class="text">佣金提现</span><i class="arrow"></i></a></li>
			
        </ul>
    </div>
	
	
	<?php  } ?>
	
	
	

   

    <div class="panel member-nav">
        <ul class="side-nav">
		
           		<?php  if(!empty($_W['account']['payment']['wechat']['switch'])&&!empty($_W['account']['payment']['credit']['switch'])) { ?>
					<li><a href="<?php  echo $this->createMobileUrl('rechargecredit2')?>"><i class="icon-passowrd"></i><span class="text">余额充值</span><i class="arrow"></i></a></li>
			<?php  } ?>
			  <li><a href="<?php  echo $this->createMobileUrl('register', array('id'=>$profile['id'], 'opp'=>'complate'))?>"><i class="icon-ratio"></i><span class="text">资料修改</span><i class="arrow"></i></a></li>
			  <li><a href="<?php  echo $this->createMobileUrl('award')?>"><i class="icon-personal"></i><span class="text">积分兑换</span><i class="arrow"></i></a></li>
                  <li><a href="<?php  echo $this->createMobileUrl('phb')?>"><i class="icon-card"></i><span class="text">销售排行榜</span><i class="arrow"></i> </a></li>
			
         <li><a href="<?php  echo $this->createMobileUrl('rule')?>"><i class="icon-client"></i><span class="text">帮助说明</span><i class="arrow"></i></a></li>

        </ul>
    </div>



	

    <!--side nav end-->
	
   
 <!--bottom begin
    <div class="h50"></div>-->
  <?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
   <!--bottom end-->
	
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
</body>
<script src="<?php echo BJ_QMXK_ROOT;?>/style/js/zepto.min.js"></script>
<script>
function report(){
	if(<?php  echo $credit;?>!=-1){
		return;
	}
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->createMobileurl('home',array('op'=>'report'))?>",
		dataType: "text",
		
		success: function (d) {
			if(d!=0){
				window.document.getElementById('wxqd').innerHTML = '获得'+d+'分';
				var credit = parseInt(window.document.getElementById('mygold').innerHTML);
				var credit1 = credit + parseInt(d);
				window.document.getElementById('mygold').innerHTML = credit1;
			}
		},
		
		error: function (xml, text, thrown){
			TopBox.alert("出错啦!");
		}
	});
}

</script>

<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
 <script>
   document.getElementById('wxloading').style.display='none';
   	</script>
</html>
   	</script>
</html>
