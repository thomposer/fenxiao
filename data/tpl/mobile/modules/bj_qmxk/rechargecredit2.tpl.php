<?php defined('IN_IA') or exit('Access Denied');?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>我的佣金</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/ds4.css?v=<?php echo BJ_QMXK_VERSION;?>">
		<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/foundation.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/foundation.tab.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/foundation.accordion.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/func.js"></script>
</head>
<body>
    <div class="mask"></div>
    <form class="form-horizontal img-rounded" role="form" method="post" >
  	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    <!--topbar end-->
    <!--amount begin-->
    <div class="bro-spare">
        <p class="tip-txt"><i class="icon-money"></i>账户可用余额</p>
        <span class="number-big">¥<?php  echo $profile['credit2'];?></span>
    </div>
    <!--amount end-->
    <!--list begin-->
    <ul class="maneylist" style="display: ;">
   
       
          <li class="maneylist-li">
                <i class="icon-money-circle"></i>
                <span class="text">充值余额</span>
                 <span class="text">	<input type="text" name="charge" value="" /></span>
      
        </li>
           
    </ul>
    <!--list end-->

    <div class="bro-extract-btn">
		<button type="submit" name="submit" value="submit" class="button [radius round] red" style="width:100%;">充值</button>
		
    </div>
</form>
 
    <!--help end-->


	<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
	

<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>


    
<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
