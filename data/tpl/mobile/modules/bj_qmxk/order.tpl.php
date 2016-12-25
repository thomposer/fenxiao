<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html<?php  if($initNG) { ?> ng-app<?php  } ?>>
<head>
	<title>我的订单</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- Mobile Devices Support @begin -->
	<meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
	<meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
	<meta content="no-cache" http-equiv="pragma">
	<meta content="0" http-equiv="expires">
	<meta content="telephone=no, address=no" name="format-detection">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<!-- Mobile Devices Support @end -->
	<script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="./resource/script/common.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
	<link type="text/css" rel="stylesheet" href="./themes/mobile/default/style/bootstrap.css?x=<?php echo BJ_QMXK_VERSION;?>">
	<script type="text/javascript" src="./themes/mobile/default/script/bootstrap.min.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>

<?php  if($initNG) { ?><script type="text/javascript" src="./resource/script/angular.min.js?x=<?php echo BJ_QMXK_VERSION;?>"></script><?php  } ?>
	<link type="text/css" rel="stylesheet" href="./resource/style/font-awesome.min.css?x=<?php echo BJ_QMXK_VERSION;?>" />
	<link type="text/css" rel="stylesheet" href="./themes/mobile/default/style/common.mobile.css?x=<?php echo BJ_QMXK_VERSION;?>">
	<script type="text/javascript" src="./resource/script/cascade.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<script type="text/javascript" src="./themes/mobile/default/script/jquery.touchwipe.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<script type="text/javascript" src="./themes/mobile/default/script/swipe.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	
</head>

