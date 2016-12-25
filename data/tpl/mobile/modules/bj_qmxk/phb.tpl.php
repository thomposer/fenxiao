<?php defined('IN_IA') or exit('Access Denied');?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>代理排行榜</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">
     <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/pr4.css?v=<?php echo BJ_QMXK_VERSION;?>">

   
</head>
<body>
   
    <!--table begin-->
   
    <!--table end-->
   
   <!-- 01 begin-->
<div class="list-myorder">
    
    <ul class="ul-product">
        		<?php  $key=1?>
    		<?php  if(is_array($list)) { foreach($list as $member) { ?>
        <li>
       
                <span class="pic">
                    <img src="<?php  if(empty($member['avatar'])) { ?><?php echo BJ_QMXK_ROOT;?>/style/images/yh.png<?php  } else { ?><?php  echo $member['avatar'];?><?php  } ?>"></span>
                <div class="text">
                    <span class="pro-name">昵称：<?php  echo $member['realname'];?></span>
                    <div class="pro-pric"><span>等级：</span><?php  echo $this->getLevel($member['fanscount'])?></div>
                     <div class="pro-pric"><span>粉丝数：</span><?php  echo $member['fanscount'];?></div>
                </div>
        
            
        </li>
			<?php  $key++?>
			<?php  } } ?>
		
        
    </ul>
    
   


    

  
    
</div>
<!--01 end-->
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