<body style="padding-top:0px;">
<?php  if(empty($main_off)) { ?><div class="main"><?php  } ?>
<style type='text/css'>
    .sel { background:#e9342a; color:#fff;}
    .nosel { background:#fff;color:#000}
</style>
<link type="text/css" rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/images/style.css">



<style>
.sel{background:#ff9900;}
.nosel{}
.myoder{border-radius:0px;}

</style>

 <!--<div class="myoder img-rounded" style='color:#aaa;padding:5px;'>
<div>姓名：<?php  echo $fans['realname'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 电话：<?php  echo $fans['mobile'];?></div>
<div>余额：<?php  echo $fans['credit2'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 积分：<?php  echo $fans['credit1'];?></div>
</div>-->
 <div class="myoder img-rounded" style='text-align:center;color:#aaa;padding:5px;'>
     <div style='float:left;height:30px;margin:auto;width:100%;'>
    <div <?php  if($status==0) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-left-radius: px;border-bottom-left-radius:-1px;border:1px solid #ff9900;text-align: center;float:left;width:20%;' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>0))?>'">
        待支付
    </div>
    <div <?php  if($status==1) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #ff9900;text-align: center;margin-left:-1px;float:left;width:20%' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>1))?>'">
        待发货
    </div>
    <div <?php  if($status==2) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #ff9900;margin-left:-1px;float:left;width:20%;text-align: center;' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>2))?>'">
        待收货
    </div>
    <div <?php  if($status==3) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #ff9900;margin-left:-1px;float:left;width:20%;text-align: center;' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>3))?>'">
        已完成
    </div>
       <div <?php  if($status==-5) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-right-radius: 1px;margin-left:-1px;border-bottom-right-radius:px;text-align: center;border:1px solid #ff9900;float:left;width:20%' onclick="location.href='<?php  echo $this->createMobileUrl('myorder',array('status'=>-5))?>'">
        退换货
    </div>
</div>
     <a style='float:right;' href="<?php  echo $this->createMobileUrl('address',array('from'=>'confirm'))?>">管理收货地址</a>
</div>



<?php  if(count($list)<=0) { ?>
<div class="myoder img-rounded" style='text-align:center;color:#aaa;padding:30px;'>
    您暂时没有任何订单!
</div>
<?php  } ?>
<div style='margin-bottom:40px;'>
<?php  if(is_array($list)) { foreach($list as $item) { ?>
<div class="myoder img-rounded">
	<div class="myoder-hd">
		<span class="pull-left">订单编号：<?php  echo $item['ordersn'];?></span>
		<span class="pull-right">  <?php  echo date('Y-m-d H:i', $item['createtime'])?>   
  			<?php  if($item['status'] == 0) { ?><span class="text-warning">待付款</span>			<?php  } ?>
			<?php  if($item['status'] == 1) { ?><span class="text-danger">待发货</span>			<?php  } ?>
			<?php  if($item['status'] == 2) { ?><span class="text-warning">待收货</span>			<?php  } ?>
			<?php  if($item['status'] == 3) { ?><span class="text-success">已完成</span>			<?php  } ?>
			<?php  if($item['status'] == -1) { ?><span class="text-success">已关闭</span>			<?php  } ?>
			<?php  if($item['status'] == -2) { ?><span class="text-danger">退款中</span>			<?php  } ?>
			<?php  if($item['status'] == -3) { ?><span class="text-danger">换货中</span>			<?php  } ?>
			<?php  if($item['status'] == -4) { ?><span class="text-danger">退货中</span>			<?php  } ?>
			<?php  if($item['status'] == -5) { ?><span class="text-success">已退货</span>			<?php  } ?>
			<?php  if($item['status'] == -6) { ?><span class="text-success">已退款</span>			<?php  } ?>
                </span>
	</div>
                  <?php  if(count($item['goods'])==1) { ?>
	<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
	<div class="myoder-detail">
		<a href="<?php  echo $this->createMobileUrl('detail', array('id' => $goods['id']))?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $goods['thumb'];?>" width="160"></a>
		<div class="pull-left">
			<div class="name"><a href="<?php  echo $this->createMobileUrl('detail', array('id' => $goods['id']))?>"><?php  echo $goods['title'];?></a></div>
			<div class="price">
				<span><?php  echo $goods['marketprice'];?> 元<?php  if($goods['unit']) { ?> / <?php  echo $goods['unit'];?><?php  } ?></span>
				<span class="num"><?php  echo $item['total'][$goods['id']]['total'];?><?php  if($goods['unit']) { ?> <?php  echo $goods['unit'];?><?php  } ?></span>
			</div>
		</div>
	</div>
	<?php  } } ?>
        <?php  } else { ?>
       
	<div class="myoder-detail">
             <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
		<a href="<?php  echo $this->createMobileUrl('detail', array('id' => $goods['id']))?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $goods['thumb'];?>" width="160"></a>
                <?php  } } ?>
	</div>
	
        <?php  } ?>
	 
	<div class="myoder-total">
		<span>共计：<span class="false"> <?php  if($item['dispatchprice']<=0) { ?>
                        <?php  echo $item['price'];?> 元
                        <?php  } else { ?>
                        <?php  echo $item['price'];?> 元 (运费 <?php  echo $item['dispatchprice'];?> 元) 
                        <?php  } ?></span></span>
	 	<a href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'detail'))?>" class="btn btn-success pull-right btn-sm" >订单详情</a>
		 
	</div>
</div>
<?php  } } ?></div>



<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/zepto.min.js" type="text/javascript"></script>
<script type="text/javascript">
Zepto(function($){
   var $nav = $('.global-nav'), $btnLogo = $('.global-nav__operate-wrap');
   //点击箭头，显示隐藏导航
   $btnLogo.on('click',function(){
     if($btnLogo.parent().hasClass('global-nav--current')){
       navHide();
     }else{
       navShow();
     }
   });
   var navShow = function(){
     $nav.addClass('global-nav--current');
   }
   var navHide = function(){
     $nav.removeClass('global-nav--current');
   }
   
   $(window).on("scroll", function() {
		if($nav.hasClass('global-nav--current')){
			navHide();
		}
	});
})
function get_search_box(){
	try{
		document.getElementById('get_search_box').click();
	}catch(err){
		document.getElementById('keywordfoot').focus();
 	}
}
</script>


<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>


